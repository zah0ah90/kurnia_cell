<?php $this->load->view('template/header.php'); ?>
<!-- Page Heading -->
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
<h4>Selamat Datang <?= $this->session->userdata('nama') ?></h4>
<script>
    $(document).ready(function() {
        const flashData = $('.flash-data').data('flashdata');
        if (flashData) {
            Swal.fire(
                flashData, '',
                'success'
            )
        }
    })
</script>
<?php $this->load->view('template/footer.php'); ?>