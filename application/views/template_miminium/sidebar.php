<style>
     ul.nav-list.tree { display: none; }
     ul.nav-list.tree.open { display: block; }
</style>
<div class="container-fluid mimin-wrapper">

    <!-- start:Left Menu -->
      <div id="left-menu">
        <div class="sub-left-menu scroll">
          <ul class="nav nav-list">
              <li><div class="left-bg"></div></li>
              <!-- <li class="time">
                <h1 class="animated fadeInLeft">21:00</h1>
                <p class="animated fadeInRight">Sat,October 1st 2029</p>
              </li> -->
              <li class="<?php if(isset($link) && ($link=='Admin/Pegawai/Index' || $link=='Admin/Kelas/Index' || $link=='Admin/Siswa/Index' || $link=='Admin/Tahunakademik/Index' || $link=='Admin/Ruangan/Index' || $link=='Admin/Matapelajaran/Index')){?> active <?php }?> ripple">
                <a class="tree-toggle nav-header"><i class="fa fa-database" aria-hidden="true"></i> Master Data 
                  <span class="<?php if($link=='Admin/Pegawai/Index' || $link=='Admin/Kelas/Index' || $link=='Admin/Siswa/Index' || $link=='Admin/Tahunakademik/Index' || $link=='Admin/Ruangan/Index' || $link=='Admin/Matapelajaran/Index'){?> fa-angle-down <?php }else{?> fa-angle-right <?php }?> fa right-arrow text-right"></span>
                </a>
                <ul class="nav nav-list tree<?php if($link=='Admin/Pegawai/Index' || $link=='Admin/Kelas/Index' || $link=='Admin/Siswa/Index' || $link=='Admin/Tahunakademik/Index' || $link=='Admin/Ruangan/Index' || $link=='Admin/Matapelajaran/Index'){?> open<?php }?>">
                    <li><a href="<?=base_url()?>admin/pegawai/index" style="color:<?php if($link=='Admin/Pegawai/Index'){?> #2196F3 <?php }?>;">Pegawai </a></li>
                    <li><a href="<?=base_url()?>admin/siswa/index" style="color:<?php if($link=='Admin/Siswa/Index'){?> #2196F3 <?php }?>;">Siswa</a></li>
                    <li><a href="<?=base_url()?>admin/kelas/index" style="color:<?php if($link=='Admin/Kelas/Index'){?> #2196F3 <?php }?>;">Kelas</a></li>
                    <li><a href="<?=base_url()?>admin/tahunakademik/index" style="color:<?php if($link=='Admin/Tahunakademik/Index'){?> #2196F3 <?php }?>;">Tahun Akademik</a></li>
                    <li><a href="<?=base_url()?>admin/ruangan/index" style="color:<?php if($link=='Admin/Ruangan/Index'){?> #2196F3 <?php }?>;">Ruangan</a></li>
                    <li><a href="<?=base_url()?>admin/matapelajaran/index" style="color:<?php if($link=='Admin/Matapelajaran/Index'){?> #2196F3 <?php }?>;">Mata Pelajaran</a></li>
                </ul>
              </li>
              <li class="<?php if(isset($link) && ($link=='Admin/Kelassiswa/Index' || $link=='Admin/Kelasrombel/Index')){ ?> active <?php } ?> ripple">
                <a class="tree-toggle nav-header"><span class="fa-cogs fa"></span> Setting 
                  <span class="<?php if(isset($link) && ($link=='Admin/Kelassiswa/Index' || $link=='Admin/Kelasrombel/Index')){ ?> fa-angle-down <?php }else{ ?> fa-angle-right <?php }?> fa right-arrow text-right"></span>
                </a>
                <ul class="nav nav-list tree <?php if(isset($link) && ($link=='Admin/Kelassiswa/Index' || $link=='Admin/Kelasrombel/Index')){ ?> open <?php } ?>">
                  <li><a href="<?=base_url()?>admin/kelasrombel/index" style="color:<?php if($link=='Admin/Kelasrombel/Index'){?> #2196F3 <?php }?>;">Kelas Rombel</a></li>
                  <!-- <li><a href="<?=base_url()?>admin/kelassiswa/index" style="color:<?php if($link=='Admin/Kelassiswa/Index'){?> #2196F3 <?php }?>;">Kelas Siswa</a></li> -->
                </ul>
              </li>
            </ul>
          </div>
      </div>
    <!-- end: Left Menu -->