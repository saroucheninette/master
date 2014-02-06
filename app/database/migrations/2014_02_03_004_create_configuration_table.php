<?php

use Illuminate\Database\Migrations\Migration;

class CreateConfigurationTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Configuration', function($table) {
            //$table->increments('id');
            $table->string('AuthenticationTypes_id', 5)->primary();
            $table->string('LDAP_ServerName', 500)->nullable();
            $table->integer('LDAP_Port')->nullable();
            $table->string('LDAP_Domain', 100)->nullable();
            $table->longtext('LDAP_BaseDNUsers')->nullable();
            $table->longtext('LDAP_BaseDNGroups')->nullable();
            $table->string('LDAP_AttribDNUniqueName', 255)->nullable();
            $table->string('LDAP_AttribDNUserClass', 255)->nullable();
            $table->string('LDAP_AttribDNGroupClass', 255)->nullable();
            $table->string('LDAP_AttribDNAlias', 255)->nullable();
            $table->string('LDAP_AttribDNName', 255)->nullable();
            $table->string('LDAP_AttribDNEmail', 255)->nullable();
            $table->string('LDAP_AttribDNGroupMember', 255)->nullable();
            $table->string('LDAP_CNUsername', 255)->nullable();
            $table->string('LDAP_Password', 255)->nullable();
            $table->integer('IsDeleted');
            $table->integer('IsActive');
            $table->integer('IsPublic');
            $table->integer('Users_id_created')->index();
            $table->integer('Users_id_updated')->index()->nullable();
            $table->dateTime('DateCreated');
            $table->dateTime('DateUpdated')->nullable();
        });
        Schema::table('Configuration', function($table)
        {
           $table->foreign('Users_id_created')
                 ->references('Users_id')->on('Users');
           $table->foreign('Users_id_updated')
                 ->references('Users_id')->on('Users');
           $table->foreign('AuthenticationTypes_id')
                   ->references('AuthenticationTypes_id')->on('AuthenticationTypes');

        });
        
         $dateTime = new DateTime('now');
         DB::table('Configuration')->insert(
                array(
                    'AuthenticationTypes_id' => 'LDAP',
                    'LDAP_ServerName' => '10.90.64.105',
                    'LDAP_Port' => 389,
                    'LDAP_Domain' => 'euro.transat.local',
                    'LDAP_BaseDNUsers' => 'OU=Utilisateurs,OU=France,DC=euro,DC=transat,DC=local',
                    'LDAP_BaseDNGroups' => 'OU=Groupes%20de%20distribution,OU=Groupes,OU=France,DC=euro,DC=transat,DC=local',
                    'LDAP_AttribDNUniqueName' => 'distinguishedName',
                    'LDAP_AttribDNUserClass' => 'person',
                    'LDAP_AttribDNGroupClass' => 'group',
                    'LDAP_AttribDNAlias' => 'samaccountname',
                    'LDAP_AttribDNName' => 'cn',
                    'LDAP_AttribDNEmail' => 'mail',
                    'LDAP_AttribDNGroupMember' => 'memberOf',
                   // 'LDAP_CNUsername' => 'CN=LookAnnu,CN=Users,DC=euro,DC=transat,DC=local',
                    'LDAP_CNUsername' => 'LookAnnu',
                    'LDAP_Password' => 'Look123',
                    'IsDeleted'=>0,
                    'IsActive'=>1,
                    'IsPublic'=>1,
                    'Users_id_created' => 1, //admin
                    'DateCreated'=> $dateTime->format('Y-m-d H:i:s')
         ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Configuration');
    }

}