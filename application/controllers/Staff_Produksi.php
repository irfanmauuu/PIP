<?php

class Staff_Produksi extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Staff_Produksi_Model');
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
        $data['title']="Staff Produksi";
        $data['header']="Dashboard";
		    $this->load->view('templet/header',$data);
        $this->load->view('templet/sidebar_staff');
        $this->load->view('templet/content');
        $this->load->view('templet/footer');
      }
	}
    function data_kategori(){
        $cari= $this->input->get('x');
        $data['title']  = "Staff Produksi";
        $data['header'] = "Data Kategori";
        $data['get']    = $this->Staff_Produksi_Model->data_kategori($cari);

        $this->load->view('templet/header',$data);
        $this->load->view('templet/sidebar_staff');
        $this->load->view('staff_produksi/kategori/data_kategori',$data);
        $this->load->view('templet/footer');

    }
    function form_kategori(){
        $id_kategori=$this->Staff_Produksi_Model->id_kategori();
        $data['title']="Staff Produksi";
        $data['header']="Form Kategori";
        $data['id_kategori']= $id_kategori;
        
        $this->load->view('templet/header',$data);
        $this->load->view('templet/sidebar_staff');
        $this->load->view('staff_produksi/kategori/form_kategori');
        $this->load->view('templet/footer');
    }
    function simpan_kategori(){
     
     $id_kategori   =  $this->input->post('id_kategori');
     $nama_kategori =  $this->input->post('nama_kategori');
     $data  = array( 'id_kategori'   => $id_kategori,
                     'nama_kategori' => $nama_kategori
                    );
     $this->Staff_Produksi_Model->simpan_kategori($data);
     redirect('Staff_Produksi/data_kategori');
    }
    function hapus_kategori(){
             $id = base64_decode($this->input->get('x'));
             $this->Staff_Produksi_Model->hapus_kategori($id);
             redirect('Staff_Produksi/data_kategori');  
    }
    function form_edit_kategori(){  
        $id = base64_decode($this->input->get('x'));
        $result = $this->Staff_Produksi_Model->get_id_kategori($id);
        if($result->num_rows() > 0){
            $i = $result->row_array();
            $data = array(
                'header'       => 'Edit Kategori',
                'title'        => 'Staff Produksi',
                'id_kategori'  => $i['id_kategori'],
                'nama_kategori'=> $i['nama_kategori']
            );
          
          }else{
            echo "Data Was Not Found";
             }
                $this->load->view('templet/header',$data);
                $this->load->view('templet/sidebar_staff');
                $this->load->view('staff_produksi/kategori/form_edit_kategori');
                $this->load->view('templet/footer');
    }
    function edit_kategori(){
        $data   = array(
            'id_kategori'    => $this->input->post('id_kategori'),
            'nama_kategori'  => $this->input->post('nama_kategori')
         
        );

        $update=$this->Staff_Produksi_Model->edit_kategori($data);
        redirect('Staff_Produksi/data_kategori');  

    }
    //============ BARANG/PRODUK=================//
    function data_produk(){

        $cari= $this->input->get('x');
        $data['title'] = "Staff Produksi";
        $data['header'] = "Data Produk";
        $data['get'] = $this->Staff_Produksi_Model->data_produk($cari);

        $this->load->view('templet/header',$data);
        $this->load->view('templet/sidebar_staff');
        $this->load->view('staff_produksi/produk/data_produk',$data);
        $this->load->view('templet/footer');

    }

    function form_produk(){
        $id_produk        =$this->Staff_Produksi_Model->id_produk();
        $data['get']      = $this->Staff_Produksi_Model->get_nama_kategori();
        $data['title']    ="Staff Produksi";
        $data['header']   ="Form Produk";
        $data['id_produk']= $id_produk;
        
        $this->load->view('templet/header',$data);
        $this->load->view('templet/sidebar_staff');
        $this->load->view('staff_produksi/produk/form_produk',$data);
        $this->load->view('templet/footer');
    }

    function simpan_produk(){
        $id_produk     =  $this->input->post('id_produk');
        $nama          =  $this->input->post('nama');
        $kategori      =  $this->input->post('kategori');
        $kg            =  $this->input->post('kg');
        $total_beras   =  preg_replace("/[^0-9]/","",$this->input->post('total_beras'));
        $harga         =  preg_replace("/[^0-9]/","",$this->input->post('harga'));

        $data  = array(  'id_produk'    => $id_produk,
                         'kategori'     => $kategori,
                         'nama'         => $nama,
                         'satuan_kg'    => $kg,
                         'harga'        => $harga,
                         'total_beras'  => $total_beras                         // 'jenis'        => $jenis
                    );
        $this->Staff_Produksi_Model->simpan_produk($data);
        redirect('Staff_Produksi/data_produk');
    }

    function hapus_produk(){
             $id = base64_decode($this->input->get('x'));
             $this->Staff_Produksi_Model->hapus_produk($id);
             redirect('Staff_Produksi/data_produk');  
    }

    function form_edit_produk(){  
        $id = base64_decode($this->input->get('x'));
        $result = $this->Staff_Produksi_Model->get_id_produk($id);
         
        if($result->num_rows() > 0){
            $i = $result->row_array();
            $data = array(
                'header'       => 'Edit Produk',
                'title'        => 'Staff Produksi',
                'id_produk'    => $i['id_produk'],
                'kategori'     => $i['kategori'],
                'nama'         => $i['nama'],
                'kg'           => $i['satuan_kg'],
                'harga'        => $i['harga'],
                'total_beras'  => $i['total_beras'],
                // 'jenis'        => $i['jenis']
              
            );
          $data['get'] = $this->Staff_Produksi_Model->get_nama_kategori();
        
          }else{
            echo "Data Was Not Found";
             }
                $this->load->view('templet/header',$data);
                $this->load->view('templet/sidebar_staff');
                $this->load->view('staff_produksi/produk/form_edit_produk',$data);
                $this->load->view('templet/footer');
    }
    
    function edit_produk(){
        $data   = array(
              'id_produk'    => $this->input->post('id_produk'),
              'kategori'     => $this->input->post('kategori'),
              'nama'         => $this->input->post('nama'),
              'kg'           => $this->input->post('kg'),
              'harga'        => preg_replace("/[^0-9]/","",$this->input->post('harga')),
              'total_beras'  =>  preg_replace("/[^0-9]/","",$this->input->post('total_beras'))
   
             
        );
        $update=$this->Staff_Produksi_Model->edit_produk($data);
        redirect('Staff_Produksi/data_produk');  

    }
     //=========STOK BARANG======================//
    function hasil_produksi(){
        $data['title']    ="Staff Produksi";
        $data['header']   ="Hasil Produksi";
        $cari=$this->input->post('x');
        $sql="SELECT produk.nama as nama ,satuan_kg,total_beras,stok_produk FROM produk,stok_produk WHERE produk.id_produk=stok_produk.id_produk AND nama like '%$cari%'";
        $data['query']=$this->db->query($sql);
        $this->load->view('templet/header',$data);
        $this->load->view('templet/sidebar_staff');
        $this->load->view('staff_produksi/hasil_produksi/hasil_produksi',$data);
        $this->load->view('templet/footer');
    }
    function laporan_stok(){
        $data['tgl1']=$this->input->post('date1');
        $data['tgl2']=$this->input->post('date2');
        $data['id_produk']=$this->input->post('id_produk');
        $data['kategori']=$this->input->post('kategori');


        $data['query']=$this->Staff_Produksi_Model->laporan_stok($data);
        
        $Sql= "SELECT DISTINCT stok_produk.id_produk,nama FROM stok_produk,produk WHERE stok_produk.id_produk=produk.id_produk ";
        $Sql_kategori= "SELECT DISTINCT nama_kategori FROM kategori";
        $data['get'] = $this->db->query($Sql); 
        $data['get_kategori'] = $this->db->query($Sql_kategori); 
        $date1=$this->input->post('date1');
        $date2=$this->input->post('date2');
        $data['title']    = "Staff Produksi";
        $data['header']   = "Laporan Stok";
        $this->load->view('templet/header',$data);
        $this->load->view('templet/sidebar_staff');
        $this->load->view('staff_produksi/stok/laporan_stok',$data);
        $this->load->view('templet/footer');
    }
    function cetak_laporan_stok(){
        $data['tgl1']=base64_decode($this->input->get('d'));
        $data['tgl2']=base64_decode($this->input->get('D'));
        $data['id_produk']=base64_decode($this->input->get('IP'));
        $data['kategori']=base64_decode($this->input->get('Kt'));


        $data['query']=$this->Staff_Produksi_Model->laporan_stok($data);
        
        $data['get']      = $this->Staff_Produksi_Model->get_nama_produk();
        $data['title']    = "Staff Produksi";
        $data['header']   = "Laporan Stok";
        $this->load->view('templet/header',$data);
        $this->load->view('staff_produksi/stok/cetak_laporan_stok',$data);

    }
     function export_laporan_stok(){
        $data['tgl1']=base64_decode($this->input->get('d'));
        $data['tgl2']=base64_decode($this->input->get('D'));
        $data['id_produk']=base64_decode($this->input->get('IP'));
        $data['kategori']=base64_decode($this->input->get('Kt'));


        $data['query']=$this->Staff_Produksi_Model->laporan_stok($data);
        
        $data['get']      = $this->Staff_Produksi_Model->get_nama_produk();
        $data['title']    = "Staff Produksi";
        $data['header']   = "Laporan Stok";
        $this->load->view('staff_produksi/stok/export_laporan_stok',$data);

    }
     function data_stok(){
        $cari= $this->input->get('x');
        $data['title'] = "Staff Produksi";
        $data['header'] = "Data Stok";
        $data['get'] = $this->Staff_Produksi_Model->data_stok($cari);

        $this->load->view('templet/header',$data);
        $this->load->view('templet/sidebar_staff');
        $this->load->view('staff_produksi/stok/data_stok',$data);
        $this->load->view('templet/footer');
    }
    function form_stok(){
        $sql="SELECT * FROM produk WHERE total_beras>0";        
        $data['get']      = $this->db->query($sql);
        $data['title']    ="Staff Produksi";
        $data['header']   ="Form Stok";
        
        $this->load->view('templet/header',$data);
        $this->load->view('templet/sidebar_staff');
        $this->load->view('staff_produksi/stok/form_stok',$data);
        $this->load->view('templet/footer');
    }
    function simpan_stok(){
     $id_produk     =  $this->input->post('id_produk');
     $tgl_produksi  =  $this->input->post('tgl_produksi');
     $stok          =  $this->input->post('stok');
     $total_beras   =  $this->input->post('total_beras');
     $kg            =  $this->input->post('kg');
     $kategori      =  $this->input->post('kategori');
     $where = array(
      'id_produk'    => $id_produk,
      'tgl_produksi' => $tgl_produksi
      );
     // $cek="SELECT * FROM stok_produk WHERE id_produk='$id_produk' AND tgl_produksi='$tgl_produksi'";
     // $this->db->query($cek);
     $total_beras=$total_beras-$stok*$kg;
     $sql="UPDATE produk SET total_beras = '$total_beras' WHERE id_produk='$id_produk'";
     $this->db->query($sql);
     $get_stok = $this->Staff_Produksi_Model->cek_stok("stok_produk",$where);
     $i = $get_stok->row_array();
     $cek = $this->Staff_Produksi_Model->cek_stok("stok_produk",$where)->num_rows();  
     if($cek > 0){
     $Total_Stok = $stok* + $i['stok_produk'];  
     $data  = array( 'id_stok'      =>$i['id_stok'],
                     'id_produk'    => $id_produk,
                     'kategori'     => $kategori,
                     'tgl_produksi' => $tgl_produksi,
                     'stok'         => $Total_Stok
                    );
     $this->Staff_Produksi_Model->edit_stok($data);
     redirect('Staff_Produksi/data_stok');
     }
     else{
        $data  = array('id_produk'    => $id_produk,
                       'kategori'  => $kategori,
                       'tgl_produksi' => $tgl_produksi,
                       'stok_produk'  => $stok,
                      );
        $this->Staff_Produksi_Model->simpan_stok($data);
        redirect('Staff_Produksi/data_stok');
     }
    }
    function hapus_stok(){
             $id = base64_decode($this->input->get('x'));
             $this->Staff_Produksi_Model->hapus_stok($id);
             redirect('Staff_Produksi/data_stok');  
    }
    function form_edit_stok(){  
        $id = base64_decode($this->input->get('x'));    
        $result = $this->Staff_Produksi_Model->get_id_stok($id);
        if($result->num_rows() > 0){
            $i = $result->row_array();
            $data = array(
                'header'       => 'Edit Stok',
                'title'        => 'Staff Produksi',
                'id_stok'      => $i['id_stok'],
                'id_produk'    => $i['id_produk'],
                'tgl_produksi' => $i['tgl_produksi'],
                'stok_produk'  => $i['stok_produk']
              
            );
          $data['get'] = $this->Staff_Produksi_Model->get_nama_produk();
        
          }else{
            echo "Data Was Not Found";
             }
                $this->load->view('templet/header',$data);
                $this->load->view('templet/sidebar_staff');
                $this->load->view('staff_produksi/stok/form_edit_stok',$data);
                $this->load->view('templet/footer');
    }
    function edit_stok(){
     $id_stok       =  $this->input->post('id_stok');   
     $id_produk     =  $this->input->post('id_produk');
     $tgl_produksi  =  $this->input->post('tgl_produksi');
     $stok          =  $this->input->post('stok');
     
     $where = array(
      'id_produk'    => $id_produk,
      'tgl_produksi' => $tgl_produksi
      );
     $get_stok = $this->Staff_Produksi_Model->cek_stok("stok_produk",$where);
     $i = $get_stok->row_array();
     $cek = $this->Staff_Produksi_Model->cek_stok("stok_produk",$where)->num_rows();  
    
        echo $cek.'dua';
        $data   = array(
              'id_stok'      => $this->input->post('id_stok'),
              'id_produk'    => $this->input->post('id_produk'),
              'tgl_produksi' => $this->input->post('tgl_produksi'),
              'stok'         => $this->input->post('stok')
        );
        $update=$this->Staff_Produksi_Model->edit_stok($data);
        redirect('Staff_Produksi/data_stok');  
    }
    //Produk lama
    function data_produk_lama(){
        $cari= $this->input->get('x');
        $data['title'] = "Staff Produksi";
        $data['header'] = "Data Produk Lama";
        $sql="SELECT produk.nama,produk.kategori,produk.harga,produk.satuan_kg,stok_produk.* FROM stok_produk,produk WHERE tgl_produksi < DATE_ADD(NOW(), INTERVAL -3 MONTH) AND produk.nama like'%$cari%' AND produk.id_produk=stok_produk.id_produk AND stok_produk > 0";
        $query=$this->db->query($sql);
        $data['query'] = $query;

        $nama_barang             = $this->Staff_Produksi_Model->get_nama_produk();
        $data['nama_produk']     = $nama_barang;
        $data['get']             = $this->Staff_Produksi_Model->get_nama_kategori();
        $data['id_produk']       = $this->Staff_Produksi_Model->id_produk();
        
        $this->load->view('templet/header',$data);
        $this->load->view('templet/sidebar_staff');
        $this->load->view('staff_produksi/produk_lama/data_produk_lama',$data);
        $this->load->view('templet/footer');
    
    }
    function form_produk_lama(){
        $id_produk        =$this->Staff_Produksi_Model->id_produk();
        // $sql="SELECT DISTINCT 
        //         pengembalian.id_produk as id_produk,
        //         produk.nama as nama,
        //         pengembalian.id_pengembalian as id_pengembalian

        //         FROM pengembalian,produk 
        //         WHERE pengembalian.id_produk=produk.id_produk";
        $sql="SELECT produk.nama,produk.kategori,produk.harga,produk.satuan_kg,stok_produk.*  FROM stok_produk,produk WHERE tgl_produksi < DATE_ADD(NOW(), INTERVAL -3 MONTH) AND produk.id_produk=stok_produk.id_produk AND stok_produk > 0";
        $query=$this->db->query($sql);        
        $data['produk']   = $this->Staff_Produksi_Model->get_nama_produk();

        $data['title']    ="Staff Produksi";
        $data['header']   ="Form Produk Lama";
        $data['nama_produk'] = $query;
        $data['id_produk']   = $id_produk;
        
        $this->load->view('templet/header',$data);
        $this->load->view('templet/sidebar_staff');
        $this->load->view('staff_produksi/produk_lama/form_produk_lama',$data);
        $this->load->view('templet/footer');
    }
  
    function simpan_produk_lama(){
        $id_produk     =  $this->input->post('id_produk');
        $id_stok       =  $this->input->post('id_stok');
        $nama          =  $this->input->post('nama');
        $kategori      =  $this->input->post('kategori');
        $kg            =  $this->input->post('satuan_kg');
        $tgl_produksi  =  $this->input->post('tgl_produksi');
        $stok          =  preg_replace("/[^0-9]/","",$this->input->post('stok'));
        $harga         =  preg_replace("/[^0-9]/","",$this->input->post('harga'));

        $data  = array(  'id_produk'    => $id_produk,
                         'kategori'     => $kategori,
                         'nama'         => $nama,
                         'satuan_kg'    => $kg,
                         'harga'        => $harga,
                         'total_beras'  => 0                         // 'jenis'        => $jenis
                    );
        $this->Staff_Produksi_Model->simpan_produk($data);

        $data = array('id_produk' => $id_produk,'kategori' => $kategori,'tgl_produksi' => $tgl_produksi,'stok_produk'=> $stok );
        $this->Staff_Produksi_Model->simpan_stok($data);

        $this->Staff_Produksi_Model->hapus_stok($id_stok);
        
        $SS = "SELECT * FROM pengembalian WHERE id_stok='$id_stok'";
        $cek=$this->db->query($SS)->num_rows();
        echo $cek;  
        if($cek > 0){
        $Hapus="DELETE FROM pengembalian WHERE id_stok='$id_stok'";
        $this->db->query($Hapus);
        }
        redirect('Staff_Produksi/data_produk_lama');
   

    }
    function hapus_produk_lama(){
             $id = base64_decode($this->input->get('x'));
             $this->Staff_Produksi_Model->hapus_stok($id);
             redirect('Staff_Produksi/data_produk_lama');  
    }
     //=========Pengembalian BARANG======================//

    
     function data_pengembalian(){
        $cari= $this->input->get('x');
        $data['title'] = "Staff Produksi";
        $cari = $this->input->get('x');
        $data['header'] = "Data Pengembalian Produk";
        $sql="SELECT DISTINCT penjualan.tgl as tgl,pelanggan.nama as nama,id_penjualan,penjualan.id_pelanggan,tipe_sj,id_transaksi,no_do FROM penjualan,pelanggan WHERE status='lunas' AND penjualan.id_pelanggan=pelanggan.id_pelanggan AND nama like '%$cari%'";
        $data['query_penjualan']=$this->db->query($sql);
        
        $sql="SELECT DISTINCT tipe_sj,pengembalian.tgl as tgl,pelanggan.nama as nama,pengembalian.id_pelanggan as id_pelanggan,id_pengembalian,id_penjualan FROM pengembalian,pelanggan WHERE pengembalian.id_pelanggan=pelanggan.id_pelanggan AND nama like '%$cari%'";
        $data['query']=$this->db->query($sql);

        $nama_barang             = $this->Staff_Produksi_Model->get_nama_produk();
        $data['nama_produk']     = $nama_barang;
        $this->load->view('templet/header',$data);
        $this->load->view('templet/sidebar_staff');
        $this->load->view('staff_produksi/pengembalian/data_penjualan',$data);
        $this->load->view('templet/footer');
    }
    function form_pengembalian(){
        $data['title']           ="Staff Produksi";
        $data['header']          ="Form Pengembalian";
        
        $id_pengembalian         = $this->Staff_Produksi_Model->id_pengembalian();
        $data['id_pengembalian'] = $id_pengembalian;
      
        $this->load->view('templet/header',$data);
        $this->load->view('templet/sidebar_staff');
        $this->load->view('staff_produksi/pengembalian/form_pengembalian',$data);
        $this->load->view('templet/footer');
    }
    function edit_pengembalian(){
     $id_produk       =  $this->input->post('id_produk');
     $tgl             =  $this->input->post('tgl');
     $jumlah          =  $this->input->post('jumlah');
     $id_pengembalian =  $this->input->post('id_pengembalian');
    
     $data  = array( 'id_pengembalian'=>$id_pengembalian,
                     'id_produk'      => $id_produk,
                     'tgl'            => $tgl,
                     'jumlah'         => $jumlah
                    );
     $this->Staff_Produksi_Model->edit_pengembalian($data);
     redirect('Staff_Produksi/data_pengembalian');
    }
    function simpan_pengembalian(){
     $id_pengembalian =  $this->input->post('id_pengembalian');
     $id_produk       =  $this->input->post('id_produk');
     $id_penjualan    =  $this->input->post('id_penjualan');
     $id_pelanggan    =  $this->input->post('id_pelanggan');
     $tipe_sj         =  $this->input->post('tipe_sj');  
     $id_stok         =  $this->input->post('id_stok');
     $tgl             =  $this->input->post('tgl');
     $jumlah          =  $this->input->post('qty');
     $keterangan      =  $this->input->post('keterangan');
     
      $data   = array('id_pengembalian'    => $id_pengembalian,
                         // 'id_produk'          => $id_produk,
                         // 'id_stok'            => $id_stok,
                         // 'id_pelanggan'       => $id_pelanggan,
                         // 'id_penjualan'       => $id_penjualan,
                         // 'tipe_sj'            => $tipe_sj,
                         // 'tgl'                => $tgl,
                         'jumlah'             => $jumlah
                    );
        $where = array(
          'id_pelanggan'    => $id_pelanggan,
          'id_stok'         => $id_stok,
          'id_penjualan'    => $id_penjualan,
          'tipe_sj'         => $tipe_sj,
          'tgl'             => $tgl
          );
         $get= $this->Staff_Produksi_Model->cek_pengembalian("pengembalian",$where);
         $i = $get->row_array();
         $cek = $this->Staff_Produksi_Model->cek_pengembalian("pengembalian",$where)->num_rows();  
         if($cek > 0){
         $Total_Jumlah = $jumlah + $i['jumlah'];  
          $data   = array('id_pengembalian'    => $i['id_pengembalian'],
                    'jumlah'                  => $Total_Jumlah);
         $this->Staff_Produksi_Model->edit_pengembalian($data);
         
           $sql="SELECT * FROM penjualan WHERE id_penjualan = '$id_penjualan'"; 
           $Q=$this->db->query($sql);
            $i=$Q->row_array();
               $i['qty'];
                if($i['qty'] <= 0 ){
                    $delete="DELETE FROM penjualan WHERE id_penjualan = '$id_penjualan'";
                    $this->db->query($delete);
                }else{
                  $edit_penjualan="UPDATE penjualan SET qty = qty-'$jumlah' WHERE id_penjualan='$id_penjualan'";
                  $this->db->query($edit_penjualan);

                }
         }
        else{
         $data   = array('id_pengembalian'    => $id_pengembalian,
                         'id_produk'          => $id_produk,
                         'id_stok'            => $id_stok,
                         'id_pelanggan'       => $id_pelanggan,
                         'id_penjualan'       => $id_penjualan,
                         'tipe_sj'            => $tipe_sj,
                         'tgl'                => $tgl,
                         'jumlah'             => $jumlah,
                         'keterangan'         => $keterangan,
                    );
       $sql="SELECT * FROM penjualan WHERE id_penjualan = '$id_penjualan'"; 
       $Q=$this->db->query($sql);
        $i=$Q->row_array();
           $i['qty'];
            if($i['qty'] <= 0 ){
                $delete="DELETE FROM penjualan WHERE id_penjualan = '$id_penjualan'";
                $this->db->query($delete);
            }else{
              $edit_penjualan="UPDATE penjualan SET qty = qty-'$jumlah' WHERE id_penjualan='$id_penjualan'";
              $this->db->query($edit_penjualan);

            }
      
       


     $data= $this->Staff_Produksi_Model->simpan_pengembalian($data);
    }  

    json_encode($data);

    redirect('Staff_Produksi/data_pengembalian');
    }
    function hapus_pengembalian(){
             // $id = base64_decode($this->input->get('I'));
             // $sj = base64_decode($this->input->get('SJ'));
             // $p  = base64_decode($this->input->get('P'));
             // $t  = base64_decode($this->input->get('T'));
         
             //   $id_penjualan  = base64_decode($this->input->get('PJ'));
              $id_pengembalian =  $this->input->post('id');
               


                $sql="SELECT * FROM pengembalian WHERE id_pengembalian = '$id_pengembalian'"; 
                $Q=$this->db->query($sql);
                $i=$Q->row_array();
                    $jumlah=$i['jumlah'];
                    $id_penjualan=$i['id_penjualan'];
                    $edit_penjualan="UPDATE penjualan SET qty = qty + '$jumlah' WHERE id_penjualan='$id_penjualan'";
                    $this->db->query($edit_penjualan);
             
        
              $hapus=$this->Staff_Produksi_Model->hapus_pengembalian($id_pengembalian);
              
              redirect('Staff_Produksi/form_pengembalian?Tg='.base64_encode($t).'&P='.base64_encode($p).'&SJ='.base64_encode($sj).'&iT='.base64_encode($id));  
             
    }
    function form_edit_pengembalian(){  
        $id = base64_decode($this->input->get('x'));    
        $result = $this->Staff_Produksi_Model->get_id_pengembalian($id);
        if($result->num_rows() > 0){
            $i = $result->row_array();
            $data = array(
                'header'       => 'Edit Pengembalian',
                'title'        => 'Staff Produksi',
                'id_pengembalian'      => $i['id_pengembalian'],
                'id_produk'    => $i['id_produk'],
                'tgl'          => $i['tgl'],
                'jumlah'       => $i['jumlah']
              
            );
          $data['get'] = $this->Staff_Produksi_Model->get_nama_produk();
        
          }else{
            echo "Data Was Not Found";
             }
                $this->load->view('templet/header',$data);
                $this->load->view('templet/sidebar_staff');
                $this->load->view('staff_produksi/pengembalian/form_edit_pengembalian',$data);
                $this->load->view('templet/footer');
    }
    // function edit_stok(){
    //     $data   = array(
    //           'id_stok'      => $this->input->post('id_stok'),
    //           'id_produk'    => $this->input->post('id_produk'),
    //           'tgl_produksi' => $this->input->post('tgl_produksi'),
    //           'stok'         => $this->input->post('stok')
    //     );
    //     $update=$this->Staff_Gudang_Model->edit_stok($data);
    //     redirect('Staff_Gudang/data_stok');  

