<?php
function webmoneyeur_activate( )
{
    definegatewayfield( "webmoneyeur", "text", "webmoneyeurpurse", "", "WME Purse", "30", "" );
    definegatewayfield( "webmoneyeur", "text", "webmoneyeurkey", "", "Secret Key", "30", "" );
    definegatewayfield( "webmoneyeur", "text", "webmoneyeurrate", "", "Rate", "10", "1.0" );
}

function webmoneyeur_link( $params )
{
   
    $gatewayusername = $params['username'];
    $gatewaytestmode = $params['testmode'];
    $invoiceid = $params['invoiceid'];
    $description = $params['description'];
    $amount = $params['amount'];
    $duedate = $params['duedate'];
    $rate = $params['webmoneyeurrate'];
    $firstname = $params['clientdetails']['firstname'];
    $lastname = $params['clientdetails']['lastname'];
    $email = $params['clientdetails']['email'];
    $address1 = $params['clientdetails']['address1'];
    $address2 = $params['clientdetails']['address2'];
    $city = $params['clientdetails']['city'];
    $state = $params['clientdetails']['state'];
    $postcode = $params['clientdetails']['postcode'];
    $country = $params['clientdetails']['country'];
    $phone = $params['clientdetails']['phone'];
    $companyname = $params['companyname'];
    $systemurl = $params['systemurl'];
    $currency = $params['currency'];
    $itogo = round( sprintf( "%.2f", $amount ) * $rate, 2);

        $code = "<style type=\"text/css\" media=\"all\">\r\n\t\t\t.button {\r\n\t\t\tcolor:#000000;\r\n\t\t\tcursor: pointer;\r\n\t\t\tcursor: hand;\r\n\t\t\theight:20px;\r\n\t\t\tfont-weight:bold;\r\n\t\t\tbackground-color:#ffffff;\r\n\t\t\tborder:1px solid #8FBCE9;\r\n\t\t\tfilter:progid:DXImageTransform.Microsoft.Gradient(GradientType=0,StartColorStr='#ffffff',EndColorStr='#e5e5e5');}\r\n\t\t\t}\r\n\t\t\t</style>\r\n\t<br>\r\n\t<form action=\"https://merchant.webmoney.ru/lmi/payment.asp\" method=\"POST\">\r\n\t<input type=\"hidden\" name=\"LMI_PAYEE_PURSE\" value=\"".$params['webmoneyeurpurse']."\">\r\n    <input type=\"hidden\" name=\"LMI_PAYMENT_NO\" value=\"".$params['invoiceid']."\">\r\n    <input type=\"hidden\" name=\"LMI_PAYMENT_AMOUNT\" value=\"".$itogo."\">\r\n    <input type=\"hidden\" name=\"LMI_PAYMENT_DESC\" value=\"Invoice # ".$params['invoiceid']."\">\r\n    <input type=\"hidden\" name=\"LMI_RESULT_URL\" value=\"".$params['systemurl']."/modules/gateways/callback/webmoneyeurresult.php\">\r\n    <input type=\"hidden\" name=\"LMI_SUCCESS_URL\" value=\"".$params['systemurl']."/modules/gateways/callback/webmoneyeursuccess.php\">\r\n    <input type=\"hidden\" name=\"LMI_SUCCESS_METHOD\" value=\"1\">\r\n    <input type=\"hidden\" name=\"LMI_FAIL_URL\" value=\"".$params['systemurl']."/modules/gateways/callback/webmoneyeurfail.php\">\r\n    <input type=\"hidden\" name=\"LMI_FAIL_METHOD\" value=\"1\">\r\n    <input type=\"submit\" value=\"".$params['langpaynow']."\" class=\"button\">\r\n    </form>";
        return $code;
}

$GATEWAYMODULE['webmoneyeurname'] = "webmoneyeur";
$GATEWAYMODULE['webmoneyeurvisiblename'] = "WebMoney E";
$GATEWAYMODULE['webmoneyeurtype'] = "Invoices";
?>
