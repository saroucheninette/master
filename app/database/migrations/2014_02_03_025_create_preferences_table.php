<?php

use Illuminate\Database\Migrations\Migration;

class CreatePreferencesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Preferences', function($table) {
            $table->increments('Preferences_id');
            $table->integer('Users_id')->nullable();
            $table->integer('Groups_id')->nullable();
            $table->string('Name', 100);
            $table->string('DescriptionText', 500)->nullable();
            $table->integer('IsDeleted');
            $table->integer('IsActive');
            $table->integer('IsPublic');
            $table->integer('Users_id_created')->index();
            $table->integer('Users_id_updated')->index();
            $table->dateTime('DateCreated');
            $table->dateTime('DateUpdated')->nullable();
        });
        Schema::table('Preferences', function($table)
        {
           $table->foreign('Users_id_created')
                 ->references('Users_id')->on('users');
           $table->foreign('Users_id_updated')
                 ->references('Users_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Preferences');
    }

}