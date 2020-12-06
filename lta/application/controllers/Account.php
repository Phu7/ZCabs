<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	public function __construct() {
   parent::__construct();
   $this->load->model('Account_model');
	 $this->load->library('form_validation');
	}


	public function index(){
		if(!$this->customer->isLogged()){
			redirect("/");
		}
		$data['result'] = $this->Account_model->get_profile();
		$this->load->view("account/profile", $data);
	}

	public function register_form(){
		$this->load->view("account/login");
	}

	public function register(){
		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user.user_email]|xss_clean');
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|is_unique[user.contact1]|xss_clean');
    $this->form_validation->set_rules('password', 'Password', 'trim|xss_clean');
    if($this->form_validation->run()==FALSE){
      $this->session->set_flashdata('info', "2--".validation_errors());
			redirect("account/register_form");
    } else{
      $query = $this->Account_model->register();
			$this->send_otp('register', $query, $this->input->post('mobile'));
      if($query){
        $this->session->set_flashdata('info', "1--Successfully done");
      }
      else{
        $this->session->set_flashdata('info', "2--Error!!!");
      }
			redirect("account/otp_form");
    }
	}

	private function send_otp($method, $id, $mobile){
		$this->load->helper('string');
		$otp = random_string('nozero', 6);
		$data = array("otp" => $otp, "id" => $id, "mobile" => $mobile);
		if($method == 'register'){
			$msg = 'Thank you to register with us. Your verification OTP is ' . $otp;
			$this->session->set_userdata("register_verify", $data);
		} elseif($method == 'login'){
			$this->session->set_userdata("login_verify", $data);
			$msg = 'Please Verify your mobile Number, Your verification OTP is ' . $otp;
		} elseif($method == 'forget'){
			$this->session->set_userdata("forget_verify", $data);
			$msg = 'Please Verify your mobile Number, Your verification OTP is ' . $otp;
		} else{
			return false;
		}
	}

	public function login(){
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
    if($this->form_validation->run()==FALSE){
      $this->session->set_flashdata('info', "2--".validation_errors());
    } else{
			if($this->Account_model->isExist()->num_rows()){
				if($this->customer->login($this->input->post('username'), $this->input->post('password'))){
					redirect('account');
				} else{
					$q = $this->Account_model->isExist();
					$method = 'login';
					$mobile = $q->contact1;
					$id = $q->id;
					$this->send_otp($method, $id, $mobile);
					$this->session->set_flashdata('info', "1--An Otp has been sent to user registered mobile number.");
					redirect("account/otp_form");
				}
			} else{
				$this->session->set_flashdata('info', "2--Username Or Password did not match.");
			}
		}
	}

	public function update(){
		if(!$this->customer->isLogged()){
			redirect("/");
		}
		$data['result'] = $this->Account_model->get_profile();
		$this->load->view("account/update", $data);
	}

	public function logout(){
		if(!$this->customer->isLogged()){
			redirect("/");
		}
	}

	 function resend_otp(){
		 if($this->session->userdata("register_verify")){
 			$id = $this->session->userdata("register_verify")['id'];
			$mobile = $this->session->userdata("register_verify")['mobile'];
			$method = 'register';
	 		} elseif($this->session->userdata("login_verify")){
				$id = $this->session->userdata("login_verify")['id'];
				$mobile = $this->session->userdata("login_verify")['mobile'];
				$method = 'login';
	 		} elseif($this->session->userdata("forget_verify")){
				$id = $this->session->userdata("forget_verify")['id'];
				$mobile = $this->session->userdata("forget_verify")['mobile'];
				$method = 'forget';
	 		} else{
	 			return false;
	 		}
			$this->send_otp($method, $id, $mobile);
	  }

	public function otp_form(){
		$this->load->view("account/otp_form");
	}

	public function verify_user(){
		if($this->session->userdata("register_verify")){
			$id = $this->session->userdata("register_verify")['id'];
		} elseif($this->session->userdata("login_verify")){
			$id = $this->session->userdata("login_verify")['id'];
		} else{
			return false;
		}
		$query = $this->Account_model->verify_user($id);
		return true;
	}

	public function change_password(){
		if(!$this->customer->isLogged()){
			redirect("/");
		}
		$this->load->view("account/change_password");
	}

	public function submit_change_password(){
		if(!$this->customer->isLogged()){
			redirect("/");
		}
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]|xss_clean');
    if($this->form_validation->run()==FALSE){
      $this->session->set_flashdata('info', "2--".validation_errors());
    } else{
			if($this->Account_model->check_password()->num_rows()){
				$query = $this->Account_model->change_password();
				if($query){
					$this->session->set_flashdata('info', "1--Password changed successfully");
				} else{
					$this->session->set_flashdata('info', "2--Some error occure");
				}
			redirect("account/change_password");
			}
		}
	}

	public function forget_password(){
		$this->load->view("account/forget_password");
	}

	public function send_forget_password_key(){
		$query = $this->Account_model->get_id_by_mobile();
		if($query->num_rows()){
			$method = 'forget';
			$id = $query->row()->id;
			$mobile = $this->input->post('mobile');
			$this->send_otp($method, $id, $mobile);
			redirect("account/otp_form");
		} else{
			redirect("account/forget_password");
		}
	}

	public function check_otp(){
		$this->load->view("account/check_otp");
	}

	public function set_new_password_form(){
		if($this->session->userdata('forget_verify')['otp'] == $this->input->post('otp')){
			$this->load->view("account/new_password");
		} else{
			$this->session->set_flashdata('info', "1--OTP did not match.");
			redirect("account/check_otp");
		}
	}

	public function set_new_password(){
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]|xss_clean');
		if($this->form_validation->run()==FALSE){
			$this->session->set_flashdata('info', "2--".validation_errors());
		} else{
			$query = $this->Account_model->set_password();
			if($query){
				$this->session->unset('forget_verify');
				$this->session->set_flashdata('info', "1--Your password updated successfully");
			} else{
				$this->session->set_flashdata('info', "2--Some Error Occure");
			}
		}
		redirect("account/login");
	}

}
