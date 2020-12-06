<?php  defined('BASEPATH') OR exit('No direct script access allowed');

	class Sight_location extends CI_Controller {
	
		public function __construct() {
			parent::__construct();
		 $this->load->model('admin/Sight_location_model');
		 $this->load->library('form_validation');
		}
		
		
		
		public function city(){
			if($this->input->get('state')){
				$state = $this->input->get('state');
			}
			else{
				$state = false;
			}
			$data['result'] = $this->Sight_location_model->get_cities($state);
			$data['state'] = $this->Sight_location_model->get_states();
			if ($this->admin->getInfo()){
				$info = explode('--', $this->admin->getInfo());
				$data['info'] = $info[1];
				$data['info_type'] = $info[0];
			} else {
				$data['info'] = '';
				$data['info_type'] = '';
			}
			$this->load->view('admin/sight_location/city_list',$data);
		}
		
		public function city_add(){
			$data['state'] = $this->Sight_location_model->get_states();
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
			$this->load->view('admin/sight_location/city_form',$data);
		}
		
		public function add_city(){
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			if($this->form_validation->run()==FALSE){
				 $this->session->set_userdata('info', "2--".validation_errors());
			}
			else{
			if($this->input->post('id')){
				$query = $this->Sight_location_model->edit_city();
			}
			else{
				$query = $this->Sight_location_model->add_city();
			}
			if($query){
					$this->session->set_userdata('info', "1--Successfully done");
				}
				else{
					$this->session->set_userdata('info', "2--Error!!!");
				}
			redirect('admin/sight_location/city');
		}
		}
		
		public function delete_city(){
			$id = implode(',',$this->input->post('check_list'));
			$query = $this->Sight_location_model->delete_city($id);
			if($query){
					$this->session->set_userdata('info', "1--Successfully deleted");
				}
				else{
					$this->session->set_userdata('info', "2--Error!!!");
				}
			redirect('admin/sight_location/city');
		}/*end city*/
		
		public function get_city_by_state(){
			$state_id = $this->input->post("state_id"); 
			$query = $this->Sight_location_model->get_city_by_state($state_id);
			$data = '';
			foreach($query->result() as $query){
				$data .= '<option value="' . $query->id . '">' . $query->name . '</option>';		
			}
			echo $data;
		}
		
}