<?php

/*
 * Following code will get single product details
 * A product is identified by product id (pid)
 */

// array for JSON response
$response = array();


// include db connect class
//require_once __DIR__ . '/db_connect.php';

// connecting to db
//$db = new DB_CONNECT();

// check for post data
if (true) {
	
    $db = mysqli_connect("localhost","root","thanks123", "sunshine") or die ("could not connect to mysql"); 

    // get a product from products table
    $result = mysqli_query($db, "SELECT * FROM users WHERE is_admin = 0 and is_verified = 0");

    if (!empty($result)) {
        // check for empty result
        if (mysqli_num_rows($result) > 0) {
			
			// user node
			$response["users"] = array();

            while($row = mysqli_fetch_assoc($result)) {

				$request = array();
				$request["id"] = $row["id"];
				$request["username"] = $row["username"];
				$request["password"] = $row["password"];
				$request["email"] = $row["email"];
				$request["occupation"] = $row["occupation"];
								
				array_push($response["users"], $request);
			}
			
			// success
			$response["success"] = 1;

            // echoing JSON response
            echo json_encode($response);
        } else {
            // no product found
            $response["success"] = 0;
            $response["message"] = "No product found";

            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "No product found";

        // echo no users JSON
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>