//    }
  
      //============ Surat Jalan =================//
    function data_penjualan (){

        $cari = $this->input->get('x');
        $data['no_do']=$this->Staff_Produksi_Model->no_do();
        $data['title'] = "Staff Produksi";
        $data['header'] = "Transaksi Penjualan";
        $sql="SELECT DISTINCT penjualan.tgl as tgl,pelanggan.nama as nama,penjualan.id_pelanggan,tipe_sj,id_transaksi,no_do FROM penjualan,pelanggan WHERE status='lunas' AND penjualan.id_pelanggan=pelanggan.id_pelanggan AND nama like '%$cari%'";
        $data['query']=$this->db->query($sql);
      
        $this->load->view('templet/header',$data);
        $this->load->view('templet/sidebar_staff');
        $this->load->view('staff_produksi/surat_jalan/data_penjualan',$data);
        $this->load->view('templet/footer');

    }
    function simpan_no_do(){
        $no_do         =$this->input->post('no_do');
        $id_transaksi  =$this->input->post('id_transaksi');
        $id_pelanggan  =$this->input->post('id_pelanggan');
        $tipe_sj       =$this->input->post('tipe_sj');
        $Tgl           =date_create($this->input->post('tgl'));
        $tgl           =date_format($Tgl,'Y/m/d');
        $sql="UPDATE penjualan SET no_do ='$no_do' WHERE id_transaksi='$id_transaksi' AND id_pelanggan='$id_pelanggan' AND tipe_sj ='$tipe_sj' AND tgl='$tgl' AND status='lunas' ";
        $query=$this->db->query($sql);
        // return $query; 
        redirect('Staff_Produksi/data_penjualan');  

    }
    function cetak_surat_jalan(){  
        $data['title']           ="Surat Jalan";
        $data['no_do']           = base64_decode($this->input->get('N'));
        $data['tgl']             = base64_decode($this->input->get('T'));
        $data['id_transaksi']    = base64_decode($this->input->get('IT'));
        $data['id_pelanggan']    = base64_decode($this->input->get('Ip'));
        $data['tipe_sj']         = base64_decode($this->input->get('Sj'));
        $data['nama']            = base64_decode($this->input->get('np'));
        $this->load->view('templet/header',$data);
        $this->load->view('staff_produksi/surat_jalan/cetak_surat_jalan',$data);
        
    }
}
?>