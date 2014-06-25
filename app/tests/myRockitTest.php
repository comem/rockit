<?php

class myRockitTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testGetGenreById()
	{
			
		$response = $this->call('GET', 'v1/members', array('id' => 3));
	// $response = $this->call('GET', 'MemberController@show', array('id' => '3')); // doesnt work

	var_dump($response->getContent() . ' is received');
	// receive a string
	$this->assertEquals(3, $response->getContent());
	// receive a string
	// $this->assertEquals("true", $response->getContent());

	// $this->assertResponseOk();
	}


}
