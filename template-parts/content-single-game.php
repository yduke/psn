<?php $post_id=get_the_ID();?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


<header class="entry-header">
<div class="my-5 text-center">
            <?php if ( has_post_thumbnail() ) :
                    echo '<div class="post-thumbnail">' . get_the_post_thumbnail( $post_id, 'medium' ) . '</div>';
            endif; ?>
        <h2 class="display-5 fw-bold"><?php the_title(); ?></h2>
        <div class="entry-meta">
                <?php
                    $terms = get_the_terms( $post->ID, 'game_publishers' ); 
                    if ($terms) {
                    echo '<p><span class="inc"><a href="'. esc_url( get_term_link( $terms[0] )). '">'.$terms[0]->name.'</a></span></p>';
                    }
                echo
                __('Last Played on','psn').' '
                .esc_attr( get_the_date() . ' - ' . get_the_time() )
                .' '.__('by','psn').' '
                .get_option('psn_player_id');
                ?>
        </div><!-- /.entry-meta -->

    </div>

</header><!-- /.entry-header -->
<div class="entry-content">
        <table class="table table-striped table-sm">
          <tbody>
            <tr>
              <td><?php _e('Name','psn');?></td>
              <td><?php echo get_post_meta($post_id,'game_localizedName',true);?></td>
            </tr>
            <tr>
              <td><?php _e('Platform','psn');?></td>
              <td><?php
               $platform = get_post_meta($post_id,'game_platform',true);
                if($platform == 'ps4_game'){
                    echo 'PlayStation 4';
                }elseif($platform == 'ps5_native_game'){
                    echo 'PlayStation 5';
                }elseif($platform == 'ps4_nongame_mini_app'){
                    echo 'PlayStation 4 APP';
                }elseif($platform == 'unknown' || $platform == ''){
                    echo __('Unknown','psn');
                }
               ?></td>
            </tr>
            <tr>
              <td><?php _e('Genre','psn');?></td>
              <td><?php
                          $taxonomy = 'game_genres';
                          $terms = get_object_term_cache( $post->ID, $taxonomy );
                          $output = '';
                          foreach($terms as $term) {
                              if(!empty($output))
                                  $output .= ' | ';
                                  $output .= '<span class="genre"><a href="'. esc_url( get_term_link( $term )). '">'.$term->name.'</a></span>';
                              }
                          echo $output;
              ?></td>
            </tr>
            <tr>
              <td><?php _e('Play Count','psn');?></td>
              <td><?php echo get_post_meta($post_id,'game_playCount',true);?></td>
            </tr>
            <tr>
              <td><?php _e('Play Duration','psn');?></td>
              <td><?php echo str_replace(['H','M','S'],[__('h', 'psn'),__('m', 'psn'),__('s', 'psn')], substr(get_post_meta($post_id,'game_playDuration',true),2));?></td>
            </tr>
            <tr>
              <td><?php _e('First Played On','psn');?></td>
              <td><?php echo get_post_meta($post_id,'game_firstPlayedDateTime_l',true);?></td>
            </tr>
            <tr>
              <td><?php _e('Last Played On','psn');?></td>
              <td><?php echo gmt_to_local(get_post_meta($post_id,'game_lastPlayedDateTime',true));?></td>
            </tr>
            <tr>
              <td><?php _e('Obtained from','psn');?></td>
              <td><?php
              $plus = get_post_meta($post_id,'game_service',true);
              if($plus == 'none(purchased)'){
                echo __('Purchased','psn');
              }elseif($plus == 'ps_plus'){
                echo '<img src="'.get_template_directory_uri().'/assets/img/plus.svg" width="20" height="20">';
              }
              ?></td>
            </tr>
          </tbody>
        </table>
        <?php if(get_the_content() !=''){ ?>
        <h3><?php _e('Description','psn')?></h3>
        <p class="lead mb-4"><?php
            the_content();
            wp_link_pages( array( 'before' => '<div class="page-link"><span>' . esc_html__( 'Pages:', 'psn' ) . '</span>', 'after' => '</div>' ) );
            ?></p>
            <?php } ?>
</div><!-- /.entry-content -->

<?php
    edit_post_link( __( 'Edit', 'psn' ), '<span class="edit-link">', '</span>' );
?>


</article><!-- /#post-<?php the_ID(); ?> -->