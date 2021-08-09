<?php
/**
 * static sanitizing functions
 * @package huskycat
 * @since huskycat 0.0.1
 */

class Huskycat_Sanitize {

    //checkbox sanitization function
    public static function checkbox( $input ) {

        //returns true if checkbox is checked
        return ( ( isset( $input ) && true === $input ) ? true : false );

    }

}