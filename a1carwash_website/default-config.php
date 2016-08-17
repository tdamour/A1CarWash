<?php

/**
 * @file
 * This file contains site configuration information.
 *
 * IMPORTANT. READ ME
 *
 * When installing this site, copy default-config.php to config.php and
 * fill in all database information. The actual config.php should _not_
 * be included in any source code version control system, which is why
 * it has been listed in the .gitignore list for this site.
 *
 * DEVELOPERS
 *
 * Do not put database connection information directly into your application.
 * Instead, include this file using require_once('config.php') and then
 * reference the $dbinfo array for connection info.
 */

global $dbinfo;

$dbinfo = array(
  'host' => 'localhost',
  'database' => 'CHANGEME',
  'username' => 'CHANGEME',
  'password' => 'CHANGEME',
);
