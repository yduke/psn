<?php $post_id=get_the_ID();?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


<header class="entry-header">
    <div class="my-5 text-center">
            <?php if ( has_post_thumbnail() ) :
                    echo '<div class="post-thumbnail">' . get_the_post_thumbnail( $post_id, 'full' ) . '</div>';
            endif; ?>
        <h2 class="display-5 fw-bold"><i class="iconfont icon-steam size-m"></i><?php the_title(); ?></h2>
        <div class="entry-meta">
                <?php
                                
                $terms_p = get_the_terms( $post_id, 'game_publishers' ); 
                if ($terms_p) {
                  foreach ( $terms_p as $term ) { 
                    echo '<p><span class="inc"><a href="'. esc_url( get_term_link( $term )). '">'.$term->name.'</a></span></p>';
                  }
                }
                if(get_the_time('U') == 1041408000){
                  _e('Never Played','psn');
                }else{
                  echo __('Last Played on','psn').' '.esc_html( human_time_diff( get_the_time('U'), current_time('timestamp') ) ). __(' ago','psn');
                }
                ?>
        </div><!-- /.entry-meta -->

    </div>
    <div class="text-center"><?php if(function_exists('yasr_autoload_shortcodes')){ echo do_shortcode( '[yasr_visitor_votes]' ); } ?></div>
      <?php
      $terms = get_the_terms( $post_id , 'stm_game_genres' );
      if (is_array($terms)){
        foreach ( $terms as $term ) { 
              echo '<a href="'.get_term_link($term->slug, 'stm_game_genres').'"><span class="badge text-bg-primary">'.$term->name.'</span></a> ';
        }
      }
      ?>


</header><!-- /.entry-header -->
<div class="entry-content">
        <table class="table table-striped table-sm mb-5">
          <tbody>
          <tr>
              <td><?php _e('Last Played on','psn');?></td>
              <td><?php 
              if(get_the_time('U') == 1041408000){
                _e('Never Played','psn');
              }else{
                $lpt = get_the_time(get_option( 'date_format' )); 
                echo esc_html( human_time_diff( get_the_time('U'), current_time('U') ) ) . __(' ago','dk-psn');
                echo ' (' .$lpt.')';
              }
              ?></td>
            </tr>

            <tr>
              <td><?php _e('Play Duration','psn');?></td>
              <td><?php 
              $playtime = get_post_meta($post_id,'playtime',true);
              $hours = intdiv($playtime, 60).__('h', 'psn'). ($playtime % 60).__('m', 'psn');
              echo $hours;
              ?></td>
            </tr>

            <tr>
              <td><?php _e('Name','psn');?></td>
              <td><?php the_title();?></td>
            </tr>

            <?php $name_localized = get_post_meta($post_id,'name_localized',true);
            if(''!=$name_localized && $name_localized != get_the_title()){
              ?>
            <tr>
              <td><?php _e('Local Name','psn');?></td>
              <td>
              <?php echo $name_localized; ?>
              </td>
            </tr>
              <?php
            }
            ?>

            <?php $devs = get_the_terms( $post_id, 'game_developers' ); 
            if($devs){
              ?>
            <tr>
              <td><?php _e('Developers','psn');?></td>
              <td>
              <?php 
                  foreach ( $devs as $dev ) { 
                    echo '<a href="'.get_term_link($dev->slug, 'game_developers').'"><span class="badge text-bg-secondary">'.$dev->name.'</span></a> ';
              }
              ?>
              </td>
            </tr>
              <?php
            }
            ?>

            <?php $release_date = get_post_meta($post_id,'release_date',true);
            if($release_date){
              ?>
            <tr>
              <td><?php _e('Release date','psn');?></td>
              <td>
              <?php echo get_date_from_gmt( date("Y-m-d H:i:s",  $release_date), get_option( 'date_format' ) ); ?>
              </td>
            </tr>
              <?php
            }
            ?>

            <?php $required_age = get_post_meta($post_id,'required_age',true);
            if($required_age){
              ?>
            <tr>
              <td><?php _e('Age Required','psn');?></td>
              <td>
              <?php echo $required_age; ?>
              </td>
            </tr>
              <?php
            }
            ?>

            <tr>
              <td><?php _e('Platform','psn');?></td>
              <td>
                <?php
              $win = get_post_meta($post->ID,'platformWindows',true);
              $mac = get_post_meta($post->ID,'platformMac',true);
              $lnx = get_post_meta($post->ID,'platformLinux',true);
              if($win){
                echo '<i class="iconfont icon-windows" title="Windows"></i>';
              }
              if($mac){
                echo ' <i class="iconfont icon-mac" title="MacOS"></i>';
              }
              if($lnx){
                echo '  <i class="iconfont icon-linux" title="Linux"></i>';
              }
              ?>
             </td>
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

            <?php $price = get_post_meta($post_id,'price',true);
            if($price){
              $cny = $price/100;
              ?>
            <tr>
              <td><?php _e('Price','psn');?></td>
              <td>
              <?php echo number_format((float)$cny, 2, '.', ''); ?>
              </td>
            </tr>
              <?php
            }
            ?>

            <?php $metacritic = get_post_meta($post_id,'metacritic',true);
            $metacritic_url = get_post_meta($post_id,'metacritic_url',true);
            if($metacritic && $metacritic_url){
              ?>
            <tr>
              <td>
                <?php _e('Score','psn');?>
            </td>
              <td><svg class="icon fs-4" aria-hidden="true"><use xlink:href="#icon-metacritic"></use></svg>
              <strong><a href="<?php echo $metacritic_url; ?>" target="_blank"><?php echo $metacritic; ?></a></strong>
              </td>
            </tr>
              <?php
            }
            ?>

            <?php $website = get_post_meta($post_id,'website',true);
            if($website){
              ?>
            <tr>
              <td><?php _e('Website','psn');?></td>
              <td>
              <a href="<?php echo $website; ?>" target="_blank"><?php  _e('Link','psn'); ?></a>
              </td>
            </tr>
              <?php
            }
            ?>



          </tbody>
        </table>
