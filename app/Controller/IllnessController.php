<?php

namespace Controller;
use Controller\BaseController;

class IllnessController extends BaseController{

	public function index($request, $response, $args){
		return $this->view()->render($response, "illness.html");
	}

	public function recipe($request, $response, $args){
		return $this->view()->render($response, "recipe.html");
	}

}