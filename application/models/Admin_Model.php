<?php
class Admin_Model extends CI_Model
{
	//==============Transaksi==============//
	function id_penjualan(){
		  $this->db->select('RIGHT(penjualan.id_penjualan,2) as id_penjualan', FALSE);
		  $this->db->order_by('id_penjualan','DESC');    
		  $this->db->limit(1);    
		  $query = $this->db->get('penjualan');  //cek dulu apakah ada sudah ada kode di tabel.    
		  if($query->num_rows() <> 0){      
			   //cek kode jika telah tersedia    
			   $data = $query->row();      
			   $kode = intval($data->id_penjualan) + 1; 
		  }
		  else{      
			   $kode = 1;  //cek jika kode belum terdapat pada table
		  }
			  $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);    
			  $id_penjualan = "TP".$batas;  //format kode
			  return $id_penjualan;  
		 }
	function id_transaksi(){
		  $id_pelanggan=$this->input->post('id_pelanggan');
		
		  $this->db->select('RIGHT(penjualan.id_transaksi,2) as id_transaksi', FALSE);
		  $this->db->order_by('id_transaksi','DESC');    
		  $this->db->limit(1);    
		  $this->db->where('status','lunas');
		  $this->db->where('id_pelanggan',$id_pelanggan);
		  $query = $this->db->get('penjualan');  //cek dulu apakah ada sudah ada kode di tabel.    
		  if($query->num_rows() <> 0){      
			   //cek kode jika telah tersedia    
			   $data = $query->row();
			   //echo$data->id_penjualan;      
			   $kode = intval($data->id_transaksi) + 1; 
		  }
		  else{      
			   $kode = 1;  //cek jika kode belum terdapat pada table
		  }
			  $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);    
			  $id_penjualan = "TR".$batas;  //format kode
			  return $id_penjualan;  
		 }
   
	function get_nama_produk($cari=null)
	{
	    $sql="SELECT DISTINCT stok_produk.id_produk,nama,harga,satuan_kg,id_stok,tgl_produksi,stok_produk,produk.kategori
             FROM stok_produk,produk WHERE produk.id_produk=stok_produk.id_produk AND stok_produk > 0 ORDER BY produk.nama,stok_produk.tgl_produksi Asc";
	    $query = $this->db->query($sql);
		return $query->result();
	}
	//==============pengguna================//
	function data_pengguna($cari=null)
    {
        
        $this->db->select('*');
        $this->db->from('pengguna');
        $this->db->order_by('nama');
        if(!empty($cari)){
        $this->db->like('nama',$cari);
        }$query = $this->db->get();
        return $query->result();
    }

   
    function simpan_pengguna($data){
		$this->db->insert('pengguna',$data);
	}
	function hapus_pengguna($id){
		$this->db->where('username',$id);
		$this->db->delete('pengguna');
	}
	
	function get_username($id){
	    $query = $this->db->get_where('pengguna', array('username' => $id));
	    return $query;
    }
    function edit_pengguna($data){

	     $username           = $data['username'];	
	     $nama               = $data['nama'];	
		 $password           = $data['password'];	
		 $akses              = $data['akses'];	
	
	    $data = array(
	      'username'           => $username,	
	      'nama'               => $nama,
		  'password'           => $password,	
		  'akses'              => $akses	
	            
	      );
	     $this->db->where('username', $username);
	     $update=$this->db->update('pengguna',$data);
	     if($update){
	    
	   	}
    }
	
    //============ Pelanggan ================
    function data_pelanggan($cari=null)
	{
		
		$this->db->select('*');
		$this->db->from('pelanggan');
		$this->db->order_by('id_pelanggan');
		if(!empty($cari)){
		$this->db->like('nama',$cari);
	    }$query = $this->db->get();
		return $query->result();
	}
	function simpan_pelanggan($data){
		$this->db->insert('pelanggan',$data);
	}
	function hapus_pelanggan($id){
		$this->db->where('id_pelanggan',$id);
		$this->db->delete('pelanggan');
	}
	function id_pelanggan(){
		  $this->db->select('RIGHT(pelanggan.id_pelanggan,2) as id_pelanggan', FALSE);
		  $this->db->order_by('id_pelanggan','DESC');    
		  $this->db->limit(1);    
		  $query = $this->db->get('pelanggan');  //cek dulu apakah ada sudah ada kode di tabel.    
		  if($query->num_rows() <> 0){      
			   //cek kode jika telah tersedia    
			   $data = $query->row();      
			   $kode = intval($data->id_pelanggan) + 1; 
		  }
		  else{      
			   $kode = 1;  //cek jika kode belum terdapat pada table
		  }
			  $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);    
			  $id_pelanggan = "P".$batas;  //format kode
			  return $id_pelanggan;  
		 }
	function get_id_pelanggan($id){
	    $query = $this->db->get_where('pelanggan', array('id_pelanggan' => $id));
	    return $query;
    }
    function edit_pelanggan($data){
	     $id_pelanggan       = $data['id_pelanggan'];	
	     $nama               = $data['nama'];	
		 $alamat             = $data['alamat'];	
		 $no_hp              = $data['no_hp'];	
         $biaya_pengiriman   = $data['biaya_pengiriman'];		 
	    $data = array(
	      'id_pelanggan'     => $id_pelanggan,
	      'nama'             => $nama,
	      'alamat'           => $alamat,
	      'no_hp'            => $no_hp,	   
	      'biaya_pengiriman' => $biaya_pengiriman
	            
	      );
	     $this->db->where('id_pelanggan', $id_pelanggan);
	     $update=$this->db->update('pelanggan',$data);
	     if($update){
	    
	   	}
    }
    
    //==========penjualan=============
	function simpan_penjualan(){
     
  
    
		return $this->db->insert('penjualan',$data);
	   
	  
	}
	function hapus_penjualan($id){
		$this->db->where('id_penjualan',$id);
		$this->db->delete('penjualan');
	}
	function hapus_no_do($id){
		$this->db->where('no_do',$id);
		$this->db->delete('surat_jalan');
	}
	function get_id_penjualan($id){
	    $query = $this->db->get_where('penjualan', array('id_penjualan' => $id));
	    return $query;
    }
    function edit_penjualan($data){
	    $data = array(
	    		  'id_penjualan' => $data['id_penjualan'],
                  'id_transaksi' => $data['id_transaksi'],
                  'id_produk'    => $data['id_produk'],
                  'id_stok'      => $data['id_stok'],
                  'qty'          => $data['qty'],
                  'no_so'        => $data['no_so'],
                 
	      );
	     $this->db->where('id_penjualan', $data['id_penjualan']);
	     $update=$this->db->update('penjualan',$data);
	    
    }
    //=============Laporan Penjualan===============
    function laporan_pertanggal($data=null)
	{ 
		$date1=$data['tgl1'];
		$date2=$data['tgl2'];
		
        // $sql="SELECT penjualan.id_produk as id_produk,
        // 			 produk.nama as nama,
        // 			 penjualan.tgl as tgl,
        // 			 produk.satuan_kg,harga,
        // 			 stok_produk.tgl_produksi as tgl_produksi,
        //     		 SUM(IF( tgl BETWEEN '$date1' AND '$date2', qty, 0)) AS qty,
        //     		 SUM(IF( tgl_produksi BETWEEN '$date1' AND '$date2', stok_produk, 0)) AS stok_in
            		 
        //     		 FROM penjualan, produk,stok_produk  
        //     		 WHERE penjualan.tgl BETWEEN '$date1' AND '$date2'
        //     		 AND penjualan.id_produk=produk.id_produk 
        //     		 AND penjualan.id_stok=stok_produk.id_stok
        //     		 AND status='lunas' 
        //     		  GROUP BY tgl asc";
        $sql="SELECT id_penjualan, 
                     produk.id_produk,
                     produk.nama,
                     produk.harga,
                     qty,
                     kg,
                     satuan_kg,
                     tgl_produksi,
                     qty,
             		 stok_produk AS stok_in,
             		 tgl
                     FROM penjualan,produk,stok_produk 
                     WHERE penjualan.id_stok=stok_produk.id_stok AND penjualan.id_produk=produk.id_produk AND status='lunas' AND tgl BETWEEN '$date1' AND '$date2'";

        $query = $this->db->query($sql);
		return $query->result();
	} 
	function laporan_perhari($data=null)
	{ 
		$date1=$data['tgl1'];
		
        $sql="SELECT id_produk,nama,tgl,harga,kg, 
             SUM(IF( tgl = '$date1', qty, 0)) AS qty
             FROM penjualan LEFT JOIN produk USING(id_produk) WHERE status='lunas' AND tgl = '$date1' GROUP BY id_produk";

        $query = $this->db->query($sql);
		return $query->result();
	} 
	function laporan_perbulan($data=null)
	{ 
		$M=$data['month'];
		$Y=$data['year'];
        $sql="SELECT id_produk,nama,tgl,harga,kg, 
             SUM(IF( MONTH(tgl) = '$M' AND YEAR(tgl)='$Y', qty, 0)) AS qty
             FROM penjualan LEFT JOIN produk USING(id_produk) WHERE status='lunas' AND MONTH(tgl) = '$M' AND YEAR(tgl)='$Y' GROUP BY tgl,id_produk";

        $query = $this->db->query($sql);
		return $query->result();
	} 
	function laporan_pertahun($data=null)
	{ 
		$Y=$data['year'];
        $sql="SELECT id_produk,nama,MONTH(tgl) as month,harga,kg, 
             SUM(IF( MONTH(tgl) BETWEEN '01' AND '12' AND YEAR(tgl)='$Y', qty, 0)) AS qty
             FROM penjualan LEFT JOIN produk USING(id_produk) WHERE status='lunas' AND MONTH(tgl) BETWEEN '01' AND '12' AND YEAR(tgl)='$Y' GROUP BY MONTH(tgl),id_produk";

        $query = $this->db->query($sql);
		return $query->result();
	} 
	function cek_stok($table,$where){		
		return $this->db->get_where($table,$where);
	}
	function cek_id_stok($table,$where){		
		return $this->db->get_where($table,$where);
	}
   //  function no_dokumen(){
   //  	  $d=date('d');
   //  	  $m=date('m');

		 //  $this->db->select('RIGHT(surat_jalan.no_dokumen,2) as no_dokumen', FALSE);
		 //  $this->db->order_by('no_dokumen','DESC');    
		 //  $this->db->limit(1);    
		 //  $query = $this->db->get('surat_jalan');  //cek dulu apakah ada sudah ada kode di tabel.    
		 //  if($query->num_rows() <> 0){      
			//    //cek kode jika telah tersedia    
			//    $data = $query->row();      
			//    $kode = intval($data->no_dokumen) + 1; 
		 //  }
		 //  else{      
			//    $kode = 1;  //cek jika kode belum terdapat pada table
		 //  }
			//   $batas = str_pad($kode,2, "0", STR_PAD_LEFT);    
			//   $no_do = "PIP-WH-".$d.'-'.$m.'.'.$batas;  //format kode
			//   return $no_do;  
		 // }
 //    function no_DO(){
 //    	  $y=substr(date('Y'),2);

	// 	  $this->db->select('RIGHT(surat_jalan.no_do,2) as no_do', FALSE);
	// 	  $this->db->order_by('no_do','DESC');    
	// 	  $this->db->limit(1);    
	// 	  $query = $this->db->get('surat_jalan');  //cek dulu apakah ada sudah ada kode di tabel.    
	// 	  if($query->num_rows() <> 0){      
	// 		   //cek kode jika telah tersedia    
	// 		   $data = $query->row();      
	// 		   $kode = intval($data->no_do) + 1; 
	// 	  }
	// 	  else{      
	// 		   $kode = 1;  //cek jika kode belum terdapat pada table
	// 	  }
	// 		  $batas = str_pad($kode, 7, "0", STR_PAD_LEFT);    
	// 		  $no_do = "DORM-".$y.$batas;  //format kode
	// 		  return $no_do;  
	// 	 }
	// function no_SO(){
 //    	  $y=substr(date('Y'),2);

	// 	  $this->db->select('RIGHT(surat_jalan.no_so,2) as no_so', FALSE);
	// 	  $this->db->order_by('no_so','DESC');    
	// 	  $this->db->limit(1);    
	// 	  $query = $this->db->get('surat_jalan');  //cek dulu apakah ada sudah ada kode di tabel.    
	// 	  if($query->num_rows() <> 0){      
	// 		   //cek kode jika telah tersedia    
	// 		   $data = $query->row();      
	// 		   $kode = intval($data->no_so) + 1; 
	// 	  }
	// 	  else{      
	// 		   $kode = 1;  //cek jika kode belum terdapat pada table
	// 	  }
	// 		  $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);    
	// 		  $no_so = "SO-".$batas;  //format kode
	// 		  return $no_so;  
	// 	 }	 
	// function delete($product_id){
	// 	$this->db->where('product_id',$product_id);
	// 	$this->db->delete('product');
	// }
	// function get_product_id($product_id){
 //    $query = $this->db->get_where('product', array('product_id' => $product_id));
 //    return $query;
 //    }
 //   function update($product_id,$product_name,$product_price){
 //    $data = array(
 //      'product_name' => $product_name,
 //      'product_price' => $product_price
 //    );
 //    $this->db->where('product_id', $product_id);
 //    $this->db->update('product', $data);
//}
}
?>