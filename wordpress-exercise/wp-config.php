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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'training_purvad' );

/** Database username */
define( 'DB_USER', 'training_purvad' );

/** Database password */
define( 'DB_PASSWORD', 'EDFusc9uZg0Sp5jq' );

/** Database hostname */
define( 'DB_HOST', '172.104.166.158' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          '^HgZz$6)GUMo<xJkaqeVBeA.j(WO%RFLOf-qcj4~looo)FS>ZhLA+$)2VByP)9]S' );
define( 'SECURE_AUTH_KEY',   '^=vSxJ+JaM1PD@JWmIRA29p7UZgI^X |e9N)[G<NnER)t98IHHIzQh.Mc=C5Aoz7' );
define( 'LOGGED_IN_KEY',     '$yS*fGr]|pl8Lda_V_lGWfItCKjCDz#GX0&E1K35cZLsGp?yAmpC8/wbr+:eS}?6' );
define( 'NONCE_KEY',         'RhF=upgLwTvapc71n#13~{O]W}TOXqZx!|Zwk<o7kCE^%`lH6{i /wk2m}!h&~[9' );
define( 'AUTH_SALT',         'v.bWe6On/>7>OK$]vl jjj=LGsl$TAs$cwSd$LJA!SnlGp8C8UXVDAiwX^~(x@{q' );
define( 'SECURE_AUTH_SALT',  '}uf=aC-[9DC?QQ*&k4+naCm{B1Oc<7/V`a5D41QPjh!+qp5)S2<vE@BAVz8:#%To' );
define( 'LOGGED_IN_SALT',    '4YSAi:F(WX=VuK?u4R&>tY,Kdu%jfd02$;!o!qvtXwR>*FnHSY(nq007Koexp)%g' );
define( 'NONCE_SALT',        '*hV--)DA`;L&N{@Sx;Hy_bwI 6clL@Ep/2<hJ]`u&`h :, `r,FS+oz*blh(Om5S' );
define( 'WP_CACHE_KEY_SALT', 'p;q^JiIBu`:4/<U!A:ny2M[3:wih&WR|n;C6MrPD>:k9ek1(Jn0~Tj#+HOxJH10>' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'ex1_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
    define( 'WP_DEBUG', true );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

