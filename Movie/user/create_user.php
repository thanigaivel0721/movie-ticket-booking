<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Login Page">
    <meta name="keywords" content="DreamWorld Cinemas,Movies">
    <meta name="author" content="Arunachalam M">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link href='../css/loginstyle.css' rel="stylesheet">
    <link rel="icon" href="../img/logo2.png">
    <link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d3a7f46eb0.js" crossorigin="anonymous"></script>
    <script src="../js/validator_create.js"></script>
</head>
<body>
    <div class="circle"></div>
    <div class="circle1"></div>
    <h1 class="signupmaintitle">DREAMWORLD CINEMAS</h1>
    <main class="reg-form">
        <h2 class="reg-form-title">Create Your Account</h2>
        <form method="POST" name="newuserform" class="new-user-form">
            <input type="text" name="name" class="input" placeholder="Full Name" id="hide1"><br>
            <select name="gender" class="input" id="hide2">
                <option value="Gender" disabled selected hidden class="drop">Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select><br>
            <input type="text" name="phoneno" class="input" placeholder="Phone number" id="hide3"><br>
            <input type="email" name="email" class="input" placeholder="Email" id="hide4"><br>
            <input type="text" name="city" class="input" placeholder="City" id="hide5"><br>
            <input type="text" name="username" class="input" placeholder="Username" id="hide6"><br>
            <input type="password" name="password" class="input"
            placeholder="Password" id="hide7"><br>
            <input type="password" name="confirmpassword" class="input"
            placeholder="Confirm Password" id="hide8"><br>
            <input type="submit" value="Sign Up" class="signupbutton" onclick="validateform()" id="hide9">
            <!-- To have terms and conditions here -->
        </form>
    
        <?php
// Define your MySQL connection parameters
$host = 'localhost:3306';
$username = 'username'; // Replace with your actual username
$password = 'password'; // Replace with your actual password
$database = 'dreamworld'; // Replace with your actual database name

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if (isset($_POST["name"]) && isset($_POST["gender"]) && isset($_POST["phoneno"]) && isset($_POST["email"]) && isset($_POST["city"]) && isset($_POST["username"]) && isset($_POST["password"])) {
    $name = $_POST["name"];
    $gender = $_POST["gender"];
    $phoneno = $_POST["phoneno"];
    $email = $_POST["email"];
    $city = $_POST["city"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if the email already exists
    $emailCheckQuery = "SELECT * FROM login WHERE Email='$email'";
    $emailCheckResult = $conn->query($emailCheckQuery);
    if ($emailCheckResult->num_rows > 0) {
        echo "<script>alert('Account Already exists with this Email-id. Please use some other email.');</script>";
        echo "<script>window.location.replace('create_user.php')</script>";
        goto end;
    }

    // Check if the username already exists
    $usernameCheckQuery = "SELECT * FROM login WHERE Username='$username'";
    $usernameCheckResult = $conn->query($usernameCheckQuery);
    if ($usernameCheckResult->num_rows > 0) {
        echo "<script>alert('Account Already exists with this Username. Please use some other Username.');</script>";
        echo "<script>window.location.replace('create_user.php')</script>";
        goto end;
    }

    // Insert new user
    $insertQuery = "INSERT INTO login VALUES ('$name', '$gender', '$phoneno', '$email', '$city', '$username', '$password', 'none')";
    $insertResult = $conn->query($insertQuery);

    // Check if the user is successfully inserted
    if ($insertResult) {
       
        header("location: ../login.php");
    }
}

end:
// Close your HTML document
echo "</main>
</body>
</html>";
?>
