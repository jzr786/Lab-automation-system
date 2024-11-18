<?php
include('login_config.php');
session_start();
if (!isset($_SESSION['user_name'])) {
    header('location:login.php');
}
$username = $_SESSION['user_name'];
// echo $username;


$query = "SELECT * FROM user_form WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found!";
    exit();
}

if (isset($_POST['update_profile_user'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $user_type = $_POST['user_type'];

    if ($password !== $confirm_password) {
        $error[] = 'Password not matched!';
    } else {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $query = "SELECT * FROM user_form WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result1 = $stmt->get_result();

        if ($result1->num_rows > 0) {
            $error[] = 'email already exists!';
        } else {

            $update_query = "UPDATE user_form SET email = ?";

            if (!empty($password)) {
                $update_query .= ", password = ?";
            }

            $update_query .= " WHERE username = ?";

            $stmt = $conn->prepare($update_query);

            if (!empty($password)) {
                $stmt->bind_param("sss", $email, $hashed_password, $username);
            } else {
                $stmt->bind_param("ss", $email, $username);
            }

            if ($stmt->execute()) {
                header('location:user_dashboard.php');
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar With Bootstrap</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">SRS Electric</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="user_dashboard.php" class="sidebar-link">
                        <i class="lni lni-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="book_request.php" class="sidebar-link">
                        <i class="lni lni-book"></i>
                        <span>Book Request</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="test_request_user.php" class="sidebar-link">
                        <i class="lni lni-pencil-alt"></i>
                        <span>Testing Request</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="test_list_user.php" class="sidebar-link">
                        <i class="lni lni-ruler"></i>
                        <span>Testing Result</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="logout.php" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-4 py-3">
                <h3 class="fw-bold fs-4 mb-3">Welcome User <span>
                        <?php echo $_SESSION['user_name'] ?>
                    </span></h3>
                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                <img src="img/admin.png" class="avatar" alt="">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end rounded">
                                <a href="manage_user.php?username=$_SESSION['user_name']" class="dropdown-item">
                                    <i class="lni lni-cog"></i>
                                    <span>Update Profile</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content px-3 py-4">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h3 class="fw-bold fs-4 mb-4">Manage User's Profile</h3>
                        <form action="" method="POST">

                            <?php
                            // Display error messages
                            if (isset($error)) {
                                foreach ($error as $err) {
                                    echo '<p style="color:red;">' . htmlspecialchars($err) . '</p>';
                                }
                            }
                            ?>

                            <div class="mb-3">
                                <label for="username" class="form-label">Username (Read-only)</label>
                                <input type="text" class="form-control" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password (Optional)</label>
                                <input type="password" class="form-control" name="password" value="">
                            </div>

                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm Password (Optional)</label>
                                <input type="password" class="form-control" name="confirm_password" value="">
                            </div>

                            <div class="mb-3">

                                <label for="user_type" class="form-label">User Type (Read-only)</label>
                                <input type="text" class="form-control" name="user_type" value="<?php echo htmlspecialchars($user['user_type']); ?>" readonly>
                            </div>


                            <button type="submit" class="btn btn-primary" name="update_profile_user">Update Profile</button>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>

</html>