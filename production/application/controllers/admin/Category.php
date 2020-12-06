<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

		public function __construct() {
			parent::__construct();
			$this->load->model('admin/Category_model');
			$this->load->library('form_validation');
		}
		
		public function index(){
		$data['result'] = $this->Category_model->get_category();
		if ($this->admin->getInfo()){
			$info = explode('--', $this->admin->getInfo());
			$data['info'] = $info[1];
			$data['info_type'] = $info[0];
		} else {
			$data['info'] = '';
			$data['info_type'] = '';
		}
		$this->load->view('admin/category/category_list',$data);
	}
	
	public function add(){
		if($this->input->get('id')){
			$query = $this->Category_model->get_category_by_id($this->input->get('id'));
			foreach($query->result() as $query){
			$data['id'] = $query->id;
			$data['seo'] = $query->slug;
			$data['name'] = $query->name;
			$data['description'] = $query->description;
			$data['metatitle'] = $query->metatitle;
			$data['metadescription'] = $query->metadescription;
			$data['metakeyword'] = $query->metakeyword;
			$data['o_img'] = $query->image;
			$data['parent_id'] = $query->parent_id;
			$data['status'] = $query->status;
		}
		}
		else{
			$data['id'] = "";
			$data['seo'] = "";
			$data['name'] = "";
			$data['description'] = "";
			$data['metatitle'] = "";
			$data['metadescription'] = "";
			$data['o_img'] = "";
			$data['metakeyword'] = "";
			$data['parent_id'] = "";
			$data['status'] = "";
		}
		$data['parent'] = $this->Category_model->get_category();
		$this->load->view('admin/category/category_form',$data);
	}
	
	public function add_category(){
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
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
				$image = $this->input->post('o_img');
			}
		if($this->input->post('id')){
			$query = $this->Category_model->edit($image);
		}
		else{
			$query = $this->Category_model->add($image);
		}
		if($query){
				$this->session->set_userdata('info', "1--Successfully done");
			}
			else{
				$this->session->set_userdata('info', "2--Error!!!");
			}
		redirect('admin/category');
	}
	}
	
	public function delete(){
		$ids = $this->input->post('checklist');
		$query = $this->Category_model->delete($ids);
		if($query){
				$this->session->set_userdata('info', "1--Successfully deleted");
			}
			else{
				$this->session->set_userdata('info', "2--Error!!!");
			}
		redirect('admin/category');
	}
	
}
