    <div class="list-group-item list-group-item-action" aria-current="true">
        <div class="d-flex w-100 justify-content-between">
            <p class="mb-1"><?php echo get_the_time(get_option('date_format').' '.get_option('time_format') );?></p>
            <small><?php echo esc_html( human_time_diff( get_the_time('U'), current_time('timestamp') ) ) . __(' ago','psn'); ?></small>
        </div>
            <p class="mb-1"><h6><?php the_title(); ?></h6><?php echo get_the_excerpt(); ?></p>
    </div>