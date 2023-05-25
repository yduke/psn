    <div class="list-group-item list-group-item-action" aria-current="true">
        <div class="d-flex w-100 justify-content-between">
            <h6 class="mb-1"><?php the_title(); ?></h6>
            <small><?php echo esc_html( human_time_diff( get_the_time('U'), current_time('timestamp') ) ) . __(' ago','psn'); ?></small>
        </div>
            <p class="mb-1"><?php echo get_the_excerpt(); ?></p>
    </div>