<?php
/**
 * Initialize the options before anything else.
 */
add_action( 'admin_init', 'custom_theme_options', 1 );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
	/**
	 * Get a copy of the saved settings array. 
	 */
	$saved_settings = get_option( 'option_tree_settings', array() );

	/**
	 * Custom settings array that will eventually be 
	 * passes to the OptionTree Settings API Class.
	 */
	$custom_settings = array( 
		'contextual_help' => array( 
			'sidebar'       => ''
		),
		'sections'        => array( 
			array(
				'id'          => 'logo',
				'title'       => 'Logo'
			),
			array(
				'id'          => 'social_links',
				'title'       => 'Social Links'
			),
			array(
				'id'          => 'general',
				'title'       => 'General'
			)
		),
		'settings'        => array( 
			array(
				'id'          => 'logo_image',
				'label'       => 'Logo Image',
				'desc'        => '',
				'std'         => '',
				'type'        => 'upload',
				'section'     => 'logo',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'id'          => 'logo_offset_top',
				'label'       => 'Logo Offset (top)',
				'desc'        => '',
				'std'         => '',
				'type'        => 'text',
				'section'     => 'logo',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'id'          => 'logo_offset_left',
				'label'       => 'Logo Offset (left)',
				'desc'        => '',
				'std'         => '',
				'type'        => 'text',
				'section'     => 'logo',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'id'          => 'facebook',
				'label'       => 'Facebook',
				'desc'        => '',
				'std'         => '',
				'type'        => 'text',
				'section'     => 'social_links',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'id'          => 'twitter',
				'label'       => 'Twitter',
				'desc'        => '',
				'std'         => '',
				'type'        => 'text',
				'section'     => 'social_links',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'id'          => 'gplus',
				'label'       => 'Google Plus',
				'desc'        => '',
				'std'         => '',
				'type'        => 'text',
				'section'     => 'social_links',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'id'          => 'dribbble',
				'label'       => 'Dribbble',
				'desc'        => '',
				'std'         => '',
				'type'        => 'text',
				'section'     => 'social_links',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'id'          => 'myspace',
				'label'       => 'MySpace',
				'desc'        => '',
				'std'         => '',
				'type'        => 'text',
				'section'     => 'social_links',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'id'          => 'linkedin',
				'label'       => 'LinkedIn',
				'desc'        => '',
				'std'         => '',
				'type'        => 'text',
				'section'     => 'social_links',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'id'          => 'flickr',
				'label'       => 'Flickr',
				'desc'        => '',
				'std'         => '',
				'type'        => 'text',
				'section'     => 'social_links',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'id'          => 'reddit',
				'label'       => 'Reddit',
				'desc'        => '',
				'std'         => '',
				'type'        => 'text',
				'section'     => 'social_links',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'id'          => 'youtube',
				'label'       => 'You Tube',
				'desc'        => '',
				'std'         => '',
				'type'        => 'text',
				'section'     => 'social_links',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'id'          => 'vimeo',
				'label'       => 'Vimeo',
				'desc'        => '',
				'std'         => '',
				'type'        => 'text',
				'section'     => 'social_links',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'id'          => 'digg',
				'label'       => 'Digg',
				'desc'        => '',
				'std'         => '',
				'type'        => 'text',
				'section'     => 'social_links',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'id'          => 'evernote',
				'label'       => 'Evernote',
				'desc'        => '',
				'std'         => '',
				'type'        => 'text',
				'section'     => 'social_links',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'id'          => 'pinterest',
				'label'       => 'Pinterest',
				'desc'        => '',
				'std'         => '',
				'type'        => 'text',
				'section'     => 'social_links',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'id'          => 'footer_copyright_text',
				'label'       => 'Footer Copyright Text',
				'desc'        => '',
				'std'         => '',
				'type'        => 'text',
				'section'     => 'general',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'id'          => 'footer_author',
				'label'       => 'Footer Theme Author',
				'desc'        => '',
				'std'         => '',
				'type'        => 'text',
				'section'     => 'general',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			)
		)
	);
	
	/* allow settings to be filtered before saving */
	$custom_settings = apply_filters( 'option_tree_settings_args', $custom_settings );

	/* settings are not the same update the DB */
	if ( $saved_settings !== $custom_settings ) {
		update_option( 'option_tree_settings', $custom_settings ); 
	}

}