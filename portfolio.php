<?php
    session_start();
    include_once 'dbconnect.php';

    if (!isset($_SESSION['userSession'])) {
	    header("Location: index.php");
    }

    $query = $DBcon->query("SELECT * FROM tbl_users WHERE user_id=".$_SESSION['userSession']);
    $userRow=$query->fetch_array();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Skills - Course Portfolio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="http://webthemez.com" />
    <!-- css -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/fancybox/jquery.fancybox.css" rel="stylesheet">
    <link href="css/jcarousel.css" rel="stylesheet" />
    <link href="css/flexslider.css" rel="stylesheet" />
    <!-- Vendor Styles -->
    <link href="css/magnific-popup.css" rel="stylesheet">
    <!-- Block Styles -->
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/gallery-1.css" rel="stylesheet">

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
        <!-- start header -->
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
                            <li><a href="appointment.php">Appointments</a></li>
                            <li class="active"><a href="portfolio.php">Portfolio</a></li>
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
                        <h2 class="pageTitle"><i>Portfolio</i></h2>
                    </div>
                </div>
            </div>
        </section>

        <br>
       
        <section id="gallery-1" class="content-block section-wrapper gallery-1">
            <div class="container">

                <div class="editContent">
                    <ul class="filter">
                        <li class="active"><a href="#" data-filter="*">All</a></li>
                        <li><a href="#" data-filter=".artwork">Courses</a></li>
                        <li><a href="#" data-filter=".creative">Languages</a></li>
                        <li><a href="#" data-filter=".nature">Tutors</a></li>
                        <li><a href="#" data-filter=".outside">Platforms</a></li>
                        <li><a href="#" data-filter=".photography">Sessions</a></li>
                    </ul>
                </div>
                <!-- /.gallery-filter -->

                <div class="row">
                    <div id="isotope-gallery-container">
                        <div class="col-md-4 col-sm-6 col-xs-12 gallery-item-wrapper artwork creative">
                            <div class="gallery-item">
                                <div class="gallery-thumb">
                                    <img src="img/works/1.png" class="img-responsive" alt="1st gallery Thumb">
                                    <div class="image-overlay"></div>
                                    <a href="img/works/1.png" class="gallery-zoom"><i class="fa fa-eye"></i></a>
                                    <a href="#" class="gallery-link"><i class="fa fa-link"></i></a>
                                </div>
                                <div class="gallery-details">
                                    <!--<div class="editContent">
                                        <h5>1st gallery Item</h5>
                                    </div>-->
                                    <div class="editContent">
                                        <p><strong>Get Started</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.gallery-item-wrapper -->
                        <div class="col-md-4 col-sm-6 col-xs-12 gallery-item-wrapper nature outside">
                            <div class="gallery-item">
                                <div class="gallery-thumb">
                                    <img src="img/works/2.png" class="img-responsive" alt="2nd gallery Thumb">
                                    <div class="image-overlay"></div>
                                    <a href="img/works/2.png" class="gallery-zoom"><i class="fa fa-eye"></i></a>
                                    <a href="#" class="gallery-link"><i class="fa fa-link"></i></a>
                                </div>
                                <div class="gallery-details">
                                    <!--<div class="editContent">
                                        <h5>2nd gallery Item</h5>
                                    </div>-->
                                    <div class="editContent">
                                        <p><strong>Manage Databases and Platforms</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.gallery-item-wrapper -->
                        <div class="col-md-4 col-sm-6 col-xs-12 gallery-item-wrapper photography artwork">
                            <div class="gallery-item">
                                <div class="gallery-thumb">
                                    <img src="img/works/3.png" class="img-responsive" alt="3rd gallery Thumb">
                                    <div class="image-overlay"></div>
                                    <a href="img/works/3.png" class="gallery-zoom"><i class="fa fa-eye"></i></a>
                                    <a href="#" class="gallery-link"><i class="fa fa-link"></i></a>
                                </div>
                                <div class="gallery-details">
                                    <!--<div class="editContent">
                                        <h5>3rd gallery Item</h5>
                                    </div>-->
                                    <div class="editContent">
                                        <p><strong>Engage Different Methods of Learning</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.gallery-item-wrapper -->
                        <div class="col-md-4 col-sm-6 col-xs-12 gallery-item-wrapper creative nature">
                            <div class="gallery-item">
                                <div class="gallery-thumb">
                                    <img src="img/works/4.png" class="img-responsive" alt="4th gallery Thumb">
                                    <div class="image-overlay"></div>
                                    <a href="img/works/4.png" class="gallery-zoom"><i class="fa fa-eye"></i></a>
                                    <a href="#" class="gallery-link"><i class="fa fa-link"></i></a>
                                </div>
                                <div class="gallery-details">
                                   <!-- <div class="editContent">
                                        <h5>4th gallery Item</h5>
                                    </div>-->
                                    <div class="editContent">
                                        <p><strong>Enahnce your Knowledge</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.gallery-item-wrapper -->
                        <div class="col-md-4 col-sm-6 col-xs-12 gallery-item-wrapper nature">
                            <div class="gallery-item">
                                <div class="gallery-thumb">
                                    <img src="img/works/5.png" class="img-responsive" alt="5th gallery Thumb">
                                    <div class="image-overlay"></div>
                                    <a href="img/works/5.png" class="gallery-zoom"><i class="fa fa-eye"></i></a>
                                    <a href="#" class="gallery-link"><i class="fa fa-link"></i></a>
                                </div>
                                <div class="gallery-details">
                                    <!--<div class="editContent">
                                        <h5>5th gallery Item</h5>
                                    </div>-->
                                    <div class="editContent">
                                        <p><strong>Connect Now</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.gallery-item-wrapper -->
                        <div class="col-md-4 col-sm-6 col-xs-12 gallery-item-wrapper artwork creative">
                            <div class="gallery-item">
                                <div class="gallery-thumb">
                                    <img src="img/works/6.png" class="img-responsive" alt="6th gallery Thumb">
                                    <div class="image-overlay"></div>
                                    <a href="img/works/6.png" class="gallery-zoom"><i class="fa fa-eye"></i></a>
                                    <a href="#" class="gallery-link"><i class="fa fa-link"></i></a>
                                </div>
                                <div class="gallery-details">
                                    <!--<div class="editContent">
                                        <h5>6th gallery Item</h5>
                                    </div>-->
                                    <div class="editContent">
                                        <p><strong>Build your Skills</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.isotope-gallery-container -->
                </div>
                <!-- /.row -->
                <!-- /.container -->
            </div>
        </section>
        <!--// End Gallery 1-2 -->
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
    <!-- Vendor Scripts -->
    <script src="js/modernizr.custom.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/animate.js"></script>
    <script src="js/custom.js"></script>

</body>
</html>