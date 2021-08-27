<?php
/**
 * Casino functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Casino
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'casino_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function casino_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Casino, use a find and replace
		 * to change 'casino' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'casino', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'casino' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'casino_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'casino_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function casino_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'casino_content_width', 640 );
}
add_action( 'after_setup_theme', 'casino_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function casino_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'casino' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'casino' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'casino_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function casino_scripts() {
	wp_enqueue_style( 'casino-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'casino-style', 'rtl', 'replace' );

	wp_enqueue_script( 'casino-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'casino_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function handle_admin_head() {
	if(!current_user_can('manage_options')){
		remove_action( 'admin_notices', 'update_nag',      3  );
		remove_action( 'admin_notices', 'maintenance_nag', 10 );
	}
}
add_action('admin_head', 'handle_admin_head');

add_action( 'save_post', 'handle_save_post_function', 10, 3 );

function handle_save_post_function( $post_ID, $post, $update ) {
  $post_type = $post->post_type;
  $url = get_permalink($post->ID);
  $path = parse_url($url, PHP_URL_PATH);
  if($post->post_type=='nav_menu_item'){
	$post_type ='menus';
  }
//   $url = get_home_url().'/clearCache/?postType='.$post_type.'&key='.$path;
//   $url = get_home_url().'/clearCache/?postType='.$post_type.'&key='.$path;
//   $curl = curl_init($url);
//   curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//   curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
//   curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
//   $response = curl_exec($curl);
//   curl_close($curl);
	//For fix 2 server
	$url = 'http://'.server_ip_1.':'.server_1_api_port.'/forceClearCache/?postType='.$post_type.'&key='.$path;
	callAPIhttp($url);
	$url = 'http://'.server_ip_1.':'.server_1_fe_port.'/forceClearCache/?postType='.$post_type.'&key='.$path;
	callAPIhttp($url);
	$url = 'http://'.server_ip_2.':'.server_2_api_port.'/forceClearCache/?postType='.$post_type.'&key='.$path;
	callAPIhttp($url);
	$url = 'http://'.server_ip_2.':'.server_2_fe_port.'/forceClearCache/?postType='.$post_type.'&key='.$path;
	callAPIhttp($url);
}

function callAPIhttp($url){
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($curl);
	curl_close($curl);
}

function custom_post_link( $post_link, $id = 0 ){
    $post = get_post($id);  
    if ( is_object( $post ) ){
		$terms = get_field( "category", $post->ID );
        if( $terms ){
            return str_replace( '%category%' , $terms->slug , $post_link );
        }
    }
    return $post_link;  
}
add_filter( 'post_type_link', 'custom_post_link', 1, 3 );

function generated_rewrite_rules($wp_rewrite) {
	$wp_rewrite->rules = array_merge(array(
        '^promotions/(.*)?$' => 'index.php?post_type=promotions_categories&name=$matches[1]',
		'^promotions/(.*)/(.*)?$'=>'index.php?post_type=promotions&name=$matches[2]',
		// '^faq/(.*)?$' => 'index.php?post_type=faq_categories&name=$matches[1]',
		// '^faq/(.*)/(.*)?$'=>'index.php?post_type=faq&name=$matches[2]'
    ), $wp_rewrite->rules);
 }
 add_filter('generate_rewrite_rules', 'generated_rewrite_rules', 1, 3);

function post_type_exclude($type){
	$list = array("promotions");
	return in_array($type, $list);
}

function page_exclude($type){
	$list = array( "casino", "live-casino", "sports", "jackpots");
	return in_array($type, $list);
}

function resOK($data){
	$response = new WP_REST_Response($data);
	$response->set_status(200);
	return $response;
}

function resFail(){
	$response = new WP_REST_Response();
	$response->set_status(404);
	return $response;
}

function myFilter($var){
  return ($var !== NULL && $var !== FALSE && $var !== '');
}

function get_lang(){
	global $sitepress;
	return !empty($_GET['lang']) && is_string($_GET['lang']) ?  $_GET['lang'] : $sitepress->get_default_language();
}

function check_link(){
	$link = urldecode($_GET['link']);
	$res = array_values(array_filter(explode('/', parse_url($link, PHP_URL_PATH)), 'myFilter'));
	return $res;
}

function get_url(){
	$link = urldecode($_GET['link']);
	$home_URL =  get_home_url();
	return $home_URL.$link;
}

function get_post_id($url){
	return url_to_postid($url);
}

function get_wpml_permalink($id){
	$link = urldecode($_GET['link']);
	$res = array_values(array_filter(explode('/', parse_url($link, PHP_URL_PATH)), 'myFilter'));
	$post_id_lang = wpml_object_id_filter($id, $res[0], true, get_lang());
	return get_permalink($post_id_lang);
}

function get_terms_data($post_type){
	$link = urldecode($_GET['link']);
	$slug = substr($link, strrpos($link, '/' )+1);
	return get_terms( $post_type."_categories", array(
		'hide_empty' => false,
		'slug'=> $slug
	) );
}

function get_custom_data(){
	$link = urldecode($_GET['link']);
	$slug = substr($link, strrpos($link, '/' )+1);
	$res = array_values(array_filter(explode('/', parse_url($link, PHP_URL_PATH)), 'myFilter'));
	return get_page_by_path($slug, '', $res[0]);
}

function permalink() {
	$url = get_url();
	$link = check_link();
	if(count($link)>2 && page_exclude($link[0])){
		if($link[0]=='casino' || $link[0]=='live-casino' || $link[0]=='jackpots'){
			$data['link'] = $url;
			return resOK($data);
		}else{
			$data['link'] = $url;
			return resOK($data);
		}
	}else if(count($link)==2 && (post_type_exclude($link[0]) || page_exclude($link[0]) )){
		if(post_type_exclude($link[0])){
			$terms = get_terms_data($link[0]);
			if(count($terms)>0){
				$data['link'] = $url;
				return resOK($data);
			}else{
				return resFail();
			}
		}else{
			if($link[0]=='casino' || $link[0]=='live-casino' || $link[0]=='jackpots'){
				$data['link'] = $url;
				return resOK($data);
			}else{
				$data['link'] = $url;
				return resOK($data);
			}
		}
	}else{
		$post_id = get_post_id($url);
		if($post_id<=0){
			$custom_post = get_custom_data();
			if($custom_post){
				$data['link'] = get_wpml_permalink($custom_post->ID);
				return resOK($data);
			}else{
				return resFail();
			}
		}else{
			$data['link'] = get_wpml_permalink($post_id);
			return resOK($data);
		}
	}
}

add_action( 'rest_api_init', function () {
    register_rest_route( 'custom/v1', '/permalink', array(
      'methods' => 'GET',
      'callback' => 'permalink'
    ) );
} );

function get_page_info($id){
	$info['title'] = get_the_title($id);
	$info['content'] = apply_filters('the_content', get_post_field('post_content', $id));
	$info['slug'] = get_post_field('post_name', $id);
	$info['seoTitle'] = get_post_meta($id, '_yoast_wpseo_title', true);
	$info['seoMetaDesc'] = get_post_meta($id, '_yoast_wpseo_metadesc', true);
	$info['seoKeyword'] = get_post_meta($id, '_yoast_wpseo_focuskw', true);
	$info['seoCanonical'] = get_post_meta($id, '_yoast_wpseo_canonical', true);
	$template = get_post_meta( $id, '_wp_page_template', true );
	$template = str_replace(".php", "",$template);
	$info['template'] = $template;
	return $info;
}

function get_terms_info($term){
	$id = $term->term_id;
	$info['title'] = $term->name;
	$info['content'] = $term->description;
	$info['slug'] = $term->slug;
	$taxonomy_meta = get_option( 'wpseo_taxonomy_meta' );
	$info['seoTitle'] = '';
	$info['seoMetaDesc'] = '';
	$info['seoCanonical'] = '';
	$info['template'] = 'default';
	if(isset($taxonomy_meta[$term->taxonomy])){
		if(isset($taxonomy_meta[$term->taxonomy][$id])){
			$meta = $taxonomy_meta[$term->taxonomy][$id];
			$info['seoTitle'] = isset($meta['wpseo_title'])?$meta['wpseo_title']:'';
			$info['seoKeyword'] = isset($meta['wpseo_focuskw'])?$meta['wpseo_focuskw']:'';
			$info['seoMetaDesc'] = isset($meta['wpseo_desc'])?$meta['wpseo_desc']:'';
			$info['seoCanonical'] = isset($meta['wpseo_canonical'])?$meta['wpseo_canonical']:'';
		}
	}
	return $info;
}

function callAPI($url){
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	$response = curl_exec($curl);
	curl_close($curl);
	return json_decode($response);
}

function get_casino_cate_info($name){
	$info['title'] = $name;
	$info['content'] = $name;
	$info['slug'] = $name;
	$info['seoTitle'] = '';
	$info['seoMetaDesc'] = '';
	$info['seoCanonical'] = '';
	$info['template'] = 'default';
	return $info;
}

function get_casino_game_info($name){
	$link = urldecode($_GET['link']);
	$parts = parse_url($link);
	parse_str($parts['query'], $query);
	$url = check_link();
	if(count($url)>0){
		$name = $url[count($url)-1];
	}
	// if(isset($query['id'])){
	// 	$game = callAPI(NORWAYAPI_ENDPOINT."v1/casino/games/".$query['id']);
	// 	echo '<pre>';
	// 	print_r($game);
	// 	echo '</pre>';
	// }
	$info['title'] = $name;
	$info['content'] = $name;
	$info['slug'] = $name;
	$info['seoTitle'] = '';
	$info['seoMetaDesc'] = '';
	$info['seoCanonical'] = '';
	$info['template'] = 'default';
	return $info;
}

function get_sports_category_data($id, $sportId){
	$title="Sports";
	$content="Sports";
	if($id==0){
		$resArr = get_data_name('sports/'.$sportId);
		$title = $resArr[0]." All";
		$content = $resArr[1]." All";
	}else{
		$location = OM_curl(OM_ENDPOINT . 'eventCategories/'.$id, array() , 'return');
		if (isset($location->successful) && $location->successful) {
			if(count($location->response)){
				$item = $location->response[0];
				if(isset($item->name)){
					$title  = "$item->sportName $item->name";
					$content = "$item->sportName $item->name";
				}
			}
		}
	}
	return array($title, $content);
}

function get_sports_data($id, $sportId){
	$title="Sports";
	$content="Sports";
	if($id==0){
		$resArr = get_data_name('sports/'.$sportId);
		$title = $resArr[0]." All";
		$content = $resArr[1]." All";
	}else{
		$sport = OM_curl(OM_ENDPOINT . 'sports/'.$id, array() , 'return');
		if (isset($sport->successful) && $sport->successful) {
			if(count($sport->response)){
				$item = $sport->response[0];
				if(isset($item->name)){
					$title  = "$item->parentName $item->name";
					$content = "$item->parentName $item->name";
				}
			}
		}
	}
	return array($title, $content);
}

function get_data_name($path){
	$title="Sports";
	$content="Sports";
	$res = OM_curl(OM_ENDPOINT . $path, array() , 'return');
		if (isset($res->successful) && $res->successful) {
			if(count($res->response)){
				$item = $res->response[0];
				if(isset($item->name)){
					$title  = "$item->name";
					$content = "$item->name";
				}
			}
		}
	return array($title, $content);
}

function get_data_match($path){
	$title="Sports";
	$content="Sports";
	$res = OM_curl(OM_ENDPOINT . $path, array() , 'return');
		if (isset($res->successful) && $res->successful) {
			if(count($res->response)){
				$item = $res->response[0];
				if(isset($item->startTime)){
					$date = date('Y-m-d H:i', $item->startTime/1000);
					$title  = "$item->sportName $item->name $date";
					$content = "$item->parentName $item->name ($date) $item->sportName, $item->venueName";
				}
			}
		}
	return array($title, $content);
}

function get_sports_info($name){
	$link = check_link();
	$title = $name;
	$content = $name;
	$seoCanonical = '';
	$count = count($link);
	if($count==2){
		$title = ucwords(str_replace("-", " ", $link[1]));
		$content = $title;
	}else if($count>=9){
		if($link[1]=='tournament-location'){
			$resArr = get_data_match('tournaments/'.$link[7]);
			$title = $resArr[0];
			$content = $resArr[1];
		}else{
			$resArr = get_data_match('matches/'.$link[7]);
			$title = $resArr[0];
			$content = $resArr[1];
		}
	}else if($count==8){
		$sportType = $link[6]; 
		$id = $link[5]; 
		$sportId = $link[3]; 
		if($sportType=='discipline'){
			$resArr = get_sports_data($id, $sportId);
			$title = $resArr[0];
			$content = $resArr[1];
		}else if($sportType=='location'){
			if($id==0){
				$resArr = get_data_name('sports/'.$sportId);
				$title = $resArr[0]." All";
				$content = $resArr[1]." All";
			}else{
				$resArr = get_data_name('locations/'.$id);
				$title = $resArr[0];
				$content = $resArr[1];
			}
		}else if($sportType=='category'){
			$resArr = get_sports_category_data($id, $sportId);
			$title = $resArr[0];
			$content = $resArr[1];
		}
	}else if($count==7){
		$id = $link[5]; 
		$sportId = $link[3]; 
		if($link[6]=='category'){
			$resArr = get_sports_category_data($id, $sportId);
			$title = $resArr[0];
			$content = $resArr[1];
		}else{
			$resArr = get_data_match('tournaments/'.$link[5]);
			$title = $resArr[0];
			$content = $resArr[1];
		}
	}else if($count==6){
		$id = $link[5]; 
		$sportId = $link[3]; 
		if($link[1]=='next-events'){
			$resArr = get_data_name('sports/'.$sportId);
			$title = "Next events ".$resArr[0];
			$content = "Next events ".$resArr[1];
		}else{
			$resArr = get_sports_data($id, $sportId);
			$title = $resArr[0];
			$content = $resArr[1];
		}
	}else if($count==4){
		if($link[1]=='popular-events'){
			$sportId = $link[3]; 
			$resArr = get_data_name('sports/'.$sportId);
			$title = "Popular Events ".$resArr[0];
			$content = "Popular Events ".$resArr[1];
		}else{
			$sportId = $link[3]; 
			$resArr = get_data_name('sports/'.$sportId);
			$title = $resArr[0];
			$content = $resArr[1];
		}
	}
	$info['title'] = $title;
	$info['content'] = $content;
	$info['slug'] = $name;
	$info['seoTitle'] = $title;
	$info['seoMetaDesc'] = $content;
	$info['seoCanonical'] = $seoCanonical;
	$info['template'] = 'default';
	return $info;
}

function page_info() {
	$url = get_url();
	$link = check_link();
	if(count($link)>2 && page_exclude($link[0])){
		if($link[0]=='casino' || $link[0]=='live-casino' || $link[0]=='jackpots'){
			return resOK(get_casino_game_info($link[0]));
		}else{
			return resOK(get_sports_info($link[0]));
		}
	}else if(count($link)==2 && (post_type_exclude($link[0]) || page_exclude($link[0]) )){
		if(post_type_exclude($link[0])){
			$terms = get_terms_data($link[0]);
			if(count($terms)>0){
				return resOK(get_terms_info($terms[0]));
			}else{
				return resFail();
			}
		}else{
			if($link[0]=='casino' || $link[0]=='live-casino' || $link[0]=='jackpots'){
				return resOK(get_casino_game_info($link[0]));
			}else{
				return resOK(get_sports_info($link[0]));
			}
		}

	}else{
		$post_id = get_post_id($url);
		if($post_id<=0){
			$custom_post = get_custom_data();
			if($custom_post){
				$current_id = apply_filters( 'wpml_object_id', $custom_post->ID, 'post', true, get_lang() );
				return resOK(get_page_info($current_id));
			}else{
				return resFail();
			}
		}else{
			$current_id = apply_filters( 'wpml_object_id', $post_id, 'post', true, get_lang() );
			return resOK(get_page_info($current_id));
		}
	}
}

add_action( 'rest_api_init', function () {
    register_rest_route( 'custom/v1', '/page_info', array(
      'methods' => 'GET',
      'callback' => 'page_info'
    ) );
} );

add_filter( 'acf/rest_api/recursive/types', function( $types ) {
	$types += array(
		'dedicated_lobbies' => 'dedicated_lobbies',
	);
	return $types;
} );

add_filter( 'wpseo_sitemap_index', 'add_casino_sitemap_to_index', 99 );
add_action( 'init', 'add_casino_sitemap_to_wpseo' );

// Add custom index
function add_casino_sitemap_to_index($smp){
    global $wpseo_sitemaps;
    $date = date('Y-m-d\TH:i:s+00:00');

    $smp .= '<sitemap>' . PHP_EOL;
    $smp .= '<loc>' . home_url() .'/casino-sitemap.xml</loc>' . PHP_EOL;
    $smp .= '<lastmod>' . htmlspecialchars( $date ) . '</lastmod>' . PHP_EOL;
    $smp .= '</sitemap>' . PHP_EOL;

    return $smp;
}

function add_casino_sitemap_to_wpseo(){
    add_action( "wpseo_do_sitemap_casino", 'generate_casino_sitemap');
}

function generate_casino_sitemap(){
    global $wpseo_sitemaps, $post;
	$args = array(
		'post_type' => 'dedicated_lobbies',
		'post_status' => 'publish',
		'posts_per_page' => -1
	);
	$posts = new WP_Query( $args );
	$datasource_name_casino_arr = [];
	while ( $posts->have_posts() ) : $posts->the_post();
		$datasource_name_casino =  get_post_meta($post->ID, 'datasource_name_casino', true);
		if (!in_array($datasource_name_casino, $datasource_name_casino_arr)){
			array_push($datasource_name_casino_arr,$datasource_name_casino);
		}
	endwhile;
	$output = '';
	$query = "?expand=games&fields=games%28id%2Cname%2Ctype%2ChasAnonymousFunMode%2Cgroups%2Cthumbnail%29&language=en&pagination=games%28limit%3D100%29";
	
	if(count($datasource_name_casino_arr)>0){
		foreach ($datasource_name_casino_arr as $item) {
			$res = callAPI(NORWAYAPI_ENDPOINT."v1/casino/groups/".$item.$query);
			if($res->count>0){
				foreach ($res->items as $list) {
					if($list->games->count>0){
						foreach ($list->games->items as $game) {
							$page = 'live-casino';
							$mode = '&funMode=true';
							$group = $game->groups->items[0];
							list($datasource, $group_name) = explode('$',$group);
							if($game->type=='casino-games'){
								$page = 'casino';
							}
							if($game->hasAnonymousFunMode){
								$mode = '&funMode=false';
							}
							$date = date('Y-m-d\TH:i:s+00:00');
							$output .= '<url>' . PHP_EOL;
							$output .= '<loc>' . htmlspecialchars(home_url() .'/'.$page.'/'.$group_name.'/'.$game->name.'?id='.$game->id.$mode) .'</loc>' . PHP_EOL;
							$output .= '<lastmod>' . htmlspecialchars( $date ) . '</lastmod>' . PHP_EOL;
							if($game->thumbnail!=''){
								$output .= '<image:image>' . PHP_EOL;
								$output .= '<image:loc>'.$game->thumbnail.'</image:loc>' . PHP_EOL;
								$output .= '</image:image>' . PHP_EOL;
							}
							$output .= '</url>' . PHP_EOL;
						}	
					}
				}	
			}

		}
	}

    //Build the full sitemap
    $sitemap  = '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-image/1.1 http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;
    $sitemap .= $output . '</urlset>';

    $wpseo_sitemaps->set_sitemap($sitemap);

}

/*********************************************************
 *  OR we can use $wpseo_sitemaps->register_sitemap( 'casino', 'METHOD' );
 ********************************************************/

