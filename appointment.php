<?php
session_start();
include_once 'dbconnect.php';

if (!isset($_SESSION['userSession'])) {
	header("Location: index.php");
}

$query = $DBcon->query("SELECT * FROM tbl_users WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();


if(isset($_POST['btn-submit'])){

    $myfile = fopen("activityLog.txt", "a") or die("Unable to open file!");
    $dateNow= date("l jS \of F Y h:i:s A");
         
    $uname = strip_tags($_POST ['username']);
	$email = strip_tags($_POST['email']);
    $ename = strip_tags($_POST['Empname']);
	$Empmail = strip_tags($_POST['Empemail']);

    $date = strip_tags($_POST['date']);
    $dateTime = new DateTime($date);
    $formatted_date = date_format($dateTime, 'Y-m-d');

    $time = strip_tags($_POST['time']);
    $time = date('H:i:s', strtotime($time));

	$specification = strip_tags($_POST['specification']);


    $uname = $DBcon->real_escape_string($uname);
	$email = $DBcon->real_escape_string($email);
    $ename = $DBcon->real_escape_string($ename);
	$Empmail = $DBcon->real_escape_string($Empmail);
    $date = $DBcon->real_escape_string($date);
    $time = $DBcon->real_escape_string($time);
    $specification = $DBcon->real_escape_string($specification);


    $check_date = $DBcon->query("SELECT date, time FROM tbl_appointments WHERE date='$date' AND time='$time'");
    $count = $check_date->num_rows;

    if($count==0){

        $query = "INSERT into tbl_appointments (app_id,username,email,Empname,Empemail,date,time,specifications) VALUES (null,'$uname','$email', '$ename','$Empmail','$formatted_date','$time','$specification')";

        //echo $query;

        if(mysqli_query ($DBcon, $query)){

            $txt = $uname . "\tAppointment Set Successfully " . "\t". $dateNow . "\n";
            fwrite($myfile, $txt);
           $msg = "<div class='alert alert-success'>
    <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Appointment successful !
</div>";

                    require 'PHPMailers/PHPMailerAutoload.php';


                    $mail = new PHPMailer(true);


                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = 'abigailthomas279@gmail.com';                 // SMTP username
                    $mail->Password = 'August27';                           // SMTP password
                    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 587;                                    // TCP port to connect to

                    $mail->setFrom('abigailthomas279@gmail.com', 'Mailer');
                    $mail->addAddress("$Empmail", "$specification");     // Add a recipient
                    $mail->addAddress("$email");               // Name is optional
                    $mail->addReplyTo('info@example.com', "$specification");
                    $mail->addCC('cc@example.com');
                    $mail->addBCC('bcc@example.com');

                    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                    $mail->isHTML(true);                                  // Set email format to HTML

                    $mail->Subject = 'Skills Tutoring Scheduler
<img src="logo.png" width="200px" />';
                    $mail->Body    = "<p>Client name:</p> $uname
<br> $specification
<br> $date
<br> $time";
                    $mail->AltBody = 'You have a notification';

                    if(!$mail->send()) {
                        $msg = 'Message could not be sent.';
                        $msg = 'Mailer Error: ' . $mail->ErrorInfo;
                    } else {
                        $msg = 'Message has been sent';
                    }

        }
        else{

            var_dump($query);
                $txt = $uname . "\tAppointment Set IUnsuccessfully " . "\t". $dateNow . "\n";
            fwrite($myfile, $txt);
            $msg = "<div class='alert alert-danger'>
    <span class='glyphicon glyphicon-info-sign'></span> &nbsp; error while setting appointment !
</div> mysqli_error()";

        }

    }
    else{
        $txt = $uname . "\tAppointment Set Unsuccessfully " . "\t". $dateNow . "\n";
            fwrite($myfile, $txt);
       $msg = "<div class='alert alert-danger'>
    <span class='glyphicon glyphicon-info-sign'></span> &nbsp; sorry date already taken !
</div>";
    }

    fclose($myfile);
    $DBcon->close();

}
?>



<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>

    <meta charset="utf-8" />
    <title>Skills - Schedule A Session</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="http://webthemez.com" />
    <!-- css -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/fancybox/jquery.fancybox.css" rel="stylesheet">
    <link href="css/jcarousel.css" rel="stylesheet" />
    <link href="css/flexslider.css" rel="stylesheet" />
    <link href="js/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" />

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

    <script>
         function showCD(str) {
            if (str == "") {
               document.getElementById("txtHint").innerHTML = "";
               return;
            }

            if (window.XMLHttpRequest) {
               // code for IE7+, Firefox, Chrome, Opera, Safari
               xmlhttp = new XMLHttpRequest();
            }else {
               // code for IE6, IE5
               xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange = function() {
               if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                  document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
               }
            }
            xmlhttp.open("GET","getInstructor.php?q="+str,true);
            xmlhttp.send();
         }
    </script>

    <script>
        $(function(){
            $(document).on("click", ".reg", function(e) {
            e.preventDefault();
            {
            //This will capture all the inputs from the form
            var infom = $("#msform").serialize();

                    $.ajax({
                        beforeSend: function() { },
                        type: "POST",
                        url: "http://localhost/apointment.php",
                        data:infom,
                        success: function(result){

                        $('#showresult').html(result);
                        }
                    });
                    e.preventDefault();
            }
            });
         });
    </script>

</head>
<body>
    <div id="wrapper">
        <div class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p class="pull-left hidden-xs">Timeless Education</p>

                        <p class="pull-right"><i><a href="logout.php?logout"><strong>Logout</strong></a></i></p>
                        <p class="pull-right"><i> <strong>Username: </strong><?php echo $userRow['username']; ?></i></p>
                        <p class="pull-right"><i class=""><strong>Email: </strong><?php echo $userRow['email']; ?>&nbsp;&nbsp;</i></p>

                    </div>
                </div>
            </div>
        </div>

        <header>
            <div class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="index.php"><img src="img/logo.png" alt="logo" /></a>
                    </div>
                    <div class="navbar-collapse collapse ">
                        <ul class="nav navbar-nav">
                            <li><a href="dashboard.php">Dashboard</a></li>
                            <li class="active"><a href="appointment.php">Appointments</a></li>
                            <li><a href="portfolio.php">Portfolio</a></li>
                            <li><a href="contact_login.php">Contact</a></li>
                            <li><a href="help_login.php">Help/Support</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header><!-- end header -->

        <section id="inner-headline">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="pageTitle"><i></i></h2>
                    </div>
                </div>
            </div>
        </section>

        <br>



        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <form>
                        Select a Tutor:
                        <select name="cds" onchange="showCD(this.value)" class="form-control">
                            <option value="">Select a Tutor/Instructor:</option>
                            <option value="Abigail">Abigail</option>
                            <option value="Venessa">Venessa</option>
                            <option value="Tyshorna">Tyshorna</option>
                            <option value="Monique">Monique</option>
                            <option value="Onaje">Onaje</option>
                        </select>
                    </form>

                    <div id="txtHint"><b>Tutor/Instructor Information Will Be Listed Here...</b></div>

                    <div class="well-block">
                        <div class="well-title">
                            <h2>Schedule a Session</h2>
                        </div>
                        <form method="post" action="">
                            <?php
                            if (isset($msg)) {
                            echo $msg;
                            }
                            mysqli_error($DBcon);
                            ?>


                            <!-- Form start -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Userame</label>
                                        <input id="name" name="username" type="text" placeholder="username" value="<?php echo $userRow['username']; ?>" class="form-control input-md" required readonly>
                                    </div>
                                </div>
                                <!-- Text input-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="email">User Email</label>
                                        <input id="email" name="email" type="text" placeholder="" value="<?php echo $userRow['email']; ?>" class="form-control input-md" required readonly>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Tutor's Name</label>
                                        <input id="name" name="Empname" type="text" placeholder="Name" class="form-control input-md" required>
                                    </div>
                                </div>
                                <!-- Text input-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="email">Tutor's Email</label>
                                        <input id="email" name="Empemail" type="text" placeholder="E-Mail" class="form-control input-md" required>
                                    </div>
                                </div>


                                <!-- Text input-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="date">Preferred Date</label>
                                        <input id="date" name="date" type="date" placeholder="Preferred Date" class="form-control input-md" required>
                                    </div>
                                </div>
                                <!-- Text input-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="date">Preferred Time</label>
                                        <input id="date" name="time" type="time" placeholder="Preferred Time" class="form-control input-md" required>
                                    </div>
                                </div>

                                <br> <br>

                                <!-- Select Basic -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="control-label" for="date">Session Service</label>
                                            <input id="date" name="specification" type="text" placeholder="Service" class="form-control input-md">

                                            <br>

                                            <!--  <iframe src="https://calendar.google.com/calendar/embed?src=appointment@skills.com&ctz=America/Jamaica" style="border: 0" width="900" height="300" frameborder="0" scrolling="no"></iframe>
                                             -->
                                        </div>
                                    </div>
                                </div>

                                <br> <br>
                                <!-- Button -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button id="singlebutton" type="submit" name="btn-submit" class="btn btn-default">Schedule a Session</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- form end -->


                    </div>
                </div>
            </div>
        </div>

        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="widget">
                            <h5 class="widgetheading">Our Contact</h5>
                            <address>
                                <strong>Skills</strong><br>
                                Ocean Towers, Kingston<br>
                                Jamaica
                            </address>
                            <p>
                                <i class="icon-phone"></i> (876) 456-7898 / 255-2584 <br>
                                <i class="icon-envelope-alt"></i> support@gmail.com
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="widget">
                            <h5 class="widgetheading">Quick Links</h5>
                            <ul class="link-list">
                                <li><a href="#">Latest Events</a></li>
                                <li><a href="#">Terms and conditions</a></li>
                                <li><a href="#">Privacy policy</a></li>
                                <li><a href="#">Career</a></li>
                                <li><a href="#">Contact us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="widget">
                            <h5 class="widgetheading">Latest posts</h5>
                            <ul class="link-list">
                                <li><a href="#">Three Additional Course Categories</a></li>
                                <li><a href="#">External Certification</a></li>
                                <li><a href="#">Updated Course Material</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="widget">
                            <h5 class="widgetheading">Recent News</h5>
                            <ul class="link-list">
                                <li><a href="#">Site Upgrade</a></li>
                                <li><a href="#">New Courses</a></li>
                                <li><a href="#">Enhanced Resource Database</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div id="sub-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="copyright">
                                <p>
                                    <span>&copy; Skills Tutoring Scheduler </span> <a href=" " target="_blank"> Development </a>
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ul class="social-network">
                                <li><a href="#" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#" data-placement="top" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#" data-placement="top" title="Pinterest"><i class="fa fa-pinterest"></i></a></li>
                                <li><a href="#" data-placement="top" title="Google plus"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!--<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>-->
    <!-- javascript
        ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.fancybox.pack.js"></script>
    <script src="js/jquery.fancybox-media.js"></script>
    <script src="js/jquery.flexslider.js"></script>
    <script src="js/animate.js"></script>
    <!-- Vendor Scripts -->
    <script src="js/modernizr.custom.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/animate.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>