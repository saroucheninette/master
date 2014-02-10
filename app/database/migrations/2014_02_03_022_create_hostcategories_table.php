<?php

use Illuminate\Database\Migrations\Migration;

class CreateHostcategoriesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HostCategories', function($table) {
            //$table->increments('id');
            $table->string('HostCategories_id', 5)->primary();
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
        Schema::table('HostCategories', function($table)
        {
           $table->foreign('Users_id_created')
                 ->references('Users_id')->on('users');
           $table->foreign('Users_id_updated')
                 ->references('Users_id')->on('users');
        });
         $dateTime = new DateTime('now');
        DB::table('HostCategories')->insert(
                array(
                    'HostCategories_id' => 'PROD',
                    'Label'=> 'Production',
                    'DescriptionText' => 'Production',
                    'IsDeleted'=>0,
                    'IsActive'=>1,
                    'IsPublic'=>1,
                    'Users_id_created'=>1,
                    'DateCreated'=> $dateTime->format('Y-m-d H:i:s')
                ));
        DB::table('HostCategories')->insert(
                array(
                    'HostCategories_id' => 'PREP',
                    'Label'=> 'Pre-Production',
                    'DescriptionText' => 'Pre-Production',
                    'IsDeleted'=>0,
                    'IsActive'=>1,
                    'IsPublic'=>1,
                    'Users_id_created'=>1,
                    'DateCreated'=> $dateTime->format('Y-m-d H:i:s')
                ));
        DB::table('HostCategories')->insert(
                array(
                    'HostCategories_id' => 'DEV',
                    'Label'=> 'Development',
                    'DescriptionText' => 'Development',
                    'IsDeleted'=>0,
                    'IsActive'=>1,
                    'IsPublic'=>1,
                    'Users_id_created'=>1,
                    'DateCreated'=> $dateTime->format('Y-m-d H:i:s')
                ));
        DB::table('HostCategories')->insert(
                array(
                    'HostCategories_id' => 'UAT',
                    'Label'=> 'Evaluation',
                    'DescriptionText' => 'Evaluation',
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
        Schema::drop('HostCategories');
    }

}