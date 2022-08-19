<?php
/**
 * 
 */
class Login extends  CI_Controller
{
	 
	function __construct()
	{
		parent::__construct();
	    $this->load->library('form_validation');
        $this->load->library('session');
		$this->load->model('login_model');
        $this->load->helper('url');

	}
	function index(){
		$this->load->view('login/form_login');
	}
	function aksi_login(){
		$username = $this->input->post('x');
		$password = base64_encode($this->input->post('n'));

		$where = array(
			'username' => $username,
			'password' => $password,
			);
		$cek = $this->login_model->cek_login("pengguna",$where)->num_rows();
		
		$cek_akses = $this->login_model->cek_login("pengguna",$where);
		$i = $cek_akses->row_array();
		if($cek > 0){
 
			$data_session = array(
				'username' => $username,
				'status' => "login"
				);
          	if($i['status']=='belum aktif'){
                 echo'<script>
                 	alert("Akun anda belum diaktifasi \nuntuk mengaktifasi silahkan hubungi manager");
					window.history.back();
                      </script>';
			}else{
            
				if($i['akses'] == 'Staff Produksi' || $i['akses'] == 'staff produksi'){
					$this->session->set_userdata($data_session);
				      redirect('/Staff_Produksi/');
			    }else if($i['akses'] == 'admin' || $i['akses'] == 'Admin'){
	             	$this->session->set_userdata($data_session);
				      $halaman=base64_encode('admin');
				      redirect('/Admin');
			     
			   }else if($i['akses'] == 'manager' || $i['akses'] == 'Manager'){
	             	$this->session->set_userdata($data_session);
				      $halaman=base64_encode('admin');
				      redirect('/Manager');
				}
			}   
          
		 }else{
			echo "<script>
			alert('username atau password salah !!!');
			window.history.back();
			      </script>";
		}
	}
 
	function logout(){
		$this->session->sess_destroy();
		redirect('login');
	}

}
?>