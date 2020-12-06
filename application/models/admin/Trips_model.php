<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trips_model extends CI_Model{

	function get_trips(){
		$query = $this->db->query("SELECT o.*,c.first_name,c.last_name,c.email,c.mobile,s.name as sight_name, s.slug as sight_slug FROM outstation o LEFT JOIN customer c ON(c.id = o.customer_id) LEFT JOIN sight s ON(s.id = o.sight_id) ORDER BY o.id DESC");
		return $query;
	}

	function get_locals(){
		$query = $this->db->query("SELECT o.*,c.first_name,c.last_name,c.email,c.mobile,s.name as sight_name, s.slug as sight_slug FROM outstation o LEFT JOIN customer c ON(c.id = o.customer_id) LEFT JOIN sight s ON(s.id = o.sight_id) WHERE o.type='4' ORDER BY o.id DESC");
		return $query;
	}

	function get_sights(){
		$query = $this->db->query("SELECT o.*,c.first_name,c.last_name,c.email,c.mobile,s.name as sight_name, s.slug as sight_slug FROM outstation o LEFT JOIN customer c ON(c.id = o.customer_id) LEFT JOIN sight s ON(s.id = o.sight_id) WHERE o.type='3' ORDER BY o.id DESC");
		return $query;
	}

	function get_outs(){
		$query = $this->db->query("SELECT o.*,c.first_name,c.last_name,c.email,c.mobile,s.name as sight_name, s.slug as sight_slug FROM outstation o LEFT JOIN customer c ON(c.id = o.customer_id) LEFT JOIN sight s ON(s.id = o.sight_id) WHERE o.type='1' OR o.type = '2' ORDER BY o.id DESC");
		return $query;
	}

	function get_cancels(){
		$query = $this->db->query("SELECT o.*,c.first_name,c.last_name,c.email,c.mobile,s.name as sight_name, s.slug as sight_slug FROM outstation o LEFT JOIN customer c ON(c.id = o.customer_id) LEFT JOIN sight s ON(s.id = o.sight_id) WHERE o.status = '8' ORDER BY o.id DESC");
		return $query;
	}

	function detail($id){
		$query = $this->db->query("SELECT o.*,c.first_name as customer_first_name, c.last_name as customer_last_name, c.email as customer_email, c.mobile as customer_mobile, c.address as customer_address, c.city as customer_city, c.pincode as customer_pincode, c.state as customer_state, c.country as customer_country, c.gender as customer_gender, c.dob as customer_dob, d.first_name as driver_first_name, d.last_name as driver_last_name, d.mobile as driver_mobile, d.email as driver_email, d.vehicle_type, d.vehicle_name as vehicle_name_final, d.vehicle_number, d.vehicle_model, s.slug as sight_slug, s.name as sight_name FROM outstation o LEFT JOIN customer c ON(c.id = o.customer_id) LEFT JOIN customer d ON(d.id = o.driver) LEFT JOIN sight s ON(s.id=o.sight_id) WHERE o.id = '" . (int)$id . "'");
		return $query;
	}

	function get_drivers(){
		$query = $this->db->query("SELECT * FROM customer WHERE role_id = '2' and status != '3'");
		return $query;
	}

	function manage_status($id, $status){
		$user_id = $this->db->query("SELECT customer_id, order_price FROM outstation WHERE id = '" . (int)$id . "'")->row();
		if($this->admin->isType($user_id->customer_id) == 3){
			if($status == 6){
				$commision =  $user_id->order_price * $this->admin->getAgentCommision();
				$this->db->query("UPDATE customer SET wallet = wallet + " . $commision . " WHERE id = '" . (int)$user_id->customer_id . "'");
			}
		}

		$query = $this->db->query("UPDATE outstation SET status = '" . (int)$status . "' WHERE id = '" . (int)$id . "'");
		return $query;
	}

	function accept($id, $driver, $price){
		$query = $this->db->query("UPDATE outstation SET driver = '" . (int)$driver . "', order_price = '" . (float)$price . "', status = '2' WHERE id = '" . (int)$id . "'");
		if($query){
			$sql = $this->detail($id)->row();

			$msg = urlencode('Hello, Your booking has been confirmed with ' . $sql->vehicle_name . ' with Number ' . $sql->vehicle_number . '.Driver name: ' . $sql->driver_first_name . '. Contact no. '. $sql->driver_mobile . ' Date:' . date('d M, Y h:i A', strtotime($sql->departure_date)).' will be pick from your location, any assistance feel free to call ZCabs.');
			$sms = 'http://103.241.146.71/sendsms.jsp?user=zcabs1&password=ee33f5114dXX&mobiles='.$sql->customer_mobile.'&sms='.$msg.'&senderid=ZCABSS';
			$response = $this->file_get_contents_curl($sms);



			$psg = ($sql->passengers > 0) ? $sql->passengers: 'N/A';
			$lc = ($sql->_from != '') ? $sql->_from : 'Not Available';
			$driver_msg = urlencode('A new trip booking is arrived passanger name : ' . $sql->customer_first_name . ' with ' . $psg . ' seats and contact no. is ' . $sql->customer_mobile . ' pick up from ' . $lc . ' and date of jorney is ' . date('d M, Y h:i A', strtotime($sql->departure_date)) . '.');
			$sms1 = 'http://103.241.146.71/sendsms.jsp?user=zcabs1&password=ee33f5114dXX&mobiles='.$sql->driver_mobile.'&sms='.$driver_msg.'&senderid=ZCABSS';
			$response = $this->file_get_contents_curl($sms1);
		}
		return true;
	}

	function file_get_contents_curl($url){
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

		$data = curl_exec($ch);
		curl_close($ch);

		return $data;
	}

	function delete($ids){
		$query = $this->db->query("DELETE FROM outstation WHERE id IN (" . $ids . ")");
		return $query;
	}
}
