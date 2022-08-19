<?php
/**
 * 
 */
class Manager extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Manager_Model');
        // $this->load->library('encrypt');
   }
	function index(){
           $this->session->userdata('status');
        if($this->session->userdata('status') != "login"){
            echo'<script>
             alert("akses ditolak");
             window.location="../"
                 </script>';
        
        }
        else{
        $data['title']="Manager";
        $data['header']="Dashboard";
	    	$this->load->view('templet/header',$data);
        $this->load->view('templet/sidebar_manager');
        $this->load->view('templet/content');
        $this->load->view('templet/footer');
      }
	}
  
 
   
     //========== Laporan Penjualan=============/
     function laporan_pertanggal(){
        $data['tgl1']=$this->input->post('date1');
        $data['tgl2']=$this->input->post('date2');


        $data['query']=$this->Manager_Model->laporan_pertanggal($data);
        
        $date1=$this->input->post('date1');
        $date2=$this->input->post('date2');
        $data['title']       ="Laporan Penjualan";
        $data['header']      ="Laporan Penjualan Pertanggal";
     
        $this->load->view('templet/header',$data);
        $this->load->view('templet/sidebar_manager');
        $this->load->view('manager/laporan/laporan_pertanggal',$data);
        $this->load->view('templet/footer');

     }
    function cetak_laporan_pertanggal(){
        $data['tgl1']=base64_decode($this->input->get('d'));
        $data['tgl2']=base64_decode($this->input->get('D'));


        $data['query']=$this->Manager_Model->laporan_pertanggal($data);
        
        $date1=base64_decode($this->input->get('d'));
        $date2=base64_decode($this->input->get('D'));

        $data['title']       ="Laporan Penjualan";
        $data['header']      ="Laporan Penjualan Pertanggal";
     
        $this->load->view('templet/header',$data);
        $this->load->view('manager/laporan/cetak_laporan_pertanggal',$data);
    
     }
      function export_laporan_pertanggal(){
        $data['tgl1']=base64_decode($this->input->get('d'));
        $data['tgl2']=base64_decode($this->input->get('D'));


        $data['query']=$this->Manager_Model->laporan_pertanggal($data);
        
        $date1=base64_decode($this->input->get('d'));
        $date2=base64_decode($this->input->get('D'));

        $data['title']       ="Laporan Penjualan";
        $data['header']      ="Laporan Penjualan Pertanggal";
     
        $this->load->view('manager/laporan/export_laporan_pertanggal',$data);
    
     }
     //Hari
     function laporan_perhari(){
        $data['tgl1']=$this->input->post('date1');


        $data['query']=$this->Manager_Model->laporan_perhari($data);
        
        $date1=$this->input->post('date1');
        $date2=$this->input->post('date2');
        $data['title']       ="Laporan Perhari";
        $data['header']      ="Laporan Penjualan Perhari";
     
        $this->load->view('templet/header',$data);
        $this->load->view('templet/sidebar_manager');
        $this->load->view('manager/laporan/laporan_perhari',$data);
        $this->load->view('templet/footer');

     }
    function cetak_laporan_perhari(){
        $data['tgl1']=base64_decode($this->input->get('d'));


        $data['query']=$this->Manager_Model->laporan_perhari($data);
        
        $date1=base64_decode($this->input->get('d'));
        $date2=base64_decode($this->input->get('D'));

        $data['title']       ="Laporan Perhari";
        $data['header']      ="Laporan Penjualan Perhari";
     
        $this->load->view('templet/header',$data);
        $this->load->view('manager/laporan/cetak_laporan_perhari',$data);
    
     }
      function export_laporan_perhari(){
        $data['tgl1']=base64_decode($this->input->get('d'));
    

        $data['query']=$this->Manager_Model->laporan_perhari($data);
        
        $date1=base64_decode($this->input->get('d'));
      
        $data['title']       ="Laporan Penjualan";
        $data['header']      ="Laporan Penjualan Perhari";
     
        $this->load->view('manager/laporan/export_laporan_perhari',$data);
    
     }
     //Bulan
     function laporan_perbulan(){
        $data['month']=substr($this->input->post('date1'),5);
        $data['year']=substr($this->input->post('date1'),0,4);
  
        $data['query']=$this->Manager_Model->laporan_perbulan($data);
        
        $date1=$this->input->post('date1');
        $data['title']       ="Laporan Perbulan";
        $data['header']      ="Laporan Penjualan Perbulan";
     
        $this->load->view('templet/header',$data);
        $this->load->view('templet/sidebar_manager');
        $this->load->view('manager/laporan/laporan_perbulan',$data);
        $this->load->view('templet/footer');

     }
    function cetak_laporan_perbulan(){
        $data['month']=base64_decode($this->input->get('m'));
        $data['year']=base64_decode($this->input->get('Y'));

        $data['query']=$this->Manager_Model->laporan_perbulan($data);
        
        $date1=base64_decode($this->input->get('d'));
        $date2=base64_decode($this->input->get('D'));

        $data['title']       ="Laporan Perbulan";
        $data['header']      ="Laporan Penjualan Perbulan";
     
        $this->load->view('templet/header',$data);
        $this->load->view('manager/laporan/cetak_laporan_perbulan',$data);
    
     }
      function export_laporan_perbulan(){
        $data['month']=base64_decode($this->input->get('m'));
        $data['year']=base64_decode($this->input->get('Y'));
  

        $data['query']=$this->Manager_Model->laporan_perbulan($data);
 
        $data['title']       ="Laporan Penjualan";
        $data['header']      ="Laporan Penjualan Perbulan";
     
        $this->load->view('manager/laporan/export_laporan_perbulan',$data);
    
     }
       //Tahun
     function laporan_pertahun(){
        $data['year']=$this->input->post('year');
  
        $data['query']=$this->Manager_Model->laporan_pertahun($data);
        
        $data['title']       ="Laporan Pertahun";
        $data['header']      ="Laporan Penjualan Pertahun";
     
        $this->load->view('templet/header',$data);
        $this->load->view('templet/sidebar_manager');
        $this->load->view('manager/laporan/laporan_pertahun',$data);
        $this->load->view('templet/footer');

     }
    function cetak_laporan_pertahun(){
        $data['year']=base64_decode($this->input->get('Y'));

        $data['query']=$this->Manager_Model->laporan_pertahun($data);
        
        $data['title']       ="Laporan Pertahun";
        $data['header']      ="Laporan Penjualan Pertahun";
     
        $this->load->view('templet/header',$data);
        $this->load->view('manager/laporan/cetak_laporan_pertahun',$data);
    
     }
      function export_laporan_pertahun(){
        $data['year']=base64_decode($this->input->get('Y'));
  

        $data['query']=$this->Manager_Model->laporan_pertahun($data);
 
        $data['title']       ="Laporan Penjualan";
        $data['header']      ="Laporan Penjualan Pertahun";
     
        $this->load->view('manager/laporan/export_laporan_pertahun',$data);
    
     }
    // function cetak_surat_jalan(){  
    //     $data['title']       ="Surat Jalan";
     
    //     $data['no_do']  = base64_decode($this->input->get('N'));
    //     $data['tgl'] = base64_decode($this->input->get('T'));
    //     $this->load->view('templet/header',$data);
    //     $this->load->view('staff_gudang/surat_jalan/cetak_surat_jalan',$data);
        
    // }

}
?>