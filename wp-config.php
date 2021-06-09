<?php
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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'owr');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('FS_METHOD','direct');

define( 'WP_MAX_MEMORY_LIMIT', '9999999999M' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'iE1Nw/>c87h@d7GS, Jl9Biz?[,B,]ed|H%+56@!`*!]m{jRz/u6$7 ovh6$b/v4');
define('SECURE_AUTH_KEY',  'j3b;NP`g5Z%@@TN,6?GQK{t$Q/-Rh]n0Jqe&fl MEax2RpW(2.uzk%]3quF(iJ4j');
define('LOGGED_IN_KEY',    'QBds yDf//,IhA7#3N$M?A}`sl5Gw-m^=0Cz?s6(DoK{RZvC)V;3SjQ5q)&-8ABd');
define('NONCE_KEY',        ';]68bB?se#dEQy@?1F{|[1bv_f0u:X$t:~d2j~yBn7,&K9QbcOoZG]#kGmI/$E2 ');
define('AUTH_SALT',        'no~Q^L9X(lKln!x,*J788`Y{Fod=oc31`Q?q@[p;(6(&l.pU@Sx#07)29~h-?.N_');
define('SECURE_AUTH_SALT', '3b)5nDWb>I}Q0H+vJK9USB{gf9LE(6.P:.DjLHXhRGAdZ7%Nt i2V0j%T318SB#K');
define('LOGGED_IN_SALT',   'R5* ,oYtPVEF@BF0+?3B{6FKX~fwjs`;Kc~P2af{kurtB4n|!zb;xz=C-flp:lf,');
define('NONCE_SALT',       'XIqy3=5.[Jt~_]0eE/8*Ic[Dg.u%}<Y7tsch_wH1fTBfrv,%+#5CTB<^n*sekj<Q');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
