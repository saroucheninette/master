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
            $table->string('Code', 30);
            $table->string('Name', 100);
            $table->string('DescriptionText', 500)->nullable();
            $table->string('TicketPermissions',30);
            $table->string('DocumentPermissions',30);
            $table->string('UserPermissions',30);
            $table->string('ProfilePermissions',30);
            $table->string('GroupPermissions',30);
            $table->string('HistoryPermissions',30);
            $table->string('HostPermissions',30);
            $table->string('CommentPermissions',30);
            $table->string('AdminPermissions',30);
            $table->integer('IsDeleted');
            $table->integer('IsActive');
            $table->integer('IsPublic');
            $table->integer('Users_id_created')->index()->nullable();
            $table->integer('Users_id_updated')->index()->nullable();
            $table->dateTime('DateCreated');
            $table->dateTime('DateUpdated')->nullable();
        });
        //Profiles are :
        // READ;OWN;ADD;MODIFY;DELETE
        //READ= Lecture de liste
        //OWN= Gestion lecture/ecriture des ces éléments : propriétaire/assignataire
        //ADD = ajout d'éléménts
        //MODIFY = modification de tout élément
        //DELETE = suppression de tout élément

        $dateTime = new DateTime('now');
        DB::table('Profiles')->insert(
                array(
                    'Code' => 'ADMIN_PROFILE',
                    'Name'=> 'Administrator',
                    'TicketPermissions' => '1;1;1;1;1',
                    'DocumentPermissions' => '1;1;1;1;1',
                    'UserPermissions' => '1;1;1;1;1',
                    'ProfilePermissions' => '1;1;1;1;1',
                    'GroupPermissions' => '1;1;1;1;1',
                    'HistoryPermissions' => '1;1;1;1;1',
                    'HostPermissions' => '1;1;1;1;1',
                    'CommentPermissions' => '1;1;1;1;1',
                    'AdminPermissions' => '1;1;1;1;1',
                    'IsDeleted'=>0,
                    'IsActive'=>1,
                    'IsPublic'=>1,
                    'DateCreated'=> $dateTime->format('Y-m-d H:i:s')
                ));
         DB::table('Profiles')->insert(
                array(
                    'Code' => 'READONLY_PROFILE',
                    'Name'=> 'Read only',
                    'TicketPermissions' => '1;0;0;0;0',
                    'DocumentPermissions' => '1;0;0;0;0',
                    'UserPermissions' => '1;0;0;0;0',
                    'ProfilePermissions' => '1;0;0;0;0',
                    'GroupPermissions' => '1;0;0;0;0',
                    'HistoryPermissions' => '1;0;0;0;0',
                    'HostPermissions' => '1;0;0;0;0',
                    'CommentPermissions' => '1;0;0;0;0',
                    'AdminPermissions' => '0;0;0;0;0',
                    'IsDeleted'=>0,
                    'IsActive'=>1,
                    'IsPublic'=>1,
                    'DateCreated'=> $dateTime->format('Y-m-d H:i:s')
                ));
          DB::table('Profiles')->insert(
                array(
                    'Code' => 'USER_PROFILE',
                    'Name'=> 'User',
                    'TicketPermissions' => '1;1;1;0;0',
                    'DocumentPermissions' => '1;1;1;0;0',
                    'UserPermissions' => '1;1;0;0;0',
                    'ProfilePermissions' => '1;1;0;0;0',
                    'GroupPermissions' => '1;1;0;0;0',
                    'HistoryPermissions' => '1;0;0;0;0',
                    'HostPermissions' =>'1;1;0;0;0',
                    'CommentPermissions' => '1;1;1;0;0',
                    'AdminPermissions' => '0;0;0;0;0',
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