<?php
include('login_config.php');
session_start();
if (!isset($_SESSION['user_name'])) {
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
                <h2 class="fw-bold mb-5 text-center">Booked test's requests</h2>
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col" class='text-center'>S.no</th>
                            <th scope="col" class='text-center'>Date</th>
                            <th scope="col" class='text-center'>Batch Code</th>
                            <th scope="col" class='text-center'>Product Name</th>
                            <th scope="col" class='text-center'>Tests to Perform</th>
                            <th scope="col" class='text-center'>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">

                        <?php
                        $sql = "SELECT * FROM `book_request` ORDER BY date DESC";
                        $result = mysqli_query($conn, $sql);

                        $sno = 0;

                        while ($row = mysqli_fetch_assoc($result)) {
                            $sno += 1;
                            echo <<<_END
                                <tr>
                                    <th scope='row' class='text-center'>$sno</th>
                                    <td class='text-center'>$row[date]</td>
                                    <td class='text-center'>$row[batch_code]</td>
                                    <td class='text-center'>$row[product_name]</td>
                                    <td class='text-center'>$row[test]</td>
                                    <td align='center'>
                                        <a class='btn btn-default dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                            Action
                                        </a>
                                            <div class='dropdown-menu' id='menu' role='menu'>
                                                <a class='dropdown-item' href='test_request_user_update.php?sno=$row[sno]'>Update</a>
                                                <div class='dropdown-divider'></div>
                                                <a class='dropdown-item' onClick="return confirm('Are you sure you want to delete?')" href='test_request_user_delete.php?sno=$row[sno]'>Delete</a>
                                            </div>
                                    </td>
                                </tr>
                            _END;
                        }
                        ?>

                    </tbody>
                </table>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.min.js"></script>
    <script>
        function chkalert(sno) {
            r = confirm("OK to delete?");

            if (r) {
                document.location.href = `test_request_user_delete.php?sno=${sno}`;
            }
        }

        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    <script src="script.js"></script>
</body>

</html>