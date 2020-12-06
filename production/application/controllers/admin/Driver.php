<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Driver extends CI_Controller {

		public function __construct() {
			parent::__construct();
			$this->load->model('admin/Driver_model');
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
		$data['result'] = $this->Driver_model->get_drivers();
		$this->load->view('admin/driver/driver_list',$data);
	}

	public function add(){
		if($this->input->get('id')){
			$query = $this->Driver_model->get_customer($this->input->get('id'));
			foreach($query->result() as $query){
				$data['id'] = $query->id;
				$data['first_name'] = $query->first_name;
				$data['last_name'] = $query->last_name;
				$data['email'] = $query->email;
				$data['mobile'] = $query->mobile;
				$data['address'] = $query->address;
				$data['city'] = $query->city;
				$data['state'] = $query->state;
				$data['zip'] = $query->zip;
				$data['country'] = $query->country;
				$data['dob'] = $query->dob;
				$data['gender'] = $query->gender;
				$data['vehicle_type'] = $query->vehicle_type;
				$data['vehicle_name'] = $query->vehicle_name;
				$data['vehicle_number'] = $query->vehicle_number;
				$data['vehicle_model'] = $query->vehicle_model;
				$data['old_image'] = $query->old_image;
				$data['status'] = $query->status;
			}
		}
		else{
			$data['id'] = "";
			$data['first_name'] = "";
			$data['last_name'] = "";
			$data['email'] = "";
			$data['mobile'] = "";
			$data['address'] = "";
			$data['dob'] = "";
			$data['gender'] = "";
			$data['city'] = "";
			$data['state'] = "";
			$data['zip'] = "";
			$data['country'] = "";
			$data['vehicle_type'] = "";
			$data['vehicle_name'] = "";
			$data['vehicle_number'] = "";
			$data['vehicle_model'] = "";
			$data['old_image'] = "";
			$data['status'] = "";
		}
		$this->load->view('admin/driver/driver_form',$data);
	}

	public function add_driver(){
		$this->form_validation->set_rules('first_name', 'Name', 'trim|required');
		if($this->form_validation->run()==FALSE){
			$this->session->set_userdata('info', "2--".validation_errors());
		}
		else{
			if($_FILES['image']['name']){
			$con['upload_path']   = './uploads/';
         $con['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
         $con['max_size']      = 0;
         $con['max_width']     = 0;
         $con['max_height']    = 0;
		 $con['max_filename'] = '50';
         $con['encrypt_name'] = TRUE;
         $this->load->library('upload', $con);
				if (!$this->upload->do_upload('image')) {
                   echo $this->upload->display_errors();
				   exit;
                } else {
            $image_data = $this->upload->data();
			$image = "uploads/".$image_data['file_name'];
               }
		}
			else{
				$image = $this->input->post('old_image');
			}
			if($this->input->post('id')){
				$query = $this->Driver_model->edit($image);
			}
			else{
				$query = $this->Driver_model->add($image);
			}
			if($query){
				$this->session->set_userdata('info', "1--Successfully done");
			}
			else{
				$this->session->set_userdata('info', "2--Error!!!");
			}
		}
		redirect('admin/driver');
	}

	public function update(){
		$query = $this->Driver_model->update($this->input->get('id'), $this->input->get('status'));
		if($query){
			$this->session->set_userdata('info', "1--Successfully done");
		}
		else{
			$this->session->set_userdata('info', "2--Error!!!");
		}
		redirect('admin/driver');
	}



	public function delete(){
		$id = implode(',',$this->input->post('check_list'));
		$query = $this->Driver_model->delete($id);
		if($query){
				$this->session->set_userdata('info', "1--Successfully deleted");
			}
			else{
				$this->session->set_userdata('info', "2--Error!!!");
			}
		redirect('admin/driver');
	}

	public function detail(){
		$id = $this->input->get('id');
		$data['result'] = $this->Driver_model->get_driver($id);
		$this->load->view('admin/driver/driver_detail', $data);
	}

}
