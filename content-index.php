<?php
/**
 * The template for displaying content in the index.php template.
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'col px-1 mt-3' ); ?>>
	<div class="card shadow-sm">
		<div class="bg-secondary bg-opacity-25 bg-gradient">
				<?php
				if( $post_type=='steam_game'){
					$steamdeck_status = get_post_meta($post->ID,'steamdeck_status',true);
					if($steamdeck_status !=''){
						echo '<span class="badge rounded-pill text-bg-dark position-absolute top-0 end-0">';
					  if($steamdeck_status == 3){
						echo '<svg class="icon fs-2 " aria-hidden="true"><use xlink:href="#icon-verified"></use></svg>';
					  }elseif($steamdeck_status == 2){
						echo '<svg class="icon fs-2" aria-hidden="true"><use xlink:href="#icon-info"></use></svg>';
					  }elseif($steamdeck_status == 1){
						echo '<i class="iconfont icon-stop text-white fs-2"></i>';
					  }elseif($steamdeck_status == 0){
						echo '<i class="iconfont icon-question fs-2"></i>';
					  }
					  echo "</span>";
					}
					$img_lib = get_post_meta( $post->ID, 'img_library', true );
					if($img_lib){
					?>
					<img loading="lazy" src="<?php echo $img_lib; ?>" class="card-img-top">
					<?php
					}else{
						if ( has_post_thumbnail() ) { the_post_thumbnail('medium', array('class' => 'card-img-top'));  };
					}
				}else{
					if ( has_post_thumbnail() ) { the_post_thumbnail('medium', array('class' => 'card-img-top'));  }
				}
				?>
				</div>
            <div class="card-body">
				<h2 class="card-title fs-6 text-truncate"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'psn' ), the_title_attribute( array( 'echo' => false ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
              	<div class="card-text small text-truncate">
					<?php
					$post_type= get_post_type();
					if($post_type=='psn_game' OR $post_type=='steam_game'){
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

                	<small class="text-muted"><?php
					if($post_type=='steam_game' && get_the_time('U') == 1041408000){
						_e('Never Played','psn');
					}else{
						echo esc_html( human_time_diff( get_the_time('U'), current_time('timestamp') ) ) . __(' ago','psn');
					}
					?></small>
              	</div>
            </div>
	</div><!-- /.col -->
</article><!-- /#post-<?php the_ID(); ?> -->
