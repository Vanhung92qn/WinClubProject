<?php

Class Confignew extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
       $this->load->model('gameconfig_model');
        //$this->load->model('logadmin_model');
    }

    function index()
    {

        $this->data['temp'] = 'admin/config/index';
        $this->load->view('admin/main', $this->data);
    }

    function add()
    {
        $this->data['temp'] = 'admin/config/add';
        $this->load->view('admin/main', $this->data);
    }
    function addconfigajax(){
        $value = urlencode($this->input->post('data'));
        $name = $this->input->post('name_config');
        $version = $this->input->post('version');
        $platform = $this->input->post('platform');
        $dataInfo =  $this->file_get_contents($this->config->item('api_backend') . '?c=602&gv=' . $value . '&gn=' . $name . '&v='. $version . '&pf='. $platform);
        if (isset($dataInfo)) {
            echo $dataInfo;
        } else {
            echo "Bạn không được hack";
        }


    }

    function edit()
    {
        $namecf = $this->uri->rsegment('3');
        $this->data['namecf'] = $namecf;
        $plat = $this->uri->rsegment('4');
        $this->data['plat'] = $plat;
        $id = $this->uri->rsegment('5');
        $this->data['id'] = $id;
        $this->data['temp'] = 'admin/config/testconfig';
        $this->load->view('admin/main', $this->data);
    }



    function listconfig()
    {
       // $list = $this->gameconfig_model->get_list_game_config();
      //  $this->data['list'] = $list;
        $this->data['temp'] = 'admin/config/listconfignew';
        $this->load->view('admin/main', $this->data);
    }

    function listconfigajax()
    {
        $datainfo = $this->file_get_contents($this->config->item('api_backend') . '?c=601&pf=' . "" . '&nm=' . "");
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function editajax()
    {
        $configpf = $this->input->post('configpf');
        $nmconfig = $this->input->post('nmconfig');

        $datainfo = $this->file_get_contents($this->config->item('api_backend') . '?c=601&pf=' . $configpf . '&nm=' . $nmconfig);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function successeditajax()
    {
        $admin_login = $this->session->userdata('user_id_login');
        $admin_info = $this->admin_model->get_info($admin_login);
        $idconfig = $this->input->post('idconfig');
        $valueconfig = urlencode($this->input->post('valueconfig'));
        $versionconfig = $this->input->post('versionconfig');
        $configpf = $this->input->post('configpf');

        $datainfo = $this->CallAPI("POST",$this->config->item('api_backend') . '?c=603&gid=' . $idconfig . '&gv=' . $valueconfig . '&v=' . $versionconfig . '&pf=' . $configpf);
        if (isset($datainfo)) {
            $data = array(
                'account_name' => $configpf,
                'username' => $admin_info->UserName,
                'action' => "Sửa config",
            );
            //$this->logadmin_model->create($data);
            echo $datainfo;

        } else {
            echo "Bạn không được hack";
        }
    }

    function configajax()
    {
        $datainfo = $this->file_get_contents($this->config->item('api_url') . '?c=7');
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }
}
