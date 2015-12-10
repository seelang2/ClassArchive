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
define('DB_NAME', 'tc8852');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'xampp');

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
define('AUTH_KEY',         '{?SF{i5;+-ZPcvw#Ityow[GuGu3ZaN6F|VTHd4uh1=+|uO/q})+/F;Pw#NGwuK=:');
define('SECURE_AUTH_KEY',  'K|-#Os /l`X%YlTMz0kAf_./!<qv+Ck+0I9{[Ze.|h~J8,wP|U|C.W{l~;#`i}6V');
define('LOGGED_IN_KEY',    ']s. ,HC<FCJ3{vmyQ fNZoq%[RiTgi-mL:_|[8}4C6IJ57c,Q!+E#|XH+j0|E<P#');
define('NONCE_KEY',        'XJ+bJf|(!8O|~5M*R%:7i!X}ciT8DzT<Ds76+$E4<X#L:R#:4z]J.5^>J7>I>P;)');
define('AUTH_SALT',        'kG#Cd@P5P+{/n}7!~4m{VJr[}1<[d?B@tJTKRDcNftKt?hr)!z4)C+T~-#!R}|!o');
define('SECURE_AUTH_SALT', 'Nr;~W:c,T||;2U#t88z@o M`<Bsu-C(K1BKY|2{M?cDtCD`!oZl_izR}nQ {C{L&');
define('LOGGED_IN_SALT',   '>,DD.khmF;R%^z*9+v jwoF8WpA1%*Ak]HFXuI*?|TQo`s6v@k|lTx,Wr|FoXU)t');
define('NONCE_SALT',       '/U/j#gj-?=X|n+FWR8rhYgJpf7L}(SE=OcDgk?<(>Ub8Z[>]1o/U=%0c@NXUFc0U');

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
