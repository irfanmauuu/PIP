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
                                  <!--  
                                    <div class="clearfix">
                                      <a href="<?php base_url() ?>form_surat_jalan" class="btn btn-success btn-sm" ><i class="fa fa-plus" ></i> Tambah</a>
                                     </div> -->

                                    <div class="clearfix">
                                      <button data-toggle="modal" data-target="#myModal" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-plus" id="tombol-simpan"></i>Tambah</button>
                                     </div>
                                     <form action="<?php echo base_url('Staff_Produksi/data_surat_jalan')?>" method="get">
                                        <input list="no_dokumen" type="text" class="form-control sm" name="x" placeholder="No Dokument" >
                                        <datalist id="no_dokumen">
                                          <?php
                                            $no=1; foreach ($no_dokumen as $data) {
                                            ?>
                                           <option><?php echo $data->no_dokumen; ?></option>
                                          <?php } ?>
                                        </datalist>
                                     </form>
                                </div>
                                  <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                      <tr>
                                        <th>No</th>
                                        <th>No DO</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                       $no=1;
                                        foreach ($get as $data) {
                                          $tgl=date_create($data->tgl);
                                        ?>
                                        <tr>
                                          <td><?php echo  $no++;?></td>
                                          <td><button type="button" class="btn btn-defout" onclick='get("<?php echo $data->no_do ?>")' ><?php echo htmlentities($data->no_do)?> </button></td>
                                          <td><?php echo htmlentities(date_format($tgl,'d-m-Y'));?></td>
                                          <td>                                          
                                            <a href="<?php echo base_url('Staff_Produksi/hapus_no_do?x='.base64_encode($data->no_do))?>" class="btn-danger btn-sm" onclick="return confirm('Yakin Data Akan Dihapus???')"><i class="fa fa-trash"></i> Hapus</a>
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
                        <div class="col-md-7 col-sm-10">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Surat Jalan </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                      <li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</li>
                                      <li>
                                        <a href="<?php echo base_url() ?>Staff_Produksi/data_surat_jalan" class="btn btn-warning" title="kembali">
                                            <i class="fa fa-close" style="color:black"></i>
                                          </a>
                                      </li>
                                    </ul>
                            <div class="clearfix"></div>
                          </div>
                                <div class="x_content">
                                    <form method="post" id="form-user" action="<?php base_url() ?>form_surat_jalan">
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3">No DO</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input  type="text" class="form-control" name="no_do"  data-parsley-trigger="change"  value="<?php //echo $no_do?>" required>
                                            </div>
                                        </div>
                                         <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3">Nama Pelanggan</label>
                                            <div class="col-md-6 col-sm-3">
                                               <select class="form-control" name="id_pelanggan" required="" id=id_pelanggan>
                                                 <option value="">pilih</option>
                                                <?php 
                                                    $no=1;
                                                    foreach ($nama_pelanggan as $data) {
                                                    echo"
                                                       <option value='".$data->id_pelanggan."'>".$data->nama."</option>
                                                    ";
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3">Tanggal</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input  type="date" class="form-control" name="tgl"  data-parsley-trigger="change"  value="<?php //echo $no_do?>" required>
                                            </div>
                                        </div>
                                       
                                        <div class="ln_solid">
                                            <div class="form-group">
                                                <div class="col-md-6 offset-md-3">
                                                    <button type="submit" class="btn btn-primary btn-sm mt-3" id="tombol-simpan"><i class="fa fa-next" ></i> Next</button>
                                                     
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                               </div>
                              </div>
                             </div>
                             </div>   
                             
                                <script type="text/javascript">
                                    $(document).ready(function(){
                                       $("#tombol-simpan").click(function(){
                                           var data = $('#form-user').serialize();
                                           $.ajax({
                                               type: 'POST',
                                               url: "<?php echo base_url()?>Staff_Produksi/form_surat_jalan",
                                               data: data,
                                               success: function() {
                                                location.reload(true);
                                              
                                              //    $('#tampildata').load("<?php echo base_url()?>Staff_Gudang/tabel_surat_jalan").html(response);;
                                               }
                                           });
                                       });
                                   });
                                 </script>
                               
             <!-- modal input -->
<!--             <div id="myModal" class="modal fade" >
             <div class="right_col" role="main" style="background: none;margin-left: 10%;margin-right: 10%">
                 <div class="row">
                        <div class="col-md-12 col-sm-10">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Surat Jalan </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                      <li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</li>
                                      <li>
                                        <a href="<?php echo base_url() ?>Staff_Gudang/data_surat_jalan" class="btn btn-warning" title="kembali">
                                            <i class="fa fa-close" style="color:black"></i>
                                          </a>
                                      </li>
                                    </ul>
                            <div class="clearfix"></div>
                          </div>
                                <div class="x_content">
                                    <form  method="post" id="form-user" action="#">
                                                <input  type="hidden" class="form-control" name="no_dokumen"  data-parsley-trigger="change" readonly  value="PIP-WH-04-01.01">
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3">No DO</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input  type="text" class="form-control" name="no_do"  data-parsley-trigger="change"  value="<?php //echo $no_do?>" >
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3">SO No</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input  type="text" class="form-control" name="no_so"  data-parsley-trigger="change"   value="<?php // $no_so?>" >
                                            </div>
                                        </div>
                                          <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3">Tipe Surat Jalan</label>
                                            <div class="col-md-6 col-sm-6">
                                               <select class="form-control" name="type_sj" required="">
                                                 <option value="">pilih</option>
                                                 <option value="LOCCO">LOCCO</option>
                                                 <option value="SYSTEMA LOGISTIC">SYSTEMA LOGISTIC</option>
                                                 <option value="MAKLOON">MAKLOON</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3">Nama Barang</label>
                                            <div class="col-md-6 col-sm-6">
                                               <select class="form-control" name="nama_barang" required="" id=nama_barang>
                                                 <option value="">pilih</option>
                                                <?php 
                                                    $no=1;
                                                    foreach ($nama_barang as $data) {
                                                    echo"
                                                       <option value='".$data->nama."'>".$data->nama."</option>
                                                    ";
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3">Tonase Kirim</label>
                                            <div class="col-md-3 col-sm-6">
                                                <input  type="number" class="form-control" name="sak"  data-parsley-trigger="change" required="" placeholder="Sak" id=sak>
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <input  type="number" class="form-control" name="kg"  data-parsley-trigger="change" required=""  placeholder="Kg" id=kg>
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3">Tanggal</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input  type="date" class="form-control" name="tgl"  data-parsley-trigger="change" required="" id=tgl>
                                            </div>
                                        </div>
                                        <div class="ln_solid">
                                            <div class="form-group">
                                                <div class="col-md-6 offset-md-3">
                                                    <button type="button" class="btn btn-primary btn-sm mt-3" id="tombol-simpan"><i class="fa fa-save" ></i> Simpan</button>
                                                    <button type='reset' class="btn btn-success btn-sm mt-3">Reset</button> 
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                 <table id="datatable" class="table table-striped table-bordered" style="width:100%" id=tampildata>
                                    <thead>
                                      <tr>
                                        <th>No</th>
                                        <th>No Dokument</th>
                                        <th>Tanggal</th>
                                        <th>No DO</th>
                                        <th>Aksi</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                       $no=1;
                                        foreach ($Get as $data) {
                                          $tgl=date_create($data->tgl);
                                        ?>
                                        <tr>
                                          <td><?php echo  $no++;?></td>
                                          <td><?php echo htmlentities($data->no_dokumen);?></td>
                                          <td><?php echo htmlentities(date_format($tgl,'d-m-Y'));?></td>
                                          <td><?php echo htmlentities($data->no_do);?></td>
                                          <td>
                                            <a href="<?php echo base_url('Staff_Gudang/form_edit_surat_jalan?x='.base64_encode($data->no_dokumen))?>" class="btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit</a>
                                          
                                            <a href="<?php echo base_url('Staff_Gudang/hapus_surat_jalan?x='.base64_encode($data->no_dokumen))?>" class="btn-danger btn-sm" onclick="return confirm('Yakin Data Akan Dihapus???')"><i class="fa fa-trash"></i> Hapus</a>
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
        </center>
            <script type="text/javascript">
              
             $(document).ready(function(){
                 $("#tombol-simpan").click(function(){
                     alert('asdasd');
                     var data = $('#form-user').serialize();
                     $.ajax({
                         type: 'POST',
                         url: "<?php echo base_url()?>Staff_Gudang/simpan_surat_jalan",
                         data: data,
                         success: function() {
                           document.getElementById('kg').value="";
                           document.getElementById('nama_barang').value="";
                           document.getElementById('sak').value="";
                           document.getElementById('tgl').value="";
                           $('#tampildata').load("<?php echo base_url()?>Staff_Gudang/tabel_surat_jalan").html(response);;
                         }
                     });
                 });
             });
          </script>        -->
          
     