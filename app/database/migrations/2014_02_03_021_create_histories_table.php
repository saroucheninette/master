<?php

use Illuminate\Database\Migrations\Migration;

class CreateHistoriesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Histories', function($table) {
            $table->increments('Histories_id');
            $table->integer('External_id');
            $table->string('ExternalTypes_id', 10)->index();
            $table->string('Field', 500)->nullable();
            $table->string('Actions', 500)->nullable();
            $table->longtext('Old_value')->nullable();
            $table->longtext('New_value')->nullable();
            $table->longtext('HistoryText');
            $table->integer('IsDeleted');
            $table->integer('IsActive');
            $table->integer('IsPublic');
            $table->integer('Users_id_created')->index();
            $table->integer('Users_id_updated')->index();
            $table->dateTime('DateCreated');
            $table->dateTime('DateUpdated')->nullable();
        });
        Schema::table('Histories', function($table)
        {
           $table->foreign('Users_id_created')
                 ->references('Users_id')->on('users');
           $table->foreign('Users_id_updated')
                 ->references('Users_id')->on('users');
           $table->foreign('ExternalTypes_id')
                   ->references('ExternalTypes_id')->on('ExternalTypes');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Histories');
    }

}