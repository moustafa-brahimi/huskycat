<?php 

/**
 * toggle switch control class
 * @package Huskycat
 * @since 0.0.1
 * 
 */

if( class_exists( 'Huskycat_Control' )  && !class_exists( 'Huskycat_Toggle_Switch' ) ):

    class Huskycat_Toggle_Switch_Control extends Huskycat_Control {

        public $type    =   'huskycat_toggle_switch';

        public function render_content() {

            $input_id_escaped           =   esc_attr( 'huskycat-' . $this->id );
		    $description_id_escaped     =   esc_attr( 'huskycat-description-' . $this->id );
            $describedby_attr           =   ( !empty( $this->description )  ? sprintf( ' aria-describedby="%s" ', $description_id_escaped ) : '' );
            $label_escaped              =   esc_html( $this->label );

            $output     =   '<div class="huskycat-control huskycat-toggle-switch-control">';

            // label

            if( $label_escaped ):

                $output .=   sprintf( 
                    
                    '<label for="%s"><span class="customize-control-title">%s</span></label>',
                    $input_id_escaped,
                    $label_escaped
                
                );
            
            endif;
            
            // description

            if( !empty( $this->description ) ):

                $output .=  sprintf( 
                    
                    '<span id="%s" class="description customize-control-description">%s</span>', 
                    $description_id_escaped,
                    esc_html( $this->description ),
                
                );

            endif;

            $output     .=  sprintf(

                '<input id="%s" class="huskycat-toggle-switch-input" %s type="checkbox" value="%s" %s/>',
                $input_id_escaped,
                $describedby_attr,
                esc_attr( $this->value() ),
                $this->get_link(),

            );


            $output     .=  '<span class="customize-inside-control-row huskycat-toggle">';

			$output     .=  sprintf( 
                
                '<label for="%s"><span class="toggle-ball"></span></label>',
                $input_id_escaped,
            );


            
            $output     .=  '</span>';
            $output     .=  '</div>';

            print( $output );


        }

    }

endif;