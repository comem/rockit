<?php

class myRockitTest extends TestCase {

	///////////////////////////// Single test ////////////////////////////////////

	public function test_all_show_for_peripheral_tables()
	{

		$cases = array("instruments");

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
	}

	public function test_generic_for_peripheral_table($class = "genres")
	{	
		$response = $this->call('GET', "v1/$class");
		$result = json_decode($response->getContent());
		// echo "call here";
		echo "$class ";
		var_dump($result->status);
		$this->assertEquals("success", $result->status,'We expected to have a success status !');
		$this->assertResponseStatus(200);
	}

	
	///////////////////////////// test for updates /////////////////////////

	public function test_all_update()
	{
		$cases = array("skills");

		foreach ($cases as $case) {
			$this->test_generic_add_to_peripheral_table("ble", $case);
		}
	}

	public function test_generic_add_to_peripheral_table($name_de = "bln", $class = "genres")
	{
		$response = $this->call('POST', "v1/$class", array('name_de' => $name_de));

		$result = json_decode($response->getContent());

		echo "$class ";
		var_dump($result->status);

		$this->assertEquals("success", $result->status,'We expected to have a success status !');
		$this->assertResponseStatus(200);

		// $this->assertResponseOk();
	}




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
