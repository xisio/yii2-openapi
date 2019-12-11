<?php

namespace cebe\yii2openapi\helper;
 
class ModelClass {
	private $tableName;
	private $name;
	private $namespacepath;
	private $modelNamespace;
	private $properties = [];
	private $relations = [];
	private $description;

	public function __construct(array $arr){
		$this->init($arr);
	}

	public function init(array $arr){
		foreach($arr as $key=> $value){
			$this->$key = $value;
		}
	}

	public function setNamespace($namespacepath){
		$this->namespacepath = $namespacepath;
	}

	public function addRelation(array $relation){
		$this->relations = array_merge($this->relations,$relation);
	}

	public function addProperty($property){
		$this->properties = array_merge($this->properties,$property);
	}
}


