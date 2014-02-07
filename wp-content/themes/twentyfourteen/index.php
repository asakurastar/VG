<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<div id="main-content" class="main-content">

<?php
	if ( is_front_page() && twentyfourteen_has_featured_posts() ) {
		// Include the featured content template.
		get_template_part( 'featured-content' );
	}
?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

		<?php
			if ( have_posts() ) :
				// Start the Loop.
				while ( have_posts() ) : the_post();

					/*
					 * Include the post format-specific template for the content. If you want to
					 * use this in a child theme, then include a file called called content-___.php
					 * (where ___ is the post format) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );

				endwhile;
				// Previous/next post navigation.
				twentyfourteen_paging_nav();

			else :
				// If no content, include the "No posts found" template.
				get_template_part( 'content', 'none' );

			endif;
		?>

			<div>
				<input type="text" name="search" />
				<div id="result"></div>
			</div>
		</div><!-- #content -->

	</div><!-- #primary -->
	<?php get_sidebar( 'content' ); ?>
</div><!-- #main-content -->

<script type="text/javascript">
(function($) {
	$(function() {
		var timer;
		$('input[name=search]').on('keyup', function() {
			var $me = $(this);

			if (timer) { clearTimeout(timer); }

			timer = setTimeout(function() {
				if ( '' != $me.val() ) {
					$('#result').html('');

					$.get('wp-admin/admin-ajax.php', { action : 'cursos', search : $me.val() }, function(data) {
						if (data) {
							var txt = '';
							$.each( data, function(k, v) {
								txt += k + " (" + data[ k ].length + ") <br />";
								if ( typeof(v) == "object" ) {
									$.each(v, function( x, y ) {
										t = ( '' != y.titulacao ) ? '[' + y.titulacao + ']' : '';
										txt += "&nbsp;&nbsp;&nbsp;" + y.title + " " + t + "<br />";
									});
								}
							});
							$('#result').html( txt );
						}
					}, 'json');
				}
			}, 1000);
		});
	});
})(jQuery);
</script>

<?php
get_sidebar();
get_footer();
