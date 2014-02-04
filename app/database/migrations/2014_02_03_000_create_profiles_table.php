<?php

use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Profiles', function($table) {
            $table->increments('Profiles_id');
            $table->string('Name', 100);
            $table->string('DescriptionText', 500)->nullable();
            $table->integer('CanReadTickets');
            $table->integer('CanAddTickets');
            $table->integer('CanModifyTickets');
            $table->integer('CanDeleteTickets');
            $table->integer('CanReadDocuments');
            $table->integer('CanAddDocuments');
            $table->integer('CanModifyDocuments');
            $table->integer('CanDeleteDocuments');
            $table->integer('CanReadUsers');
            $table->integer('CanAddUsers');
            $table->integer('CanModifyUsers');
            $table->integer('CanDeleteUsers');
            $table->integer('CanReadProfiles');
            $table->integer('CanAddProfiles');
            $table->integer('CanModifyProfiles');
            $table->integer('CanDeleteProfiles');
            $table->integer('CanReadGroups');
            $table->integer('CanAddGroups');
            $table->integer('CanModifyGroups');
            $table->integer('CanDeleteGroups');
            $table->integer('CanReadHistories');
            $table->integer('CanAddHistories');
            $table->integer('CanModifyHistories');
            $table->integer('CanDeleteHistories');
            $table->integer('CanReadHosts');
            $table->integer('CanAddHosts');
            $table->integer('CanModifyHosts');
            $table->integer('CanDeleteHosts');
            $table->integer('CanReadComments');
            $table->integer('CanAddComments');
            $table->integer('CanModifyComments');
            $table->integer('CanDeleteComments');
            $table->integer('IsDeleted');
            $table->integer('IsActive');
            $table->integer('IsPublic');
            $table->integer('Users_id_created')->index()->nullable();
            $table->integer('Users_id_updated')->index()->nullable();
            $table->dateTime('DateCreated');
            $table->dateTime('DateUpdated')->nullable();
        });
        
        /*
        Schema::table('Profiles', function($table)
        {
           $table->foreign('Users_id_created')
                 ->references('Users_id')->on('users');
           $table->foreign('Users_id_updated')
                 ->references('Users_id')->on('users');
        });*/
        $dateTime = new DateTime('now');
        DB::table('Profiles')->insert(
                array(
                    'Name'=> 'Administrator',
                    'CanReadTickets'=>1,
                    'CanAddTickets'=>1,
                    'CanModifyTickets'=>1,
                    'CanDeleteTickets'=>1,
                    'CanReadDocuments'=>1,
                    'CanAddDocuments'=>1,
                    'CanModifyDocuments'=>1,
                    'CanDeleteDocuments'=>1,
                    'CanReadUsers'=>1,
                    'CanAddUsers'=>1,
                    'CanModifyUsers'=>1,
                    'CanDeleteUsers'=>1,
                    'CanReadProfiles'=>1,
                    'CanAddProfiles'=>1,
                    'CanModifyProfiles'=>1,
                    'CanDeleteProfiles'=>1,
                    'CanReadGroups'=>1,
                    'CanAddGroups'=>1,
                    'CanModifyGroups'=>1,
                    'CanDeleteGroups'=>1,
                    'CanReadHistories'=>1,
                    'CanAddHistories'=>1,
                    'CanModifyHistories'=>1,
                    'CanDeleteHistories'=>1,
                    'CanReadHosts'=>1,
                    'CanAddHosts'=>1,
                    'CanModifyHosts'=>1,
                    'CanDeleteHosts'=>1,
                    'CanReadComments'=>1,
                    'CanAddComments'=>1,
                    'CanModifyComments'=>1,
                    'CanDeleteComments'=>1,
                    'IsDeleted'=>0,
                    'IsActive'=>1,
                    'IsPublic'=>1,
                    'DateCreated'=> $dateTime->format('Y-m-d H:i:s')
                ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Profiles');
    }

}