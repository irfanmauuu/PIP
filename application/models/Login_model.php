<?php

Class Login_model extends CI_Model
{
	// private $_table = "akses";
    function cek_login($table,$where){		
		return $this->db->get_where($table,$where);
	}	

}
?>