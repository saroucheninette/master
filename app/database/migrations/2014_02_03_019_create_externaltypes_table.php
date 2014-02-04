<?php

use Illuminate\Database\Migrations\Migration;

class CreateExternaltypesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ExternalTypes', function($table) {
            //$table->increments('id');
            $table->string('ExternalTypes_id', 10)->primary();
            $table->string('Label', 255);
            $table->longtext('DescriptionText')->nullable();
            $table->integer('IsDeleted');
            $table->integer('IsActive');
            $table->integer('IsPublic');
            $table->integer('Users_id_created');
            $table->integer('Users_id_updated');
            $table->dateTime('DateCreated');
            $table->dateTime('DateUpdated')->nullable();
        });
        Schema::table('ExternalTypes', function($table)
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
        Schema::drop('ExternalTypes');
    }

}