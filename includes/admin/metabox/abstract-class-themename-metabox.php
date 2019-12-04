<?php
    abstract class themenameMetabox{
        /**
         * @param array $arg containe the information for create the metabox
        */
        protected $arg;
        public function __construct( $arg ){
            $default_arg = array(
                "id"            =>  "",
                "title"         =>  "",
                "callback"      =>  array($this , "print"),
                "screen"        =>  null,
                "context"       =>  "",
                "priority"      =>  "",
                "callback_args" =>  "",
            );
            $arg = array_merge( $default_arg , $arg );
            extract( $arg );
            if( empty( $id ) || empty( $title )  || empty( $screen ) ) wp_die("We have problem with your input in line :".__LINE__."Of Class".__CLASS__ );
            $this->arg = $arg;
            add_action( 'add_meta_boxes', array( $this , "create" ) );
            add_action( 'save_post', array( $this , "save" ) );

        }
        public function create(){
            // must create the metabox 
            extract( $this->arg );

            add_meta_box( $id, $title, $callback, $screen, $context, $priority, $callback_args );
        }
        abstract public function print();
        abstract public function save();

    }
?>