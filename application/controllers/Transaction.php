<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    // check_not_login();
    // logsis();
    $this->load->model(['crud_m']);
    // bukanAkj();
    // $this->load->library('upload');
  }

  public function index()
  {
    $data_category = $this->db->select('category_id, nama')->get('tbl_category_product');
    $data = [

      // 'data_product' => $data_product,
      'data_category' => $data_category
    ];
    $this->load->view('transaksi/index');
  }

  function showCarts()
  {
    echo $this->show_cart();
  }

  function show_cart()
  { //Fungsi untuk menampilkan Cart
    $output = '';
    $no     = 0;
    foreach ($this->cart->contents() as $items) {
      $no++;
      // echo '<pre>';
      // print_r($items);
      // die();
      $output .= '
              <tr>
              <td>' . $items['name'] . ' </td>
              <td class="text-center">
              <a href="#" data-id="' . $items['id'] . '"           
              class="tambahCart  text-white btn btn-primary btn-sm rounded-circle"><i class="fas fa-plus"></i></a>
              &nbsp; ' . $items['qty'] . ' &nbsp;  <a href="#" data-id="' . $items['rowid'] . '" 
              class="kurangCart  text-white rounded-circle btn btn-primary btn-sm"><i class="fas fa-minus"></i></a>
              </td>
              <td>' . $items['price'] . '</td> 
              <td>
              ';
      $CekStokDB = $this->db->select('product_id, stok')->where('product_id', $items['id'])->get('tbl_product_list')->row()->stok;

      $output .= '' . $CekStokDB . ' </td><td>' . $items['subtotal'] . ' </td>   
      <td><a href="#" data-id="' . $items['rowid'] . '"           
      class="hapusCart  text-white btn btn-danger btn-sm rounded-circle"><i class="far fa-trash-alt"></i></a></td>
      </tr>
             ';
    }
    return $output;
  }

  function search($array, $key, $value)
  {
    $results = array();

    if (is_array($array)) {
      if (isset($array[$key]) && $array[$key] == $value) {
        $results[] = $array;
      }

      foreach ($array as $subarray) {
        $results = array_merge($results, $this->search($subarray, $key, $value));
      }
    }

    return $results;
  }


  function tambahCart()
  {
    $post = $this->input->post(null, true);
    $id = $post['id'];
    $item = $this->db->select('harga_setelah_diskon, nama, product_id, stok')->where('product_id', $id)->get('tbl_product_list')->row();
    // echo '<pre>';
    $try = $this->cart->contents();
    // print_r($try);
    // die();
    $cekArray = $this->search($try, 'id', $id);
    // print_r();
    if ($item->stok == '0') {
      echo $this->show_cart() . '<script>alert("Mohon untuk mengecek stok karena stok tersebut 0")</script>';
    } else {
      if ($cekArray) {
        if ($item->stok >  $cekArray[0]['qty']) {
          $data = array(
            'id'          => $item->product_id,
            'price'       => $item->harga_setelah_diskon,
            'name'        => $item->nama,
            'qty'         => 1,
          );
          $this->cart->insert($data);
          echo $this->show_cart();
        } else {
          echo $this->show_cart() . '<script>alert("Mohon untuk mengecek stok")</script>';
        }
      } else {
        $data = array(
          'id'          => $item->product_id,
          'price'       => $item->harga_setelah_diskon,
          'name'        => $item->nama,
          'qty'         => 1,
        );
        $this->cart->insert($data);
        echo $this->show_cart();
      }
    }
  }

  function clear()
  {
    $this->cart->destroy();
    echo $this->show_cart();
  }

  function kurangCart()
  {
    $idarray = $this->input->post('id');
    $try = $this->cart->get_item($idarray);

    $qty     = $try['qty'] - 1;
    $data   = array(
      'rowid' => $idarray,
      'qty'   => $qty,
    );
    $this->cart->update($data);
    echo $this->show_cart();
  }

  function hapusCart()
  {
    $idarray = $this->input->post('id');
    $try = $this->cart->get_item($idarray);

    $qty     = $try['qty'] * 0;
    $data   = array(
      'rowid' => $idarray,
      'qty'   => $qty,
    );
    $this->cart->update($data);
    echo $this->show_cart();
  }

  function showHarga()
  {
    echo $this->cart->total();
  }

  function bayar()
  {
    $post = $this->input->post(null, true);
    $cust = $post['cust'];
    $data = [
      'nama_pembeli' => $cust,
      'total_harga' => $this->cart->total()
    ];
    $this->crud_m->insert_model($table = 'tbl_trx_list', $data);
    $id = $this->db->insert_id();
    if ($this->db->affected_rows() > 0) {
      $try = $this->cart->contents();
      foreach ($try as $key => $items) {
        $itemQTY = $items['qty'];
        $itemID = $items['id'];

        $dataDetailProduct[] = [
          'trx_id' => $id,
          'product_id' =>  $itemID,
          'product_name' =>  $items['name'],
          'harga_jual' => $items['price'],
          'total' => $items['subtotal'],
          'qty' => $itemQTY,
          'status' => '1',
          'addid'           => $this->session->userdata('nama'),
          'adddate'         => date('Y-m-d H:i:s'),
        ];

        $mencariStok = $this->db->select('product_id, stok')->where('product_id', $itemID)->get('tbl_product_list')->row();
        // print_r($itemQTY);
        $menempelkanStokProduct = [
          'stok' => $mencariStok->stok - $itemQTY
        ];
        // die();
        $this->crud_m->update_model($table = 'tbl_product_list', $category = 'product_id', $idnya = $itemID, $menempelkanStokProduct);
        // $this->db->where('product_id', $itemID)->update('tbl_product_list', $menempelkanStokProduct);
      }


      foreach ($dataDetailProduct as $item) {
        $insert_query = $this->db->insert_string('tbl_trx_list_history', $item);
        $insert_query = str_replace('INSERT INTO', 'INSERT INTO', $insert_query);
        $this->db->query($insert_query);
      }

      if ($this->db->affected_rows() > 0) {
        $this->cart->destroy();
        $massage['status'] = true;
        echo json_encode($massage);
      } else {
        echo '<script>alert("error insert");</script>';
        $massage['status'] = false;
        echo json_encode($massage);
      }
    }
  }

  function listProduct()
  {
    $data = $this->db->select('category_id, nama, product_id')->where('category_id', $this->input->post('id'))->get('tbl_product_list')->result();
    $output = false;
    $output .= '<option value="">-- Pilih Product --</option>';
    foreach ($data as $item) {
      $output .= '<option value="' . $item->product_id . '">' . $item->nama . '</option>';
    }
    echo $output;
  }

  function detailProduct()
  {
    $data = $this->db->select('harga, discount, nama, product_id')->where('product_id', $this->input->post('id'))->get('tbl_product_list')->row();
    $output = false;

    $output .= '
    <div class="form-group">
    <label for="">Harga</label>
    <input type="number" class="form-control" value="' . $data->harga . '" disabled="disabled">
    </div>
    <div class="form-group">
    <label for="">Discount</label>
    <input type="number" class="form-control" value="' . $data->discount . '" disabled="disabled">
    </div>
    
    ';

    echo $output;
  }
}