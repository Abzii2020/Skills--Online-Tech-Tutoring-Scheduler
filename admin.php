<?php
    session_start();
    include_once 'dbconnect.php';

    if(isset($_COOKIE['userSession']) && $_COOKIE['userSession'] != ''){
 
     $user = $_COOKIE['userSession'];
     //get user data from mysql

    }else if(isset($_SESSION['userSession']) && $_SESSION['userSession'] !=''){
 
     $user = $_SESSION['userSession'];
     //get user data from mysql
    }else{
         header("Location: index.php");
    }

    
    $query = $DBcon->query("SELECT * FROM tbl_users WHERE user_id=".$_SESSION['userSession']);
    $userRow=$query->fetch_array();

    $sql="SELECT username,email, Empname, Empemail, date, time, specifications FROM tbl_appointments ORDER BY username";

    if ($result=mysqli_query($DBcon,$sql))
      {
      // Return the number of rows in result set
      $rowcount=mysqli_num_rows($result);
      $count = $rowcount;
      // Free result set
      mysqli_free_result($result);
      }

    $userlevel= 3;

    $sql="SELECT username,email,gender,location,userlevel FROM tbl_users WHERE userlevel='$userlevel'";

    if ($result=mysqli_query($DBcon,$sql))
      {
      // Return the number of rows in result set
      $rowcount=mysqli_num_rows($result);
      $count1 = $rowcount;
      // Free result set
      mysqli_free_result($result);
      }

    $level= 2;

    $sql="SELECT username,email,gender,location,userlevel FROM tbl_users WHERE userlevel='$level'";

    if ($result=mysqli_query($DBcon,$sql))
      {
      // Return the number of rows in result set
      $rowcount=mysqli_num_rows($result);
      $count2 = $rowcount;
      // Free result set
      mysqli_free_result($result);
      }


    $DBcon->close();

