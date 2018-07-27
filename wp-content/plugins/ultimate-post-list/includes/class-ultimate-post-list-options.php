<?php

class Ultimate_Post_List_Options {

	public static $options_set;
	public static $options_rendered;
	
	/**
	* Define the options
	*
	* @since	1.0.0
	*/
	public static function set_options () {

		/*
		 * Set multiple used translations once
		 */
		$translated = array();
		
		// add simple translations
		foreach ( array(
			'align_center' => 'Center',
			'align_justify' => 'Justify',
			'align_left' => 'Align left',
			'align_right' => 'Align right',
			'all' => 'All',
			'asc' => 'Ascending',
			'author' => 'Author',
			'avatars' => 'Avatars',
			'comma' => ', ',
			'datetime' => 'Date and time',
			'desc' => 'Descending',
			'last_modified' => 'Last Modified',
			'more_label' => '(more&hellip;)',
			'no' => 'No',
			'no_posts' => 'No posts found.',
			'none' => 'None',
			'postname' => 'Post name',
			'pw_protected' => 'Password protected',
			'random' => 'Random',
			'read_more' => 'Read more...',
			'select' => '&mdash; Select &mdash;',
			'settings' => 'Settings',
			'slug' => 'Slug',
			'yes' => 'Yes',
			) as $key => $str ) {
			$translated[ $key ] = __( $str );
		}

		// add context translations
		$contextuals = array(
			// post types (generic and custom)
			'Posts' => 'post type general name',
			'Pages' => 'post type general name',
			'Post' => 'post type singular name',
			'Page' => 'post type singular name',
			// statuses
			'Private'	=> 'post status',
			'Published'	=> 'post status',
			'Scheduled'	=> 'post status',
			'Pending'	=> 'post status',
			'Draft'		=> 'post status',
			'Trash'		=> 'post status',
			// post types
			'Media'		=> 'post type general name',
		);
		foreach( $contextuals as $label => $context ) {
			$translated[ $label ] = _x( $label, $context );
		}
		
		// add complex strings
		$translated[ 'in_desc' ]			= sprintf( __( 'Use the CTRL key to select multiple entries.', 'ultimate-post-list' ), implode( $translated[ 'comma' ], wp_allowed_protocols() ) );
		$translated[ 'post_title' ]			= __( 'Post title', 'ultimate-post-list' );
		$translated[ 'url_desc' ]			= sprintf( __( 'An URL starting with %s is accepted, else http:// is prepended automatically.', 'ultimate-post-list' ), implode( $translated[ 'comma' ], wp_allowed_protocols() ) );
		$text_1 = 'Date Format';
		$text_2 = 'General Settings';
		$translated[ 'date-format-desc']	= sprintf( 
			__( 'Select the desired representation of the post date, as shown in the list exemplarily with the 1st of February in 2003. If not specified the date format as set at &#8220;%s&#8221; on the page &#8220;%s&#8221; is taken.', 'ultimate-post-list' ), 
			__( $text_1 ),
			__( $text_2 )
		);
		/*
		 * Set default values
		 */
		$default = array();

		// set thumbnail alignment selection box, default is based on current reading direction
		if ( is_rtl() ) {
			$defaults[ 'alignment_thumbnail' ]	= 'align_right';
			$defaults[ 'width_margin_left' ]	= 8;
			$defaults[ 'width_margin_right' ]	= 0;
		} else {
			$defaults[ 'alignment_thumbnail' ]	= 'align_left';
			$defaults[ 'width_margin_left' ]	= 0;
			$defaults[ 'width_margin_right' ]	= 8;
		}
		$defaults[ 'width_margin_top' ]			= 0;
		$defaults[ 'width_margin_bottom' ]		= 8;
		
		// set position selection boxes
		// only $positions needs to be changed to get the rest dynamically
		$positions = array(
			'position_post_thumbnail'			=> __( 'Position of post thumbnail', 'ultimate-post-list' ),
			'position_post_title'				=> __( 'Position of post title', 'ultimate-post-list' ),
			'position_post_date'				=> __( 'Position of post date', 'ultimate-post-list' ),
			'position_post_author'				=> __( 'Position of post author name', 'ultimate-post-list' ),
		);

		$c = count( $positions );
		$defaults[ 'order_range' ] = array();
		foreach ( range( 1, $c ) as $i ) {
			$defaults[ 'order_range' ][ $i ] = $i;
		}		

		$position_options = array();
		$i = 1;
		foreach ( $positions as $key => $label ) {
			$position_options[ $key ] = array(
				'type' => 'selection',
				'label' => $label,
				'values' => $defaults[ 'order_range' ],
				'default' => array( $i ),
			);
			$i++;
		}

		// set date format selection
		/*
			l: Full name of a day (lower-case 'L')
			D: Abbreviated name of a day
			d: Number of a day of the month with leading zero
			j: Number of a day of the month without leading zero
			F: Full name of a month
			M: Abbreviated name of a month
			m: Number of a month with leading zero
			n: Number of a month without leading zero
			Y: Number of a year in 4 digits
			y: Number of a year in 2 digits
		*/
		$defaults[ 'date_formats' ] = array(
			'null' => $translated[ 'select' ],
		);
		$dateformats = array(
			'Day'	=> array( 'l d F Y', 'l j F Y', 'l, d F Y', 'l, d F, Y', 'l, d. F Y', 'l, d. F, Y', 'l, j F Y', 'l, j F, Y', 'l, j. F Y', 'l, j. F, Y', 'D, M d, Y', 'D, M j, Y', 'D, d F Y', 'D, d-F-Y', 'D, d. F Y', 'D, j F Y', 'D, j F Y', 'D, j M Y', 'D, j-F-Y', 'D, j. F Y', 'd F Y', 'd F y', 'd F, Y', 'd F, y', 'd M Y', 'd M y', 'd M. Y', 'd M. y', 'd-M-Y', 'd-M-y', 'd-m-Y', 'd-m-y', 'd-n-Y', 'd-n-y', 'd. F Y', 'd. M Y', 'd.m.Y', 'd.m.y', 'd.n.Y', 'd.n.y', 'd/F/Y', 'd/M/Y', 'd/M/y', 'd/m/Y', 'd/m/y', 'j F Y', 'j F y', 'j F, Y', 'j F, y', 'j M Y', 'j M y', 'j M. Y', 'j M. y', 'j-M-Y', 'j-M-y', 'j-n-y', 'j. F Y', 'j. M Y', 'j.n.y', 'j/F/Y', 'j/M/Y', 'j/M/y', 'j/n/Y', 'j/n/y', ),
			'Month'	=> array( 'F d, Y', 'F d, y', 'F j, Y', 'F j, y', 'F-d-Y', 'F-d-y', 'F-j-Y', 'F-j-y', 'M d, Y', 'M d, y', 'M j, Y', 'M j, y', 'M j, y', 'm-d-Y', 'm-d-y', 'm/d/Y', 'm/d/y', 'm/j/Y', 'm/j/y', 'n/d/Y', 'n/d/y', 'n/j/Y', 'n/j/y', ),
			'Year'	=> array( 'Y, F d, l', 'Y, F j, l', 'Y-m-d', 'Y-n-d', 'Y-n-j', 'Y.m.d', 'Y.m.d.', 'Y.m.j', 'Y/M/d', 'Y/m/d', 'Y/n/j', 'y m d', 'y-m-d', 'y-n-d', 'y-n-j', 'y.n.j', 'y/M/d', 'y/m/d', 'y/n/j', ) 
		);
		$testdate = strtotime( '1 Feb 2003' );
		foreach ( $dateformats as $base => $formats ) {
			foreach ( $formats as $format ) {
				$defaults[ 'date_formats' ][ $base ][ $format ] = date_i18n( $format, $testdate );
			}
		}

		// end of defaults definitions
		
		/* define the form sections, order by appereance, with headlines, and options
		 */
		self::$options_set = array(
			'list_options' => array(
				'title' => __( 'List Options', 'ultimate-post-list'),
				'list_display_options' => array(
					'headline' => __( 'List Display Options', 'ultimate-post-list' ),
					'options' => array(
						'visibility_if_empty' => array(
							'type'		=> 'radiobuttons',
							'label'		=> __( 'List Visibility', 'ultimate-post-list' ),
							'values'	=> array( 
								'show' => __( 'Show title and text if no post is found', 'ultimate-post-list'),
								'hide' => __( 'Hide list if no post is found', 'ultimate-post-list'),
							),
							'default'	=> 'show',
						),
						'text_if_empty' => array(
							'type'		=> 'textfield',
							'label'		=> __( 'Text if no posts', 'ultimate-post-list' ),
							'default'	=> $translated[ 'no_posts' ],
							'desc'		=> __( 'This field can be empty', 'ultimate-post-list' ),
						),
					),
				), // end list_display_options
				'list_title_options' => array(
					'headline' => __( 'List Title Options', 'ultimate-post-list' ),
					'options' => array(
						'list_title' => array(
							'type'	=> 'textfield',
							'label'	=> __( 'Title of the list in post content', 'ultimate-post-list' ),
							'desc'	=> __( 'If the list is displayed via shortcode in the content of a post or page you can set the list title by entering the headline. To remove the list title just leave this field empty. You can convert the text to a link and set the headline level with the next two options. If the list is displayed as a widget you can set the list title in the widget form.', 'ultimate-post-list' ),
						),
						'url_list_title' => array(
							'type'	=> 'url',
							'label'	=> __( 'URL of list title', 'ultimate-post-list' ),
							'desc'	=> __( 'If you want to link the list title to a web page enter the URL here. To remove the link just leave this field empty.', 'ultimate-post-list' ) . ' ' . $translated[ 'url_desc' ],
						),
						'list_title_element' => array(
							'type'		=> 'selection',
							'label'		=> __( 'HTML element of list title', 'ultimate-post-list' ),
							'values'	=> array(
								'h1'	=> 'H1',
								'h2'	=> 'H2',
								'h3'	=> 'H3',
								'h4'	=> 'H4',
								'h5'	=> 'H5',
								'h6'	=> 'H6',
							),
							'default'	=> array( 'h3' ),
							'desc'		=> __( 'Headline level in lists printed by shortcode, ignored in widgets.', 'ultimate-post-list' ),
						),
					),
				), // list_title_options
				'posts_list_options_general' => array(
					'headline' => __( 'Post List Options In General', 'ultimate-post-list' ),
					'options' => array(
						'number_posts'					=> array( 'type' => 'absint',		'label' => __( 'Number of posts', 'ultimate-post-list' ),	'default' => get_option( 'posts_per_page', 7 ),	'required' => 1, 'desc' => sprintf( __( 'Number of posts to show in the list. If the value is not an integer or 0 the default of %d is used.', 'ultimate-post-list' ), get_option( 'posts_per_page', 7 ) ), ),
						'offset_posts'					=> array( 'type' => 'absint',		'label' => __( 'Posts offset', 'ultimate-post-list' ),	'default' => 0,	'required' => 1, 'desc' => __( 'Number of post to displace or pass over. If the value is not an integer the default of 0 is used.', 'ultimate-post-list' ), ),
						'hide_current_viewed_post'		=> array( 'type' => 'checkbox',		'label' => __( 'Hide current viewed post in list', 'ultimate-post-list' ), ),
						'show_sticky_posts_on_top'		=> array( 'type' => 'checkbox',		'label' => __( 'Show sticky posts on top of the list', 'ultimate-post-list' ), ),
					),
				), // end posts_list_options_general
				'posts_sort_order' => array(
					'headline' => __( 'Posts Sort Order', 'ultimate-post-list' ),
					'options' => array(
						'posts_order_by' => array(
							'type'		=> 'selection',
							'label'		=> __( 'Order by', 'ultimate-post-list' ),
							'values'	=> array(
								'post_date'		=> $translated[ 'datetime' ],
								'post_title'	=> $translated[ 'post_title' ],
							),
							'default' => array( 'post_date' ),
						),
						'posts_order_direction' => array(
							'type'		=> 'selection',
							'label'		=> __( 'Order direction', 'ultimate-post-list' ),
							'values'	=> array(
								'ASC'	=> $translated[ 'asc' ],
								'DESC'	=> $translated[ 'desc' ]
							),
							'default' => array( 'DESC' ),
						),
					),
				), // end posts_sort_order
			), // end posts_list_options
			'posts_list_item_options' => array(
				'title' => __( 'Post List Item Options', 'ultimate-post-list'),
				'post_data_order' => array(
					'headline' => __( 'Post Data Order', 'ultimate-post-list' ),
					'description' => __( 'Select a number to set the position of each post information. The higher the number the lower the position. If a number is used multiple times the result is not predictable. So use each number only once. Post informations which are set not to be shown will be ingored.', 'ultimate-post-list' ),
					'options' => $position_options,
				), // end post_data_order
				'post_display_options' => array(
					'headline' => __( 'Post Display Options', 'ultimate-post-list' ),
					'options' => array(
						'show_post_thumbnail'			=> array( 'type' => 'checkbox', 'label' => __( 'Show post thumbnail', 'ultimate-post-list' ), 'default' => 1, ),
						'show_post_title'				=> array( 'type' => 'checkbox', 'label' => __( 'Show post title', 'ultimate-post-list' ), 'default' => 1, ),
						'show_post_date'				=> array( 'type' => 'checkbox', 'label' => __( 'Show post date', 'ultimate-post-list' ), ),
						'show_post_author'				=> array( 'type' => 'checkbox', 'label' => __( 'Show post author name', 'ultimate-post-list' ), ),
					),
				), // end post_options_in_general
				'post_link_options' => array(
					'headline' => __( 'Post Links Options', 'ultimate-post-list' ),
					'description' => __( 'Each link will point to the post unless otherwise specified.', 'ultimate-post-list' ),
					'options' => array(
						'set_post_title_clickable'			=> array( 'type' => 'checkbox', 'label' => __( 'Set post title clickable', 'ultimate-post-list' ), 'default' => 1, ),
						'set_post_thumbnail_clickable'		=> array( 'type' => 'checkbox', 'label' => __( 'Set post thumbnail clickable', 'ultimate-post-list' ), 'default' => 1, ),
						'set_post_date_clickable'			=> array( 'type' => 'checkbox', 'label' => __( 'Set post date clickable, pointing to the month archive', 'ultimate-post-list' ), ),
						'set_post_author_clickable'			=> array( 'type' => 'checkbox', 'label' => __( 'Set post author clickable, pointing to the author&#8217;s archive', 'ultimate-post-list' ), ),
						'open_post_links_in_new_window'		=> array( 'type' => 'checkbox',	'label' => __( 'Open post links in new windows', 'ultimate-post-list' ), ),
					),
				), // end post_link_options
				'post_title_options' => array(
					'headline' => __( 'Post Title Options', 'ultimate-post-list' ),
					'options' => array(
						'max_length_post_title'			=> array( 'type' => 'absint',		'label' => __( 'Maximum length of post title', 'ultimate-post-list' ), 'default' => 1000,	'required' => 1,	'desc' => __( 'Maximal number of letters', 'ultimate-post-list' ), ),
						'text_after_shortened_title'	=> array( 'type' => 'textfield',	'label' => __( 'Text after shortened title', 'ultimate-post-list' ), 'default' => '&hellip;' ),
					),
				), // end post_title_options
				'post_date_options' => array(
					'headline' => __( 'Post Date Options', 'ultimate-post-list' ),
					'description' => $translated[ 'date-format-desc' ],
					'options' => array(
						'format_date'	=> array(
							'type'		=> 'selection',
							'label'		=> __( 'Format of the post date', 'ultimate-post-list' ),
							'values'	=> $defaults[ 'date_formats' ],
							'default'	=> array( get_option( 'date_format', 'Y-m-d' ) ),
						),
					),
				), // end post_date_options
				'post_thumbnail_options' => array(
					'headline' => __( 'Post Thumbnail Options', 'ultimate-post-list' ),
					'options' => array(
						'source_thumbnail' => array(
							'type'		=> 'radiobuttons',
							'label'		=> __( 'Source of the post thumbnail', 'ultimate-post-list' ),
							'values'	=> array( 
								'featured_only'		=> __( 'Featured image', 'ultimate-post-list'),
								'first_only'		=> __( 'First post content image', 'ultimate-post-list'),
								'first_or_featured'	=> __( 'Featured image if the first post content image is not available', 'ultimate-post-list'),
								'featured_or_first'	=> __( 'First post content image if the featured image is not available', 'ultimate-post-list'),
								'use_author_avatar'	=> $translated[ 'avatars' ],
							),
							'default'	=> 'featured_only',
						),
						'show_default_thumbnail'	=> array( 'type' => 'checkbox', 'label' => __( 'Use default thumbnail if no image could be ascertained', 'ultimate-post-list' ), 'default' => absint( round( get_option( 'thumbnail_size_w', 110 ) / 2 ) ) ),
						'url_thumbnail'	=> array(
							'type'		=> 'url',
							'label'		=> __( 'URL of default thumbnail', 'ultimate-post-list' ),
							'default'	=> plugins_url( 'public/images/default_thumb.gif', dirname( __FILE__ ) ),
							'desc'		=> $translated[ 'url_desc' ],
						),
						'size_thumbnail'	=> array(
							'type'		=> 'selection',
							'label'		=> __( 'Thumbnail size', 'ultimate-post-list' ), 
							'values'	=> self::get_image_sizes(),
							'default'	=> array( 'custom' ),
						),
						'width_thumbnail'		=> array( 'type' => 'absint', 'label' => __( 'Width of thumbnail in px', 'ultimate-post-list' ), 'default' => absint( round( get_option( 'thumbnail_size_w', 110 ) / 2 ) ) ),
						'height_thumbnail'		=> array( 'type' => 'absint', 'label' => __( 'Height of thumbnail in px', 'ultimate-post-list' ), 'default' => absint( round( get_option( 'thumbnail_size_h', 110 ) / 2 ) ) ),
						'keep_aspect_ratio'		=> array( 'type' => 'checkbox', 'label' => __( 'Use aspect ratios of original images', 'ultimate-post-list' ), 'default' => absint( round( get_option( 'thumbnail_size_w', 110 ) / 2 ) ) ),
						'alignment_thumbnail'	=> array(
							'type'		=> 'selection',
							'label'		=> __( 'Thumbnail alignment', 'ultimate-post-list' ),
							'values'	=> array(
								'align_left'	=> $translated[ 'align_left' ],
								'align_center'	=> $translated[ 'align_center' ],
								'align_right'	=> $translated[ 'align_right' ],
							),
							'default'	=> array( $defaults[ 'alignment_thumbnail' ] ),
							'desc'		=> sprintf( __( 'If %s the values for the right and left margins will be ignored.', 'ultimate-post-list' ), $translated[ 'align_center' ] ),
						),
						'width_margin_top'		=> array( 'type' => 'absint', 'label' => __( 'Top image margin in px', 'ultimate-post-list' ),		'default' => $defaults[ 'width_margin_top' ],	'required' => 1, ),
						'width_margin_bottom'	=> array( 'type' => 'absint', 'label' => __( 'Bottom image margin in px', 'ultimate-post-list' ),	'default' => $defaults[ 'width_margin_bottom' ],	'required' => 1, ),
						'width_margin_left'		=> array( 'type' => 'absint', 'label' => __( 'Left image margin in px', 'ultimate-post-list' ),		'default' => $defaults[ 'width_margin_left' ],	'required' => 1, ),
						'width_margin_right'	=> array( 'type' => 'absint', 'label' => __( 'Right image margin in px', 'ultimate-post-list' ),	'default' => $defaults[ 'width_margin_right' ],	'required' => 1, ),
						'width_radius_thumbnail'	=> array( 'type' => 'absint', 'label' => __( 'Radius of rounded image corners in px', 'ultimate-post-list' ), ),
					),
				), // end post_thumbnail_options
			), // end posts_list_item_options
			'posts_list_more_element_options' => array(
				'title' => __( '&#8220;More&#8221; Element Options', 'ultimate-post-list' ),
				'posts_list_more_element_appearance' => array(
					'headline' => __( '&#8220;More&#8221; Element Appearance', 'ultimate-post-list' ),
					'description' => __( 'Switch on and off an element to load further list items without leaving the page. The theme determines the appearance of the element. In this way, the element fits optically perfectly.', 'ultimate-post-list' ),
					'options' => array(
						'show_more_element'	=> array(
							'type' => 'checkbox',
							'label' => __( 'Show a clickable &#8220;More&#8221; element for loading further list items at the bottom of the list', 'ultimate-post-list' ),
						),
						'more_element_type' => array(
							'type'		=> 'radiobuttons',
							'label'		=> __( '&#8220;More&#8221; element type', 'ultimate-post-list' ),
							'values'	=> array( 
								'link'	=> __( 'Show element as a link', 'ultimate-post-list' ),
								'button'=> __( 'Show element as a button', 'ultimate-post-list' ),
							),
							'default'	=> 'button',
						),
						'more_element_label' => array(
							'type'		=> 'textfield',
							'label'		=> __( 'Label of &#8220;More&#8221; element', 'ultimate-post-list' ),
							'default'	=> $translated[ 'more_label' ],
						),
						'show_more_spinner'	=> array(
							'type' => 'checkbox',
							'label' => __( 'Show icon while new posts are loaded', 'ultimate-post-list' ),
							'default' => 1, 
						),
						'style_more_spinner' => array(
							'type'		=> 'selection',
							'label'		=> __( 'Icon style', 'ultimate-post-list' ),
							'values'	=> array(
								'null' => $translated[ 'select' ],
								__( 'Small icons', 'ultimate-post-list' )	=> array(
									'spinner'	=> __( 'Small gray circle with rotating dot', 'ultimate-post-list' ),
									'wpspin'	=> __( 'Small turning wheel', 'ultimate-post-list' ),
								),
								__( 'Big icons', 'ultimate-post-list' )	=> array(
									'spinner-2x'=> __( 'Big gray circle with rotating dot', 'ultimate-post-list' ),
									'wpspin-2x'	=> __( 'Big turning wheel', 'ultimate-post-list' ),
								),
							),
							'default'	=> 'wpspin',
						),
						'no_more_label' => array(
							'type'		=> 'textfield',
							'label'		=> __( 'Text that appears when no further posts have been found', 'ultimate-post-list' ),
							'default'	=> $translated[ 'no_posts' ],
						),
					),
				), // end posts_list_more_element_feedback_options
			), // end posts_list_more_element
			'list_layout_options' => array(
				'title' => __( 'List Layout Options', 'ultimate-post-list'),
				'layout_type_options' => array(
					'headline' => __( 'List Layout Type', 'ultimate-post-list' ),
					'options' => array(
						'type_list_layout'	=> array(
							'type' => 'selection',
							'label' => __( 'Type of list layout', 'ultimate-post-list' ),
							'values' => array(
								'vertical'		=> __( 'Vertical list', 'ultimate-post-list' ),
								//'horizontal'	=> __( 'Horizontal list', 'ultimate-post-list' ),
								'grid'			=> __( 'Responsive grid', 'ultimate-post-list' ),
							),
							'default' => array( 'vertical' ),
						),
					),
				), // end layout_type_options
				'grid_layout_options' => array(
					'headline' => __( 'Grid Layout Options', 'ultimate-post-list' ),
					'description' => __( 'These options only takes effect if a grid layout was selected in the previous option.', 'ultimate-post-list' ),
					'options' => array(
						'width_grid_item'		=> array( 'type' => 'absint', 'label' => __( 'Width of grid item content in px', 'ultimate-post-list' ),	'desc'	=> __( 'If the specified width is smaller than the thumbnail width the thumbnail width will be used.', 'ultimate-post-list' ), ),
						'height_min_grid_item'	=> array( 'type' => 'absint', 'label' => __( 'Minimal height of grid item in px', 'ultimate-post-list' ), ),
					),
				), // end grid_layout_options
				'list_item_layout_options' => array(
					'headline' => __( 'List Item Layout Options', 'ultimate-post-list' ),
					'description' => __( 'Layout options for each list item.', 'ultimate-post-list' ),
					'options' => array(
						'list_item_layout_type'	=> array(
							'type' => 'selection',
							'label' => __( 'List item layout type', 'ultimate-post-list' ),
							'values' => array(
								'text_around_thumbnail'		=> __( 'Text floats around the thumbnail', 'ultimate-post-list' ),
								'text_next_to_thumbnail'	=> __( 'Text is next to the thumbnail', 'ultimate-post-list' ),
							),
							'default' => array( 'text_around_thumbnail' ),
						),
					),
				), // end list_item_layout_options
				'list_item_margin_options' => array(
					'headline' => __( 'List Item Margin Options', 'ultimate-post-list' ),
					'description' => __( 'Set the space between each list item or grid element.', 'ultimate-post-list' ),
					'options' => array(
						'width_item_margin_top'		=> array( 'type' => 'absint', 'label' => __( 'Top item margin in px', 'ultimate-post-list' ),	 ),
						'width_item_margin_bottom'	=> array( 'type' => 'absint', 'label' => __( 'Bottom item margin in px', 'ultimate-post-list' ), 'default' => 24 ),
						'width_item_margin_left'	=> array( 'type' => 'absint', 'label' => __( 'Left item margin in px', 'ultimate-post-list' ),	 ),
						'width_item_margin_right'	=> array( 'type' => 'absint', 'label' => __( 'Right item margin in px', 'ultimate-post-list' ),	 ),
					),
				), // end list_item_margin_options
			), // end list_layout_options
		);
	}
		
