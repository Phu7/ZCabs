<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Commision extends CI_Controller {

	public function __construct() {
        parent::__construct();
     $this->load->model('admin/Commision_model');
     $this->load->model('admin/Driver_commision_model');
	 $this->load->library('form_validation');
	}

	public function add(){
			$query = $this->Commision_model->get_commision_by_id($id = 1);
			foreach($query->result() as $query){
				$data['id'] = $query->id;
				$data['rate'] = $query->rate;
			}
			$this->load->view('admin/commision/commision_form',$data);
	}

	public function driver_commision(){
			$query = $this->Driver_commision_model->get_commision_by_id($id = 1);
			foreach($query->result() as $query){
				$data['id'] = $query->id;
				$data['rate'] = $query->rate;
			}
			$this->load->view('admin/commision/driver_commision_form',$data);
	}

	public function add_commision(){
		$this->form_validation->set_rules('rate', 'Rate', 'trim|required');
		if($this->form_validation->run()==FALSE){
			$this->session->set_userdata('info', "2--".validation_errors());
		}
		else{
				$query = $this->Commision_model->edit();

			if($query){
				$this->session->set_userdata('info', "1--Successfully done");
			}
			else{
				$this->session->set_userdata('info', "2--Error!!!");
			}
		}
		redirect('admin/commision/add');
	}

	public function add_driver_commision(){
		$this->form_validation->set_rules('rate', 'Rate', 'trim|required');
		if($this->form_validation->run()==FALSE){
			$this->session->set_userdata('info', "2--".validation_errors());
		}
		else{
				$query = $this->Driver_commision_model->edit();

			if($query){
				$this->session->set_userdata('info', "1--Successfully done");
			}
			else{
				$this->session->set_userdata('info', "2--Error!!!");
			}
		}
		redirect('admin/commision/add');
	}
}
