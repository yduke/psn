<?php
/*
Template Name: Steam Promotions
*/
__( 'Steam Promotions', 'dukeyin' );
$wp_upload_dir = wp_upload_dir();
$local_path = $wp_upload_dir['basedir'].'/dk-steam/api_cache/featuredcategories.json';
$filetime = filemtime($local_path );
$json       = file_get_contents($local_path);
$obj        = json_decode($json);
$special    = $obj->specials->items;
$top_sellers    = $obj->top_sellers->items;
get_header();

?>
<div class="row mb-4">
<div class="col-sm-12">
    <header class="page-header">
        <h1 class="page-title"><?php _e('Steam Promotions','psn');?></h1>
    </header>

    <h2 class="mt-5 mb-4"><?php _e('Special sales','psn');?></h2>
    <?php
    if ($obj ) {
    ?>
    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-5 g-2">
        <?php
        usort($special, fn($b, $a) => $b->final_price - $a->final_price);
        foreach($special as $game){
?>
<article>
    <div class="card shadow-sm">
        <div class="bg-secondary bg-opacity-25 bg-gradient">
            <img width="616" height="353" src="<?php echo $game->large_capsule_image; ?>" class="card-img-top wp-post-image" alt="" decoding="async" >
        </div>
        <div class="card-body">
            <h2 class="card-title fs-6 text-truncate"><a href="https://store.steampowered.com/app/<?php echo $game->id; ?>/" title="<?php echo $game->name; ?>" rel="bookmark" target="_blank"><?php echo $game->name; ?></a></h2>
            <div class="card-text small text-truncate">
            <?php 
            echo '￥'.'<span class="badge text-bg-light fs-4 p-1">'. $game->final_price/100 .'</span>';
            if($game->discounted){
                echo ' ( <del>';
                echo '￥'.$game->original_price/100;
                echo '</del>';
                echo ' -'.$game->discount_percent.'% ) ';
            }
             ?>
            </div>
            <div class="d-flex justify-content-between align-items-center">
            <small class="text-muted"><?php if($game->discounted){ echo __('Discount time left:  ','psn'). esc_html( human_time_diff( $game->discount_expiration , current_time('timestamp',true) ) );}else{ echo __('No discount','psn');}?></small>
            </div>
        </div>
	</div>
</article>
<?php
        }
    ?>
    </div>
    <h2 class="mt-5 mb-4"><?php _e('Top sales','psn');?></h2>
    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-5 g-1">
        <?php
        foreach($top_sellers as $sales){
?>
<article>
    <div class="card shadow-sm">
        <div class="bg-secondary bg-opacity-25 bg-gradient">
            <img width="616" height="353" src="<?php echo $sales->large_capsule_image; ?>" class="card-img-top wp-post-image" alt="" decoding="async" >
        </div>
        <div class="card-body">
            <h2 class="card-title fs-6 text-truncate"><a href="https://store.steampowered.com/app/<?php echo $sales->id; ?>/" title="<?php echo $sales->name; ?>" rel="bookmark" target="_blank"><?php echo $sales->name; ?></a></h2>
            <div class="card-text small text-truncate">
            <?php 
            echo '￥'.'<span class="badge text-bg-light fs-4 p-1">'. $sales->final_price/100 .'</span>';
            if($sales->discounted){
                echo ' ( <del>';
                echo '￥'.$sales->original_price/100;
                echo '</del>';
                // echo 
                echo ' -'.$sales->discount_percent.'% ) ';
            }
             ?>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted"><?php if($sales->discounted){ echo __('Discount time left:  ','psn'). esc_html( human_time_diff( $sales->discount_expiration , current_time('timestamp',true) ) );}else{ echo __('No discount','psn');}?></small>
            </div>
        </div>
	</div>
</article>

<?php
        }
    ?>
</div>

    <?php
    }else{
        get_template_part( 'content', 'none' );
    }
    ?>
    </div>
</div>

<p><?php if($filetime){echo __('Cached on','psn').' '.date_i18n( get_option('date_format').' '.get_option('time_format'), $filetime );} ?></p>
<?php
get_footer();
