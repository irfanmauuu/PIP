 <!-- page content -->
<?php
  $Q="SELECT COUNT(*) as pelanggan FROM pelanggan ";
  $query=$this->db->query($Q);
  $i=$query->row_array();

  $P="SELECT COUNT(*) as produk FROM produk ";
  $query1=$this->db->query($P);
  $p=$query1->row_array();

  $S="SELECT SUM(stok_produk) as stok_produk FROM stok_produk ";
  $query2=$this->db->query($S);
  $s=$query2->row_array();

  $T="SELECT SUM(qty) as penjualan FROM penjualan ";
  $query3=$this->db->query($T);
  $t=$query3->row_array();

  $Pg="SELECT COUNT(*) as pengguna FROM pengguna ";
  $query4=$this->db->query($Pg);
  $pg=$query4->row_array();

  $K="SELECT COUNT(*) as kategori FROM kategori ";
  $query5=$this->db->query($K);
  $k=$query5->row_array();
?>       
 <div class="right_col" role="main">

          <!-- top tiles -->
          <div class="row" style="display: inline-block; width: 100%" >
          <div class="tile_count">
            <div class="col-md-2 col-sm-6  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Pelanggan</span>
              <div class="count green"><?php echo $i['pelanggan'];?></div>
              <span class="count_bottom"><i class="green"></i> <?php echo date('d-m-Y'); ?></span>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-edit"></i>Total Master Produk</span>
              <div class="count green"><?php echo $p['produk'] ?></div>
              <span class="count_bottom"><?php echo date('d-m-Y'); ?></span>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Produk Aktif</span>
              <div class="count green"><?php echo $s['stok_produk'] ?></div>
              <span class="count_bottom"><?php echo date('d-m-Y'); ?></span>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Penjualan Poduk</span>
              <div class="count green"><?php echo $t['penjualan'] ?></div>
              <span class="count_bottom"><?php echo date('d-m-Y'); ?></span>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Pengguna</span>
              <div class="count green"><?php echo $pg['pengguna'] ?></div>
              <span class="count_bottom"><?php echo date('d-m-Y'); ?></span>
            </div>
            <div class="col-md-2 col-smz-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Kategori</span>
              <div class="count green"><?php echo $k['kategori'] ?></div>
              <span class="count_bottom"><?php echo date('d-m-Y'); ?></span>
            </div>
          </div>
        </div>
          <!-- /top tiles -->

          <div class="row">
            <div class="col-md-12 col-sm-12 ">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Penjualan Bulan ini</h3>
                  </div>
                </div>

                <div class="col-md-9 col-sm-9 ">
                  <canvas id="myChart"></canvas>
                 <!-- chart -->
                </div>
                <div class="col-md-3 col-sm-3  bg-white">
                  <div class="x_title">
                    <h2>Penjualan Produk</h2>
                    <div class="clearfix"></div>
                  </div>
                  <?php
                    
                    
                  ?>
                  <div class="col-md-12 col-sm-12 ">
                    <div>
                      <p>Facebook Campaign</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="80"></div>
                        </div>
                      </div>
                    </div>
                </div>

                <div class="clearfix"></div>
              </div>
            </div>

          </div>
        
                </div>
                <!-- end of weather widget -->
              </div>
            </div>
          </div>
        </div>
      </div>  
                
              <?php 
               $M=date('m');
               $Y=date('Y');
               $Tgl="SELECT DISTINCT tgl FROM penjualan WHERE MONTH(tgl)='$M' AND YEAR(tgl)='$Y' AND status='lunas' ORDER BY tgl ASC";
               $query=$this->db->query($Tgl);
               $SUM="SELECT  
                     COUNT(IF( MONTH(tgl) = '$M' AND YEAR(tgl)='$Y', qty, 0)) AS qty
                     FROM penjualan WHERE status='lunas'AND  MONTH(tgl)='$M' AND YEAR(tgl)='$Y' GROUP BY tgl";
               $q_qty=$this->db->query($SUM);
              
              ?>
              <script>
                var xValues = [<?php foreach ($query->result() as $data) { $day=date_create($data->tgl); echo  date_format($day,'d').',';  }?>];
                var yValues = [<?php foreach ($q_qty->result() as $qty) { echo $qty->qty.',';  }?>];

                new Chart("myChart", {
                  type: "line",
                  data: {
                    labels: xValues,
                    datasets: [{
                      fill: false,
                      lineTension: 0,
                      backgroundColor: "rgb(0, 0, 0)",
                      borderColor: "rgb(85, 107, 47)",
                      data: yValues
                    }]
                  },
                  options: {
                    legend: {display: false},
                    scales: {
                      yAxes: [{ticks: {min: 6, max:100}}],
                    }
                  }
              });
</script>
        <!-- /page content -->
