<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sight_seen_place extends CI_Controller {

	public function __construct() {
        parent::__construct();
     $this->load->model('admin/Sight_seen_place_model');
	 $this->load->library('form_validation');
	}

	public function index(){
		$data['result'] = $this->Sight_seen_place_model->get_products();
			if ($this->admin->getInfo()){
				$info = explode('--', $this->admin->getInfo());
				$data['info'] = $info[1];
				$data['info_type'] = $info[0];
			}
			else {
				$data['info'] = '';
				$data['info_type'] = '';
			}
		$this->load->view('admin/product/product_list',$data);
	}

	

	public function add(){
		if($this->input->get('id')){
			$tid = $this->input->get('id');
		}
		elseif($this->input->get('cid')){
			$tid = $this->input->get('cid');
		}
		else{
			$tid="";
		}
		if($tid){
			$query = $this->Sight_seen_place_model->get_product_by_id($tid);
			foreach($query->result() as $query){
				if($this->input->get('id')){
				$data['id'] = $query->id;								$data['package_id'] = $query->package_id;
				$data['name'] = $query->name;
				$data['city'] = $query->city;
				$data['status'] = $query->status;
				}
				else{
				$data['id'] = "";								$data['package_id'] = "";
				$data['name'] = "";								$data['city'] = "";				$data['status'] = "1";	
				}
		$data['packages'] = $this->Sight_seen_place_model->get_packages();
		$data['product_image'] = $this->Sight_seen_place_model->sight_image($this->input->get('id'));
		$this->load->view('admin/product/product_form',$data);
	}

	public function add_product(){
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		if($this->form_validation->run()==FALSE){
			$this->session->set_userdata('info', "2--".validation_errors());
		}
		else{
			if($this->input->post('id')){
				$query = $this->Product_model->edit();
			}
			else{
				$query = $this->Product_model->add();
			}
			if($query){
				$this->session->set_userdata('info', "1--Successfully done");
			}
			else{
				$this->session->set_userdata('info', "2--Error!!!");
			}
		}
		redirect('admin/product');
	}

	
	public function delete(){
		$id = implode(',',$this->input->post('check_list'));
		$query = $this->Product_model->delete($id);
		if($query){
				$this->session->set_userdata('info', "1--Successfully deleted");
			}
			else{
				$this->session->set_userdata('info', "2--Error!!!");
			}
		redirect('admin/product');
	}
}