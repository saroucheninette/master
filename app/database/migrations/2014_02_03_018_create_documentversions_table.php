<?php

use Illuminate\Database\Migrations\Migration;

class CreateDocumentversionsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DocumentVersions', function($table) {
            $table->increments('DocumentVersions_id');
            $table->integer('Documents_id')->index();
            $table->longtext('DownloadUrl');
            $table->longtext('RealPath');
            $table->string('FileName', 500);
            $table->string('MimeType', 100);
            $table->integer('FileSize');
            $table->string('VersionNumber', 10);
            $table->dateTime('DateVersion');
            $table->longtext('VersionHistory')->nullable();
            $table->integer('IsDeleted');
            $table->integer('IsActive');
            $table->integer('IsPublic');
            $table->integer('Users_id_created')->index();
            $table->integer('Users_id_updated')->index();
            $table->dateTime('DateCreated');
            $table->dateTime('DateUpdated')->nullable();
        });
        Schema::table('DocumentVersions', function($table)
        {
           $table->foreign('Users_id_created')
                 ->references('Users_id')->on('users');
           $table->foreign('Users_id_updated')
                 ->references('Users_id')->on('users');
           $table->foreign('Documents_id')
                   ->references('Documents_id')->on('Documents');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('DocumentVersions');
    }

}