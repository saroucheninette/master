<?php

use Illuminate\Database\Migrations\Migration;

class CreateTicketprioritiesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TicketPriorities', function($table) {
            //$table->increments('id');
            $table->string('Priorities_id', 3)->primary();
            $table->string('Label', 255);
            $table->longtext('DescriptionText')->nullable();
            $table->integer('IsDeleted');
            $table->integer('IsActive');
            $table->integer('IsPublic');
            $table->integer('Users_id_created')->index();
            $table->integer('Users_id_updated')->index();
            $table->dateTime('DateCreated');
            $table->dateTime('DateUpdated')->nullable();
        });
        Schema::table('TicketPriorities', function($table)
        {
           $table->foreign('Users_id_created')
                 ->references('Users_id')->on('Users');
           $table->foreign('Users_id_updated')
                 ->references('Users_id')->on('Users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('TicketPriorities');
    }

}