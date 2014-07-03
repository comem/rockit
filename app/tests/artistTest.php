<?php

class artistTest extends TestCase {


	///////////////////////////// Test for index ////////////////////////////////////

	public function testIndex()
	{
		$response = $this->call('GET', 'v1/artists');
		$result = json_decode($response->getContent());
		var_dump($result);
		$this->assertEquals("success", $result->status);
		$this->assertResponseStatus(200);
	}


	///////////////////////////// Test for show ////////////////////////////////////

	public function testStore()
	{
		$response = $this->call('POST', 'v1/artists', ["name"=>"My new artist", 
			"short_description_de"=>"The short description", 
			"complete_description_de"=>"My long description",
			"images"=>[3],
			"genres"=>[2]
			]
		);
		$result = json_decode($response->getContent());
		var_dump($result);
		$this->assertEquals("success", $result->status);
		$this->assertResponseStatus(200);
	}


	///////////////////////////// Test for show ////////////////////////////////////

	public function testShow()
	{
		$response = $this->call('GET', 'v1/artists/1');
		$result = json_decode($response->getContent());
		var_dump($result);
		$this->assertEquals("success", $result->status);
		$this->assertResponseStatus(200);
	}


	///////////////////////////// Test for show ////////////////////////////////////

	public function testUpdate()
	{
		$response = $this->call('PUT', 'v1/artists/1', ["name"=>"My new artist", 
			"short_description_de"=>"The short description", 
			"complete_description_de"=>"My long description"
			]
		);
		$result = json_decode($response->getContent());
		var_dump($result);
		$this->assertEquals("success", $result->status);
		$this->assertResponseStatus(200);
	}


	///////////////////////////// Test for show ////////////////////////////////////

	public function testDelete()
	{
		$response = $this->call('DELETE', 'v1/artists/1');
		$result = json_decode($response->getContent());
		var_dump($result);
		$this->assertEquals("success", $result->status);
		$this->assertResponseStatus(200);
	}



}