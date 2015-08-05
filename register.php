<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="SMS AndezNet Gateway">

    <title>AGA - Sms AndezNet Gateway</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
	<link rel="shortcut icon" href="assets/img/saga.ico">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>


      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT source code by andezNEt.com
  <body>
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
	  	<div class="container">
		       
				
		        <div class="login-wrap">
				
				<form name="form" id="validation-reg" method="post" action="" class="form-login">
				 <h2 class="form-login-heading">REGISTER S.A.G.A</h2>
                    <div id="loading" style="text-align: center"></div>
					<br>
					<div class="form-group">
                        <div class="col-sm-12">
		            <input type="text"  id="username" name="username" class="form-control" placeholder="Username" autofocus>
                            </div>
					</div>
		            <br>

					<div class="form-group">
                        <div class="col-sm-12">
		            <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                         </div>
					</div>

                    <br>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="password" id="password2" name="password2" class="form-control" placeholder="Confirm Password">
                        </div>
                    </div>

                    <br>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                        </div>
                    </div>

                    <br>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="text" id="nohp" name="nohp" class="form-control" placeholder="Masukan No Handphone Anda">
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <label class="checkbox">
		                <span class="pull-right">
		                    <a href="index.php">Back to Login</a>
		                </span>
		            </label>
                    <br>
                    <div class="form-group">
                        <div class="col-sm-12">
		            <button class="btn btn-theme btn-block"><i class="fa fa-lock"></i> REGISTER</button>
                            </div>
					</div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <footer class="site-footer">
                        <div class="text-center">
                            2015 <a href="http://andeznet.com">AndezNet</a>
                        </div>
                    </footer>
                </form>
		        </div>


	  	
	  	</div>
	  </div>
	
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.2.1.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("", {speed: 500});
    </script>

  <script type="text/javascript">

      jQuery(function($) {
          $.validator.setDefaults({
              submitHandler: function () {
                  register();

              }

          });

          $().ready(function () {
              // validate the comment form when it is submitted
              $("#validation-reg").validate({
                  errorElement: 'div',
                  errorClass: 'help-block',
                  focusInvalid: false,
                  rules: {
                      email: {
                          required: true
                      },

                      username: {
                          required: true
                      },
                      password: {
                          required: true,
                          minlength: 5
                      },
                      password2: {
                          required: true,
                          minlength: 5,
                          equalTo: "#password"
                      },

                      nohp: {
                          required: true
                      }

                  },

                  messages: {

                      password: {
                          required: "Please specify a password.",
                          minlength: "Please specify a secure password."
                      },
                      username: "Mohon isi username anda",
                      nohp: "Mohon isi no handphone anda"
                  },


                  highlight: function (e) {
                      $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
                  },

                  success: function (e) {
                      $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
                      $(e).remove();
                  }

              })
          });


          function register() {
              $("#loading").html('<div class="alert alert-block alert-success">Mohon Tunggu....</div>');
              $.post('daftar.input.php', $("form").serialize(), function (hasil) {
                  $('form input[type="text"],form input[type="password2"],form input[type="email"],form input[type="text"]').val('');
                  $("#loading").html(hasil);
              });
          };




      });




  </script>

  </body>
</html>
