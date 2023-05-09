<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

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
define( 'AUTH_KEY',         'd]{PlOU=OP03NP 0O_fu+N16mTTU8JtL 5+r.8OZE|tNHDQPJT`>JWpXOO|Gjf] ' );
define( 'SECURE_AUTH_KEY',  'HaQ=FcX2}wNBn|YcMu/>rVPfoA4^Pn.^ne-0fTb>rVG*s>PDvaL-OoqWT21z;oak' );
define( 'LOGGED_IN_KEY',    'uEni$zbZ0uA{z`lC@%B+dU2Bsg(p5_q6GE<#F`MOR[Oz~n$OmCiI8tC;n,3z&8+P' );
define( 'NONCE_KEY',        'e0l{fzh^-Xuu@E4H2PPm>xoLpr@/@ew[M;E>T6F^Q+H;m(_GGJAjjEaGa.8Z2V(K' );
define( 'AUTH_SALT',        '4&+;hh(XP/>- 9[:l}x*|p]C)^oDmb,$VPb-t6X73mXh,6nE[Pvc.qvc4yp2m &3' );
define( 'SECURE_AUTH_SALT', ')Jb/y5j-HK51:mmJyw2h4,2_>*qjk,#27vDry!lO_r9Ck>XB#&fG71%F6b]G*cE:' );
define( 'LOGGED_IN_SALT',   'j22.X/[/C8;c&~MW-~[nN1k3htGz1!%U5 e;V&UnAgzECKR;g>Bwp~4ljZeRf}dr' );
define( 'NONCE_SALT',       '%+fLWsAvz^vTU9m* >Y:]#SAPf=wT=p|RY2t,OyNfT8C>SBEkBwQ,@j3TBl9(vU#' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );
define('FS_METHOD', 'direct');
/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';