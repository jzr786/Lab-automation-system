<?php

include('login_config.php');

$username = $email = $password = $confirm_password = $user_type = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"])) {
        $error[] = "Name is required";
    } else {
        $username = $_POST["username"];
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $username)) {
            $error[] = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["email"])) {
        $error[] = "Email is required";
    } else {
        $email = $_POST["email"];
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error[] = "Invalid email format";
        }
    }

    if (empty($_POST["password"])) {
        $error[] = "Password is required";
    } else {
        $password = $_POST["password"];
    }

    $confirm_password = $_POST['confirm_password'];
    $user_type = $_POST['user_type'];
    // if (isset($_POST["signup_btn"])) {

    //     $username = $_POST['username'];
    //     $email = $_POST['email'];
    //     $password = $_POST['password'];
    //     $confirm_password = $_POST['confirm_password'];
    //     $user_type = $_POST['user_type'];

    //     if (empty($username)) {
    //         $error[] = "Name is required";
    //     } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $username)) {
    //         $error[] = "Only letters and white space allowed";
    //     }


    //     if (empty($_POST["email"])) {
    //         $error[] = "Email is required";
    //     } else {
    //         $email = $_POST["email"];
    //         if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //             $error[] = "Invalid email format";
    //         }
    //     }

    if ($password !== $confirm_password) {
        $error[] = 'Password not matched!';
    } else {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $query = "SELECT * FROM user_form WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        $query = "SELECT * FROM user_form WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result1 = $stmt->get_result();


        if ($result->num_rows > 0) {
            $error[] = 'Username already exists!';
        } elseif ($result1->num_rows > 0) {
            $error[] = 'Email already exists!';
        } else {
            $insert = "INSERT INTO user_form (username, email, password, user_type) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($insert);
            $stmt->bind_param("ssss", $username, $email, $hashed_password, $user_type);
            $stmt->execute();

            header('location:login.php');
        }
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
                <h1>Register Yourself</h1>
                <form action="" method="post" autocomplete="off">
                    <?php
                    if (isset($error)) {
                        foreach ($error as $error) {
                            echo '<div class="input-wrapper" style="color: red; justify-content: center;">' . $error . '</div>';
                        };
                    };
                    ?>
                    <div class="input-wrapper">
                        <input type="text" name="username" class="input-field">
                        <label for="">Username</label>
                    </div>
                    <div class="input-wrapper">
                        <input type="email" name="email" class="input-field">
                        <label for="email">Email</label>
                    </div>
                    <div class="input-wrapper">
                        <input type="password" name="password" class="input-field">
                        <label for="password">Password</label>
                    </div>
                    <div class="input-wrapper">
                        <input type="password" name="confirm_password" class="input-field">
                        <label for="confirm_password"> Confirm Password</label>
                    </div>
                    <div class="input-wrapper">
                        <input type="text" name="user_type" class="input-field" value="user" readonly>
                        <label for="user_type"></label>



                        <!-- <select class="input-field" name="user_type">
                            <option style="background-color: #121a23; color: white;" value="user">
                                User</option>
                            <option style="background-color: #121a23; color: white;" value="admin" selected>
                                Admin</option>
                        </select> -->
                    </div>
                    <!-- <input type="submit" name="signup_btn" value="Register" class="btn btn-submit"> -->
                    <button class="btn-submit" name="signup_btn">Register</button>

                </form>
                <div class=" signup-link">
                    I have an account?
                    <a href="login.php">Login</a>
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