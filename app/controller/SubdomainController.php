<?php

class SubdomainController
{
	public static function insertSubdomain($data = array())
	{
		try {
			$dst = realpath(dirname(ROOT)) . DS . $data['subdomain'];
			$src = ROOT . 'subdomain';
		    SubdomainController::recurse_copy($src,$dst);
		    return true;

		} catch (Exception $ex) {

			$data = array(
				'msg' => $ex->getMessage(), 
				'route' => '/erro'
				);

			return ($data);
		}
	}

	public static function recurse_copy($src,$dst){
		$dir = opendir($src); 
		@mkdir($dst); 
		    while(false !== ( $file = readdir($dir)) ) { 
		        if (( $file != '.' ) && ( $file != '..' )) { 
		            if ( is_dir($src . '/' . $file) ) { 
		                SubdomainController::recurse_copy($src . '/' . $file,$dst . '/' . $file); 
		            } 
		            else { 
		                copy($src . '/' . $file,$dst . '/' . $file); 
		            } 
		        } 
		    } 
		    closedir($dir); 
	}

	public static function create_base($data){

		// $conn = new mysqli('localhost', 'root', '');
		// // Check connection
		// if ($conn->connect_error) {
		//     die("Connection failed: " . $conn->connect_error);
		// }else{
		// 	echo 'Connected';
		// } 
		// echo '<br>';
		// // Create database
		// $sql = "CREATE DATABASE " . $data['subdomain'];
		// if ($conn->query($sql) === TRUE) {
		//     echo "Database created successfully";
		// } else {
		//     echo "Error creating database: " . $conn->error;
		// }
		// echo '<br>';
		// $conn->close();

		$conn = new mysqli('localhost', 'root', '', $data['subdomain']);

		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}else{
			echo 'Connected';
		} 
		echo '<br>';

		$file=file_get_contents(realpath(dirname(ROOT)) . DS . $data['subdomain'] . DS . 'gibr.sql');


		if($conn->multi_query($file)){
			echo 'Ok';
		}else{
			echo $conn->error;
		}
		$conn->close();
		
	}

}