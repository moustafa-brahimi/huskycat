<?php
/**
 * 
 * @package storyteller
 * @since 1.0.0
 */


if( class_exists( "WP_Customize_Control" ) && !class_exists( "Storyteller_Color_Collections_Control" ) ):

    class Storyteller_Color_Collections_Control extends WP_Customize_Control {

        public $type    =   "storyteller-color-collections";

        protected function render_content() {
            
            //

            if( empty( $this->choices ) ) { return; }

            $input_id           =   'storyteller-' . $this->id;
            $input_name         =   'storyteller-collection-' . $this->id;

            $output =   "";

            if( !empty( $this->label ) ):

                $output .=   sprintf( "<label><span class='customize-control-title'>%s</span></label>", esc_html( $this->label ) );
            
            endif;
            
            if( !empty( $this->description ) ):

                $output .=  sprintf( "<span class='description customize-control-description'>%s</span>", esc_html( $this->description ) );

            endif;

            foreach( $this->choices as $value => $choice ): 


                $choice_id  =   $input_id . $value;

                $output .=  "<span class='customize-inside-control-row'>";

                if( isset( $choice[ "label" ] ) && !empty( $choice[ "label" ] ) ):

                    $output .=   sprintf( "<label for='%s'><span class='customize-control-title'>%s</span></label>", $choice_id, esc_html( $choice[ "label" ] ) );

                endif;

                if( isset( $choice[ "description" ] ) && !empty( $choice[ "description" ]  ) ):

                    $output .=  sprintf( "<span class='description customize-control-description'>%s</span>", esc_html( $choice[ "description" ] ) );

                endif;

                $output .=  sprintf( "<label for='%s'>", $choice_id );

                $output .=  sprintf( "<input type='radio' %s id='%s' name='%s' value='%s'/>", $this->get_link(), $choice_id, $input_name, $value );

                if( isset( $choice[ "colors" ] ) && !empty( $choice[ "colors" ] ) && is_array( $choice[ "colors" ] ) ) {

                    foreach( $choice[ "colors" ] as $color ):

                        $output .=  sprintf( "<div class='storyteller-color' style='background-color:%s;'></div>", $color );

                    endforeach;

                }

                $output .=  "</label>";

                
                $output .=  "</span>";


            endforeach;

            print( $output );

        }

        public function to_json() {
 
            parent::to_json();
            $this->json['storyteller_color_collections_args'] = $this->storyteller_color_collections_args;

        }
     

    }

endif;