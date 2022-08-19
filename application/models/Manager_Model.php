<?php
class Manager_Model extends CI_Model
{
	//============ Pengguna ================
   
    //=============Laporan Penjualan===============
    function laporan_pertanggal($data=null)
	{ 
		$date1=$data['tgl1'];
		$date2=$data['tgl2'];
		
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
		
        $sql="SELECT id_produk,nama,tgl,kg, 
             SUM(IF( tgl = '$date1', qty, 0)) AS qty, 
             SUM(IF( tgl = '$date1', harga, 0)) AS harga
             FROM penjualan LEFT JOIN produk USING(id_produk) WHERE status='lunas' AND tgl = '$date1' GROUP BY id_produk";

        $query = $this->db->query($sql);
		return $query->result();
	} 
	function laporan_perbulan($data=null)
	{ 
		$M=$data['month'];
		$Y=$data['year'];
        $sql="SELECT id_produk,nama,tgl,kg, 
             SUM(IF( MONTH(tgl) = '$M' AND YEAR(tgl)='$Y', qty, 0)) AS qty, 
             SUM(IF( MONTH(tgl) = '$M' AND YEAR(tgl)='$Y', harga, 0)) AS harga
             FROM penjualan LEFT JOIN produk USING(id_produk) WHERE status='lunas' AND MONTH(tgl) = '$M' AND YEAR(tgl)='$Y' GROUP BY tgl,id_produk";

        $query = $this->db->query($sql);
		return $query->result();
	} 
	function laporan_pertahun($data=null)
	{ 
		$Y=$data['year'];
        $sql="SELECT id_produk,nama,MONTH(tgl) as month,kg, 
             SUM(IF( MONTH(tgl) BETWEEN '01' AND '12' AND YEAR(tgl)='$Y', qty, 0)) AS qty, 
             SUM(IF( MONTH(tgl) BETWEEN '01' AND '12' AND YEAR(tgl)='$Y', harga, 0)) AS harga
             FROM penjualan LEFT JOIN produk USING(id_produk) WHERE status='lunas' AND MONTH(tgl) BETWEEN '01' AND '12' AND YEAR(tgl)='$Y' GROUP BY MONTH(tgl),id_produk";

        $query = $this->db->query($sql);
		return $query->result();
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