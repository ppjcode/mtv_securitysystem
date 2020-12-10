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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'mtv_security' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define('AUTH_KEY',         '1kuQf3Oe>4:TK[OWuS24(_|5FS#qQ69OmzA)?oGC$({yG: q~m61:hU>aXC `o3A');
define('SECURE_AUTH_KEY',  't]:{P%V-2b7l!,S[Z?KiO.Tu455EL^y7aT8w46!1Q! ~CdZYiw}%AJ+`cPv^gyFK');
define('LOGGED_IN_KEY',    'nCB>zf`~C.0ZSh^s5!+#,;y-{I+iR<Tn.+0@v+MK_=sPLZ+Mv#%P{C_QGs*,6A)m');
define('NONCE_KEY',        'Ie>PfW-%fA|29J]n_38m$pZn5SRwQ7evho/pJnt{-V&/ZN5A>8Vzuq>phdUamL5#');
define('AUTH_SALT',        ' 1]ego<{U~h3ZGE0vU7CgUTCj*Rq~-g<[z8y|_taJ+z1Q289&QdlCcj?7td[f(HH');
define('SECURE_AUTH_SALT', 'u3R<)d&_XUhQM:!aQFP4ZbZQ]*#Ni.+`>w;ERot%0;Xbw$+0D|.gao=0?I_+it%&');
define('LOGGED_IN_SALT',   'iH~B9*xHZUdot@p++vwcTD> pXdqS3A0w;*A$a*LZ=_&BRw-&1=yNbOj5zmP7#L1');
define('NONCE_SALT',       'md)m.?N<?>nz=<[ ?w2<?~dy-4n&{UYsqg?^k!}PhR^i7@9wpohA55z#alg>/OF-');

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
