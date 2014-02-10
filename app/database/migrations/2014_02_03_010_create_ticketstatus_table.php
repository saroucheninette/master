<?php

use Illuminate\Database\Migrations\Migration;

class CreateTicketstatusTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TicketStatus', function($table) {
            //$table->increments('id');
            $table->string('Status_id', 3)->primary();
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
        Schema::table('TicketStatus', function($table)
        {
           $table->foreign('Users_id_created')
                 ->references('Users_id')->on('Users');
           $table->foreign('Users_id_updated')
                 ->references('Users_id')->on('Users');
        });
        $dateTime = new DateTime('now');
        DB::table('TicketStatus')->insert(
                array(
                    'Status_id' => 'NEW',
                    'Label'=> 'New',
                    'DescriptionText' => 'New ticket',
                    'IsDeleted'=>0,
                    'IsActive'=>1,
                    'IsPublic'=>1,
                    'Users_id_created'=>1,
                    'DateCreated'=> $dateTime->format('Y-m-d H:i:s')
                ));
        DB::table('TicketStatus')->insert(
                array(
                    'Status_id' => 'PRO',
                    'Label'=> 'In progress',
                    'DescriptionText' => 'In progress',
                    'IsDeleted'=>0,
                    'IsActive'=>1,
                    'IsPublic'=>1,
                    'Users_id_created'=>1,
                    'DateCreated'=> $dateTime->format('Y-m-d H:i:s')
                ));
        DB::table('TicketStatus')->insert(
                array(
                    'Status_id' => 'ASS',
                    'Label'=> 'Assignated',
                    'DescriptionText' => 'Assignated',
                    'IsDeleted'=>0,
                    'IsActive'=>1,
                    'IsPublic'=>1,
                    'Users_id_created'=>1,
                    'DateCreated'=> $dateTime->format('Y-m-d H:i:s')
                ));
        DB::table('TicketStatus')->insert(
                array(
                    'Status_id' => 'WAI',
                    'Label'=> 'Pending',
                    'DescriptionText' => 'Pending',
                    'IsDeleted'=>0,
                    'IsActive'=>1,
                    'IsPublic'=>1,
                    'Users_id_created'=>1,
                    'DateCreated'=> $dateTime->format('Y-m-d H:i:s')
                ));
        DB::table('TicketStatus')->insert(
                array(
                    'Status_id' => 'CLO',
                    'Label'=> 'Closed',
                    'DescriptionText' => 'Closed',
                    'IsDeleted'=>0,
                    'IsActive'=>1,
                    'IsPublic'=>1,
                    'Users_id_created'=>1,
                    'DateCreated'=> $dateTime->format('Y-m-d H:i:s')
                ));
        DB::table('TicketStatus')->insert(
                array(
                    'Status_id' => 'RES',
                    'Label'=> 'Resolved',
                    'DescriptionText' => 'Resolved',
                    'IsDeleted'=>0,
                    'IsActive'=>1,
                    'IsPublic'=>1,
                    'Users_id_created'=>1,
                    'DateCreated'=> $dateTime->format('Y-m-d H:i:s')
                ));
        DB::table('TicketStatus')->insert(
                array(
                    'Status_id' => 'URE',
                    'Label'=> 'Unsolved',
                    'DescriptionText' => 'Unsolved',
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
        Schema::drop('TicketStatus');
    }

}