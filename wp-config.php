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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'dungtt123');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ']L#]{Q8M7)Vau4*hs%^tCIrFZA/2xwK$Y54T,!@4$4,iZ<Tnu#az7 U@U8cSE*%5');
define('SECURE_AUTH_KEY',  'J%IEa+0Yit&w2|:S$y)/IG*:`]-erx.QAvlTiKcrivijVE__:+x4i&Feg<>lr),G');
define('LOGGED_IN_KEY',    '[_Nc-h%5=C;!1>T ;.~}l]r46,*3V)4(1nt U|`mx.MKf.=W#x1cC9Db-KR[W(/;');
define('NONCE_KEY',        '_QodHpF9>Ewgux]L]Q9FaOe-E$h]f>mwo8wO6%[O(?XZG~8`]&X3>(SAJ&|a.d7~');
define('AUTH_SALT',        ']S*^j~ZRpS=kqFIYi,ZMj|1O7Nzk+o{fyket/<L.=3&c/]:1P<ed3P8E}*`(xK]=');
define('SECURE_AUTH_SALT', '5C1t37Q]HNy:GLg8HK#CHvG>4^F>t5}0O%li^$vGv,ePc<_{({?jntf0{C-d!@8w');
define('LOGGED_IN_SALT',   'O=oeNrp1$AM~6|G)AIgC)tyMw,Y]5LI(P1c9zbo~}zKXvzDFXd}bsfz `sgq$?T`');
define('NONCE_SALT',       'cP-Iwkx?BV^w|.NGg.dT|,8c9WU?p2Tb!Vo66pTI]NG]gh)fDus(B6~xZ[cb5ga#');

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
