<?php

use Illuminate\Database\Migrations\Migration;

class CreateTicketcategoriesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TicketCategories', function($table) {
            //$table->increments('id');
            $table->string('Categories_id', 3)->primary();
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
        Schema::table('TicketCategories', function($table)
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
        Schema::drop('TicketCategories');
    }

}