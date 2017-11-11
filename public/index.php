<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>爬虫</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/login.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <nav class="navbar navbar-default" role="navigation">
        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a href="#" style="float:left"><img src="images/logo.png" height="36px" style="margin:7px;"></a>
            <a class="navbar-brand" style="color:#000;font-weight:550; font-size:21px;margin-right:50px" href="#">一个简单的爬虫</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
              
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
      <div class="col-md-7"></div>
<div class="col-md-4">
  <div class="kuang clear-fix">
        <form class="form-horizontal myform" role="form" action="../PostLogin.php" method="post" >
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">账号</label>
    <div class="col-sm-9">
      <input type="name" name="username" class="form-control" id="inputEmail3" placeholder="账号">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-3 control-label">密码</label>
    <div class="col-sm-9">
      <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="密码">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-8">
      <div class="checkbox">
  

<p id="demo"></p>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-7">
      
      <button type="submit" class="btn btn-default btn-block" onclick="getElementById('demo').innerHTML=Date()">登陆</button>
      <p id="demo"></p>
    </div>
 </div>
    </div>
  </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>