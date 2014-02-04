<?php

use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Groups', function($table) {
            $table->increments('Groups_id');
            $table->integer('Profiles_id')->index();
            $table->string('Name', 100);
            $table->string('DescriptionText', 500)->nullable();
            $table->string('Email', 500);
            $table->longtext('CN')->nullable();
            $table->integer('IsDeleted');
            $table->integer('IsActive');
            $table->integer('IsPublic');
            $table->integer('Users_id_created')->index();
            $table->integer('Users_id_updated')->index();
            $table->dateTime('DateCreated');
            $table->dateTime('DateUpdated')->nullable();
        });
        Schema::table('Groups', function($table)
        {
           $table->foreign('Users_id_created')
                 ->references('Users_id')->on('users');
           $table->foreign('Users_id_updated')
                 ->references('Users_id')->on('users');
           $table->foreign('Profiles_id')
                   ->references('Profiles_id')->on('Profiles');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Groups');
    }

}