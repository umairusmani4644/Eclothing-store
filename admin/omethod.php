<?php
include ('include/header.php');
?>
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-summernote/summernote.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->


</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo">


<?php
include ('include/sidebar.php');
?>

 

    
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                   
                    <!-- BEGIN PAGE TITLE-->
                    <h3 class="page-title"><i class="fa fa-cogs"></i> Online Payment Method
                        <small></small>
                    </h3>
                    <!-- END PAGE TITLE-->

          <hr>

          
          
          
          
          
      <div class="row">
      <div class="col-md-12">
                            <!-- BEGIN SAMPLE FORM PORTLET-->
                            <div class="portlet light bordered">
                                

                
                    
<?php

  if ($_POST) {
    

    $res1 = mysqli_query($conms, "UPDATE payment_gateway SET name='".mysqli_real_escape_string($conms,  $_POST['name1'] )."', val1='".mysqli_real_escape_string($conms,  $_POST['val11'] )."', val2='".mysqli_real_escape_string($conms,  $_POST['val11'] )."' WHERE id='1'");

    $res2 = mysqli_query($conms, "UPDATE payment_gateway SET name='".mysqli_real_escape_string($conms,  $_POST['name2'] )."', val1='".mysqli_real_escape_string($conms,  $_POST['val21'] )."', val2='".mysqli_real_escape_string($conms,  $_POST['val22'] )."' WHERE id='2'");

    $res3 = mysqli_query($conms, "UPDATE payment_gateway SET name='".mysqli_real_escape_string($conms,  $_POST['name3'] )."', val1='".mysqli_real_escape_string($conms,  $_POST['val31'] )."', val2='".mysqli_real_escape_string($conms,  $_POST['val32'] )."' WHERE id='3'");

    $res4 = mysqli_query($conms, "UPDATE payment_gateway SET name='".mysqli_real_escape_string($conms,  $_POST['name4'] )."', val1='".mysqli_real_escape_string($conms,  $_POST['val41'] )."', val2='".mysqli_real_escape_string($conms,  $_POST['val42'] )."' WHERE id='4'");

    if ( $res1 || $res2 || $res3 || $res4 ) {
      ?>
        <div class="alert alert-success alert-dismissable">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>    

Updated Successfully

</div>
      <?php
    } else {
      ?>
        <div class="alert alert-danger alert-dismissable">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>    

Error: Not Updated

</div>
      <?php

    }

  }

  $methods_all = mysqli_query($conms, "SELECT * FROM payment_gateway");

