<?php
if( !class_exists( "ThemenameOptions" ) ){
    class ThemenameOptions {
        
        /**
         * The list of name and callback function for  get and set option 
         * @param array
        */
        protected $option_list ;
        

        public function __construct(){

            $this->option_list = array(
                            "test"           => array(
                                                    "option_name" => "theoptionname",
                                                    'default'     => "default",
                                                    "get" => "nameget",
                                                    "set" => "nameset",
                                                    ),
                            
                             );
            $this->check_options();

        }
        public function check_options(){
            if( is_array( $this->option_list ) ){
                foreach( $this->option_list as $option ){
                    $option = (object) $option;
                    if( !get_option( $option->option_name ) ){
                        $default = isset($option->default)?$option->default:"default";
                        add_option( $option->option_name , $default );
                    }
                }
            }

        }
        public function get( $option_name ){
            if( !empty($this->option_list[ $option_name ]) ){
                $temp = (object)$this->option_list[ $option_name ];
                if( is_set( $temp->get ) && function_exists( array( $this , $temp->get ) )  ){
                       return call_user_func( array( $this , $temp->get ) );
                }else{

                    return get_option( $temp->option_name );
                }

            }
        }
        public function set( $option_name , $option_value  ){
            if( !empty($this->option_list[ $option_name ]) ){
                $temp = (object)$this->option_list[ $option_name ];
                if( is_set( $temp->set ) && function_exists( array( $this , $temp->set ))  ){
                       return call_user_func( array( $this , $temp->get ) , $option_value );
                }else{

                    return update_option( $temp->option_name , $option_value );
                }

            }
        }

        // here is the custome function that need for spetial options

    }
}//endif