<?php $post_id=get_the_ID();?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


<header class="entry-header">
<div class="my-5 text-center">
            <?php if ( has_post_thumbnail() ) :
                    echo '<div class="post-thumbnail">' . get_the_post_thumbnail( $post_id, 'medium' ) . '</div>';
            endif; ?>
        <h2 class="display-5 fw-bold"><i class="iconfont icon-playstation size-m"></i> <?php the_title(); ?></h2>
        <div class="entry-meta">
                <?php
                    $terms = get_the_terms( $post->ID, 'game_publishers' ); 
                    if ($terms) {
                    echo '<p><span class="inc"><a href="'. esc_url( get_term_link( $terms[0] )). '">'.$terms[0]->name.'</a></span></p>';
                    }
                echo
                __('Last Played on','psn').' '
                .esc_html( human_time_diff( get_the_time('U'), current_time('timestamp') ) ). __(' ago','psn')
                ?>
        </div><!-- /.entry-meta -->

    </div>
    <div class="text-center"><?php echo do_shortcode( '[yasr_visitor_votes]' );?></div>
    <?php
      $terms = get_the_terms( $post_id , 'game_genres' );
      if (is_array($terms)){
        foreach ( $terms as $term ) { 
              echo '<a href="'.get_term_link($term->slug, 'game_genres').'"><span class="badge text-bg-primary">'.$term->name.'</span></a> ';
        }
      }
      ?>

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
<?php if(has_term( '', 'trophy_groups' )){ ?>
  <h3><?php _e('Trophies','psn');?></h3>
  <div class="list-group w-auto mb-5">
    <?php
      $trophies_list = get_the_terms( $post_id, 'trophy_groups' );
      if (is_array($trophies_list)){
        $tg = reset($trophies_list);
        $t_slug = $tg->slug;
      }
        $query_meta = array(
          'post_type' => 'psn_trophy',
          'orderby' => 'post_date',
          'posts_per_page'=>'-1',
          'tax_query' => array(
            array(
                'taxonomy' => 'trophy_groups',
                'field' => 'slug',
                'terms' => $t_slug,
            ),
          ),
      );
      $trophies = new WP_Query( $query_meta );
      if($trophies->have_posts()){
        while ( $trophies->have_posts() ) {
          $trophies->the_post();
          $earned = get_post_meta(get_the_ID(),'earned',true);
          $t_color = get_post_meta(get_the_ID(),'type',true);
          ?>
          <a href="<?php the_permalink(); ?>" class="list-group-item list-group-item-action d-flex gap-3 py-3 <?php if($earned == '0'){echo 'grayscale';}?>" aria-current="true">
            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full'); ?>" alt="<?php the_title(); ?>" width="75" height="75" class="rounded-3 flex-shrink-0">
            <div class="d-flex gap-2 w-100 justify-content-between">
              <div>
                <h5 class="mb-0"><i class="iconfont icon-trophy <?php echo $t_color; ?>"></i><?php the_title(); ?></h5>
                <p class="mb-0 opacity-75"><?php the_excerpt(); ?></p>
              </div>
              <small class="opacity-50 text-nowrap"><?php if($earned == '1'){echo esc_html( human_time_diff( get_the_time('U'), current_time('timestamp') ) ) . __(' ago','psn'); }else{echo __('Unearned','psn'); }?></small>
            </div>
          </a>
                            <?php
        }
      }
    ?>
  </div>

<?php } ?>


</div><!-- /.entry-content -->

<?php
    edit_post_link( __( 'Edit', 'psn' ), '<span class="edit-link">', '</span>' );
?>


</article><!-- /#post-<?php the_ID(); ?> -->