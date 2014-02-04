<?php

use Illuminate\Database\Migrations\Migration;

class CreateDocumentticketsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DocumentTickets', function($table) {
            //$table->increments('id');
            $table->integer('Documents_id')->index();
            $table->integer('Tickets_id')->index();
            $table->integer('IsDeleted');
            $table->integer('IsActive');
            $table->integer('IsPublic');
            $table->integer('Users_id_created')->index();
            $table->integer('Users_id_updated')->index();
            $table->dateTime('DateCreated');
            $table->dateTime('DateUpdated')->nullable();
        });
        Schema::table('DocumentTickets', function($table)
        {
           $table->foreign('Users_id_created')
                 ->references('Users_id')->on('users');
           $table->foreign('Users_id_updated')
                 ->references('Users_id')->on('users');
           $table->foreign('Documents_id')
                   ->references('Documents_id')->on('Documents');
           $table->foreign('Tickets_id')
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
        Schema::drop('DocumentTickets');
    }

}