<?php
/**
 * Template Name: Blog Index
 * Description: The template for displaying the Blog index /blog.
 *
 */

get_header();

// $page_id = get_option( 'page_for_posts' );
?>
<div class="row">

	<div class="col-md-12">
		<?php
			get_template_part( 'template-parts/content', 'player-psn' );
		?>
	</div><!-- /.col -->

	<div class="col-md-12">
		<?php
			get_template_part( 'template-parts/content', 'psn_games' );
		?>
	</div><!-- /.col -->

	<div class="col-md-12 mt-5">
		<?php
			get_template_part( 'template-parts/content', 'psn_trophies' );
		?>
	</div><!-- /.col -->

	<div class="col-md-12 mt-5">
		<?php
			get_template_part( 'template-parts/content', 'player-steam' );
		?>
	</div><!-- /.col -->
	<div class="col-md-12">
		<?php
			get_template_part( 'template-parts/content', 'steam_games' );
		?>
	</div><!-- /.col -->

	<div class="col-md-12 mt-5">
		<?php
			get_template_part( 'template-parts/content', 'steam_achievements' );
		?>
	</div><!-- /.col -->

</div><!-- /.row -->
<?php
get_footer();
