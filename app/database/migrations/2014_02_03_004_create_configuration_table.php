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
            $table->integer('Users_id_updated')->index();
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