<?php

use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Users', function($table) {
            $table->increments('Users_id')->index();
            $table->integer('Profiles_id')->index();
            $table->string('Alias', 50);
            $table->string('Email', 500);
            $table->string('Password', 100)->nullable();
            $table->string('Gender', 1)->nullable();
            $table->string('LastName', 255);
            $table->string('FirstName', 255);
            $table->string('Title', 500)->nullable();
            $table->string('Company', 255)->nullable();
            $table->string('Department', 500)->nullable();
            $table->string('PhoneNumber1', 50)->nullable();
            $table->string('PhoneNumber2', 50)->nullable();
            $table->string('CN',500)->nullable();
            $table->dateTime('DateLastLogOn')->nullable();
            $table->dateTime('DateLastLogOff')->nullable();
            $table->integer('IsDeleted');
            $table->integer('IsActive');
            $table->integer('IsPublic');
            $table->integer('Users_id_created')->index()->nullable();
            $table->integer('Users_id_updated')->index()->nullable();
            $table->dateTime('DateCreated');
            $table->dateTime('DateUpdated')->nullable();
            
        });
        Schema::table('Users', function($table)
        {
           $table->foreign('Users_id_created')
                 ->references('Users_id')->on('Users');
           $table->foreign('Users_id_updated')
                 ->references('Users_id')->on('Users');
           $table->foreign('Profiles_id')
                   ->references('Profiles_id')->on('Profiles');

        });
        
         $dateTime = new DateTime('now');
        DB::table('Users')->insert(
                array(
                    'Profiles_id' => 1, //Administrator
                    'Alias' => 'system',
                    'Email' => 'system',
                    'Password' => Hash::make('system'),
                    'LastName' => 'System',
                    'FirstName' => 'System',
                    'IsDeleted' => 0,
                    'IsActive' => 1,
                    'IsPublic' => 1,
                    'DateCreated'=> $dateTime->format('Y-m-d H:i:s')
                    
                ));
        DB::table('Users')->insert(
                array(
                    'Profiles_id' => 1, //Administrator
                    'Alias' => 'admin',
                    'Email' => 'admin@changethismail.fr',
                    'Password' => Hash::make('admin'),
                    'LastName' => 'Admin',
                    'FirstName' => 'Admin',
                    'IsDeleted' => 0,
                    'IsActive' => 1,
                    'IsPublic' => 1,
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
        Schema::drop('Users');
    }

}