add_action( 'init', 'register_casino_sitemap', 99 );
/**
 * On init, run the function that will register our new sitemap as well
 * as the function that will be used to generate the XML. This creates an
 * action that we can hook into built around the new
 * sitemap name - 'wp_seo_do_sitemap_*'
 */
function register_casino_sitemap() {
    global $wpseo_sitemaps;
    if($wpseo_sitemaps) {
        $wpseo_sitemaps->register_sitemap( 'casino', 'generate_casino_sitemap' );
    }
}

add_action( 'init', 'init_do_sitemap_actions' );

function init_do_sitemap_actions(){
    add_action( 'wp_seo_do_sitemap_casino', 'generate_casino_sitemap' );
	add_action( 'wp_seo_do_sitemap_sports', 'generate_sports_sitemap' );
}


add_filter( 'wpseo_sitemap_index', 'add_sports_sitemap_to_index', 99 );
add_action( 'init', 'add_sports_sitemap_to_wpseo' );

// Add custom index
function add_sports_sitemap_to_index($smp){
    global $wpseo_sitemaps;
    $date = date('Y-m-d\TH:i:s+00:00');

    $smp .= '<sitemap>' . PHP_EOL;
    $smp .= '<loc>' . home_url() .'/sports-sitemap.xml</loc>' . PHP_EOL;
    $smp .= '<lastmod>' . htmlspecialchars( $date ) . '</lastmod>' . PHP_EOL;
    $smp .= '</sitemap>' . PHP_EOL;

    return $smp;
}

