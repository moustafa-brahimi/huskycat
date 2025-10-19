<?php
/**
 * @package hsukycat 
 * @since 0.0.1
 * standard validation functions
 */

class Huskycat_Validate {

    public static function numeric( $validity, $value ) {

        if( !is_numeric( $value ) ):
            
            $validity->add( 'required', __( 'non valid value', 'evy' ) );

        endif;

        return $validity;

    }

    public static function font_family( $validity, $value ) {

        $file_path  =   ( Huskycat::path() . "helpers/google-fonts.json" );
        $raw_data   =   file_get_contents( $file_path );
        $fonts      =   json_decode( $raw_data, true );


        if( !array_key_exists( $value, $fonts ) ):
            
            $validity->add( 'required', __( 'non supported font', 'evy' ) );

        endif;

        return $validity;

    }

    public static function font_weight( $validity, $value ) {

        $weights    =   [ '100','200','300','400','500','600','700','800','900' ];

        if( !in_array( $value, $weights ) ):
            
            $validity->add( 'required', __( 'not valid font weight', 'evy' ) ); 

        endif;

        return $validity;

    }

    public static function text_transform( $validity, $value ) {

        $possible_values    =   [
            'none',
            'capitalize',
            'uppercase',
            'lowercase',
        ];

        if( !in_array( $value, $possible_values ) ):

            $validity->add( 'required', __( 'unsupported text transform', 'evy' ) ); 

        endif;

        return $validity;
    }
    
    public static function font_style( $validity, $value ) {

        $possible_values    =   [
            'italic',
            'normal',
            'oblique',
        ];

        if( !in_array( $value, $possible_values ) ):

            $validity->add( 'required', __( 'unsupported font style', 'evy' ) ); 

        endif;

        return $validity;
    }

}