<?php

namespace Controller;
use Controller\BaseController;
use Model\HomeModel as Model;

class HomeController extends BaseController{

	public function index($request, $response){
		return $this->view()->render($response, "index.html");
	}

	public function nextpage($request, $response){
		Model::all();
		/*$model = new Model();
		$output = $model->next($request);
		if($output){
			$response = $response->withStatus(200);
			return $this->view()->render($response, "illness.html");
		}
		else{
			return $response->withStatus(400);
		}*/
	}

}