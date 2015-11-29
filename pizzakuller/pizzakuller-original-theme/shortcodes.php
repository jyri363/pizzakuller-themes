<?php
    function blockquote_shortcode( $atts, $content = null ) {
       $return = '
			<blockquote>
				<strong> ' . $atts['title'] . '</strong>
				<span class="open-quote"></span>
				 ' . $content . '
				<span class="close-quote"></span>
			</blockquote>
       ';
       return $return;
    }
    function separator_shortcode( $atts, $content = null ) {
       return '<hr>';
    }
    function col50_shortcode( $atts, $content = null ) {
       return '
			<div class="col-50">
			 ' . $content . '
			</div>
	   ';
    }
    function clear_shortcode( $atts, $content = null ) {
       return '<div class="clear"></div>';
    }

    add_shortcode('col50', 'col50_shortcode');
    add_shortcode('blockquote', 'blockquote_shortcode');
    add_shortcode('separator', 'separator_shortcode');
    add_shortcode('clear', 'clear_shortcode');
?>
