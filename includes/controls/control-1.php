<?php 
    class Control_1 extends \Elementor\Base_Data_Control {
        public function get_type() {
            return 'product_custom_id';
        }

        public function content_template() {
            ?>
            <div class="elementor-control-field">
                <label class="elementor-control-title">{{{ data.label }}}</label>
                <div class="elementor-control-input-wrapper">
                    <select class="elementor-control-tag-area" data-setting="{{ data.name }}">
                        <# _.each( data.options, function( option_title, option_value ) { #>
                        <option value="{{ option_value }}">{{{ option_title }}}</option>
                        <# } ); #>
                    </select>
                </div>
            </div>
            <# if ( data.description ) { #>
            <div class="elementor-control-field-description">{{{ data.description }}}</div>
            <# } #>
            <?php
        }

        protected function get_default_settings() {
            return [
                'label_block' => true,
                'options' => $this->get_product_id_options(),
            ];
        }

        private function get_product_id_options() {
            $product_query = new \WP_Query( [
                'post_type' => 'product',
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'fields' => 'ids',
            ] );

            $product_ids = $product_query->posts;

            $options = [];

            foreach ( $product_ids as $product_id ) {
                $product = wc_get_product( $product_id );
                $options[ $product_id ] = $product->get_title();
            }

            return $options;
        }
    }


