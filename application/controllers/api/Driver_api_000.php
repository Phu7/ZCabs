<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Driver_api extends REST_Controller {

    function __construct()
    {
        parent::__construct();
		$this->load->model('api/Driver_api_model');
		$this->load->model('api/Api_model');
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
            $data = $this->Driver_api_model->get_driver($id)->row();
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
			$query = $this->Driver_api_model->get_driver($id);
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

	// function edit_profile_post(){
    // if($this->input->post('api_key') != '54st65h4esrth14s3ghd5f4g3d5fg13d2fg1d32fy4d2fg1hd3'){
    //   $setting['success'] = '2';
    //   $setting['message'] = "Api key is not valid";
    //   $this->response(array('setting' => $setting));
    //   exit();
    // }

	// 	$access_token = $this->input->post('access_token');
    // $id = $this->Api_model->isAccessId($access_token);
    // if($id){

	// 		 if(isset($_FILES)){
	// 			 $txt = json_encode($_FILES);
	// 			 $myfile = file_put_contents('./log.txt', $txt.PHP_EOL , FILE_APPEND);
	// 		 } else{
	// 			 $txt = 'No entry';
	// 			 $myfile = file_put_contents('./log.txt', $txt.PHP_EOL , FILE_APPEND);
	// 		 }

	// 		 $con['upload_path']   = './user_img/';
    //          $con['allowed_types'] = '*';
    //          $con['max_size']      = 0;
    //          $con['max_width']     = 0;
    //          $con['max_height']    = 0;
    // 		     $con['max_filename'] = '50';
    //          $con['encrypt_name'] = TRUE;
    //          $this->load->library('upload', $con);
    //             if (!$this->upload->do_upload('image')) {
    //                $dp = $this->input->post("old_image");
	// 			         } else {
    //                $image_data = $this->upload->data();
	// 		             $dp = "user_img/".$image_data['file_name'];
	// 			}

	// 	$query = $this->Api_model->edit_customer($dp, $id);
	// 	if($query){
	// 		$setting['success'] = '1';
	// 		$setting['message'] = "Edited Successfully";
	// 		$s = $this->Api_model->get_customer($id);
    //   $data = $s->row();
	// 		$this->response(array('setting' => $setting, "data"=>$data));
    // }
    // else{
	// 		$setting['success'] = '0';
	// 		$setting['message'] = "Error!!!";
	// 		$this->response(array('setting' => $setting));
	// 	}
	// }
	// else{
	// 		$setting['success'] = '2';
	// 		$setting['message'] = "Session Expire. Please login again";
	// 	$this->response(array('setting' => $setting));
	// 	}
	// }

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
			$setting['success'] = '2';
			$setting['message'] = "Already registered. But not approved by admin.";
			$this->response(array('setting' => $setting));
			exit();
		}
    	else{
      		$query = $this->Driver_api_model->add_driver();
			if($query){
				$this->load->helper('string');
				$setting['success'] = '1';
				$setting['message'] = "Successfully registered. Approval is on process.";
				$this->response(array('setting' => $setting));
			}
			else{
				$setting['success'] = '0';
				$setting['message'] = "Sign up error";
				$this->response(array('setting' => $setting));
			}
  		}
	}
	
	function manage_document_post(){
		if($this->input->post('api_key') != '54st65h4esrth14s3ghd5f4g3d5fg13d2fg1d32fy4d2fg1hd3'){
			$setting['success'] = '2';
			$setting['message'] = "Api key is not valid";
			$this->response(array('setting' => $setting));
			exit();
		}
		
		
    	$query = $this->Driver_api_model->manage_document();
		if($query){
			$setting['success'] = '1';
			$setting['message'] = "Successfully registered. Approval is on process.";
			$this->response(array('setting' => $setting));
		}
		else{
			$setting['success'] = '0';
			$setting['message'] = "Error";
			$this->response(array('setting' => $setting));
		}
	}

	function manage_duty_post(){
		if($this->input->post('api_key') != '54st65h4esrth14s3ghd5f4g3d5fg13d2fg1d32fy4d2fg1hd3'){
			$setting['success'] = '2';
			$setting['message'] = "Api key is not valid";
			$this->response(array('setting' => $setting));
			exit();
		}
		if($this->input->post('status') == ""){
			$setting['success'] = '0';
			$setting['message'] = "Status not found";
			$this->response(array('setting' => $setting));
		} else{
			$access_token = $this->input->post('access_token');
			$id = $this->Api_model->isAccessId($access_token);
			if($this->input->post('status') == 1){
				$st = "Online";
			} else{
				$st = "Offline";
			}
			$query = $this->Driver_api_model->manage_duty($id, $this->input->post('status'));
			if($query){
				$setting['success'] = '1';
				$setting['message'] = "Successfully " . $st . ".";
				$this->response(array('setting' => $setting));
			}
			else{
				$setting['success'] = '0';
				$setting['message'] = "Sign up error";
				$this->response(array('setting' => $setting));
			}
		}
	}

	function update_token_post(){
		if($this->input->post('api_key') != '54st65h4esrth14s3ghd5f4g3d5fg13d2fg1d32fy4d2fg1hd3'){
			$setting['success'] = '2';
			$setting['message'] = "Api key is not valid";
			$this->response(array('setting' => $setting));
			exit();
		}
		if($this->input->post('user_id') == ""){
			$setting['success'] = '0';
			$setting['message'] = "User Id not found";
			$this->response(array('setting' => $setting));
		} else{
			$query = $this->Driver_api_model->manage_token();
			if($query){
				$setting['success'] = '1';
				$setting['message'] = "Successfully updated.";
				$data = $this->Driver_api_model->get_driver($this->input->post('user_id'))->row();
				$this->response(array('setting' => $setting,'data'=>$data));
			}
			else{
				$setting['success'] = '0';
				$setting['message'] = "Sign up error";
				$this->response(array('setting' => $setting));
			}
		}
	}
	
	function update_app_post(){
		if($this->input->post('api_key') != '54st65h4esrth14s3ghd5f4g3d5fg13d2fg1d32fy4d2fg1hd3'){
			$setting['success'] = '2';
			$setting['message'] = "Api key is not valid";
			$this->response(array('setting' => $setting));
			exit();
		}
		if($this->input->post('access_token') == ""){
			$setting['success'] = '0';
			$setting['message'] = "Access Token not found";
			$this->response(array('setting' => $setting));
		} else{
			$query = $this->Driver_api_model->manage_app();
			if($query){
				$setting['success'] = '1';
				$setting['message'] = "Successfully updated.";
				$access_token = $this->input->post('access_token');
				$id = $this->Api_model->isAccessId($access_token);
				$data = $this->Driver_api_model->get_driver($id)->row();
				$this->response(array('setting' => $setting,'data'=>$data));
			}
			else{
				$setting['success'] = '0';
				$setting['message'] = "Sign up error";
				$this->response(array('setting' => $setting));
			}
		}
	}
	
	function resend_otp_post(){
		if($this->input->post('api_key') != '54st65h4esrth14s3ghd5f4g3d5fg13d2fg1d32fy4d2fg1hd3'){
		$setting['success'] = '2';
		$setting['message'] = "Api key is not valid";
		$this->response(array('setting' => $setting));
		exit();
		}
		$data['user_id'] = $this->input->post("user_id");
		$this->load->helper('string');
		$OTP = random_string('nozero', 4);
		$setting['success'] = '1';
		$setting['message'] = "data found";

		$mobile = $this->Driver_api_model->get_driver($data['user_id'])->row()->mobile;
		$data['otp'] = $OTP;
		if($this->input->post('type') == '1'){
			$msg = urlencode('Hi, Your OTP is ' . $OTP . '. By using the OTP, you agree to the terms and conditions on zcabs.in.');
		}
		$sms = 'http://sms.harshikainfotech.com/sendsms.jsp?user=zcabs1&password=ee33f5114dXX&mobiles='.$mobile.'&sms='.$msg.'&senderid=ZCABSS';
		$response = $this->file_get_contents_curl($sms);
		$this->response(array('setting' => $setting,'data'=>$data));
	}
	
  private function file_get_contents_curl($url){
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
