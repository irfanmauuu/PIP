<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Log in / Registrasi</title>
    <link rel=icon href="img/logoPIP3.png">
     
    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
    <style type="text/css">
      section{ padding: 10%;border-radius: 3%; box-shadow: 2px 0px 20px 1px green; background-color: rgba(200, 255, 200, .5);}
      img{
        position: relative;
        top:0%;
        width: 50%;
      }
      body.login{
        background: url('img/background.jpg');
        background-size: cover;
        background-repeat: no-repeat;
      }
      a{
        font-size: 20px;
        color:black;
      }
      p{
        color:black;
      }
    </style>
  </head>

  <body class="login">
   <div class="container"> 
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
         <div class="animate form login_form">
          <section class="login_content" style="padding: 10%">
          <img src="img/logoPIP.png">
        
            <form action="<?php echo  base_url('login/aksi_login') ?>" method=post>
              <h1>Login Form</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" name="x" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" name="n" />
              </div>
              <div>
                <button class="btn btn-primary " type="submit">Log in</button>
              </div>
              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Belum Punya Akun ??
                  <a href="#signup" class="to_register"> Daftar Akun </a>
                </p>

                <div class="clearfix"></div>
                <br />

              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content" style="padding: 10%">
           <img src="img/logoPIP.png">
            <form action="<?php echo base_url()?>Admin/registrasi" method=post>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" name="username" />
              </div>
              <div>
                <input type="text" class="form-control" placeholder="Nama" required="" name="nama" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" name="password" />
              </div>
              <div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
              
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </div>
  </body>
</html>
