<?php
/**
 * Static sanitizing functions
 * @package huskycat
 * @since huskycat 0.0.1
 */

class Huskycat_Sanitize {

    /**
     * Checkbox sanitization function
     * 
     * @param bool $input Checkbox value
     * @return bool
     */
    public static function checkbox( $input ) {
        return ( ( isset( $input ) && true === $input ) ? true : false );
    }

    /**
     * Select sanitization function
     * 
     * @param string $input Select value
     * @param object $setting Setting object
     * @return string
     */
    public static function select( $input, $setting ) {
        $input = sanitize_key( $input );
        
        $choices = $setting->manager->get_control( $setting->id )->choices;
        
        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
    }

    /**
     * Radio button sanitization function
     * 
     * @param string $input Radio value
     * @param object $setting Setting object
     * @return string
     */
    public static function radio( $input, $setting ) {
        return self::select( $input, $setting );
    }

    /**
     * Image radio sanitization function
     * 
     * @param string $input Image radio value
     * @param object $setting Setting object
     * @return string
     */
    public static function image_radio( $input, $setting ) {
        return self::select( $input, $setting );
    }

    /**
     * Hex color sanitization function
     * 
     * @param string $color Hex color value
     * @return string
     */
    public static function hex_color( $color ) {
        if ( empty( $color ) ) {
            return '';
        }
        
        if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
            return $color;
        }
        
