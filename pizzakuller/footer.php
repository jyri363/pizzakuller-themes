	</div><!--Closing Wrapper Div-->

	<?php global  $social_links, $cooker_options; ?>

	<footer class="footer-main">
		<div class="footer-holder">
			<div class="links social-links first">
				<h6>follow us on...</h6>
				<ul>
					<?php 
						if(!empty($social_links)) :
							foreach ($social_links as $name => $link):?>
								<li class="<?php echo $name; ?>"><a href="<?php echo $link; ?>"><?php echo $name; ?></a></li>
					<?php 
							endforeach;
						endif;
					?>
					<li class="rss"><a href="<?php bloginfo_rss('rss_url') ?>">Rss feed</a></li>
				</ul>
			</div>
			<?php if ( is_active_sidebar( 'footer-list-ckrw' ) ) {
					dynamic_sidebar('footer-list-ckrw'); 
			}1?>
		</div>
		<div class="credits-holder">
			<div class="credits">
				<a href="<?php echo home_url(); ?> " class="logo">
					<img src="<?php echo $cooker_options['logo_image']?>" alt="your logo" />
				</a>
				<div class="copyright-text">
					<?php if(isset($cooker_options['footer_copyright_text'])){
						echo $cooker_options['footer_copyright_text'];
						}
						else{
					?>
						Copyright &copy; 2015 Cooker. All rights reserved
					<?php } ?>
				</div>
				<div class="webdesign-text">
					<?php if(isset($cooker_options['footer_author'])){
						echo $cooker_options['footer_author'];
						}
						else{
					?>
						Web design: Design Mania
					<?php } ?>
<?php /*
	<a href="#clear-cart" class="hs-rsp-popup hiddendiv">PopUp</a>
	<div id="clear-cart" style="display:none">
        <div id="popupwarn" class="popup-warning">
            <div class="content">
                <h1><?php _e('If you choose new place, then your basket will be reseted!'); ?></h1>
                <h5><?php _e('You can order only one place at time.'); ?></h5>
                <a href="javascript: void(0);" class="action_continue"><img src="http://www.pizzakuller.ee/wp-content/themes/pizzakuller/images/arrow_right.png<?php /* echo get_template_directory_uri() . '/images/arrow_right.png'; *//*?>" width="20" /><div><?php _e('Reset basket'); ?></div></a>
                <a href="javascript: void(0);" class="action_close"><img src="http://www.pizzakuller.ee/wp-content/themes/pizzakuller/images/arrow_left.png<?php /* echo get_template_directory_uri() . '/images/arrow_left.png'; *//*?>" width="20" /><div><?php _e('Back to Menu'); ?></div></a>
            </div>
        </div>
	</div>
*/?>
				</div>
			</div>
		</div>
	</footer>
	<?php wp_footer(); ?>
</body>
</html>