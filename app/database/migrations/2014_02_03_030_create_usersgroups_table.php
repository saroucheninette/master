<?php

use Illuminate\Database\Migrations\Migration;

class CreateUsersgroupsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('UsersGroups', function($table) {
            //$table->increments('id');
            $table->integer('Users_id')->index();
            $table->integer('Groups_id')->index();
            $table->integer('IsDeleted');
            $table->integer('IsActive');
            $table->integer('IsPublic');
            $table->integer('Users_id_created')->index();
            $table->integer('Users_id_updated')->index();
            $table->dateTime('DateCreated');
            $table->dateTime('DateUpdated')->nullable();
        });
        Schema::table('UsersGroups', function($table)
        {
           $table->foreign('Users_id_created')
                 ->references('Users_id')->on('users');
           $table->foreign('Users_id_updated')
                 ->references('Users_id')->on('users');
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
        Schema::drop('UsersGroups');
    }

}