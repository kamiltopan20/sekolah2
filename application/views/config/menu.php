<div class="col-xs-6 col-sm-3 sidebar-offcanvas" role="navigation">
            <ul class="list-group panel">
                <li class="list-group-item"><i class="glyphicon glyphicon-align-justify"></i> <b>MENU UTAMA</b></li>
                <li class="list-group-item"><input type="text" class="form-control search-query" placeholder="Search Something"></li>
                <li class="list-group-item"><a href="<?php echo base_url()?>"><i class="glyphicon glyphicon-home"></i>Dashboard </a></li>
                
                <?php 
                if ($this->session->userdata('level') == 'admin') {
                 ?>
               
                <li>
                  <a href="#demo4" class="list-group-item " data-toggle="collapse"><i class="glyphicon glyphicon-th-large"></i>Data Master  <span class="glyphicon glyphicon-chevron-right"></span></a>
                    <li class="collapse" id="demo4">
                      <a href="produk" class="list-group-item"> Data Produk</a>
                    </li>
                </li>

                <li class="list-group-item"><a href="users"><i class="glyphicon glyphicon-user"></i>Manajemen User </a></li>
                <li class="list-group-item"><a href="<?php echo base_url()?>app/logout"><i class="glyphicon glyphicon-share"></i>Logout </a></li>

                <?php 
                } elseif ($this->session->userdata('level') == 'petugas gudang') {
                 ?>

              <li>
                  <a href="#demo4" class="list-group-item " data-toggle="collapse"><i class="glyphicon glyphicon-th-large"></i>Data Master  <span class="glyphicon glyphicon-chevron-right"></span></a>
                    <li class="collapse" id="demo4">
                      <a href="produk" class="list-group-item"> Data Produk</a>
                    </li>
                </li>
               
                <!-- <li class="list-group-item"><a href="users"><i class="glyphicon glyphicon-user"></i>Manajemen User </a></li> -->
                <li class="list-group-item"><a href="<?php echo base_url()?>app/logout"><i class="glyphicon glyphicon-share"></i>Logout </a></li>


                <?php } ?>

                

              </ul>
          </div>