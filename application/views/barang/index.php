<?php $this->load->view('template/header.php'); ?>
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"> -->
<!-- <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> -->

<?php $this->load->view('template/datatable.php'); ?>




<div class="flash-data" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Sparepart</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <a href="<?= base_url('barang/tambah') ?>" class="btn btn-primary float-right mb-2">Tambah</a>
        <div class="table-responsive">
            <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Sparepart</th>
                        <th>Nama Supplier</th>
                        <th>STOK</th>
                        <th>Harga Modal</th>
                        <th>Harga Jual</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($tabel as $data) { ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data->nama_barang ?></td>
                        <td><?= $data->nama_supplier ?></td>
                        <td>
                            <?php if ($data->stok == 0) {
                                    $stok = 0;
                                } else {
                                    $stok = $data->stok;
                                } ?>
                            <?= $stok ?>
                        </td>
                        <td><?= uang($data->harga_jual) ?></td>
                        <td><?= uang($data->harga_modal) ?></td>
                        <td>
                            <a href="<?= base_url('barang/edit/' . $data->id) ?>"><span
                                    class="btn btn-primary">Edit</span></a>
                            <a href="<?= base_url('barang/tambah_stok/' . $data->id) ?>" class="btn btn-success">+ /
                                -</a>
                            <a href="<?= base_url('barang/hapus/' . $data->id) ?>"
                                class="btn btn-danger tombol-hapus">Hapus</a>

                        </td>
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
    $('.tombol-hapus').on('click', function(e) {
        e.preventDefault();

        const href = $(this).attr('href');

        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data Obat akan dihapus!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus Data!'
        }).then((result) => {
            if (result.value == true) {
                document.location.href = href;
            }
        })
    })

    const flashData = $('.flash-data').data('flashdata');
    if (flashData) {
        Swal.fire({
            title: 'Data Spare Part',
            text: flashData,
            type: 'success'
        })
    }

});
</script>
<!-- Page level plugins -->




<?php $this->load->view('template/footer.php'); ?>