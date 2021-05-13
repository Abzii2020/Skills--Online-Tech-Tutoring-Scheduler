<?php

     include 'dbconnect.php';

    require_once __DIR__ . '/vendor/autoload.php';

    $mpdf = new \Mpdf\Mpdf();

    $data = "";
    $data .= "<h1>Session Details</h1>";

                
                $result = $DBcon->query("SELECT app_id, username, Empname, date, time, specifications FROM tbl_appointments");

                if ($result->num_rows > 0) {

                    if (isset($msg)) {
                                    echo $msg;
                                }
                    // output data of each row

                    $data .= "<table class='table table-striped table-hover'>
    ";
    $data .= "
    <tr> <th>Appointment ID</th><th>Username</th><th>Tutor</th><th>Date</th><th>Time</th><th>Focus Area</th> </tr>  ";
    while($row = mysqli_fetch_array($result)) {
    
    $data .= "<tr>
                                                <td>". $row["app_id"]. "</td>
                                                <td>" . $row["username"]. "</td>
                                                <td>" . $row["Empname"]. "</td>
                                                <td>" . $row["date"]. "</td>
                                                <td>" . $row["time"]. "</td>
                                                <td>" . $row["specifications"]. "</td>";
    }
    $data .= "
</table>";
                } else {
                    $data .= "0 results";
                }

    //Write PDF
    $mpdf->WriteHTML($data);
    //Output to Browser
    $mpdf->Output("appointmentsReport.pdf","D");

?>

