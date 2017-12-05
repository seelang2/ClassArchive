<?php
/**
 * Template Name: Event App
 *
 */

get_header(); ?>
<div id="main-content" class="main-content">
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<!-- Because we're disregarding the CMS content, the content needs to be put directly in the template HTML. -->
			<?php
			// retrieve requested view
			if (!empty($_GET['view'])) {
				get_template_part( 'evtapp/event-app-page', $_GET['view'] );
			}
			?>
		</div><!-- #content -->
	</div><!-- #primary -->
	<?php get_sidebar( 'content' ); ?>
</div><!-- #main-content -->
<?php
get_sidebar();
get_footer();
