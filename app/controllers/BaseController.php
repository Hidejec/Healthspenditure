<?php

namespace Controllers;

class BaseController{

	private $container;

	public function __construct($container){
		$this->container = $container;
	}

	public function view(){
		return $this->container['view'];
	}
	
}