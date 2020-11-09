<?php

require('../model/Model.php');

class Task extends Model implements \JsonSerializable {
	private $id;
	private $nameTask;
	private $dateInit;
	private $dateFinal;

	public function __construct($data){
		if( isset( $data->id) )
			$this->id = intval($data->id);
		if( isset( $data->nameTask) )
			$this->nameTask = $data->nameTask;
		if( isset( $data->dateInit) )
			$this->dateInit = $data->dateInit;
		if( isset( $data->dateFinal) )
			$this->dateFinal = $data->dateFinal;
	}
	public function create(){
		$query = "INSERT INTO Task(nameTask,dateInit,dateFinal) VALUES('$this->nameTask','$this->dateInit','$this->dateFinal')";
		return parent::createSQL( $query );
	}
	public function read(){
		$query = "SELECT id,nameTask,dateInit,dateFinal FROM Task";
		return parent::readSQL($query, "Task");
	}
	public function update($data){
		if( "id" == $data->attribute)
			return false;
		$query = "UPDATE Task SET $data->attribute = '$data->value' WHERE id = '$data->id';";
		return parent::updateSQL( $query );
	}
	public function delete($data){
		$query = "DELETE FROM Task WHERE  id = '$data->id';";
		return parent::deleteSQL($query);
	}
	public function find( $id ){
		$query = "SELECT id,nameTask,dateInit,dateFinal FROM Task WHERE id = '$id';";
		return parent::readSQL($query, "Task");
	}
	public function jsonSerialize(){
		$vars = get_object_vars($this);
		return $vars;
	}
}