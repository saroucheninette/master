<?php

use Illuminate\Database\Migrations\Migration;

class CreateTicketusersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TicketUsers', function($table) {
            //$table->increments('id');
            $table->integer('Tickets_id')->index();
            $table->string('TicketUserTypes_id', 6)->index();
            $table->integer('Users_id')->nullable()->index();
            $table->integer('Groups_id')->nullable()->index();
            $table->integer('IsDeleted');
            $table->integer('IsActive');
            $table->integer('IsPublic');
            $table->integer('Users_id_created')->index();
            $table->integer('Users_id_updated')->index();
            $table->dateTime('DateCreated');
            $table->dateTime('DateUpdated')->nullable();
        });
        Schema::table('TicketUsers', function($table)
        {
           $table->foreign('Users_id_created')
                 ->references('Users_id')->on('users');
           $table->foreign('Users_id_updated')
                 ->references('Users_id')->on('users');
           $table->foreign('Tickets_id')
                   ->references('Tickets_id')->on('Tickets');
            $table->foreign('TicketUserTypes_id')
                    ->references('TicketUserTypes_id')->on('TicketUserTypes');
            $table->foreign('Users_id')
                    ->references('Users_id')->on('Users');
            $table->foreign('Groups_id')
                    ->references('Groups_id')->on('Groups');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('TicketUsers');
    }

}