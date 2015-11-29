		</div><!--Closing Wrapper Div-->	
		 
		 <?php global  $social_links, $cooker_options; ?>
		 
		<footer>
			<div class="footer-holder">
			<div class="newsletter">
			<?php if ( is_active_sidebar( 'footeriuudiskiri' ) ) {
								dynamic_sidebar('footeriuudiskiri'); 
						}?>
						
						</div>
						<?php if ( is_active_sidebar( 'footer-list-ckrw' ) ) {
								dynamic_sidebar('footer-list-ckrw'); 
						}?>
						<div class="credits">
							<div class="copyright-text">
								<?php if(isset($cooker_options['footer_copyright_text'])){
										echo $cooker_options['footer_copyright_text'];
									}else{
									?>
									Copyright &copy; 2014 CP Group OÜ.
									<?php } ?>
									</div>
							<div class="billion"><a href="http://www.billion.ee"><img src="<?php bloginfo( 'template_url' ); ?>/images/billionad.png" alt="billion" /></a></div>
						</div>
			</div>
    </footer>
    <?php wp_footer(); ?>
    
</body>
</html>