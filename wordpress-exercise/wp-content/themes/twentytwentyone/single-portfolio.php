<?php
/**
 * The template for displaying all single posts in portfolio projects
 *
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */


get_header();

if ( have_posts() ) :
    while ( have_posts() ) : 
        the_post();
    
    ?>
    <article>
        <header class="page-header alignwide">
            <h2><?php the_title(); ?></h2>
            <div class="portfolio-content">
                <?php the_excerpt(); ?>
                <?php the_post_thumbnail(); ?>
                <?php the_content(); ?> 

                <div class="portfolio-meta">
                    <span class="portfolio-date"><?php the_date(); ?></span>
                    <br>
                    <span class="post-taxonomies"><?php the_terms( get_the_ID(), 'project_type', 'Project Type: ', ', ' ); ?></span>
                    <span class="post-taxonomies"><?php the_terms( get_the_ID(), 'project_category', 'Project Category: ', ', ' ); ?></span>
                    <br>
                    <span class="portfolio-client">Project Client: <?php echo get_post_meta( get_the_ID(), 'portfolio_client', true ); ?></span>
                </div>
            </div>
        </header>

    </article>
    <?php 
    endwhile;

else :
    echo 'Project not found.';

endif;

get_footer();
?>
