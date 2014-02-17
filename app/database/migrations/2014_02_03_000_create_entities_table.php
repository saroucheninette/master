<?php

use Illuminate\Database\Migrations\Migration;

class CreateEntitiesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Entities', function($table) {
            $table->increments('Entities_id')->index();
            $table->integer('Entities_parent_id')->index()->nullable();
            $table->string('Name', 255);
            $table->longtext('DescriptionText')->nullable();
            $table->integer('IsDeleted');
            $table->integer('IsActive');
            $table->integer('IsPublic');
            $table->integer('Users_id_created')->index()->nullable();
            $table->integer('Users_id_updated')->index()->nullable();
            $table->dateTime('DateCreated');
            $table->dateTime('DateUpdated')->nullable();
           
        });
         $dateTime = new DateTime('now');
         DB::table('Entities')->insert(
                array(
                    'Name' => 'Master',
                    'DescriptionText' => 'Master entity',
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
        Schema::drop('TicketCategories');
    }

}