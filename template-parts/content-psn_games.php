    <?php
    // Games content
        $args = array(
            'orderby'           => 'date',
            'posts_per_page'    => 10,
            'post_type'         => 'psn_game',
            'ignore_sticky_posts' => 1,
            'meta_query'  => array(
                'relation' => 'OR',
                array(
                    'key' 		=> 'hide_game_post',
                    'value' 	=> '1',
                    'compare' 	=> '!='
                ),
                array(
                    'key' 		=> 'hide_game_post',
                    'compare' => 'NOT EXISTS',
                    'value' => ''
                ),
            )
        );
        $posts = new WP_Query( $args );
        if ( $posts->have_posts() ) {
    ?>
<h2><?php _e('Recent PlayStation Games','psn');?></h2>
<div class="list-group w-auto mb-2">
    <?php
        while ( $posts->have_posts() ) {
            $posts->the_post()
    ?>
  <a href="<?php the_permalink(); ?>" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'thumbnail'); ?>" alt="<?php the_title(); ?>" width="75" height="75" class="rounded-3 flex-shrink-0">
    <div class="d-flex gap-2 w-100 justify-content-between">
      <div>
        <h6 class="mb-0"><?php the_title(); ?></h6>
        <p class="mb-0 opacity-75"><?php $terms = get_the_terms( get_the_ID(), 'game_publishers' ); if ($terms) {echo $terms[0]->name;} ?></p>
        <p class="mb-0 opacity-75"><?php
               $platform = get_post_meta(get_the_ID(),'game_platform',true);
                if($platform == 'ps4_game'){
                    echo '<i class="iconfont icon-ps4 size-l"></i>';
                }elseif($platform == 'ps5_native_game'){
                    echo '<i class="iconfont icon-ps5 size-l"></i>';
                }elseif($platform == 'ps4_nongame_mini_app'){
                    echo 'APP';
                }
               ?></p>
      </div>
      <small class="position-absolute top-0 end-0 me-2 opacity-50 text-nowrap"><?php echo esc_html( human_time_diff( get_the_time('U'), current_time('timestamp') ) ) . __(' ago','psn'); ?></small>
    </div>
  </a>
    <?php }; ?>
</div>
    <?php }; ?>

    <div class="d-grid gap-2 mb-5">
        <a href="<?php echo get_post_type_archive_link( 'psn_game' ); ?>" class="btn btn-primary btn-lg" role="button"><?php _e('More','psn'); ?></a>
    </div>