<?php

class Auth extends Controller{
    private $keyUser;
    private $password;

    public function __construct($data){
        $this->keyUser = $data->keyUser;
        $this->password = $data->password;
    }

    public function authenticate($userModel){
        $query = "CALL sp_select_user('$this->keyUser', '$this->password');";
        $response = $userModel->readSQL( $query );
        print_r( $response );
    }
}
