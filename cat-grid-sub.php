<?php
include('include-global.php');
$iidd = mysqli_real_escape_string($conms, $_GET['id']);


$parent1 = mysqli_fetch_array(mysqli_query($conms, "SELECT name, parent FROM subcat WHERE id='".$iidd."'"));
$parent2 = mysqli_fetch_array(mysqli_query($conms, "SELECT name FROM cat WHERE id='".$parent1[1]."'"));

$url1 = "$baseurl/subcategory/$iidd/".urlmod($parent1[0]);
$url2 = "$baseurl/category/$parent1[1]/".urlmod($parent2[0]);
 



$titleofme = "$basetitle - $parent1[0]";

include('include-styles.php');

echo '</head><body>';

include('include-header.php');
include('include-navbar.php');

$adver_obj2 = mysqli_query($conms, "SELECT * FROM advertise WHERE size='1' ORDER BY RAND() LIMIT 1");

$advertise1 = array();

while ($ad1 = mysqli_fetch_array($adver_obj2)) {
  $advertise1[] = $ad1;
}
?>



  <!-- Breadcrumbs -->
  <div class="breadcrumbs">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <ul>
     <li class="home"> <a title="Go to Home Page" href="<?php echo $baseurl; ?>">Home</a><span>&rarr; </span></li>


<li class=""> <a title="Go to <?php echo $parent2[0]; ?>" href="<?php echo $url2; ?>">
<?php echo $parent2[0]; ?></a><span>&rarr; </span></li>

            <li class="category13"><strong><?php echo $parent1[0]; ?></strong></li>




          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumbs End --> 
  <!-- Main Container -->
  <section class="main-container col2-left-layout bounceInUp animated">
  <div class="category-description std">
   <div class="container">
              <div class="slider-items-products">
                <div id="category-desc-slider" class="product-flexslider hidden-buttons">
                  <div class="slider-items slider-width-col1 owl-carousel owl-theme"> 
                    

<?php

$ddaa = mysqli_query($conms, "SELECT id, img, btxt, stxt FROM slider_cat ORDER BY id");
echo mysqli_error($conms);
    while ($data = mysqli_fetch_array($ddaa))
    {
?>
                    <!-- Item -->
                    <div class="item"> <a href="#"><img alt="" src="<?php echo "$baseurl/images/slider_cat/$data[1]"; ?>"></a>
                      <div class="cat-img-title cat-bg cat-box">
                        <h2 class="cat-heading" style="color: #0088cc;"><?php echo $data[2]; ?></h2>
						<p><?php echo $data[3]; ?> </p>
                      </div>
                    </div>
                    <!-- End Item --> 
<?php 
}
 ?>



                </div>
              </div>
			  </div>
			  </div>
            </div>
			
    <div class="container">
      <div class="row">
        <div class="col-main col-sm-9 col-sm-push-3">
          <article class="col-main">
            <div class="page-title">
              <h2><?php echo $parent1[0]; ?></h2>
            </div>
            
<?php if(isset($advertise1[0])): ?>
  
<br>
<br>

<?php if($advertise1[0]['type'] == '1'){ ?>
<a href="<?php echo $advertise1[0]['link']; ?>" target="_blank">
  <div class="hidden-sm hidden-xs"> 
<div class="ad" style="border: 1px # solid; margin-bottom:15px; margin-top:15px; width: 100%;">
<img src="<?php echo $baseurl; ?>/ad/<?php echo $advertise1[0]['body']; ?>" style="width:100%;">
</div>
</div>
</a>
<?php } else { ?>
  <?php echo $advertise1[0]['body']; ?>
<?php } ?>

<?php endif; ?>
            
            
            <div class="category-products">
              <ul class="products-grid">




<div id="load">

</div>
 <br>
 
<div style="text-align: center;">
<img style="display:none; align: center;" id="loading" src="<?php echo $baseurl;?>/loader.gif" />
</div>
<br>
<button id="lmore" class="btn btn-primary btn-block">Load More</button>


              </ul>
            </div>
          </article>
          <!--	///*///======    End article  ========= //*/// --> 
        </div>
        <div class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9">
          <aside class="col-left sidebar">
            

<?php 

include('include-cat-left.php');
include('include-cart-left.php');
include('ad-sidebar.php');
 ?>
			
			
          
            
          </aside>
        </div>
      </div>
    </div>
  </section>
  <!-- Main Container End --> 


<?php
include('include-foot-service.php');
include('include-footer.php');
?>



<script>

 $(document).ready(function() {
        var last = 0;
        
        $.post( 
                  "<?php echo $baseurl;?>/api-sub.php",
                  { 
          lstid: last,
          cid: "<?php echo $iidd; ?>"
          },
                  function(data) {
            
                     $('#load').append(data);

                     
           var sesh = $("#sesh").val();
            if(sesh==1){

                 $("#lmore").fadeOut("slow"); 

                       }
          
                  }
               );
         

});



$("#lmore").click(function() {
  
  var hit = $(document).height();
  var x = hit - 1000;
  var last = $("#lastuu").val();
   

        $("#loading").fadeIn();
        $.post( 
                  "<?php echo $baseurl;?>/api-sub.php",
                  { 
          lstid: last,
          cid: "<?php echo $iidd; ?>"
          },
                  function(data) {

           $("#lastuu").removeAttr('id');
           $("#loading").delay(1500).fadeOut(1500); 
           
          $(data).hide().delay(3000).appendTo("#load").fadeIn(1000);


           var sesh = $("#sesh").val();
            if(sesh==1){

                 $("#lmore").fadeOut("slow"); 

                       }
                    }
               );
 
});

     

</script>





</body>
</html>