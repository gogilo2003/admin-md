<?php

use Illuminate\Support\Str;

use Ogilo\AdminMd\Models\Hit;
use Ogilo\AdminMd\Models\Menu;

function current_path_name()
{
	return Route::currentRouteName();
}

function is_current_path($path_name){
	return current_path_name() === $path_name;
}

function is_admin_path()
{
	return is_path('admin');
}

function is_path($path)
{
	return starts_with(Route::currentRouteName(),$path);
}

function admin_roles($as_string=true,$sort=false)
{

    $routes = \Route::getRoutes()->getRoutes();

	if ($as_string) {
        $roles = '';

        foreach($routes as $route){
            if(Str::startsWith($route->getName(),'admin')){
                $roles .= ','.$route->getName();
            }
        }

        $roles = ltrim($roles,',');

        $raw_roles = explode(',', $roles);

        if ($sort) {
            asort($raw_roles);
            $raw_roles = array_values($raw_roles);
        }

		$string_roles = implode(',', $raw_roles);
		return $string_roles;
	}else{
        // dd($raw_roles);
        $array_roles = array();
        foreach($routes as $route){
            if(Str::startsWith($route->getName(),'admin')){
                $roles[$route->getName()] = $route;
            }
        }

        if($sort){
            asort($roles);
        }

		foreach($roles as $key => $route){
			// global $array_values;
			if ($route->getName() !== null) {
				$array_roles[$key] = str_replace(url('/').'/','',$route->uri());
			}
			// $array_roles[$value] = route($value);
		}

        // $array_roles = array_fill_keys($raw_roles,array_values($raw_roles));
        // dd($array_roles);
		return $array_roles;
	}


}

function get_hits($html=false)
{
	$hits = DB::table('hits')
				->where('url','NOT LIKE',"%admin%")
				->where('url','NOT LIKE',"%api%")
				->where('url','NOT LIKE',"%public%")
				->count();

	$result = $hits;

	if ($html) {
		$array_hits = str_split($hits);
		$string_hits = '<div class="hit_counter"><span class="num">'.implode('</span><span class="num">', $array_hits).'</span></div>';

		$result = $string_hits;
	}

	return $result;
}

function str_words($string, $words=15)
{
	$string = strip_tags($string);
	return Str::words($string,$words);
}
/**
 * Truncate string at whites spaces limiting with characters
 * @param: $string
 * The string you intend to truncate
 * @param: $characters
 * The number of characters you intend to limit the truncated string to.
 */
function str_words_alt($string, $characters=100)
{
	$string = preg_replace('/\s+/', ' ', html_entity_decode($string));
    $words = count(explode(' ',substr($string,0,$characters)));
	$string = strip_tags($string);
	return Str::words($string,$words);
}

function get_menus()
{
	return Menu::with('links')->get();
}

