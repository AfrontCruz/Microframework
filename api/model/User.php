<?php

require('../model/Model.php');

class User extends Model implements \JsonSerializable {
	private $email;
	private $password;
	private $username;
	private $active;
	private $created;
	private $updated;

	public function __construct($data){
		if( isset( $data->email) )
			$this->email = $data->email;
		if( isset( $data->password) )
			$this->password = $data->password;
		if( isset( $data->username) )
			$this->username = $data->username;
		if( isset( $data->active) )
			$this->active = intval($data->active);
		if( isset( $data->created) )
			$this->created = $data->created;
		if( isset( $data->updated) )
			$this->updated = $data->updated;
	}
	public function create(){
		$query = "CALL sp_insert_user('$this->email','$this->password','$this->username')";
		echo $query;
		return parent::createSQL( $query );
	}
	public function read(){
		$query = "SELECT email,username,active,created,updated FROM User";
		return parent::readSQL($query, "User");
	}
	public function update($data){
		if( "created" == $data->attribute || "updated" == $data->attribute)
			return false;
		$query = "UPDATE User SET $data->attribute = '$data->value' WHERE email = '$data->email';";
		return parent::updateSQL( $query );
	}
	public function delete($data){
		$query = "DELETE FROM User WHERE  email = '$data->email';";
		return parent::deleteSQL($query);
	}
	public function find( $email ){
		$query = "SELECT email,username,active,created,updated FROM User WHERE email = '$email';";
		return parent::readSQL($query, "User");
	}
	public function jsonSerialize(){
		$vars = get_object_vars($this);
		return $vars;
	}
}