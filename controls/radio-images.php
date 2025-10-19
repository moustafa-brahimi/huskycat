<?php
/**
 * color palettes radio control class
 * @package huskycat
 * @since 0.0.1
 */

if( class_exists( 'Huskycat_Control' )  && !class_exists( 'Huskycat_Images_Radio_Control' ) ):

    class Huskycat_Images_Radio_Control extends Huskycat_Control {

        public $type    =   'huskycat_images_radio';
        
        protected function render_content() {

            if( empty( $this->choices ) ) { return; }

            $input_name_escaped     =   esc_attr( 'huskycat-images-radio-' . $this->id );
            $output                 =   '<div class="huskycat-control images-radio">';

            // label

            if( !empty( $this->label_escaped ) ):

                $output .=   sprintf( 
                    
                    '<label><span class="customize-control-title">%s</span></label>', 
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

            // choices

            foreach( $this->choices as $value => $choice ): 

                $value_escaped          =   esc_attr( $value );
                $choice_id_escaped      =   esc_attr( $this->input_id_escaped . $value );
                $label_escaped          =   ( isset( $choice[ 'label' ] ) ? esc_attr( $choice[ 'label' ] ) : '' );
                
                
                $output     .=  '<span class="images-radio__choice">';

                $output .=  sprintf( 
                    
                    '<input class="images-radio__input" type="radio" %s id="%s" name="%s" value="%s" %s/>', 
                    $this->get_link(), 
                    $choice_id_escaped,
                    $input_name_escaped, 
                    $value_escaped,
                    $this->describedby_escaped
                
                );
                
                $output .=  sprintf( 
                    
                    '<label for="%s" class="images-radio__wrapper" title="%s">',
                    $choice_id_escaped,
                    $label_escaped,
                
                );

                if( isset( $choice[ 'src' ] ) && filter_var( $choice[ 'src' ], FILTER_VALIDATE_URL) ):

                    $output .=  sprintf( '<img class="images-radio__image" src="%s"/>', esc_url( $choice[ 'src' ] ) );

                endif;


                $output .=  '</label>';
                $output .=  '</span>';


            endforeach;

            $output .=  '</div>';
            
            print( $output );

        }

    }

endif;