<div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0; background:;">
             <center>
              <br>
             <div style="background: white; width: 80%;border-radius: 5%;">
              <center>
                <img src="<?php echo base_url(); ?>img/logoPIP3.png" style="width: 44%;background: white;margin-top: 5%">
              </center>
              <center>
              <b style="font-size: 18px;">Pupuk Indonesia Pangan</b>
              </center>
             </div>  
             </center>
            </div>
            <div class="clearfix" style=""></div>
            <br><br><br><br><br>

            <!-- menu profile quick info -->
            
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu" >
              <div class="menu_section">
                <br>
                <br>
                <ul class="nav side-menu">
                  <li><a href="<?php echo base_url() ?>Manager/"><i class="fa fa-home"></i> Home </span></a></li>
                  <li><a><i class="fa fa-file-text"></i> Laporan Penjualan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url()?>Manager/laporan_pertanggal">Pertanggal</a></li>
                      <li><a href="<?php echo base_url()?>Manager/laporan_perhari">Perhari</a></li>
                      <li><a href="<?php echo base_url()?>Manager/laporan_perbulan">Perbulan</a></li>
                      <li><a href="<?php echo base_url()?>Manager/laporan_pertahun">Pertahun</a></li>
                    </ul>
                  </li>
                  <li><a href="<?php echo base_url() ?>Login/logout" onclick="return confirm('Yakin Akan Keluar??')"><i class="fa fa-sign-out"></i> Keluar</a></li>
                 
                </ul>
              </div>
            
            </div>
          </div>
        </div>
        </div>
        <div class="top_nav">
          <div class="nav_menu">
              <h3 style="margin-left: 20%"><?php echo $header; ?></h3>
          </div>
        </div>
       
        <!-- /top navigation -->
