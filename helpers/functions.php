<?php 
/**
 * huskycat functions
 * @package huskycat
 * @since 0.0.1
 */


if( !function_exists( 'huskycat_add_control_dependents' ) ):

    function huskycat_add_control_dependents( $setting_id = false, $value = false, $dependent_controls = array() ) {

        Huskycat::add_control_dependents( $setting_id, $value, $dependent_controls );

    }

endif;