	/**
	* Get the default settings
	*
	* @since	1.0.0
	*/
	public static function get_default_settings () {
		$defaults = array();
		foreach ( self::$options_set as $chapter => $sections ) {
			if ( ! is_array( $sections ) ) {
				continue;
			}
			foreach ( $sections as $section_key => $section_values ) {
				if ( ! is_array( $section_values ) or ! isset( $section_values[ 'options' ] ) ) {
					continue;
				}
				foreach ( $section_values[ 'options' ] as $option_name => $option_values ) {
					if ( isset( $option_values[ 'default' ] ) ) {
						$defaults[ $option_name ] = $option_values[ 'default' ];
					} else {
						switch ( $option_values[ 'type' ] ) {
							case 'checkboxes':
							case 'checkbox':
							case 'absint':
							case 'int':
								$defaults[ $option_name ] = 0;
								break;
							case 'float':
								$defaults[ $option_name ] = 0.0;
								break;
							case 'selection':
								$defaults[ $option_name ] = array();
								break;
							// else all other form elements
							default:
								$defaults[ $option_name ] = '';
						} // end switch()
					}
				}
			}
		}
		return $defaults;
	}
		
	/**
	* Get the settings
	*
	* @since	1.0.0
	*/
	public static function get_stored_settings ( $post_id ) {
		
		$settings = get_post_meta( $post_id, UPL_OPTION_NAME );

		if ( empty( $settings ) ) {
			
			return self::get_default_settings();
			
		} else {

			// sanitize settings
			$settings = self::sanitize_options( $settings[ 0 ] );

			// set default settings for non-existing values
			foreach ( self::get_default_settings() as $option_name => $default_value ) {
				if ( ! isset( $settings[ $option_name ] ) ) {
					$settings[ $option_name ] = $default_value;
				}
			}
			
			return $settings;
			
		}
	}
		
