  

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
                                 <form action="<?php echo base_url('Manager/laporan_perbulan')?>" method="post">
                                  <div class="row mb-3">
                                    <div class="col">
                                      <input  type="month" class="form-control sm" name="date1" required="">
                                    </div>
                                    <div class="col">
                                      <button class="btn btn-info"><i class="fa fa-search"></i></button>
                                      <?php if(isset($_POST['date1'])){?>
                                      <a href="<?php echo base_url('Manager/cetak_laporan_perbulan?m='.base64_encode($month).'&Y='.base64_encode($year))?>" class="btn btn-danger" title="cetak" target=window><i class="fa fa-file-pdf-o"></i></a>
                                      <a href="<?php echo base_url('Manager/export_laporan_perbulan?m='.base64_encode($month).'&Y='.base64_encode($year))?>" class="btn btn-success" title="download"><i class="fa fa-download"></i></a>
                                      <?php } ?>
                                    </div>
                                    
                                  </div>
                                </form>
                                  <!-- Table -->
                                  <?php 
                                   if(isset($_POST['date1'])){
                                       
                                      $bln=$month;
                                      $tahun=($year);
                                       if($bln=='01'){$bulan='Januari';}
                                       if($bln=='02'){$bulan='Februari';}
                                       if($bln=='03'){$bulan='Maret';}
                                       if($bln=='04'){$bulan='April';}
                                       if($bln=='05'){$bulan='Mei';}
                                       if($bln=='06'){$bulan='Juni';}
                                       if($bln=='07'){$bulan='Juli';}
                                       if($bln=='08'){$bulan='Agustus';}
                                       if($bln=='09'){$bulan='September';}
                                       if($bln=='10'){$bulan='Oktober';}
                                       if($bln=='11'){$bulan='November';}
                                       if($bln=='12'){$bulan='Desember';}
                                  ?>
                                 <h4>
                                    Bulan :  <?php echo $bulan.' '.$tahun; ?>
                                 </h4>
                               <?php } ?>
                                 <table id="datatable" class="table table-striped table-bordered" style="width:100%" id=tampildata>
                                    <thead>
                                      <tr>
                                        <th rowspan=3>No</th>
                                        <th rowspan=3>Tanggal</th>
                                        <th rowspan=3>Produk</th>
                                        <th rowspan=3>Harga</th>
                                        <th rowspan=3>Qty Sak</th>
                                        <th rowspan=3>Jumlah</th>
                                      </tr>

                                    </thead>
                                   <tbody id="listUser">
                                      <?php 
                                      $no=1;
                                     foreach ($query as $data)
                                          {
                                          $jumlah=$data->qty*$data->harga*$data->kg;
                                          $tgl=date_create($data->tgl);
                                       ?>
                                          <tr>
                                           <td><?php echo  $no++;?></td>
                                           <td><?php echo htmlentities(date_format($tgl,'d-m-Y'));?></td>
                                           <td><?php echo htmlentities($data->nama);?></td>
                                           <td><?php echo htmlentities(number_format($data->harga));?></td>
                                           <td><?php echo htmlentities($data->qty);?></td>
                                           <td><?php echo htmlentities(number_format($jumlah));?></td>
                                          
                                         </tr> 
                                         <?php
                                       }
                                         $M=$month;
                                         $Y=$year;
                                         $sql_total="SELECT SUM(qty)as total_kg, SUM(harga*qty*kg) as total_harga FROM penjualan,produk WHERE MONTH(tgl) = '$M' AND YEAR(tgl)='$Y' AND produk.id_produk=penjualan.id_produk AND status='lunas'";
                                         $query2=$this->db->query($sql_total);
                                        
                                      
                                      ?>
                                      <tr>
                                        <td  colspan="4">Total</td>
                                        <td><?php foreach ($query2->result() as $total){ echo number_format($total->total_kg); } ?></td>                        
                                        <td><?php foreach ($query2->result() as $total){ echo 'Rp '. number_format($total->total_harga); } ?></td>
                                        
                                      </tr>
                                     
                                    </tbody>
                                  </table>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>

          