<?php
/**
 * Init function
 */
if( !function_exists( 'otw_pcl_init' ) ){
	
	function otw_pcl_init(){
		
		global $otw_pcl_plugin_url, $otw_pcl_grid_manager_component, $otw_pcl_shortcode_component, $otw_pcl_shortcode_object, $otw_pcl_form_component, $otw_pcl_validator_component, $otw_pcl_form_object, $otw_pcl_js_version, $otw_pcl_css_version, $otw_pcl_grid_manager_object, $wp_pcl_int_items, $otw_pcl_overlay_component, $otw_pcl_overlay_object, $otw_pcl_factory_component, $otw_pcl_factory_object, $otw_pcl_plugin_id;
		
		if( is_admin() ){
			
			add_action('admin_menu', 'otw_pcl_init_admin_menu' );
			
			add_action('admin_print_styles', 'otw_pcl_enqueue_admin_styles' );
			
			add_action('admin_enqueue_scripts', 'otw_pcl_enqueue_admin_scripts');
			
			add_filter('otwfcr_notice', 'otw_pcl_factory_message' );
		}
		else
		{
			otw_pcl_enqueue_styles();
			
			otw_pcl_enqueue_scripts();
		}
		
		//otw grid manager component
		$otw_pcl_grid_manager_component = otw_load_component( 'otw_overlay_grid_manager' );
		$otw_pcl_grid_manager_object = otw_get_component( $otw_pcl_grid_manager_component );
		$otw_pcl_grid_manager_object->js_version = $otw_pcl_js_version;
		$otw_pcl_grid_manager_object->css_version = $otw_pcl_css_version;
		$otw_pcl_grid_manager_object->text_info = esc_html__( 'Add some rows and columns in the rows. Then you will be able to add shortcodes in the columns. Once you build your layout you can save it so you can use it for another page.', 'otw_pcl' );
		
		include_once( plugin_dir_path( __FILE__ ).'otw_labels/otw_pcl_grid_manager_object.labels.php' );
		$otw_pcl_grid_manager_object->init();
		
		//shortcode component
		$otw_pcl_shortcode_component = otw_load_component( 'otw_overlay_shortcode' );
		$otw_pcl_shortcode_object = otw_get_component( $otw_pcl_shortcode_component );
		$otw_pcl_shortcode_object->js_version = $otw_pcl_js_version;
		$otw_pcl_shortcode_object->css_version = $otw_pcl_css_version;
		
		$otw_pcl_shortcode_object->add_default_external_lib( 'css', 'style', get_stylesheet_directory_uri().'/style.css', 'live_preview', 10 );
		
		$otw_pcl_shortcode_object->shortcodes['button'] = array('title' => esc_html__('Button', 'otw_pcl'), 'enabled' => true, 'children' => false, 'parent' => false, 'order' => 0, 'path' => dirname(__FILE__) . '/otw_components/otw_overlay_shortcode/', 'url' => $otw_pcl_plugin_url . '/include/otw_components/otw_overlay_shortcode/');
		$otw_pcl_shortcode_object->shortcodes['info_box'] = array('title' => esc_html__('Info Box', 'otw_pcl'), 'enabled' => true, 'children' => false, 'parent' => false, 'order' => 2, 'path' => dirname(__FILE__) . '/otw_components/otw_overlay_shortcode/', 'url' => $otw_pcl_plugin_url . '/include/otw_components/otw_overlay_shortcode/');
		$otw_pcl_shortcode_object->shortcodes['dropcap'] = array('title' => esc_html__('Dropcaps', 'otw_pcl'), 'enabled' => true, 'children' => false, 'parent' => false, 'order' => 3, 'path' => dirname(__FILE__) . '/otw_components/otw_overlay_shortcode/', 'url' => $otw_pcl_plugin_url . '/include/otw_components/otw_overlay_shortcode/');
		$otw_pcl_shortcode_object->shortcodes['quote'] = array('title' => esc_html__('Quote', 'otw_pcl'), 'enabled' => true, 'children' => false, 'parent' => false, 'order' => 4, 'path' => dirname(__FILE__) . '/otw_components/otw_overlay_shortcode/', 'url' => $otw_pcl_plugin_url . '/include/otw_components/otw_overlay_shortcode/');
		$otw_pcl_shortcode_object->shortcodes['tabslayout'] = array('title' => esc_html__('Tabs Layout', 'otw_pcl'), 'enabled' => true, 'children' => false, 'parent' => false, 'order' => 7, 'path' => dirname(__FILE__) . '/otw_components/otw_overlay_shortcode/', 'url' => $otw_pcl_plugin_url . '/include/otw_components/otw_overlay_shortcode/');
		$otw_pcl_shortcode_object->shortcodes['content_toggle'] = array('title' => esc_html__('Content toggle', 'otw_pcl'), 'enabled' => true, 'children' => false, 'parent' => false, 'order' => 8, 'path' => dirname(__FILE__) . '/otw_components/otw_overlay_shortcode/', 'url' => $otw_pcl_plugin_url . '/include/otw_components/otw_overlay_shortcode/');
		$otw_pcl_shortcode_object->shortcodes['unordered_list'] = array('title' => esc_html__('Unordered list', 'otw_pcl'), 'enabled' => true, 'children' => false, 'parent' => false, 'order' => 15, 'path' => dirname(__FILE__) . '/otw_components/otw_overlay_shortcode/', 'url' => $otw_pcl_plugin_url . '/include/otw_components/otw_overlay_shortcode/');
		$otw_pcl_shortcode_object->shortcodes['ordered_list'] = array('title' => esc_html__('Ordered list', 'otw_pcl'), 'enabled' => true, 'children' => false, 'parent' => false, 'order' => 16, 'path' => dirname(__FILE__) . '/otw_components/otw_overlay_shortcode/', 'url' => $otw_pcl_plugin_url . '/include/otw_components/otw_overlay_shortcode/');
		$otw_pcl_shortcode_object->shortcodes['divider'] = array('title' => esc_html__('Divider', 'otw_pcl'), 'enabled' => true, 'children' => false, 'parent' => false, 'order' => 17, 'path' => dirname(__FILE__) . '/otw_components/otw_overlay_shortcode/', 'url' => $otw_pcl_plugin_url . '/include/otw_components/otw_overlay_shortcode/');
		$otw_pcl_shortcode_object->shortcodes['html_editor'] = array('title' => esc_html__('HTML Editor', 'otw_pcl'), 'enabled' => true, 'children' => false, 'parent' => false, 'order' => 125, 'path' => dirname(__FILE__) . '/otw_components/otw_overlay_shortcode/', 'url' => $otw_pcl_plugin_url . '/include/otw_components/otw_overlay_shortcode/');
		
		
		include_once( plugin_dir_path( __FILE__ ).'otw_labels/otw_pcl_shortcode_object.labels.php' );
		$otw_pcl_shortcode_object->init();
		
		//form component
		$otw_pcl_form_component = otw_load_component( 'otw_form' );
		$otw_pcl_form_object = otw_get_component( $otw_pcl_form_component );
		$otw_pcl_form_object->js_version = $otw_pcl_js_version;
		$otw_pcl_form_object->css_version = $otw_pcl_css_version;
		
		global $wp_filesystem;
		
		if( otw_init_filesystem() ){
			
			if(  $wp_filesystem->is_file( plugin_dir_path( __FILE__ ).'otw_labels/otw_pcl_form_object.labels.php' ) ){
				include_once( plugin_dir_path( __FILE__ ).'otw_labels/otw_pcl_form_object.labels.php' );
			}
		}
		$otw_pcl_form_object->init();
		
		//overlay component
		$otw_pcl_overlay_component = otw_load_component( 'otw_overlay' );
		$otw_pcl_overlay_object = otw_get_component( $otw_pcl_overlay_component );
		$otw_pcl_overlay_object->js_version = $otw_pcl_js_version;
		$otw_pcl_overlay_object->css_version = $otw_pcl_css_version;
		$otw_pcl_overlay_object->grid_manager_component_object = $otw_pcl_grid_manager_object;
		$otw_pcl_overlay_object->create_nav_menu = true;
		$otw_pcl_overlay_object->views['full_bar'] = 'views/pcl/full_bar';
		$otw_pcl_overlay_object->views['side_box'] = 'views/pcl/side_box';
		$otw_pcl_overlay_object->views['lightbox'] = 'views/pcl/lightbox';
		include_once( plugin_dir_path( __FILE__ ).'otw_labels/otw_pcl_overlay_object.labels.php' );
		$otw_pcl_overlay_object->init();
		
		$otw_pcl_factory_component = otw_load_component( 'otw_factory' );
		$otw_pcl_factory_object = otw_get_component( $otw_pcl_factory_component );
		$otw_pcl_factory_object->add_plugin( $otw_pcl_plugin_id, dirname( dirname( __FILE__ ) ).'/otw_popping_content.php', array( 'menu_parent' => 'otw-pcl', 'lc_name' => esc_html__( 'License Manager', 'otw_pcl' ), 'menu_key' => 'otw-pcl' ) );
		
		include_once( plugin_dir_path( __FILE__ ).'otw_labels/otw_pcl_factory_object.labels.php' );
		$otw_pcl_factory_object->init();
		
		
		include_once( 'otw_pcl_process_actions.php' );
		
	}
}
/**
 * include needed styles
 */
