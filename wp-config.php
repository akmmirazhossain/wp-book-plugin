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
define( 'DB_NAME', 'wp_prep' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'mysql' );

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
define( 'AUTH_KEY',         'Ql3LS^/5O+gF2kT6Ni;]3Mp^WZRQ#(L{yW1dvc/tiuO$<gIOIb=k,)@wY)KcH/)$' );
define( 'SECURE_AUTH_KEY',  '~?D$%DPei!/(yv1hHuL2u;zTq;P)Ff28oc u5mf<9mot{`]OG>6l1;bhUTijkNNb' );
define( 'LOGGED_IN_KEY',    '_L?eTD&4JYG<d|| f@}`L*26p*Jps.PXBC[zid$0RV-61d-`{G($_Zf$2o/2(G_S' );
define( 'NONCE_KEY',        '5z0P~c~MwcG}U-(cqKdg<<9. *$,[T&QE[ BwJo3/~*`$[/K/bq$EbwKo9S2%<E+' );
define( 'AUTH_SALT',        '^U[0L:),yOCDk|k03By3fNu5cgW*/){f+U/CPtX94N)6>2{-Xf=kTxmCgf{0:w`I' );
define( 'SECURE_AUTH_SALT', 'XJ<b-QZx}[!$:wUWa26ZHvys0&m-}51fpe/a(oe-_3gmyhxW|?xfn};k_K=YZknf' );
define( 'LOGGED_IN_SALT',   'T.n(NA}wK~&HlK8{@7mYa7UAip-|1]@86kjq@yUp=uq:0Y|Za`o#x5&/d~EhefUV' );
define( 'NONCE_SALT',       'xu&-i>}YJ7.u{)Vj7(o|osPKfpGr;^IP-Bh0*=R?,0Nrh[+X_n!yUB09129:@0p+' );

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



define( 'AKMDE_DEBUG', true );

define( 'DICK_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
