<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Driver_wd_req extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('admin/Driver_wd_req_model');
		$this->load->library('form_validation');
	}

	public function index(){
		if ($this->admin->getInfo()){
			$info = explode('--', $this->admin->getInfo());
			$data['info'] = $info[1];
			$data['info_type'] = $info[0];
		} else {
			$data['info'] = '';
			$data['info_type'] = '';
		}
		$data['result'] = $this->Driver_wd_req_model->get_wds();
		$this->load->view('admin/wd/wd_list',$data);
	}

	public function update(){
		$query = $this->Driver_wd_req_model->update($this->input->get('id'), $this->input->get('status'));
		if($query){
			$this->session->set_userdata('info', "1--Successfully done");
		}
		else{
			$this->session->set_userdata('info', "2--Error!!!");
		}
		redirect('admin/wd_req');
	}

	public function success(){
		$id = $this->input->get('id');
		$data['result'] = $this->Driver_wd_req_model->get_wd($id)->row();
		$this->load->view('admin/wd/wd_success',$data);
	}

	public function suc(){
		$query = $this->Driver_wd_req_model->update_transaction();
		if($query){
			$this->session->set_userdata('info', "1--Successfully done");
		}
		else{
			$this->session->set_userdata('info', "2--Error!!!");
		}
		redirect('admin/wd_req');
	}


}
