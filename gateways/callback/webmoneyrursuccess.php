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
if ( !isset($_POST[LMI_PAYMENT_NO]) )
{
    echo "NO";
    exit( );
}
if ( !isset($_POST[LMI_SYS_INVS_NO]) )
{
    echo "NO";
    exit( );
}
if ( !isset($_POST[LMI_SYS_TRANS_NO]) )
{
    echo "NO";
    exit( );
}
if ( !isset($_POST[LMI_SYS_TRANS_DATE]) )
{
    echo "NO";
    exit( );
}

if ( !is_numeric($_POST[LMI_PAYMENT_NO]))
{
    echo "NO";
    exit( );
}

$debugreport .= $arr;
$result = mysql_query( "SELECT id, total FROM tblinvoices WHERE tblinvoices.id='".$_POST['LMI_PAYMENT_NO']."'" );
$data = mysql_fetch_array( $result );
if ( $data['id'] != "" )
{
    header( "Location: ".$CONFIG['SystemURL']."/viewinvoice.php?id=".$data['id'] );
    exit( );
}
header( "Location: ".$CONFIG['SystemURL']."/clientarea.php?action=invoices" );
exit( );
?>
