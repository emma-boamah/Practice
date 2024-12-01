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
        <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">
            <div>
                <label for="form_Number">Form Number</label>
                <input type="text" name="form_Number" value="" placeholder="Enter Form ID">
            </div>
            <div>
                <label for="full_Name">Full Name</label>
                <input type="text" name="full_Name" value="" placeholder="Enter Full Name" required>
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
                <input type="email" name="email" value="" placeholder="Enter E-mail Address">
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
    session_start();


    if(isset($_POST["save"])){
        
        try{
            $host = "localhost";
            $user = "root";
            $password = "";
            $dbname = "crud";
            $connection = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "success";

            $id=filter_var($_POST['form_Number'], FILTER_VALIDATE_INT);
            $name=filter_var($_POST['full_Name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $location=filter_var($_POST['home_Address'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $mobile=htmlspecialchars($_POST['mobile_Number']);
            $email=filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            $password=htmlspecialchars(string: $_POST['password']);

            // VALIDATE USER INPUT
            $errors = [];
            if(empty($id)){
                $errors[] = "Invalid id";
            }
            if(empty($name)){
                $errors[] = "Enter Full Name";
            }
            if(empty($location)){
                $errors[]="Invalid input for location";
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
                $sql = ("INSERT INTO user_info(ID, Name, Location, Mobile, Email, Password) VALUES(?, ?, ?, ?, ?, ?)");
                $stmt = $connection->prepare($sql);
                $stmt->bindParam(1, $id, PDO::PARAM_STR);
                $stmt->bindParam(2, $name, PDO::PARAM_STR);
                $stmt->bindParam(3, $location, PDO::PARAM_STR);
                $stmt->bindParam(4, $mobile, PDO::PARAM_STR);
                $stmt->bindParam(5, $email, PDO::PARAM_STR);
                $stmt->bindParam(6, $password, PDO::PARAM_STR);
                
                $stmt->execute();
                
                $_SESSION['message'] = "Form has been Added and saved to Table";
                $_SESSION["msg_type"] = "success";

                header("location: display.php");
            }


        } catch(PDOException $e){
            echo $e->getMessage();
        }

        
    }
?>