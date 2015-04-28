<?
class Controller extends MadController {
	function indexAction() {
		$router = $this->router;
		if ( $router->project == '/' ) {
			$location = "http://$router->host/contents";
		} else {
			$location = "http://$router->host$router->project/contents";
		}
		header("Location: $location");
		die;
	}
}
