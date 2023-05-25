<?php $post_id=get_the_ID(); $achieved = get_post_meta($post_id,'achieved',true); $hidden = get_post_meta($post_id,'hidden',true); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


<header class="entry-header <?php if($hidden=='1' && $achieved != '1'){echo 'grayscale blurry';} ?>">
<div class="my-5 text-center">
            <?php if ( has_post_thumbnail() ){
              if($achieved == '1' || $achieved == ''){
                    echo '<div class="post-thumbnail">' . get_the_post_thumbnail( $post_id, 'full' ) . '</div>';
                  }else{
                    echo '<div class="post-thumbnail"><img src="' . get_post_meta($post_id,'icongray',true) . '"></div>';;
                  }
              }
             ?>
        <h2 class="display-5 fw-bold"><i class="iconfont icon-achievement size-m"></i><?php the_title(); ?></h2>
        <p class="lead mb-4">
            <?php the_excerpt();?>
        </p>
        <div class="entry-meta">
                <?php
                if($achieved=='0'){echo __('Unearned','psn');}else{
                  echo __('Earned on','psn').' '.esc_html( human_time_diff( get_the_time('U'), current_time('timestamp') ) ). __(' ago','psn');
                }
                ?>
        </div><!-- /.entry-meta -->

    </div>

</header><!-- /.entry-header -->
<div class="entry-content">
        <table class="table table-striped table-sm mb-5">
          <tbody>
            <tr>
              <td><?php _e('Earned on','psn');?></td>
              <td><?php if($achieved=='0'){echo __('Unearned','psn');}else{echo get_the_time(get_option( 'date_format' ));} ?></td>
            </tr>
            <tr>
              <td><?php _e('From Game','psn');?></td>
              <td><?php
              $appid = get_post_meta($post_id,'appid',true);
              $args = array(
                'post_type' => 'steam_game',
                'meta_key' => 'appid',
                'meta_query' => array(
                    array(
                        'key' => 'appid',
                        'value' => $appid,
                        'compare' => '=',
                    )
                )
             );
             $query = new WP_Query($args);
             if ( $query->have_posts() ) {
              while ( $query->have_posts() ) {
                $query->the_post();
                $link = get_the_permalink();
              }
            }
              $game = get_post_meta($post_id,'game',true);
              echo '<a href='.$link.'>'.$game.'</a>';
              ?></td>
            </tr>
            <?php if($hidden){?>
              <td><?php _e('Hidden achievement','psn');?></td>
              <td><?php _e('Yes','psn');?></td>

              <?php } ?>

          </tbody>
        </table>

</div><!-- /.entry-content -->

<?php
    edit_post_link( __( 'Edit', 'psn' ), '<span class="edit-link">', '</span>' );
?>


</article><!-- /#post-<?php the_ID(); ?> -->