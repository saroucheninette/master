<?php

use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Tickets', function($table) {
            $table->increments('Tickets_id');
            $table->string('Name', 100)->index();
            $table->longtext('DescriptionText');
            $table->longtext('DescriptionHtml');
            $table->longtext('ResolutionText')->nullable();
            $table->longtext('ResolutionHtml')->nullable();
            $table->longtext('ReproductionText')->nullable();
            $table->longtext('ReproductionHtml')->nullable();
            $table->dateTime('DateStart')->nullable();
            $table->dateTime('DateEnd')->nullable();
            $table->dateTime('DateResolved')->nullable();
            $table->dateTime('DateClosed')->nullable();
            $table->string('Status_id', 3)->index();
            $table->string('Priorities_id', 3)->nullable()->index();
            $table->string('Urgencies_id', 3)->nullable()->index();
            $table->string('Reproductibilities_id', 3)->nullable()->index();
            $table->dateTime('EstimateTime')->nullable();
            $table->integer('Environments_id')->index();
            $table->string('Impacts_id', 3)->index();
            $table->string('ImpactsText', 500)->nullable();
            $table->string('Categories_id', 3)->index();
            $table->integer('TicketTypes_id')->index();
            $table->integer('Progression')->nullable();
            $table->string('RollbackStates_id', 3)->nullable()->index();
            $table->string('Monitoring', 500)->nullable();
            $table->longtext('LogFiles')->nullable();
            $table->integer('OutlookMapping_id')->nullable();
            $table->integer('IsDeleted');
            $table->integer('IsActive');
            $table->integer('IsPublic');
            $table->integer('Users_id_created')->index();
            $table->integer('Users_id_updated')->index();
            $table->dateTime('DateCreated');
            $table->dateTime('DateUpdated')->nullable();
        });
        Schema::table('Tickets', function($table)
        {
           $table->foreign('Users_id_created')
                 ->references('Users_id')->on('users');
           $table->foreign('Users_id_updated')
                 ->references('Users_id')->on('users');
           $table->foreign('Status_id')
                   ->references('Status_id')->on('TicketStatus');
            $table->foreign('Priorities_id')
                    ->references('Priorities_id')->on('TicketPriorities');
            $table->foreign('Urgencies_id')
                    ->references('Urgencies_id')->on('TicketUrgencies');
            $table->foreign('Reproductibilities_id')
                    ->references('Reproductibilities_id')->on('TicketReproductibilities');
            $table->foreign('Environments_id')
                    ->references('Environments_id')->on('TicketEnvironments');
            $table->foreign('Impacts_id')
                    ->references('Impacts_id')->on('TicketImpacts');
            $table->foreign('Categories_id')
                    ->references('Categories_id')->on('TicketCategories');
            $table->foreign('TicketTypes_id')
                    ->references('TicketTypes_id')->on('TicketTypes');
            $table->foreign('RollbackStates_id')
                    ->references('RollbackStates_id')->on('TicketRollbackStates');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Tickets');
    }

}