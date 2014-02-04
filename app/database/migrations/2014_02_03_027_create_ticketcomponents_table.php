<?php

use Illuminate\Database\Migrations\Migration;

class CreateTicketcomponentsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TicketComponents', function($table) {
            //$table->increments('id');
            $table->integer('Tickets_id')->index();
            $table->integer('Hosts_id')->nullable()->index();
            $table->integer('Projects_id')->nullable()->index();
            $table->integer('IsDeleted');
            $table->integer('IsActive');
            $table->integer('IsPublic');
            $table->integer('Users_id_created')->index();
            $table->integer('Users_id_updated')->index();
            $table->dateTime('DateCreated');
            $table->dateTime('DateUpdated')->nullable();
        });
        Schema::table('TicketComponents', function($table)
        {
           $table->foreign('Users_id_created')
                 ->references('Users_id')->on('users');
           $table->foreign('Users_id_updated')
                 ->references('Users_id')->on('users');
           $table->foreign('Tickets_id')
                   ->references('Tickets_id')->on('Tickets');
           $table->foreign('Hosts_id')
                   ->references('Hosts_id')->on('Hosts');
            $table->foreign('Projects_id')
                    ->references('Tickets_id')->on('Tickets');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('TicketComponents');
    }

}