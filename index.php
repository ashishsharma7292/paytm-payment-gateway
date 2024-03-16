<?php
require_once("PaytmKit/lib/config_paytm.php");
require_once("PaytmKit/lib/encdec_paytm.php");

    $orderId 	= time();
    $txnAmount 	= "1.00";
    $custId 	= "cust123";
    $mobileNo 	= "7777777777";
    $email 		= "username@emailprovider.com";
    $paytm_MID  = '';  //Put Your Paytm Merchant ID Here
    $paytm_key  = '';  //Put Your Paytm Merchant Key Here

    $paytmParams = array();
    $paytmParams["ORDER_ID"] 	= $orderId;
    $paytmParams["CUST_ID"] 	= $custId;
    $paytmParams["MOBILE_NO"] 	= $mobileNo;
    $paytmParams["EMAIL"] 	= $email;
    $paytmParams["TXN_AMOUNT"] 	= $txnAmount;
    $paytmParams["MID"]         = $paytm_MID;
    $paytmParams["CHANNEL_ID"] 	= PAYTM_CHANNEL_ID;
    $paytmParams["WEBSITE"] 	= PAYTM_MERCHANT_WEBSITE;
    $paytmParams["INDUSTRY_TYPE_ID"] = PAYTM_INDUSTRY_TYPE_ID;
    $paytmParams["CALLBACK_URL"] = 'http://localhost/paytm//response.php';
    $paytmChecksum = getChecksumFromArray($paytmParams, $paytm_key);

    $transactionURL = "https://securegw-stage.paytm.in/theia/processTransaction";
    // $transactionURL = "https://securegw.paytm.in/theia/processTransaction"; // for production
?>
<html>
    <head>
        <title>Merchant Checkout Page</title>
    </head>
    <body>
        <center><h1>Please do not refresh this page...</h1></center>
        <form method='post' action='<?php echo $transactionURL; ?>' name='f1'>
            <?php
                foreach($paytmParams as $name => $value) {
                    echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
                }
            ?>
            <input type="hidden" name="CHECKSUMHASH" value="<?php echo $paytmChecksum ?>">
            <input type="submit" name="submit" value="submit" />
        </form>
        <!-- <script type="text/javascript">
            document.f1.submit();
        </script> -->
    </body>
</html>




