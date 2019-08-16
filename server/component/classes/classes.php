<?php
require_once __DIR__ . '/../page.php';

/**
 * Contact Component Class
 */
class Classes extends Page {
    private $db;
    private $id;

    function __construct( $router, $dbMapper, $id=null ) {
        parent::__construct( $router );
        $this->db = $dbMapper;
        $this->id = $id;
    }

    public function print_view() {
        $this->print_page( function() {
            require __DIR__ . '/v_classes.php';
        } );
    }
}

?>
