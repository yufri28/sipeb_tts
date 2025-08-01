<footer class="footer">
    <div class="container-fluid d-flex justify-content-between">
        <nav class="pull-left">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="http://www.themekita.com">
                        ThemeKita
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"> Help </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"> Licenses </a>
                </li>
            </ul>
        </nav>
        <div class="copyright">
            2024, made with <i class="fa fa-heart heart text-danger"></i> by
            <a href="http://www.themekita.com">ThemeKita</a>
        </div>
        <div>
            Distributed by
            <a target="_blank" href="https://themewagon.com/">ThemeWagon</a>.
        </div>
    </div>
</footer>
</div>

<!-- Custom template | don't include it in your project! -->
<div class="custom-template">
    <div class="title">Settings</div>
    <div class="custom-content">
        <div class="switcher">
            <div class="switch-block">
                <h4>Navbar Header</h4>
                <div class="btnSwitch">
                    <button type="button" class="changeTopBarColor" data-color="dark"></button>
                    <button type="button" class="changeTopBarColor" data-color="blue"></button>
                    <button type="button" class="changeTopBarColor" data-color="purple"></button>
                    <button type="button" class="changeTopBarColor" data-color="light-blue"></button>
                    <button type="button" class="changeTopBarColor" data-color="green"></button>
                    <button type="button" class="changeTopBarColor" data-color="orange"></button>
                    <button type="button" class="changeTopBarColor" data-color="red"></button>
                    <button type="button" class="selected changeTopBarColor" data-color="white"></button>
                    <br />
                    <button type="button" class="changeTopBarColor" data-color="dark2"></button>
                    <button type="button" class="changeTopBarColor" data-color="blue2"></button>
                    <button type="button" class="changeTopBarColor" data-color="purple2"></button>
                    <button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
                    <button type="button" class="changeTopBarColor" data-color="green2"></button>
                    <button type="button" class="changeTopBarColor" data-color="orange2"></button>
                    <button type="button" class="changeTopBarColor" data-color="red2"></button>
                </div>
            </div>
            <div class="switch-block">
                <h4>Sidebar</h4>
                <div class="btnSwitch">
                    <button type="button" class="changeSideBarColor" data-color="white"></button>
                    <button type="button" class="selected changeSideBarColor" data-color="dark"></button>
                    <button type="button" class="changeSideBarColor" data-color="dark2"></button>
                </div>
            </div>
        </div>
    </div>
    <div class="custom-toggle">
        <i class="icon-settings"></i>
    </div>
</div>
<!-- End Custom template -->
</div>
<!--   Core JS Files   -->
<script src="<?=base_url("assets/js/core/jquery-3.7.1.min.js");?>"></script>
<script src="<?=base_url("assets/js/core/popper.min.js");?>"></script>
<script src="<?=base_url("assets/js/core/bootstrap.min.js");?>"></script>

<!-- jQuery Scrollbar -->
<script src="<?=base_url("assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js");?>"></script>

<!-- Chart JS -->
<script src="<?=base_url("assets/js/plugin/chart.js/chart.min.js");?>"></script>

<!-- jQuery Sparkline -->
<script src="<?=base_url("assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js");?>"></script>

<!-- Chart Circle -->
<script src="<?=base_url("assets/js/plugin/chart-circle/circles.min.js");?>"></script>

<!-- Datatables -->
<script src="<?=base_url("assets/js/plugin/datatables/datatables.min.js");?>"></script>

<!-- Bootstrap Notify -->
<script src="<?=base_url("assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js");?>"></script>

<!-- jQuery Vector Maps -->
<script src="<?=base_url("assets/js/plugin/jsvectormap/jsvectormap.min.js");?>"></script>
<script src="<?=base_url("assets/js/plugin/jsvectormap/world.js");?>"></script>

<!-- Sweet Alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Kaiadmin JS -->
<script src="<?=base_url("assets/js/kaiadmin.min.js");?>"></script>

