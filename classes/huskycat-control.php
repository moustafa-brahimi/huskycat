<?php
/**
 * @package huskycat
 * @since 0.0.1
 * a class contains common methods that the huskycat controls share
 */


if( class_exists( 'WP_Customize_Control' ) && !class_exists( 'Huskycat_Control' ) ):

    class Huskycat_Control extends WP_Customize_Control {

        public function __construct( $wp_customize, $setting_id, $args ) {

            parent::__construct( $wp_customize, $setting_id, $args );

            $this->input_id_escaped       =   esc_attr( 'huskycat-' . $this->id );
		    $this->description_id_escaped =   esc_attr( 'huskycat-description-' . $this->id );
            $this->describedby_escaped    =   ( !empty( $this->description )  ? sprintf( ' aria-describedby="%s" ', $this->description_id_escaped ) : '' );
            $this->label_escaped          =   esc_html( $this->label );

        }

        public function enqueue() {
                        
            wp_enqueue_style( 'huskycat-style' );

        }

    }

endif;