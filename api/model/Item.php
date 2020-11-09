<?php

require('../model/Model.php');

class Item extends Model implements \JsonSerializable {
	private $id;
	private $name;
	private $cost;
	private $stocks;

	public function __construct($data){
		if( isset( $data->id) )
			$this->id = intval($data->id);
		if( isset( $data->name) )
			$this->name = $data->name;
		if( isset( $data->cost) )
			$this->cost = floatval($data->cost);
		if( isset( $data->stocks) )
			$this->stocks = intval($data->stocks);
	}
	public function create(){
		$query = "INSERT INTO Item(name,cost,stocks) VALUES('$this->name',$this->cost,$this->stocks)";
		return parent::createSQL( $query );
	}
	public function read(){
		$query = "SELECT id,name,cost,stocks FROM Item";
		return parent::readSQL($query, "Item");
	}
	public function update($data){
		if( "id" == $data->attribute)
			return false;
		$query = "UPDATE Item SET $data->attribute = '$data->value' WHERE id = '$data->id';";
		return parent::updateSQL( $query );
	}
	public function delete($data){
		$query = "DELETE FROM Item WHERE  id = '$data->id';";
		return parent::deleteSQL($query);
	}
	public function find( $id ){
		$query = "SELECT id,name,cost,stocks FROM Item WHERE id = '$id';";
		return parent::readSQL($query, "Item");
	}
	public function jsonSerialize(){
		$vars = get_object_vars($this);
		return $vars;
	}
}