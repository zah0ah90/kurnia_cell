<?php $this->load->view('template/header.php'); ?>

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Transaksi</h1>


<!-- Default box -->
<div class="card shadow">
    <div class="card-body">

        <div class="row" style="height: 500px;">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Pilih Sparepart</label>
                    <select class="form-control sparepart" name="sparepart">
                        <option value="">-- Pilih Sparepart --</option>
                        <?php foreach ($sparepart->result() as $data) { ?>
                        <option value="<?= $data->id ?>"><?= $data->nama_barang ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="detailProduct"> </div>
                <button href="#" class="btn btn-primary pilihAN">Pilih</button>
            </div>
            <div class="col-md-6">
                <!-- <div class="form-group">
                    <label for="">Nama Konsumen</label>
                    <input type="text" class="form-control namaKonsumen">
                </div> -->
                <table class="table table-borderless table-hover table-striped w-100">
                    <thead>
                        <tr align="center">
                            <th>Nama Product</th>
                            <th>QTY</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Sub Total</th>
                            <th>Del</th>
                        </tr>
                    </thead>
                    <tbody class="resultCart"></tbody>
                </table>
                <div class="text-right ">
                    <h4><b>Total Harga <div class="total-harga"></div><input type="number" hidden="hidden"
                                class="harga"></b>
                    </h4>
                </div>
                <a href="#" class="btn btn-primary text-white float-right mx-1 " id="btnBayar"><i
                        class="fas fa-sync-alt"></i> Bayar</a>
                <a href="#" class="btn btn-secondary text-white float-right mx-1 " id="btnClear"><i
                        class="fas fa-sync-alt"></i> Clear</a>
            </div>
        </div>
    </div>
</div>
<!-- /.card -->



<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    listdetail_cart();
    totalHarga();

    function listdetail_cart() {
        $.ajax({
            url: "<?= base_url() ?>transaksi/showCarts",
            method: "POST",
            success: function(data) {
                $(".resultCart").html(data);
            },
        });
    }

    function totalHarga() {
        $.ajax({
            url: "<?= base_url() ?>transaksi/showHarga",
            method: "POST",
            success: function(data) {
                $(".total-harga").html(data);
                $('.harga').val(data);
            },
        });
    }

    $(document).on("change", ".sparepart", function() {
        var id = $('.sparepart').val();
        if (id == '') {
            alert('Mohon untuk memilih Sparepart');
            $(".detailProduct").html('');
            // $(".product").val('0');
            $('.btn').attr('disabled', false);
        } else {
            $.ajax({
                url: "<?= base_url() ?>transaksi/listProduct",
                method: "POST",
                data: {
                    id: id,
                },
                success: function(data) {
                    // $(".product").html(data);
                    $(".detailProduct").html(data);
                    // totalHarga()
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert('Terjadi Kesalahan Harap Hubungi Admin');
                }
            });
        }
    });


    // $(document).on("change", ".product", function() {
    //     var id = $('.product').val();
    //     if (id == '') {
    //         alert('Mohon untuk memilih Product');
    //         $(".detailProduct").html('');
    //         // $('.btn').attr('disabled', false);
    //     } else {
    //         $.ajax({
    //             url: "<?= base_url() ?>transaksi/detailProduct",
    //             method: "POST",
    //             data: {
    //                 id: id,
    //             },
    //             success: function(data) {
    //                 $(".detailProduct").html(data);
    //                 // totalHarga()
    //             },
    //             error: function(xhr, ajaxOptions, thrownError) {
    //                 alert('Terjadi Kesalahan Harap Hubungi Admin');
    //             }
    //         });
    //     }
    // });

    $(document).on("click", ".pilihAN", function() {
        var id = $('.sparepart').val();
        $('.btn').attr('disabled', true);
        if (id == '') {
            alert('Mohon untuk memilih Product')
            $('.btn').attr('disabled', false);
        } else {
            $.ajax({
                url: "<?= base_url() ?>transaksi/tambahCart",
                method: "POST",
                data: {
                    id: id,
                },
                success: function(data) {
                    $(".resultCart").html(data);
                    totalHarga();
                    $('.btn').attr('disabled', false);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert('Terjadi Kesalahan Harap Hubungi Admin');
                }
            });
        }
    });


    $(document).on("click", ".tambahCart", function() {
        var id = $(this).data('id');
        $('.btn').attr('disabled', true);
        $.ajax({
            url: "<?= base_url() ?>transaksi/tambahCart",
            method: "POST",
            data: {
                id: id,
            },
            success: function(data) {
                $(".resultCart").html(data);
                totalHarga();
                $('.btn').attr('disabled', false);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert('Terjadi Kesalahan Harap Hubungi Admin');
            }
        });
    });

    $(document).on("click", ".kurangCart", function() {
        var id = $(this).data('id');
        $('.btn').attr('disabled', true);
        $.ajax({
            url: "<?= base_url() ?>transaksi/kurangCart",
            method: "POST",
            data: {
                id: id,
            },
            success: function(data) {
                $(".resultCart").html(data);
                totalHarga();
                $('.btn').attr('disabled', false);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert('Terjadi Kesalahan Harap Hubungi Admin');
            }
        });
    });

    $(document).on("click", ".hapusCart", function() {
        var id = $(this).data('id');
        $('.btn').attr('disabled', true);
        $.ajax({
            url: "<?= base_url() ?>transaksi/hapusCart",
            method: "POST",
            data: {
                id: id,
            },
            success: function(data) {
                $(".resultCart").html(data);
                totalHarga()
                $('.btn').attr('disabled', false);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert('Terjadi Kesalahan Harap Hubungi Admin');
            }
        });
    });

    $(document).on("click", "#btnClear", function() {
        $('.btn').attr('disabled', true);
        $.ajax({
            url: "<?= base_url() ?>transaksi/clear",
            method: "GET",
            success: function(data) {
                $(".resultCart").html(data);
                totalHarga();
                $('.btn').attr('disabled', false);
                $(".detailProduct").html('');
                $(".product").html('');
                // $('.namaKonsumen').val('');
            },
        });
    })

    $(document).on("click", "#btnBayar", function() {
        $('.btn').attr('disabled', true);
        // var cust = $('.namaKonsumen').val();
        var hargaIN = $('.harga').val();
        if (hargaIN == 0) {
            alert('mohon untuk menambahkan product');
            $('.btn').attr('disabled', false);
        } else {
            $.ajax({
                url: "<?= base_url() ?>transaksi/bayar",
                method: "POST",
                dataType: "json",
                success: function(data) {
                    if (data.status == true) {
                        Swal.fire(
                            'Berhasil',
                            'Data Berhasil Di simpan',
                            'success'
                        )

                        $('.resultCart').html('');
                        totalHarga();
                        $('.btn').attr('disabled', false);
                        $(".detailProduct").html('');
                    }

                    if (data.status == false) {
                        // Swal({
                        //     type: "warning",
                        //     title: "Terjadi Kesalahan harap hubungi admin",
                        // });
                        Swal.fire(
                            'Tidak Berhasil',
                            'Terjadi Kesalahan harap hubungi admin',
                            'warning'
                        )
                        $('.btn').attr('disabled', false);
                    }

                    // $(".resultCart").html(data);
                    // totalHarga()
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert('Terjadi Kesalahan Harap Hubungi Admin');
                }
            });
        }
    })
});
</script>



<?php $this->load->view('template/footer.php'); ?>