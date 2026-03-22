<?php


class Loto extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('logadmin_model');
        $this->load->model('admin_model');
        $this->load->library('session');

    }


    function  addketqualode()
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
        $this->data['temp'] = 'admin/loto/addketqualode';
        $this->load->view('admin/main', $this->data);
    }

    function  tinhtoantrathuong()
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
        $this->data['temp'] = 'admin/loto/tinhtoantrathuong';
        $this->load->view('admin/main', $this->data);
    }

    function  addketqualodeajax()
    {
        $sessionId =  ($this->input->post("session"));
        $chanel = ($this->input->post("chanel"));
        $rsdb = ($this->input->post("rsdb"));
        $rs1 = ($this->input->post("rs1"));
        $rs2 = $this->input->post("rs2");
        $rs3 = $this->input->post("rs3");
        $rs4 = $this->input->post("rs4");
        $rs5 = $this->input->post("rs5");
        $rs6 = $this->input->post("rs6");
        $rs7 = $this->input->post("rs7");
        $rs8 = $this->input->post("rs8");
        $dateResult = urlencode( $this->input->post("dateResult"));
       ///lotoapi/addresult
         error_log($dateResult);
        $datainfo = $this->CallAPI("POST",$this->config->item('api_backend_lode') . 'lotoapi/addresult/' . $sessionId . '/' . $chanel . '?&time=' . $dateResult . '&rsdb=' . $rsdb . '&rs1='
            . $rs1 . '&rs2=' . $rs2 . '&rs3=' . $rs3 . '&rs4=' . $rs4 . '&rs5=' . $rs5. '&rs6=' . $rs6. '&rs7=' . $rs7. '&rs8=' . $rs8);
        error_log($datainfo);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }

    }

    function  tinhtoanhketquaAjax()
    {
        $LotosessionId =  ($this->input->post("msession"));
        $datainfo = $this->CallAPI("POST",$this->config->item('api_backend_lode') . 'lotoapi/calculateresult'.'/'.$LotosessionId ."?&phien=".$LotosessionId) ;
        error_log($datainfo);
        if (isset($datainfo)) {
            echo $datainfo;

        } else {
            echo "Bạn không được hack";
        }

    }

    function  tragiaiketquaAjax()
    {
        $LotosessionId =  ($this->input->post("msession"));
        $datainfo = $this->CallAPI("POST",$this->config->item('api_backend_lode') . 'lotoapi/calculateresultAndPay'.'/'.$LotosessionId ."?&phien=".$LotosessionId) ;
       // error_log($datainfo);
        if (isset($datainfo)) {
            echo $datainfo;

        } else {
            echo "Bạn không được hack";
        }

    }
}