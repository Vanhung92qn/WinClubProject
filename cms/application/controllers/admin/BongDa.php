<?php


class BongDa extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('logadmin_model');
        $this->load->model('admin_model');
        $this->load->library('session');

    }

    function addkeobongda()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
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
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/user/addkeobongda';
        $this->load->view('admin/main', $this->data);
    }


    function updatekeobongda()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $start_time = null;
        $end_time = null;
        $idtran = $_GET['id'];
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
        $time = $_GET['thoiGianDa'];
        if ($time === null) {

        } else {
            $start_time = $time;
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['idtran'] = $idtran;
        $this->data['temp'] = 'admin/user/updatekeobongda';
        $this->load->view('admin/main', $this->data);
    }

    function updatekeoajax()
    {

        $session = urlencode($this->input->post("session"));
        $id = urlencode($this->input->post("id"));
        $doiA = urlencode($this->input->post("doiA"));
        $doiB = urlencode($this->input->post("doiB"));
        $banThangDoiA = urlencode($this->input->post("banThangDoiA"));
        $banThangDoiB = urlencode($this->input->post("banThangDoiB"));
        $thoiGianDa = urlencode($this->input->post("thoiGianDa"));
        $tiLeDoiAChapCaTran = urlencode($this->input->post("tiLeDoiAChapCaTran"));
        $tiLeDoiBChapCaTran = urlencode($this->input->post("tiLeDoiBChapCaTran"));
        $tileDoiAChapTaiXiu = urlencode($this->input->post("tileDoiAChapTaiXiu"));
        $tileDoiBChapTaiXiu = urlencode($this->input->post("tileDoiBChapTaiXiu"));
        $tileDoiAChapHiep1 = urlencode($this->input->post("tileDoiAChapHiep1"));
        $tileDoiBChapHiep1 = urlencode($this->input->post("tileDoiBChapHiep1"));
        $tileDoiAChapHiep2 = urlencode($this->input->post("tileDoiAChapHiep2"));
        $tileDoiBChapHiep2 = urlencode($this->input->post("tileDoiBChapHiep2"));
        $tileAnDoiACaTran = urlencode($this->input->post("tileAnDoiACaTran"));
        $tileAnDoiBCaTran = urlencode($this->input->post("tileAnDoiBCaTran"));
        $tileAnDoiATaiXiu = urlencode($this->input->post("tileAnDoiATaiXiu"));
        $tileAnDoiBTaiXiu = urlencode($this->input->post("tileAnDoiBTaiXiu"));
        $tileAnDoiAHiep1 = urlencode($this->input->post("tileAnDoiAHiep1"));
        $tileAnDoiBHiep1 = urlencode($this->input->post("tileAnDoiBHiep1"));
        $tileAnDoiAHiep2 = urlencode($this->input->post("tileAnDoiAHiep2"));
        $tileAnDoiBHiep2 = urlencode($this->input->post("tileAnDoiBHiep2"));
        $status = urlencode($this->input->post("status"));
        $url = urlencode($this->input->post("url"));

        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4005&Id=' . $id . '&session=' . $session . '&doiA=' . $doiA . '&doiB=' . $doiB . '&banThangDoiA=' . $banThangDoiA . '&banThangDoiB=' . $banThangDoiB . '&tiLeDoiAChapCaTran=' . $tiLeDoiAChapCaTran . '&tiLeDoiBChapCaTran=' . $tiLeDoiBChapCaTran . '&tileDoiAChapTaiXiu=' . $tileDoiAChapTaiXiu . '&tileDoiBChapTaiXiu=' . $tileDoiBChapTaiXiu . '&tileDoiAChapHiep1=' . $tileDoiAChapHiep1 . '&tileDoiBChapHiep1=' . $tileDoiBChapHiep1 . '&tileDoiAChapHiep2=' . $tileDoiAChapHiep2 . '&tileDoiBChapHiep2=' . $tileDoiBChapHiep2 . '&tileAnDoiACaTran=' . $tileAnDoiACaTran . '&tileAnDoiBCaTran=' . $tileAnDoiBCaTran . '&tileAnDoiATaiXiu=' . $tileAnDoiATaiXiu . '&tileAnDoiBTaiXiu=' . $tileAnDoiBTaiXiu . '&tileAnDoiAHiep1=' . $tileAnDoiAHiep1 . '&tileAnDoiBHiep1=' . $tileAnDoiBHiep1 . '&tileAnDoiAHiep2=' . $tileAnDoiAHiep2 . '&tileAnDoiBHiep2=' . $tileAnDoiBHiep2 . '&status=0&url=none&thoiGianDa=' . $thoiGianDa);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function dongcuockeoajax()
    {

        $id = urlencode($this->input->post("Id"));

        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4007&Id=' . $id);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function addkeoajax()
    {

        $session = urlencode($this->input->post("session"));
        $doiA = urlencode($this->input->post("doiA"));
        $doiB = urlencode($this->input->post("doiB"));
        $banThangDoiA = urlencode($this->input->post("banThangDoiA"));
        $banThangDoiB = urlencode($this->input->post("banThangDoiB"));
        $thoiGianDa = urlencode($this->input->post("thoiGianDa"));
        $tiLeDoiAChapCaTran = urlencode($this->input->post("tiLeDoiAChapCaTran"));
        $tiLeDoiBChapCaTran = urlencode($this->input->post("tiLeDoiBChapCaTran"));
        $tileDoiAChapTaiXiu = urlencode($this->input->post("tileDoiAChapTaiXiu"));
        $tileDoiBChapTaiXiu = urlencode($this->input->post("tileDoiBChapTaiXiu"));
        $tileDoiAChapHiep1 = urlencode($this->input->post("tileDoiAChapHiep1"));
        $tileDoiBChapHiep1 = urlencode($this->input->post("tileDoiBChapHiep1"));
        $tileDoiAChapHiep2 = urlencode($this->input->post("tileDoiAChapHiep2"));
        $tileDoiBChapHiep2 = urlencode($this->input->post("tileDoiBChapHiep2"));
        $tileAnDoiACaTran = urlencode($this->input->post("tileAnDoiACaTran"));
        $tileAnDoiBCaTran = urlencode($this->input->post("tileAnDoiBCaTran"));
        $tileAnDoiATaiXiu = urlencode($this->input->post("tileAnDoiATaiXiu"));
        $tileAnDoiBTaiXiu = urlencode($this->input->post("tileAnDoiBTaiXiu"));
        $tileAnDoiAHiep1 = urlencode($this->input->post("tileAnDoiAHiep1"));
        $tileAnDoiBHiep1 = urlencode($this->input->post("tileAnDoiBHiep1"));
        $tileAnDoiAHiep2 = urlencode($this->input->post("tileAnDoiAHiep2"));
        $tileAnDoiBHiep2 = urlencode($this->input->post("tileAnDoiBHiep2"));
        $status = urlencode($this->input->post("status"));
        $url = urlencode($this->input->post("url"));

        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4003&session=' . $session . '&doiA=' . $doiA . '&doiB=' . $doiB . '&banThangDoiA=' . $banThangDoiA . '&banThangDoiB=' . $banThangDoiB . '&tiLeDoiAChapCaTran=' . $tiLeDoiAChapCaTran . '&tiLeDoiBChapCaTran=' . $tiLeDoiBChapCaTran . '&tileDoiAChapTaiXiu=' . $tileDoiAChapTaiXiu . '&tileDoiBChapTaiXiu=' . $tileDoiBChapTaiXiu . '&tileDoiAChapHiep1=' . $tileDoiAChapHiep1 . '&tileDoiBChapHiep1=' . $tileDoiBChapHiep1 . '&tileDoiAChapHiep2=' . $tileDoiAChapHiep2 . '&tileDoiBChapHiep2=' . $tileDoiBChapHiep2 . '&tileAnDoiACaTran=' . $tileAnDoiACaTran . '&tileAnDoiBCaTran=' . $tileAnDoiBCaTran . '&tileAnDoiATaiXiu=' . $tileAnDoiATaiXiu . '&tileAnDoiBTaiXiu=' . $tileAnDoiBTaiXiu . '&tileAnDoiAHiep1=' . $tileAnDoiAHiep1 . '&tileAnDoiBHiep1=' . $tileAnDoiBHiep1 . '&tileAnDoiAHiep2=' . $tileAnDoiAHiep2 . '&tileAnDoiBHiep2=' . $tileAnDoiBHiep2 . '&status=0&url=none&thoiGianDa=' . $thoiGianDa);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }


    function listkeobongdaajax()
    {

        $session = urlencode($this->input->post("session"));
        $datainfo = $this->get_data_curl($this->config->item('api_url') . '?c=4003&session=' . $session);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }


    function listkeobongda()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
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
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/user/listkeobongda';
        $this->load->view('admin/main', $this->data);
    }

    function listrequestbongda()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
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
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/user/listrequestbongda';
        $this->load->view('admin/main', $this->data);
    }

    function listrequestbongdaajax()
    {

        $session = urlencode($this->input->post("session"));
        $start_time = urlencode($this->input->post("fromDate"));
        $time_end = urlencode($this->input->post("toDate"));
        $pag = urlencode($this->input->post("pages"));

        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4004&session=' . $session . '&ts=' . $start_time . '&te=' . $time_end . '&p=' . $pag);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

}