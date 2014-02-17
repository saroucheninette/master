<?php

use Illuminate\Database\Migrations\Migration;

class CreateTicketenvironmentsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TicketEnvironments', function($table) {
            $table->increments('Environments_id');
            $table->integer('Environments_parent_id')->nullable();
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
        Schema::table('TicketEnvironments', function($table)
        {
           $table->foreign('Users_id_created')
                 ->references('Users_id')->on('Users');
           $table->foreign('Users_id_updated')
                 ->references('Users_id')->on('Users');
        });
        $dateTime = new DateTime('now');
        DB::table('TicketEnvironments')->insert(
                array(
                    'Name'=> 'Demat',
                    'DescriptionText' => 'Demat',
                    'IsDeleted'=>0,
                    'IsActive'=>1,
                    'IsPublic'=>1,
                    'Users_id_created'=>1,
                    'DateCreated'=> $dateTime->format('Y-m-d H:i:s')
                ));
        DB::table('TicketEnvironments')->insert(
                array(
                    'Name'=> 'Logitours',
                    'DescriptionText' => 'Logitours',
                    'IsDeleted'=>0,
                    'IsActive'=>1,
                    'IsPublic'=>1,
                    'Users_id_created'=>1,
                    'DateCreated'=> $dateTime->format('Y-m-d H:i:s')
                ));
        DB::table('TicketEnvironments')->insert(
                array(
                    'Name'=> 'TravelBox',
                    'DescriptionText' => 'TravelBox',
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
        Schema::drop('TicketEnvironments');
    }

}