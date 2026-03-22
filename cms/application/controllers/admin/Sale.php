<?php

class Sale extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('usergame_model');
        $this->load->model('logadmin_model');
        $this->load->model('tranfermoney_model');
        $this->load->model('useragent_model');

    }

    function index()
    {
        $admin_login = $this->session->userdata('user_id_login');
        $admin_info = $this->admin_model->get_info($admin_login);
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $this->data['status'] = $admin_info->Status;

        $this->data['temp'] = 'admin/sale/index';
        $this->load->view('admin/main', $this->data);
    }

    function fetch()
    {
        $datainfo = $this->get_method_data_curl($this->config->item('api_backend') . '?c=4079');
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }


    function save()
    {
        $id = $this->input->post("id");
        $dl_id = $this->input->post("dl_id");
        $fullname = $this->input->post("fullname");
        $username = $this->input->post("username");
        $nickname = $this->input->post("nickname");
        $phone = $this->input->post("phone");
        $khuvuc = $this->input->post("khuvuc");
        $tele = $this->input->post("tele");
        $fb = $this->input->post("facebook");
        $zalo = $this->input->post("zalo");
        $bank = $this->input->post("bank");
        $banknum = $this->input->post("banknumber");
        $bankname = $this->input->post("bankname");
        $note = $this->input->post("note");

        error_log($id);
        if ($id != '0') {
            $datainfo = $this->get_data_curl($this->config->item('api_backend').'?c=4078'.'&id='.$id.'&dl_id='.$dl_id.'&fullname='.$fullname.'&username='.$username.'&nickname='.$nickname.'&phone='.$phone.'&khuvuc='.$khuvuc.'&tele='.$tele.'&fb='.$fb.'&zalo='.$zalo.'&bank='.$bank.'&banknum='.$banknum.'&bankname='.$bankname.'&note='.$note);
        } else {
            $datainfo = $this->get_data_curl($this->config->item('api_backend').'?c=4077'.'&dl_id='.$dl_id.'&fullname='.$fullname.'&username='.$username.'&nickname='.$nickname.'&phone='.$phone.'&khuvuc='.$khuvuc.'&tele='.$tele.'&fb='.$fb.'&zalo='.$zalo.'&bank='.$bank.'&banknum='.$banknum.'&bankname='.$bankname.'&note='.$note);
        }

        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }
}
