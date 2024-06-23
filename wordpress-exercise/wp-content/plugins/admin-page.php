<?php
/*
Plugin Name: Custom Admin Page
Description: Creates a plugin for custom admin page in WP-Admin.
Version: 1.0
Author: Purva
*/

//to register custom admin page
function custom_admin_page(){
    add_menu_page(
        'Admin page', // Page title
        'Admin page', // Menu title
        'manage_options', //options for access
        'admin_page', //Menu slug
        'admin_page_content', //Callback function to display content
        'dashicons-edit-page',
        59,  //position above appearance
    );
}
add_action('admin_menu', 'custom_admin_page');

function admin_page_content(){
    ?>
	<div class="wrap">
        <h1>Welcome to the Custom Admin Page</h1>
        <p>The plugin for creating admin page is activated. This is admin page content.</p>
	</div>
	<?php
    
}
