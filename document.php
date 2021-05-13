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
<html>
   <head>
     <!--<title>Load Excel Sheet in Browser using PHPSpreadsheet</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />-->
     <meta charset="utf-8" />
    <title>Skills - Upload Document</title>
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
                            <li><a href="tutor.php">Tutors</a></li>
                            <li><a href="student_info.php">Students</a></li>
                            <li><a href="logs.php">Logs</a></li>
                            <!--<li class="active"><a href="document.php">Documents</a></li>
                            --><li><a href="reports.php">Reports</a></li>
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


      <br />
      <h3 align="center">Upload Document</h3>
      <br />
      <div class="table-responsive">
       <span id="message"></span>
          <form method="post" id="load_excel_form" enctype="multipart/form-data">
            <table class="table">
              <tr>
                <td width="25%" align="right">Select Excel File</td>
                <td width="50%"><input type="file" name="select_excel" /></td>
                <td width="25%"><input type="submit" name="load" class="btn btn-primary" /></td>
              </tr>
            </table>
          </form>
       <br />
          <div id="excel_area"></div>
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
     
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  </body>
</html>
<script>
$(document).ready(function(){
  $('#load_excel_form').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url:"upload.php",
      method:"POST",
      data:new FormData(this),
      contentType:false,
      cache:false,
      processData:false,
      success:function(data)
      {
        $('#excel_area').html(data);
        $('table').css('width','100%');
      }
    })
  });
});
</script>