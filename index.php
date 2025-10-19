<?php
/**
 * Huskycat main class
 * @package huskycat
 * @since huskycat 0.0.1
 */

if( !class_exists( 'Huskycat' ) ):
    
    class Huskycat {

        private static $path;
        private static $url;
        private static $dependencies   =   array();

        // Setup Related Functions

        public static function setup( $root_path = false, $root_url = false ) {

            // do some checks
            if( !$root_path || !$root_url ) { return; }
            if( !is_string( $root_path ) || !is_string( $root_url ) ) { return; }
            if( !filter_var($root_url, FILTER_VALIDATE_URL) ) { return; }

            // affect properties
            self::$path =   $root_path;
            self::$url  =   $root_url;

            // classes.
            self::include_classes();

            // controls
            self::include_controls();

            // helpers.
            self::include_helpers();

            // scripts and styles
            self::enqueue();

        }

        private static function include_classes() {

            require_once ( self::$path . 'classes/huskycat-control.php' );

        }

        private static function include_controls() {

            require_once ( self::$path . 'controls/radio-color-palettes.php' );
            require_once ( self::$path . 'controls/switch-toggle.php' );
            require_once ( self::$path . 'controls/radio-images.php' );
            require_once ( self::$path . 'controls/select-typography.php' );

        }

        private static function include_helpers() {

            require_once ( self::$path . 'helpers/sanitize.php' );
            require_once ( self::$path . 'helpers/validate.php' );
            require_once ( self::$path . 'helpers/functions.php' );

        }

        // register and enqueue scripts

        private static function enqueue() {

            add_action( 'admin_enqueue_scripts', 'Huskycat::register_styles' );
            add_action( 'admin_enqueue_scripts', 'Huskycat::register_scripts' );
            add_action( 'customize_controls_enqueue_scripts', 'Huskycat::enqueue_controls_script' );
            add_action( 'customize_preview_init', 'Huskycat::enqueue_preview_script' );

        }

        public static function register_scripts() {


        }


        public static function register_styles() {


        }

        public static function enqueue_controls_script() {

            wp_enqueue_script( 'select2', ( self::$url . '/node_modules/select2/dist/js/select2.full.min.js' ), array( 'jquery' ), '4.1.0-rc.0', false );
            wp_enqueue_style( 'select2-style', ( self::$url . '/node_modules/select2/dist/css/select2.min.css' ), false, '4.1.0-rc.0', 'all' );
            wp_enqueue_style( 'huskycat-style', ( self::$url . '/assets/dist/css/style.css' ), false, '1.0', 'all' );

            wp_enqueue_script( 'huskycat-controls-js', ( self::$url . '/assets/dist/js/controls.js'  ), array( 'jquery', 'customize-controls' ), '0.0.1', true );
            wp_localize_script( 'huskycat-controls-js', 'huskycatControls', self::js_controls_localize() );


        }

        public static function enqueue_preview_script() {


            // wp_enqueue_script( 'select2', ( self::$url . '/node_modules/select2/dist/js/select2.min.js' ), array( 'jquery' ), '4.1.0-rc.0', false );
            // wp_enqueue_style( 'select2-style', ( self::$url . '/node_modules/select2/dist/css/select2.min.css' ), false, '4.1.0-rc.0', 'all' );

            wp_enqueue_script( 'huskycat-preview-js', ( self::$url . '/assets/dist/js/preview.js'  ), array( 'jquery' ), '0.0.1', true );

        }

        // control dependecies functions 
        public static function add_control_dependents( $setting_id = false, $value = false, $dependent_controls = array() ) {
            
            // check control id
            if( !$setting_id || !is_string( $setting_id ) || empty( $setting_id ) ) { return; }

            // check value
            if( !$value || empty( $value ) ) { return; }

            // check dependent
            if( !( is_string( $dependent_controls ) || is_array( $dependent_controls ) ) || empty( $dependent_controls ) ) { return; }


            // initialize control
            if( !array_key_exists( $setting_id, self::$dependencies ) ) {

                self::$dependencies[ $setting_id ]     =   array();

            }

            // initilize value dependencies if it doesn't have previous dependents
            if( !array_key_exists( $value, self::$dependencies[ $setting_id ] ) ) {

                self::$dependencies[ $setting_id ][ $value ]   =   array();

            }

            // the dependent controls could be single value or an array
            if( is_string( $dependent_controls ) ) {

                self::$dependencies[ $setting_id ][ $value ][] =   $dependent_controls;

            } elseif( is_array( $dependent_controls ) ) {

                // merge the new dependents with the old onces
                self::$dependencies[ $setting_id ][ $value ]   =   array_merge( $dependent_controls, self::$dependencies[ $setting_id ][ $value ] ); 

            }

        }

        public static function js_controls_localize() {

            return array( 

                'googleFonts'  =>  Huskycat::url() . "helpers/google-fonts.json",

            );

        }


        public static function path() {

            return self::$path;

        }

        public static function url() {

            return self::$url;

        }


    }

endif;


