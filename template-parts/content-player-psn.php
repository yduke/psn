    <div class="row mb-5">
      <div class="col-lg-12 text-center">
        
        <img loading="lazy" class="bd-placeholder-img rounded-circle" width="140" height="140" src="<?php echo get_option('psn_player_avatar_loc'); ?>">

        <h2 class="fw-normal"><?php echo get_option('psn_player_id');
        if(get_option('psn_player_hasPlus')){?>
 <img loading="lazy" src="<?php echo get_template_directory_uri() .'/assets//img/plus.svg' ?>" width="20" height="20"></h2>
        <?php } ?>
        <p><i class="iconfont icon-playstation"></i> <?php echo get_option('psn_player_about'); ?></p>
        <p><?php echo __('Level: ','psn'). get_option('psn_player_level'); ?></p>
        <p><?php echo __('Last updated on: ','psn'). esc_html( human_time_diff( strtotime(get_option('psn_last_update')), current_time('timestamp') ) ). __(' ago','psn'); ?></p>
        <div class="row text-center">
            <div class="col-3 themed-grid-col platinum"><i class="iconfont icon-trophy platinum"></i><span class="fw-bolder"><?php echo get_option('psn_player_platinum'); ?></span></div>
            <div class="col-3 themed-grid-col gold"><i class="iconfont icon-trophy gold"></i><span class="fw-bolder"><?php echo get_option('psn_player_gold'); ?></span></div>
            <div class="col-3 themed-grid-col silver"><i class="iconfont icon-trophy silver"></i><span class="fw-bolder"><?php echo get_option('psn_player_silver'); ?></span></div>
            <div class="col-3 themed-grid-col bronze"><i class="iconfont icon-trophy bronze"></i><span class="fw-bolder"><?php echo get_option('psn_player_bronze'); ?></span></div>
        </div>
      </div><!-- /.col-lg-4 -->
    </div>