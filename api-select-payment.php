<?php
require_once('function.php');
connectdb();

header("Access-Control-Allow-Origin: *");

echo '<hr>';


$select = explode('-', $_POST["payid"]);
//print_r($select);
if ($select[0] == 'offline') {
  


  $pdet = mysqli_fetch_array(mysqli_query($conms, "SELECT ins, need FROM payment WHERE id='".$select[1]."'"));

  if($pdet[1]=="0"){ ?>
  
  <br>

  <p style='color:green; font-weight: bold;'><?php echo $pdet[0]; ?></p>
 

  <form action="<?php echo $baseurl; ?>/offline.php" method="POST">
    <textarea name="detai" class="form-control"></textarea>
    <input type="hidden" name="invid" value="<?php echo $_POST["invid"]; ?>">
    <input type="hidden" name="paymode" value="<?php echo $select[1]; ?>">
<br>
    <button type="submit" class="btn btn-success btn-lg btn-block">UPDATE</button>
  </form>

<br>
  <?php

  }else{ ?>
<br>
  <p style='color:green; font-weight: bold;'><?php echo $pdet[0]; ?></p>

  <form action="<?php echo $baseurl; ?>/offline.php" method="POST">
    <textarea name="detai" class="form-control" rows="2"><?php echo $pdet[1]; ?></textarea>
    <input type="hidden" name="invid" value="<?php echo $_POST["invid"]; ?>">
    <input type="hidden" name="paymode" value="<?php echo $select[1]; ?>">
<br>
    <button type="submit" class="btn btn-success btn-lg btn-block">UPDATE</button>
  </form>
<?php

  }




} elseif ($select[0] == 'online') {

  if ($select[1] == '1') {

    $invid = mysqli_real_escape_string($conms, $_POST["invid"]);

    $gateway = mysqli_fetch_array(mysqli_query($conms, "SELECT * FROM payment_gateway WHERE id='1'"));

    $order = mysqli_fetch_array(mysqli_query($conms, "SELECT * FROM orrdr WHERE invid='".$invid."'"));

    $site = mysqli_fetch_array(mysqli_query($conms, "SELECT sitename, currency FROM general_setting WHERE id='1'"));

    ?>
<br>
            <h2 class="text-success text-center">Payment Via Paypal</h2>

            <br>

            <form action="https://secure.paypal.com/cgi-bin/webscr" method="post" id="paypal">
              <input type="hidden" name="cmd" value="_xclick" />

              <input type="hidden" name="business" value="<?php echo $gateway['val1']; ?>" />

              <input type="hidden" name="cbt" value="<?php echo $site[0]; ?>" />

              <input type="hidden" name="currency_code" value="<?php echo $site[1]; ?>" />

              <input type="hidden" name="quantity" value="1" />

              <input type="hidden" name="item_name" value="Payment For <?php echo $invid; ?>" />

              <input type="hidden" name="custom" value="<?php echo $invid; ?>" />

              <input type="hidden" name="amount"  value="<?php echo $order['cost']; ?>" />

              <input type="hidden" name="return" value="<?php echo $baseurl; ?>/dashboard?msg=<?php echo urlencode('Paypal Payment Successfull'); ?>"/>

              <input type="hidden" name="cancel_return" value="<?php echo $baseurl; ?>/checkout?invid=<?php echo $invid; ?>&msg=<?php echo urlencode('Paypal Error: Process Failed'); ?>" />

              <input type="hidden" name="notify_url" value="<?php echo $baseurl; ?>/paypal_ipn.php" />

              <input type="submit" class="btn btn-primary btn-block" value="Processed Via Paypal">

            </form>

    <?php

  } elseif ($select[1] == '2') {

    $invid = mysqli_real_escape_string($conms, $_POST["invid"]);

    $gateway = mysqli_fetch_array(mysqli_query($conms, "SELECT * FROM payment_gateway WHERE id='2'"));

    $order = mysqli_fetch_array(mysqli_query($conms, "SELECT * FROM orrdr WHERE invid='".$invid."'"));

    $site = mysqli_fetch_array(mysqli_query($conms, "SELECT sitename, currency FROM general_setting WHERE id='1'"));

    ?>
<br>
            <h2 class="text-success text-center">Payment Via Perfect Money</h2>

            <br>
          <form action="https://perfectmoney.is/api/step1.asp" method="POST" id="myform">

            <input type="hidden" name="PAYEE_ACCOUNT" value="<?php echo $gateway['val1']; ?>">

            <input type="hidden" name="PAYEE_NAME" value="<?php echo $site[0]; ?>">

            <input type='hidden' name='PAYMENT_ID' value='<?php echo $invid; ?>'>

            <input type="hidden" name="PAYMENT_AMOUNT"  value="<?php echo $order['cost']; ?>">

            <input type="hidden" name="PAYMENT_UNITS" value="<?php echo $site[1]; ?>">

            <input type="hidden" name="STATUS_URL" value="<?php echo $baseurl; ?>/ppmoney_ipn.php">

            <input type="hidden" name="PAYMENT_URL" value="<?php echo $baseurl; ?>/dashboard?msg=<?php echo urlencode('Perfect Money Payment Successfull'); ?>">

            <input type="hidden" name="PAYMENT_URL_METHOD" value="POST">

            <input type="hidden" name="NOPAYMENT_URL" value="<?php echo $baseurl; ?>/checkout?invid=<?php echo $invid; ?>&msg=<?php echo urlencode('Perfect Money Error: Process Failed'); ?>">

            <input type="hidden" name="NOPAYMENT_URL_METHOD" value="POST">

            <input type="hidden" name="SUGGESTED_MEMO" value="Payment For <?php echo $invid; ?>">

            <input type="hidden" name="BAGGAGE_FIELDS" value="IDENT"><br>

            <input type="submit" class="btn btn-primary btn-block" value="Processed Via Perfect Money">

          </form>

  <?php

  } elseif ($select[1] == '3') {

    $invid = mysqli_real_escape_string($conms, $_POST["invid"]);

    $gateway = mysqli_fetch_array(mysqli_query($conms, "SELECT * FROM payment_gateway WHERE id='3'"));

    $order = mysqli_fetch_array(mysqli_query($conms, "SELECT * FROM orrdr WHERE invid='".$invid."'"));

    $site = mysqli_fetch_array(mysqli_query($conms, "SELECT sitename, currency FROM general_setting WHERE id='1'"));

            $blockchain_root = "https://blockchain.info/";
            $blockchain_receive_root = "https://api.blockchain.info/";
            $mysite_root = $baseurl . '/dashboard';
            $secret = "SHANTO";
            $my_xpub = $gateway['val2'];
            $my_api_key = $gateway['val1'];
            $invoice_id = $invid;
            $callback_url = $baseurl . '/blockchain.php';
            $resp = file_get_contents($blockchain_receive_root . "v2/receive?key=" . $my_api_key . "&callback=" . urlencode($callback_url) . "&xpub=" . $my_xpub);
            //echo $resp;

            $response = json_decode($resp);

            
            //echo $response;
            if ($response['address']) {
              $sendto = $response['address'];
              $usd = get_currency($order['cost'], $site[1], 'USD');
              $bcamo = toBTC($usd);
              $addi = serialize(array('bcamo' => $bcamo, 'bcid' => $sendto));
              $res = mysqli_query($conms, "UPDATE orrdr SET addi='".$addi."' WHERE invid='".$invid."'");

              ?>
              <br>
            <h4 style="text-align: center; text-transform: uppercase;"> SEND EXACTLY <strong><?php echo $bcamo; ?> BTC</strong> TO <strong><?php echo $sendto; ?></strong><br>
            <?php toScan($bcamo, $sendto ); ?> <br>
            <strong>SCAN TO SEND</strong> <br><br>
            <strong style="color: red;">NB: 3 Confirmation required for payment</strong>
            </h4>

              <?php
            } else {
              echo '<br><br><br>API Key is not valid. Please, contact with admin.<br><br><br>';
            }

  } elseif ($select[1] == '4') {
    $invid = mysqli_real_escape_string($conms, $_POST["invid"]);
    ?>


        <div class="demo-container">
            <h1 class="text-center">Payment Via <small>Credit Card</small></h1>
            <div class="card-wrapper"></div>

            <div class="form-container active">
                <form action="<?php echo $baseurl; ?>/stripe.php" method="POST">
                    <p class="small">Please Enter Your Card Details.</p>
                    <div class="row collapse-cus">
                        <div class="small-6 columns">
                            <input placeholder="Card number" type="text" name="number">
                        </div>
                        <div class="small-6 columns">
                            <input placeholder="Full name" type="text" name="name">
                        </div>
                    </div>
                    <div class="row collapse-cus">
                        <div class="small-3 columns">
                            <input placeholder="MM/YY" type="text" name="expiry">
                        </div>

                        <div class="small-3 columns">
                            <input placeholder="CVC" type="text" name="cvc">
                        </div>

                        <input type="hidden" name="invid" value="<?php echo $invid; ?>">

                        <div class="small-6 columns">
                            <input type="submit" value="Submit" class="button postfix">
                        </div>
                    </div>
                </form>
            </div>
        </div>

    <?php

  }

}




?>
