<?php

include('login_config.php');

session_start();

if (isset($_POST["login_btn"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user_form WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            if ($row['user_type'] == 'admin') {
                $_SESSION['admin_name'] = $row['username'];
                header('location:admin_dashboard.php');
            } elseif ($row['user_type'] == 'user') {
                $_SESSION['user_name'] = $row['username'];
                header('location:user_dashboard.php');
            }
        } else {
            $error[] = 'Incorrect email or password';
        }
    } else {
        $error[] = 'Incorrect email or password';
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="login_style.css">

    <title>Login Form</title>
</head>

<body>
    <section>
        <div class="main">
            <div class="login">
                <h1>Login Form</h1>
                <form action="" method="post" autocomplete="off">
                    <?php
                    if (isset($error)) {
                        foreach ($error as $error) {
                            echo '<div class="input-wrapper" style="color: red; justify-content: center;">' . $error . '</div>';
                        };
                    };
                    ?>
                    <div class="input-wrapper">
                        <input type="email" name="email" class="input-field">
                        <label for="email">Email Address</label>
                        <span class="icon">
                            <i class="lni lni-user"></i>
                        </span>
                    </div>
                    <div class="input-wrapper">
                        <input type="password" name="password" class="input-field">
                        <label for="password">Password</label>
                        <span class="icon">
                            <i class="lni lni-lock-alt"></i>
                        </span>
                    </div>
                    <!-- <input type="submit" name="login_btn" value="Sign In" class="btn btn-submit"> -->
                    <button name="login_btn" value="LOGIN" class="btn-submit">Sign In</button>
                </form>
                <div class="signup-link">
                    Don't have an account?
                    <a href="register.php">Register</a>
                </div>
                <div class="signup-link">
                    Go to SRS Electrical
                    <a href="index.html">Index Page</a>
                </div>

            </div>
        </div>

    </section>

</body>

</html>