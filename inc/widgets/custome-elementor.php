<?php

namespace WPC;

use Elementor\Modules\Favorites\Types\Widgets;
use ElementorPro\Modules\GlobalWidget\Documents\Widget;

class Widgets_Loader {

    private static $_instance = null;
    public static function instance()
    {
        if(is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }


    public function register_widgets()
    {
        $this->include_widgets_files();

        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new 
        Widgets\Advertisement());
    }







    public function __construct()
    {
        add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets'], 99);
    }
}




// Instantiate plugin class
Widgets_Loader::instance();

?>