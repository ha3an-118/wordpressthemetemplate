<?php
    abstract class ThemenameMenus{
        
        protected $arg;
        
        /**
         * @param array $input_arg is the input for setting
        */
        public function __construct( $input_arg ){

            $default_arg = array(
                "type"              => "menu",
                "page_title"        => "",
                "menu_title"        => "",
                "capability"        => "manage_options",
                "menu_slug"         => "",
                "callback_function" => array( $this , 'printHtml' ),
                "icon_url"          => "",
                "position"          => 20,
                "parent_slug"       => "",
            );

            $input_arg = array_merge( $default_arg , $input_arg );
            extract( $input_arg );
            // check if the file input is empty must send error
            if( empty($page_title) || empty($menu_title) || empty($menu_slug) ) wp_die(__FILE__."Have problem in input arg");
            if(  $type == "submenu" && empty( $parent_slug ) ) wp_die(__FILE__."Have problem in input arg in line : ".__LINE__);
            // set the input arg as class var
            $this->arg = $input_arg;
            add_action( "admin_menu" , array( $this , "registerMenu" ) );

        }
        /**
         *@description : It's function that register the menu or submenu 
        */
        protected  function registerMenu(){

            if( is_array( $this->arg ) ){
                extract( $this->arg );
            }else{
                wp_die("Have problem in ".__CLASS__."line:".__LINE__);
            }

            if( $type == 'menu' ){
                // do register for menu
                $hookname = add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
            }elseif( $type == "submenu" ){
                // do register submenu
                $hookname = add_submenu_page( $parent_slug, $page_title, $menu_title,  $capability, $menu_slug, $function ,$position );
            }
            add_action( 'load-' . $hookname, array( $this , "saveDate" ) );

        }

        abstract protected function printHtml();

        abstract protected function saveDate();

    }
?>