<?php $post_id=get_the_ID();?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


<header class="entry-header">
    <div class="my-5 text-center">
            <?php if ( has_post_thumbnail() ) :
                    echo '<div class="post-thumbnail">' . get_the_post_thumbnail( $post_id, 'medium',  array('class' => 'bg-secondary bg-opacity-25')) . '</div>';
            endif; ?>
        <h2 class="display-5 fw-bold"><?php
                      $type = get_post_meta($post_id,'type',true);
                      if($type){ ?>
                <img src="<?php echo get_template_directory_uri();?>/assets/img/<?php echo $type;?>.png" alt="<?php echo $type;?>">
                <?php } 
        the_title(); ?></h2>
        <p class="lead mb-4">
            <?php the_excerpt();?>
        </p>
        <div class="entry-meta">
            <?php echo
                __('Earned on','psn').' '
                .esc_attr( get_the_date() . ' - ' . get_the_time() )
                .' '.__('by','psn').' '
                .get_option('psn_player_id');
                ?>
        </div><!-- /.entry-meta -->
    </div>
</header><!-- /.entry-header -->
<div class="entry-content">
<h5 ><?php _e('From Game','psn');?></h5>

        <div class="row mb-3">
          <div class="col-md-3 text-center">
          <?php $terms = get_the_terms( $post->ID, 'trophy_groups' );
                $term_id = $terms[0]->term_id ?? '';
                $term_name = $terms[0]->name ?? '';
                $attachment_id = get_term_meta($term_id)["local_iconUrl"] ?? '';
                $term_cover = wp_get_attachment_image_src( $attachment_id[0], 'thumbnail')[0] ?? '';
                $progress = get_term_meta( $term_id, 'progress', true);
          ?>
          <img class="rounded-3" src="<?php echo $term_cover; ?>" >
          </div>
          <div class="col-md-9">
            <div class="row">
              <h3><?php echo $term_name; ?></h3>
            </div>
          <div class="row">
            <div class="col-3  pb-3"><img src="<?php echo get_template_directory_uri();?>/assets/img/platinum.png" alt="platinum" width="20"> <?php echo get_term_meta( $term_id, 'earnedTrophiesPlatinumCount', true);?></div>
            <div class="col-3 pb-3"><img src="<?php echo get_template_directory_uri();?>/assets/img/gold.png" alt="gold" width="20"> <?php echo get_term_meta( $term_id, 'earnedTrophiesGoldCount', true).'/'.get_term_meta( $term_id, 'goldTrophyCount', true);?></div>
            <div class="col-3 pb-3"><img src="<?php echo get_template_directory_uri();?>/assets/img/silver.png" alt="silver" width="20"> <?php echo get_term_meta( $term_id, 'earnedTrophiesSilverCount', true).'/'.get_term_meta( $term_id, 'silverTrophyCount', true);?></div>
            <div class="col-3 pb-3"><img src="<?php echo get_template_directory_uri();?>/assets/img/bronze.png" alt="bronze" width="20"> <?php echo get_term_meta( $term_id, 'earnedTrophiesBronzeCount', true).'/'.get_term_meta( $term_id, 'bronzeTrophyCount', true);?></div>
          </div>
          <p><?php _e('Trophy Progress','psn');?></p>
          <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="<?php echo $progress; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $progress; ?>%"><?php echo $progress; ?>%</div>
          </div>
          </div>
        </div>

</div><!-- /.entry-content -->

<?php
    edit_post_link( __( 'Edit', 'psn' ), '<span class="edit-link">', '</span>' );
?>


</article><!-- /#post-<?php the_ID(); ?> -->