<?php

include 'config/database.php';

$fname = $lname = $email = "";
function test_input($fname, $lname, $email)
        {
            
            if (!preg_match("/^[a-zA-Z-' ]*$/",$fname)) {

                return  [
                    'error'=>'Only letters and white space allowed for firstname'
                ];
            }

            if (!preg_match("/^[a-zA-Z-' ]*$/",$lname)) {
                
                return  [
                    'error'=>'Only letters and white space allowed for lastname'
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
        $lname = $_POST['last_name'];
        $email = $_POST['email'];
    
        // echo $fname . $lname . $email;
        $validate = test_input($fname, $lname, $email);
        if(isset($validate['true'])){

          $query = "INSERT INTO waitlist SET first_name=:first_name, last_name=:last_name,email=:email, register_date=:register_date";
          $stmt = $con -> prepare($query);

          // bind the parameters
          $stmt->bindParam(':first_name', $fname);
          $stmt->bindParam(':last_name', $lname);
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