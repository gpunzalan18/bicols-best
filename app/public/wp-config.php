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
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'I7l15dHoT0ib0VzmN/fX+50kfSP3Zoi9JXMjvEEFoerAtkFoT+MZ/gFUMzgp1dy6nbDOqWtlHqQ8S+avpUCVpg==');
define('SECURE_AUTH_KEY',  'L/IeqBC4WW9flxm+qSq6Uyl5mDKDSujQUASiEeBFo8EPxSwg8N8JfNde1j1RWMGxHtxAF7jWv7pxm4fxsNW2cw==');
define('LOGGED_IN_KEY',    'a1PlhYeyfku9VNiEd6za49xIXix4X6zkM6McEttnE+H4mobemIGhaQjqfPVDKavgv9R4gvgCc7YbofSKChjKmQ==');
define('NONCE_KEY',        'YK8apm2s5cqaS9BU8tfwG+FBmuqELSoWdIheaBM0i5zcDqS86bySTIPlcu0N689qMf/YjAQkLWOpS14bML4O8w==');
define('AUTH_SALT',        '2qrmuCI87IQDxFOyA/y7O9MzWXbjCXaKf1kglbUX0j9GJDpG5Z+kZoHRvU6uRsx+LpR4BRUtjkvtG0RXeb6OAw==');
define('SECURE_AUTH_SALT', 'wpNDKO9edALhfXgyNFaWpQ25+D/j0cYvSui36ZhFbsvte8x4NyhfebPvNbi6a5JCvlgqaPvtjoLfH3ryER8yyw==');
define('LOGGED_IN_SALT',   'UUxSXfe5tfL4d2XUatQLny0edj5UcctwOqEupBPXhpj7Jl3zlj7U0fA6nhyCFPndSpJS5SLSbObgu/zw8XdKpA==');
define('NONCE_SALT',       '3RM8gegCSd29GM2/L2vEui6O49d2ZqspppgWZW/fshBhAAETBxVeGw30DZupzfqWyef6KkF++H1cSMtw/vg+Eg==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
