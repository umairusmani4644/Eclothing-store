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
                    <h3 class="page-title"><i class="fa fa-edit"></i> Edit Sub Category
                        <small></small>
                    </h3>
                    <!-- END PAGE TITLE-->

                    <hr>

                    
                    
                    
                    
                    
            <div class="row">
            <div class="col-md-12">
                            <!-- BEGIN SAMPLE FORM PORTLET-->
                            <div class="portlet light bordered">
                                
                                <div class="portlet-body form">
                                    <form class="form-horizontal" action="" method="post" role="form">
                                        <div class="form-body">

           
<?php

if($_POST)
{



//------------------------------->> Post The Form Value

$name = mysqli_real_escape_string($conms, $_POST["name"]);
$parent = mysqli_real_escape_string($conms, $_POST["parent"]);


//------------------------------->> Post The Form Value

//------------------------------->> CONDITIONS

$err1=0;
$err2=0;

if(trim($name)=="")
      {
$err1=1;
}

if($parent=="" || $parent=="0")
      {
$err2=1;
}
//------------------------------->> CONDITIONS

$error = $err1+$err2;


if ($error == 0){
    
$res = mysqli_query($conms, "UPDATE subcat SET name='".$name."', parent='".$parent."' WHERE id='".$iidd."'");
if($res){
    
    
echo "<div class=\"alert alert-success alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>    
Added Successfully! 
</div>";
}else{
    echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>    
Some Problem Occurs, Please Try Again. 
</div>";
}
} else {
    
if ($err1 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>    

Sub Categorey Name Can Not be Empty!!!

</div>";
}   

if ($err2 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>    

Parent Can Not be Empty !!!

</div>";
}       
    
}


}


$old = mysqli_fetch_array(mysqli_query($conms, "SELECT name, parent FROM subcat WHERE id='".$iidd."'"));

?>                                      
                                        
                                        
                                        
                                
                                        
                    <div class="form-group">
                    <label class="col-md-3 control-label"><strong>Sub Categorey Name</strong></label>
                    <div class="col-md-6">
                     <input class="form-control input-lg" name="name" value="<?php echo $old[0]; ?>" placeholder="Sub Categorey Name" type="text">
                    </div>
                    </div>

                     
                            
                
       <div class="form-group">
       <label class="col-md-3 control-label"><strong>Parent</strong></label>
       <div class="col-sm-6">
       <select class="form-control input-lg" name="parent">


              
<?php

$parent = mysqli_fetch_array(mysqli_query($conms, "SELECT name FROM cat WHERE id='".$old[1]."'"));

echo "<option value=\"$old[1]\">$parent[0] [selected]</option>"; 
echo "<option value=\"0\">------------------------------</option>";


$ddaa = mysqli_query($conms, "SELECT id, name FROM cat ORDER BY id");
    echo mysqli_error($conms);
    while ($data = mysqli_fetch_array($ddaa))
    {             
            echo "<option value=\"$data[0]\">$data[1]</option>";
            
    }
            
?>
              

       </select>
       </div>
       </div>                  

                     
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-6">
                                                    <button type="submit" class="btn blue btn-block">Submit</button>
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

</body>
</html>