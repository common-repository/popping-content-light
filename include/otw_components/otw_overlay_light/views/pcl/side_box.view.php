<!-- Popup Wrapper -->
<div class="<?php echo trim( $overlay_vars['wrapper_class'] )?>"<?php echo $overlay_vars['data_param']?>>
	<!-- Popup and Pullouts Stickies-->
	<div class="otw-sticky otw-side-box <?php echo $overlay_vars['class'];?>" id="<?php echo esc_attr( $overlay_vars['id'] );?>" <?php echo $overlay_vars['style'];?>>
		<!-- Trigger labels for hiding and showing the menu -->
		<div class="otw-hide-label<?php echo $overlay_vars['show_hide_button_class'];?>"<?php echo $overlay_vars['show_hide_button_style'];?>>&times;</div>
		<div class="otw-show-label<?php echo $overlay_vars['show_hide_button_class'];?>"<?php echo $overlay_vars['show_hide_button_style'];?>><?php echo otw_esc_text( $overlay_vars['show_label'], 'cont' ); ?></div>
		<!-- Stickies content -->
		<section class="<?php echo otw_esc_text( $overlay_vars['section_class'], 'cont' );?>" <?php echo $overlay_vars['section_style'];?>>
			<div class="otw-sticky-content-inner"<?php echo $overlay_vars['content_inner_style'];?>>
				<?php echo $overlay_vars['content']; ?>
			</div>
			<?php if( strlen( $overlay_vars['affiliate_username'] ) ){?>
				<div class="otw-overlay-affiliate">
					<?php echo $this->get_label( 'Powered by' )?> <a href="http://codecanyon.net/item/popping-content-for-wordpress/8688220?ref=<?php echo $overlay_vars['affiliate_username'] ?>" target="_blank"><?php echo $this->get_label( 'Popping Content.')?></a>
				</div>
			<?php }?>
		</section>
		
		<!-- / Stickies content -->
	</div>
		<!-- / Popup and Pullouts -->
</div> <!-- / Popup Wrapper -->

