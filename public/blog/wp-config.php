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
define('DB_NAME', 'ideaingblog');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '*OV#%Ch_>0YzBt`zrKrXU:K[L-=[,c#Ra5=HMl@PnS-dUmskG:6$|P3;H,;|5v+O');
define('SECURE_AUTH_KEY',  'giR +oYev{Ah!,?ae<i@,YA.(gQyVxX3=8]7x7E01GTmVnXJm!pWp;UrP=Y6o(D{');
define('LOGGED_IN_KEY',    'EVP>,?odc+uTUTCaA@58 +*f!n^oN9hFN6|{#OWC_2|~cft9}c+:6n~8?EoO%5p!');
define('NONCE_KEY',        'c+ri+TRRp<vv|mzg|[E[#mOX_1T#Z^HYo63*]q(J/!lOs^8At5Z>H/n+pn7jjDU?');
define('AUTH_SALT',        '[biNpjSKUit)<3PbZ2mo*F17S~b&XGjp$}B|My*.gTlgL-WK=8(|9NgVrpX0yJBf');
define('SECURE_AUTH_SALT', '1lCA-LgSEJ_er)L 0XYJ^m+wtMtI}Xb;JE>2_px}24+WsC&pLxD[EL+t(gu `&`$');
define('LOGGED_IN_SALT',   'haOIP8lf/^0@B]$Ag$`:)D<9v6R.N}t_k+`r( (3]D}t{B6*<M/&%?/b2d~IeNWn');
define('NONCE_SALT',       '}.AS&uj51IMelL-1[UW3z}>PAqe(<+s1)J;jf^q]}tG4_,?x}>h*)1-*bHjfCEN?');

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