<!-- Kaiadmin DEMO methods, don't include it in your project! -->
<script src="<?=base_url("assets/js/setting-demo.js");?>"></script>
<!-- <script src="<?=base_url("assets/js/demo.js");?>"></script> -->
<!-- Tambahkan Dashboard-js ke posisi ini -->


<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Alerts -->
<!-- begin::Alert -->
<?php if ($this->session->flashdata('success')): ?>
<script>
var successfuly = '<?= $this->session->flashdata('success'); ?>';
Swal.fire({
    title: 'Sukses!',
    text: successfuly,
    icon: 'success',
    confirmButtonText: 'OK'
}).then(function(result) {
    if (result.isConfirmed) {
        // window.location.href = '';
        window.location.reload();

    }
});
</script>
<?php $this->session->unset_userdata('success'); // Menghapus session setelah ditampilkan ?>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
<script>
Swal.fire({
    title: 'Error!',
    text: '<?= $this->session->flashdata('error'); ?>',
    icon: 'error',
    confirmButtonText: 'OK'
}).then(function(result) {
    if (result.isConfirmed) {
        // window.location.href = '';
        window.location.reload();
    }
});
</script>
<?php $this->session->unset_userdata('error'); // Menghapus session setelah ditampilkan ?>
<?php endif; ?>
<!-- end::Alert -->

