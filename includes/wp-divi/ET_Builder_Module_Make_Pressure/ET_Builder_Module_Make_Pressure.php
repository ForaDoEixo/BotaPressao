<?php
class ET_Builder_Module_Make_Pressure extends ET_Builder_Module {
	function init() {
		$this->name = esc_html__( 'Agente Público Grid', 'et_builder' );
		$this->slug = 'et_pb_public_agent';

		$this->whitelisted_fields = array(
			'fullwidth',
			'posts_number',
			'include_categories',
			'show_title',
			'show_categories',
			'show_pagination',
			'background_layout',
			'admin_label',
			'module_id',
			'module_class',
			'zoom_icon_color',
			'hover_overlay_color',
			'hover_icon',
		);

		$this->fields_defaults = array(
			'fullwidth'         => array( 'on' ),
			'posts_number'      => array( 10, 'add_default_setting' ),
			'show_title'        => array( 'on' ),
			'show_categories'   => array( 'on' ),
			'show_pagination'   => array( 'on' ),
			'background_layout' => array( 'light' ),
		);

		$this->main_css_element = '%%order_class%% .et_pb_portfolio_item';
		$this->advanced_options = array(
			'fonts' => array(
				'title'   => array(
					'label'    => esc_html__( 'Title', 'et_builder' ),
					'css'      => array(
						'main' => "{$this->main_css_element} h2",
						'important' => 'all',
					),
				),
				'caption' => array(
					'label'    => esc_html__( 'Meta', 'et_builder' ),
					'css'      => array(
						'main' => "{$this->main_css_element} .post-meta, {$this->main_css_element} .post-meta a",
					),
				),
			),
			'background' => array(
				'settings' => array(
					'color' => 'alpha',
				),
			),
			'border' => array(),
		);
		$this->custom_css_options = array(
			'portfolio_image' => array(
				'label'    => esc_html__( 'Portfolio Image', 'et_builder' ),
				'selector' => '.et_portfolio_image',
			),
			'overlay' => array(
				'label'    => esc_html__( 'Overlay', 'et_builder' ),
				'selector' => '.et_overlay',
			),
			'overlay_icon' => array(
				'label'    => esc_html__( 'Overlay Icon', 'et_builder' ),
				'selector' => '.et_overlay:before',
			),
			'portfolio_title' => array(
				'label'    => esc_html__( 'Portfolio Title', 'et_builder' ),
				'selector' => '.et_pb_portfolio_item h2',
			),
			'portfolio_post_meta' => array(
				'label'    => esc_html__( 'Portfolio Post Meta', 'et_builder' ),
				'selector' => '.et_pb_portfolio_item .post-meta',
			),
		);
	}

