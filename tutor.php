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


    if(isset($_POST['btn-delete']))
	{

         $myfile = fopen("activityLog.txt", "a") or die("Unable to open file!");
        $date = date("l jS \of F Y h:i:s A");
         $uname = strip_tags($_POST['username']);
         $uname = $DBcon->real_escape_string($uname);

         $level = 2;

        // sql to delete a record
        $sql = "DELETE FROM tbl_users  WHERE username='$uname' AND userlevel='$level'";

        if ($DBcon->query($sql) === TRUE) {

            $msg = "Record deleted successfully";
            $txt = $uname . "\tInstructor Deleted" . "\t". $date . "\t".$time. "\n";
                    fwrite($myfile, $txt);
        } else {
             
            $txt = $uname . "\tDeleting Instructor Unsuccessful" . "\t". $date . "\t".$time. "\n";
                    fwrite($myfile, $txt);
            $msg  = "Error deleting record: " . $DBcon->error;
        }
		  fclose($myfile);
    }


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
    <title>Skills - Tutors</title>
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
    <!--CK Editor -->
    <script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>  

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
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
                            <li><a href="admin.php">Dashboard</a></li>
                            <li class="active"><a href="tutor.php">Tutors</a></li>
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
                    <h1><span aria-hidden="true"></span>Admin<small> Tutors</small></h1>
                </div>
                <!--<div class="col-md-2">
                    <div class="dropdown create">
                        <button class="btn btn-default dropdown-toggle" class"pull-right" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Create Content
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li><a type="button" data-toggle="modal" data-target="#addUser">Add Instructor/Tutor</a></li>
                        </ul>
                    </div>
                </div>-->
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
                  <a href="reports.php" class="list-group-item"><span aria-hidden="true"></span>Reports<span class="badge"><?php
                                if (isset($count)) {
                                    echo $count;
                                }
                            ?></span></a>
                  
                  <a href="logs.php" class="list-group-item"><span  aria-hidden="true"></span>Logs <span class="badge"><?php
                                if (isset($count)) {
                                    echo $count;
                                }
                            ?></span></a>
                  <a href="student_info.php" class="list-group-item"><span  aria-hidden="true"></span>Students <span class="badge"><?php
                                if (isset($count1)) {
                                    echo $count1;
                                }
                            ?></span></a>
                  <a href="tutor.php" class="list-group-item"><span  aria-hidden="true"></span>Tutors <span class="badge"><?php
                                if (isset($count2)) {
                                    echo $count2;
                                }
                            ?></span></a>
            </div>
              
          </div>
          
          <div class="col-md-9">
              <div class="panel panel-default">
                  <div class="panel-heading main-color-bg">
                    <h3 class="panel-title">Tutors</h3>
                  </div>
                  <div class="panel-body">
            <?php
    
                include 'dbconnect.php';

                $emp = 2;

                $result = $DBcon->query("SELECT username, email, gender, location FROM tbl_users WHERE userlevel='$emp'");

                if ($result->num_rows > 0) {
                    
                    if (isset($msg)) {
                                    echo $msg;
                                }
                    // output data of each row
                    echo "<div class='panel panel-default'>
                          <div class='panel-body'>";
                    echo "<table class='table table-striped table-hover'>";
                    echo "<tr> <th>Username</th> <th>Email</th> <th>Gender</th> <th>Location</th> </tr> ";
                    while($row = mysqli_fetch_array($result)) {
                        //echo "<tr> <th>Email</th> <th>Gender</th> <th>Username</th> <th>Location</th> </tr> ";
                        echo "<tr><td>". $row["username"]. "</td><td>" . $row["email"]. "</td><td>" . $row["gender"]. "</td><td>" . $row["location"]. "</td><td><a class='btn btn-danger' data-toggle='modal' data-target='#addPage' name='btn-delete' href='#'>Delete</a></td>";
                    }
                    echo "</table>";
                } else {
                    echo "0 results";
                }

            ?>
                
                 
              </div>


              
          </div>
      </div>    
      </div>
      </section>
       <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="widget">
                        <h5 class="widgetheading">Our Contact</h5>
                        <address>
                            <strong>Courser Online Learning</strong><br>
                            Ocean Towers, Kingston<br>
                            Jamaica
                        </address>
                        <p>
                            <i class="icon-phone"></i> (876) 456-7898 / 255-2584 <br>
                            <i class="icon-envelope-alt"></i> support@courser.edu
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
                                <span>&copy; Courser Online Learning </span> <a href=" " target="_blank"> Development </a>
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
        <!--Modals-->
      
      <!--Delete Employee-->
      <div class="modal fade" id="addPage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
               <div class="modal-content">
            <form method="post" action="">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete Employee</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>Employee Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Username">
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" name="btn-delete" class="btn btn-danger">Delete</button>
              </div>
                </form>
            </div>
        </div>
</div>
      
      <!--Edit Employee-->
      <div class="modal fade" id="addPost" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
               <div class="modal-content">
                <form action="" method="post">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Employee Info</h4>
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
                <button type="submit" name="btn-edit" class="btn btn-primary">Save</button>
              </div>
                </form>
            </div>
        </div>
      </div>
 
    <!--Add User-->  
      
     <?php


if(isset($_POST['btn-save'])){
    
    
    $uname = strip_tags($_POST['username']);
	$email = strip_tags($_POST['email']);
    $gender = (isset($_POST['gender']) ? $_POST['gender'] : null);
    $location = strip_tags($_POST['location']);
	$upass = strip_tags($_POST['password']);
    $level = 2;
   
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
        
       
//        //echo $query;
        
        if($DBcon->query($query)){
            
           $msg = "<div class='alert alert-success'>
						<span class='glyphicon glyphicon-info-sign'></span> &nbsp; successfully registered !
					</div>";
                    header("Location: admin.php");
        }
        else{
            
            $msg = "<div class='alert alert-danger'>
						<span class='glyphicon glyphicon-info-sign'></span> &nbsp; error while registering !
					</div>";
        }
        
    }
    else{
        
       $msg = "<div class='alert alert-danger'>
					<span class='glyphicon glyphicon-info-sign'></span> &nbsp; sorry email already taken !
				</div>";
    }
    
    
}//end if
?>
      
      
      <!--Add User-->
      <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
               <div class="modal-content">
                <form method="post" action="">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add User</h4>
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

