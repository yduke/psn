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
        <p class="mb-0 opacity-75"><?php
              _e('Total duration:','psn');
              $playtime = get_post_meta($post->ID,'playtime',true);
              $hours = intdiv($playtime, 60).__('h', 'psn'). ($playtime % 60).__('m', 'psn');
              echo ' '.$hours; ?></p>
        <p class="mb-0 opacity-75">Steam</p>
      </div>
      <small class="opacity-50 text-nowrap"><?php 
      if(get_the_time('U') == 1041408000){
        _e('Never Played','psn');
      }else{
        echo esc_html( human_time_diff( get_the_time('U'), current_time('timestamp') ) ) . __(' ago','psn');
      }
       ?></small>
    </div>
  </a>
    <?php }; ?>
</div>
    <?php }; ?>

    <div class="d-grid gap-2 mb-5">
        <a href="<?php echo get_post_type_archive_link( 'steam_game' ); ?>" class="btn btn-primary btn-lg" role="button"><?php _e('More','psn'); ?></a>
    </div>