<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function __construct() {
        parent::__construct();
     $this->load->model('admin/Pages_model');
	 $this->load->library('form_validation');
	}



	public function index(){
		$data['result'] = $this->Pages_model->get_pages();
			if ($this->admin->getInfo()){
				$info = explode('--', $this->admin->getInfo());
				$data['info'] = $info[1];
				$data['info_type'] = $info[0];
			}
			else {
				$data['info'] = '';
				$data['info_type'] = '';
			}
		$this->load->view('admin/pages/pages_list',$data);
	}



	public function add(){
		if($this->input->get('id')){
			$query = $this->Pages_model->get_page($this->input->get('id'))->row();
			$data['id'] = $query->page_id;
			$data['topic_id'] = $query->topic_id;
			$data['book_id'] = $query->book_id;
			$data['titleurl'] = $query->page_titleurl;
			$data['status'] = $query->status;
			$data['page_title'] = $query->page_title;
			$data['page_number'] = $query->page_number;
			$data['page_data'] = $query->page_data;
			$data['metakeyword'] = $query->metakeyword;
			$data['metadescription'] = $query->metadescription;
			}
		else{
			$data['id'] = "";
			$data['topic_id'] = "";
			$data['book_id'] = "";
			$data['titleurl'] = "";
			$data['status'] = "";
			$data['page_title'] = "";
			$data['page_number'] = "";
			$data['page_data'] = "";
			$data['metakeyword'] = "";
			$data['metadescription'] = "";
		}
		$this->load->view('admin/pages/page_form',$data);
	}

	public function add_page(){
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
				$query = $this->Pages_model->edit($image);
			}
			else{
				$query = $this->Pages_model->add($image);
			}
			if($query){
				$this->session->set_userdata('info', "1--Successfully done");
			}
			else{
				$this->session->set_userdata('info', "2--Error!!!");
			}
		}
		redirect('admin/pages');
	}


	public function delete(){
		$id = implode(',',$this->input->post('check_list'));
		$query = $this->Pages_model->delete($id);
		if($query){
				$this->session->set_userdata('info', "1--Successfully deleted");
			}
			else{
				$this->session->set_userdata('info', "2--Error!!!");
			}
		redirect('admin/pages');
	}
}
