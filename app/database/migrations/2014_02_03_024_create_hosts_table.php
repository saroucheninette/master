<?php

use Illuminate\Database\Migrations\Migration;

class CreateHostsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Hosts', function($table) {
            $table->increments('Hosts_id');
            $table->string('HostName', 100);
            $table->string('IPAddress', 100);
            $table->longtext('DescriptionText')->nullable();
            $table->string('HostTypes_id', 3)->index();
            $table->string('HostCategories_id', 5)->index();
            $table->string('HostModel', 500)->nullable();
            $table->string('HostOS', 500)->nullable();
            $table->integer('IsDeleted');
            $table->integer('IsActive');
            $table->integer('IsPublic');
            $table->integer('Users_id_created')->index();
            $table->integer('Users_id_updated')->index();
            $table->dateTime('DateCreated');
            $table->dateTime('DateUpdated')->nullable();
        });
         Schema::table('Hosts', function($table)
        {
           $table->foreign('Users_id_created')
                 ->references('Users_id')->on('users');
           $table->foreign('Users_id_updated')
                 ->references('Users_id')->on('users');
           $table->foreign('HostTypes_id')
                   ->references('HostTypes_id')->on('HostTypes');
           $table->foreign('HostCategories_id')
                    ->references('HostCategories_id')->on('HostCategories');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Hosts');
    }

}