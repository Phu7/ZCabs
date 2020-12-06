<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Topics extends CI_Controller {

	public function __construct() {
        parent::__construct();
     $this->load->model('admin/Topics_model');
		 $this->load->model('admin/Books_model');
	 	 $this->load->library('form_validation');
	}



	public function index(){
		$data['result'] = $this->Topics_model->get_topics();
			if ($this->admin->getInfo()){
				$info = explode('--', $this->admin->getInfo());
				$data['info'] = $info[1];
				$data['info_type'] = $info[0];
			}
			else {
				$data['info'] = '';
				$data['info_type'] = '';
			}
		$this->load->view('admin/topics/topics_list',$data);
	}



	public function add(){
		if($this->input->get('id')){
			$query = $this->Topics_model->get_topic($this->input->get('id'))->row();
			$data['id'] = $query->id;
			$data['topicname'] = $query->topicname;
			$data['book_id'] = $query->book_id;
			$data['titleurl'] = $query->titleurl;
			$data['status'] = $query->status;
			$data['metakeyword'] = $query->metakeyword;
			$data['metadescription'] = $query->metadescription;
			}
		else{
			$data['id'] = "";
			$data['topicname'] = "";
			$data['book_id'] = "";
			$data['titleurl'] = "";
			$data['status'] = "";
			$data['metakeyword'] = "";
			$data['metadescription'] = "";
		}
		$data['books'] = $this->Books_model->get_books();
		$this->load->view('admin/topics/topic_form',$data);
	}

	public function add_topic(){
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
				$image = $this->input->post('o_image');
			}
			if($this->input->post('id')){
				$query = $this->Topics_model->edit($image);
			}
			else{
				$query = $this->Topics_model->add($image);
			}
			if($query){
				$this->session->set_userdata('info', "1--Successfully done");
			}
			else{
				$this->session->set_userdata('info', "2--Error!!!");
			}
		}
		redirect('admin/topics');
	}


	public function delete(){
		$id = implode(',',$this->input->post('check_list'));
		$query = $this->Topics_model->delete($id);
		if($query){
				$this->session->set_userdata('info', "1--Successfully deleted");
			}
			else{
				$this->session->set_userdata('info', "2--Error!!!");
			}
		redirect('admin/topics');
	}

	function topic_by_book(){
		$book_id = $this->input->post('book_id');
		$query = $this->Topics_model->get_topic_by_book($book_id);
		if($query->num_rows()){
			$view = '<option value="">--Select a Topic--</option>';
			foreach($query->result() as $query){
				$view .= '<option value="' . $query->topic_id . '" >' . $query->topicname . '</option>';
			}
		}
		else{
			$view = '<option value="">--No topic to choose--</option>';
		}
		echo $view;
	}

}
