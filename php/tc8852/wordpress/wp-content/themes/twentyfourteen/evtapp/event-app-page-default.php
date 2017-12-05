<?php
/*
This setup allows us to use the content in the Wordpress CMS for the page instead 
of simply disregarding it.

*/
while ( have_posts() ) : the_post();
	// Page thumbnail and title.
	twentyfourteen_post_thumbnail();
	the_title( '<header class="entry-header"><h1 class="entry-title">', '</h1></header><!-- .entry-header -->' );

	the_content();

endwhile;
	
?>