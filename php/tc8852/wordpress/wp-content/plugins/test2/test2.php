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
http://codex.wordpress.org/Function_Reference/is_admin


Sample WP_Query object:
WP_Query Object
(
    [query] => Array
        (
            [post_type] => post
            [posts_per_page] => 20
        )

    [query_vars] => Array
        (
            [post_type] => post
            [posts_per_page] => 20
            [error] => 
            [m] => 
            [p] => 0
            [post_parent] => 
            [subpost] => 
            [subpost_id] => 
            [attachment] => 
            [attachment_id] => 0
            [name] => 
            [static] => 
            [pagename] => 
            [page_id] => 0
            [second] => 
            [minute] => 
            [hour] => 
            [day] => 0
            [monthnum] => 0
            [year] => 0
            [w] => 0
            [category_name] => 
            [tag] => 
            [cat] => 
            [tag_id] => 
            [author] => 
            [author_name] => 
            [feed] => 
            [tb] => 
            [paged] => 0
            [comments_popup] => 
            [meta_key] => 
            [meta_value] => 
            [preview] => 
            [s] => 
            [sentence] => 
            [fields] => 
            [menu_order] => 
            [category__in] => Array
                (
                )

            [category__not_in] => Array
                (
                )

            [category__and] => Array
                (
                )

            [post__in] => Array
                (
                )

            [post__not_in] => Array
                (
                )

            [tag__in] => Array
                (
                )

            [tag__not_in] => Array
                (
                )

            [tag__and] => Array
                (
                )

            [tag_slug__in] => Array
                (
                )

            [tag_slug__and] => Array
                (
                )

            [post_parent__in] => Array
                (
                )

            [post_parent__not_in] => Array
                (
                )

            [author__in] => Array
                (
                )

            [author__not_in] => Array
                (
                )

        )

    [tax_query] => WP_Tax_Query Object
        (
            [queries] => Array
                (
                )

            [relation] => AND
            [table_aliases:protected] => Array
                (
                )

            [queried_terms] => Array
                (
                )

            [primary_table] => 
            [primary_id_column] => 
        )

    [meta_query] => 
    [date_query] => 
    [post_count] => 0
    [current_post] => -1
    [in_the_loop] => 
    [comment_count] => 0
    [current_comment] => -1
    [found_posts] => 0
    [max_num_pages] => 0
    [max_num_comment_pages] => 0
    [is_single] => 
    [is_preview] => 
    [is_page] => 
    [is_archive] => 
    [is_date] => 
    [is_year] => 
    [is_month] => 
    [is_day] => 
    [is_time] => 
    [is_author] => 
    [is_category] => 
    [is_tag] => 
    [is_tax] => 
    [is_search] => 
    [is_feed] => 
    [is_comment_feed] => 
    [is_trackback] => 
    [is_home] => 
    [is_404] => 
    [is_comments_popup] => 
    [is_paged] => 
    [is_admin] => 1
    [is_attachment] => 
    [is_singular] => 
    [is_robots] => 
    [is_posts_page] => 
    [is_post_type_archive] => 
    [query_vars_hash:WP_Query:private] => 7e2d8b3567cf41112b5d8a2040319f2f
    [query_vars_changed:WP_Query:private] => 
    [thumbnails_cached] => 
    [stopwords:WP_Query:private] => 
    [compat_fields:WP_Query:private] => Array
        (
            [0] => query_vars_hash
            [1] => query_vars_changed
        )

    [compat_methods:WP_Query:private] => Array
        (
            [0] => init_query_flags
            [1] => parse_tax_query
        )

)



*/

function do_stuff( $query ) {

	// is_admin() is used to only affect the admin section, not the front end
	if ( $query->is_main_query() && is_admin() ) {
		$args = array(
			array(
				'taxonomy' => 'wpdmcategory',
				'field'    => 'term_id',
				'terms'    => array(3, 4)
			)
		);
		$query->set('tax_query', $args);
		//echo '<pre>'.print_r($query,true).'</pre>';
    }

}


add_action( 'pre_get_posts', 'do_stuff' );

?>