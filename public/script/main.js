// Package

// Data TAble
$(document).ready(function () {
    var table = $("#myTable").DataTable({
        responsive: true,
        columnDefs: [
            {
                targets: "_all",
                className: "text-center",
            },
        ],
    });
});
$("#driverAdminDashboard").DataTable({
    paging: false,
    ordering: false,
    info: false,
    searching: false,
    scrollY: "300px", // Ganti dengan tinggi yang sesuai
    scrollCollapse: true,
    autoWidth: false,
});
$("#unitAdminDashboard").DataTable({
    paging: false,
    ordering: false,
    info: false,
    searching: false,
    scrollY: "300px", // Ganti dengan tinggi yang sesuai
    scrollCollapse: true,
    autoWidth: false,
});
$("#bengkelAdminDashboard").DataTable({
    paging: false,
    ordering: false,
    info: false,
    searching: false,
    scrollY: "300px", // Ganti dengan tinggi yang sesuai
    scrollCollapse: true,
    autoWidth: false,
});
$("#perbaikanAdminDashboard").DataTable({
    paging: false,
    ordering: false,
    info: false,
    searching: false,
    scrollY: "300px",
    scrollCollapse: true,
    autoWidth: false,
});
$("#reportAdminDashboard").DataTable({
    paging: false,
    ordering: false,
    info: false,
    searching: false,
    scrollY: "700px", // Ganti dengan tinggi yang sesuai
    scrollCollapse: true,
    autoWidth: false,
});

// Sub Menu SIdebar Admin
let subMenuSidebarAdmin = document.getElementById("profileAdmin");
function openMenuSidebarAdmin() {
    subMenuSidebarAdmin.classList.toggle("open-menu");
}

// Mengambil Id yang ada di halaman Input User lalu menampilkan nama sesuai dengan id yang di pilih
$(document).ready(function () {
    let nama_driver = document.getElementById("nama_driver");
    // Mendengarkan perubahan pada elemen select dengan id_driver
    $("#id_driver").change(function () {
        // Mendapatkan nilai id_driver yang dipilih
        var selectedIdDriver = $(this).val();

        // Mendapatkan nilai nama_driver yang sesuai dengan id_driver yang dipilih
        var selectedNamaDriver = $(this)
            .find("option:selected")
            .data("nama-driver");

        // Memasukkan nilai nama_driver ke input dengan id nama_driver
        nama_driver.value = selectedNamaDriver;
    });
});
// Mengambil Id yang ada di halaman Input Admin lalu menampilkan nama sesuai dengan id yang di pilih
$(document).ready(function () {
    let nama_admin = document.getElementById("nama_admin");
    // Mendengarkan perubahan pada elemen select dengan id_admin
    $("#id_admin").change(function () {
        // Mendapatkan nilai id_admin yang dipilih
        var selectedIdAdmin = $(this).val();

        // Mendapatkan nilai nama_driver yang sesuai dengan id_driver yang dipilih
        var selectedNamaAdmin = $(this)
            .find("option:selected")
            .data("nama-admin");

        // Memasukkan nilai nama_driver ke input dengan id nama_driver
        nama_admin.value = selectedNamaAdmin;
    });
});

