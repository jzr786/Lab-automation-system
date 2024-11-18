<?php

include('login_config.php');
session_start();
if (!isset($_SESSION['user_name'])) {
    header('location:login.php');
}

$sno = $_GET['sno'];
// echo $sno;

$sql = "SELECT * FROM `book_request` WHERE sno = '$sno'";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

if (isset($_GET['edit_btn'])) {
    $sno = $_GET['sno'];
    $test_date = $_GET['test_date'];
    $batch_code = $_GET['batch_code'];
    $product_name = $_GET['product_name'];
    $test_perform = $_GET['tests_to_perform'];


    $sql = "UPDATE `book_request` SET `date` = '$test_date', `batch_code` = '$batch_code', `product_name` = '$product_name', `test` = '$test_perform' WHERE sno = '$sno'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("location:test_request_user.php");
    } else {
        echo "data not inserted";
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
                <h3 class="fw-bold fs-4 mb-3">Welcome User <span><?php echo $_SESSION['user_name'] ?></span></h3>
                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                <img src="img/admin.png" class="avatar" alt="">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end rounded">
                                <a href="manage_user.php" class="dropdown-item">
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
                        <form action="test_request_user_update.php" method="GET">
                            <input type="hidden" name="sno" value="<?php echo $row['sno'] ?>">
                            <!-- Date Input -->
                            <div class="mb-3">
                                <label for="testDate" class="form-label">Date</label>
                                <input type="date" class="form-control" id="testDate" name="test_date" value="<?php echo $row['date'] ?>">
                            </div>

                            <!-- Batch Code Input -->
                            <div class="mb-3">
                                <label for="batchCode" class="form-label">Batch Code</label>
                                <input type="text" class="form-control" id="batchCode" name="batch_code" value="<?php echo $row['batch_code'] ?>">
                            </div>

                            <!-- Product Name Input -->
                            <div class="mb-3">
                                <label for="productName" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="productName" name="product_name" value="<?php echo $row['product_name'] ?>">
                            </div>

                            <!-- Tests to Perform Dropdown -->
                            <div class="mb-3">

                                <label for="testsToPerform" class="form-label">Tests to Perform</label>
                                <select class="form-select" id="testsToPerform" name="tests_to_perform">
                                    <option value="" disabled selected><?php echo $row['test'] ?></option>
                                    <option value="Electrical Test">Electrical Test</option>
                                    <option value="Mechanical Test">Mechanical Test</option>
                                    <option value="Thermal Test">Thermal Test</option>
                                    <option value="Chemical Test">Chemical Test</option>
                                    <option value="Safety Test">Safety Test</option>
                                </select>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary" name="edit_btn">Update</button>
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