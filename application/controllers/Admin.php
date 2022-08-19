<?php
/**
 * 
 */
class Admin extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_Model');
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
        $data['title']="Admin";
        $data['header']="Dashboard";
		$this->load->view('templet/header',$data);
        $this->load->view('templet/sidebar_admin');
        $this->load->view('templet/content');
        $this->load->view('templet/footer');
      }
	}
    //=====pengguna=======///
 function simpan_pengguna(){
     $username      =  $this->input->post('username');
     $nama          =  $this->input->post('nama');
     $pasword       =  base64_encode($this->input->post('password'));
     $akses         =  $this->input->post('akses');

     $data  = array( 'username'     => $username,
                     'nama'         => $nama,
                     'password'     => $password,
                     'akses'        => $akses,
                     'status'       => 'belum aktif'
                    );
     $this->Admin_Model->simpan_pengguna($data);
     redirect('Admin/data_penguna');
    }

    function data_pengguna(){
        $cari = $this->input->get('x');
        $data['title'] = "Pengguna";
        $data['header'] = "Data Pengguna";
        $data['get'] = $this->Admin_Model->data_pengguna($cari);

        $this->load->view('templet/header',$data);
        $this->load->view('templet/sidebar_admin');
        $this->load->view('admin/pengguna/data_pengguna',$data);
        $this->load->view('templet/footer');

    }
    function hapus_pengguna(){
             $id = base64_decode($this->input->get('x'));
             $this->Admin_Model->hapus_pengguna($id);
             redirect('Admin/data_penguna');  
    }
    function form_edit_pengguna(){  
        $id = base64_decode($this->input->get('x'));
        $result = $this->Admin_Model->get_username($id);
        if($result->num_rows() > 0){
            $i = $result->row_array();
            $data = array(
                'header'       => 'Edit Pengguna',
                'title'        => 'Manager',
                'username'           => $i['username'],  
                'nama'               => $i['nama'],
                'password'           => $i['password'],  
                'akses'              => $i['akses'],
                'status'             => $i['status']
            );
          }else{
            echo "Data Was Not Found";
             }
                $this->load->view('templet/header',$data);
                $this->load->view('templet/sidebar_admin');
                $this->load->view('admin/pengguna/form_edit_pengguna',$data);
                $this->load->view('templet/footer');
    }
    function edit_pengguna(){

        $data   = array(
               'username'      =>  $this->input->post('username'),
               'nama'          =>  $this->input->post('nama'),
               'password'       => base64_encode($this->input->post('password')),
               'akses'         =>  $this->input->post('akses')
             
        );
        $update=$this->Admin_Model->edit_pengguna($data);
        redirect('Admin/data_pengguna');  

    }
    function aktivasi_pengguna(){
            $username  = $this->input->post('username');
           
            $data = [
              'akses'     => $this->input->post('akses'),
              'status'    => 'aktif'
            ];
            
            $this->db->where('username', $username);
            $this->db->update('pengguna',$data);
                redirect('Admin/data_pengguna');  

      }
     function registrasi(){
     $username      =  $this->input->post('username');
     $nama          =  $this->input->post('nama');
     $password       = base64_encode($this->input->post('password'));
     // $akses         =  $this->input->post('akses');

     $data  = array( 'username'     => $username,
                     'nama'         => $nama,
                     'password'     => $password,
                     'akses'        => '',
                     'status'       => 'belum aktif'
                    );
     $this->Admin_Model->simpan_pengguna($data);
     redirect('Login');
    }
  
     //============ Pelanggan =================//
    function data_pelanggan(){
        $cari = $this->input->get('x');
        $data['title'] = "Admin";
        $data['header'] = "Data Pelanggan";
        $data['get'] = $this->Admin_Model->data_pelanggan($cari);

        $this->load->view('templet/header',$data);
        $this->load->view('templet/sidebar_admin');
        $this->load->view('admin/pelanggan/data_pelanggan',$data);
        $this->load->view('templet/footer');

    }
    function form_pelanggan(){
        $id_pelanggan=$this->Admin_Model->id_pelanggan();
        $data['title']    = "Staff Gudang";
        $data['header']   ="Form Pelanggan";
        $data['id_pelanggan']= $id_pelanggan;
        
        $this->load->view('templet/header',$data);
        $this->load->view('templet/sidebar_admin',$data);
        $this->load->view('admin/pelanggan/form_pelanggan',$data);
        $this->load->view('templet/footer');
    }
    function simpan_pelanggan(){
     $id_pelanggan     =  $this->input->post('id_pelanggan');
     $nama             =  $this->input->post('nama');
     $alamat           =  $this->input->post('alamat');
     $biaya_pengiriman =   preg_replace("/[^0-9]/","",$this->input->post('biaya_pengiriman'));
     $no_hp            =  $this->input->post('no_hp');
    
     $data  = array( 'id_pelanggan'     => $id_pelanggan,
                     'nama'             => $nama,
                     'alamat'           => $alamat,
                     'no_hp'            => $no_hp,
                     'biaya_pengiriman' => $biaya_pengiriman
                    );
     $this->Admin_Model->simpan_pelanggan($data);
     redirect('admin/data_pelanggan');
    }
    function hapus_pelanggan(){
             $id = base64_decode($this->input->get('x'));
             $this->Admin_Model->hapus_pelanggan($id);
             redirect('admin/data_pelanggan');  
    }
    function form_edit_pelanggan(){  
        $id = base64_decode($this->input->get('x'));
        $result = $this->Admin_Model->get_id_pelanggan($id);
        if($result->num_rows() > 0){
            $i = $result->row_array();
            $data = array(
                'header'       => 'Edit Pelanggan',
                'title'        => 'Admin',
                'id_pelanggan' => $i['id_pelanggan'],
                'nama'         => $i['nama'],
                'alamat'       => $i['alamat'],
                'no_hp'        => $i['no_hp'],
                'biaya_pengiriman' => $i['biaya_pengiriman'],
            );
          }else{
            echo "Data Was Not Found";
             }
                $this->load->view('templet/header',$data);
                $this->load->view('templet/sidebar_admin');
                $this->load->view('admin/pelanggan/form_edit_pelanggan',$data);
                $this->load->view('templet/footer');
    }
    function edit_pelanggan(){
        $data   = array(
              'id_pelanggan'     => $this->input->post('id_pelanggan'),
              'nama'             => $this->input->post('nama'),
              'alamat'           => $this->input->post('alamat'),
              'no_hp'            => $this->input->post('no_hp'),
              'biaya_pengiriman' =>  preg_replace("/[^0-9]/","",$this->input->post('biaya_pengiriman'))
             
        );
        $update=$this->Admin_Model->edit_pelanggan($data);
        redirect('Admin/data_pelanggan');  
    }
      //============ Penjualan=================//
    function data_penjualan (){

        $cari = $this->input->get('x');
        $data['title'] = "Admin";
        $data['header'] = "Transaksi Penjualan";
        $nama_pelanggan =$this->Admin_Model->data_pelanggan();
        $data['nama_pelanggan'] = $nama_pelanggan;
        $sql="SELECT DISTINCT penjualan.tgl as tgl,pelanggan.nama as nama,penjualan.id_pelanggan,tipe_sj,id_transaksi,pembayaran FROM penjualan,pelanggan WHERE status='lunas' AND penjualan.id_pelanggan=pelanggan.id_pelanggan AND nama like '%$cari%'";
        $data['query']=$this->db->query($sql);
      
        $this->load->view('templet/header',$data);
        $this->load->view('templet/sidebar_admin');
        $this->load->view('admin/penjualan/data_penjualan',$data);
        $this->load->view('templet/footer');

    }
    // function tabel_surat_jalan(){
    //    return $data['Get'] = $this->Staff_Gudang_Model->tabel_surat_jalan($cek1);
    // }
    function form_penjualan(){

        $id_pelanggan=$this->input->post('id_pelanggan');
        $data['biaya_pengiriman']=$this->input->post('biaya_pengiriman');
        $id_penjualan   =$this->Admin_Model->id_penjualan();
        $id_transaksi   =$this->Admin_Model->id_transaksi();
        $nama_barang    =$this->Admin_Model->get_nama_produk();
        $nama_pelanggan =$this->Admin_Model->data_pelanggan();
        $data['title']       ="Transaksi Penjualan";
        $data['header']      ="Form Transaksi Penjualan";
        $data['nama_produk'] = $nama_barang;
        $data['nama_pelanggan'] = $nama_pelanggan;
        $data['id_penjualan'] = $id_penjualan;
        $data['id_transaksi'] = $id_transaksi;
        $this->load->view('templet/header',$data);
        $this->load->view('templet/sidebar_admin');
        $this->load->view('admin/penjualan/form_penjualan',$data);
        $this->load->view('templet/footer');
    }
    function form_edit_penjualan(){  
        $id = $this->input->get('id');
        $data['title']       ="Penjualan";
        $result = $this->Admin_Model->get_id_penjualan($id);
        $nama_barang =$this->Admin_Model->get_nama_produk();
        if($result->num_rows() > 0){
            $i = $result->row_array();
            //mengambil tgl produksi di table stok_produksi
            $id_stok= $i['id_stok'];
            $Sql="SELECT * FROM stok_produk WHERE id_stok='$id_stok'";
            $query=$this->db->query($Sql);
            $idStok = $query->row_array();

            $id_pelanggan=$i['id_pelanggan'];
            $mysql="SELECT * FROM pelanggan WHERE id_pelanggan='$id_pelanggan'";
            $Q=$this->db->query($mysql);
            $pelanggan=$Q->row_array();

            $data = array(
                  'header'       => 'Edit Penjualan',
                  'title'        => 'Admin',
                  'id_transaksi' => $i['id_transaksi'],
                  'id_penjualan' => $i['id_penjualan'],
                  'id_pelanggan' => $i['id_pelanggan'],
                  'id_produk'    => $i['id_produk'],
                  'id_stok'      => $i['id_stok'],
                  'tipe_sj'      => $i['tipe_sj'],
                  'qty'          => $i['qty'],    
                  'kg'           => $i['kg'],
                  'no_so'        => $i['no_so'],
                  'tgl_produksi' => $idStok['tgl_produksi'],
                  'biaya_pengiriman' => $pelanggan['biaya_pengiriman'],
                  'nama_produk'  => $nama_barang
            );
          }else{
            echo "Data Was Not Found";
             }     
                $this->load->view('admin/penjualan/form_edit_penjualan',$data);
        }
    function simpan_penjualan(){
       $data  = array(
                      'id_penjualan' => $this->input->post('id_penjualan',true),
                      'id_transaksi' => $this->input->post('id_transaksi',true),
                      'id_pelanggan' => $this->input->post('id_pelanggan',true),
                      'id_produk'    => $this->input->post('id_produk',true),
                      'kategori'     => $this->input->post('kategori',true),
                      'id_stok'      => $this->input->post('id_stok',true),
                      'no_so'        => $this->input->post('no_so',true),
                      'qty'          => $this->input->post('qty',true),
                      'kg'           => $this->input->post('kg',true),
                      'tgl'          => $this->input->post('tgl',true),
                      'tipe_sj'      => $this->input->post('tipe_sj',true),
                      'status'       => 'belum lunas'
                    );

            $qty = $this->input->post('qty');
            $id_stok  =  array('id_stok' => $this->input->post('id_stok'));               
           //update stok
             $get_stok = $this->Admin_Model->cek_stok("stok_produk",$id_stok);
             $i = $get_stok->row_array();
             $Total_Stok = $i['stok_produk']-$qty;
             $id_stok  =  $this->input->post('id_stok');
            
             $sql="UPDATE stok_produk SET stok_produk = '$Total_Stok' WHERE id_stok='$id_stok'";
             $this->db->query($sql);
             json_encode($data);
             header('Admin/form_penjualan'); 
             
             return $this->db->insert('penjualan',$data);
             $this->Admin_Model->simpan_penjualan($data);


    

       

         // $data=$this->Admin_Model->simpan_penjualan($data);
        // json_encode($data);
       
     // echo $pesan;
     // header('Admin/simpan_penjualan');
             
    }

    function edit_penjualan(){
            $qty          = $this->input->post('qty');
            $id_produk    = $this->input->post('id_produk');
            $id           = $this->input->post('id_penjualan');
            $no_so        = $this->input->post('no_so');
          $sql="SELECT * FROM stok_produk WHERE id_produk='$id_produk' AND stok_produk > 0 ORDER BY stok_produk.tgl_produksi ASC";
          $query=$this->db->query($sql);
          $num=$query->num_rows();
          if($num>1){
            $no=1;
            $n=0;
            $result = array();
            $data_update = array();
            foreach ($query->result() as $row) {
              $N=$no++;
              $Sql="SELECT * FROM stok_produk WHERE id_produk='$row->id_produk' AND stok_produk > 0 ORDER BY stok_produk.tgl_produksi ASC";
              $Query=$this->db->query($Sql);
              $stk=$Query->row_array();
                    $tgl_produksi=$stk['tgl_produksi'];
                    $id_stok     =$stk['id_stok'];
                    $stok_produk =$stk['stok_produk'];
                if($qty > $stok_produk){
                  $sisa= $qty - $stok_produk;
                  $Qty=$qty-$sisa;
                  $Ar=['',$Qty,$sisa];
                     $get_stok ="SELECT * FROM stok_produk WHERE id_stok='$row->id_stok'";
                     $query=$this->db->query($get_stok);
                     $i = $query->row_array();
                     $Total_Stok[$N] = $i['stok_produk'] - $qty + $Ar[$N];
                     $data_update[]= array(
                         'id_stok' => $row->id_stok,
                         'stok_produk' => $Total_Stok[$N]
                     );
                  }else{
              
               }

             }
              $this->db->update_batch('stok_produk', $data_update,'id_stok');

          }else{
                     $id_p= array('id_penjualan'=>$this->input->post('id_penjualan'));
                     $cek_id=$this->Admin_Model->cek_id_stok("penjualan",$id_p);
                     $p = $cek_id->row_array();
                     $p['id_stok'];
                     $id_stok= array('id_stok' => $p['id_stok']);
                       $get_stok = $this->Admin_Model->cek_stok("stok_produk",$id_stok);
                       $i = $get_stok->row_array();
                       if($qty>$p['qty']){ 
                           $Total_Stok = $i['stok_produk'] - $qty+$p['qty'];
                           $id_stok  =  $i['id_stok'];
                           $sql="UPDATE stok_produk SET stok_produk = '$Total_Stok' WHERE id_stok='$id_stok'";
                           $this->db->query($sql);
                        }else{

                           $Total_Stok = $i['stok_produk'] + $p['qty']-$qty;
                           $id_stok  =  $i['id_stok'];
                           $sql="UPDATE stok_produk SET stok_produk = '$Total_Stok' WHERE id_stok='$id_stok'";
                           $this->db->query($sql);

                        }

                    $id_stok=$query->row_array();
                    $data   = array(
                          'id_penjualan' => $this->input->post('id_penjualan'),
                          'id_transaksi' => $this->input->post('id_transaksi'),
                          'id_produk'    => $this->input->post('id_produk'),
                          'id_stok'      => $id_stok['id_stok'],
                          'no_so'        => $this->input->post('no_so'),
                          'qty'          => $this->input->post('qty')
                         
                    );
                    $update=$this->Admin_Model->edit_penjualan($data);
                    header('Admin/form_penjualan');  

          } 

               // $sql="SELECT * FROM stok_produk WHERE id_produk='$id_produk' AND stok_produk > 0";
            // $query=$this->db->query($sql);
            // $tgl_p=$query->row_array();
            // foreach ($query->result() as $row):
            //          $id_p= array('id_penjualan'=>$this->input->post('id_penjualan'));
            //          $cek_id=$this->Admin_Model->cek_id_stok("penjualan",$id_p);
            //          $p = $cek_id->row_array();
            //          $p['id_stok'];
            //          $id_stok= array('id_stok' => $p['id_stok']);
            //            $get_stok = $this->Admin_Model->cek_stok("stok_produk",$id_stok);
            //            $i = $get_stok->row_array();
            //            if($qty>$p['qty']){ 
            //                $Total_Stok = $i['stok_produk'] - $qty+$p['qty'];
            //                $id_stok  =  $i['id_stok'];
            //                $sql="UPDATE stok_produk SET stok_produk = '$Total_Stok' WHERE id_stok='$id_stok'";
            //                $this->db->query($sql);
            //             }else{

            //                $Total_Stok = $i['stok_produk'] + $p['qty']-$qty;
            //                $id_stok  =  $i['id_stok'];
            //                $sql="UPDATE stok_produk SET stok_produk = '$Total_Stok' WHERE id_stok='$id_stok'";
            //                $this->db->query($sql);

            //             }
            //         $data   = array(
            //               'id_penjualan' => $this->input->post('id_penjualan'),
            //               'id_transaksi' => $this->input->post('id_transaksi'),
            //               'id_produk'    => $this->input->post('id_produk'),
            //               'id_stok'      => $this->input->post('id_stok'),
            //               'no_so'        => $this->input->post('no_so'),
            //               'qty'          => $this->input->post('qty')
                         
            //         );
            //         $update=$this->Admin_Model->edit_penjualan($data);
            //         header('Admin/form_penjualan');  
                    
    }
    function hapus_penjualan(){
             $id = $this->input->post('id');
             $id_p= array('id_penjualan'=>$this->input->post('id'));
             $cek_id=$this->Admin_Model->cek_id_stok("penjualan",$id_p);
             $p = $cek_id->row_array();
             $p['id_stok'];
             $id_stok= array('id_stok' => $p['id_stok']);
               $get_stok = $this->Admin_Model->cek_stok("stok_produk",$id_stok);
               $i = $get_stok->row_array();
               $Total_Stok = $i['stok_produk'] + $p['qty'];
               $id_stok  =  $i['id_stok'];
                   $sql="UPDATE stok_produk SET stok_produk = '$Total_Stok' WHERE id_stok='$id_stok'";
                   $this->db->query($sql);
             $this->Admin_Model->hapus_penjualan($id);
             header('Admin/form_penjualan');  
    }
    
    function bayar(){
        // $id_transaksi=base64_decode($this->input->get('T'));
        // $id_pelanggan=base64_decode($this->input->get('P'));
        // $pembayaran="Tunai";
        $id_transaksi=($this->input->post('T'));
        $id_pelanggan=($this->input->post('P'));
        $pembayaran=($this->input->post('metode_pembayaran'));
         
        $sql="UPDATE penjualan SET status = 'lunas', pembayaran='$pembayaran' WHERE id_pelanggan = '$id_pelanggan' AND id_transaksi = '$id_transaksi'";
        $this->db->query($sql);

        redirect('Admin/data_penjualan');  
    }
    function cetak_penjualan(){
        $id_transaksi=base64_decode($this->input->get('T'));
        $id_pelanggan=base64_decode($this->input->get('P'));
        $tipe_sj=base64_decode($this->input->get('S'));
        $tgl=base64_decode($this->input->get('Tg'));
        $pembayaran=base64_decode($this->input->get('PmB'));
        
        $sql="SELECT * FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'";
        $data['query']=$this->db->query($sql);

        $sql2="SELECT * FROM penjualan WHERE id_pelanggan ='$id_pelanggan' AND id_transaksi ='$id_transaksi' AND tgl ='$tgl' AND status ='lunas'";
        $data['query2']=$this->db->query($sql2);
        $data['tipe_sj']= $tipe_sj;
        $data['pembayaran']=$pembayaran;
        $data['header']='Cetak Penjualan'; 
        $data['title']='Cetak Penjualan';
        $this->load->view('templet/header',$data);
       // $this->load->view('templet/sidebar_admin');
        $this->load->view('admin/penjualan/cetak_penjualan',$data);
        header('Admin/data_penjualan');     
     }
     //========== Laporan Penjualan=============/
     function laporan_pertanggal(){
        $data['tgl1']=$this->input->post('date1');
        $data['tgl2']=$this->input->post('date2');
        

        $data['query']=$this->Admin_Model->laporan_pertanggal($data);
        
        $date1=$this->input->post('date1');
        $date2=$this->input->post('date2');
        $data['title']       ="Laporan Penjualan";
        $data['header']      ="Laporan Penjualan Pertanggal";
     
        $this->load->view('templet/header',$data);
        $this->load->view('templet/sidebar_admin');
        $this->load->view('admin/laporan/laporan_pertanggal',$data);
        $this->load->view('templet/footer');


     }
    function cetak_laporan_pertanggal(){
        $data['tgl1']=base64_decode($this->input->get('d'));
        $data['tgl2']=base64_decode($this->input->get('D'));


        $data['query']=$this->Admin_Model->laporan_pertanggal($data);
        
        $date1=base64_decode($this->input->get('d'));
        $date2=base64_decode($this->input->get('D'));

        $data['title']       ="Laporan Penjualan Pertanggal";
        $data['header']      ="Laporan Penjualan Pertanggal";
     
        $this->load->view('templet/header',$data);
        $this->load->view('admin/laporan/cetak_laporan_pertanggal',$data);
    
     }
      function export_laporan_pertanggal(){
        $data['tgl1']=base64_decode($this->input->get('d'));
        $data['tgl2']=base64_decode($this->input->get('D'));


        $data['query']=$this->Admin_Model->laporan_pertanggal($data);
        
        $date1=base64_decode($this->input->get('d'));
        $date2=base64_decode($this->input->get('D'));

        $data['title']       ="Laporan Penjualan";
        $data['header']      ="Laporan Penjualan Pertanggal";
     
        $this->load->view('admin/laporan/export_laporan_pertanggal',$data);
    
     }
     //Hari
     function laporan_perhari(){
        $data['tgl1']=$this->input->post('date1');


        $data['query']=$this->Admin_Model->laporan_perhari($data);
        
        $date1=$this->input->post('date1');
        $date2=$this->input->post('date2');
        $data['title']       ="Laporan Perhari";
        $data['header']      ="Laporan Penjualan Perhari";
     
        $this->load->view('templet/header',$data);
        $this->load->view('templet/sidebar_admin');
        $this->load->view('admin/laporan/laporan_perhari',$data);
        $this->load->view('templet/footer');

     }
    function cetak_laporan_perhari(){
        $data['tgl1']=base64_decode($this->input->get('d'));


        $data['query']=$this->Admin_Model->laporan_perhari($data);
        
        $date1=base64_decode($this->input->get('d'));
        $date2=base64_decode($this->input->get('D'));

        $data['title']       ="Laporan Perhari";
        $data['header']      ="Laporan Penjualan Perhari";
     
        $this->load->view('templet/header',$data);
        $this->load->view('admin/laporan/cetak_laporan_perhari',$data);
    
     }
      function export_laporan_perhari(){
        $data['tgl1']=base64_decode($this->input->get('d'));
    

        $data['query']=$this->Admin_Model->laporan_perhari($data);
        
        $date1=base64_decode($this->input->get('d'));
      
        $data['title']       ="Laporan Penjualan Perhari";
        $data['header']      ="Laporan Penjualan Perhari";
     
        $this->load->view('admin/laporan/export_laporan_perhari',$data);
    
     }
     //Bulan
     function laporan_perbulan(){
        $data['month']=substr($this->input->post('date1'),5);
        $data['year']=substr($this->input->post('date1'),0,4);

        $data['query']=$this->Admin_Model->laporan_perbulan($data);
        
        $date1=$this->input->post('date1');
        
        $data['title']       ="Laporan Perbulan";
        $data['header']      ="Laporan Penjualan Perbulan";
     
        $this->load->view('templet/header',$data);
        $this->load->view('templet/sidebar_admin');
        $this->load->view('admin/laporan/laporan_perbulan',$data);
        $this->load->view('templet/footer');

     }
    function cetak_laporan_perbulan(){
        $data['month']=base64_decode($this->input->get('m'));
        $data['year']=base64_decode($this->input->get('Y'));

        $data['query']=$this->Admin_Model->laporan_perbulan($data);
        
        $date1=base64_decode($this->input->get('d'));
        $date2=base64_decode($this->input->get('D'));

        $data['title']       ="Laporan Perbulan";
        $data['header']      ="Laporan Penjualan Perbulan";
     
        $this->load->view('templet/header',$data);
        $this->load->view('admin/laporan/cetak_laporan_perbulan',$data);
    
     }
      function export_laporan_perbulan(){
        $data['month']=base64_decode($this->input->get('m'));
        $data['year']=base64_decode($this->input->get('Y'));
  

        $data['query']=$this->Admin_Model->laporan_perbulan($data);
 
        $data['title']       ="Laporan Penjualan";
        $data['header']      ="Laporan Penjualan Perbulan";
     
        $this->load->view('admin/laporan/export_laporan_perbulan',$data);
    
     }
       //Tahun
     function laporan_pertahun(){
        $data['year']=$this->input->post('year');
  
        $data['query']=$this->Admin_Model->laporan_pertahun($data);
        
        $data['title']       ="Laporan Pertahun";
        $data['header']      ="Laporan Penjualan Pertahun";
     
        $this->load->view('templet/header',$data);
        $this->load->view('templet/sidebar_admin');
        $this->load->view('admin/laporan/laporan_pertahun',$data);
        $this->load->view('templet/footer');

     }
    function cetak_laporan_pertahun(){
        $data['year']=base64_decode($this->input->get('Y'));

        $data['query']=$this->Admin_Model->laporan_pertahun($data);
        
        $data['title']       ="Laporan Pertahun";
        $data['header']      ="Laporan Penjualan Pertahun";
     
        $this->load->view('templet/header',$data);
        $this->load->view('admin/laporan/cetak_laporan_pertahun',$data);
    
     }
      function export_laporan_pertahun(){
        $data['year']=base64_decode($this->input->get('Y'));
  

        $data['query']=$this->Admin_Model->laporan_pertahun($data);
 
        $data['title']       ="Laporan Penjualan";
        $data['header']      ="Laporan Penjualan Pertahun";
     
        $this->load->view('admin/laporan/export_laporan_pertahun',$data);
    
     }
   

}
?>