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

            $input_id           =   'huskycat-' . $this->id;
            $input_name_escaped =   esc_attr( 'huskycat-images-radio-' . $this->id );
            $label_escaped      =   esc_html( $this->label );
            $description_escaped=   esc_html( $this->description );

            $output     =   '<div class="huskycat-control huskycat-images-radio-control">';

            // label

            if( !empty( $label_escaped ) ):

                $output .=   sprintf( 
                    
                    '<label><span class="customize-control-title">%s</span></label>', 
                    $label_escaped 
                
                );
            
            endif;
            
            // description

            if( !empty( $description_escaped ) ):

                $output .=  sprintf( 
                    
                    '<span class="description customize-control-description">%s</span>',
                    $description_escaped 
                
                );

            endif;

            // choices

            foreach( $this->choices as $value => $choice ): 

                $value_escaped          =   esc_attr( $value );
                $choice_id_escaped      =   esc_attr( $input_id . $value );
                $label_escaped          =   ( isset( $choice[ 'label' ] ) ? esc_attr( $choice[ 'label' ] ) : '' );
                $description_escaped    =   ( isset( $choice[ 'description' ] ) ? esc_attr( $choice[ 'description' ] ) : '' );
                
                
                $output     .=  '<span class="huskycat-image-option">';

                $output .=  sprintf( 
                    
                    '<input class="huskycat-image-input" type="radio" %s id="%s" name="%s" value="%s"/>', 
                    $this->get_link(), 
                    $choice_id_escaped,
                    $input_name_escaped, 
                    $value_escaped
                
                );
                
                $output .=  sprintf( 
                    
                    '<label for="%s" class="huskycat-image-wrapper" title="%s">',
                    $choice_id_escaped,
                    $label_escaped,
                
                );

                if( isset( $choice[ 'src' ] ) && filter_var( $choice[ 'src' ], FILTER_VALIDATE_URL) ):

                    $output .=  sprintf( '<img src="%s"/>', esc_url( $choice[ 'src' ] ) );

                endif;


                $output .=  '</label>';
                $output .=  '</span>';


            endforeach;

            $output .=  '</div>';
            
            print( $output );

        }

    }

endif;