<?php
$steamdeck_status = get_post_meta($post_id,'steamdeck_status',true);
$steamdeck_items = get_post_meta($post_id,'steamdeck_items',true);
if($steamdeck_status !=''){
  
  echo '<h4>';
  echo __('Steam Deck Verified Status','psn');
  echo '</h4>';
  echo '<ul class="list-group"><li class="list-group-item">';
  echo ' <svg class="icon fs-4" aria-hidden="true"><use xlink:href="#icon-steamdeck"></use></svg>';
    if($steamdeck_status == 3){
      echo '<svg class="icon fs-4" aria-hidden="true"><use xlink:href="#icon-verified"></use></svg>';
      echo ' '.__('Verified','psn');
    }elseif($steamdeck_status == 2){
      echo '<svg class="icon fs-4" aria-hidden="true"><use xlink:href="#icon-info"></use></svg>';
      echo ' '.__('Playable','psn');
    }elseif($steamdeck_status == 1){
      echo '<i class="iconfont icon-stop fs-4"></i>';
      echo ' '.__('Unsupported','psn');
    }elseif($steamdeck_status == 0){
      echo '<i class="iconfont icon-question fs-4"></i>';
      echo ' '.__('Unknown','psn');
    }
    echo "</li>";
    if($steamdeck_items){
      foreach($steamdeck_items as $item){
        $display_type = $item->display_type;
        $loc_token = str_replace('#SteamDeckVerified_TestResult_', '', $item->loc_token);
        $message = get_steamdeck_verified_message($loc_token);
        switch($display_type){
          case '4':
            $icon = 'verified';
            break;
          case '3':
              $icon = 'info';
            break;
          case '2':
              $icon = 'stop';
            break;
          case '1':
              $icon = 'question';
            break;
          
          default:
            $icon = 'info';
        }
        ?><li class="list-group-item"><i class="iconfont icon-<?php echo $icon; ?>"></i> <?php echo $message; ?></li><?php
      }
    }

  echo '</ul>';

}

