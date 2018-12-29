<?php
include( "../../../init.php" );
$silent = "true";
include( "../../../includes/gatewayfunctions.php" );
include( "../../../includes/invoicefunctions.php" );

$debugreport = "";
foreach ( $_REQUEST as $key => $value )
{
    $arr .= $key."=>".$value."\n";
}
if ( !isset($_POST[LMI_PAYMENT_AMOUNT]) || 
     !isset($_POST[LMI_PAYMENT_NO]) 	||
     !isset($_POST[LMI_PAYEE_PURSE]) 	||
     !isset($_POST[LMI_SYS_INVS_NO]) 	||
     !isset($_POST[LMI_SYS_TRANS_NO])  	|| 
     !isset($_POST[LMI_PAYER_PURSE]) 	||
     !isset($_POST[LMI_SYS_TRANS_DATE]) ||
     !isset($_POST[LMI_HASH] )		||
     !is_numeric($_POST[LMI_PAYMENT_NO])  )

{
    echo "NO";
    exit();
}

$debugreport .= $arr;
$result = mysql_query( "SELECT userid, tblinvoices.id as id, total, tblclients.currency as currency, tblpaymentgateways.value as convertto FROM tblinvoices, tblclients, tblpaymentgateways  WHERE tblclients.id=tblinvoices.userid and tblpaymentgateways.gateway='webmoneyrur' and tblpaymentgateways.setting='convertto' and tblinvoices.id='".(int)$_POST['LMI_PAYMENT_NO']."'" );
$data = mysql_fetch_array( $result );
$result3 = mysql_query( "SELECT value FROM `tblpaymentgateways` WHERE gateway='webmoneyrur' and setting='webmoneyrurkey'" );
$webmoneyrurkey = mysql_fetch_array( $result3 );
$my_crc =  strtoupper( hash('sha256', $_POST['LMI_PAYEE_PURSE'].$_POST['LMI_PAYMENT_AMOUNT'].$_POST['LMI_PAYMENT_NO'].$_POST['LMI_MODE'].$_POST['LMI_SYS_INVS_NO'].$_POST['LMI_SYS_TRANS_NO'].$_POST['LMI_SYS_TRANS_DATE'].$webmoneyrurkey['0'].$_POST['LMI_PAYER_PURSE'].$_POST['LMI_PAYER_WM']) );
if ( strtoupper( $my_crc ) != strtoupper( $_POST[LMI_HASH] ) )
{
    logtransaction( "WebMoney R", $debugreport, "Error" );
    echo "NO Result Err";
    exit( );
}

$total_invoice = convertcurrency($data['total'], $data['currency'], $data['convertto']);

$rate = mysql_query( "SELECT value FROM `tblpaymentgateways` WHERE gateway='webmoneyrur' and setting='webmoneyrurrate'" );
$rate = mysql_fetch_array( $rate );
$itogo = round( sprintf( "%.2f", $total_invoice ) * $rate[0], 2 );
if($itogo!=$_POST['LMI_PAYMENT_AMOUNT'])
{
    logtransaction( "WebMoney R", "Amount not correct! invoice=".$data['total']." currency_invoice=".$total_invoice." summarity=$itogo ".$debugreport, "Error" );
    echo "NO";
    exit();
}

addinvoicepayment( $data['id'], $_POST['LMI_PAYMENT_NO'], "", "", "webmoneyrur" );
logtransaction( "WebMoney R", $debugreport, "Successful" );
echo "OK\n";
?>
