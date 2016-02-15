<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = 'desarrollo';
$active_record = TRUE;

$db['desarrollo']['hostname'] = 'localhost';
$db['desarrollo']['username'] = 'root';
$db['desarrollo']['password'] = 'toor';
$db['desarrollo']['database'] = 'bd_des_yana';
$db['desarrollo']['dbdriver'] = 'mysqli';
$db['desarrollo']['dbprefix'] = '';
$db['desarrollo']['pconnect'] = TRUE;
$db['desarrollo']['db_debug'] = TRUE;
$db['desarrollo']['cache_on'] = FALSE;
$db['desarrollo']['cachedir'] = '';
$db['desarrollo']['char_set'] = 'utf8';
$db['desarrollo']['dbcollat'] = 'utf8_general_ci';
$db['desarrollo']['swap_pre'] = '';
$db['desarrollo']['autoinit'] = TRUE;
$db['desarrollo']['stricton'] = FALSE;

$db['pruebas']['hostname'] = 'localhost';
$db['pruebas']['username'] = 'root';
$db['pruebas']['password'] = 'toor';
$db['pruebas']['database'] = 'bd_test_yana';
$db['pruebas']['dbdriver'] = 'mysqli';
$db['pruebas']['dbprefix'] = '';
$db['pruebas']['pconnect'] = TRUE;
$db['pruebas']['db_debug'] = TRUE;
$db['pruebas']['cache_on'] = FALSE;
$db['pruebas']['cachedir'] = '';
$db['pruebas']['char_set'] = 'utf8';
$db['pruebas']['dbcollat'] = 'utf8_general_ci';
$db['pruebas']['swap_pre'] = '';
$db['pruebas']['autoinit'] = TRUE;
$db['pruebas']['stricton'] = FALSE;

$db['preproduccion']['hostname'] = 'localhost';
$db['preproduccion']['username'] = 'root';
$db['preproduccion']['password'] = 'toor';
$db['preproduccion']['database'] = 'bd_pre_yana';
$db['preproduccion']['dbdriver'] = 'mysqli';
$db['preproduccion']['dbprefix'] = '';
$db['preproduccion']['pconnect'] = TRUE;
$db['preproduccion']['db_debug'] = TRUE;
$db['preproduccion']['cache_on'] = FALSE;
$db['preproduccion']['cachedir'] = '';
$db['preproduccion']['char_set'] = 'utf8';
$db['preproduccion']['dbcollat'] = 'utf8_general_ci';
$db['preproduccion']['swap_pre'] = '';
$db['preproduccion']['autoinit'] = TRUE;
$db['preproduccion']['stricton'] = FALSE;

$db['produccion']['hostname'] = 'localhost';
$db['produccion']['username'] = 'root';
$db['produccion']['password'] = 'toor';
$db['produccion']['database'] = 'bd_prod_yana';
$db['produccion']['dbdriver'] = 'mysqli';
$db['produccion']['dbprefix'] = '';
$db['produccion']['pconnect'] = TRUE;
$db['produccion']['db_debug'] = TRUE;
$db['produccion']['cache_on'] = FALSE;
$db['produccion']['cachedir'] = '';
$db['produccion']['char_set'] = 'utf8';
$db['produccion']['dbcollat'] = 'utf8_general_ci';
$db['produccion']['swap_pre'] = '';
$db['produccion']['autoinit'] = TRUE;
$db['produccion']['stricton'] = FALSE;

/* End of file database.php */
/* Location: ./application/config/database.php */