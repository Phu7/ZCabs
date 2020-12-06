<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Front extends CI_Controller{

	 public function __construct() {
        parent::__construct();
    	$this->load->model('Front_model');
		$this->load->library('form_validation');
	}


	function index(){
		/*
		$data['banner'] = $this->Front_model->getHomeBanners();*/
		$data['batach'] = $this->Front_model->getHomeBatches();
		$data['results'] = $this->Front_model->getHomeResults();
		$data['announcements'] = $this->Front_model->get_home_announcements();
		$data['blogs'] = $this->Front_model->get_home_blogs();
		$data['metatitle'] = "CSIR NET Life Science Coaching Institute in Jaipur - Let's Talk Academy";
		$data['metaother'] = '<meta name="description" content="Let\'s Talk Academy (LTA) is the best CSIR NET Life Science institute in Jaipur, Rajasthan that continues to lead CSIR NET JRF Life Science coaching in Jaipur with best results so far that makes aspirants to crack CSIR-UGC National Eligibility Test (NET) for Junior Research Fellowship and Lecturer-ship dam easy." /> <meta name="keywords" content="net coaching in Jaipur for life science, csir net life science, csir net life science coaching in Jaipur, csir net life science coaching, net life science, net life science coaching, best net jrf life sciences coaching
csir life science, online coaching for csir net life science, best net jrf life sciences coaching, csir net jrf life science, best net jrf life sciences coaching, , jrf life science, net coaching for life science, net exam life science, net jrf life science, "/> ';
		$this->load->view("front/home",$data);
	}

	function page(){
		$slug = ($this->uri->segment(2)) ? $this->uri->segment(2):$this->uri->segment(1);
		$data['result'] = $this->Front_model->get_page($slug)->result_array();
		//echo "<pre>";print_r($data['result'][0]);
		$data['metatitle'] = (isset($data['result'][0]['metatitle'])) ? $data['result'][0]['metatitle']:"";
		$data['metaother'] = (isset($data['result'][0]['metadescription'])) ? $data['result'][0]['metadescription']:"";
		$this->load->view("front/page",$data);
	}

	function course_detail(){
		$slug = $this->uri->segment(2);
		$data['result'] = $this->Front_model->get_course_detail($slug)->result_array();
		$data['metatitle'] = $data['result'][0]['metatitle'];
		$data['metaother'] = '<meta name="description" content="'.$data['result'][0]['metadescription'].'" />';
		$this->load->view("front/course_detail",$data);
	}

	function course_syllabus(){
		$slug = $this->uri->segment(2);
		$data['result'] = $this->Front_model->get_course_syllabus($slug)->result_array();
		$data['metatitle'] = $data['result'][0]['metatitle'];
		$data['metaother'] = '<meta name="description" content="'.$data['result'][0]['metadescription'].'" />';
		$this->load->view("front/course_syllabus",$data);
	}

	function announcements(){
		$data['result'] = $this->Front_model->get_announcements();
		$data['metatitle'] = '';
		$data['metaother'] = '';
		$this->load->view("front/announcements",$data);
	}

	function announcement(){
		$slug = $this->uri->segment(2);
		$data['result'] = $this->Front_model->get_announcement($slug)->result_array();
		$data['metatitle'] = $data['result'][0]['title'];
		$data['metaother'] = '<meta name="description" content="'.$data['result'][0]['title'].'" />';
		$this->load->view("front/announcement",$data);
	}

	function testimonials(){
		$data['result'] = $this->Front_model->get_testimonials();
		$data['metatitle'] = 'Testimonials';
		$data['metaother'] = '';
		$this->load->view("front/testimonial",$data);
	}

	/* function rescat(){
		$data['result'] = $this->Front_model->get_rescat();
		$this->load->view("front/rescat",$data);
	} */

	function result(){
		$data['result'] = $this->Front_model->get_result_cat();
		$data['metatitle'] = ':Life Science Exam Results and Selections - Let\'s Talk Academy';
		$data['metaother'] = '<meta name="Description" content=" Nothing compares to Let\'s Talk Academy Institute results for various life science exams.  More than 80+ students selected in CSIR/NET JRF 2016 and 55+ in June 2017 exams. 2018 results are awaited.  No other Students from any other institute from whole India has got any selections from Last many attempts. " />
<meta name="keywords" content="Let\'s Talk Academy Institute results, Life Science results "/>
';
		$url = $this->uri->uri_string();
		$data['z'] = $this->Front_model->get_block($url)->row();
    	//print_r($data['z']);
    $this->load->view("front/result",$data);
	}

	function batches(){
		$data['result'] = $this->Front_model->get_batches();
		//echo json_encode($data['result']);exit();
		$data['metatitle'] = 'batches';
		$data['metaother'] = '';
		$this->load->view("front/batches",$data);
	}

	function contact_us(){
		$q = $this->Front_model->get_contact();
		if($q->num_rows()){
		$qu = $q->row();
		$data['metatitle'] = $qu->metatitle;
		$data['metaother'] = $qu->metadescription;
		}
		else{
		$data['metatitle'] = 'Contact Us';
		$data['metaother'] = '';
		}
		$this->load->view("front/contact_us",$data);
	}

	function send_contactus(){
			$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
			$this->form_validation->set_rules('subject', 'Subject', 'trim|required|xss_clean');
			$this->form_validation->set_rules('phone', 'Phone', 'trim|xss_clean');
			$this->form_validation->set_rules('message', 'Message', 'trim|xss_clean');
		if($this->form_validation->run()==FALSE){
			$this->session->set_flashdata('info', "2--".validation_errors());
		}else{
			$query = $this->Front_model->send_contactus();

		if($query){
				$this->session->set_flashdata('info', "1--Successfully done");
			}
			else{
				$this->session->set_flashdata('info', "2--Error!!!");
			}
		}
	}


	function blogs(){
		$data['result'] = $this->Front_model->get_blogs();
		$data['metatitle'] = '';
		$data['metaother'] = '';
		$this->load->view("front/blogs",$data);
	}

	function blog(){
		$slug = $this->uri->segment(2);
		$data['result'] = $this->Front_model->get_blog($slug)->row();
		$data['metatitle'] = $data['result']->metatitle;
		$data['metaother'] = '<meta name="description" content="'.$data['result']->metadescription.'" />';
		$this->load->view("front/blog",$data);
	}

	function set_location(){
		$this->customer->setLocation($this->input->get('id'));
		echo "success";
	}

	function get_uri_string(){
		$url = $this->uri->uri_string();
		$data['z'] = $this->Front_model->get_block($url);
		print_r($data['z']);

	}

	function question_paper_cat(){
	$data['result'] = $this->Front_model->get_paper_categories();
	$data['metatitle'] = '';
		$data['metaother'] = '';
	$this->load->view("front/question_paper_categories",$data);
}

	function question_papers(){
	$slug = $this->uri->segment(2);
	if($this->customer->getQuestionPaperIdBySlug($slug)){
		$id = $this->customer->getQuestionPaperIdBySlug($slug);
		$data['result'] = $this->Front_model->get_question_papers($id)->result_array();
		$data['metatitle'] = '';
		$data['metaother'] = '';
		$this->load->view("front/question_papers",$data);
	}
	else{
		redirect("/");
	}
}

	function question_paper(){
	$slug = $this->uri->segment(2);
	if($this->customer->isQuestionPaper($slug)){
		$data['result'] = $this->Front_model->get_question_papers($this->customer->isQuestionPaper($slug))->row();
		$data['metatitle'] = '';
		$data['metaother'] = '';
		$this->load->view("front/question_paper",$data);
	}
	else{
		redirect("/");
	}
	}
	function page_error(){
		redirect("/");
	}

/*	function add_form(){
		if($this->admin->isLogged()){
				$data['type'] = $this->Batch_model->get_batch_type();
				$data['type'] = $this->Batch_model->get_established_in();
			if($this->input->get('id')){
			$query = $this->Batch_model->get_batch_by_id($this->input->get('id'));
			foreach($query->result() as $query){
				$data['id'] = $query->id;
				$data['established_id'] = $query->established_id;
				$data['type_id'] = $query->type_id;
				$data['timing'] = $query->timing;
				$data['batch'] = $query->batch;
				$data['duration'] = $query->duration;
				$data['fees'] = $query->fees;
				$data['comment'] = $query->comment;
				$data['status'] = $query->status;
				$data['is_open'] = $query->is_open;
			}
			}
			else{
				$data['id'] = "";
				$data['established_id'] = "";
				$data['type_id'] = "";
				$data['timing'] = "";
				$data['batch'] = "";
				$data['duration'] = "";
				$data['fees'] = "";
				$data['comment'] = "";
				$data['status'] = "";
				$data['is_open'] = "";
			}
			$this->load->view('admin/add_form', $data);
		}
		else{
			redirect('admin/home');
		}
	}

	function add(){
		if($this->admin->isLogged()){
		$this->form_validation->set_rules('name', 'Batch Name', 'trim|required');
		if($this->form_validation->run()==FALSE){
			$this->session->set_userdata('info', "2--".validation_errors());
		}else{
			if($this->input->post('id')){
				$query = $this->Batch_model->edit();
			}
			else{
				$query = $this->Batch_model->add();
			}

		if($query){
				$this->session->set_flashdata('info', "1--Successfully done");
			}
			else{
				$this->session->set_flashdata('info', "2--Error!!!");
			}
		}
		redirect('admin/batch');
		}
		else{
			redirect('admin/home');
		}
	}*/


		/****TEST****/
	public function pricings(){
		$data['metatitle'] = '';
		$data['metaother'] = '';
		$data['result'] = $this->Front_model->getPricing();
		$this->load->view('front/pricing_plan',$data);
	}


	public function tests(){
		$data['metatitle'] = '';
		$data['metaother'] = '';
		$data['subject'] = $this->Front_model->getCombo();
		$this->load->view('front/subject',$data);
	}

	public function disclaimer(){
		$data['metatitle'] = '';
		$data['metaother'] = '';
		$data['id'] = $this->uri->segment(3);
		$this->load->view('front/disclaimer',$data);
	}

	public function get_paper(){
		$data['metatitle'] = '';
		$data['metaother'] = '';
		$id = $this->input->get('id');
		$data['paper'] = $this->Front_model->getPapers($id);
		$this->load->view('front/paper',$data);
	}

	public function get_questions(){
		$data['metatitle'] = '';
		$data['metaother'] = '';
		$query = $this->Front_model->checkAndEntry($this->input->get('id'));
		if($query){
		$data['query'] = $this->Front_model->get_questions_by_paper($this->input->get('id'));
		//echo "<pre>";print_r($data['query']);exit();
		$this->load->view('front/test',$data);
		}
		else{
			echo "error";
		}
	}

	public function save_next(){
		$data['option'] = $this->input->get('option');
		$data['question'] = $this->input->get('question');
		$data['tag'] = $this->input->get('tag');
		$this->Front_model->update_answer($data);
	}

	public function getSection(){
		$j = $this->input->get("id");
		$msg = "";
		$query = $this->Front_model->get_questions_by_paper($paper_id=1);

		$msg .= '<div class="row" style="background-color:#f1ffff;padding:0 !important;margin-bottom:2px;height:8vh">
					<div class="col-md-12" style="padding:10px;">
					 <span style="font-size:15px;font-weight:bold;">SECTION | '.$query['section'][$j]['name'].'</span></div></div>

					 <div class="row" style="background-color:#f1ffff;padding:0 !important;margin-bottom:2px;height:55vh;overflow:auto;">
						<div class="col-md-12" style="padding:10px;">';
		$count = count($query['section'][$j]['question']);
		for($i=0;$i<$count;$i++){
		$class = $this->customer->getQuestionClass($query['section'][$j]['question'][$i]['question_id']);
		$msg .= '<button class="btn btn-'.$class.'" onclick="jumpNumber('.$j.','.($i+1).')" style="border-radius:50%;width:40px;height:40px;margin-bottom:10px;margin-right:7px;">'.($i+1).'</button>';
		}
		$msg .= '</div>
					 </div>';
		echo $msg;
	}

	public function goSubmit(){
		$id = $this->input->get("id");
		$query = $this->Front_model->goSubmit($id);
		if($query){
			echo "1";
		}
		else{
			echo "2";
		}
	}

	public function submition_report(){
		$data['metatitle'] = '';
		$data['metaother'] = '';
		$id = $this->input->get('id');
		$data['q'] = $this->Front_model->getSubmitionReport($id);
		$this->load->view('front/submition_report',$data);
	}

	public function analysis(){
		$data['metatitle'] = '';
		$data['metaother'] = '';
		$query = $this->Front_model->checkAnalysis($this->input->get('id'));
		if($query->num_rows()){
		$data['query'] = $this->Front_model->get_questions_analysis_by_paper($this->input->get('id'));
		$this->load->view('test/front/analysis',$data);
		}
		else{
			echo "error";
		}
	}

}
