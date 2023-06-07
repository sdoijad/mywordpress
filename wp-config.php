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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'naua' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         '+X3faY~: cnEi/L ?!1M&3@_c@}ts4f7kh*m 8Si#I=efaYXkQ61)-qMwlhslnB^' );
define( 'SECURE_AUTH_KEY',  '7*tqd%.c &5(2|:M^d(KW8dS>hyg7^N0FQu!7CsZBF;)V+Bzqh(9iqb@VfFhD+]Q' );
define( 'LOGGED_IN_KEY',    '^(]b+Ljm*Aq 7aRlOhJwD~rfU;F4sOn1(495!GVy2@~A7=n9%JmHDC}ypXs5hJa1' );
define( 'NONCE_KEY',        '=!}ul^f^dpKtdq7gG9MI-UMMoWmB(A&fiS|1&#HK_^O0yEi-:wn~3iyv-Kwe?|D!' );
define( 'AUTH_SALT',        'M;UA%@?RP$`-_6a9lBI2Q%,QgQM+`qAZ82E LiY&V?P!w-4Nls-0FV:T{q6]^vT9' );
define( 'SECURE_AUTH_SALT', 'k*gl^%6W+$7s2)2~oOw&?9k4:P!Y88FCB_=v2.!Vlo1j<@hW`8ummz9nB =h).>H' );
define( 'LOGGED_IN_SALT',   'n+u)Vj^o!Z:kd|~-~}|`xVjwj=Lef5B=Y#[Y!2?5=Q=jY1v<`v-*qW7Y{WH+AN;O' );
define( 'NONCE_SALT',       'P#,Jp,K+ZvA$=b,kfZ`0~N/byln$MS*ZMF?jSsTwbyWr/x4iQi$7Vt!VtV?i .UO' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
