<?php $this->load->view('template/header.php'); ?>
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"> -->
<!-- <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> -->

<?php $this->load->view('template/datatable.php'); ?>

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">History Sparepart</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">


        <div class="table-responsive">
            <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Sparepart</th>
                        <th>Jenis</th>
                        <th>qty</th>
                        <th>Note</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($tabel as $data) { ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data->nama_barang ?></td>
                        <td><?= $data->jenis ?></td>
                        <td><?= $data->qty ?></td>
                        <td><?= $data->note ?></td>
                        <td><?= $data->add_date ?></td>

                    </tr>
                    <?php } ?>
                </tbody>

            </table>
        </div>
    </div>
</div>



<script>
$(document).ready(function() {
    $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel'
        ]
    });
})
</script>



<?php $this->load->view('template/footer.php'); ?>