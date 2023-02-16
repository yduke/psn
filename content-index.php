<?php
/**
 * The template for displaying content in the index.php template.
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'col px-1 mt-3' ); ?>>
	<div class="card shadow-sm">
		<div class="bg-secondary bg-opacity-25 bg-gradient">
				<?php if ( has_post_thumbnail() ) { the_post_thumbnail('medium', array('class' => 'card-img-top'));  } ?>
				</div>
            <div class="card-body">
				<h2 class="card-title fs-6"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'psn' ), the_title_attribute( array( 'echo' => false ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
              	<div class="card-text small">
					<?php
					$post_type= get_post_type();
					if($post_type=='psn_game'){
						$terms = get_the_terms( get_the_ID(), 'game_publishers' ); 
						if($terms){
							echo $terms[0]->name;
						}
					}elseif($post_type=='psn_trophy'){
						$terms = get_the_terms( $post->ID, 'trophy_groups' );$term_id = $terms[0]->term_id ?? '';$term_name = $terms[0]->name ?? ''; echo $term_name;
					}
					?>
				</div>
              	<div class="d-flex justify-content-between align-items-center">
			  		<div class="btn-group mt-2">
					  <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-sm"><?php _e('View','psn'); ?></a>
                	</div>
                	<small class="text-muted"><?php echo esc_html( human_time_diff( get_the_time('U'), current_time('timestamp') ) ) . __(' ago','psn'); ?></small>
              	</div>
            </div>
	</div><!-- /.col -->
</article><!-- /#post-<?php the_ID(); ?> -->
