<?php

     include 'dbconnect.php';

    require_once __DIR__ . '/vendor/autoload.php';

    $mpdf = new \Mpdf\Mpdf();

    $data = "";
    $data .= "<h1>Instructor Details</h1>";

                $emp = 2;

                $result = $DBcon->query("SELECT username, email, gender, location FROM tbl_users WHERE userlevel='$emp'");

                if ($result->num_rows > 0) {
                    
                    if (isset($msg)) {
                                    echo $msg;
                                }
                    // output data of each row
                    
                    $data .= "<table class='table table-striped table-hover'>";
                    $data .= "<tr> <th>Username</th> <th>Email</th> <th>Gender</th> <th>Location</th> </tr> ";
                    while($row = mysqli_fetch_array($result)) {
                        //echo "<tr> <th>Email</th> <th>Gender</th> <th>Username</th> <th>Location</th> </tr> ";
                        $data .= "<tr><td>". $row["username"]. "</td><td>" . $row["email"]. "</td><td>" . $row["gender"]. "</td><td>" . $row["location"]. "</td></tr>";
                    }
                    $data .= "</table>";
                } else {
                    $data .= "0 results";
                }

    //Write PDF
    $mpdf->WriteHTML($data);
    //Output to Browser
    $mpdf->Output("tutorReport.pdf","D");

?>

