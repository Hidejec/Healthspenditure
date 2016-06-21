<?php

namespace Controllers;

use Models\ExplainModel;

class ExplainController extends BaseController{

	public function recommended($request, $response, $args){
		$data = ExplainModel::with([
			'food' => $args['foodname'],
		], 'rcmdexplain');
		if($data){
			return $response->withJSON($data);
		}else{
			return $response->withStatus(400);
		}
	}

	public function avoid($request, $response, $args){
		$data = ExplainModel::with([
			'food' => $args['foodname'],
		], 'nrcmdexplain');
		if($data){
			return $response->withJSON($data);
		}else{
			return $response->withStatus(400);
		}
	}

}