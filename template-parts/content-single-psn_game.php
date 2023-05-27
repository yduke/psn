<?php $post_id=get_the_ID();?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


<header class="entry-header">
<div class="my-5 text-center">
            <?php if ( has_post_thumbnail() ) :
                    echo '<div class="post-thumbnail">' . get_the_post_thumbnail( $post_id, 'medium' ) . '</div>';
            endif; ?>
        <h2 class="display-5 fw-bold">
          <i class="iconfont icon-playstation size-m"></i>
          <?php
                    $game_tittle_custom = get_post_meta($post_id,'game_tittle_custom',true);
                    $name_localized = get_post_meta($post_id,'game_localizedName',true);
                    if($game_tittle_custom){
                      echo $game_tittle_custom;
                    }else{
                      if($name_localized !='' && $name_localized != get_the_title()){
                        echo $name_localized;
                      }else{
                        the_title(); 
                      }
                    }
          ?>
        </h2>
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
    <div class="text-center"><?php if(function_exists('yasr_autoload_shortcodes')){ echo do_shortcode( '[yasr_visitor_votes]' ); } ?></div>
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
              <td><?php the_title();?></td>
            </tr>

            <?php 
            if(''!=$name_localized && $name_localized != get_the_title()){
              ?>
            <tr>
              <td><?php _e('Local Name','psn');?></td>
              <td><?php echo $name_localized; ?></td>
            </tr>
              <?php
            }
            ?>

            <?php 
            if(''!=$game_tittle_custom && $game_tittle_custom != get_the_title()){
              ?>
            <tr>
              <td><?php _e('Also known as','psn');?></td>
              <td><?php echo $game_tittle_custom; ?></td>
            </tr>
              <?php
            }
            ?>

            <?php $game_releaseDate = get_post_meta($post_id,'game_releaseDate',true); 
            if($game_releaseDate && !str_starts_with($game_releaseDate, '1970')){
              ?>
            <tr>
              <td><?php _e('Release Date','psn');?></td>
              <td style="width: 70%;">
              <?php 
                echo wp_date( get_option( 'date_format' ), strtotime($game_releaseDate));
              ?>
              </td>
            </tr>
            <?php
            }
            ?>

            <?php $game_platforms = get_the_terms( $post->ID, 'game_platforms' ); 
            if($game_platforms){
              ?>
            <tr>
              <td><?php _e('Platform available','psn');?></td>
              <td style="width: 70%;">
              <?php 
                  foreach ( $game_platforms as $game_platform ) { 
                    echo '<a href="'.get_term_link($game_platform->slug, 'game_platforms').'"><span class="badge text-bg-light">'.$game_platform->name.'</span></a>';
              }
              ?>
              </td>
            </tr>
            <?php
            }
            ?>

            <tr>
              <td><?php _e('Platform Played','psn');?></td>
              <td><?php
               $platform = get_post_meta($post_id,'game_platform',true);
                if($platform == 'ps4_game'){
                    echo 'PS4';
                }elseif($platform == 'ps5_native_game'){
                    echo 'PS5';
                }elseif($platform == 'ps4_nongame_mini_app'){
                    echo 'PS4 APP';
                }elseif($platform == 'unknown' || $platform == ''){
                    echo __('Unknown','psn');
                }
               ?></td>
            </tr>

            <?php $langs = get_the_terms( $post->ID, 'game_langs' ); 
            if($langs){
              ?>
            <tr>
              <td><?php _e('Languages','psn');?></td>
              <td style="width: 70%;">
              <?php 
                  foreach ( $langs as $lan ) { 
                    echo '<a href="'.get_term_link($lan->slug, 'game_langs').'"><span class="badge text-bg-light">'.$lan->name.'</span></a>';
              }
              ?>
              </td>
            </tr>
              <?php
            }
            ?>

            <?php $vlangs = get_the_terms( $post->ID, 'game_spo_langs' ); 
            if($vlangs){
              ?>
            <tr>
              <td><?php _e('Voice Languages','psn');?></td>
              <td style="width: 70%;">
              <?php 
                  foreach ( $vlangs as $lan ) { 
                    echo '<a href="'.get_term_link($lan->slug, 'game_spo_langs').'"><span class="badge text-bg-light">'.$lan->name.'</span></a>';
              }
              ?>
              </td>
            </tr>
              <?php
            }
            ?>

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
              <td><?php 
              $ftpd = get_post_meta($post_id,'game_firstPlayedDateTime_l',true );
              $ftp =date( 'Y-m-d H:i:s', strtotime( $ftpd ));
              echo esc_html( human_time_diff( strtotime($ftp, current_time('timestamp',true) ) )) . __(' ago','dk-psn');
              echo ' (' .date( get_option( 'date_format' ), strtotime( $ftpd )).')'; ?></td>
            </tr>
            <tr>
              <td><?php _e('Last Played On','psn');?></td>
              <td><?php $lpt =get_the_time(get_option( 'date_format' )); echo  esc_html( human_time_diff( get_the_time('U'), current_time('timestamp') ) ) . __(' ago','dk-psn');echo ' (' .$lpt.')'; ?></td>
            </tr>
            <tr>
              <td><?php _e('Obtained from','psn');?></td>
              <td><?php
              $plus = get_post_meta($post_id,'game_service',true);
              if($plus == 'none(purchased)'){
                echo __('Purchased','psn');
              }elseif($plus == 'ps_plus'){
                echo '<img loading="lazy" src="'.get_template_directory_uri().'/assets/img/plus.svg" width="20" height="20">';
              }
              ?></td>
            </tr>
          </tbody>
        </table>
        <?php if(get_the_content() !=''){ ?>
        <h3><?php _e('Description','psn')?></h3>
        <div class="mb-5"><?php
            the_content();
            wp_link_pages( array( 'before' => '<div class="page-link"><span>' . esc_html__( 'Pages:', 'psn' ) . '</span>', 'after' => '</div>' ) );
            ?></div>
            <?php
                edit_post_link( __( 'Edit', 'psn' ), '<span class="edit-link">', '</span>' );
            ?>
            <?php } ?>
