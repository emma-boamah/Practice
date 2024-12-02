<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Records</title>
</head>
<body>
    <div>
        <h2>Add new Records</h2>
        <div>
            <form role="form" action="transac.php?action=add" method="post">
                <div>
                    <input type="text" placeholder="First Name" name="firstname" required>
                </div>
                <div>
                    <input type="text" placeholder="Last Name" name="lastname" required>
                </div>
                <div>
                    <input type="text" name="Middlename" placeholder="Middle Name">
                </div>
                <div>
                    <input type="text" name="Address" placeholder="Address">
                </div>
                <div>
                    <input type="text" name="contact" placeholder="contact">
                </div>
                <div>
                    <label for="comment">Comment</label>
                    <textarea name="comment" rows="3"></textarea>
                </div>
                <button type="submit">Save Record</button>
                <button type="reset">Clear Entry</button>
            </form>
        </div>
    </div>
</body>
</html>