function get_icons(){
	return array(
		'fa fa-home'=>'Font Awesome - Home',
		'fa fa-list'=>'Font Awesome - List',
		'fa fa-list-alt'=>'Font Awesome - List',
		'fa fa-circle'=>'Font Awesome - Circle',
		'fa fa-circle-o'=>'Font Awesome - Circle',
		'fa fa-circle-o-notch'=>'Font Awesome - Circle',
		'fa fa-circle-thin'=>'Font Awesome - Circle',
		"fa fa-address-book" => "Font Awesome - Address Book",
		"fa fa-address-book-o" => "Font Awesome - Address Book",
		"fa fa-address-card" => "Font Awesome - Address Card",
		"fa fa-address-card-o" => "Font Awesome - Address Card",
		"fa fa-bandcamp" => "Font Awesome - Bandcamp",
		"fa fa-bath" => "Font Awesome - Bath",
		"fa fa-bathtub" => "Font Awesome - Bathtub",
		"fa fa-image" => "Font Awesome - Picture",
		"fa fa-drivers-license" => "Font Awesome - Drivers License",
		"fa fa-drivers-license-o" => "Font Awesome - Drivers License Outline",
		"fa fa-eercast" => "Font Awesome - EER Cast",
		"fa fa-envelope-open" => "Font Awesome - Open Envelope",
		"fa fa-envelope-open-o" => "Font Awesome - Open Envelope Outline",
		"fa fa-etsy" => "Font Awesome - Etsy",
		"fa fa-free-code-camp" => "Font Awesome - Free Code Camp",
		"fa fa-grav" => "Font Awesome - Grav",
		"fa fa-handshake-o" => "Font Awesome - Handshake Outline",
		"fa fa-id-badge" => "Font Awesome - Badge",
		"fa fa-id-card" => "Font Awesome - Card",
		"fa fa-id-card-o" => "Font Awesome - Card Outline",
		"fa fa-imdb" => "Font Awesome - IMDB",
		"fa fa-linode" => "Font Awesome - Linode",
		"fa fa-meetup" => "Font Awesome - Meet-up",
		"fa fa-microchip" => "Font Awesome - Microchip",
		"fa fa-podcast" => "Font Awesome - Pod-Cast",
		"fa fa-quora" => "Font Awesome - Quora",
		"fa fa-ravelry" => "Font Awesome - Ravalry",
		"fa fa-s15" => "Font Awesome - Sl5",
		"fa fa-shower" => "Font Awesome - Shower",
		"fa fa-snowflake-o" => "Font Awesome - Snow Flake",
		"fa fa-superpowers" => "Font Awesome - Super Power",
		"fa fa-telegram" => "Font Awesome - Telegram",
		"fa fa-thermometer" => "Font Awesome - Thermometer",
		"fa fa-thermometer-0" => "Font Awesome - Thermometer 0",
		"fa fa-thermometer-1" => "Font Awesome - Thermometer 1",
		"fa fa-thermometer-2" => "Font Awesome - Thermometer 2",
		"fa fa-thermometer-3" => "Font Awesome - Thermometer 3",
		"fa fa-thermometer-4" => "Font Awesome - Thermometer 4",
		"fa fa-thermometer-empty" => "Font Awesome - Thermometer Empty",
		"fa fa-thermometer-full" => "Font Awesome - Thermometer Full",
		"fa fa-thermometer-half" => "Font Awesome - Thermometer Half",
		"fa fa-thermometer-quarter" => "Font Awesome - Thermometer Quarter",
		"fa fa-thermometer-three-quarters" => "Font Awesome - Thermometer Three Quarters",
		"fa fa-times-rectangle" => "Font Awesome - Times Rectangle",
		"fa fa-times-rectangle-o" => "Font Awesome - Times Rectangle Outline",
		"fa fa-user-circle" => "Font Awesome - User Circle",
		"fa fa-user-circle-o" => "Font Awesome - User Circle Outline",
		"fa fa-user-o" => "Font Awesome - User Outline",
		"fa fa-vcard" => "Font Awesome - V-Card",
		"fa fa-vcard-o" => "V-Card Outline",
		"fa fa-window-close" => "Font Awesome - Window Close",
		"fa fa-window-close-o" => "Font Awesome - Window Close Outline",
		"fa fa-window-maximize" => "Font Awesome - Window Maximize",
		"fa fa-window-minimize" => "Font Awesome - Window Minimize",
		"fa fa-window-restore" => "Font Awesome - Window Restore",
		"fa fa-wpexplorer" => "Font Awesome - Window Explorer",
		"fa fa-area-chart" => "Font Awesome - Area Chart",
		"fa fa-bar-chart" => "Font Awesome - Bar Chart",
		"fa fa-bar-chart-o" => "Font Awesome - Bar Chart Outline",
		"fa fa-line-chart" => "Font Awesome - Line Chart",
		"fa fa-pie-chart" => "Font Awesome - Pie Chart",
		"fa fa-bitcoin" => "Font Awesome - Bitcoin",
		"fa fa-btc" => "Font Awesome - Bitcoin",
		"fa fa-cny" => "Font Awesome - Chinese Yen",
		"fa fa-dollar" => "Font Awesome - Doller",
		"fa fa-eur" => "Font Awesome - Euro",
		"fa fa-euro" => "Font Awesome - Euro",
		"fa fa-gbp" => "Font Awesome - Great Britain",
		"fa fa-gg" => "Font Awesome - gg",
		"fa fa-gg-circle" => "Font Awesome - Pigg Circlee",
		"fa fa-ils" => "Font Awesome - ILS",
		"fa fa-inr" => "Font Awesome - INR",
		"fa fa-jpy" => "Font Awesome - Japanese Yen",
		"fa fa-krw" => "Font Awesome - KRW",
		"fa fa-money" => "Font Awesome - Money",
		"fa fa-rmb" => "Font Awesome - RMB",
		"fa fa-rouble" => "Font Awesome - Rouble",
		"fa fa-rub" => "Font Awesome - Rouble",
		"fa fa-ruble" => "Font Awesome - Rouble",
		"fa fa-rupee" => "Font Awesome - Rupee",
		"fa fa-shekel" => "Font Awesome - Shekel",
		"fa fa-sheqel" => "Font Awesome - Shekel",
		"fa fa-try" => "Font Awesome - Turkish Lira",
		"fa fa-turkish-lira" => "Font Awesome - Turkish Lira",
		"fa fa-usd" => "Font Awesome - US Doller",
		"fa fa-viacoin" => "Font Awesome - Via Coin",
		"fa fa-won" => "Font Awesome - Won",
		"fa fa-yen" => "Font Awesome - Japanese Yen",
		"icon-adjustments"=>"adjustments",
		"icon-alarmclock"=>"Alarm Clock",
		"icon-anchor"=>"anchor",
		"icon-aperture"=>"aperture",
		"icon-attachments"=>"attachments",
		"icon-bargraph"=>"bargraph",
		"icon-basket"=>"basket",
		"icon-beaker"=>"beaker",
		"icon-bike"=>"bike",
		"icon-book-open"=>"book-open",
		"icon-briefcase2"=>"briefcase2",
		"icon-browser2"=>"browser2",
		"icon-calendar"=>"calendar",
		"icon-camera"=>"camera",
		"icon-caution"=>"caution",
		"icon-chat"=>"chat",
		"icon-circle-compass"=>"circle-compass",
		"icon-clipboard"=>"clipboard",
		"icon-clock2"=>"clock2",
		"icon-cloud"=>"cloud",
		"icon-compass"=>"compass",
		"icon-desktop"=>"desktop",
		"icon-dial"=>"dial",
		"icon-document"=>"document",
		"icon-documents"=>"documents",
		"icon-download"=>"download",
		"icon-dribbble"=>"dribbble",
		"icon-edit"=>"edit",
		"icon-envelope"=>"envelope",
		"icon-expand"=>"expand",
		"icon-facebook"=>"facebook",
		"icon-flag"=>"flag",
		"icon-focus"=>"focus",
		"icon-gears"=>"gears",
		"icon-genius"=>"genius",
		"icon-gift"=>"gift",
		"icon-global"=>"global",
		"icon-globe2"=>"globe2",
		"icon-googleplus"=>"googleplus",
		"icon-grid"=>"grid",
		"icon-happy"=>"happy",
		"icon-hazardous"=>"hazardous",
		"icon-heart2"=>"heart2",
		"icon-hotairballoon"=>"hotairballoon",
		"icon-hourglass"=>"hourglass",
		"icon-key"=>"key",
		"icon-laptop2"=>"laptop2",
		"icon-layers"=>"layers",
		"icon-lifesaver"=>"lifesaver",
		"icon-lightbulb"=>"lightbulb",
		"icon-linegraph"=>"linegraph",
		"icon-linkedin"=>"linkedin",
		"icon-lock"=>"lock",
		"icon-magnifying-glass"=>"magnifying-glass",
		"icon-map-pin"=>"map-pin",
		"icon-map"=>"map",
		"icon-megaphone"=>"megaphone",
		"icon-mic"=>"mic",
		"icon-mobile"=>"mobile",
		"icon-newspaper"=>"newspaper",
		"icon-notebook"=>"notebook",
		"icon-paintbrush"=>"paintbrush",
		"icon-paperclip"=>"paperclip",
		"icon-pencil"=>"pencil",
		"icon-phone"=>"phone",
		"icon-picture"=>"picture",
		"icon-pictures"=>"pictures",
		"icon-piechart"=>"piechart",
		"icon-presentation"=>"presentation",
		"icon-pricetags"=>"pricetags",
		"icon-printer2"=>"printer2",
		"icon-profile-female"=>"profile-female",
		"icon-profile-male"=>"profile-male",
		"icon-puzzle"=>"puzzle",
		"icon-quote"=>"quote",
		"icon-recycle"=>"recycle",
		"icon-refresh2"=>"refresh2",
		"icon-ribbon"=>"ribbon",
		"icon-rss"=>"rss",
		"icon-sad"=>"sad",
		"icon-scissors"=>"scissors",
		"icon-scope"=>"scope",
		"icon-search"=>"search",
		"icon-shield"=>"shield",
		"icon-speedometer"=>"speedometer",
		"icon-strategy"=>"strategy",
		"icon-streetsign"=>"streetsign",
		"icon-tablet"=>"tablet",
		"icon-telescope"=>"telescope",
		"icon-toolbox"=>"toolbox",
		"icon-tools"=>"tools",
		"icon-tools2"=>"tools2",
		"icon-traget"=>"traget",
		"icon-trophy"=>"trophy",
		"icon-tumblr"=>"tumblr",
		"icon-twitter"=>"twitter",
		"icon-upload"=>"upload",
		"icon-video"=>"video",
		"icon-wallet"=>"wallet",
		"icon-wine"=>"wine",
		"icon-apartment_building"=>"apartment_building",
		"icon-architectural_pen"=>"architectural_pen",
		"icon-backpack"=>"backpack",
		"icon-bomb"=>"bomb",
		"icon-book_download"=>"book_download",
		"icon-book"=>"book",
		"icon-briefcase"=>"briefcase",
		"icon-browser"=>"browser",
		"icon-buffet_tray"=>"buffet_tray",
		"icon-camera_photo"=>"camera_photo",
		"icon-camera_video"=>"camera_video",
		"icon-cap_chef"=>"cap_chef",
		"icon-cap_crown"=>"cap_crown",
		"icon-cap_hat"=>"cap_hat",
		"icon-car_carrer"=>"car_carrer",
		"icon-cart_down"=>"cart_down",
		"icon-cart_up"=>"cart_up",
		"icon-chair_sofa"=>"chair_sofa",
		"icon-clock"=>"clock",
		"icon-coffee_blander"=>"coffee_blander",
		"icon-color_plate"=>"color_plate",
		"icon-comment_favorite"=>"comment_favorite",
		"icon-comment_with_dot"=>"comment_with_dot",
		"icon-computer_duel"=>"computer_duel",
		"icon-computer_imac_slim"=>"computer_imac_slim",
		"icon-computer_imac_thick"=>"computer_imac_thick",
		"icon-computer_monitor"=>"computer_monitor",
		"icon-coverage"=>"coverage",
		"icon-crop"=>"crop",
		"icon-dashboard_meter"=>"dashboard_meter",
		"icon-database"=>"database",
		"icon-device_ipad"=>"device_ipad",
		"icon-device_iphone"=>"device_iphone",
		"icon-device_ipod_earphone"=>"device_ipod_earphone",
		"icon-device_ipod_headphone"=>"device_ipod_headphone",
		"icon-device_ipod_nano"=>"device_ipod_nano",
		"icon-diary"=>"diary",
		"icon-envelope_back"=>"envelope_back",
		"icon-equalizer"=>"equalizer",
		"icon-gear_wheel"=>"gear_wheel",
		"icon-glass_coffee"=>"glass_coffee",
		"icon-glass_juice"=>"glass_juice",
		"icon-globe"=>"globe",
		"icon-grid_line"=>"grid_line",
		"icon-hand_bag"=>"hand_bag",
		"icon-handbag"=>"handbag",
		"icon-head_phone"=>"head_phone",
		"icon-heart"=>"heart",
		"icon-home"=>"home",
		"icon-hot_dog"=>"hot_dog",
		"icon-ice_cream"=>"ice_cream",
		"icon-ink_feather"=>"ink_feather",
		"icon-input_injection"=>"input_injection",
		"icon-jar_drop"=>"jar_drop",
		"icon-laptop_mac_book"=>"laptop_mac_book",
		"icon-laptop"=>"laptop",
		"icon-link"=>"link",
		"icon-lock_close"=>"lock_close",
		"icon-lock_open"=>"lock_open",
		"icon-magic_wand"=>"magic_wand",
		"icon-magnet"=>"magnet",
		"icon-mail_envelope"=>"mail_envelope",
		"icon-map_pointer"=>"map_pointer",
		"icon-multiple_paper"=>"multiple_paper",
		"icon-mustache"=>"mustache",
		"icon-paint_brush_wall_roller"=>"paint_brush_wall_roller",
		"icon-paint_brush"=>"paint_brush",
		"icon-paper_pencil"=>"paper_pencil",
		"icon-pen_fountain"=>"pen_fountain",
		"icon-pen_point_rounded"=>"pen_point_rounded",
		"icon-pen_point"=>"pen_point",
		"icon-photo_frame"=>"photo_frame",
		"icon-pot_fire"=>"pot_fire",
		"icon-printer"=>"printer",
		"icon-refresh"=>"refresh",
		"icon-remote"=>"remote",
		"icon-seal"=>"seal",
		"icon-shield_plus"=>"shield_plus",
		"icon-shoes"=>"shoes",
		"icon-skull"=>"skull",
		"icon-smile_emoticon"=>"smile_emoticon",
		"icon-sound_note"=>"sound_note",
		"icon-sound_recorder"=>"sound_recorder",
		"icon-spoon_fork"=>"spoon_fork",
		"icon-square_anchor_point"=>"square_anchor_point",
		"icon-support_tools"=>"support_tools",
		"icon-support_underwater"=>"support_underwater",
		"icon-target_arrow"=>"target_arrow",
		"icon-tea_pot"=>"tea_pot",
		"icon-television_remote"=>"television_remote",
		"icon-tools_creative"=>"tools_creative",
		"icon-tools_measurement"=>"tools_measurement",
		"icon-trash"=>"trash",
		"icon-tube_measurement"=>"tube_measurement",
		"icon-umbralla"=>"umbralla",
		"icon-user_comment"=>"user_comment",
		"icon-user"=>"user",
		"icon-arrows_anticlockwise_dashed"=>"arrows_anticlockwise_dashed",
		"icon-arrows_anticlockwise"=>"arrows_anticlockwise",
		"icon-arrows_button_down"=>"arrows_button_down",
		"icon-arrows_button_off"=>"arrows_button_off",
		"icon-arrows_button_on"=>"arrows_button_on",
		"icon-arrows_button_up"=>"arrows_button_up",
		"icon-arrows_check"=>"arrows_check",
		"icon-arrows_circle_check"=>"arrows_circle_check",
		"icon-arrows_circle_down"=>"arrows_circle_down",
		"icon-arrows_circle_downleft"=>"arrows_circle_downleft",
		"icon-arrows_circle_downright"=>"arrows_circle_downright",
		"icon-arrows_circle_left"=>"arrows_circle_left",
		"icon-arrows_circle_minus"=>"arrows_circle_minus",
		"icon-arrows_circle_plus"=>"arrows_circle_plus",
		"icon-arrows_circle_remove"=>"arrows_circle_remove",
		"icon-arrows_circle_right"=>"arrows_circle_right",
		"icon-arrows_circle_up"=>"arrows_circle_up",
		"icon-arrows_circle_upleft"=>"arrows_circle_upleft",
		"icon-arrows_circle_upright"=>"arrows_circle_upright",
		"icon-arrows_clockwise_dashed"=>"arrows_clockwise_dashed",
		"icon-arrows_clockwise"=>"arrows_clockwise",
		"icon-arrows_compress"=>"arrows_compress",
		"icon-arrows_deny"=>"arrows_deny",
		"icon-arrows_diagonal"=>"arrows_diagonal",
		"icon-arrows_diagonal2"=>"arrows_diagonal2",
		"icon-arrows_down_double-34"=>"arrows_down_double-34",
		"icon-arrows_down"=>"arrows_down",
		"icon-arrows_downleft"=>"arrows_downleft",
		"icon-arrows_downright"=>"arrows_downright",
		"icon-arrows_drag_down_dashed"=>"arrows_drag_down_dashed",
		"icon-arrows_drag_down"=>"arrows_drag_down",
		"icon-arrows_drag_horiz"=>"arrows_drag_horiz",
		"icon-arrows_drag_left_dashed"=>"arrows_drag_left_dashed",
		"icon-arrows_drag_left"=>"arrows_drag_left",
		"icon-arrows_drag_right_dashed"=>"arrows_drag_right_dashed",
		"icon-arrows_drag_right"=>"arrows_drag_right",
		"icon-arrows_drag_up_dashed"=>"arrows_drag_up_dashed",
		"icon-arrows_drag_up"=>"arrows_drag_up",
		"icon-arrows_drag_vert"=>"arrows_drag_vert",
		"icon-arrows_exclamation"=>"arrows_exclamation",
		"icon-arrows_expand_diagonal1"=>"arrows_expand_diagonal1",
		"icon-arrows_expand_horizontal1"=>"arrows_expand_horizontal1",
		"icon-arrows_expand_vertical1"=>"arrows_expand_vertical1",
		"icon-arrows_expand"=>"arrows_expand",
		"icon-arrows_fit_horizontal"=>"arrows_fit_horizontal",
		"icon-arrows_fit_vertical"=>"arrows_fit_vertical",
		"icon-arrows_glide_horizontal"=>"arrows_glide_horizontal",
		"icon-arrows_glide_vertical"=>"arrows_glide_vertical",
		"icon-arrows_glide"=>"arrows_glide",
		"icon-arrows_hamburger2"=>"arrows_hamburger2",
		"icon-arrows_hamburger1"=>"arrows_hamburger1",
		"icon-arrows_horizontal"=>"arrows_horizontal",
		"icon-arrows_info"=>"arrows_info",
		"icon-arrows_keyboard_alt"=>"arrows_keyboard_alt",
		"icon-arrows_keyboard_cmd-29"=>"arrows_keyboard_cmd-29",
		"icon-arrows_keyboard_delete"=>"arrows_keyboard_delete",
		"icon-arrows_keyboard_down-28"=>"arrows_keyboard_down-28",
		"icon-arrows_keyboard_left"=>"arrows_keyboard_left",
		"icon-arrows_keyboard_return"=>"arrows_keyboard_return",
		"icon-arrows_keyboard_right"=>"arrows_keyboard_right",
		"icon-arrows_keyboard_shift"=>"arrows_keyboard_shift",
		"icon-arrows_keyboard_tab"=>"arrows_keyboard_tab",
		"icon-arrows_keyboard_up"=>"arrows_keyboard_up",
		"icon-arrows_left_double-32"=>"arrows_left_double-32",
		"icon-arrows_left"=>"arrows_left",
		"icon-arrows_minus"=>"arrows_minus",
		"icon-arrows_move_bottom"=>"arrows_move_bottom",
		"icon-arrows_move_left"=>"arrows_move_left",
		"icon-arrows_move_right"=>"arrows_move_right",
		"icon-arrows_move_top"=>"arrows_move_top",
		"icon-arrows_move"=>"arrows_move",
		"icon-arrows_move2"=>"arrows_move2",
		"icon-arrows_plus"=>"arrows_plus",
		"icon-arrows_question"=>"arrows_question",
		"icon-arrows_remove"=>"arrows_remove",
		"icon-arrows_right_double-31"=>"arrows_right_double-31",
		"icon-arrows_right"=>"arrows_right",
		"icon-arrows_rotate_anti_dashed"=>"arrows_rotate_anti_dashed",
		"icon-arrows_rotate_anti"=>"arrows_rotate_anti",
		"icon-arrows_rotate_dashed"=>"arrows_rotate_dashed",
		"icon-arrows_rotate"=>"arrows_rotate",
		"icon-arrows_shrink_diagonal1"=>"arrows_shrink_diagonal1",
		"icon-arrows_shrink_diagonal2"=>"arrows_shrink_diagonal2",
		"icon-arrows_shrink_horizonal2"=>"arrows_shrink_horizonal2",
		"icon-arrows_shrink_horizontal1"=>"arrows_shrink_horizontal1",
		"icon-arrows_shrink_vertical1"=>"arrows_shrink_vertical1",
		"icon-arrows_shrink_vertical2"=>"arrows_shrink_vertical2",
		"icon-arrows_shrink"=>"arrows_shrink",
		"icon-arrows_sign_down"=>"arrows_sign_down",
		"icon-arrows_sign_left"=>"arrows_sign_left",
		"icon-arrows_sign_right"=>"arrows_sign_right",
		"icon-arrows_sign_up"=>"arrows_sign_up",
		"icon-arrows_slide_down1"=>"arrows_slide_down1",
		"icon-arrows_slide_down2"=>"arrows_slide_down2",
		"icon-arrows_slide_left1"=>"arrows_slide_left1",
		"icon-arrows_slide_left2"=>"arrows_slide_left2",
		"icon-arrows_slide_right1"=>"arrows_slide_right1",
		"icon-arrows_slide_right2"=>"arrows_slide_right2",
		"icon-arrows_slide_up1"=>"arrows_slide_up1",
		"icon-arrows_slide_up2"=>"arrows_slide_up2",
		"icon-arrows_slim_down_dashed"=>"arrows_slim_down_dashed",
		"icon-arrows_slim_down"=>"arrows_slim_down",
		"icon-arrows_slim_left_dashed"=>"arrows_slim_left_dashed",
		"icon-arrows_slim_left"=>"arrows_slim_left",
		"icon-arrows_slim_right_dashed"=>"arrows_slim_right_dashed",
		"icon-arrows_slim_right"=>"arrows_slim_right",
		"icon-arrows_slim_up_dashed"=>"arrows_slim_up_dashed",
		"icon-arrows_slim_up"=>"arrows_slim_up",
		"icon-arrows_square_check"=>"arrows_square_check",
		"icon-arrows_square_down"=>"arrows_square_down",
		"icon-arrows_square_downleft"=>"arrows_square_downleft",
		"icon-arrows_square_downright"=>"arrows_square_downright",
		"icon-arrows_square_left"=>"arrows_square_left",
		"icon-arrows_square_minus"=>"arrows_square_minus",
		"icon-arrows_square_plus"=>"arrows_square_plus",
		"icon-arrows_square_remove"=>"arrows_square_remove",
		"icon-arrows_square_right"=>"arrows_square_right",
		"icon-arrows_square_up"=>"arrows_square_up",
		"icon-arrows_square_upleft"=>"arrows_square_upleft",
		"icon-arrows_square_upright"=>"arrows_square_upright",
		"icon-arrows_squares"=>"arrows_squares",
		"icon-arrows_stretch_diagonal1"=>"arrows_stretch_diagonal1",
		"icon-arrows_stretch_diagonal2"=>"arrows_stretch_diagonal2",
		"icon-arrows_stretch_diagonal3"=>"arrows_stretch_diagonal3",
		"icon-arrows_stretch_diagonal4"=>"arrows_stretch_diagonal4",
		"icon-arrows_stretch_horizontal1"=>"arrows_stretch_horizontal1",
		"icon-arrows_stretch_horizontal2"=>"arrows_stretch_horizontal2",
		"icon-arrows_stretch_vertical1"=>"arrows_stretch_vertical1",
		"icon-arrows_stretch_vertical2"=>"arrows_stretch_vertical2",
		"icon-arrows_switch_horizontal"=>"arrows_switch_horizontal",
		"icon-arrows_switch_vertical"=>"arrows_switch_vertical",
		"icon-arrows_up_double-33"=>"arrows_up_double-33",
		"icon-arrows_up"=>"arrows_up",
		"icon-arrows_upleft"=>"arrows_upleft",
		"icon-arrows_upright"=>"arrows_upright",
		"icon-arrows_vertical"=>"arrows_vertical",
		"icon-basic_accelerator"=>"basic_accelerator",
		"icon-basic_alarm"=>"basic_alarm",
		"icon-basic_anchor"=>"basic_anchor",
		"icon-basic_anticlockwise"=>"basic_anticlockwise",
		"icon-basic_archive_full"=>"basic_archive_full",
		"icon-basic_archive"=>"basic_archive",
		"icon-basic_ban"=>"basic_ban",
		"icon-basic_battery_charge"=>"basic_battery_charge",
		"icon-basic_battery_empty"=>"basic_battery_empty",
		"icon-basic_battery_full"=>"basic_battery_full",
		"icon-basic_battery_half"=>"basic_battery_half",
		"icon-basic_bolt"=>"basic_bolt",
		"icon-basic_book_pen"=>"basic_book_pen",
		"icon-basic_book_pencil"=>"basic_book_pencil",
		"icon-basic_book"=>"basic_book",
		"icon-basic_bookmark"=>"basic_bookmark",
		"icon-basic_calculator"=>"basic_calculator",
		"icon-basic_calendar"=>"basic_calendar",
		"icon-basic_cards_diamonds"=>"basic_cards_diamonds",
		"icon-basic_cards_hearts"=>"basic_cards_hearts",
		"icon-basic_case"=>"basic_case",
		"icon-basic_chronometer"=>"basic_chronometer",
		"icon-basic_clessidre"=>"basic_clessidre",
		"icon-basic_clock"=>"basic_clock",
		"icon-basic_clockwise"=>"basic_clockwise",
		"icon-basic_cloud"=>"basic_cloud",
		"icon-basic_clubs"=>"basic_clubs",
		"icon-basic_compass"=>"basic_compass",
		"icon-basic_cup"=>"basic_cup",
		"icon-basic_diamonds"=>"basic_diamonds",
		"icon-basic_display"=>"basic_display",
		"icon-basic_download"=>"basic_download",
		"icon-basic_elaboration_bookmark_checck"=>"basic_elaboration_bookmark_checck",
		"icon-basic_elaboration_bookmark_minus"=>"basic_elaboration_bookmark_minus",
		"icon-basic_elaboration_bookmark_plus"=>"basic_elaboration_bookmark_plus",
		"icon-basic_elaboration_bookmark_remove"=>"basic_elaboration_bookmark_remove",
		"icon-basic_elaboration_briefcase_check"=>"basic_elaboration_briefcase_check",
		"icon-basic_elaboration_briefcase_download"=>"basic_elaboration_briefcase_download",
		"icon-basic_elaboration_briefcase_flagged"=>"basic_elaboration_briefcase_flagged",
		"icon-basic_elaboration_briefcase_minus"=>"basic_elaboration_briefcase_minus",
		"icon-basic_elaboration_briefcase_plus"=>"basic_elaboration_briefcase_plus",
		"icon-basic_elaboration_briefcase_refresh"=>"basic_elaboration_briefcase_refresh",
		"icon-basic_elaboration_briefcase_remove"=>"basic_elaboration_briefcase_remove",
		"icon-basic_elaboration_briefcase_search"=>"basic_elaboration_briefcase_search",
		"icon-basic_elaboration_briefcase_star"=>"basic_elaboration_briefcase_star",
		"icon-basic_elaboration_briefcase_upload"=>"basic_elaboration_briefcase_upload",
		"icon-basic_elaboration_browser_check"=>"basic_elaboration_browser_check",
		"icon-basic_elaboration_browser_download"=>"basic_elaboration_browser_download",
		"icon-basic_elaboration_browser_minus"=>"basic_elaboration_browser_minus",
		"icon-basic_elaboration_browser_plus"=>"basic_elaboration_browser_plus",
		"icon-basic_elaboration_browser_refresh"=>"basic_elaboration_browser_refresh",
		"icon-basic_elaboration_browser_remove"=>"basic_elaboration_browser_remove",
		"icon-basic_elaboration_browser_search"=>"basic_elaboration_browser_search",
		"icon-basic_elaboration_browser_star"=>"basic_elaboration_browser_star",
		"icon-basic_elaboration_browser_upload"=>"basic_elaboration_browser_upload",
		"icon-basic_elaboration_calendar_check"=>"basic_elaboration_calendar_check",
		"icon-basic_elaboration_calendar_cloud"=>"basic_elaboration_calendar_cloud",
		"icon-basic_elaboration_calendar_download"=>"basic_elaboration_calendar_download",
		"icon-basic_elaboration_calendar_empty"=>"basic_elaboration_calendar_empty",
		"icon-basic_elaboration_calendar_flagged"=>"basic_elaboration_calendar_flagged",
		"icon-basic_elaboration_calendar_heart"=>"basic_elaboration_calendar_heart",
		"icon-basic_elaboration_calendar_minus"=>"basic_elaboration_calendar_minus",
		"icon-basic_elaboration_calendar_next"=>"basic_elaboration_calendar_next",
		"icon-basic_elaboration_calendar_noaccess"=>"basic_elaboration_calendar_noaccess",
		"icon-basic_elaboration_calendar_pencil"=>"basic_elaboration_calendar_pencil",
		"icon-basic_elaboration_calendar_plus"=>"basic_elaboration_calendar_plus",
		"icon-basic_elaboration_calendar_previous"=>"basic_elaboration_calendar_previous",
		"icon-basic_elaboration_calendar_refresh"=>"basic_elaboration_calendar_refresh",
		"icon-basic_elaboration_calendar_remove"=>"basic_elaboration_calendar_remove",
		"icon-basic_elaboration_calendar_search"=>"basic_elaboration_calendar_search",
		"icon-basic_elaboration_calendar_star"=>"basic_elaboration_calendar_star",
		"icon-basic_elaboration_calendar_upload"=>"basic_elaboration_calendar_upload",
		"icon-basic_elaboration_cloud_check"=>"basic_elaboration_cloud_check",
		"icon-basic_elaboration_cloud_download"=>"basic_elaboration_cloud_download",
		"icon-basic_elaboration_cloud_minus"=>"basic_elaboration_cloud_minus",
		"icon-basic_elaboration_cloud_noaccess"=>"basic_elaboration_cloud_noaccess",
		"icon-basic_elaboration_cloud_plus"=>"basic_elaboration_cloud_plus",
		"icon-basic_elaboration_cloud_refresh"=>"basic_elaboration_cloud_refresh",
		"icon-basic_elaboration_cloud_remove"=>"basic_elaboration_cloud_remove",
		"icon-basic_elaboration_cloud_search"=>"basic_elaboration_cloud_search",
		"icon-basic_elaboration_cloud_upload"=>"basic_elaboration_cloud_upload",
		"icon-basic_elaboration_document_check"=>"basic_elaboration_document_check",
		"icon-basic_elaboration_document_cloud"=>"basic_elaboration_document_cloud",
		"icon-basic_elaboration_document_download"=>"basic_elaboration_document_download",
		"icon-basic_elaboration_document_flagged"=>"basic_elaboration_document_flagged",
		"icon-basic_elaboration_document_graph"=>"basic_elaboration_document_graph",
		"icon-basic_elaboration_document_heart"=>"basic_elaboration_document_heart",
		"icon-basic_elaboration_document_minus"=>"basic_elaboration_document_minus",
		"icon-basic_elaboration_document_next"=>"basic_elaboration_document_next",
		"icon-basic_elaboration_document_noaccess"=>"basic_elaboration_document_noaccess",
		"icon-basic_elaboration_document_note"=>"basic_elaboration_document_note",
		"icon-basic_elaboration_document_pencil"=>"basic_elaboration_document_pencil",
		"icon-basic_elaboration_document_picture"=>"basic_elaboration_document_picture",
		"icon-basic_elaboration_document_plus"=>"basic_elaboration_document_plus",
		"icon-basic_elaboration_document_previous"=>"basic_elaboration_document_previous",
		"icon-basic_elaboration_document_refresh"=>"basic_elaboration_document_refresh",
		"icon-basic_elaboration_document_remove"=>"basic_elaboration_document_remove",
		"icon-basic_elaboration_document_search"=>"basic_elaboration_document_search",
		"icon-basic_elaboration_document_star"=>"basic_elaboration_document_star",
		"icon-basic_elaboration_document_upload"=>"basic_elaboration_document_upload",
		"icon-basic_elaboration_folder_check"=>"basic_elaboration_folder_check",
		"icon-basic_elaboration_folder_cloud"=>"basic_elaboration_folder_cloud",
		"icon-basic_elaboration_folder_document"=>"basic_elaboration_folder_document",
		"icon-basic_elaboration_folder_download"=>"basic_elaboration_folder_download",
		"icon-basic_elaboration_folder_flagged"=>"basic_elaboration_folder_flagged",
		"icon-basic_elaboration_folder_graph"=>"basic_elaboration_folder_graph",
		"icon-basic_elaboration_folder_heart"=>"basic_elaboration_folder_heart",
		"icon-basic_elaboration_folder_minus"=>"basic_elaboration_folder_minus",
		"icon-basic_elaboration_folder_next"=>"basic_elaboration_folder_next",
		"icon-basic_elaboration_folder_noaccess"=>"basic_elaboration_folder_noaccess",
		"icon-basic_elaboration_folder_note"=>"basic_elaboration_folder_note",
		"icon-basic_elaboration_folder_pencil"=>"basic_elaboration_folder_pencil",
		"icon-basic_elaboration_folder_picture"=>"basic_elaboration_folder_picture",
		"icon-basic_elaboration_folder_plus"=>"basic_elaboration_folder_plus",
		"icon-basic_elaboration_folder_previous"=>"basic_elaboration_folder_previous",
		"icon-basic_elaboration_folder_refresh"=>"basic_elaboration_folder_refresh",
		"icon-basic_elaboration_folder_remove"=>"basic_elaboration_folder_remove",
		"icon-basic_elaboration_folder_search"=>"basic_elaboration_folder_search",
		"icon-basic_elaboration_folder_star"=>"basic_elaboration_folder_star",
		"icon-basic_elaboration_folder_upload"=>"basic_elaboration_folder_upload",
		"icon-basic_elaboration_mail_check"=>"basic_elaboration_mail_check",
		"icon-basic_elaboration_mail_cloud"=>"basic_elaboration_mail_cloud",
		"icon-basic_elaboration_mail_document"=>"basic_elaboration_mail_document",
		"icon-basic_elaboration_mail_download"=>"basic_elaboration_mail_download",
		"icon-basic_elaboration_mail_flagged"=>"basic_elaboration_mail_flagged",
		"icon-basic_elaboration_mail_heart"=>"basic_elaboration_mail_heart",
		"icon-basic_elaboration_mail_next"=>"basic_elaboration_mail_next",
		"icon-basic_elaboration_mail_noaccess"=>"basic_elaboration_mail_noaccess",
		"icon-basic_elaboration_mail_note"=>"basic_elaboration_mail_note",
		"icon-basic_elaboration_mail_pencil"=>"basic_elaboration_mail_pencil",
		"icon-basic_elaboration_mail_picture"=>"basic_elaboration_mail_picture",
		"icon-basic_elaboration_mail_previous"=>"basic_elaboration_mail_previous",
		"icon-basic_elaboration_mail_refresh"=>"basic_elaboration_mail_refresh",
		"icon-basic_elaboration_mail_remove"=>"basic_elaboration_mail_remove",
		"icon-basic_elaboration_mail_search"=>"basic_elaboration_mail_search",
		"icon-basic_elaboration_mail_star"=>"basic_elaboration_mail_star",
		"icon-basic_elaboration_mail_upload"=>"basic_elaboration_mail_upload",
		"icon-basic_elaboration_message_check"=>"basic_elaboration_message_check",
		"icon-basic_elaboration_message_dots"=>"basic_elaboration_message_dots",
		"icon-basic_elaboration_message_happy"=>"basic_elaboration_message_happy",
		"icon-basic_elaboration_message_heart"=>"basic_elaboration_message_heart",
		"icon-basic_elaboration_message_minus"=>"basic_elaboration_message_minus",
		"icon-basic_elaboration_message_note"=>"basic_elaboration_message_note",
		"icon-basic_elaboration_message_plus"=>"basic_elaboration_message_plus",
		"icon-basic_elaboration_message_refresh"=>"basic_elaboration_message_refresh",
		"icon-basic_elaboration_message_remove"=>"basic_elaboration_message_remove",
		"icon-basic_elaboration_message_sad"=>"basic_elaboration_message_sad",
		"icon-basic_elaboration_smartphone_cloud"=>"basic_elaboration_smartphone_cloud",
		"icon-basic_elaboration_smartphone_heart"=>"basic_elaboration_smartphone_heart",
		"icon-basic_elaboration_smartphone_noaccess"=>"basic_elaboration_smartphone_noaccess",
		"icon-basic_elaboration_smartphone_note"=>"basic_elaboration_smartphone_note",
		"icon-basic_elaboration_smartphone_pencil"=>"basic_elaboration_smartphone_pencil",
		"icon-basic_elaboration_smartphone_picture"=>"basic_elaboration_smartphone_picture",
		"icon-basic_elaboration_smartphone_refresh"=>"basic_elaboration_smartphone_refresh",
		"icon-basic_elaboration_smartphone_search"=>"basic_elaboration_smartphone_search",
		"icon-basic_elaboration_tablet_cloud"=>"basic_elaboration_tablet_cloud",
		"icon-basic_elaboration_tablet_heart"=>"basic_elaboration_tablet_heart",
		"icon-basic_elaboration_tablet_noaccess"=>"basic_elaboration_tablet_noaccess",
		"icon-basic_elaboration_tablet_note"=>"basic_elaboration_tablet_note",
		"icon-basic_elaboration_tablet_pencil"=>"basic_elaboration_tablet_pencil",
		"icon-basic_elaboration_tablet_picture"=>"basic_elaboration_tablet_picture",
		"icon-basic_elaboration_tablet_refresh"=>"basic_elaboration_tablet_refresh",
		"icon-basic_elaboration_tablet_search"=>"basic_elaboration_tablet_search",
		"icon-basic_elaboration_todolist_2"=>"basic_elaboration_todolist_2",
		"icon-basic_elaboration_todolist_check"=>"basic_elaboration_todolist_check",
		"icon-basic_elaboration_todolist_cloud"=>"basic_elaboration_todolist_cloud",
		"icon-basic_elaboration_todolist_download"=>"basic_elaboration_todolist_download",
		"icon-basic_elaboration_todolist_flagged"=>"basic_elaboration_todolist_flagged",
		"icon-basic_elaboration_todolist_minus"=>"basic_elaboration_todolist_minus",
		"icon-basic_elaboration_todolist_noaccess"=>"basic_elaboration_todolist_noaccess",
		"icon-basic_elaboration_todolist_pencil"=>"basic_elaboration_todolist_pencil",
		"icon-basic_elaboration_todolist_plus"=>"basic_elaboration_todolist_plus",
		"icon-basic_elaboration_todolist_refresh"=>"basic_elaboration_todolist_refresh",
		"icon-basic_elaboration_todolist_remove"=>"basic_elaboration_todolist_remove",
		"icon-basic_elaboration_todolist_search"=>"basic_elaboration_todolist_search",
		"icon-basic_elaboration_todolist_star"=>"basic_elaboration_todolist_star",
		"icon-basic_elaboration_todolist_upload"=>"basic_elaboration_todolist_upload",
		"icon-basic_exclamation"=>"basic_exclamation",
		"icon-basic_eye_closed"=>"basic_eye_closed",
		"icon-basic_eye"=>"basic_eye",
		"icon-basic_female"=>"basic_female",
		"icon-basic_flag1"=>"basic_flag1",
		"icon-basic_flag2"=>"basic_flag2",
		"icon-basic_floppydisk"=>"basic_floppydisk",
		"icon-basic_folder_multiple"=>"basic_folder_multiple",
		"icon-basic_folder"=>"basic_folder",
		"icon-basic_gear"=>"basic_gear",
		"icon-basic_geolocalize-01"=>"basic_geolocalize-01",
		"icon-basic_geolocalize-05"=>"basic_geolocalize-05",
		"icon-basic_globe"=>"basic_globe",
		"icon-basic_gunsight"=>"basic_gunsight",
		"icon-basic_hammer"=>"basic_hammer",
		"icon-basic_headset"=>"basic_headset",
		"icon-basic_heart_broken"=>"basic_heart_broken",
		"icon-basic_heart"=>"basic_heart",
		"icon-basic_helm"=>"basic_helm",
		"icon-basic_home"=>"basic_home",
		"icon-basic_info"=>"basic_info",
		"icon-basic_ipod"=>"basic_ipod",
		"icon-basic_joypad"=>"basic_joypad",
		"icon-basic_key"=>"basic_key",
		"icon-basic_keyboard"=>"basic_keyboard",
		"icon-basic_laptop"=>"basic_laptop",
		"icon-basic_life_buoy"=>"basic_life_buoy",
		"icon-basic_lightbulb"=>"basic_lightbulb",
		"icon-basic_link"=>"basic_link",
		"icon-basic_lock_open"=>"basic_lock_open",
		"icon-basic_lock"=>"basic_lock",
		"icon-basic_magic_mouse"=>"basic_magic_mouse",
		"icon-basic_magnifier_minus"=>"basic_magnifier_minus",
		"icon-basic_magnifier_plus"=>"basic_magnifier_plus",
		"icon-basic_magnifier"=>"basic_magnifier",
		"icon-basic_mail_multiple"=>"basic_mail_multiple",
		"icon-basic_mail_open_text"=>"basic_mail_open_text",
		"icon-basic_mail_open"=>"basic_mail_open",
		"icon-basic_mail"=>"basic_mail",
		"icon-basic_male"=>"basic_male",
		"icon-basic_map"=>"basic_map",
		"icon-basic_message_multiple"=>"basic_message_multiple",
		"icon-basic_message_txt"=>"basic_message_txt",
		"icon-basic_message"=>"basic_message",
		"icon-basic_mixer2"=>"basic_mixer2",
		"icon-basic_mouse"=>"basic_mouse",
		"icon-basic_notebook_pen"=>"basic_notebook_pen",
		"icon-basic_notebook_pencil"=>"basic_notebook_pencil",
		"icon-basic_notebook"=>"basic_notebook",
		"icon-basic_paperplane"=>"basic_paperplane",
		"icon-basic_pencil_ruler_pen"=>"basic_pencil_ruler_pen",
		"icon-basic_pencil_ruler"=>"basic_pencil_ruler",
		"icon-basic_photo"=>"basic_photo",
		"icon-basic_picture_multiple"=>"basic_picture_multiple",
		"icon-basic_picture"=>"basic_picture",
		"icon-basic_pin1"=>"basic_pin1",
		"icon-basic_pin2"=>"basic_pin2",
		"icon-basic_postcard_multiple"=>"basic_postcard_multiple",
		"icon-basic_postcard"=>"basic_postcard",
		"icon-basic_printer"=>"basic_printer",
		"icon-basic_question"=>"basic_question",
		"icon-basic_rss"=>"basic_rss",
		"icon-basic_server_cloud"=>"basic_server_cloud",
		"icon-basic_server_download"=>"basic_server_download",
		"icon-basic_server_upload"=>"basic_server_upload",
		"icon-basic_server"=>"basic_server",
		"icon-basic_server2"=>"basic_server2",
		"icon-basic_settings"=>"basic_settings",
		"icon-basic_share"=>"basic_share",
		"icon-basic_sheet_multiple"=>"basic_sheet_multiple",
		"icon-basic_sheet_pen"=>"basic_sheet_pen",
		"icon-basic_sheet_pencil"=>"basic_sheet_pencil",
		"icon-basic_sheet_txt"=>"basic_sheet_txt",
		"icon-basic_sheet"=>"basic_sheet",
		"icon-basic_signs"=>"basic_signs",
		"icon-basic_smartphone"=>"basic_smartphone",
		"icon-basic_spades"=>"basic_spades",
		"icon-basic_spread_bookmark"=>"basic_spread_bookmark",
		"icon-basic_spread_text_bookmark"=>"basic_spread_text_bookmark",
		"icon-basic_spread_text"=>"basic_spread_text",
		"icon-basic_spread"=>"basic_spread",
		"icon-basic_star"=>"basic_star",
		"icon-basic_tablet"=>"basic_tablet",
		"icon-basic_target"=>"basic_target",
		"icon-basic_todo_pen"=>"basic_todo_pen",
		"icon-basic_todo_pencil"=>"basic_todo_pencil",
		"icon-basic_todo_txt"=>"basic_todo_txt",
		"icon-basic_todo"=>"basic_todo",
		"icon-basic_todolist_pen"=>"basic_todolist_pen",
		"icon-basic_todolist_pencil"=>"basic_todolist_pencil",
		"icon-basic_trashcan_full"=>"basic_trashcan_full",
		"icon-basic_trashcan_refresh"=>"basic_trashcan_refresh",
		"icon-basic_trashcan_remove"=>"basic_trashcan_remove",
		"icon-basic_trashcan"=>"basic_trashcan",
		"icon-basic_upload"=>"basic_upload",
		"icon-basic_usb"=>"basic_usb",
		"icon-basic_video"=>"basic_video",
		"icon-basic_watch"=>"basic_watch",
		"icon-basic_webpage_img_txt"=>"basic_webpage_img_txt",
		"icon-basic_webpage_multiple"=>"basic_webpage_multiple",
		"icon-basic_webpage_txt"=>"basic_webpage_txt",
		"icon-basic_webpage"=>"basic_webpage",
		"icon-basic_world"=>"basic_world",
		"icon-ecommerce_bag_check"=>"ecommerce_bag_check",
		"icon-ecommerce_bag_cloud"=>"ecommerce_bag_cloud",
		"icon-ecommerce_bag_download"=>"ecommerce_bag_download",
		"icon-ecommerce_bag_minus"=>"ecommerce_bag_minus",
		"icon-ecommerce_bag_plus"=>"ecommerce_bag_plus",
		"icon-ecommerce_bag_refresh"=>"ecommerce_bag_refresh",
		"icon-ecommerce_bag_remove"=>"ecommerce_bag_remove",
		"icon-ecommerce_bag_search"=>"ecommerce_bag_search",
		"icon-ecommerce_bag_upload"=>"ecommerce_bag_upload",
		"icon-ecommerce_bag"=>"ecommerce_bag",
		"icon-ecommerce_banknote"=>"ecommerce_banknote",
		"icon-ecommerce_banknotes"=>"ecommerce_banknotes",
		"icon-ecommerce_basket_check"=>"ecommerce_basket_check",
		"icon-ecommerce_basket_cloud"=>"ecommerce_basket_cloud",
		"icon-ecommerce_basket_download"=>"ecommerce_basket_download",
		"icon-ecommerce_basket_minus"=>"ecommerce_basket_minus",
		"icon-ecommerce_basket_plus"=>"ecommerce_basket_plus",
		"icon-ecommerce_basket_refresh"=>"ecommerce_basket_refresh",
		"icon-ecommerce_basket_remove"=>"ecommerce_basket_remove",
		"icon-ecommerce_basket_search"=>"ecommerce_basket_search",
		"icon-ecommerce_basket_upload"=>"ecommerce_basket_upload",
		"icon-ecommerce_basket"=>"ecommerce_basket",
		"icon-ecommerce_bath"=>"ecommerce_bath",
		"icon-ecommerce_cart_check"=>"ecommerce_cart_check",
		"icon-ecommerce_cart_cloud"=>"ecommerce_cart_cloud",
		"icon-ecom"=>"ecom",
		"icon-ecommerce_cart_download"=>"ecommerce_cart_download",
		"icon-ecommerce_cart_minus"=>"ecommerce_cart_minus",
		"icon-ecommerce_cart_plus"=>"ecommerce_cart_plus",
		"icon-ecommerce_cart_refresh"=>"ecommerce_cart_refresh",
		"icon-ecommerce_cart_remove"=>"ecommerce_cart_remove",
		"icon-ecommerce_cart_search"=>"ecommerce_cart_search",
		"icon-ecommerce_cart_upload"=>"ecommerce_cart_upload",
		"icon-ecommerce_cart"=>"ecommerce_cart",
		"icon-ecommerce_cent"=>"ecommerce_cent",
		"icon-ecommerce_colon"=>"ecommerce_colon",
		"icon-ecommerce_creditcard"=>"ecommerce_creditcard",
		"icon-ecommerce_diamond"=>"ecommerce_diamond",
		"icon-ecommerce_dollar"=>"ecommerce_dollar",
		"icon-ecommerce_euro"=>"ecommerce_euro",
		"icon-ecommerce_franc"=>"ecommerce_franc",
		"icon-ecommerce_gift"=>"ecommerce_gift",
		"icon-ecommerce_graph_decrease"=>"ecommerce_graph_decrease",
		"icon-ecommerce_graph_increase"=>"ecommerce_graph_increase",
		"icon-ecommerce_graph1"=>"ecommerce_graph1",
		"icon-ecommerce_graph2"=>"ecommerce_graph2",
		"icon-ecommerce_graph3"=>"ecommerce_graph3",
		"icon-ecommerce_guarani"=>"ecommerce_guarani",
		"icon-ecommerce_kips"=>"ecommerce_kips",
		"icon-ecommerce_lira"=>"ecommerce_lira",
		"icon-ecommerce_megaphone"=>"ecommerce_megaphone",
		"icon-ecommerce_money"=>"ecommerce_money",
		"icon-ecommerce_naira"=>"ecommerce_naira",
		"icon-ecommerce_pesos"=>"ecommerce_pesos",
		"icon-ecommerce_pound"=>"ecommerce_pound",
		"icon-ecommerce_receipt_bath"=>"ecommerce_receipt_bath",
		"icon-ecommerce_receipt_cent"=>"ecommerce_receipt_cent",
		"icon-ecommerce_receipt_dollar"=>"ecommerce_receipt_dollar",
		"icon-ecommerce_receipt_euro"=>"ecommerce_receipt_euro",
		"icon-ecommerce_receipt_franc"=>"ecommerce_receipt_franc",
		"icon-ecommerce_receipt_guarani"=>"ecommerce_receipt_guarani",
		"icon-ecommerce_receipt_kips"=>"ecommerce_receipt_kips",
		"icon-ecommerce_receipt_lira"=>"ecommerce_receipt_lira",
		"icon-ecommerce_receipt_naira"=>"ecommerce_receipt_naira",
		"icon-ecommerce_receipt_pesos"=>"ecommerce_receipt_pesos",
		"icon-ecommerce_receipt_pound"=>"ecommerce_receipt_pound",
		"icon-ecommerce_receipt_rublo"=>"ecommerce_receipt_rublo",
		"icon-ecommerce_receipt_rupee"=>"ecommerce_receipt_rupee",
		"icon-ecommerce_receipt_tugrik"=>"ecommerce_receipt_tugrik",
		"icon-ecommerce_receipt_won"=>"ecommerce_receipt_won",
		"icon-ecommerce_receipt_yen"=>"ecommerce_receipt_yen",
		"icon-ecommerce_receipt_yen2"=>"ecommerce_receipt_yen2",
		"icon-ecommerce_receipt"=>"ecommerce_receipt",
		"icon-ecommerce_recept_colon"=>"ecommerce_recept_colon",
		"icon-ecommerce_rublo"=>"ecommerce_rublo",
		"icon-ecommerce_rupee"=>"ecommerce_rupee",
		"icon-ecommerce_safe"=>"ecommerce_safe",
		"icon-ecommerce_sale"=>"ecommerce_sale",
		"icon-ecommerce_sales"=>"ecommerce_sales",
		"icon-ecommerce_ticket"=>"ecommerce_ticket",
		"icon-ecommerce_tugriks"=>"ecommerce_tugriks",
		"icon-ecommerce_wallet"=>"ecommerce_wallet",
		"icon-ecommerce_won"=>"ecommerce_won",
		"icon-ecommerce_yen"=>"ecommerce_yen",
		"icon-ecommerce_yen2"=>"ecommerce_yen2",
		"icon-music_beginning_button"=>"music_beginning_button",
		"icon-music_bell"=>"music_bell",
		"icon-music_cd"=>"music_cd",
		"icon-music_diapason"=>"music_diapason",
		"icon-music_eject_button"=>"music_eject_button",
		"icon-music_end_button"=>"music_end_button",
		"icon-music_fastforward_button"=>"music_fastforward_button",
		"icon-music_headphones"=>"music_headphones",
		"icon-music_ipod"=>"music_ipod",
		"icon-music_loudspeaker"=>"music_loudspeaker",
		"icon-music_microphone_old"=>"music_microphone_old",
		"icon-music_microphone"=>"music_microphone",
		"icon-music_mixer"=>"music_mixer",
		"icon-music_mute"=>"music_mute",
		"icon-music_note_multiple"=>"music_note_multiple",
		"icon-music_note_single"=>"music_note_single",
		"icon-music_pause_button"=>"music_pause_button",
		"icon-music_play_button"=>"music_play_button",
		"icon-music_playlist"=>"music_playlist",
		"icon-music_radio_ghettoblaster"=>"music_radio_ghettoblaster",
		"icon-music_radio_portable"=>"music_radio_portable",
		"icon-music_record"=>"music_record",
		"icon-music_recordplayer"=>"music_recordplayer",
		"icon-music_repeat_button"=>"music_repeat_button",
		"icon-music_rewind_button"=>"music_rewind_button",
		"icon-music_shuffle_button"=>"music_shuffle_button",
		"icon-music_stop_button"=>"music_stop_button",
		"icon-music_tape"=>"music_tape",
		"icon-music_volume_down"=>"music_volume_down",
		"icon-music_volume_up"=>"music_volume_up",
		"icon-software_add_vectorpoint"=>"software_add_vectorpoint",
		"icon-software_box_oval"=>"software_box_oval",
		"icon-software_box_polygon"=>"software_box_polygon",
		"icon-software_box_rectangle"=>"software_box_rectangle",
		"icon-software_box_roundedrectangle"=>"software_box_roundedrectangle",
		"icon-software_character"=>"software_character",
		"icon-software_crop"=>"software_crop",
		"icon-software_eyedropper"=>"software_eyedropper",
		"icon-software_font_allcaps"=>"software_font_allcaps",
		"icon-software_font_baseline_shift"=>"software_font_baseline_shift",
		"icon-software_font_horizontal_scale"=>"software_font_horizontal_scale",
		"icon-software_font_kerning"=>"software_font_kerning",
		"icon-software_font_leading"=>"software_font_leading",
		"icon-software_font_size"=>"software_font_size",
		"icon-software_font_smallcapital"=>"software_font_smallcapital",
		"icon-software_font_smallcaps"=>"software_font_smallcaps",
		"icon-software_font_strikethrough"=>"software_font_strikethrough",
		"icon-software_font_tracking"=>"software_font_tracking",
		"icon-software_font_underline"=>"software_font_underline",
		"icon-software_font_vertical_scale"=>"software_font_vertical_scale",
		"icon-software_horizontal_align_center"=>"software_horizontal_align_center",
		"icon-software_horizontal_align_right"=>"software_horizontal_align_right",
		"icon-software_horizontal_distribute_center"=>"software_horizontal_distribute_center",
		"icon-software_horizontal_distribute_left"=>"software_horizontal_distribute_left",
		"icon-software_horizontal_distribute_right"=>"software_horizontal_distribute_right",
		"icon-software_indent_firstline"=>"software_indent_firstline",
		"icon-software_indent_left"=>"software_indent_left",
		"icon-software_indent_right"=>"software_indent_right",
		"icon-software_lasso"=>"software_lasso",
		"icon-software_layers1"=>"software_layers1",
		"icon-software_layers2"=>"software_layers2",
		"icon-software_layout_2columns"=>"software_layout_2columns",
		"icon-software_layout_3columns"=>"software_layout_3columns",
		"icon-software_layout_4boxes"=>"software_layout_4boxes",
		"icon-software_layout_4columns"=>"software_layout_4columns",
		"icon-software_layout_4lines"=>"software_layout_4lines",
		"icon-software_layout_header_2columns"=>"software_layout_header_2columns",
		"icon-software_layout_header_3columns"=>"software_layout_header_3columns",
		"icon-software_layout_header_4boxes"=>"software_layout_header_4boxes",
		"icon-software_layout_header_4columns"=>"software_layout_header_4columns",
		"icon-software_layout_header_complex"=>"software_layout_header_complex",
		"icon-software_layout_header_complex2"=>"software_layout_header_complex2",
		"icon-software_layout_header_complex3"=>"software_layout_header_complex3",
		"icon-software_layout_header_complex4"=>"software_layout_header_complex4",
		"icon-software_layout_header_sideleft"=>"software_layout_header_sideleft",
		"icon-software_layout_header_sideright"=>"software_layout_header_sideright",
		"icon-software_layout_header"=>"software_layout_header",
		"icon-software_layout_sidebar_left"=>"software_layout_sidebar_left",
		"icon-software_layout_sidebar_right"=>"software_layout_sidebar_right",
		"icon-software_layout-8boxes"=>"software_layout-8boxes",
		"icon-software_layout"=>"software_layout",
		"icon-software_magnete"=>"software_magnete",
		"icon-software_pages"=>"software_pages",
		"icon-software_paintbrush"=>"software_paintbrush",
		"icon-software_paintbucket"=>"software_paintbucket",
		"icon-software_paintroller"=>"software_paintroller",
		"icon-software_paragraph_align_left"=>"software_paragraph_align_left",
		"icon-software_paragraph_align_right"=>"software_paragraph_align_right",
		"icon-software_paragraph_center"=>"software_paragraph_center",
		"icon-software_paragraph_justify_all"=>"software_paragraph_justify_all",
		"icon-software_paragraph_justify_center"=>"software_paragraph_justify_center",
		"icon-software_paragraph_justify_left"=>"software_paragraph_justify_left",
		"icon-software_paragraph_justify_right"=>"software_paragraph_justify_right",
		"icon-software_paragraph_space_after"=>"software_paragraph_space_after",
		"icon-software_paragraph_space_before"=>"software_paragraph_space_before",
		"icon-software_paragraph"=>"software_paragraph",
		"icon-software_pathfinder_exclude"=>"software_pathfinder_exclude",
		"icon-software_pathfinder_intersect"=>"software_pathfinder_intersect",
		"icon-software_pathfinder_subtract"=>"software_pathfinder_subtract",
		"icon-software_pathfinder_unite"=>"software_pathfinder_unite",
		"icon-software_pen_add"=>"software_pen_add",
		"icon-software_pen_remove"=>"software_pen_remove",
		"icon-software_pen"=>"software_pen",
		"icon-software_pencil"=>"software_pencil",
		"icon-software_polygonallasso"=>"software_polygonallasso",
		"icon-software_reflect_horizontal"=>"software_reflect_horizontal",
		"icon-software_reflect_vertical"=>"software_reflect_vertical",
		"icon-software_remove_vectorpoint"=>"software_remove_vectorpoint",
		"icon-software_scale_expand"=>"software_scale_expand",
		"icon-software_scale_reduce"=>"software_scale_reduce",
		"icon-software_selection_oval"=>"software_selection_oval",
		"icon-software_selection_polygon"=>"software_selection_polygon",
		"icon-software_selection_rectangle"=>"software_selection_rectangle",
		"icon-software_selection_roundedrectangle"=>"software_selection_roundedrectangle",
		"icon-software_shape_oval"=>"software_shape_oval",
		"icon-software_shape_polygon"=>"software_shape_polygon",
		"icon-software_shape_rectangle"=>"software_shape_rectangle",
		"icon-software_shape_roundedrectangle"=>"software_shape_roundedrectangle",
		"icon-software_slice"=>"software_slice",
		"icon-software_transform_bezier"=>"software_transform_bezier",
		"icon-software_vector_box"=>"software_vector_box",
		"icon-software_vector_composite"=>"software_vector_composite",
		"icon-software_vector_line"=>"software_vector_line",
		"icon-software_vertical_align_bottom"=>"software_vertical_align_bottom",
		"icon-software_vertical_align_center"=>"software_vertical_align_center",
		"icon-software_vertical_align_top"=>"software_vertical_align_top",
		"icon-software_vertical_distribute_bottom"=>"software_vertical_distribute_bottom",
		"icon-software_vertical_distribute_center"=>"software_vertical_distribute_center",
		"icon-software_vertical_distribute_top"=>"software_vertical_distribute_top",
		"icon-software-horizontal_align_left"=>"software-horizontal_align_left",
		"icon-weather_aquarius"=>"weather_aquarius",
		"icon-weather_aries"=>"weather_aries",
		"icon-weather_cancer"=>"weather_cancer",
		"icon-weather_capricorn"=>"weather_capricorn",
		"icon-weather_cloud_drop"=>"weather_cloud_drop",
		"icon-weather_cloud_lightning"=>"weather_cloud_lightning",
		"icon-weather_cloud_snowflake"=>"weather_cloud_snowflake",
		"icon-weather_cloud"=>"weather_cloud",
		"icon-weather_downpour_fullmoon"=>"weather_downpour_fullmoon",
		"icon-weather_downpour_halfmoon"=>"weather_downpour_halfmoon",
		"icon-weather_downpour_sun"=>"weather_downpour_sun",
		"icon-weather_drop"=>"weather_drop",
		"icon-weather_first_quarter"=>"weather_first_quarter",
		"icon-weather_fog_fullmoon"=>"weather_fog_fullmoon",
		"icon-weather_fog_halfmoon"=>"weather_fog_halfmoon",
		"icon-weather_fog_sun"=>"weather_fog_sun",
		"icon-weather_fog"=>"weather_fog",
		"icon-weather_fullmoon"=>"weather_fullmoon",
		"icon-weather_gemini"=>"weather_gemini",
		"icon-weather_hail_fullmoon"=>"weather_hail_fullmoon",
		"icon-weather_hail_halfmoon"=>"weather_hail_halfmoon",
		"icon-weather_hail_sun"=>"weather_hail_sun",
		"icon-weather_hail"=>"weather_hail",
		"icon-weather_last_quarter"=>"weather_last_quarter",
		"icon-weather_leo"=>"weather_leo",
		"icon-weather_libra"=>"weather_libra",
		"icon-weather_lightning"=>"weather_lightning",
		"icon-weather_mistyrain_fullmoon"=>"weather_mistyrain_fullmoon",
		"icon-weather_mistyrain_halfmoon"=>"weather_mistyrain_halfmoon",
		"icon-weather_mistyrain_sun"=>"weather_mistyrain_sun",
		"icon-weather_mistyrain"=>"weather_mistyrain",
		"icon-weather_moon"=>"weather_moon",
		"icon-weather_moondown_full"=>"weather_moondown_full",
		"icon-weather_moondown_half"=>"weather_moondown_half",
		"icon-weather_moonset_full"=>"weather_moonset_full",
		"icon-weather_moonset_half"=>"weather_moonset_half",
		"icon-weather_move2"=>"weather_move2",
		"icon-weather_newmoon"=>"weather_newmoon",
		"icon-weather_pisces"=>"weather_pisces",
		"icon-weather_rain_fullmoon"=>"weather_rain_fullmoon",
		"icon-weather_rain_halfmoon"=>"weather_rain_halfmoon",
		"icon-weather_rain_sun"=>"weather_rain_sun",
		"icon-weather_rain"=>"weather_rain",
		"icon-weather_sagittarius"=>"weather_sagittarius",
		"icon-weather_scorpio"=>"weather_scorpio",
		"icon-weather_snow_fullmoon"=>"weather_snow_fullmoon",
		"icon-weather_snow_halfmoon"=>"weather_snow_halfmoon",
		"icon-weather_snow_sun"=>"weather_snow_sun",
		"icon-weather_snow"=>"weather_snow",
		"icon-weather_snowflake"=>"weather_snowflake",
		"icon-weather_star"=>"weather_star",
		"icon-weather_storm_fullmoon"=>"weather_storm_fullmoon",
		"icon-weather_storm_halfmoon"=>"weather_storm_halfmoon",
		"icon-weather_storm_sun"=>"weather_storm_sun",
		"icon-weather_storm-11"=>"weather_storm-11",
		"icon-weather_storm-32"=>"weather_storm-32",
		"icon-weather_sun"=>"weather_sun",
		"icon-weather_sundown"=>"weather_sundown",
		"icon-weather_sunset"=>"weather_sunset",
		"icon-weather_taurus"=>"weather_taurus",
		"icon-weather_tempest_fullmoon"=>"weather_tempest_fullmoon",
		"icon-weather_tempest_halfmoon"=>"weather_tempest_halfmoon",
		"icon-weather_tempest_sun"=>"weather_tempest_sun",
		"icon-weather_tempest"=>"weather_tempest",
		"icon-weather_variable_fullmoon"=>"weather_variable_fullmoon",
		"icon-weather_variable_halfmoon"=>"weather_variable_halfmoon",
		"icon-weather_variable_sun"=>"weather_variable_sun",
		"icon-weather_virgo"=>"weather_virgo",
		"icon-weather_waning_cresent"=>"weather_waning_cresent",
		"icon-weather_waning_gibbous"=>"weather_waning_gibbous",
		"icon-weather_waxing_cresent"=>"weather_waxing_cresent",
		"icon-weather_waxing_gibbous"=>"weather_waxing_gibbous",
		"icon-weather_wind_E"=>"weather_wind_E",
		"icon-weather_wind_fullmoon"=>"weather_wind_fullmoon",
		"icon-weather_wind_halfmoon"=>"weather_wind_halfmoon",
		"icon-weather_wind_N"=>"weather_wind_N",
		"icon-weather_wind_NE"=>"weather_wind_NE",
		"icon-weather_wind_NW"=>"weather_wind_NW",
		"icon-weather_wind_S"=>"weather_wind_S",
		"icon-weather_wind_SE"=>"weather_wind_SE",
		"icon-weather_wind_sun"=>"weather_wind_sun",
		"icon-weather_wind_SW"=>"weather_wind_SW",
		"icon-weather_wind_W"=>"weather_wind_W",
		"icon-weather_wind"=>"weather_wind",
		"icon-weather_windgust"=>"weather_windgust",
	);
}

