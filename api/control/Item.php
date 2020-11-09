<?php

require('./Controller.php');
require('./InterfaceController.php');
require('../model/Item.php');

class ItemController extends Controller implements InterfaceController{
	private $item;

	public function __construct(){
		parent::__construct("item");
		$this->item = new Item( $this->data->item );
	}
	public function exec(){
		$function = $this->method;
		$this->$function();
	}
	public function POST(){
		if( $this->params == null)
			print_r( json_encode( $this->item->create() ) );
		else{
			$function = $this->params[0];
			$this->$function();
		}
	}
	public function GET(){
		if( $this->params == null)
			print_r( json_encode( $this->item->read() ) );
		else{
			$function = $this->params[0];
			$this->$function();
		}
	}
	public function PUT(){
		print_r( json_encode( $this->item->update($this->data) ) );
	}
	public function DELETE(){
		print_r( json_encode( $this->item->delete($this->data) ) );
	}
	public function find(){
		print_r( json_encode( $this->item->find( $this->params[1] ) ) );
	}
	public function test(){
		echo "Test Item";
	}
}

$itemController = new ItemController();
$itemController->exec();