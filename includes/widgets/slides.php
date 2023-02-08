<?php

use Elementor\Controls_Manager;
use ElementorPro\Base\Base_Widget;
use Elementor\Repeater;
use Elementor\Icons_Manager;

class SlidesExtension extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'slides-ftech';
    }

    public function get_title()
    {
        return esc_html__('Slides', '');
    }

    public function get_icon()
    {
        return 'eicon-code';
    }

    public function get_categories()
    {
        return ['ftech_extension'];
    }

    public function get_keywords()
    {
        return ['slides-ex'];
    }

    public function get_style_depends() {
        return [ 'widget-carousel-rtl' ];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'sections_slides',
            [
                'label' => esc_html__('Slides', ''),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->start_controls_tabs('slides_repeater');

        $repeater->start_controls_tab(
            'background',
            [
                'label' => esc_html__('Background', ''),
            ]
        );


        $repeater->add_control(
            'background_color',
            [
                'label' => esc_html__('Color', ''),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selector' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .swiper-slide-bg' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            'content',
            [
                'label' => esc_html__('Content', ''),
            ]
        );

        $repeater->add_control(
            'heading',
            [
                'label' => esc_html__('Title & Description', ''),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Slide Heading', ''),
                'label_block' => true,
                'dynamic' => [
                    'active' => true
                ],
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => esc_html__('Description', ''),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor-pro'),
                'show_label' => false,
                'dynamic' => [
                    'active' => true
                ],
            ]
        );

        $repeater->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', ''),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Click Here', ''),
                'dynamic' => [
                    'active' => true,
                ],
            ]

        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            'style',
            [
                'label' => esc_html__('Style', ''),
            ]
        );

        $repeater->end_controls_tab();

        $repeater->end_controls_tabs();

        $this->add_control(
            'slides',
            [
                'label' => esc_html__('Slides', ''),
                'type' => Controls_Manager::REPEATER,
                'show_label' => true,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'heading' => esc_html__('Slide 1 Heading', 'elementor-pro'),
                        'description' => esc_html__('Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'elementor-pro'),
                        'button_text' => esc_html__('Click Here', 'elementor-pro'),
                        'background_color' => '#833ca3',
                    ],
                    [
                        'heading' => esc_html__('Slide 2 Heading', 'elementor-pro'),
                        'description' => esc_html__('Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'elementor-pro'),
                        'button_text' => esc_html__('Click Here', 'elementor-pro'),
                        'background_color' => '#4054b2',
                    ],
                    [
                        'heading' => esc_html__('Slide 3 Heading', 'elementor-pro'),
                        'description' => esc_html__('Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'elementor-pro'),
                        'button_text' => esc_html__('Click Here', 'elementor-pro'),
                        'background_color' => '#1abc9c',
                    ],
                ],
                'title_field' => '{{heading}}'
            ]
        );

        $this->add_control(
            'TRUNG',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Title', 'textdomain'),
                'placeholder' => esc_html__('Enter your title', 'textdomain'),
            ]
        );
//
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
//        if (!empty($settings['slides'])) {
//            return;
//        }

        $slides = [];
        $slide_count = 0;
        $show_dots = true;
        $show_arrows = true;

        foreach ($settings['slides'] as $slide) {
            $slide_html = '';
            $btn_attributes = '';
            $slide_attributes = '';
            $slide_element = 'div';
            $btn_element = 'div';

            $slide_html .= '<' . $slide_element . 'class = swiper-slide-inner' . $slide_attributes . '>';
            $slide_html .= '<div class ="swiper-slide-content">';

            if ($slide['heading']) {
                $slide_html .= '<div class="elementor-slide-heading" >' . $slide['heading'] . '</div>';
            }

            if ($slide['description']) {
                $slide_html .= '<div class="elementor-slide-description">' . $slide['description'] . '</div>';
            }

            if ($slide['button_text']) {
                $slide_html .= '<' . $btn_element . ' ' . $btn_attributes . '>' . $slide['button_text'] . '</' . $btn_element . '>';
            }

            $slide_html .= '</div></' . $slide_element;
            $slides[] = '<div class="elementor-repeater-item-' . $slide['_id'] . ' swiper-slide">' . $slide_html . '</div>';
            $slide_count++;
        }
        $slides_count = count($settings['slides']);
        ?>
            <div class="elementor-swiper">
                <div class="elementor-slides-wrapper elementor-main-swiper swiper-container">
                    <div class="swiper-wrapper elementor-slides">
                        <?php // PHPCS - Slides for each is safe.?>
                        <?php echo implode('', $slides); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                        ?>
                    </div>
                    <?php if (1 < $slides_count) : ?>
                        <?php if ($show_dots) : ?>
                            <div class="swiper-pagination"></div>
                        <?php endif ?>
                    <?php if ($show_arrows) : ?>
                        <div class="elementor-swiper-button elementor-swiper-button-prev">
                            <?php $this->render_swiper_button('previous'); ?>
                            <span class="elementor-screen-only">
                                <?php echo esc_html__('Previous', ''); ?>
                            </span>
                        </div>
                        <div class="elementor-swiper-button elementor-swiper-button-next">
                            <?php $this->render_swiper_button('next'); ?>
                            <span class="elementor-screen-only">
                                <?php esc_html__('Next', ''); ?>
                            </span>
                        </div>
                    <?php endif; ?>
                    <?php endif; ?>
                </div>
        </div>
        <?php
    }
    private function render_swiper_button ($type) {
        $direction = 'next' === $type ? 'right' : 'left';
        if (is_rtl()) {
            $direction = 'right' === $direction ? 'left' : 'right';
        }

        $icon_value = 'eicon-chevron-' . $direction;

        Icons_Manager::render_icon([
                'library' => 'eicons',
                'value' => $icon_value,
        ], ['aria-hiddon' => 'true']);
    }
}