function add_sports_sitemap_to_wpseo(){
    add_action( "wpseo_do_sitemap_sports", 'generate_sports_sitemap');
}

function get_matchs($sportId, $locationId, $live){
	$matchs = OM_curl(OM_ENDPOINT . "matches?sportId=$sportId&locationId=$locationId&live=$live", array() , 'return');
	if ($matchs->successful) {
		return $matchs->response;
	}
	return array();
}

function get_locations($id){
	$location = OM_curl(OM_ENDPOINT . 'sports/'.$id.'/locations', array() , 'return');
	if ($location->successful) {
		return $location->response;
	}
	return array();
}

function get_sport_childern($id){
	$sports = OM_curl(OM_ENDPOINT . 'sports/'.$id, array() , 'return');
	if (isset($sports->successful) && $sports->successful) {
		return $sports->response[0];
	}
	return array();
}

function get_sports(){
	$sports = OM_curl(OM_ENDPOINT . 'sports', array() , 'return');
	$sportsArr = array();
	if (isset($sports->successful) && $sports->successful) {
		foreach ($sports->response as $sport){
			if(count($sport->childrenIds)){
				foreach ($sport->childrenIds as $children){
					array_push($sportsArr,get_sport_childern($children));
				}
			}else{
				array_push($sportsArr,$sport);
			}
		}
	}
	return $sportsArr;
}

