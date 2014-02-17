<?php 
namespace Wells\L4LdapNtlm;

use Illuminate\Auth\UserProviderInterface;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\GenericUser;


/**
 * An LDAP/NTLM authentication driver for Laravel 4.
 *
 * @author Brian Wells (https://github.com/wells/)
 * 
 */
class L4LdapNtlmUserProvider implements UserProviderInterface
{
        /**
	 * The Eloquent configuration model
	 */
        protected $config;
	/**
	 * The Eloquent user model
	 * @var GenericUser
	 */
	protected $model;        
	/**
	* Create a new LDAP user provider.
	*
	* @param  array  $config
	* @return void
	*/
	public function __construct()
	{

		$this->config =  \App\Models\Configuration::first();
                if($this->config == null) 
                {
                    throw new Exception('No configuration row find on database!');
                }
                               
		// Connect to the domain controller
		if ( ! $this->conn = ldap_connect("ldap://{$this->config->LDAP_ServerName}",$this->config->LDAP_Port ))
		{
			throw new \Exception("Could not connect to LDAP host {$this->config->LDAP_ServerName}: ".ldap_error($this->conn));
		}

		// Required for Windows AD
		ldap_set_option($this->conn, LDAP_OPT_PROTOCOL_VERSION, 3);
		ldap_set_option($this->conn, LDAP_OPT_REFERRALS, 0);

		// Enable search of LDAP
		if ( ! @ldap_bind($this->conn, $this->config->LDAP_CNUsername, $this->config->LDAP_Password))
		{
                        throw new \Exception('Could not bind to AD: '."{$this->config->LDAP_CNUsername} : ".ldap_error($this->conn));
		}
	}

	/**
	 * Destroy LDAP user provider
	 */
	public function __destruct()
	{
		if ( ! is_null($this->conn))
		{
			ldap_unbind($this->conn);
		}
	}

	/**
	* Retrieve a user by their unique identifier.
	*
	* @param  mixed  $identifier
	* @return Illuminate\Auth\UserInterface|null
	*/
	public function retrieveByID($identifier)
	{
            $user = \App\Models\Users::find($identifier);
            if(empty($user)) return;
            
            //generic user for Auth:user()
            return new GenericUser(array(
               'id'         => $user->Users_id,
                'username'  => $user->Alias,
                'CN'        => $user->CN,
                'realname' => $user->FistName.' '.$user->LastName,
                'profile' => $user->Profiles_id,
                'entity' => \App\Models\Entities::find($user->Entities_id)->Name
                     
             ));
	}

	/**
	* Retrieve a user by the given credentials.
	*
	* @param  array  $credentials
	* @return Illuminate\Auth\UserInterface|null
	*/
	public function retrieveByCredentials(array $credentials)
	{
            //Search Alias in LDAP
            $result = ldap_search($this->conn, $this->config->LDAP_BaseDNUsers,
                    "({$this->config->LDAP_AttribDNAlias}={$credentials['Alias']})");
             
            if ($result === FALSE) return NULL;
            
            //Get first LDAP Entry
            $entries = ldap_get_entries($this->conn, $result);
            if ($entries['count'] == 0 || $entries['count'] > 1) return NULL;
            
            //Create or update user in database
            $this->updateUser($entries[0]);
                 
             //Return a GenericUser for validateCredentials method
            return new GenericUser(array(
               'id'         => $this->model->Users_id,
                'username'  => $this->model->Alias,
                'CN'        => $this->model->CN,
                'active'    => $this->model->IsActive
                     
             ));
                 
                
	}

	/**
	* Validate a user against the given credentials.
	*
	* @param  Illuminate\Auth\UserInterface  $user
	* @param  array  $credentials
	* @return bool
	*/    
	public function validateCredentials(UserInterface $user, array $credentials)
	{
		if($user == NULL) return FALSE;
		if($credentials['Password'] == '') return FALSE;
                if($user->active == 0) return FALSE;
                
                //try to connect
                $ldapconn = ldap_connect("ldap://{$this->config->LDAP_ServerName}");    
                $result = @ldap_bind($ldapconn, $user->CN, $credentials['Password']);
                ldap_unbind($ldapconn);
               
		return $result;
	}

	/**
	 * Add or update user in database and set $this->model
	 * @param  array  $entry 
	 * @return void        
	 */
        public function updateUser($entry)
        {
            $username = $entry[$this->config->LDAP_AttribDNAlias][0];
            //Date actuelle
            $dateTime = new \DateTime('now');
            
            //Check if exist in database
            $user = \App\Models\Users::where('Alias', '=', $username)->first();
            if(empty($user)) {
                $user = new \App\Models\Users();
                $user->CN =  $entry['dn'];
                $user->Alias = $username;
                $user->Email = $entry['mail'][0];
                $user->LastName = $entry['sn'][0];
                $user->FirstName = $entry['givenname'][0];
                $user->Title = $entry['title'][0];
                $user->Company = $entry['company'][0];
                $user->Department = $entry['department'][0];
                $user->PhoneNumber1 = $entry['telephonenumber'][0];
                $user->PhoneNumber2 = $entry['facsimiletelephonenumber'][0];

                //Profile par défaut
                $profile_id = \App\Models\Profiles::where('Code', '=', 'READONLY_PROFILE')->first()->Profiles_id;
                
                //Création de l'entité si inexistante
                $entity_id = 1;
                $entity = \App\Models\Entities::where('Name', '=', $user->Company)->first();
                if(empty($entity))
                {
                    $entity = new \App\Models\Entities();
                    $entity->Name = $user->Company;
                    $entity->IsDeleted =0;
                    $entity->IsActive =1;
                    $entity->IsPublic =1;
                    $entity->DateCreated = $dateTime->format('Y-m-d H:i:s');
                    $entity->Users_id_created = 1;
                    
                    $entity->save_wc();
                }
                $entity_id = $entity->Entities_id;
                
                $user->Profiles_id = $profile_id;
                $user->Entities_id = $entity_id;
                $user->IsDeleted = 0;
                $user->IsActive = 1;
                $user->IsPublic = 1;
                $user->DateCreated = $dateTime->format('Y-m-d H:i:s');
                $user->Users_id_created = 1;
                $user->save_wc();
           }
           else
           {
               $user->DateUpdated = $dateTime->format('Y-m-d H:i:s');
               $user->Users_id_updated = 1;
               $user->save_wc();
           }
           
           $this->model =  $user;
        }
	/**
	 * Checks group membership of the user, searching
	 * in the specified group and its children (recursively)
	 */
	protected function checkGroup($userdn, $groupdn) 
	{	
		$members = $this->getMembers($userdn);

		if ($members == NULL) 
			return FALSE;

		for ($i = 0; $i < $members['count']; $i++) 
		{
			if ($groupdn == $members[$i])
				return TRUE;
			elseif ($this->checkGroup($members[$i], $groupdn)) 
				return TRUE; 
		}

		return FALSE;
	}

	protected function getMembers($dn)
	{
		$result = @ldap_read($this->conn, $dn, '(objectclass=*)');
		if ($result === FALSE)
			return NULL;

		$entries = ldap_get_entries($this->conn, $result);
		if ($entries['count'] == 0)
			return NULL;

		return !empty($entries[0]['memberof']) ? $entries[0]['memberof'] : NULL;
	}

}