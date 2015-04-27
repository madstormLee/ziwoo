<?
class ImageController extends MadController {
	function indexAction() {
		$this->layout->setFile('layout/mainOnly.html');
	}
	function listAction() {
		$get = $this->params;
		if( ! $get->dir ) {
			$get->dir = 'file/image/data';
		}
		$this->view->index = new MadDir( $get->dir, '*.{gif,png,jpg,JPG,GIF,PNG}' );
	}
	function saveAction() {
		$router = $this->router;
		error_reporting(E_ALL | E_STRICT);
		include __dir__ . '/UploadHandler.php';
		$options = array(
			'script_url' => "$router->project/uploads/",
			'upload_dir' => 'uploads/',
			'upload_url' =>  "$router->project/uploads/",
		);
		$upload_handler = new UploadHandler( $options );
		die;
	}
	function viewAction() {
		$file = new MadFile( $this->params->file );
		$this->view->file = $file;
		$this->view->info = $file->getInfo();
	}
}
