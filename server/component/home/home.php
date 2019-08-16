<?php
require_once __DIR__ . '/../page.php';

/**
 * Contact Component Class
 */
class Home extends Page {

    private $class_item;

    function __construct( $router, $db ) {
        parent::__construct( $router );
    }

    private function print_link($key, $name)
    {
        require __DIR__ . '/v_home_link.php';
    }

    public function print_view() {
        $this->print_page( function() {
            require __DIR__ . '/v_home.php';
        } );
    }
}

?>
