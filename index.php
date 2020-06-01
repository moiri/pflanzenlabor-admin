<?php
session_start();
require_once "./server/service/router.php";
require_once "./server/service/pflanzenlaborDbMapper.php";
require_once "./server/service/globals.php";
require_once "./server/service/globals_untracked.php";
require_once "./server/component/home/home.php";
require_once "./server/component/invalid/invalid.php";
require_once "./server/component/404/404.php";
require_once "./server/component/classes/classes.php";
require_once "./server/component/impressions/impressions.php";
require_once "./server/component/orders/orders.php";

/**
 * Helper function to show stacktrace also of wranings.
 */
function exception_error_handler($severity, $message, $file, $line) {
    if (!(error_reporting() & $severity)) {
        // This error code is not included in error_reporting
        return;
    }
    throw new ErrorException($message, 0, $severity, $file, $line);
}
// only activate in debug mode
if(DEBUG == 1) set_error_handler("exception_error_handler");

$router = new Router();
$dbMapper = new PflanzenlaborDbMapper(DBSERVER,DBNAME,DBUSER,DBPASSWORD);
$dbMapper->setDbLocale('de_CH');

// map homepage
$view_path = '/server/view';
$router->setBasePath(BASE_PATH);
// Main Pages
$router->map( 'GET', '/', function( $router, $db ) {
    $page = new Home( $router, $db );
    $page->print_view();
}, 'home');
$router->map( 'GET|POST', '/impressionen/[i:id_imp]?/[i:id_cont]?', function( $router, $db, $id_imp=null, $id_cont=null ) {
    $page = new Impressions( $router, $db, $id_imp, $id_cont );
    $page->print_view();
}, 'impressions');
$router->map( 'GET|POST', '/orders/', function( $router, $db) {
    $page = new Orders( $router, $db );
    $page->print_view();
}, 'orders');
$router->map( 'GET', '/kurse', function( $router, $db ) {
    $page = new Classes( $router, $db );
    $page->print_view();
}, 'courses');
// match current request url
$router->update_route();

// call closure or throw 404 status
if( $router->route && is_callable( $router->route['target'] ) ) {
    call_user_func_array( $router->route['target'], array_merge( array( $router, $dbMapper ), $router->route['params'] ) );
} else {
    $page = new Missing( $router );
    $page->print_view();
}
?>
