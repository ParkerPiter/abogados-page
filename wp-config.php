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
define( 'DB_NAME', 'test' );

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
define( 'AUTH_KEY',         '2y%r5n3]BA~%552%9mk.7@87E4f82RibU0db$v;,>[ijK`cCcg@/P1qAnAUh.R2s' );
define( 'SECURE_AUTH_KEY',  '>b<%@,>rGAQkJ]/f2e+eU*kizUnK6RQC_Sah.jJ4,Pr|A%[/hoPFHl)-y>M2OOGV' );
define( 'LOGGED_IN_KEY',    'L<,cQmO2XA7`_jBx[GtT ;v}Z_,P-WFJD|9N2B-%nJYOz9l1`W5 GPr{WV?e7K+e' );
define( 'NONCE_KEY',        '.RoV$M)Lss>=}H@Hu}K9T|0UcU3&pWx{2]I_0[/%U(09etnyj4C)|[%H9:m[H4+A' );
define( 'AUTH_SALT',        '7RH+ZEkA7jX/C.S7L`&)N2M*lX%>nv{Na0SQrRC[u~k*g@MA-f~LvPhNXFdz_hf+' );
define( 'SECURE_AUTH_SALT', 'U|pi8sbrBmx&q-.o^JAUEl$-A5u3xRUQ1&6f.Yt:{UE%eA2mS`-&>#l+/pWc>(G:' );
define( 'LOGGED_IN_SALT',   'Y~i2 H0QA cA&Fhy^I0{.(7%4 O5J6T^4Lu|_1FKoB`4=j2p{v!C1dbPQ7MF~tXV' );
define( 'NONCE_SALT',       '6a`kUu2:i >x_;5rF+vvL5Cq%YQG+at;NU99TD&jDmi%Q6K&Sm?d-D3@cx_EayR_' );

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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
