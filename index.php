<?php
    error_reporting(0);
    session_start();
    if(!empty($_SESSION[username])){
        header('location:media.php?module=home');
    }
?>
<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Administrator | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">
    <div id="fullscreen">
        <div class="form-box" id="login-box">
            <div class="header">Inventory System</div>
            <form action="cek_login.php" method="POST">
                <div class="body bg-gray">


                    <?php
                        if (!empty($_GET['msg'])){
                            if($_GET['msg']==1){
                                echo '<div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>Username dan passowrd tidak boleh kosong.</b>
                                      </div>';

                            }elseif ($_GET['msg']==2){
                                echo '<div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>Pastikan username dan passowrd benar.</b>
                                      </div>';
                            }
                        }
                    ?>



                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="Username"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
                    </div>          
                    <!-- <div class="form-group">
                        <input type="checkbox" name="remember_me"/> Remember me
                    </div> -->
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block">Sign In</button>  
                    
                    <!-- <p><a href="#">I forgot my password</a></p>
                    
                    <a href="register.html" class="text-center">Register a new membership</a> -->
                    <h6>&copy; <?php $waktu= date("Y"); echo"$waktu "?> by Tarkiman 2015</h6>
                </div>
            </form>

            <!-- <div class="margin text-center">
                <span>Sign in using social networks</span>
                <br/>
                <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
                <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
                <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>

            </div> -->

            <!-- <div >
                <p>Your browser <span id="support">doesn't support</span> FullScreen API.</p>
                <p>This block is <span id="state">not</span> in fullscreen mode. <a href="#" class="requestfullscreen">Click to open it in fullscreen</a><a href="#" class="exitfullscreen" style="display: none">Click to exit fullscreen</a>.</p>
            </div> -->




        </div>


        <!-- jQuery 2.0.2 -->
        <script src="js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>        
        

        <!-- Fullscreen -->
        <script src='js/jquery.fullscreen-0.4.1.min.js' type="text/javascript"></script>
        <script src='js/fullscreen.js' type="text/javascript"></script>

            </div>
    </body>
</html>