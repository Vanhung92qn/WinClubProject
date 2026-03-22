<div class="scroll-sidebar">
    <?php $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>

    <ul id="sidebar-menu" class="gw-nav gw-nav-list">
        <li class="home-item <?php if($actual_link ==  admin_url("") ){echo "active";}else{echo "init-un-active";} ?> "> 
            <a href="<?php echo admin_url("")?>"> <span class="gw-menu-text">Trang chủ</span> </a> </li>
        <?php if (isset($admin_info)) :  ?>
        <?php echo $menu_list; ?>
        <?php endif; ?>
    </ul>
    <div class="linebreak"></div>

</div>
<!-- <div class="bgg" style="position: fixed;
    height: 100%;
    width: 260px;
    left: 0;
    top: 0;
    background: #2b3a4a;
    z-index: -1;"></div> -->

<style>
    .home-item {
        position: sticky !important;
        top: 0;
        background: #2b3a4a;
        z-index: 99;
    }
    .home-item>a {
        background-color: #2b3a4a;
    }
   .home-item>a:hover {
        background-color: #0e90e4;
    }
   .home-item>a:focus {
        background-color: #0e90e4;
    }
</style>