	/**
	* Get rendered HTML code of the options
	*
	* @since	1.0.0
	*/
	public static function set_rendered_options ( $post_id = null ) {
		
		self::$options_rendered = array();

		if ( ! ( $post_id and self::$options_set ) ) {
			return;
		}

		$text_no_items = 'No items';
		$label_no_items = __( $text_no_items );

		$settings = self::get_stored_settings( $post_id );
		
		// build form with sections and options
		foreach ( self::$options_set as $chapter => $sections ) {
			if ( ! is_array( $sections ) ) {
				continue;
			}
			self::$options_rendered[ $chapter ] = array();
			foreach ( $sections as $section_key => $section_values ) {
				if ( ! is_array( $section_values ) or ! isset( $section_values[ 'options' ] ) ) {
					continue;
				}
				self::$options_rendered[ $chapter ][ $section_key ] = array(
					'headline' => $section_values[ 'headline' ]
				);
				if ( isset( $section_values[ 'description' ] ) ) {
					self::$options_rendered[ $chapter ][ $section_key ][ 'description' ] = $section_values[ 'description' ];
				}
				// set labels and callback function names per option name
				foreach ( $section_values[ 'options' ] as $option_name => $option_values ) {
					// set default description
					$desc = '';
					if ( isset( $option_values[ 'desc' ] ) and '' != $option_values[ 'desc' ] ) {
						$desc = sprintf( ' <span class="description">%s</span>', esc_html( $option_values[ 'desc' ] ) );
					}
					// build the form elements values
					switch ( $option_values[ 'type' ] ) {
						case 'radiobuttons':
							$stored_value = isset( $settings[ $option_name ] ) ? $settings[ $option_name ] : $option_values[ 'default' ];
							$html = sprintf( '<fieldset><legend><span>%s</span></legend>', esc_html( $option_values[ 'label' ] ) );
							$leftover = count( $option_values[ 'values' ] );
							foreach ( $option_values[ 'values' ] as $value => $label ) {
								$html .= sprintf(
									'<label><input type="radio" name="%s[%s]" value="%s"%s /> <span>%s</span></label>',
									UPL_OPTION_NAME,
									esc_attr( $option_name ),
									esc_attr( $value ),
									checked( $stored_value, $value, false ),
									esc_html( $label )
								);
								$leftover--;
								if ( $leftover ) {
									$html .= '<br />';
								}
							}
							$html .= '</fieldset>';
							$html .= $desc;
							break;
						case 'checkboxes':
							$html = sprintf( '<fieldset><legend class="screen-reader-text"><span>%s</span></legend>', esc_html( $option_values[ 'label' ] ) );
							$leftover = count( $option_values[ 'values' ] );
							foreach ( $option_values[ 'values' ] as $key => $label ) {
								$esc_key = esc_attr( $key );
								$html .= sprintf(
									'<label for="%s"><input name="%s[%s]" type="checkbox" id="%s" value="1"%s /> %s</label>' ,
									$esc_key,
									UPL_OPTION_NAME,
									$esc_key,
									$esc_key,
									checked( $settings[ $key ], 1, false ),
									esc_html( $label )
								);
								$leftover--;
								if ( $leftover ) {
									$html .= '<br />';
								}
							}
							$html .= '</fieldset>';
							$html .= $desc;
							break;
						case 'checkbox':
							$esc_name = esc_attr( $option_name );
							$html = sprintf(
								'<p><label for="%s"><input name="%s[%s]" type="checkbox" id="%s" value="1"%s /> %s</label>%s</p>' ,
								$esc_name,
								UPL_OPTION_NAME,
								$esc_name,
								$esc_name,
								checked( $settings[ $option_name ], 1, false ),
								esc_html( $option_values[ 'label' ] ),
								$desc
							);
							break;
						case 'selection':
							$html = '<p>';
							if ( empty( $option_values[ 'values' ] ) ) {
								$html .= sprintf( '%s: %s', esc_html( $option_values[ 'label' ] ), esc_html( $label_no_items ) );
							} else {
								if ( isset( $settings[ $option_name ] ) ) {
									if ( is_array( $settings[ $option_name ] ) ) {
										$stored_values = $settings[ $option_name ];
									} else {
										$stored_values = array ( $settings[ $option_name ] );
									}
								} else {
									$stored_values = $option_values[ 'default' ];
								}
								$esc_name = esc_attr( $option_name );
								$html .= sprintf(
									'<label>%s <select id="%s" name="%s[%s][]"',
									esc_html( $option_values[ 'label' ] ),
									$esc_name,
									UPL_OPTION_NAME,
									$esc_name
								);
								if ( isset( $option_values[ 'attr' ] ) ) {
									foreach ( $option_values[ 'attr' ] as $attr ) {
										if ( is_array( $attr ) ) {
											foreach( $attr as $key => $value ) {
												$html .= sprintf( ' %s="%s"', $key, esc_attr( $value ) );
											}
										} else {
											$html .= ' ' . esc_attr( $attr );
										}
									}
								}
								$html .= '>';
								foreach ( $option_values[ 'values' ] as $value => $label ) {
									if ( is_array( $label ) ) {
										$html .= sprintf(
											'<optgroup label="%s">',
											esc_attr( $value )
										);
										foreach( $label as $sub_value => $sub_label ) {
											$html .= sprintf(
												'<option value="%s"%s>%s</option>',
												esc_attr( $sub_value ),
												selected( in_array( $sub_value, $stored_values ), true, false ),
												esc_html( $sub_label )
											);
										}
										$html .= '</optgroup>';
									} else {
										$html .= sprintf(
											'<option value="%s"%s>%s</option>',
											esc_attr( $value ),
											selected( in_array( $value, $stored_values ), true, false ),
											esc_html( $label )
										);
									}
								}
								$html .= '</select></label>';
								$html .= $desc;
							}
							$html .= '</p>';
							break;
						case 'url':
							$value = isset( $settings[ $option_name ] ) ? $settings[ $option_name ] : '';
							$esc_name = esc_attr( $option_name );
							$html = sprintf(
								'<p><label for="%s">%s <input type="text" id="%s" name="%s[%s]" value="%s"></label>',
								$esc_name,
								esc_html( $option_values[ 'label' ] ),
								$esc_name,
								UPL_OPTION_NAME,
								$esc_name,
								esc_url( $value )
							);
							$html .= $desc;
							$html .= '</p>';
							break;
						case 'textarea':
							$value = isset( $settings[ $option_name ] ) ? $settings[ $option_name ] : '';
							$esc_name = esc_attr( $option_name );
							$html = sprintf(
								'<p><label for="%s">%s<br /><textarea id="%s" name="%s[%s]">%s</textarea></label>',
								$esc_name,
								esc_html( $option_values[ 'label' ] ),
								$esc_name,
								UPL_OPTION_NAME,
								$esc_name,
								esc_textarea( $value )
							);
							$html .= $desc;
							$html .= '</p>';
							break;
						case 'colorpicker':
							$value = isset( $settings[ $option_name ] ) ? $settings[ $option_name ] : '#cccccc';
							$esc_name = esc_attr( $option_name );
							$html = sprintf(
								'<p><label for="%s">%s <input type="text" id="%s" class="wp-color-picker" name="%s[%s]" value="%s"></label>',
								$esc_name,
								esc_html( $option_values[ 'label' ] ),
								$esc_name,
								UPL_OPTION_NAME,
								$esc_name,
								esc_attr( $value )
							);
							$html .= $desc;
							$html .= '</p>';
							break;
						case 'password':
							$value = isset( $settings[ $option_name ] ) ? $settings[ $option_name ] : '';
							$esc_name = esc_attr( $option_name );
							$html = sprintf(
								'<p><label for="%s">%s <input type="password" id="%s" name="%s[%s]" value="%s"></label>',
								$esc_name,
								esc_html( $option_values[ 'label' ] ),
								$esc_name,
								UPL_OPTION_NAME,
								$esc_name,
								esc_attr( $value )
							);
							$html .= $desc;
							$html .= '</p>';
							break;
						// else text field or unknown fields
						default:
							$value = isset( $settings[ $option_name ] ) ? $settings[ $option_name ] : '';
							$esc_name = esc_attr( $option_name );
							$html = sprintf(
								'<p><label for="%s">%s <input type="text" id="%s" name="%s[%s]" value="%s"></label>',
								$esc_name,
								esc_html( $option_values[ 'label' ] ),
								$esc_name,
								UPL_OPTION_NAME,
								$esc_name,
								esc_attr( $value )
							);
							$html .= $desc;
							$html .= '</p>';
					} // end switch()
					
					self::$options_rendered[ $chapter ][ $section_key ][ 'options' ][] = $html;

				} // end foreach( section_values )
			} // end foreach( section )
		} // end foreach( chapter )
		
	}

