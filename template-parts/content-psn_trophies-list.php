
  <a href="<?php the_permalink(); ?>" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
      <img loading="lazy" src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'thumbnail'); ?>" alt="<?php the_title(); ?>" width="75" height="75" class="flex-shrink-0 rounded-3 bg-secondary bg-opacity-25 bg-gradient">
    <div class="d-flex gap-2 w-100 justify-content-between">
      <div>
        <?php $t_color = get_post_meta(get_the_ID(),'type',true);?>
        <h5 class="mb-0"><i class="iconfont icon-trophy <?php echo $t_color; ?>"></i><?php the_title(); ?></h5>
        <p class="mb-0 opacity-75"><?php echo get_the_excerpt(); ?></p>
        <p class="mb-0 badge bg-secondary text-wrap"><?php $terms = get_the_terms( $post->ID, 'trophy_groups' );$term_id = $terms[0]->term_id ?? '';$term_name = $terms[0]->name ?? ''; echo $term_name;?></p>
      </div>
      <small class="position-absolute top-0 end-0 me-2 opacity-50 text-nowrap"><?php echo esc_html( human_time_diff( get_the_time('U'), current_time('timestamp') ) ) . __(' ago','psn'); ?></small>
    </div>
  </a>