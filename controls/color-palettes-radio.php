<?php
/**
 * @package huskycat
 * @since 1.0.0
 */

if( class_exists( "Huskycat_Control" )  && !class_exists( "Huskycat_Color_Collections_Radio_Control" ) ):

    class Huskycat_Color_Palettes_Radio_Control extends Huskycat_Control {

        public $type    =   "huskycat_color_palettes_radio";
        

        protected function render_content() {

            if( empty( $this->choices ) ) { return; }

            $input_id   =   'huskycat-' . $this->id;
            $input_name =   'huskycat-color-palettes-radio-' . $this->id;

            $output     =   "<div class='huskycat-control huskycat-color-palettes-radio-control'>";

            // label

            if( !empty( $this->label ) ):

                $output .=   sprintf( "<label><span class='customize-control-title'>%s</span></label>", esc_html( $this->label ) );
            
            endif;
            
            // description

            if( !empty( $this->description ) ):

                $output .=  sprintf( "<span class='description customize-control-description'>%s</span>", esc_html( $this->description ) );

            endif;

            // choices

            foreach( $this->choices as $value => $choice ): 

                $choice_id_escaped  =   esc_attr( $input_id . $value );

                $output     .=  "<span class='customize-inside-control-row huskycat-palette'>";

                if( isset( $choice[ "label" ] ) && !empty( $choice[ "label" ] ) ):

                    $output .=   sprintf( "<label for='%s'><span class='customize-control-title'>%s</span></label>", $choice_id_escaped, esc_html( $choice[ "label" ] ) );

                endif;

                if( isset( $choice[ "description" ] ) && !empty( $choice[ "description" ]  ) ):

                    $output .=  sprintf( "<span class='description customize-control-description'>%s</span>", esc_html( $choice[ "description" ] ) );

                endif;

                $output .=  sprintf( "<input class='huskycat-palette-input' type='radio' %s id='%s' name='%s' value='%s'/>", $this->get_link(), $choice_id_escaped, $input_name, $value );
                
                $output .=  sprintf( "<label for='%s' class='huskycat-palette-wrapper'>",  $choice_id_escaped );


                if( isset( $choice[ "colors" ] ) && !empty( $choice[ "colors" ] ) && is_array( $choice[ "colors" ] ) ) {

                    foreach( $choice[ "colors" ] as $color ):

                        $output .=  sprintf( "<div class='huskycat-palette-color' style='background-color:%s;'></div>", esc_attr( $color ) );

                    endforeach;

                }

                $output .=  "</label>";
                $output .=  "</span>";


            endforeach;

            $output .=  "</div>";
            
            print( $output );

        }

    }

endif;