function urlPattern($sportPath, $sportId, $shortSportName, $shortVenueName, $shortParentName, $shortName, $id){
    return home_url()."/$sportPath/$sportId/$shortSportName/$shortVenueName/$shortParentName/$shortName/$id";
}

function generate_sports_matchs_sitemap($sportId){
    global $wpseo_sitemaps;
	$output = "";
	$matchsArr = array();
	if(isset($sportId)){
		$locations = get_locations($sportId);
		if(count($locations)>0){
			foreach ($locations as $location){
				$matchs = get_matchs($sportId, $location->id, false);
				array_push($matchsArr,$matchs);
			}
		}
	}
	if(count($matchsArr)>0){
		foreach ($matchsArr as $matchs){
			if(count($matchs)>0){
				foreach ($matchs as $match){
					if(isset($match->startTime)){
						$sportPath = 'sports/event';
						$date = date('Y-m-d\TH:i:s+00:00', $match->startTime/1000);
						$url = urlPattern($sportPath, $match->sportId, sanitize_title($match->shortSportName), sanitize_title($match->shortVenueName), sanitize_title($match->shortParentName), sanitize_title($match->shortName), $match->id);
						$output .= '<url>' . PHP_EOL;
						$output .= '<loc>' . htmlspecialchars($url) .'</loc>' . PHP_EOL;
						$output .= '<lastmod>' . htmlspecialchars( $date ) . '</lastmod>' . PHP_EOL;
						$output .= '</url>' . PHP_EOL;
					}
				}
			}
		}
	}
    //Build the full sitemap
    $sitemap  = '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-image/1.1 http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;
    $sitemap .= $output . '</urlset>';

    $wpseo_sitemaps->set_sitemap($sitemap);
	$wpseo_sitemaps->output();
	exit();
}