function get_file_icon($filename,$icon_type=false){
    $type = get_file_type(get_file_extension($filename));
    $icon = $type ? 'fa-file-'.$type.'-o' : 'fa-file';
	$icon = $icon_type ? get_fa_code($icon) : ($icon='fa '.$icon);

	return $icon;
}

function get_file_extension($filename){
	$f = explode('.', $filename);

	return $f[count($f)-1];
}

function get_file_type($extension){
	$types = [
		"pdf" => "pdf",
		"doc" => "word",
		"docx" => "word",
		"xls" => "excel",
		"xlsx" => "excel",
		"txt" => "text",
		"zip" => "zip",
		"tar" => "zip",
		"gz" => "zip",
		"tgz" => "zip",
		"deb" => "zip",
	];
    $t = array_values($types);
    $index = array_search($extension, array_keys($types));
	$type = $index ? $t[$index] : '';
	return $type;
}

if (!function_exists('get_fa_code')) {
    function get_fa_code($name){
        $codes = [
            'fa-file'=>'&#xf15b;',
            'fa-file-archive-o'=>'&#xf1c6;',
            'fa-file-audio-o'=>'&#xf1c7;',
            'fa-file-code-o'=>'&#xf1c9;',
            'fa-file-excel-o'=>'&#xf1c3;',
            'fa-file-image-o'=>'&#xf1c5;',
            'fa-file-movie-o (alias)'=>'&#xf1c8;',
            'fa-file-o'=>'&#xf016;',
            'fa-file-pdf-o'=>'&#xf1c1;',
            'fa-file-photo-o (alias)'=>'&#xf1c5;',
            'fa-file-picture-o (alias)'=>'&#xf1c5;',
            'fa-file-powerpoint-o'=>'&#xf1c4;',
            'fa-file-sound-o (alias)'=>'&#xf1c7;',
            'fa-file-text'=>'&#xf15c;',
            'fa-file-text-o'=>'&#xf0f6;',
            'fa-file-video-o'=>'&#xf1c8;',
            'fa-file-word-o'=>'&#xf1c2;',
            'fa-file-zip-o (alias)'=>'&#xf1c6;',
            'fa-files-o'=>'&#xf0c5;',
            'fa-film' =>'&#xf008; ',
        ];

        $values = array_values($codes);
        $index = array_search($name, array_keys($codes));
        $code = $values[$index ? $index : 0];
        return $code;
    }
}

