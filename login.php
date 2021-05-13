<?php
    session_start();
    require_once 'dbconnect.php';

    if (isset($_SESSION['userSession'])!="") 
    {
	    header("Location: index.php");
	    exit;
    }

    date_default_timezone_set("America/Jamaica");

    if (isset($_POST['btn-login'])) 
    {
        $myfile = fopen("activityLog.txt", "a") or die("Unable to open file!");
        $date = date("l jS \of F Y h:i:s A");
         
        $username = strip_tags($_POST['username']);
        $password = strip_tags($_POST['password']);

        $username = $DBcon->real_escape_string($username);
        $password = $DBcon->real_escape_string($password);
    
        $password = md5($password);
    
        $query = $DBcon->query("SELECT * FROM tbl_users WHERE username='$username'");
        $row=$query->fetch_array();
    
        $count = $query->num_rows; 

        if ($username == $row['username']) 
        {
            if ($password == $row['password']) 
            {
                if($row['userlevel']== 1)
                {
                    if(isset($_POST['rememberme']))
                    {
                        setcookie("email", $email, time()+60);
                    }
                    else
                    {
                        setcookie("email", $email, time()-60);
                    }
                    
                    $_SESSION['userSession'] = $row['user_id'];
                    
                        $txt = $username . "\tSuccessful Login" . "\t". $date . "\n";
                        fwrite($myfile, $txt);
                    header("Location: admin.php");
                }
                else if($row['userlevel']== 2) 
                {
                    if(isset($_POST['rememberme']))
                    {
                        setcookie("email", $email, time()+60);
                    }
                    else
                    {
                        setcookie("email", $email, time()-60);
                    }
                    $_SESSION['userSession'] = $row['user_id'];
                    
                    $txt = $username . "\tSuccessful Login" . "\t". $date . "\t".$time. "\n";
                        fwrite($myfile, $txt);
                }
                else if($row['userlevel']== 3)
                {
                    if(isset($_POST['rememberme']))
                    {
                        setcookie("email", $email, time()+60);
                    }
                    else
                    {
                        setcookie("email", $email, time()-60);
                    }
                    $_SESSION['userSession'] = $row['user_id'];
                   
                    $txt = $username . "\tSuccessful Login" . "\t". $date . "\t".$time. "\n";
                    fwrite($myfile, $txt);
                    header("Location: student.php");
                }
            }
            else 
            {
                $txt = $username . "\tUnsuccessful Login" . "\t". $date . "\t".$time. "\n";
                fwrite($myfile, $txt);
                $msg ="<div class='alert alert-danger'>
					       <span class=''></span> &nbsp; Invalid Username or Password !
				    </div>";
            }
        }
        else 
        {
            $txt = $username . "\tUnsuccessful Login" . "\t". $date . "\t".$time. "\n";
                    fwrite($myfile, $txt);
            $msg = "<div class='alert alert-danger'>
					       <span class=''></span> &nbsp; Invalid Username or Password !
				    </div>";
        }

        fclose($myfile);
        $DBcon->close();

    }//End of Button log if statement
    
?>

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>

    <meta charset="" />
    <title>Skills - Login</title>
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
      
        <h2 class="form-signin-heading">Login</h2><hr />
        
        <?php
		if(isset($msg)){
			echo $msg;
		}
		?>
        
        <div class="form-group">
        <input type="text" class="form-control" placeholder="Username" name="username" required />
        <span id="check-e"></span>
        </div>
        
        <div class="form-group">
        <input type="password" class="form-control" placeholder="Password" name="password" required />
        </div>
        
            
         <button type="submit" class="btn btn-default btn-block" name="btn-login" id="btn-login"><span></span> &nbsp; Sign In</button>
        <br />
        
           

        <label class="radio-inline">
              <input type="radio" name="rememberme">Remember me
            </label>
           
       
     	<hr />
        <br>
        <div class="form-group">
           <a href="forgetpw.php" class="btn btn-default" style="float:left;">Forget Password</a> 
            
            
            <a href="register.php" class="btn btn-default" style="float:right;">Sign UP Here</a>
            
            <hr />
            <br />
            
            
        </div>  
        
        
      
      </form>

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
                                <span>&copy; Skills Tutoring Shceduler</span> <a href=" " target="_blank"> Development </a>
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