if( !function_exists( 'otw_pcl_enqueue_styles' ) ){
	function otw_pcl_enqueue_styles(){
		global $otw_pcl_plugin_url, $otw_pcl_css_version;
		
		if( !is_admin() ){
		}
	}
}

/**
 * include needed scripts
 */
if( !function_exists( 'otw_pcl_enqueue_scripts' ) ){
	function otw_pcl_enqueue_scripts(){
		global $otw_pcl_plugin_url, $otw_pcl_js_version;
		
		if( !is_admin() ){
		
		}
	}
}
/**
 * Admin styles
 */
if( !function_exists( 'otw_pcl_enqueue_admin_styles' ) ){
	
	function otw_pcl_enqueue_admin_styles(){
		
		global $otw_pcl_plugin_url, $otw_pcl_css_version;
		
		wp_enqueue_style( 'otw_pcl_admin', $otw_pcl_plugin_url.'/css/otw_pcl_admin.css', array( 'thickbox' ), $otw_pcl_css_version );
	}
}

/**
 * Admin scripts
 */
if( !function_exists( 'otw_pcl_enqueue_admin_scripts' ) ){
	
	function otw_pcl_enqueue_admin_scripts( $requested_page ){
		
		global $otw_pcl_plugin_url, $otw_pcl_js_version, $otw_pcl_shortcode_object, $otw_pcl_grid_manager_object;
		
		
		if( ( $requested_page == 'popping-content-light_page_otw-pcl-manage' ) || ( preg_match( "/page_otw-pcl-manage$/", $requested_page ) ) ){
					
			$otw_pcl_grid_manager_object->include_admin_scripts();
			$otw_pcl_shortcode_object->include_admin_scripts();
			
			wp_enqueue_style('thickbox');
			wp_enqueue_script('thickbox');
			wp_enqueue_script('media-models');
			wp_enqueue_script('media-upload');
			wp_enqueue_media();
			wp_enqueue_script("otw_pcl_manage_overlay_admin", $otw_pcl_plugin_url.'/js/otw_manage_overlay_admin.js'  , array( 'jquery', 'jquery-ui-sortable' ), $otw_pcl_js_version );
		}
	}
	
}

/**
 * Init admin menu
 */
if( !function_exists( 'otw_pcl_init_admin_menu' ) ){
	
	function otw_pcl_init_admin_menu(){
		
		global $otw_pcl_plugin_url;
		
		add_menu_page(__('Popping Content Light', 'otw_pcl'), esc_html__('Popping Content Light', 'otw_pcl'), 'manage_options', 'otw-pcl', 'otw_pcl_list', $otw_pcl_plugin_url.'/images/otw-menu-icon.png');
		add_submenu_page( 'otw-pcl', esc_html__('All Overlays', 'otw_pcl'), esc_html__('All Overlays', 'otw_pcl'), 'manage_options', 'otw-pcl', 'otw_pcl_list' );
		add_submenu_page( 'otw-pcl', esc_html__('Manage Overlay', 'otw_pcl'), esc_html__('Add Overlay', 'otw_pcl'), 'manage_options', 'otw-pcl-manage', 'otw_pcl_manage' );
		add_submenu_page( __FILE__, esc_html__('Overlay action', 'otw_pcl'), esc_html__('Overlay action', 'otw_pcl'), 'manage_options', 'otw-pcl-action', 'otw_pcl_action' );
		add_submenu_page( 'otw-pcl', esc_html__( 'Plugin Options', 'otw_pcl'), esc_html__('Plugin Options', 'otw_pcl'), 'manage_options', 'otw-pcl-options', 'otw_pcl_plugin_options' );

	}
}

/**
 * Get overlays
 */
if( !function_exists( 'otw_get_overlays' ) ){
	function otw_get_overlays(){
		
		$otw_overlays = get_option( 'otw_overlays' );
		
		if( !is_array( $otw_overlays ) ){
			$otw_overlays = array();
		}
		return $otw_overlays;
	}
}

/**
 * Save overlays
 */
if( !function_exists( 'otw_save_overlays' ) ){
	function otw_save_overlays( $otw_overlays ){
		
		return update_option( 'otw_overlays', $otw_overlays );
	}
}

/**
 * Get next overlay id
 */
if( !function_exists( 'otw_get_next_overlay_id' ) ){
	function otw_get_next_overlay_id(){
		$next_id = 0;
		$existing_overlays = otw_get_overlays();
		
		if( is_array( $existing_overlays ) && count( $existing_overlays ) ){
			
			foreach( $existing_overlays as $key => $s_data ){
			
				if( preg_match( "/^otw\-overlay\-([0-9]+)$/", $key, $matches ) ){
				
					if( $matches[1] > $next_id ){
						$next_id = $matches[1];
					}
				}
			}
		}
		return $next_id + 1;
	}
}

/** calls page where to create new overlay
  *
  */
function otw_pcl_manage(){
	require_once( 'otw_pcl_manage.php' );
}

/** calls page where to list all overlays
  *
  */
function otw_pcl_list(){
	require_once( 'otw_pcl_list.php' );
}

