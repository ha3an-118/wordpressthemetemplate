<?php
if( !class_exists( 'ThemenameAdminMenu' ) ) {
    class ThemenameAdminMenu{
        public function __construct(){
            // include the class file 
            $this->includes();
            //and must init the class in 

        }
        protected function includes(){
            // must include the class here
            // Abstract class that every subclass need it
            require_once(BASE_DIR."/includes/admin/menu/abstract-class-themename-menus.php");

        }
        public function init(){
            // must create new of any class 
        }
    }
}

?>