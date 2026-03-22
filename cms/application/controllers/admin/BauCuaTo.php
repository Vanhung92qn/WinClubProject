<?php


class BauCuaTo extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('logadmin_model');
        $this->load->model('admin_model');
        $this->load->library('session');

    }

    function quanlybaucua()
    {  date_default_timezone_set('Asia/Ho_Chi_Minh');
        $start_time = null;
        $end_time = null;
        if ($this->input->post('toDate')) {
            $end_time = $this->input->post('toDate');
        }

        if ($this->input->post('fromDate')) {
            $start_time = $this->input->post('fromDate');
        }

        if ($start_time === null) {
            $start_time = date('Y-m-d 18:15:00');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 18:15:00');
        }
        $this->data['temp'] = 'admin/baucuato/quanlybaucuato';
        $this->load->view('admin/main', $this->data);
    }
    function getlistbaucuaAjax()
    {

        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=3701');
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function getlistUserbaucuaAjax()
    {

        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=3703');
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }
    function beCaubaucuaAjax()
    {
        $status =  ($this->input->post("status"));
        $dice1 =  ($this->input->post("dice1"));
        $dice2 =  ($this->input->post("dice2"));
        $dice3 =  ($this->input->post("dice3"));

        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=3705&st='.$status.'&dc1='.$dice1.'&dc2='.$dice2.'&dc3='.$dice3);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }
}