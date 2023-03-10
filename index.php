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
			get_template_part( 'template-parts/content', 'player' );
		?>
	</div><!-- /.col -->

	<div class="col-md-12">
		<?php
			get_template_part( 'template-parts/content', 'games' );
		?>
	</div><!-- /.col -->

	<div class="col-md-12">
		<?php
			get_template_part( 'template-parts/content', 'trophies' );
		?>
	</div><!-- /.col -->

</div><!-- /.row -->
<?php
get_footer();
