<?php

class tablePeripheralTest extends TestCase {

	///////////////////////////// PDO exception test ////////////////////////////

	// // why is this taking so long?
	// public function testLangs()
	// {
	// 	$response = $this->call('GET', 'v1/langs');
	// 	var_dump($response->getContent());
	// }

	/// respond to the question above ?


	///////////////////////////// Test for show ////////////////////////////////////

	public function test_all_show_for_peripheral_tables()
	{
		// $cases = array("instruments", "genres");
		// foreach ($cases as $case) {
		// 	$this->generic_for_peripheral_table($case);
		// }
			$this->generic_for_peripheral_table("genres");
			// $this->generic_for_peripheral_table("instruments");
	}

	public function generic_for_peripheral_table($class)
	{	
		$response = $this->call('GET', "v1/$class");
		$result = json_decode($response->getContent());
		// echo "Pas de probleme si on appel UNE fois : \n";
		echo "$class ";
		var_dump($result->status);
		$this->assertEquals("success", $result
				->status,'We expected the show all to have a success status !');
		$this->assertResponseStatus(200);
	}

	
	// ///////////////////////////// test for updates /////////////////////////

	// public function test_all_update()
	// {
	// 	$cases = array(
	// 		array(
	// 			// "class" => "instruments", "name" => "ble"
	// 			"class" => "gifts", "name" => "gro"
	// 		));
	// 		// array(
	// 		// 	"class" => "ticket-categories", "name" => "bla"
	// 		// ));

	// 	foreach ($cases as $case) {
	// 		$this->generic_add_to_peripheral_table($case['class'], $case['name']);
	// 	}
	// }

	// public function generic_add_to_peripheral_table($class, $name)
	// {
	// 	$response = $this->call('POST', "v1/$class", array('name_de' => $name));
	// 	$result = json_decode($response->getContent());

	// 	echo "$class ";
	// 	var_dump($result->status);
	// 	$this->assertEquals("success", $result->status,'We expected an update to have a success status !');
	// 	$this->assertResponseStatus(200);
	// }



	// /////////////////////////// test for delete ////////////////////////////////

	// public function test_all_delete()
	// {
	// 	$cases = array(
	// 		array(
	// 			// "class" => "instruments", "name" => "ble"
	// 			"class" => "gifts", "name" => "goe"
	// 		));
	// 		// array(
	// 		// 	"class" => "ticket-categories", "name" => "bla"
	// 		// ));

	// 	foreach ($cases as $case) {
	// 		$this->generic_delete_from_peripheral_table($case['class'], $case['name']);
	// 	}
	// }

	// public function generic_delete_from_peripheral_table($class, $name)
	// {
	// 	$response = $this->call('POST', "v1/$class", array('name_de' => $name));
	// 	$result = json_decode($response->getContent());

	// 	echo "$class ";
	// 	var_dump($result->status);
	// 	$this->assertEquals("success", $result->status,'We expected a delete to have a success status !');
	// 	$this->assertResponseStatus(200);
	// }



}
