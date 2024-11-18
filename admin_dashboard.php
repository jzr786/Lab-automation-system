<?php
include('login_config.php');
session_start();
if (!isset($_SESSION['admin_name'])) {
    header('location:login.php');
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
    <script>
        window.onload = function() {

            var pending = document.getElementById("pending").innerText;

            var approved = document.getElementById("approved").innerText;

            var reject = document.getElementById("reject").innerText;



            var options = {
                animationEnabled: true,

                title: {
                    text: "Test status report (Donut Chart)"
                },
                data: [{
                    type: "doughnut",
                    innerRadius: "40%",
                    showInLegend: true,
                    legendText: "{label}",
                    indexLabel: "{label}: {y}",
                    dataPoints: [{
                            label: "Pending tests",
                            y: pending
                        },
                        {
                            label: "Rejected tests",
                            y: reject
                        },
                        {
                            label: "Approved tests",
                            y: approved
                        }
                    ]
                }]
            };

            $("#chartContainer1").CanvasJSChart(options);

            var options = {
                animationEnabled: true,

                title: {
                    text: "Test status report (Pie Chart)"
                },
                data: [{
                    type: "pie",
                    startAngle: 240,
                    indexLabel: "{label}: {y}",
                    dataPoints: [{
                            label: "Pending tests",
                            y: pending
                        },
                        {
                            label: "Rejected tests",
                            y: reject
                        },
                        {
                            label: "Approved tests",
                            y: approved
                        }
                    ]
                }]
            };
            $("#chartContainer2").CanvasJSChart(options);

        }
    </script>
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
                    <a href="admin_dashboard.php" class="sidebar-link">
                        <i class="lni lni-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="testing_request.php" class="sidebar-link">
                        <i class="lni lni-pencil-alt"></i>
                        <span>Testing Request</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="test_list.php" class="sidebar-link">
                        <i class="lni lni-list"></i>
                        <span>Test list</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="user_list.php" class="sidebar-link">
                        <i class="lni lni-users"></i>
                        <span>User list</span>
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
                <h3 class="fw-bold fs-4 mb-3">Welcome Admin <span>
                        <?php echo $_SESSION['admin_name'] ?>
                    </span></h3>
                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                <img src="img/admin.png" class="avatar" alt="">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end rounded">
                                <a href="manage_admin.php" class="dropdown-item">
                                    <i class="lni lni-cog"></i>
                                    <span>Update Profile</span>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="admin_register.php" class="dropdown-item">
                                    <i class="lni lni-users"></i>
                                    <span>Add admins</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content px-3 py-3 border-bottom " id="dashboard">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h2 class="fw-bold mb-4 text-center">Dashboard</h2>
                        <!-- <div class="row">
                            <div class="col-12 col-md-4 ">
                                <div class="card border-0">
                                    <div class="card-body py-4">
                                        <h5 class="mb-2 fw-bold">
                                            Memebers Progress
                                        </h5>
                                        <p class="mb-2 fw-bold">
                                            $72,540
                                        </p>
                                        <div class="mb-0">
                                            <span class="badge text-success me-2">
                                                +9.0%
                                            </span>
                                            <span class=" fw-bold">
                                                Since Last Month
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 ">
                                <div class="card  border-0">
                                    <div class="card-body py-4">
                                        <h5 class="mb-2 fw-bold">
                                            Memebers Progress
                                        </h5>
                                        <p class="mb-2 fw-bold">
                                            $72,540
                                        </p>
                                        <div class="mb-0">
                                            <span class="badge text-success me-2">
                                                +9.0%
                                            </span>
                                            <span class="fw-bold">
                                                Since Last Month
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 ">
                                <div class="card border-0">
                                    <div class="card-body py-4">
                                        <h5 class="mb-2 fw-bold">
                                            Memebers Progress
                                        </h5>
                                        <p class="mb-2 fw-bold">
                                            $72,540
                                        </p>
                                        <div class="mb-0">
                                            <span class="badge text-success me-2">
                                                +9.0%
                                            </span>
                                            <span class="fw-bold">
                                                Since Last Month
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="row">

                            <div class="col-xl-3 col-sm-6 col-12">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex justify-content-between">
                                                <div class="align-self-center">
                                                    <i class="lni lni-calendar fs-1"></i>
                                                </div>
                                                <div class="media-body">
                                                    <?php
                                                    $sql = 'SELECT COUNT(*) AS `total` FROM `book_request`';
                                                    $result = mysqli_query($conn, $sql);
                                                    $row = mysqli_fetch_assoc($result);
                                                    if ($row) {
                                                        echo "<h3 id='pending'>$row[total]</h3>";
                                                    } else {
                                                        echo '<h3>0</h3>';
                                                    }
                                                    ?>
                                                    <h5>Pending Tests</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6 col-12">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex justify-content-between">
                                                <div class="align-self-center">
                                                    <i class="lni lni-thumbs-up fs-1"></i>
                                                </div>
                                                <div class="media-body">
                                                    <?php
                                                    $sql = 'SELECT COUNT(*) AS total FROM status WHERE status = "Approve"';
                                                    $result = mysqli_query($conn, $sql);
                                                    $row = mysqli_fetch_assoc($result);
                                                    if ($row) {
                                                        echo "<h3 id='approved'>$row[total]</h3>";
                                                    } else {
                                                        echo '<h3>0</h3>';
                                                    }
                                                    ?>
                                                    <h5>Approved Tests</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6 col-12">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex justify-content-between">
                                                <div class="align-self-center">
                                                    <i class="lni lni-spray fs-1"></i>
                                                </div>
                                                <div class="media-body">
                                                    <?php
                                                    $sql = 'SELECT COUNT(*) AS total FROM status WHERE status = "reject"';
                                                    $result = mysqli_query($conn, $sql);
                                                    $row = mysqli_fetch_assoc($result);
                                                    if ($row) {
                                                        echo "<h3 id='reject'>$row[total]</h3>";
                                                    } else {
                                                        echo '<h3>0</h3>';
                                                    }
                                                    ?>
                                                    <h5>Rejected test</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6 col-12">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex justify-content-between">
                                                <div class="align-self-center">
                                                    <i class="lni lni-users fs-1"></i>
                                                </div>
                                                <div class="media-body">
                                                    <?php
                                                    $sql = 'SELECT COUNT(*) AS `total` FROM `user_form`';
                                                    $result = mysqli_query($conn, $sql);
                                                    $row = mysqli_fetch_assoc($result);
                                                    if ($row) {
                                                        echo "<h3>$row[total]</h3>";
                                                    } else {
                                                        echo '<h3>0</h3>';
                                                    }
                                                    ?>
                                                    <h5>Registered Users</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </main>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-sm-12" id="chartContainer1" style="height: 300px;"></div>
                    <div class="col-lg-6 col-sm-12" id="chartContainer2" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script src="https://cdn.canvasjs.com/jquery.canvasjs.min.js"></script>
</body>

</html>