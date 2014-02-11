<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'App\\Controllers\\BaseController' => $baseDir . '/app/controllers/BaseController.php',
    'App\\Controllers\\HomeController' => $baseDir . '/app/controllers/HomeController.php',
    'App\\Controllers\\LoginController' => $baseDir . '/app/controllers/auth/LoginController.php',
    'App\\Controllers\\PermissionController' => $baseDir . '/app/controllers/auth/PermissionController.php',
    'App\\Controllers\\TicketController' => $baseDir . '/app/controllers/ticket/TicketController.php',
    'App\\Models\\BaseModel' => $baseDir . '/app/models/BaseModel.php',
    'App\\Models\\Configuration' => $baseDir . '/app/models/Configuration.php',
    'App\\Models\\Groups' => $baseDir . '/app/models/Groups.php',
    'App\\Models\\Profiles' => $baseDir . '/app/models/Profiles.php',
    'App\\Models\\TicketCategories' => $baseDir . '/app/models/TicketCategories.php',
    'App\\Models\\TicketEnvironments' => $baseDir . '/app/models/TicketEnvironments.php',
    'App\\Models\\TicketImpacts' => $baseDir . '/app/models/TicketImpacts.php',
    'App\\Models\\TicketPriorities' => $baseDir . '/app/models/TicketPriorities.php',
    'App\\Models\\TicketStatus' => $baseDir . '/app/models/TicketStatus.php',
    'App\\Models\\TicketTypes' => $baseDir . '/app/models/TicketTypes.php',
    'App\\Models\\Tickets' => $baseDir . '/app/models/Tickets.php',
    'App\\Models\\Users' => $baseDir . '/app/models/Users.php',
    'App\\Utils\\DateUtil' => $baseDir . '/app/controllers/utils/DateUtil.php',
    'App\\Utils\\ListUtil' => $baseDir . '/app/controllers/utils/ListUtil.php',
    'CreateAuthenticationtypesTable' => $baseDir . '/app/database/migrations/2014_02_03_003_create_authenticationtypes_table.php',
    'CreateCommentsTable' => $baseDir . '/app/database/migrations/2014_02_03_015_create_comments_table.php',
    'CreateConfigurationTable' => $baseDir . '/app/database/migrations/2014_02_03_004_create_configuration_table.php',
    'CreateDocumentsTable' => $baseDir . '/app/database/migrations/2014_02_03_016_create_documents_table.php',
    'CreateDocumentticketsTable' => $baseDir . '/app/database/migrations/2014_02_03_017_create_documenttickets_table.php',
    'CreateDocumentversionsTable' => $baseDir . '/app/database/migrations/2014_02_03_018_create_documentversions_table.php',
    'CreateExternaltypesTable' => $baseDir . '/app/database/migrations/2014_02_03_019_create_externaltypes_table.php',
    'CreateGroupsTable' => $baseDir . '/app/database/migrations/2014_02_03_020_create_groups_table.php',
    'CreateHistoriesTable' => $baseDir . '/app/database/migrations/2014_02_03_021_create_histories_table.php',
    'CreateHostcategoriesTable' => $baseDir . '/app/database/migrations/2014_02_03_022_create_hostcategories_table.php',
    'CreateHostsTable' => $baseDir . '/app/database/migrations/2014_02_03_024_create_hosts_table.php',
    'CreateHosttypesTable' => $baseDir . '/app/database/migrations/2014_02_03_023_create_hosttypes_table.php',
    'CreatePreferencesTable' => $baseDir . '/app/database/migrations/2014_02_03_025_create_preferences_table.php',
    'CreateProfilesTable' => $baseDir . '/app/database/migrations/2014_02_03_000_create_profiles_table.php',
    'CreateTicketassociationsTable' => $baseDir . '/app/database/migrations/2014_02_03_026_create_ticketassociations_table.php',
    'CreateTicketcategoriesTable' => $baseDir . '/app/database/migrations/2014_02_03_005_create_ticketcategories_table.php',
    'CreateTicketcomponentsTable' => $baseDir . '/app/database/migrations/2014_02_03_027_create_ticketcomponents_table.php',
    'CreateTicketenvironmentsTable' => $baseDir . '/app/database/migrations/2014_02_03_013_create_ticketenvironments_table.php',
    'CreateTicketimpactsTable' => $baseDir . '/app/database/migrations/2014_02_03_007_create_ticketimpacts_table.php',
    'CreateTicketprioritiesTable' => $baseDir . '/app/database/migrations/2014_02_03_006_create_ticketpriorities_table.php',
    'CreateTicketreproductibilitiesTable' => $baseDir . '/app/database/migrations/2014_02_03_009_create_ticketreproductibilities_table.php',
    'CreateTicketrollbackstatesTable' => $baseDir . '/app/database/migrations/2014_02_03_008_create_ticketrollbackstates_table.php',
    'CreateTicketsTable' => $baseDir . '/app/database/migrations/2014_02_03_014_create_tickets_table.php',
    'CreateTicketstatusTable' => $baseDir . '/app/database/migrations/2014_02_03_010_create_ticketstatus_table.php',
    'CreateTickettypesTable' => $baseDir . '/app/database/migrations/2014_02_03_011_create_tickettypes_table.php',
    'CreateTicketurgenciesTable' => $baseDir . '/app/database/migrations/2014_02_03_012_create_ticketurgencies_table.php',
    'CreateTicketusersTable' => $baseDir . '/app/database/migrations/2014_02_03_029_create_ticketusers_table.php',
    'CreateTicketusertypesTable' => $baseDir . '/app/database/migrations/2014_02_03_028_create_ticketusertypes_table.php',
    'CreateUsersTable' => $baseDir . '/app/database/migrations/2014_02_03_001_create_users_table.php',
    'CreateUsersgroupsTable' => $baseDir . '/app/database/migrations/2014_02_03_030_create_usersgroups_table.php',
    'DatabaseSeeder' => $baseDir . '/app/database/seeds/DatabaseSeeder.php',
    'IlluminateQueueClosure' => $vendorDir . '/laravel/framework/src/Illuminate/Queue/IlluminateQueueClosure.php',
    'SessionHandlerInterface' => $vendorDir . '/symfony/http-foundation/Symfony/Component/HttpFoundation/Resources/stubs/SessionHandlerInterface.php',
    'TestCase' => $baseDir . '/app/tests/TestCase.php',
);
