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
                       
            return new GenericUser(array(
               'id'         => $user->Users_id,
                'username'  => $user->Alias,
                'CN'        => $user->CN,
                'realname' => $user->FistName.' '.$user->LastName,
                'profile' => $user->Profiles_id
                     
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
            //DATAS
             $data = array(
                    'CN' => $entry['dn'],
                    'Alias' => $username,
                    'Email' => $entry['mail'][0],
                    'LastName' => $entry['sn'][0],
                    'FirstName' => $entry['givenname'][0],
                    'Title' => $entry['title'][0],
                    'Company' => $entry['company'][0],
                    'Department' => $entry['department'][0],
                    'PhoneNumber1' => $entry['telephonenumber'][0],
                    'PhoneNumber2' => $entry['facsimiletelephonenumber'][0]
                );
            
            //Check if exist in database
            $user = \App\Models\Users::where('Alias', '=', $username)->first();
            if(empty($user)) {
                //Profile par défaut
                $profile_id = \App\Models\Profiles::where('Code', '=', 'READONLY_PROFILE')->first()->Profiles_id;
                $user = new \App\Models\Users();
                $data['Profiles_id'] = $profile_id;
                $data['IsDeleted'] = 0;
                $data['IsActive'] = 1;
                $data['IsPublic'] = 1;
                $data['DateCreated'] = $dateTime->format('Y-m-d H:i:s');
                $data['Users_id_created'] = 1;
                $user = $user->create($data);
           }
           else
           {
               $data['DateUpdated'] = $dateTime->format('Y-m-d H:i:s');
               $data['Users_id_updated'] = 1;
               $user->update($data);
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