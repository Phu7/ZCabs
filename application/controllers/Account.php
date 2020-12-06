<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('api/Api_model');
		$this->load->library('form_validation');
	}

	public function index(){
		$data['result'] = $this->Api_model->get_customer($this->customer->getId())->row();
		$this->load->view("front/account/profile",$data);
	}

	public function cancel_ride(){
		$id = $this->input->get('id');
		$query = $this->db->query("SELECT id FROM outstation WHERE id = '" . (int)$id . "' AND customer_id = '" . (int)$this->customer->getId() . "'");
		if($query->num_rows()){
			$this->db->query("UPDATE outstation SET status = 8 WHERE id = '" . (int)$id . "'");
			$this->session->set_flashdata('msg','Your cancel request has been under process.');
			$this->session->set_flashdata('is_success','1');
		} else{
			$this->session->set_flashdata('msg','Sorry you can not cancel this trip.');
			$this->session->set_flashdata('is_success','');
		}
		redirect('account/get_history');
	}
	/*
	@Agent
	*/

	public function agent_start(){
			$this->load->view("front/common/agent");
	}

	public function withdrawal(){
			$this->load->view("front/account/withdrawal");
	}

	public function withdrawal_request(){
		if($this->input->post('amount') <= 0){
			$this->session->set_flashdata('msg','Amount not valid.');
			$this->session->set_flashdata('is_success','0');
		}
		elseif($this->input->post('amount') > $this->customer->getWallet()){
			$this->session->set_flashdata('msg','Not Enough Amount In Wallet.');
			$this->session->set_flashdata('is_success','0');
		}
		else{
			$query = $this->Api_model->send_withdrawal_request();
			if($query){
				$this->session->set_flashdata('msg','Your Request Send Successfully.');
				$this->session->set_flashdata('is_success','1');
			}
		}
		redirect('account/withdrawal');
	}

	public function transaction_history(){
		$data['result'] = $this->Api_model->get_transactions();
		$this->load->view("front/account/transaction",$data);
	}

	public function payin_history(){
		$data['result'] = $this->Api_model->get_payins();
		$this->load->view("front/account/payin",$data);
	}

	/*
	End
	Agent
	*/

	/**
	**Driver
	**/

	public function driver_start(){
			$this->load->view("front/common/driver");
	}

	public function driver_register(){
		$this->form_validation->set_rules('first_name', 'Name', 'trim|required');
		if($this->form_validation->run()==FALSE){
			$this->session->set_userdata('info', "2--".validation_errors());
		}
		else{



			$this->load->helper('string');
			$OTP = random_string('nozero', 6);
			$this->session->set_userdata('otp', $OTP);
			if($this->customer->isUser($this->input->post("mobile")) AND $this->customer->getStatus($this->input->post("mobile"))){
				$data['success'] = '0';
				$data['message'] = "Already Registered. Please Login";
				$data['open'] = 'loginModal';
			}
			elseif($this->customer->isUser($this->input->post("mobile")) AND !$this->customer->getStatus($this->input->post("mobile"))){
				$this->session->set_userdata("username", $this->input->post("mobile"));
				$this->session->set_userdata("otp", $OTP);
				$msg = urlencode('Hi, Your OTP is ' . $OTP . '. By using the OTP, you agree to the terms and conditions on zcabs.in.');
				$sms = 'http://103.241.146.71/sendsms.jsp?user=zcabs1&password=ee33f5114dXX&mobiles='.$this->input->post("mobile").'&sms='.$msg.'&senderid=ZCABSS';
				$response = $this->file_get_contents_curl($sms);
				$data['success'] = '1';
				$data['message'] = "Please confirm your mobile. An OTP has been sent to your mobile number.";
				$data['open'] = 'otpModal';
			}
			else{
				$this->Api_model->add_driver();
				$this->session->set_userdata("username", $this->input->post("mobile"));
				$this->session->set_userdata("otp", $OTP);

				$data['open'] = 'otpModal';
				$msg = urlencode('Hi, Your OTP is ' . $OTP . '. By using the OTP, you agree to the terms and conditions on zcabs.in.');
				$sms = 'http://103.241.146.71/sendsms.jsp?user=zcabs1&password=ee33f5114dXX&mobiles='.$this->input->post("mobile").'&sms='.$msg.'&senderid=ZCABSS';
				$response = $this->file_get_contents_curl($sms);
				$data['success'] = '1';
				$data['message'] = "Please confirm your mobile. An OTP has been sent to your mobile number.";
			}
		}
		echo json_encode($data);
	}

	/**
	**Driver ENd
	**/



	public function login_home(){
		$this->load->view("front/login");
	}

	public function login_home_submit(){
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if($this->form_validation->run()==FALSE){
			 $data['success'] =  "0";
			 $data['message'] = validation_errors();
			 redirect('login');
		}
		else{
		$query = $this->customer->login($this->input->post('username'), $this->input->post('password'));
		if($query){
			if($this->session->userdata('d')){
				$this->Api_model->add_final($this->session->userdata('d'));
				$this->session->set_flashdata('msg','Your Trip successfully scheduled.');
				$this->session->set_flashdata('is_success','1');
				redirect('thank-you');
			}
			else{
				redirect('/');
			}
		}
		else{
			$this->session->set_flashdata('msg','Username Or Password did Not Match.');
				$this->session->set_flashdata('is_success','0');
			redirect('login');
		}
		}
	}

	public function login(){
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if($this->form_validation->run()==FALSE){
			 $data['success'] =  "0";
			 $data['message'] = validation_errors();
		}
		else{
		$query = $this->customer->login($this->input->post('username'), $this->input->post('password'));
		if($query){
			if($this->input->post('login_extra')){
				$extra = json_decode($this->input->post('login_extra'));
				$sa = $this->Api_model->save_order($extra);
				$data['success'] = "1";
				$data['message'] = "Your Trip successfully submitted.";
			}
			else{
			$data['success'] = "1";
			$data['message'] = "Successfully Logged in.";
		}
		}
		else{
			$data['success'] =  "0";
			$data['message'] = "Username Or Password doesnot Match.";
		}
		}
		echo json_encode($data);
	}

	public function logout(){
		$this->customer->logout();
		redirect("/");
	}

	public function register(){
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if($this->form_validation->run()==FALSE){
			$data['success'] = '0';
			$data['message'] = validation_errors();
		}
		else{
			$this->load->helper('string');
			$OTP = random_string('nozero', 6);
			$this->session->set_userdata('otp', $OTP);
			if($this->customer->isUser($this->input->post("mobile")) AND $this->customer->getStatus($this->input->post("mobile"))){
				$data['success'] = '0';
				$data['message'] = "Already Registered. Please Login";
				$data['open'] = 'loginModal';
			}
			elseif($this->customer->isUser($this->input->post("mobile")) AND !$this->customer->getStatus($this->input->post("mobile"))){
				$this->session->set_userdata("username", $this->input->post("mobile"));
				$this->session->set_userdata("otp", $OTP);
				$msg = urlencode('Hi, Your OTP is ' . $OTP . '. By using the OTP, you agree to the terms and conditions on zcabs.in.');
				/* $sms = 'http://mysms.dogmaindia.com/http-api.php?username=obee&password=obee&senderid=OBEINT&route=8&number='.$this->input->post("mobile").'&message='.$msg; */
				$sms = 'http://103.241.146.71/sendsms.jsp?user=zcabs1&password=ee33f5114dXX&mobiles='.$this->input->post("mobile").'&sms='.$msg.'&senderid=ZCABSS';
				$response = $this->file_get_contents_curl($sms);
				$data['success'] = '1';
				$data['message'] = "Please confirm your mobile. An OTP has been sent to your mobile number 1.";
				$data['open'] = 'otpModal';
			}
			else{
				$this->Api_model->add_web_customer();
				$this->session->set_userdata("username", $this->input->post("mobile"));
				$this->session->set_userdata("otp", $OTP);

				$data['open'] = 'otpModal';
				$msg = urlencode('Hi, Your OTP is ' . $OTP . '. By using the OTP, you agree to the terms and conditions on zcabs.in.');
				$sms = 'http://103.241.146.71/sendsms.jsp?user=zcabs1&password=ee33f5114dXX&mobiles='.$this->input->post("mobile").'&sms='.$msg.'&senderid=ZCABSS';
				$response = $this->file_get_contents_curl($sms);
				$data['success'] = '1';
				$data['message'] = "Please confirm your mobile. An OTP has been sent to your mobile number 2.";
			}
		}
		echo json_encode($data);
	}

	public function agent_register(){
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|valid_email');
		$this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if($this->form_validation->run()==FALSE){
			$data['success'] = '0';
			$data['message'] = validation_errors();
		}
		else{
			$this->load->helper('string');
			$OTP = random_string('nozero', 6);
			$this->session->set_userdata('otp', $OTP);
			if($this->customer->isUser($this->input->post("mobile")) AND $this->customer->getStatus($this->input->post("mobile"))){
				$data['success'] = '0';
				$data['message'] = "Already Registered. Please Login";
				$data['open'] = 'loginModal';
			}
			elseif($this->customer->isUser($this->input->post("mobile")) AND !$this->customer->getStatus($this->input->post("mobile"))){
				$this->session->set_userdata("username", $this->input->post("mobile"));
				$this->session->set_userdata("otp", $OTP);
				$msg = urlencode('Hi, Your OTP is ' . $OTP . '. By using the OTP, you agree to the terms and conditions on zcabs.in.');
				$sms = 'http://103.241.146.71/sendsms.jsp?user=zcabs1&password=ee33f5114dXX&mobiles='.$this->input->post("mobile").'&sms='.$msg.'&senderid=ZCABSS';
				$response = $this->file_get_contents_curl($sms);
				$data['success'] = '1';
				$data['message'] = "Please confirm your mobile. An OTP has been sent to your mobile number.";
				$data['open'] = 'otpModal';
			}
			else{
				$this->Api_model->add_agent();
				$this->session->set_userdata("username", $this->input->post("mobile"));
				$this->session->set_userdata("otp", $OTP);

				$data['open'] = 'otpModal';
				$msg = urlencode('Hi, Your OTP is ' . $OTP . '. By using the OTP, you agree to the terms and conditions on zcabs.in.');
				$sms = 'http://103.241.146.71/sendsms.jsp?user=zcabs1&password=ee33f5114dXX&mobiles='.$this->input->post("mobile").'&sms='.$msg.'&senderid=ZCABSS';
				$response = $this->file_get_contents_curl($sms);
				$data['success'] = '1';
				$data['message'] = "Please confirm your mobile. An OTP has been sent to your mobile number.";
			}
		}
		echo json_encode($data);
	}

	public function edit_profile(){
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|valid_email');
		$this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required');
		if($this->form_validation->run()==FALSE){
			$this->session->set_flashdata('msg', validation_errors());
			$this->session->set_flashdata('is_success','0');
		}
		else{
			$this->Api_model->edit_customer($this->input->post('dp'), $this->input->post('id'));
			$this->session->set_flashdata('msg','Profile updated successfully.');
			$this->session->set_flashdata('is_success','1');
		}
		redirect("account");
	}

	public function check_otp(){
		$otp = $this->session->userdata('otp');
		$this->session->unset_userdata('otp');
		if($this->input->post('otp') == $otp){
			$this->Api_model->complete_user();
			$is_login = $this->customer->login($this->session->userdata('username'), $password="", $override=true);
			if($is_login){
				$data['success'] = "1";
				$data['message'] = "Thank you to join with us. Now you can directly book a ride.";
				if($this->input->post('register_extra')){
					$extra = json_decode($this->input->post('register_extra'));
					$sa = $this->Api_model->save_order($extra);
					$data['success'] = "1";
					$data['message'] = "Your Trip successfully submitted.";
				}
				if($this->session->userdata('d')){
					$this->Api_model->add_final($this->session->userdata('d'));
					//set flash
					redirect("/");
				}
				$this->session->unset_userdata('username');
			} else{
				$data['success'] = "1";
				$data['message'] = "Thank you to join with us. Your Account will be activated soon.";
			}
		}
		else{
			$data['success'] = "0";
			$data['message'] = "Sorry Otp didnot match.";
		}
		echo json_encode($data);
	}

	public function resend_otp(){
		$this->load->helper('string');
		$OTP = random_string('nozero', 6);
		$this->session->set_userdata('otp', $OTP);
		$msg = urlencode('Hi, Your OTP is ' . $OTP . '. By using the OTP, you agree to the terms and conditions on zcabs.in.');
		$sms = 'http://103.241.146.71/sendsms.jsp?user=zcabs1&password=ee33f5114dXX&mobiles='.$this->session->userdata("username").'&sms='.$msg.'&senderid=ZCABSS';
		$response = $this->file_get_contents_curl($sms);
		$data['success'] = '1';
		$data['message'] = $response."Please confirm your mobile. An OTP has been sent to your mobile number.";
		$data['open'] = 'otpModal';
		echo json_encode($data);
	}

	public function update(){
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required');
		$this->form_validation->set_rules('address', 'Address', 'trim');
		$this->form_validation->set_rules('city', 'City', 'trim');
		$this->form_validation->set_rules('state', 'State', 'trim');
		$this->form_validation->set_rules('country', 'Country', 'trim');
		$this->form_validation->set_rules('zip', 'Pincode', 'trim');
		$this->form_validation->set_rules('gender', 'Gender', 'trim');
		$this->form_validation->set_rules('dob', 'DOB', 'trim');
		if($this->form_validation->run()==FALSE){
			 $this->session->set_flashdata('success', "0");
			 $this->session->set_flashdata('msg', validation_errors());
		}
		else{
		$query = $this->Api_model->edit_customer($dp = '', $this->customer->getId());
		if($query){

			$this->session->set_flashdata('success', "0");
			$this->session->set_flashdata('msg', "Ypur Profile Successfully Updated.");
		}
		else{
			$this->session->set_flashdata('msg', "Some Error Occure.");
			$this->session->set_flashdata('success', "0");
		}
		}
	}
	public function isLogged(){
		if($this->customer->isLogged() AND ($this->customer->isType() == 1 || $this->customer->isType() == 3)){
			echo '1';
		}
		else{
			echo '0';
		}
	}
	
    public function isDriver(){
		if($this->customer->isLogged() AND $this->customer->isType() == 2){
			echo '2';
		}
		else{
			echo '0';
		}
	}

	public function isAgent(){
		if($this->customer->isLogged() AND $this->customer->isType() == 3){
			echo '3';
		}
		else{
			echo '0';
		}
	}
	

	public function change_password(){
		if($this->customer->isLogged()){
		$this->load->view("front/account/change_password");
		}
		else{
		redirect('/');
		}
	}

	public function forget_password(){
		$this->load->view("front/account/forget_password");
	}

	public function send_forget_password(){

		if($this->customer->isUser($this->input->post("mobile"))){
			$this->load->helper('string');
			$OTP = random_string('nozero', 6);
			$query = $this->Api_model->new_password($this->input->post("mobile"), $OTP);
			if($query){
				$msg = urlencode('Hi, Your new password for ' . $this->input->post("mobile") . ' is ' . $OTP . '. By using this you can login.');
				$sms = 'http://103.241.146.71/sendsms.jsp?user=zcabs1&password=ee33f5114dXX&mobiles='.$this->input->post("mobile").'&sms='.$msg.'&senderid=ZCABSS';
				$response = $this->file_get_contents_curl($sms);

				$this->session->set_flashdata('msg','New Password has been sent to your registered mobile');
				$this->session->set_flashdata('is_success','1');
			}
			else{
				$this->session->set_flashdata('msg','Some Error Occures');
				$this->session->set_flashdata('is_success','0');
			}
		} else{
				$this->session->set_flashdata('msg','mobile you entered not found. Please Login');
				$this->session->set_flashdata('is_success','0');
		}
		redirect('/');
	}


	public function submit_change_password(){
		$this->form_validation->set_rules('old_password', 'Old Password', 'trim|required');
		$this->form_validation->set_rules('new_password', 'New Password', 'trim|required');
		$this->form_validation->set_rules('con_password', 'Confirm Password', 'trim|required|matches[new_password]');
		if($this->form_validation->run()==FALSE){
			 $this->session->set_flashdata('msg',validation_errors());
			$this->session->set_flashdata('is_success','0');
		}
		else{
			$id = $this->customer->getId();
			$s = $this->Api_model->isPassword($id, $this->input->post('old_password'));
			if($s){
				$query = $this->Api_model->update_password($id);
				if($query){
					$this->session->set_flashdata('msg','Password Updated successfully');
				 $this->session->set_flashdata('is_success','1');
				}
				else{
					$this->session->set_flashdata('msg','Some Error Occures');
				 $this->session->set_flashdata('is_success','0');
				}
				}
				else{
					$this->session->set_flashdata('msg','Old password does not match');
				 $this->session->set_flashdata('is_success','0');
				}
	}
	redirect("account");
	}

	public function submit_newsletter(){
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|is_unique[newsletter.email]');
		if($this->form_validation->run()==FALSE){
			$data['message'] = validation_errors();
			$data['success'] = '0';
		}
		else{
		$query = $this->db->query("INSERT INTO newsletter SET email = '" . $this->db->escape_str($this->input->post('email')) . "', created = NOW()");
		$data['message'] = "Thank you to subscribe newsletter.";
		$data['success'] = '1';
		}
		echo json_encode($data);
	}

	public function thanks(){
		$this->load->view("front/thanks");
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

	function get_history(){
		$data['result'] = $this->Api_model->get_web_trip();
		$data['search_radio'] = $this->input->post('search_radio') ? $this->input->post('search_radio') : 'booking_date';
		$data['booking_from'] = $this->input->post('booking_from') ? $this->input->post('booking_from') : '';
		$data['booking_to'] = $this->input->post('booking_from') ? $this->input->post('booking_to') : '';
		$data['travel_from'] = $this->input->post('travel_from') ? $this->input->post('travel_from') : '';
		$data['travel_to'] = $this->input->post('travel_to') ? $this->input->post('travel_to') : '';
		$this->load->view("front/account/trips", $data);
	}

	function get_driver_history(){
		$data['result'] = $this->Api_model->get_driver_web_trip();
		$data['search_radio'] = $this->input->post('search_radio') ? $this->input->post('search_radio') : 'booking_date';
		$data['booking_from'] = $this->input->post('booking_from') ? $this->input->post('booking_from') : '';
		$data['booking_to'] = $this->input->post('booking_from') ? $this->input->post('booking_to') : '';
		$data['travel_from'] = $this->input->post('travel_from') ? $this->input->post('travel_from') : '';
		$data['travel_to'] = $this->input->post('travel_to') ? $this->input->post('travel_to') : '';
		$this->load->view("front/account/trips", $data);
	}

	function get_outstat(){
		$id = $this->input->get('id');
		$query = $this->Api_model->get_outstat($id);
		echo json_encode($query->row());
	}

	function update_out(){
		$data->name = $this->input->post('full_name');
		$data->mobile = $this->input->post('mobile');
		$data->comment = $this->input->post('comment');

		$query = $this->Api_model->update_out(json_encode($data));
		if($query){
			$this->session->set_flashdata('msg','Updated successfully');
		 	$this->session->set_flashdata('is_success','1');
		} else{
			$this->session->set_flashdata('msg','Error, Please Try After Sometime');
		 	$this->session->set_flashdata('is_success','0');
		}

		redirect('account/get_history');
	}

	function detail(){
		$data['result'] = '';
		$this->load->view('front/account/view', $data);
	}
	
	function outstationtrip(){
		$data['result'] = '';
		$this->load->view('front/account/outstationtrip', $data);
	}
	
	
	function outstationtripadd(){
	   	$this->form_validation->set_rules('goingto', 'Going To', 'trim|required');
		$this->form_validation->set_rules('goingfrom', 'Going From', 'trim|required');
		$this->form_validation->set_rules('fare', 'Offer Fare', 'trim|required');
		$this->form_validation->set_rules('datee', 'Date', 'trim');
		if($this->form_validation->run()==FALSE){
			 $this->session->set_flashdata('success', "0");
			 $this->session->set_flashdata('msg', validation_errors());
		}
		else{
		$query = $this->Api_model->outstationtripadd();
		if($query){
			$this->session->set_flashdata('msg','Updated successfully');
		 	$this->session->set_flashdata('is_success','1');
		} else{
			$this->session->set_flashdata('msg','Error, Please Try After Sometime');
		 	$this->session->set_flashdata('is_success','0');
		}
		}

		redirect('account/outstationtrip');
	}
}
