
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
                                         foreach ($get as $data) {
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
                                             <a href="<?php echo base_url('Staff_Produksi/form_edit_surat_jalan?x='.base64_encode($data->no_dokumen))?>" class="btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit</a>
                                          
                                             <a href="<?php echo base_url('Staff_Produksi/hapus_surat_jalan?x='.base64_encode($data->id_sj))?>" class="btn-danger btn-sm" onclick="return confirm('Yakin Data Akan Dihapus???')"><i class="fa fa-trash"></i> Hapus</a>
                                           </td>
                                         </tr> 
                                         <?php
                                       // }
                                      ?>
                                      <tr></tr>
                                    </tbody>
                                  </table>