<?php
spl_autoload_register(function ($class_name) {
    		include '../classes/' .$class_name . '.class.php';
    	});

    $user = new User();
    if(!empty($_POST['username'])) {
            $user->Username = $_POST['username'];

            if($user->UsernameAvailable()) {
                    $response['status'] = 'success';
                    $response['message'] = 'Username available';
                } else {
                    $response['status'] = "error";
                    $response['message'] = 'Username already taken';
                }

         header('Content-type: application/json');
         echo json_encode($response);
     }

?>