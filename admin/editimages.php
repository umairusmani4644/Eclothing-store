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
$iidd = $_GET['id'];
?>

 

    
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                   
                    <!-- BEGIN PAGE TITLE-->
                    <h3 class="page-title"><i class="fa fa-edit"></i> Edit Product Images
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

//--------------------------->>>>> Multiple Image


$cou = 0;
extract($_POST);
    $error=array();
    $extension=array("jpeg","jpg","png","gif");
    foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name)
            {
                

                $file_name=$_FILES["files"]["name"][$key];
                $file_tmp=$_FILES["files"]["tmp_name"][$key];
                $ext=pathinfo($file_name,PATHINFO_EXTENSION);
                if(in_array($ext,$extension))
                {
$dt = date("YmdHis", time());
$random = rand(100000,999999);
$fnm = $file_name;
    
    $string = strtolower($fnm);
    //Make alphanumeric (removes all other characters)
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    //Clean up multiple dashes or whitespaces
    $string = preg_replace("/[\s-]+/", "", $string);
    //Convert whitespaces and underscore to dash
    $string = preg_replace("/[\s_]/", "_", $string);
    $ok = substr("$string", 0, -3);
    
$fnl = "$dt$random$ok";
                        $filename=basename($file_name,$ext);
                        $newFileName=$fnl.".jpg";
                        move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"../productimages/".$newFileName);
 //$aa = "$aa,$newFileName";     
$cou++;
mysqli_query($conms, "INSERT INTO moreimg SET assignto='".$iidd."', img='".$newFileName."'");
echo mysqli_error($conms);

  //------------------>>> RESIZE
include_once("abirimageclass.php");
    $folder = "../productimages/";

$target_file = $folder.$newFileName;
$resized_file = $folder.$newFileName;
$wmax = 700;
$hmax = 850;
$ext = ".jpg";
ak_img_resize($target_file, $resized_file, $wmax, $hmax, $ext);
//------------------>>> RESIZE

                }
                else
                {
                    array_push($error,"$file_name, ");
                }
            }

//--------------------------->>>>> Multiple Image
echo "<div class=\"alert alert-success alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  
$cou Image Added Successfully! 
</div>";



}


?>                  
                    
                    
    
                                <div class="portlet-body form">
                                    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

                                        <div class="form-body"> 
                
     
                        <div class="form-group">
              <label class="col-sm-3 control-label">ADD MORE IMAGE</label>
              <div class="col-sm-3"><input type="file" name="files[]" multiple></div>
              <div class="col-sm-3"><b style="color:red; font-weight: bold;"> MULTIPLE IMAGE CAN BE UPLOADED</b></div>
          
                 </div>
        
   <input type="hidden" name="upload" value="multiple">
           
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-6">
                                                    <button type="submit" class="btn blue btn-block">Submit</button>
                                                </div>
                                            </div>
                      
                                        </div>
                                    </form>
                                </div>
                            </div>




<?php


          
//------------------------------------------->>> DELETE             

if(isset($_GET['did'])) {
$did = $_GET["did"];
$exist = mysqli_fetch_array(mysqli_query($conms, "SELECT COUNT(*) FROM moreimg WHERE id='".$did."'"));
if($exist[0]>=1){
    
$res = mysqli_query($conms, "DELETE FROM moreimg WHERE id='".$did."'");

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
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>    
NOT FOUND IN DATABASE (MAY ALREADY DELETED)
</div>";
}   
}
//------------------------------------------->>> DELETE         



$ddaa = mysqli_query($conms, "SELECT id, img FROM moreimg WHERE assignto='".$iidd."' ORDER BY id");
    while ($data = mysqli_fetch_array($ddaa))
    {

echo "<div class=\"col-md-3 col-sm-12\">

<img src=\"../productimages/$data[1]\" alt=\"IMG\" style=\"width:100%; height:400px;\">

<a href=\"?id=$iidd&amp;did=$data[0]\" class='btn purple btn-block'>DELETE</a>
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