	function get_fields() {
		$fields = array(
			'include_categories' => array(
				'label'            => esc_html__( 'Include Categories', 'et_builder' ),
				'renderer'         => 'et_builder_include_general_categories_option',
				'option_category'  => 'basic_option',
				'description'      => esc_html__( 'Select the categories that you would like to include in the feed.', 'et_builder' ),
			),
			'fullwidth' => array(
				'label'           => esc_html__( 'Layout', 'et_builder' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'         => array(
					'off'  => esc_html__( 'Fullwidth', 'et_builder' ),
					'on' => esc_html__( 'Grid', 'et_builder' ),
				),
				'description'       => esc_html__( 'Choose your desired portfolio layout style.', 'et_builder' ),
			),
			'posts_number' => array(
				'label'             => esc_html__( 'Posts Number', 'et_builder' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Define the number of projects that should be displayed per page.', 'et_builder' ),
			),
			'show_title' => array(
				'label'           => esc_html__( 'Show Title', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'description'       => esc_html__( 'Turn project titles on or off.', 'et_builder' ),
			),
			'show_categories' => array(
				'label'           => esc_html__( 'Show Categories', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'description'        => esc_html__( 'Turn the category links on or off.', 'et_builder' ),
			),
			'show_pagination' => array(
				'label'           => esc_html__( 'Show Pagination', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'description'        => esc_html__( 'Enable or disable pagination for this feed.', 'et_builder' ),
			),
			'background_layout' => array(
				'label'           => esc_html__( 'Text Color', 'et_builder' ),
				'type'            => 'select',
				'option_category' => 'color_option',
				'options'         => array(
					'light'  => esc_html__( 'Dark', 'et_builder' ),
					'dark' => esc_html__( 'Light', 'et_builder' ),
				),
				'description'        => esc_html__( 'Here you can choose whether your text should be light or dark. If you are working with a dark background, then your text should be light. If your background is light, then your text should be set to dark.', 'et_builder' ),
			),
			'zoom_icon_color' => array(
				'label'             => esc_html__( 'Zoom Icon Color', 'et_builder' ),
				'type'              => 'color',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
			),
			'hover_overlay_color' => array(
				'label'             => esc_html__( 'Hover Overlay Color', 'et_builder' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
			),
			'hover_icon' => array(
				'label'               => esc_html__( 'Hover Icon Picker', 'et_builder' ),
				'type'                => 'text',
				'option_category'     => 'configuration',
				'class'               => array( 'et-pb-font-icon' ),
				'renderer'            => 'et_pb_get_font_icon_list',
				'renderer_with_field' => true,
				'tab_slug'            => 'advanced',
			),
			'disabled_on' => array(
				'label'           => esc_html__( 'Disable on', 'et_builder' ),
				'type'            => 'multiple_checkboxes',
				'options'         => array(
					'phone'   => esc_html__( 'Phone', 'et_builder' ),
					'tablet'  => esc_html__( 'Tablet', 'et_builder' ),
					'desktop' => esc_html__( 'Desktop', 'et_builder' ),
				),
				'additional_att'  => 'disable_on',
				'option_category' => 'configuration',
				'description'     => esc_html__( 'This will disable the module on selected devices', 'et_builder' ),
			),
			'admin_label' => array(
				'label'       => esc_html__( 'Admin Label', 'et_builder' ),
				'type'        => 'text',
				'description' => esc_html__( 'This will change the label of the module in the builder for easy identification.', 'et_builder' ),
			),
			'module_id' => array(
				'label'           => esc_html__( 'CSS ID', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'tab_slug'        => 'custom_css',
				'option_class'    => 'et_pb_custom_css_regular',
			),
			'module_class' => array(
				'label'           => esc_html__( 'CSS Class', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'tab_slug'        => 'custom_css',
				'option_class'    => 'et_pb_custom_css_regular',
			),
		);
		return $fields;
	}

	function shortcode_callback( $atts, $content = null, $function_name ) {
		$module_id          = $this->shortcode_atts['module_id'];
		$module_class       = $this->shortcode_atts['module_class'];
		$fullwidth          = $this->shortcode_atts['fullwidth'];
		$posts_number       = $this->shortcode_atts['posts_number'];
		$include_categories = $this->shortcode_atts['include_categories'];
		$show_title         = $this->shortcode_atts['show_title'];
		$show_categories    = $this->shortcode_atts['show_categories'];
		$show_pagination    = $this->shortcode_atts['show_pagination'];
		$background_layout  = $this->shortcode_atts['background_layout'];
		$zoom_icon_color     = $this->shortcode_atts['zoom_icon_color'];
		$hover_overlay_color = $this->shortcode_atts['hover_overlay_color'];
		$hover_icon          = $this->shortcode_atts['hover_icon'];

		global $paged;

		$module_class = ET_Builder_Element::add_module_order_class( $module_class, $function_name );

		if ( '' !== $zoom_icon_color ) {
			ET_Builder_Element::set_style( $function_name, array(
				'selector'    => '%%order_class%% .et_overlay:before',
				'declaration' => sprintf(
					'color: %1$s !important;',
					esc_html( $zoom_icon_color )
				),
			) );
		}

		if ( '' !== $hover_overlay_color ) {
			ET_Builder_Element::set_style( $function_name, array(
				'selector'    => '%%order_class%% .et_overlay',
				'declaration' => sprintf(
					'background-color: %1$s;
					border-color: %1$s;',
					esc_html( $hover_overlay_color )
				),
			) );
		}

		$container_is_closed = false;

		$et_paged = is_front_page() ? get_query_var( 'page' ) : get_query_var( 'paged' );

		if ( is_front_page() ) {
			$paged = $et_paged;
		}

		$args = array(
			'posts_per_page' => (int) $posts_number,
			'post_type'      => 'public_agent',
		);

		$args = wp_divi_separete_categories($include_categories, $args);

        if ( ! is_search() ) {
			$args['paged'] = $et_paged;
		}

		$main_post_class = sprintf(
			'et_pb_portfolio_item%1$s',
			( 'on' !== $fullwidth ? ' et_pb_grid_item' : '' )
		);

		$posts = wp_divi_get_congresscards( $args, $fullwidth, $hover_icon, $show_title, $show_categories );

		$class = " et_pb_module et_pb_bg_layout_{$background_layout}";

		$output = sprintf(
			'<div%5$s class="%1$s%3$s%6$s">
				%2$s
			%4$s',
			( 'on' === $fullwidth ? 'et_pb_portfolio' : 'et_pb_portfolio_grid clearfix' ),
			$posts,
			esc_attr( $class ),
			( ! $container_is_closed ? '</div> <!-- .et_pb_portfolio -->' : '' ),
			( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
			( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' )
		);

		return $output;
	}
}
new ET_Builder_Module_Make_Pressure;

class ET_Builder_Module_Fullwidth_Make_Pressure extends ET_Builder_Module {
	function init() {
		$this->name       = esc_html__( 'Fullwidth Portfolio', 'et_builder' );
		$this->slug       = 'et_pb_fullwidth_public_agent';
		$this->fullwidth  = true;

		// need to use global settings from the slider module
		$this->global_settings_slug = 'et_pb_portfolio';

		$this->whitelisted_fields = array(
			'title',
			'fullwidth',
			'include_categories',
			'posts_number',
			'show_title',
			'show_date',
			'background_layout',
			'auto',
			'auto_speed',
			'hover_icon',
			'hover_overlay_color',
			'zoom_icon_color',
			'admin_label',
			'module_id',
			'module_class',
		);

		$this->main_css_element = '%%order_class%%';

		$this->advanced_options = array(
			'fonts' => array(
				'title'   => array(
					'label'    => esc_html__( 'Title', 'et_builder' ),
					'css'      => array(
						'main' => "{$this->main_css_element} h3",
						'important' => 'all',
					),
				),
				'caption' => array(
					'label'    => esc_html__( 'Meta', 'et_builder' ),
					'css'      => array(
						'main' => "{$this->main_css_element} .post-meta, {$this->main_css_element} .post-meta a",
					),
				),
			),
			'background' => array(
				'settings' => array(
					'color' => 'alpha',
				),
			),
			'border' => array(
				'css' => array(
					'main' => "{$this->main_css_element} .et_pb_portfolio_item",
				),
			),
		);

		$this->custom_css_options = array(
			'portfolio_title' => array(
				'label'    => esc_html__( 'Portfolio Title', 'et_builder' ),
				'selector' => '> h2',
			),
			'portfolio_item' => array(
				'label'    => esc_html__( 'Portfolio Item', 'et_builder' ),
				'selector' => '.et_pb_portfolio_item',
			),
			'portfolio_overlay' => array(
				'label'    => esc_html__( 'Item Overlay', 'et_builder' ),
				'selector' => 'span.et_overlay',
			),
			'portfolio_item_title' => array(
				'label'    => esc_html__( 'Item Title', 'et_builder' ),
				'selector' => '.meta h3',
			),
			'portfolio_meta' => array(
				'label'    => esc_html__( 'Meta', 'et_builder' ),
				'selector' => '.meta p',
			),
			'portfolio_arrows' => array(
				'label'    => esc_html__( 'Navigation Arrows', 'et_builder' ),
				'selector' => '.et-pb-slider-arrows a',
			),
		);

		$this->fields_defaults = array(
			'fullwidth'         => array( 'on' ),
			'show_title'        => array( 'on' ),
			'show_date'         => array( 'on' ),
			'background_layout' => array( 'light' ),
			'auto'              => array( 'off' ),
			'auto_speed'        => array( '7000' ),
		);
	}

	function get_fields() {
		$fields = array(
			'title' => array(
				'label'           => esc_html__( 'Portfolio Title', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Title displayed above the portfolio.', 'et_builder' ),
			),
			'include_categories' => array(
				'label'           => esc_html__( 'Include Categories', 'et_builder' ),
				'renderer'        => 'et_builder_include_general_categories_option',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Select the categories that you would like to include in the feed.', 'et_builder' ),
			),
			'fullwidth' => array(
				'label'             => esc_html__( 'Layout', 'et_builder' ),
				'type'              => 'select',
				'option_category'   => 'layout',
				'options'           => array(
					'off'  => esc_html__( 'Carousel', 'et_builder' ),
					'on' => esc_html__( 'Grid', 'et_builder' ),
				),
				'affects'           => array(
					'#et_pb_auto',
				),
				'description'        => esc_html__( 'Choose your desired portfolio layout style.', 'et_builder' ),
			),
			'posts_number' => array(
				'label'           => esc_html__( 'Posts Number', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'description'     => esc_html__( 'Control how many projects are displayed. Leave blank or use 0 to not limit the amount.', 'et_builder' ),
			),
			'show_title' => array(
				'label'             => esc_html__( 'Show Title', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'description'        => esc_html__( 'Turn project titles on or off.', 'et_builder' ),
			),
			'show_date' => array(
				'label'             => esc_html__( 'Show Date', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'description'        => esc_html__( 'Turn the date display on or off.', 'et_builder' ),
			),
			'background_layout' => array(
				'label'             => esc_html__( 'Text Color', 'et_builder' ),
				'type'              => 'select',
				'option_category'   => 'color_option',
				'options'           => array(
					'light'  => esc_html__( 'Dark', 'et_builder' ),
					'dark' => esc_html__( 'Light', 'et_builder' ),
				),
				'description'        => esc_html__( 'Here you can choose whether your text should be light or dark. If you are working with a dark background, then your text should be light. If your background is light, then your text should be set to dark.', 'et_builder' ),
			),
			'auto' => array(
				'label'             => esc_html__( 'Automatic Carousel Rotation', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'off'  => esc_html__( 'Off', 'et_builder' ),
					'on' => esc_html__( 'On', 'et_builder' ),
				),
				'affects'           => array(
					'#et_pb_auto_speed',
				),
				'depends_show_if' => 'on',
				'description'        => esc_html__( 'If you the carousel layout option is chosen and you would like the carousel to slide automatically, without the visitor having to click the next button, enable this option and then adjust the rotation speed below if desired.', 'et_builder' ),
			),
			'auto_speed' => array(
				'label'             => esc_html__( 'Automatic Carousel Rotation Speed (in ms)', 'et_builder' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'depends_default'   => true,
				'description'       => esc_html__( "Here you can designate how fast the carousel rotates, if 'Automatic Carousel Rotation' option is enabled above. The higher the number the longer the pause between each rotation. (Ex. 1000 = 1 sec)", 'et_builder' ),
			),
			'zoom_icon_color' => array(
				'label'             => esc_html__( 'Zoom Icon Color', 'et_builder' ),
				'type'              => 'color',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
			),
			'hover_overlay_color' => array(
				'label'             => esc_html__( 'Hover Overlay Color', 'et_builder' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
			),
			'hover_icon' => array(
				'label'               => esc_html__( 'Hover Icon Picker', 'et_builder' ),
				'type'                => 'text',
				'option_category'     => 'configuration',
				'class'               => array( 'et-pb-font-icon' ),
				'renderer'            => 'et_pb_get_font_icon_list',
				'renderer_with_field' => true,
				'tab_slug'            => 'advanced',
			),
			'disabled_on' => array(
				'label'           => esc_html__( 'Disable on', 'et_builder' ),
				'type'            => 'multiple_checkboxes',
				'options'         => array(
					'phone'   => esc_html__( 'Phone', 'et_builder' ),
					'tablet'  => esc_html__( 'Tablet', 'et_builder' ),
					'desktop' => esc_html__( 'Desktop', 'et_builder' ),
				),
				'additional_att'  => 'disable_on',
				'option_category' => 'configuration',
				'description'     => esc_html__( 'This will disable the module on selected devices', 'et_builder' ),
			),
			'admin_label' => array(
				'label'       => esc_html__( 'Admin Label', 'et_builder' ),
				'type'        => 'text',
				'description' => esc_html__( 'This will change the label of the module in the builder for easy identification.', 'et_builder' ),
			),
			'module_id' => array(
				'label'           => esc_html__( 'CSS ID', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'tab_slug'        => 'custom_css',
				'option_class'    => 'et_pb_custom_css_regular',
			),
			'module_class' => array(
				'label'           => esc_html__( 'CSS Class', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'tab_slug'        => 'custom_css',
				'option_class'    => 'et_pb_custom_css_regular',
			),
		);
		return $fields;
	}

	function shortcode_callback( $atts, $content = null, $function_name ) {
		$title               = $this->shortcode_atts['title'];
		$module_id           = $this->shortcode_atts['module_id'];
		$module_class        = $this->shortcode_atts['module_class'];
		$fullwidth           = $this->shortcode_atts['fullwidth'];
		$include_categories  = $this->shortcode_atts['include_categories'];
		$posts_number        = $this->shortcode_atts['posts_number'];
		$show_title          = $this->shortcode_atts['show_title'];
		$show_date           = $this->shortcode_atts['show_date'];
		$background_layout   = $this->shortcode_atts['background_layout'];
		$auto                = $this->shortcode_atts['auto'];
		$auto_speed          = $this->shortcode_atts['auto_speed'];
		$zoom_icon_color     = $this->shortcode_atts['zoom_icon_color'];
		$hover_overlay_color = $this->shortcode_atts['hover_overlay_color'];
		$hover_icon          = $this->shortcode_atts['hover_icon'];

		$module_class = ET_Builder_Element::add_module_order_class( $module_class, $function_name );

		if ( '' !== $zoom_icon_color ) {
			ET_Builder_Element::set_style( $function_name, array(
				'selector'    => '%%order_class%% .et_overlay:before',
				'declaration' => sprintf(
					'color: %1$s !important;',
					esc_html( $zoom_icon_color )
				),
			) );
		}

		if ( '' !== $hover_overlay_color ) {
			ET_Builder_Element::set_style( $function_name, array(
				'selector'    => '%%order_class%% .et_overlay',
				'declaration' => sprintf(
					'background-color: %1$s;
					border-color: %1$s;',
					esc_html( $hover_overlay_color )
				),
			) );
		}

		$args = array();
		if ( is_numeric( $posts_number ) && $posts_number > 0 ) {
			$args['posts_per_page'] = $posts_number;
		} else {
			$args['nopaging'] = true;
		}


        $terms_category = '';
        $terms_states = '';
        $terms_party = '';
        $terms_job = '';
        $terms_genre = '';
        $terms_commission = '';
        $terms_position = '';

        $categories = explode( ',', $include_categories );
        foreach ($categories as $category) {
        	$term = get_term($category);
        	if($term->taxonomy == "category"){
        		$terms_category .= $terms_category ? ', ' . $category : $category;
        	}
        	elseif ($term->taxonomy == "public_agent_state") {
        		$terms_states .= $terms_states ? ', ' . $category : $category;
        	}
        	elseif ($term->taxonomy == "public_agent_job") {
        		$terms_job .= $terms_job ? ', ' . $category : $category;
        	}
        	elseif ($term->taxonomy == "public_agent_genre") {
        		$terms_genre .= $terms_genre ? ', ' . $category : $category;
        	}
        	elseif ($term->taxonomy == "public_agent_party") {
        		$terms_party .= $terms_party ? ', ' . $category : $category;
        	}
        	elseif ($term->taxonomy == "public_agent_commission") {
        		$terms_commission .= $terms_commission ? ', ' . $category : $category;
        	}
        	elseif ($term->taxonomy == "public_agent_vote") {
        		$terms_position .= $terms_position ? ', ' . $category : $category;
        	}

        }

		$settings_states = '';
		$settings_category = '';
		$settings_job = '';
		$settings_genre = '';
		$settings_party = '';
		$settings_commission = '';
		$settings_position = '';

		if ($terms_category){
			$settings_category = array(
					'taxonomy' => 'category',
					'field' => 'id',
					'terms' => explode( ',', $terms_category ),
					'operator' => 'IN',
				);
		} elseif ($terms_states) {
			$settings_states = array(
					'taxonomy' => 'public_agent_state',
					'field' => 'id',
					'terms' => explode( ',', $terms_states ),
					'operator' => 'IN',
				);
		} elseif ($terms_job) {
			$settings_job = array(
					'taxonomy' => 'public_agent_job',
					'field' => 'id',
					'terms' => explode( ',', $terms_job ),
					'operator' => 'IN',
				);
		} elseif ($terms_genre) {
			$settings_genre = array(
					'taxonomy' => 'public_agent_genre',
					'field' => 'id',
					'terms' => explode( ',', $terms_genre ),
					'operator' => 'IN',
				);
		} elseif ($terms_party) {
			$settings_party = array(
					'taxonomy' => 'public_agent_party',
					'field' => 'id',
					'terms' => explode( ',', $terms_party ),
					'operator' => 'IN',
				);
		} elseif ($terms_commission) {
			$settings_commission = array(
					'taxonomy' => 'public_agent_commission',
					'field' => 'id',
					'terms' => explode( ',', $terms_commission ),
					'operator' => 'IN',
				);
		} elseif ($terms_position) {
			$settings_position = array(
					'taxonomy' => 'public_agent_vote',
					'field' => 'id',
					'terms' => explode( ',', $terms_position ),
					'operator' => 'IN',
				);
		}



		if ( '' !== $include_categories )
			$args['tax_query'] = array(
				$settings_states,
				$settings_category,
				$settings_job,
				$settings_genre,
				$settings_party,
				$settings_commission,
				$settings_position
			);


		$projects = et_divi_get_public_agent( $args );

		ob_start();
		if( $projects->post_count > 0 ) {
			while ( $projects->have_posts() ) {
				$projects->the_post();
				?>
				<div id="post-<?php the_ID(); ?>" <?php post_class( 'et_pb_portfolio_item et_pb_grid_item ' ); ?>>
				<?php
					$thumb = '';

					$width = 320;
					$width = (int) apply_filters( 'et_pb_portfolio_image_width', $width );

					$height = 241;
					$height = (int) apply_filters( 'et_pb_portfolio_image_height', $height );

					list($thumb_src, $thumb_width, $thumb_height) = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), array( $width, $height ) );

					$orientation = ( $thumb_height > $thumb_width ) ? 'portrait' : 'landscape';

					if ( '' !== $thumb_src ) : ?>

						<div class="et_pb_portfolio_image <?php echo esc_attr( $orientation ); ?>">
							<a href="<?php esc_url( the_permalink() ); ?>">
								<img src="<?php echo esc_url( $thumb_src ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>"/>
								<div class="meta">
								<?php
									$data_icon = '' !== $hover_icon
										? sprintf(
											' data-icon="%1$s"',
											esc_attr( et_pb_process_font_icon( $hover_icon ) )
										)
										: '';

									printf( '<span class="et_overlay%1$s"%2$s></span>',
										( '' !== $hover_icon ? ' et_pb_inline_icon' : '' ),
										$data_icon
									);
								?>
									<?php if ( 'on' === $show_title ) : ?>
										<h3><?php the_title(); ?></h3>
									<?php endif; ?>

									<?php if ( 'on' === $show_date ) : ?>
										<p class="post-meta"><?php echo get_the_date(); ?></p>
									<?php endif; ?>
								</div>
							</a>
						</div>
				<?php endif; ?>
				</div>
				<?php
			}
		}

		wp_reset_postdata();

		$posts = ob_get_clean();

		$class = " et_pb_module et_pb_bg_layout_{$background_layout}";

		$output = sprintf(
			'<div%4$s class="et_pb_fullwidth_portfolio %1$s%3$s%5$s" data-auto-rotate="%6$s" data-auto-rotate-speed="%7$s">
				%8$s
				<div class="et_pb_portfolio_items clearfix" data-portfolio-columns="">
					%2$s
				</div><!-- .et_pb_portfolio_items -->
			</div><!-- .et_pb_fullwidth_portfolio -->',
			( 'on' === $fullwidth ? 'et_pb_fullwidth_portfolio_carousel' : 'et_pb_fullwidth_portfolio_grid clearfix' ),
			$posts,
			esc_attr( $class ),
			( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
			( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' ),
			( '' !== $auto && in_array( $auto, array('on', 'off') ) ? esc_attr( $auto ) : 'off' ),
			( '' !== $auto_speed && is_numeric( $auto_speed ) ? esc_attr( $auto_speed ) : '7000' ),
			( '' !== $title ? sprintf( '<h2>%s</h2>', esc_html( $title ) ) : '' )
		);

		return $output;
	}
}
new ET_Builder_Module_Fullwidth_Make_Pressure;

class ET_Builder_Module_Make_Pressure_Button extends ET_Builder_Module {
	function init() {
		$this->name = esc_html__( 'Super Pressão', 'et_builder' );
		$this->slug = 'et_pb_makepressure_button';

		$this->whitelisted_fields = array(
			'url_new_window',
			'include_categories',
			'button_text',
			'background_layout',
			'button_alignment',
			'admin_label',
			'module_id',
			'module_class',
		);

		$this->fields_defaults = array(
			'url_new_window'    => array( 'off' ),
			'background_color'  => array( et_builder_accent_color(), 'add_default_setting' ),
			'background_layout' => array( 'light' ),
		);

		$this->main_css_element = '%%order_class%%';
		$this->advanced_options = array(
			'button' => array(
				'button' => array(
					'label' => esc_html__( 'Button', 'et_builder' ),
					'css' => array(
						'main' => $this->main_css_element,
					),
				),
			),
		);
	}

	function get_fields() {
		$fields = array(
			'include_categories' => array(
				'label'            => esc_html__( 'Include Categories', 'et_builder' ),
				'renderer'         => 'et_builder_include_general_categories_option',
				'option_category'  => 'basic_option',
				'description'      => esc_html__( 'Select the categories that you would like to include in the feed.', 'et_builder' ),
			),
			'url_new_window' => array(
				'label'           => esc_html__( 'Url Opens', 'et_builder' ),
				'type'            => 'select',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'In The Same Window', 'et_builder' ),
					'on'  => esc_html__( 'In The New Tab', 'et_builder' ),
				),
				'description'       => esc_html__( 'Here you can choose whether or not your link opens in a new window', 'et_builder' ),
			),
			'button_text' => array(
				'label'           => esc_html__( 'Button Text', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Input your desired button text.', 'et_builder' ),
			),
			'button_alignment' => array(
				'label'           => esc_html__( 'Button alignment', 'et_builder' ),
				'type'            => 'select',
				'option_category' => 'configuration',
				'options'         => array(
					'left'   => esc_html__( 'Left', 'et_builder' ),
					'center' => esc_html__( 'Center', 'et_builder' ),
					'right'  => esc_html__( 'Right', 'et_builder' ),
				),
				'description'     => esc_html__( 'Here you can define the alignemnt of Button', 'et_builder' ),
			),
			'background_layout' => array(
				'label'           => esc_html__( 'Text Color', 'et_builder' ),
				'type'            => 'select',
				'option_category' => 'color_option',
				'options'         => array(
					'light' => esc_html__( 'Dark', 'et_builder' ),
					'dark'  => esc_html__( 'Light', 'et_builder' ),
				),
				'description'     => esc_html__( 'Here you can choose whether your text should be light or dark. If you are working with a dark background, then your text should be light. If your background is light, then your text should be set to dark.', 'et_builder' ),
			),
			'disabled_on' => array(
				'label'           => esc_html__( 'Disable on', 'et_builder' ),
				'type'            => 'multiple_checkboxes',
				'options'         => array(
					'phone'   => esc_html__( 'Phone', 'et_builder' ),
					'tablet'  => esc_html__( 'Tablet', 'et_builder' ),
					'desktop' => esc_html__( 'Desktop', 'et_builder' ),
				),
				'additional_att'  => 'disable_on',
				'option_category' => 'configuration',
				'description'     => esc_html__( 'This will disable the module on selected devices', 'et_builder' ),
			),
			'admin_label' => array(
				'label'       => esc_html__( 'Admin Label', 'et_builder' ),
				'type'        => 'text',
				'description' => esc_html__( 'This will change the label of the module in the builder for easy identification.', 'et_builder' ),
			),
			'module_id' => array(
				'label'           => esc_html__( 'CSS ID', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'tab_slug'        => 'custom_css',
				'option_class'    => 'et_pb_custom_css_regular',
			),
			'module_class' => array(
				'label'           => esc_html__( 'CSS Class', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'tab_slug'        => 'custom_css',
				'option_class'    => 'et_pb_custom_css_regular',
			),
		);
		return $fields;
	}

	function shortcode_callback( $atts, $content = null, $function_name ) {
		$module_id         = $this->shortcode_atts['module_id'];
		$module_class      = $this->shortcode_atts['module_class'];
		$button_text       = $this->shortcode_atts['button_text'];
		$background_layout = $this->shortcode_atts['background_layout'];
		$url_new_window    = $this->shortcode_atts['url_new_window'];
		$custom_icon       = $this->shortcode_atts['button_icon'];
		$button_custom     = $this->shortcode_atts['custom_button'];
		$button_alignment  = $this->shortcode_atts['button_alignment'];
		$include_categories = $this->shortcode_atts['include_categories'];

        $args = array(
			'post_type'      => 'public_agent',
			'post_status'    => 'publish',
			'fields' 		 => 'ids',
			'posts_per_page' => -1,
		);


        $terms_category = '';
        $terms_states = '';
        $terms_party = '';
        $terms_job = '';
        $terms_genre = '';
        $terms_commission = '';
        $terms_position = '';
        $categories = explode( ',', $include_categories );

        foreach ($categories as $category) {
        	$term = get_term($category);

        	if (!is_wp_error($term)) {
        	    if($term->taxonomy == "category"){
        		    $terms_category .= $terms_category ? ', ' . $category : $category;
	        	}
	        	elseif ($term->taxonomy == "public_agent_state") {
	        		$terms_states .= $terms_states ? ', ' . $category : $category;
	        	}
	        	elseif ($term->taxonomy == "public_agent_job") {
	        		$terms_job .= $terms_job ? ', ' . $category : $category;
	        	}
	        	elseif ($term->taxonomy == "public_agent_genre") {
	        		$terms_genre .= $terms_genre ? ', ' . $category : $category;
	        	}
	        	elseif ($term->taxonomy == "public_agent_party") {
	        		$terms_party .= $terms_party ? ', ' . $category : $category;
	        	}
	        	elseif ($term->taxonomy == "public_agent_commission") {
	        		$terms_commission .= $terms_commission ? ', ' . $category : $category;
	        	}
	        	elseif ($term->taxonomy == "public_agent_vote") {
	        		$terms_position .= $terms_position ? ', ' . $category : $category;
	        	}
        	}

        }

		$settings_states = '';
		$settings_category = '';
		$settings_job = '';
		$settings_genre = '';
		$settings_party = '';
		$settings_commission = '';
		$settings_position = '';

		if ($terms_category){
			$settings_category = array(
					'taxonomy' => 'category',
					'field' => 'id',
					'terms' => explode( ',', $terms_category ),
					'operator' => 'IN',
				);
		} elseif ($terms_states) {
			$settings_states = array(
					'taxonomy' => 'public_agent_state',
					'field' => 'id',
					'terms' => explode( ',', $terms_states ),
					'operator' => 'IN',
				);
		} elseif ($terms_job) {
			$settings_job = array(
					'taxonomy' => 'public_agent_job',
					'field' => 'id',
					'terms' => explode( ',', $terms_job ),
					'operator' => 'IN',
				);
		} elseif ($terms_genre) {
			$settings_genre = array(
					'taxonomy' => 'public_agent_genre',
					'field' => 'id',
					'terms' => explode( ',', $terms_genre ),
					'operator' => 'IN',
				);
		} elseif ($terms_party) {
			$settings_party = array(
					'taxonomy' => 'public_agent_party',
					'field' => 'id',
					'terms' => explode( ',', $terms_party ),
					'operator' => 'IN',
				);
		} elseif ($terms_commission) {
			$settings_commission = array(
					'taxonomy' => 'public_agent_commission',
					'field' => 'id',
					'terms' => explode( ',', $terms_commission ),
					'operator' => 'IN',
				);
		} elseif ($terms_position) {
			$settings_position = array(
					'taxonomy' => 'public_agent_vote',
					'field' => 'id',
					'terms' => explode( ',', $terms_position ),
					'operator' => 'IN',
				);
		}



		if ( '' !== $include_categories )
			$args['tax_query'] = array(
				$settings_states,
				$settings_category,
				$settings_job,
				$settings_genre,
				$settings_party,
				$settings_commission,
				$settings_position
			);

		$the_query = new WP_Query( $args );

		// The Loop
		$emails = array();
		$button_url = 'mailto:' . get_option('makepressure_more_emailsmails');
		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$emails[] = get_post_meta(  get_the_ID(), 'public_agent_email', true) ? get_post_meta(  get_the_ID(), 'public_agent_email', true):'';
			}

			shuffle($emails);
			$emails = array_slice($emails, 0, 98);
			
			$button_url .= implode( ',',  $emails ) . '?subject=' . get_option('makepressure_email_title') . '&body=' . get_option('makepressure_email_body') ;
			/* Restore original Post Data */
			wp_reset_postdata();
		} else {
			_e('Não há agentes públicos','makepressure');
		}

		// Nothing to output if neither Button Text nor Button URL defined
		if ( '' === $button_text && '' === $button_url ) {
			return;
		}

		$module_class = ET_Builder_Element::add_module_order_class( $module_class, $function_name );

		$module_class .= " et_pb_module et_pb_bg_layout_{$background_layout}";
		global $post;
		$output = sprintf(
			'<div class="et_pb_button_module_wrapper et_pb_module%8$s">
				<a class="makepressure_superpressure et_pb_button%5$s%7$s" href="%1$s"%3$s%4$s%6$s>%2$s</a>
			</div>',
			esc_url( $button_url ),
			'' !== $button_text ? esc_html( $button_text ) : esc_url( $button_url ),
			( 'on' === $url_new_window ? ' target="_blank"' : '' ),
			'' !== $custom_icon && 'on' === $button_custom ? sprintf(
				' data-icon="%1$s"',
				esc_attr( et_pb_process_font_icon( $custom_icon ) )
			) : '',
			'' !== $custom_icon && 'on' === $button_custom ? ' et_pb_custom_button_icon' : '',
			( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
			( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' ),
			'right' === $button_alignment || 'center' === $button_alignment ? sprintf( ' et_pb_button_alignment_%1$s', esc_attr( $button_alignment ) )  : ''
		);

		return $output;
	}
}
new ET_Builder_Module_Make_Pressure_Button;

class ET_Builder_Module_Make_Pressure_Gmail_Button extends ET_Builder_Module {
	function init() {
		$this->name = esc_html__( 'Super Pressão Gmail', 'et_builder' );
		$this->slug = 'et_pb_makepressure_gmail_button';

		$this->whitelisted_fields = array(
			'url_new_window',
			'include_categories',
			'button_text',
			'background_layout',
			'button_alignment',
			'admin_label',
			'module_id',
			'module_class',
		);

		$this->fields_defaults = array(
			'url_new_window'    => array( 'off' ),
			'background_color'  => array( et_builder_accent_color(), 'add_default_setting' ),
			'background_layout' => array( 'light' ),
		);

		$this->main_css_element = '%%order_class%%';
		$this->advanced_options = array(
			'button' => array(
				'button' => array(
					'label' => esc_html__( 'Button', 'et_builder' ),
					'css' => array(
						'main' => $this->main_css_element,
					),
				),
			),
		);
	}

	function get_fields() {
		$fields = array(
			'include_categories' => array(
				'label'            => esc_html__( 'Include Categories', 'et_builder' ),
				'renderer'         => 'et_builder_include_general_categories_option',
				'option_category'  => 'basic_option',
				'description'      => esc_html__( 'Select the categories that you would like to include in the feed.', 'et_builder' ),
			),
			'url_new_window' => array(
				'label'           => esc_html__( 'Url Opens', 'et_builder' ),
				'type'            => 'select',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'In The Same Window', 'et_builder' ),
					'on'  => esc_html__( 'In The New Tab', 'et_builder' ),
				),
				'description'       => esc_html__( 'Here you can choose whether or not your link opens in a new window', 'et_builder' ),
			),
			'button_text' => array(
				'label'           => esc_html__( 'Button Text', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Input your desired button text.', 'et_builder' ),
			),
			'button_alignment' => array(
				'label'           => esc_html__( 'Button alignment', 'et_builder' ),
				'type'            => 'select',
				'option_category' => 'configuration',
				'options'         => array(
					'left'   => esc_html__( 'Left', 'et_builder' ),
					'center' => esc_html__( 'Center', 'et_builder' ),
					'right'  => esc_html__( 'Right', 'et_builder' ),
				),
				'description'     => esc_html__( 'Here you can define the alignemnt of Button', 'et_builder' ),
			),
			'background_layout' => array(
				'label'           => esc_html__( 'Text Color', 'et_builder' ),
				'type'            => 'select',
				'option_category' => 'color_option',
				'options'         => array(
					'light' => esc_html__( 'Dark', 'et_builder' ),
					'dark'  => esc_html__( 'Light', 'et_builder' ),
				),
				'description'     => esc_html__( 'Here you can choose whether your text should be light or dark. If you are working with a dark background, then your text should be light. If your background is light, then your text should be set to dark.', 'et_builder' ),
			),
			'disabled_on' => array(
				'label'           => esc_html__( 'Disable on', 'et_builder' ),
				'type'            => 'multiple_checkboxes',
				'options'         => array(
					'phone'   => esc_html__( 'Phone', 'et_builder' ),
					'tablet'  => esc_html__( 'Tablet', 'et_builder' ),
					'desktop' => esc_html__( 'Desktop', 'et_builder' ),
				),
				'additional_att'  => 'disable_on',
				'option_category' => 'configuration',
				'description'     => esc_html__( 'This will disable the module on selected devices', 'et_builder' ),
			),
			'admin_label' => array(
				'label'       => esc_html__( 'Admin Label', 'et_builder' ),
				'type'        => 'text',
				'description' => esc_html__( 'This will change the label of the module in the builder for easy identification.', 'et_builder' ),
			),
			'module_id' => array(
				'label'           => esc_html__( 'CSS ID', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'tab_slug'        => 'custom_css',
				'option_class'    => 'et_pb_custom_css_regular',
			),
			'module_class' => array(
				'label'           => esc_html__( 'CSS Class', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'tab_slug'        => 'custom_css',
				'option_class'    => 'et_pb_custom_css_regular',
			),
		);
		return $fields;
	}

	function shortcode_callback( $atts, $content = null, $function_name ) {
		$module_id         = $this->shortcode_atts['module_id'];
		$module_class      = $this->shortcode_atts['module_class'];
		$button_text       = $this->shortcode_atts['button_text'];
		$background_layout = $this->shortcode_atts['background_layout'];
		$url_new_window    = $this->shortcode_atts['url_new_window'];
		$custom_icon       = $this->shortcode_atts['button_icon'];
		$button_custom     = $this->shortcode_atts['custom_button'];
		$button_alignment  = $this->shortcode_atts['button_alignment'];
		$include_categories = $this->shortcode_atts['include_categories'];

        $args = array(
			'post_type'      => 'public_agent',
			'post_status'    => 'publish',
	        'fields' 		 => 'ids',
			'posts_per_page' => -1,
		);


         $terms_category = '';
        $terms_states = '';
        $terms_party = '';
        $terms_job = '';
        $terms_genre = '';
        $terms_commission = '';
        $terms_position = '';
        $categories = explode( ',', $include_categories );
        foreach ($categories as $category) {
        	$term = get_term($category);

        	if (!is_wp_error($term)) {
        	    if($term->taxonomy === 'category'){
        		    $terms_category .= $terms_category ? ', ' . $category : $category;
	        	}
	        	elseif ($term->taxonomy === 'public_agent_state') {
	        		$terms_states .= $terms_states ? ', ' . $category : $category;
	        	}
	        	elseif ($term->taxonomy === 'public_agent_job') {
	        		$terms_job .= $terms_job ? ', ' . $category : $category;
	        	}
	        	elseif ($term->taxonomy === 'public_agent_genre') {
	        		$terms_genre .= $terms_genre ? ', ' . $category : $category;
	        	}
	        	elseif ($term->taxonomy === 'public_agent_party') {
	        		$terms_party .= $terms_party ? ', ' . $category : $category;
	        	}
	        	elseif ($term->taxonomy === 'public_agent_commission') {
	        		$terms_commission .= $terms_commission ? ', ' . $category : $category;
	        	}
	        	elseif ($term->taxonomy === 'public_agent_vote') {
	        		$terms_position .= $terms_position ? ', ' . $category : $category;
	        	}
        	}

        }

		$settings_states = '';
		$settings_category = '';
		$settings_job = '';
		$settings_genre = '';
		$settings_party = '';
		$settings_commission = '';
		$settings_position = '';

		if ($terms_category){
			$settings_category = array(
					'taxonomy' => 'category',
					'field' => 'id',
					'terms' => explode( ',', $terms_category ),
					'operator' => 'IN',
				);
		} elseif ($terms_states) {
			$settings_states = array(
					'taxonomy' => 'public_agent_state',
					'field' => 'id',
					'terms' => explode( ',', $terms_states ),
					'operator' => 'IN',
				);
		} elseif ($terms_job) {
			$settings_job = array(
					'taxonomy' => 'public_agent_job',
					'field' => 'id',
					'terms' => explode( ',', $terms_job ),
					'operator' => 'IN',
				);
		} elseif ($terms_genre) {
			$settings_genre = array(
					'taxonomy' => 'public_agent_genre',
					'field' => 'id',
					'terms' => explode( ',', $terms_genre ),
					'operator' => 'IN',
				);
		} elseif ($terms_party) {
			$settings_party = array(
					'taxonomy' => 'public_agent_party',
					'field' => 'id',
					'terms' => explode( ',', $terms_party ),
					'operator' => 'IN',
				);
		} elseif ($terms_commission) {
			$settings_commission = array(
					'taxonomy' => 'public_agent_commission',
					'field' => 'id',
					'terms' => explode( ',', $terms_commission ),
					'operator' => 'IN',
				);
		} elseif ($terms_position) {
			$settings_position = array(
					'taxonomy' => 'public_agent_vote',
					'field' => 'id',
					'terms' => explode( ',', $terms_position ),
					'operator' => 'IN',
				);
		}



		if ( '' !== $include_categories )
			$args['tax_query'] = array(
				$settings_states,
				$settings_category,
				$settings_job,
				$settings_genre,
				$settings_party,
				$settings_commission,
				$settings_position
			);

		$the_query = new WP_Query( $args );

		// The Loop
		$aux = '';
		$aux2 ='';
		$button_url = "https://mail.google.com/mail?view=cm&tf=0&to=" . get_option('makepressure_more_emailsmails');
		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$aux = get_post_meta(  get_the_ID(), 'public_agent_email', true) ? get_post_meta(  get_the_ID(), 'public_agent_email', true):'';
				if ($aux) $aux2 .= $aux2 ? "," . $aux: $aux;
			}

			$button_url .= $aux2 . '&su=' . get_option('makepressure_email_title') . '&body=' . get_option('makepressure_email_body') ;
			/* Restore original Post Data */
			wp_reset_postdata();
		} else {
			// no posts found
		}

		// Nothing to output if neither Button Text nor Button URL defined
		if ( '' === $button_text && '' === $button_url ) {
			return;
		}

		$module_class = ET_Builder_Element::add_module_order_class( $module_class, $function_name );

		$module_class .= " et_pb_module et_pb_bg_layout_{$background_layout}";

		$output = sprintf(
			'<div class="et_pb_button_module_wrapper et_pb_module%8$s">
				<a class="et_pb_button%5$s%7$s"  target="_blank" href="%1$s"%3$s%4$s%6$s>%2$s</a>
			</div>',
			esc_url( $button_url ),
			'' !== $button_text ? esc_html( $button_text ) : esc_url( $button_url ),
			( 'on' === $url_new_window ? ' target="_blank"' : '' ),
			'' !== $custom_icon && 'on' === $button_custom ? sprintf(
				' data-icon="%1$s"',
				esc_attr( et_pb_process_font_icon( $custom_icon ) )
			) : '',
			'' !== $custom_icon && 'on' === $button_custom ? ' et_pb_custom_button_icon' : '',
			( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
			( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' ),
			'right' === $button_alignment || 'center' === $button_alignment ? sprintf( ' et_pb_button_alignment_%1$s', esc_attr( $button_alignment ) )  : ''
		);

		return $output;
	}
}
new ET_Builder_Module_Make_Pressure_Gmail_Button;

class ET_Builder_Module_Brazil_States_map extends ET_Builder_Module {
	function init() {
		$this->name = esc_html__( 'Mapa dos Estados (BP)', 'et_builder' );
		$this->slug = 'et_pb_map_bp';

		$this->whitelisted_fields = array(
			'background_layout',
			'text_orientation',
			'content_new',
			'admin_label',
			'module_id',
			'module_class',
			'max_width',
			'max_width_tablet',
			'max_width_phone',
		);

		$this->fields_defaults = array(
			'background_layout' => array( 'light' ),
			'text_orientation'  => array( 'left' ),
		);

		$this->main_css_element = '%%order_class%%';
		$this->advanced_options = array(
			'fonts' => array(
				'text'   => array(
					'label'    => esc_html__( 'Text', 'et_builder' ),
					'css'      => array(
						'line_height' => "{$this->main_css_element} p",
					),
				),
			),
			'background' => array(
				'settings' => array(
					'color' => 'alpha',
				),
			),
			'border' => array(),
			'custom_margin_padding' => array(
				'css' => array(
					'important' => 'all',
				),
			),
		);
	}

	function get_fields() {
		$fields = array(
			'background_layout' => array(
				'label'             => esc_html__( 'Text Color', 'et_builder' ),
				'type'              => 'select',
				'option_category'   => 'configuration',
				'options'           => array(
					'light' => esc_html__( 'Dark', 'et_builder' ),
					'dark'  => esc_html__( 'Light', 'et_builder' ),
				),
				'description'       => esc_html__( 'Here you can choose the value of your text. If you are working with a dark background, then your text should be set to light. If you are working with a light background, then your text should be dark.', 'et_builder' ),
			),
			'text_orientation' => array(
				'label'             => esc_html__( 'Text Orientation', 'et_builder' ),
				'type'              => 'select',
				'option_category'   => 'layout',
				'options'           => et_builder_get_text_orientation_options(),
				'description'       => esc_html__( 'This controls the how your text is aligned within the module.', 'et_builder' ),
			),
			'content_new' => array(
				'label'           => esc_html__( 'Content', 'et_builder' ),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Here you can create the content that will be used within the module.', 'et_builder' ),
			),
			'max_width' => array(
				'label'           => esc_html__( 'Max Width', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'layout',
				'mobile_options'  => true,
				'tab_slug'        => 'advanced',
				'validate_unit'   => true,
			),
			'max_width_tablet' => array(
				'type' => 'skip',
			),
			'max_width_phone' => array(
				'type' => 'skip',
			),
			'disabled_on' => array(
				'label'           => esc_html__( 'Disable on', 'et_builder' ),
				'type'            => 'multiple_checkboxes',
				'options'         => array(
					'phone'   => esc_html__( 'Phone', 'et_builder' ),
					'tablet'  => esc_html__( 'Tablet', 'et_builder' ),
					'desktop' => esc_html__( 'Desktop', 'et_builder' ),
				),
				'additional_att'  => 'disable_on',
				'option_category' => 'configuration',
				'description'     => esc_html__( 'This will disable the module on selected devices', 'et_builder' ),
			),
			'admin_label' => array(
				'label'       => esc_html__( 'Admin Label', 'et_builder' ),
				'type'        => 'text',
				'description' => esc_html__( 'This will change the label of the module in the builder for easy identification.', 'et_builder' ),
			),
			'module_id' => array(
				'label'           => esc_html__( 'CSS ID', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'tab_slug'        => 'custom_css',
				'option_class'    => 'et_pb_custom_css_regular',
			),
			'module_class' => array(
				'label'           => esc_html__( 'CSS Class', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'tab_slug'        => 'custom_css',
				'option_class'    => 'et_pb_custom_css_regular',
			),
		);
		return $fields;
	}

	function shortcode_callback( $atts, $content = null, $function_name ) {
		$module_id            = $this->shortcode_atts['module_id'];
		$module_class         = $this->shortcode_atts['module_class'];
		$background_layout    = $this->shortcode_atts['background_layout'];
		$text_orientation     = $this->shortcode_atts['text_orientation'];
		$max_width            = $this->shortcode_atts['max_width'];
		$max_width_tablet     = $this->shortcode_atts['max_width_tablet'];
		$max_width_phone      = $this->shortcode_atts['max_width_phone'];



		$base_page = get_page_by_path("estados");

		if (is_null($base_page)) {
			$content = '[et_pb_section admin_label="section"]
							[et_pb_row admin_label="Linha"]
									[et_pb_column type="4_4"]
										[et_pb_map_bp admin_label="Mapa dos Estados (BP)" background_layout="light" text_orientation="left" text_font_size_tablet="51" text_line_height_tablet="2" use_border_color="off" border_color="#ffffff" border_style="solid"]
									[/et_pb_map_bp]
								[/et_pb_column]
							[/et_pb_row]
						[/et_pb_section]';


			$postarr = array(
			  'post_title'    => "Estados",
			  'post_content'  => $content,
			  'post_status'   => 'publish',
			  'post_author'   => get_current_user_id(),
			  'post_type'	  => 'page',
			  'post_name'	  => 'estados'
			);
			$page_id = wp_insert_post( $postarr );
			if ($page_id) {

				update_post_meta($page_id, '_et_pb_post_hide_nav', 'default');
				update_post_meta($page_id, '_et_pb_page_layout', 'et_right_sidebar');
				update_post_meta($page_id, '_et_pb_side_nav', 'off');
				update_post_meta($page_id, '_et_pb_use_builder', 'on');

			}

		}
		$base_page = get_page_by_path("estados");

		//add pages
		$states = array(
			"Acre" => "ac",
			"Alagoas" => "al",
			"Amapá" => "ap",
			"Amazonas" => "am",
			"Bahia" => "ba",
			"Ceará" => "ce",
			"Distrito Federal" => "df",
			"Espírito Santo" => "es",
			"Goiás" => "go",
			"Maranhão" => "ma",
			"Mato Grosso" => "mt",
			"Mato Grosso do Sul" => "ms",
			"Minas Gerais" => "mg",
			"Pará" => "pa",
			"Paraíba" => "pb",
			"Paraná" => "pr",
			"Pernambuco" => "pe",
			"Piauí" => "pi",
			"Rio de Janeiro" => "rj",
			"Rio Grande do Norte" => "rn",
			"Rio Grande do Sul" => "rs",
			"Rondônia" => "ro",
			"Roraima" => "rr",
			"Santa Catarina" => "sc",
			"São Paulo" => "sp",
			"Sergipe" => "se",
			"Tocantins" => "to"
		);
		foreach ($states as $state => $state_abbreviation) {

			$page = get_page_by_path("estados/".$state_abbreviation);

			if( is_null($page) ){
				$term_id = get_term_by( 'slug', $state_abbreviation, 'public_agent_state' );
				$content = '[et_pb_section admin_label="section"]
								[et_pb_row admin_label="row"]
									[et_pb_column type="1_2"]
										[et_pb_makepressure_button admin_label="Super Pressão" include_categories="' . $term_id->term_id . '" url_new_window="off" button_text="Super Pressão" button_alignment="left" background_layout="light" custom_button="off" button_letter_spacing="0" button_use_icon="default" button_icon_placement="right" button_on_hover="on" button_letter_spacing_hover="0"] [/et_pb_makepressure_button]
									[/et_pb_column]
									[et_pb_column type="1_2"]
										[et_pb_makepressure_gmail_button admin_label="Super Pressão Gmail" include_categories="' . $term_id->term_id . '" url_new_window="off" button_text="Super Pressão Gmail" button_alignment="left" background_layout="light" custom_button="off" button_letter_spacing="0" button_use_icon="default" button_icon_placement="right" button_on_hover="on" button_letter_spacing_hover="0" /]
									[/et_pb_column]
								[/et_pb_row]
								[et_pb_row admin_label="Linha"]
									[et_pb_column type="4_4"]
										[et_pb_public_agent admin_label="Agente Público Grid" include_categories="' . $term_id->term_id . '" fullwidth="off" show_title="on" show_categories="on" show_pagination="on" background_layout="light" title_font_size_tablet="51" title_line_height_tablet="2" caption_font_size_tablet="51" caption_line_height_tablet="2" use_border_color="off" border_color="#ffffff" border_style="solid" posts_number="100" /]
									[/et_pb_column]
								[/et_pb_row]
							[/et_pb_section]';

				$postarr = array(
				  'post_title'    => $state,
				  'post_content'  => $content,
				  'post_status'   => 'publish',
				  'post_author'   => get_current_user_id(),
				  'post_type'	  => 'page',
				  'post_name'	  => $state_abbreviation
				);

				if (!is_null($base_page)) {
					//var_dump($base_page->ID);
					$postarr['post_parent'] = $base_page->ID;
				}

				$page_id = wp_insert_post( $postarr );
				if ($page_id) {

					update_post_meta($page_id, '_et_pb_post_hide_nav', 'default');
					update_post_meta($page_id, '_et_pb_page_layout', 'et_right_sidebar');
					update_post_meta($page_id, '_et_pb_side_nav', 'off');
					update_post_meta($page_id, '_et_pb_use_builder', 'on');

				}



			}

		}

		$module_class = ET_Builder_Element::add_module_order_class( $module_class, $function_name );

		$this->shortcode_content = et_builder_replace_code_content_entities( $this->shortcode_content );

		if ( '' !== $max_width_tablet || '' !== $max_width_phone || '' !== $max_width ) {
			$max_width_values = array(
				'desktop' => $max_width,
				'tablet'  => $max_width_tablet,
				'phone'   => $max_width_phone,
			);

			et_pb_generate_responsive_css( $max_width_values, '%%order_class%%', 'max-width', $function_name );
		}

		if ( is_rtl() && 'left' === $text_orientation ) {
			$text_orientation = 'right';
		}

		$class = " et_pb_module et_pb_bg_layout_{$background_layout} et_pb_map_bp_align_{$text_orientation}";

		$output = sprintf(
			'<div%3$s class="et_pb_map_bp%2$s%4$s">
				%1$s
			</div> <!-- .et_pb_map_bp -->',
			$this->shortcode_content,
			esc_attr( $class ),
			( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
			( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' )
		);

		$sudeste = "#f7d7e6";
		$norte = "#d7e6af";
		$centro_oeste = "#fff74c";
		$nordeste = "#ffe3a5";
		$sul = "#ded1ed";
		$contorno_estados = "#000";

		$output .= '<div id="mapa-brasil">';

			$output .= '<svg xml:space="preserve" enable-background="new 0 0 450 460" viewBox="0 0 450 460" height="100%" width="100%" y="0px" x="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg" id="svg-map" version="1.1"><g/>';

				$output .= '<a class="state-link" id="tooltip_TO" xlink:href="' . get_site_url() . '/to' .'" ><path stroke="' . $contorno_estados . '" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . $norte . '" d="M289.558,235.641c16.104,0.575,44.973-31.647,44.835-45.259c-0.136-13.612-17.227-58.446-22.349-66.088c-5.122-7.628-37.905,2.506-37.905,2.506S234.852,233.695,289.558,235.641z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 287.0137 188.3208)" style="cursor: pointer;">TO</text></a>';
				$output .= '<a class="state-link" id="tooltip_BA" xlink:href="' . get_site_url() . '/ba' .'"><path stroke="' . $contorno_estados . '" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . $nordeste . '" d="M313.276,197.775c2.084-2.739,3.506-7.012,6.464-8.764c1.641-0.973,3.232-4.684,4.271-5.163c2.304-1.014,12.161-25.143,20.706-22.513c1.095,0.342,29.881,3.478,32.153,7.532c2.246-0.506,17.582-8.804,25.829-4.999c9.172,4.246,11.225,20.679,11.2,20.843c0.107,0.328-0.823,5.765-0.985,5.929c-1.15,1-5.258-0.807-4.22,2.138c1.317,3.751,5.094,10.583,9.97,6.613c-3.669,6.574-6.846,16.022-13.966,17.747c-5.808,1.411-4.605,13.421-5.178,18.037c-0.465,3.75,0.192,8.448,1.014,12.117c1.148,4.959-0.821,8.6-1.808,13.42c-0.822,4.162-0.219,8.299-0.987,12.297c-0.271,1.286-4.407,5.723-5.559,7.148c-1.616-1.426-63.952-37.248-73.1-36.265c1.149-3.738,2.438-9.559-0.741-12.723c-8.625-8.572-0.135-19.335-0.162-19.432c-0.546-1.725-5.396-6.079-0.026-7.175c-3.175,0.959-1.944-4.027,0.875-3.012C316.726,200.733,314.044,200.527,313.276,197.775z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 359.7324 210.1221)" style="cursor: pointer;">BA</text></a>';
				$output .= '<a class="state-link" id="tooltip_SE" xlink:href="' . get_site_url() . '/se' .'"><path stroke="' . $contorno_estados . '" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . $nordeste . '" d="M408.561,191.735c0.521-1.505,2.465-0.725,3.533-0.794c2.273-0.164,0.494-2.738,1.095-3.778c2.026-3.793-2.738-5.999-1.998-10.408c4.024,1.931,9.448,3.397,12.408,6.89c1.343,1.533,5.504,2.656,5.832,4.847c-6.822,0.384-6.901,8.819-11.942,11.572C413.545,202.212,407.055,193.721,408.561,191.735z" style="cursor: pointer;"/><path class="circle" fill="' . $nordeste . '" d="M417.324,182.854c6.214,0,11.266,5.035,11.266,11.262c0,6.208-5.052,11.261-11.266,11.261c-6.238,0-11.258-5.053-11.258-11.261C406.063,187.89,411.084,182.854,417.324,182.854z"/><text fill="#000000" transform="matrix(1 0 0 1 408.9121 198.6689)" style="cursor: pointer;">SE</text></a>';
				$output .= '<a class="state-link" id="tooltip_PE" xlink:href="' . get_site_url() . '/pe' .'"><path stroke="' . $contorno_estados . '" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . $nordeste . '" d="M373.011,167.238c2.709-0.795,6.218-14.106,8.325-15.106c4.136-1.986,17.255-1.437,17.8,4.903c-0.437-0.068,8.189-2.273,7.479-1.466c1.7-0.711,10.518-4.723,12.599-4.82c0.274-0.013,4.603,0.905,3.068,2.315c-0.464,0.439,4.219,3.698,10.789,3.45c4.66-0.176,5.179-3.436,8.627-4.409c5.89-1.67,4.737,3.698,5.589,6.943c-1.182,2.684-1.646,5.586-2.74,8.285c-1.533,3.792-9.804,9.791-13.39,12.119c-7.287,4.778-21.802-4.067-22.762-5.67c-0.602-0.985-2.55-5.121-3.178-5.107c-0.629,0.356-1.04,0.861-1.287,1.519c-0.904-0.013-7.256-3.533-7.502-4.655c-4.769-1.151-5.425,6.108-8.957,6.19c0.219,0.108-8.244,6.681-7.506,3.314C383.556,170.4,374.241,168.566,373.011,167.238z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 401.3984 165.8003)" style="cursor: pointer;">PE</text></a>';
				$output .= '<a class="state-link" id="tooltip_AL" xlink:href="' . get_site_url() . '/al' .'"><path stroke="' . $contorno_estados . '" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . $nordeste . '" d="M413.953,169.018c3.78,3.313,9.424,5.505,12.547,5.491c3.229-0.013,5.009-3.328,7.421-4.794c1.177-0.712,10.297-1.93,9.174,1.042c-1.807,4.848-7.122,8.585-10.024,12.789c-2.792,2-3.423,7.093-6.354,1.864c-3.259,0.424-3.722-4.424-6.957-4.477c-3.668-2.261-7.998-3.769-11.201-6.342C410.615,172.646,412.751,171.359,413.953,169.018z" style="cursor: pointer;"/><path class="circle" fill="' . $nordeste . '" d="M436.423,168.763c6.236,0,11.258,5.054,11.258,11.278c0,6.207-5.02,11.259-11.258,11.259c-6.241,0-11.263-5.052-11.263-11.259C425.16,173.816,430.182,168.763,436.423,168.763z"/><text fill="#000000" transform="matrix(1 0 0 1 429.7891 183.895)" style="cursor: pointer;">AL</text></a>';
				$output .= '<a class="state-link" id="tooltip_RN" xlink:href="' . get_site_url() . '/rn' .'"><path stroke="' . $contorno_estados . '" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . $nordeste . '" d="M404.698,138.795c2.383-4.027,6.574-6.123,8.49-11.149c1.973-5.107,3.834-5.818,8.764-4.642c5.041,1.207,9.339,0.837,14.57,1.671c7.534,1.193,6.848,10.968,9.206,16.516c-1.919,1.096-13.972,0.521-15.064-1.657c-1.041-2.067-2.904,7.107-5.094,7.3c1.532-5.847-12.654,1.78-5.424-8.683c2.545-3.67-6.302-0.808-6.711,0.725C410.121,144.013,407.217,139.151,404.698,138.795z" style="cursor: pointer;"/><path class="circle" fill="' . $nordeste . '" d="M430.827,107.798c6.241,0,11.261,5.039,11.261,11.261c0,6.224-5.02,11.261-11.261,11.261c-6.209,0-11.26-5.037-11.26-11.261C419.567,112.837,424.618,107.798,430.827,107.798z"/><text fill="#000000" transform="matrix(1 0 0 1 422.541 123.9009)" style="cursor: pointer;">RN</text></a>';
				$output .= '<a class="state-link" id="tooltip_CE" xlink:href="' . get_site_url() . '/ce' .'"><path stroke="' . $contorno_estados . '" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . $nordeste . '" d="M372.379,104.409c0.437-1.368,2.961-3.627,1.043-5.025c12.106-1.328,17.581-0.849,27.66,6.723c4.026,3.054,6.822,5.574,10.571,9.147c1.317,1.273,7.614,4.313,7.914,6.164c-0.054-0.316-5.396,3.696-5.997,5.217c-1.066,2.684-2.659,6.093-4.3,8.298c0.025-0.055-6.903,3.957-3.532,4.217c-4.41,3.821-1.015,8.135-0.797,11.517c0.196,2.767-4.38,7.587-6.765,5.422c-2.244-1.999-3.998-5.711-7.779-5.094c-1.998,0.329-5.476,2.189-7.612,0.479c-2.52-2.054,3.669-5.162-0.545-7.354c-6.987-3.615-1.264-15.393-6.684-20.239c-3.504-3.136,1.753-7.313,0.109-10.749C374.952,111.68,373.694,105.244,372.379,104.409C373.035,102.314,374.815,105.971,372.379,104.409z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 386.8379 129.0347)" style="cursor: pointer;">CE</text></a>';
				$output .= '<a class="state-link" id="tooltip_PI" xlink:href="' . get_site_url() . '/pi' .'"><path stroke="' . $contorno_estados . '" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . $nordeste . '" d="M320.781,185.478c2.465-5.149-7.505-20.801-7.505-20.801s47.354-65.868,54.285-66.841c0.299-0.042,6.243,1.768,6.463,2.219c0.438,0.863-0.821,5.244-0.685,6.587c0.275,2.629,2.879,6.587,2.328,8.684c-1.15,4.736-1.863,6.134,1.369,9.901c2.794,3.245,0.325,10.16,2.544,14.269c-1.778,4.23,4.768,3.656,3.943,7.613c-0.655,3.163-5.424,7.655-1.176,10.312c0.274,4.642-4.685,4.983-6.79,7.818c-2.631,2.835-5.535,5.013-7.999,7.888c-0.55,0.671-8.821,4.096-9.998,4.082c0.302-0.301-17.665-6.449-11.967,2.354c2.463,3.808-1.505,5.56-3.177,8.778c-0.633,2.164-5.836,0.958-7.836,3.205C328.176,198.748,327.409,180.727,320.781,185.478z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 355.127 158.1045)" style="cursor: pointer;">PI</text></a>';
				$output .= '<a class="state-link" id="tooltip_MA" xlink:href="' . get_site_url() . '/ma' .'"><path stroke="' . $contorno_estados . '" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . $nordeste . '" d="M288.845,127.827c4.108-2.726,31.195-48.985,31.386-50.395c1.235,0.397,6.084,7.435,7.562,5.025c0.493,0.013-0.328,2.15-0.547,2.396c-0.054-0.135,2.189-2.286,2.52-2.436c0.521-0.233,1.948,1.903,3.451-0.726c5.642,1.575,1.314,14.31,9.121,11.694c-1.147,0.384,1.452,0.74,0.848,1.905c5.095-6.587,8.488-0.027,15.337,1.491c2.025,0.466,6.243,0.575,8.162,0.207c3.808-0.823-2.082,6.847-2.082,6.887c-1.369,2.986-5.041,1.713-6.818,5.683c-0.684,1.549-3.506,4.327-3.042,6.148c0.494,1.781,2.081,2.863,0.274,4.629c0.603,2.793,3.066,7.109-0.385,9.12c-4.601,4.383,2.304,7.52,1.316,11.598c-0.9,3.726-6.244,5.725-9.147,2.78c-4.847-0.11-6.872,3.821-10.406,6.45c-2.74,2.041-8.793,2.493-10.327,5.642c-1.918,3.929-3.699,8.763-5.341,12.79c-1.699,4.204,6.383,18.762-4.328,15.611c-0.932-0.273-3.396-4.725-3.396-5.738c-0.081-3.739-2.738-4.176-4.821-7.477c0.356-3.025,2.466-6.929,4.766-8.052c3.342-1.63,1.919-6.629-2.466-4.465c-3.505,1.726-4.709-2.794-6.958-5.287c0.548,0.59-3.064-4.696-3.146-3.697c0.19-1.89,2.876-5.833,3.341-8.448c0.575-3.259,0.52-6.764-0.521-10.105c-0.63-2.068-4.656-4.521-6.518-4.437c-1.289,0.287-2.443,0-3.427-0.878C290.983,125.675,290.983,128.044,288.845,127.827z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 318.2754 126.7036)" style="cursor: pointer;">MA</text></a>';
				$output .= '<a class="state-link" id="tooltip_AP" xlink:href="' . get_site_url() . '/ap' .'"><path stroke="' . $contorno_estados . '" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . $norte . '" d="M225.198,39.089c3.274,1.165,3.985-1.315,6.572-1.74c3.616-0.603,5.683,2.725,9.037,2.067c4.055-0.78,7.093-8.025,7.314-11.598c4.492-3.534,5.503-11.258,9.42-14.68c6.055,4.258,6.11,15.788,7.589,22.485c-0.164,0.083,6.57,7.998,7.944,8.682c3.396,1.657,3.366,6.203,0.078,9.34c-3.777,3.587-7.449,34.275-7.449,34.275h-46.489c0,0,0.932-50.366,0-51.449C221.814,36.458,223.334,38.417,225.198,39.089z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 245.9023 52.6099)" style="cursor: pointer;">AP</text></a>';
				$output .= '<a class="state-link" id="tooltip_PA" xlink:href="' . get_site_url() . '/pa' .'"><path stroke="' . $contorno_estados . '" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . $norte . '" d="M173.378,50.619c2.259,2.63,5.629-4.478,7.901-3.82c3.19,0.918,1.478-1.108,5.026-1.752c1.931,0.806,3.096,0.273,3.519-1.631c0.535-1.26,1.453-1.726,2.725-1.384c1.768-1.684,13.558,3.603,14.68,0.384c0.629-1.821-4.287-5.709-0.302-6.997c1.643-0.533,6.012,0.808,8.75-0.068c3.986-1.288,4.876,2.684,4.382,6.066c0.631,3.587,13.145,5.766,12.982,7.97c3.589-1.518,5.354,12.763,7.105,14.447c0.357,4.26,6.304,8.585,7.07,12.544c0.628,3.396,7.065,3.616,8.213,0.095c2.578-8.133,9.696-10.022,13.475-16.651c4.603-8.038,3.725,3.752,8.955,1.067c2.11,0.411,2.876,3.629,4.574,4.724c3.18,2.027,7.779,0.974,10.572,3.013c-4.192,4.382,8.188,3.752,9.231,3.875c4.682,0.575,8.104,2.383,11.855,3.629c-0.164-0.069,4.792,0.52,5.178,1.245c2.026,3.767-4.904,19.214-6.382,21.486c-1.121,1.713-2.932,4.985-3.727,6.834c-0.902,2.026-4.764,7.313-4.655,9.229c-1.888,0.972-2.248,4.835-5.012,4.328c-3.096,3.026-8.187,4.999-10.27,8.956c2.057,0.781,8.325,1.041,5.311,4.272c-0.821,0.877-1.094,5.533-1.615,6.833c-0.575,1.384-4.464,4.779-6.108,5.34c-4.107,1.426-2.736,4.135-4.271,7.655c-0.933,2.054-0.546,3.491,1.756,4.339c-0.083,2.835-0.988,5.575-2.385,7.998c-3.041,5.245-9.009,9.818-10.079,16.27c-3.261,3.408-87.066-1.22-87.464-2.644c-1.423-5.012,1.508-24.006-2.808-27.88c-0.19-2.082-29.893-6.299-30.714-8.081C150.016,140.479,173.173,58.561,173.378,50.619z M319.139,77.664C319.302,76.912,319.74,78.76,319.139,77.664z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 232.7725 122.5137)" style="cursor: pointer;">PA</text></a>';
				$output .= '<a class="state-link" id="tooltip_RR" xlink:href="' . get_site_url() . '/rr' .'"><path stroke="' . $contorno_estados . '" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . $norte . '" d="M113.18,24.107c-0.972-2.753-7.861-5.889-6.999-8.984c0.068-0.232,13.229,6.053,12.79,2.808c0.398,1.329,1.219,1.889,2.439,1.685c1.889-1.301,7.148,4.204,8.216,1.889c0.438-0.959-1.657-3.753,0.74-3.848c1.026,0.438,1.534,0.164,1.52-0.822c0.835-1.752,3.575,0.219,4.793,0.083c0.767-1.056,10.625-3.026,9.037-5.094c1.37,0.438,4.574,0.808,4.63-1.547c4.546-2.054,1.15-4.409,2.644-6.354c2.177-2.82,9.791,0.809,7.327,5.738c-1.972,3.93,7.121,4.027,5.724,9.366c-0.452,1.686-2.479,2.724-3.423,3.971c-1.179,1.546-1.836,9.243-1.356,11.53c1.041,4.889,3.231,8.695,6.134,12.16c1.712,2.027,5.614,2.261,5.724,4.369c0.164,2.945,1.165,6.177,0.329,9.092c-1.547,5.424-36.618,30.471-36.618,30.471s-12.517-52.736-20.335-54.063C115.261,36.417,111.523,25.682,113.18,24.107z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 136.2939 42.3862)" style="cursor: pointer;">RR</text></a>';
				$output .= '<a class="state-link" id="tooltip_AM" xlink:href="' . get_site_url() . '/am' .'"><path stroke="' . $contorno_estados . '" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . $norte . '" d="M10.078,136.412c1.15-4.972,4.258-10.394,8.215-13.105c4.41-3.027,7.656-5.71,13.105-6.082c2.165-0.149,10.216-5.75,11.983-2.984c3.711,5.765,4.998-3.739,5.574-7.025c1.726-9.667,3.697-19.322,4.86-29.086c-0.342-1.356-2.013-6.231-2.833-7.163c-1.453-1.616-4.287-2.122-4.768-4.544c-0.272-1.452-0.574-7.258,1.109-8.121c3.494-1.768,6.547-0.042,9.737-0.89c-2.561-4.053,0.302-4.327-5.532-5.135c-3.438-0.466-3.971-2.466-2.738-6.368c1.053-3.3,15.898-1,19.088-1.396c-1.534,0.178-1.11-2.479-0.042-2.616c1.274-0.165,1.576,2.684,3.165,0.998c1.286-1.395,3.189-2.915,4.6-3.751c2.438-1.45,4.533,8.217,4.465,9.833c-0.041,0.78-0.137,2.438,1.177,2.246c3.012-0.466,4.219,2.849,7.273,4.231c3.778,1.713,3.929-1.355,7.023-2.068c4.301-0.985,0.711,3.396,2.383,3.793c1.589,0.385,3.806-4.969,4.821-5.572c0.93-0.533,3.725-0.753,4.846-1.602c3.013-2.245,1.933-1.686,3.492-1.206c3.478,1.041,2.233-8.367,6.491-7.066c1.822-0.466,3.643-2.34,5.533-2.423c1.041-0.043,6.066,2.287,6.544,3.147c0.589,1.465,0.316,2.795-0.793,3.986c1.575,1.425,2.698,3.149,3.355,5.162c0.904,2.862-1.286,6.807,0.588,9.299c-0.22,6.655,4.808,7.887-0.396,12.597c0.192-0.178,6.711,7.067,7.121,8.039c0.971-0.711,4.066,0.849,4.381,1.535c-1.658-3.629,0.547-17.09,6.628-10.915c7.203,7.327,5.491-3.615,9.148-8.627c2.834-3.875,14.597-3.136,14.077,3.246c-1.082,3.273,6.271,14.256,9.667,11.436c2.26,5.737,6.889,4.285,10.407,8.051c5.094,5.464,4.37,3.396,11.313,2.848c-2.259,3.602-3.425,4.808-5.272,8.86c-3.149,6.862-6.15,13.776-9.204,20.678c-2.437,5.505-14.843,23.471-11.105,28.442c4.806,6.395,9.339,30.183,11.324,29.934c-6.162-0.26-48.079-10.625-51.652-8.105c-1.453,1.013-53.626,10.503-55.9,10.819c-6.369,0.875-18.09-7.272-23.719-10.136c-8.601-4.381-16.61-8.981-26.088-11.05c-10.282-2.259-20.635-4.793-29.878-10.011C4.121,145.766,12.433,144.779,10.078,136.412z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 98.1406 119.0591)" style="cursor: pointer;">AM</text></a>';
				$output .= '<a class="state-link" id="tooltip_AC" xlink:href="' . get_site_url() . '/ac' .'"><path stroke="' . $contorno_estados . '" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . $norte . '" d="M3.656,148.545c12.557,7.544,27.524,8.367,41.082,13.2c12.802,8.065,27.278,12.845,40.616,19.872c-2.834,1.205-7.587,4.382-9.983,6.395c-2.93,2.45-1.3,2.04-4.628,1.957c-2.93-0.069-3.957,4.615-7.203,5.259c-2.999,0.603-7.161-1.958-10.995-1.697c-1.905,0.136-11.969-0.056-12.64,0.603c0.313-3.642-0.385-7.299-0.165-10.941c0.096-1.439,1.998-6.533,1.245-7.451c-6.82,3.149-8.339,7.19-16.733,7.013c-2.136-0.042-2.562-2.492-3.081-4.001c-1.247-3.572-7.218-3.422-10.559-3.778c6.299-3.41-3.107-11.9-5.216-15.679c-0.52-0.918-3.588-4.655-3.629-5.957C1.642,150.174,6.612,151.968,3.656,148.545z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 47.7017 184.9355)" style="cursor: pointer;">AC</text></a>';
				$output .= '<a class="state-link" id="tooltip_RO" xlink:href="' . get_site_url() . '/ro' .'"><path stroke="' . $contorno_estados . '" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . $norte . '" d="M83.34,180.232c0.931-1.574,5.341-4.668,6.312-4.656c1.355-0.067,2.671,0.138,3.958,0.603c3.012,1.44,2.039-1.135,5.341-0.123c-1.274-2.287,3.793-2.943,2.86-0.315c3.068,0.247,2.725-4.683,6.668-5.12c4.438-0.508,5.054-0.646,7.122-4.534c0.135-0.246,2.628-5.519,2.752-5.025c2.191-6.491,14.585-0.878,15.638,3.355c0.397,1.615,1.834,3.137,3.642,4.369c1.246,0.862,6.327-3.999,6.134,1.314c-0.78,1.274,26.663,7.656,30.005,19.282c3.82,13.338-16.421,32.167-18.173,34.043c-4.464,1.191-2.039,1.726-6.6,0.15c-2.574-0.875-6.422,0.986-9.08,0.289c-2.409-0.645-3.041-3.957-5.86-4.683c-3.055-0.78-5.423-1.795-7.654-3.93c-4.041-3.876-8.983-2.645-14.475-3.808c-1.835-0.083-6.053-6.779-7.874-5.327c-1.821-0.438-5.381-9.094-3.397-11.204c0.124-1.67-0.26-3.204-1.163-4.627c-0.986-2.644,1.041-5.026,0.863-7.806c-0.384-6.081-1.028-1.986-3.382-1.903C94.336,180.686,85.957,181.671,83.34,180.232z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 118.1299 195.3193)" style="cursor: pointer;">RO</text></a>';
				$output .= '<a class="state-link" id="tooltip_MT" xlink:href="' . get_site_url() . '/mt' .'"><path stroke="' . $contorno_estados . '" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . $centro_oeste . '" d="M142.237,173.962c4-0.316-1.888-6.452,5-5.738c7.914,0.808,16.295,0.328,24.279,0.218c1.629-0.013,8.902,1.288,7.395-1.833c-1.192-2.453,1.821-6.425,0.425-9.725c2.027-0.864,1.289-3.807,2.629-5.107c1.151-1.123,4.176,7.244,4.436,7.819c1.097,2.451,0.398,5.478,1.932,7.654c1.41,1.987,4.574,2.136,5.889,4.259c3.136,5.136,10.845,4.137,17.13,4.657c20.159,1.656,40.356,2.669,60.486,4.752c-3.48,7.763-3.999,14.912-5.122,22.552c-0.437,2.972,1.863,7.163-0.056,10.065c1.945,1.287,1.346,2.753,1.424,4.409c1.151,25.129-20.429,60.186-33.548,58.569c-10.914-1.369-45.3,0.058-46.928-3.396c-1.165-3.944-6.136-2.658-8.395-6.603c-2.301-4.051,0.684-6.299,0.737-10.242c-6.997,0.603-14.09-0.384-21.102-0.324c0.793-5.016-3.725-9.288-2.929-13.809c0.519-3.025,2.726-2.916,0.932-6.79c-1.206-2.589-0.261-4.247-0.699-6.382c-0.289-1.385-1.042-1.876-2.124-2.424c-2.931-1.493,1.246-2.48,2.056-3.644c1.726-2.465,3.299-11.394,6.545-11.612c1.219-1.999-1.781-3.643-1.465-5.56c-3.902-3.588,0.506-4.643,0.369-7.984c-0.151-3.627-9.654-3.944-12.256-3.751c-1.821,0.137-4.109,0.562-5.888-0.094c0.493-3.521-0.521-6.054-0.535-9.217c-0.014-2.286,1.288-5.177,0.835-7.45C143.581,176.618,141.937,174.714,142.237,173.962z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 200.0244 218.4175)" style="cursor: pointer;">MT</text></a>';
				$output .= '<a class="state-link" id="tooltip_MS" xlink:href="' . get_site_url() . '/ms' .'"><path stroke="' . $contorno_estados . '" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . $centro_oeste . '" d="M183.198,294.536c2.136-4.464,3.177-9.394,5.312-13.61c1.712-3.344-4.067-7.587-2.423-9.807c0.027-0.026,2.738,3.641,3.917,3.725c3.204-1.534,4.807-2.272,6.984-5.228c2.615-3.59,10.832-3.014,14.051-0.305c1.259,1.041,3.068,2.107,4.668,2.574c3.163,0.934,5.889-3.013,8.559-0.873c3.724,2.982,4.626-1.862,7.86-3.509c1.945-1.012-1.768,8.465-2.244,7.781c2.463,0.959,4.285,0.901,6.82,0.959c3.504,0.081,1.805,1.205,2.436,3.339c0.466,1.564,28.948-5.997,29.416,0.578c0.302,3.837-0.987,61.813-0.987,61.813s-39.532,5.533-41.602,5.286c-3.889-0.492-3.587-3.231-8.063-0.933c-2.028,0.329-6.012,1.205-5.177-2.409c-2.013-4.354-0.111-14.625-4.849-17.088c-1.206-0.659-7.092-2.36-7.504-1.945c-1.699,1.777-3.739,1.562-6.121,1.121c-2.904,0.027-5.629-1.614-8.243-1.203c-4.178,0.656-0.603-2.986-1.645-3.535c0.932-2.847,1.411-9.912,0.453-11.856c-0.165-0.331-3.52-7.232-2.547-8.108C186.306,297.688,182.334,299.415,183.198,294.536z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 213.2939 306.7236)" style="cursor: pointer;">MS</text></a>';
				$output .= '<a class="state-link" id="tooltip_GO" xlink:href="' . get_site_url() . '/go' .'"><path stroke="' . $contorno_estados . '" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . $centro_oeste . '" d="M237.768,270.519c0.628-2.904,1.835-7.396,4.709-8.766c1.015-1.644,1.754-5.147,2.275-5.586c2.408-2.247,3.889-3.783,6.63-4.656c3.723-1.205,3.338-5.342,4.846-8.165c1.504-2.845,4.736-1.15,5.942-3.382c1.479-2.834,0.741-6.161,2.189-8.874c2.902-5.531,1.862-17.363,8.656-20.567c-4.878,7.641,3.698,4.971,7.201,9.449c2.273,1.738,2.164-1.822,2.71-3.055c1.618-3.533,2.878,2.247,4.52-1.533c0.413,0.37,4.136,5.765,3.427,5.601c-0.029-0.931,0.326-1.408,1.037-1.438c0.108,0.534,0.274,1.013,0.602,1.452c-0.602-0.261,9.697-0.095,8.82,1.534c0.36-0.657-0.602-3.11,0.221-3.438c1.039-0.411,3.971,1.368,6.351,0.438c1.045-0.397,7.889-2.807,7.671-3.683c0.767,0.905,1.262,2.67,2.85,1.286c-2.632,2.274-2.576,4.466,1.258,3.821c-1.861,1.438-2.846,4.341-2.382,6.547c0.357,1.643,3.752,5.973,3.478,6.751c-1.78,0.315,0.602,5.438-2.325,6.078c-3.181,0.701-3.973-5.53-4.3,0.688c-0.164,1.48-1.097,1.67-2.768,0.576c-3.288,0.327-0.549,2.19-1.121,3.888c-0.988,2.902,2.792,6.437-2.411,6.764c-3.586,0.219-2.682,1.341-2.682-2.739c-0.028-4.573-12.054-3.643-10.218,0.521c-4.901,6.355,12.05-0.326,9.668,6.355c-1.313,3.752,15.83,28.211,10.406,25.416c-1.944-0.986-50.804,10.271-49.982,12.105c-5.012-2.136-11.804-7.941-17.391-8.162c-0.438-2.189-3.618-1.284-5.095-1.533c-3.724-0.604,1.04-3.231,0.22-4.109c-1.89-1.916-4.382,1.756-3.588-3.012C239.602,274.627,237.055,273.038,237.768,270.519z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 266.9111 254.2139)" style="cursor: pointer;">GO</text></a>';
				$output .= '<a class="state-link" id="tooltip_PR" xlink:href="' . get_site_url() . '/pr' .'"><path stroke="' . $contorno_estados . '" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . $sul . '" d="M222.225,363.694c1.807-2.138,1.889-4.881,2.424-7.479c0.301-1.453,0.465-7.86,1.369-8.736c2.3-0.684,2.3-3.315,2.726-5.204c0.616-2.738,2.821-2.958,3.984-5.616c4.369-9.91,38.947-9.529,46.476-9.227c4.658,0.193,15.775,34.563,17.916,33.794c-1.728,2.19-5.754,8.929-8.41,8.984c-4.054,0.057-14.215,14.68-14.215,14.68s-37.329-12.05-40.287-11.285c-3.875-1.449-2.698-6.491-6.054-8.216C226.663,364.623,222.498,367.8,222.225,363.694z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 248.4453 356.1045)" style="cursor: pointer;">PR</text></a>';
				$output .= '<a class="state-link" id="tooltip_SC" xlink:href="' . get_site_url() . '/sc' .'"><path stroke="' . $contorno_estados . '" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . $sul . '" d="M231.029,383.959c1.669-3.338-0.284-10.516,4.573-10.569c6.631-0.109,13.639,3.559,20.402,3.888c1.317,0.055,5.231,2.163,4.357-1.15c-1.095-4.164,3.945-1.863,5.67-3.179c2.274-1.724,8.187-4.106,11.311-1.367c1.423,1.809,20.05-5.395,13.284,3.946c-1.368,1.395,0.713,10.789,0.466,10.734c-3.449,4.438,1.726,11.666-5.096,15.334c-2.901,1.536-7.284,7.779-9.64,9.995C276.085,411.866,233.534,382.918,231.029,383.959z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 266.9111 387.7646)" style="cursor: pointer;">SC</text></a>';
				$output .= '<a class="state-link" id="tooltip_RS" xlink:href="' . get_site_url() . '/rs' .'"><path stroke="' . $contorno_estados . '" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . $sul . '" d="M191.236,416.881c0.52-2.684,7.38-8.409,9.477-10.351c0.37-0.359,8.599-10.08,9.174-8.329c-1.301-3.89,2.781-1.589,3.917-4.819c0.26-0.521,7.04-4.821,7.109-4.795c1.436-0.191,6.721-3.695,7.421-3.257c1.204-2.028,8.927-1.479,8.653-0.824c1.165-0.38,2.284-0.877,3.326-1.479c0.221-0.821,22.459,7.533,24.319,11.531c2.523,5.34,12.217,2.822,13.15,5.563c0.106,0.275-5.809,9.339-3.89,9.173c-0.985,0.08,3.204-2.875,3.834,0.409c-2.793,3.619-4.6,7.834-6.571,11.944c-3.696,7.614-8.872,12.765-15.886,17.42c-7.394,4.902-7.339,11.941-13.257,17.693c-8.091,7.942-10.159-0.574-4.08-5.752c3.806-3.231-22.527-19.746-25.578-22.732c-1.918-1.862-2.384,0.274-4.219,1.15c-2.547,1.205-1.917-2.822-3.588-4.273c-2.3-1.999-4.793-5.479-7.737-6.68c-3.478-1.367-5.615,5.145-9.052,0.821C189.168,418.854,190.332,418.032,191.236,416.881z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 231.0313 414.4658)" style="cursor: pointer;">RS</text></a>';
				$output .= '<a class="state-link" id="tooltip_SP" xlink:href="' . get_site_url() . '/sp' .'"><path stroke="' . $contorno_estados . '" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . $sudeste . '" d="M239.3,330.554c3.26-4.356,9.56-5.039,11.531-10.792c1.369-3.942,3.889-8.818,6.135-13.036c1.561-2.957,7.749-7.121,10.517-8.65c0.383-0.196,32.974-6.138,42.234-1.701c20.265,9.724,26.017,33.879,27.854,33.304c4.408-1.425,5.34,3.778,2.106,4.49c-1.754,0.413-6.519,1.479-6.49,3.399c0.027,3.448,0.521,1.615-2.931,3.639c-2.189-1.42-3.34,4.111-4.763,3.426c-4.271-2.244-6.958,2.96-9.258,1.918c-4.271-1.918-16.98,13.092-19.638,15.336c0.245-0.218-1.148-1.479-1.587-2.685c-0.466-1.369-2.658,0.385-4.025,0.082c-0.986-0.192,1.751-4.079-2.303-4.52c-1.369-0.164-3.753,0.303-4.929,0.084c-2.903-0.547,0.108-2.41-0.439-3.862c-1.067-2.986-3.013-4.931-3.751-7.779c-0.52-1.945,0.165-7.531-3.615-7.395c-0.848-2.956-6.628-1.451-9.066-1.862c-0.162,0.163-8.846-2.684-10.079-2.684c-1.616-0.029-6.791-3.396-7.121-0.274C247.982,330.386,239.876,331.21,239.3,330.554z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 280.6816 327.3193)" style="cursor: pointer;">SP</text></a>';
				$output .= '<a class="state-link" id="tooltip_MG" xlink:href="' . get_site_url() . '/mg' .'"><path stroke="' . $contorno_estados . '" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . $sudeste . '" d="M262.881,297.305c-1.696-5.094,15.531-19.882,18.844-13.421c5.531-7.367,15.886,1.588,19.773-3.944c0.988-1.367,3.015-1.453,3.725-2.957c0.326-0.711-0.493-2.793-0.056-3.888c1.369-3.398-4.873-2.355-0.109-6.603c4.547-4.053-1.917-4.739-1.204-8.186c0.957-4.604,1.807-4.713,5.613-6.027c1.943-0.688,0.906-8.272,0.083-8.52c-0.108-2.699,1.974-2.546,3.782-1.617c2.188-0.135-0.276-3.695,0.957-4.243c-0.357,0.151,5.559,1.999,5.724,2.055c0.986,0.358-0.52,3.534-0.931,3.943c8.217-2.355,14.514-11.789,23.279-11.242c4.983,0.316-0.327,4.339,5.367,5.544c0.684,1.234,3.34-1.054,4.054-1.189c2.876-0.536,5.53,3.284,8.106,3.886c2.301,3.578,7.503,0.537,10.298,3.001c1.755,1.589,2.188,3.397,3.396,5.313c1.314,2.052,3.86-0.465,5.726-0.109c3.257,0.656,6.326,2.026,9.338,3.723c2.19,1.205,0.768,3.179-0.548,4.573c-0.765,0.796-3.259,6.165-2.627,5.643c-2.138,1.781-2.628-1.669-3.397,2.764c-0.628,3.674,0.164,4.714,3.149,7.015c4.901,3.229-6.765,3.12-6.71,3.504c0.22,0.601-2.846,41.96-3.835,42.179c-6.737,1.562-14.513,5.311-21.744,7.012c-12.736,2.985-24.295,3.778-29.471,4.656c0,1.452-5.367,6.872-8.518,1.259c0,0-3.041-7.285-2.821-7.229c0.105-0.027,2.138-5.506,2.244-6.137c0.768-3.504-5.042-0.765-5.749-2.188c-0.878-1.81-2.358-4.576-2.166-6.628c1.699-1.205,1.672-2.383-0.08-3.562c-1.04-1.095-1.205-2.303-0.521-3.672c-2.329-1.424-3.065-2.683-5.698-2.462c-1.479,0.138-4.055,3.668-5.506,0.629c0.878,2.108-4.188,0.769-5.094,1.56c-2.354-1.202-1.779,2.028-2.384,3.069c-0.137,0.22-1.014-2.904-1.065-2.961c-1.149-1.175-2.767,4.165-3.505-0.055c0.766-4.105-4.657-2.709-7.67-2.93c-4.708-0.353-5.53-1.613-9.858,0.631C262.993,300.562,262.336,299.274,262.881,297.305z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 328.4063 286.4561)" style="cursor: pointer;">MG</text></a>';
				$output .= '<a class="state-link" id="tooltip_RJ" xlink:href="' . get_site_url() . '/rj' .'"><path stroke="' . $contorno_estados . '" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . $sudeste . '" d="M332.886,337.429c-1.26-2.768,8.409-4.795,7.89-6.71c-3.177-1.864-4.602,1.148-6.63-2.959c4.274-0.686,9.533-4.49,13.831-3.562c0.548-0.219,4.902-1.753,4.96,0.167c2.546-1.566,5.479-2.412,8.105-3.837c2.246-1.206,0.932-8.218,3.725-9.643c6.054-3.123,1.398,1.836,7.066,2.959c5.888,1.205,5.395,1.48,5.641,7.067c0.247,5.642-8.763,4.381-11.063,8.764c-1.039,1.999,1.698,5.368-3.368,4.903c-4.188-0.413-10.628,2.355-9.285-3.18c-1.039-0.08-1.861,0.301-2.464,1.124c0,0,0.105,2.767-0.74,2.741c-0.766-0.056-7.643,1.094-7.449,0.463c1.398-0.359,2.708-0.684,4.135-0.794c-1.667-0.713-2.957-1.839-4.901-0.142c0.465,0.195-4.227-0.086-3.379-0.113c-0.521,1.727-3.814,0.699-3.879,3.045C336.717,337.908,333.927,342.41,332.886,337.429z" style="cursor: pointer;"/><path class="circle" fill="' . $sudeste . '" d="M355.094,318.613c6.209,0,11.263,5.021,11.263,11.259c0,6.208-5.056,11.264-11.263,11.264c-6.211,0-11.263-5.054-11.263-11.264C343.831,323.634,348.883,318.613,355.094,318.613z"/><text fill="#000000" transform="matrix(1 0 0 1 347.4648 334.6807)" style="cursor: pointer;">RJ</text></a>';
				$output .= '<a class="state-link" id="tooltip_ES" xlink:href="' . get_site_url() . '/es' .'"><path stroke="' . $contorno_estados . '" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . $sudeste . '" d="M367.119,308.834c1.044-1.999-0.298-5.451,1.841-6.326c3.697-1.453,3.858-0.467,5.941-4.49c0.767-1.563,3.999-5.807,2.848-7.835c-0.439-0.765-3.204-3.613-3.286-4.05c1.04-0.249,2.079-0.219,3.123,0.054c1.366-0.654-6.465-10.519,2.137-8.054c-1.204-0.655-1.535-1.365-0.932-2.135c4.358-0.138,13.856,0.027,12.845,6.738c-0.577,3.835,0.933,8.079-0.577,11.804c-0.218,0.576-5.861,8.954-5.831,8.954c0.985,3.289-5.18,5.808-6.054,8.165c-1.313,3.56-2.135,3.013-5.614,2.573c-1.64-0.274-3.202-0.768-4.736-1.451C368.819,311.297,369.424,309.055,367.119,308.834z" style="cursor: pointer;"/><path class="circle" fill="' . $sudeste . '" d="M381.917,284.723c6.21,0,11.261,5.055,11.261,11.262c0,6.212-5.051,11.261-11.261,11.261c-6.212,0-11.263-5.049-11.263-11.261C370.654,289.777,375.705,284.723,381.917,284.723z"/><text fill="#000000" transform="matrix(1 0 0 1 373.3047 300.4971)" style="cursor: pointer;">ES</text></a>';
				$output .= '<a class="state-link" id="tooltip_DF" xlink:href="' . get_site_url() . '/df' .'"><path stroke="' . $contorno_estados . '" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . $centro_oeste . '" d="M292.461,246.197c0,0,12.929-2.903,14.188,0c1.233,2.903,0.659,10.683-1.424,11.504c-2.08,0.849-14.296-1.806-14.023-3.313C291.503,252.853,292.461,246.197,292.461,246.197z" style="cursor: pointer;"/><path class="circle" fill="' . $centro_oeste . '" d="M300.735,238.34c6.212,0,11.26,5.035,11.26,11.258c0,6.21-5.048,11.263-11.26,11.263c-6.209,0-11.261-5.053-11.261-11.263C289.475,243.377,294.523,238.34,300.735,238.34z"/><text fill="#000000" transform="matrix(1 0 0 1 292.4141 254.2139)" style="cursor: pointer;">DF</text></a>';
				$output .= '<a class="state-link" id="tooltip_PB" xlink:href="' . get_site_url() . '/pb' .'"><path stroke="' . $contorno_estados . '" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . $nordeste . '" d="M401.575,141.096c2.081-3.081,16.791-6.82,19.117-4.616c0,1.918,7.259,1.686,10.133,2.712c-0.492,3.038,12.652,1.533,14.408,2.259c1.421,0.589,3.833,11.983,1.421,12.202c-0.874-1.124-2.083-1.739-3.586-1.835c-2.957-0.027-2.546,1.863-4.383,3.108c-2.626,1.767-6.571,1.917-9.558,2.109c-0.162,1.232-3.943,4.438-5.259,4.916c-3.122,1.149-2.657-2.727-5.095-3.602c0.713-1.124,4.082-5.203,3.725-6.205c-1.423-3.846-12.051,5.52-14.981,3.506c-1.396-0.973-6.218,1.493-3.476-2.588C405.574,150.776,400.398,142.889,401.575,141.096z" style="cursor: pointer;"/><path class="circle" fill="' . $nordeste . '" d="M433.797,133.597c6.237,0,11.26,5.051,11.26,11.261c0,6.226-5.022,11.262-11.26,11.262c-6.208,0-11.257-5.036-11.257-11.262C422.54,138.647,427.589,133.597,433.797,133.597z"/><text fill="#000000" transform="matrix(1 0 0 1 425.2129 148.9893)" style="cursor: pointer;">PB</text></a>';
		    $output .= '</svg>';
		$output .= '</div>';

		return $output;
	}
}
new ET_Builder_Module_Brazil_States_map;

class ET_Builder_Module_Brazil_Party_map extends ET_Builder_Module {
	function init() {
		$this->name = esc_html__( 'Mapa dos Estados (BP)', 'et_builder' );
		$this->slug = 'et_pb_party_bp';

		$this->whitelisted_fields = array(
			'background_layout',
			'text_orientation',
			'content_new',
			'admin_label',
			'module_id',
			'module_class',
			'max_width',
			'max_width_tablet',
			'max_width_phone',
		);

		$this->fields_defaults = array(
			'background_layout' => array( 'light' ),
			'text_orientation'  => array( 'left' ),
		);

		$this->main_css_element = '%%order_class%%';
		$this->advanced_options = array(
			'fonts' => array(
				'text'   => array(
					'label'    => esc_html__( 'Text', 'et_builder' ),
					'css'      => array(
						'line_height' => "{$this->main_css_element} p",
					),
				),
			),
			'background' => array(
				'settings' => array(
					'color' => 'alpha',
				),
			),
			'border' => array(),
			'custom_margin_padding' => array(
				'css' => array(
					'important' => 'all',
				),
			),
		);
	}

	function get_fields() {
		$fields = array(
			'background_layout' => array(
				'label'             => esc_html__( 'Text Color', 'et_builder' ),
				'type'              => 'select',
				'option_category'   => 'configuration',
				'options'           => array(
					'light' => esc_html__( 'Dark', 'et_builder' ),
					'dark'  => esc_html__( 'Light', 'et_builder' ),
				),
				'description'       => esc_html__( 'Here you can choose the value of your text. If you are working with a dark background, then your text should be set to light. If you are working with a light background, then your text should be dark.', 'et_builder' ),
			),
			'text_orientation' => array(
				'label'             => esc_html__( 'Text Orientation', 'et_builder' ),
				'type'              => 'select',
				'option_category'   => 'layout',
				'options'           => et_builder_get_text_orientation_options(),
				'description'       => esc_html__( 'This controls the how your text is aligned within the module.', 'et_builder' ),
			),
			'content_new' => array(
				'label'           => esc_html__( 'Content', 'et_builder' ),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Here you can create the content that will be used within the module.', 'et_builder' ),
			),
			'max_width' => array(
				'label'           => esc_html__( 'Max Width', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'layout',
				'mobile_options'  => true,
				'tab_slug'        => 'advanced',
				'validate_unit'   => true,
			),
			'max_width_tablet' => array(
				'type' => 'skip',
			),
			'max_width_phone' => array(
				'type' => 'skip',
			),
			'disabled_on' => array(
				'label'           => esc_html__( 'Disable on', 'et_builder' ),
				'type'            => 'multiple_checkboxes',
				'options'         => array(
					'phone'   => esc_html__( 'Phone', 'et_builder' ),
					'tablet'  => esc_html__( 'Tablet', 'et_builder' ),
					'desktop' => esc_html__( 'Desktop', 'et_builder' ),
				),
				'additional_att'  => 'disable_on',
				'option_category' => 'configuration',
				'description'     => esc_html__( 'This will disable the module on selected devices', 'et_builder' ),
			),
			'admin_label' => array(
				'label'       => esc_html__( 'Admin Label', 'et_builder' ),
				'type'        => 'text',
				'description' => esc_html__( 'This will change the label of the module in the builder for easy identification.', 'et_builder' ),
			),
			'module_id' => array(
				'label'           => esc_html__( 'CSS ID', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'tab_slug'        => 'custom_css',
				'option_class'    => 'et_pb_custom_css_regular',
			),
			'module_class' => array(
				'label'           => esc_html__( 'CSS Class', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'tab_slug'        => 'custom_css',
				'option_class'    => 'et_pb_custom_css_regular',
			),
		);
		return $fields;
	}

	function shortcode_callback( $atts, $content = null, $function_name ) {
		$module_id            = $this->shortcode_atts['module_id'];
		$module_class         = $this->shortcode_atts['module_class'];
		$background_layout    = $this->shortcode_atts['background_layout'];
		$text_orientation     = $this->shortcode_atts['text_orientation'];
		$max_width            = $this->shortcode_atts['max_width'];
		$max_width_tablet     = $this->shortcode_atts['max_width_tablet'];
		$max_width_phone      = $this->shortcode_atts['max_width_phone'];



		$base_page = get_page_by_path("partidos");

		if (is_null($base_page)) {
			$content = '';


			$postarr = array(
			  'post_title'    => "Partidos",
			  'post_content'  => $content,
			  'post_status'   => 'publish',
			  'post_author'   => get_current_user_id(),
			  'post_type'	  => 'page',
			  'post_name'	  => 'partidos'
			);
			$page_id = wp_insert_post( $postarr );
			if ($page_id) {

				update_post_meta($page_id, '_et_pb_post_hide_nav', 'default');
				update_post_meta($page_id, '_et_pb_page_layout', 'et_right_sidebar');
				update_post_meta($page_id, '_et_pb_side_nav', 'off');
				update_post_meta($page_id, '_et_pb_use_builder', 'on');

			}

		}
		$base_page = get_page_by_path("estados");

		//add pages
		$states = array(
			'Acre' => 'ac',
			'Alagoas' => 'al',
			'Amapá' => 'ap',
			'Amazonas' => 'am',
			'Bahia' => 'ba',
			'Ceará' => 'ce',
			'Distrito Federal' => 'df',
			'Espírito Santo' => 'es',
			'Goiás' => 'go',
			'Maranhão' => 'ma',
			'Mato Grosso' => 'mt',
			'Mato Grosso do Sul' => 'ms',
			'Minas Gerais' => 'mg',
			'Pará' => 'pa',
			'Paraíba' => 'pb',
			'Paraná' => 'pr',
			'Pernambuco' => 'pe',
			'Piauí' => 'pi',
			'Rio de Janeiro' => 'rj',
			'Rio Grande do Norte' => 'rn',
			'Rio Grande do Sul' => 'rs',
			'Rondônia' => 'ro',
			'Roraima' => 'rr',
			'Santa Catarina' => 'sc',
			'São Paulo' => 'sp',
			'Sergipe' => 'se',
			'Tocantins' => 'to'
		);
		foreach ($states as $state => $state_abbreviation) {

			$page = get_page_by_path("estados/".$state_abbreviation);

			if( is_null($page) ){
				$term_id = get_term_by( 'slug', $state_abbreviation, 'public_agent_state' );
				$content = '[et_pb_section admin_label="section"]
								[et_pb_row admin_label="row"]
									[et_pb_column type="1_2"]
										[et_pb_makepressure_button admin_label="Super Pressão" include_categories="' . $term_id->term_id . '" url_new_window="off" button_text="Super Pressão" button_alignment="left" background_layout="light" custom_button="off" button_letter_spacing="0" button_use_icon="default" button_icon_placement="right" button_on_hover="on" button_letter_spacing_hover="0"] [/et_pb_makepressure_button]
									[/et_pb_column]
									[et_pb_column type="1_2"]
										[et_pb_makepressure_gmail_button admin_label="Super Pressão Gmail" include_categories="' . $term_id->term_id . '" url_new_window="off" button_text="Super Pressão Gmail" button_alignment="left" background_layout="light" custom_button="off" button_letter_spacing="0" button_use_icon="default" button_icon_placement="right" button_on_hover="on" button_letter_spacing_hover="0" /]
									[/et_pb_column]
								[/et_pb_row]
								[et_pb_row admin_label="Linha"]
									[et_pb_column type="4_4"]
										[et_pb_public_agent admin_label="Agente Público Grid" include_categories="' . $term_id->term_id . '" fullwidth="off" show_title="on" show_categories="on" show_pagination="on" background_layout="light" title_font_size_tablet="51" title_line_height_tablet="2" caption_font_size_tablet="51" caption_line_height_tablet="2" use_border_color="off" border_color="#ffffff" border_style="solid" posts_number="100" /]
									[/et_pb_column]
								[/et_pb_row]
							[/et_pb_section]';

				$postarr = array(
				  'post_title'    => $state,
				  'post_content'  => $content,
				  'post_status'   => 'publish',
				  'post_author'   => get_current_user_id(),
				  'post_type'	  => 'page',
				  'post_name'	  => $state_abbreviation
				);

				if (!is_null($base_page)) {
					//var_dump($base_page->ID);
					$postarr['post_parent'] = $base_page->ID;
				}

				$page_id = wp_insert_post( $postarr );
				if ($page_id) {

					update_post_meta($page_id, '_et_pb_post_hide_nav', 'default');
					update_post_meta($page_id, '_et_pb_page_layout', 'et_right_sidebar');
					update_post_meta($page_id, '_et_pb_side_nav', 'off');
					update_post_meta($page_id, '_et_pb_use_builder', 'on');

				}



			}

		}

		$module_class = ET_Builder_Element::add_module_order_class( $module_class, $function_name );

		$this->shortcode_content = et_builder_replace_code_content_entities( $this->shortcode_content );

		if ( '' !== $max_width_tablet || '' !== $max_width_phone || '' !== $max_width ) {
			$max_width_values = array(
				'desktop' => $max_width,
				'tablet'  => $max_width_tablet,
				'phone'   => $max_width_phone,
			);

			et_pb_generate_responsive_css( $max_width_values, '%%order_class%%', 'max-width', $function_name );
		}

		if ( is_rtl() && 'left' === $text_orientation ) {
			$text_orientation = 'right';
		}

		$class = " et_pb_module et_pb_bg_layout_{$background_layout} et_pb_map_bp_align_{$text_orientation}";

		$output = sprintf(
			'<div%3$s class="et_pb_map_bp%2$s%4$s">
				%1$s
			</div> <!-- .et_pb_map_bp -->',
			$this->shortcode_content,
			esc_attr( $class ),
			( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
			( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' )
		);
		$output .= '<div id="mapa-brasil">';

			$output .= '<svg xml:space="preserve" enable-background="new 0 0 450 460" viewBox="0 0 450 460" height="100%" width="100%" y="0px" x="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg" id="svg-map" version="1.1"><g/>';

				$output .= '<a id="tooltip_TO" xlink:href="' . get_site_url() . '/to' .'" ><path stroke="#FFFFFF" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . 'yellow' . '" d="M289.558,235.641c16.104,0.575,44.973-31.647,44.835-45.259c-0.136-13.612-17.227-58.446-22.349-66.088c-5.122-7.628-37.905,2.506-37.905,2.506S234.852,233.695,289.558,235.641z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 287.0137 188.3208)" style="cursor: pointer;">TO</text></a>';
				$output .= '<a id="tooltip_BA" xlink:href="' . get_site_url() . '/ba' .'"><path stroke="#FFFFFF" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . 'yellow' . '" d="M313.276,197.775c2.084-2.739,3.506-7.012,6.464-8.764c1.641-0.973,3.232-4.684,4.271-5.163c2.304-1.014,12.161-25.143,20.706-22.513c1.095,0.342,29.881,3.478,32.153,7.532c2.246-0.506,17.582-8.804,25.829-4.999c9.172,4.246,11.225,20.679,11.2,20.843c0.107,0.328-0.823,5.765-0.985,5.929c-1.15,1-5.258-0.807-4.22,2.138c1.317,3.751,5.094,10.583,9.97,6.613c-3.669,6.574-6.846,16.022-13.966,17.747c-5.808,1.411-4.605,13.421-5.178,18.037c-0.465,3.75,0.192,8.448,1.014,12.117c1.148,4.959-0.821,8.6-1.808,13.42c-0.822,4.162-0.219,8.299-0.987,12.297c-0.271,1.286-4.407,5.723-5.559,7.148c-1.616-1.426-63.952-37.248-73.1-36.265c1.149-3.738,2.438-9.559-0.741-12.723c-8.625-8.572-0.135-19.335-0.162-19.432c-0.546-1.725-5.396-6.079-0.026-7.175c-3.175,0.959-1.944-4.027,0.875-3.012C316.726,200.733,314.044,200.527,313.276,197.775z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 359.7324 210.1221)" style="cursor: pointer;">BA</text></a>';
				$output .= '<a id="tooltip_SE" xlink:href="' . get_site_url() . '/se' .'"><path stroke="#FFFFFF" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . 'yellow' . '" d="M408.561,191.735c0.521-1.505,2.465-0.725,3.533-0.794c2.273-0.164,0.494-2.738,1.095-3.778c2.026-3.793-2.738-5.999-1.998-10.408c4.024,1.931,9.448,3.397,12.408,6.89c1.343,1.533,5.504,2.656,5.832,4.847c-6.822,0.384-6.901,8.819-11.942,11.572C413.545,202.212,407.055,193.721,408.561,191.735z" style="cursor: pointer;"/><path class="circle" fill="' . 'yellow' . '" d="M417.324,182.854c6.214,0,11.266,5.035,11.266,11.262c0,6.208-5.052,11.261-11.266,11.261c-6.238,0-11.258-5.053-11.258-11.261C406.063,187.89,411.084,182.854,417.324,182.854z"/><text fill="#000000" transform="matrix(1 0 0 1 408.9121 198.6689)" style="cursor: pointer;">SE</text></a>';
				$output .= '<a id="tooltip_PE" xlink:href="' . get_site_url() . '/pe' .'"><path stroke="#FFFFFF" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . 'yellow' . '" d="M373.011,167.238c2.709-0.795,6.218-14.106,8.325-15.106c4.136-1.986,17.255-1.437,17.8,4.903c-0.437-0.068,8.189-2.273,7.479-1.466c1.7-0.711,10.518-4.723,12.599-4.82c0.274-0.013,4.603,0.905,3.068,2.315c-0.464,0.439,4.219,3.698,10.789,3.45c4.66-0.176,5.179-3.436,8.627-4.409c5.89-1.67,4.737,3.698,5.589,6.943c-1.182,2.684-1.646,5.586-2.74,8.285c-1.533,3.792-9.804,9.791-13.39,12.119c-7.287,4.778-21.802-4.067-22.762-5.67c-0.602-0.985-2.55-5.121-3.178-5.107c-0.629,0.356-1.04,0.861-1.287,1.519c-0.904-0.013-7.256-3.533-7.502-4.655c-4.769-1.151-5.425,6.108-8.957,6.19c0.219,0.108-8.244,6.681-7.506,3.314C383.556,170.4,374.241,168.566,373.011,167.238z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 401.3984 165.8003)" style="cursor: pointer;">PE</text></a>';
				$output .= '<a id="tooltip_AL" xlink:href="' . get_site_url() . '/al' .'"><path stroke="#FFFFFF" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . 'yellow' . '" d="M413.953,169.018c3.78,3.313,9.424,5.505,12.547,5.491c3.229-0.013,5.009-3.328,7.421-4.794c1.177-0.712,10.297-1.93,9.174,1.042c-1.807,4.848-7.122,8.585-10.024,12.789c-2.792,2-3.423,7.093-6.354,1.864c-3.259,0.424-3.722-4.424-6.957-4.477c-3.668-2.261-7.998-3.769-11.201-6.342C410.615,172.646,412.751,171.359,413.953,169.018z" style="cursor: pointer;"/><path class="circle" fill="' . 'yellow' . '" d="M436.423,168.763c6.236,0,11.258,5.054,11.258,11.278c0,6.207-5.02,11.259-11.258,11.259c-6.241,0-11.263-5.052-11.263-11.259C425.16,173.816,430.182,168.763,436.423,168.763z"/><text fill="#000000" transform="matrix(1 0 0 1 429.7891 183.895)" style="cursor: pointer;">AL</text></a>';
				$output .= '<a id="tooltip_RN" xlink:href="' . get_site_url() . '/rn' .'"><path stroke="#FFFFFF" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . 'yellow' . '" d="M404.698,138.795c2.383-4.027,6.574-6.123,8.49-11.149c1.973-5.107,3.834-5.818,8.764-4.642c5.041,1.207,9.339,0.837,14.57,1.671c7.534,1.193,6.848,10.968,9.206,16.516c-1.919,1.096-13.972,0.521-15.064-1.657c-1.041-2.067-2.904,7.107-5.094,7.3c1.532-5.847-12.654,1.78-5.424-8.683c2.545-3.67-6.302-0.808-6.711,0.725C410.121,144.013,407.217,139.151,404.698,138.795z" style="cursor: pointer;"/><path class="circle" fill="' . 'yellow' . '" d="M430.827,107.798c6.241,0,11.261,5.039,11.261,11.261c0,6.224-5.02,11.261-11.261,11.261c-6.209,0-11.26-5.037-11.26-11.261C419.567,112.837,424.618,107.798,430.827,107.798z"/><text fill="#000000" transform="matrix(1 0 0 1 422.541 123.9009)" style="cursor: pointer;">RN</text></a>';
				$output .= '<a id="tooltip_CE" xlink:href="' . get_site_url() . '/ce' .'"><path stroke="#FFFFFF" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . 'yellow' . '" d="M372.379,104.409c0.437-1.368,2.961-3.627,1.043-5.025c12.106-1.328,17.581-0.849,27.66,6.723c4.026,3.054,6.822,5.574,10.571,9.147c1.317,1.273,7.614,4.313,7.914,6.164c-0.054-0.316-5.396,3.696-5.997,5.217c-1.066,2.684-2.659,6.093-4.3,8.298c0.025-0.055-6.903,3.957-3.532,4.217c-4.41,3.821-1.015,8.135-0.797,11.517c0.196,2.767-4.38,7.587-6.765,5.422c-2.244-1.999-3.998-5.711-7.779-5.094c-1.998,0.329-5.476,2.189-7.612,0.479c-2.52-2.054,3.669-5.162-0.545-7.354c-6.987-3.615-1.264-15.393-6.684-20.239c-3.504-3.136,1.753-7.313,0.109-10.749C374.952,111.68,373.694,105.244,372.379,104.409C373.035,102.314,374.815,105.971,372.379,104.409z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 386.8379 129.0347)" style="cursor: pointer;">CE</text></a>';
				$output .= '<a id="tooltip_PI" xlink:href="' . get_site_url() . '/pi' .'"><path stroke="#FFFFFF" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . 'yellow' . '" d="M320.781,185.478c2.465-5.149-7.505-20.801-7.505-20.801s47.354-65.868,54.285-66.841c0.299-0.042,6.243,1.768,6.463,2.219c0.438,0.863-0.821,5.244-0.685,6.587c0.275,2.629,2.879,6.587,2.328,8.684c-1.15,4.736-1.863,6.134,1.369,9.901c2.794,3.245,0.325,10.16,2.544,14.269c-1.778,4.23,4.768,3.656,3.943,7.613c-0.655,3.163-5.424,7.655-1.176,10.312c0.274,4.642-4.685,4.983-6.79,7.818c-2.631,2.835-5.535,5.013-7.999,7.888c-0.55,0.671-8.821,4.096-9.998,4.082c0.302-0.301-17.665-6.449-11.967,2.354c2.463,3.808-1.505,5.56-3.177,8.778c-0.633,2.164-5.836,0.958-7.836,3.205C328.176,198.748,327.409,180.727,320.781,185.478z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 355.127 158.1045)" style="cursor: pointer;">PI</text></a>';
				$output .= '<a id="tooltip_MA" xlink:href="' . get_site_url() . '/ma' .'"><path stroke="#FFFFFF" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . 'yellow' . '" d="M288.845,127.827c4.108-2.726,31.195-48.985,31.386-50.395c1.235,0.397,6.084,7.435,7.562,5.025c0.493,0.013-0.328,2.15-0.547,2.396c-0.054-0.135,2.189-2.286,2.52-2.436c0.521-0.233,1.948,1.903,3.451-0.726c5.642,1.575,1.314,14.31,9.121,11.694c-1.147,0.384,1.452,0.74,0.848,1.905c5.095-6.587,8.488-0.027,15.337,1.491c2.025,0.466,6.243,0.575,8.162,0.207c3.808-0.823-2.082,6.847-2.082,6.887c-1.369,2.986-5.041,1.713-6.818,5.683c-0.684,1.549-3.506,4.327-3.042,6.148c0.494,1.781,2.081,2.863,0.274,4.629c0.603,2.793,3.066,7.109-0.385,9.12c-4.601,4.383,2.304,7.52,1.316,11.598c-0.9,3.726-6.244,5.725-9.147,2.78c-4.847-0.11-6.872,3.821-10.406,6.45c-2.74,2.041-8.793,2.493-10.327,5.642c-1.918,3.929-3.699,8.763-5.341,12.79c-1.699,4.204,6.383,18.762-4.328,15.611c-0.932-0.273-3.396-4.725-3.396-5.738c-0.081-3.739-2.738-4.176-4.821-7.477c0.356-3.025,2.466-6.929,4.766-8.052c3.342-1.63,1.919-6.629-2.466-4.465c-3.505,1.726-4.709-2.794-6.958-5.287c0.548,0.59-3.064-4.696-3.146-3.697c0.19-1.89,2.876-5.833,3.341-8.448c0.575-3.259,0.52-6.764-0.521-10.105c-0.63-2.068-4.656-4.521-6.518-4.437c-1.289,0.287-2.443,0-3.427-0.878C290.983,125.675,290.983,128.044,288.845,127.827z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 318.2754 126.7036)" style="cursor: pointer;">MA</text></a>';
				$output .= '<a id="tooltip_AP" xlink:href="' . get_site_url() . '/ap' .'"><path stroke="#FFFFFF" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . 'yellow' . '" d="M225.198,39.089c3.274,1.165,3.985-1.315,6.572-1.74c3.616-0.603,5.683,2.725,9.037,2.067c4.055-0.78,7.093-8.025,7.314-11.598c4.492-3.534,5.503-11.258,9.42-14.68c6.055,4.258,6.11,15.788,7.589,22.485c-0.164,0.083,6.57,7.998,7.944,8.682c3.396,1.657,3.366,6.203,0.078,9.34c-3.777,3.587-7.449,34.275-7.449,34.275h-46.489c0,0,0.932-50.366,0-51.449C221.814,36.458,223.334,38.417,225.198,39.089z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 245.9023 52.6099)" style="cursor: pointer;">AP</text></a>';
				$output .= '<a id="tooltip_PA" xlink:href="' . get_site_url() . '/pa' .'"><path stroke="#FFFFFF" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . 'yellow' . '" d="M173.378,50.619c2.259,2.63,5.629-4.478,7.901-3.82c3.19,0.918,1.478-1.108,5.026-1.752c1.931,0.806,3.096,0.273,3.519-1.631c0.535-1.26,1.453-1.726,2.725-1.384c1.768-1.684,13.558,3.603,14.68,0.384c0.629-1.821-4.287-5.709-0.302-6.997c1.643-0.533,6.012,0.808,8.75-0.068c3.986-1.288,4.876,2.684,4.382,6.066c0.631,3.587,13.145,5.766,12.982,7.97c3.589-1.518,5.354,12.763,7.105,14.447c0.357,4.26,6.304,8.585,7.07,12.544c0.628,3.396,7.065,3.616,8.213,0.095c2.578-8.133,9.696-10.022,13.475-16.651c4.603-8.038,3.725,3.752,8.955,1.067c2.11,0.411,2.876,3.629,4.574,4.724c3.18,2.027,7.779,0.974,10.572,3.013c-4.192,4.382,8.188,3.752,9.231,3.875c4.682,0.575,8.104,2.383,11.855,3.629c-0.164-0.069,4.792,0.52,5.178,1.245c2.026,3.767-4.904,19.214-6.382,21.486c-1.121,1.713-2.932,4.985-3.727,6.834c-0.902,2.026-4.764,7.313-4.655,9.229c-1.888,0.972-2.248,4.835-5.012,4.328c-3.096,3.026-8.187,4.999-10.27,8.956c2.057,0.781,8.325,1.041,5.311,4.272c-0.821,0.877-1.094,5.533-1.615,6.833c-0.575,1.384-4.464,4.779-6.108,5.34c-4.107,1.426-2.736,4.135-4.271,7.655c-0.933,2.054-0.546,3.491,1.756,4.339c-0.083,2.835-0.988,5.575-2.385,7.998c-3.041,5.245-9.009,9.818-10.079,16.27c-3.261,3.408-87.066-1.22-87.464-2.644c-1.423-5.012,1.508-24.006-2.808-27.88c-0.19-2.082-29.893-6.299-30.714-8.081C150.016,140.479,173.173,58.561,173.378,50.619z M319.139,77.664C319.302,76.912,319.74,78.76,319.139,77.664z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 232.7725 122.5137)" style="cursor: pointer;">PA</text></a>';
				$output .= '<a id="tooltip_RR" xlink:href="' . get_site_url() . '/rr' .'"><path stroke="#FFFFFF" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . 'yellow' . '" d="M113.18,24.107c-0.972-2.753-7.861-5.889-6.999-8.984c0.068-0.232,13.229,6.053,12.79,2.808c0.398,1.329,1.219,1.889,2.439,1.685c1.889-1.301,7.148,4.204,8.216,1.889c0.438-0.959-1.657-3.753,0.74-3.848c1.026,0.438,1.534,0.164,1.52-0.822c0.835-1.752,3.575,0.219,4.793,0.083c0.767-1.056,10.625-3.026,9.037-5.094c1.37,0.438,4.574,0.808,4.63-1.547c4.546-2.054,1.15-4.409,2.644-6.354c2.177-2.82,9.791,0.809,7.327,5.738c-1.972,3.93,7.121,4.027,5.724,9.366c-0.452,1.686-2.479,2.724-3.423,3.971c-1.179,1.546-1.836,9.243-1.356,11.53c1.041,4.889,3.231,8.695,6.134,12.16c1.712,2.027,5.614,2.261,5.724,4.369c0.164,2.945,1.165,6.177,0.329,9.092c-1.547,5.424-36.618,30.471-36.618,30.471s-12.517-52.736-20.335-54.063C115.261,36.417,111.523,25.682,113.18,24.107z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 136.2939 42.3862)" style="cursor: pointer;">RR</text></a>';
				$output .= '<a id="tooltip_AM" xlink:href="' . get_site_url() . '/am' .'"><path stroke="#FFFFFF" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . 'yellow' . '" d="M10.078,136.412c1.15-4.972,4.258-10.394,8.215-13.105c4.41-3.027,7.656-5.71,13.105-6.082c2.165-0.149,10.216-5.75,11.983-2.984c3.711,5.765,4.998-3.739,5.574-7.025c1.726-9.667,3.697-19.322,4.86-29.086c-0.342-1.356-2.013-6.231-2.833-7.163c-1.453-1.616-4.287-2.122-4.768-4.544c-0.272-1.452-0.574-7.258,1.109-8.121c3.494-1.768,6.547-0.042,9.737-0.89c-2.561-4.053,0.302-4.327-5.532-5.135c-3.438-0.466-3.971-2.466-2.738-6.368c1.053-3.3,15.898-1,19.088-1.396c-1.534,0.178-1.11-2.479-0.042-2.616c1.274-0.165,1.576,2.684,3.165,0.998c1.286-1.395,3.189-2.915,4.6-3.751c2.438-1.45,4.533,8.217,4.465,9.833c-0.041,0.78-0.137,2.438,1.177,2.246c3.012-0.466,4.219,2.849,7.273,4.231c3.778,1.713,3.929-1.355,7.023-2.068c4.301-0.985,0.711,3.396,2.383,3.793c1.589,0.385,3.806-4.969,4.821-5.572c0.93-0.533,3.725-0.753,4.846-1.602c3.013-2.245,1.933-1.686,3.492-1.206c3.478,1.041,2.233-8.367,6.491-7.066c1.822-0.466,3.643-2.34,5.533-2.423c1.041-0.043,6.066,2.287,6.544,3.147c0.589,1.465,0.316,2.795-0.793,3.986c1.575,1.425,2.698,3.149,3.355,5.162c0.904,2.862-1.286,6.807,0.588,9.299c-0.22,6.655,4.808,7.887-0.396,12.597c0.192-0.178,6.711,7.067,7.121,8.039c0.971-0.711,4.066,0.849,4.381,1.535c-1.658-3.629,0.547-17.09,6.628-10.915c7.203,7.327,5.491-3.615,9.148-8.627c2.834-3.875,14.597-3.136,14.077,3.246c-1.082,3.273,6.271,14.256,9.667,11.436c2.26,5.737,6.889,4.285,10.407,8.051c5.094,5.464,4.37,3.396,11.313,2.848c-2.259,3.602-3.425,4.808-5.272,8.86c-3.149,6.862-6.15,13.776-9.204,20.678c-2.437,5.505-14.843,23.471-11.105,28.442c4.806,6.395,9.339,30.183,11.324,29.934c-6.162-0.26-48.079-10.625-51.652-8.105c-1.453,1.013-53.626,10.503-55.9,10.819c-6.369,0.875-18.09-7.272-23.719-10.136c-8.601-4.381-16.61-8.981-26.088-11.05c-10.282-2.259-20.635-4.793-29.878-10.011C4.121,145.766,12.433,144.779,10.078,136.412z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 98.1406 119.0591)" style="cursor: pointer;">AM</text></a>';
				$output .= '<a id="tooltip_AC" xlink:href="' . get_site_url() . '/ac' .'"><path stroke="#FFFFFF" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . 'yellow' . '" d="M3.656,148.545c12.557,7.544,27.524,8.367,41.082,13.2c12.802,8.065,27.278,12.845,40.616,19.872c-2.834,1.205-7.587,4.382-9.983,6.395c-2.93,2.45-1.3,2.04-4.628,1.957c-2.93-0.069-3.957,4.615-7.203,5.259c-2.999,0.603-7.161-1.958-10.995-1.697c-1.905,0.136-11.969-0.056-12.64,0.603c0.313-3.642-0.385-7.299-0.165-10.941c0.096-1.439,1.998-6.533,1.245-7.451c-6.82,3.149-8.339,7.19-16.733,7.013c-2.136-0.042-2.562-2.492-3.081-4.001c-1.247-3.572-7.218-3.422-10.559-3.778c6.299-3.41-3.107-11.9-5.216-15.679c-0.52-0.918-3.588-4.655-3.629-5.957C1.642,150.174,6.612,151.968,3.656,148.545z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 47.7017 184.9355)" style="cursor: pointer;">AC</text></a>';
				$output .= '<a id="tooltip_RO" xlink:href="' . get_site_url() . '/ro' .'"><path stroke="#FFFFFF" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . 'yellow' . '" d="M83.34,180.232c0.931-1.574,5.341-4.668,6.312-4.656c1.355-0.067,2.671,0.138,3.958,0.603c3.012,1.44,2.039-1.135,5.341-0.123c-1.274-2.287,3.793-2.943,2.86-0.315c3.068,0.247,2.725-4.683,6.668-5.12c4.438-0.508,5.054-0.646,7.122-4.534c0.135-0.246,2.628-5.519,2.752-5.025c2.191-6.491,14.585-0.878,15.638,3.355c0.397,1.615,1.834,3.137,3.642,4.369c1.246,0.862,6.327-3.999,6.134,1.314c-0.78,1.274,26.663,7.656,30.005,19.282c3.82,13.338-16.421,32.167-18.173,34.043c-4.464,1.191-2.039,1.726-6.6,0.15c-2.574-0.875-6.422,0.986-9.08,0.289c-2.409-0.645-3.041-3.957-5.86-4.683c-3.055-0.78-5.423-1.795-7.654-3.93c-4.041-3.876-8.983-2.645-14.475-3.808c-1.835-0.083-6.053-6.779-7.874-5.327c-1.821-0.438-5.381-9.094-3.397-11.204c0.124-1.67-0.26-3.204-1.163-4.627c-0.986-2.644,1.041-5.026,0.863-7.806c-0.384-6.081-1.028-1.986-3.382-1.903C94.336,180.686,85.957,181.671,83.34,180.232z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 118.1299 195.3193)" style="cursor: pointer;">RO</text></a>';
				$output .= '<a id="tooltip_MT" xlink:href="' . get_site_url() . '/mt' .'"><path stroke="#FFFFFF" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . 'yellow' . '" d="M142.237,173.962c4-0.316-1.888-6.452,5-5.738c7.914,0.808,16.295,0.328,24.279,0.218c1.629-0.013,8.902,1.288,7.395-1.833c-1.192-2.453,1.821-6.425,0.425-9.725c2.027-0.864,1.289-3.807,2.629-5.107c1.151-1.123,4.176,7.244,4.436,7.819c1.097,2.451,0.398,5.478,1.932,7.654c1.41,1.987,4.574,2.136,5.889,4.259c3.136,5.136,10.845,4.137,17.13,4.657c20.159,1.656,40.356,2.669,60.486,4.752c-3.48,7.763-3.999,14.912-5.122,22.552c-0.437,2.972,1.863,7.163-0.056,10.065c1.945,1.287,1.346,2.753,1.424,4.409c1.151,25.129-20.429,60.186-33.548,58.569c-10.914-1.369-45.3,0.058-46.928-3.396c-1.165-3.944-6.136-2.658-8.395-6.603c-2.301-4.051,0.684-6.299,0.737-10.242c-6.997,0.603-14.09-0.384-21.102-0.324c0.793-5.016-3.725-9.288-2.929-13.809c0.519-3.025,2.726-2.916,0.932-6.79c-1.206-2.589-0.261-4.247-0.699-6.382c-0.289-1.385-1.042-1.876-2.124-2.424c-2.931-1.493,1.246-2.48,2.056-3.644c1.726-2.465,3.299-11.394,6.545-11.612c1.219-1.999-1.781-3.643-1.465-5.56c-3.902-3.588,0.506-4.643,0.369-7.984c-0.151-3.627-9.654-3.944-12.256-3.751c-1.821,0.137-4.109,0.562-5.888-0.094c0.493-3.521-0.521-6.054-0.535-9.217c-0.014-2.286,1.288-5.177,0.835-7.45C143.581,176.618,141.937,174.714,142.237,173.962z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 200.0244 218.4175)" style="cursor: pointer;">MT</text></a>';
				$output .= '<a id="tooltip_MS" xlink:href="' . get_site_url() . '/ms' .'"><path stroke="#FFFFFF" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . 'yellow' . '" d="M183.198,294.536c2.136-4.464,3.177-9.394,5.312-13.61c1.712-3.344-4.067-7.587-2.423-9.807c0.027-0.026,2.738,3.641,3.917,3.725c3.204-1.534,4.807-2.272,6.984-5.228c2.615-3.59,10.832-3.014,14.051-0.305c1.259,1.041,3.068,2.107,4.668,2.574c3.163,0.934,5.889-3.013,8.559-0.873c3.724,2.982,4.626-1.862,7.86-3.509c1.945-1.012-1.768,8.465-2.244,7.781c2.463,0.959,4.285,0.901,6.82,0.959c3.504,0.081,1.805,1.205,2.436,3.339c0.466,1.564,28.948-5.997,29.416,0.578c0.302,3.837-0.987,61.813-0.987,61.813s-39.532,5.533-41.602,5.286c-3.889-0.492-3.587-3.231-8.063-0.933c-2.028,0.329-6.012,1.205-5.177-2.409c-2.013-4.354-0.111-14.625-4.849-17.088c-1.206-0.659-7.092-2.36-7.504-1.945c-1.699,1.777-3.739,1.562-6.121,1.121c-2.904,0.027-5.629-1.614-8.243-1.203c-4.178,0.656-0.603-2.986-1.645-3.535c0.932-2.847,1.411-9.912,0.453-11.856c-0.165-0.331-3.52-7.232-2.547-8.108C186.306,297.688,182.334,299.415,183.198,294.536z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 213.2939 306.7236)" style="cursor: pointer;">MS</text></a>';
				$output .= '<a id="tooltip_GO" xlink:href="' . get_site_url() . '/go' .'"><path stroke="#FFFFFF" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . 'yellow' . '" d="M237.768,270.519c0.628-2.904,1.835-7.396,4.709-8.766c1.015-1.644,1.754-5.147,2.275-5.586c2.408-2.247,3.889-3.783,6.63-4.656c3.723-1.205,3.338-5.342,4.846-8.165c1.504-2.845,4.736-1.15,5.942-3.382c1.479-2.834,0.741-6.161,2.189-8.874c2.902-5.531,1.862-17.363,8.656-20.567c-4.878,7.641,3.698,4.971,7.201,9.449c2.273,1.738,2.164-1.822,2.71-3.055c1.618-3.533,2.878,2.247,4.52-1.533c0.413,0.37,4.136,5.765,3.427,5.601c-0.029-0.931,0.326-1.408,1.037-1.438c0.108,0.534,0.274,1.013,0.602,1.452c-0.602-0.261,9.697-0.095,8.82,1.534c0.36-0.657-0.602-3.11,0.221-3.438c1.039-0.411,3.971,1.368,6.351,0.438c1.045-0.397,7.889-2.807,7.671-3.683c0.767,0.905,1.262,2.67,2.85,1.286c-2.632,2.274-2.576,4.466,1.258,3.821c-1.861,1.438-2.846,4.341-2.382,6.547c0.357,1.643,3.752,5.973,3.478,6.751c-1.78,0.315,0.602,5.438-2.325,6.078c-3.181,0.701-3.973-5.53-4.3,0.688c-0.164,1.48-1.097,1.67-2.768,0.576c-3.288,0.327-0.549,2.19-1.121,3.888c-0.988,2.902,2.792,6.437-2.411,6.764c-3.586,0.219-2.682,1.341-2.682-2.739c-0.028-4.573-12.054-3.643-10.218,0.521c-4.901,6.355,12.05-0.326,9.668,6.355c-1.313,3.752,15.83,28.211,10.406,25.416c-1.944-0.986-50.804,10.271-49.982,12.105c-5.012-2.136-11.804-7.941-17.391-8.162c-0.438-2.189-3.618-1.284-5.095-1.533c-3.724-0.604,1.04-3.231,0.22-4.109c-1.89-1.916-4.382,1.756-3.588-3.012C239.602,274.627,237.055,273.038,237.768,270.519z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 266.9111 254.2139)" style="cursor: pointer;">GO</text></a>';
				$output .= '<a id="tooltip_PR" xlink:href="' . get_site_url() . '/pr' .'"><path stroke="#FFFFFF" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . 'yellow' . '" d="M222.225,363.694c1.807-2.138,1.889-4.881,2.424-7.479c0.301-1.453,0.465-7.86,1.369-8.736c2.3-0.684,2.3-3.315,2.726-5.204c0.616-2.738,2.821-2.958,3.984-5.616c4.369-9.91,38.947-9.529,46.476-9.227c4.658,0.193,15.775,34.563,17.916,33.794c-1.728,2.19-5.754,8.929-8.41,8.984c-4.054,0.057-14.215,14.68-14.215,14.68s-37.329-12.05-40.287-11.285c-3.875-1.449-2.698-6.491-6.054-8.216C226.663,364.623,222.498,367.8,222.225,363.694z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 248.4453 356.1045)" style="cursor: pointer;">PR</text></a>';
				$output .= '<a id="tooltip_SC" xlink:href="' . get_site_url() . '/sc' .'"><path stroke="#FFFFFF" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . 'yellow' . '" d="M231.029,383.959c1.669-3.338-0.284-10.516,4.573-10.569c6.631-0.109,13.639,3.559,20.402,3.888c1.317,0.055,5.231,2.163,4.357-1.15c-1.095-4.164,3.945-1.863,5.67-3.179c2.274-1.724,8.187-4.106,11.311-1.367c1.423,1.809,20.05-5.395,13.284,3.946c-1.368,1.395,0.713,10.789,0.466,10.734c-3.449,4.438,1.726,11.666-5.096,15.334c-2.901,1.536-7.284,7.779-9.64,9.995C276.085,411.866,233.534,382.918,231.029,383.959z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 266.9111 387.7646)" style="cursor: pointer;">SC</text></a>';
				$output .= '<a id="tooltip_RS" xlink:href="' . get_site_url() . '/rs' .'"><path stroke="#FFFFFF" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . 'yellow' . '" d="M191.236,416.881c0.52-2.684,7.38-8.409,9.477-10.351c0.37-0.359,8.599-10.08,9.174-8.329c-1.301-3.89,2.781-1.589,3.917-4.819c0.26-0.521,7.04-4.821,7.109-4.795c1.436-0.191,6.721-3.695,7.421-3.257c1.204-2.028,8.927-1.479,8.653-0.824c1.165-0.38,2.284-0.877,3.326-1.479c0.221-0.821,22.459,7.533,24.319,11.531c2.523,5.34,12.217,2.822,13.15,5.563c0.106,0.275-5.809,9.339-3.89,9.173c-0.985,0.08,3.204-2.875,3.834,0.409c-2.793,3.619-4.6,7.834-6.571,11.944c-3.696,7.614-8.872,12.765-15.886,17.42c-7.394,4.902-7.339,11.941-13.257,17.693c-8.091,7.942-10.159-0.574-4.08-5.752c3.806-3.231-22.527-19.746-25.578-22.732c-1.918-1.862-2.384,0.274-4.219,1.15c-2.547,1.205-1.917-2.822-3.588-4.273c-2.3-1.999-4.793-5.479-7.737-6.68c-3.478-1.367-5.615,5.145-9.052,0.821C189.168,418.854,190.332,418.032,191.236,416.881z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 231.0313 414.4658)" style="cursor: pointer;">RS</text></a>';
				$output .= '<a id="tooltip_SP" xlink:href="' . get_site_url() . '/sp' .'"><path stroke="#FFFFFF" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . 'yellow' . '" d="M239.3,330.554c3.26-4.356,9.56-5.039,11.531-10.792c1.369-3.942,3.889-8.818,6.135-13.036c1.561-2.957,7.749-7.121,10.517-8.65c0.383-0.196,32.974-6.138,42.234-1.701c20.265,9.724,26.017,33.879,27.854,33.304c4.408-1.425,5.34,3.778,2.106,4.49c-1.754,0.413-6.519,1.479-6.49,3.399c0.027,3.448,0.521,1.615-2.931,3.639c-2.189-1.42-3.34,4.111-4.763,3.426c-4.271-2.244-6.958,2.96-9.258,1.918c-4.271-1.918-16.98,13.092-19.638,15.336c0.245-0.218-1.148-1.479-1.587-2.685c-0.466-1.369-2.658,0.385-4.025,0.082c-0.986-0.192,1.751-4.079-2.303-4.52c-1.369-0.164-3.753,0.303-4.929,0.084c-2.903-0.547,0.108-2.41-0.439-3.862c-1.067-2.986-3.013-4.931-3.751-7.779c-0.52-1.945,0.165-7.531-3.615-7.395c-0.848-2.956-6.628-1.451-9.066-1.862c-0.162,0.163-8.846-2.684-10.079-2.684c-1.616-0.029-6.791-3.396-7.121-0.274C247.982,330.386,239.876,331.21,239.3,330.554z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 280.6816 327.3193)" style="cursor: pointer;">SP</text></a>';
				$output .= '<a id="tooltip_MG" xlink:href="' . get_site_url() . '/mg' .'"><path stroke="#FFFFFF" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . 'yellow' . '" d="M262.881,297.305c-1.696-5.094,15.531-19.882,18.844-13.421c5.531-7.367,15.886,1.588,19.773-3.944c0.988-1.367,3.015-1.453,3.725-2.957c0.326-0.711-0.493-2.793-0.056-3.888c1.369-3.398-4.873-2.355-0.109-6.603c4.547-4.053-1.917-4.739-1.204-8.186c0.957-4.604,1.807-4.713,5.613-6.027c1.943-0.688,0.906-8.272,0.083-8.52c-0.108-2.699,1.974-2.546,3.782-1.617c2.188-0.135-0.276-3.695,0.957-4.243c-0.357,0.151,5.559,1.999,5.724,2.055c0.986,0.358-0.52,3.534-0.931,3.943c8.217-2.355,14.514-11.789,23.279-11.242c4.983,0.316-0.327,4.339,5.367,5.544c0.684,1.234,3.34-1.054,4.054-1.189c2.876-0.536,5.53,3.284,8.106,3.886c2.301,3.578,7.503,0.537,10.298,3.001c1.755,1.589,2.188,3.397,3.396,5.313c1.314,2.052,3.86-0.465,5.726-0.109c3.257,0.656,6.326,2.026,9.338,3.723c2.19,1.205,0.768,3.179-0.548,4.573c-0.765,0.796-3.259,6.165-2.627,5.643c-2.138,1.781-2.628-1.669-3.397,2.764c-0.628,3.674,0.164,4.714,3.149,7.015c4.901,3.229-6.765,3.12-6.71,3.504c0.22,0.601-2.846,41.96-3.835,42.179c-6.737,1.562-14.513,5.311-21.744,7.012c-12.736,2.985-24.295,3.778-29.471,4.656c0,1.452-5.367,6.872-8.518,1.259c0,0-3.041-7.285-2.821-7.229c0.105-0.027,2.138-5.506,2.244-6.137c0.768-3.504-5.042-0.765-5.749-2.188c-0.878-1.81-2.358-4.576-2.166-6.628c1.699-1.205,1.672-2.383-0.08-3.562c-1.04-1.095-1.205-2.303-0.521-3.672c-2.329-1.424-3.065-2.683-5.698-2.462c-1.479,0.138-4.055,3.668-5.506,0.629c0.878,2.108-4.188,0.769-5.094,1.56c-2.354-1.202-1.779,2.028-2.384,3.069c-0.137,0.22-1.014-2.904-1.065-2.961c-1.149-1.175-2.767,4.165-3.505-0.055c0.766-4.105-4.657-2.709-7.67-2.93c-4.708-0.353-5.53-1.613-9.858,0.631C262.993,300.562,262.336,299.274,262.881,297.305z" style="cursor: pointer;"/><text fill="#000000" transform="matrix(1 0 0 1 328.4063 286.4561)" style="cursor: pointer;">MG</text></a>';
				$output .= '<a id="tooltip_RJ" xlink:href="' . get_site_url() . '/rj' .'"><path stroke="#FFFFFF" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . 'yellow' . '" d="M332.886,337.429c-1.26-2.768,8.409-4.795,7.89-6.71c-3.177-1.864-4.602,1.148-6.63-2.959c4.274-0.686,9.533-4.49,13.831-3.562c0.548-0.219,4.902-1.753,4.96,0.167c2.546-1.566,5.479-2.412,8.105-3.837c2.246-1.206,0.932-8.218,3.725-9.643c6.054-3.123,1.398,1.836,7.066,2.959c5.888,1.205,5.395,1.48,5.641,7.067c0.247,5.642-8.763,4.381-11.063,8.764c-1.039,1.999,1.698,5.368-3.368,4.903c-4.188-0.413-10.628,2.355-9.285-3.18c-1.039-0.08-1.861,0.301-2.464,1.124c0,0,0.105,2.767-0.74,2.741c-0.766-0.056-7.643,1.094-7.449,0.463c1.398-0.359,2.708-0.684,4.135-0.794c-1.667-0.713-2.957-1.839-4.901-0.142c0.465,0.195-4.227-0.086-3.379-0.113c-0.521,1.727-3.814,0.699-3.879,3.045C336.717,337.908,333.927,342.41,332.886,337.429z" style="cursor: pointer;"/><path class="circle" fill="' . 'yellow' . '" d="M355.094,318.613c6.209,0,11.263,5.021,11.263,11.259c0,6.208-5.056,11.264-11.263,11.264c-6.211,0-11.263-5.054-11.263-11.264C343.831,323.634,348.883,318.613,355.094,318.613z"/><text fill="#000000" transform="matrix(1 0 0 1 347.4648 334.6807)" style="cursor: pointer;">RJ</text></a>';
				$output .= '<a id="tooltip_ES" xlink:href="' . get_site_url() . '/es' .'"><path stroke="#FFFFFF" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . 'yellow' . '" d="M367.119,308.834c1.044-1.999-0.298-5.451,1.841-6.326c3.697-1.453,3.858-0.467,5.941-4.49c0.767-1.563,3.999-5.807,2.848-7.835c-0.439-0.765-3.204-3.613-3.286-4.05c1.04-0.249,2.079-0.219,3.123,0.054c1.366-0.654-6.465-10.519,2.137-8.054c-1.204-0.655-1.535-1.365-0.932-2.135c4.358-0.138,13.856,0.027,12.845,6.738c-0.577,3.835,0.933,8.079-0.577,11.804c-0.218,0.576-5.861,8.954-5.831,8.954c0.985,3.289-5.18,5.808-6.054,8.165c-1.313,3.56-2.135,3.013-5.614,2.573c-1.64-0.274-3.202-0.768-4.736-1.451C368.819,311.297,369.424,309.055,367.119,308.834z" style="cursor: pointer;"/><path class="circle" fill="' . 'yellow' . '" d="M381.917,284.723c6.21,0,11.261,5.055,11.261,11.262c0,6.212-5.051,11.261-11.261,11.261c-6.212,0-11.263-5.049-11.263-11.261C370.654,289.777,375.705,284.723,381.917,284.723z"/><text fill="#000000" transform="matrix(1 0 0 1 373.3047 300.4971)" style="cursor: pointer;">ES</text></a>';
				$output .= '<a id="tooltip_DF" xlink:href="' . get_site_url() . '/df' .'"><path stroke="#FFFFFF" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . 'yellow' . '" d="M292.461,246.197c0,0,12.929-2.903,14.188,0c1.233,2.903,0.659,10.683-1.424,11.504c-2.08,0.849-14.296-1.806-14.023-3.313C291.503,252.853,292.461,246.197,292.461,246.197z" style="cursor: pointer;"/><path class="circle" fill="' . 'yellow' . '" d="M300.735,238.34c6.212,0,11.26,5.035,11.26,11.258c0,6.21-5.048,11.263-11.26,11.263c-6.209,0-11.261-5.053-11.261-11.263C289.475,243.377,294.523,238.34,300.735,238.34z"/><text fill="#000000" transform="matrix(1 0 0 1 292.4141 254.2139)" style="cursor: pointer;">DF</text></a>';
				$output .= '<a id="tooltip_PB" xlink:href="' . get_site_url() . '/pb' .'"><path stroke="#FFFFFF" stroke-width="1.0404" stroke-linecap="round" stroke-linejoin="round" fill="' . 'yellow' . '" d="M401.575,141.096c2.081-3.081,16.791-6.82,19.117-4.616c0,1.918,7.259,1.686,10.133,2.712c-0.492,3.038,12.652,1.533,14.408,2.259c1.421,0.589,3.833,11.983,1.421,12.202c-0.874-1.124-2.083-1.739-3.586-1.835c-2.957-0.027-2.546,1.863-4.383,3.108c-2.626,1.767-6.571,1.917-9.558,2.109c-0.162,1.232-3.943,4.438-5.259,4.916c-3.122,1.149-2.657-2.727-5.095-3.602c0.713-1.124,4.082-5.203,3.725-6.205c-1.423-3.846-12.051,5.52-14.981,3.506c-1.396-0.973-6.218,1.493-3.476-2.588C405.574,150.776,400.398,142.889,401.575,141.096z" style="cursor: pointer;"/><path class="circle" fill="' . 'yellow' . '" d="M433.797,133.597c6.237,0,11.26,5.051,11.26,11.261c0,6.226-5.022,11.262-11.26,11.262c-6.208,0-11.257-5.036-11.257-11.262C422.54,138.647,427.589,133.597,433.797,133.597z"/><text fill="#000000" transform="matrix(1 0 0 1 425.2129 148.9893)" style="cursor: pointer;">PB</text></a>';
		    $output .= '</svg>';
		$output .= '</div>';

		return $output;
	}
}
new ET_Builder_Module_Brazil_Party_map;

