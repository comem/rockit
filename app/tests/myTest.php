<?php

class myRockitTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testGetGenreById()
	{
	// 	$response = $this->call('POST', 'genres', array('name_de' => 'organ'));
	
	// 	$this->assertEquials('true', $response->getContent());
	

	$response = $this->call('GET', 'genres', array('id' => '1'));
	// $this->assertResponseStatus(403);

	// $this->assertResponseOk();

	}

}
