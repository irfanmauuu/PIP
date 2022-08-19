<?php
class Staff_Produksi_Model extends CI_Model
{
	
    function data_kategori($cari=null)
	{
		
		$this->db->select('*');
		$this->db->from('kategori');
		$this->db->order_by('id_kategori');
		if(!empty($cari)){
		$this->db->like('nama_kategori',$cari);
	    }$query = $this->db->get();
		return $query->result();
	}
    function get_nama_kategori($cari=null)
	{
		$this->db->distinct();
		$this->db->select('nama_kategori');
		$this->db->from('kategori');
		$this->db->order_by('id_kategori');
		if(!empty($cari)){
		$this->db->like('nama_kategori',$cari);
	    }$query = $this->db->get();
		return $query->result();
	}
    
	function simpan_kategori($data){
		$this->db->insert('kategori',$data);
	}
	function hapus_kategori($id){
		$this->db->where('id_kategori',$id);
		$this->db->delete('kategori');
	}
	function id_kategori(){
		  $this->db->select('RIGHT(kategori.id_kategori,2) as id_kategori', FALSE);
		  $this->db->order_by('id_kategori','DESC');    
		  $this->db->limit(1);    
		  $query = $this->db->get('kategori');  //cek dulu apakah ada sudah ada kode di tabel.    
		  if($query->num_rows() <> 0){      
			   //cek kode jika telah tersedia    
			   $data = $query->row();      
			   $kode = intval($data->id_kategori) + 1; 
		  }
		  else{      
			   $kode = 1;  //cek jika kode belum terdapat pada table
		  }
			  $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);    
			  $id_kategori = "K".$batas;  //format kode
			  return $id_kategori;  
		 }
	function get_id_kategori($id){
	    $query = $this->db->get_where('kategori', array('id_kategori' => $id));
	    return $query;
    }
    function edit_kategori($data){
	    $id_kategori        =$data['id_kategori'];	
	    $nama_kategori      =$data['nama_kategori'];	
	 
	    $data = array(
	      'id_kategori'        => $id_kategori,
	      'nama_kategori'      => $nama_kategori      
	      );
	    $this->db->where('id_kategori', $id_kategori);
	     $update=$this->db->update('kategori',$data);
	     if($update){
	    
	   	}
    }
    //============ BARANG/ PRODUK ================
    function data_produk($cari=null)
	{
		
		$this->db->select('*');
		$this->db->from('produk');
		$this->db->order_by('id_produk');
		if(!empty($cari)){
		$this->db->like('nama',$cari);
	    }$query = $this->db->get();
		return $query->result();
	}
	function get_nama_produk($cari=null)
	{
		$this->db->distinct();
		$this->db->select('*');
		$this->db->from('produk');
		$this->db->order_by('nama');
		if(!empty($cari)){
		$this->db->like('nama',$cari);
	    }$query = $this->db->get();
		return $query->result();
	}

	function simpan_produk($data){
		$this->db->insert('produk',$data);
	}
	function hapus_produk($id){
		$this->db->where('id_produk',$id);
		$this->db->delete('produk');
	}
	function id_produk(){
		  $this->db->select('RIGHT(produk.id_produk,2) as id_produk', FALSE);
		  $this->db->order_by('id_produk','DESC');    
		  $this->db->limit(1);    
		  $query = $this->db->get('produk');  //cek dulu apakah ada sudah ada kode di tabel.    
		  if($query->num_rows() <> 0){      
			   //cek kode jika telah tersedia    
			   $data = $query->row();      
			   $kode = intval($data->id_produk) + 1; 
		  }
		  else{      
			   $kode = 1;  //cek jika kode belum terdapat pada table
		  }
			  $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);    
			  $id_produk = "PK".$batas;  //format kode
			  return $id_produk;  
		 }
	
    function edit_produk($data){
	     $id_produk          = $data['id_produk'];	
	     $nama               = $data['nama'];	
		 $kategori           = $data['kategori'];	
		 $harga              = $data['harga'];	
		 $kg                 = $data['kg'];	
		 $total_beras        = $data['total_beras'];	
	    $data = array(
	      'id_produk'        => $id_produk,
	      'nama'             => $nama,
	      'kategori'         => $kategori,
	      'satuan_kg'        => $kg,
	      'harga'            => $harga,
	      'total_beras'      => $total_beras,
	            
	      );
	    $this->db->where('id_produk', $id_produk);
	     $update=$this->db->update('produk',$data);
	     if($update){
	    
	   	}
    }
    function get_id_produk($id){
	    $query = $this->db->get_where('produk', array('id_produk' => $id));
	    return $query;
    } 
 //    //============ Pelanggan ================
 //    function data_pelanggan($cari=null)
	// {
		
	// 	$this->db->select('*');
	// 	$this->db->from('pelanggan');
	// 	$this->db->order_by('id_pelanggan');
	// 	if(!empty($cari)){
	// 	$this->db->like('nama',$cari);
	//     }$query = $this->db->get();
	// 	return $query->result();
	// }
	// function simpan_pelanggan($data){
	// 	$this->db->insert('pelanggan',$data);
	// }
	// function hapus_pelanggan($id){
	// 	$this->db->where('id_pelanggan',$id);
	// 	$this->db->delete('pelanggan');
	// }
	// function id_pelanggan(){
	// 	  $this->db->select('RIGHT(pelanggan.id_pelanggan,2) as id_pelanggan', FALSE);
	// 	  $this->db->order_by('id_pelanggan','DESC');    
	// 	  $this->db->limit(1);    
	// 	  $query = $this->db->get('pelanggan');  //cek dulu apakah ada sudah ada kode di tabel.    
	// 	  if($query->num_rows() <> 0){      
	// 		   //cek kode jika telah tersedia    
	// 		   $data = $query->row();      
	// 		   $kode = intval($data->id_pelanggan) + 1; 
	// 	  }
	// 	  else{      
	// 		   $kode = 1;  //cek jika kode belum terdapat pada table
	// 	  }
	// 		  $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);    
	// 		  $id_pelanggan = "P".$batas;  //format kode
	// 		  return $id_pelanggan;  
	// 	 }
	// function get_id_pelanggan($id){
	//     $query = $this->db->get_where('pelanggan', array('id_pelanggan' => $id));
	//     return $query;
 //    }
 //    function edit_pelanggan($data){
	//      $id_pelanggan       = $data['id_pelanggan'];	
	//      $nama               = $data['nama'];	
	// 	 $alamat             = $data['alamat'];	
	// 	 $no_hp              = $data['no_hp'];	
	 
	//     $data = array(
	//       'id_pelanggan'   => $id_pelanggan,
	//       'nama'           => $nama,
	//       'alamat'         => $alamat,
	//       'no_hp'          => $no_hp
	            
	//       );
	//     $this->db->where('id_pelanggan', $id_pelanggan);
	//      $update=$this->db->update('pelanggan',$data);
	//      if($update){
	    
	//    	}
 //    }

    //============ Stok ================//

     function laporan_stok($data=null)
	{ 
		$date1=$data['tgl1'];
		$date2=$data['tgl2'];
		$id_produk=$data['id_produk'];
		$kategori=$data['kategori'];
		if($id_produk !=="" && $kategori !==""){
		$sql="  SELECT kategori,`tgl_produksi`,id_stok,id_produk, stok_in, stok_out, @temp :=  stok_in  AS total
				FROM ( SELECT kategori,`tgl_produksi`,id_produk,id_stok, SUM(stok_produk) as stok_in, SUM(qty)AS stok_out
				FROM ( SELECT kategori,`tgl_produksi`,id_produk,id_stok, stok_produk, 0 qty FROM stok_produk 
				UNION ALL 
				SELECT kategori,tgl, id_produk,id_stok, 0, qty FROM penjualan WHERE status='lunas') total
				GROUP BY id_stok ) summarized, ( SELECT @temp := 0 ) variable WHERE id_produk='$id_produk' AND tgl_produksi BETWEEN '$date1' AND '$date2' AND kategori='$kategori' ORDER by tgl_produksi ";
       
		
        $query = $this->db->query($sql);
		return $query->result();
	    }else if($id_produk =="" && $kategori ==""){
	    		$sql="  SELECT kategori,`tgl_produksi`,id_stok,id_produk, stok_in, stok_out, @temp :=  stok_in  AS total
				FROM ( SELECT kategori,`tgl_produksi`,id_produk,id_stok, SUM(stok_produk) as stok_in, SUM(qty)AS stok_out
				FROM ( SELECT kategori,`tgl_produksi`,id_produk,id_stok, stok_produk, 0 qty FROM stok_produk 
				UNION ALL 
				SELECT kategori,tgl, id_produk,id_stok, 0, qty FROM penjualan WHERE status='lunas') total
				GROUP BY id_stok ) summarized, ( SELECT @temp := 0 ) variable WHERE tgl_produksi BETWEEN '$date1' AND '$date2' ORDER by tgl_produksi ";
       
		
        $query = $this->db->query($sql);
		return $query->result();
	    }else if($id_produk =="" && $kategori !==""){
              $sql="  SELECT kategori,`tgl_produksi`,id_stok,id_produk, stok_in, stok_out, @temp :=  stok_in  AS total
				FROM ( SELECT kategori,`tgl_produksi`,id_produk,id_stok, SUM(stok_produk) as stok_in, SUM(qty)AS stok_out
				FROM ( SELECT kategori,`tgl_produksi`,id_produk,id_stok, stok_produk, 0 qty FROM stok_produk 
				UNION ALL 
				SELECT kategori,tgl, id_produk,id_stok, 0, qty FROM penjualan WHERE status='lunas') total
				GROUP BY id_stok ) summarized, ( SELECT @temp := 0 ) variable WHERE tgl_produksi BETWEEN '$date1' AND '$date2' AND kategori='$kategori' ORDER by tgl_produksi ";
       
		
        $query = $this->db->query($sql);
		return $query->result(); 
	    }
	    else if($id_produk !=="" && $kategori ==""){
              $sql="  SELECT kategori,`tgl_produksi`,id_stok,id_produk, stok_in, stok_out, @temp :=  stok_in  AS total
				FROM ( SELECT kategori,`tgl_produksi`,id_produk,id_stok, SUM(stok_produk) as stok_in, SUM(qty)AS stok_out
				FROM ( SELECT kategori,`tgl_produksi`,id_produk,id_stok, stok_produk, 0 qty FROM stok_produk 
				UNION ALL 
				SELECT kategori,tgl, id_produk,id_stok, 0, qty FROM penjualan WHERE status='lunas') total
				GROUP BY id_stok ) summarized, ( SELECT @temp := 0 ) variable WHERE tgl_produksi BETWEEN '$date1' AND '$date2' AND id_produk='$id_produk' ORDER by tgl_produksi ";
       
		
        $query = $this->db->query($sql);
		return $query->result(); 
	    }
	} 
    function cek_stok($table,$where){		
		return $this->db->get_where($table,$where);
	}
    function data_stok($cari=null)
	{
		$sql="SELECT tgl_produksi,nama,produk.kategori,harga,id_stok,stok_produk,produk.satuan_kg
             FROM stok_produk,produk WHERE produk.id_produk=stok_produk.id_produk AND tgl_produksi >= DATE_ADD(NOW(), INTERVAL -3 MONTH) AND nama like '%$cari%' ";
		$query=$this->db->query($sql);
		return $query->result();
	}
	function simpan_stok($data){
		$this->db->insert('stok_produk',$data);
	}
	function hapus_stok($id){
		$this->db->where('id_stok',$id);
		$this->db->delete('stok_produk');
	}
	function id_stok(){
		  $this->db->select('RIGHT(stok_produk.id_stok,2) as id_stok', FALSE);
		  $this->db->order_by('id_stok','DESC');    
		  $this->db->limit(1);    
		  $query = $this->db->get('stok_produk'); //cek dulu apakah ada sudah ada kode di tabel.    
		  if($query->num_rows() <> 0){      
			   //cek kode jika telah tersedia    
			   $data = $query->row();      
			   $kode = intval($data->id_stok) + 1; 
		  }
		  else{      
			   $kode = 1;  //cek jika kode belum terdapat pada table
		  }
			  $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);    
			  $id_stok = "s".$batas;  //format kode
			  return $id_stok;  
		 }
	function get_id_stok($id){
	    $query = $this->db->get_where('stok_produk', array('id_stok' => $id));
	    return $query;
    }
    function edit_stok($data){
	     $id_stok            = $data['id_stok'];	
	     $id_produk          = $data['id_produk'];	
		 $tgl_produksi       = $data['tgl_produksi'];	
		 $stok               = $data['stok'];	
	 
	    $data = array(
	      'id_produk'      => $id_produk,
	      'tgl_produksi'   => $tgl_produksi,
	      'stok_produk'    => $stok
	            
	      );
	    $this->db->where('id_stok', $id_stok);
	     $update=$this->db->update('stok_produk',$data);
	     if($update){
	    
	   	}
    }
    //Pengembalian Prduk
    function cek_pengembalian($table,$where){		
		return $this->db->get_where($table,$where);
	}
    function id_pengembalian(){
		  $this->db->select('RIGHT(pengembalian.id_pengembalian,2) as id_pengembalian', FALSE);
		  $this->db->order_by('id_pengembalian','DESC');    
		  $this->db->limit(1);    
		  $query = $this->db->get('pengembalian');  //cek dulu apakah ada sudah ada kode di tabel.    
		  if($query->num_rows() <> 0){      
			   //cek kode jika telah tersedia    
			   $data = $query->row();      
			   $kode = intval($data->id_pengembalian) + 1; 
		  }
		  else{      
			   $kode = 1;  //cek jika kode belum terdapat pada table
		  }
			  $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);    
			  $id_pengembalian = "PP".$batas;  //format kode
			  return $id_pengembalian;  
		 }
    function data_pengembalian($cari=null)
	{
		$this->db->select('pengembalian_produk.id_pengembalian,pengembalian_produk.jumlah,pengembalian_produk.tgl,produk.nama,produk.kategori');
		$this->db->from('produk,pengembalian_produk');
		$this->db->order_by('pengembalian_produk.tgl');
		if(!empty($cari)){
		$this->db->like('nama',$cari);
	    }$query = $this->db->get();
		return $query->result();
	}
	function simpan_pengembalian($data){
		$this->db->insert('pengembalian',$data);
	}
	function hapus_pengembalian($id){
		$this->db->where('id_pengembalian',$id);
		$this->db->delete('pengembalian');
	}
	function get_id_pengembalian($id){
	    $query = $this->db->get_where('pengembalian', array('id_pengembalian' => $id));
	    return $query;
    }
   
    function edit_pengembalian($data){
	     $id_pengembalian    = $data['id_pengembalian'];	
	     $jumlah             = $data['jumlah'];
	     
	 
	    $data = array(
	      'jumlah'     => $jumlah,
	      );
	     $this->db->where('id_pengembalian', $id_pengembalian);
	     $update=$this->db->update('pengembalian',$data);
	      if($update){
	      echo"yes";
	   	}
	    
    }
    //================Surat Jalan======================//
    function get_no_dokumen($cari=null)
	{
		$this->db->distinct('');
		$this->db->select('no_dokumen');
		$this->db->from('surat_jalan');
		$this->db->order_by('no_dokumen');
		if(!empty($cari)){
		$this->db->like('no_dokumen',$cari);
	    }$query = $this->db->get();
		return $query->result();
	}
 //    function data_surat_jalan($cari=null)
	// {   
	// 	$this->db->distinct();
	// 	$this->db->select('no_dokumen,no_do,tgl');
	// 	$this->db->from('surat_jalan');
	// 	$this->db->order_by('no_dokumen');
	// 	if(!empty($cari)){
	// 	$this->db->like('no_dokumen',$cari);
	//     }$query = $this->db->get();
	// 	return $query->result();
	// }
	function data_penjualan($cari=null)
	{
		$sql="SELECT  DISTINCT pelanggan.nama,penjualan.tgl FROM pelanggan,penjualan WHERE pelanggan.id_pelanggan=penjualan.id_pelanggan";
		$query=$this->db->query($sql);
		return $query->result();
	}
    function no_do(){
    	  $y=substr(date('Y'),2);

		  $this->db->select('RIGHT(penjualan.no_do,2) as no_do', FALSE);
		  $this->db->order_by('no_do','DESC');    
		  $this->db->limit(1);    
		  $query = $this->db->get('penjualan');  //cek dulu apakah ada sudah ada kode di tabel.    
		  if($query->num_rows() <> 0){      
			   //cek kode jika telah tersedia    
			   $data = $query->row();      
			   $kode = intval($data->no_do) + 1; 
		  }
		  else{      
			   $kode = 1;  //cek jika kode belum terdapat pada table
		  }
			  $batas = str_pad($kode, 7, "0", STR_PAD_LEFT);    
			  $no_do = "DORM-".$y.$batas;  //format kode
			  return $no_do;  
		 }
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