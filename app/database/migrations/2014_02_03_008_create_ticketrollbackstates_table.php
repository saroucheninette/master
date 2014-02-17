<?php

use Illuminate\Database\Migrations\Migration;

class CreateTicketrollbackstatesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TicketRollbackstates', function($table) {
            //$table->increments('id');
            $table->string('RollbackStates_id', 3)->primary();
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
        Schema::table('TicketRollbackstates', function($table)
        {
           $table->foreign('Users_id_created')
                 ->references('Users_id')->on('Users');
           $table->foreign('Users_id_updated')
                 ->references('Users_id')->on('Users');
        });
        $dateTime = new DateTime('now');
        DB::table('TicketRollbackstates')->insert(
                array(
                    'RollbackStates_id' => 'PLN',
                    'Name'=> 'Planned',
                    'DescriptionText' => 'Planned',
                    'IsDeleted'=>0,
                    'IsActive'=>1,
                    'IsPublic'=>1,
                    'Users_id_created'=>1,
                    'DateCreated'=> $dateTime->format('Y-m-d H:i:s')
                ));
        DB::table('TicketRollbackstates')->insert(
                array(
                    'RollbackStates_id' => 'NPL',
                    'Name'=> 'Non planned',
                    'DescriptionText' => 'Non planned',
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
        Schema::drop('TicketRollbackstates');
    }

}