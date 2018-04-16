<?php

class UserModel extends Model{
	public function register (){
	
		// sanitise the post
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

         


		$password = md5($post['password']);

		if ($post['submit']){

			if($post['name'] == ''){
				Messages::setMsg('Please fill in the form', 'error');
				return;
 }




			// insert
		$this->query('insert into users(name, email, password) VALUES(:name,:email,:password)');
		$this->bind(':name', $post['name']);
		$this->bind(':email', $post['email']);
		$this->bind(':password', $password);
		$this->execute();

		// verify
		if ($this->lastInsertId()){
			// redirect
		header('Location: '.ROOT_URL.'Users/Login');
		}

	}
	return;	
}

	public function login (){
		// sanitise the post
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		$password = md5($post['password']);

		if ($post['submit']){

		// check for user
		$this->query('SELECT * FROM users WHERE email = :email and password = :password');
		$this->bind(':email',$post['email']);
	    $this->bind(':password', $password);
		
		$row = $this->single();

		if ($row){
			$_SESSION['is_logged_in'] = true;
			$_SESSION['user_data'] = array(
				"id"=>$row['id'],
				"name"=>$row['name'],
				"email"=>$row['email']
            );
            header('Location: '.ROOT_URL.'Shares');
		} else {
			Messages::setMsg('Incorrect Login', 'error');
		}
	}
	return;	
	}
}