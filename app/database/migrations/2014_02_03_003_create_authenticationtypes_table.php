<?php

use Illuminate\Database\Migrations\Migration;

class CreateAuthenticationtypesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('AuthenticationTypes', function($table) {
            $table->string('AuthenticationTypes_id', 5)->primary();
            $table->string('Label', 255);
            $table->longtext('DescriptionText')->nullable();
            $table->integer('IsDeleted');
            $table->integer('IsActive');
            $table->integer('IsPublic');
            $table->integer('Users_id_created')->index();
            $table->integer('Users_id_updated')->index()->nullable();
            $table->dateTime('DateCreated');
            $table->dateTime('DateUpdated')->nullable();
        });
        Schema::table('AuthenticationTypes', function($table)
        {
           $table->foreign('Users_id_created')
                 ->references('Users_id')->on('Users');
           $table->foreign('Users_id_updated')
                 ->references('Users_id')->on('Users');
        });
        
        $dateTime = new DateTime('now');
         DB::table('AuthenticationTypes')->insert(
                array(
                    'AuthenticationTypes_id' => 'DBA',
                    'Label' => 'Database',
                    'DescriptionText' => 'Simple authentication',
                    'IsDeleted'=>0,
                    'IsActive'=>1,
                    'IsPublic'=>1,
                    'Users_id_created' => 1, //admin
                    'DateCreated'=> $dateTime->format('Y-m-d H:i:s')
         ));
         DB::table('AuthenticationTypes')->insert(
                array(
                    'AuthenticationTypes_id' => 'LDAP',
                    'Label' => 'LDAP',
                    'DescriptionText' => 'LDAP authentication',
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
        Schema::drop('AuthenticationTypes');
    }

}