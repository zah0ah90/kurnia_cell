<?php $this->load->view('template/header.php'); ?>

<?php $this->load->view('template/datatable.php'); ?>


<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Laporan</h1>

<div class="card shadow">
    <div class="card-body">
        <a href="#" class="btn btn-primary float-right mb-2" data-toggle="modal" data-target="#exampleModal">Filter</a>
        <div class="table-responsive">
            <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Total Harga</th>
                        <th>Total Modal</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($tabel) { ?>
                    <?php $no = 1;
                        foreach ($tabel as $row) { ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row->total_harga_jual ?></td>
                        <td><?= $row->total_harga_modal ?></td>
                        <td><?= $row->add_date ?></td>
                    </tr>
                    <?php }
                    } else { ?>
                    <tr>
                        <td colspan="4" class="text-center">Data tidak ada</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <br><br>
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>

                    <tr>
                        <th colspan="2" class="text-center">TOTAL HARGA JUAL DAN TOTAL HARGA MODAL</th>
                    </tr>
                    <tr>
                        <th>Total Harga</th>
                        <th>Total Modal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($tabel_total) { ?>
                    <?php
                        foreach ($tabel_total as $row) { ?>
                    <tr>

                        <td><?= $row->total_harga_jual ?></td>
                        <td><?= $row->total_harga_modal ?></td>

                    </tr>
                    <?php }
                    } else { ?>
                    <tr>
                        <td colspan="2" class="text-center">Data tidak ada</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#example').DataTable();
})
</script>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Filter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="forms" class="formsc">
                    <div class="form-group">
                        <label for="">Tanggal Awal</label>
                        <input type="date" name="tanggalAwal" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="" style="margin-bottom: -10px;">Tanggal Akhir</label>
                        <input type="date" name="tanggalAkhir" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <input type="submit" name="asambit" value="FILTER" onclick="sambit()"
                        class="btn btn-primary text-white float-right">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </form>


            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<script>
$(function() {
    $("#forms").validate({
        rules: {
            tanggalAwal: {
                required: true,
            },
            tanggalAkhir: {
                required: true,
            },
            action: "required"
        },
        messages: {
            tanggalAwal: {
                required: "Mohon untuk memilih",
            },
            tanggalAkhir: {
                required: "Mohon untuk memilih",
            },
            action: "Please provide some data"
        }
    });
});
</script>

<?php $this->load->view('template/footer.php'); ?>