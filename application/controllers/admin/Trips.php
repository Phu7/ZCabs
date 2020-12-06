<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Trips extends CI_Controller {

	public function __construct() {
        parent::__construct();
     $this->load->model('admin/Trips_model');
	 $this->load->library('form_validation');
	}



	public function index(){
		$data['result'] = $this->Trips_model->get_trips();
			if ($this->admin->getInfo()){
				$info = explode('--', $this->admin->getInfo());
				$data['info'] = $info[1];
				$data['info_type'] = $info[0];
			}
			else {
				$data['info'] = '';
				$data['info_type'] = '';
			}
		$this->load->view('admin/trips/trips_list',$data);
	}

	public function local(){
		$data['result'] = $this->Trips_model->get_locals();
			if ($this->admin->getInfo()){
				$info = explode('--', $this->admin->getInfo());
				$data['info'] = $info[1];
				$data['info_type'] = $info[0];
			}
			else {
				$data['info'] = '';
				$data['info_type'] = '';
			}
		$this->load->view('admin/trips/trips_list',$data);
	}

	public function sight(){
		$data['result'] = $this->Trips_model->get_sights();
			if ($this->admin->getInfo()){
				$info = explode('--', $this->admin->getInfo());
				$data['info'] = $info[1];
				$data['info_type'] = $info[0];
			}
			else {
				$data['info'] = '';
				$data['info_type'] = '';
			}
		$this->load->view('admin/trips/trips_list',$data);
	}

	public function out(){
		$data['result'] = $this->Trips_model->get_outs();
			if ($this->admin->getInfo()){
				$info = explode('--', $this->admin->getInfo());
				$data['info'] = $info[1];
				$data['info_type'] = $info[0];
			}
			else {
				$data['info'] = '';
				$data['info_type'] = '';
			}
		$this->load->view('admin/trips/trips_list',$data);
	}

	public function cancels(){
		$data['result'] = $this->Trips_model->get_cancels();
			if ($this->admin->getInfo()){
				$info = explode('--', $this->admin->getInfo());
				$data['info'] = $info[1];
				$data['info_type'] = $info[0];
			}
			else {
				$data['info'] = '';
				$data['info_type'] = '';
			}
		$this->load->view('admin/trips/trips_list',$data);
	}

	public function cancel(){
		$id = $this->input->get('id');
		$this->db->query("UPDATE outstation SET status = 7 WHERE id = '" . (int)$id . "'");
		redirect('admin/trips/cancels');
	}

	public function detail(){
		$data['drivers'] = $this->Trips_model->get_drivers();
		$id = $this->input->get('id');
		$data['result'] = $this->Trips_model->detail($id)->row();
		$this->load->view("admin/trips/detail", $data);
	}

	public function manage_status(){
		$id = $this->input->get('id');
		$status = $this->input->get('status');
		$query = $this->Trips_model->manage_status($id,$status);
		if($query){
			$this->session->set_userdata('info', "1--Successfully done");
		}
		else{
			$this->session->set_userdata('info', "2--Error!!!");
		}
		redirect("admin/trips/detail?id=".$id);
	}

	public function accept(){
		$id = $this->input->post("id");
		$driver = $this->input->post("driver");
		$price = $this->input->post("price");
		$query = $this->Trips_model->accept($id, $driver, $price);
		if($query){
			$this->session->set_userdata('info', "1--Successfully done");
			/*  Send sms */
		}
		else{
			$this->session->set_userdata('info', "2--Error!!!");
		}
		redirect("admin/trips/detail?id=".$id);
	}

	public function delete(){
		$ids = implode(',', $this->input->post('check_list'));
		$query = $this->Trips_model->delete($ids);
		if($query){
				$this->session->set_userdata('info', "1--Successfully deleted");
			}
			else{
				$this->session->set_userdata('info', "2--Error!!!");
			}
		redirect('admin/trips');
	}



}
