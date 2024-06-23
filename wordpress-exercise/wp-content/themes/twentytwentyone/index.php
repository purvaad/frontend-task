<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header(); ?>

<?php if ( is_home() && ! is_front_page() && ! empty( single_post_title( '', false ) ) ) : ?>
	<header class="page-header alignwide">
		<h1 class="page-title"><?php single_post_title(); ?></h1>
	</header><!-- .page-header -->
<?php endif; ?>

<?php

//custom WP_Query to display portfolio items
$portfolio_query = new WP_Query( array(
    'post_type' => 'portfolio',
    'posts_per_page' => 4, 
    
) );

if ( $portfolio_query->have_posts() ) :
    ?>
    <div class="portfolios">
        <h1>CLIENT PORTFOLIO</h1>

        <?php
        while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post();
            ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="post-header alignwide">
                        <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div class="post-description">
                        <?php the_excerpt(); ?>
                        <?php if (has_post_thumbnail()) : ?>
                        <div class="portfolio-thumbnail">
                            <?php the_post_thumbnail(); ?>
                        </div>
                    <?php endif; ?>

                    </div>
                </div>
                
            </article>
        <?php
        endwhile;
        ?>
    </div> 
    
    <?php
    wp_reset_postdata(); 
else :
    echo 'No portfolio items found.';
endif;

get_footer();
?>
