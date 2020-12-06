<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Lets_api extends REST_Controller {

    function __construct()
    {
        parent::__construct();
		$this->load->model('api/Api_model');
    }

	function splash_post(){
    if($this->input->post('api_key') != '54st65h4esrth14s3ghd5f4g3d5fg13d2fg1d32fy4d2fg1hd3'){
      $setting['success'] = '2';
      $setting['message'] = "Api key is not valid";
      $this->response(array('setting' => $setting));
      exit();
    }
    	$access_token = $this->input->post('access_token');
      $id = $this->Api_model->isAccessId($access_token);
      if($id){
			$this->db->query("UPDATE login SET device_token = '" . $this->input->post('device_token') . "' WHERE access_id = '" . $access_token . "'");
        }
		else{
			$setting['success'] = '2';
			$setting['message'] = "Session Expire. Please login again";
			$this->response(array('setting' => $setting));
		}
    }


	function login_post(){
    if($this->input->post('api_key') != '54st65h4esrth14s3ghd5f4g3d5fg13d2fg1d32fy4d2fg1hd3'){
      $setting['success'] = '2';
      $setting['message'] = "Api key is not valid";
      $this->response(array('setting' => $setting));
      exit();
    }

        $username = $this->input->post('username');
        $password = $this->input->post('password');
		$query = $this->Api_model->check_login($username, $password);
		if (!$query->num_rows()){
			$setting['success'] = '0';
			$setting['message'] = "Username or password incorrect";
      $this->response(array("setting" => $setting));
        }
		else {
			$setting['success'] = '1';
			$setting['message'] = "data found";
      $res = $query->row();
      $id = $res->id;
			   $login_check = $this->Api_model->isLogged($id);
    			if($login_check){
    			     $login_update = $this->Api_model->update_login($id);
    			}
    			else{
    			     $login_update = $this->Api_model->add_login($id);
    			}
            $data = $this->Api_model->get_customer($id)->row();
			      $this->response(array('setting' => $setting,'data'=>$data));
        }
    }


		function logout_post(){
      if($this->input->post('api_key') != '54st65h4esrth14s3ghd5f4g3d5fg13d2fg1d32fy4d2fg1hd3'){
        $setting['success'] = '2';
        $setting['message'] = "Api key is not valid";
        $this->response(array('setting' => $setting));
        exit();
      }

    $access_id = $this->input->post('access_token');
		if($this->Api_model->isAccessId($access_id)){
		    $query = $this->Api_model->logout($access_id);
		if($query){
			$setting['message'] = "Logged out successfully";
      $setting['success'] = '1';
		}
		else{
			$setting['success'] = '0';
			$setting['message'] = "Error !!";
		}
		}
		else{
			$setting['success'] = '1';
			$setting['message'] = "Logged out successfully";
		}
		$this->response(array('setting' => $setting));
	}

	function view_profile_post(){
    if($this->input->post('api_key') != '54st65h4esrth14s3ghd5f4g3d5fg13d2fg1d32fy4d2fg1hd3'){
      $setting['success'] = '2';
      $setting['message'] = "Api key is not valid";
      $this->response(array('setting' => $setting));
      exit();
    }

		$access_token = $this->input->post('access_token');
    $id = $this->Api_model->isAccessId($access_token);
    if($id){
		$query = $this->Api_model->get_customer($id);
		if($query->num_rows()){
			$setting['success'] = '1';
			$setting['message'] = "data found";
      $data = $query->row();
			$this->response(array('setting' => $setting,"data"=>$data));
		}
		else{
			$setting['success'] = '0';
			$setting['message'] = "data not found";
			$this->response(array('setting' => $setting));
		}
		}
	else{
			$setting['success'] = '2';
			$setting['message'] = "Session Expire. Please login again";
		$this->response(array('setting' => $setting));
		}
	}

	function edit_profile_post(){
    if($this->input->post('api_key') != '54st65h4esrth14s3ghd5f4g3d5fg13d2fg1d32fy4d2fg1hd3'){
      $setting['success'] = '2';
      $setting['message'] = "Api key is not valid";
      $this->response(array('setting' => $setting));
      exit();
    }

		$access_token = $this->input->post('access_token');
    $id = $this->Api_model->isAccessId($access_token);
    if($id){

			 if(isset($_FILES)){
				 $txt = json_encode($_FILES);
				 $myfile = file_put_contents('./log.txt', $txt.PHP_EOL , FILE_APPEND);
			 } else{
				 $txt = 'No entry';
				 $myfile = file_put_contents('./log.txt', $txt.PHP_EOL , FILE_APPEND);
			 }

			 $con['upload_path']   = './user_img/';
             $con['allowed_types'] = '*';
             $con['max_size']      = 0;
             $con['max_width']     = 0;
             $con['max_height']    = 0;
    		     $con['max_filename'] = '50';
             $con['encrypt_name'] = TRUE;
             $this->load->library('upload', $con);
                if (!$this->upload->do_upload('image')) {
                   $dp = $this->input->post("old_image");
				         } else {
                   $image_data = $this->upload->data();
			             $dp = "user_img/".$image_data['file_name'];
				}

		$query = $this->Api_model->edit_customer($dp, $id);
		if($query){
			$setting['success'] = '1';
			$setting['message'] = "Edited Successfully";
			$s = $this->Api_model->get_customer($id);
      $data = $s->row();
			$this->response(array('setting' => $setting, "data"=>$data));
    }
    else{
			$setting['success'] = '0';
			$setting['message'] = "Error!!!";
			$this->response(array('setting' => $setting));
		}
	}
	else{
			$setting['success'] = '2';
			$setting['message'] = "Session Expire. Please login again";
		$this->response(array('setting' => $setting));
		}
	}

	function change_password_post(){
    if($this->input->post('api_key') != '54st65h4esrth14s3ghd5f4g3d5fg13d2fg1d32fy4d2fg1hd3'){
      $setting['success'] = '2';
      $setting['message'] = "Api key is not valid";
      $this->response(array('setting' => $setting));
      exit();
    }

		$access_token = $this->input->post('access_token');
    $id = $this->Api_model->isAccessId($access_token);
    if($id){
			$s = $this->Api_model->isPassword($id, $this->input->post('old_password'));
			if($s){
				$query = $this->Api_model->update_password($id);
					if($query){
						$setting['success'] = '1';
						$setting['message'] = "Password Changed Successfully";
					}
					else{
						$setting['success'] = '0';
						$setting['message'] = "Database Error !!!!";
					}
			}
			else{
				$setting['success'] = '0';
				$setting['message'] = "Old Password is not correct";
			}
			}
		else{
			$setting['success'] = '2';
			$setting['message'] = "Session Expire. Please login again";
		}
		$this->response(array('setting' => $setting));
	}

	function sign_up_post(){
    if($this->input->post('api_key') != '54st65h4esrth14s3ghd5f4g3d5fg13d2fg1d32fy4d2fg1hd3'){
      $setting['success'] = '2';
      $setting['message'] = "Api key is not valid";
      $this->response(array('setting' => $setting));
      exit();
    }

    $q = $this->Api_model->isRegistered($this->input->post('mobile'), $this->input->post('email'));
      if($q['status'] == '1'){
        $setting['success'] = '2';
			  $setting['message'] = "Already Resgistered. Please Login.";
        $this->response(array('setting' => $setting));
        exit();
      }
      elseif($q['status'] == '0'){
        $setting['success'] = '1';
  			$setting['message'] = "data found";
        $this->load->helper('string');
        $OTP = random_string('nozero', 4);
        $msg = urlencode('Hi, Your OTP is ' . $OTP . '. By using the OTP, you agree to the terms and conditions on zcabs.in.');
        $sms = 'http://sms.harshikainfotech.com/sendsms.jsp?user=zcabs1&password=ee33f5114dXX&mobiles='.$this->input->post("mobile").'&sms='.$msg.'&senderid=ZCABSS';
        $response = $this->file_get_contents_curl($sms);
        $data['otp'] = $OTP;
        $data['customer_id'] = $q['customer_id'];
        $this->response(array('setting' => $setting,'data'=>$data));
        exit();
      }
    else{

           $con['upload_path']   = './user_img/';
           $con['allowed_types'] = '*';
           $con['max_size']      = 0;
           $con['max_width']     = 0;
           $con['max_height']    = 0;
           $con['max_filename'] = '50';
           $con['encrypt_name'] = TRUE;
           $this->load->library('upload', $con);
              if (!$this->upload->do_upload('image')) {
                 $dp = '';
               } else {
                 $image_data = $this->upload->data();
                 $dp = "user_img/".$image_data['file_name'];
                }

      $query = $this->Api_model->add_customer($dp);

    if($query){
      $this->load->helper('string');
      $OTP = random_string('nozero', 4);
      /* Send Message */
      $msg = urlencode('Hi, Your OTP is ' . $OTP . '. By using the OTP, you agree to the terms and conditions on zcabs.in.');
      $sms = 'http://sms.harshikainfotech.com/sendsms.jsp?user=zcabs1&password=ee33f5114dXX&mobiles='.$this->input->post("mobile").'&sms='.$msg.'&senderid=ZCABSS';
      $response = $this->file_get_contents_curl($sms);
      $data['mobile'] = $this->input->post('mobile');
      $data['id'] = $query;

      $setting['success'] = '1';
			$setting['message'] = "data found";

      $data['otp'] = $OTP;

      $this->response(array('setting' => $setting,'data'=>$data));
    }
		else{
			$setting['success'] = '0';
			$setting['message'] = "Sign up error";
			$this->response(array('setting' => $setting));
		}
  }
	}

/* New Apis to valiadate*/

function verify_user_post(){
  if($this->input->post('api_key') != '54st65h4esrth14s3ghd5f4g3d5fg13d2fg1d32fy4d2fg1hd3'){
    $setting['success'] = '2';
    $setting['message'] = "Api key is not valid";
    $this->response(array('setting' => $setting));
    exit();
  }
  $id = $this->input->post("customer_id");
  $query = $this->Api_model->user_verified($id);
  if($query){
    $setting['success'] = '1';
    $setting['message'] = "data found";
    $data = $this->Api_model->get_customer($id)->row();

    $this->response(array('setting' => $setting,'data'=>$data));
  }
  else{
    $setting['success'] = '0';
    $setting['message'] = "Sign up error";
    $this->response(array('setting' => $setting));
  }
}

function resend_otp_post(){
  if($this->input->post('api_key') != '54st65h4esrth14s3ghd5f4g3d5fg13d2fg1d32fy4d2fg1hd3'){
    $setting['success'] = '2';
    $setting['message'] = "Api key is not valid";
    $this->response(array('setting' => $setting));
    exit();
  }
  $data['customer_id'] = $this->input->post("customer_id");
  $this->load->helper('string');
  $OTP = random_string('nozero', 4);
  $setting['success'] = '1';
  $setting['message'] = "data found";

  $mobile = $this->Api_model->get_customer($data['customer_id'])->row()->mobile;
  $data['otp'] = $OTP;
  $msg = urlencode('Hi, Your OTP is ' . $OTP . '. By using the OTP, you agree to the terms and conditions on zcabs.in.');
  $sms = 'http://sms.harshikainfotech.com/sendsms.jsp?user=zcabs1&password=ee33f5114dXX&mobiles='.$mobile.'&sms='.$msg.'&senderid=ZCABSS';
  $response = $this->file_get_contents_curl($sms);


  $this->response(array('setting' => $setting,'data'=>$data));
}


/*
function forgot_password_post(){
		//$email = $this->input->post('email');
		$query = $this->Api_model->get_customer_by_email();

			if(!$query->num_rows()){
				$setting['success'] = '0';
				$setting['message'] = "No email id is found of this address.";
			}
			else{
				foreach($query->result() as $for){
				$token =  $for->token;
				$id = $for->user_id;
				$name = $for->user_name;
				$email = $for->user_email;
				}
				 $config = Array(
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.zoho.com',
				'smtp_port' => 465,
				'smtp_user' => 'nosupport@letstalkacademy.com', // change it to yours
				'smtp_pass' => '#3||is@ver', // change it to yours
				'mailtype' => 'html',
				'charset' => 'iso-8859-1',
				'wordwrap' => TRUE
					);

				$message = '<table cellpadding="0" cellspacing="15" border="0" bgcolor="#f07607" width="100%" style="margin:0 auto;max-width:440px;font-family:arial">
<tbody>
<tr bgcolor="#ffffff">
<td>
<table cellpadding="15" cellspacing="0" border="0" width="100%">
<tbody>
<tr>
<td valign="middle">
<img src="'.base_url().'img/logo.png" alt="Logo" style="vertical-align:middle;width:225px;">
</td>
<td align="right">
<a href="https://facebook.com/letstalkacademy">
<img src="'.base_url().'images/facebook.png" alt="f" style="padding-left:3px;padding-right:3px;vertical-align:middle;width:15px;"></a>
<a href=""><img src="'.base_url().'images/twitter.png" alt="t" style="padding-left:3px;padding-right:3px;vertical-align:middle;width:15px;"></a>
<a href=""><img src="'.base_url().'images/google.png" alt="g+" style="padding-left:3px;padding-right:3px;vertical-align:middle;width:15px;"></a>
</td>
</tr>
</tbody>
</table>
</td>
</tr>

<tr bgcolor="#ffffff">
<td>
<table cellpadding="0" cellspacing="0" border="0">
<tbody>
<tr>
<td>
<img src="'.base_url().'img/s2.jpg" width="100%" style="max-width:415px" alt="banner" tabindex="0">
</td></tr>
<tr>
<td>
<table cellpadding="15" cellspacing="0" border="0" width="100%">
<tbody>
<tr>
<td>
<p style="margin:0;padding:0px;font-family:arial;font-size:13px;color:#121212;line-height:18px;padding-bottom:10px">Hi '.$name.', </p>

<p style="margin:0;padding:0px;font-family:arial;font-size:13px;color:#121212;line-height:18px;padding-bottom:10px">This mail is system generated and sent
you because you recently asked to reset your letstalkacademy password.</p>
<p style="margin:0;padding:0px;font-family:arial;font-size:13px;color:#121212;line-height:18px;padding-bottom:10px">
<a href="'.base_url().'profile_edit/mail_password/?st='.$token.'-'.$id.'">Click here to change your password</a>
</p>
<p style="margin:0;padding:0px;font-family:arial;font-size:13px;color:#121212;line-height:18px;padding-bottom:10px">
Log in to Lets Talk academy website for more information.</p>
</td>
</tr>
</tbody></table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>


<tr bgcolor="#ffffff"><td>
<table cellpadding="0" cellspacing="15" border="0" width="100%"><tbody><tr><td>
<p style="margin:0;padding:0px;font-family:arial;font-size:13px;color:#121212;line-height:20px;padding-bottom:20px">
For any queries or concerns, write to us at <a href="mailto:info@letstalkacademy.com"
style="color:#38bef0;text-decoration:none" target="_blank">info@letstalkacademy.com</a></p></td>
</tr><tr><td><p style="margin:0;padding:0px;font-family:arial;font-size:13px;color:#121212;line-height:20px">Best Wishes,<br>Lets Talk Academy</p>
</td></tr>
</tbody></table>
</td></tr>
<tr>
<td><p style="margin:0;padding:0px;font-family:arial;font-size:9px;color:#121212;line-height:20px;">
This is a system generated mail. If you not request for password reset let us know .</p>
</td>
</tr>
</tbody>
</table>';
				$subject = 'Letstalkacademy | Password reset ';
				$this->load->library('email', $config);
				$this->email->set_newline("\r\n");
				$this->email->from('nosupport@letstalkacademy.com', 'Letstalkacademy | Password RESET LINK'); // change it to yours
				$this->email->to($email);// change it to yours
				$this->email->subject($subject);
				$this->email->message($message);
				$this->email->send();

				$setting['success'] = '1';
				$setting['message'] = "A link has been sent to your mail id follow the link to recover your password. ";
			}
	$this->response(array('setting' => $setting));
	}
*/

function contact_us_post(){

  if($this->input->post('api_key') != '54st65h4esrth14s3ghd5f4g3d5fg13d2fg1d32fy4d2fg1hd3'){
    $setting['success'] = '2';
    $setting['message'] = "Api key is not valid";
    $this->response(array('setting' => $setting));
    exit();
  }

  $access_token = $this->input->post('access_token');
  $id = $this->Api_model->isAccessId($access_token);
  if($id){
  $result = $this->Api_model->send_contact();
  if($result){
    $setting['success'] = '1';
    $setting['message'] = "Your Query submitted successfully. We will catch you as soon as possible.";
    $this->response(array('setting' => $setting));
  }
  else{
    $setting['success'] = '0';
    $setting['message'] = "Error !!!";
    $this->response(array('setting' => $setting));
  }
  }
  else{
      $setting['success'] = '2';
      $setting['message'] = "Session Expire. Please login again";
    $this->response(array('setting' => $setting));
    }
  }

  function cms_post(){
    if($this->input->post('api_key') != '54st65h4esrth14s3ghd5f4g3d5fg13d2fg1d32fy4d2fg1hd3'){
      $setting['success'] = '2';
      $setting['message'] = "Api key is not valid";
      $this->response(array('setting' => $setting));
      exit();
    }

    $access_token = $this->input->post('access_token');
    $id = $this->Api_model->isAccessId($access_token);
    if($id){
      $cms = $this->input->post('cms');
    $result = $this->Api_model->get_cms($cms);
    if($result->num_rows()){
      $data = $result->row();
      $setting['success'] = '1';
      $setting['message'] = "Data Found.";
      $this->response(array('setting' => $setting, 'data'=>$data));
    }
    else{
      $setting['success'] = '0';
      $setting['message'] = "Error !!!";
      $this->response(array('setting' => $setting));
    }
    }
    else{
        $setting['success'] = '2';
        $setting['message'] = "Session Expire. Please login again";
      $this->response(array('setting' => $setting));
      }
    }



  	public function get_location_post(){
  		if($this->input->post('api_key') != '54st65h4esrth14s3ghd5f4g3d5fg13d2fg1d32fy4d2fg1hd3'){
  		  $setting['success'] = '2';
  		  $setting['message'] = "Api key is not valid";
  		  $this->response(array('setting' => $setting));
  		  exit();
  		}
  		$result = $this->Api_model->get_location();
  		if($result->num_rows()){
  		  $data = $result->result_array();
  		  $setting['success'] = '1';
  		  $setting['message'] = "Data Found.";
  		  $this->response(array('setting' => $setting, 'data'=>$data));
  		}
  		else{
  		  $setting['success'] = '0';
  		  $setting['message'] = "Error !!!";
  		  $this->response(array('setting' => $setting));
  		}
  	}

    public function get_sight_location_post(){
  		if($this->input->post('api_key') != '54st65h4esrth14s3ghd5f4g3d5fg13d2fg1d32fy4d2fg1hd3'){
  		  $setting['success'] = '2';
  		  $setting['message'] = "Api key is not valid";
  		  $this->response(array('setting' => $setting));
  		  exit();
  		}
  		$result = $this->Api_model->get_site_location();
  		if($result->num_rows()){
  		  $data = $result->result_array();
  		  $setting['success'] = '1';
  		  $setting['message'] = "Data Found.";
  		  $this->response(array('setting' => $setting, 'data'=>$data));
  		}
  		else{
  		  $setting['success'] = '0';
  		  $setting['message'] = "Error !!!";
  		  $this->response(array('setting' => $setting));
  		}
  	}


    public function get_outstation_price_post(){
      if($this->input->post('api_key') != '54st65h4esrth14s3ghd5f4g3d5fg13d2fg1d32fy4d2fg1hd3'){
        $setting['success'] = '2';
        $setting['message'] = "Api key is not valid";
        $this->response(array('setting' => $setting));
        exit();
      }


      $to = $this->input->post('_to');
  		$from = $this->input->post('_from');
  		$return_date = $this->input->post('return_date');
  		$date = $this->input->post('departure_date');
  		$passengers = $this->input->post('passengers');
  		$type = $this->input->post('type');
  		$pool_type = $this->input->post('pool_type');

  		if($pool_type == 'Shared'){
    		$lo_to = $this->Api_model->get_locality($to);
    		$lo_from = $this->Api_model->get_locality($from);
    		$result = $this->Api_model->get_outstation_price($to, $from, $date);
    		if($result->num_rows()){
          $data['prices'] = $result->result_array();
          $data['pickups'] = $lo_from->result_array();
          $data['drops'] = $lo_to->result_array();
          $setting['success'] = '1';
          $setting['message'] = "Data Found.";
          $this->response(array('setting' => $setting, 'data'=>$data));
    		}
    		else{
          $setting['success'] = '3';
          $setting['message'] = "This route is not currently available. We are adding it very soon. For more enquiry please leave a message.";
          $this->response(array('setting' => $setting));
    		}
  		}
  		else{
    		$result = $this->Api_model->get_reserved_outstation_price($to, $from);
    		if($result->num_rows()){
          $data['prices'] = $result->result_array();
          $data['pickups'] = array();
          $data['drops'] = array();
          $setting['success'] = '1';
          $setting['message'] = "Data Found.";
          $this->response(array('setting' => $setting, 'data'=>$data));
    		}
    		else{
          $setting['success'] = '3';
          $setting['message'] = "This route is not currently available. We are adding t very soon. For more enquiry please leave a message.";
          $this->response(array('setting' => $setting));
    		}
  		}
  	}


    public function add_outstation_post(){
      if($this->input->post('api_key') != '54st65h4esrth14s3ghd5f4g3d5fg13d2fg1d32fy4d2fg1hd3'){
        $setting['success'] = '2';
        $setting['message'] = "Api key is not valid";
        $this->response(array('setting' => $setting));
        exit();
      }

      $access_token = $this->input->post('access_token');
      $id = $this->Api_model->isAccessId($access_token);
      if($id){
      $result = $this->Api_model->add_final_api($id);
      if($result){
        $setting['success'] = '1';
        $setting['message'] = "Your outstation trip request sent successfully. We will confirm you soon.";
        $this->response(array('setting' => $setting));
      }
      else{
        $setting['success'] = '0';
        $setting['message'] = "Error !!!";
        $this->response(array('setting' => $setting));
      }
      }
      else{
          $setting['success'] = '2';
          $setting['message'] = "Session Expire. Please login again";
        $this->response(array('setting' => $setting));
        }
    }

    /***Tested Till Here***/

    public function get_sight_post(){
      if($this->input->post('api_key') != '54st65h4esrth14s3ghd5f4g3d5fg13d2fg1d32fy4d2fg1hd3'){
        $setting['success'] = '2';
        $setting['message'] = "Api key is not valid";
        $this->response(array('setting' => $setting));
        exit();
      }

      $access_token = $this->input->post('access_token');
      $id = $this->Api_model->isAccessId($access_token);
      if($id){
        $location_id = $this->input->post('location_id');
        $result = $this->Api_model->get_full_packages($location_id);
      if(!empty($result)){
        $setting['success'] = '1';
        $setting['message'] = "Data Found.";
        $this->response(array('setting' => $setting, "data"=>$result));
      }
      else{
        $setting['success'] = '0';
        $setting['message'] = "No Data Found !!!";
        $this->response(array('setting' => $setting));
      }
      }
      else{
          $setting['success'] = '2';
          $setting['message'] = "Session Expire. Please login again";
        $this->response(array('setting' => $setting));
        }
    }

    public function add_sight_post(){
      if($this->input->post('api_key') != '54st65h4esrth14s3ghd5f4g3d5fg13d2fg1d32fy4d2fg1hd3'){
        $setting['success'] = '2';
        $setting['message'] = "Api key is not valid";
        $this->response(array('setting' => $setting));
        exit();
      }

      $access_token = $this->input->post('access_token');
      $id = $this->Api_model->isAccessId($access_token);
      if($id){
      $result = $this->Api_model->add_sight($id);
      if($result){
        $setting['success'] = '1';
        $setting['message'] = "Your Sight Seen trip request sent successfully. We will confirm you soon.";
        $this->response(array('setting' => $setting));
      }
      else{
        $setting['success'] = '0';
        $setting['message'] = "Error !!!";
        $this->response(array('setting' => $setting));
      }
      }
      else{
          $setting['success'] = '2';
          $setting['message'] = "Session Expire. Please login again";
          $this->response(array('setting' => $setting));
      }
    }

	public function trips_post(){
		$type = array("1"=>"One Way", "2"=>"Round Trip", "3"=>"Sight_seeing", "4"=>"Local Trip");
		$status = array("1"=>"Recieved","2"=>"Accepted","3"=>"Admin Deny","4"=>"Started","5"=>"On Trip","6"=>"Completed","7"=>"Customer Cancel");
		if($this->input->post('api_key') != '54st65h4esrth14s3ghd5f4g3d5fg13d2fg1d32fy4d2fg1hd3'){
		  $setting['success'] = '2';
		  $setting['message'] = $this->input->post('api_key');
		  $this->response(array('setting' => $setting));
		  exit();
		}
		$access_token = $this->input->post('access_token');
		$id = $this->Api_model->isAccessId($access_token);
		if($id){
			$result = $this->Api_model->get_trips($id);
			if(!empty($result)){
			  $data = $result;
			  $setting['success'] = '1';
			  $setting['message'] = "Data Found.";
			  $this->response(array('setting' => $setting,'type'=>$type,'status'=>$status,'data'=>$data));
			}
			else{
			  $setting['success'] = '0';
			  $setting['message'] = "No Data Found";
			  $this->response(array('setting' => $setting));
			}
		}
      else{
			$setting['success'] = '2';
			$setting['message'] = "Session Expire. Please login again";
			$this->response(array('setting' => $setting));
        }
	}

	public function trip_manage_post(){
		if($this->input->post('api_key') != '54st65h4esrth14s3ghd5f4g3d5fg13d2fg1d32fy4d2fg1hd3'){
        $setting['success'] = '2';
        $setting['message'] = "Api key is not valid";
        $this->response(array('setting' => $setting));
        exit();
      }

      $access_token = $this->input->post('access_token');
      $id = $this->Api_model->isAccessId($access_token);
      if($id){
		  $trip_id = $this->input->post('trip_id');
		  $status = $this->input->post('status');
		  if($status == '4'){
			  $status_text = "Started";
		  }
		  elseif($status == '5'){
			  $status_text = "Trip on";
		  }
		  elseif($status == '6'){
			   $status_text = "Completed";
		  }
		  elseif($status == '7'){
			  $status_text = 'Customer Cancel';
		  }
		  else{
			  $setting['success'] = '0';
			  $setting['message'] = "Not Authorised.";
			  $this->response(array('setting' => $setting));
			  exit();
		  }
      $result = $this->Api_model->change_status($id,$trip_id,$status);
      if($result){
        $setting['success'] = '1';
        $setting['message'] = "Your trip has been " . $status_text . "successfully.";
        $this->response(array('setting' => $setting));
      }
      else{
        $setting['success'] = '0';
        $setting['message'] = "Error !!!";
        $this->response(array('setting' => $setting));
      }
      }
      else{
          $setting['success'] = '2';
          $setting['message'] = "Session Expire. Please login again";
        $this->response(array('setting' => $setting));
        }
	}


  public function add_local_post(){
    if($this->input->post('api_key') != '54st65h4esrth14s3ghd5f4g3d5fg13d2fg1d32fy4d2fg1hd3'){
      $setting['success'] = '2';
      $setting['message'] = "Api key is not valid";
      $this->response(array('setting' => $setting));
      exit();
    }

    $access_token = $this->input->post('access_token');
    $id = $this->Api_model->isAccessId($access_token);
    if($id){
    $result = $this->Api_model->submit_local($id);
    if($result){
      $setting['success'] = '1';
      $setting['message'] = "Your cab request sent successfully.";
      $this->response(array('setting' => $setting));
    }
    else{
      $setting['success'] = '0';
      $setting['message'] = "Error !!!";
      $this->response(array('setting' => $setting));
    }
    }
    else{
        $setting['success'] = '2';
        $setting['message'] = "Session Expire. Please login again";
      $this->response(array('setting' => $setting));
      }
  }

  public function update_app_post(){
    $app_code = $this->input->post('app_code');
    if($app_code < 3){
      $setting['success'] = '1';
      $setting['message'] = "Data Found.";
      $data['is_update'] = true;
      $data['is_force_update'] = true;
    } else{
      $setting['success'] = '0';
      $setting['message'] = "Data Found.";
      $data['is_update'] = false;
      $data['is_force_update'] = false;
    }
    $this->response(array('setting' => $setting, 'data'=>$data));
  }

  function file_get_contents_curl($url){
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
  }

}
