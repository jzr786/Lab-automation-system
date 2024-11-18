<?php
include('login_config.php');
session_start();
if (!isset($_SESSION['user_name'])) {
    header('location:login.php');
}

$sno = $_GET['sno'];
echo $sno;

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();
$query = "SELECT * FROM `status` WHERE sno = $sno";
$result = mysqli_query($conn, $query);
$infor = '';
$row = mysqli_fetch_assoc($result);

$infor .= '<h1 align="center">Certificate of testing</h1><br/><br/>';

$infor .= '<strong>1. Date: </strong>' . $row['date'] . '<br/><br/>';
$infor .= '<strong>2. Batch Code: </strong>' . $row['batch_code'] . '<br/><br/>';
$infor .= '<strong>3. Product Name: </strong>' . $row['product_name'] . '<br/><br/>';
$infor .= '<strong>4. Test performed: </strong>' . $row['test'] . '<br/><br/>';
$infor .= '<strong>5. Status: </strong>' . $row['status'] . '<br/><br/>';

$mpdf->WriteHTML($infor);
$mpdf->Output();
