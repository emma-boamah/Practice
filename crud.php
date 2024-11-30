<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
</head>
<body>
    <h2><div>INSERT DATA FORM</div></h2>
    <div>
        <form action="connect.php" method="POST">
            <div>
                <label for="form_Number">Form Number</label>
                <input type="text" name="form_Number" value="" placeholder="Enter Form ID">
            </div>
            <div>
                <label for="full_Name">Full Name</label>
                <input type="text" name="full_Name" value="" placeholder="Enter Full Name">
            </div>
            <div>
                <label for="home_Address">Home Address</label>
                <input type="text" name="home_Address" value="" placeholder="Enter Home Address">
            </div>
            <div>
                <label for="mobile_Number">Mobile Number</label>
                <input type="tel" name="mobile_Number" value="" placeholder="Enter Mobile Number">
            </div>
            <div>
                <label for="email">E-mail Address</label>
                <input type="text" name="email" value="" placeholder="Enter E-mail Address">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" value="" placeholder="Enter Password">
            </div>

            <div class="">
                <button type="submit" name="save">Save</button>
            </div>
        </form>
    </div>
</body>
</html>
<!-- PHP CODES -->
<?php
    require_once("connect.php");
    if(isset($_POST["save"])){
        $id=htmlspecialchars($_POST['id']);
        $name=htmlspecialchars($_POST['name']);
        $location=htmlspecialchars($_POST['home_Address']);
        $mobile=htmlspecialchars($_POST['mobile_Number']);
        $email=htmlspecialchars($_POST['email']);
        $password=htmlspecialchars($_POST['password']);

        // VALIDATE USER INPUT
        $errors = [];
        if(empty($id) || !ctype_digit($id)){
            $errors[] = "Invalid id";
        }
        if(empty($name)|| !ctype_alpha($name)){
            $errors[] = "Name must contain only Alphabets";
        }
        if(empty($location)||!ctype_alnum($location)){
            $errors[]="Invalid location input";
        }
        if(empty($mobile)||!ctype_digit($mobile)){
            $errors[] = "Invalid Mobile Number";
        }
        if(empty($email)||!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors[] = "Invalid E-mail Address!";
        }
        if(empty($password)){
            $errors[] = "Enter a password";
        } else{
            $password = password_hash($password, PASSWORD_DEFAULT);
        }

        // CHECK IF THERE ARE ANY ERRORS
        if(!empty($errors)){
            echo "Errors:";
            foreach( $errors as $error){
                echo '<br>' . $error;
            }
        } else{
            // PREPARE AND EXECUTE SQL STATEMENT
            $sql = ("INSERT INTO user_info(ID, Name, Locatioin, Mobile, Email, Password) VALUES(?, ?, ?, ?, ?, ?)");
            $stmt = $connection->prepare($sql);
            $stmt->bindParam(1, $id, PDO::PARAM_STR);
            $stmt->bindParam(2, $name, PDO::PARAM_STR);
            $stmt->bindParam(3, $location, PDO::PARAM_STR);
            $stmt->bindParam(4, $mobile, PDO::PARAM_STR);
            $stmt->bindParam(5, $email, PDO::PARAM_STR);
            $stmt->bindParam(6, $password, PDO::PARAM_STR);

            // CHECK IF INFO IS INSERTES
            if($stmt->rowCount()>0){
                echo "Data inserted successfully";
            }
            else{
                echo "Failed to insert Data";
            }
        }
    }
?>