function bower_install(){
	$cwmd = getcwd();
    $dir = __DIR__;

    chdir($dir);
    chdir('../../public');

    $outputs = [];
    $cmd = 'bower install';
    $res = exec($cmd,$outputs);

    chdir($cwmd);

    $resp = is_array($res) ? implode('\n',$res) : $res;

    return "Bower components installed/Updated\n\n".$resp;
}

function node_modules_install(){
	$cwmd = getcwd();
    $dir = __DIR__;

    chdir($dir);
    chdir('../../public');

    $outputs = [
    		'md'=>null,
    		'public'=>null
    	];
    $cmd = 'npm install --save';
    $res = exec($cmd,$outputs['public']);

    chdir('material-dashboard-master');

    $cmd = 'npm install --save';
    $res = exec($cmd,$outputs['md']);

    chdir($cwmd);

    return "Node Modules installed/Updated";
}

function clean_directories()
{
	$cwmd = getcwd();
	$dir = __DIR__;

    chdir($dir);
    chdir('../../public');

    if(file_exists('bower_components'))
    	exec('rm -R bower_components');

    if(file_exists('node_modules'))
    	exec('rm -R node_modules');

    if(file_exists('material-dashboard-master/node_modules'))
    	exec('rm -R material-dashboard-master/node_modules');

    chdir($cwmd);
}

