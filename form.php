<?php
require_once "TemplateDropdownMenu.php";

// Example usage
$notifications = [
    'data' => [
        ['id' => 1, 'message' => 'New comment on your post', 'time' => '2 minutes ago', 'link' => '/comment/1', 'timestamp'=>time()*1000],
        ['id' => 2, 'message' => 'Your order has shipped', 'time' => '5 minutes ago', 'link' => '/order/123', 'timestamp'=>time()*1000],
    ],
    'totalData' => 8
];

$messages = [
    'data' => [
        ['id' => 1, 'message' => 'John Doe sent you a message', 'time' => '10 minutes ago', 'link' => '/message/1', 'timestamp'=>time()*1000],
        ['id' => 2, 'message' => 'Jane Smith sent you a message', 'time' => '30 minutes ago', 'link' => '/message/2', 'timestamp'=>time()*1000],
    ],
    'totalData' => 5
];

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome/all.min.css">
    <link rel="stylesheet" href="css/css.css">
    <link rel="shortcut icon" href="css/favicon.png" type="image/png">
    <link rel="stylesheet" href="vendors/datetime-picker/bootstrap-datetimepicker.css">
    <link rel="stylesheet" href="vendors/fontawesome-free-6.5.2-web/css/all.min.css">
    <script src="js/MultiSelect.js"></script>
    <script src="vendors/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendors/moment/min/moment.min.js"></script>
    <script src="vendors/datetime-picker/bootstrap-datetimepicker.js"></script>
    <script src="vendors/sortable/Sortable.min.js"></script>
    <script src="js/custom.js"></script>

</head>

