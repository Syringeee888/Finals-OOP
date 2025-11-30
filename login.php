<?php
session_start();
if (isset($_SESSION['email'])) header("Location: profile.php");

$message = '';
if (isset($_POST['login'])) {
    $data = json_decode(file_get_contents('students.json'), true) ?: [];
    $found = false;
    foreach ($data as $s) {
        if ($s['email'] == $_POST['email'] && $s['password'] == $_POST['password']) {
            $_SESSION['email'] = $s['email'];
            $found = true;
            header("Location: profile.php");
            exit();
        }
    }
    if (!$found) $message = "Invalid email or password!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Login</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="title-wrapper">
    <h1>Student Information System</h1>
</div>
<div class="container">
    <h2>Login</h2>
    <?php if($message != '') echo "<p class='message' style='color:red;'>$message</p>"; ?>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>
    <p>Don't have an account? <a href="register.php">Register</a></p>
</div>
</body>
</html>
