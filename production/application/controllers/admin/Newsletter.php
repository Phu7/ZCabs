<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletter extends CI_Controller {

		public function __construct() {
			parent::__construct();
			$this->load->model('admin/Newsletter_model');
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
		$this->load->view('admin/newsletter/newsletter_list',$data);
	}

	public function get_list(){
		   $fetch_data = $this->Newsletter_model->get_list();
		//	$i = $_POST['start'] + 1 ;
           $data = array();
           foreach($fetch_data as $newsletter){
                $sub_array = array();
                $sub_array[] = '#';

				$sub_array[] = $newsletter->email;
				$sub_array[] = date("d/m/Y h:i A", strtotime($newsletter->created));
				$data[] = $sub_array;
           }
           $output = array(
                "draw"                    =>     intval($_POST["draw"]),
                "recordsTotal"          =>      $this->Newsletter_model->get_all_data(),
                "recordsFiltered"     =>     $this->Newsletter_model->get_filtered_data(),
                "data"                    =>     $data
           );
           echo json_encode($output);
	}


}
