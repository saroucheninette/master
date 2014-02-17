<?php

use Illuminate\Database\Migrations\Migration;

class CreateHosttypesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HostTypes', function($table) {
            //$table->increments('id');
            $table->string('HostTypes_id', 3)->primary();
            $table->string('Name', 255);
            $table->longtext('DescriptionText')->nullable();
            $table->integer('IsDeleted');
            $table->integer('IsActive');
            $table->integer('IsPublic');
            $table->integer('Users_id_created')->index();
            $table->integer('Users_id_updated')->index()->nullable();
            $table->dateTime('DateCreated');
            $table->dateTime('DateUpdated')->nullable();
        });
        Schema::table('HostTypes', function($table)
        {
           $table->foreign('Users_id_created')
                 ->references('Users_id')->on('users');
           $table->foreign('Users_id_updated')
                 ->references('Users_id')->on('users');
        });
         $dateTime = new DateTime('now');
        DB::table('HostTypes')->insert(
                array(
                    'HostTypes_id' => 'SER',
                    'Name'=> 'Server',
                    'DescriptionText' => 'Server',
                    'IsDeleted'=>0,
                    'IsActive'=>1,
                    'IsPublic'=>1,
                    'Users_id_created'=>1,
                    'DateCreated'=> $dateTime->format('Y-m-d H:i:s')
                ));
        DB::table('HostTypes')->insert(
                array(
                    'HostTypes_id' => 'DES',
                    'Name'=> 'Desktop',
                    'DescriptionText' => 'Desktop',
                    'IsDeleted'=>0,
                    'IsActive'=>1,
                    'IsPublic'=>1,
                    'Users_id_created'=>1,
                    'DateCreated'=> $dateTime->format('Y-m-d H:i:s')
                ));
        DB::table('HostTypes')->insert(
                array(
                    'HostTypes_id' => 'LAP',
                    'Name'=> 'Laptop',
                    'DescriptionText' => 'Laptop',
                    'IsDeleted'=>0,
                    'IsActive'=>1,
                    'IsPublic'=>1,
                    'Users_id_created'=>1,
                    'DateCreated'=> $dateTime->format('Y-m-d H:i:s')
                ));
        DB::table('HostTypes')->insert(
                array(
                    'HostTypes_id' => 'SEV',
                    'Name'=> 'Virtual server',
                    'DescriptionText' => 'Virtual server',
                    'IsDeleted'=>0,
                    'IsActive'=>1,
                    'IsPublic'=>1,
                    'Users_id_created'=>1,
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
        Schema::drop('HostTypes');
    }

}