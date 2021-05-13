<?php
session_start();
if (isset($_SESSION['userSession'])!="") {
	header("Location: index.php");
}
require_once 'dbconnect.php';

if(isset($_POST['btn-signup'])){

    $myfile = fopen("activityLog.txt", "a") or die("Unable to open file!");
    $date = date("l jS \of F Y h:i:s A");

    $uname = strip_tags($_POST['username']);
	$email = strip_tags($_POST['email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid format and please re-enter valid email";
    }
    $gender = (isset($_POST['gender']) ? $_POST['gender'] : null);
    $location = strip_tags($_POST['location']);
	$upass = strip_tags($_POST['password']);
    $level = 3;

    $uname = $DBcon->real_escape_string($uname);
	$email = $DBcon->real_escape_string($email);
    $gender = $DBcon->real_escape_string($gender);
    $location = $DBcon->real_escape_string($location);
	$upass = $DBcon->real_escape_string($upass);
    //$level = $DBcon->real_escape_string($level);



    $hashed_password = md5($upass);

    $check_username = $DBcon->query("SELECT email FROM tbl_users WHERE email='$email'");
    $count = $check_username->num_rows;


    if($count==0){

        $query = "INSERT into tbl_users (user_id, username,email,gender,location,password,userlevel) VALUES (null,'$uname','$email','$gender','$location','$hashed_password', '$level')";


        if($DBcon->query($query)){

           /*$msg = "<div class='alert alert-success'>
                  <span class='glyphicon glyphicon-info-sign'></span> &nbsp; successfully r!
                  </div>";*/
                  $txt = $username . "\tSuccessful Registration" . "\t". $date . "\t".$time. "\n";
                    fwrite($myfile, $txt);
                  header("Location: login.php");
        }
        else{
            $txt = $username . "\tUnsuccessful Registration (Username Issues" . "\t". $date . "\t".$time. "\n";
                    fwrite($myfile, $txt);
            $msg = "<div class='alert alert-danger'>
            <span class=''></span> &nbsp; Username already taken!
            </div>";
        }

    }
    else{
        $txt = $username . "\tUnsuccessful Login (Email Already Exists" . "\t". $date . "\t".$time. "\n";
                    fwrite($myfile, $txt);
       $msg = "<div class='alert alert-danger'>
               <span class=''></span> &nbsp; Email already taken !
                </div>";
    }
    fclose($myfile);
    $DBcon->close();
}//end if

?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Skills - Online Tech Learning</title>
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

    <script>
       function checkPass()
       {
                //Store the password field objects into variables ...
                var pass1 = document.getElementById('password');
            var pass2 = document.getElementById('confirm_password');
            //Store the Confimation Message Object ...
            var message = document.getElementById('confirmMessage');
            //Set the colors we will be using ...
            var goodColor = "#66cc66";
            var badColor = "#ff6666";
            //Compare the values in the password field
            //and the confirmation field
            if(pass1.value == pass2.value){
                //The passwords match.
                //Set the color to the good color and inform
                //the user that they have entered the correct password
                pass2.style.backgroundColor = goodColor;
                message.style.color = goodColor;
                message.innerHTML = "Passwords Match!"
            }else{
                //The passwords do not match.
                //Set the color to the bad color and
                //notify the user.
                pass2.style.backgroundColor = badColor;
                message.style.color = badColor;
                message.innerHTML = "Passwords Do Not Match!"
            }
        }
    </script>
</head>
<body>
    <div id="wrapper">
        <div class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p class="pull-left hidden-xs">Timeless Education</p>
                        <p class="pull-right"><i class=""></i><a href="login.php"> Login </a></p>
                        <p class="pull-right"><i class="fa fa-sign-in" href="register.php"></i><a>Register /</a></p>
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
                            <li><a href="index.php">Home</a></li>
                            <li><a href="about.php">About</a></li>
                            
                            <li><a href="courses.php">Courses</a></li>
                            <li><a href="contact.php">Contact</a></li>
                            <li><a href="help.php">Help/Support</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <div class="signin-form">
            <section id="inner-headline">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="pageTitle"><i></i></h2>
                        </div>
                    </div>
                </div>
            </section>

            <div class="container">


                <form class="form-signin" method="post" id="register-form">

                    <h2 class="form-signin-heading">Sign Up</h2><hr />

                    <?php
                    if (isset($msg)) {
                    echo $msg;
                    }
                    ?>

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Username" name="username" required />
                    </div>


                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email address" name="email" required />
                        <span id="check-e"></span>
                        <!--        <span class = "error">* <?php echo $emailErr;?></span>-->
                    </div>

                    <div class="form-group">
                        Male:
                        <input type="radio" value="male" name="gender" id="gender" required />
                        Female:
                        <input type="radio" value="female" name="gender" id="gender" required />
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Location" name="location" id="location" required />
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password" required />
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" id="confirm_password" required onkeyup="checkPass(); return false;" />
                        <span id="confirmMessage" class="confirmMessage"></span>
                    </div>

                    <hr />

                    <div class="form-group">
                        <button type="submit" class="btn btn-default" name="btn-signup">
                            <span></span> &nbsp; Create Account
                        </button>
                        <a href="index.php" class="btn btn-default" style="float:right;">Log In Here</a>
                    </div>

                </form>

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
                                    <span>&copy; Skills Tutoring Scheduler</span> <a href=" " target="_blank"> Development </a>
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
</body>
</html>