<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../../favicon.ico">

  <title>NMS - Omnitracker</title>

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap select CSS -->
  <link  href="css/bootstrap-select.min.css" rel="stylesheet">

  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug
  <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
  -->

  <!-- Custom styles for this template -->
  <link href="starter-template.css" rel="stylesheet">
  <link rel="stylesheet" href="fonts/fa/css/font-awesome.min.css">
  <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
  <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<script>
  if (document.addEventListener) {
        document.addEventListener('contextmenu', function(e) {
            alert("Updates comming soon!"); //here you draw your own menu
            e.preventDefault();
        }, false);
    } else {
        document.attachEvent('oncontextmenu', function() {
            alert("Next update!");
            window.event.returnValue = false;
        });
    }
</script>
<body>
<?php include 'db_bridge.php'; ?>
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <a class="navbar-brand" href="#"><img src="img/brand.png"></a>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>

  <div id="wrapper" >
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
      <ul id="sidebar_menu" class="sidebar-nav">
        <li class="sidebar-brand"><a id="menu-toggle" href="#">MENU<span id="main_icon" class="glyphicon glyphicon-align-justify"></span></a></li>
      </ul>
      <ul class="sidebar-nav" id="sidebar">
        <li><a href="index.php">Home<i class="sub_icon fa fa-home" aria-hidden="true"></i></a></li>
        <li><a href="index.php?p=1">Star<i class="sub_icon fa fa-star" aria-hidden="true"></i></a></a></li>
        <li><a href="index.php?p=2">Pilot<i class="sub_icon fa fa-space-shuttle" aria-hidden="true"></i></a></a></li>
        <li><a href="index.php?p=3&page=1">List<i class="sub_icon fa fa-flag" aria-hidden="true"></i></a></a></li>
        <li><a href="#" data-toggle="modal" data-target="#myModal" >About<i class="sub_icon fa fa-info-circle" aria-hidden="true"></i></a></li>
      </ul>
    </div>
    <!-- Page content -->
    <div id="page-content-wrapper">
      <!-- Keep all page content within the page-content inset div! -->
      <div class="page-content inset">
        <div class="row">
          <div class="col-md-12">
            <div class="row">
            </div>
<?php
@$PageNum = $_GET['p'];

if ($PageNum == 1) {
    include("sh_coordinate.php");
} else if ($PageNum == 2) {
    include("sh_pilot.php");
} else if ($PageNum == 3) {
    include("sh_coordinate_list.php");
} else {
    include("canvas_ctrl.php");
}
?>

          </div><!-- /.container -->
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">NEXT UPDATES</h4>
        </div>
        <div class="modal-body">
          <p><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span> Improve design (this is uggly).</p>
          <p><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span> Database to save locations.</p>
          <p><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span> LYC (Light Years Calculation).</p>
          <p><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span> Customizations for each Alliance/Hub/travellers etc.</p>
          <br>
          <b>NMS Omnitrack by Junior Silva - Phenixpro.com web systems.</b><br>
          <small>If you want to help send us a message: facebook.com/Phenix-1716922208588388</small>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery.min.js"><\/script>')</script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/bootstrap-select.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug
    <script src="js/ie10-viewport-bug-workaround.js"></script>
    -->
  <script>
    $(document).ready(function() {
      $("#MyModal").modal();
    });

    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("active");
    });
  </script>
  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
  <script>
    (adsbygoogle = window.adsbygoogle || []).push({
      google_ad_client: "ca-pub-6485555707317987",
      enable_page_level_ads: true
    });
  </script>
  <!--
  <script src="js/ie-emulation-modes-warning.js"></script>
  -->
</body>
</html>
