<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>

		<?php endwhile; // end of the loop. ?>
	
	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>
	
	<?php wc_get_template_part( 'content', 'single-product' ); ?>
		<!-- <form method="post" action="<?php //echo esc_url( admin_url('admin-post.php') ); ?>" class="inquiry-form">
    		<input type="hidden" name="action" value="product_inquiry">
    		<input type="hidden" name="product_id" value="<?php //echo get_the_ID(); ?>" >
			Email: </br>
			<input type="email" name="email" class="email" placeholder="Enter your email"></br>
			Contact: 
			<input type="text" name="contact" class="contact" placeholder="Enter your email">
    		Inquiry: </br>
			<textarea name="inquiry_msg" class="inquiry_msg" placeholder="Enter inquiry message..."></textarea></br>
    		<button type="submit">Submit Inquiry</button>
		</form> -->
	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
	?>
	

<?php
get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
