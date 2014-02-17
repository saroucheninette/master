<?php

use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Documents', function($table) {
            $table->increments('Documents_id');
            $table->integer('Entities_id')->index();
            $table->string('Name', 100);
            $table->longtext('DescriptionText');
            $table->longtext('DescriptionHtml');
            $table->integer('IsDeleted');
            $table->integer('IsActive');
            $table->integer('IsPublic');
            $table->integer('Users_id_created')->index();
            $table->integer('Users_id_updated')->index();
            $table->dateTime('DateCreated');
            $table->dateTime('DateUpdated')->nullable();
        });
        Schema::table('Documents', function($table)
        {
           $table->foreign('Users_id_created')
                 ->references('Users_id')->on('users');
           $table->foreign('Users_id_updated')
                 ->references('Users_id')->on('users');
           $table->foreign('Entities_id')
                    ->references('Entities_id')->on('Entities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Documents');
    }

}