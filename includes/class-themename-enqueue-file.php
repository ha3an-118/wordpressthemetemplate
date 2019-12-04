<?php

    if( !class_exists( 'ThemenameEnqueueFile' ) ){
        class ThemenameEnqueueFile{

            /**
             * @param array for list of style and script must add in spetial page
            */
            protected $style_list = array();
            protected $script_list = array();

            public function __construct(){
                add_action("wp_enqueue_scripts", array( $this , "registreFile"));
                add_action("admin_enqueue_scripts", array( $this , "enqueueInAdmin"));
                add_action("wp_enqueue_scripts", array( $this , "enqueueInUser"));
                add_action("wp_enqueue_scripts", array( $this , "enqueueScriptList"));
                add_action("wp_enqueue_scripts", array( $this , "enqueueStyleList"));


            }
            /**
             * @description : all script and style must register here 
            */
            public function registreFile(){

            }
            /**
             * @description : All file in admin part must add here 
            */
            public function enqueueInAdmin(){

            }

            /**
             * @description : All file in user side must add here
            */
            public function enqueueInUser(){

            }

            /**
             * @param string that the file registerd name 
             * @description : For enqueue script in special page 
            */
            public function enqueueScript( $string  ){
                // add stigng to script array
                array_push( $this->script_list ,  $string );
            }
            public function enqueueScriptList(){
                if( is_array( $this->script_list ) ){
                    foreach( $this->script_list as $script_name ){
                        wp_enqueue_script( $script_name );
                    }
                }
            }
            /**
             * @param string that file registed name 
             * @description : For enqueue style in special page
            */
            public function enqueueStyle( $string  ){
                //adding to style array
                array_push( $this->style_list , $string );
            }
            public function enqueueStyleList(){
                if( is_array( $this->style_list ) ){
                    foreach( $style_list as $style_name ){
                        wp_enqueue_style( $style_name );
                    }
                }
            }

        }


    }