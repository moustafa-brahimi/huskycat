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
            
            $output     =   '<div class="huskycat-control toggle">';

            // label

            if( $this->label_escaped ):

                $output .=   sprintf( 
                    
                    '<label for="%s"><span class="customize-control-title">%s</span></label>',
                    $this->input_id_escaped,
                    $this->label_escaped
                
                );
            
            endif;
            
            // description

            if( !empty( $this->description ) ):

                $output .=  sprintf( 
                    
                    '<span id="%s" class="description customize-control-description">%s</span>', 
                    $this->description_id_escaped,
                    $this->description,
                
                );

            endif;

            $output     .=  sprintf(

                '<input id="%s" class="toggle__input" %s type="checkbox" value="%s" %s/>',
                $this->input_id_escaped,
                $this->describedby_escaped,
                esc_attr( $this->value() ),
                $this->get_link(),

            );

            $output     .=  '<span class="customize-inside-control-row toggle__container">';

			$output     .=  sprintf( 
                
                '<label class="toggle__label" for="%s"><span class="toggle__hero"></span></label>',
                $this->input_id_escaped,
            );

            $output     .=  '</span>';
            $output     .=  '</div>';

            print( $output );


        }

    }

endif;