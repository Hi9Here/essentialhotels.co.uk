<?php
/*-----------------------------------------------------------------------------------*/
/* Start WooThemes Functions - Please refrain from editing this section */
/*-----------------------------------------------------------------------------------*/
// Set path to WooFramework and theme specific functions
$functions_path = TEMPLATEPATH . '/functions/';
$includes_path = TEMPLATEPATH . '/includes/';
// WooFramework
require_once ($functions_path . 'admin-init.php');			// Framework Init
require_once ($includes_path . '/content-builder/admin-content-builder.php');	// Content Builder
// Theme specific functionality
require_once ($includes_path . 'theme-options.php'); 		// Options panel settings and custom settings
require_once ($includes_path . 'theme-functions.php'); 		// Custom theme functions
require_once ($includes_path . 'theme-plugins.php');		// Theme specific plugins integrated in a theme
require_once ($includes_path . 'theme-actions.php');		// Theme actions & user defined hooks
require_once ($includes_path . 'theme-comments.php'); 		// Custom comments/pingback loop
require_once ($includes_path . 'theme-js.php');				// Load javascript in wp_head
require_once ($includes_path . 'sidebar-init.php');			// Initialize widgetized areas
require_once ($includes_path . 'theme-widgets.php');		// Theme widgets
/*-----------------------------------------------------------------------------------*/
/* You can add custom functions below */
/*-----------------------------------------------------------------------------------*/
// Custom Query Filter
add_action('pre_get_posts', 'woo_custom_query_filter' );
function woo_custom_query_filter( $query ) {
  global $wp_query;
  if ($query->is_archive) {
  	$query->set('orderby','title');
  	$query->set('order','ASC');
  	$query->parse_query();
  }
  return $query;
}
function featuredtoRSS($content) {
	global $post;
	if ( has_post_thumbnail( $post->ID ) ){
	$content = '' . get_the_post_thumbnail( $post->ID, 'thumbnail', array( 'style' => 'float:left; margin:0 15px 15px 0;' ) ) . '' . $content;
	}
	return $content;
}
add_filter('the_excerpt_rss', 'featuredtoRSS');
add_filter('the_content_feed', 'featuredtoRSS');
//Excerpt Length Restrication to 20 Characters
function custom_excerpt_length( $length ) {
	return 8;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
function hhost_add_links_card($hhost_text) {
	
// Time Out
add_filter( 'auth_cookie_expiration', 'keep_me_logged_in_for_1_year' );

function keep_me_logged_in_for_1_year( $expirein ) {
    return 31556926; // 1 year in seconds
}

	
  // print print_r($hhost_text,1);
  $hhost_text = str_ireplace ('<h2> ','<h2>',$hhost_text );
  $hhost_text = str_ireplace (' <h2>','<h2>',$hhost_text );
  $hhost_text = str_ireplace ('</h2> ','</h2>',$hhost_text );
  $hhost_text = str_ireplace (' </h2>','</h2>',$hhost_text );     
  $hhost_text = str_ireplace (' </h2>','</h2>',$hhost_text );
  $hhost_links = "";
  if (strripos($hhost_text,'<h2>book</h2>') !== false) {
    $hhost_text = str_ireplace ('<h2>Info</h2>', '<br /><a name=info ></a>',$hhost_text );    
    $hhost_text = str_ireplace ('<h2>Book</h2>', '<a name=Book ></a>',$hhost_text );    
    $hhost_links .= '<li> <a href="#info" >Info</a></li>'; 
    $hhost_links .= '<li> <a href="#Book" >Book</a></li>'; 
  }
  if ($hhost_links == "") {
    return $hhost_text;
  } else {
    return '<div id="stickymenu"><ul id="menu" >' .$hhost_links. '</ul></div><div id="stickyalias"></div><div id="content-wrpe">' . $hhost_text . '</div>';
  }
}
function hhost_add_links_mobi($hhost_text) {
  // print print_r($hhost_text,1);
  $hhost_text = str_ireplace ('<h2> ','<h2>',$hhost_text );
  $hhost_text = str_ireplace (' <h2>','<h2>',$hhost_text );
  $hhost_text = str_ireplace ('</h2> ','</h2>',$hhost_text );
  $hhost_text = str_ireplace (' </h2>','</h2>',$hhost_text );     
  $hhost_text = str_ireplace (' </h2>','</h2>',$hhost_text );
  $hhost_links = "";
  if (strripos($hhost_text,'<h2>book</h2>') !== false) {
    $hhost_text = str_ireplace ('<h2>Book</h2>', '<a name=Book ></a><h2>Book</h2>',$hhost_text );    
    $hhost_text = str_ireplace ('<h2>Infomation</h2>', '<br /><a name=info ></a><h2>Infomation</h2>',$hhost_text );    
    $hhost_links .= '<li> <a href="#Book" >Book</a></li>'; 
    $hhost_links .= '<li> <a href="#info" >Infomation</a></li>'; 
  } else {
    if (strripos($hhost_text,'<h2>sleep</h2>') !== false) {
      $hhost_text = str_ireplace ('<h2>sleep</h2>', '<a name=sleep ></a><h2>Sleep</h2>',$hhost_text );    
      $hhost_links .= '<li> <a href="#sleep" > Sleep </a></li>';  
    }
    if (strripos($hhost_text,'<h2>eat</h2>') !== false) {
      $hhost_text = str_ireplace ('<h2>eat</h2>','<a name=eat ></a><h2>Eat</h2>',$hhost_text );    
      $hhost_links .= '<li> <a href="#eat" > Eat </a></li>';  
    }
    if (strripos($hhost_text,'<h2>meet</h2>') !== false) {
      $hhost_text = str_ireplace ('<h2>meet</h2>','<a name=meet ></a><h2>Meet</h2>',$hhost_text );
      $hhost_links .= '<li> <a href="#meet" > Meet </a></li>';
    }
    if (strripos($hhost_text,'<h2>play</h2>') !== false) {
      $hhost_text = str_ireplace ('<h2>play</h2>','<a name=play ></a><h2>Play</h2></a>',$hhost_text);
      $hhost_links .= '<li> <a href="#play" > Play </a></li>';
    }
    if (strripos($hhost_text,'<h2>explore</h2>') !== false) {
      $hhost_text = str_ireplace ('<h2>explore</h2>','<a name=explore ></a><h2>Explore</h2>',$hhost_text );    
      $hhost_links .= '<li> <a href="#explore" > Explore </a></li>';  
    }
    if (strripos($hhost_text,'<h2>must see</h2>') !== false) {
      $hhost_text = str_ireplace ('<h2>must see</h2>', '<a name=mustsee ></a><h2>Must See</h2>',$hhost_text );    
      $hhost_links .= '<li> <a href="#mustsee" > Must See </a></li>';  
    }
    if (strripos($hhost_text,'<h2>to do</h2>') !== false) {
      $hhost_text = str_ireplace ('<h2>to do</h2>','<a name=todo ></a><h2>To Do</h2>',$hhost_text );    
      $hhost_links .= '<li> <a href="#todo" > To Do </a></li>';  
    }
    if (strripos($hhost_text,'<h2>food + drink</h2>') !== false) {
      $hhost_text = str_ireplace ('<h2>food + drink</h2>','<a name=foodanddrink ></a><h2>Food & Drink</h2>',$hhost_text );
      $hhost_links .= '<li> <a href="#foodanddrink" > Food & Drink </a></li>';
    }
    if (strripos($hhost_text,'<h2>stay</h2>') !== false) {
      $hhost_text = str_ireplace ('<h2>stay</h2>','<a name=stay ></a><h2>Stay</h2>',$hhost_text);
      $hhost_links .= '<li> <a href="#stay" > Stay </a></li>';
    }
    if (strripos($hhost_text,'<h2>shopping</h2>') !== false) {
      $hhost_text = str_ireplace ('<h2>shopping</h2>','<a name=shopping ></a><h2>Shopping</h2>',$hhost_text );    
      $hhost_links .= '<li> <a href="#shopping" > Shopping </a></li>';  
    }
    if (strripos($hhost_text,'<h2>did you know?</h2>') !== false) {
      $hhost_text = str_ireplace ('<h2>did you know?</h2>','<a name=didyouknow? ></a><h2>Did You Know?</h2>',$hhost_text );    
      $hhost_links .= '<li> <a href="#didyouknow?" > Did You Know? </a></li>';  
    }
    if (strripos($hhost_text,'<h2>hotel</h2>') !== false) {
      $hhost_text = str_ireplace ('<h2>hotel</h2>','<a name=hotel ></a><h2>Hotel</h2>',$hhost_text );    
      $hhost_links .= '<li> <a href="#hotel" > Hotel </a></li>';  
    }
    if (strripos($hhost_text,'<h2>hotels</h2>') !== false) {
      $hhost_text = str_ireplace ('<h2>hotels</h2>','<a name=hotels ></a><h2>Hotels</h2>',$hhost_text );    
      $hhost_links .= '<li> <a href="#hotels" > Hotels </a></li>';  
    }
    if (strripos($hhost_text,'<h2>Destinations</h2>') !== false) {
      $hhost_text = str_ireplace ('<h2>Destinations</h2>','<a name= >Destinations</a><h2>Destinations</h2>',$hhost_text );    
      $hhost_links .= '<li> <a href="#Destinations" > Destinations</a></li>';  
    }
    if (strripos($hhost_text,'<h2>Attractions</h2>') !== false) {
      $hhost_text = str_ireplace ('<h2>Attractions</h2>','<a name= >Attractions</a><h2>Attractions</h2>',$hhost_text );    
      $hhost_links .= '<li> <a href="#Attractions" > Attractions </a></li>';  
    }
  }
  if ($hhost_links == "") {
    return $hhost_text;
  } else {
    return '<div id="stickymenu"><ul id="menu" >' .$hhost_links. '</ul></div><div id="stickyalias"></div><div id="content-wrpe">' . $hhost_text . '</div>';
  }
}
function hhost_stripArgumentFromTags( $html ) {
  $domd = new DOMDocument();
  libxml_use_internal_errors(true);
  $domd->loadHTML($html);
  libxml_use_internal_errors(false);
  $domx = new DOMXPath($domd);
  $items = $domx->query("//img[@align]");
  foreach($items as $item) {
    $item->removeAttribute("align");
  }
  $items = $domx->query("//img[@style]");
  foreach($items as $item) {
    $item->removeAttribute("style");
  }
  return $domd->saveHTML(); 
}
function hhost_add_links($hhost_text) {
  // print print_r($hhost_text,1);
  $hhost_text = str_ireplace (array('<h2> ',' <h2>'),'<h2>',$hhost_text );
  $hhost_text = str_ireplace (array('</h2> ',' </h2>'),'</h2>',$hhost_text );
  $hhost_links = "";
  if (strripos($hhost_text,'<h2>hotels</h2>') !== false) {
    $hhost_text = str_ireplace ('<h2>hotels</h2>','<a name=hotels ></a><h2>Hotels</h2>',$hhost_text );    
    $hhost_links .= '<li> <a href="#hotels" > Hotels </a></li>';  
  }
  if (strripos($hhost_text,'<h2>Destinations</h2>') !== false) {
    $hhost_text = str_ireplace ('<h2>Destinations</h2>','<a name=Destinations ></a><h2>Destinations</h2>',$hhost_text );    
    $hhost_links .= '<li> <a href="#Destinations" > Destinations</a></li>';  
  }
  if (strripos($hhost_text,'<h2>Attractions</h2>') !== false) {
    $hhost_text = str_ireplace ('<h2>Attractions</h2>','<a name=Attractions ></a><h2>Attractions</h2>',$hhost_text );    
    $hhost_links .= '<li> <a href="#Attractions" > Attractions </a></li>';  
  }
  if (strripos($hhost_text,'<h2>sleep</h2>') !== false) {
    $hhost_text = str_ireplace ('<h2>sleep</h2>', '<a name=sleep ></a><h2>Sleep</h2>',$hhost_text );    
    $hhost_links .= '<li> <a href="#sleep" > Sleep </a></li>';  
  }
  if (strripos($hhost_text,'<h2>eat</h2>') !== false) {
    $hhost_text = str_ireplace ('<h2>eat</h2>','<a name=eat ></a><h2>Eat</h2>',$hhost_text );    
    $hhost_links .= '<li> <a href="#eat" > Eat </a></li>';  
  }
  if (strripos($hhost_text,'<h2>meet</h2>') !== false) {
    $hhost_text = str_ireplace ('<h2>meet</h2>','<a name=meet ></a><h2>Meet</h2>',$hhost_text );
    $hhost_links .= '<li> <a href="#meet" > Meet </a></li>';
  }
  if (strripos($hhost_text,'<h2>play</h2>') !== false) {
    $hhost_text = str_ireplace ('<h2>play</h2>','<a name=play ></a><h2>Play</h2></a>',$hhost_text);
    $hhost_links .= '<li> <a href="#play" > Play </a></li>';
  }
  if (strripos($hhost_text,'<h2>explore</h2>') !== false) {
    $hhost_text = str_ireplace ('<h2>explore</h2>','<a name=explore ></a><h2>Explore</h2>',$hhost_text );    
    $hhost_links .= '<li> <a href="#explore" > Explore </a></li>';  
  }
  if (strripos($hhost_text,'<h2>must see</h2>') !== false) {
    $hhost_text = str_ireplace ('<h2>must see</h2>', '<a name=mustsee ></a><h2>Must See</h2>',$hhost_text );    
    $hhost_links .= '<li> <a href="#mustsee" > Must See </a></li>';  
  }
  if (strripos($hhost_text,'<h2>to do</h2>') !== false) {
    $hhost_text = str_ireplace ('<h2>to do</h2>','<a name=todo ></a><h2>To Do</h2>',$hhost_text );    
    $hhost_links .= '<li> <a href="#todo" > To Do </a></li>';  
  }
  if (strripos($hhost_text,'<h2>food + drink</h2>') !== false) {
    $hhost_text = str_ireplace ('<h2>food + drink</h2>','<a name=foodanddrink ></a><h2>Food & Drink</h2>',$hhost_text );
    $hhost_links .= '<li> <a href="#foodanddrink" > Food & Drink </a></li>';
  }
  if (strripos($hhost_text,'<h2>stay</h2>') !== false) {
    $hhost_text = str_ireplace ('<h2>stay</h2>','<a name=stay ></a><h2>Stay</h2>',$hhost_text);
    $hhost_links .= '<li> <a href="#stay" > Stay </a></li>';
  }
  if (strripos($hhost_text,'<h2>shopping</h2>') !== false) {
    $hhost_text = str_ireplace ('<h2>shopping</h2>','<a name=shopping ></a><h2>Shopping</h2>',$hhost_text );    
    $hhost_links .= '<li> <a href="#shopping" > Shopping </a></li>';  
  }
  if (strripos($hhost_text,'<h2>did you know?</h2>') !== false) {
    $hhost_text = str_ireplace ('<h2>did you know?</h2>','<a name=didyouknow? ></a><h2>Did You Know?</h2>',$hhost_text );    
    $hhost_links .= '<li> <a href="#didyouknow?" > Did You Know? </a></li>';  
  }
  if ($hhost_links == "") {
    return $hhost_text;
  } else {
    return '<div id="stickymenu"><ul id="menu" >' .$hhost_links. '</ul></div><div id="stickyalias"></div><div id="content-wrpe">' . $hhost_text . '</div>';
  }
}/*Define Width for th Galleries*/if ( ! isset( $content_width ) )$content_width = 930;
/*UberMenu Replacement*/
function uberMenu_canvas_comaptible(){
    remove_action( 'woo_header_after','woo_nav', 10 ); 
    remove_action( 'woo_header_inside', 'woo_nav_toggle', 20 );
    remove_action( 'woo_header_before', 'woo_nav_toggle', 20 );
    add_action( 'woo_header_after','uberMenu_direct_woo', 10 , 0 );
}
function uberMenu_direct_woo(){
    uberMenu_direct( 'primary-menu' );
}
add_action( 'init' , 'uberMenu_canvas_comaptible' );
/*Code to Make Progress Map Work*/
function cspm_remove_style_files(){	
	if (!class_exists("CodespacingProgressMap"))
		return; 
	$ProgressMapClass = CodespacingProgressMap::this();
	if($ProgressMapClass->loading_scripts == "only_pages"){
		global $post;
		$IDs = array_merge(
					explode(",", str_replace(" ", "", $ProgressMapClass->load_on_page_ids)),
					explode(",", str_replace(" ", "", $ProgressMapClass->load_on_post_ids))
			   );
		$page_templates = explode(",", str_replace(" ", "", $ProgressMapClass->load_on_page_templates));
		$current_template_name = basename(get_page_template());
		if($ProgressMapClass->include_or_remove_option == "include"){
			if(!in_array($post->ID, $IDs)) $ProgressMapClass->cspm_deregister_styles();
			if(in_array($current_template_name, $page_templates)) $ProgressMapClass->cspm_styles();			
		}else{
			if(in_array($post->ID, $IDs) || in_array($current_template_name, $page_templates)) 
				$ProgressMapClass->cspm_deregister_styles();
		}
	}	
}
add_action("wp_print_styles", "cspm_remove_style_files", 100);
function cspm_remove_script_files(){	
	if (!class_exists("CodespacingProgressMap"))
		return; 
	$ProgressMapClass = CodespacingProgressMap::this();
	if($ProgressMapClass->loading_scripts == "only_pages"){
		global $post;
		$IDs = array_merge(
					explode(",", str_replace(" ", "", $ProgressMapClass->load_on_page_ids)),
					explode(",", str_replace(" ", "", $ProgressMapClass->load_on_post_ids))
			   );
		$page_templates = explode(",", str_replace(" ", "", $ProgressMapClass->load_on_page_templates));
		$current_template_name = basename(get_page_template());
		if($ProgressMapClass->include_or_remove_option == "include"){
			if(!in_array($post->ID, $IDs)) $ProgressMapClass->cspm_deregister_scripts();
			if(in_array($current_template_name, $page_templates)) $ProgressMapClass->cspm_scripts();
		}else{
			if(in_array($post->ID, $IDs) || in_array($current_template_name, $page_templates)) 
				$ProgressMapClass->cspm_deregister_scripts();					
		}
                if(in_array($post->ID, $IDs))
                     wp_dequeue_script('carousel');
	}	
}
add_action("wp_print_scripts", "cspm_remove_script_files", 100);
/*-----------------------------------------------------------------------------------*/
/* Don't add any code below here or the sky will fall down */
/*-----------------------------------------------------------------------------------*/
?>
