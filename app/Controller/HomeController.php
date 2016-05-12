<?php

namespace Controller;
use Controller\BaseController;

class HomeController extends BaseController{

	public function index($request, $response){
		return $this->view()->render($response, "index.html");
	}

}