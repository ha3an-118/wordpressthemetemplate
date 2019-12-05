<?php
if( !class_exists( "themename" ) ){
    class themename{
        protected static $_notice = null;
        protected static $_instance = false;

        private  function __construct(){

            $this->define_constants();
            $this->includes();

            // setup theme
            add_action( 'after_setup_theme' , array( $this , "setup_theme" ) );

            // enqueue the files
            $this->enqueue = new ThemenameEnqueueFile();
            $this->functions = new ThemenameHelperFunctions();
            $this->options = new ThemenameOptions();
            
            
            // theme options
            if( is_admin() ){
                // create the admin menu and submenu
                $this->admin_menu = new ThemenameAdminMenu();

            }else{
                $this->shortcode  = new themenameShortcode();

            }
            // admin part
                //adming metabox
                // amdin menu
                // enqueue file
                // theme update

            
            // is not admin 
                // adding shortcode
            
            // helperfunctions


        } 
        public static function instance(){
            
            if( !self::$_instance ){
                return new self;
            }else{
                return self::$_instance;
            }
        }
        protected function includes(){
            
            // all part
            // include autoload of composer
            require_once(BASE_DIR.'/vendor/autoload.php');
            // include the file neaded
            require_once(BASE_DIR.'/includes/class-themename-enqueue-file.php');
            // the class that containe the function we need in theme
            require_once(BASE_DIR.'/includes/class-themename-helper-functions.php');
            // the class that handel the option get set and update
            require_once(BASE_DIR.'/includes/class-themname-options.php');
            
            
            // admin part
            if( is_admin() ){
                require_once(BASE_DIR.'/includes/admin/class-themename-admin-menu.php');
                require_once(BASE_DIR.'/includes/admin/metabox/abstract-class-themename-metabox.php');
            }
            // userpart
            else{
                require_once(BASE_DIR.'/includes/class-themename-shortcode.php');
            }
           
        }
        protected function define_constants(){
            // hear must define the constant we need like file Dir or theme path
            define("BASE_DIR",get_template_directory());

        }
        public function setup_theme(){
            // must setup theme
        }
       

    }
}
function themename(){
    return themename::instance();
}
global $themename;
$themename = themename();
