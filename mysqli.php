<?php

/*DEFINE ('DB_USER', getenv('DB_USER'));    // Get username from environment variable
DEFINE ('DB_PASSWORD', getenv('DB_PASSWORD')); // Get password from environment variable
DEFINE ('DB_HOST', getenv('DB_HOST'));
DEFINE ('DB_NAME', getenv('DB_NAME'));

// Make the MySQL connection.
$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);*/

DEFINE ('DB_USER', 'root');
//DEFINE ('DB_PASSWORD', 'NO');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'possiddiqie'); //tukar nama database korang

// Make the MySQL connection.
$dbc = @mysqli_connect(DB_HOST, DB_USER) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
//echo"<p>Successfully connected to MySQL</p>\n";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
// Select database.
@mysqli_select_db($dbc, DB_NAME) OR die ('Could not connect to MySQL database: ' . mysqli_errno($dbc) );
//echo"<p>Database name = ".DB_NAME."</p>\n";

?>