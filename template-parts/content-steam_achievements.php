<?php
        $args = array(
            'orderby'           => 'date',
            'posts_per_page'    => 10,
            'post_type'         => 'stm_trophy',
            'ignore_sticky_posts' => 1,
            'meta_key' => 'achieved',
            'meta_value' => '1'
        );
        $posts = new WP_Query( $args );
        if ( $posts->have_posts() ) {
    ?>
<h2><?php _e('Recent Steam Achievements','psn');?></h2>
<div class="list-group w-auto mb-2">
    <?php
        while ( $posts->have_posts() ) {
            $posts->the_post()
    ?>
  <a href="<?php the_permalink(); ?>" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
      <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full'); ?>" alt="<?php the_title(); ?>" width="75" height="75" class="flex-shrink-0 rounded-3 bg-secondary bg-opacity-25 bg-gradient">
    <div class="d-flex gap-2 w-100 justify-content-between">
      <div>
        <h5 class="mb-0"><?php the_title(); ?></h5>
        <p class="mb-0 opacity-75"><?php echo get_the_excerpt(); ?></p>
        <p class="mb-0 badge bg-secondary text-wrap"><?php echo get_post_meta($post->ID,'game',true); ?></p>
      </div>
      <small class="position-absolute top-0 end-0 me-2 opacity-50 text-nowrap"><?php echo esc_html( human_time_diff( get_the_time('U'), current_time('timestamp') ) ) . __(' ago','psn'); ?></small>
    </div>
  </a>
    <?php }; ?>
</div>
    <?php }; ?>
    <div class="d-grid gap-2 mb-5">
        <a href="<?php echo get_post_type_archive_link( 'stm_trophy' ); ?>" class="btn btn-primary btn-lg" role="button"><?php _e('More','psn'); ?></a>
    </div>