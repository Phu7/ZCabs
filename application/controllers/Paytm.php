<?php 
 
 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Paytm extends CI_Controller {
		public function __construct() {
        parent::__construct();
    	
	}

	
		
      
	function paytm(){
		$this->load->view('TxnTest');
	}
	function pgResponse(){
		header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

// following files need to be included
require_once(APPPATH . "/third_party/paytmlib/config_paytm.php");
require_once(APPPATH . "/third_party/paytmlib/encdec_paytm.php");

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : "";
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum);
		
		if($isValidChecksum == "TRUE") {
		 echo "<pre>";print_r($_POST);exit();
		
		 
		}
	else{
		echo "no response found";
	}
}
	function paytmpost(){

		
			 header("Pragma: no-cache");
			 header("Cache-Control: no-cache");
			 header("Expires: 0");

			 // following files need to be included
			 require_once(APPPATH . "/third_party/paytmlib/config_paytm.php");
			 require_once(APPPATH . "/third_party/paytmlib/encdec_paytm.php");

			 $checkSum = "";
			 $paramList = array();

			 $ORDER_ID = $_POST["ORDER_ID"];
			 $CUST_ID = $_POST["CUST_ID"];
			 $INDUSTRY_TYPE_ID = $_POST["INDUSTRY_TYPE_ID"];
			 $CHANNEL_ID = $_POST["CHANNEL_ID"];
			 $TXN_AMOUNT = $_POST["TXN_AMOUNT"];
			  
			// Create an array having all required parameters for creating checksum.
			 $paramList["MID"] = PAYTM_MERCHANT_MID;
			 $paramList["ORDER_ID"] = $ORDER_ID;
			 $paramList["CUST_ID"] = $CUST_ID;
			 $paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
			 $paramList["CHANNEL_ID"] = $CHANNEL_ID;
			 $paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
			
			 $paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
			 //echo '<pre>';print_r($paramList);exit();
			 $paramList["CALLBACK_URL"] = base_url()."Paytm/pgResponse";
			// $paramList["CALLBACK_URL"] = "http://www.arvino.in/paytm/paytmCallback";
			 //echo '<pre>';print_r($paramList);exit();
			// $paramList["CALLBACK_URL"] = CALLBACK_URL;
			 /*
			 $paramList["MSISDN"] = $MSISDN; //Mobile number of customer
			 $paramList["EMAIL"] = $EMAIL; //Email ID of customer
			 $paramList["VERIFIED_BY"] = "EMAIL"; //
			 $paramList["IS_USER_VERIFIED"] = "YES"; //

			 */
			 //echo '<pre>';print_r($paramList);exit();
			//Here checksum string will return by getChecksumFromArray() function.
			 $checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);
			 echo "<html>
			<head>
			<title>Merchant Check Out Page</title>
			</head>
			<body>
				<center><h1>Please do not refresh this page...</h1></center>
					<form method='post' action='".PAYTM_TXN_URL."' name='f1'>
			<table border='1'>
			 <tbody>";

			 foreach($paramList as $name => $value) {
			 echo '<input type="hidden" name="' . $name .'" value="' . $value .         '">';
			 }

			 echo "<input type='hidden' name='CHECKSUMHASH' value='". $checkSum . "'>
			 </tbody>
			</table>
			<script type='text/javascript'>
			 document.f1.submit();
			</script>
			</form>
			</body>
			</html>";

			 } 
			 function getTxnStatus(){
 
				header("Pragma: no-cache");
				header("Cache-Control: no-cache");
				header("Expires: 0");

				// following files need to be included
				require_once(APPPATH . "/third_party/paytmlib/config_paytm.php");
				require_once(APPPATH . "/third_party/paytmlib/encdec_paytm.php");

				$ORDER_ID = "";
				$requestParamList = array();
				$responseParamList = array();

				$requestParamList = array("MID" => PAYTM_MERCHANT_MID , "ORDERID" => "1004"); 

$checkSum = getChecksumFromArray($requestParamList,PAYTM_MERCHANT_KEY);
$requestParamList['CHECKSUMHASH'] = urlencode($checkSum);

$data_string = "JsonData=".json_encode($requestParamList);
//echo $data_string;

$ch = curl_init(); // initiate curl
$url = PAYTM_STATUS_QUERY_URL; //Paytm server where you want to post data

curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST, true); // tell curl you want to post something
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string); // define what you want to post
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // return the output in string format
$headers = array();
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$output = curl_exec($ch); // execute
$info = curl_getinfo($ch);

$data = json_decode($output, true);
echo "<pre>";
print_r($data);
echo "</pre>";
exit();
// echo "<pre>";
// print_r($data);
// echo "</pre>";
			 }

	  function paytmCallback(){
	 // echo '=====';exit;
	  //	 echo '<pre>';print_r($_POST);exit();
		header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

// following files need to be included
require_once(APPPATH . "/third_party/paytmlib/config_paytm.php");
require_once(APPPATH . "/third_party/paytmlib/encdec_paytm.php");

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;

$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.
//echo 'isValidChecksum:-'.$isValidChecksum ;exit();

if($isValidChecksum == "TRUE") {
	echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		echo "<b>Transaction status is success</b>" . "<br/>Txn Id = ".$_POST["CHECKSUMHASH"];
		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.
	}
	else {
		echo "<b>Transaction status is failure</b>" . "<br/>";
	}

	if (isset($_POST) && count($_POST)>0 )
	{ 
		foreach($_POST as $paramName => $paramValue) {
				echo "<br/>" . $paramName . " = " . $paramValue;
		}
	}
	

}
else {
	echo "<b>Checksum mismatched.</b>";
	//Process transaction as suspicious.
}
/* 	  	$this->load->view('front/order/thank'); */
	  }


}