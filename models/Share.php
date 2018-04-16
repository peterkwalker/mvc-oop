<?php

class ShareModel extends Model{
	public function Index(){
		$this->query('select * from shares order by create_date desc');
		$rows = $this->resultSet();
		return $rows;
	}

	public function add(){
		// sanitise the post
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		if ($post['submit']){
			// insert
		$this->query('insert into shares(title, body, link, user_id) VALUES(:title,:body,:link,:user_id)');
		$this->bind(':title', $post['title']);
		$this->bind(':body', $post['body']);
		$this->bind(':link', $post['link']);
		$this->bind(':user_id', 1);
		$this->execute();

		// verify
		if ($this->lastInsertId()){
			// redirect
		header('Location: '.ROOT_URL.'Shares');
		}

	}
	return;
}

}