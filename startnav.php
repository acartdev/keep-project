<?php if (!empty($_SESSION['role']) && $_SESSION['role'] !== "user") : ?>
    <div class="container-fluid bg-light">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-white shadow z-3">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">

                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item ">
                            <a href="add_project.php" class="nav-link text-danger align-middle px-0 fs-6">
                                <i class="fa-solid fa-folder-open"></i> <span class="ms-1 d-none d-sm-inline ">จัดการโครงงาน</span>
                            </a>
                        </li>
                        <li>
                            <a href="add_user.php" class="nav-link px-0 align-middle text-danger">
                                <i class="fa-solid fa-users-rectangle"></i> <span class="ms-1 d-none d-sm-inline">จัดการผู้ใช้</span> </a>
                        </li>
                        <li>
                            <a href="add_teacher.php" class="nav-link px-0 align-middle text-danger">
                                <i class="fa-solid fa-user-gear"></i> <span class="ms-1 d-none d-sm-inline">จัดการครูที่ปรึกษา</span> </a>
                        </li>

                        <li>
                            <a href="admin_page.php" class="nav-link px-0 align-middle text-danger">
                                <i class="fa-solid fa-users-rectangle"></i> <span class="ms-1 d-none d-sm-inline">ผู้จัดการระบบ</span> </a>
                        </li>
                        <li>
                            <a href="edit_banner.php" class="nav-link px-0 align-middle text-danger">
                                <i class="fa-solid fa-images"></i> <span class="ms-1 d-none d-sm-inline">จัดการแบร์นเนอร์</span> </a>
                        </li>
                    </ul>
                    <hr>

                </div>
            </div>
            <div class="col py-3">
            <?php endif; ?>