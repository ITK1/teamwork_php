<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'ql_khohang' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'vcM|I%|G!(<gR_OKf$ZvZ:?:s3v)@.}!iA@T=|XSI`*5;kKU<FlPk?eM<]m~pP?{' );
define( 'SECURE_AUTH_KEY',  '?lc2Vj7#yj8*H3p|0xE5PaVu6WR`t@&PsKH(]S}X_Ol)5,_ZNrhKQeP[/)c:D!;M' );
define( 'LOGGED_IN_KEY',    '&boC3/QDL?_&kXq@Ri.kEK>(H4B) :<10l=G2fP+~E~[X3H@df*)xAsZqq8(6$n~' );
define( 'NONCE_KEY',        '`&n8?Tg@6|)TJ|f&zab`tFFV76/6/&$QV_w`phiyi18d7 8Lt,+b{EBhl3dJpJ|(' );
define( 'AUTH_SALT',        '6H#h.!+C9e+J6Q~DTq-TelJ?gv%-8Y@~dk5-{CcVh?!yPPT!d1+k)I|~H7B88M4!' );
define( 'SECURE_AUTH_SALT', 'bj:CD2et/2WW_=`&U|?_M=F,+vi/ADrGWV2Z.L0X*h6T?7]s] p]jB[3&EHFx*>;' );
define( 'LOGGED_IN_SALT',   'j9[;O[s*&*hAt6fvkV7VW2s9wUb97=ZwAGC0?Y+gD;1~vmEtF`sxav+lk%My3L K' );
define( 'NONCE_SALT',       'lhw;J:B-QG ~gcVQFoV?o<8SkUZRs+/gHFBqPeUI2h%BJx %gPu^4xT=X-H@9Z%G' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