	/**
	* Print the rendered HTML code of the options
	*
	* @since	1.0.0
	*/
	public static function print_rendered_options ( $selected_chapter = null ) {

		$sections = self::$options_rendered;

		// return whole tree or part of it if defined, else empty array
		if ( $selected_chapter ) {
			if ( isset( self::$options_rendered[ $selected_chapter ] ) ) {
				$sections = self::$options_rendered[ $selected_chapter ];
			} else {
				echo '<p>No options (1).</p>';
			}
		}

		if ( $sections ) {
			foreach( $sections as $section_values ) {
				if ( ! is_array( $section_values ) or ! isset( $section_values[ 'options' ] ) ) {
					continue;
				}
				printf( "<h3>%s</h3>\n", $section_values[ 'headline' ] );
				if ( isset( $section_values[ 'description' ] ) ) {
					printf( "<p>%s</p>\n", $section_values[ 'description' ] );
				}
				foreach( $section_values[ 'options' ] as $option ) {
					printf( "%s\n", $option );
				}
			}
		} else {
			echo '<p>No options (2).</p>';
		}
	}

	/**
	* Check and return correct values for the settings
	*
	* @since	1.0.0
	* @param	array	$input	Options and their values after submitting the form
	* @return	array			Options and their sanatized values
	*/
	public static function sanitize_options ( $input ) {
		
		if ( empty( $input ) or ! is_array( $input ) ) {
			return self::get_default_settings();
		}
		
		foreach ( self::$options_set as $chapter => $sections ) {
			if ( ! is_array( $sections ) ) {
				continue;
			}
			foreach ( $sections as $section_name => $section_values ) {
				if ( ! is_array( $section_values ) or ! isset( $section_values[ 'options' ] ) ) {
					continue;
				}
				foreach ( $section_values[ 'options' ] as $option_name => $option_values ) {
					switch ( $option_values[ 'type' ] ) {
						// if radio button is set assign selected value, else default value
						case 'radiobuttons':
							$input[ $option_name ] = isset( $input[ $option_name ] ) ? $input[ $option_name ] : $option_values[ 'default' ];
							break;
						// if checkbox is set assign '1', else '0'
						case 'checkbox':
						#case 'checkboxes':
							if ( ! isset( $input[ $option_name ] ) ) {
								$input[ $option_name ] = 0;
							} else {
								$input[ $option_name ] = ( 1 == $input[ $option_name ] ) ? 1 : 0 ;
							}
							break;
						// clean selection fields
						case 'selection':
							if ( ! isset( $input[ $option_name ] ) ) {
								$input[ $option_name ] = isset( $option_values[ 'default' ] ) ? $option_values[ 'default' ] : array();
							} else {
								if ( ! is_array( $input[ $option_name ] ) ) {
									$input[ $option_name ] = (array) $input[ $option_name ];
								}
								if ( 'format_date' == $option_name ) {
									if ( ! preg_match( '@^[DdFjlMmnYy ,./-]+$@', $input[ $option_name ][ 0 ] ) ) {
										if ( isset( $option_values[ 'default' ] ) ) {
											$input[ $option_name ] = $option_values[ 'default' ];
										} else {
											$input[ $option_name ] = array();
										}
									}
								} else {
									$input[ $option_name ] = array_map( 'sanitize_text_field', $input[ $option_name ] );
								}
							}
							break;
						// clean email value
						case 'email':
							if ( ! isset( $input[ $option_name ] ) ) {
								$input[ $option_name ] = isset( $option_values[ 'default' ] ) ? $option_values[ 'default' ] : '';
							} else {
								if ( '' == $input[ $option_name ] and isset( $option_values[ 'required' ] ) ) {
									$input[ $option_name ] = $option_values[ 'default' ];
								} else {
									$email = sanitize_email( $input[ $option_name ] );
									$input[ $option_name ] = is_email( $email ) ? $email : '';
								}
							}
							break;
						// clean url values
						case 'url':
							if ( ! isset( $input[ $option_name ] ) ) {
								$input[ $option_name ] = isset( $option_values[ 'default' ] ) ? $option_values[ 'default' ] : '';
							} else {
								if ( '' == $input[ $option_name ] and isset( $option_values[ 'required' ] ) ) {
									$input[ $option_name ] = $option_values[ 'default' ];
								} else {
									$input[ $option_name ] = esc_url_raw( $input[ $option_name ] );
								}
							}
							break;
						// clean positive integers
						case 'absint':
							if ( ! isset( $input[ $option_name ] ) ) {
								$input[ $option_name ] = isset( $option_values[ 'default' ] ) ? $option_values[ 'default' ] : 0;
							} else {
								$input[ $option_name ] = absint( $input[ $option_name ] );
							}
							break;
						// clean integers
						case 'int':
							if ( ! isset( $input[ $option_name ] ) ) {
								$input[ $option_name ] = isset( $option_values[ 'default' ] ) ? $option_values[ 'default' ] : 0;
							} else {
								$input[ $option_name ] = intval( $input[ $option_name ] );
							}
							break;
						// clean floating point numbers
						case 'float':
							if ( ! isset( $input[ $option_name ] ) ) {
								$input[ $option_name ] = isset( $option_values[ 'default' ] ) ? $option_values[ 'default' ] : 0;
							} else {
								$input[ $option_name ] = floatval( $input[ $option_name ] );
							}
							break;
						// clean hexadecimal color values
						case 'colorpicker':
							// 3 or 6 hex digits, or the empty string
							if ( '' == $input[ $option_name ] or ! preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $input[ $option_name ] ) ) {
								$input[ $option_name ] = '';
							}
							break;
						// clean all other form elements values
						default:
							if ( ! isset( $input[ $option_name ] ) ) {
								$input[ $option_name ] = isset( $option_values[ 'default' ] ) ? $option_values[ 'default' ] : '';
							} else {
								if ( '' == $input[ $option_name ] and isset( $option_values[ 'required' ] ) ) {
									$input[ $option_name ] = $option_values[ 'default' ];
								} else {
									$input[ $option_name ] = sanitize_text_field( $input[ $option_name ] );
								}
							}
					} // end switch()
					
					// do some special checks
					switch ( $option_name ) {
						case 'number_posts':
							if ( 0 == $input[ $option_name ] or ! is_int( $input[ $option_name ] ) ) {
								$input[ $option_name ] = get_option( 'posts_per_page', 7 );
							}
							break;
					} // end switch()
				} // foreach( options )
			} // foreach( sections )
		} // foreach( chapter )
		
