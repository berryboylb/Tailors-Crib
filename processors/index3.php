<?php

include '../config/database.php';

try {
    if (isset($_POST['submit'])) {
        $fname = $_POST['first_name'];
        $lname = $_POST['last_name'];
        $email = $_POST['email'];
        $brand_name = $_POST['brand_Name'];
        $address = $_POST['address'];
    
        // echo $fname . $lname . $email;

        if (!preg_match("/^[a-zA-Z-' ]*$/",$fname)) {
            $nameErr = "Only letters and white space allowed for firstname";
            echo $nameErr;
            echo "<br>";
        }

        if (!preg_match("/^[a-zA-Z-' ]*$/",$lname)) {
            $nameErr = "Only letters and white space allowed for Lastname";
            echo $nameErr;
            echo "<br>";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            echo $emailErr;
            echo "<br>";
          }

          if (!preg_match("/[^A-Za-z0-9]/",$brand_name)) {
            $brandErr = "Only numbers letters and white spaces are allowed";
            echo $brandErr;
            echo "<br>";
        }

        if (!preg_match("/[^A-Za-z0-9]/",$address)) {
            $addressErr = "Only numbers letters and white spaces are allowed";
            echo $addressErr;
            echo "<br>";
        }

          $query = "INSERT INTO members SET first_name=:first_name, last_name=:last_name,email=:email, brand_name=:brand_name, address=:address, register_date=:register_date";
          $stmt = $con->prepare($query);

          // bind the parameters
          $stmt->bindParam(':first_name', $fname);
          $stmt->bindParam(':last_name', $lname);
          $stmt->bindParam(':email', $email);
          $stmt->bindParam(':brand_name', $brand_name);
          $stmt->bindParam(':address', $address);
          $register_date=date('Y-m-d H:i:s');
          $stmt->bindParam(':register_date', $register_date);

        
         if($stmt->execute()){
            echo " Record was saved";
            header("Location: ../waitlist.html");
            exit();
        }else {
            echo " Record was not saved";
        }
          
    }
}
  

// show error
catch(PDOException $exception){
    echo "There was an issue connecting with database: " . $exception->getMessage();
}