<?php if(has_term( '', 'trophy_groups' )){  
        $terms = get_the_terms( $post->ID, 'trophy_groups' );
        $term_id = $terms[0]->term_id ?? '';
        $term_name = $terms[0]->name ?? '';
        $attachment_id = get_term_meta($term_id)["local_iconUrl"] ?? '';
        $term_cover = wp_get_attachment_image_src( $attachment_id[0], 'thumbnail')[0] ?? '';
        $progress = get_term_meta( $term_id, 'progress', true);
?>

  <h3><?php _e('Trophies','psn');?></h3>
  <?php if($progress=='100'){ ?>
            <div class="pyro">
              <div class="before"></div>
              <div class="after"></div>
            </div>
          <?php } ?>
  <div class="row mb-5">
          <div class="col-md-3 text-center">

          <img loading="lazy" class="rounded-3" src="<?php echo $term_cover; ?>" >
          </div>

          <div class="col-md-9">
            <div class="row text-center">
              <h3><?php echo $term_name; ?></h3>
            </div>
          <div class="row">
            <div class="col-3  pb-3"><i class="iconfont icon-trophy platinum size-normal-s"></i> <?php echo get_term_meta( $term_id, 'earnedTrophiesPlatinumCount', true);?></div>
            <div class="col-3 pb-3"><i class="iconfont icon-trophy gold size-normal-s"></i> <?php echo get_term_meta( $term_id, 'earnedTrophiesGoldCount', true).'/'.get_term_meta( $term_id, 'goldTrophyCount', true);?></div>
            <div class="col-3 pb-3"><i class="iconfont icon-trophy silver size-normal-s"></i> <?php echo get_term_meta( $term_id, 'earnedTrophiesSilverCount', true).'/'.get_term_meta( $term_id, 'silverTrophyCount', true);?></div>
            <div class="col-3 pb-3"><i class="iconfont icon-trophy bronze size-normal-s"></i> <?php echo get_term_meta( $term_id, 'earnedTrophiesBronzeCount', true).'/'.get_term_meta( $term_id, 'bronzeTrophyCount', true);?></div>
          </div>
          <p><?php _e('Trophy Progress','psn');?></p>
          <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="<?php echo $progress; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $progress; ?>%"><?php echo $progress; ?>%</div>
          </div>
          </div>
        </div>

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
            <img loading="lazy" src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full'); ?>" alt="<?php the_title(); ?>" width="75" height="75" class="flex-shrink-0 rounded-3 bg-secondary bg-opacity-25 bg-gradient">
            <div class="d-flex gap-2 w-100 justify-content-between">
              <div>
                <h5 class="mb-0"><i class="iconfont icon-trophy <?php echo $t_color; ?>"></i><?php the_title(); ?></h5>
                <p class="mb-0 opacity-75"><?php the_excerpt(); ?></p>
              </div>
              <small class="position-absolute top-0 end-0 me-2 opacity-50 text-nowrap"><?php if($earned == '1'){echo esc_html( human_time_diff( get_the_time('U'), current_time('timestamp') ) ) . __(' ago','psn'); }else{echo __('Unearned','psn'); }?></small>
            </div>
          </a>
                            <?php
        }
      }
    ?>
  </div>

<?php } ?>


</div><!-- /.entry-content -->




</article><!-- /#post-<?php the_ID(); ?> -->