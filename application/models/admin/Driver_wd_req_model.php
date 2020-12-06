<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Driver_wd_req_model extends CI_Model{

	function get_wds(){
		$query = $this->db->query("SELECT wd.*, c.first_name, c.last_name, c.mobile, c.bank_name, c.account_holder_name, c.bank_account, c.ifsc_code, c.wallet FROM withdrawal_request wd LEFT JOIN customer c ON(wd.customer_id = c.id) Where wd.type='2' ");
		return $query;
	}

	function update($id, $status){
		$query = $this->db->query("UPDATE withdrawal_request SET status = '" . (int)$status . "' WHERE id = '" . (int)$id . "'");
		return $query;
	}

	function get_wd($id){
		$query = $this->db->query("SELECT wd.*, c.first_name, c.last_name, c.mobile, c.bank_name, c.account_holder_name, c.bank_account, c.ifsc_code, c.wallet FROM withdrawal_request wd LEFT JOIN customer c ON(wd.customer_id = c.id) WHERE wd.id = '" . (int)$id . "'");
		return $query;
	}

	function update_transaction(){
		$this->db->query("UPDATE withdrawal_request SET transaction_id = '" . $this->db->escape_str($this->input->post('transaction_id')) . "', dot = '" . date("Y-m-d", strtotime($this->input->post('dot'))) . "', status = '1' WHERE id = '" . (int)$this->input->post('id') . "'");
		$this->db->query("UPDATE customer SET wallet = wallet - " . $this->input->post('amount') . " WHERE id = '" . (int)$this->input->post('customer_id') . "'");



		return true;
	}
}
