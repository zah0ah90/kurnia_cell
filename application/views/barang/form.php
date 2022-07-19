<?php $this->load->view('template/header.php'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?= $page ?> Sparepart</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">

    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <form method="post" id="myForm" action="<?= base_url('barang/process') ?>">
                    <input type="hidden" name="id" value="<?= $row->id ?>">
                    <input type="hidden" name="opsi" value="<?= $page ?>">
                    <div class="form-group">
                        <label>Nama Sparepart</label>
                        <input type="text" name="nama_barang" value="<?= $row->nama_barang ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Jenis Sparepart</label>
                        <input type="text" name="jenis_barang" value="<?= $row->jenis_barang ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Tipe Sparepart</label>
                        <input type="text" name="tipe_barang" value="<?= $row->tipe_barang ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nama Supplier</label>
                        <input type="text" name="nama_supplier" value="<?= $row->nama_supplier ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Harga Jual</label>
                        <input type="number" name="harga_jual" value="<?= $row->harga_jual ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Harga Modal</label>
                        <input type="number" name="harga_modal" value="<?= $row->harga_modal ?>" class="form-control">
                    </div>



                    <button type="submit" class="float-right btn btn-success text-white">Simpan</button>
                    <a href="<?= base_url('barang') ?>" class="float-right btn btn-primary text-white mr-2">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $('#myForm').validate({ // initialize the plugin
            rules: {
                harga_jual: {
                    required: true,
                    number: true,
                    minlength: 4,
                },
                harga_modal: {
                    required: true,
                    number: true,
                    // minlength: 5,
                },
                nama_barang: {
                    required: true,
                },
                nama_supplier: {
                    required: true,
                },
                jenis_barang: {
                    required: true,
                },
                tipe_barang: {
                    required: true,
                },

            }
        });

    });
</script>


<?php $this->load->view('template/footer.php'); ?>