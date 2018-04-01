<!-- BEGIN SIDEBAR -->
<div class="sidebar">
    <div class="logopanel">
        <h1>
            <a href="index.php"></a>
        </h1>
    </div>
    <div class="sidebar-inner">
        <ul class="nav nav-sidebar">
            <li class="nav-active active"><a href="index.php?menu=home"><i class="icon-home"></i><span>Home</span></a>
            </li>

            <?php
            if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
                ?>
                <li class="nav-parent">
                    <a href="#"><i class="icon-docs"></i><span>Survey</span> <span class="fa arrow"></span></a>
                    <ul class="children collapse">
                        <li><a href="index.php?menu=insertSurvey"> Insert Survey</a></li>
                        <li><a href="index.php?menu=survey"> Survey</a></li>
<!--                        <li><a href="index.php?menu=survey"> Survey Draf</a></li>-->
                        <li><a href="index.php?menu=jawabanSurvey"> Jawaban Survey</a></li>
                    </ul>
                </li>
                <li class="nav-parent">
                    <a href="#"><i class="fa fa-newspaper-o"></i><span>Berita</span> <span class="fa arrow"></span></a>
                    <ul class="children collapse">
                        <li><a href="index.php?menu=berita"> Lihat Berita</a></li>
                        <li><a href="index.php?menu=dataBerita"> Data Berita</a></li>
                        <li><a href="index.php?menu=dataKategoriBerita"> Data Kategori Berita</a></li>
                    </ul>
                </li>
                <li class="nav"><a href="index.php?menu=insertResponden"><i class="fa fa-user  "></i><span>Responden</span></a>
                </li>
                <li class="nav-parent">
                    <a href="#"><i class="icon-users"></i><span>Users</span> <span class="fa arrow"></span></a>
                    <ul class="children collapse">
                        <li><a href="index.php?menu=userMember"> Member</a></li>
                        <li><a href="index.php?menu=userAdmin"> Admin</a></li>
                    </ul>
                </li>
                <?php
            } else if (isset($_SESSION['role']) && $_SESSION['role'] == 0) {
                ?>
                <li class="nav"><a href="index.php?menu=berita"><i class="fa fa-newspaper-o"></i><span>Berita</span></a>
                </li>
<!--                <li class="nav"><a href="#"><i class="icons-office-02"></i><span>Lowongan Kerja</span></a>-->
<!--                </li>-->
                <li class="nav"><a href="index.php?menu=surveyMember"><i class="icon-docs"></i><span>Survey</span></a>
                </li>
                <li class="nav"><a href="index.php?menu=isiResponden"><i class="fa fa-user  "></i><span>Profile</span></a>
                </li>
                <?php
            } else {
                ?>
                <li class="nav"><a href="index.php?menu=berita"><i class="fa fa-newspaper-o"></i><span>Berita</span></a>
                </li>
                <li class="nav"><a href="#"><i class="icons-office-02"></i><span>Lowongan Kerja</span></a>
                </li>
                <?php
            }
            ?>
        </ul>

        <div class="sidebar-footer clearfix">
            <a class="pull-left footer-settings" href="#" data-rel="tooltip" data-placement="top"
               data-original-title="Settings">
                <i class="icon-settings"></i></a>
            <a class="pull-left toggle_fullscreen" href="#" data-rel="tooltip" data-placement="top"
               data-original-title="Fullscreen">
                <i class="icon-size-fullscreen"></i></a>
            <a class="pull-left" href="#" data-rel="tooltip" data-placement="top" data-original-title="Lockscreen">
                <i class="icon-lock"></i></a>
            <a class="pull-left btn-effect" href="#" data-modal="modal-1" data-rel="tooltip" data-placement="top"
               data-original-title="Logout">
                <i class="icon-power"></i></a>
        </div>
    </div>
</div>
<!-- END SIDEBAR -->