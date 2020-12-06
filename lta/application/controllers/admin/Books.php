<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Books extends CI_Controller {

	public function __construct() {
        parent::__construct();
     $this->load->model('admin/Books_model');
	 $this->load->library('form_validation');
	}



	public function index(){
		$data['result'] = $this->Books_model->get_books();
			if ($this->admin->getInfo()){
				$info = explode('--', $this->admin->getInfo());
				$data['info'] = $info[1];
				$data['info_type'] = $info[0];
			}
			else {
				$data['info'] = '';
				$data['info_type'] = '';
			}
		$this->load->view('admin/books/books_list',$data);
	}



	public function add(){
		if($this->input->get('id')){
			$query = $this->Books_model->get_book($this->input->get('id'))->row();
				$data['id'] = $query->book_id;
				$data['name'] = $query->book_name;
				$data['titleurl'] = $query->titleurl;
				$data['amazon'] = $query->amazon;
				$data['writer'] = $query->book_writer;
				$data['metadescription'] = $query->metadescription;
				$data['metakeyword'] = $query->metakeyword;
				$data['o_img'] = $query->image;
				$data['status'] = $query->status;
		}
		else{
			$data['id'] = "";
			$data['name'] = "";
			$data['amazon'] = "";
			$data['titleurl'] = "";
			$data['writer'] = "";
			$data['metadescription'] = "";
			$data['o_img'] = "";
			$data['metakeyword'] = "";
			$data['status'] = "";
		}
		$this->load->view('admin/books/book_form',$data);
	}

	public function add_book(){
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		if($this->form_validation->run()==FALSE){
			$this->session->set_userdata('info', "2--".validation_errors());
		}
		else{
			if($_FILES['image']['name']){
				$con['upload_path']   = './booksimages/';
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
				$query = $this->Books_model->edit($image);
			}
			else{
				$query = $this->Books_model->add($image);
			}
			if($query){
				$this->session->set_userdata('info', "1--Successfully done");
			}
			else{
				$this->session->set_userdata('info', "2--Error!!!");
			}
		}
		redirect('admin/books');
	}


	public function delete(){
		$id = implode(',',$this->input->post('check_list'));
		$query = $this->Books_model->delete($id);
		if($query){
				$this->session->set_userdata('info', "1--Successfully deleted");
			}
			else{
				$this->session->set_userdata('info', "2--Error!!!");
			}
		redirect('admin/books');
	}
}