function otw_pcl_items_by_type(){
	require_once( 'otw_pcl_items_by_type.php' );
	die;
}

/** calls page where to process overlay actions
  *
  */
function otw_pcl_action(){
	require_once( 'otw_pcl_overlays_action.php' );
}
/** calls plugin opionts page
  *
  */
function otw_pcl_plugin_options(){
	require_once( 'otw_pcl_plugin_options.php' );
}


if( !function_exists( 'otw_pcl_get_item_sort_options' ) ){
	function otw_pcl_get_item_sort_options( $item_type ){
	
		$sort_options = array();
		
		switch( $item_type ){
		
			case 'page':
			case 'post':
					$sort_options['a_z'] = esc_html__( 'Alphabetically: A-Z', 'otw_pcl' );
					$sort_options['z_a'] = esc_html__( 'Alphabetically: Z-A', 'otw_pcl' );
					$sort_options['date_latest'] = esc_html__( 'Latest created', 'otw_pcl' );
					$sort_options['date_oldest'] = esc_html__( 'Oldest created', 'otw_pcl' );
					$sort_options['modified_latest'] = esc_html__( 'Latest Modified', 'otw_pcl' );
					$sort_options['modified_oldest'] = esc_html__( 'Oldest Modified', 'otw_pcl' );
				break;
			case 'templatehierarchy':
			case 'pagetemplate':
			case 'archive':
			case 'author_archive':
			case 'userroles':
			case 'wpmllanguages':
			case 'bbp_page':
			case 'buddypress_page':
					$sort_options['a_z'] = esc_html__( 'Alphabetically: A-Z', 'otw_pcl' );
					$sort_options['z_a'] = esc_html__( 'Alphabetically: Z-A', 'otw_pcl' );
				break;
			default:
					if( preg_match( "/^cpt_(.*)$/", $item_type, $matches ) ){
						$sort_options['a_z'] = esc_html__( 'Alphabetically: A-Z', 'otw_pcl' );
						$sort_options['z_a'] = esc_html__( 'Alphabetically: Z-A', 'otw_pcl' );
						$sort_options['date_latest'] = esc_html__( 'Latest created', 'otw_pcl' );
						$sort_options['date_oldest'] = esc_html__( 'Oldest created', 'otw_pcl' );
						$sort_options['modified_latest'] = esc_html__( 'Latest Modified', 'otw_pcl' );
						$sort_options['modified_oldest'] = esc_html__( 'Oldest Modified', 'otw_pcl' );
					}else{
						$sort_options['a_z'] = esc_html__( 'Alphabetically: A-Z', 'otw_pcl' );
						$sort_options['z_a'] = esc_html__( 'Alphabetically: Z-A', 'otw_pcl' );
						$sort_options['date_latest'] = esc_html__( 'Latest created', 'otw_pcl' );
						$sort_options['date_oldest'] = esc_html__( 'Oldest created', 'otw_pcl' );
					}
				break;
		}
		return $sort_options;
	}
}

if( !function_exists( 'otw_pcl_wp_item_exclude' ) ){
	function otw_pcl_wp_item_exclude( $exclude_object, $type, $overlay_data ){
		
		if( isset( $overlay_data['exclude_posts_for'] ) && isset( $overlay_data['exclude_posts_for'][ $type ] )  && strlen( trim( $overlay_data['exclude_posts_for'][ $type ] ) ) ){
			return $overlay_data['exclude_posts_for'][ $type ];
		}
		return '';
	}
}