add_action( 'init', 'add_matchs_sitemap_to_wpseo' );

function add_matchs_sitemap_to_wpseo(){
    global $wp;
	$current_url = add_query_arg( null, $wp->request );
	if (strpos($current_url, 'sports_') !== false) {
		$path = explode('_',$current_url);
		$findId = end($path);
		list($sportId, $text) = explode('-sitemap.xml',$findId);
		generate_sports_matchs_sitemap($sportId);
	}
}

function generate_sports_sitemap(){
	register_sports_list_sitemap();
}

function register_sports_list_sitemap() {
    global $wpseo_sitemaps;
    if($wpseo_sitemaps) {
		$sports = get_sports();
		$sitemap = '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'. PHP_EOL;
		$sitemap .=  add_sports_list_sitemap_to_index($sports);
		$sitemap .= '</sitemapindex>';
		$wpseo_sitemaps->set_sitemap($sitemap);
    }
}

// Add custom sports list
function add_sports_list_sitemap_to_index($sports){
    $date = date('Y-m-d\TH:i:s+00:00');
	$smp = '';
	if(count($sports)>0){
		foreach ($sports as $sport){
			$smp .= '<sitemap>' . PHP_EOL;
			$smp .= '<loc>' . home_url() .'/'.'sports_'.sanitize_title($sport->name).'_'.$sport->id.'-sitemap.xml</loc>' . PHP_EOL;
			$smp .= '<lastmod>' . htmlspecialchars( $date ) . '</lastmod>' . PHP_EOL;
			$smp .= '</sitemap>' . PHP_EOL;
		}
	}
    return $smp;
}

