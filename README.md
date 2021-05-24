# WebMoney Payment Gateway Module for WHMCS 8

# Installation
1) Copy the files from the `gateway` folder to your WHMCS directory at `./modules/gateways`
2) Go to the Admin area and enable the payment gateway module
3) Configure the settings on the module and merchant website (see callback below)
4) Create a Test payment

# Callback
For automatic callback, tick the checkboxes `Allow overriding URL from Payment Request Form`  and   
`Send an error notification to merchant's keeper`

If you want to set up the Callback manually, *leave the checkboxes unticked* and enter the result URL's on the merchant setting page instead.

**Example for WMZ**   
Result URL: `https://your_site.com/modules/gateways/callback/webmoneyusdresult.php`   
Success URL: `https://your_site.com/modules/gateways/callback/webmoneyusdsuccess.php`   
Fail URL: `https://your_site.com/modules/gateways/callback/webmoneyusdfail.php`