if (!function_exists( "otw_pcl_get_filtered_items" )){
	function otw_pcl_get_filtered_items( $type, $filter, $overlay_id, $displayed_items = 20, $id_in_list = array(), $id_not_in_list = array(), $show = 'all', $order = 'a_z', $current_page = 0 ){
		
		global $string_filter, $id_list_filter;
		
		$string_filter = $filter;
		$id_list_filter = $id_in_list;
		$pager_data = array();
		
		switch( $type )
		{
			case 'page':
					$args = array();
					$args['post_type']      = $type;
					$args['posts_per_page'] = -1;
					if( count( $id_list_filter ) ){
						$args['post__in']       = $id_list_filter;
					}
					if( $string_filter ){
						add_filter( 'posts_where', 'otw_pcl_post_by_title' );
					}
					
					if( otw_pcl_installed_plugin( 'buddypress' ) ){
						
						global $bp;
						
						if( isset( $bp->pages->activity ) && $bp->pages->activity->id ){
							$id_not_in_list[] = $bp->pages->activity->id;
						}
						if( isset( $bp->pages->members ) && $bp->pages->members->id ){
							$id_not_in_list[] = $bp->pages->members->id;
						}
					}
					
					if( count( $id_not_in_list ) ){
						$args['post__not_in'] = $id_not_in_list;
					}
					
					$the_query = new WP_Query( $args );
					
					$all_items = count( $the_query->posts );
					
					$pager_data = otw_pcl_get_pager_data( $all_items, $displayed_items, $current_page );
					
					$args['offset'] = $pager_data['first'];
					$args['posts_per_page'] = ($displayed_items)?$displayed_items:-1;
					
					switch( $order )
					{
						case 'a_z':
								$args['orderby']        = 'title';
								$args['order']          = 'ASC';
							break;
						case 'z_a':
								$args['orderby']        = 'title';
								$args['order']          = 'DESC';
							break;
						case 'date_latest':
								$args['orderby']        = 'date';
								$args['order']          = 'DESC';
							break;
						case 'date_oldest':
								$args['orderby']        = 'date';
								$args['order']          = 'ASC';
							break;
						case 'modified_latest':
								$args['orderby']        = 'modified';
								$args['order']          = 'DESC';
							break;
						case 'modified_oldest':
								$args['orderby']        = 'modified';
								$args['order']          = 'ASC';
							break;
						default:
								$args['orderby']        = 'ID';
								$args['order']          = 'DESC';
							break;
					}
					
					$the_query = new WP_Query( $args );
					
					if( $string_filter ){
						remove_filter('posts_where', 'otw_pcl_post_by_title');
					}
					
					return array( $all_items, $the_query->posts, $pager_data );
				break;
			case 'post':
					$args = array();
					$args['post_type']      = $type;
					$args['posts_per_page'] = -1;
					if( count( $id_list_filter ) ){
						$args['post__in']       = $id_list_filter;
					}
					if( $string_filter ){
						add_filter( 'posts_where', 'otw_pcl_post_by_title' );
					}
					
					if( count( $id_not_in_list ) ){
						$args['post__not_in'] = $id_not_in_list;
					}
					
					$the_query = new WP_Query( $args );
					
					$all_items = count( $the_query->posts );
					
					$pager_data = otw_pcl_get_pager_data( $all_items, $displayed_items, $current_page );
					
					$args['offset'] = $pager_data['first'];
					$args['posts_per_page'] = ($displayed_items)?$displayed_items:-1;
					
					switch( $order )
					{
						case 'a_z':
								$args['orderby']        = 'title';
								$args['order']          = 'ASC';
							break;
						case 'z_a':
								$args['orderby']        = 'title';
								$args['order']          = 'DESC';
							break;
						case 'date_latest':
								$args['orderby']        = 'date';
								$args['order']          = 'DESC';
							break;
						case 'date_oldest':
								$args['orderby']        = 'date';
								$args['order']          = 'ASC';
							break;
						case 'modified_latest':
								$args['orderby']        = 'modified';
								$args['order']          = 'DESC';
							break;
						case 'modified_oldest':
								$args['orderby']        = 'modified';
								$args['order']          = 'ASC';
							break;
						default:
								$args['orderby']        = 'ID';
								$args['order']          = 'DESC';
							break;
					}
					
					$the_query = new WP_Query( $args );
					
					if( $string_filter ){
						remove_filter('posts_where', 'otw_pcl_post_by_title');
					}
					
					return array( $all_items, $the_query->posts, $pager_data );
				break;
			case 'category':
			case 'postsincategory':
					//first get all
					$args = array();
					$args['type']            = 'post';
					$args['hide_empty']      = 0;
					$args['number']          = 0;
					
					if( count( $id_list_filter ) ){
						sort( $id_list_filter );
						$args['include']  = $id_list_filter;
					}
					
					if( $string_filter ){
						$args['search'] = $string_filter;
					}
					
					if( count( $id_not_in_list ) ){
						sort( $id_not_in_list );
						$args['exclude'] = $id_not_in_list;
					}
					
					$all_items = count( get_categories( $args ) );
					
					$pager_data = otw_pcl_get_pager_data( $all_items, $displayed_items, $current_page );
					
					$args['offset'] = $pager_data['first'];
					$args['number']          = ($displayed_items)?$displayed_items:0;
					
					switch( $order )
					{
						case 'a_z':
								$args['orderby']        = 'name';
								$args['order']          = 'ASC';
							break;
						case 'z_a':
								$args['orderby']        = 'name';
								$args['order']          = 'DESC';
							break;
						case 'date_latest':
								$args['orderby']        = 'ID';
								$args['order']          = 'DESC';
							break;
						case 'date_oldest':
								$args['orderby']        = 'ID';
								$args['order']          = 'ASC';
							break;
						default:
								$args['orderby']        = 'ID';
								$args['order']          = 'DESC';
							break;
					}
					return array( $all_items, get_categories( $args ), $pager_data );
				break;
			case 'posttag':
			case 'postsintag':
					$args = array();
					$args['hide_empty']      = 0;
					$args['number']          = 0;
					
					if( count( $id_list_filter ) ){
						sort( $id_list_filter );
						$args['include']  = $id_list_filter;
					}
					
					if( $string_filter ){
						$args['search'] = $string_filter;
					}
					
					if( count( $id_not_in_list ) ){
						sort( $id_not_in_list );
						$args['exclude'] = $id_not_in_list;
					}
					
					$all_items = count( get_terms( 'post_tag', $args ) );
					
					$pager_data = otw_pcl_get_pager_data( $all_items, $displayed_items, $current_page );
					
					$args['offset'] 	 = $pager_data['first'];
					$args['number']          = ($displayed_items)?$displayed_items:0;
					
					switch( $order )
					{
						case 'a_z':
								$args['orderby']        = 'name';
								$args['order']          = 'ASC';
							break;
						case 'z_a':
								$args['orderby']        = 'name';
								$args['order']          = 'DESC';
							break;
						case 'date_latest':
								$args['orderby']        = 'ID';
								$args['order']          = 'DESC';
							break;
						case 'date_oldest':
								$args['orderby']        = 'ID';
								$args['order']          = 'ASC';
							break;
						default:
								$args['orderby']        = 'ID';
								$args['order']          = 'DESC';
							break;
					}
					return array( $all_items, get_terms( 'post_tag', $args ), $pager_data );
				break;
			case 'author_archive':
					$args = array();
					$args['number']          = 0;
					
					if( count( $id_list_filter ) ){
						sort( $id_list_filter );
						$args['include']  = $id_list_filter;
					}
					
					if( $string_filter ){
						$args['search'] = '*'.$string_filter.'*';
					}
					
					if( count( $id_not_in_list ) ){
						sort( $id_not_in_list );
						$args['exclude'] = $id_not_in_list;
					}
					
					$all_items = count( get_users( $args ) );
					
					$pager_data = otw_pcl_get_pager_data( $all_items, $displayed_items, $current_page );
					
					$args['offset'] 	 = $pager_data['first'];
					$args['number']          = ($displayed_items)?$displayed_items:0;
					
					switch( $order )
					{
						case 'a_z':
								$args['orderby']        = 'login';
								$args['order']          = 'ASC';
							break;
						case 'z_a':
								$args['orderby']        = 'login';
								$args['order']          = 'DESC';
							break;
						case 'date_latest':
								$args['orderby']        = 'registered';
								$args['order']          = 'DESC';
							break;
						case 'date_oldest':
								$args['orderby']        = 'registered';
								$args['order']          = 'ASC';
							break;
						default:
								$args['orderby']        = 'ID';
								$args['order']          = 'DESC';
							break;
					}
					
					return array( $all_items, get_users( $args ), $pager_data );
				break;
			case 'customposttype':
			case 'templatehierarchy':
			case 'archive':
					$all_items = otw_pcl_get_wp_items( $type );
					$items = array();
					foreach( $all_items as $item_key => $item_object ){
					
						if( $string_filter ){
							if( ( stripos( $item_object->name, $string_filter ) === false ) ){
								continue;
							}
						}
						
						if( count( $id_list_filter ) && !in_array( $item_object->ID, $id_list_filter ) && !in_array( 'all', $id_list_filter ) ){
							continue;
						}
						if( count( $id_not_in_list ) && ( in_array( $item_object->ID, $id_not_in_list ) || in_array( 'all', $id_not_in_list ) ) ){
							continue;
						}
						$items[] = $item_object;
					}
					$all_items = count( $items );
					$pager_data = otw_pcl_get_pager_data( $all_items, $displayed_items, $current_page );
					
					$sort_args = array();
					switch( $order )
					{
						case 'a_z':
								$sort_args['name'] = 'ASC';
							break;
						case 'z_a':
								$sort_args['name'] = 'DESC';
							break;
						default:
								$sort_args['name'] = 'ASC';
							break;
					}
					
					if( count( $items ) ){
						
						$items = otw_pcl_asort( $items, $sort_args );
						if( $displayed_items ){
							$items = array_slice( $items, $pager_data['first'], $displayed_items );
						}
					}
					
					return array( $all_items, $items, $pager_data );
				break;
			case 'pagetemplate':
					$all_items = otw_pcl_get_wp_items( $type );
					$items = array();
					foreach( $all_items as $item_key => $item_object ){
					
						if( $string_filter ){
							if( ( stripos( $item_object->name, $string_filter ) === false ) ){
								continue;
							}
						}
						if( count( $id_list_filter ) && !in_array( $item_object->script, $id_list_filter ) && !in_array( 'all', $id_list_filter ) ){
							continue;
						}
						if( count( $id_not_in_list ) && ( in_array( $item_object->script, $id_not_in_list ) || in_array( 'all', $id_not_in_list ) ) ){
							continue;
						}
						$items[] = $item_object;
					}
					$all_items = count( $items );
					$pager_data = otw_pcl_get_pager_data( $all_items, $displayed_items, $current_page );
					
					$sort_args = array();
					switch( $order )
					{
						case 'a_z':
								$sort_args['name'] = 'ASC';
							break;
						case 'z_a':
								$sort_args['name'] = 'DESC';
							break;
						default:
								$sort_args['name'] = 'ASC';
							break;
					}
					
					if( count( $items ) ){
						
						$items = otw_asort( $items, $sort_args );
						if( $displayed_items ){
							$items = array_slice( $items, $pager_data['first'], $displayed_items );
						}
					}
					
					return array( $all_items, $items, $pager_data );
				break;
			case 'userroles':
					$items = array();
					$wp_roles = new WP_Roles;
					$all_items = $wp_roles->get_names();
					$all_items['notlogged'] = esc_html__( 'Not Logged in', 'otw_pcl' );
					
					foreach( $all_items as $u_role_code => $u_role_name ){
						
						if( $string_filter ){
							
							if( ( stripos( $u_role_name, $string_filter ) === false ) ){
								continue;
							}
						}
						
						
						$item = new stdClass();
						$item->ID = $u_role_code;
						if( $u_role_code != 'notlogged' ){
							$item->name = esc_html__( 'Logged in as ', 'otw_pcl' ).$u_role_name;
						}else{
							$item->name = $u_role_name;
						}
						
						if( count( $id_list_filter ) && !in_array( $item->ID, $id_list_filter ) && !in_array( 'all', $id_list_filter ) ){
							continue;
						}
						if( count( $id_not_in_list ) && ( in_array( $item->ID, $id_not_in_list ) || in_array( 'all', $id_not_in_list ) ) ){
							continue;
						}
						
						$items[] = $item;
						
					}
					$all_items = count( $items );
					$pager_data = otw_pcl_get_pager_data( $all_items, $displayed_items, $current_page );
					
					switch( $order )
					{
						case 'a_z':
								$sort_args['name'] = 'ASC';
							break;
						case 'z_a':
								$sort_args['name'] = 'DESC';
							break;
						default:
								$sort_args['name'] = 'ASC';
							break;
					}
					
					if( count( $items ) ){
						
						$items = otw_pcl_asort( $items, $sort_args );
						if( $displayed_items ){
							$items = array_slice( $items, $pager_data['first'], $displayed_items );
						}
					}
					
					return array( $all_items, $items, $pager_data );
				break;
			case 'wpmllanguages':
					if( otw_pcl_installed_plugin( 'wpml' ) ){
						
						$wpml_languages = icl_get_languages( 'skip_missing=0' );
						
						$all_items = count( $wpml_languages );
						
						$items = array();
						foreach( $wpml_languages as $wpml_lang ){
							
							if( $string_filter ){
								
								if( ( stripos( $wpml_lang['translated_name'], $string_filter ) === false ) && ( stripos( $wpml_lang['translated_name'], $string_filter ) === false ) ){
									continue;
								}
							}
							
							$item = new stdClass();
							$item->ID = $wpml_lang['language_code'];
							$item->name = '<img src="'.esc_attr( $wpml_lang['country_flag_url'] ).'" alt="'.esc_attr( $wpml_lang['language_code'] ).'" border="0"/>&nbsp;'.$wpml_lang['native_name'];
							
							if( count( $id_list_filter ) && !in_array( $item->ID, $id_list_filter ) && !in_array( 'all', $id_list_filter ) ){
								continue;
							}
							if( count( $id_not_in_list ) && ( in_array( $item->ID, $id_not_in_list ) || in_array( 'all', $id_not_in_list ) ) ){
								continue;
							}
							
							$items[] = $item;
						}
						
						$all_items = count( $items );
						$pager_data = otw_pcl_get_pager_data( $all_items, $displayed_items, $current_page );
						
						switch( $order )
						{
							case 'a_z':
									$sort_args['name'] = 'ASC';
								break;
							case 'z_a':
									$sort_args['name'] = 'DESC';
								break;
							default:
									$sort_args['name'] = 'ASC';
								break;
						}
						
						if( count( $items ) ){
							
							$items = otw_pcl_asort( $items, $sort_args );
							if( $displayed_items ){
								$items = array_slice( $items, $pager_data['first'], $displayed_items );
							}
						}
						return array( $all_items, $items, $pager_data );
					}
				break;
			case 'bbp_page':
					if( otw_pcl_installed_plugin( 'bbpress' ) ){
						
						$bbp_pages = array();
						
						$bbp_pages[] = array( 'id' => 'forums', 'name' => esc_html__( 'Forums', 'otw_pcl' ) );
						$bbp_pages[] = array( 'id' => 'noreplies', 'name' => esc_html__( 'Topics no reply', 'otw_pcl' ) );
						$bbp_pages[] = array( 'id' => 'mostpopular', 'name' => esc_html__( 'Topics popular', 'otw_pcl' ) );
						$bbp_pages[] = array( 'id' => 'search', 'name' => esc_html__( 'Search', 'otw_pcl' ) );
						$bbp_pages[] = array( 'id' => 'singleuser', 'name' => esc_html__( 'User pages', 'otw_pcl' ) );
						
						$all_items = count( $bbp_pages );
						
						$items = array();
						foreach( $bbp_pages as $bbp_page ){
							
							if( $string_filter ){
								
								if( stripos( $bbp_page['name'], $string_filter ) === false ){
									continue;
								}
							}
							
							$item = new stdClass();
							$item->ID = $bbp_page['id'];
							$item->name = $bbp_page['name'];
							
							if( count( $id_list_filter ) && !in_array( $item->ID, $id_list_filter ) && !in_array( 'all', $id_list_filter ) ){
								continue;
							}
							if( count( $id_not_in_list ) && ( in_array( $item->ID, $id_not_in_list ) || in_array( 'all', $id_not_in_list ) ) ){
								continue;
							}
							
							$items[] = $item;
						}
						
						$all_items = count( $items );
						$pager_data = otw_pcl_get_pager_data( $all_items, $displayed_items, $current_page );
						
						switch( $order )
						{
							case 'a_z':
									$sort_args['name'] = 'ASC';
								break;
							case 'z_a':
									$sort_args['name'] = 'DESC';
								break;
							default:
									$sort_args['name'] = 'ASC';
								break;
						}
						
						if( count( $items ) ){
							
							$items = otw_pcl_asort( $items, $sort_args );
							if( $displayed_items ){
								$items = array_slice( $items, $pager_data['first'], $displayed_items );
							}
						}
						
						return array( $all_items, $items, $pager_data );
					}
				break;
			case 'buddypress_page':
					if( otw_pcl_installed_plugin( 'buddypress' ) ){
						global $bp;
						$buddypress_pages = array();
						
						if( isset( $bp->pages->activity ) && $bp->pages->activity->id ){
							$buddypress_pages[] = array( 'id' => $bp->pages->activity->id, 'name' => $bp->pages->activity->title.' '.__( 'page', 'otw_pcl' ) );
						}
						if( isset( $bp->pages->members ) && $bp->pages->members->id ){
							$buddypress_pages[] = array( 'id' => $bp->pages->members->id, 'name' => $bp->pages->members->title.' '.__( 'pages', 'otw_pcl' ) );
						}
						
						$all_items = count( $buddypress_pages );
						
						$items = array();
						foreach( $buddypress_pages as $buddypress_page ){
							
							if( $string_filter ){
								
								if( stripos( $buddypress_page['name'], $string_filter ) === false ){
									continue;
								}
							}
							
							$item = new stdClass();
							$item->ID = $buddypress_page['id'];
							$item->name = $buddypress_page['name'];
							
							if( count( $id_list_filter ) && !in_array( $item->ID, $id_list_filter ) && !in_array( 'all', $id_list_filter ) ){
								continue;
							}
							if( count( $id_not_in_list ) && ( in_array( $item->ID, $id_not_in_list ) || in_array( 'all', $id_not_in_list ) ) ){
								continue;
							}
							
							$items[] = $item;
						}
						
						$all_items = count( $items );
						$pager_data = otw_pcl_get_pager_data( $all_items, $displayed_items, $current_page );
						
						switch( $order )
						{
							case 'a_z':
									$sort_args['name'] = 'ASC';
								break;
							case 'z_a':
									$sort_args['name'] = 'DESC';
								break;
							default:
									$sort_args['name'] = 'ASC';
								break;
						}
						
						if( count( $items ) ){
							
							$items = otw_pcl_asort( $items, $sort_args );
							if( $displayed_items ){
								$items = array_slice( $items, $pager_data['first'], $displayed_items );
							}
						}
						
						return array( $all_items, $items, $pager_data );
					}
					
				break;
			default:
					
					if( preg_match( "/^cpt_(.*)$/", $type, $matches ) ){
						
						$args = array();
						$args['post_type']      = $matches[1];
						$args['posts_per_page'] = -1;
						
						if( count( $id_list_filter ) ){
							$args['post__in']       = $id_list_filter;
						}
						
						if( $string_filter ){
							add_filter( 'posts_where', 'otw_pcl_post_by_title' );
						}
						
						if( count( $id_not_in_list ) ){
							$args['post__not_in'] = $id_not_in_list;
						}
						
						$the_query = new WP_Query( $args );
						
						$all_items = count( $the_query->posts );
						
						$pager_data = otw_pcl_get_pager_data( $all_items, $displayed_items, $current_page );
						
						$args['posts_per_page'] = ($displayed_items)?$displayed_items:-1;
						
						switch( $order )
						{
							case 'a_z':
									$args['orderby']        = 'title';
									$args['order']          = 'ASC';
								break;
							case 'z_a':
									$args['orderby']        = 'title';
									$args['order']          = 'DESC';
								break;
							case 'date_latest':
									$args['orderby']        = 'date';
									$args['order']          = 'DESC';
								break;
							case 'date_oldest':
									$args['orderby']        = 'date';
									$args['order']          = 'ASC';
								break;
							case 'modified_latest':
									$args['orderby']        = 'modified';
									$args['order']          = 'DESC';
								break;
							case 'modified_oldest':
									$args['orderby']        = 'modified';
									$args['order']          = 'ASC';
								break;
								
							default:
									$args['orderby']        = 'ID';
									$args['order']          = 'DESC';
								break;
						}
						
						$the_query = new WP_Query( $args );
						
						if( $string_filter ){
							remove_filter('posts_where', 'otw_pcl_post_by_title');
						}
						
						return array( $all_items, $the_query->posts, $pager_data );
					}elseif( preg_match( "/^ctx_(.*)$/", $type, $matches ) ){
						
						$args = array();
						$args['hide_empty']      = 0;
						$args['number']          = 0;
						
						if( count( $id_list_filter ) ){
							sort( $id_list_filter );
							$args['include']  = $id_list_filter;
						}
						
						if( $string_filter ){
							$args['search'] = $string_filter;
						}
						
						if( count( $id_not_in_list ) ){
							sort( $id_not_in_list );
							$args['exclude'] = $id_not_in_list;
						}
						
						$all_items = count( get_terms( $matches[1], $args ) );
						
						$pager_data = otw_pcl_get_pager_data( $all_items, $displayed_items, $current_page );
						
						$args['offset'] = $pager_data['first'];
						$args['number']          = ($displayed_items)?$displayed_items:0;
						
						switch( $order )
						{
							case 'a_z':
									$args['orderby']        = 'name';
									$args['order']          = 'ASC';
								break;
							case 'z_a':
									$args['orderby']        = 'name';
									$args['order']          = 'DESC';
								break;
							case 'date_latest':
									$args['orderby']        = 'ID';
									$args['order']          = 'DESC';
								break;
							case 'date_oldest':
									$args['orderby']        = 'ID';
									$args['order']          = 'ASC';
								break;
							default:
									$args['orderby']        = 'ID';
									$args['order']          = 'DESC';
								break;
						}
						
						return array( $all_items, get_terms( $matches[1], $args ), $pager_data );
					}elseif( preg_match( "/(.*)_in_ctx_(.*)$/", $type, $matches ) ){
						
						$args = array();
						$args['hide_empty']      = 0;
						$args['number']          = 0;
						
						if( count( $id_list_filter ) ){
							sort( $id_list_filter );
							$args['include']  = $id_list_filter;
						}
						
						if( $string_filter ){
							$args['search'] = $string_filter;
						}
						
						if( count( $id_not_in_list ) ){
							sort( $id_not_in_list );
							$args['exclude'] = $id_not_in_list;
						}
						
						$all_items = count( get_terms( $matches[2], $args ) );
						
						$pager_data = otw_pcl_get_pager_data( $all_items, $displayed_items, $current_page );
						
						$args['offset'] = $pager_data['first'];
						$args['number']          = ($displayed_items)?$displayed_items:0;
						
						switch( $order )
						{
							case 'a_z':
									$args['orderby']        = 'name';
									$args['order']          = 'ASC';
								break;
							case 'z_a':
									$args['orderby']        = 'name';
									$args['order']          = 'DESC';
								break;
							case 'date_latest':
									$args['orderby']        = 'ID';
									$args['order']          = 'DESC';
								break;
							case 'date_oldest':
									$args['orderby']        = 'ID';
									$args['order']          = 'ASC';
								break;
							default:
									$args['orderby']        = 'ID';
									$args['order']          = 'DESC';
								break;
						}
						return array( $all_items, get_terms( $matches[2], $args ), $pager_data );
					}
				break;
		}
		
		return array();
	}
}

