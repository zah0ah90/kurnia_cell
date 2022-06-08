<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{

	// function __construct()
	// {
	//     parent::__construct();
	//     $this->load->model('all_m');
	//     check_not_login();
	// }


	public function index()
	{
		$data = [
			'tabel' => $this->db->get('barang')->result()
		];
		$this->load->view('barang/index', $data);
	}

	public function tambah()
	{
		$barang = new StdClass();
		$barang->id = null;
		$barang->nama_barang = null;
		$barang->jenis_barang = null;
		$barang->tipe_barang = null;
		$barang->nama_supplier = null;
		$barang->qty = null;
		$barang->harga_jual = null;
		$barang->harga_modal = null;

		$data = [
			'row' => $barang,
			'page' => 'tambah'
		];
		$this->load->view('barang/form', $data);
	}

	public function edit($id)
	{
		$data = [
			'page' => 'edit',
			'row' => $this->db->where('id', $id)->get('barang')->row()

		];
		$this->load->view('barang/form', $data);
	}


	public function process()
	{
		$post = $this->input->post(null, true);

		if ($post['nama_barang']) {
			$data = [
				'nama_barang' => $post['nama_barang'],
				'jenis_barang' => $post['jenis_barang'],
				'tipe_barang' => $post['tipe_barang'],
				'nama_supplier' => $post['nama_supplier'],
				'qty' => $post['qty'],
				'harga_jual' => $post['harga_jual'],
				'harga_modal' => $post['harga_modal'],
			];
			$add = [
				'add_date' => date('Y-m-d H:i:s')
			];
			$upd = [
				'upd_date' => date('Y-m-d H:i:s')
			];
		}


		if ($post['opsi'] == 'tambah') {
			array_merge($data, $add);
			$this->db->insert('barang', $data);
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('success', 'Berhasil di Tambah');
			}
		}
		if ($post['opsi'] == 'edit') {
			$id = [
				'id' => $post['id']
			];
			array_merge($data, $upd, $id);
			$this->db->where('id', $post['id'])->update('barang', $data);
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('success', 'Berhasil di Edit');
			}
		}

		redirect('barang');
	}

	public function hapus($id)
	{
		$this->db->where('id', $id)->delete('barang');
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Berhasil di hapus');
		}
		redirect('barang');
	}
}