<?php
/**
 * Navigationbar Component Class
 */
class Nav
{
    public $router;
    private $active_css = 'active';

    function __construct( $router )
    {
        $this->router = $router;
    }

    public function get_active_css( $route_name )
    {
        if( $this->router->is_active( $route_name ) )
            return $this->active_css;
        $uri = $_SERVER['REQUEST_URI'];
        if( $route_name == "impressions" ) {
            $id_imp = $this->router->get_route_param( 'id_imp' );
            $id_cont = $this->router->get_route_param( 'id_cont' );
            if( $this->router->generate( 'impressions',
                    array( 'id_imp' => $id_imp, 'id_cont' => $id_cont ) ) == $uri )
                return $this->active_css;
        }
        return '';
    }

    public function print_view()
    {
        require __DIR__ . '/v_nav.php';
    }
}

?>
