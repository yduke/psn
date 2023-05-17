<?php
/*
Template Name: TEST2
*/
header( 'Content-Type: application/json' );

function update_steam_with_local(){
    $args = array(
        'post_type' => 'steam_game',
		'numberposts' => -1,
        'orderby'=>'date',
    );
    $posts = get_posts($args);
    if($posts){
		foreach($posts as $post){
			$post_id = $post -> ID;
			$appid = get_post_meta($post_id, 'appid', true);
			echo $appid.' ';
			$wp_upload_dir = wp_upload_dir();
			$url = $wp_upload_dir['baseurl'].'/dk-steam/appdetails/'.$appid.'.json';
			$obj = get_remote_json($url);
			if($obj){
				$detail =  reset($obj);
				if($detail && $detail->success){
					$type                   =  $detail->data->type ?? '';
					$name_localized         =  $detail->data->name;
					$controller_support     =  $detail->data->controller_support ?? '';
					$required_age           =  $detail->data->required_age ?? '';
					$is_free                =  $detail->data->is_free; //bol
					$description            =  wp_strip_all_tags($detail->data->about_the_game);
					$short_description      =  $detail->data->short_description;
					$supported_languages    =  wp_strip_all_tags($detail->data->supported_languages);
					$lang_array             =  explode (", ", $supported_languages);
					$website                =  $detail->data->website ?? '';
					$legal_notice           =  $detail->data->legal_notice ?? '';
					$developers             =  $detail->data->developers ?? array(); //array
					$publishers             =  $detail->data->publishers ?? array(); //array
					$price                  =  $detail->data->price_overview->initial ?? ''; //int
					$platformWindows        =  $detail->data->platforms->windows; //bol
					$platformMac            =  $detail->data->platforms->mac; //bol
					$platformLinux          =  $detail->data->platforms->linux; //bol
					$metacritic             =  $detail->data->metacritic->score ?? ''; //num
					$metacritic_url         =  $detail->data->metacritic->url ?? ''; 
					$categories             =  $detail->data->categories;  //array
					$genres                 =  $detail->data->genres;  //array
					$coming_soon            =  $detail->data->release_date->coming_soon;  //bol
					$release_date_a         =  $detail->data->release_date->date;
					if($release_date_a){
						$str = trim($release_date_a);
						$arr = date_parse_from_format('Y年m月d日',$str);
						$release_date = mktime(0,0,0,$arr['month'],$arr['day'],$arr['year']);
					}
					$support_info_url       =  $detail->data->support_info->url ?? '';
					$content_descriptors    =  $detail->data->content_descriptors->notes;
				}
				
		        wp_update_post(array (
					'ID'                => $post_id,
					'post_content'      => $description,
					'post_excerpt'      => $short_description,
					'meta_input'        => array(
						'type'                  => $type,
						'name_localized'        => $name_localized,
						'required_age'          => $required_age,
						'controller_support'    => $controller_support,
						'is_free'               => $is_free,
						'price'                 => $price,
						'website'               => $website,
						'legal_notice'          => $legal_notice,
						'platformWindows'       => $platformWindows,
						'platformMac'           => $platformMac,
						'platformLinux'         => $platformLinux,
						'metacritic'            => $metacritic,
						'metacritic_url'        => $metacritic_url,
						'coming_soon'           => $coming_soon,
						'support_info_url'      => $support_info_url,
						'content_descriptors'   => $content_descriptors,
						'release_date'          => $release_date
					  ),
				));
				//Platforms
				if($platformWindows){
					$platform = 'Windows';
					$exist_plf = term_exists( $platform, 'game_platforms' );
					if(null == $exist_plf){
						$exist_plf = wp_insert_term($platform, 'game_platforms');
					}
					$term_idw = $exist_plf['term_id'];
					wp_set_post_terms($post_id, (array)$term_idw, 'game_platforms', true);
				} 
				if($platformMac){
					$platform = 'Mac';
					$exist_plf = term_exists( $platform, 'game_platforms' );
					if(null == $exist_plf){
						$exist_plf = wp_insert_term($platform, 'game_platforms');
					}
					$term_idm = $exist_plf['term_id'];
					wp_set_post_terms($post_id, (array)$term_idm, 'game_platforms', true);
				} 
				if($platformLinux){
					$platform = 'Linux';
					$exist_plf = term_exists( $platform, 'game_platforms' );
					if(null == $exist_plf){
						$exist_plf = wp_insert_term($platform, 'game_platforms');
					}
					$term_idl = $exist_plf['term_id'];
					wp_set_post_terms($post_id, (array)$term_idl, 'game_platforms', true);
				}
				//Publisher
				if(is_array($publishers)){
					foreach($publishers as $publisher){
						$exist_pub = term_exists( $publisher, 'game_publishers' );
						if(null == $exist_pub){
							$exist_pub = wp_insert_term(
								$publisher,   // the term 
								'game_publishers', // the taxonomy
							);
						}
						$term_id = $exist_pub['term_id'];
						wp_set_post_terms($post_id, $term_id, 'game_publishers', true);
					}                    
				}

				//developer
				if(is_array($developers)){
					foreach($developers as $developer){
						$exist_pub = term_exists( $developer, 'game_developers' );
						if(null == $exist_pub){
							$exist_pub = wp_insert_term(
								$developer,   // the term 
								'game_developers', // the taxonomy
							);
						}
						$term_id = $exist_pub['term_id'];
						wp_set_post_terms($post_id, $term_id, 'game_developers', true);
					}                    
				}

				//Genres
				if(is_array($genres)){
					foreach($genres as $gener){
						$gen_name = $gener->description;
						wp_set_post_terms($post_id, $gen_name, 'stm_game_genres', true);
					}
				}

				//language
				if(is_array($lang_array)){
					foreach($lang_array as $lan){
						if (str_contains($lan, '*')) { 
							$lan_sd = strstr($lan, '*', true);
						}else{
							$lan_sd = $lan;
						}
						wp_set_post_terms($post_id, array($lan_sd,), 'game_langs', true);
					}
				}
				//Categories
				if(is_array($categories)){
					foreach($categories as $cat){
						$cat_name = $cat->description;
						$exist_cat = term_exists( $cat_name, 'stm_game_cat' );
						if(null == $exist_cat){
							$exist_cat = wp_insert_term(
								$cat_name,   // the term 
								'stm_game_cat', // the taxonomy
							);
						}
						$term_id = $exist_cat['term_id'];
						wp_set_post_terms($post_id, $term_id, 'stm_game_cat', true);
					}
				}
			} //if obj
		}//foreach
    }
}

update_steam_with_local();