function save_config($key,$value){
	config([$key => $value]);
	$ar_key = explode('.', $key);
	$config = $ar_key[0];
	$fp = fopen(base_path() .'/config/'.$config.'.php' , 'w');
	fwrite($fp, '<?php return ' . var_export(config($config), true) . ';');
	fclose($fp);
}

function str_slug_unique($table,$field,$value,$id=null){
	$name = str_slug($value);

	if ($id) {
		$item = DB::table('articles')->where('id','=',$id)->where($field,'LIKE',$name.'%')->first();
		if ($item) {
			$name = $item->{$field};
		} else {
			$items = DB::table($table)->where($field,'LIKE',$name.'%')->where('id','<>',$id)->orderBy($field,'DESC')->get();

			if ($items->count()) {
				$last = (int)str_replace($name, '', $items->first()->{$field});
				$name .= ++$last;
			}
		}

	}else{
		$items = DB::table($table)->where($field,'LIKE',$name.'%')->orderBy($field,'DESC')->get();

		if ($items->count()) {
			$last = (int)str_replace($name, '', $items->first()->{$field});
			$name .= ++$last;
		}
	}

	return $name;
}

function save_admin_config($settings = null) {
	if (!$settings) {
		$settings = array(
            'articles' => true,
            'pictures' => true,
            'videos' => true,
            'files' => true,
            'projects' => true,
            'profiles' => true,
            'sermons' => true,
            'events' => true,
            'packages' => true,
            'products' => true,
            'contact' => config('mail.username'),
        );
	}

	$fp = fopen(config_path('admin.php') , 'w');
	fwrite($fp, '<?php return ' . var_export($settings, true) . ';');
	fclose($fp);

	return $settings;
}