// AJAx
// filter Report  SUPER ADMIN
$(document).ready(function () {
    let table;

    $("#tombol-filter").click(function (e) {
        e.preventDefault();

        const tanggalAwal = $("#tanggal_awal").val();
        const tanggalAkhir = $("#tanggal_akhir").val();

        filterReport(
            tanggalAwal,
            tanggalAkhir,
            filter,
            "/super-admin/filter-report-super/"
        );

        function filter(response) {
            if (table) {
                table.destroy();
            }

            table = $("#myTable").DataTable({
                destroy: true,
                processing: true,
                serverSide: false,
                responsive: true,
                createdRow: function (row, data, dataIndex) {
                    // Menggunakan jQuery untuk mengubah atribut style textAlign pada setiap sel (td) ke 'center'
                    $("td", row).css("text-align", "center");
                },
                data: response,
                columns: [
                    {
                        data: null,
                        render: function (data, type, row, meta) {
                            return meta.row + 1;
                        },
                        width: "10px",
                    },
                    {
                        data: "id_driver",
                        width: "10px",
                    },
                    {
                        data: "nama_driver",
                        width: "200px",
                    },
                    {
                        data: "shift",
                        width: "50px",
                    },
                    {
                        data: "no_polisi",
                        width: "150px",
                    },
                    {
                        data: null,
                        render: function (data) {
                            const merkMobil = data.unit
                                ? data.unit.merk_mobil
                                : "";
                            const modelMobil = data.unit
                                ? data.unit.model_mobil
                                : "";
                            return merkMobil + " " + modelMobil;
                        },
                        width: "120px",
                    },
                    {
                        data: "tanggal_input",
                        width: "200px",
                    },
                    {
                        data: null,
                        render: function (data) {
                            const buttons =
                                '<div class="text-center">' +
                                '<a href="/super-admin/detailReport/' +
                                data.id +
                                '">' +
                                '<button type="button" class="btn btn-warning" style="margin-right: 10px; width: 100px">Detail</button>' +
                                "</a>" +
                                '<a href="/super-admin/inputPerbaikan/' +
                                data.id +
                                '">' +
                                '<button type="button" class="btn btn-info" style="margin-right: 10px; width: 130px">Input Perbaikan</button>' +
                                "</a>" +
                                '<a href="#">' +
                                '<button type="button" class="btn btn-success" style="margin-right: 10px; width: 100px">Cetak</button>' +
                                "</a>" +
                                '<a href="/super-admin/deleteReportSuper/' +
                                data.id +
                                '">' +
                                '<button type="button" class="btn btn-danger" style="margin-right: 10px; width: 100px">Delete</button>' +
                                "</a>" +
                                "</div>";
                            return buttons;
                        },
                    },
                ],
                order: [[0, "asc"]],
                columnDefs: [
                    { targets: [4], orderable: false },
                    { targets: [4], searchable: false },
                ],
            });
        }

        $("#tanggal_awal").val("");
        $("#tanggal_akhir").val("");
    });
});
// filter Perbaikan SUPER ADMIN
$(document).ready(function () {
    let table;

    $("#tombol-filter-perbaikan").click(function (e) {
        e.preventDefault();

        const tanggalAwal = $("#tanggal_awal").val();
        const tanggalAkhir = $("#tanggal_akhir").val();

        filterPerbaikan(
            tanggalAwal,
            tanggalAkhir,
            filter,
            "/super-admin/filter-perbaikan-super/"
        );

        function filter(response) {
            if (table) {
                table.destroy();
            }
            table = $("#myTable").DataTable({
                destroy: true,
                processing: true,
                serverSide: false,
                responsive: true,
                createdRow: function (row, data, dataIndex) {
                    // Menggunakan jQuery untuk mengubah atribut style textAlign pada setiap sel (td) ke 'center'
                    $("td", row).css("text-align", "center");
                },
                data: response,
                columns: [
                    {
                        data: null,
                        render: function (data, type, row, meta) {
                            return meta.row + 1;
                        },
                        width: "10px",
                    },
                    {
                        data: "status",
                        width: "40px",
                    },
                    {
                        data: "id_report",
                        width: "10px",
                    },
                    {
                        data: "no_polisi",
                        width: "150px",
                    },
                    {
                        data: "mitra_bengkel",
                        width: "200px",
                    },
                    {
                        data: "tanggal_perbaikan",
                        width: "200px",
                    },
                    {
                        data: "tanggal_selesai",
                        width: "200px",
                    },
                    {
                        data: "jumlah_pembayaran",
                        width: "50px",
                    },
                    {
                        data: null,
                        render: function (data, type, row, meta) {
                            const notaLink =
                                '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal' +
                                meta.row +
                                '" >Nota</button>';
                            return notaLink;
                        },
                    },
                    {
                        data: null,
                        render: function (perbaikan) {
                            const buttons =
                                '<a href="">' +
                                '<button type="button" class="btn btn-info " style="margin-right: 10px; width: 100px">Detail</button>' +
                                "</a>" +
                                '<a href="/super-admin/updatePerbaikan/' +
                                perbaikan.id +
                                '">' +
                                '<button type="button" class="btn btn-secondary" style="margin-right: 10px; width: 100px">Update</button>' +
                                "</a>" +
                                '<a href="#">' +
                                '<button type="button" class="btn btn-success" style="margin-right: 10px; width: 100px">Cetak</button>' +
                                "</a>" +
                                '<a href="/super-admin/deletePerbaikanSuper/' +
                                perbaikan.id +
                                '">' +
                                '<button type="button" class="btn btn-danger" style="margin-right: 10px; width: 100px">Delete</button>' +
                                "</a>";
                            return buttons;
                        },
                    },
                ],
                order: [[0, "asc"]],
                columnDefs: [
                    { targets: [4], orderable: false },
                    { targets: [4], searchable: false },
                ],
            });
        }

        $("#tanggal_awal").val("");
        $("#tanggal_akhir").val("");
    });
});
$(document).ready(function () {
    let table;

    $("#tombol-filter-perbaikan-selesai").click(function (e) {
        e.preventDefault();

        const tanggalAwal = $("#tanggal_awal_selesai").val();
        const tanggalAkhir = $("#tanggal_akhir_selesai").val();

        filterPerbaikanSelesai(
            tanggalAwal,
            tanggalAkhir,
            filter,
            "/super-admin/filter-perbaikan-selesai-super/"
        );

        function filter(response) {
            if (table) {
                table.destroy();
            }
            table = $("#myTable").DataTable({
                destroy: true,
                processing: true,
                serverSide: false,
                responsive: true,
                createdRow: function (row, data, dataIndex) {
                    // Menggunakan jQuery untuk mengubah atribut style textAlign pada setiap sel (td) ke 'center'
                    $("td", row).css("text-align", "center");
                },
                data: response,
                columns: [
                    {
                        data: null,
                        render: function (data, type, row, meta) {
                            return meta.row + 1;
                        },
                        width: "10px",
                    },
                    {
                        data: "status",
                        width: "40px",
                    },
                    {
                        data: "id_report",
                        width: "10px",
                    },
                    {
                        data: "no_polisi",
                        width: "150px",
                    },
                    {
                        data: "mitra_bengkel",
                        width: "200px",
                    },
                    {
                        data: "tanggal_perbaikan",
                        width: "200px",
                    },
                    {
                        data: "tanggal_selesai",
                        width: "200px",
                    },
                    {
                        data: "jumlah_pembayaran",
                        width: "50px",
                    },
                    {
                        data: null,
                        data: null,
                        render: function (data, type, row, meta) {
                            const notaLink =
                                '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal' +
                                meta.row +
                                '" >Nota</button>';
                            return notaLink;
                        },
                    },
                    {
                        data: null,
                        render: function (perbaikan) {
                            const buttons =
                                '<a href="">' +
                                '<button type="button" class="btn btn-info " style="margin-right: 10px; width: 100px">Detail</button>' +
                                "</a>" +
                                '<a href="/super-admin/updatePerbaikan/' +
                                perbaikan.id +
                                '">' +
                                '<button type="button" class="btn btn-warning" style="margin-right: 10px; width: 100px">Detail</button>' +
                                "</a>" +
                                '<a href="#">' +
                                '<button type="button" class="btn btn-success" style="margin-right: 10px; width: 100px">Cetak</button>' +
                                "</a>" +
                                '<a href="/super-admin/deletePerbaikanSuper/' +
                                perbaikan.id +
                                '">' +
                                '<button type="button" class="btn btn-danger" style="margin-right: 10px; width: 100px">Delete</button>' +
                                "</a>";
                            return buttons;
                        },
                    },
                ],
                order: [[0, "asc"]],
                columnDefs: [
                    { targets: [4], orderable: false },
                    { targets: [4], searchable: false },
                ],
            });
        }

        $("#tanggal_awal_selesai").val("");
        $("#tanggal_akhir_selesai").val("");
    });
});

