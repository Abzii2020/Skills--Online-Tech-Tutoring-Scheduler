<?php
session_start();
require_once 'dbconnect.php';

if (isset($_SESSION['userSession'])!="") {
	header("Location: home.php");
	exit;
}


if(!empty($_POST['email'])){

    $email = strip_tags($_POST['email']);
    $email = $DBcon->real_escape_string($email);

   $sql = "SELECT email FROM tbl_users WHERE email = '$email' LIMIT 1";
   $result = $DBcon->query($sql);

    if($result->num_rows > 0){

        $key = md5(time());
        $sql_key = "UPDATE tbl_users SET reset = '$key' WHERE email = '$email'";

        if($DBcon->query($sql_key) === TRUE){

        $message = 'Click or copy paste the following link on your URL bar to reset your password '.$url.'new-password.php?email='.$email.'&reset='.$key.'';
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'From: $reset_email';
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        
        mail($email,'Password Reset Request',$message,$headers);
        //$msg = 'An email has been sent to you.';
        }
    }
        else {
            $msg = 'No such email is registered with us.
<br />';
        }
        }
        else {
            $msg = 'Type your email address.
<br />';
        }

	$DBcon->close();

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

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
</head>
<body>
    <div id="wrapper" class="home-page">
      <div class="topbar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="pull-left hidden-xs">Timeless Education</p>
                <p class="pull-right"><i class=""></i><a href="login.php"> Login </a></p>
                <p class="pull-right"><i class="fa fa-sign-in" class"active"></i><a href="register.php">Register</a>/</p>
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
                    <li><a href="portfolio.php">Portfolio</a></li>
                    <li><a href="courses.php">Courses</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="help.php">Help/Support</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>

<section id="inner-headline">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="pageTitle"><i></i></h2>
			</div>
		</div>
	</div>
	</section>

     <section id="content">
            <div class="signin-form">

	<div class="container">
     
        
       <form class="form-signin" method="post" id="login-form">
      
        <h2 class="form-signin-heading">Forget Password.</h2>
           <h3 class="form-signin-heading">Enter email to get new password</h3>
           <hr />
           
        
        <?php
		if(isset($msg)){
			echo $msg;
		}
		?>
        
        <div class="form-group">
        <input type="text" class="form-control" placeholder="Email" name="email" required />
        <span id="check-e"></span>
        </div>
           
         <button type="submit" class="btn btn-default btn-block" name="" id=""><span></span> &nbsp; Submit</button>
       
     	<hr />
        
        <div class="form-group">
           <a href="index.php" class="btn btn-default" style="float:left;">Sign in</a>
            
            
            <a href="register.php" class="btn btn-default" style="float:right;">Sign UP Here</a>
            
        </div>  
        <br />
        
      
      </form>

      </div>

      </div>

      </section>

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
</body>
</html>