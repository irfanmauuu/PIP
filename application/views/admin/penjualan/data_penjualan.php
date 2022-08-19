 <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                        </div>

                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <div class="clearfix">
                                      <button data-toggle="modal" data-target="#myModal" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-plus" id="tombol-simpan"></i>Tambah Transaksi</button>
                                     </div>
                                     <form action="<?php echo base_url('Admin/data_penjualan')?>" method="get">
                                        <input list="no_dokumen" type="text" class="form-control sm" name="x" placeholder="Nama Pelanggan">
                                     </form>
                                </div>
                                  <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                      <tr>
                                        <th>No</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Tanggal</th>
                                        <th>Tipe Surat Jalan</th>
                                        <th>Cetak</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                        $no=1;
                                        
                                        foreach ($query->result() as $data)
                                          {
                                         // $jumlah=$data->qty*$data->harga;
                                          $tgl=date_create($data->tgl);
                                       ?>
                                          <tr>
                                           <td><?php echo  $no++;?></td>
                                           <td><?php echo htmlentities($data->nama) ?></td>
                                           <td><?php echo htmlentities(date_format($tgl,'d-m-Y'));?></td>
                                           <td><?php if($data->tipe_sj==""){echo "Tidak Ada surat jalan";}else{ echo htmlentities($data->tipe_sj);}?></td>
                                           <td>                                        
                                            <a href="<?php echo base_url('Admin/cetak_penjualan?T='.base64_encode($data->id_transaksi).'&P='.base64_encode($data->id_pelanggan).'&S='.base64_encode($data->tipe_sj).'&Tg='.base64_encode($data->tgl).'&PmB='.base64_encode($data->pembayaran))?>" target=window class="btn-info btn-sm"><i class="fa fa-print"></i> </a>
                                          </td>
                                        </tr>
                                        <?php
                                        }
                                      ?>
                                      <tr></tr>
                                    </tbody>
                                  </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          
             <div id="myModal" class="modal fade" >
             <div class="right_col" role="main" style="background: none;margin-left: 30%;">
                 <div class="row">
                        <div class="col-md-8 col-sm-10">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Transaksi Penjualan </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                      <li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</li>
                                      <li>
                                        <a href="<?php echo base_url() ?>Admin/" class="btn btn-warning" title="kembali">
                                            <i class="fa fa-close" style="color:black"></i>
                                          </a>
                                      </li>
                                    </ul>
                            <div class="clearfix"></div>
                          </div>
                                <div class="x_content">
                                    <form method="post" id="form-user" action="<?php base_url() ?>form_penjualan">
                                       <?php   
                                        $jsArray2 = "var prdName = new Array();\n"; 

                                       echo'
                                         <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3">Nama Pelanggan</label>
                                            <div class="col-md-6 col-sm-3">
                                              <select class="form-control" id="id_pelanggan" name=id_pelanggan required="" onchange="changeValue2(this.value)">
                                              <option value="">Pilih</option>';
                                          
                                                $no=1;
                                                    foreach ($nama_pelanggan as $row) {
                                                      echo'
                                                         <option value="'.$row->id_pelanggan.'">'.$row->nama.'</option>';
                                                       $jsArray2 .= "prdName['" . $row->id_pelanggan."'] =     
                                                          {
                                                            
                                                             biaya_pengiriman   :'".addslashes($row->biaya_pengiriman)."'
                                                         };\n";
                                                        }  
                                                       echo '</select>';  
                                        ?>  
                                            <script type="text/javascript">  
                                                <?php echo $jsArray2; ?>
                                                   function changeValue2(id){
                                                   document.getElementById('biaya_pengiriman').value =prdName[id].biaya_pengiriman;
                                                   document.getElementById('biaya').value = (prdName[id].biaya_pengiriman);                      
                                                 };
                                             </script>    
                                            </div>
                                        </div>
                                  
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3">Tipe Surat Jalan</label>
                                            <div class="col-md-6 col-sm-6">
                                               <select class="form-control" name="tipe_sj" id="tipe_sj" onchange="show()">
                                                 <option value="">pilih</option>
                                                 <option value="LOCCO">LOCCO</option>
                                                 <option value="FRANCO">FRANCO</option>
                                                </select>
                                                </div>
                                        </div>
                                        <input type="hidden" name="biaya" id="biaya">
                                        <div class="field item form-group" id="id_biaya_pengiriman" style="display: none;">
                                             <label class="col-form-label col-md-3 col-sm-3">Biaya Pengiriman</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input  type="text" class="form-control" name="biaya_pengiriman"  data-parsley-trigger="change" id="biaya_pengiriman" readonly="" >
                                            </div>
                                        </div>
                                       <script>
                                        function show() {
                                          if(document.getElementById('tipe_sj').value!==""){
                                               document.getElementById("id_biaya_pengiriman").style.display = "block";
                                               document.getElementById("biaya_pengiriman").value=document.getElementById('biaya').value;
                                            }else{
                                                document.getElementById("id_biaya_pengiriman").style.display = "none";
                                                document.getElementById("biaya_pengiriman").value="0";
                                           }
                                          }
                                        function Visibility() {
                                        }
                                      </script>
                                      
                                       <!--  <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3">Tanggal</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input  type="date" class="form-control" name="tgl"  data-parsley-trigger="change"  value="<?php //echo $no_do?>" required>
                                            </div>
                                        </div> -->
                                        <div class="form-group">
                                                <div class="col-md-6 offset-md-3">
                                                    <button type="submit" name="submit" class="btn btn-primary btn-sm mt-3" id="tombol-simpan"><i class="fa fa-next" ></i> Next</button>
                                                     
                                                </div>
                                       </div>
                                    </form>
                                </div>
                              </div>
                            </div></div>
                              </div>
                            </div></div>
                              </div>
                            </div>
                        
         