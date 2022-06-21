<?php $this->load->view('template/header.php'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
<h4>Selamat Datang <?= $this->session->userdata('nama') ?></h4>

<?php $this->load->view('template/footer.php'); ?>