<?php

class Controller {
    protected $registry;

    protected $db;
    protected $response;
    protected $view;

	public function __construct($registry) {
		$this->registry = $registry;

        $this->db = $this->registry->get('db');
        $this->response = $this->registry->get('response');
        $this->view = $this->registry->get('view');
	}
}