<script>
$(document).ready(function() {
    $("#multi-filter-select").DataTable({
        pageLength: 5,
        scrollX: true,
        screenY: true,
        dom: 'Bfrtip', // Tambahkan tombol di atas tabel
        buttons: [{
                extend: 'excelHtml5',
                className: 'btn btn-sm btn-success',
                text: '<i class="fa fa-file-excel"></i> Export to Excel',
                title: 'Stok Barang - Sistem Informasi Pendataan Barang - BPBD Kab TTS',
                exportOptions: {
                    columns: ':not(:last-child)'
                }
            },

        ],
        initComplete: function() {
            this.api()
                .columns()
                .every(function() {
                    var column = this;
                    var select = $(
                            '<select class="form-select"><option value=""></option></select>'
                        )
                        .appendTo($(column.footer()).empty())
                        .on("change", function() {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());

                            column
                                .search(val ? "^" + val + "$" : "", true, false)
                                .draw();
                        });

                    column
                        .data()
                        .unique()
                        .sort()
                        .each(function(d, j) {
                            select.append(
                                '<option value="' + d + '">' + d + "</option>"
                            );
                        });
                });
        },
    });
    $("#multi-filter-select-pem").DataTable({
        pageLength: 5,
        scrollX: true,
        screenY: true,
        dom: 'Bfrtip', // Tambahkan tombol di atas tabel
        buttons: [{
                extend: 'excelHtml5',
                className: 'btn btn-sm btn-success',
                text: '<i class="fa fa-file-excel"></i> Export to Excel',
                title: 'Peminjaman Barang - Sistem Informasi Pendataan Barang - BPBD Kab TTS',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                }
            },

        ],
        initComplete: function() {
            this.api()
                .columns()
                .every(function() {
                    var column = this;
                    var select = $(
                            '<select class="form-select"><option value=""></option></select>'
                        )
                        .appendTo($(column.footer()).empty())
                        .on("change", function() {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());

                            column
                                .search(val ? "^" + val + "$" : "", true, false)
                                .draw();
                        });

                    column
                        .data()
                        .unique()
                        .sort()
                        .each(function(d, j) {
                            select.append(
                                '<option value="' + d + '">' + d + "</option>"
                            );
                        });
                });
        },
    });
    $("#multi-filter-select-mas").DataTable({
        pageLength: 5,
        scrollX: true,
        screenY: true,
        dom: 'Bfrtip', // Tambahkan tombol di atas tabel
        buttons: [{
                extend: 'excelHtml5',
                className: 'btn btn-sm btn-success',
                text: '<i class="fa fa-file-excel"></i> Export to Excel',
                title: 'Barang Masuk - Sistem Informasi Pendataan Barang - BPBD Kab TTS',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 8]
                }
            },

        ],
        initComplete: function() {
            this.api()
                .columns()
                .every(function() {
                    var column = this;
                    var select = $(
                            '<select class="form-select"><option value=""></option></select>'
                        )
                        .appendTo($(column.footer()).empty())
                        .on("change", function() {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());

                            column
                                .search(val ? "^" + val + "$" : "", true, false)
                                .draw();
                        });

                    column
                        .data()
                        .unique()
                        .sort()
                        .each(function(d, j) {
                            select.append(
                                '<option value="' + d + '">' + d + "</option>"
                            );
                        });
                });
        },
    });
    $("#multi-filter-select-kel").DataTable({
        pageLength: 5,
        scrollX: true,
        screenY: true,
        dom: 'Bfrtip', // Tambahkan tombol di atas tabel
        buttons: [{
                extend: 'excelHtml5',
                className: 'btn btn-sm btn-success',
                text: '<i class="fa fa-file-excel"></i> Export to Excel',
                title: 'Barang Keluar - Sistem Informasi Pendataan Barang - BPBD Kab TTS',
                exportOptions: {
                    columns: ':not(:last-child)'
                }
            },

        ],
        initComplete: function() {
            this.api()
                .columns()
                .every(function() {
                    var column = this;
                    var select = $(
                            '<select class="form-select"><option value=""></option></select>'
                        )
                        .appendTo($(column.footer()).empty())
                        .on("change", function() {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());

                            column
                                .search(val ? "^" + val + "$" : "", true, false)
                                .draw();
                        });

                    column
                        .data()
                        .unique()
                        .sort()
                        .each(function(d, j) {
                            select.append(
                                '<option value="' + d + '">' + d + "</option>"
                            );
                        });
                });
        },
    });

    $("#multi-filter-select2").DataTable({
        pageLength: 5,
        scrollX: true,
        screenY: true,
        initComplete: function() {
            this.api()
                .columns()
                .every(function() {
                    var column = this;
                    var select = $(
                            '<select class="form-select"><option value=""></option></select>'
                        )
                        .appendTo($(column.footer()).empty())
                        .on("change", function() {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());

                            column
                                .search(val ? "^" + val + "$" : "", true, false)
                                .draw();
                        });

                    column
                        .data()
                        .unique()
                        .sort()
                        .each(function(d, j) {
                            select.append(
                                '<option value="' + d + '">' + d + "</option>"
                            );
                        });
                });
        },
    });

    $("#no-filter-select").DataTable({
        pageLength: 5,
        scrollX: true,
        screenY: true,
    });

    // Initialize the Barang Masuk table
    var barangMasukTable = $("#barangMasuk").DataTable({
        pageLength: 5,
    });

    // Initialize the Barang Keluar table
    var barangKeluarTable = $("#barangKeluar").DataTable({
        pageLength: 5,
    });

    $("#tb-master-barang").DataTable({
        pageLength: 5,
        scrollX: true,
        screenY: true,
        initComplete: function() {
            this.api()
                .columns()
                .every(function() {
                    var column = this;
                    var select = $(
                            '<select class="form-select"><option value=""></option></select>'
                        )
                        .appendTo($(column.footer()).empty())
                        .on("change", function() {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());

                            column
                                .search(val ? "^" + val + "$" : "", true, false)
                                .draw();
                        });

                    column
                        .data()
                        .unique()
                        .sort()
                        .each(function(d, j) {
                            select.append(
                                '<option value="' + d + '">' + d + "</option>"
                            );
                        });
                });
        },
    });

    $("#tb-master-jenis-barang").DataTable({
        pageLength: 5,
        scrollX: true,
        screenY: true,
        initComplete: function() {
            this.api()
                .columns()
                .every(function() {
                    var column = this;
                    var select = $(
                            '<select class="form-select"><option value=""></option></select>'
                        )
                        .appendTo($(column.footer()).empty())
                        .on("change", function() {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());

                            column
                                .search(val ? "^" + val + "$" : "", true, false)
                                .draw();
                        });

                    column
                        .data()
                        .unique()
                        .sort()
                        .each(function(d, j) {
                            select.append(
                                '<option value="' + d + '">' + d + "</option>"
                            );
                        });
                });
        },
    });
    $("#tb-master-kondisi").DataTable({
        pageLength: 5,
        scrollX: true,
        screenY: true,
        initComplete: function() {
            this.api()
                .columns()
                .every(function() {
                    var column = this;
                    var select = $(
                            '<select class="form-select"><option value=""></option></select>'
                        )
                        .appendTo($(column.footer()).empty())
                        .on("change", function() {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());

                            column
                                .search(val ? "^" + val + "$" : "", true, false)
                                .draw();
                        });

                    column
                        .data()
                        .unique()
                        .sort()
                        .each(function(d, j) {
                            select.append(
                                '<option value="' + d + '">' + d + "</option>"
                            );
                        });
                });
        },
    });

    $("#tb-master-klasifikasi").DataTable({
        pageLength: 5,
        scrollX: true,
        screenY: true,
        initComplete: function() {
            this.api()
                .columns()
                .every(function() {
                    var column = this;
                    var select = $(
                            '<select class="form-select"><option value=""></option></select>'
                        )
                        .appendTo($(column.footer()).empty())
                        .on("change", function() {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());

                            column
                                .search(val ? "^" + val + "$" : "", true, false)
                                .draw();
                        });

                    column
                        .data()
                        .unique()
                        .sort()
                        .each(function(d, j) {
                            select.append(
                                '<option value="' + d + '">' + d + "</option>"
                            );
                        });
                });
        },
    });

    $("#tb-master-sumber").DataTable({
        pageLength: 5,
        scrollX: true,
        screenY: true,
        initComplete: function() {
            this.api()
                .columns()
                .every(function() {
                    var column = this;
                    var select = $(
                            '<select class="form-select"><option value=""></option></select>'
                        )
                        .appendTo($(column.footer()).empty())
                        .on("change", function() {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());

                            column
                                .search(val ? "^" + val + "$" : "", true, false)
                                .draw();
                        });

                    column
                        .data()
                        .unique()
                        .sort()
                        .each(function(d, j) {
                            select.append(
                                '<option value="' + d + '">' + d + "</option>"
                            );
                        });
                });
        },
    });

    $("#tb-master-satuan").DataTable({
        pageLength: 5,
        scrollX: true,
        screenY: true,
        initComplete: function() {
            this.api()
                .columns()
                .every(function() {
                    var column = this;
                    var select = $(
                            '<select class="form-select"><option value=""></option></select>'
                        )
                        .appendTo($(column.footer()).empty())
                        .on("change", function() {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());

                            column
                                .search(val ? "^" + val + "$" : "", true, false)
                                .draw();
                        });

                    column
                        .data()
                        .unique()
                        .sort()
                        .each(function(d, j) {
                            select.append(
                                '<option value="' + d + '">' + d + "</option>"
                            );
                        });
                });
        },
    });

    $("#tb-master-jenis-bencana").DataTable({
        pageLength: 5,
        scrollX: true,
        screenY: true,
        initComplete: function() {
            this.api()
                .columns()
                .every(function() {
                    var column = this;
                    var select = $(
                            '<select class="form-select"><option value=""></option></select>'
                        )
                        .appendTo($(column.footer()).empty())
                        .on("change", function() {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());

                            column
                                .search(val ? "^" + val + "$" : "", true, false)
                                .draw();
                        });

                    column
                        .data()
                        .unique()
                        .sort()
                        .each(function(d, j) {
                            select.append(
                                '<option value="' + d + '">' + d + "</option>"
                            );
                        });
                });
        },
    });

    // Add Row
    $("#add-row").DataTable({
        pageLength: 5,
    });

    // var action =
    //     '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

    // $("#addRowButton").click(function() {
    //     $("#add-row")
    //         .dataTable()
    //         .fnAddData([
    //             $("#addName").val(),
    //             $("#addPosition").val(),
    //             $("#addOffice").val(),
    //             action,
    //         ]);
    //     $("#addRowModal").modal("hide");
    // });
});
</script>

</body>

</html>