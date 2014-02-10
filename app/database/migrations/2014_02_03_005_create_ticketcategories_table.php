<?php

use Illuminate\Database\Migrations\Migration;

class CreateTicketcategoriesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TicketCategories', function($table) {
            //$table->increments('id');
            $table->string('Categories_id', 3)->primary();
            $table->string('Label', 255);
            $table->longtext('DescriptionText')->nullable();
            $table->integer('IsDeleted');
            $table->integer('IsActive');
            $table->integer('IsPublic');
            $table->integer('Users_id_created')->index();
            $table->integer('Users_id_updated')->index()->nullable();
            $table->dateTime('DateCreated');
            $table->dateTime('DateUpdated')->nullable();
           
        });
        Schema::table('TicketCategories', function($table)
        {
           $table->foreign('Users_id_created')
                 ->references('Users_id')->on('Users');
           $table->foreign('Users_id_updated')
                 ->references('Users_id')->on('Users');
        });
        //BUG/MEP/MEV/701/PRO
         $dateTime = new DateTime('now');
         DB::table('TicketCategories')->insert(
                array(
                    'Categories_id' => 'BUG',
                    'Label'=> 'Bug',
                    'DescriptionText' => 'Bug category : for reporting a bug',
                    'IsDeleted'=>0,
                    'IsActive'=>1,
                    'IsPublic'=>1,
                    'Users_id_created'=>1,
                    'DateCreated'=> $dateTime->format('Y-m-d H:i:s')
                ));
         DB::table('TicketCategories')->insert(
                array(
                    'Categories_id' => 'MEP',
                    'Label'=> 'MEP',
                    'DescriptionText' => 'MEP category : for package release on production',
                    'IsDeleted'=>0,
                    'IsActive'=>1,
                    'IsPublic'=>1,
                    'Users_id_created'=>1,
                    'DateCreated'=> $dateTime->format('Y-m-d H:i:s')
                ));
          DB::table('TicketCategories')->insert(
                array(
                    'Categories_id' => 'MEV',
                    'Label'=> 'MEV',
                    'DescriptionText' => 'MEV category : for package release on preproduction',
                    'IsDeleted'=>0,
                    'IsActive'=>1,
                    'IsPublic'=>1,
                    'Users_id_created'=>1,
                    'DateCreated'=> $dateTime->format('Y-m-d H:i:s')
                ));
          DB::table('TicketCategories')->insert(
                array(
                    'Categories_id' => '701',
                    'Label'=> '701',
                    'DescriptionText' => '701 category : for reporting a big problem',
                    'IsDeleted'=>0,
                    'IsActive'=>1,
                    'IsPublic'=>1,
                    'Users_id_created'=>1,
                    'DateCreated'=> $dateTime->format('Y-m-d H:i:s')
                ));
          DB::table('TicketCategories')->insert(
                array(
                    'Categories_id' => 'PRO',
                    'Label'=> 'Project',
                    'DescriptionText' => 'Project category : for project',
                    'IsDeleted'=>0,
                    'IsActive'=>1,
                    'IsPublic'=>1,
                    'Users_id_created'=>1,
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