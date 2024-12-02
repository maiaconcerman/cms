<?php
include('z_db.php');
?>
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <?php
        $rr = mysqli_query($con, "SELECT ufile FROM logo");
        $r = mysqli_fetch_row($rr);
        $ufile = $r[0];
        ?>

        <a href="dashboard.php" class="logo logo-dark">
            <span class="logo-sm">
                <img src="assets/images/sinag_with_text.png" alt="" height="50">
            </span>
            <span class="logo-lg">
                <img src="assets/images/sinag_with_text.png" alt="" height="58">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="dashboard.php" class="logo logo-light">
            <span class="logo-sm">
                <img src="assets/images/sinag_with_text.png" alt="" height="50">
            </span>
            <span class="logo-lg">
                <img src="assets/images/sinag_with_text.png" alt="" height="58">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Admin</span></li>


                <li class="nav-item">
                    <a href="dashboard" class="nav-link" data-key="t-analytics"> <i class="ri-dashboard-2-line"></i>
                        <span data-key="t-dashboards"> Dashboard </span></a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarPot" data-bs-toggle="collapse" role="button"
                            aria-expanded="true" aria-controls="sidebarLanding">
                            <i class="ri-rhythm-fill"></i> <span data-key="t-landing"> Activity Log </span>
                        </a>
                        <div class="menu-dropdown collapse" id="sidebarPot" style="">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="dashboard" class="nav-link" data-key="t-analytics"> Recent Actions </a>
                                </li>
                                <li class="nav-item">
                                    <a href="dashboard" class="nav-link" data-key="t-analytics"> Updates </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarSl" data-bs-toggle="collapse" role="button"
                            aria-expanded="true" aria-controls="sidebarLanding">
                            <i class="ri-image-fill"></i> <span data-key="t-landing"> Customization </span>
                        </a>
                        <div class="menu-dropdown collapse" id="sidebarSl" style="">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="dashboard" class="nav-link" data-key="t-analytics"> Preferences </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebar5" data-bs-toggle="collapse" role="button"
                            aria-expanded="true" aria-controls="sidebarLanding">
                            <i class="ri-chrome-fill"></i> <span data-key="t-landing"> Widgets </span>
                        </a>
                        <div class="menu-dropdown collapse" id="sidebar5" style="">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="dashboard" class="nav-link" data-key="t-analytics"> Data </a>
                                </li>
                                <li class="nav-item">
                                    <a href="dashboard" class="nav-link" data-key="t-analytics"> Insights </a>
                                </li>
                            </ul>
                        </div>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarX" data-bs-toggle="collapse" role="button"
                            aria-expanded="true" aria-controls="sidebarLanding">
                            <i class="ri-tools-fill"></i> <span data-key="t-landing"> Report </span>
                        </a>
                        <div class="menu-dropdown collapse" id="sidebarX" style="">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="clicks_report.php" class="nav-link" data-key="t-analytics"> Clicks Report</a>
                                </li>
                                <li class="nav-item">
                                    <a href="audit_trail.php" class="nav-link" data-key="t-analytics"> Audit Trail </a>
                                </li>
                                <li class="nav-item">
                                    <a href="categories_report.php" class="nav-link" data-key="t-analytics"> Categories </a>
                                </li>
                                <li class="nav-item">
                                    <a href="roles_report.php" class="nav-link" data-key="t-analytics"> Roles </a>
                                </li>
                                <li class="nav-item">
                                    <a href="inactive_users.php" class="nav-link" data-key="t-analytics"> Inactive Users </a>
                                 </li>
                                 <li class="nav-item">
                                 <a href="signup_trends.php" class="nav-link" data-key="t-analytics"> Sign-Up Trends </a>
                                 <li class="nav-item">
                                 <a href="export_pdf.php" class="nav-link" data-key="t-analytics"> export </a>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebar4" data-bs-toggle="collapse" role="button"
                            aria-expanded="true" aria-controls="sidebarLanding">
                            <i class="ri-user-fill"></i> <span data-key="t-landing"> User Management </span>
                        </a>
                        <div class="menu-dropdown collapse" id="sidebar4" style="">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="add_user" class="nav-link" data-key="t-analytics"> add user </a>
                                </li>
                                <li class="nav-item">
                                    <a href="user_list" class="nav-link" data-key="t-analytics"> User list </a>
                                </li>
                            </ul>
                        </div>
                    </li>


                    <li class="nav-item">
                        <a href="settings.php" class="nav-link" data-key="t-analytics">
                            <i class="ri-tools-fill"></i> <span data-key="t-landing"> Settings </span>
                        </a>
                    </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>