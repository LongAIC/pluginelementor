<?php

use Elementor\Controls_Manager;
use ElementorPro\Base\Base_Widget;
class Slides extends Base_Widget {
    public function get_name() {
        'slides';
    }

    public function get_title() {
        return esc_html__('Slides', '');
    }

    public function get_icon() {
        return 'eicon-code';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    public function get_keywords() {
        return ['slides'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'sections_slides',
            [
                'label' => esc_html__('Slides')
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $this->add_inline_editing_attributes( 'description', 'basic' );
        ?>

        <h3 class="hello-world" style="color:<?php echo $settings['color']; ?>">
            <?php echo $settings['title']; ?>
        </h3>
        <img src="<?php echo $settings['image']['url']; ?>">
        <ul>
            <?php foreach ( $settings['list'] as $index => $item ) : ?>
                <li>
                    <?php
                    if ( ! $item['link']['url'] ) {
                        echo $item['text'];
                    } else {
                        ?><a href="<?php echo esc_url( $item['link']['url'] ); ?>"><?php echo $item['text']; ?></a><?php
                    }
                    ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <div <?php echo $this->get_render_attribute_string( 'description' ); ?>><?php echo $settings['description']; ?></div>

        <?php

    }

}