// filter Report ADMIN
$(document).ready(function () {
    let table;

    $("#tombol-filter-report").click(function (e) {
        e.preventDefault();

        const tanggalAwal = $("#tanggal_awal").val();
        const tanggalAkhir = $("#tanggal_akhir").val();

        filterReport(
            tanggalAwal,
            tanggalAkhir,
            filter,
            "/admin/filter-report-admins"
        );

        function filter(response) {
            if (table) {
                table.destroy();
            }

            table = $("#myTable").DataTable({
                destroy: true,
                processing: true,
                serverSide: false,
                responsive: true,
                createdRow: function (row, data, dataIndex) {
                    // Menggunakan jQuery untuk mengubah atribut style textAlign pada setiap sel (td) ke 'center'
                    $("td", row).css("text-align", "center");
                },
                data: response,
                columns: [
                    {
                        data: null,
                        render: function (data, type, row, meta) {
                            return meta.row + 1;
                        },
                        width: "10px",
                    },
                    {
                        data: "id_driver",
                        width: "10px",
                    },
                    {
                        data: "nama_driver",
                        width: "200px",
                    },
                    {
                        data: "shift",
                        width: "50px",
                    },
                    {
                        data: "no_polisi",
                        width: "150px",
                    },
                    {
                        data: null,
                        render: function (data) {
                            const merkMobil = data.unit
                                ? data.unit.merk_mobil
                                : "";
                            const modelMobil = data.unit
                                ? data.unit.model_mobil
                                : "";
                            return merkMobil + " " + modelMobil;
                        },
                        width: "120px",
                    },
                    {
                        data: "tanggal_input",
                        width: "200px",
                    },
                    {
                        data: null,
                        render: function (data) {
                            const buttons =
                                '<a href="/admin/detailReport/' +
                                data.id +
                                '">' +
                                '<button type="button" class="btn btn-warning" style="margin-right: 10px; width: 100px">Detail</button>' +
                                "</a>" +
                                '<a href="#">' +
                                '<button type="button" class="btn btn-success" style="margin-right: 10px; width: 130px">Cetak Laporan</button>' +
                                "</a>";
                            return buttons;
                        },
                    },
                ],
                order: [[0, "asc"]],
                columnDefs: [
                    { targets: [4], orderable: false },
                    { targets: [4], searchable: false },
                ],
            });
        }

        $("#tanggal_awal").val("");
        $("#tanggal_akhir").val("");
    });
});
// filter Perbaikan ADMIN
$(document).ready(function () {
    let table;

    $("#tombol-filter-perbaikan-admin").click(function (e) {
        e.preventDefault();

        const tanggalAwal = $("#tanggal_awal").val();
        const tanggalAkhir = $("#tanggal_akhir").val();

        filterPerbaikan(
            tanggalAwal,
            tanggalAkhir,
            filter,
            "/admin/filter-report-perbaikan-admin/"
        );

        function filter(response) {
            if (table) {
                table.destroy();
            }
            table = $("#myTable").DataTable({
                destroy: true,
                processing: true,
                serverSide: false,
                responsive: true,
                createdRow: function (row, data, dataIndex) {
                    // Menggunakan jQuery untuk mengubah atribut style textAlign pada setiap sel (td) ke 'center'
                    $("td", row).css("text-align", "center");
                },
                data: response,
                columns: [
                    {
                        data: null,
                        render: function (data, type, row, meta) {
                            return meta.row + 1;
                        },
                        width: "10px",
                    },
                    {
                        data: "status",
                        width: "40px",
                    },
                    {
                        data: "id_report",
                        width: "10px",
                    },
                    {
                        data: "no_polisi",
                        width: "150px",
                    },
                    {
                        data: "mitra_bengkel",
                        width: "200px",
                    },
                    {
                        data: "tanggal_perbaikan",
                        width: "200px",
                    },
                    {
                        data: "tanggal_selesai",
                        width: "200px",
                    },
                    {
                        data: "jumlah_pembayaran",
                        width: "50px",
                    },
                    {
                        data: null,
                        render: function (data, type, row, meta) {
                            const notaLink =
                                '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal' +
                                meta.row +
                                '" >Nota</button>';
                            return notaLink;
                        },
                    },
                    {
                        data: null,
                        render: function (perbaikan) {
                            const buttons =
                                '<a href="/admin/updatePerbaikan/' +
                                perbaikan.id +
                                '">' +
                                '<button type="button" class="btn btn-info" style="margin-right: 10px; width: 100px">Update</button>' +
                                "</a>" +
                                '<a href="#">' +
                                '<button type="button" class="btn btn-success" style="margin-right: 10px; width: 130px">Cetak Laporan</button>' +
                                "</a>";

                            return buttons;
                        },
                    },
                ],
                order: [[0, "asc"]],
                columnDefs: [
                    { targets: [4], orderable: false },
                    { targets: [4], searchable: false },
                ],
            });
        }

        $("#tanggal_awal").val("");
        $("#tanggal_akhir").val("");
    });
});
$(document).ready(function () {
    let table;

    $("#tombol-filter-perbaikan-selesai-admin").click(function (e) {
        e.preventDefault();

        const tanggalAwal = $("#tanggal_awal_selesai").val();
        const tanggalAkhir = $("#tanggal_akhir_selesai").val();

        filterPerbaikanSelesai(
            tanggalAwal,
            tanggalAkhir,
            filter,
            "/admin/filter-report-admin/"
        );

        function filter(response) {
            if (table) {
                table.destroy();
            }
            table = $("#myTable").DataTable({
                destroy: true,
                processing: true,
                serverSide: false,
                responsive: true,
                createdRow: function (row, data, dataIndex) {
                    // Menggunakan jQuery untuk mengubah atribut style textAlign pada setiap sel (td) ke 'center'
                    $("td", row).css("text-align", "center");
                },
                data: response,
                columns: [
                    {
                        data: null,
                        render: function (data, type, row, meta) {
                            return meta.row + 1;
                        },
                        width: "10px",
                    },
                    {
                        data: "status",
                        width: "40px",
                    },
                    {
                        data: "id_report",
                        width: "10px",
                    },
                    {
                        data: "no_polisi",
                        width: "150px",
                    },
                    {
                        data: "mitra_bengkel",
                        width: "200px",
                    },
                    {
                        data: "tanggal_perbaikan",
                        width: "200px",
                    },
                    {
                        data: "tanggal_selesai",
                        width: "200px",
                    },
                    {
                        data: "jumlah_pembayaran",
                        width: "50px",
                    },
                    {
                        data: null,
                        render: function (data, type, row, meta) {
                            const notaLink =
                                '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal' +
                                meta.row +
                                '" >Nota</button>';
                            return notaLink;
                        },
                    },
                    {
                        data: null,
                        render: function (perbaikan) {
                            const buttons =
                                '<a href="/admin/updatePerbaikan/' +
                                perbaikan.id +
                                '">' +
                                '<button type="button" class="btn btn-info" style="margin-right: 10px; width: 100px">Update</button>' +
                                "</a>" +
                                '<a href="#">' +
                                '<button type="button" class="btn btn-success" style="margin-right: 10px; width: 130px">Cetak Laporan</button>' +
                                "</a>";
                            return buttons;
                        },
                    },
                ],
                order: [[0, "asc"]],
                columnDefs: [
                    { targets: [4], orderable: false },
                    { targets: [4], searchable: false },
                ],
            });
        }

        $("#tanggal_awal_selesai").val("");
        $("#tanggal_akhir_selesai").val("");
    });
});

