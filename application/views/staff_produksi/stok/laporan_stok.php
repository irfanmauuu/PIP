  

          <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                        </div>

                    </div>
                    <div class="clearfix"></div>
                
                 <div class="row">
                        <div class="col-md-12 col-sm-10">
                            <div class="x_panel">
                                <div class="x_title">
                                    <ul class="nav navbar-right panel_toolbox">
                                      <li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</li>
                                      </li>
                                    </ul>
                            <div class="clearfix"></div>
                          </div>
                                <div class="x_content">
                                 <form action="<?php echo base_url('Staff_Produksi/laporan_stok')?>" method="post">
                                  <div class="row mb-3">
                                    <div class="col col-md-3">
                                      <input  type="date" class="form-control sm" name="date1" required="">
                                    </div>
                                    <div class="col col-md-3">
                                       <input  type="date" class="form-control sm" name="date2" required="">
                                    </div>

                                    <div class="col col-md-3">
                                      <select name="id_produk" class="form-control">
                                        <option value="">Semua Produk</option>
                                         <?php
                                           foreach ($get->result() as $Row) {
                                             ?>
                                          <option value="<?php echo $Row->id_produk; ?>"><?php echo $Row->nama ?></option>   
                                             <?php
                                           }
                                         ?>
                                      </select>
                                    </div>
                                     <div class="col-md-3">
                                      <select name="kategori" class="form-control">
                                        <option value="">Semua Kategori</option>
                                         <?php
                                           foreach ($get_kategori->result() as $Row) {
                                             ?>
                                          <option value="<?php echo $Row->nama_kategori; ?>"><?php echo $Row->nama_kategori; ?></option>   
                                             <?php
                                           }
                                         ?>
                                      </select>
                                    </div>
                                     </div>
                                   <div class="row ml-100"> 
                                  
                                    <div class="col">
                                      <button class="btn btn-info"><i class="fa fa-search"></i></button>
                                      <?php if(isset($_POST['date1'])){?>
                                      <a href="<?php echo base_url('Staff_Produksi/cetak_laporan_stok?d='.base64_encode($tgl1).'&D='.base64_encode($tgl2).'&IP='.base64_encode($id_produk).'&Kt='.base64_encode($kategori))?>" class="btn btn-danger" title="cetak" target=window><i class="fa fa-file-pdf-o"></i></a>
                                      <a href="<?php echo base_url('Staff_Produksi/export_laporan_stok?d='.base64_encode($tgl1).'&D='.base64_encode($tgl2).'&IP='.base64_encode($id_produk).'&Kt='.base64_encode($kategori))?>" class="btn btn-success" title="download"><i class="fa fa-download"></i></a>
                                      <?php } ?>
                                    </div>
                                    
                                  </div>
                                </form>
                                  <!-- Table -->
                                  <?php 
                                   if(isset($_POST['date1'])){
                                  ?>
                                 <h4>
                                   Tanggal :  <?php $Tgl1=date_create($tgl1); $Tgl2=date_create($tgl2); echo date_format($Tgl1,'d-m-Y').' s/d '.date_format($Tgl2,'d-m-Y')  ?>
                                 </h4>
                               <?php } ?>
                                 <table id="datatable" class="table table-striped table-bordered" style="width:100%" id=tampildata>
                                    <thead>
                                      <tr>
                                        <th rowspan=3>No</th>
                                        <th rowspan=3>Tanggal</th>
                                        <th rowspan=3>Produk</th>
                                        <th rowspan=3>Kategori</th>
                                        <th rowspan=3>Stok In</th>
                                        <th rowspan=3>Stok Out</th>
                                        <th rowspan=3>Jumlah</th>
                                      </tr>

                                    </thead>
                                   <tbody id="listUser">
                                      <?php 
                                      $no=1;
                                     foreach ($query as $data)
                                          {
                                                $tgl_produksi=date_create($data->tgl_produksi);
                                                $sql="SELECT * FROM produk WHERE id_produk='$data->id_produk'";
                                                $cek=$this->db->query($sql);
                                                $i=$cek->row_array();
                                                $num=$cek->num_rows();

                                       ?>
                                          <tr>
                                           <td><?php echo  $no++;?></td>
                                           <td><?php echo htmlentities(date_format($tgl_produksi,'d-m-Y'));?></td>
                                           <td><?php echo htmlentities($i['nama']);?></td>
                                           <td><?php echo htmlentities($data->kategori);?></td>
                                           <td><?php echo htmlentities(number_format($data->stok_in+$data->stok_out));?></td>
                                           <td><?php echo htmlentities(number_format($data->stok_out));?></td>
                                           <td><?php echo number_format($data->total); ?></td>
                                          
                                         </tr> 
                                         <?php
                                         $date1=$tgl1;
                                         $date2=$tgl2;
                                         
                                         if(($id_produk=="")){
                                         $total_stok_in="SELECT SUM(stok_produk.stok_produk) as stok_in FROM stok_produk WHERE tgl_produksi BETWEEN '$date1' AND '$date2'";
                                           $stokIn=$this->db->query($total_stok_in);
                                           $in=$stokIn->row_array();

                                         $total_stok_out="SELECT SUM(qty) as stok_out FROM penjualan WHERE tgl BETWEEN '$date1' AND '$date2' AND status='lunas'";
                                           $stokOut=$this->db->query($total_stok_out);
                                           $out=$stokOut->row_array();
                                      
                                        }else{
                                         $total_stok_in="SELECT SUM(stok_produk.stok_produk) as stok_in FROM stok_produk WHERE tgl_produksi BETWEEN '$date1' AND '$date2' AND id_produk='$id_produk'";
                                           $stokIn=$this->db->query($total_stok_in);
                                           $in=$stokIn->row_array();

                                         $total_stok_out="SELECT SUM(qty) as stok_out FROM penjualan WHERE tgl BETWEEN '$date1' AND '$date2' AND status='lunas' AND id_produk='$id_produk'";
                                           $stokOut=$this->db->query($total_stok_out);
                                           $out=$stokOut->row_array();
                                         }
                                       }
                                        
                                      ?>
                                        <?php 
                                        if($no<=1){
                                         
                                             echo '<h4>Data tidak ditemukan</h4>';
                                             
                                        }
                                      ?>
                                      <tr>
                                        <td colspan="6">Total</td>
                                        <td><?php if($no>1){ echo number_format($in['stok_in']); }?></td>
                                        
                                      </tr>
                                    
                                    </tbody>
                                  </table>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>

          