<?php
include('include-global.php');

$titleofme = "$basetitle";

include('include-styles.php');
    if(isset($_GET['invid'])){
?>
    <link rel="stylesheet" href="<?php echo $baseurl; ?>/css/card.css">
<?php }
echo '</head>

<body class="cms-index-index cms-home-page">';

include('include-header.php');
include('include-navbar.php');


?>



  <!-- Main Container -->
  <section class="main-container col1-layout wow bounceInUp animated">
    <div class="main container">
      <div class="col-main">
        <div class="cart">
          <div class="page-title">
            <h2>Checkout</h2>
          </div>
<?php


if (!is_loggedin()) {
echo "<h1 style='text-align:center; margin-top:40px;'>You Have to  <a href=\"$baseurl/signin\"><u>login</u></a> before checkout</h1>";
}else{
?>


<div class="row">
<div class="col-md-8 col-md-offset-2">

  <?php if (isset($_GET['invid']) && !empty($_GET['invid'])) {


$offline = mysqli_query($conms, 'SELECT id, name FROM payment');
$online = mysqli_query($conms, 'SELECT id, name FROM payment_gateway');

   ?>



<style>
  #display {display: none;}
</style>
<?php if(isset($_GET['msg']) && !empty($_GET['msg'])){ ?>
<div class="alert alert-danger alert-dismissable">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<?php echo urldecode($_GET['msg']); ?>
</div>
<?php } ?>
<h2>Please Select a Payment Method</h2>
<select name="" class="form-control input-lg" id="paymnt">
  <option value="0">SELECT METHOD</option>
  <?php while($off_method = mysqli_fetch_array($offline)){ ?>
    <option value="offline-<?php echo $off_method[0]; ?>"><?php echo $off_method[1]; ?></option>
  <?php } ?>
  <?php while($on_method = mysqli_fetch_array($online)){ ?>
    <option value="online-<?php echo $on_method[0]; ?>"><?php echo $on_method[1]; ?></option>
  <?php } ?>
</select>
<input type="hidden" id="invid" value="<?php echo mysqli_real_escape_string($conms, $_GET['invid']); ?>">

<div id="inst"></div>




  <?php } ?>

<?php

if($_POST && !isset($_GET['invid']))
{



//------------------------------->> Post The Form Value
$daddr = mysqli_real_escape_string($conms, $_POST["daddr"]);
//$paymode = mysqli_real_escape_string($conms, $_POST["paymode"]);
$contactnum = mysqli_real_escape_string($conms, $_POST["contactnum"]);
//$detai = mysqli_real_escape_string($conms, $_POST["detai"]);

$cost = mysqli_real_escape_string($conms, $_POST["cost"]);



//$pdet = mysqli_fetch_array(mysqli_query($conms, "SELECT name FROM payment WHERE id='".$paymode."'"));

//$paymentdetails = "PAYMENT MODE: $pdet[0]  <br>    $detai";
//------------------------------->> Post The Form Value
//------------------------------->> CONDITIONS

$err1=0;
$err2=0;
$err3=0;
$err4=0;





if(trim($daddr)=="")
      {
$err1=1;
}

if($cost =="")
      {
$err2=1;
}

if($contactnum =="")
      {
$err3=1;
}

$cou = mysqli_fetch_array(mysqli_query($conms, "SELECT COUNT(*) FROM carrrt WHERE code='".$unique."'"));

if($cou[0]==0)
      {
$err4=1;
}
//------------------------------->> CONDITIONS

$error = $err1+$err2+$err3+$err4;


if ($error == 0){

$dd = date("Ymd", $tm);
$co = mysqli_fetch_array(mysqli_query($conms, "SELECT COUNT(*) FROM orrdr"));
$onm = $co[0]+1;

$invid="$dd$onm";


$res = mysqli_query($conms, "INSERT INTO orrdr SET invid='".$invid."', usid='".$uid."', daddr='".$daddr."', contactnum='".$contactnum."', code='".$unique."', tm='".$tm."', pst='0', dst='0', cost='".$cost."'");
if($res){

echo "<div class=\"alert alert-success alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
ORDER PLACED Successfully!
</div>";

mysqli_query($conms, "UPDATE carrrt SET ordered='1' WHERE code='".$unique."'");
unset($_SESSION["unique"]);
echo "<meta http-equiv=\"refresh\" content=\"2; url=$baseurl/checkout?invid=$invid\" />";

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

Delivery Address Can Not be Empty!!!

</div>";
}

if ($err2 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>

Cost Can Not be Empty !!!

</div>";
}

 if ($err3 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>

Contact Number Can Not be Empty !!!

</div>";
}

 if ($err4 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>

Cart Can Not be Empty !!!

</div>";
}

}




}



$cost = 0;
$ddaa = mysqli_query($conms, "SELECT pid, qty, rraate FROM carrrt WHERE code='".$unique."' ORDER BY id");
    echo mysqli_error($conms);
    while ($data = mysqli_fetch_array($ddaa))
    {
$ttl = $data[2]*$data[1];
$cost = $cost+$ttl;


  }
  $curr = mysqli_fetch_array(mysqli_query($conms, "SELECT currency FROM general_setting WHERE id='1'"));




 ?>

<form id="display" action="" method="post">


<h2>Delivery Address:</h2>

<input type="text" class="form-control input-lg" name="daddr" value="<?php echo "$userr[3]"; ?>">


<h2>Contact Number:</h2>

<input type="text" class="form-control input-lg" name="contactnum" value="<?php echo "$userr[2]"; ?>">


<input type="hidden" name="cost" value="<?php echo $cost; ?>">



<h2>Payment <span class="pull-right">Amount Due : <?php echo "$cost $curr[0]"; ?></span></h2>

<br><br><br>

<button type="submit" class="btn btn-success btn-lg btn-block"> PLACE ORDER</button>
</form>
<br><br><br><br>
</div>

</div>


<?php
}
?>
        </div>


      </div>
    </div>
  </section>

