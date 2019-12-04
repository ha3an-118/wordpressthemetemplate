<?php
if( !class_exists( "themenameShortcode" ) ){
    class themenameShortcode{
        /**
         * for each short code must add the name in the shortcode_list array and must create funtion
         * for handel  shortcode
        */


        public function __construct(){
            $shortcode_list = array(
                "shortcodeName"    =>   "functionName",
                );
            
            foreach( $shortcode_list  as  $shortcode_name => $shortcode_function ){
                if( !shortcode_exists( $shortcode_name )  ){
                    add_shortcode( $shortcode_name  , array( $this , $shortcode_function ) );
                }
            }

        }

    }
}