?>                    
    
                                <div class="portlet-body form">
            <form class="form-horizontal" action="" method="post" role="form" enctype="multipart/form-data">
              <div class="form-body">
                <div class="row">



                  <?php while($methods = mysqli_fetch_array($methods_all)){ ?>

                  <?php if($methods['id'] == '1') { ?>
                  <div class="col-md-3">
                    <div class="panel panel-primary">
                      <div class="panel-heading">
                        <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">
                          <?php echo $methods['name']; ?>
                        </h1>
                      </div>
                      <div class="panel-body">
                        <div class="form-group">
                          <label class="col-md-12">
                            <strong style="text-transform: uppercase;">
                              Display Name
                            </strong>
                          </label>
                          <div class="col-md-12">
                            <input class="form-control input-lg" name="name1" value="<?php echo $methods['name']; ?>" type="text">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-12">
                            <strong style="text-transform: uppercase;">
                              PayPal Business Email
                            </strong>
                          </label>
                          <div class="col-md-12">
                            <input class="form-control input-lg" name="val11" value="<?php echo $methods['val1']; ?>" type="text">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- col-3 -->
                  <?php } elseif ($methods['id'] == '2') { ?>
                  <div class="col-md-3">
                    <div class="panel panel-primary">
                      <div class="panel-heading">
                        <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">
                          <?php echo $methods['name']; ?>
                        </h1>
                      </div>
                      <div class="panel-body">
                        <div class="form-group">
                          <label class="col-md-12">
                            <strong style="text-transform: uppercase;">
                              Display Name
                            </strong>
                          </label>
                          <div class="col-md-12">
                            <input class="form-control input-lg" name="name2" value="<?php echo $methods['name']; ?>" type="text">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-12">
                            <strong style="text-transform: uppercase;">
                              PM ACCOUNT
                            </strong>
                          </label>
                          <div class="col-md-12">
                            <input class="form-control input-lg" name="val21" value="<?php echo $methods['val1']; ?>" type="text">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-12">
                            <strong style="text-transform: uppercase;">
                              Alternate Passphrase
                            </strong>
                          </label>
                          <div class="col-md-12">
                            <input class="form-control input-lg" name="val22" value="<?php echo $methods['val2']; ?>" type="text">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- col-3 -->
                  <?php } elseif ($methods['id'] == '3') { ?>
                  <div class="col-md-3">
                    <div class="panel panel-primary">
                      <div class="panel-heading">
                        <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">
                          <?php echo $methods['name']; ?> (BitCoin)
                        </h1>
                      </div>
                      <div class="panel-body">
                        <div class="form-group">
                          <label class="col-md-12">
                            <strong style="text-transform: uppercase;">
                              Display Name
                            </strong>
                          </label>
                          <div class="col-md-12">
                            <input class="form-control input-lg" name="name3" value="<?php echo $methods['name']; ?>" type="text">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-12">
                            <strong style="text-transform: uppercase;">
                              API KEY
                            </strong>
                          </label>
                          <div class="col-md-12">
                            <input class="form-control input-lg" name="val31" value="<?php echo $methods['val1']; ?>" type="text">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-12">
                            <strong style="text-transform: uppercase;">
                              XPub Code
                            </strong>
                          </label>
                          <div class="col-md-12">
                            <input class="form-control input-lg" name="val32" value="<?php echo $methods['val2']; ?>" type="text">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- col-3 -->
                  <?php } elseif ($methods['id'] == '4') { ?>
                  <div class="col-md-3">
                    <div class="panel panel-primary">
                      <div class="panel-heading">
                        <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">
                          Stripe (Card)
                        </h1>
                      </div>
                      <div class="panel-body">
                        <div class="form-group">
                          <label class="col-md-12">
                            <strong style="text-transform: uppercase;">
                              Display Name
                            </strong>
                          </label>
                          <div class="col-md-12">
                            <input class="form-control input-lg" name="name4" value="<?php echo $methods['name']; ?>" type="text">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-12">
                            <strong style="text-transform: uppercase;">
                              secret key
                            </strong>
                          </label>
                          <div class="col-md-12">
                            <input class="form-control input-lg" name="val41" value="<?php echo $methods['val1']; ?>" type="text">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-12">
                            <strong style="text-transform: uppercase;">
                              publishable key
                            </strong>
                          </label>
                          <div class="col-md-12">
                            <input class="form-control input-lg" name="val42" value="<?php echo $methods['val2']; ?>" type="text">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- col-3 -->
                  <?php }
                  } ?>
                  



                </div>
                <!-- row -->
                <br>
                <br>
                <br>
                <div class="row">
                  <div class="col-md-12">
                    <button type="submit" class="btn btn-success btn-block btn-lg">
                      UPDATE SETTING
                    </button>
                  </div>
                </div>
              </div>
            </form>
                                </div>
                            </div>
                        </div>    
                        </div><!---ROW-->   
          
          
          
          
          
          
      
          
          
          
          
          
          
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
            
      


<?php
 include ('include/footer.php');
 ?>

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-markdown/lib/markdown.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <script>
        
    
        
        </script>
        
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="assets/pages/scripts/components-editors.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
<script src="http://www.appelsiini.net/projects/chained/jquery.chained.js"></script>
<script>
    $("#subcat").chained("#cat");
$("#child").chained("#subcat");
</script>
</body>
</html>