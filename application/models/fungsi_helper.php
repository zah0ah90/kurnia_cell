<?php

function check_already_login()
{
    $ci = &get_instance();
    $user_session = $ci->session->userdata('user_id');
    if ($user_session) {
        redirect('dashboard');
    }
}

function check_not_login()
{
    $ci = &get_instance();
    $user_session = $ci->session->userdata('user_id');
    if (!$user_session) {
        redirect('auth');
    }
}

function uang($nominal)
{
    $result =  number_format($nominal, 0, ',', ',');
    return $result;
}

function memanggilAuth()
{
    $ci = &get_instance();
    $userID = $ci->session->userdata('user_id');
    $result = $ci->db->where('user_id', $userID)->get('tbl_master_user')->row();
    return $result;
}
