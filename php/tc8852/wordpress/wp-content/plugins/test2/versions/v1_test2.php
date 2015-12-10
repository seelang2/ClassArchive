<?php
/*
Plugin Name: Test2
Description: This is just a test plugin. It does somewhat little. Enjoy.
Author: Chris Langtiw
Version: 0.1
Author URI: http://www.sitebabble.com
*/
/*
ref:
http://codex.wordpress.org/Plugin_API/Action_Reference/pre_get_posts

*/

function do_stuff( $query ) {


/*
*/
	if ( $query->is_main_query() ) {
        //$query->set( 'cat', '3' );
		//$query->set('category__in', array(3));
		//$query->set('category__name', 'testcategory');
		/*
		$query->set('tax_query', array(
			'taxonomy' => 'wpdmcategory',
			'terms' => 3
		));
		*/
		/*
		$args = array(
			'post_type' => 'wpdmpro',
			'tax_query' => array(
				array(
					'taxonomy' => 'wpdmcategory',
					'field'    => 'term_id',
					'terms'    => 3,
				),
			),
		);
		$query = new WP_Query( $args );
		echo '<pre>'.print_r($query,true).'</pre>';
		*/
		$args = array(
			array(
				'taxonomy' => 'wpdmcategory',
				'field'    => 'term_id',
				'terms'    => 3,
			)
		);
		$query->set('tax_query', $args);
		//echo '<pre>'.print_r($query,true).'</pre>';
    }

}


add_action( 'pre_get_posts', 'do_stuff' );

?>