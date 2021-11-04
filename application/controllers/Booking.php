<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {
  function __construct() {
        parent::__construct();
    }  

    public function booking()
    {
       $response=array();
      $post=$this->input->post();     
     $bookingId = uniqid();

      $data = array(
        'tourId' => $this->input->post('tourId'),
      'tour_date' => $this->input->post('bookingDate'),
      'bookingId' => $bookingId,
      'no_of_persons' => $this->input->post('no_of_persons'),
      'b_name' => $this->input->post('firstName'),
      'b_email' => $this->input->post('email'),
      'b_phone' => $this->input->post('phone'),
      'b_country' => $this->input->post('country'),
      'b_special_note' => $this->input->post('note'),
      'total_amount' => $this->input->post('amount'),
      'adults' => $this->input->post('adults'),
      'child' => $this->input->post('child'),
      'infant' => $this->input->post('infant')
    );

    $outletRef 	 = "f589d8ea-790c-4683-9c7e-287033b6ed7a";                                                                    // set your outlet reference/ID value here (example only)
$apikey 	 = "OTJjNmEwNWMtMzVkZi00YjMxLTg0NTUtY2MyY2ZmY2QxOWM5OmU5ZmI0NGUxLTFiYTctNDQ3Ni1hMGEwLTRmZTE5Nzk2OGNmMA==";       // set your service account API key (example only)


$idServiceURL  = "https://identity.ngenius-payments.com/auth/realms/NetworkInternational/protocol/openid-connect/token";           // set the identity service URL (example only)
$txnServiceURL = "https://api-gateway.ngenius-payments.com/transactions/outlets/".$outletRef."/orders";             // set the transaction service URL (example only)
  
    
$tokenHeaders  = array("Authorization: Basic ".$apikey, "Content-Type: application/x-www-form-urlencoded");
$tokenResponse = $this->invokeCurlRequest("POST", $idServiceURL, $tokenHeaders, http_build_query(array('grant_type' => 'client_credentials')));
$tokenResponse = json_decode($tokenResponse);
$access_token = $tokenResponse->access_token;
$order = new StdClass();
$amount=array("currencyCode" => "AED","value" => $data['total_amount']*100);
$billingAddress=array("firstName" => $data['b_name'],"lastName" => $data['b_name'],"address1" => $data['b_country'],"city" => $data['b_country'],"countryCode" => $data['b_country']);
$merchantAttributes=array("redirectUrl" => "https://onlytourism.com/booking-confirm");
$order = json_encode(array("action" => "SALE",
                            "amount" => $amount,
                            "emailAddress" => $data['b_email'],
                            "merchantOrderReference" => time(),
                            "merchantAttributes" => $merchantAttributes,
                            "billingAddress" => $billingAddress));

$orderCreateHeaders  = array("Authorization: Bearer ".$access_token, "Content-Type: application/vnd.ni-payment.v2+json", "Accept: application/vnd.ni-payment.v2+json");
$orderCreateResponse = $this->invokeCurlRequest("POST", $txnServiceURL, $orderCreateHeaders, $order);

$orderCreateResponse = json_decode($orderCreateResponse);
// print_r(json_encode($orderCreateResponse));

$paymentLink = $orderCreateResponse->_links;     // the link to the payment page for redirection (either full-page redirect or iframe)
$orderReference      = $orderCreateResponse->reference;              // the reference to the order, which you should store in your records for future interaction with this order
$payment1 = json_encode($paymentLink->payment->href);

$paymenturl= trim($payment1, "\"\'");

$data['orderReference'] = $orderReference;
$insert=$this->m->store('bookings',$data);
header("Location: ".$paymenturl);  
// redirect($payment1);
                            // execute redirect
//die();

        // if($insert){
        //     $this->bookingconfirm($data);
        // }
    }
    function invokeCurlRequest($type, $url, $headers, $post) {

        $ch = curl_init();
    
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);		
    
        if ($type == "POST") {
        
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        
        }
    
        $server_output = curl_exec ($ch);
        curl_close ($ch);
        
        return $server_output;
        
    }

    public function bookingconfirm($data = ''){
        if(is_array($data) && count($data) > 0){
            $data['confirmdata'] = $data;
            $data['page'] = 'tours/bookingConfirm';
            $this->load->view('theme/template/contents',$data);
         } else {
            echo "No result found";
         }
       
    }

    public function redirectAfterBooking(){
        $refId = $_GET['ref'];
           $data['ref']=$this->m->getAll('bookings',null,array('orderReference'=>$refId),null,null,'b_id','DESC');
echo $refId;
print_r($data['ref'][0]['b_email']);

             $from_email = 'info@onlytourism.com'; 
             $to_email = $data['ref'][0]['b_email']; 
   
            $config = array();
            $config['mailtype'] = 'html';
            $config['validation'] = TRUE;
            $config['charset'] = 'utf-8';
            $config['newline'] = "\r\n";
            $config['wordwrap'] = TRUE;

            $this->load->library('email');
            $this->email->initialize($config);
             
             $this->email->from($from_email, $from_email); 
             $this->email->to($to_email);
             $this->email->subject('Booking Confirmation'); 
             $message = '<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<meta content="width=device-width" name="viewport"/>
<meta content="IE=edge" http-equiv="X-UA-Compatible"/>
<title></title>
<style type="text/css">
		body {
			margin: 0;
			padding: 0;
		}

		table,
		td,
		tr {
			vertical-align: top;
			border-collapse: collapse;
		}

		* {
			line-height: inherit;
		}

		a[x-apple-data-detectors=true] {
			color: inherit !important;
			text-decoration: none !important;
		}
	</style>
<style id="media-query" type="text/css">
		@media (max-width: 570px) {

			.block-grid,
			.col {
				min-width: 320px !important;
				max-width: 100% !important;
				display: block !important;
			}

			.block-grid {
				width: 100% !important;
			}

			.col {
				width: 100% !important;
			}

			.col_cont {
				margin: 0 auto;
			}

			img.fullwidth,
			img.fullwidthOnMobile {
				max-width: 100% !important;
			}

			.no-stack .col {
				min-width: 0 !important;
				display: table-cell !important;
			}

			.no-stack.two-up .col {
				width: 50% !important;
			}

			.no-stack .col.num2 {
				width: 16.6% !important;
			}

			.no-stack .col.num3 {
				width: 25% !important;
			}

			.no-stack .col.num4 {
				width: 33% !important;
			}

			.no-stack .col.num5 {
				width: 41.6% !important;
			}

			.no-stack .col.num6 {
				width: 50% !important;
			}

			.no-stack .col.num7 {
				width: 58.3% !important;
			}

			.no-stack .col.num8 {
				width: 66.6% !important;
			}

			.no-stack .col.num9 {
				width: 75% !important;
			}

			.no-stack .col.num10 {
				width: 83.3% !important;
			}

			.video-block {
				max-width: none !important;
			}

			.mobile_hide {
				min-height: 0px;
				max-height: 0px;
				max-width: 0px;
				display: none;
				overflow: hidden;
				font-size: 0px;
			}

			.desktop_hide {
				display: block !important;
				max-height: none !important;
			}
		}
	</style>
<style id="icon-media-query" type="text/css">
		@media (max-width: 570px) {
			.icons-inner {
				text-align: center;
			}

			.icons-inner td {
				margin: 0 auto;
			}
		}
	</style>
</head>
<body class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #f9f9f9;">
<table  cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="table-layout: fixed; vertical-align: top; min-width: 320px; border-spacing: 0; border-collapse: collapse;  background-color: #f9f9f9; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top;" valign="top">
<div style="background-color:transparent;">
<div class="block-grid two-up no-stack" style="min-width: 320px; max-width: 550px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: transparent;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
<div class="col num6" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 270px; width: 275px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<div  class="img-container left fixedwidth" style="padding-right: 0px;padding-left: 25px;">
	<img src="https://onlytourism.com/site/assets/assets/logo.png" style="width: 75%;">
</div>
</div>
</div>
</div>
<div class="col num6" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 270px; width: 275px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;">
<p style="margin: 0; text-align: right; line-height: 1.2; word-break: break-word;  margin-top: 0; margin-bottom: 0;">+971 43 31 7111</p>
<p style="margin: 0; text-align: right; line-height: 1.2; word-break: break-word;  margin-top: 0; margin-bottom: 0;">The Burjuman, Business Tower - Sheikh Zayed Rd - Al Mankhool - Dubai Dubai, United Arab Emirates</p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="min-width: 320px; max-width: 550px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: transparent;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
<div class="col num12" style="min-width: 320px; max-width: 550px; display: table-cell; vertical-align: top; width: 550px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<div align="center" class="img-container center autowidth" style="padding-right: 0px;padding-left: 0px;">
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="min-width: 320px; max-width: 550px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #a9e0ff;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#a9e0ff;">
<div class="col num12" style="min-width: 320px; max-width: 550px; display: table-cell; vertical-align: top; width: 550px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<div style="color:#1678ac;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:25px;padding-left:10px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.2; font-size: 12px; color: #1678ac; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;">
<p style="margin: 0; font-size: 14px; line-height: 1.2; word-break: break-word; text-align: center;  margin-top: 0; margin-bottom: 0;"><strong><span style="font-size: 16px;">Booking Confirmation</span></strong></p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="min-width: 320px; max-width: 550px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 550px; display: table-cell; vertical-align: top; width: 550px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<div style="color:#232323;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:35px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.2; font-size: 12px; color: #232323; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; ">
<p style="margin: 0; font-size: 17px; line-height: 1.2; word-break: break-word;  margin-top: 0; margin-bottom: 0;"><span style="font-size: 17px; ">Booking ID:</span></p>
</div>
</div>
<div style="color:#0c9830;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:0px;padding-right:10px;padding-bottom:10px;padding-left:35px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.2; font-size: 12px; color: #0c9830; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; ">
<p style="margin: 0; font-size: 14px; line-height: 1.2; word-break: break-word;  margin-top: 0; margin-bottom: 0;"><strong><span style="font-size: 20px;">'.$data['ref'][0]['bookingId'].'</span></strong></p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid three-up no-stack" style="min-width: 320px; max-width: 550px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #0c5486;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#0c5486;">
<div class="col num2" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 90px; width: 91px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse;   min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" height="20" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse;   border-top: 0px solid transparent; height: 20px; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td height="20" style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse;  min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" height="10" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse;  border-top: 0px solid transparent; height: 10px; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td height="10" style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
<div class="col num8" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 360px; width: 366px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<div style="color:#ffffff;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:0px;padding-bottom:10px;padding-left:0px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.2; font-size: 12px; color: #ffffff; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; ">
<p style="margin: 0; font-size: 28px; line-height: 1.2; word-break: break-word; text-align: center;  margin-top: 0; margin-bottom: 0;"><span style="font-size: 28px;"><strong>Morning Desert Safari</strong></span></p>
</div>
</div>
<div style="color:#ffffff;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.2; font-size: 12px; color: #ffffff; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; ">
<p style="margin: 0; line-height: 1.2; word-break: break-word; text-align: center; font-size: 17px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 17px; ">Dubai</span></p>
</div>
</div>
</div>
</div>
</div>
<div class="col num2" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 90px; width: 91px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" height="10" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse;  border-top: 0px solid transparent; height: 10px; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td height="10" style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="min-width: 320px; max-width: 550px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: transparent;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
<div class="col num12" style="min-width: 320px; max-width: 550px; display: table-cell; vertical-align: top; width: 550px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<div align="center" class="img-container center autowidth" style="padding-right: 0px;padding-left: 0px;">
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid four-up no-stack" style="min-width: 320px; max-width: 550px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
<div class="col num3" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 135px; width: 137px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<div style="color:#232323;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.2; font-size: 12px; color: #232323; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; ">
<p style="margin: 0; line-height: 1.2; word-break: break-word; text-align: center; font-size: 15px;  margin-top: 0; margin-bottom: 0;"><span style="font-size: 15px;">ID</span></p>
</div>
</div>
<div style="color:#232323;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:0px;padding-bottom:10px;padding-left:0px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.2; font-size: 12px; color: #232323; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; ">
<p style="margin: 0; line-height: 1.2; word-break: break-word; text-align: center;  margin-top: 0; margin-bottom: 0;"><strong><span style="font-size: 18px;">'.$data['ref'][0]['bookingId'].'</span></strong></p>
</div>
</div>
</div>
</div>
</div>
<div class="col num3" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 135px; width: 137px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<div style="color:#232323;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.2; font-size: 12px; color: #232323; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; ">
<p style="margin: 0; line-height: 1.2; word-break: break-word; text-align: center; font-size: 15px;  margin-top: 0; margin-bottom: 0;"><span style="font-size: 15px;">Date</span></p>
</div>
</div>
<div style="color:#232323;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.2; font-size: 12px; color: #232323; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;">
<p style="margin: 0; line-height: 1.2; word-break: break-word; text-align: center; margin-top: 0; margin-bottom: 0;"><strong><span style="font-size: 18px;">'.$data['ref'][0]['tour_date'].'</span></strong></p>
</div>
</div>
</div>
</div>
</div>
<div class="col num3" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 135px; width: 137px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">

<div class="mobile_hide">
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse;  min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" height="0" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; border-top: 0px solid transparent; height: 0px; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td height="0" style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="min-width: 320px; max-width: 550px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 550px; display: table-cell; vertical-align: top; width: 550px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<div align="center" class="img-container center autowidth" style="padding-right: 0px;padding-left: 0px;">
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="min-width: 320px; max-width: 550px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 550px; display: table-cell; vertical-align: top; width: 550px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" height="0" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse;  border-top: 0px solid transparent; height: 0px; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td height="0" style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<div align="center" class="button-container" style="padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
<div style="text-decoration:none;display:inline-block;color:#ffffff;background-color:#0c5486;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px;width:auto; width:auto;;border-top:1px solid #0c5486;border-right:1px solid #0c5486;border-bottom:1px solid #0c5486;border-left:1px solid #0c5486;padding-top:5px;padding-bottom:5px;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;text-align:center;;word-break:keep-all;"><span style="padding-left:20px;padding-right:20px;font-size:16px;display:inline-block;letter-spacing:undefined;"><span style="font-size: 16px; line-height: 2; word-break: break-word; mso-line-height-alt: 32px;">View Tour Detail</span></span></div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="min-width: 320px; max-width: 550px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: transparent;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
<div class="col num12" style="min-width: 320px; max-width: 550px; display: table-cell; vertical-align: top; width: 550px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">

<div align="center" class="img-container center autowidth" style="padding-right: 0px;padding-left: 0px;">
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="min-width: 320px; max-width: 550px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 550px; display: table-cell; vertical-align: top; width: 550px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<div style="color:#232323;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:35px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.2; font-size: 12px; color: #232323; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; ">
<p style="margin: 0; font-size: 17px; line-height: 1.2; word-break: break-word;  margin-top: 0; margin-bottom: 0;"><span style="font-size: 17px; ">Booking Details</span></p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid two-up no-stack" style="min-width: 320px; max-width: 550px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
<div class="col num6" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 270px; width: 275px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<div style="color:#232323;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.5;padding-top:10px;padding-right:10px;padding-bottom:0px;padding-left:35px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.5; font-size: 12px; color: #232323; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; ">
<p style="margin: 0; font-size: 14px; line-height: 1.5; word-break: break-word; text-align: left; margin-top: 0; margin-bottom: 0;"><span style="font-size: 14px;">Adults</span></p>
</div>
</div>
</div>
</div>
</div>
<div class="col num6" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 270px; width: 275px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<div style="color:#232323;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.5;padding-top:10px;padding-right:25px;padding-bottom:0px;padding-left:35px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.5; font-size: 12px; color: #232323; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; ">
<p style="margin: 0; font-size: 14px; line-height: 1.5; word-break: break-word; text-align: left;  margin-top: 0; margin-bottom: 0;"><span style="font-size: 14px;">1 x 150 AED</span></p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid two-up no-stack" style="min-width: 320px; max-width: 550px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
<div class="col num6" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 270px; width: 275px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<div style="color:#232323;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.5;padding-top:10px;padding-right:10px;padding-bottom:0px;padding-left:35px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.5; font-size: 12px; color: #232323; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; ">
<p style="margin: 0; font-size: 14px; line-height: 1.5; word-break: break-word; text-align: left;  margin-top: 0; margin-bottom: 0;"><span style="font-size: 14px;">Children</span></p>
</div>
</div>
</div>
</div>
</div>
<div class="col num6" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 270px; width: 275px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<div style="color:#232323;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.5;padding-top:10px;padding-right:25px;padding-bottom:0px;padding-left:35px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.5; font-size: 12px; color: #232323; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; ">
<p style="margin: 0; font-size: 14px; line-height: 1.5; word-break: break-word; text-align: left; margin-top: 0; margin-bottom: 0;"><span style="font-size: 14px;">1 x 120 AED</span></p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid two-up no-stack" style="min-width: 320px; max-width: 550px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
<div class="col num6" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 270px; width: 275px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<div style="color:#232323;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.5;padding-top:10px;padding-right:10px;padding-bottom:0px;padding-left:35px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.5; font-size: 12px; color: #232323; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; ">
<p style="margin: 0; font-size: 14px; line-height: 1.5; word-break: break-word; text-align: left;  margin-top: 0; margin-bottom: 0;"><span style="font-size: 14px;">Infant</span></p>
</div>
</div>
</div>
</div>
</div>
<div class="col num6" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 270px; width: 275px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<div style="color:#232323;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.5;padding-top:10px;padding-right:25px;padding-bottom:0px;padding-left:35px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.5; font-size: 12px; color: #232323; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; ">
<p style="margin: 0; font-size: 14px; line-height: 1.5; word-break: break-word; text-align: left;  margin-top: 0; margin-bottom: 0;"><span style="font-size: 14px;">1 x 80 AED</span></p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="min-width: 320px; max-width: 550px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 550px; display: table-cell; vertical-align: top; width: 550px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">

<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse;  min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" height="0" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse;  border-top: 0px solid transparent; height: 0px; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td height="0" style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="min-width: 320px; max-width: 550px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: transparent;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
<div class="col num12" style="min-width: 320px; max-width: 550px; display: table-cell; vertical-align: top; width: 550px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<div align="center" class="img-container center autowidth" style="padding-right: 0px;padding-left: 0px;">
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="min-width: 320px; max-width: 550px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 550px; display: table-cell; vertical-align: top; width: 550px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<div style="color:#232323;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:35px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.2; font-size: 12px; color: #232323; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; ">
<p style="margin: 0; font-size: 17px; line-height: 1.2; word-break: break-word;margin-top: 0; margin-bottom: 0;"><span style="font-size: 17px;">James Brown</span></p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid two-up no-stack" style="min-width: 320px; max-width: 550px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
<div class="col num6" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 270px; width: 275px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<div style="color:#232323;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.5;padding-top:10px;padding-right:10px;padding-bottom:0px;padding-left:35px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.5; font-size: 12px; color: #232323; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; ">
<p style="margin: 0; font-size: 14px; line-height: 1.5; word-break: break-word; text-align: left;  margin-top: 0; margin-bottom: 0;"><span style="font-size: 14px;">Amount x3</span></p>
</div>
</div>
</div>
</div>
</div>
<div class="col num6" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 270px; width: 275px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<div style="color:#232323;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.5;padding-top:10px;padding-right:25px;padding-bottom:0px;padding-left:35px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.5; font-size: 12px; color: #232323; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; ">
<p style="margin: 0; font-size: 14px; line-height: 1.5; word-break: break-word; text-align: left; margin-top: 0; margin-bottom: 0;"><span style="font-size: 14px;">$350</span></p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid two-up no-stack" style="min-width: 320px; max-width: 550px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
<div class="col num6" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 270px; width: 275px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<div style="color:#232323;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.5;padding-top:10px;padding-right:10px;padding-bottom:0px;padding-left:35px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.5; font-size: 12px; color: #232323; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;">
<p style="margin: 0; font-size: 14px; line-height: 1.5; word-break: break-word; text-align: left; margin-top: 0; margin-bottom: 0;"><span style="font-size: 14px;">Fees &amp; Taxes</span></p>
</div>
</div>
</div>
</div>
</div>
<div class="col num6" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 270px; width: 275px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<div style="color:#232323;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.5;padding-top:10px;padding-right:25px;padding-bottom:0px;padding-left:35px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.5; font-size: 12px; color: #232323; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;">
<p style="margin: 0; font-size: 14px; line-height: 1.5; word-break: break-word; text-align: left;  margin-top: 0; margin-bottom: 0;"><span style="font-size: 14px;">$50</span></p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid two-up no-stack" style="min-width: 320px; max-width: 550px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
<div class="col num6" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 270px; width: 275px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:15px; padding-right: 0px; padding-left: 0px;">
<div style="color:#232323;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.5;padding-top:10px;padding-right:10px;padding-bottom:0px;padding-left:35px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.5; font-size: 12px; color: #232323; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; ">
<p style="margin: 0; font-size: 14px; line-height: 1.5; word-break: break-word; text-align: left; margin-top: 0; margin-bottom: 0;"><strong><span style="font-size: 16px;">Total Amount</span></strong></p>
</div>
</div>
</div>
</div>
</div>
<div class="col num6" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 270px; width: 275px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:15px; padding-right: 0px; padding-left: 0px;">
<div style="color:#232323;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.5;padding-top:10px;padding-right:25px;padding-bottom:0px;padding-left:35px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.5; font-size: 12px; color: #232323; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; ">
<p style="margin: 0; font-size: 16px; line-height: 1.5; word-break: break-word; text-align: left; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;"><strong><span >$400</span></strong></span></p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="min-width: 320px; max-width: 550px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 550px; display: table-cell; vertical-align: top; width: 550px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">

<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" height="0" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; border-top: 0px solid transparent; height: 0px; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td height="0" style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="min-width: 320px; max-width: 550px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 550px; display: table-cell; vertical-align: top; width: 550px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse;  min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" height="0" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; border-top: 0px solid transparent; height: 0px; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td height="0" style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="min-width: 320px; max-width: 550px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: transparent;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
<div class="col num12" style="min-width: 320px; max-width: 550px; display: table-cell; vertical-align: top; width: 550px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<div align="center" class="img-container center autowidth" style="padding-right: 0px;padding-left: 0px;">
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="min-width: 320px; max-width: 550px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: transparent;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
<div class="col num12" style="min-width: 320px; max-width: 550px; display: table-cell; vertical-align: top; width: 550px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" height="15" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; border-top: 0px solid transparent; height: 15px; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td height="15" style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<div align="center" class="img-container center fixedwidth" style="padding-right: 0px;padding-left: 0px;">
<div style="font-size:1px;line-height:15px"> </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid four-up" style="min-width: 320px; max-width: 550px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: transparent;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
<div class="col num3" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 135px; width: 137px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<div style="color:#232323;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.2; font-size: 12px; color: #232323; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; ">
<p style="margin: 0; font-size: 14px; line-height: 1.2; text-align: center; word-break: break-word; margin-top: 0; margin-bottom: 0;"><a href="#" rel="noopener" style="text-decoration: none; color: #626262;" target="_blank">Need Help</a></p>
</div>
</div>
</div>
</div>
</div>
<div class="col num3" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 135px; width: 137px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<div style="color:#232323;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.2; font-size: 12px; color: #232323; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; ">
<p style="margin: 0; font-size: 14px; line-height: 1.2; text-align: center; word-break: break-word; margin-top: 0; margin-bottom: 0;"><a href="#" rel="noopener" style="text-decoration: none; color: #626262;" target="_blank">About Us</a></p>
</div>
</div>
</div>
</div>
</div>
<div class="col num3" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 135px; width: 137px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<div style="color:#232323;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.2; font-size: 12px; color: #232323; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; "></div>
<p style="margin: 0; font-size: 14px; line-height: 1.2; text-align: center; word-break: break-word; margin-top: 0; margin-bottom: 0;"><a href="#" rel="noopener" style="text-decoration: none; color: #626262;" target="_blank">Privacy &amp; Policy</a></p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="min-width: 320px; max-width: 550px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: transparent;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
<div class="col num12" style="min-width: 320px; max-width: 550px; display: table-cell; vertical-align: top; width: 550px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse;  border-top: 1px dashed #BBBBBB; width: 95%;" valign="top" width="95%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="min-width: 320px; max-width: 550px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: transparent;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
<div class="col num12" style="min-width: 320px; max-width: 550px; display: table-cell; vertical-align: top; width: 550px;">
<div class="col_cont" style="width:100% !important;">
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<table cellpadding="0" cellspacing="0" class="social_icons" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse;  valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;" valign="top">
<table align="center" cellpadding="0" cellspacing="0" class="social_table" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; " valign="top">
<tbody>
<tr align="center" style="vertical-align: top; display: inline-block; text-align: center;" valign="top">
<td style="word-break: break-word; vertical-align: top; padding-bottom: 0; padding-right: 5px; padding-left: 5px;" valign="top"><a href="https://www.facebook.com/" target="_blank"><img alt="Facebook" height="32" src="images/facebook2x.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; display: block;" title="Facebook" width="32"/></a></td>
<td style="word-break: break-word; vertical-align: top; padding-bottom: 0; padding-right: 5px; padding-left: 5px;" valign="top"><a href="https://twitter.com/" target="_blank"><img alt="Twitter" height="32" src="images/twitter2x.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; display: block;" title="Twitter" width="32"/></a></td>
<td style="word-break: break-word; vertical-align: top; padding-bottom: 0; padding-right: 5px; padding-left: 5px;" valign="top"><a href="https://instagram.com/" target="_blank"><img alt="Instagram" height="32" src="images/instagram2x.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; display: block;" title="Instagram" width="32"/></a></td>
<td style="word-break: break-word; vertical-align: top; padding-bottom: 0; padding-right: 5px; padding-left: 5px;" valign="top"><a href="https://www.linkedin.com/" target="_blank"><img alt="LinkedIn" height="32" src="images/linkedin2x.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; display: block;" title="LinkedIn" width="32"/></a></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</td>
</tr>
</tbody>
</table>
</body>
</html>';
         $this->email->message($message); 
        
         //Send mail 
        $sent =  $this->email->send();
        if($sent){
            echo "email sent";
        }else{
            echo "nothing";
        }
            $data['page'] = 'tours/bookingConfirm';
            $this->load->view('theme/template/contents',$data);
        
       
    }

}
