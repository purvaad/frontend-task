<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();

$description = get_the_archive_description();
?>

<?php if ( have_posts() ) : ?>

    <header class="page-header alignwide">
        <?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
        <?php if ( $description ) : ?>
            <div class="archive-description"><?php echo wp_kses_post( wpautop( $description ) ); ?></div>
        <?php endif; ?>
    </header> <!-- .page-header -->

<main id="archive">
        <div class="portfolio-grid">
            <?php while ( have_posts() ) : the_post(); ?>
            <article <?php post_class('portfolio-item'); ?>>
                <div class="post-header alignwide">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail">
                            <?php the_post_thumbnail(); ?>
                        </div>
                    <?php endif; ?>
                    <div class="post-content">
                        <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div class="post-taxonomies">
                            <?php the_terms(get_the_ID(), 'project_type', 'Project Type: ', ', '); ?>
                            <?php the_terms(get_the_ID(), 'project_category', 'Project Category: ', ', '); ?>
                        </div>
						<div class="post-description">
                        <?php the_excerpt(); ?>
                    </div>
                    </div>
            </div>
            </article>
            <?php endwhile; ?>
        </div>
        <div class="portfolio-pagination">
            <?php echo paginate_links(); ?>
        </div>
</main>

<?php else : ?>
    <?php get_template_part( 'template-parts/content/content-none' ); ?>
<?php endif; ?>

<?php
get_footer();
?>