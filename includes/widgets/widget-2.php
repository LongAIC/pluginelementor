<?php

use Elementor\Group_Control_Css_Filter;
use Elementor\Repeater;
use Elementor\Controls_Manager;

class Widget_2 extends \Elementor\Widget_Base {
    public function get_name() {
		return 'popup';
	}

	public function get_title() {
		return esc_html__( 'Pop Up', 'textdomain' );
	}

	public function get_icon() {
		return 'eicon-code';
	}

	public function get_custom_help_url() {
		return 'https://go.elementor.com/widget-name';
	}

	public function get_categories() {
		return [ 'ftech_extension' ];
	}

	public function get_keywords() {
		return [ 'keyword', 'keyword' ];
	}

	public function get_style_depends() {
		return [ 'widgets-2-style', 'mag-popup' ];
	}

	public function get_script_depends() {
		return [ 'jquery-popup','popup-min', 'widgets-2-script' ];
	}

    protected function register_controls() {
        $this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this -> add_control(
            'product_id',
            [
                'label' => esc_html__( 'Chọn sản phẩm', 'textdomain' ),
                'type' => 'product_custom_id'
            ]
        );

        $this -> add_control(
            'image',
            [
                'label' => esc_html__( 'Image','' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],

            ]
        );



        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_popup_image',
            [
                'label'=>esc_html__('Image',''),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'background_image',
            [
                'type' => \Elementor\Controls_Manager::COLOR,
                'label' => esc_html__( 'Color', '' ),
                'default' => '#FFFFFF',
                'selectors' => [
            ' .img_hotspot_container' => 'background:{{VALUE}};',
        ]
            ]
        );

        $this->add_responsive_control(
            'width_image',
            [
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label' => esc_html__( 'Width', 'textdomain' ),
                'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100
                        ],
                        'px' => [
                                'min' => 0,
                                'max' => 1000,
                        ]

                ],
                'size_units' => [ '%', 'px' ],
                'default' => [
                    'size' => 100,
                    'unit' => '%'
                ],
                'selectors' => [
                    ' .img_hotspot' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'height_image',
            [
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label' => esc_html__( 'Height', 'textdomain' ),
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100
                    ],
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ]

                ],
                'size_units' => [ '%', 'px' ],
                'default' => [
                    'size' => 100,
                    'unit' => '%'
                ],
                'selectors' => [
                    '{{WRAPPER}} .img_hotspot' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'elementor-pro' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .img_hotspot' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'image_css_filters',
                'selector' => '{{WRAPPER}} .img_hotspot',
            ]
        );

        $this->end_controls_section();



        $this->start_controls_section(
            'section_style_popup_hotspot',
            [
                'label'=>esc_html__('Hotspot',''),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_responsive_control(
            'width_hotspot',
            [
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label' => esc_html__( 'Width', 'textdomain' ),
                'range' => [
                    'min' => 0,
                    'max' => 100
                ],
                'default' => [
                    'size' => 50,
                ],
            ]
        );

        $repeater->add_responsive_control(
            'height_hotspot',
            [
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label' => esc_html__( 'Height', 'textdomain' ),
                'range' => [
                    'min' => 0,
                    'max' => 100
                ],
                'default' => [
                    'size' => 35,
                ],
            ]
        );

        $repeater->add_responsive_control(
            'top_hotspot',
            [
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label' => esc_html__( 'Top', 'textdomain' ),
                'range' => [
                    'min' => 0,
                    'max' => 100
                ],
                'default' => [
                    'size' => 29,
                ],
            ]
        );

        $repeater->add_responsive_control(
            'left_hotspot',
            [
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label' => esc_html__( 'Left', 'textdomain' ),
                'range' => [
                    'min' => 0,
                    'max' => 100
                ],
                'default' => [
                    'size' => 19,
                ],
            ]
        );

        $this->add_control(
            'hotspot_items',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );


        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $hospots = [];
        foreach ( $settings['hotspot_items'] as $hotspot ) {
            $hotspot_html = '';

            $hotspot_html .= '<a class="hotspots_link" style="top:'. $hotspot['top_hotspot']['size'] .'%; left:'. $hotspot['left_hotspot']['size'] .'%;  width:'. $hotspot['width_hotspot']['size'].'%; height: '. $hotspot['height_hotspot']['size'].'%;">';

            $hotspot_html .= '<div class="hotspot_title_container" >';

            $hotspot_html .= '<span class="hotspot_title" >More Info</span>';

            $hotspot_html .= '</div></a>';

            $hospots[] = $hotspot_html;

        }


// Output the button HTML with the added render attributes

        ?>
		 <article class="hotspots_layer">
			<div class="img_hotspot_container ">
				<img class="img_hotspot " src="<?php echo $settings['image']['url'] ?>"  alt="">
			</div>
            <?php echo implode( '', $hospots ); ?>
		 </article>
         <?php 
    
    }

	


}