function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }

    }

    return rmdir($dir);
}

function getOS($user_agent) {

    $os_platform  = "Unknown OS Platform";

    $os_array     = array(
                          '/windows nt 10/i'      =>  'Windows 10',
                          '/windows nt 6.3/i'     =>  'Windows 8.1',
                          '/windows nt 6.2/i'     =>  'Windows 8',
                          '/windows nt 6.1/i'     =>  'Windows 7',
                          '/windows nt 6.0/i'     =>  'Windows Vista',
                          '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                          '/windows nt 5.1/i'     =>  'Windows XP',
                          '/windows xp/i'         =>  'Windows XP',
                          '/windows nt 5.0/i'     =>  'Windows 2000',
                          '/windows me/i'         =>  'Windows ME',
                          '/win98/i'              =>  'Windows 98',
                          '/win95/i'              =>  'Windows 95',
                          '/win16/i'              =>  'Windows 3.11',
                          '/macintosh|mac os x/i' =>  'Mac OS X',
                          '/mac_powerpc/i'        =>  'Mac OS 9',
                          '/linux/i'              =>  'Linux',
                          '/ubuntu/i'             =>  'Ubuntu',
                          '/iphone/i'             =>  'iPhone',
                          '/ipod/i'               =>  'iPod',
                          '/ipad/i'               =>  'iPad',
                          '/android/i'            =>  'Android',
                          '/blackberry/i'         =>  'BlackBerry',
                          '/webos/i'              =>  'Mobile'
                    );

    foreach ($os_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $os_platform = $value;

    return $os_platform;
}

function getBrowser($user_agent) {

    $browser        = "Unknown Browser";

    $browser_array = array(
                            '/msie/i'      => 'Internet Explorer',
                            '/firefox/i'   => 'Firefox',
                            '/safari/i'    => 'Safari',
                            '/chrome/i'    => 'Chrome',
                            '/edge/i'      => 'Edge',
                            '/opera/i'     => 'Opera',
                            '/netscape/i'  => 'Netscape',
                            '/maxthon/i'   => 'Maxthon',
                            '/konqueror/i' => 'Konqueror',
                            '/mobile/i'    => 'Handheld Browser'
                     );

    foreach ($browser_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $browser = $value;

    return $browser;
}

function make_html_list($data,$type='ol'){
    $list = '<'.$type.'>';
    foreach ($data as $key => $value) {
        $list .= '<li>'.$value.'</li>';
    }
    $list .= '</'.$type.'>';

    return $list;
}

// Ordinal function to add st, nd, rd etc to numbers

if (! function_exists('str_ordinal')) {
    /**
     * Append an ordinal indicator to a numeric value.
     *
     * @param  string|int  $value
     * @param  bool  $superscript
     * @return string
     */
    function str_ordinal($value, $superscript = false)
    {
        $number = abs($value);

        $indicators = ['th','st','nd','rd','th','th','th','th','th','th'];

        $suffix = $superscript ? '<sup>' . $indicators[$number % 10] . '</sup>' : $indicators[$number % 10];
        if ($number % 100 >= 11 && $number % 100 <= 13) {
            $suffix = $superscript ? '<sup>th</sup>' : 'th';
        }

        return number_format($number) . $suffix;
    }
}

if(! function_exists('clean_isdn')){
    function clean_isdn($phone_number){

        $isdn = ltrim($phone_number,0);

        if(strlen($isdn) === 9){
            $isdn = '+254'.$isdn;
        }elseif(strlen($isdn)===12){
            $isdn = '+'.$isdn;
        }

        return $isdn;
    }
}

if(! function_exists('str_studle')){
    function str_studle($string){
        $str = str_slug($string);
        return str_replace('-', '_', $str);
    }
}

if (! function_exists('week')) {
    function week($from=null, $when=null){
        $date = null;
        $start = null;

        if ($from) {
            $start = date_create($from);
        } else {
            $start = date_create(date('Y').'-01-01');
        }

        if ($when) {
            $date = date_create($when);
        } else {
            $date = date_create();
        }

        return ((int)$date->format('W') - (int) $start->format('W')) + 1;
    }
}

if(! function_exists('str_starts_with')){
    function str_starts_with($string,$needle){
        return Str::startsWith($string,$needle);
    }
}


if (!function_exists('get_filesize')) {
    function get_filesize($filename, $decimals = 2) {
        $bytes = filesize($filename);
        $factor = floor((strlen($bytes) - 1) / 3);
        if ($factor > 0) $sz = 'KMGT';
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor - 1] . 'B';
    }
}

if(!function_exists('stop_words')){
    function stop_words($text) {
    	$text = strip_tags($text);

        $stopwords = file(public_path('stopwords.txt'));
        // Remove line breaks and spaces from stopwords
        $stopwords = array_map(function($x){return trim(strtolower($x));}, $stopwords);
        // Replace all non-word chars with comma
        $pattern = '/[0-9\W]/';
        $text = preg_replace($pattern, ',', $text);
        // Create an array from $text
        $text_array = explode(",",$text);
        // remove whitespace and lowercase words in $text
        $text_array = array_map(function($x){return trim(strtolower($x));}, $text_array);
        foreach ($text_array as $term) {
            if (!in_array($term, $stopwords)) {
                $keywords[] = $term;
            }
        };
        return array_filter($keywords);
    }
}

if (!function_exists('keywords')) {
	function keywords($text)
	{
		return implode(', ', stop_words($text));
	}
}


if (!function_exists('is_current_url')) {
	function is_current_url($path){
		return starts_with(Request::path(),$path);
	}
}
