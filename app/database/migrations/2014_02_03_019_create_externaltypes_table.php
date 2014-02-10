<?php

use Illuminate\Database\Migrations\Migration;

class CreateExternaltypesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ExternalTypes', function($table) {
            //$table->increments('id');
            $table->string('ExternalTypes_id', 10)->primary();
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
        Schema::table('ExternalTypes', function($table)
        {
           $table->foreign('Users_id_created')
                 ->references('Users_id')->on('users');
           $table->foreign('Users_id_updated')
                 ->references('Users_id')->on('users');
        });
        $dateTime = new DateTime('now');
        DB::table('ExternalTypes')->insert(
                array(
                    'ExternalTypes_id' => 'PROFILE',
                    'Label'=> 'Profiles',
                    'DescriptionText' => 'Profiles',
                    'IsDeleted'=>0,
                    'IsActive'=>1,
                    'IsPublic'=>1,
                    'Users_id_created'=>1,
                    'DateCreated'=> $dateTime->format('Y-m-d H:i:s')
                ));
         DB::table('ExternalTypes')->insert(
                array(
                    'ExternalTypes_id' => 'USER',
                    'Label'=> 'Users',
                    'DescriptionText' => 'Users',
                    'IsDeleted'=>0,
                    'IsActive'=>1,
                    'IsPublic'=>1,
                    'Users_id_created'=>1,
                    'DateCreated'=> $dateTime->format('Y-m-d H:i:s')
                ));
          DB::table('ExternalTypes')->insert(
                array(
                    'ExternalTypes_id' => 'CONFIG',
                    'Label'=> 'Configuration',
                    'DescriptionText' => 'Configuration',
                    'IsDeleted'=>0,
                    'IsActive'=>1,
                    'IsPublic'=>1,
                    'Users_id_created'=>1,
                    'DateCreated'=> $dateTime->format('Y-m-d H:i:s')
                ));
          DB::table('ExternalTypes')->insert(
                array(
                    'ExternalTypes_id' => 'CATEGORY',
                    'Label'=> 'Categories',
                    'DescriptionText' => 'Categories',
                    'IsDeleted'=>0,
                    'IsActive'=>1,
                    'IsPublic'=>1,
                    'Users_id_created'=>1,
                    'DateCreated'=> $dateTime->format('Y-m-d H:i:s')
                ));
           DB::table('ExternalTypes')->insert(
                array(
                    'ExternalTypes_id' => 'PRIORITY',
                    'Label'=> 'Priorities',
                    'DescriptionText' => 'Priorities',
                    'IsDeleted'=>0,
                    'IsActive'=>1,
                    'IsPublic'=>1,
                    'Users_id_created'=>1,
                    'DateCreated'=> $dateTime->format('Y-m-d H:i:s')
                ));
           //TODO...
            DB::table('ExternalTypes')->insert(
                array(
                    'ExternalTypes_id' => 'TICKET',
                    'Label'=> 'Ticket',
                    'DescriptionText' => 'Ticket',
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
        Schema::drop('ExternalTypes');
    }

}