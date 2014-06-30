<?php

class authentificationTest extends TestCase {

	

	///////////////////////////// Test for login ////////////////////////////////////

	public function test_login()
	{
		$response = $this->call('POST', 'v1/login', array('remember' => 'true', 'email' => 'guzi@guzi.ch', 'password' => 'guzi'));
		// $response = $this->action('POST', 'AuthController@login', array('remember' => 'true', 'email' => 'bla@example.com', 'password' => 'password'));
		// difference of two lines above?
		$result = json_decode($response->getContent());
		echo "login is : ";
		var_dump($result->status);
		$this->assertEquals("success", $result
				->status, 'We expected the post login to have a success status !');
		$this->assertResponseStatus(200);
	}

	///////////////////////////// Test for logout ////////////////////////////////////

	public function test_logout()
	{
		$response = $this->call('GET', 'v1/logout');
		$result = json_decode($response->getContent());
		echo "logout is : ";
		var_dump($result->status);
		$this->assertEquals("success", $result
				->status, 'We expected the post logout to have a success status !');
		$this->assertResponseStatus(200);
	}



}