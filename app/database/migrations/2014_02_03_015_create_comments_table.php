<?php

use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Comments', function($table) {
            $table->increments('Comments_id');
            $table->integer('Tickets_id')->index();
            $table->longtext('DescriptionText')->nullable();
            $table->longtext('DescriptionHtml')->nullable();
            $table->integer('IsDeleted');
            $table->integer('IsActive');
            $table->integer('IsPublic');
            $table->integer('Users_id_created')->index();
            $table->integer('Users_id_updated')->index();
            $table->dateTime('DateCreated');
            $table->dateTime('DateUpdated')->nullable();
        });
        Schema::table('Comments', function($table)
        {
           $table->foreign('Users_id_created')
                 ->references('Users_id')->on('Users');
           $table->foreign('Users_id_updated')
                 ->references('Users_id')->on('Users');
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
        Schema::drop('Comments');
    }

}