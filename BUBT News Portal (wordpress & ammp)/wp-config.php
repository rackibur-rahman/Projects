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
define('DB_NAME', 'newsportal');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'mysql');

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
define('AUTH_KEY',         'jB;sRg$eV4|$~W%o:%f>Q3ywRU8d+Wm-o7`}|0D>+ESbM6aWWFEVX5^rck7^;io7');
define('SECURE_AUTH_KEY',  'l$>p,];Nu26^8=>,V)y52:w> [Zzj)y fjDbA9HO{o6|Vj/6x,l5p8Uq(o#qXxp,');
define('LOGGED_IN_KEY',    '#d}ymN?90#P]>fBV{CSo@gm;bw:5._vdoj@A|!~V,rkl/^`Keg<zIg~Jz7t$p%8.');
define('NONCE_KEY',        'ubn-+Y2nj5(OpR]!Huka.J,*A2@ME2=?X^}e^Cqt b.Ju~&pH7(ReQRNWE>Wjv?w');
define('AUTH_SALT',        '3%2p14%I(&mRFl@Q>M3`D-KLsLeo=~7%QC$:?QJ`YL<TKU2`% =%?#H-;jhP$Ii?');
define('SECURE_AUTH_SALT', 'q+1uA??eq4qHA3k@1&kf4: cd)T3$^g&P}N7Bf0LgN_@4! v.^FDhgLs>/6[-6tf');
define('LOGGED_IN_SALT',   '!1?gGsI`68XN8t2PjEVn*]`?Lgfvz-L%ZJcO<^V_<Ht6Px~qvy};0+&8?yi)@HFn');
define('NONCE_SALT',       'ol6-q^u-++0<[b+cu4O]25/RYdH*JX`:Za`|ha%LNv5`v^DCa/JxI2&:9%~,E#)V');

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
