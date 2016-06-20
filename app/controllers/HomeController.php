<?php

namespace Controllers;
use Models\RecommendedModel as RCModel;
use Models\NotRecommendedModel as NRCModel;
use Models\MarketModel;

class HomeController extends BaseController{

	public function index($request, $response){
		return $this->view()->render($response, "index.html");
	}

	public function search($request, $response){
		$request = $request->getParsedBody();
		$_SESSION['illness'] = $request['illnessValue'];
		if($request['autoValue'] == false){
			$_SESSION['market'] = $request['marketValue'];
		}
		$recommendedFoods = RCModel::all($request['illnessValue']);
		$notRecommendedFoods = NRCModel::all($request['illnessValue']);
		$price = array();
		for($x = 0 ; $x<count($recommendedFoods);$x++){
	 		$price[] = MarketModel::where("comodity", "LIKE", "%{$recommendedFoods[$x]}%", "price");
		}
		return $this->view()->render($response, "page1.html", [
			'autox' => $request['autoValue'],
			'market' => $_SESSION['market'],
			'recommendedFoods' => $recommendedFoods,
			'notRecommendedFoods' => $notRecommendedFoods,
			'price' => $price 
		]);
	}
}