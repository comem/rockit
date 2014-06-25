<?php

class myRockitTest extends TestCase {

	/////////////////////////////// Single test ////////////////////////////////////

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testById()
	{
		var_dump($id);
		$response = $this->call('GET', 'v1/members', array('id' => 2));

	var_dump($response->getContent() . ' is received');
	// receive a string
	$this->assertEquals(2, $response->getContent(),'We expected to see that the id sent = 2');
	// receive a string
	// $this->assertEquals("true", $response->getContent());

	// $this->assertResponseOk();
	}

	/////////////////////////// Composite Test ///////////////////////////////////

	public function testMultipleIds() {
		$this->testGetMemberById('1');
		$this->testGetMemberById('2');
		// $this->testGetMemberById(3);
	}


	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	protected function testGetMemberById($id)
	{
		var_dump($id);
		$response = $this->call('GET', 'v1/members', array('id' => {$id}));
	// $response = $this->call('GET', 'MemberController@show', array('id' => '3')); // doesnt work

	var_dump($response->getContent() . ' is received');
	// receive a string
	$this->assertEquals(2, $response->getContent(),'We expected to see that {$id} sent = 2');
	// receive a string
	// $this->assertEquals("true", $response->getContent());

	// $this->assertResponseOk();
	}

	///////////////////////////// PDO exception test ////////////////////////////

	// // why is this taking so long?
	// public function testLangs()
	// {
	// 	$response = $this->call('GET', 'v1/langs');
	// 	var_dump($response->getContent());
	// }

}
