<?php
/* Template Name: Custom Archive Post Template */

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package finalproject
 */

get_header();
?>

<main id="primary" class="site-main archive">

	<?php if (have_posts()) : ?>

		<header class="page-header">
			<?php
			the_archive_title('<h1 class="page-title">', '</h1>');
			the_archive_description('<div class="archive-description">', '</div>');
			?>
		</header><!-- .page-header -->

		<div class="filter-form">
			<?php echo do_shortcode('[filter]'); ?>
		</div>
		<!-- animasi loading -->
		<div class="sk-fading-circle" style="display: none;">
			<div class="sk-circle1 sk-circle"></div>
			<div class="sk-circle2 sk-circle"></div>
			<div class="sk-circle3 sk-circle"></div>
			<div class="sk-circle4 sk-circle"></div>
			<div class="sk-circle5 sk-circle"></div>
			<div class="sk-circle6 sk-circle"></div>
			<div class="sk-circle7 sk-circle"></div>
			<div class="sk-circle8 sk-circle"></div>
			<div class="sk-circle9 sk-circle"></div>
			<div class="sk-circle10 sk-circle"></div>
			<div class="sk-circle11 sk-circle"></div>
			<div class="sk-circle12 sk-circle"></div>
		</div>
		<div class="listing-wrapper archive-listing-wrapper">
		<?php
		/* Start the Loop */
		while (have_posts()) :
			the_post();
			/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
			get_template_part('template-parts/content-archive', get_post_type());

		endwhile;

		the_posts_navigation();

	else :

		get_template_part('template-parts/content', 'none');

	endif;
		?>
		</div>
</main><!-- #main -->

<?php
get_sidebar();
get_footer();
