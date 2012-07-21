<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'sudarakaorg_wordpress');

/** MySQL database username */
define('DB_USER', 'suda');

/** MySQL database password */
define('DB_PASSWORD', '123');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'o3.:~o|n<ZjzxbR,f>tPsus*{e-plDDH6!|&HR+iJsZlH(WPQ{Vc=>/a7o|h8M<g');
define('SECURE_AUTH_KEY',  'RfH+^5StLq{d8ex2MMMf3y3R @6bID8y_xJQS]$D8es|Y^bP_;$XWaE%6.%l5wnr');
define('LOGGED_IN_KEY',    ' 7&v3;=T;195}JW6B-XW)->N^c01aVxM6^DA-N3brTAH;6$56gZCshmu[L&i|,V[');
define('NONCE_KEY',        'R:+_ye>EKT.Jk0[yk?C7Y%&Kq2w~N?kO`:c/Jp3?M(,Y6%tW$+X%M8SFF5pBg^:;');
define('AUTH_SALT',        '+h[p0&mI3hCuStHlB9ySZ&a.3(hSL9QFk6w;!D~#f_f`1YX0^T6^:L ~=BSBTm1G');
define('SECURE_AUTH_SALT', 'a;uMh >e-O]1,1&;{&Em|MUyZ=Stvs@[IB`ZI-E,},#J<)O_ph{B^HPIvEl6>S1d');
define('LOGGED_IN_SALT',   'B?24RH{oHw^Ozz+(>8I9oECc[!,?~`Bh)Nf+IidHtO[O<>w`5R9&;bo8h(_wO_o*');
define('NONCE_SALT',       'h;&8HLXc=)^qS|e%K&K:HqsM%.v5B7BBA,7v<7bqH~.#bScxN{7pH+[A61UGFL)^');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'sworg_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

define('FORCE_SSL_ADMIN', true);
define('FORCE_SSL_LOGIN', true);

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
