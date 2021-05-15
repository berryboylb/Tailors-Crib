<?php

include '../config/database.php';

$fname =  $email = "";


function test_input($fname, $email){
        if (!preg_match("/^[a-zA-Z-' ]*$/",$fname)) {

            return  [
                'error'=>'Only letters and white space allowed for firstname'
            ];
        }

        if (!preg_match("/^[a-zA-Z-' ]*$/",$fname)) {
            
            return  [
                'error'=>'Only letters and white space allowed for firstname'
            ];
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            return  [
                'error'=>'Invalid email format'
            ];
        }

        $new_query = "SELECT * FROM waitlist WHERE email = ?";
        $stmt = $GLOBALS['con']->prepare($new_query);
        $stmt->bindValue(1, $email);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($result)) {
            return  [
                'error'=>'This email has been used'
            ];
        }


        return  [
            'true'=>'all tests passed'
        ];
}




try {
    if (isset($_POST['submit'])) {
        $fname = $_POST['first_name'];
        $email = $_POST['email'];

        //validate the results
        $validate = test_input($fname,$email);
    
        if(isset($validate['true'])){
          $query = "INSERT INTO suscribers SET first_name=:first_name, email=:email, register_date=:register_date";
          $stmt = $con->prepare($query);

          // bind the parameters
          $stmt->bindParam(':first_name', $fname);
          $stmt->bindParam(':email', $email);
          $register_date=date('Y-m-d H:i:s');
          $stmt->bindParam(':register_date', $register_date);

        
         if($stmt->execute()){
            $response = [
                'success'=> 'Record saved'
            ];
            // echo json_encode($response);
            //return header("Location: waitlist.html");
            echo json_encode($response);
        }
    }
    else 
        {
            echo json_encode($validate);
        }
          
    }
}
  

// show error
catch(PDOException $exception){
    echo "There was an issue connecting with database: " . $exception->getMessage();
}