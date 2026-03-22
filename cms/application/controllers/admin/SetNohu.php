<?php


class SetNohu extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('logadmin_model');
        $this->load->model('admin_model');
        $this->load->library('session');

    }

    function checknickname()
    {
        $nickname = $this->input->post('nickname');
        $optinfo = $this->curl->simple_get($this->config->item('api_backend') . '?c=716&nn=' . $nickname);
        if ($optinfo) {
            echo $optinfo;
        } else {
            echo "1001";
        }
    }
}