/*********************************************************
 *  OR we can use $wpseo_sitemaps->register_sitemap( 'sports', 'METHOD' );
 ********************************************************/

add_action( 'init', 'register_sports_sitemap', 99 );
/**
 * On init, run the function that will register our new sitemap as well
 * as the function that will be used to generate the XML. This creates an
 * action that we can hook into built around the new
 * sitemap name - 'wp_seo_do_sitemap_*'
 */
function register_sports_sitemap() {
    global $wpseo_sitemaps;
    if($wpseo_sitemaps) {
        $wpseo_sitemaps->register_sitemap( 'sports', 'generate_sports_sitemap' );
    }
}

function return_json($data)
{
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    echo json_encode($data);
    exit();
}

/**OM server api EM*/
function OM_curl($url , $params = array(), $return='json', $method='post'){
	global $sitepress;
    $header = array( "security-token:".OM_TOKEN,"language:".$sitepress->get_default_language());
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    if($method == 'post'){
        if(count($params) > 0 )curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    }
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    $curlResult = curl_exec($ch);
    $result = array('successful'=>false,'message'=>'OM api down.'); 
    if ($curlResult === false) {
        $result = array('successful'=>false,'message'=>curl_error($ch));        
    }else{
        $result = json_decode($curlResult);
    }
    if($return=='json'){
        return_json($result);
    }else{
        return $result;
    }
}

//add SVG to allowed file uploads
function add_file_types_to_uploads($file_types){

    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes );

    return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');