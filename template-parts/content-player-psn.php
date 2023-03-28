    <div class="row mb-5">
      <div class="col-lg-12 text-center">
        
        <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="<?php echo get_option('psn_player_avatar_loc'); ?>">

        <h2 class="fw-normal"><?php echo get_option('psn_player_id');
        if(get_option('psn_player_hasPlus')){?>
 <img src="<?php echo get_template_directory_uri() .'/assets//img/plus.svg' ?>" width="20" height="20"></h2>
        <?php } ?>
        <p><?php echo get_option('psn_player_about'); ?></p>
        <p><?php echo __('Level: ','psn'). get_option('psn_player_level'); ?></p>
        <p><?php echo __('Last updated on: ','psn'). esc_html( human_time_diff( strtotime(get_option('psn_last_update')), current_time('timestamp') ) ). __(' ago','psn'); ?></p>
        <div class="row text-center">
            <div class="col-3 themed-grid-col"><img src="<?php echo get_template_directory_uri() .'/assets//img/platinum.png' ?>" alt="platinum" width="30"><?php echo get_option('psn_player_platinum'); ?></div>
            <div class="col-3 themed-grid-col"><img src="<?php echo get_template_directory_uri() .'/assets//img/gold.png' ?>" alt="gold" width="30"><?php echo get_option('psn_player_gold'); ?></div>
            <div class="col-3 themed-grid-col"><img src="<?php echo get_template_directory_uri() .'/assets//img/silver.png' ?>" alt="silver" width="30"><?php echo get_option('psn_player_silver'); ?></div>
            <div class="col-3 themed-grid-col"><img src="<?php echo get_template_directory_uri() .'/assets//img/bronze.png' ?>" alt="bronze" width="30"><?php echo get_option('psn_player_bronze'); ?></div>
        </div>
      </div><!-- /.col-lg-4 -->
    </div>