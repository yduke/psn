<?php
/**
 * The Template for displaying Archive pages.
 */

get_header();

if ( have_posts() ) :
?>
<header class="page-header container">
	<h1 class="page-title">
		<?php
					if($post_type=='psn_game'){
						_e('Recent PlayStation Games','psn');
					}elseif($post_type=='psn_trophy'){
						_e('Recent PlayStation Trophies','psn');
					}elseif($post_type=='steam_game'){
						_e('Recent Steam Games','psn');
					}elseif($post_type=='stm_trophy'){
						_e('Recent Steam Achievements','psn');
					}elseif($post_type=='dk_log'){
						_e('Activity logs','psn');
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
					if(is_tax('game_genres') || is_tax('stm_game_genres')){
						$taxonomy = get_queried_object();
						_e('Genre','psn');
						echo  ': '.$taxonomy->name;
					}elseif(is_tax('trophy_groups')){
						$taxonomy = get_queried_object();
						echo  $taxonomy->name;
					}elseif(is_tax('game_publishers')){
						$taxonomy = get_queried_object();
						_e('Publisher','psn');
						echo  ': '.$taxonomy->name;
					}elseif(is_tax('game_developers')){
						$taxonomy = get_queried_object();
						_e('Developer','psn');
						echo  ': '.$taxonomy->name;
					}elseif(is_tax('game_platforms')){
						$taxonomy = get_queried_object();
						_e('Platform','psn');
						echo  ': '.$taxonomy->name;
					}elseif(is_tax('game_langs')){
						$taxonomy = get_queried_object();
						_e('Language support','psn');
						echo  ': '.$taxonomy->name;
					}elseif(is_tax('stm_game_cat')){
						$taxonomy = get_queried_object();
						_e('Game category','psn');
						echo  ': '.$taxonomy->name;
					}elseif(is_tax('game_spo_langs')){
						$taxonomy = get_queried_object();
						_e('Voice Language','psn');
						echo  ': '.$taxonomy->name;
					}elseif(is_tax('game_langs')){
						$taxonomy = get_queried_object();
						_e('Language','psn');
						echo  ': '.$taxonomy->name;
					}
		?>
	</h1>
</header>
<div class="container">
<?php
	get_template_part( 'archive', 'loop' );
else :
	// 404.
	get_template_part( 'content', 'none' );
endif;

wp_reset_postdata(); // End of the loop.
?>
</div>
<?php
get_footer();