?>

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Skills - Admin</title>
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
    <!--CK Editor -->
    <title>Welcome - <?php echo $userRow['email']; ?></title>
    <script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
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
                            <li class="active"><a href="admin.php">Dashboard</a></li>
                            <li><a href="tutor.php">Tutors</a></li>
                            <li><a href="student_info.php">Students</a></li>
                            <li><a href="logs.php">Logs</a></li>
                            <li><a href="reports.php">Reports</a></li>
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
                <div class="col-md-10">
                    <h1><span aria-hidden="true"></span>Dashboard <small>Admin</small></h1>
                </div>
                <div class="col-md-2">
                    <div class="dropdown create">
                        <button class="btn btn-default dropdown-toggle" class"pull-right" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Tasks
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li><a type="button" data-toggle="modal" data-target="#addUser">Add Instructor</a></li>
                            <li><a href ="document.php">View Document</a></li>
                            <li><a href ="documentImport.php">Upload Document</a></li>
                           <!--<li><a href="newInstructors.php">View Upcoming Instructors</a></li>
                        --></ul>
                    </div>
                </div>
            </div>
        </div>

        <!--Main Section-->
        <section id="main">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <!--Side bar-->
                        <div class="list-group">
                            <a href="admin.php" class="list-group-item active main-color-bg">
                                Dashboard
                            </a>
                            <a href="reports.php" class="list-group-item">
                                <span aria-hidden="true"></span>Reports<span class="badge">
                                    <?php
                                    if (isset($count)) {
                                    echo $count;
                                    }
                                    ?>
                                </span>
                            </a>

                            <a href="logs.php" class="list-group-item">
                                <span aria-hidden="true"></span>Logs <span class="badge">
                                    <?php
                                    if (isset($count)) {
                                    echo $count;
                                    }
                                    ?>
                                </span>
                            </a>
                            <a href="student_info.php" class="list-group-item">
                                <span aria-hidden="true"></span>Students  <span class="badge">
                                    <?php
                                    if (isset($count1)) {
                                    echo $count1;
                                    }
                                    ?>
                                </span>
                            </a>
                            <a href="tutor.php" class="list-group-item">
                                <span aria-hidden="true"></span>Tutors<span class="badge">
                                    <?php
                                    if (isset($count2)) {
                                    echo $count2;
                                    }
                                    ?>
                                </span>
                            </a>

                        </div>

                    </div>

                    <div class="col-md-9">
                        <div class="panel panel-default">
                            <div class="panel-heading main-color-bg">
                                <h3 class="panel-title">Website Overview</h3>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-3">
                                    <div class="well dash-box">
                                        <h2>
                                            <span aria-hidden="true"></span><?php
                                            if (isset($count)) {
                                            echo $count;
                                            }
                                            ?>
                                        </h2>
                                        <h4> Logs</h4>
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="well dash-box">
                                        <h2>
                                            <span aria-hidden="true"></span><?php
                                            if (isset($count1)) {
                                            echo $count1;
                                            }
                                            ?>
                                        </h2>
                                        <h4> Students</h4>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="well dash-box">
                                        <h2>
                                            <span aria-hidden="true"></span><?php
                                            if (isset($count2)) {
                                            echo $count2;
                                            }
                                            ?>
                                        </h2>
                                        <h4> Tutors</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
    
                include 'dbconnect.php';

                $emp = 2;

            //    $sql = "SELECT username, email, gender, location, photo FROM tbl_users WHERE userlevel='$emp'";
               // $image=addslashes(@file_get_contents($_FILES['pic']['tmp_name']));
                $result = $DBcon->query("SELECT username, email, gender, location FROM tbl_users WHERE userlevel='$emp'");

                if ($result->num_rows > 0) {
                    // output data of each row
                    echo "<div class='panel panel-default'>
                          <div class='panel-heading'>
                            <h3 class='panel-title'>Tutors</h3>
                          </div>
                          <div class='panel-body'>";
                    echo "<table class='table table-striped table-hover'>";
                    echo "<tr> <th>Username</th> <th>Email</th> <th>Gender</th> <th>Location</th> </tr> ";
                    while($row = mysqli_fetch_array($result)) {
                        //echo "<tr> <th>Email</th> <th>Gender</th> <th>Username</th> <th>Location</th> </tr> ";
                        echo "<tr><td>". $row["username"]. "</td><td>" . $row["email"]. "</td><td>" . $row["gender"]. "</td><td>" . $row["location"]. "<br>" ;
                    }
                    echo "</table>";
                } else {
                    echo "0 results";
                }

            ?>
              
              
              <br />
              
             <?php
    
                include 'dbconnect.php';

                $emp = 3;

            //    $sql = "SELECT username, email, gender, location, photo FROM tbl_users WHERE userlevel='$emp'";
               // $image=addslashes(@file_get_contents($_FILES['pic']['tmp_name']));
                $result = $DBcon->query("SELECT username, email, gender, location FROM tbl_users WHERE userlevel='$emp'");

                if ($result->num_rows > 0) {
                    // output data of each row
                    echo "<div class='panel panel-default'>
                          <div class='panel-heading'>
                            <h3 class='panel-title'>Students</h3>
                          </div>
                          <div class='panel-body'>";
                    echo "<table class='table table-striped table-hover'>";
                    echo "<tr> <th>Username</th> <th>Email</th> <th>Gender</th> <th>Location</th> </tr> ";
                    while($row = mysqli_fetch_array($result)) {
                        //echo "<tr> <th>Email</th> <th>Gender</th> <th>Username</th> <th>Location</th> </tr> ";
                        echo "<tr><td>". $row["username"]. "</td><td>" . $row["email"]. "</td><td>" . $row["gender"]. "</td><td>" . $row["location"]. "<br>" ;
                    }
                    echo "</table>";
                } else {
                    echo "0 results";
                }

            ?>
              

             </div> <!--End of Container-->
        </section>



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
    

        <!--Modals-->
      
      <!--Add Page-->
      <div class="modal fade" id="addPage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
               <div class="modal-content">
                <form>
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Page</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>Page Title</label>
                    <input type="text" class="form-control" placeholder="Page Title">
                </div>
                    <div class="form-group">
                     <label>Page Body</label>
                        <textarea name="editor1" class="form-control" placeholder="Page Body">

                        </textarea>
                </div>

                  <div class="checkbox">
                    <label>
                        <input type="checkbox">Published  
                    </label>
                  </div>

                <div class="form-group">
                        <label>Meta Tags</label>
                        <input type="text" class="form-control" placeholder="Add Meta Tags">
                </div>

                <div class="form-group">
                        <label>Meta Description</label>
                        <input type="text" class="form-control" placeholder="Add Meta Description">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
                </form>
            </div>
        </div>
