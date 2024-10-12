<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up for Terminal Management System</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
    <div class="container">
        <h3>Sign Up</h3>
        <form action="register.php" method="post">
            <div class="form-group">
                <label for="userName">Username:</label>
                <input type="text" id="userName" name="userName" required>
            </div>
            <div class="form-group">
                <label for="userPass">Password:</label>
                <input type="password" id="userPass" name="userPass" required>
            </div>
            <div class="form-group">
                <label for="userLastname">Last Name:</label>
                <input type="text" id="userLastname" name="userLastname" required>
            </div>
            <div class="form-group">
                <label for="userFirstname">First Name:</label>
                <input type="text" id="userFirstname" name="userFirstname" required>
            </div>
            <div class="form-group">
                <label for="userAddress">Address:</label>
                <input type="text" id="userAddress" name="userAddress" required>
            </div>
           <div class="form-group">
    			<label for="userPhoneNumber">Phone Number:</label>
   				<input type="number" id="userPhoneNumber" name="userPhoneNumber" required>
			</div>

            <div class="form-group">
                <input type="submit" value="Sign Up">
            </div>
        </form>
        <p>Already have an account? <a href="login.html">Login</a></p>
    </div>
</body>
</html>
