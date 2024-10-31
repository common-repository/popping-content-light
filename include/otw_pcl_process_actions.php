<?php
/**
 * Process otw actions
 *
 */
if( otw_post('otw_action',false) ){

	switch( otw_post('otw_action','') ){
		
		case 'otw_pcl_overlay_activate':
				if( otw_post( 'cancel', false ) ){
					wp_redirect( 'admin.php?page=otw-pcl' );
				}else{
					$otw_overlays = otw_get_overlays();
					
					if( otw_get('overlay',false) && isset( $otw_overlays[ otw_get('overlay','') ] ) ){
						$otw_overlay_id = otw_get( 'overlay', '' );
						
						$otw_overlays[ $otw_overlay_id ]['status'] = 'active';
						
						otw_save_overlays( $otw_overlays );
						
						wp_redirect( 'admin.php?page=otw-pcl&message=3' );
					}else{
						wp_die( esc_html__( 'Invalid overlay', 'otw_pcl' ) );
					}
				}
			break;
		case 'otw_pcl_overlay_deactivate':
				if( otw_post( 'cancel', false ) ){
					wp_redirect( 'admin.php?page=otw-pcl' );
				}else{
					$otw_overlays = otw_get_overlays();
					
					if( otw_get('overlay',false) && isset( $otw_overlays[ otw_get('overlay','') ] ) ){
						$otw_overlay_id = otw_get( 'overlay', '' );
						
						$otw_overlays[ $otw_overlay_id ]['status'] = 'inactive';
						
						otw_save_overlays( $otw_overlays );
						
						wp_redirect( 'admin.php?page=otw-pcl&message=4' );
					}else{
						wp_die( esc_html__( 'Invalid overlay', 'otw_pcl' ) );
					}
				}
			break;
		case 'otw_pcl_overlay_delete':
				if( otw_post( 'cancel', false ) ){
					wp_redirect( 'admin.php?page=otw-pcl' );
				}else{
					
					$otw_overlays = otw_get_overlays();
					
					if( otw_get('overlay',false) && isset( $otw_overlays[ otw_get('overlay','') ] ) ){
						$otw_overlay_id = otw_get( 'overlay', '' );
						
						$new_overlays = array();
						
						//remove the overlay from otw_overlays
						foreach( $otw_overlays as $overlay_key => $overlay ){
						
							if( $overlay_key != $otw_overlay_id ){
							
								$new_overlays[ $overlay_key ] = $overlay;
							}
						}
						otw_save_overlays( $new_overlays );
						
						wp_redirect( admin_url( 'admin.php?page=otw-pcl&message=2' ) );
					}else{
						wp_die( esc_html__( 'Invalid overlay', 'otw_pcl' ) );
					}
				}
			break;
		case 'manage_otw_pcl_overlay':
				
				global $validate_messages, $wpdb, $otw_pcl_overlay_object;
				
				$validate_messages = array();
				
				$valid_page = true;
				if( !otw_post( 'title', false ) || !strlen( trim( otw_post( 'title', '' ) ) ) ){
					$valid_page = false;
					$validate_messages[] = esc_html__( 'Please type valid overlay title', 'otw_pcl' );
				}
				if( !otw_post( 'status', false ) || !strlen( trim( otw_post( 'status', '' ) ) ) ){
					$valid_page = false;
					$validate_messages[] = esc_html__( 'Please select status', 'otw_pcl' );
				}
				if( !otw_post( 'type', false ) || !strlen( trim( otw_post( 'type', '' ) ) ) ){
					$valid_page = false;
					$validate_messages[] = esc_html__( 'Please select overlay type', 'otw_pcl' );
				}
				if( $valid_page ){
					$otw_overlays = otw_get_overlays();
					
					if( otw_get('overlay',false) && isset( $otw_overlays[ otw_get('overlay','') ] ) ){
						$otw_overlay_id = otw_get( 'overlay', '' );
						$overlay = $otw_overlays[ otw_get('overlay','') ];
					}else{
						$overlay = array();
						$otw_overlay_id = false;
					}
					
					$overlay['title'] = (string) otw_post( 'title', '' );
					$overlay['type'] = (string) otw_post( 'type', '' );
					$overlay['status'] = (string) otw_post( 'status', '' );
					$overlay['grid_content'] = otw_post( array( '_otw_grid_manager_content', 'code' ), '' );
					$overlay['options'] = array();
					
					//save options
					foreach( $otw_pcl_overlay_object->overlay_types as $overlay_type => $overlay_type_data ){
						
						foreach( $overlay_type_data['options'] as $o_type => $type_options ){
							
							if( in_array( $o_type, array( 'main', 'custom' ) ) ){
								
								foreach( $type_options['items'] as $option_name => $option_item ){
									
									if( otw_post( $overlay_type.'_'.$option_name, false ) ){
										
										$overlay['options'][ $overlay_type.'_'.$option_name ] = otw_post( $overlay_type.'_'.$option_name, '' );
										
									}elseif( isset( $overlay['options'][ $overlay_type.'_'.$option_name ] ) ){
										
										unset( $overlay['options'][ $overlay_type.'_'.$option_name ] );
									}
									
									if( isset( $option_item['subfields'] ) && is_array( $option_item['subfields'] ) && count( $option_item['subfields'] ) ){
									
										foreach( $option_item['subfields'] as $subfield => $subfield_data ){
										
											if( otw_post( $overlay_type.'_'.$option_name.'_'.$subfield, false ) ){
												
												$overlay['options'][ $overlay_type.'_'.$option_name.'_'.$subfield ] = otw_post( $overlay_type.'_'.$option_name.'_'.$subfield, '' );
												
											}elseif( isset( $overlay['options'][ $overlay_type.'_'.$option_name.'_'.$subfield  ] ) ){
												
												unset( $overlay['options'][ $overlay_type.'_'.$option_name.'_'.$subfield  ] );
											}
										}
									
									}
								}
								
							}else{
								foreach( $type_options['items'] as $option_name => $option_item ){
									
									$overlay['options'][ $overlay_type.'_'.$option_name ] = $option_item['default'];
								}
							}
						}
					}
					
					if( $otw_overlay_id === false ){
						
						$otw_overlay_id = 'otw-overlay-'.( otw_get_next_overlay_id() );
						$overlay['id'] = $otw_overlay_id;
					}
					
					$otw_overlays[ $otw_overlay_id ] = $overlay;
					
					if( !otw_save_overlays( $otw_overlays ) && $wpdb->last_error ){
						
						$valid_page = false;
						$validate_messages[] = esc_html__( 'DB Error: ', 'otw_pcl' ).$wpdb->last_error.'. Tring to save '.strlen( maybe_serialize( $otw_overlays ) ).' bytes.';
					}else{
						wp_redirect( 'admin.php?page=otw-pcl&message=1' );
					}
				}
			break;
		case 'otw_pcl_manage_options':
				if( otw_post( 'otw_psw_promotions', false ) && !empty( otw_post( 'otw_psw_promotions', '' ) ) ){
					
					global $otw_pcl_factory_object, $otw_pcl_plugin_id;
					
					update_option( $otw_pcl_plugin_id.'_dnms', otw_post( 'otw_psw_promotions', '' ) );
					
					if( is_object( $otw_pcl_factory_object ) ){
						$otw_pcl_factory_object->retrive_plungins_data( true );
					}
				}
				wp_redirect( admin_url( 'admin.php?page=otw-pcl-options&message=1' ) );
			break;
	}
}
