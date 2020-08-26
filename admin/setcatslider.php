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
                    <h3 class="page-title"><i class="fa fa-edit"></i> SET Category Sliders
                        <small></small>
                    </h3>
                    <!-- END PAGE TITLE-->

          <hr>

          
          
          
          
          
      <div class="row">
      <div class="col-md-12">
                            <!-- BEGIN SAMPLE FORM PORTLET-->
                            <div class="portlet light bordered">
                                

     
<?php

if($_POST)
{
$btxt = mysqli_real_escape_string($conms, $_POST["btxt"]);
$stxt = mysqli_real_escape_string($conms, $_POST["stxt"]);

$err1 = 0;

if (empty($_FILES['bgimg']['name'])) {
$err1 = 1;
}else{
// IMAGE UPLOAD //////////////////////////////////////////////////////////
    $folder = "../images/slider_cat/";
    $extention = strrchr($_FILES['bgimg']['name'], ".");
    $new_name = time();
    $bgimg = $new_name.'.jpg';
    $uploaddir = $folder . $bgimg;
    move_uploaded_file($_FILES['bgimg']['tmp_name'], $uploaddir);

    //------------------>>> RESIZE
include_once("abirimageclass.php");
$target_file = $folder.$bgimg;
$resized_file = $folder.$bgimg;
$wmax = 1200;
$hmax = 280;
$ext = ".jpg";
ak_img_resize($target_file, $resized_file, $wmax, $hmax, $ext);


//------------------>>> RESIZE
//////////////////////////////////////////////////////////////////////////
}

$error = $err1;


if ($error == 0){

$res = mysqli_query($conms, "INSERT INTO slider_cat SET img='".$bgimg."', btxt='".$btxt."', stxt='".$stxt."'");
echo mysqli_error($conms);
if($res){

echo "<div class=\"alert alert-success alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  
New Slider Added Successfully! 
</div>";
}else{

echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>    
Some Problem Occurs, Please Try Again. 
</div>";
}
}else{
if ($err1 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>    

SLIDER IMAGE IS REQUIRED!!!

</div>";
} 

}
}

?>                  
                    
                    
    
                                <div class="portlet-body form">
                                    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

                                        <div class="form-body"> 
                
     
                        <div class="form-group">
              <label class="col-sm-3 control-label"><strong>SLIDER IMAGE</strong></label>
              <div class="col-sm-3"><input type="file" name="bgimg"></div>
              <div class="col-sm-3"><b style="color:red; font-weight: bold;"> Will Resized To 1200 X 280</b></div>
          
                 </div>
             

              <div class="form-group">
              <label class="col-sm-3 control-label"><strong>Bold Text</strong></strong></label>
              <div class="col-sm-6"><input type="text" name="btxt" class="form-control input-lg"></div>          
                 </div>
        
              <div class="form-group">
              <label class="col-sm-3 control-label"><strong>Small Text</strong></strong></label>
              <div class="col-sm-6"><input type="text" name="stxt" class="form-control input-lg"></div>          
                 </div>
        
           
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-6">
                                                    <button type="submit" class="btn blue btn-block">ADD NEW</button>
                                                </div>
                                            </div>
                      
                                        </div>
                                    </form>
                                </div>
                            </div>




<?php


          
//------------------------------------------->>> DELETE             

if(isset($_GET['did'])) {
$did = mysqli_real_escape_string($conms, $_GET["did"]);
$exist = mysqli_fetch_array(mysqli_query($conms, "SELECT COUNT(*) FROM slider_cat WHERE id='".$did."'"));
if($exist[0]>=1){
    
$res = mysqli_query($conms, "DELETE FROM slider_cat WHERE id='".$did."'");

if($res){
echo "<div class=\"alert alert-success alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>    
DELETED Successfully! 
</div>";
}else{
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>    
Some Problem Occurs, Please Try Again. 
</div>";
}
}else{
    /*
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>    
NOT FOUND IN DATABASE (MAY ALREADY DELETED)
</div>";
*/
}   
}
//------------------------------------------->>> DELETE         



$ddaa = mysqli_query($conms, "SELECT id, img, btxt, stxt FROM slider_cat ORDER BY id");
echo mysqli_error($conms);
    while ($data = mysqli_fetch_array($ddaa))
    {

echo "<div class=\"col-md-6 col-sm-12\">

<img src=\"../images/slider_cat/$data[1]\" alt=\"IMG\" style=\"width:100%; height:180px;\"><br/>

<h3 style=\"font-weight:bold; min-height:40px;\">$data[2] </h3> $data[3] <br><br>

<a href=\"?did=$data[0]\" class='btn purple btn-block'>DELETE</a>
<br><br><br><br>
</div>";





}
?>                    
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