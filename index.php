<?php
include('include-global.php');
$titleofme = "$basetitle";

include('include-styles.php');
echo '</head>
<body class="cms-index-index cms-home-page">';

include('include-header.php');
include('include-navbar.php');
include('include-headbanner.php');
include('include-slider.php');
include('include-bannerimg.php');

$adver_obj = mysqli_query($conms, "SELECT * FROM advertise WHERE size='1' ORDER BY RAND() LIMIT 3");

$advertise = array();

while ($ad = mysqli_fetch_array($adver_obj)) {
  $advertise[] = $ad;
}




?>

<?php if(isset($advertise[0])): ?>
  
<br>
<br>
<div class="container">
<?php if($advertise[0]['type'] == '1'){ ?>
<a href="<?php echo $advertise[0]['link']; ?>" target="_blank">
  <div class="hidden-sm hidden-xs"> 
<div class="ad" style="border: 1px # solid; margin-bottom:15px; margin-top:15px; width: 100%;">
<img src="<?php echo $baseurl; ?>/ad/<?php echo $advertise[0]['body']; ?>" style="width:100%;">
</div>
</div>
</a>
<?php } else { ?>
  <?php echo $advertise[0]['body']; ?>
<?php } ?>
</div>
<?php endif; ?>

  
  <!-- Featured Slider -->
  <section class="featured-pro container wow bounceInUp animated">
    <div class="slider-items-products">
      <div class="new_title center">
        <h2>HOT PRODUCTS</h2>
      </div>
      <div id="best-seller-slider" class="product-flexslider hidden-buttons">
        <div class="slider-items slider-width-col4 products-grid">



<?php 
$ddaa = mysqli_query($conms, "SELECT id FROM products WHERE featured='1' ORDER BY id DESC LIMIT 0,10");
    while ($data = mysqli_fetch_array($ddaa))
    {

echo singleslide($data[0]);
}
 ?>


          
          
        </div>
      </div>
    </div>
  </section>

  <!--Offer Start-->
  <div class="offer-slider wow animated parallax parallax-2">
    <div class="container">
      <ul class="bxslider">


<?php
$ddaa = mysqli_query($conms, "SELECT id, ttxt, btxt, stxt FROM slider_home_text ORDER BY id");
echo mysqli_error($conms);
    while ($data = mysqli_fetch_array($ddaa))
    {
?>


        <li>
          <h2><?php echo $data[1]; ?></h2>
          <h1><?php echo $data[2]; ?></h1>
          <p><?php echo $data[3]; ?></p>

        </li>

<?php 
}

 ?>


      </ul>
    </div>
  </div>
  <!--Offer silder End--> 
  
<?php if(isset($advertise[1])): ?>
  

<div class="container">
<?php if($advertise[1]['type'] == '1'){ ?>
<a href="<?php echo $advertise[1]['link']; ?>" target="_blank">
  <div class="hidden-sm hidden-xs"> 
<div class="ad" style="border: 1px # solid; margin-bottom:15px; margin-top:15px; width: 100%;">
<img src="ad/<?php echo $advertise[1]['body']; ?>" style="width:100%;">
</div>
</div>
</a>
<?php } else { ?>
  <?php echo $advertise[1]['body']; ?>
<?php } ?>
</div>

<?php endif; ?>

  <!-- Featured Slider -->
  <section class="featured-pro container wow bounceInUp animated">
    <div class="slider-items-products">
      <div class="new_title center">
        <h2>New Products</h2>
      </div>



 <div id="best-seller-slider" class="product-flexslider hidden-buttons">
        <div class="slider-items slider-width-col4 products-grid">



<?php 
$ddaa = mysqli_query($conms, "SELECT id FROM products ORDER BY id DESC LIMIT 0,10");
    while ($data = mysqli_fetch_array($ddaa))
    {

echo singleslide($data[0]);
}
 ?>


          
          
        </div>
      </div>



    </div>
  </section>
  <!-- End Featured Slider -->
  
  <div class="brand-logo wow bounceInUp animated">
    <div class="container">
      <div class="new_title center">
        <h2>TOP BRANDS</h2>
      </div>
      <div class="slider-items-products">
        <div id="brand-logo-slider" class="product-flexslider hidden-buttons">
          <div class="slider-items slider-width-col6"> 
            
<?php
$ddaa = mysqli_query($conms, "SELECT id, img FROM brand_logo ORDER BY id");
    while ($data = mysqli_fetch_array($ddaa))
    {
?>

<!-- Item -->
<div class="item"><a href="#"><img src="<?php echo "$baseurl/images/brand/$data[1]"; ?>" style="width: 130px; height: 50px;" alt="Image"></a> </div>
<!-- End Item --> 

<?php 
}
 ?>            
          </div>
        </div>
      </div>
    </div>
  </div>
  
<?php if(isset($advertise[2])): ?>
  


<div class="container">
<?php if($advertise[2]['type'] == '1'){ ?>
<a href="<?php echo $advertise[2]['link']; ?>" target="_blank">
  <div class="hidden-sm hidden-xs"> 
<div class="ad" style="border: 1px # solid; margin-bottom:15px; margin-top:15px; width: 100%;">
<img src="ad/<?php echo $advertise[2]['body']; ?>" style="width:100%;">
</div>
</div>
</a>
<?php } else { ?>
  <?php echo $advertise[2]['body']; ?>
<?php } ?>
</div>
<br>
<br>
<?php endif; ?>
 <?php 
$fea4 = mysqli_fetch_array(mysqli_query($conms, "SELECT text1, text2, text3, text4 FROM gen_fea4 WHERE id='1'"));
 ?>

  <div class="header-banner mobile-show">
    <div class="our-features-box">
      <ul>
        <li>
          <div class="feature-box">
            <div class="icon-truck"></div>
            <div class="content"><?php echo $fea4[0];?></div>
          </div>
        </li>
        <li>
          <div class="feature-box">
            <div class="icon-support"></div>
            <div class="content"><?php echo $fea4[1];?></div>
          </div>
        </li>
        <li>
          <div class="feature-box">
            <div class="icon-money"></div>
            <div class="content"><?php echo $fea4[2];?></div>
          </div>
        </li>
        <li class="last">
          <div class="feature-box">
            <div class="icon-return"></div>
            <div class="content"><?php echo $fea4[3];?></div>
          </div>
        </li>
      </ul>
    </div>
  </div>

<?php
include('include-footer.php');
?>
</body>
</html>
