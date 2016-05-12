<?php

ini_set( "display_errors", true );
date_default_timezone_set( "Asia/Manila" );  // http://www.php.net/manual/en/timezones.php
define( "DB_DSN", "mysql:host=localhost;dbname=healthspenditure" );
define( "DB_USERNAME", "root" );
define( "DB_PASSWORD", "root" );
 
function handleException( $exception ) {
  echo "Sorry, a problem occurred. Please try later.";
  error_log( $exception->getMessage() );
}
 
set_exception_handler( 'handleException' );

?>