/** get wp items based on type
  * @param string
  * @return array
  */
if( !function_exists( 'otw_pcl_get_wp_items' ) ){
	function otw_pcl_get_wp_items( $item_type ){
		switch( $item_type ){
			case 'page':
					$pages = get_pages();
					$pages = otw_group_items( $pages, 'ID', 'post_parent', 0 );
					return $pages;
				break;
			case 'post':
					return get_posts( array( 'numberposts' => -1 )  );
				break;
			case 'postsincategory':
					$categories = get_categories(array('hide_empty' => 0));
					$categories = otw_group_items( $categories, 'cat_ID', 'parent', 0 );
					return $categories;
				break;
			case 'postsintag':
					return get_terms( 'post_tag', '&orderby=name&hide_empty=0' );
				break;
			case 'category':
					$categories = get_categories(array('hide_empty' => 0));
					$categories = otw_group_items( $categories, 'cat_ID', 'parent', 0 );
					
					return $categories;
				break;
			case 'posttag':
					return get_terms( 'post_tag', '&orderby=name&hide_empty=0' );
				break;
			case 'pagetemplate':
					$templates = array();
					$all_templates = get_page_templates();
					
					if( is_array( $all_templates ) && count( $all_templates ) )
					{
						foreach( $all_templates as $page_template_name => $page_template_script )
						{
							$tplObject = new stdClass();
							$tplObject->name = $page_template_name;
							$tplObject->script = $page_template_script;
							$templates[] = $tplObject;
						}
					}
					return $templates;
				break;
			case 'archive':
					$archive_types = array();
					$a_types = array( 'daily' => esc_html__('Daily', 'otw_pcl'), 'monthly' => esc_html__('Monthly', 'otw_pcl'), 'yearly' => esc_html__('Yearly', 'otw_pcl') );

					foreach( $a_types as $a_type => $a_name )
					{
						$aObject = new stdClass();
						$aObject->ID = $a_type;
						$aObject->name = $a_name;
						$archive_types[] = $aObject;
					}
					return $archive_types;
				break;
			case 'customposttype':
					return get_post_types( array(  'public'   => true, '_builtin' => false ), 'object' );
				break;
			case 'templatehierarchy':
					$h_types = array();
					$a_types = array(
							'home'        =>    esc_html__('Home', 'otw_pcl'),
							'front'       =>    esc_html__('Front Page', 'otw_pcl'),
							'404'         =>    esc_html__('Error 404 Page', 'otw_pcl'),
							'search'      =>    esc_html__('Search', 'otw_pcl'),
							'date'        =>    esc_html__('Date', 'otw_pcl'),
							'author'      =>    esc_html__('Author', 'otw_pcl'),
							'category'    =>    esc_html__('Category', 'otw_pcl'),
							'tag'         =>    esc_html__('Tag', 'otw_pcl'),
							'taxonomy'    =>    esc_html__('Taxonomy', 'otw_pcl'),
							'archive'     =>    esc_html__('Archive', 'otw_pcl'),
							'single'      =>    esc_html__('Singular', 'otw_pcl'),
							'attachment'  =>    esc_html__('Attachment', 'otw_pcl'),
							'page'        =>    esc_html__('Page', 'otw_pcl')
						);

					foreach( $a_types as $a_type => $a_name )
					{
						$aObject = new stdClass();
						$aObject->ID = $a_type;
						$aObject->name = $a_name;
						$h_types[] = $aObject;
					}
					return $h_types;
				break;
			default:
					if( preg_match( "/^cpt_(.*)$/", $item_type, $matches ) ){
						return get_posts( array( 'post_type' =>  $matches[1], 'numberposts' => -1 )  );
					}elseif( preg_match( "/^ctx_(.*)$/", $item_type, $matches ) ){
						return get_terms( $matches[1], '&orderby=name&hide_empty=0' );
					}
				break;
		}
	}
}

