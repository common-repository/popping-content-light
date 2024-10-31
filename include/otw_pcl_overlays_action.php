<?php
/** Overlay actions
  *  - delete overlay
  *  - activate
  *  - deactivate
  */
	$otw_overlay_values = array(
		'title'       =>  '',
		'status'      =>  'inactive'
	);
	
	$otw_overlay_id = '';
	$otw_action = '';
	
	if( otw_get('action',false) ){
		
		switch( otw_get('action','') ){
			
			case 'delete':
					$otw_action = 'otw_pcl_overlay_delete';
					$page_title = esc_html__( 'Delete Overlay', 'otw_pcl' );
					$confirm_text = esc_html__( 'Please confirm to delete the overlay', 'otw_pcl' );
				break;
			case 'activate':
					$otw_action = 'otw_pcl_overlay_activate';
					$page_title = esc_html__( 'Activate Overlay', 'otw_pcl' );
					$confirm_text = esc_html__( 'Please confirm to activate the overlay', 'otw_pcl' );
				break;
			case 'deactivate':
					$otw_action = 'otw_pcl_overlay_deactivate';
					$page_title = esc_html__( 'Deactivate Overlay', 'otw_pcl' );
					$confirm_text = esc_html__( 'Please confirm to deactivate the overlay', 'otw_pcl' );
				break;
		}
	}
	if( !$otw_action ){
		wp_die( esc_html__( 'Invalid overlay action', 'otw_pcl' ) );
	}
	if( otw_get('overlay',false) ){
		
		$otw_overlay_id = otw_get( 'overlay', '' );
		$otw_overlays = otw_get_overlays();
		
		if( is_array( $otw_overlays ) && isset( $otw_overlays[ $otw_overlay_id ] ) ){
			
			$otw_overlay_values['title'] = $otw_overlays[ $otw_overlay_id ]['title'];
			$otw_overlay_values['status'] = $otw_overlays[ $otw_overlay_id ]['status'];
			$otw_overlay_values['validfor'] = $otw_overlays[ $otw_overlay_id ]['validfor'];
		}
	}
	if( !$otw_overlay_id ){
		wp_die( esc_html__( 'Invalid overlay', 'otw_pcl' ) );
	}
	
?>
<div class="wrap">
	<div id="icon-edit" class="icon32"><br/></div>
	<h2>
		<?php echo $page_title; ?>
		<a class="preview button" href="admin.php?page=otw-pcl"><?php esc_html_e( 'Back To List Of overlays', 'otw_pcl' );?></a>
	</h2>
	<?php include_once( 'otw_pcl_help.php' );?>
	<div id="ajax-response"></div>
	<div class="form-wrap" id="poststuff">
		<form method="post" action="" class="validate">
			<input type="hidden" name="otw_action" value="<?php echo esc_attr( $otw_action )?>" />
			<?php wp_original_referer_field(true, 'previous'); wp_nonce_field('otw-pcl-overlays-action'); ?>

			<div id="post-body">
				<div id="post-body-content">
					<div id="col-right">
						<div class="form-field form-required">
							<?php esc_html_e( 'overlay title', 'otw_pcl' );?>:
							<strong><?php echo esc_html( $otw_overlay_values['title'] )?></strong>
						</div>
						<div class="form-field">
							<?php esc_html_e( 'Status', 'otw_pcl' );?>:
							<strong><?php esc_html_e( ucfirst( $otw_overlay_values['status']  ), 'otw_pcl' )?></strong>
						</div>
					</div>
					<div id="col-left">
						<p>
							<?php echo $confirm_text;?>
						</p>
						<p class="submit">
							<input type="submit" class="button button-primary button-large" value="<?php esc_html_e( 'Confirm', 'otw_pcl') ?>" name="submit" />
							<input type="submit" value="<?php esc_html_e( 'Cancel', 'otw_pcl' ) ?>" name="cancel" class="button"/>
						</p>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>