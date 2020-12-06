<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Out_reserved extends CI_Controller {

	public function __construct() {
        parent::__construct();
     $this->load->model('admin/Out_reserved_model');
	 $this->load->library('form_validation');
	}



	public function index(){
		$data['result'] = $this->Out_reserved_model->get_out_reserved();
			if ($this->admin->getInfo()){
				$info = explode('--', $this->admin->getInfo());
				$data['info'] = $info[1];
				$data['info_type'] = $info[0];
			}
			else {
				$data['info'] = '';
				$data['info_type'] = '';
			}
		$this->load->view('admin/out_rvsd/out_rvsd_list',$data);
	}



	public function add(){
		if($this->input->get('id')){
			$query = $this->Out_reserved_model->get_out_reserved_by_id($this->input->get('id'));
			foreach($query->result() as $query){
				$data['id'] = $query->id;
				$data['from'] = $query->from;
				$data['to'] = $query->to;
				$data['fare'] = $query->fare;
				$data['name'] = $query->vehicle_name;
				$data['amenities'] = $query->amenities;
				$data['o_img'] = $query->image;
				$data['pickup_point'] = $query->pickup_point;
				$data['seats'] = $query->seats;
				$data['drop_point'] = $query->drop_point;
				$data['status'] = $query->status;
			}
		}
		else{
			$data['id'] = "";
			$data['from'] = "";
			$data['seats'] = "";
			$data['pickup_point'] = "";
			$data['drop_point'] = "";
			$data['amenities'] = "";
			$data['to'] = "";
			$data['fare'] = "";
			$data['name'] = "";
			$data['o_img'] = "";
			$data['status'] = "";
		}
		$data['locations'] = $this->Out_reserved_model->get_location();
		$this->load->view('admin/out_rvsd/out_rvsd_form',$data);
	}

	public function add_out_reserved(){
		$this->form_validation->set_rules('vehicle_name', 'Name', 'trim|required');
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
                }
				else {
					$image_data = $this->upload->data();
					$image = "uploads/".$image_data['file_name'];
               }
			}
			else{
				$image = $this->input->post('o_img');
			}
			if($this->input->post('id')){
				$query = $this->Out_reserved_model->edit($image);
			}
			else{
				$query = $this->Out_reserved_model->add($image);
			}
			if($query){
				$this->session->set_userdata('info', "1--Successfully done");
			}
			else{
				$this->session->set_userdata('info', "2--Error!!!");
			}
		}
		redirect('admin/out_reserved');
	}


	public function delete(){
		$id = implode(',',$this->input->post('check_list'));
		$query = $this->Out_reserved_model->delete($id);
		if($query){
				$this->session->set_userdata('info', "1--Successfully deleted");
			}
			else{
				$this->session->set_userdata('info', "2--Error!!!");
			}
		redirect('admin/out_reserved');
	}
}