// Filter Report DRIVER
$(document).ready(function () {
    let table;

    $("#tombol-filter-report-driver").click(function (e) {
        e.preventDefault();

        const tanggalAwal = $("#tanggal_awal").val();
        const tanggalAkhir = $("#tanggal_akhir").val();

        filterReport(
            tanggalAwal,
            tanggalAkhir,
            filter,
            "/driver/filter-report-driver/"
        );

        function filter(response) {
            if (table) {
                table.destroy();
            }
            table = $("#myTable").DataTable({
                destroy: true,
                processing: true,
                serverSide: false,
                responsive: true,
                createdRow: function (row, data, dataIndex) {
                    // Menggunakan jQuery untuk mengubah atribut style textAlign pada setiap sel (td) ke 'center'
                    $("td", row).css("text-align", "center");
                },
                data: response,
                columns: [
                    {
                        data: null,
                        render: function (data, type, row, meta) {
                            return meta.row + 1;
                        },
                        width: "10px",
                    },
                    {
                        data: "nama_driver",
                        width: "200px",
                    },
                    {
                        data: "shift",
                        width: "50px",
                    },
                    {
                        data: "no_polisi",
                        width: "150px",
                    },
                    {
                        data: "tanggal_input",
                        width: "200px",
                    },
                    {
                        data: null,
                        render: function (data) {
                            const buttons =
                                '<a href="/driver/detailReport/' +
                                data.id +
                                '">' +
                                '<button type="button" class="btn btn-warning" style="margin-right: 10px; width: 100px">Detail</button>' +
                                "</a>" +
                                '<a href="#">' +
                                '<button type="button" class="btn btn-success" style="margin-right: 10px; width: 130px">Cetak Laporan</button>' +
                                "</a>";
                            return buttons;
                        },
                    },
                ],
                order: [[0, "asc"]],
                columnDefs: [
                    { targets: [4], orderable: false },
                    { targets: [4], searchable: false },
                ],
            });
        }

        $("#tanggal_awal").val("");
        $("#tanggal_akhir").val("");
    });
});

// Filter
function filterReport(tanggalAwal, tanggalAkhir, func, link) {
    $.ajax({
        url: link,
        type: "POST",
        data: {
            tanggal_awal: tanggalAwal,
            tanggal_akhir: tanggalAkhir,
            _token: $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            func(response);
        },
        error: function (xhr, status, error) {
            console.log("Terjadi kesalahan saat melakukan AJAX:", error);
        },
    });
}
function filterPerbaikan(tanggalAwal, tanggalAkhir, func, link) {
    $.ajax({
        url: link,
        type: "POST",
        data: {
            tanggal_awal: tanggalAwal,
            tanggal_akhir: tanggalAkhir,
            _token: $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            func(response);
        },
        error: function (xhr, status, error) {
            console.log("Terjadi kesalahan saat melakukan AJAX:", error);
        },
    });
}
function filterPerbaikanSelesai(tanggalAwal, tanggalAkhir, func, link) {
    $.ajax({
        url: link,
        type: "POST",
        data: {
            tanggal_awal: tanggalAwal,
            tanggal_akhir: tanggalAkhir,
            _token: $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            func(response);
        },
        error: function (xhr, status, error) {
            console.log("Terjadi kesalahan saat melakukan AJAX:", error);
        },
    });
}