class ET_Builder_Module_Statistics extends ET_Builder_Module {
	function init() {
		$this->name = esc_html__( 'Estatisticas - BP', 'et_builder' );
		$this->slug = 'et_pb_statistics_bp';

		$this->whitelisted_fields = array(
			'background_layout',
			'categories',
			'text_orientation',
			'content_new',
			'admin_label',
			'module_id',
			'module_class',
			'max_width',
			'max_width_tablet',
			'max_width_phone',
		);

		$this->fields_defaults = array(
			'background_layout' => array( 'light' ),
			'text_orientation'  => array( 'left' ),
		);

		$this->main_css_element = '%%order_class%%';
		$this->advanced_options = array(
			'fonts' => array(
				'text'   => array(
					'label'    => esc_html__( 'Text', 'et_builder' ),
					'css'      => array(
						'line_height' => "{$this->main_css_element} p",
					),
				),
			),
			'background' => array(
				'settings' => array(
					'color' => 'alpha',
				),
			),
			'border' => array(),
			'custom_margin_padding' => array(
				'css' => array(
					'important' => 'all',
				),
			),
		);
	}

	function get_fields() {
		$fields = array(
			'categories' => array(
				'label'           => esc_html__( 'Categorias', 'et_builder' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'         => array(
					'public_agent_state'  => esc_html__( 'Estado', 'et_builder' ),
					'public_agent_genre' => esc_html__( 'Genêro', 'et_builder' ),
					'public_agent_party' => esc_html__( 'Partido', 'et_builder' ),
				),
				'description'       => esc_html__( 'Escolha a categoria desejada', 'et_builder' ),
			),
			'background_layout' => array(
				'label'             => esc_html__( 'Text Color', 'et_builder' ),
				'type'              => 'select',
				'option_category'   => 'configuration',
				'options'           => array(
					'light' => esc_html__( 'Dark', 'et_builder' ),
					'dark'  => esc_html__( 'Light', 'et_builder' ),
				),
				'description'       => esc_html__( 'Here you can choose the value of your text. If you are working with a dark background, then your text should be set to light. If you are working with a light background, then your text should be dark.', 'et_builder' ),
			),
			'text_orientation' => array(
				'label'             => esc_html__( 'Text Orientation', 'et_builder' ),
				'type'              => 'select',
				'option_category'   => 'layout',
				'options'           => et_builder_get_text_orientation_options(),
				'description'       => esc_html__( 'This controls the how your text is aligned within the module.', 'et_builder' ),
			),
			'content_new' => array(
				'label'           => esc_html__( 'Content', 'et_builder' ),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Here you can create the content that will be used within the module.', 'et_builder' ),
			),
			'max_width' => array(
				'label'           => esc_html__( 'Max Width', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'layout',
				'mobile_options'  => true,
				'tab_slug'        => 'advanced',
				'validate_unit'   => true,
			),
			'max_width_tablet' => array(
				'type' => 'skip',
			),
			'max_width_phone' => array(
				'type' => 'skip',
			),
			'disabled_on' => array(
				'label'           => esc_html__( 'Disable on', 'et_builder' ),
				'type'            => 'multiple_checkboxes',
				'options'         => array(
					'phone'   => esc_html__( 'Phone', 'et_builder' ),
					'tablet'  => esc_html__( 'Tablet', 'et_builder' ),
					'desktop' => esc_html__( 'Desktop', 'et_builder' ),
				),
				'additional_att'  => 'disable_on',
				'option_category' => 'configuration',
				'description'     => esc_html__( 'This will disable the module on selected devices', 'et_builder' ),
			),
			'admin_label' => array(
				'label'       => esc_html__( 'Admin Label', 'et_builder' ),
				'type'        => 'text',
				'description' => esc_html__( 'This will change the label of the module in the builder for easy identification.', 'et_builder' ),
			),
			'module_id' => array(
				'label'           => esc_html__( 'CSS ID', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'tab_slug'        => 'custom_css',
				'option_class'    => 'et_pb_custom_css_regular',
			),
			'module_class' => array(
				'label'           => esc_html__( 'CSS Class', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'tab_slug'        => 'custom_css',
				'option_class'    => 'et_pb_custom_css_regular',
			),
		);
		return $fields;
	}

	function shortcode_callback( $atts, $content = null, $function_name ) {
		$module_id            = $this->shortcode_atts['module_id'];
		$module_class         = $this->shortcode_atts['module_class'];
		$background_layout    = $this->shortcode_atts['background_layout'];
		$text_orientation     = $this->shortcode_atts['text_orientation'];
		$max_width            = $this->shortcode_atts['max_width'];
		$max_width_tablet     = $this->shortcode_atts['max_width_tablet'];
		$max_width_phone      = $this->shortcode_atts['max_width_phone'];
		$categories     	  = $this->shortcode_atts['categories'];

		$module_class = ET_Builder_Element::add_module_order_class( $module_class, $function_name );

		$this->shortcode_content = et_builder_replace_code_content_entities( $this->shortcode_content );

		if ( '' !== $max_width_tablet || '' !== $max_width_phone || '' !== $max_width ) {
			$max_width_values = array(
				'desktop' => $max_width,
				'tablet'  => $max_width_tablet,
				'phone'   => $max_width_phone,
			);

			et_pb_generate_responsive_css( $max_width_values, '%%order_class%%', 'max-width', $function_name );
		}

		if ( is_rtl() && 'left' === $text_orientation ) {
			$text_orientation = 'right';
		}

		$class = " et_pb_module et_pb_bg_layout_{$background_layout} et_pb_text_align_{$text_orientation}";

		$output = sprintf(
			'<div%3$s class="et_pb_text%2$s%4$s">
				%1$s
			</div> <!-- .et_pb_text -->',
			$this->shortcode_content,
			esc_attr( $class ),
			( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
			( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' )
		);

		if ($categories == "public_agent_state") {
			$label_category = "Estado";
		}
		elseif($categories == "public_agent_genre"){
			$label_category = "Genêro";
		}
		elseif ($categories == "public_agent_party") {
			$label_category = "Partido";
		}

		$output .= '<script type="text/javascript" >
				    jQuery(function ($) {
				      var output = $.getJSON("' . get_site_url() . '/stats/' . $categories . '",
				      function(response){
				      	  var arr = $.map(response, function(el) { return el });
				      	  var email = arr.map(function(arr){return arr["email"]});
				      	  var twitter = arr.map(function(arr){return arr["twitter"]});
				      	  var facebook = arr.map(function(arr){return arr["facebook"]});
					      var ctx = document.getElementById("makepressure");
					      var myChart = new Chart(ctx, {
					          type: "bar",
					          data: {
					              labels: Object.keys(response),
					              datasets: [{
					                  label: "Número de cliques no email por ' . $label_category . '",
					                  data: email,
					                  backgroundColor: "rgba(75, 192, 192, 0.2)",
					                  borderColor: "rgba(75, 192, 192, 1)",
					                  borderWidth: 1
					              },
					              {
					                  label: "Número de cliques no twitter por ' . $label_category . '",
					                  data: twitter,
					                  backgroundColor: "rgba(255, 99, 132, 0.2)",
					                  borderColor: "rgba(255,99,132,1)",
					                  borderWidth: 1
					              },
					              {
					                  label: "Número de cliques no facebook por ' . $label_category . '",
					                  data: facebook,
					                  backgroundColor: "rgba(255, 206, 86, 0.2)",
					                  borderColor: "rgba(255, 206, 86, 1)",
					                  borderWidth: 1
					              }],
					          },
					          options: {
					              scales: {
					                  yAxes: [{
					                      ticks: {
					                          beginAtZero:true
					                      }
					                  }]
					              }
					          }
					      });
					    });

				      });
			</script>';
	    $output .= '<canvas height="500px" width="1080" id="makepressure" style="display: block; width: 1080px; height: 500px;"></canvas>';

		return $output;
	}
}
//new ET_Builder_Module_Statistics;

class ET_Builder_Module_Make_Pressure_Search extends ET_Builder_Module {
	function init() {
		$this->name = esc_html__( 'Busca - BP', 'et_builder' );
		$this->slug = 'et_pb_search_bp';

		$this->whitelisted_fields = array(
			'background_layout',
			'text_orientation',
			'content_new',
			'admin_label',
			'module_id',
			'module_class',
			'max_width',
			'max_width_tablet',
			'max_width_phone',
			'button_text',
		);

		$this->fields_defaults = array(
			'background_layout' => array( 'light' ),
			'background_color'  => array( et_builder_accent_color(), 'add_default_setting' ),
			'text_orientation'  => array( 'left' ),
			'button_text' => array( 'Busca' ),
		);

		$this->main_css_element = '%%order_class%%';
		$this->advanced_options = array(
			'fonts' => array(
				'text'   => array(
					'label'    => esc_html__( 'Text', 'et_builder' ),
					'css'      => array(
						'line_height' => "{$this->main_css_element} p",
					),
				),
			),
			'background' => array(
				'settings' => array(
					'color' => 'alpha',
				),
			),
			'border' => array(),
			'custom_margin_padding' => array(
				'css' => array(
					'important' => 'all',
				),
			),
			'button' => array(
				'button' => array(
					'label' => esc_html__( 'Button', 'et_builder' ),
					'css' => array(
						'main' => $this->main_css_element,
					),
				),
			),
		);
	}

	function get_fields() {
		$fields = array(
			'background_layout' => array(
				'label'             => esc_html__( 'Text Color', 'et_builder' ),
				'type'              => 'select',
				'option_category'   => 'configuration',
				'options'           => array(
					'light' => esc_html__( 'Dark', 'et_builder' ),
					'dark'  => esc_html__( 'Light', 'et_builder' ),
				),
				'description'       => esc_html__( 'Here you can choose the value of your text. If you are working with a dark background, then your text should be set to light. If you are working with a light background, then your text should be dark.', 'et_builder' ),
			),
			'text_orientation' => array(
				'label'             => esc_html__( 'Text Orientation', 'et_builder' ),
				'type'              => 'select',
				'option_category'   => 'layout',
				'options'           => et_builder_get_text_orientation_options(),
				'description'       => esc_html__( 'This controls the how your text is aligned within the module.', 'et_builder' ),
			),
			'content_new' => array(
				'label'           => esc_html__( 'Content', 'et_builder' ),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Here you can create the content that will be used within the module.', 'et_builder' ),
			),
			'max_width' => array(
				'label'           => esc_html__( 'Max Width', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'layout',
				'mobile_options'  => true,
				'tab_slug'        => 'advanced',
				'validate_unit'   => true,
			),
			'max_width_tablet' => array(
				'type' => 'skip',
			),
			'max_width_phone' => array(
				'type' => 'skip',
			),
			'disabled_on' => array(
				'label'           => esc_html__( 'Disable on', 'et_builder' ),
				'type'            => 'multiple_checkboxes',
				'options'         => array(
					'phone'   => esc_html__( 'Phone', 'et_builder' ),
					'tablet'  => esc_html__( 'Tablet', 'et_builder' ),
					'desktop' => esc_html__( 'Desktop', 'et_builder' ),
				),
				'additional_att'  => 'disable_on',
				'option_category' => 'configuration',
				'description'     => esc_html__( 'This will disable the module on selected devices', 'et_builder' ),
			),
			'admin_label' => array(
				'label'       => esc_html__( 'Admin Label', 'et_builder' ),
				'type'        => 'text',
				'description' => esc_html__( 'This will change the label of the module in the builder for easy identification.', 'et_builder' ),
			),
			'module_id' => array(
				'label'           => esc_html__( 'CSS ID', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'tab_slug'        => 'custom_css',
				'option_class'    => 'et_pb_custom_css_regular',
			),
			'module_class' => array(
				'label'           => esc_html__( 'CSS Class', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'tab_slug'        => 'custom_css',
				'option_class'    => 'et_pb_custom_css_regular',
			),
			'button_text' => array(
				'label'           => esc_html__( 'Button Text', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Input your desired button text.', 'et_builder' ),
			),
		);
		return $fields;
	}

	function shortcode_callback( $atts, $content = null, $function_name ) {
		$module_id            = $this->shortcode_atts['module_id'];
		$module_class         = $this->shortcode_atts['module_class'];
		$background_layout    = $this->shortcode_atts['background_layout'];
		$text_orientation     = $this->shortcode_atts['text_orientation'];
		$max_width            = $this->shortcode_atts['max_width'];
		$max_width_tablet     = $this->shortcode_atts['max_width_tablet'];
		$max_width_phone      = $this->shortcode_atts['max_width_phone'];
		$button_text       = $this->shortcode_atts['button_text'];

		$module_class = ET_Builder_Element::add_module_order_class( $module_class, $function_name );

		$this->shortcode_content = et_builder_replace_code_content_entities( $this->shortcode_content );

		if ( '' !== $max_width_tablet || '' !== $max_width_phone || '' !== $max_width ) {
			$max_width_values = array(
				'desktop' => $max_width,
				'tablet'  => $max_width_tablet,
				'phone'   => $max_width_phone,
			);

			et_pb_generate_responsive_css( $max_width_values, '%%order_class%%', 'max-width', $function_name );
		}

		if ( is_rtl() && 'left' === $text_orientation ) {
			$text_orientation = 'right';
		}

		$class = " et_pb_module et_pb_bg_layout_{$background_layout} et_pb_text_align_{$text_orientation}";

		$output = sprintf(
			'<div%3$s class="et_pb_text%2$s%4$s">
				%1$s
			</div> <!-- .et_pb_text -->',
			$this->shortcode_content,
			esc_attr( $class ),
			( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
			( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' )
		);

		$output .= '<form method="get" action="' . get_site_url() . '">';
		 	$output .= '<p>';
			$output .= 'Busca: <input type="text" name="s">';
			$output .= '</p>';

			$args = array( 'taxonomy' => 'public_agent_party','name' => 'public_agent_party', 'show_count' => 1, 'value_field' => 'slug', 'echo' => 0, 'show_option_none' => 'Selecione', 'option_none_value' => '');

			$terms = get_terms( 'public_agent_party' );
	 		if (!empty($terms)) {
				$output .= '<p> Partido: ';
				$output .= wp_dropdown_categories( $args );
				$output .= '</p>';
			}

			$terms = get_terms( 'public_agent_state' );
	 		if (!empty($terms)) {
				$args['taxonomy'] = 'public_agent_state';
				$args['name'] = 'public_agent_state';

				$output .= '<p>Estado: ';
		 		$output .= wp_dropdown_categories( $args );
		 		$output .= '</p>';
		 	}

			$terms = get_terms( 'public_agent_genre' );
	 		if (!empty($terms)) {
		 		$args['taxonomy'] = 'public_agent_genre';
		 		$args['name'] = 'public_agent_genre';

		 		$output .= '<p>Genêro: ';
		 		$output .= wp_dropdown_categories( $args );
		 		$output .= '</p>';
		 	}

			$terms = get_terms( 'public_agent_job' );
	 		if (!empty($terms)) {
		 		$args['taxonomy'] = 'public_agent_job';
		 		$args['name'] = 'public_agent_job';

		 		$output .= '<p>Cargo: ';
		 		$output .= wp_dropdown_categories( $args );
		 		$output .= '</p>';
	 		}

	 		$output .= '<input type="hidden" name="post_type" value="public_agent">';
	 		$output .= '<p>';
	 		$output .= '<button class="et_pb_button" style="background-color:#545454; color: white ">' . ('' !== $button_text ? esc_html( $button_text ) : 'Busca') . '</button>';
	 		$output .= '</p>';
		$output .= '</form>';

		return $output;
	}
}
new ET_Builder_Module_Make_Pressure_Search;

class ET_Builder_Module_Make_Pressure_ClipBoard extends ET_Builder_Module {
  function init() {
    $this->name = esc_html__( 'ClipBoard - Lista de emails dos Agentes Públicos para copiar', 'et_builder' );
    $this->slug = 'et_pb_clipboard';

    $this->whitelisted_fields = array(
      'fullwidth',
      'include_categories',
      'admin_label',
      'module_id',
      'module_class',
      'open',
      'title',
      'content_new',
      'open_toggle_background_color',
      'closed_toggle_background_color',
      'icon_color',
      'closed_toggle_text_color',
      'open_toggle_text_color',
    );

    $this->fields_defaults = array(
      'fullwidth'         => array( 'on' ),
      'show_title'        => array( 'on' ),
    );

    $this->main_css_element = '%%order_class%% .et_pb_toggle';
    $this->advanced_options = array(
      'fonts' => array(
        'title' => array(
          'label'    => esc_html__( 'Title', 'et_builder' ),
          'css'      => array(
            'main' => "{$this->main_css_element} h5",
          ),
        ),
        'body'   => array(
          'label'    => esc_html__( 'Body', 'et_builder' ),
          'css'      => array(
            'line_height' => "{$this->main_css_element} p",
          ),
        ),
      ),
      'background' => array(
        'settings' => array(
          'color' => 'alpha',
        ),
      ),
      'border' => array(),
      'custom_margin_padding' => array(
        'use_margin' => false,
        'css' => array(
          'important' => 'all',
        ),
      ),
    );
    $this->custom_css_options = array(
      'open_toggle' => array(
        'label'    => esc_html__( 'Open Toggle', 'et_builder' ),
        'selector' => '.et_pb_toggle_open',
      ),
      'toggle_title' => array(
        'label'    => esc_html__( 'Toggle Title', 'et_builder' ),
        'selector' => '.et_pb_toggle_title',
      ),
      'toggle_icon' => array(
        'label'    => esc_html__( 'Toggle Icon', 'et_builder' ),
        'selector' => '.et_pb_toggle_title:before',
      ),
      'toggle_content' => array(
        'label'    => esc_html__( 'Toggle Content', 'et_builder' ),
        'selector' => '.et_pb_toggle_content',
      ),
    );
  }

  function get_fields() {
    $fields = array(
      'include_categories' => array(
        'label'            => esc_html__( 'Include Categories', 'et_builder' ),
        'renderer'         => 'et_builder_include_general_categories_option',
        'option_category'  => 'basic_option',
        'description'      => esc_html__( 'Select the categories that you would like to include in the feed.', 'et_builder' ),
      ),
      'fullwidth' => array(
        'label'           => esc_html__( 'Layout', 'et_builder' ),
        'type'            => 'select',
        'option_category' => 'layout',
        'options'         => array(
          'off'  => esc_html__( 'Fullwidth', 'et_builder' ),
          'on' => esc_html__( 'Grid', 'et_builder' ),
        ),
        'description'       => esc_html__( 'Choose your desired portfolio layout style.', 'et_builder' ),
      ),
      'title' => array(
        'label'           => esc_html__( 'Title', 'et_builder' ),
        'type'            => 'text',
        'option_category' => 'basic_option',
        'description'     => esc_html__( 'The toggle title will appear above the content and when the toggle is closed.', 'et_builder' ),
      ),
      'open' => array(
        'label'           => esc_html__( 'State', 'et_builder' ),
        'type'            => 'select',
        'option_category' => 'basic_option',
        'options'         => array(
          'off' => esc_html__( 'Close', 'et_builder' ),
          'on'  => esc_html__( 'Open', 'et_builder' ),
        ),
        'description' => esc_html__( 'Choose whether or not this toggle should start in an open or closed state.', 'et_builder' ),
      ),
      'content_new' => array(
        'label'             => esc_html__( 'Content', 'et_builder' ),
        'type'              => 'tiny_mce',
        'option_category'   => 'basic_option',
        'description'       => esc_html__( 'Input the main text content for your module here.', 'et_builder' ),
      ),
      'open_toggle_background_color' => array(
        'label'             => esc_html__( 'Open Toggle Background Color', 'et_builder' ),
        'type'              => 'color-alpha',
        'custom_color'      => true,
        'tab_slug'          => 'advanced',
      ),
      'open_toggle_text_color' => array(
        'label'             => esc_html__( 'Open Toggle Text Color', 'et_builder' ),
        'type'              => 'color',
        'custom_color'      => true,
        'tab_slug'          => 'advanced',
      ),
      'closed_toggle_background_color' => array(
        'label'             => esc_html__( 'Closed Toggle Background Color', 'et_builder' ),
        'type'              => 'color-alpha',
        'custom_color'      => true,
        'tab_slug'          => 'advanced',
      ),
      'closed_toggle_text_color' => array(
        'label'             => esc_html__( 'Closed Toggle Text Color', 'et_builder' ),
        'type'              => 'color',
        'custom_color'      => true,
        'tab_slug'          => 'advanced',
      ),
      'icon_color' => array(
        'label'             => esc_html__( 'Icon Color', 'et_builder' ),
        'type'              => 'color',
        'custom_color'      => true,
        'tab_slug'          => 'advanced',
      ),
      'disabled_on' => array(
        'label'           => esc_html__( 'Disable on', 'et_builder' ),
        'type'            => 'multiple_checkboxes',
        'options'         => array(
          'phone'   => esc_html__( 'Phone', 'et_builder' ),
          'tablet'  => esc_html__( 'Tablet', 'et_builder' ),
          'desktop' => esc_html__( 'Desktop', 'et_builder' ),
        ),
        'additional_att'  => 'disable_on',
        'option_category' => 'configuration',
        'description'     => esc_html__( 'This will disable the module on selected devices', 'et_builder' ),
      ),
      'admin_label' => array(
        'label'       => esc_html__( 'Admin Label', 'et_builder' ),
        'type'        => 'text',
        'description' => esc_html__( 'This will change the label of the module in the builder for easy identification.', 'et_builder' ),
      ),
      'module_id' => array(
        'label'           => esc_html__( 'CSS ID', 'et_builder' ),
        'type'            => 'text',
        'option_category' => 'configuration',
        'tab_slug'        => 'custom_css',
        'option_class'    => 'et_pb_custom_css_regular',
      ),
      'module_class' => array(
        'label'           => esc_html__( 'CSS Class', 'et_builder' ),
        'type'            => 'text',
        'option_category' => 'configuration',
        'tab_slug'        => 'custom_css',
        'option_class'    => 'et_pb_custom_css_regular',
      ),
    );
    return $fields;
  }

  function shortcode_callback( $atts, $content = null, $function_name ) {
    $module_id                      = $this->shortcode_atts['module_id'];
    $module_class                   = $this->shortcode_atts['module_class'];
    $fullwidth                      = $this->shortcode_atts['fullwidth'];
    $include_categories             = $this->shortcode_atts['include_categories'];
    $title                          = $this->shortcode_atts['title'];
    $open                           = $this->shortcode_atts['open'];
    $open_toggle_background_color   = $this->shortcode_atts['open_toggle_background_color'];
    $closed_toggle_background_color = $this->shortcode_atts['closed_toggle_background_color'];
    $icon_color                     = $this->shortcode_atts['icon_color'];
    $closed_toggle_text_color       = $this->shortcode_atts['closed_toggle_text_color'];
    $open_toggle_text_color         = $this->shortcode_atts['open_toggle_text_color'];

    global $paged;

    $module_class = ET_Builder_Element::add_module_order_class( $module_class, $function_name );

    if ( '' !== $open_toggle_background_color ) {
      ET_Builder_Element::set_style( $function_name, array(
        'selector'    => '%%order_class%%.et_pb_toggle_open',
        'declaration' => sprintf(
          'background-color: %1$s;',
          esc_html( $open_toggle_background_color )
        ),
      ) );
    }

    if ( '' !== $closed_toggle_background_color ) {
      ET_Builder_Element::set_style( $function_name, array(
        'selector'    => '%%order_class%%.et_pb_toggle_close',
        'declaration' => sprintf(
          'background-color: %1$s;',
          esc_html( $closed_toggle_background_color )
        ),
      ) );
    }

    if ( '' !== $icon_color ) {
      ET_Builder_Element::set_style( $function_name, array(
        'selector'    => '%%order_class%% .et_pb_toggle_title:before',
        'declaration' => sprintf(
          'color: %1$s;',
          esc_html( $icon_color )
        ),
      ) );
    }

    if ( '' !== $closed_toggle_text_color ) {
      ET_Builder_Element::set_style( $function_name, array(
        'selector'    => '%%order_class%%.et_pb_toggle_close h5.et_pb_toggle_title',
        'declaration' => sprintf(
          'color: %1$s !important;',
          esc_html( $closed_toggle_text_color )
        ),
      ) );
    }

    if ( '' !== $open_toggle_text_color ) {
      ET_Builder_Element::set_style( $function_name, array(
        'selector'    => '%%order_class%%.et_pb_toggle_open h5.et_pb_toggle_title',
        'declaration' => sprintf(
          'color: %1$s !important;',
          esc_html( $open_toggle_text_color )
        ),
      ) );
    }

    $args = array(
      'posts_per_page' => -1,
      'post_type'      => 'public_agent',
    );

    $terms_category = '';
    $terms_states = '';
    $terms_party = '';
    $terms_job = '';
    $terms_genre = '';
    $terms_commission = '';
    $terms_position = '';
    $categories = explode( ',', $include_categories );
    foreach ($categories as $category) {

      $term = get_term($category);
      if (!is_wp_error($term)) {
        if($term->taxonomy === 'category'){
          $terms_category .= $terms_category ? ', ' . $category : $category;
        }
        if ($term->taxonomy === 'public_agent_state') {
          $terms_states .= $terms_states ? ', ' . $category : $category;
        }
        if ($term->taxonomy == 'public_agent_job') {
          $terms_job .= $terms_job ? ', ' . $category : $category;
        }
        if ($term->taxonomy == 'public_agent_genre') {
          $terms_genre .= $terms_genre ? ', ' . $category : $category;
        }
        if ($term->taxonomy == 'public_agent_party') {
          $terms_party .= $terms_party ? ', ' . $category : $category;
        }
        if ($term->taxonomy == 'public_agent_commission') {
          $terms_commission .= $terms_commission ? ', ' . $category : $category;
        }
        if ($term->taxonomy == 'public_agent_vote') {
          $terms_position .= $terms_position ? ', ' . $category : $category;
        }
      }
    }

    $settings_states = '';
    $settings_category = '';
    $settings_job = '';
    $settings_genre = '';
    $settings_party = '';
    $settings_commission = '';
    $settings_position = '';

    if ($terms_category){
      $settings_category = array(
          'taxonomy' => 'category',
          'field' => 'id',
          'terms' => explode( ',', $terms_category ),
          'operator' => 'IN',
        );
    } if ($terms_states) {
      $settings_states = array(
          'taxonomy' => 'public_agent_state',
          'field' => 'id',
          'terms' => explode( ',', $terms_states ),
          'operator' => 'IN',
        );
    } if ($terms_job) {
      $settings_job = array(
          'taxonomy' => 'public_agent_job',
          'field' => 'id',
          'terms' => explode( ',', $terms_job ),
          'operator' => 'IN',
        );
    } if ($terms_genre) {
      $settings_genre = array(
          'taxonomy' => 'public_agent_genre',
          'field' => 'id',
          'terms' => explode( ',', $terms_genre ),
          'operator' => 'IN',
        );
    } if ($terms_party) {
      $settings_party = array(
          'taxonomy' => 'public_agent_party',
          'field' => 'id',
          'terms' => explode( ',', $terms_party ),
          'operator' => 'IN',
        );
    } if ($terms_commission) {
      $settings_commission = array(
          'taxonomy' => 'public_agent_commission',
          'field' => 'id',
          'terms' => explode( ',', $terms_commission ),
          'operator' => 'IN',
        );
    } if ($terms_position) {
      $settings_position = array(
          'taxonomy' => 'public_agent_vote',
          'field' => 'id',
          'terms' => explode( ',', $terms_position ),
          'operator' => 'IN',
        );
    }

    if ( '' !== $include_categories )
      $args['tax_query'] = array(
        'relation' => 'AND',
        $settings_states,
        $settings_category,
        $settings_job,
        $settings_genre,
        $settings_party,
        $settings_commission,
        $settings_position
      );

    ob_start();

    query_posts( $args );

    $emails = '';
    $aux = '';
    $output = '';
    if ( have_posts() ) {
      $output .= '<textarea class="makepressure_clipboard">';
      while ( have_posts() ) {
          the_post();
          $emails = get_post_meta(  get_the_ID(), 'public_agent_email', true) ? get_post_meta(  get_the_ID(), 'public_agent_email', true):'';
          if ($emails) $aux .= $aux ? "," . $emails: $emails;
        }
        $output .= $aux;
      $output .= '</textarea>';
      wp_reset_query();
    } else {
      if ( et_is_builder_plugin_active() ) {
        include( ET_BUILDER_PLUGIN_DIR . 'includes/no-results.php' );
      } else {
        get_template_part( 'includes/no-results', 'index' );
      }
    }

    $output = sprintf(
      '<div%4$s class="et_pb_module et_pb_toggle %2$s%5$s">
        <h5 class="et_pb_toggle_title">%1$s</h5>
        <div class="et_pb_toggle_content clearfix">
          %3$s
        </div> <!-- .et_pb_toggle_content -->
      </div> <!-- .et_pb_toggle -->',
      esc_html( $title ),
      ( 'on' === $open ? 'et_pb_toggle_open' : 'et_pb_toggle_close' ),
      $this->shortcode_content.$output,
      ( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
      ( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' )
    );

    $posts = ob_get_contents();

    ob_end_clean();

    return $output;
  }
}
new ET_Builder_Module_Make_Pressure_ClipBoard;
