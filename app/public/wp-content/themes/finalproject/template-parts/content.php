<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package finalproject
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if (is_singular()) :
			the_title('<h1 class="entry-title">', '</h1>');
		else :
			the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
		endif;
		?>
		<?php
		if ('post' === get_post_type()) :
		?>
			<div class="entry-meta">
				<?php
				echo "saya";
				finalproject_posted_on();
				finalproject_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php elseif ('event' === get_post_type()) : ?>
			<div class="entry-meta-event">
				<?php
				echo '<span class="location">' . get_field('location', get_the_ID()) . '</span>';
				echo '<span> | </span>';
				echo '<span class="dates">' . get_the_date() . '</span>';
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php finalproject_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'finalproject'),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post(get_the_title())
			)
		);
		echo do_shortcode('[layout layout_id="256"]');
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__('Pages:', 'finalproject'),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->
	<section class="latest-from-blog">
		<p>Travel Blog</p>
		<h2>Latest from our Blog</h2>
		<?php echo do_shortcode('[listing post_type="post" posts_per_page="4" orderby="date" order="DESC"]'); ?>
	</section>
	<footer class="entry-footer">
		<?php finalproject_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->