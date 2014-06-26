<?php

class myRockitTest extends TestCase {

	/////////////////////////////// Single test ////////////////////////////////////

// 	public function testsMulti(){

// 	$class = "instruments";
// 	$this->testByClass_showAll("instruments");	
// 	}
// 	/**
// 	 * A basic functional test example.
// 	 *
// 	 * @return void
// 	 */
// 	protected function testByClass_showAll($class)
// 	{
// 		$response = $this->call('GET', "v1/$class");

// // var_dump($response->getContent() . ' is received');
// 	// receive a string
// 		$result = json_decode($response->getContent());

// 	// dd($result->status);
// 	$this->assertEquals("success", $result->status,'We expected to see that the id sent = 2');
// 	// receive a string
// 	// $this->assertEquals("true", $response->getContent());

// 	// $this->assertResponseOk();
// 	}

	/////////////////////////// Test that includes a name space ////////////////////
	// public function testClassWithTrait()
	// {
	// 	$response = $this->call('GET', 'v1/instruments');
	// 	var_dump($response->getContent());
	// }





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
		$response = $this->call('GET', 'v1/members', array('id' => $id));
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
