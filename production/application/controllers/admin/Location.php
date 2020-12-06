<?php  defined('BASEPATH') OR exit('No direct script access allowed');

	class Location extends CI_Controller {
	
		public function __construct() {
			parent::__construct();
		 $this->load->model('admin/Location_model');
		 $this->load->library('form_validation');
		}
		
		public function state(){
			$data['result'] = $this->Location_model->get_states();
			if ($this->admin->getInfo()){
				$info = explode('--', $this->admin->getInfo());
				$data['info'] = $info[1];
				$data['info_type'] = $info[0];
			} else {
				$data['info'] = '';
				$data['info_type'] = '';
			}
			$this->load->view('admin/location/state_list',$data);
		}
		
		public function state_add(){
			if($this->input->get('id')){
				$query = $this->Location_model->get_state_by_id($this->input->get('id'));
				foreach($query->result() as $query){
				$data['id'] = $query->id;
				$data['name'] = $query->name;
				$data['status'] = $query->status;
				}
			}
			else{
				$data['id'] = "";
				$data['name'] = "";
				$data['status'] = "";
			}
			$this->load->view('admin/location/state_form',$data);
		}
		
		public function add_state(){
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			if($this->form_validation->run()==FALSE){
				 $this->session->set_userdata('info', "2--".validation_errors());
			}
			else{
			if($this->input->post('id')){
				$query = $this->Location_model->edit_state();
			}
			else{
				$query = $this->Location_model->add_state();
			}
			if($query){
					$this->session->set_userdata('info', "1--Successfully done");
				}
				else{
					$this->session->set_userdata('info', "2--Error!!!");
				}
			redirect('admin/location/state');
		}
		}
		
		public function delete_state(){
			$id = implode(',',$this->input->post('check_list'));
			$query = $this->Location_model->delete_state($id);
			if($query){
					$this->session->set_userdata('info', "1--Successfully deleted");
				}
				else{
					$this->session->set_userdata('info', "2--Error!!!");
				}
			redirect('admin/location/state');
		}/*End state*/
		
		public function city(){
			if($this->input->get('state')){
				$state = $this->input->get('state');
			}
			else{
				$state = false;
			}
			$data['result'] = $this->Location_model->get_cities($state);
			$data['state'] = $this->Location_model->get_states();
			if ($this->admin->getInfo()){
				$info = explode('--', $this->admin->getInfo());
				$data['info'] = $info[1];
				$data['info_type'] = $info[0];
			} else {
				$data['info'] = '';
				$data['info_type'] = '';
			}
			$this->load->view('admin/location/city_list',$data);
		}
		
		public function city_add(){
			$data['state'] = $this->Location_model->get_states();
			if($this->input->get('id')){
				$query = $this->Location_model->get_city_by_id($this->input->get('id'));
				foreach($query->result() as $query){
				$data['id'] = $query->id;
				$data['state_id'] = $query->state_id;
				$data['name'] = $query->name;
				$data['status'] = $query->status;
				}
			}
			else{
				$data['id'] = "";
				$data['state_id'] = "";
				$data['name'] = "";
				$data['status'] = "";
			}
			$this->load->view('admin/location/city_form',$data);
		}
		
		public function add_city(){
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			if($this->form_validation->run()==FALSE){
				 $this->session->set_userdata('info', "2--".validation_errors());
			}
			else{
			if($this->input->post('id')){
				$query = $this->Location_model->edit_city();
			}
			else{
				$query = $this->Location_model->add_city();
			}
			if($query){
					$this->session->set_userdata('info', "1--Successfully done");
				}
				else{
					$this->session->set_userdata('info', "2--Error!!!");
				}
			redirect('admin/location/city');
		}
		}
		
		public function delete_city(){
			$id = implode(',',$this->input->post('check_list'));
			$query = $this->Location_model->delete_city($id);
			if($query){
					$this->session->set_userdata('info', "1--Successfully deleted");
				}
				else{
					$this->session->set_userdata('info', "2--Error!!!");
				}
			redirect('admin/location/city');
		}/*end city*/
		
		public function get_city_by_state(){
			$state_id = $this->input->post("state_id"); 
			$query = $this->Location_model->get_city_by_state($state_id);
			$data = '';
			foreach($query->result() as $query){
				$data .= '<option value="' . $query->id . '">' . $query->name . '</option>';		
			}
			echo $data;
		}
		
}