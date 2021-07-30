<?php

class ControllerCategory extends Controller {
    private $data = array();
    private $error = array();

    public function index() {
        $category_id = 0;
        $filter = array();

        if (isset($_GET['category_id'])) {
            $category_id = $_GET['category_id'];
        }

        $this->data['sort'] = '';
        if (isset($_GET['sort'])) {
            $sort = explode("_", $_GET['sort']);

            $filter['sort'] = $sort['0'];
            $filter['direction'] = $sort['1'];

            $this->data['sort'] = $_GET['sort'];
        }

        $this->data['category_id'] = $category_id;
        $this->data['categories'] = $this->getCategories();
        $this->data['products'] = $this->getProducts($category_id, $filter);

        $template = $this->view->load('category', $this->data);

        $this->response->setOutput($template);

    }

    public function getProducts($category_id, $filter = array()) {

        $defaultSort = 'product_id';
        $defaultDirection = 'ASC';

        $sort = array(
            'product_id',
            'price',
            'name',
            'date'
        );

        if (isset($filter['sort']) && in_array($filter['sort'], $sort)) {
            $sort = $filter['sort'];
        } else {
            $sort = $defaultSort;
        }

        $direction = array(
            'ASC',
            'DESC'
        );

        if (isset($filter['direction']) && in_array($filter['direction'], $direction)) {
            $direction = $filter['direction'];
        } else {
            $direction = $defaultDirection;
        }

        $where = '';
        if ($category_id) {
            $where =  " WHERE category_id = '".(int)$category_id."'";
        }

        $query = $this->db->query("SELECT * FROM product" . $where . ' ORDER BY ' . $sort . ' ' . $direction);
        
        return $query;
    }

    public function getCategories() {
        $query = $this->db->query("
            SELECT 
                cat.category_id, 
                cat.name,
                (SELECT COUNT(prod.product_id) FROM product AS prod WHERE prod.category_id = cat.category_id) AS total
            FROM 
                category AS cat
        ");

        return $query;
    }

    public function getAjaxProducts() {
        $json = array();
        $filter = array();
        $category_id = 0;

        if (isset($_GET['category_id'])) {
            $category_id = $_GET['category_id'];
        }

        if (isset($_GET['sort'])) {
            $sort = explode("_", $_GET['sort']);

            $filter['sort'] = $sort['0'];
            $filter['direction'] = $sort['1'];
        }

        $json['products'] = $this->getProducts($category_id, $filter);

        if (empty($json['products'])) {
            $json['success'] = false;
        } else {
            $json['success'] = true;
        }

        $this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
    }
}