/**
 * Build pager data
 *
 * @param integer total items
 * @param integer total items returned for with limit
 * @param integer limit
 * @param integer current page
 * @return array
 */
if( !function_exists( 'otw_pcl_get_pager_data' ) ){
	function otw_pcl_get_pager_data( $total_items, $items_limit, $current_page  ){
		$pager_data = array();
		
		$pager_data['current'] = $current_page;
		$pager_data['links'] = array();
		$pager_data['links']['next'] = false;
		$pager_data['links']['prev'] = false;
		$pager_data['links']['first']= false;
		$pager_data['links']['last'] = false;
		$pager_data['links']['page'] = array();
		$pager_data['first'] = 0;
		
		if( $items_limit ){
			
			if( ( $total_items %  $items_limit ) == 0 ){
				$pager_data['pages'] = $total_items / $items_limit;
			}else{
				$pager_data['pages'] = $total_items / $items_limit;
				$pager_data['pages'] = (int)$pager_data['pages'] + 1;
			}
			
			if( $pager_data['current'] >= $pager_data['pages'] ){
				$pager_data['current'] = 0;
			}
			
			$pager_data['first'] = $pager_data['current'] * $items_limit;
			$pager_data['last']  = $pager_data['first'] + $items_limit - 1;
			
			if( $pager_data['pages'] > 1 ){
				
				if( $pager_data['current'] < ( $pager_data['pages'] - 1 ) ){
					$pager_data['links']['next'] = $pager_data['current'] + 1;
					$pager_data['links']['last'] = ( $pager_data['pages'] - 1 );
				}
			}
			if( $pager_data['current'] > 0 ){
				$pager_data['links']['first'] = 0;
				$pager_data['links']['prev'] = $pager_data['current'] - 1;
			}
			
			$l_size = 3;
			if( $pager_data['pages'] > 1 ){
				$pager_data['links']['page'][] = $pager_data['current'];
				//build page numbe links
				for( $cP = 1; $cP <= $l_size; $cP++ ){
					
					if( ( $pager_data['current'] - $cP ) >= 0 ){
						$pager_data['links']['page'][] = $pager_data['current'] - $cP;
					}elseif( ( $pager_data['current'] + $l_size + $cP ) < $pager_data['pages'] ){
						$pager_data['links']['page'][] = $pager_data['current'] + $l_size + $cP;
					}
					
					if( ( $pager_data['current'] + $cP ) < $pager_data['pages'] ){
						$pager_data['links']['page'][] = $pager_data['current'] + $cP;
					}elseif( ( $pager_data['current'] - $l_size - $cP ) >= 0 ){
						$pager_data['links']['page'][] = $pager_data['current'] - $l_size - $cP;
					}
				}
				sort( $pager_data['links']['page'] );
			}
		}
		return $pager_data;
	}
}

