<?php

require('./Controller.php');
require('./InterfaceController.php');
require('../model/Task.php');

class TaskController extends Controller implements InterfaceController{
	private $task;

	public function __construct(){
		parent::__construct("task");
		$this->task = new Task( $this->data->task );
	}
	public function exec(){
		$function = $this->method;
		$this->$function();
	}
	public function POST(){
		if( $this->params == null)
			print_r( json_encode( $this->task->create() ) );
		else{
			$function = $this->params[0];
			$this->$function();
		}
	}
	public function GET(){
		if( $this->params == null)
			print_r( json_encode( $this->task->read() ) );
		else{
			$function = $this->params[0];
			$this->$function();
		}
	}
	public function PUT(){
		print_r( json_encode( $this->task->update($this->data) ) );
	}
	public function DELETE(){
		print_r( json_encode( $this->task->delete($this->data) ) );
	}
	public function find(){
		print_r( json_encode( $this->task->find( $this->params[1] ) ) );
	}
	public function test(){
		echo "Test Task";
	}
}

$taskController = new TaskController();
$taskController->exec();