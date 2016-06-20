<?php

namespace Controllers;

use Models\ExplainModel;

class ExplainController extends BaseController{

	public function recommended($request, $response, $args){
		$data = ExplainModel::with([
			'food' => $args['foodname'],
		], 'rcmdexplain');
		return $response->withJSON($data);
	}

	public function avoid($request, $response, $args){
		$data = ExplainModel::with([
			'food' => $args['foodname'],
		], 'nrcmdexplain');
		return $response->withJSON($data);
	}

}