<?php
include('include-footer.php');
?>

<?php
    if(isset($_GET['invid'])){
?>
<script src="<?php echo $baseurl; ?>/js/card.js"></script>
<?php } ?>
<script>

$(document).ready(function() {


$("#paymnt").on('change',function() {


  var x = $("#paymnt").val();

  $.ajax({
    url: "<?php echo $baseurl;?>/api-select-payment.php",
    type: 'POST',
    data: {payid: x, invid: $("#invid").val()},
    success: function(data){
      $('#inst').html(data);
      var card = new Card({
      // a selector or DOM element for the form where users will
      // be entering their information
      form: '.active form', // *required*
      // a selector or DOM element for the container
      // where you want the card to appear
      container: '.card-wrapper', // *required*

      formSelectors: {
          numberInput: 'input[name="number"]', // optional — default input[name="number"]
          expiryInput: 'input[name="expiry"]', // optional — default input[name="expiry"]
          cvcInput: 'input[name="cvc"]', // optional — default input[name="cvc"]
          nameInput: 'input[name="name"]' // optional - defaults input[name="name"]
      },

      //width: 200, // optional — default 350px
      formatting: true, // optional - default true

      // Strings for translation - optional
      messages: {
          validDate: 'valid\ndate', // optional - default 'valid\nthru'
          monthYear: 'mm/yyyy', // optional - default 'month/year'
      },

      // Default placeholders for rendered fields - optional
      placeholders: {
          number: '•••• •••• •••• ••••',
          name: 'Full Name',
          expiry: '••/••',
          cvc: '•••'
      },

      masks: {
          cardNumber: '•' // optional - mask card number
      },

      // if true, will log helpful messages for setting up Card
      debug: false // optional - default false
  });
    }
  })
  .done(function() {
    console.log("success");
  })
  .fail(function() {
    console.log("error");
  })
  .always(function() {
    console.log("complete");
  });


});

});

</script>


</body>
</html>
