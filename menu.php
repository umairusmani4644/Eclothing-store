<?php
include('include-global.php');

$titleofme = "$basetitle - Sign In";

include('include-styles.php');
echo '</head>
<body class="cms-index-index cms-home-page">';

include('include-header.php');
include('include-navbar.php');

$iidd = mysqli_real_escape_string($conms, $_GET['id']);

$data = mysqli_fetch_array(mysqli_query($conms, "SELECT name, btxt FROM foot_menu WHERE id='".$iidd."'"));

?>


<!-- Main Container -->
<section class="main-container col1-layout bounceInUp animated">
  <div class="main container">
    <div class="account-login">

      <fieldset class="col2-set">

        
        <h1><?php echo $data[0]; ?></h1> <hr>
          <div class="content">
<?php echo $data[1]; ?>
<br><br><br>
        </div>
      </fieldset>
    </div>


  </div>
</section>
<!-- Main Container End -->
  
<?php
include('include-footer.php');
?>
</body>
</html>
