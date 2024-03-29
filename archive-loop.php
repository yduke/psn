<?php
/**
 * The template for displaying the archive loop.
 */

psn_content_nav( 'nav-above' );
$post_type= get_post_type();
if ( $post_type=='psn_trophy' ){
	?>
		<div class="row">
			<div class="col-md-12">
				<div class="list-group w-auto mb-5">
					<?php
						while ( have_posts() ) :
							the_post();
								get_template_part( 'template-parts/content', 'psn_trophies-list' );
						endwhile;
					?>
				</div>
			</div>
		</div>
	<?php
}elseif ( $post_type=='stm_trophy'){
	?>
		<div class="row">
			<div class="col-md-12">
				<div class="list-group w-auto mb-5">
				<?php
					while ( have_posts() ) :
						the_post();
							get_template_part( 'template-parts/content', 'steam_achievements-list' );
					endwhile;
				?>
				</div>
			</div>
		</div>
	<?php
}elseif ( $post_type=='dk_log'){
	?>
		<div class="row">
			<div class="col-md-12">
				<div class="list-group  w-auto mb-5">
				<?php
					while ( have_posts() ) :
						the_post();
							get_template_part( 'template-parts/content', 'dk_log' );
					endwhile;
				?>
				</div>
			</div>
		</div>
	<?php
}else{
	?>
		<div class="row row-cols-2 row-cols-sm-2 row-cols-md-5 g-4">
		<?php
			while ( have_posts() ) :
				the_post();
					get_template_part( 'content', 'index' ); // Post format: content-index.php
			endwhile;
		?>
		</div>
	<?php
}

wp_reset_postdata();

psn_content_nav( 'nav-below' );
