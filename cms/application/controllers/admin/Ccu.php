<?php
Class Ccu extends MY_Controller
{
    function __construct()
    {
        parent::__construct();

    }
    /*
     * Lay ra danh sach danh muc san pham
     */
    function index()
    {
        $this->data['temp'] = 'admin/ccu/index';
        $this->load->view('admin/main', $this->data);
    }
    function indexajax()
    {

        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $datainfo = $this->get_data_curl($this->config->item('api_backend').'?c=108&ts='.urlencode($fromDate).'&te='.urlencode($toDate));
        if(isset($datainfo)) {
            echo $datainfo;
        }else{
            echo "Bạn không được hack";
        }
    }
}