<body>
    <script src="js/color-mode.js"></script>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <button class="button-transparent toggle-sidebar"><i class="fas fa-times"></i></button>
        <!-- Button to toggle sidebar -->
        <h4 class="text-white text-center"><a href="./">Dashboard</a></h4> <!-- Sidebar title -->
        <ul class="nav flex-column" id="sidebarMenu"> <!-- Sidebar menu, populated by JavaScript -->
            <!-- The menu will be populated by JavaScript -->
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-tachometer-alt"></i> Dashboard Home</a>
                <!-- Main link with icon -->
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#submenu1" data-toggle="collapse"><i class="fas fa-folder"></i> Menu 1</a>
                <!-- Menu with a submenu -->
                <div id="submenu1" class="collapse"> <!-- Submenu 1 -->
                    <ul class="nav flex-column pl-3">
                        <li class="nav-item">
                            <a class="nav-link" href="#submenu1-1" data-toggle="collapse"><i
                                    class="fas fa-file-alt"></i> Submenu 1-1</a> <!-- Submenu with a deeper submenu -->
                            <div id="submenu1-1" class="collapse"> <!-- Submenu 1-1 -->
                                <ul class="nav flex-column pl-3">
                                    <li class="nav-item">
                                        <a class="nav-link" href="form.html"><i class="fas fa-file"></i> Form</a>
                                        <!-- Level 3 submenu -->
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"><i class="fas fa-file"></i> Submenu 1-1-2</a>
                                        <!-- Level 3 submenu -->
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fas fa-file-alt"></i> Submenu 1-2</a>
                            <!-- Level 2 submenu -->
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#submenu2" data-toggle="collapse"><i class="fas fa-folder"></i> Menu 2</a>
                <!-- Menu with a submenu -->
                <div id="submenu2" class="collapse"> <!-- Submenu 2 -->
                    <ul class="nav flex-column pl-3">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fas fa-file-alt"></i> Submenu 2-1</a>
                            <!-- Level 2 submenu -->
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#submenu2-1" data-toggle="collapse"><i
                                    class="fas fa-file-alt"></i> Submenu 2-2</a> <!-- Submenu with a deeper submenu -->
                            <div id="submenu2-1" class="collapse"> <!-- Submenu 2-2 -->
                                <ul class="nav flex-column pl-3">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"><i class="fas fa-file"></i> Submenu 2-2-1</a>
                                        <!-- Level 3 submenu -->
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"><i class="fas fa-file"></i> Submenu 2-2-2</a>
                                        <!-- Level 3 submenu -->
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <?php
    $dd = new TemplateDrowpdownMenu();
    ?>
    <div class="content">
        <nav class="navbar navbar-expand navbar-light"> <!-- Navbar at the top -->
            <button class="btn btn-outline-secondary toggle-sidebar"><i class="fas fa-bars"></i></button>
            <!-- Button to toggle sidebar -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto"> <!-- Menu on the right side of the navbar -->
                    
                    <?php
                    $ddmenu = new TemplateDrowpdownMenu();
                    echo $ddmenu->dropdownMenu($notifications, 'notificationDropdown', 'notificationMenu', 'fas fa-bell'); // Output notifications
                    echo $ddmenu->dropdownMenu($messages, 'messageDropdown', 'messageMenu', 'fas fa-comments'); // Output messages
                    ?>
                
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button"
                            data-toggle="dropdown">
                            <i class="fas fa-user"></i> <!-- Account icon -->
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="accountDropdown">
                            <a class="dropdown-item" href="#">Profile</a> <!-- Profile item -->
                            <a class="dropdown-item" href="#">Settings</a> <!-- Settings item -->
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button"
                            data-toggle="dropdown">
                            <i class="fas fa-globe"></i> <!-- Language selection icon -->
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="languageDropdown">
                            <a class="dropdown-item" href="#"><img src="css/id.svg" class="language-flag" alt="ID">
                                Bahasa Indonesia</a> <!-- Language option -->
                            <a class="dropdown-item" href="#"><img src="css/us.svg" class="language-flag" alt="EN">
                                English</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-outline-secondary toggle-mode"><i class="fas fa-adjust"></i></button>
                        <!-- Button to toggle mode -->
                    </li>
                </ul>
            </div>
        </nav>
        <h2>Form</h2> <!-- Main content title -->
        <form action="" method="get">
            <table class="responsive-table two-side-responsive-table">
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td><input class="form-control" type="text" name="name" id="name"></td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td><select class="form-control" name="gender" id="gender">
                                <option value="M">Man</option>
                                <option value="W">Woman</option>
                            </select></td>
                    </tr>
                    <tr>
                        <td>Birth Date</td>
                        <td><input class="form-control" type="date" name="birth_date" id="birth_date"
                                data-mindate="2024-12-10"></td>
                    </tr>
                    <tr>
                        <td>Time Register</td>
                        <td><input class="form-control" type="datetime-local" name="time_register" id="time_register">
                        </td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><textarea class="form-control" name="address" id="address"></textarea></td>
                    </tr>
                    <tr>
                        <td>Languages</td>
                        <td><select class="form-control" name="languages" id="languages" placeholder="Select item(s)"
                                data-search-placeholder="Search" data-label-selected="selected"
                                data-label-select-all="Select all" multiple data-multi-select>
                                <option value="EN">English</option>
                                <optgroup label="Asia">
                                    <option value="ID">Bahasa Indonesian</option>
                                    <option value="JV" selected>Javanese</option>
                                    <option value="JP">Japanese</option>
                                </optgroup>
                                <optgroup label="Europa">
                                    <option value="DE">Germany</option>
                                </optgroup>
                            </select>
                        </td>
                    <tr>
                        <td>Languages</td>
                        <td><select class="form-control" name="languages" id="languages"
                                data-placeholder="Select item(s)" data-search-placeholder="Search"
                                data-label-selected="selected" data-label-select-all="Select all" multiple
                                data-multi-select>
                                <option value="EN">English</option>
                                <optgroup label="Asia">
                                    <option value="ID">Indonesian</option>
                                    <option value="JV">Javanese</option>
                                    <option value="JP">Japanese</option>
                                </optgroup>
                                <optgroup label="Europa">
                                    <option value="DE">Germany</option>
                                </optgroup>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Active</td>
                        <td>
                            <label><input type="radio" name="active" id="active"> Yes</label>
                            <label><input type="radio" name="active" id="active"> No</label>
                        </td>
                    </tr>
                    <tr>
                        <td>Blocked</td>
                        <td>
                            <label><input type="checkbox" name="blocked" id="active"> Yes</label>
                            <label><input type="checkbox" name="blocked" id="active"> No</label>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <button class="btn btn-success" type="submit">Submit</button>
                            <button class="btn btn-secondary" type="button">Back</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>



        <div class="filter-section">
            <form action="" method="get" class="filter-form">
                <span class="filter-group">
                    <span class="filter-label">Nama</span>
                    <span class="filter-control">
                        <input type="text" name="nama" class="form-control" value="" autocomplete="off">
                    </span>
                </span>

                <span class="filter-group">
                    <span class="filter-label">KTSK</span>
                    <span class="filter-control">
                        <select name="ktsk_id" class="form-control">
                            <option value="">Pilih satu</option>
                            <option value="3">ABDI HAMDANI</option>
                            <option value="5">RIZKI NANDA</option>
                            <option value="4">ROY PUTRA SILALAHI</option>
                            <option value="10">SIGIT HERWANTO</option>
                            <option value="11">SWEMPRI AGUNG PRASETYO</option>
                            <option value="8">YULIANDI HIDAYAT DALIMUNTHE</option>
                            <option value="12">YUNIAR LUBIS</option>
                        </select>
                    </span>
                </span>

                <span class="filter-group">
                    <span class="filter-label">KTSK</span>
                    <span class="filter-control">
                        <select name="ktsk_id" class="form-control" multiple data-multi-select>
                            <option value="">Pilih satu</option>
                            <option value="3">ABDI HAMDANI</option>
                            <option value="5">RIZKI NANDA</option>
                            <optgroup label="Anu">
                                <option value="4">ROY PUTRA SILALAHI</option>
                                <option value="10">SIGIT HERWANTO</option>
                            </optgroup>
                            <option value="11">SWEMPRI AGUNG PRASETYO</option>
                            <optgroup label="Any">
                                <option value="8">YULIANDI HIDAYAT DALIMUNTHE</option>
                                <option value="12">YUNIAR LUBIS</option>
                            </optgroup>
                        </select>
                    </span>
                </span>

                <span class="filter-group">
                    <span class="filter-label">Date Time</span>
                    <span class="filter-control">
                        <input class="form-control" type="datetime-local" name="time_register" id="time_register">
                    </span>
                </span>

                <span class="filter-group">
                    <span class="filter-label">Date</span>
                    <span class="filter-control">
                        <input class="form-control" type="date" name="time_register" id="time_register">
                    </span>
                </span>

                <span class="filter-group">
                    <span class="filter-label">Time</span>
                    <span class="filter-control">
                        <input class="form-control" type="time" name="time_register" id="time_register">
                    </span>
                </span>

                <span class="filter-group">
                    <button type="submit" class="btn btn-success">Cari</button>
                </span>

                <span class="filter-group">
                    <button type="submit" name="user_action" value="export" class="btn btn-success">Ekspor</button>
                </span>
                <span class="filter-group">
                    <button type="submit" name="filter" value="update" class="btn btn-success"><span
                            class="fa fa-edit"></span></button>
                </span>

                <span class="filter-group">
                    <button type="button" class="btn btn-primary"
                        onclick="window.location='/lokasi-proyek.php?user_action=create'">Tambah</button>
                </span>
                <input type="hidden" name="orderby"><input type="hidden" name="ordertype">
            </form>
        </div>

        <div class="data-section" data-ajax-support="true" data-ajax-name="main-data">
            <div class="pagination pagination-top">
                <div class="pagination-number">
                    <span class="page-selector page-selector-number page-first page-selected" data-page-number="1"><a
                            href="?ordertype=asc&amp;orderby=nama&amp;page=1">1</a></span><span
                        class="page-selector page-selector-number page-last" data-page-number="2"><a
                            href="?ordertype=asc&amp;orderby=nama&amp;page=2">2</a></span><span
                        class="page-selector page-selector-step-one" data-page-number="2"><a
                            href="?ordertype=asc&amp;orderby=nama&amp;page=2"><i
                                class="fa-solid fa-angle-right"></i></a></span>
                </div>
            </div>
            <form action="" method="post" class="data-form">
                <div class="data-wrapper">
                    <table class="table table-row table-sort-by-column">
                        <thead>
                            <tr>
                                <td class="data-sort data-sort-header"></td>
                                <td class="data-controll data-selector" data-key="jenis_pekerjaan_id">
                                    <input type="checkbox" class="checkbox check-master"
                                        data-selector=".checkbox-jenis-pekerjaan-id">
                                </td>
                                <td class="data-controll data-editor">
                                    <span class="fa fa-edit"></span>
                                </td>
                                <td class="data-controll data-viewer">
                                    <span class="fa fa-folder"></span>
                                </td>
                                <td class="data-controll data-number">No</td>
                                <td data-col-name="jenis_pekerjaan_id" class="order-controll"><a
                                        href="?ordertype=asc&amp;orderby=jenis_pekerjaan_id">Kode</a>
                                </td>
                                <td data-col-name="nama" class="order-controll" data-order-method="asc"><a
                                        href="?ordertype=desc&amp;orderby=nama">Nama</a>
                                </td>
                                <td data-col-name="tipe_pondasi_id" class="order-controll"><a
                                        href="?ordertype=asc&amp;orderby=tipe_pondasi_id">Tipe
                                        Pondasi</a></td>
                                <td data-col-name="kelas_tower_id" class="order-controll"><a
                                        href="?ordertype=asc&amp;orderby=kelas_tower_id">Kelas
                                        Tower</a></td>
                                <td data-col-name="lokasi_proyek_id" class="order-controll"><a
                                        href="?ordertype=asc&amp;orderby=lokasi_proyek_id">Lokasi
                                        Proyek</a></td>
                                <td data-col-name="kegiatan" class="order-controll"><a
                                        href="?ordertype=asc&amp;orderby=kegiatan">Kegiatan</a>
                                </td>
                                <td data-col-name="sort_order" class="order-controll"><a
                                        href="?ordertype=asc&amp;orderby=sort_order">Sort
                                        Order</a></td>
                                <td data-col-name="default_data" class="order-controll"><a
                                        href="?ordertype=asc&amp;orderby=default_data">Default
                                        Data</a></td>
                                <td data-col-name="aktif" class="order-controll"><a
                                        href="?ordertype=asc&amp;orderby=aktif">Aktif</a>
                                </td>
                            </tr>
                        </thead>

                        <tbody class="data-table-manual-sort" data-offset="0">

                            <tr data-primary-key="BRp" data-sort-order="0" data-number="1">
                                <td class="data-sort data-sort-body data-sort-handler"></td>
                                <td class="data-selector" data-key="jenis_pekerjaan_id">
                                    <input type="checkbox" class="checkbox check-slave checkbox-jenis-pekerjaan-id"
                                        name="checked_row_id[]" value="BRp">
                                </td>
                                <td>
                                    <a class="edit-control"
                                        href="?user_action=update&amp;jenis_pekerjaan_id=BRp"><span
                                            class="fa fa-edit"></span></a>
                                </td>
                                <td>
                                    <a class="detail-control field-master"
                                        href="?user_action=detail&amp;jenis_pekerjaan_id=BRp"><span
                                            class="fa fa-folder"></span></a>
                                </td>
                                <td class="data-number">1</td>
                                <td data-col-name="jenis_pekerjaan_id">BRp</td>
                                <td data-col-name="nama">BAY REACTOR GITET 500 KV PERAWANG</td>
                                <td data-col-name="tipe_pondasi_id">Ya</td>
                                <td data-col-name="kelas_tower_id">Tidak</td>
                                <td data-col-name="lokasi_proyek_id">Ya</td>
                                <td data-col-name="kegiatan">Ya</td>
                                <td data-col-name="sort_order" class="data-sort-order-column">0</td>
                                <td data-col-name="default_data">Tidak</td>
                                <td data-col-name="aktif">Tidak</td>
                            </tr>

                            <tr data-primary-key="EM" data-sort-order="1" data-number="2">
                                <td class="data-sort data-sort-body data-sort-handler"></td>
                                <td class="data-selector" data-key="jenis_pekerjaan_id">
                                    <input type="checkbox" class="checkbox check-slave checkbox-jenis-pekerjaan-id"
                                        name="checked_row_id[]" value="EM">
                                </td>
                                <td>
                                    <a class="edit-control"
                                        href="?user_action=update&amp;jenis_pekerjaan_id=EM"><span
                                            class="fa fa-edit"></span></a>
                                </td>
                                <td>
                                    <a class="detail-control field-master"
                                        href="?user_action=detail&amp;jenis_pekerjaan_id=EM"><span
                                            class="fa fa-folder"></span></a>
                                </td>
                                <td class="data-number">2</td>
                                <td data-col-name="jenis_pekerjaan_id">EM</td>
                                <td data-col-name="nama">E/M</td>
                                <td data-col-name="tipe_pondasi_id">Tidak</td>
                                <td data-col-name="kelas_tower_id">Tidak</td>
                                <td data-col-name="lokasi_proyek_id">Ya</td>
                                <td data-col-name="kegiatan">Ya</td>
                                <td data-col-name="sort_order" class="data-sort-order-column">1</td>
                                <td data-col-name="default_data">Tidak</td>
                                <td data-col-name="aktif">Ya</td>
                            </tr>

                            <tr data-primary-key="GI" data-sort-order="2" data-number="3">
                                <td class="data-sort data-sort-body data-sort-handler"></td>
                                <td class="data-selector" data-key="jenis_pekerjaan_id">
                                    <input type="checkbox" class="checkbox check-slave checkbox-jenis-pekerjaan-id"
                                        name="checked_row_id[]" value="GI">
                                </td>
                                <td>
                                    <a class="edit-control"
                                        href="?user_action=update&amp;jenis_pekerjaan_id=GI"><span
                                            class="fa fa-edit"></span></a>
                                </td>
                                <td>
                                    <a class="detail-control field-master"
                                        href="?user_action=detail&amp;jenis_pekerjaan_id=GI"><span
                                            class="fa fa-folder"></span></a>
                                </td>
                                <td class="data-number">3</td>
                                <td data-col-name="jenis_pekerjaan_id">GI</td>
                                <td data-col-name="nama">Pekerjaan EM GI</td>
                                <td data-col-name="tipe_pondasi_id">Tidak</td>
                                <td data-col-name="kelas_tower_id">Tidak</td>
                                <td data-col-name="lokasi_proyek_id">Tidak</td>
                                <td data-col-name="kegiatan">Ya</td>
                                <td data-col-name="sort_order" class="data-sort-order-column">2</td>
                                <td data-col-name="default_data">Tidak</td>
                                <td data-col-name="aktif">Ya</td>
                            </tr>

                            <tr data-primary-key="ERE" data-sort-order="3" data-number="4">
                                <td class="data-sort data-sort-body data-sort-handler"></td>
                                <td class="data-selector" data-key="jenis_pekerjaan_id">
                                    <input type="checkbox" class="checkbox check-slave checkbox-jenis-pekerjaan-id"
                                        name="checked_row_id[]" value="ERE">
                                </td>
                                <td>
                                    <a class="edit-control"
                                        href="?user_action=update&amp;jenis_pekerjaan_id=ERE"><span
                                            class="fa fa-edit"></span></a>
                                </td>
                                <td>
                                    <a class="detail-control field-master"
                                        href="?user_action=detail&amp;jenis_pekerjaan_id=ERE"><span
                                            class="fa fa-folder"></span></a>
                                </td>
                                <td class="data-number">4</td>
                                <td data-col-name="jenis_pekerjaan_id">ERE</td>
                                <td data-col-name="nama">Pekerjaan Erection</td>
                                <td data-col-name="tipe_pondasi_id">Tidak</td>
                                <td data-col-name="kelas_tower_id">Ya</td>
                                <td data-col-name="lokasi_proyek_id">Ya</td>
                                <td data-col-name="kegiatan">Ya</td>
                                <td data-col-name="sort_order" class="data-sort-order-column">3</td>
                                <td data-col-name="default_data">Tidak</td>
                                <td data-col-name="aktif">Ya</td>
                            </tr>

                            <tr data-primary-key="HEE" data-sort-order="0" data-number="5">
                                <td class="data-sort data-sort-body data-sort-handler"></td>
                                <td class="data-selector" data-key="jenis_pekerjaan_id">
                                    <input type="checkbox" class="checkbox check-slave checkbox-jenis-pekerjaan-id"
                                        name="checked_row_id[]" value="HEE">
                                </td>
                                <td>
                                    <a class="edit-control"
                                        href="?user_action=update&amp;jenis_pekerjaan_id=HEE"><span
                                            class="fa fa-edit"></span></a>
                                </td>
                                <td>
                                    <a class="detail-control field-master"
                                        href="?user_action=detail&amp;jenis_pekerjaan_id=HEE"><span
                                            class="fa fa-folder"></span></a>
                                </td>
                                <td class="data-number">5</td>
                                <td data-col-name="jenis_pekerjaan_id">HEE</td>
                                <td data-col-name="nama">Pekerjaan HSE E/M GI</td>
                                <td data-col-name="tipe_pondasi_id">Ya</td>
                                <td data-col-name="kelas_tower_id">Ya</td>
                                <td data-col-name="lokasi_proyek_id">Ya</td>
                                <td data-col-name="kegiatan">Ya</td>
                                <td data-col-name="sort_order" class="data-sort-order-column">0</td>
                                <td data-col-name="default_data">Tidak</td>
                                <td data-col-name="aktif">Tidak</td>
                            </tr>

                            <tr data-primary-key="HSG" data-sort-order="0" data-number="6">
                                <td class="data-sort data-sort-body data-sort-handler"></td>
                                <td class="data-selector" data-key="jenis_pekerjaan_id">
                                    <input type="checkbox" class="checkbox check-slave checkbox-jenis-pekerjaan-id"
                                        name="checked_row_id[]" value="HSG">
                                </td>
                                <td>
                                    <a class="edit-control"
                                        href="?user_action=update&amp;jenis_pekerjaan_id=HSG"><span
                                            class="fa fa-edit"></span></a>
                                </td>
                                <td>
                                    <a class="detail-control field-master"
                                        href="?user_action=detail&amp;jenis_pekerjaan_id=HSG"><span
                                            class="fa fa-folder"></span></a>
                                </td>
                                <td class="data-number">6</td>
                                <td data-col-name="jenis_pekerjaan_id">HSG</td>
                                <td data-col-name="nama">Pekerjaan HSE Sipil GI</td>
                                <td data-col-name="tipe_pondasi_id">Ya</td>
                                <td data-col-name="kelas_tower_id">Ya</td>
                                <td data-col-name="lokasi_proyek_id">Ya</td>
                                <td data-col-name="kegiatan">Ya</td>
                                <td data-col-name="sort_order" class="data-sort-order-column">0</td>
                                <td data-col-name="default_data">Tidak</td>
                                <td data-col-name="aktif">Ya</td>
                            </tr>

                            <tr data-primary-key="SHE" data-sort-order="0" data-number="7">
                                <td class="data-sort data-sort-body data-sort-handler"></td>
                                <td class="data-selector" data-key="jenis_pekerjaan_id">
                                    <input type="checkbox" class="checkbox check-slave checkbox-jenis-pekerjaan-id"
                                        name="checked_row_id[]" value="SHE">
                                </td>
                                <td>
                                    <a class="edit-control"
                                        href="?user_action=update&amp;jenis_pekerjaan_id=SHE"><span
                                            class="fa fa-edit"></span></a>
                                </td>
                                <td>
                                    <a class="detail-control field-master"
                                        href="?user_action=detail&amp;jenis_pekerjaan_id=SHE"><span
                                            class="fa fa-folder"></span></a>
                                </td>
                                <td class="data-number">7</td>
                                <td data-col-name="jenis_pekerjaan_id">SHE</td>
                                <td data-col-name="nama">Pekerjaan Pengawasan HSE Erection</td>
                                <td data-col-name="tipe_pondasi_id">Ya</td>
                                <td data-col-name="kelas_tower_id">Ya</td>
                                <td data-col-name="lokasi_proyek_id">Ya</td>
                                <td data-col-name="kegiatan">Ya</td>
                                <td data-col-name="sort_order" class="data-sort-order-column">0</td>
                                <td data-col-name="default_data">Tidak</td>
                                <td data-col-name="aktif">Ya</td>
                            </tr>

                            <tr data-primary-key="HSE" data-sort-order="0" data-number="8">
                                <td class="data-sort data-sort-body data-sort-handler"></td>
                                <td class="data-selector" data-key="jenis_pekerjaan_id">
                                    <input type="checkbox" class="checkbox check-slave checkbox-jenis-pekerjaan-id"
                                        name="checked_row_id[]" value="HSE">
                                </td>
                                <td>
                                    <a class="edit-control"
                                        href="?user_action=update&amp;jenis_pekerjaan_id=HSE"><span
                                            class="fa fa-edit"></span></a>
                                </td>
                                <td>
                                    <a class="detail-control field-master"
                                        href="?user_action=detail&amp;jenis_pekerjaan_id=HSE"><span
                                            class="fa fa-folder"></span></a>
                                </td>
                                <td class="data-number">8</td>
                                <td data-col-name="jenis_pekerjaan_id">HSE</td>
                                <td data-col-name="nama">Pekerjaan Pengawasan HSE Sipil Jaringan</td>
                                <td data-col-name="tipe_pondasi_id">Ya</td>
                                <td data-col-name="kelas_tower_id">Ya</td>
                                <td data-col-name="lokasi_proyek_id">Ya</td>
                                <td data-col-name="kegiatan">Ya</td>
                                <td data-col-name="sort_order" class="data-sort-order-column">0</td>
                                <td data-col-name="default_data">Tidak</td>
                                <td data-col-name="aktif">Ya</td>
                            </tr>

                            <tr data-primary-key="K3L" data-sort-order="0" data-number="9">
                                <td class="data-sort data-sort-body data-sort-handler"></td>
                                <td class="data-selector" data-key="jenis_pekerjaan_id">
                                    <input type="checkbox" class="checkbox check-slave checkbox-jenis-pekerjaan-id"
                                        name="checked_row_id[]" value="K3L">
                                </td>
                                <td>
                                    <a class="edit-control"
                                        href="?user_action=update&amp;jenis_pekerjaan_id=K3L"><span
                                            class="fa fa-edit"></span></a>
                                </td>
                                <td>
                                    <a class="detail-control field-master"
                                        href="?user_action=detail&amp;jenis_pekerjaan_id=K3L"><span
                                            class="fa fa-folder"></span></a>
                                </td>
                                <td class="data-number">9</td>
                                <td data-col-name="jenis_pekerjaan_id">K3L</td>
                                <td data-col-name="nama">Pekerjaan Pengawasan HSE Stringing</td>
                                <td data-col-name="tipe_pondasi_id">Ya</td>
                                <td data-col-name="kelas_tower_id">Ya</td>
                                <td data-col-name="lokasi_proyek_id">Ya</td>
                                <td data-col-name="kegiatan">Ya</td>
                                <td data-col-name="sort_order" class="data-sort-order-column">0</td>
                                <td data-col-name="default_data">Tidak</td>
                                <td data-col-name="aktif">Ya</td>
                            </tr>

                            <tr data-primary-key="SGI" data-sort-order="0" data-number="10">
                                <td class="data-sort data-sort-body data-sort-handler"></td>
                                <td class="data-selector" data-key="jenis_pekerjaan_id">
                                    <input type="checkbox" class="checkbox check-slave checkbox-jenis-pekerjaan-id"
                                        name="checked_row_id[]" value="SGI">
                                </td>
                                <td>
                                    <a class="edit-control"
                                        href="?user_action=update&amp;jenis_pekerjaan_id=SGI"><span
                                            class="fa fa-edit"></span></a>
                                </td>
                                <td>
                                    <a class="detail-control field-master"
                                        href="?user_action=detail&amp;jenis_pekerjaan_id=SGI"><span
                                            class="fa fa-folder"></span></a>
                                </td>
                                <td class="data-number">10</td>
                                <td data-col-name="jenis_pekerjaan_id">SGI</td>
                                <td data-col-name="nama">Pekerjaan Sipil GI</td>
                                <td data-col-name="tipe_pondasi_id">Tidak</td>
                                <td data-col-name="kelas_tower_id">Tidak</td>
                                <td data-col-name="lokasi_proyek_id">Tidak</td>
                                <td data-col-name="kegiatan">Ya</td>
                                <td data-col-name="sort_order" class="data-sort-order-column">0</td>
                                <td data-col-name="default_data">Tidak</td>
                                <td data-col-name="aktif">Ya</td>
                            </tr>

                            <tr data-primary-key="STI" data-sort-order="1" data-number="11">
                                <td class="data-sort data-sort-body data-sort-handler"></td>
                                <td class="data-selector" data-key="jenis_pekerjaan_id">
                                    <input type="checkbox" class="checkbox check-slave checkbox-jenis-pekerjaan-id"
                                        name="checked_row_id[]" value="STI">
                                </td>
                                <td>
                                    <a class="edit-control"
                                        href="?user_action=update&amp;jenis_pekerjaan_id=STI"><span
                                            class="fa fa-edit"></span></a>
                                </td>
                                <td>
                                    <a class="detail-control field-master"
                                        href="?user_action=detail&amp;jenis_pekerjaan_id=STI"><span
                                            class="fa fa-folder"></span></a>
                                </td>
                                <td class="data-number">11</td>
                                <td data-col-name="jenis_pekerjaan_id">STI</td>
                                <td data-col-name="nama">Pekerjaan Sipil Transmisi</td>
                                <td data-col-name="tipe_pondasi_id">Ya</td>
                                <td data-col-name="kelas_tower_id">Ya</td>
                                <td data-col-name="lokasi_proyek_id">Ya</td>
                                <td data-col-name="kegiatan">Ya</td>
                                <td data-col-name="sort_order" class="data-sort-order-column">1</td>
                                <td data-col-name="default_data">Ya</td>
                                <td data-col-name="aktif">Ya</td>
                            </tr>

                            <tr data-primary-key="STR" data-sort-order="4" data-number="12">
                                <td class="data-sort data-sort-body data-sort-handler"></td>
                                <td class="data-selector" data-key="jenis_pekerjaan_id">
                                    <input type="checkbox" class="checkbox check-slave checkbox-jenis-pekerjaan-id"
                                        name="checked_row_id[]" value="STR">
                                </td>
                                <td>
                                    <a class="edit-control"
                                        href="?user_action=update&amp;jenis_pekerjaan_id=STR"><span
                                            class="fa fa-edit"></span></a>
                                </td>
                                <td>
                                    <a class="detail-control field-master"
                                        href="?user_action=detail&amp;jenis_pekerjaan_id=STR"><span
                                            class="fa fa-folder"></span></a>
                                </td>
                                <td class="data-number">12</td>
                                <td data-col-name="jenis_pekerjaan_id">STR</td>
                                <td data-col-name="nama">Pekerjaan Stringing</td>
                                <td data-col-name="tipe_pondasi_id">Tidak</td>
                                <td data-col-name="kelas_tower_id">Tidak</td>
                                <td data-col-name="lokasi_proyek_id">Ya</td>
                                <td data-col-name="kegiatan">Ya</td>
                                <td data-col-name="sort_order" class="data-sort-order-column">4</td>
                                <td data-col-name="default_data">Tidak</td>
                                <td data-col-name="aktif">Tidak</td>
                            </tr>

                            <tr data-primary-key="KEL" data-sort-order="0" data-number="13">
                                <td class="data-sort data-sort-body data-sort-handler"></td>
                                <td class="data-selector" data-key="jenis_pekerjaan_id">
                                    <input type="checkbox" class="checkbox check-slave checkbox-jenis-pekerjaan-id"
                                        name="checked_row_id[]" value="KEL">
                                </td>
                                <td>
                                    <a class="edit-control"
                                        href="?user_action=update&amp;jenis_pekerjaan_id=KEL"><span
                                            class="fa fa-edit"></span></a>
                                </td>
                                <td>
                                    <a class="detail-control field-master"
                                        href="?user_action=detail&amp;jenis_pekerjaan_id=KEL"><span
                                            class="fa fa-folder"></span></a>
                                </td>
                                <td class="data-number">13</td>
                                <td data-col-name="jenis_pekerjaan_id">KEL</td>
                                <td data-col-name="nama">Pembangkit - Pekerjaan Elektrikal </td>
                                <td data-col-name="tipe_pondasi_id">Tidak</td>
                                <td data-col-name="kelas_tower_id">Tidak</td>
                                <td data-col-name="lokasi_proyek_id">Ya</td>
                                <td data-col-name="kegiatan">Ya</td>
                                <td data-col-name="sort_order" class="data-sort-order-column">0</td>
                                <td data-col-name="default_data">Tidak</td>
                                <td data-col-name="aktif">Tidak</td>
                            </tr>

                            <tr data-primary-key="KHS" data-sort-order="0" data-number="14">
                                <td class="data-sort data-sort-body data-sort-handler"></td>
                                <td class="data-selector" data-key="jenis_pekerjaan_id">
                                    <input type="checkbox" class="checkbox check-slave checkbox-jenis-pekerjaan-id"
                                        name="checked_row_id[]" value="KHS">
                                </td>
                                <td>
                                    <a class="edit-control"
                                        href="?user_action=update&amp;jenis_pekerjaan_id=KHS"><span
                                            class="fa fa-edit"></span></a>
                                </td>
                                <td>
                                    <a class="detail-control field-master"
                                        href="?user_action=detail&amp;jenis_pekerjaan_id=KHS"><span
                                            class="fa fa-folder"></span></a>
                                </td>
                                <td class="data-number">14</td>
                                <td data-col-name="jenis_pekerjaan_id">KHS</td>
                                <td data-col-name="nama">Pembangkit - Pekerjaan HSE</td>
                                <td data-col-name="tipe_pondasi_id">Tidak</td>
                                <td data-col-name="kelas_tower_id">Tidak</td>
                                <td data-col-name="lokasi_proyek_id">Ya</td>
                                <td data-col-name="kegiatan">Ya</td>
                                <td data-col-name="sort_order" class="data-sort-order-column">0</td>
                                <td data-col-name="default_data">Tidak</td>
                                <td data-col-name="aktif">Ya</td>
                            </tr>

                            <tr data-primary-key="KIC" data-sort-order="0" data-number="15">
                                <td class="data-sort data-sort-body data-sort-handler"></td>
                                <td class="data-selector" data-key="jenis_pekerjaan_id">
                                    <input type="checkbox" class="checkbox check-slave checkbox-jenis-pekerjaan-id"
                                        name="checked_row_id[]" value="KIC">
                                </td>
                                <td>
                                    <a class="edit-control"
                                        href="?user_action=update&amp;jenis_pekerjaan_id=KIC"><span
                                            class="fa fa-edit"></span></a>
                                </td>
                                <td>
                                    <a class="detail-control field-master"
                                        href="?user_action=detail&amp;jenis_pekerjaan_id=KIC"><span
                                            class="fa fa-folder"></span></a>
                                </td>
                                <td class="data-number">15</td>
                                <td data-col-name="jenis_pekerjaan_id">KIC</td>
                                <td data-col-name="nama">Pembangkit - Pekerjaan Instrumen dan Kontrol </td>
                                <td data-col-name="tipe_pondasi_id">Tidak</td>
                                <td data-col-name="kelas_tower_id">Tidak</td>
                                <td data-col-name="lokasi_proyek_id">Ya</td>
                                <td data-col-name="kegiatan">Ya</td>
                                <td data-col-name="sort_order" class="data-sort-order-column">0</td>
                                <td data-col-name="default_data">Tidak</td>
                                <td data-col-name="aktif">Ya</td>
                            </tr>

                            <tr data-primary-key="KME" data-sort-order="0" data-number="16">
                                <td class="data-sort data-sort-body data-sort-handler"></td>
                                <td class="data-selector" data-key="jenis_pekerjaan_id">
                                    <input type="checkbox" class="checkbox check-slave checkbox-jenis-pekerjaan-id"
                                        name="checked_row_id[]" value="KME">
                                </td>
                                <td>
                                    <a class="edit-control"
                                        href="?user_action=update&amp;jenis_pekerjaan_id=KME"><span
                                            class="fa fa-edit"></span></a>
                                </td>
                                <td>
                                    <a class="detail-control field-master"
                                        href="?user_action=detail&amp;jenis_pekerjaan_id=KME"><span
                                            class="fa fa-folder"></span></a>
                                </td>
                                <td class="data-number">16</td>
                                <td data-col-name="jenis_pekerjaan_id">KME</td>
                                <td data-col-name="nama">Pembangkit - Pekerjaan Mekanikal </td>
                                <td data-col-name="tipe_pondasi_id">Tidak</td>
                                <td data-col-name="kelas_tower_id">Tidak</td>
                                <td data-col-name="lokasi_proyek_id">Ya</td>
                                <td data-col-name="kegiatan">Ya</td>
                                <td data-col-name="sort_order" class="data-sort-order-column">0</td>
                                <td data-col-name="default_data">Tidak</td>
                                <td data-col-name="aktif">Tidak</td>
                            </tr>

                            <tr data-primary-key="KSI" data-sort-order="0" data-number="17">
                                <td class="data-sort data-sort-body data-sort-handler"></td>
                                <td class="data-selector" data-key="jenis_pekerjaan_id">
                                    <input type="checkbox" class="checkbox check-slave checkbox-jenis-pekerjaan-id"
                                        name="checked_row_id[]" value="KSI">
                                </td>
                                <td>
                                    <a class="edit-control"
                                        href="?user_action=update&amp;jenis_pekerjaan_id=KSI"><span
                                            class="fa fa-edit"></span></a>
                                </td>
                                <td>
                                    <a class="detail-control field-master"
                                        href="?user_action=detail&amp;jenis_pekerjaan_id=KSI"><span
                                            class="fa fa-folder"></span></a>
                                </td>
                                <td class="data-number">17</td>
                                <td data-col-name="jenis_pekerjaan_id">KSI</td>
                                <td data-col-name="nama">Pembangkit - Pekerjaan Sipil </td>
                                <td data-col-name="tipe_pondasi_id">Tidak</td>
                                <td data-col-name="kelas_tower_id">Tidak</td>
                                <td data-col-name="lokasi_proyek_id">Ya</td>
                                <td data-col-name="kegiatan">Ya</td>
                                <td data-col-name="sort_order" class="data-sort-order-column">0</td>
                                <td data-col-name="default_data">Tidak</td>
                                <td data-col-name="aktif">Tidak</td>
                            </tr>

                            <tr data-primary-key="901" data-sort-order="0" data-number="18">
                                <td class="data-sort data-sort-body data-sort-handler"></td>
                                <td class="data-selector" data-key="jenis_pekerjaan_id">
                                    <input type="checkbox" class="checkbox check-slave checkbox-jenis-pekerjaan-id"
                                        name="checked_row_id[]" value="901">
                                </td>
                                <td>
                                    <a class="edit-control"
                                        href="?user_action=update&amp;jenis_pekerjaan_id=901"><span
                                            class="fa fa-edit"></span></a>
                                </td>
                                <td>
                                    <a class="detail-control field-master"
                                        href="?user_action=detail&amp;jenis_pekerjaan_id=901"><span
                                            class="fa fa-folder"></span></a>
                                </td>
                                <td class="data-number">18</td>
                                <td data-col-name="jenis_pekerjaan_id">901</td>
                                <td data-col-name="nama">Pengecekan tower terpusat</td>
                                <td data-col-name="tipe_pondasi_id">Tidak</td>
                                <td data-col-name="kelas_tower_id">Tidak</td>
                                <td data-col-name="lokasi_proyek_id">Tidak</td>
                                <td data-col-name="kegiatan">Tidak</td>
                                <td data-col-name="sort_order" class="data-sort-order-column">0</td>
                                <td data-col-name="default_data">Tidak</td>
                                <td data-col-name="aktif">Ya</td>
                            </tr>

                            <tr data-primary-key="RAP" data-sort-order="0" data-number="19">
                                <td class="data-sort data-sort-body data-sort-handler"></td>
                                <td class="data-selector" data-key="jenis_pekerjaan_id">
                                    <input type="checkbox" class="checkbox check-slave checkbox-jenis-pekerjaan-id"
                                        name="checked_row_id[]" value="RAP">
                                </td>
                                <td>
                                    <a class="edit-control"
                                        href="?user_action=update&amp;jenis_pekerjaan_id=RAP"><span
                                            class="fa fa-edit"></span></a>
                                </td>
                                <td>
                                    <a class="detail-control field-master"
                                        href="?user_action=detail&amp;jenis_pekerjaan_id=RAP"><span
                                            class="fa fa-folder"></span></a>
                                </td>
                                <td class="data-number">19</td>
                                <td data-col-name="jenis_pekerjaan_id">RAP</td>
                                <td data-col-name="nama">Rapat Koordinasi</td>
                                <td data-col-name="tipe_pondasi_id">Tidak</td>
                                <td data-col-name="kelas_tower_id">Tidak</td>
                                <td data-col-name="lokasi_proyek_id">Tidak</td>
                                <td data-col-name="kegiatan">Ya</td>
                                <td data-col-name="sort_order" class="data-sort-order-column">0</td>
                                <td data-col-name="default_data">Tidak</td>
                                <td data-col-name="aktif">Ya</td>
                            </tr>

                            <tr data-primary-key="SPL" data-sort-order="0" data-number="20">
                                <td class="data-sort data-sort-body data-sort-handler"></td>
                                <td class="data-selector" data-key="jenis_pekerjaan_id">
                                    <input type="checkbox" class="checkbox check-slave checkbox-jenis-pekerjaan-id"
                                        name="checked_row_id[]" value="SPL">
                                </td>
                                <td>
                                    <a class="edit-control"
                                        href="?user_action=update&amp;jenis_pekerjaan_id=SPL"><span
                                            class="fa fa-edit"></span></a>
                                </td>
                                <td>
                                    <a class="detail-control field-master"
                                        href="?user_action=detail&amp;jenis_pekerjaan_id=SPL"><span
                                            class="fa fa-folder"></span></a>
                                </td>
                                <td class="data-number">20</td>
                                <td data-col-name="jenis_pekerjaan_id">SPL</td>
                                <td data-col-name="nama">SIPIL</td>
                                <td data-col-name="tipe_pondasi_id">Tidak</td>
                                <td data-col-name="kelas_tower_id">Tidak</td>
                                <td data-col-name="lokasi_proyek_id">Ya</td>
                                <td data-col-name="kegiatan">Ya</td>
                                <td data-col-name="sort_order" class="data-sort-order-column">0</td>
                                <td data-col-name="default_data">Tidak</td>
                                <td data-col-name="aktif">Tidak</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div class="button-wrapper">
                    <div class="button-area">
                        <button type="submit" class="btn btn-success" name="user_action"
                            value="activate">Aktifkan</button>
                        <button type="submit" class="btn btn-warning" name="user_action"
                            value="deactivate">Nonaktifkan</button>
                        <button type="submit" class="btn btn-danger" name="user_action" value="delete"
                            data-onclik-message="Apakah Anda yakin akan menghapus data ini?">Hapus</button>
                        <button type="submit" class="btn btn-primary" name="user_action" value="sort_order"
                            disabled="disabled">Simpan Urutan</button>
                    </div>
                </div>
            </form>
            <div class="pagination pagination-bottom">
                <div class="pagination-number">
                    <span class="page-selector page-selector-number page-first page-selected" data-page-number="1"><a
                            href="?ordertype=asc&amp;orderby=nama&amp;page=1">1</a></span><span
                        class="page-selector page-selector-number page-last" data-page-number="2"><a
                            href="?ordertype=asc&amp;orderby=nama&amp;page=2">2</a></span><span
                        class="page-selector page-selector-step-one" data-page-number="2"><a
                            href="?ordertype=asc&amp;orderby=nama&amp;page=2"><i
                                class="fa-solid fa-angle-right"></i></a></span>
                </div>
            </div>


        </div>

    </div>

    <!-- Importing JavaScript for Bootstrap and jQuery -->
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>

        // Notification data from the server in JSON format
        const notifications = {
            "totalData": 129,
            "data": [
            { "id": 1, "link": "notifications.html?any=1", "message": "Notification 1", "time": "5 min" },
            { "id": 2, "link": "notifications.html?any=2", "message": "Notification 2", "time": "100 day" }
        ]}
        ;

        // Message data from the server in JSON format
        const messages = {
            "totalData": 88,
            "data": [
            { "id": 1, "link": "messages.html?any=1", "message": "Message 1", "time": "1 min" },
            { "id": 2, "link": "messages.html?any=2", "message": "Message 2", "time": "3 min" }
        ]};

    </script>
</body>

</html>