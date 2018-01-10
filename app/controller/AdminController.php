<?php

class AdminController
{
	public static function execSql($data = array())
	{
        foreach(ClientController::listClient() as $client){
            $conn = mysqli_connect('localhost', $client->root, $client->password);
            $db = mysqli_select_db($conn, $client->database);
            mysqli_set_charset($conn,'utf8');

            // Temporary variable, used to store current query
            $templine = '';
            // Read in entire file
            $lines = file($_FILES['file']['tmp_name']);
            // Loop through each line
            foreach ($lines as $line)
            {
                // Skip it if it's a comment
                if (substr($line, 0, 2) == '--' || $line == '')
                    continue;

                // Add this line to the current segment
                $templine .= $line;
                // If it has a semicolon at the end, it's the end of the query
                if (substr(trim($line), -1, 1) == ';')
                {
                    // Perform the query
                    mysqli_query($conn, $templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
                    // Reset temp variable to empty
                    $templine = '';
                }
            }

            mysqli_close($conn);
        }
	}
}