<?php
class Bootstrap {
	private $controller;
	private $action;
	private $request;

	public function __construct($request){
		$this->request = $request;
		if($this->request['controller'] == ""){
			$this->controller = 'home';
		} else {
			$this->controller = $this->request['controller'];
		}

		if ($this->request['action'] == ""){
			$this->action = 'index';
		} else {
			$this->action = $this->request['action'];

		}
	}

	public function createController(){
		// Check Class
		if(class_exists($this->controller)){
			$parents = class_parents($this->controller);
			// Check Extended
			if (in_array("Controller", $parents)){
				if(method_exists($this->controller,$this->action)){
					return new $this->controller($this->action, $this->request);

				} else {
					// Method does not exist
					echo '<h1>No Method</h1>';
					return;
				}

			} else {
					// Controller does not exist
					echo '<h1>No Controller</h1>';
					return;

			}
		} else {
				// Controller does not exist
					echo '<h1>No Controller</h1>';
					return;
		}
	}
}