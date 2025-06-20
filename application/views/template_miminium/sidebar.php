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
              <li class="time">
                <h1 class="animated fadeInLeft">21:00</h1>
                <p class="animated fadeInRight">Sat,October 1st 2029</p>
              </li>
              <!-- <li class="active ripple">
                <a class="tree-toggle nav-header"><span class="fa-home fa"></span> Dashboard 
                  <span class="fa-angle-right fa right-arrow text-right"></span>
                </a>
                <ul class="nav nav-list tree">
                    <li><a href="dashboard-v1.html">Dashboard v.1</a></li>
                    <li><a href="dashboard-v2.html">Dashboard v.2</a></li>
                </ul>
              </li> -->

              <li class="<?php if(isset($link) && ($link=='Admin/Pegawai/Index' || $link=='Admin/Kelas/Index')){?> active <?php }?> ripple">
                <a class="tree-toggle nav-header"><i class="fa fa-cogs" aria-hidden="true"></i> Master Data 
                  <span class="<?php if($link=='Admin/Pegawai/Index' || $link=='Admin/Kelas/Index'){?> fa-angle-down <?php }else{?> fa-angle-right <?php }?> fa right-arrow text-right"></span>
                </a>
                <ul class="nav nav-list tree<?php if($link=='Admin/Pegawai/Index' || $link=='Admin/Kelas/Index'){?> open<?php }?>">
                    <li><a href="<?=base_url()?>admin/pegawai/index" style="color:<?php if($link=='Admin/Pegawai/Index'){?> #2196F3 <?php }?>;">Pegawai </a></li>
                    <li><a href="dashboard-v2.html">Siswa</a></li>
                    <li><a href="<?=base_url()?>admin/kelas/index" style="color:<?php if($link=='Admin/Kelas/Index'){?> #2196F3 <?php }?>;">Kelas</a></li>
                </ul>
              </li>
              
            </ul>
          </div>
      </div>
    <!-- end: Left Menu -->