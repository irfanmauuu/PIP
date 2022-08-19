<?
  if(isset($_POST['no_do'])){
    $no_do=$_POST['no_do'];
    $tgl=$_POST['tgl'];
?>          
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
                                    <h2>No DO  : <?php echo $no_do; ?></h2>
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
                                    <form  method="post" id="form-user" action="#">
                                       <!-- HIDDEN -->
                                      <input  type="hidden" class="form-control" name="no_dokumen"  data-parsley-trigger="change" readonly  value="PIP-WH-04-01.01">
                                       <input  type="hidden" class="form-control" name="no_do"  data-parsley-trigger="change"  value="<?php echo $no_do?>" readonly >
                                         <!-- HIDDEN -->
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3">SO No</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input  type="text" class="form-control" name="no_so" id="no_so"  data-parsley-trigger="change"   value="<?php // $no_so?>" ><label id="pesan1"></label>
                                            </div>
                                        </div>
                                        
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3">Nama Produk</label>
                                            <div class="col-md-6 col-sm-6">
                                               <select class="form-control" name="nama_produk" required="" id=nama_produk>
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
                                                <label id="pesan3"></label>
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3">Tonase Kirim</label>
                                            <div class="col-md-3 col-sm-6">
                                                <input  type="number" class="form-control" name="sak"  data-parsley-trigger="change" required="" placeholder="Sak" id=sak>
                                                <label id="pesan4"></label>
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <input  type="number" class="form-control" name="kg"  data-parsley-trigger="change" required=""  placeholder="Kg" id=kg>
                                                <label id="pesan5"></label>
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <div class="col-md-6 col-sm-6">
                                                <input  type="hidden" class="form-control" name="tgl"  data-parsley-trigger="change" value="<?php echo $tgl; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="ln_solid">
                                            <div class="form-group">
                                                <div class="col-md-6 offset-md-3">
                                                    <button type="button" class="btn btn-primary btn-sm mt-3" onclick="simpan()"><i class="fa fa-save" ></i> Simpan</button>
                                                     <a href="<?php echo base_url('Staff_Produksi/cetak_surat_jalan?N='.base64_encode($no_do).'&T='.base64_encode($tgl)) ?>" class="btn btn-info btn-sm mt-3" target=window><i class="fa fa-print"></i> Cetak</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- Table -->
                               
                                 <table id="datatable" class="table table-striped table-bordered" style="width:100%" id=tampildata>
                                    <thead>
                                      <tr>
                                        <th rowspan=3>No</th>
                                        <th rowspan=3>No DO</th>
                                        <th rowspan=3>Nama</th>
                                        <th rowspan=3>No So</th>
                                          <tr >  
                                            <th colspan="2"><center> Satuan</center></th>
                                            <th rowspan="3">Total Kg</th>
                                            <th rowspan="3">Aksi</th>
                                          </tr>
                                        <th>Sak</th>
                                        <th>Kg</th>
                                      </tr>

                                    </thead>
                                   <tbody id="listUser">
                                      <?php 
                                      $no=1;
                                        $sql="SELECT * FROM surat_jalan WHERE no_do='$no_do' AND tgl='$tgl'";
                                        $query=$this->db->query($sql);
                                        
                                        foreach ($query->result() as $data)
                                          {
                                         
                                          $tgl=date_create($data->tgl);
                                       ?>
                                          <tr>
                                           <td><?php echo  $no++;?></td>
                                           <td><?php echo htmlentities($data->no_do);?></td>
                                           <td><?php echo htmlentities($data->nama_produk);?></td>
                                           <td><?php echo htmlentities($data->no_so);?></td>
                                           <td><?php echo htmlentities($data->sak);?></td>
                                           <td><?php echo htmlentities($data->kg);?></td>
                                           <td><?php echo htmlentities($data->total_kg);?></td>
                                           <td>
                                             <button  class="btn btn-success btn-sm" onclick='edit(<?php echo $data->id_sj ?>)' ><i class="fa fa-pencil"></i> Edit</button>
                                          
                                             <button  class="btn btn-danger btn-sm" onclick='hapus(<?php echo $data->id_sj ?>)' ><i class="fa fa-trash"></i> Hapus</button>
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
          </center>
            <script type="text/javascript">
                function simpan(){
                    if(document.getElementById('no_so').value==""){
                       $('#pesan1').html('No SO Harus di isi');
                    }else if(document.getElementById('nama_produk').value==""){
                       $('#pesan3').html('Nama Produk Harus di isi');
                    }else if(document.getElementById('sak').value==""){
                       $('#pesan4').html('Sak  Harus di isi');
                    }else if(document.getElementById('kg').value==""){
                       $('#pesan5').html('Kg  Harus di isi');
                    }
                    else{
                     var data = $('#form-user').serialize();
                     $.ajax({
                         type: 'POST',
                         url: "<?php echo base_url()?>Staff_Produksi/simpan_surat_jalan",
                         data: data,
                         success: function() {
                           $('html, body').animate({ scrollBottom: 0 }, 'slow');
                           location.reload(true);
                       
                        //    $('#tampildata').load("<?php echo base_url()?>Staff_Gudang/tabel_surat_jalan").html(response);;
                         }
                     });
                   }
                 }
             function hapus(id) {
              if (confirm("Yakin Data Akan Dihapus?") == true) {
               $.ajax({
                    type: 'POST',
                    data: 'id='+id,
                    url: "<?php echo base_url()?>Staff_Produksi/hapus_surat_jalan",
                    success: function(result) {
                    location.reload(true);
                      var response = JSON.parse(result);
                     }
                  });
              } else {
                    return;
                }
              
              }
            function edit(id) {
                $('html, body').animate({ scrollTop: 0 }, 'slow');

                $.ajax({
                    type: 'POST',
                    data: 'id='+id,
                    success: function(result) {
                  //  location.reload(true);
                     $(".right_col").load("<?php echo base_url()?>Staff_Produksi/form_edit_surat_jalan?id="+id);
                      var response = JSON.parse(result);
                     }
                  });
                
              }
              
          </script>    
         
          <?php
          }else{
            echo"<script>
                alert('akses ditolak');
                window.location='./'
                 </script>";
          }
          ?>
         