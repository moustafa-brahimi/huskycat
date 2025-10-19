<?php 





if( class_exists( 'Huskycat_Control' )  && !class_exists( 'Huskycat_Select_Google_Font' ) ):

    class Huskycat_Select_Google_Font extends Huskycat_Control {

        public $type                =   'huskycat_select_google_font';
        
        public $font_size_min   =   10;
        public $font_size_max   =   128;
        public $font_size_unit  =   'px';
        
        public $letter_spacing_min  =   0;
        public $letter_spacing_max  =   2;
        public $letter_spacing_unit =   'em';
        
        
        public $line_height_min =   0;
        public $line_height_max =   5;
        public $line_height_unit=   'em';

        protected function render_content() {

            $output     =   "";

            /* input label */
            if ( ! empty( $this->label ) ):
                $output .=   sprintf( 
                    '<label for="%s" class="customize-control-title">%s</label>',
                    $this->input_id_escaped,
                    esc_html( $this->label ),
                );
            endif;
            
            /* input description */
            if ( ! empty( $this->description ) ):
                $output .=   sprintf(
                    '<span id="%1$s" class="description customize-control-description">%2$s</span>',
                    $this->description_id_escaped,
                    $this->description,
                );
            endif;

            $output     .=   '<div class="huskycat-control typography">';

            /** google fonts list */
            $file_path  =   ( Huskycat::path() . "helpers/google-fonts.json" );
            $raw_data   =   file_get_contents( $file_path );
            $fonts      =   json_decode( $raw_data, true );

            /* retrieving the saved font object */
            $saved_font_family  =   ( isset( $this->settings[ 'family' ] ) ? $this->settings[ 'family' ] ->value() : null );
            $saved_font_style   =   ( isset( $this->settings[ 'style' ] ) ? $this->settings[ 'style' ] ->value() : null );
            $saved_font         =   ( isset( $saved_font_family ) && !empty( $saved_font_family ) ?  $fonts[ $saved_font_family ] : null );

            $famiy_field_exists =   array_key_exists( 'family',  $this->settings );

            /*------------------------------------*\
            FAMILY
            \*------------------------------------*/

            if( array_key_exists( 'family',  $this->settings )  ) {

                $input_value    =   $this->settings[ 'family' ]->value();
                $default        =   $this->settings[ 'family' ]->default;

         
                $output     .=   '<div class="family">';

                $output     .=  sprintf(   
                    '<label for="%1s-family">%2s</label>',
                    $this->input_id_escaped,
                    esc_attr__( 'Font Family', 'evy' ),
                );

                $output     .=  sprintf( 
        
                    '<select id="%1$s-family" value="%2$s" %3$s %4$s  class="customize-control-select2 family__select">',
                    $this->input_id_escaped,
                    $input_value,
                    $this->describedby_escaped,
                    $this->get_link( 'family' ),
    
                );

                /** recommended fonts */

                if( !empty( $this->choices ) ):

                    $output .=  sprintf( '<optgroup class="recommended" label="%1s">', esc_attr__( 'Recommended', 'evy' ) );

                    foreach( $this->choices as $font_family ):

                        $output .=  sprintf( 
                            '<option value="%1s">%2s</option>',
                            $font_family,
                            $font_family,
                        );


                        if( isset( $fonts[ $font_family ] ) ):

                            unset( $fonts[ $font_family ] );

                        endif;


                    endforeach;

                    $output .=  '</optgroup>';


                endif;

                /** all fonts. */

                // if the developer provides recommended some fonts the rest will be hidden by default 
                $disabled   =   ( !empty( $this->choices ) ? 'disabled' : '' );

                $output     .=  sprintf( '<optgroup class="all" label="%1s" %2s>', esc_attr__( 'All fonts', 'evy' ), $disabled );

                foreach( $fonts as $font_family => $font ) {

                    $output .=  sprintf( 
                        '<option value="%1s">%2s</option>',
                        $font_family,
                        $font_family,
                    );

                    
                }
                    
                $output .=  '</optgroup>';

                $output .= "</select>";

                                        
                if( !empty( $default ) ):
                    
                    $output .=  sprintf( 
                        '<span class="description">%1$s : %2$s</span>',
                        esc_html__( 'Default', 'evy' ),
                        esc_html( $default ),
                    );

                endif;

                if( !empty( $this->choices ) ):

                    $output .= "<span class='family__extra-options'>";

                    $output .= sprintf( 
                        '<input type="checkbox" checked class="family__recommend" value="true" id="%s-show-all" />',
                        $this->input_id_escaped,
                    );

                    $output .= sprintf( 
                        "<label for='%s-show-all' >%s</label>", 
                        $this->input_id_escaped,
                        esc_html__( 'Show Recommended Fonts Only', 'evy' ),
                    );

                    $output .= "</span>";


                endif;

                

                $output .=  '</div>';

            }


            /*------------------------------------*\
            STYLE
            \*------------------------------------*/

            if( array_key_exists( 'style',  $this->settings )  ) {

                $input_value        =   $this->settings[ 'style' ]->value();
                $default            =   $this->settings[ 'style' ]->default;

                // if the control support family field
                    // if we have a saved font setting we'll display it styls
                    // else the field will be disabled until the user choose a font family
                // else
                    //  we will display a set of standard options from 100 to 900

                    

                $output     .=   '<div class="style">';

                $output     .=  sprintf(   
                    '<label for="%1s-style">%2s</label>',
                    $this->input_id_escaped,
                    esc_attr__( 'Style', 'evy' ),
                );

                $disabled   =   ( $famiy_field_exists && !$saved_font ? 'disabled' : '' );
                $class      =   'style__select' . ( $famiy_field_exists ? ' style__select--dynamic' : '' );

                $output     .=  sprintf( 
        
                    '<select id="%1$s-style" value="%2$s" %3$s %4$s  %5$s class="%6$s">',
                    $this->input_id_escaped,
                    $input_value,
                    $this->describedby_escaped,
                    $this->get_link( 'style' ),
                    $disabled,
                    $class
                );


                if( $famiy_field_exists  && $saved_font && isset( $saved_font[ 'variants' ] ) ):

                    foreach( array_keys( $saved_font[ 'variants' ] ) as $style ):

                        $output .=  sprintf( '<option value="%1$s">%2$s</option>', $style, $style );

                    endforeach;

                else:

                    $output .=  sprintf( '<option value="normal">%1$s</option>', esc_html__( 'normal', 'evy' ) );
                    $output .=  sprintf( '<option value="italic">%1$s</option>', esc_html__( 'italic', 'evy' ) );
                    $output .=  sprintf( '<option value="oblique">%1$s</option>', esc_html__( 'oblique', 'evy' ) );

                endif;


                $output .= '</select>';
                
                if( !empty( $default ) ):
                    
                    $output .=  sprintf( 
                        '<span class="description">%1$s : %2$s</span>',
                        esc_html__( 'Default', 'evy' ),
                        esc_html( $default ),
                    );

                endif;
                

                $output .= '</div>';
                    

            }



            /*------------------------------------*\
            WEIGHT
            \*------------------------------------*/

            if( array_key_exists( 'weight',  $this->settings )  ) {

                $input_value        =   $this->settings[ 'weight' ]->value();
                $default            =   $this->settings[ 'weight' ]->default;

                /**
                 * if we have a saved style and a font family we'll show the weights available to that font
                 * else if the family field doesn't exsist we'll show a set of standard options 
                 * it disabled until the user choose a font
                 */


                $output     .=   '<div class="weight">';

                $output     .=  sprintf(   
                    '<label for="%1s-weight">%2s</label>',
                    $this->input_id_escaped,
                    esc_attr__( 'Weight', 'evy' ),
                );


                $disabled   =   ( $famiy_field_exists && !( $saved_font && $saved_font_style ) ? 'disabled' : '' );
                $class      =   'weight__select' . ( $famiy_field_exists ? ' weight__select--dynamic' : '' );

                $output     .=  sprintf( 
        
                    '<select id="%1$s-weight" type="hidden" value="%2$s" %3$s %4$s %5$s  class="%6$s">',
                    $this->input_id_escaped,
                    $input_value,
                    $this->describedby_escaped,
                    $this->get_link( 'weight' ),
                    $disabled,
                    $class
    
                );

                if( $famiy_field_exists && isset( $saved_font[ 'variants' ] ) && isset( $saved_font[ 'variants' ][ $saved_font_style ] ) ):

                    foreach( $saved_font[ 'variants' ][ $saved_font_style ] as $weight => $url ):

                        $output .=  sprintf( '<option value="%1$s">%2$s</option>', $weight, $weight );

                    endforeach;

                else:

                    for( $i = 100; $i <= 900; $i += 100 ):

                        $output .=  sprintf( '<option value="%1$d">%2$d</option>', $i, $i );


                    endfor;

                endif;

                $output .= '</select>';
                                        
                if( !empty( $default ) ):
                    
                    $output .=  sprintf( 
                        '<span class="description">%1$s : %2$s</span>',
                        esc_html__( 'Default', 'evy' ),
                        esc_html( $default ),
                    );

                endif;

                $output .= '</div>';

            }

            foreach( $this->settings as $setting_type => $value ) {
                
                $input_value    =   $value->value();
                $default        =   $value->default;


                switch( $setting_type ):

                    


                    case 'weight':



                    break;

                    case 'size':

                        $output .=  '<div class="size">';
                        $output .=  sprintf( 
                            '<label for="%1$s-size-numeric" >%2$s</label>',
                            $this->input_id_escaped,
                            esc_html__( 'Font Size', 'evy' ),
                        );
                        
                        $output .=  '<div class="size__container">';
                                                
                        $output .=  '<div class="size__main">';

                        $output .=  sprintf(
                            
                            '<input type="number" class="size__input" id="%1s-size-numeric" min="%2$s" max="%3$s" value="%4$s" %5$s>',
                            $this->input_id_escaped,
                            esc_attr( $this->font_size_min ),
                            esc_attr( $this->font_size_max ),
                            esc_attr( $input_value ),
                            $this->get_link( $setting_type ),
                        
                        );


                        $output .=  sprintf( 
                        
                            '<label class="size__unit" for="%1s-size-numeric" type="number">%2s</label>',
                            $this->input_id_escaped,
                            esc_html( $this->font_size_unit ),
                        
                        );
                        $output .=  '</div>';

                        $output .=  sprintf( 
                            
                            '<input class="size__hero" type="range" step="0.05" id="%1$s-size-hero" min="%2$s" max="%3$s" value="%4$s" >',
                            $this->input_id_escaped,
                            esc_attr( $this->font_size_min ),
                            esc_attr( $this->font_size_max ),
                            esc_attr( $input_value ),
                                                    
                        );

                        
                        $output .=  '</div>';
                                                
                        if( !empty( $default ) ):
                            
                            $output .=  sprintf( 
                                '<span class="description">%1$s : %2$s%3$s</span>',
                                esc_html__( 'Default', 'evy' ),
                                esc_html( $default ),
                                esc_html( $this->font_size_unit ),
                            );

                        endif;

                        $output .=  '</div>';


                    break;


                    case 'letter_spacing':

                        $output .=  '<div class="letter-spacing">';
                        $output .=  sprintf( '<label type="range" >%s</label>', esc_html__( 'Letter Spacing', 'evy' ) );
                        
                        $output .=  '<div class="letter-spacing__container">';
                                                
                        $output .=  '<div class="letter-spacing__main">';

                        $output .=  sprintf(
                            
                            '<input type="number" class="letter-spacing__input" id="%1$s-letter-spacing-numeric" min="%2$s" max="%3$s" value="%4$s" %5$s>',
                            $this->input_id_escaped,
                            esc_attr( $this->letter_spacing_min ),
                            esc_attr( $this->letter_spacing_max ),
                            esc_attr( $input_value ),
                            $this->get_link( $setting_type ),
                        
                        );


                        $output .=  sprintf( 
                        
                            '<label class="letter-spacing__unit" for="%1s-letter-spacing-numeric" type="number">%2s</label>',
                            $this->input_id_escaped,
                            esc_html( $this->letter_spacing_unit ),
                        
                        );
                        $output .=  '</div>';

                        $output .=  sprintf( 
                            
                            '<input class="letter-spacing__hero" type="range" step="0.05" id="%1$s-letter-spacing-hero" min="%2$s" max="%3$s" value="%4$s" >',
                            $this->input_id_escaped,
                            esc_attr( $this->letter_spacing_min ),
                            esc_attr( $this->letter_spacing_max ),
                            esc_attr( $input_value ),
                        
                        );

                        
                        $output .=  '</div>';
                  
                        if( !empty( $default ) ):
                            
                            $output .=  sprintf( 
                                '<span class="description">%1$s : %2$s%3$s</span>',
                                esc_html__( 'Default', 'evy' ),
                                esc_html( $default ),
                                esc_html( $this->letter_spacing_unit ),
                            );

                        endif;
                        
                        $output .=  '</div>';


                    break;

                    case 'line_height':

                        $output .=  '<div class="line-height">';
                        $output .=  sprintf( '<label>%s</label>', esc_html__( 'Line Height', 'evy' ) );
                        
                        $output .=  '<div class="line-height__container">';
                                                
                        $output .=  '<div class="line-height__main">';

                        $output .=  sprintf(
                            
                            '<input type="number" class="line-height__input" id="%1s-line-height-numeric" min="%2$s" max="%3$s" value="%4s" %5$s>',
                            $this->input_id_escaped,
                            $this->line_height_min,
                            $this->line_height_max,
                            $input_value,
                            $this->get_link( $setting_type ),

                        );


                        $output .=  sprintf( 
                        
                            '<label class="line-height__unit" for="%1$s-line-height-numeric" type="number">%2$s</label>',
                            $this->input_id_escaped,
                            esc_html( $this->line_height_unit ),
                        
                        );
                        $output .=  '</div>';

                        $output .=  sprintf( 
                            
                            '<input class="line-height__hero" type="range" step="0.05" id="%1$s-size-hero" min="%2$s" max="%3$s" value="%4$s">',
                            $this->input_id_escaped,
                            $this->line_height_min,
                            $this->line_height_max,
                            $input_value,
                        
                        );

                        
                        $output .=  '</div>';
                        
                        if( !empty( $default ) ):
                            
                            $output .=  sprintf( 
                                '<span class="description">%1$s : %2$s%3$s</span>',
                                esc_html__( 'Default', 'evy' ),
                                esc_html( $default ),
                                esc_html( $this->line_height_unit ),
                            );

                        endif;

                        $output .=  '</div>';

                    break;

                    case 'transform':

                        $output .=  '<div class="transform">';

                        $options =  [

                            'uppercase' =>  esc_attr__( 'UPPERCASE', 'evy' ),
                            'lowercase' =>  esc_attr__( 'lowercase', 'evy' ),
                            'capitalize'=>  esc_attr__( 'Capitalize', 'evy' ),
                            'none'      =>  esc_attr__( 'None', 'evy' ),

                        ];
                        
                        $output .=  sprintf( 
                            '<label for="%2$s-transform">%s</label>',
                            esc_html__( 'Transform', 'evy' ),
                            $this->input_id_escaped
                        );

                        $output .=  sprintf( 
                            
                            '<select class="transform__select" id="%1$s-transform" value="%2$s" %3$s>',
                            $this->input_id_escaped,
                            esc_attr( $input_value ),
                            $this->get_link( $setting_type ),
                            
                        );

                        foreach( $options as $value => $label ):

                        $output .=  sprintf( '<option value="%1$s">%2$s</option>', esc_attr( $value ), $label );

                        endforeach;
                        
                        $output .=  '</select>';

                                                                   
                        if( !empty( $default ) ):
                            
                            $output .=  sprintf( 
                                '<span class="description">%1$s : %2$s</span>',
                                esc_html__( 'Default', 'evy' ),
                                esc_html( $default ),
                            );

                        endif;

                        $output .=  '</div>';


                    break;

                endswitch;

            }

            $output .=  "</div>";

            echo $output;


        }

        public function enqueue() {

            wp_enqueue_script( 'select2' );
            wp_enqueue_style( 'select2-style' );

        }

    }

endif;
?>