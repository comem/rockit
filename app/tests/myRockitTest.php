<?php

class myRockitTest extends TestCase {

	///////////////////////////// Single test ////////////////////////////////////

	public function test_all_show_for_peripheral_tables()
	{

		$cases = array("instruments", "gifts", "event-types");

		foreach ($cases as $case) {
			$this->test_generic_for_peripheral_table($case);
		}

		// $this->test_generic("event-types");
		// $this->test_generic("ticket-categories");
		// $this->test_generic("gifts");
		// $this->test_generic("skills");
		// $this->test_generic("printing-types");	
		// $this->test_generic("instruments");
		// $this->test_generic("equipments");
		// echo "finish";
	}

	protected function test_generic_for_peripheral_table($class = "genres")
	{	
		$response = $this->call('GET', "v1/$class");
		$result = json_decode($response->getContent());
		// echo "call here";
		echo "$class ";
		var_dump($result->status);
		$this->assertEquals("success", $result->status,'We expected to have a success status !');
		$this->assertResponseStatus(200);
	}

	// public function test_instruments_show()
	// {
	// 	$response = $this->call('GET', "v1/genres");

	// 	$result = json_decode($response->getContent());

	// 	var_dump($result);

	// 	$this->assertEquals("success", $result->status,'We expected to have a success status !');
	// 	$this->assertResponseStatus(200);

	// 	// $this->assertResponseOk();
	// }




	/////////////////////////// Test that includes a name space ////////////////////
	// public function testClassWithTrait()
	// {
	// 	$response = $this->call('GET', 'v1/instruments');
	// 	var_dump($response->getContent());
	// }




	///////////////////////////// PDO exception test ////////////////////////////

	// // why is this taking so long?
	// public function testLangs()
	// {
	// 	$response = $this->call('GET', 'v1/langs');
	// 	var_dump($response->getContent());
	// }

}
