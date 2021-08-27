<?php
$WP_ENVIRONMENT = 'local';
if ( file_exists( __DIR__ . "/$WP_ENVIRONMENT-config.php" ) ) {
    include( __DIR__ . "/$WP_ENVIRONMENT-config.php" );
} else {
    die( "$WP_ENVIRONMENT-config.php not found" );
}

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
/** Sets up 'direct' method for wordpress, auto update without ftp */
define('FS_METHOD','direct');
