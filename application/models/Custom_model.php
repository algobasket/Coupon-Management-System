<?php
class Custom_model extends CI_Model{
	function createCoupon($data){
	  $this->db->insert('coupons',$data);
	  return true;
	}

	function updateCoupon($id,$data){
      $this->db->where('id',$id);
      $this->db->update('coupons',$data);
      return true;
	}

	function deleteCoupon($id){
      $this->db->where('id',$id);
      $this->db->delete('coupons');
      return true;
	}

	function singleCoupon(){
	  $query = $this->db->select('*')
	                    ->from('coupons')
	                    ->where('id',$id)
	                    ->get();
	   return $query->result_array();
	}

	function allCoupon($status){
	  $query = $this->db->select('*')
	                    ->from('coupons')
                      ->where('couponStatus',$status)
	                    ->get();
	   return $query->result_array();
	}



}
?>
