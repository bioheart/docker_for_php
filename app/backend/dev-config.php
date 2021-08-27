<?php
/* SSL Settings */
define('FORCE_SSL_ADMIN', true);
/* Turn HTTPS 'on' if HTTP_X_FORWARDED_PROTO matches 'https' */
if (strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false) {
    $_SERVER['HTTPS'] = 'on';
}
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'uniclub_demo' );

/** MySQL database username */
define( 'DB_USER', 'admin' );

/** MySQL database password */
define( 'DB_PASSWORD', '>=^?mgt=?mMRCy5T' );

/** MySQL hostname */
define( 'DB_HOST', 'rdsmysqluniclublt.cutbcywxdgv7.eu-central-1.rds.amazonaws.com' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'un{C[mxmZ1b7mO6ea*x0XU4^rtB?t5K>}-|h=.u:}d}2sM+:BB|&%7hITAZF_cRE' );
define( 'SECURE_AUTH_KEY',  't^6`;rkMe&#BL9:^mfS%X4LD~>m 1,8D*iobb/2]b^I`eG`zRrti)_Su1.R#Y/pm' );
define( 'LOGGED_IN_KEY',    '#JPI7Z`Lc|Cz^o6Kh:}~n$[-#m2o.(pXh%g_h-r9YW!jxO2lp_Qk9+~Nk/MD0]R3' );
define( 'NONCE_KEY',        '=en#zk,[aNw`A7~!jS<%9?7@;}0_6iwg!j|wEB[{_+^9JX#Mp{&ow2{#Jfr:3H,Q' );
define( 'AUTH_SALT',        '^*+{%0nkulv>nkwDWnr%xJbCAprHs`j&~l^=L;?`{w4[=hpIlF4UV&DQ}=S&(Qy?' );
define( 'SECURE_AUTH_SALT', '6t)8ITyuQaxsm5:;TdY(->~Y:E` HGCuk<9N5=kt:4{z6R[5AYeBA;U`VmT#S|M^' );
define( 'LOGGED_IN_SALT',   '#:.4r[I$t,S$(nSM6dZ|U hWp+s=i6m}[]5s$R?i4V6tzM`k#O&<(Bt!8%!4:MhS' );
define( 'NONCE_SALT',       'T8D~G*JY!Shv85Bzm^[BXU?l1aUpN 5a9uUcn$;d@Io`5IXN4.>/h~PL]pAU5isD' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = '1qazxsw2_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );
define( 'WP_MEMORY_LIMIT', '1024M');
define( 'NORWAYAPI_ENDPOINT', 'https://raisedbet-com-api.stage.norway.everymatrix.com/' );
define( 'OM_ENDPOINT', 'https://serverapi-stage.everymatrix.com/' );
define( 'OM_TOKEN', 'ZC89kvCXiQvZnEyKPCfQoLvm3ut0z1bY7ckxm30M' );
define('server_ip_1','10.3.57.15');
define('server_1_api_port',3003);
define('server_1_fe_port',3004);
define('server_ip_2','10.2.57.15');
define('server_2_api_port',3003);
define('server_2_fe_port',3004);
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
