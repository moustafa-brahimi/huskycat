<?php
/**
 * color palettes radio control class
 * @package huskycat
 * @since 0.0.1
 */

if( class_exists( 'Huskycat_Control' )  && !class_exists( 'Huskycat_Color_Palettes_Radio_Control' ) ):

    class Huskycat_Color_Palettes_Radio_Control extends Huskycat_Control {

        public $type    =   'huskycat_color_palettes_radio';
        
        protected function render_content() {

            if( empty( $this->choices ) ) { return; }

            $input_name_escaped     =   esc_attr( 'huskycat-color-palettes-radio-' . $this->id );
            $output     =   '<div class="huskycat-control palettes-radio">';

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
                    $this->description
                );

            endif;


            // choices

            foreach( $this->choices as $value => $choice ): 

                $value_escaped          =   esc_attr( $value );
                $choice_id_escaped      =   esc_attr( $this->input_id_escaped . $value );
                $label_escaped          =   ( isset( $choice[ 'label' ] ) ? esc_attr( $choice[ 'label' ] ) : '' );
                $description            =   ( isset( $choice[ 'description' ] ) ? $choice[ 'description' ] : '' );
                
                
                $output     .=  '<span class="customize-inside-control-row palette">';

                if( !empty( $label_escaped ) ):

                    $output .=   sprintf( 
                        
                        '<label for="%s"><span class="customize-control-title">%s</span></label>',
                        $choice_id_escaped,
                        $label_escaped
                    
                    );

                endif;

                if( !empty( $description  ) ):

                    $output .=  sprintf( 
                        
                        '<span class="description customize-control-description">%s</span>', 
                        $description
                    
                    );

                endif;

                $output .=  sprintf( 
                    
                    '<input class="palette__input" type="radio" %s id="%s" name="%s" value="%s" %s/>', 
                    $this->get_link(), 
                    $choice_id_escaped,
                    $input_name_escaped, 
                    $value_escaped,
                    $this->describedby_escaped
                
                );
                
                $output .=  sprintf( 
                    
                    '<label for="%s" class="palette__wrapper">',
                    $choice_id_escaped
                
                );

                $colors     =   ( isset( $choice[ 'colors' ] ) && is_array( $choice[ 'colors' ] ) ? $choice[ 'colors' ] : array() );
                $colors     =   array_filter( $colors, 'sanitize_hex_color' );

                $max_colors = 6;

                foreach( array_map( 'esc_attr', $colors ) as $color ):
                    if( --$max_colors < 0 ) { break; }


                    $output .=  sprintf( 
                        
                        '<div class="palette__color" style="background-color:%s;"></div>',
                        $color, 
                    
                    );

                endforeach;


                $output .=  '</label>';
                $output .=  '</span>';


            endforeach;

            $output .=  '</div>';
            
            print( $output );

        }

    }

endif;