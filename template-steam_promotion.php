<?php
/*
Template Name: Steam Promotions
*/
__( 'Steam Promotions', 'dukeyin' );
$wp_upload_dir = wp_upload_dir();
$local_path = $wp_upload_dir['basedir'].'/dk-steam/api_cache/featuredcategories.json';
$filetime = filemtime($local_path );
if(!file_exists($local_path) || (time() - $filetime > 43200)){
    GetSpecialSales();
}

$json       = file_get_contents($local_path);
$obj        = json_decode($json);
$special    = $obj->specials->items;
$top_sellers    = $obj->top_sellers->items;
$new_releases   = $obj->new_releases->items;
$coming_soon   = $obj->coming_soon->items;
get_header();

?>
<div class="container">
<div class="row mb-4">
<div class="col-sm-12">
<?php
    if ($obj ) {
    ?>

    <header class="page-header">
        <h1 class="page-title"><?php _e('Steam Promotions','psn');?></h1>
    </header>



    <?php
        foreach($obj as $gms){
            if($gms->id ==='cat_dailydeal'){
                foreach($gms->items as $dot){
?>
    <h2 class="mt-5 mb-4"><?php _e('Daily Deal','psn');?></h2>
    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-3 row-cols-lg-3 g-2">
<article>
    <div class="card text-bg-dark">
        <div class="bg-secondary bg-opacity-25 bg-gradient">
            <img loading="lazy" width="460" height="215" src="<?php echo $dot->header_image; ?>" class="card-img-top wp-post-image" alt="" decoding="async" >
        </div>
        <div class="card-body">
            <h2 class="card-title fs-6 text-truncate"><a href="https://store.steampowered.com/app/<?php echo $dot->id; ?>/" title="<?php echo $dot->name; ?>" rel="bookmark" target="_blank" class="link-light"><?php echo $dot->name; ?></a></h2>
            <div class="card-text small text-truncate">
            <?php 
            echo '￥'.'<span class="badge fs-4 p-1">'. $dot->final_price/100 .'</span>';
            if($dot->discounted){
                echo ' ( <del>';
                echo '￥'.$dot->original_price/100;
                echo '</del>';
                echo ' -'.$dot->discount_percent.'% ) ';
            }
             ?>
            </div>
            <div class="d-flex justify-content-between align-items-center">
            <small class="text-muted"><?php if($dot->discounted && isset($dot->discount_expiration)){ echo __('Discount time left:  ','psn'). esc_html( human_time_diff( $dot->discount_expiration , current_time('timestamp',true) ) );} if($dot->discounted === false ){ echo __('No discount','psn');}?></small>
            </div>
        </div>
	</div>
</article>
    </div>
    <?php
            }
    break;
            }
        } //Daily Deal end
    ?>

<h2 class="mt-5 mb-4"><?php _e('Spotlight','psn');?></h2>
    <div class="row row-cols-3 row-cols-sm-3 row-cols-md-3 row-cols-lg-6 g-1">
        <?php
foreach($obj as $spot){
    if($spot->id == 'cat_spotlight'){
        foreach($spot->items as $item){
?>
    <a href="<?php echo $item->url; ?>" title="<?php echo $item->name; ?>" rel="bookmark" target="_blank">
        <img loading="lazy" width="306" height="350" src="<?php echo $item->header_image; ?>" class="card-img-top wp-post-image rounded" alt="" decoding="async" >
    </a>

<?php
        }
     }else{
        break;
    }
    }  //spotlight end
    ?>
</div>


    <h2 class="mt-5 mb-4"><?php _e('Special sales','psn');?></h2>

    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-3 row-cols-lg-5 g-2">
        <?php
        usort($special, fn($b, $a) => $b->final_price - $a->final_price);
        foreach($special as $game){
?>
<article>
    <div class="card text-bg-dark">
        <div class="bg-secondary bg-opacity-25 bg-gradient">
            <img loading="lazy" width="616" height="353" src="<?php echo $game->header_image; ?>" class="card-img-top wp-post-image" alt="" decoding="async" >
        </div>
        <div class="card-body">
            <h2 class="card-title fs-6 text-truncate"><a href="https://store.steampowered.com/app/<?php echo $game->id; ?>/" title="<?php echo $game->name; ?>" rel="bookmark" target="_blank" class="link-light"><?php echo $game->name; ?></a></h2>
            <div class="card-text small text-truncate">
            <?php 
            echo '￥'.'<span class="badge fs-4 p-1">'. $game->final_price/100 .'</span>';
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
        } //Special sales end
    ?>
    </div>



    <h2 class="mt-5 mb-4"><?php _e('Top sales','psn');?></h2>
    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-3 row-cols-lg-5 g-1">
        <?php
        foreach($top_sellers as $sales){
?>
<article>
    <div class="card shadow-sm">
        <div class="bg-secondary bg-opacity-25 bg-gradient">
            <img loading="lazy" width="616" height="353" src="<?php echo $sales->header_image; ?>" class="card-img-top wp-post-image" alt="" decoding="async" >
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
                <small class="text-muted"><?php if($sales->discounted && isset($sales->discount_expiration)){ echo __('Discount time left:  ','psn'). esc_html( human_time_diff( $sales->discount_expiration , current_time('timestamp',true) ) );} if($sales->discounted === false ){ echo __('No discount','psn');}?></small>
            </div>
        </div>
	</div>
</article>

<?php
        }  //Top sales
    ?>
</div>





    <h2 class="mt-5 mb-4"><?php _e('New release','psn');?></h2>
 
    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-3 row-cols-lg-5 g-2">
        <?php
        foreach($new_releases as $release){
?>
<article>
    <div class="card text-bg-dark">
        <div class="bg-secondary bg-opacity-25 bg-gradient">
            <img loading="lazy" width="616" height="353" src="<?php echo $release->header_image; ?>" class="card-img-top wp-post-image" alt="" decoding="async" >
        </div>
        <div class="card-body">
            <h2 class="card-title fs-6 text-truncate"><a href="https://store.steampowered.com/app/<?php echo $release->id; ?>/" title="<?php echo $release->name; ?>" rel="bookmark" target="_blank" class="link-light"><?php echo $release->name; ?></a></h2>
            <div class="card-text small text-truncate">
            <?php 
                       if($release->final_price > 0){
                        echo '￥'.'<span class="badge text-bg-light fs-4 p-1">'. $release->final_price/100 .'</span>';
                    }elseif($release->final_price === 0){
                        echo '<span class="badge text-bg-light fs-4 p-1">'.__('Free','psn').'</span>';
                    }
            if($release->discounted){
                echo ' ( <del>';
                echo '￥'.$release->original_price/100;
                echo '</del>';
                echo ' -'.$release->discount_percent.'% ) ';
            }
             ?>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <?php ?>
            <small class="text-muted"><?php if($release->final_price != 0){ if($release->discounted){ echo __('Discount time left:  ','psn'). esc_html( human_time_diff( $release->discount_expiration , current_time('timestamp',true) ) );}else{ echo __('No discount','psn');} }else{echo __('Free to play','psn');}?></small>
            <?php ?>
            </div>
        </div>
	</div>
</article>
<?php
        } //New release  end
    ?>
    </div>


    <h2 class="mt-5 mb-4"><?php _e('Coming soon','psn');?></h2>
    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-3 row-cols-lg-5 g-1">
        <?php
        foreach($coming_soon as $soon){
?>
<article>
    <div class="card shadow-sm">
        <div class="bg-secondary bg-opacity-25 bg-gradient">
            <img loading="lazy" width="616" height="353" src="<?php echo $soon->header_image; ?>" class="card-img-top wp-post-image" alt="" decoding="async" >
        </div>
        <div class="card-body">
            <h2 class="card-title fs-6 text-truncate"><a href="https://store.steampowered.com/app/<?php echo $soon->id; ?>/" title="<?php echo $soon->name; ?>" rel="bookmark" target="_blank"><?php echo $soon->name; ?></a></h2>
            <div class="card-text small text-truncate">
            <?php 
            if($soon->final_price > 0){
                echo '￥'.'<span class="badge text-bg-light fs-4 p-1">'. $soon->final_price/100 .'</span>';
            }elseif($soon->final_price === 0){
                echo '<span class="badge text-bg-light fs-4 p-1">'.__('Free','psn').'</span>';
            }
            
            if($soon->discounted){
                echo ' ( <del>';
                echo '￥'.$soon->original_price/100;
                echo '</del>';
                // echo 
                echo ' -'.$soon->discount_percent.'% ) ';
            }
             ?>
            </div>
            <div class="d-flex justify-content-between align-items-center">
            <small class="text-muted"><?php if($soon->final_price != 0){ if($soon->discounted){ echo __('Discount time left:  ','psn'). esc_html( human_time_diff( $soon->discount_expiration , current_time('timestamp',true) ) );}else{ echo __('No discount','psn');} }else{echo __('Free to play','psn');}?></small>
            </div>
        </div>
	</div>
</article>

<?php
        }   //Coming soon end
    ?>
</div>



    <?php
    }else{
        get_template_part( 'content', 'none' );
    }
    ?>
    </div>
</div>

<p><?php if($filetime){
    echo __('Cached on','psn').' '. get_date_from_gmt( date( 'Y-m-d H:i:s', $filetime ), get_option('date_format').' '.get_option('time_format') );;
    } ?></p>

</div>
<?php
get_footer();
