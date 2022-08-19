<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slogin
{
	protected $CI;

	public function __construct()
	{
        $this->CI =& get_instance();
        $this->CI->load->model('Login_model');
	}
	public function login($username, $password){
		$cek = $this->CI->atk_model->login($username,$password);
        //Memeriksa data login session
        if($cek){
            $id_user = $cek->id_user;
            $username = $cek->username;
            $jabatan = $cek->jabatan;
        //Create Session
            $this->CI->session->set_userdata('id_user',$id_user);
            $this->CI->session->set_userdata('username',$username);
            $this->CI->session->set_userdata('jabatan',$jabatan);
        //redirect ke halaman utama
            redirect(base_url('Home'),'refresh');
        }else{
        //Jika ID atau password salah
        $this->CI->session->set_flashdata('salah','Username atau password salah');
            redirect(base_url('login'),'refresh');
        }
	}
//public function regist($id_user,$namadep,$namabel,$username, $password,$jabatan){
    //$cek = $this->CI->atk_model->regist($id_user,$namadep,$namabel,$username,$password,$jabatan);
    //Memeriksa data login session
        //if($cek){
         //   $id_user = $cek->id_user;
         //   $namadep= $cek->namadep;
         //   $namabel = $cek->namabel;
           // $username = $cek->username;
           // $jabatan = $cek->jabatan;
        //Create Session
          //  $this->CI->session->set_userdata('id_user',$id_user);
             /// $this->CI->session->set_userdata('namadep',$namadep);
           // $this->CI->session->set_userdata('namabel',$namabel);
           // $this->CI->session->set_userdata('username',$username);
           // $this->CI->session->set_userdata('jabatan',$jabatan);
        //redirect ke halaman utama
          //  redirect(base_url('Login'),'refresh');
      //  }
//}

     public function cek_login()
    {
        //Memeriksa session sudah ada atau belum
        if ($this->CI->session->userdata('username') == "") 
        {
            $this->CI->session->set_flashdata('warning','Anda Belum login');
            redirect(base_url('login'),'refresh');
        }
    }

    public function logout(){
        $this->CI->session->unset_userdata('username');
        $this->CI->session->unset_userdata('akses');
        $this->CI->session->set_flashdata('sukses','Berhasil logout');
        redirect(base_url('login'),'refresh');
    }

	

}

/* End of file Slogin.php */
/* Location: ./application/libraries/Slogin.php */
