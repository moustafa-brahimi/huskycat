<?php
/**
 * @package huskycat
 * @since 0.0.1
 * a class contains common methods that the huskycat controls share
 */


if( class_exists( 'WP_Customize_Control' ) && !class_exists( 'Huskycat_Control' ) ):

    class Huskycat_Control extends WP_Customize_Control {

        public function enqueue( ) {
                        
            wp_enqueue_style( 'huskycat-style' );

        }

    }

endif;