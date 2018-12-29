<?php
include( "../../../init.php" );
$silent = "true";
include( "../../../includes/gatewayfunctions.php" );
include( "../../../includes/invoicefunctions.php" );
$debugreport = "";
foreach ( $_POST as $k => $v )
{
    $debugreport .= "".$k." => ".$v."";
}
logtransaction( "WebMoney E", $debugreport, "Error" );
header( "Location: ".$CONFIG['SystemURL']."/viewinvoice.php?id=".$_POST['LMI_PAYMENT_NO'] );
exit( );
?>
