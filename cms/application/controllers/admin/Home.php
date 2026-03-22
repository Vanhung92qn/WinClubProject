<?php

Class Home extends MY_Controller
{
    function index()
    {
        $this->lang->load('admin/home');
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
            $start_time = date('d-m-Y');
        }
        if ($end_time === null) {
            $end_time = date('d-m-Y');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/home/index';
        $this->load->view('admin/main', $this->data);
    }

    /**
     * thuc hien call api
     */
    function getNumberChargeMoneyProcess()
    {
        $datainfo = file_get_contents($this->config->item('api_backend') . '?c=3707');
        $data = json_decode($datainfo);
        echo $datainfo;
    }

    function moneyajax(){

        $toDate = $this->input->post("toDate");
        $te = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $datainfo = $this->file_get_contents($this->config->item('api_backend').'?c=7&ts='.$fromDate.'&te='.$te);
        if(isset($datainfo)) {
            echo $datainfo;
        }else{
            echo "Bạn không được hack";
        }
    }

    function userajax()
    {
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=11013&ts=' . $fromDate . '&te=' . $toDate );
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }
    function getGiftcodeAjax()
    {
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=11024&ts=' . $fromDate . '&te=' . $toDate );
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }
    function getTotalMemberajax()
    {
        $username = urlencode($this->input->post("username"));
        $nickname = urlencode($this->input->post("nickname"));
        $phone = urlencode($this->input->post("phone"));
        $fieldname = $this->input->post("fieldname");
        $timkiemtheo = $this->input->post("timkiemtheo");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $typetaikhoan = $this->input->post("typetaikhoan");
        $pages = $this->input->post("pages");
        $record = $this->input->post("record");
        $taikhoanbot = $this->input->post("taikhoanbot");
        $typetk = $this->input->post("typetk");
        $email = $this->input->post("email");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=104&un=' . $username . '&nn=' . $nickname . '&m=' . $phone . '&fd=' . $fieldname . '&srt=' . $timkiemtheo . '&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate) . '&dl=' . $typetaikhoan . '&p=' . $pages . '&tr=' . $record . '&bt=' . $taikhoanbot . '&email=' . $email . '&lk=' . $typetk);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }
    
}