?>

        <div class="my-5">
          <?php
          $terms = get_the_terms( $post_id , 'stm_game_cat' );
          if (is_array($terms)){
            foreach ( $terms as $term ) { 
                  echo '<a href="'.get_term_link($term->slug, 'stm_game_cat').'"><span class="badge text-bg-dark">'.$term->name.'</span></a> ';

            }
          }
          ?>
        </div>


        <?php if(get_the_content() !=''){ ?>
        <h3><?php _e('Description','psn')?></h3>
        <div class="mb-5"><?php
            the_content();
            wp_link_pages( array( 'before' => '<div class="page-link"><span>' . esc_html__( 'Pages:', 'psn' ) . '</span>', 'after' => '</div>' ) );
            ?></div>
            <?php } ?>
<?php
    edit_post_link( __( 'Edit', 'psn' ), '<span class="edit-link">', '</span>' );
?>
          <?php
                $appid = get_post_meta($post_id,'appid',true);
                $query_meta = array(
                    'post_type' => 'stm_trophy',
                    'meta_key' => 'appid',
                    'meta_value' => $appid,
                    'orderby' => 'post_date',
                    'posts_per_page'=>'-1'
                );
                $trophies = new WP_Query( $query_meta );
                if($trophies->have_posts()){
                  ?>
                  <h3><?php _e('Achievements','psn');?></h3>
<?php 
$achieved_count = get_post_meta($post_id,'achieved_count',true);
$achieved_earned = get_post_meta($post_id,'achieved_earned',true);
if($achieved_count!='' && $achieved_earned !='' ){ 
  $progress = round($achieved_earned/$achieved_count*100,2);
  ?>
            <?php if($progress=='100'){ ?>
            <div class="pyro">
              <div class="before"></div>
              <div class="after"></div>
            </div>
          <?php } ?>
  <p><?php _e('Achievement Progress','psn');?></p>
  <p class="text-center"><?php echo $achieved_earned.'/'.$achieved_count;?></p>
                  <div class="progress mb-5">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="<?php echo $progress; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $progress; ?>%"><?php echo $progress; ?>%</div>
                  </div>
<?php }?>

                  <div class="list-group w-auto mb-5">
                  <?php
                  while ( $trophies->have_posts() ) {
                    $trophies->the_post();
                    $t_id = get_the_ID();
                    $achieved = get_post_meta($t_id,'achieved',true); 
                    $hidden = get_post_meta($t_id,'hidden',true);

                    if($achieved == '1' || $achieved == ''){
                      $image = get_the_post_thumbnail_url($t_id,'full');
                      $unlocktime = esc_html( human_time_diff( get_the_time('U'), current_time('timestamp') ) ) . __(' ago','psn');
                    }else{
                      $image = get_post_meta($t_id,'icongray',true);
                      $unlocktime = __('Unearned','psn');
                    }

                    ?>
  <a href="<?php the_permalink(); ?>" class="list-group-item list-group-item-action d-flex gap-3 py-3 <?php if($achieved == '0'){echo 'grayscale';}if($hidden=='1' && $achieved != '1'){echo ' blurry';} ?>" aria-current="true">
    <img src="<?php echo $image; ?>" alt="<?php the_title(); ?>" width="75" height="75" class="flex-shrink-0 rounded-3 bg-secondary bg-opacity-25 bg-gradient">
    <div class="d-flex gap-2 w-100 justify-content-between">
      <div>
        <h5 class="mb-0"><?php the_title(); ?></h5>
        <p class="mb-0 opacity-75"><?php the_excerpt(); ?></p>
      </div>
      <small class="position-absolute top-0 end-0 me-2 opacity-50 text-nowrap"><?php echo $unlocktime; ?></small>
    </div>
  </a>
                    <?php
                  }
                  ?>
                  </div><!-- /.col -->
                  <?php
                }
          ?>
</div><!-- /.entry-content -->




</article><!-- /#post-<?php the_ID(); ?> -->