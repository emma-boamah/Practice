<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Using PHP/MYSQL</title>
</head>
<body>
    <div>
        <h2>Users Information</h2>
        <div>
            <?php
            require_once("config.php");
            $query = ("SELECT * FROM people");
            $stmt = $db_Connection->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <table cellspacing="5">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Middle Name</th>
                        <th>Address</th>
                        <th>Contact Number</th>
                        <th>Commenet</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <?php while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)){?>
                    <tr>
                        <td><?php echo $row['first_name'];?></td>
                        <td><?php echo $row['last_name'];?></td>
                        <td><?php echo $row['mid_name'];?></td>
                        <td><?php echo $row['address'];?></td>
                        <td><?php echo $row['contact'];?></td>
                        <td><?php echo $row['comment'];?></td>
                        <td><a href="edit.php" id="<?php echo $row['people_id'];?>">Edit</a></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        
    </div>
</body>
</html>