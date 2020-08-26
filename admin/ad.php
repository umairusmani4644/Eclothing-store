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
                    <h3 class="page-title"><i class="fa fa-cog"></i> Ad Settings
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
    
    $type = $_POST['type'];

    if ($type == '1') {
      
      $size = $_POST['size'];
      $link = $_POST['link'];

  // IMAGE UPLOAD //////////////////////////////////////////////////////////
      $folder = "../ad/";
      $extention = strrchr($_FILES['img']['name'], ".");
      $new_name = time();
      $bgimg = $new_name.$extention;
      $uploaddir = $folder . $bgimg;
      move_uploaded_file($_FILES['img']['tmp_name'], $uploaddir);
  //////////////////////////////////////////////////////////////////////////

      $img = $bgimg;

      $res = mysqli_query($conms, "INSERT INTO advertise SET body='".$img."', size='".$size."', link='".$link."', type='".$type."'");

      if ($res) { ?>
        <div class="alert alert-success alert-dismissable">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>    

Added Successfully

</div>
      <?php } else { ?>
        <div class="alert alert-danger alert-dismissable">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>    

Error: Problem Occured

</div>
      <?php }

    } else {

      $code = $_POST['code'];
      $size = $_POST['size'];
      
      $res = mysqli_query($conms, "INSERT INTO advertise SET body='".$code."', size='".$size."', type='".$type."'");

      if ($res) { ?>
        <div class="alert alert-success alert-dismissable">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>    

Added Successfully

</div>
      <?php } else { ?>
        <div class="alert alert-danger alert-dismissable">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>    

Error: Problem Occured

</div>
      <?php }
    }

  }

  if (isset($_GET['del'])) {
    $del = mysqli_real_escape_string($conms, $_GET['del']);
    //echo $del;
    $res = mysqli_query($conms, "DELETE FROM advertise WHERE id='".$del."'");

          if ($res) { ?>
        <div class="alert alert-success alert-dismissable">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>    

Deleted Successfully

</div>
      <?php }
  }

?>                    
    
                                <div class="portlet-body form">
                                    

                                  <form action="" class="form-horizontal" action="" method="post" role="form" enctype="multipart/form-data">

                                    <div class="form-body">

                                      <div class="form-group">
                                        <label class="col-md-3 control-label"><strong>Select Ad Type</strong></label>
                                        <div class="col-md-6">
                                         <select class="form-control input-lg" name="type" id="type">
                                           <option value="1">Image</option>
                                           <option value="0">Code</option>
                                         </select>
                                        </div>
                                        </div>

                                      <div id="ajax">
                                        <div class="form-group"><label class="col-md-3 control-label"><strong>Select Size</strong></label><div class="col-md-6"><select class="form-control input-lg" name="size" id="size"><option value="1">778 x 90</option><option value="2">300 x 600</option><option value="3">300 x 250</option></select></div></div><div class="form-group"><label class="col-md-3 control-label"><strong>Select Image</strong></label><div class="col-md-6"><input type="file" class="form-control input-lg" name="img"></div></div><div class="form-group"><label class="col-md-3 control-label"><strong>Link</strong></label><div class="col-md-6"><input type="text" name="link" class="form-control input-lg"></div></div>
                                      </div>

                                      <div class="form-group">
                                        <div class="col-md-3 col-md-offset-3">
                                          <button class="btn btn-primary btn-lg" type="submit">Save</button>
                                        </div>
                                      </div>

                                    </div>
                                    
                                  </form>




                                </div>
                            </div>
                        </div>    
                        </div><!---ROW-->



                        <div class="row">
                          <?php
                            $all_ad = mysqli_query($conms, "SELECT * FROM advertise ORDER BY type DESC");
                            while ($ad = mysqli_fetch_array($all_ad)) { ?>

                              <div class="col-md-4">
                                <?php if ($ad['type'] == '1') { ?>
                                  <a href="<?php echo $ad['link']; ?>" target="_blank" >
                                    <img src="../ad/<?php echo $ad['body']; ?>" style="width: 100%;height: 300px;">
                                  </a>
                                  <h1>Size : <small><?php if($ad['size'] == '1'){echo '778x90';} elseif ($ad['size'] == '2') {echo '300x600';} else {echo '300x250';} ?></small></h1>
                                  <a href="?del=<?php echo $ad['id']; ?>" class="btn btn-warning btn-block">Delete</a>
                                <?php } else { ?>
                                  <div style="width: 100%;height: 300px;"><?php echo $ad['body']; ?></div>
                                  <h1>Size : <small><?php if($ad['size'] == '1'){echo '778x90';} elseif ($ad['size'] == '2') {echo '300x600';} else {echo '300x250';} ?></small></h1>
                                  <a href="?del=<?php echo $ad['id']; ?>" class="btn btn-warning btn-block">Delete</a>
                                <?php } ?>
                              </div>
                              
                            <?php }
                          ?>
                        </div>
          
          
          
          
          
          
      
          
          
          
          
          
          
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
  
  $('#type').change(function(event) {

    var type = $('#type').val();

    if (type == '1') {
      var html = '<div class="form-group"><label class="col-md-3 control-label"><strong>Select Size</strong></label><div class="col-md-6"><select class="form-control input-lg" name="size" id="size"><option value="1">778 x 90</option><option value="2">300 x 600</option><option value="3">300 x 250</option></select></div></div><div class="form-group"><label class="col-md-3 control-label"><strong>Select Image</strong></label><div class="col-md-6"><input type="file" class="form-control input-lg" name="img"></div></div><div class="form-group"><label class="col-md-3 control-label"><strong>Link</strong></label><div class="col-md-6"><input type="text" name="link" class="form-control input-lg"></div></div>';
      $('#ajax').html(html);
    } else {

      var html = '<div class="form-group"><label class="col-md-3 control-label"><strong>Select Size</strong></label><div class="col-md-6"><select class="form-control input-lg" name="size" id="size"><option value="1">778 x 90</option><option value="2">300 x 600</option><option value="3">300 x 250</option></select></div></div><div class="form-group"><label class="col-md-3 control-label"><strong>Code</strong></label><div class="col-md-6"><textarea name="code" id="code" class="form-control input-lg"></textarea></div></div>';

      $('#ajax').html(html);

    }

  });

</script>
</body>
</html>