/**
 * Array sort
 */
if( !function_exists( 'otw_pcl_asort' ) ){
	function otw_pcl_asort( $array, $settings ){
		
		global $otw_pcl_asort_fields;
		
		$otw_pcl_asort_fields = $settings;
		uasort( $array, 'otw_pcl_asort_compare' );
		
		return $array;
	}
}
if( !function_exists( 'otw_pcl_asort_compare' ) ){
	function otw_pcl_asort_compare( $item_1, $item_2 ){
		
		global $otw_pcl_asort_fields;
		
		foreach( $otw_pcl_asort_fields as $field => $order ){
		
			switch( strtolower( gettype( $item_1 ) ) ){
				
				case 'object':
						if( isset( $item_1->$field ) && isset( $item_2->$field ) ){
							
							$s_result = strnatcmp( $item_1->$field, $item_2->$field );
							
							if( $s_result > 0 ){
								return ( $order == "ASC" ) ? 1 : -1;
							}elseif( $s_result < 0 ){
								return ( $order == "ASC" ) ? -1 : 1;
							}
							
						}elseif( isset( $item_1->$field ) && !isset( $item_2->$field ) ){
							
							return ( $order == "ASC" ) ? 1 : -1;
							
						}elseif( !isset( $item_1->$field ) && isset( $item_2->$field ) ){
							
							return ( $order == "ASC" ) ? -1 : 1;
							
						}
					break;
			}
		}
		return 0;
	}
}
if (!function_exists( "otw_overlay_item_attributes" )){
	function otw_overlay_item_attributes( $tag, $item_type, $item_id, $overlay_data, $item_data ){
		
		$attributes = '';
		
		switch( $tag ){
			case 'p':
					$attributes_array = array();
					if( otw_post('otw_action',false) ){
						if( otw_post( array( 'otw_sbi_'.$item_type, $item_id ), false ) || isset( otw_post( 'otw_sbi_'.$item_type, '' )[ 'all' ] ) ){
							$attributes_array['class'][] = 'sitem_selected';
						}else{
							$attributes_array['class'][] = 'sitem_notselected';
						}
					}else{
						if( isset( $overlay_data['validfor'][ $item_type ]['all'] ) ){
							$attributes_array['class'][] = 'sitem_selected';
						}elseif( isset( $overlay_data['validfor'][ $item_type ][ $item_id ] ) ){
							$attributes_array['class'][] = 'sitem_selected';
						}else{
							$attributes_array['class'][] = 'sitem_notselected';
						}
					}
					if( isset( $attributes_array['class'] ) ){
						$attributes .= ' class="'.implode( ' ', $attributes_array['class'] ).'"';
					}
				break;
			case 'c':
					if( otw_post('otw_action',false) ){
						if( otw_post( array( 'otw_sbi_'.$item_type, $item_id ), false )  || isset( otw_post( 'otw_sbi_'.$item_type, '' )[ 'all' ] ) ){
							$attributes .= ' checked="checked"';
						}
					}else{
						if( isset( $overlay_data['validfor'][ $item_type ]['all'] ) ){
							$attributes .= ' checked="checked"';
						}elseif( isset( $overlay_data['validfor'][ $item_type ][ $item_id ] ) ){
							$attributes .= ' checked="checked"';
						}
					}
				break;
			case 'ap':
					if( otw_post('otw_action',false) ){
						if( otw_post( array( 'otw_sbi_'.$item_type, $item_id ), false ) ){
							$attributes .= ' class="all sitem_selected"';
						}else{
							$attributes .= ' class="all sitem_notselected"';
						}
					}else{
						if( isset( $overlay_data['validfor'][ $item_type ][ $item_id ] ) ){
							$attributes .= ' class="all sitem_selected"';
						}else{
							$attributes .= ' class="all sitem_notselected"';
						}
					}
				break;
			case 'ac':
					if( otw_post('otw_action',false) ){
						if( otw_post( array( 'otw_sbi_'.$item_type, $item_id ), false ) ){
							$attributes .= ' checked="checked"';
						}
					}else{
						if( isset( $overlay_data['validfor'][ $item_type ][ $item_id ] ) ){
							$attributes .= ' checked="checked"';
						}
					}
				break;
			case 'l':
					if( isset( $item_data->_sub_level ) && $item_data->_sub_level ){
						$attributes .= ' style="margin-left: '.( $item_data->_sub_level * 20 ).'px"';
					}
				break;
		}
		echo $attributes;
	}
}