        return '';
    }

    /**
     * RGBA color sanitization function
     * 
     * @param string $color RGBA color value
     * @return string
     */
    public static function rgba_color( $color ) {
        if ( empty( $color ) ) {
            return '';
        }
        
        // If hex color
        if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
            return $color;
        }
        
        // If rgba color
        if ( preg_match('/^rgba\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9\.]+)\s*\)$/', $color, $matches ) ) {
            $r = intval( $matches[1] );
            $g = intval( $matches[2] );
            $b = intval( $matches[3] );
            $a = floatval( $matches[4] );
            
            if ( $r >= 0 && $r <= 255 && $g >= 0 && $g <= 255 && $b >= 0 && $b <= 255 && $a >= 0 && $a <= 1 ) {
                return $color;
            }
        }
        
        return '';
    }

    /**
     * Integer sanitization function
     * 
     * @param int $input Integer value
     * @return int
     */
    public static function integer( $input ) {
        return absint( $input );
    }

    /**
     * Number sanitization function (allows decimals)
     * 
     * @param float $input Number value
     * @return float
     */
    public static function number( $input ) {
        return floatval( $input );
    }

    /**
     * Number range sanitization function
     * 
     * @param float $input Number value
     * @param object $setting Setting object
     * @return float
     */
    public static function number_range( $input, $setting ) {
        $number = floatval( $input );
        
        $atts = $setting->manager->get_control( $setting->id )->input_attrs;
        
        $min = isset( $atts['min'] ) ? floatval( $atts['min'] ) : $number;
        $max = isset( $atts['max'] ) ? floatval( $atts['max'] ) : $number;
        
        return ( $min <= $number && $number <= $max ) ? $number : $setting->default;
    }

    /**
     * Text sanitization function
     * 
     * @param string $input Text value
     * @return string
     */
    public static function text( $input ) {
        return sanitize_text_field( $input );
    }

    /**
     * Textarea sanitization function
     * 
     * @param string $input Textarea value
     * @return string
     */
    public static function textarea( $input ) {
        return sanitize_textarea_field( $input );
    }

    /**
     * URL sanitization function
     * 
     * @param string $url URL value
     * @return string
     */
    public static function url( $url ) {
        return esc_url_raw( $url );
    }

    /**
     * Email sanitization function
     * 
     * @param string $email Email address
     * @return string
     */
    public static function email( $email ) {
        return sanitize_email( $email );
    }

    /**
     * HTML sanitization function
     * 
     * @param string $input HTML content
     * @return string
     */
    public static function html( $input ) {
        return wp_kses_post( $input );
    }

    /**
     * CSS sanitization function
     * 
     * @param string $css CSS code
     * @return string
     */
    public static function css( $css ) {
        return wp_strip_all_tags( $css );
    }

    /**
     * Image upload sanitization function
     * 
     * @param string $input Image URL
     * @return string
     */
    public static function image( $input ) {
        $filetype = wp_check_filetype( $input );
        
        if ( $filetype['ext'] && wp_ext2type( $filetype['ext'] ) === 'image' ) {
            return esc_url_raw( $input );
        }
        
        return '';
    }

    /**
     * File upload sanitization function
     * 
     * @param string $input File URL
     * @return string
     */
    public static function file( $input ) {
        return esc_url_raw( $input );
    }

    /**
     * Slug sanitization function
     * 
     * @param string $input Slug value
     * @return string
     */
    public static function slug( $input ) {
        return sanitize_title( $input );
    }

    /**
     * Key sanitization function
     * 
     * @param string $input Key value
     * @return string
     */
    public static function key( $input ) {
        return sanitize_key( $input );
    }

    /**
     * HTML class sanitization function
     * 
     * @param string $input Class name
     * @return string
     */
    public static function html_class( $input ) {
        return sanitize_html_class( $input );
    }

    /**
     * Multiple HTML classes sanitization function
     * 
     * @param string $input Space-separated class names
     * @return string
     */
    public static function html_classes( $input ) {
        $classes = explode( ' ', $input );
        $classes = array_map( 'sanitize_html_class', $classes );
        return implode( ' ', array_filter( $classes ) );
    }

    /**
     * Array sanitization function
     * 
     * @param array $input Array value
     * @return array
     */
    public static function array( $input ) {
        if ( ! is_array( $input ) ) {
            return array();
        }
        
        return array_map( 'sanitize_text_field', $input );
    }

    /**
     * JSON sanitization function
     * 
     * @param string $json JSON string
     * @return string
     */
    public static function json( $json ) {
        $decoded = json_decode( $json, true );
        
        if ( json_last_error() === JSON_ERROR_NONE ) {
            return $json;
        }
        
        return '';
    }

    /**
     * Opacity sanitization function (0-1)
     * 
     * @param float $input Opacity value
     * @return float
     */
    public static function opacity( $input ) {
        $opacity = floatval( $input );
        
        if ( $opacity >= 0 && $opacity <= 1 ) {
            return $opacity;
        }
        
        return 1;
    }

    /**
     * Percentage sanitization function (0-100)
     * 
     * @param int $input Percentage value
     * @return int
     */
    public static function percentage( $input ) {
        $percentage = intval( $input );
        
        if ( $percentage >= 0 && $percentage <= 100 ) {
            return $percentage;
        }
        
        return 100;
    }

    /**
     * Post ID sanitization function
     * 
     * @param int $input Post ID
     * @return int
     */
    public static function post_id( $input ) {
        $post_id = absint( $input );
        
        if ( get_post( $post_id ) ) {
            return $post_id;
        }
        
        return 0;
    }

    /**
     * Term ID sanitization function
     * 
     * @param int $input Term ID
     * @return int
     */
    public static function term_id( $input ) {
        $term_id = absint( $input );
        
        if ( get_term( $term_id ) ) {
            return $term_id;
        }
        
        return 0;
    }

    /**
     * User ID sanitization function
     * 
     * @param int $input User ID
     * @return int
     */
    public static function user_id( $input ) {
        $user_id = absint( $input );
        
        if ( get_user_by( 'id', $user_id ) ) {
            return $user_id;
        }
        
        return 0;
    }

    /**
     * Date format sanitization function
     * 
     * @param string $input Date format
     * @return string
     */
    public static function date_format( $input ) {
        $valid_formats = array(
            'F j, Y',
            'Y-m-d',
            'm/d/Y',
            'd/m/Y',
            'M j, Y',
            'j F Y',
            'custom'
        );
        
        return in_array( $input, $valid_formats ) ? $input : 'F j, Y';
    }

    /**
     * Font family sanitization function
     * 
     * @param string $input Font family
     * @return string
     */
    public static function font_family( $input ) {
        return sanitize_text_field( $input );
    }

    /**
     * Font weight sanitization function
     * 
     * @param string $input Font weight
     * @return string
     */
    public static function font_weight( $input ) {
        $valid_weights = array(
            '100', '200', '300', '400', '500', '600', '700', '800', '900',
            'normal', 'bold', 'bolder', 'lighter',
            100, 200, 300, 400, 500, 600, 700, 800, 900
        );
        
        return in_array( $input, $valid_weights ) ? $input : '400';
    }

    /**
     * Font style sanitization function
     * 
     * @param string $input Font style
     * @return string
     */
    public static function font_style( $input ) {
        $valid_styles = array( 'normal', 'italic', 'oblique' );
        
        return in_array( $input, $valid_styles ) ? $input : 'normal';
    }

    /**
     * Text transform sanitization function
     * 
     * @param string $input Text transform
     * @return string
     */
    public static function text_transform( $input ) {
        $valid_transforms = array( 'none', 'uppercase', 'lowercase', 'capitalize' );
        
        return in_array( $input, $valid_transforms ) ? $input : 'none';
    }

    /**
     * Text alignment sanitization function
     * 
     * @param string $input Text alignment
     * @return string
     */
    public static function text_align( $input ) {
        $valid_aligns = array( 'left', 'center', 'right', 'justify' );
        
        return in_array( $input, $valid_aligns ) ? $input : 'left';
    }

    /**
     * Border style sanitization function
     * 
     * @param string $input Border style
     * @return string
     */
    public static function border_style( $input ) {
        $valid_styles = array( 'none', 'solid', 'dashed', 'dotted', 'double', 'groove', 'ridge', 'inset', 'outset' );
        
        return in_array( $input, $valid_styles ) ? $input : 'solid';
    }

    /**
     * Layout sanitization function
     * 
     * @param string $input Layout value
     * @return string
     */
    public static function layout( $input ) {
        $valid_layouts = array( 'default', 'boxed', 'wide', 'full-width', 'classic', 'minimal' );
        
        return in_array( $input, $valid_layouts ) ? $input : 'default';
    }

    /**
     * Hero variant sanitization function
     * 
     * @param string $input Hero variant
     * @return string
     */
    public static function hero_variant( $input ) {
        $valid_variants = array( 'none', 'glassmorphism', 'compact', 'featured' );
        
        return in_array( $input, $valid_variants ) ? $input : 'glassmorphism';
    }

    /**
     * Color palette sanitization function
     * 
     * @param string $input Color palette choice
     * @return string
     */
    public static function color_palette( $input ) {
        $valid_palettes = array( 'default', 'custom', 'owl', 'preset-1', 'preset-2', 'preset-3' );
        
        return in_array( $input, $valid_palettes ) ? $input : 'default';
    }

    /**
     * Post layout sanitization function
     * 
     * @param string $input Post layout
     * @return string
     */
    public static function post_layout( $input ) {
        $valid_layouts = array( 'standard', 'featured', 'compact', 'grid', 'list' );
        
        return in_array( $input, $valid_layouts ) ? $input : 'standard';
    }

}