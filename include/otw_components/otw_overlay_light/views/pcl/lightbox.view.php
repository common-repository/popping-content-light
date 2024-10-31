<!-- Overlay -->
<div id="<?php echo esc_attr( $overlay_vars['id'] );?>" class="<?php echo otw_esc_text( $overlay_vars['class'], 'cont' );?>"<?php echo $overlay_vars['data_param']?><?php echo otw_esc_text( $overlay_vars['data-style'], 'cont' )?><?php echo otw_esc_text( $overlay_vars['data-effect'], 'cont' )?><?php echo otw_esc_text( $overlay_vars['data-close-effect'], 'cont' )?><?php echo otw_esc_text( $overlay_vars['style'], 'cont' )?><?php echo otw_esc_text( $overlay_vars['data_index'], 'cont' )?>>
	<div class="otw-popup-content-inner"<?php echo $overlay_vars['content_inner_style']?>>
		<?php echo $overlay_vars['content']; ?>
		<?php if( strlen( $overlay_vars['affiliate_username'] ) ){?>
			<div class="otw-overlay-affiliate">
				<?php echo $this->get_label( 'Powered by' )?> <a href="http://codecanyon.net/item/popping-content-for-wordpress/8688220?ref=<?php echo $overlay_vars['affiliate_username'] ?>" target="_blank"><?php echo $this->get_label( 'Popping Content.')?></a>
			</div>
		<?php }?>
 	</div>
</div>