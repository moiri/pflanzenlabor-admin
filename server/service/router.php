<?php
require_once __DIR__ . "/altorouter.php";

class Router extends AltoRouter {
    public $route = NULL;

    function __construct( $routes = array(), $basePath = '', $matchTypes = array() ) {
        parent::__construct( $routes, $basePath, $matchTypes );
    }

    public function get_asset_path( $path ) {
        return $this->basePath . $path;
    }

    public function is_active( $route_name )
    {
        $uri = $_SERVER['REQUEST_URI'];
        if( $this->generate( $route_name ) == $uri ) {
            return true;
        }
    }

    public function update_route() {
        $this->route = $this->match();
    }

    public function get_route_param( $param_name ) {
        if( is_null( $this->route ) )
            throw new Exception( "Route not initialsied, call update_route() first" );
        else if( !is_null($this->route['params']) && array_key_exists( $param_name, $this->route['params'] ) )
            return $this->route['params'][$param_name];
        else
            return null;
    }
}

?>
