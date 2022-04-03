<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bootcamp2
 */

?>

<footer id="colophon" class="site-footer">
	<div class="site-info">
		<?php echo do_shortcode("[layout layout_id=78]") ?>
	</div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>


</html>