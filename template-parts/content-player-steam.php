<div class="row mb-5">
      <div class="col-lg-12 text-center">
        
        <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="<?php echo get_option('stm_avatar_local');?>">

        <h2 class="fw-normal"><?php echo get_option('stm_name');?></h2>
        <p><?php echo __('Game Count: ','psn'). get_option('stm_game_count'); ?></p>
        <div class="row text-center">
            <div class="col-6 col-sm-3 themed-grid-col"><?php echo __('Last logoff: ','psn'). esc_html( human_time_diff( strtotime(date("Y-m-d H:i:s",  get_option('stm_lastlogoff'))), current_time('timestamp') ) ). __(' ago','psn'); ?></div>
            <div class="col-6 col-sm-3 themed-grid-col"><?php echo __('Account age: ','psn'). esc_html( human_time_diff( strtotime(date("Y-m-d H:i:s",  get_option('stm_timecreated'))), current_time('timestamp') ) ); ?></div>
            <div class="col-6 col-sm-3 themed-grid-col"><?php echo __('Steam Country: ','psn').get_option('stm_loccountrycode'); ?></div>
            <div class="col-6 col-sm-3 themed-grid-col"><?php echo __('Last updated on: ','psn'). esc_html( human_time_diff( strtotime(get_option('stm_last_update')), current_time('timestamp') ) ). __(' ago','psn'); ?></div>
        </div>
      </div><!-- /.col-lg-4 -->
    </div>