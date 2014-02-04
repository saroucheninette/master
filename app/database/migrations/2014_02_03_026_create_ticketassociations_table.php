<?php

use Illuminate\Database\Migrations\Migration;

class CreateTicketassociationsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TicketAssociations', function($table) {
            //$table->increments('id');
            $table->integer('Tickets_parent_id')->index();
            $table->integer('Tickets_child_id')->index();
            $table->integer('IsDeleted');
            $table->integer('IsActive');
            $table->integer('IsPublic');
            $table->integer('Users_id_created')->index();
            $table->integer('Users_id_updated')->index();
            $table->dateTime('DateCreated');
            $table->dateTime('DateUpdated')->nullable();
        });
        Schema::table('TicketAssociations', function($table)
        {
           $table->foreign('Users_id_created')
                 ->references('Users_id')->on('users');
           $table->foreign('Users_id_updated')
                 ->references('Users_id')->on('users');
           $table->foreign('Tickets_parent_id')
                   ->references('Tickets_id')->on('Tickets');
            $table->foreign('Tickets_child_id')
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
        Schema::drop('TicketAssociations');
    }

}