<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sight extends CI_Controller {

	public function __construct() {
        parent::__construct();
     $this->load->model('admin/Sight_model');
	 $this->load->library('form_validation');
	}

	public function index(){
		$data['result'] = $this->Sight_model->get_sights();
			if ($this->admin->getInfo()){
				$info = explode('--', $this->admin->getInfo());
				$data['info'] = $info[1];
				$data['info_type'] = $info[0];
			}
			else {
				$data['info'] = '';
				$data['info_type'] = '';
			}
		$this->load->view('admin/sight/sight_list',$data);
	}



	public function add(){
		if($this->input->get('id')){
			$query = $this->Sight_model->get_sight_by_id($this->input->get('id'));
				foreach($query->result() as $query){
				$data['id'] = $query->id;
				$data['name'] = $query->name;
				$data['price'] = $query->price;
				$data['location_id'] = $query->location_id;
				$data['description'] = $query->description;
				$data['image'] = $query->image;
				$data['status'] = $query->status;
				$data['slug'] = $query->slug;
				$data['metatitle'] = $query->metatitle;
				$data['metakeyword'] = $query->metakeyword;
				$data['metadescription'] = $query->metadescription;
				}
			} else{
			$data['id'] = "";
			$data['name'] = "";
			$data['price'] = "";
			$data['description'] = "";
			$data['location_id'] = "";
			$data['image'] = "";
			$data['slug'] = "";
			$data['status'] = "";
			$data['metatitle'] = "";
			$data['metakeyword'] = "";
			$data['metadescription'] = "";
		}
		$data['locations'] = $this->Sight_model->get_cities();
		$data['sight_image'] = $this->Sight_model->sight_image($this->input->get('id'));
		$this->load->view('admin/sight/sight_form',$data);
	}

	public function add_sight(){
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		if($this->form_validation->run()==FALSE){
			$this->session->set_userdata('info', "2--".validation_errors());
		}
		else{
			if($this->input->post('id')){
				$query = $this->Sight_model->edit();
			}
			else{
				$query = $this->Sight_model->add();
			}
			if($query){
				$this->session->set_userdata('info', "1--Successfully done");
			}
			else{
				$this->session->set_userdata('info', "2--Error!!!");
			}
		}
		redirect('admin/sight');
	}


	public function delete(){
		$id = implode(',',$this->input->post('check_list'));
		$query = $this->Sight_model->delete($id);
		if($query){
				$this->session->set_userdata('info', "1--Successfully deleted");
			}
			else{
				$this->session->set_userdata('info', "2--Error!!!");
			}
		redirect('admin/sight');
	}
}