</div>
      
      <!--Add Post-->
      <div class="modal fade" id="addPost" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
               <div class="modal-content">
                <form>
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Post</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>Post Title</label>
                    <input type="text" class="form-control" placeholder="Page Title">
                </div>
                    <div class="form-group">
                     <label>Post Body</label>
                        <textarea name="blog" class="form-control" placeholder="Content">

                        </textarea>
                </div>

                <div class="form-group">
                        <label>Blog Date</label>
                        <input type="text" class="form-control" placeholder="Current Date">
                </div>

                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Post</button>
              </div>
                </form>
            </div>
        </div>
      </div>
      
<?php


if(isset($_POST['btn-save'])){

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
    $level = 2;

    $uname = $DBcon->real_escape_string($uname);
	$email = $DBcon->real_escape_string($email);
    $gender = $DBcon->real_escape_string($gender);
    $location = $DBcon->real_escape_string($location);
	$upass = $DBcon->real_escape_string($upass);

    $hashed_password = md5($upass);

    $check_username = $DBcon->query("SELECT email FROM tbl_users WHERE email='$email'");
    $count = $check_username->num_rows;


    if($count==0){

        $query = "INSERT into tbl_users (user_id, username,email,gender,location,password,userlevel) VALUES (null,'$uname','$email','$gender','$location','$hashed_password', '$level')";


        if($DBcon->query($query)){

           /*$msg = "<div class='alert alert-success'>
                  <span class='glyphicon glyphicon-info-sign'></span> &nbsp; successfully r!
                  </div>";*/
                  $txt = $uname . "\tNew Instructor Added" . "\t". $date . "\t".$time. "\n";
                    fwrite($myfile, $txt);
                 header("Location: admin.php");
        }
        else{
            
            $txt = $username . "\tAdd Instructor Unsuccessful" . "\t". $date . "\t".$time. "\n";
            fwrite($myfile, $txt);
            $msg = "<div class='alert alert-danger'>
            <span class=''></span> &nbsp; Username already taken!
            </div>";
        }

    }
    else{
        $txt = $username . "\tAdd Instructor Unsuccessful" . "\t". $date . "\t".$time. "\n";
            fwrite($myfile, $txt);
       $msg = "<div class='alert alert-danger'>
               <span class=''></span> &nbsp; Email already taken !
                </div>";
    }
    
    fclose($myfile);
}//end if
?>
      
      
      <!--Add User-->
      <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
               <div class="modal-content">
                <form method="post" action="">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Tutor</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>UserName</label>
                    <input type="text" name="username" class="form-control" placeholder="UserName" required>
                </div>

                <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" placeholder="Email" required>
                </div>
                  
                 <div class="form-group">
                    Male:
                    <input type="radio" value="male" name="gender" id="gender" required  />
                    Female:
                    <input type="radio" value="female" name="gender" id="gender" required  />
                </div>

                <div class="form-group">
                        <label>Location</label>
                        <input type="text" name="location" class="form-control" placeholder="Locaion" required>
                </div>
                <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                </div>  
                  <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" id="confirm_password"  class="form-control" placeholder="Confirm Password" onkeyup="checkPass(); return false;" required />
                       <span id="confirmMessage" class="confirmMessage"></span>
                </div>
                  
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" name="btn-save" class="btn btn-primary">Save changes</button>
              </div>
                </form>
            </div>
        </div>
      
      
    <!--CK editor functionality-->
    <script>
        CKEDITOR.replace( 'editor1' );
    </script>
        
    </div>
        <a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
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

