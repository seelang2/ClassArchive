<?php
/**
 * Template Name: Event App
 *
 */

get_header(); 

// import WP db object for later use
global $wpdb;

?>

<style type="text/css">
.evt-list {
	border: 1px solid #ccc;
}

.evt-list ul {
	list-style-type: none;
	margin: 0;
	padding: 0;
}

.evt-list li {
	padding: 0.5em 1em;
	border-bottom: 1px solid #ccc;
	
}
.evt-list li:last-child {
	border-bottom: none;
}

.evt-list li span {
	display: inline-block;
	margin-right: 1em;
}

.evt-list li button {
	display: inline-block;
}

form label, form div {
	display: block;
	margin-bottom: 0.5em;
}

form span,
form input,
form select {
	display: inline-block;
}

form label span:first-child,
form div span:first-child {
	width: 7em;
}
</style>



<div id="main-content" class="main-content">
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<!-- Because we're disregarding the CMS content, the content needs to be put directly in the template HTML. -->
			<?php
			// retrieve requested view or the default view
			$view = empty($_GET['view']) ? 'default' : strtolower($_GET['view']);
			get_template_part( 'evtapp/event-app-page', $view );
			?>
		</div><!-- #content -->
	</div><!-- #primary -->
	<?php get_sidebar( 'content' ); ?>
</div><!-- #main-content -->

<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/evtapp/evtapp.js"></script>
<?php
get_sidebar();
get_footer();
