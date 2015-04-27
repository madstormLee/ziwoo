<?
class Controller extends MadController {
	function indexAction() {
		$router = $this->router;
		$location = "http://$router->host$router->project/contents";
		header("Location: $location");
		die;
	}
}
