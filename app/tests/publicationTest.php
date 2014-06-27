<?php

class publicationTest extends TestCase {

	

	///////////////////////////// Test for publish ////////////////////////////////////

	public function test_publish()
	{
		$id = 1;

		// $response = $this->call('PUT', "events/{$id}/publish");
		$response = $this->call('PUT', "v1/events/$id/publish");
		// $response = $this->action('events/{id}/publish', 'EventController@publish', array('remember' => 'true', 'email' => 'bla@example.com', 'password' => 'password'));
		// difference of two lines above?
		$result = json_decode($response->getContent());
		echo "publish status is : ";
		var_dump($result->status);
		$this->assertEquals("success", $result->status, 'We expected the publish function to have a success status !');
		$this->assertResponseStatus(200);
	}

	///////////////////////////// Test for unpublish //////////////////////////////////

	public function test_unpublish()
	{
		$id = 2;

		$response = $this->call('PUT', "v1/events/$id/unpublish");
		$result = json_decode($response->getContent());
		echo "unpublish status is : ";
		var_dump($result->status);
		$this->assertEquals("success", $result->status, 'We expected the unpublish function to have a success status !');
		$this->assertResponseStatus(200);
	}

}