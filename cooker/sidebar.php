<?php //===============  Print Right Sidebar  ================ ?>
<div class="right-content main">
	<a class="open-sidebar" href="#"><span><?php _e('Sidebar'); ?></span></a>
	<div class="sidebar-inner">
		<?php if ( is_active_sidebar( 'right-sidebar-cart-ckrw' ) ) {
				 dynamic_sidebar('right-sidebar-cart-ckrw');
		} ?>
		
		<?php if ( is_active_sidebar( 'right-sidebar-widgets-ckrw' ) ) {
				 dynamic_sidebar('right-sidebar-widgets-ckrw');
		} ?>
	</div>
</div>