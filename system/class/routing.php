<?php

class Routing {
    protected $registry;
    private $route;
	private $method = 'index';

	public function __construct($registry) {
		$this->registry = $registry;
	}

    public function dispatch($route) {

        $parts = explode('/', preg_replace('/[^a-zA-Z0-9_\/]/', '', (string)$route));

		while ($parts) {
			$file = DIR_CONTROLLER . implode('/', $parts) . '.php';

			if (is_file($file)) {
				$this->route = implode('/', $parts);	
                
				break;
			} else {
                $method = array_pop($parts);

                if (!empty($method)) {
                    $this->method = $method;
                }
			}
		}

        $this->execute();
	}

    protected function execute() {
		if (substr($this->method, 0, 2) == '__') {
			exit('Error: Calls to magic methods are not allowed!');
		}

		$file  = DIR_CONTROLLER . $this->route . '.php';	
		$class = 'Controller' . preg_replace('/[^a-zA-Z0-9]/', '', $this->route);

		// Initialize the class
		if (is_file($file)) {
			include_once($file);
		
			$controller = new $class($this->registry);
		} else {
			exit('Error: Could not call ' . $this->route . '/' . $this->method . '!');
		}

        call_user_func(array($controller, $this->method), array());
	}
}