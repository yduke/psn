<?php $post_id=get_the_ID();?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


<header class="entry-header">
    <div class="my-5 text-center">
            <?php if ( has_post_thumbnail() ) :
                    echo '<div class="post-thumbnail">' . get_the_post_thumbnail( $post_id, 'full' ) . '</div>';
            endif; ?>
        <h2 class="display-5 fw-bold"><?php the_title(); ?></h2>
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
              <td>Steam</td>
            </tr>

            <?php $price = get_post_meta($post_id,'price',true);
            if($price){
              $cny = $price/100;
              ?>
            <tr>
              <td><?php _e('Price','psn');?></td>
              <td>
              <?php echo number_format((float)$cny, 2, '.', '');; ?>
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
              <td><?php _e('Metacritic Score','psn');?></td>
              <td>
              <a href="<?php echo $metacritic_url; ?>" target="_blank"><?php echo $metacritic; ?></a>
              </td>
            </tr>
              <?php
            }
            ?>

            <tr>
              <td><?php _e('Last Played on','psn');?></td>
              <td><?php 
              if(get_the_time('U') == 1041408000){
                _e('Never Played','psn');
              }else{
              echo get_the_time(get_option( 'date_format' ));
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

            <?php $website = get_post_meta($post_id,'website',true);
            if($website){
              ?>
            <tr>
              <td><?php _e('Website','psn');?></td>
              <td>
              <a href="<?php echo $website; ?>" target="_blank"><?php echo $website; ?></a>
              </td>
            </tr>
              <?php
            }
            ?>
          </tbody>
        </table>
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
        <p class="lead mb-4"><?php
            the_content();
            wp_link_pages( array( 'before' => '<div class="page-link"><span>' . esc_html__( 'Pages:', 'psn' ) . '</span>', 'after' => '</div>' ) );
            ?></p>
            <?php } ?>

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
                  <div class="list-group w-auto mb-5">
                  <?php
                  while ( $trophies->have_posts() ) {
                    $trophies->the_post();
                    ?>
  <a href="<?php the_permalink(); ?>" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full'); ?>" alt="<?php the_title(); ?>" width="75" height="75" class="rounded-3 flex-shrink-0">
    <div class="d-flex gap-2 w-100 justify-content-between">
      <div>
        <h5 class="mb-0"><?php the_title(); ?></h5>
        <p class="mb-0 opacity-75"><?php the_excerpt(); ?></p>
      </div>
      <small class="opacity-50 text-nowrap"><?php echo esc_html( human_time_diff( get_the_time('U'), current_time('timestamp') ) ) . __(' ago','psn'); ?></small>
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

<?php
    edit_post_link( __( 'Edit', 'psn' ), '<span class="edit-link">', '</span>' );
?>


</article><!-- /#post-<?php the_ID(); ?> -->