		return $input;
		
	} // end sanitize_options()

	/**
	* Get texts and values for image sizes dropdown
	*
	* @since	1.0.0
	* @return	array			Options and their sanatized values
	*/
	private static function get_image_sizes () {

		global $_wp_additional_image_sizes;
		$wp_standard_image_size_labels = array();
		$label = 'Full Size';	$wp_standard_image_size_labels[ 'full' ]		= __( $label );
		$label = 'Large';		$wp_standard_image_size_labels[ 'large' ]		= __( $label );
		$label = 'Medium';		$wp_standard_image_size_labels[ 'medium' ]		= __( $label );
		$label = 'Thumbnail';	$wp_standard_image_size_labels[ 'thumbnail' ]	= __( $label );
		
		$wp_standard_image_size_names = array_keys( $wp_standard_image_size_labels );
		$defaults[ 'size_options' ] = array(
			'custom' => __( 'Specified width and height', 'ultimate-post-list' ),
		);

		foreach ( get_intermediate_image_sizes() as $defaults[ 'size_name' ] ) {
			// Don't take numeric sizes that appear
			if( is_integer( $defaults[ 'size_name' ] ) ) {
				continue;
			}

			// Set name
			$name = in_array( $defaults[ 'size_name' ], $wp_standard_image_size_names ) ? $wp_standard_image_size_labels[$defaults[ 'size_name' ]] : $defaults[ 'size_name' ];
			
			// Set width
			$width = isset( $_wp_additional_image_sizes[$defaults[ 'size_name' ]]['width'] ) ? $_wp_additional_image_sizes[$defaults[ 'size_name' ]]['width'] : get_option( "{$defaults[ 'size_name' ]}_size_w" );
			
			// Set height
			$height = isset( $_wp_additional_image_sizes[$defaults[ 'size_name' ]]['height'] ) ? $_wp_additional_image_sizes[$defaults[ 'size_name' ]]['height'] : get_option( "{$defaults[ 'size_name' ]}_size_h" );
			
			// add option to options list
			$defaults[ 'size_options' ][ $defaults[ 'size_name' ] ] = sprintf( '%s (%d &times; %d)', esc_html( $name ), absint( $width ), absint( $height ) );
			
		}
		
		return $defaults[ 'size_options' ];
	}
		
}