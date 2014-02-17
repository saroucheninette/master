<?php

use Illuminate\Database\Migrations\Migration;

class CreateTicketimpactsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TicketImpacts', function($table) {
            //$table->increments('id');
            $table->string('Impacts_id', 3)->primary();
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
        Schema::table('TicketImpacts', function($table)
        {
           $table->foreign('Users_id_created')
                 ->references('Users_id')->on('Users');
           $table->foreign('Users_id_updated')
                 ->references('Users_id')->on('Users');
        });
         $dateTime = new DateTime('now');
        DB::table('TicketImpacts')->insert(
                array(
                    'Impacts_id' => 'LOW',
                    'Name'=> 'Low',
                    'DescriptionText' => 'Low impact',
                    'IsDeleted'=>0,
                    'IsActive'=>1,
                    'IsPublic'=>1,
                    'Users_id_created'=>1,
                    'DateCreated'=> $dateTime->format('Y-m-d H:i:s')
                ));
        DB::table('TicketImpacts')->insert(
                array(
                    'Impacts_id' => 'MED',
                    'Name'=> 'Medium',
                    'DescriptionText' => 'Medium impact',
                    'IsDeleted'=>0,
                    'IsActive'=>1,
                    'IsPublic'=>1,
                    'Users_id_created'=>1,
                    'DateCreated'=> $dateTime->format('Y-m-d H:i:s')
                ));
        DB::table('TicketImpacts')->insert(
                array(
                    'Impacts_id' => 'HIG',
                    'Name'=> 'High',
                    'DescriptionText' => 'High impact',
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
        Schema::drop('TicketImpacts');
    }

}