<?php
/**
 * The Template for displaying Archive pages.
 */

get_header();

if ( have_posts() ) :
?>
<header class="page-header">
	<h1 class="page-title">
		<?php
					if($post_type=='psn_game'){
						_e('Recent PlayStation Games','psn');
					}elseif($post_type=='psn_trophy'){
						_e('Recent PlayStation Trophies','psn');
					}elseif($post_type=='post'){
					}elseif($post_type=='steam_game'){
						_e('Recent Steam Games','psn');
					}elseif($post_type=='post'){
						if ( is_day() ) :
							printf( esc_html__( 'Daily Archives: %s', 'psn' ), get_the_date() );
						elseif ( is_month() ) :
							printf( esc_html__( 'Monthly Archives: %s', 'psn' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'psn' ) ) );
						elseif ( is_year() ) :
							printf( esc_html__( 'Yearly Archives: %s', 'psn' ), get_the_date( _x( 'Y', 'yearly archives date format', 'psn' ) ) );
						else :
							esc_html_e( 'Archives', 'psn' );
						endif;
					}

		?>
	</h1>
</header>
<?php
	get_template_part( 'archive', 'loop' );
else :
	// 404.
	get_template_part( 'content', 'none' );
endif;

wp_reset_postdata(); // End of the loop.

get_footer();
