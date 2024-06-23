<?php
/**
 * Plugin Name:       FAQ
 * Description:       A dynamic Gutenberg block for FAQ section
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            purva
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       faq
 *
 * 
 * @package FaqBlock
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Include the render callback function
require_once(__DIR__ . '/src/render.php');

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */

function faq_block_faq_block_init() {
    register_block_type( __DIR__ . '/build', array(
        'render_callback' => 'render_faq_block',
    ) );
}
add_action( 'init', 'faq_block_faq_block_init' );
