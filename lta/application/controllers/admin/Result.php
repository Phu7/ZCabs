<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Result extends CI_Controller{

	 public function __construct() {
        parent::__construct();
    	$this->load->model('admin/Result_model');
		$this->load->library('form_validation');
	}

	function index(){
		if($this->admin->isLogged()){
			$data['result'] = $this->Result_model->get_results();
			$this->load->view('admin/result/result_list', $data);
		}
		else{
			redirect('admin/home');
		}
	}

	function add_form(){
		if($this->admin->isLogged()){
			if($this->input->get('id')){
			$query = $this->Result_model->get_result_by_id($this->input->get('id'))->row();
				$data['id'] = $query->id;
				$data['o_img'] = $query->image;
			 	$data['title'] = $query->title;
				$data['titleurl'] = $query->titleurl;
				$data['status'] = $query->status;
				$data['pid'] = $query->p_id;
				$data['roll'] = $query->rollno;
				$data['rank'] = $query->rank;
				$data['university'] = $query->university;
				$data['front'] = $query->front;
				$data['metakeyword'] = $query->metakeyword;
				$data['metadescription'] = $query->metadescription;
			}
			else{
				$data['id'] = "";
				$data['o_img'] = "";
			 	$data['title'] = "";
				$data['titleurl'] = "";
				$data['status'] = "";
				$data['pid'] = "";
				$data['roll'] = "";
				$data['rank'] = "";
				$data['university'] = "";
				$data['front'] = "";
				$data['metakeyword'] = "";
				$data['metadescription'] = "";
			}
			$this->load->view('admin/result/result_form', $data);
	}
		else{
			redirect('admin/home');
		}
		}

		public function add(){
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
						$this->session->set_userdata('info', "--Error Uploading Image");
						redirect('admin/result');
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
					$query = $this->Result_model->edit($image);
				}
				else{
					$query = $this->Result_model->add($image);
				}
				if($query){
					$this->session->set_userdata('info', "1--Successfully done");
				}
				else{
					$this->session->set_userdata('info', "2--Error!!!");
				}
			}
			redirect('admin/result');
		}

	function delete(){
		if($this->admin->isLogged()){
		$ids = $this->input->post('check_list');
		$query = $this->Result_model->delete($ids);

			if($query){
				$this->session->set_flashdata('info', "1--Successfully done");
			}
			else{
				$this->session->set_flashdata('info', "2--Error!!!");
			}
				redirect('admin/result');
		}
		else{
			redirect('admin/home');
		}
	}


}
