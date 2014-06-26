<?php

class tablesWithAddressTest extends TestCase {

	// Adapt to consider musician (problem with lineup and interdepence on another class)

	///////////////////////////// Test for index ////////////////////////////////////

	public function test_show_all_for_tables_with_addresses()
	{
		// $cases = array( array( 'uri' => 'v1/musicians', 'controllerMethod' => 'MusicianController@index'));
		$cases = array( 
			array( 
				'method' => 'GET', 
				'uri' => 'v1/members'
			));
		foreach ($cases as $case){
			$response = $this->show_all_for_tables_with_addresses( $case['method'], $case['uri'] );
		}
	}

	public function show_all_for_tables_with_addresses($method, $uri)
	{
		$response = $this->call($method, $uri);
		$result = json_decode($response->getContent());
		echo "Index $uri : ";
		var_dump($result->status);
		$this->assertEquals("success", $result
				->status,'We expected the show all to have a success status !');
		$this->assertResponseStatus(200);
	}


	///////////////////////////// Test for show ////////////////////////////////////

	public function test_show_one_for_tables_with_addresses()
	{
		$id = 4;
		$cases = array( 
			array( 
				'method' => 'GET', 
				'uri' => "v1/musicians/$id" 
			));
		foreach ($cases as $case){
			$response = $this->show_one_for_tables_with_addresses( $case['method'], $case['uri'] );
		}
	}

	public function show_one_for_tables_with_addresses($method, $uri)
	{
		$response = $this->call($method, $uri);
		$result = json_decode($response->getContent());
		echo "Show $uri : ";
		var_dump($result->status);
		$this->assertEquals("success", $result
				->status,'We expected the show one to have a success status !');
		$this->assertResponseStatus(200);
	}


	///////////////////////////// Test for show ////////////////////////////////////

	// public function test_store_one_for_tables_with_addresses()
	// {
	// 	//first_name', 'last_name', 'stagename', 'lineups');
	// 	$cases = array( 
	// 				array( 
	// 					'method' => 'POST', 
	// 					'uri' => "v1/musicians",
	// 					'first_name' => 'Karl',
	// 					'last_name' => 'Legerfeld',
	// 					'stagename' => 'Bonzai',
	// 					'lineups' => array(
	// 									array(
	// 										'artist_id' => 1,
	// 										'instrument_id' =>1
	// 										),
	// 									array(
	// 										'artist_id' => 1,
	// 										'instrument_id' =>2
	// 										),
	// 									array(
	// 										'artist_id' => 1,
	// 										'instrument_id' =>3
	// 										)
	// 									)
	// 				)
	// 			);
	// 	foreach ($cases as $case){
	// 		$response = $this->store_one_for_tables_with_addresses( $case );
	// 	}
	// }

	// public function store_one_for_tables_with_addresses( $case )
	// {
		
	// 	// var_dump($case);
	// 	$response = $this->call($case['method'], $case['uri'], 
	// 					array(
	// 						'first_name' => $case['first_name'],
	// 						'last_name' => $case['last_name'],
	// 						'stagename' => $case['stagename'],
	// 						'lineups' => $case['lineups'],
	// 						)
	// 					);
	// 	$result = json_decode($response->getContent());
	// 	// echo "Store " . $case['uri'] . " : ";
	// 	dd($result->status);
	// 	$this->assertEquals("success", $result
	// 			->status,'We expected the store one to have a success status !');
	// 	$this->assertResponseStatus(200);
	// }




		// $response = $this->action('representers', 'RepresenterController@store', array('remember' => 'true', 'email' => 'bla@example.com', 'password' => 'password'));
		// $response = $this->action('representers', 'RepresenterController@update', array('remember' => 'true', 'email' => 'bla@example.com', 'password' => 'password'));
		// $response = $this->action('representers', 'RepresenterController@destroy', array('remember' => 'true', 'email' => 'bla@example.com', 'password' => 'password'));
		
}