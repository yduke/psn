<?php
    // Games content
        $args = array(
            'orderby'           => 'date',
            'posts_per_page'    => 10,
            'post_type'         => 'steam_game',
            'ignore_sticky_posts' => 1,
        );
        $posts = new WP_Query( $args );
        if ( $posts->have_posts() ) {
    ?>
<h2><?php _e('Recent Steam Games','psn');?></h2>
<div class="list-group w-auto mb-5">
    <?php
        while ( $posts->have_posts() ) {
            $posts->the_post()
    ?>
  <a href="<?php the_permalink(); ?>" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'thumbnail'); ?>" alt="<?php the_title(); ?>" width="75" height="75" class="rounded-3 flex-shrink-0">
    <div class="d-flex gap-2 w-100 justify-content-between">
      <div>
        <h6 class="mb-0"><?php the_title(); ?></h6>
        <p class="mb-0 opacity-75"><?php  ?></p>
        <p class="mb-0 opacity-75"><?php

               ?></p>
      </div>
      <small class="opacity-50 text-nowrap"><?php echo esc_html( human_time_diff( get_the_time('U'), current_time('timestamp') ) ) . __(' ago','psn'); ?></small>
    </div>
  </a>
    <?php }; ?>
</div>
    <?php }; ?>
    <div class="mb-5 col-lg-12 text-center">
    <a href="<?php echo get_post_type_archive_link( 'steam_game' ); ?>" class="btn btn-primary btn-lg"><?php _e('More','psn'); ?></a>
    </div>