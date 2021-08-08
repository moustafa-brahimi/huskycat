<?php
/**
 * @package huskycat
 * @since 1.0.0
 */

if( class_exists( "WP_Customize_Control" ) && !class_exists( "Huskycat" ) ):

    class Huskycat extends WP_Customize_Control {

        public function enqueue( ) {
            
            wp_enqueue_style( "huskycat-style" );

        }

    }

endif;