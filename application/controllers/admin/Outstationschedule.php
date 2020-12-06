<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Outstationschedule extends CI_Controller {

		public function __construct() {
			parent::__construct();
			$this->load->model('admin/Outstationschedule_model');
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
		$this->load->view('admin/outstationschedule/outstationschedule_list',$data);
	}

	public function get_list(){
		   $fetch_data = $this->Outstationschedule_model->get_list();
		//	$i = $_POST['start'] + 1 ;
           $data = array();
           foreach($fetch_data as $outstationschedule){
                $sub_array = array();
                $sub_array[] = '#';
				$sub_array[] = $outstationschedule->category;
				$sub_array[] = $outstationschedule->goingfrom;
				$sub_array[] = $outstationschedule->goingto;
				$sub_array[] = date("d/m/Y", strtotime($outstationschedule->datee));
				$sub_array[] = $outstationschedule->fare;
				$sub_array[] = $outstationschedule->vname;
				$sub_array[] = $outstationschedule->aseats;
				$sub_array[] = date("d/m/Y h:i A", strtotime($outstationschedule->created));
				$data[] = $sub_array;
           }
           $output = array(
                "draw"                    =>     intval($_POST["draw"]),
                "recordsTotal"          =>      $this->Outstationschedule_model->get_all_data(),
                "recordsFiltered"     =>     $this->Outstationschedule_model->get_filtered_data(),
                "data"                    =>     $data
           );
           echo json_encode($output);
	}


}