/** get the attribute of wp item
  *  @param string
  *  @param stdClass
  *  @return string
  */
if( !function_exists( 'otw_pcl_wp_item_attribute' ) ){
	function otw_pcl_wp_item_attribute( $item_type, $attribute, $object ){
		
		switch( $attribute ){
			
			case 'ID':
					switch( $item_type ){
						case 'postsincategory':
								return $object->cat_ID;
							break;
						case 'category':
								return $object->cat_ID;
							break;
						case 'postsintag':
								return $object->term_id;
							break;
						case 'posttag':
								return $object->term_id;
							break;
						case 'pagetemplate':
								return $object->script;
							break;
						case 'customposttype':
								return $object->name;
							break;
						case 'author_archive':
								return $object->ID;
							break;
						default:
								if( preg_match( "/^ctx_(.*)$/", $item_type, $matches ) ){
									return $object->term_id;
								}elseif( preg_match( "/^(.*)_in_ctx_(.*)$/", $item_type, $matches ) ){
									return $object->term_id;
								}
								return $object->ID;
							break;
					}
				break;
			case 'TITLE':
					switch( $item_type ){
						case 'page':
						case 'post':
								return $object->post_title;
							break;
						case 'author_archive':
								return $object->display_name;
							break;
						case 'customposttype':
								return $object->label;
							break;
						default:
								if( preg_match( "/^cpt_(.*)$/", $item_type, $matches ) ){
									return $object->post_title;
								}
								return $object->name;
							break;
					}
				break;
		}
	}
}

/**
 * Check if external plugin is installed
 *
 * @param string - plugin name
 * @return boolean
 */
if( !function_exists( 'otw_pcl_installed_plugin' ) ){
	function otw_pcl_installed_plugin( $plugin_name ){
		
		$installed = false;
		switch( $plugin_name ){
			case 'bbpress':
					if(function_exists( 'bbp_get_db_version_raw') && bbp_get_db_version_raw() ){
						$installed = true;
					}
				break;
			case 'wpml':
					if( function_exists( 'icl_get_languages' ) ){
						$installed = true;
					}
				break;
			case 'buddypress':
					if( class_exists( 'BuddyPress' ) ){
						
						global $bp;
						
						if( strtolower( get_class( $bp ) ) == 'buddypress' )
						{
							$installed = true;
						}
					}
				break;
		}
		
		return $installed;
	}
}

if (!function_exists( "otw_pcl_post_by_title" )){
	function otw_pcl_post_by_title( $query ){
		
		global $string_filter, $id_list_filter;
		
		$query .= " AND post_title LIKE '%".$string_filter."%'";
		return $query;
	}
}

if( !function_exists( 'otw_pcl_admin_settings' ) ){
	function otw_pcl_admin_settings(){
		
		$otw_admin_settings = get_option( 'otw_admin_settings' );
		
		if( !is_array( $otw_admin_settings ) ){
			$otw_admin_settings = array();
		}
		
		if( otw_post( 'type', '' ) ){
		
			switch( otw_post( 'type', '' ) ){
				
				case 'page':
						if( otw_post( 'page', false ) ){
						
							switch( otw_post( 'page', '' ) ){
							
								case 'otw-pcl-manage':
										if( otw_post( 'setting', false ) && strlen( trim( otw_post( 'setting', '' ) ) ) && otw_post( 'value', false ) && strlen( trim( otw_post( 'value', '' ) ) ) ){
											
											if( !isset( $otw_admin_settings['page'] ) ){
												$otw_admin_settings['page'] = array();
											}
											
											if( !isset( $otw_admin_settings['page'][ otw_post( 'page', '' ) ] ) ){
												$otw_admin_settings['page'][ otw_post( 'page', '' ) ] = array();
											}
											$otw_admin_settings['page'][ otw_post( 'page', '' ) ][ otw_post( 'setting', '' ) ] = otw_post( 'value', '' );
											
											update_option( 'otw_admin_settings', $otw_admin_settings );
										}
									break;
							}
						
						}
					break;
			}
		}
		die;
	}
}
/**
 * factory messages
 */
if( !function_exists( 'otw_pcl_factory_message' ) ){
	function otw_pcl_factory_message( $params ){
		
		global $otw_pcl_plugin_id;
		
		if( isset( $params['plugin'] ) && $otw_pcl_plugin_id == $params['plugin'] ){
			
			//filter out some messages if need it
		}
		if( isset( $params['message'] ) )
		{
			return $params['message'];
		}
		return $params;
	}
}