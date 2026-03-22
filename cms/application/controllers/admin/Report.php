<?php

class Report extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('logadmin_model');
        $this->load->model('admin_model');
        $this->load->library('session');

    }

    function index()
    {
    }

    function cashoutbybank()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $start_time = null;
        $end_time = null;
        if ($this->input->post('fromDate')) {
            $start_time = $this->input->post('fromDate');
        }

        if ($this->input->post('toDate')) {
            $end_time = $this->input->post('toDate');
        }

        if ($start_time === null) {
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/cashoutbybank';
        $this->load->view('admin/main', $this->data);
    }

    function cashoutbycardmanual()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $start_time = null;
        $end_time = null;
        if ($this->input->post('fromDate')) {
            $start_time = $this->input->post('fromDate');
        }

        if ($this->input->post('toDate')) {
            $end_time = $this->input->post('toDate');
        }

        if ($start_time === null) {
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/cashoutbycardmanual';
        $this->load->view('admin/main', $this->data);
    }

    function cashoutbycardmanualajax()
    {
        $bank = $this->input->post("bank");
        $nickname = urlencode($this->input->post("nickname"));
        $status = $this->input->post("status");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $pages = $this->input->post("pages");
        $tranid = urlencode($this->input->post("tranid"));
        $maxItem = $this->input->post("maxItem");
        $telCo = $this->input->post("telCo");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=113&nn=' . $nickname . '&st=' . $status . '&te=' . urlencode($toDate) . '&ts=' . urlencode($fromDate) . '&p=' . $pages . '&tid=' . $tranid . '&telco=' . $telCo . '&max_item=' . $maxItem);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function approvecashoutbycardajax()
    {

        $status = $this->input->post("type");
        $pin = $this->input->post("pin");
        $seri = $this->input->post("seri");
        $tranid = urlencode($this->input->post("transId"));

        $user = $this->session->userdata['usernameadmin'];
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=3706&uad=' . $user . '&st=' . $status . '&tid=' . $tranid . '&pin=' . $pin . '&seri=' . $seri);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function updatetrans()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $transId = null;
        if ($this->input->get('transId')) {
            $transId = $this->input->get('transId');
        }
        if ($transId == null)
            return;
        $this->data['transId'] = $transId;
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=112&tid=' . $transId . '&action=get');
        if (isset($datainfo)) {
            $this->data['dataTrans']['data'] = json_decode($datainfo, true);
        } else {
            return;
        }

        $this->data['temp'] = 'admin/report/updatetrans';
        $this->load->view('admin/main', $this->data);
    }

    function updatetranajax(){
        $status = $this->input->post("status");
        $type = urlencode($this->input->post("type"));
        $transId = $this->input->post("transId");
		if($status == 'sending' || $status == 'success'){
			$user = $this->session->userdata['usernameadmin'] . '-' . $this->input->post("user");
		} else {
			$user = $this->session->userdata['usernameadmin'];
		}
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=112&st=' . $status . '&tid=' . $transId . '&type=' . $type . '&action=update' . '&uad=' . $user);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }
	
	function updatetranajax2(){
        $status = $this->input->post("status");
        $type = urlencode($this->input->post("type"));
        $transId = $this->input->post("transId");
        //$user = $this->session->userdata['usernameadmin'];
		$user = $this->session->userdata['usernameadmin'] . '-' . $this->input->post("user");
		
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4044&st=' . $status . '&tid=' . $transId . '&type=' . $type . '&action=update' . '&uad=' . $user);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }
	
	function updatetranajax3(){
        $status = $this->input->post("status");
        $type = urlencode($this->input->post("type"));
        $transId = $this->input->post("transId");
        //$user = $this->session->userdata['usernameadmin'];
		$user = $this->session->userdata['usernameadmin'] . '-' . $this->input->post("user");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4045&st=' . $status . '&tid=' . $transId . '&type=' . $type . '&action=update' . '&uad=' . $user);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }
	
	function updatetranajax4(){
        $status = $this->input->post("status");
        $type = urlencode($this->input->post("type"));
        $transId = $this->input->post("transId");
        //$user = $this->session->userdata['usernameadmin'];
		$user = $this->session->userdata['usernameadmin'] . '-' . $this->input->post("user");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4048&st=' . $status . '&tid=' . $transId . '&type=' . $type . '&action=update' . '&uad=' . $user);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }
	
	function updatetranajax5(){
        $status = $this->input->post("status");
        $type = urlencode($this->input->post("type"));
        $transId = $this->input->post("transId");
        //$user = $this->session->userdata['usernameadmin'];
		$user = $this->session->userdata['usernameadmin'] . '-' . $this->input->post("user");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4049&st=' . $status . '&tid=' . $transId . '&type=' . $type . '&action=update' . '&uad=' . $user);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }
	
	function updatetranajax6(){
        $status = $this->input->post("status");
        $type = urlencode($this->input->post("type"));
        $transId = $this->input->post("transId");
        //$user = $this->session->userdata['usernameadmin'];
		$user = $this->session->userdata['usernameadmin'] . '-' . $this->input->post("user");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4050&st=' . $status . '&tid=' . $transId . '&type=' . $type . '&action=update' . '&uad=' . $user);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }
	
	function updatetranajax7(){
        $status = $this->input->post("status");
        $type = urlencode($this->input->post("type"));
        $transId = $this->input->post("transId");
        //$user = $this->session->userdata['usernameadmin'];
		$user = $this->session->userdata['usernameadmin'] . '-' . $this->input->post("user");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4051&st=' . $status . '&tid=' . $transId . '&type=' . $type . '&action=update' . '&uad=' . $user);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }
	
	function updatetranajax8(){
        $status = $this->input->post("status");
        $type = urlencode($this->input->post("type"));
        $transId = $this->input->post("transId");
        //$user = $this->session->userdata['usernameadmin'];
		$user = $this->session->userdata['usernameadmin'] . '-' . $this->input->post("user");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4052&st=' . $status . '&tid=' . $transId . '&type=' . $type . '&action=update' . '&uad=' . $user);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }
	
	function updatetranajax9(){
        $status = $this->input->post("status");
        $type = urlencode($this->input->post("type"));
        $transId = $this->input->post("transId");
        //$user = $this->session->userdata['usernameadmin'];
		$user = $this->session->userdata['usernameadmin'] . '-' . $this->input->post("user");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4053&st=' . $status . '&tid=' . $transId . '&type=' . $type . '&action=update' . '&uad=' . $user);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }
	
	function updatetranajax10(){
        $status = $this->input->post("status");
        $type = urlencode($this->input->post("type"));
        $transId = $this->input->post("transId");
        //$user = $this->session->userdata['usernameadmin'];
		$user = $this->session->userdata['usernameadmin'] . '-' . $this->input->post("user");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4054&st=' . $status . '&tid=' . $transId . '&type=' . $type . '&action=update' . '&uad=' . $user);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }
	
	

    function cashoutbybankajax()
    {
        $bank = $this->input->post("bank");
        $nickname = urlencode($this->input->post("nickname"));
        $status = $this->input->post("status");
        $bankNumber = $this->input->post("bankNumber");
        $bankAccountName = $this->input->post("bankAccountName");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $pages = $this->input->post("pages");
        $maxItem = $this->input->post("maxItem");
        $tranid = urlencode($this->input->post("tranid"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=112&nn=' . $nickname . '&b=' . $bank . '&st=' . $status . '&te=' . urlencode($toDate) . '&ts=' . urlencode($fromDate) . '&p=' . $pages . '&tid=' . $tranid . '&action=getList' . '&max_item=' . $maxItem. '&bankNumber=' . $bankNumber);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function cashoutbybankExportajax()
    {
        $bank = $this->input->post("bank");
        $nickname = urlencode($this->input->post("nickname"));
        $status = $this->input->post("status");
        $bankNumber = $this->input->post("bankNumber");
        $bankAccountName = $this->input->post("bankAccountName");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $tranid = urlencode($this->input->post("tranid"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=1121&nn=' . $nickname . '&b=' . $bank . '&st=' . $status . '&te=' . urlencode($toDate) . '&ts=' . urlencode($fromDate) . '&tid=' . $tranid . '&action=getList');
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    //start cashout by momo
    function cashoutbymomo()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $start_time = null;
        $end_time = null;
        if ($this->input->post('fromDate')) {
            $start_time = $this->input->post('fromDate');
        }

        if ($this->input->post('toDate')) {
            $end_time = $this->input->post('toDate');
        }

        if ($start_time === null) {
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/cashoutbymomo';
        $this->load->view('admin/main', $this->data);
    }

    function updatetransmomo()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $transId = null;
        if ($this->input->get('transId')) {
            $transId = $this->input->get('transId');
        }
        if ($transId == null)
            return;
        $this->data['transId'] = $transId;
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=1122&tid=' . $transId . '&action=get');
        if (isset($datainfo)) {
            $this->data['dataTrans']['data'] = json_decode($datainfo, true);
        } else {
            return;
        }

        $this->data['temp'] = 'admin/report/updatetransmomo';
        $this->load->view('admin/main', $this->data);
    }

    function updatetranmomoajax()
    {
        $status = $this->input->post("status");
        $transId = $this->input->post("transId");
        $user = $this->session->userdata['usernameadmin'];
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=1122&st=' . $status . '&tid=' . $transId . '&action=update&uad=' . $user);
        echo $datainfo;

    }

    function cashoutbymomoajax()
    {
        $bank = $this->input->post("bank");
        $nickname = urlencode($this->input->post("nickname"));
        $status = $this->input->post("status");
        $bankNumber = $this->input->post("bankNumber");
        $bankAccountName = $this->input->post("bankAccountName");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $pages = $this->input->post("pages");
        $tranid = urlencode($this->input->post("tranid"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=1122&nn=' . $nickname . '&b=' . $bank . '&st=' . $status . '&te=' . urlencode($toDate) . '&ts=' . urlencode($fromDate) . '&p=' . $pages . '&tid=' . $tranid . '&action=getList');
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }


    //end cashout by momo


    function cashoutbycard()
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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/cashoutbycard';
        $this->load->view('admin/main', $this->data);
    }

    function cashoutbycardajax()
    {
        $provider = $this->input->post("provider");
        $nickname = urlencode($this->input->post("nickname"));
        $serial = urlencode($this->input->post("serial"));
        $status = $this->input->post("status");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $pages = $this->input->post("pages");
        $partner = $this->input->post("partner");
        $tranid = urlencode($this->input->post("tranid"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=113&nn=' . $nickname . '&pv=' . $provider . '&sp=' . $serial . '&co=' . $status . '&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate) . '&p=' . $pages . '&tid=' . $tranid . '&pa=' . $partner);

        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }

    }

    function cashoutbytopup()
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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/cashoutbytopup';
        $this->load->view('admin/main', $this->data);
    }

    function cashoutbytopupajax()
    {
        $mobile = urlencode($this->input->post("mobile"));
        $nickname = urlencode($this->input->post("nickname"));
        $status = $this->input->post("status");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $pages = $this->input->post("pages");
        $tranid = urlencode($this->input->post("tranid"));
        $partner = $this->input->post("partner");
        $type = $this->input->post("type");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=114&nn=' . $nickname . '&tg=' . $mobile . '&st=' . "" . '&co=' . $status . '&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate) . '&p=' . $pages . '&tid=' . $tranid . '&pa=' . $partner . '&type=' . $type);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function rechargebyvincard()
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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/rechargebyvincard';
        $this->load->view('admin/main', $this->data);
    }

    function rechargebyvincardajax()
    {

        $nickname = urlencode($this->input->post("nickname"));
        $serial = urlencode($this->input->post("serial"));
        $mathe = urlencode($this->input->post("mathe"));
        $status = $this->input->post("status");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $pages = $this->input->post("pages");
        $tranid = urlencode($this->input->post("tranid"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=500&nn=' . $nickname . '&pv=&sr=' . $serial . '&pn=' . $mathe . '&co=' . $status . '&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate) . '&p=' . $pages . '&tid=' . $tranid);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }

    }

    function rechargebycard()
    {


        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $start_time = null;
        $end_time = null;
        if ($this->input->post('fromDate')) {
            $start_time = $this->input->post('fromDate');
        }

        if ($this->input->post('toDate')) {
            $end_time = $this->input->post('toDate');
        }

        if ($start_time === null) {
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/rechargebycard';
        $this->load->view('admin/main', $this->data);
    }


    function rechargebycardajax()
    {
        $provider = $this->input->post("provider");
        $nickname = urlencode($this->input->post("nickname"));
        $serial = urlencode($this->input->post("serial"));
        $mathe = urlencode($this->input->post("mathe"));
        $status = $this->input->post("status");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $pages = $this->input->post("pages");
        $tranid = urlencode($this->input->post("tranid"));
        $pageSize = $this->input->post("pageSize"); 
        $datainfo = $this->curl->simple_get($this->config->item('api_backend') . '?c=115&nn=' . $nickname . '&pv=' . $provider . '&sr=' . $serial . '&pn=' . $mathe . '&co=' . $status . '&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate) . '&p=' . $pages . '&pageSize=' . $pageSize . '&tid=' . $tranid . $this->getAuthBackend());
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }

    }


    function updatecard()
    {
        $rid = $this->input->post("rid");
        if ($rid == "") {
            $rid = $this->input->get("rid");
        }
        $nickname = $this->input->post("nickname");
        if ($nickname == "") {
            $nickname = $this->input->get("nickname");
        }
        //echo $rid . "---" . $nickname;die();
        $admin_login = $this->session->userdata('user_id_login');
        $admin_info = $this->admin_model->get_info($admin_login);
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=141&rid=' . $rid . '&act=' . $admin_info->FullName);

        $data1 = json_decode($datainfo);
        //var_dump($data1);die();
        if ($data1 != NULL && isset($datainfo)) {
            if ($data1->errorCode == 0) {
                $data = array(
                    'account_name' => $nickname,
                    'username' => $admin_info->UserName,
                    'action' => "Cập nhật thẻ pendding, mã giao dịch:  " . $rid,

                );
                $this->logadmin_model->create($data);
            }
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function doisoatthe()
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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/doisoatthe';
        $this->load->view('admin/main', $this->data);
    }

    function doisoattheajax()
    {

        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $provider = $this->input->post("provider");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=161&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate) . '&cr=' . $provider);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }

    }

    function rechargebybank()
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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/rechargebybank';
        $this->load->view('admin/main', $this->data);
    }

    function rechargebycodepay()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $start_time = null;
        $end_time = null;
        if ($this->input->post('fromDate')) {
            $start_time = $this->input->post('fromDate');
        }

        if ($this->input->post('toDate')) {
            $end_time = $this->input->post('toDate');
        }

        if ($start_time === null) {
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/rechargebycodepay';
        $this->load->view('admin/main', $this->data);
    }

    function rechargebymomo2()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $start_time = null;
        $end_time = null;
        if ($this->input->post('fromDate')) {
            $start_time = $this->input->post('fromDate');
        }

        if ($this->input->post('toDate')) {
            $end_time = $this->input->post('toDate');
        }

        if ($start_time === null) {
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/rechargebymomo2';
        $this->load->view('admin/main', $this->data);
    }

    function statistical()
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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/statistical';
        $this->load->view('admin/main', $this->data);
    }

    function statisticalajax()
    {
        $nickname = urlencode($this->input->post("nickname"));
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $type = urlencode($this->input->post("type"));
        $datainfo = $this->curl->simple_get($this->config->item('api_backend') . '?c=2003&nn=' . $nickname . '&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate) . '&type=' . $type);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }

    }

    function removedbmongo()
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
            $start_time = date('Y-m-d', strtotime('-90 days'));
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s', strtotime('-30 days'));
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/removedbmongo';
        $this->load->view('admin/main', $this->data);
    }

    function removedbMongoajax()
    {
        $name_db = $this->input->post("name_db");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $created_at = $this->input->post("created_at");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4015&db=' . $name_db . '&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate) . '&type=' . $created_at);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    

    // todo : onepay
    function rechargebyonepay()
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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/rechargebyonepay';
        $this->load->view('admin/main', $this->data);
    }
	
	function rechargebyonepayauto()
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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/rechargebyonepayauto';
        $this->load->view('admin/main', $this->data);
    }

    // todo : ajax - onepay
    function rechargebyonepayajax()
    {
        $txtvinplay = urlencode($this->input->post("txtvinplay"));
        $nickname = urlencode($this->input->post("nickname"));
        $txtip = urlencode($this->input->post("txtip"));
        $bank = $this->input->post("bank");
        $status = $this->input->post("status");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $maxItem = $this->input->post("maxItem");
        $pages = $this->input->post("pages");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=889&nn=' . $nickname . '&tid=' . $txtvinplay . '&ip=' . $txtip . '&b=' . $bank . '&st=' . $status . '&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate) . '&tno=' . "" . '&p=' . $pages . '&max_item=' . $maxItem);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function updatedepositonepaymanual()
    {
        $transId = urlencode($this->input->post("transId"));
        $type = urlencode($this->input->post("type"));
        $username = urlencode($this->input->post("username"));
        $user = $this->session->userdata['usernameadmin'];
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=888&transId=' . $transId . '&type=' . $type . '&uad=' . $user . '&username=' . $username);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function updatemaGdTechcombankdepositonepaymanual()
    {
        $transId = urlencode($this->input->post("transId"));
        $type = urlencode($this->input->post("type"));
        $user = $this->session->userdata['usernameadmin'];
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=890&transId=' . $transId . '&type=' . $type . '&uad=' . $user);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function rechargebymomo()
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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/rechargebymomo';
        $this->load->view('admin/main', $this->data);
    }

    function listuserfromdaily()
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
            $start_time = date('Y-m-d', strtotime('-7 days'));
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;

        // // leon todo get list daily
        // $input2['where'] = array("parentid" => -1, "active" => 1,"status"=>'D');
        // $listdaily = $this->useragent_model->get_list($input2);
        // $this->data['listdaily'] = $listdaily;
        // // END: leon todo get list daily


        $this->data['temp'] = 'admin/report/listuserfromdaily';
        $this->load->view('admin/main', $this->data);
    }

    function listuserfromdailyajax()
    {
        $codeDaily = urlencode($this->input->post("codeDaily"));
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4010&dl=' . $codeDaily . '&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate));
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function rechargebyautocard()
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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/rechargebyautocard';
        $this->load->view('admin/main', $this->data);
    }

    function rechargebyautocardajax()
    {
        $txtvinplay = urlencode($this->input->post("txtvinplay"));
        $nickname = urlencode($this->input->post("nickname"));
        $txtip = urlencode($this->input->post("txtip"));
        $sendFrom = $this->input->post("sendFrom");
        $status = $this->input->post("status");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $maxItem = $this->input->post("maxItem");
        $pages = $this->input->post("pages");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=987&nn=' . $nickname . '&tid=' . $txtvinplay . '&ip=' . $txtip . '&sendFrom=' . $sendFrom . '&st=' . $status . '&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate) . '&tno=' . "" . '&p=' . $pages . '&max_item=' . $maxItem);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }

    }

    function rechargebymomoajax()
    {
        $txtvinplay = urlencode($this->input->post("txtvinplay"));
        $nickname = urlencode($this->input->post("nickname"));
        $txtip = urlencode($this->input->post("txtip"));
        $sendFrom = $this->input->post("sendFrom");
        $status = $this->input->post("status");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $maxItem = $this->input->post("maxItem");
        $pages = $this->input->post("pages");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=787&nn=' . $nickname . '&tid=' . $txtvinplay . '&ip=' . $txtip . '&sendFrom=' . $sendFrom . '&st=' . $status . '&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate) . '&tno=' . "" . '&p=' . $pages . '&max_item=' . $maxItem);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }


    function rechargebybankajax()
    {
        $txtvinplay = urlencode($this->input->post("txtvinplay"));
        $nickname = urlencode($this->input->post("nickname"));
        $txtip = urlencode($this->input->post("txtip"));
        $bank = $this->input->post("bank");
        $status = $this->input->post("status");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $maxItem = $this->input->post("maxItem");
        $codepay = $this->input->post("codepay");
        $pages = $this->input->post("pages");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=720&nn=' . $nickname . '&tid=' . $txtvinplay . '&ip=' . $txtip . '&codepay=' . $codepay . '&b=' . $bank . '&st=' . $status . '&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate) . '&tno=' . "" . '&p=' . $pages .  '&max_item=' . $maxItem);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }

    }

    function rechargebycodepayajax()
    {
        $txtvinplay = urlencode($this->input->post("txtvinplay"));
        $nickname = urlencode($this->input->post("nickname"));
        $txtip = urlencode($this->input->post("txtip"));
        $bank = $this->input->post("bank");
        $status = $this->input->post("status");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $maxItem = $this->input->post("maxItem");
        $pages = $this->input->post("pages");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4034&nn=' . $nickname . '&tid=' . $txtvinplay . '&ip=' . $txtip . '&b=' . $bank . '&st=' . $status . '&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate) . '&tno=' . "" . '&p=' . $pages .  '&max_item=' . $maxItem);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function rechargebymomo2ajax()
    {
        $txtvinplay = urlencode($this->input->post("txtvinplay"));
        $nickname = urlencode($this->input->post("nickname"));
        $txtip = urlencode($this->input->post("txtip"));
        $bank = $this->input->post("bank");
        $status = $this->input->post("status");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $maxItem = $this->input->post("maxItem");
        $pages = $this->input->post("pages");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4035&nn=' . $nickname . '&tid=' . $txtvinplay . '&ip=' . $txtip . '&b=' . $bank . '&st=' . $status . '&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate) . '&tno=' . "" . '&p=' . $pages .  '&max_item=' . $maxItem);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function rechargebybankExportajax()
    {
        $txtvinplay = urlencode($this->input->post("txtvinplay"));
        $nickname = urlencode($this->input->post("nickname"));
        $txtip = urlencode($this->input->post("txtip"));
        $bank = $this->input->post("bank");
        $status = $this->input->post("status");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=7201&nn=' . $nickname . '&tid=' . $txtvinplay . '&b=' . $bank . '&st=' . $status . '&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate));
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }

    }

    function updatedepositbankmanual()
    {
        $transId = urlencode($this->input->post("transId"));    
        $type = urlencode($this->input->post("type"));
		$tien = urlencode($this->input->post("money"));
        $user = $this->session->userdata['usernameadmin'];
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=788&transId=' . $transId . '&type=' . $type. '&tien=' . $tien . '&uad=' . $user);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function updatedepositmomosunvinmanual()
    {
        $transId = urlencode($this->input->post("transId"));
        $type = urlencode($this->input->post("type"));
        $user = $this->session->userdata['usernameadmin'];
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4033&transId=' . $transId . '&type=' . $type . '&uad=' . $user);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function updatedepositcodepaymanual()
    {
        $transId = urlencode($this->input->post("transId"));
        $type = urlencode($this->input->post("type"));
        $money = urlencode($this->input->post("money"));
        $user = $this->session->userdata['usernameadmin'];
        if(empty($money)) {
            echo "Bạn không được hack";
        } else {
            $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=788&transId=' . $transId . '&tien='. $money . '&type=' . $type . '&uad=' . $user);
            if (isset($datainfo)) {
                echo $datainfo;
            } else {
                echo "Bạn không được hack";
            }
        }
      
    }

    function updatedepositautoCard()
    {
        $transId = urlencode($this->input->post("transId"));
        $type = urlencode($this->input->post("type"));
        $user = $this->session->userdata['usernameadmin'];
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=989&transId=' . $transId . '&type=' . $type . '&uad=' . $user);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function updatedepositmomomanual()
    {
        $transId = ($this->input->post("transId"));
        $type = urlencode($this->input->post("type"));
        $tien = urlencode($this->input->post("money"));
        $user = $this->session->userdata['usernameadmin'];
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=789&transId=' . $transId . '&type=' . $type . '&uad=' . $user.'&tien='.$tien);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function rechargebynganluong()
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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/rechargebynganluong';
        $this->load->view('admin/main', $this->data);
    }

    function rechargebynganluongajax()
    {
        $txtvinplay = urlencode($this->input->post("txtvinplay"));
        $nickname = urlencode($this->input->post("nickname"));
        $txtip = urlencode($this->input->post("txtip"));
        $bank = $this->input->post("bank");
        $status = $this->input->post("status");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $pages = $this->input->post("pages");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=721&nn=' . $nickname . '&tid=' . $txtvinplay . '&ip=' . $txtip . '&b=' . $bank . '&st=' . $status . '&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate) . '&tno=' . "" . '&p=' . $pages);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }

    }

    function logsmsotp()
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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/logsmsotp';
        $this->load->view('admin/main', $this->data);
    }

    function logsmsotpajax()
    {
        $mobile = urlencode($this->input->post("mobile"));
        $toDate = $this->input->post("toDate") + " 23:59:59";
        $fromDate = $this->input->post("fromDate") + " 00:00:00";
        $pages = $this->input->post("pages");
        $tranid = urlencode($this->input->post("tranid"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=722&m=' . $mobile . '&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate) . '&p=' . $pages . '&rid=' . $tranid);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function logbrandname()
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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/logbrandname';
        $this->load->view('admin/main', $this->data);
    }

    function logbrandnameajax()
    {
        $mobile = urlencode($this->input->post("mobile"));
        $status = $this->input->post("status");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $pages = $this->input->post("pages");
        $tranid = urlencode($this->input->post("tranid"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=719&m=' . $mobile . '&co=' . "" . '&st=' . $status . '&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate) . '&p=' . $pages . '&rid=' . $tranid);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function moneysystem()
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
            $start_time = date('Y-m-d');;
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/moneysystem';
        $this->load->view('admin/main', $this->data);
    }

    function moneysystemnew()
    {

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $start_time = null;
        $end_time = null;
        $nickName = "";
        if ($this->input->post('fromDate')) {
            $start_time = $this->input->post('fromDate');
        }

        if ($this->input->post('toDate')) {
            $end_time = $this->input->post('toDate');
        }
        if ($this->input->post('nickName')) {
            $nickName = $this->input->post('nickName');
        }

        if ($start_time === null) {
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }

        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['nickName'] = $nickName;
        $this->data['temp'] = 'admin/report/moneysystemnew';
        $this->load->view('admin/main', $this->data);
    }

    function moneysystemajax()
    {
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $nickName = $this->input->post("nickName");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=71&startTime=' . urlencode($fromDate) . '&endTime=' . urlencode($toDate) . "&nickname=" . $nickName);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function moneyuser()
    {
        $this->data['temp'] = 'admin/report/moneyuser';
        $this->load->view('admin/main', $this->data);
    }

    function moneyuserajax()
    {
        $nickname = urlencode($this->input->post("nickname"));
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=8&nn=' . $nickname . '&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate));
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }
	
	function deletelogjax()
    {
        $nickname = urlencode($this->input->post("nickname"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4047&nickname=' . $nickname);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function moneytotal()
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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/moneytotal';
        $this->load->view('admin/main', $this->data);
    }

    function moneytotalajax()
    {
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $pages = $this->input->post("pages");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=9&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate) . '&p=' . $pages);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }

    }

    function topnaptien()
    {
        $this->data['temp'] = 'admin/report/topnaptien';
        $this->load->view('admin/main', $this->data);
    }

    function chartmoneytotal()
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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/chartmoneytotal';
        $this->load->view('admin/main', $this->data);
    }

    function chartmoneyagent()
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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/chartmoneyagent';
        $this->load->view('admin/main', $this->data);
    }

    function chartmoneytotalajax()
    {
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $pages = $this->input->post("pages");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=9&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate) . '&p=' . $pages);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }

    }

    function rechargebyiap()
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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/rechargebyiap';
        $this->load->view('admin/main', $this->data);
    }

    function rechargebyiapajax()
    {
        $provider = $this->input->post("provider");
        $nickname = urlencode($this->input->post("nickname"));
        $txtoderid = urlencode($this->input->post("txtoderid"));
        $status = $this->input->post("status");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $pages = $this->input->post("pages");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=124&nn=' . $nickname . '&am=' . $provider . '&oid=' . $txtoderid . '&co=' . $status . '&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate) . '&p=' . $pages);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function rechargeby9029()
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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/rechargeby9029';
        $this->load->view('admin/main', $this->data);
    }

    function rechargeby9029ajax()
    {
        $nickname = urlencode($this->input->post("nickname"));
        $mobile = urlencode($this->input->post("mobile"));
        $amout = $this->input->post("amout");
        $rid = urlencode($this->input->post("rid"));
        $status = urlencode($this->input->post("status"));
        $toDate = urlencode($this->input->post("toDate"));
        $fromDate = urlencode($this->input->post("fromDate"));
        $pages = $this->input->post("pages");

        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=315&nn=' . $nickname . '&m=' . $mobile . '&am=' . $amout . '&rid=' . $rid . '&co=' . $status . '&ts=' . $toDate . '&te=' . $fromDate . '&p=' . $pages);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function rechargeby8x98()
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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/rechargeby8x98';
        $this->load->view('admin/main', $this->data);
    }

    function rechargeby8x98ajax()
    {
        $nickname = urlencode($this->input->post("nickname"));
        $mobile = urlencode($this->input->post("mobile"));
        $amout = $this->input->post("amout");
        $rid = urlencode($this->input->post("rid"));
        $status = urlencode($this->input->post("status"));
        $toDate = urlencode($this->input->post("toDate"));
        $fromDate = urlencode($this->input->post("fromDate"));
        $pages = $this->input->post("pages");
        $shortcode = $this->input->post("shortcode");

        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=314&nn=' . $nickname . '&m=' . $mobile . '&am=' . $amout . '&sc=' . $shortcode . '&rid=' . $rid . '&co=' . $status . '&ts=' . $toDate . '&te=' . $fromDate . '&p=' . $pages);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function checkmo9029()
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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/checkmo9029';
        $this->load->view('admin/main', $this->data);
    }

    function checkmo9029ajax()
    {
        $mobile = urlencode($this->input->post("mobile"));
        $amout = $this->input->post("amout");
        $status = urlencode($this->input->post("status"));
        $toDate = urlencode($this->input->post("toDate"));
        $fromDate = urlencode($this->input->post("fromDate"));
        $pages = $this->input->post("pages");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=316&m=' . $mobile . '&am=' . $amout . '&co=' . $status . '&ts=' . $toDate . '&te=' . $fromDate . '&p=' . $pages);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function money()
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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/money';
        $this->load->view('admin/main', $this->data);
    }


    function reportupdatecard()
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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/reportupdatecard';
        $this->load->view('admin/main', $this->data);
    }


    function reportupdatecardajax()
    {
        $provider = $this->input->post("provider");
        $nickname = urlencode($this->input->post("nickname"));
        $serial = urlencode($this->input->post("serial"));
        $mathe = urlencode($this->input->post("mathe"));
        $status = $this->input->post("status");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $pages = $this->input->post("pages");
        $tranid = urlencode($this->input->post("tranid"));
        $txtnickname = urlencode($this->input->post("txtnickname"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=510&nn=' . $nickname . '&pv=' . $provider . '&sr=' . $serial . '&pn=' . $mathe . '&co=' . $status . '&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate) . '&p=' . $pages . '&rid=' . $tranid . '&act=' . $txtnickname);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }

    }


    function doisoatnganluong()
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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/doisoatnganluong';
        $this->load->view('admin/main', $this->data);
    }

    function doisoatnganluongajax()
    {

        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=511&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate));
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }

    }

    function doisoatvmg()
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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/doisoatvmg';
        $this->load->view('admin/main', $this->data);
    }

    function doisoatvmgajax()
    {

        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=18&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate));
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }

    }

    function exportvmg()

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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->load->library('PHPExcel');
        $objPHPExcel = new PHPExcel();
        $BStyle = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('E5:K5')
            ->setCellValue('E5', 'SỐ LƯỢNG BẢN TIN')
            ->mergeCells('L5:O5')
            ->setCellValue('L5', 'DOANH THU PHÂN CHIA')
            ->getStyle('E5:O5')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('C6', 'Đầu số')
            ->setCellValue('D6', 'Nhà cung cấp')
            ->setCellValue('E6', 'Yêu cầu (MO)')
            ->setCellValue('F6', 'Phản hồi (MT)')
            ->setCellValue('G6', 'Tính cước (CDR)')
            ->setCellValue('H6', 'Tỷ lệ sau khi trừ thất thoát')
            ->setCellValue('I6', 'Số tin MT cho phép/1 MO')
            ->setCellValue('K6', 'Giới hạn MT')
            ->setCellValue('L6', 'Chênh lệch MT')
            ->setCellValue('M6', 'Đơn giá')
            ->setCellValue('N6', 'Số tiền MT vượt phải thanh toán  ')
            ->setCellValue('O6', 'Doanh thu dùng để phân chia')
            ->getStyle('C6:O6')->applyFromArray($BStyle);
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=18&ts=' . urlencode($start_time) . '&te=' . urlencode($end_time));
        $data = json_decode($datainfo);
        //var_dump($data->providers);die();
        $i = 7;
        foreach ($data->providers as $row) {
            if ($i < 12) {
                $objPHPExcel->setActiveSheetIndex()
                    ->setCellValue('C' . $i, 8079)
                    ->getStyle('C' . $i)->applyFromArray($BStyle);

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('D' . $i, $this->getprovidervmg($row->id))
                    ->getStyle('D' . $i)->applyFromArray($BStyle);
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('E' . $i, $row->mo)
                    ->getStyle('E' . $i)->applyFromArray($BStyle)
                    ->getNumberFormat()->setFormatCode('#,##0');
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('F' . $i, $row->mt)
                    ->getStyle('F' . $i)->applyFromArray($BStyle)
                    ->getNumberFormat()->setFormatCode('#,##0');
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('G' . $i, $row->sms)
                    ->getStyle('G' . $i)->applyFromArray($BStyle)
                    ->getNumberFormat()->setFormatCode('#,##0');
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('H' . $i, 1)
                    ->getStyle('H' . $i)->applyFromArray($BStyle)
                    ->getNumberFormat()->applyFromArray(
                        array(
                            'code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE
                        )
                    );


                $i++;
            }
        }
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('I7', 1)
            ->setCellValue('I8', 2)
            ->setCellValue('I9', 2)
            ->setCellValue('I10', 1)
            ->setCellValue('I11', 0)
            ->getStyle('I7:I11')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('J7', '=IF(D7="VMS",E7*I7-E7,IF(D7="VNP",E7*I7-E7,IF(D7="VNM",E7*I7-E7,IF(D7="VIETTEL",E7*I7,0))))')
            ->setCellValue('J8', '=IF(D8="VMS",E8*I8-E8,IF(D8="VNP",E8*I8-E8,IF(D8="VNM",E8*I8-E8,IF(D8="VIETTEL",E8*I8,0))))')
            ->setCellValue('J9', '=IF(D9="VMS",E9*I9-E9,IF(D9="VNP",E9*I9-E9,IF(D9="VNM",E9*I9-E9,IF(D9="VIETTEL",E9*I9,0))))')
            ->setCellValue('J10', '=IF(D10="VMS",E10*I10-E10,IF(D10="VNP",E10*I10-E10,IF(D10="VNM",E10*I10-E10,IF(D10="VIETTEL",E10*I10,0))))')
            ->setCellValue('J11', '=IF(D11="VMS",E11*I11-E11,IF(D11="VNP",E11*I11-E11,IF(D11="VNM",E11*I11-E11,IF(D11="VIETTEL",E11*I11,0))))')
            ->getStyle('J7:J11')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('K7', '=IF(F7>E7,F7-E7,0)')
            ->setCellValue('K8', '=IF(F8>E8,F8-E8,0)')
            ->setCellValue('K9', '=IF(F9>E9,F9-E9,0)')
            ->setCellValue('K10', '=IF(F10>E10,F10-E10,0)')
            ->setCellValue('K11', '=IF(F11>E11,F11-E11,0)')
            ->getStyle('K7:K11')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('L7', 236)
            ->setCellValue('L8', 191)
            ->setCellValue('L9', 191)
            ->setCellValue('L10', 236)
            ->setCellValue('L11', 104)
            ->getStyle('L7:L11')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('M7', '=IF(D7="VIETTEL",545,IF(D7="VMS",318,IF(D7="VNP",455,IF(D7="VNM",455,181))))')
            ->setCellValue('M8', '=IF(D8="VIETTEL",545,IF(D8="VMS",318,IF(D8="VNP",455,IF(D8="VNM",455,181))))')
            ->setCellValue('M9', '=IF(D9="VIETTEL",545,IF(D9="VMS",318,IF(D9="VNP",455,IF(D9="VNM",455,181))))')
            ->setCellValue('M10', '=IF(D10="VIETTEL",545,IF(D10="VMS",318,IF(D10="VNP",455,IF(D10="VNM",455,181))))')
            ->setCellValue('M11', '=IF(D11="VIETTEL",545,IF(D11="VMS",318,IF(D11="VNP",455,IF(D11="VNM",455,181))))')
            ->getStyle('M7:M11')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('N7', '=IF(K7>J7,(K7-J7)*M7+J7*91,K7*91)')
            ->setCellValue('N8', '=IF(K8>J8,(K8-J8)*M8+J8*91,K8*91)')
            ->setCellValue('N9', '=IF(K9>J9,(K9-J9)*M9+J9*91,K9*91)')
            ->setCellValue('N10', '=IF(K10>J10,(K10-J10)*M10+J10*91,K10*91)')
            ->setCellValue('N11', '=IF(K11>J11,(K11-J11)*M11+J11*91,K11*91)')
            ->getStyle('N7:N11')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('O7', '=L7*G7*H7')
            ->setCellValue('O8', '=L8*G8*H8')
            ->setCellValue('O9', '=L9*G9*H9')
            ->setCellValue('O10', '=L10*G10*H10')
            ->setCellValue('O11', '=L11*G11*H11')
            ->getStyle('O7:O11')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->getStyle('I7:I11')
            ->getNumberFormat()
            ->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->getStyle('J7:J11')
            ->getNumberFormat()
            ->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->getStyle('K7:K11')
            ->getNumberFormat()
            ->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->getStyle('L7:L11')
            ->getNumberFormat()
            ->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->getStyle('M7:M11')
            ->getNumberFormat()
            ->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->getStyle('N7:N11')
            ->getNumberFormat()
            ->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->getStyle('O7:O11')
            ->getNumberFormat()
            ->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('C12:D12')
            ->setCellValue('C12', 'Tổng cộng')
            ->setCellValue('E12', '=SUM(E7:E11)')
            ->setCellValue('F12', '=SUM(F7:F11)')
            ->setCellValue('G12', '=SUM(G7:G11)')
            ->setCellValue('J12', '=SUM(J7:J11)')
            ->setCellValue('K12', '=SUM(K7:K11)')
            ->setCellValue('N12', '=SUM(N7:N11)')
            ->setCellValue('O12', '=SUM(O7:O11)')
            ->getStyle('C12:O12')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->getStyle('C12:O12')
            ->getNumberFormat()
            ->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('C13:N13')
            ->setCellValue('C13', 'Doanh thu Công ty win123Club được hưởng (87%)')
            ->getStyle('C13:N13')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('C14:N14')
            ->setCellValue('C14', 'Doanh thu VMG được hưởng')
            ->getStyle('C14:N14')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('C15:N15')
            ->setCellValue('C15', 'Doanh thu tối thiểu win123Club phải trả VMG: 2.000.000đ/tháng')
            ->getStyle('C15:N15')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('C16:N16')
            ->setCellValue('C16', 'Số tiền  MT vượt win123Club phải thanh toán')
            ->getStyle('C16:N16')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('C17:N17')
            ->setCellValue('C17', 'Phí command code đăng ký trên mạng Viettel: 1 mã x 2000đ')
            ->getStyle('C17:N17')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('C18:N18')
            ->setCellValue('C18', 'Doanh thu quyết toán - Công ty win123Club được hưởng sau khi trừ các chi phí')
            ->getStyle('C18:N18')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('C19:N19')
            ->setCellValue('C19', 'Số tiền đã tạm tính')
            ->getStyle('C19:N19')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('C20:N20')
            ->setCellValue('C20', 'Doanh thu còn lại win123Club được hưởng:')
            ->getStyle('C20:N20')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('C21:N21')
            ->setCellValue('C21', 'Thuế VAT 10%')
            ->getStyle('C21:N21')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('C22:N22')
            ->setCellValue('C22', 'Tổng cộng sau thuế')
            ->getStyle('C22:N22')->applyFromArray($BStyle);

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('O13', "=IF(O12<200000000,O12*87%,IF(O12<500000000,O12*89%,IF(O12<1000000001,O12*91%,O12*93%)))")
            ->setCellValue('O14', '=O12-O13')
            ->setCellValue('O15', '=1*2000000')
            ->setCellValue('O16', '=N12')
            ->setCellValue('O17', '=3*2000/1.1')
            ->setCellValue('O18', '=IF(O14>O15,O13-O16-O17,O12-O15-O16-O17)')
            ->setCellValue('O19', 0)
            ->setCellValue('O20', '=O18-O19')
            ->setCellValue('O21', '=ROUND(O20*10%,0)')
            ->setCellValue('O22', '=O20+O21')
            ->getStyle('O13:O22')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->getStyle('O13:O22')
            ->getNumberFormat()
            ->setFormatCode('#,##0');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="doisoatvmg.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');


        // var_dump($data);

    }

    function getprovidervmg($pro)
    {
        $str = "";
        if ($pro == 0) {
            $str = "VIETTEL";
        } else if ($pro == 1) {
            $str = "VNP";
        } else if ($pro == 2) {
            $str = "VMS";
        } else if ($pro == 3) {
            $str = "VNM";

        } else if ($pro == 4) {
            $str = "GTEL";
        }
        return $str;
    }


    function doisoatbrandname()
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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/doisoatbrandname';
        $this->load->view('admin/main', $this->data);
    }

    function doisoatbrandnameajax()
    {

        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=19&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate));
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }

    }


    function exportbrandname()

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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->load->library('PHPExcel');
        $objPHPExcel = new PHPExcel();
        $BStyle = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B6', 'STT')
            ->mergeCells('C6:D6')
            ->setCellValue('C6', 'Nội dung')
            ->setCellValue('E6', 'Số lượng')
            ->setCellValue('F6', 'Đơn giá')
            ->setCellValue('G6', 'Số tiền')
            ->getStyle('B6:G6')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B7', 'I')
            ->mergeCells('C7:D7')
            ->setCellValue('C7', 'SMS Chăm sóc khách hàng')
            ->setCellValue('E7', '')
            ->setCellValue('F7', '')
            ->setCellValue('G7', '')
            ->getStyle('B7:G7')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('F8', 150000)
            ->getStyle('F8')->applyFromArray($BStyle)
            ->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('F9', 150000)
            ->getStyle('F9')->applyFromArray($BStyle)
            ->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('G9', '=F9*E9')
            ->getStyle('G9')->applyFromArray($BStyle)
            ->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B8', '1')
            ->mergeCells('C8:D8')
            ->setCellValue('C8', 'Phí đăng ký Brandname')
            ->setCellValue('E8', '')
            ->setCellValue('G8', '=F8*E8')
            ->getStyle('B8:G8')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B9', '2')
            ->mergeCells('C9:D9')
            ->setCellValue('C9', 'Phí duy trì thương hiệu')
            ->setCellValue('E9', 1)
            ->getStyle('B9:G9')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B10', '3')
            ->mergeCells('C10:D10')
            ->setCellValue('C10', 'Phí gửi tin')
            ->setCellValue('E10', '')
            ->setCellValue('F10', '')
            ->setCellValue('G10', '=F10*E10')
            ->getStyle('B10:G10')->applyFromArray($BStyle);
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=19&ts=' . urlencode($start_time) . '&te=' . urlencode($end_time));

        $data = json_decode($datainfo);
        $i = 11;

        foreach ($data->providers as $row) {
            //var_dump($row);die();

            $objPHPExcel->setActiveSheetIndex()
                ->setCellValue('B' . $i, "")
                ->getStyle('B' . $i)->applyFromArray($BStyle);

            $objPHPExcel->setActiveSheetIndex(0)
                ->mergeCells('C' . $i . ':D' . $i)
                ->setCellValue('C' . $i, $this->getprovider($row->id))
                ->getStyle('C' . $i . ':D' . $i)->applyFromArray($BStyle)
                ->getNumberFormat()->setFormatCode('#,##0');
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('E' . $i, $row->sms)
                ->getStyle('E' . $i)->applyFromArray($BStyle)
                ->getNumberFormat()->setFormatCode('#,##0');
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('F' . $i, $row->price)
                ->getStyle('F' . $i)->applyFromArray($BStyle)
                ->getNumberFormat()->setFormatCode('#,##0');
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('G' . $i, '=E' . $i . '*F' . $i)
                ->getStyle('G' . $i)->applyFromArray($BStyle)
                ->getNumberFormat()->setFormatCode('#,##0');


            $i++;
        }

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B15', "II")
            ->getStyle('B15:B20')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('C15:D15')
            ->setCellValue('C15', "SMS Quảng cáo")
            ->getStyle('C15:D15')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('C16:D16')
            ->setCellValue('C16', "Mạng Viettel")
            ->getStyle('C16:D16')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('C17:D17')
            ->setCellValue('C17', "Mạng Vinaphone")
            ->getStyle('C17:D17')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('C18:D18')
            ->setCellValue('C18', "Mạng Mobiofone")
            ->getStyle('C18:D18')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('C19:D19')
            ->setCellValue('C19', "Mạng Khác")
            ->getStyle('C19:D19')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('C20:D20')
            ->setCellValue('C20', "Tổng cộng (đã bao gồm 10% VAT)")
            ->getStyle('C20:D20')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('E20', "=SUM(E10:E19)")
            ->getStyle('E15:E20')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('F16', "450")
            ->setCellValue('F17', "410")
            ->setCellValue('F18', "410")
            ->setCellValue('F19', "360")
            ->getStyle('F15:F20')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('G15', "=F15*E15")
            ->setCellValue('G16', "=F16*E16")
            ->setCellValue('G17', "=F17*E17")
            ->setCellValue('G18', "=F18*E18")
            ->setCellValue('G19', "=F19*E19")
            ->getStyle('G15:G20')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('G20', "=ROUND(SUM(G8:G19),0)")
            ->getStyle('G20')
            ->getNumberFormat()->setFormatCode('#,##0');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="doisoatbrandname.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');


        // var_dump($data);

    }

    function getprovider($pro)
    {
        $str = "";
        if ($pro == 0) {
            $str = "Mạng Viettel";
        } else if ($pro == 1) {
            $str = "Mạng Vinaphone";
        } else if ($pro == 2) {
            $str = "Mạng Mobifone";
        } else if ($pro == 3) {
            $str = "Mạng Vietnammobile";

        } else if ($pro == 4) {
            $str = "Mạng Gtel";
        } else if ($pro == 5) {
            $str = "Mạng khác";
        }
        return $str;
    }


    function doisoatmuamt()
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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/doisoatmuamt';
        $this->load->view('admin/main', $this->data);
    }

    function doisoatmuamtajax()
    {

        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $partner = $this->input->post("partner");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=146&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate) . '&pa=' . $partner);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }

    }

    function doisoatnapdt()
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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/doisoatnapdt';
        $this->load->view('admin/main', $this->data);
    }

    function doisoatnapdtajax()
    {

        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $partner = $this->input->post("partner");
        $dichvu = $this->input->post("dichvu");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=147&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate) . '&pa=' . $partner . '&type=' . $dichvu);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }

    }

    function doisoat9029()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $start_time = null;
        $end_time = null;


        if ($start_time === null) {
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;

        $this->data['temp'] = 'admin/report/doisoat9029';
        $this->load->view('admin/main', $this->data);
    }

    function doisoat9029ajax()
    {

        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=149&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate));
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }

    }

    function exportdoisoat9029()

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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->load->library('PHPExcel');
        $objPHPExcel = new PHPExcel();
        $BStyle = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('C3:E3')
            ->setCellValue('C3', 'Viettel')
            ->mergeCells('F3:H3')
            ->setCellValue('F3', 'Mobifone')
            ->mergeCells('I3:K3')
            ->setCellValue('I3', 'Vinaphone')
            ->getStyle('C3:K3')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('C4', 'Đơn giá')
            ->setCellValue('D4', 'Số lượng')
            ->setCellValue('E4', 'Tổng tiền')
            ->setCellValue('F4', 'Đơn giá')
            ->setCellValue('G4', 'Số lượng')
            ->setCellValue('H4', 'Tổng tiền')
            ->setCellValue('I4', 'Đơn giá')
            ->setCellValue('J4', 'Số lượng')
            ->setCellValue('K4', 'Tổng tiền')
            ->getStyle('C4:K4')->applyFromArray($BStyle);
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=149&ts=' . urlencode($start_time) . '&te=' . urlencode($end_time));
        $data = json_decode($datainfo)->moneyReponse[1]->trans;
        $data1 = json_decode($datainfo)->moneyReponse[3]->trans;
        $data2 = json_decode($datainfo)->moneyReponse[2]->trans;
        $i = 5;
        $j = 5;
        $k = 5;
        for ($o = count($data) - 1; $o >= 0; $o--) {
            $objPHPExcel->setActiveSheetIndex()
                ->setCellValue('B' . $i, $data[$o]->faceValue)
                ->getStyle('B' . $i)->applyFromArray($BStyle)
                ->getNumberFormat()->setFormatCode('#,##0');
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('C' . $i, $this->dongiaviettel($data[$o]->faceValue))
                ->getStyle('C' . $i)->applyFromArray($BStyle)
                ->getNumberFormat()->setFormatCode('#,##0');
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('D' . $i, $data[$o]->quantity)
                ->getStyle('D' . $i)->applyFromArray($BStyle)
                ->getNumberFormat()->setFormatCode('#,##0');
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('E' . $i, '=C' . $i . '*D' . $i)
                ->getStyle('E' . $i)->applyFromArray($BStyle)
                ->getNumberFormat()->setFormatCode('#,##0');

            $i++;

        }

        for ($p = count($data1) - 1; $p >= 0; $p--) {
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('F' . $j, $this->dongiavinamobi($data1[$p]->faceValue))
                ->getStyle('F' . $j)->applyFromArray($BStyle)
                ->getNumberFormat()->setFormatCode('#,##0');
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('G' . $j, $data1[$p]->quantity)
                ->getStyle('G' . $j)->applyFromArray($BStyle)
                ->getNumberFormat()->setFormatCode('#,##0');
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('H' . $j, '=F' . $j . '*G' . $j)
                ->getStyle('H' . $j)->applyFromArray($BStyle)
                ->getNumberFormat()->setFormatCode('#,##0');

            $j++;
        }


        for ($q = count($data2) - 1; $q >= 0; $q--) {
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('I' . $k, $this->dongiavinamobi($data2[$q]->faceValue))
                ->getStyle('I' . $k)->applyFromArray($BStyle)
                ->getNumberFormat()->setFormatCode('#,##0');
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('J' . $k, $data2[$q]->quantity)
                ->getStyle('J' . $k)->applyFromArray($BStyle)
                ->getNumberFormat()->setFormatCode('#,##0');
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('K' . $k, '=I' . $k . '*J' . $k)
                ->getStyle('K' . $k)->applyFromArray($BStyle)
                ->getNumberFormat()->setFormatCode('#,##0');

            $k++;
        }

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('E16', '=SUM(E5:E15)')
            ->getStyle('E16')
            ->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('H16', '=SUM(H5:H15)')
            ->getStyle('H16')
            ->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('K16', '=SUM(K5:K15)')
            ->getStyle('K16')
            ->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B17:E17')
            ->setCellValue('B17', 'Tổng doanh thu')
            ->getStyle('B17:E17')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B18:E18')
            ->setCellValue('B18', 'Tổng doanh thu không bao gồm VAT')
            ->getStyle('B18:E18')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B19:E19')
            ->setCellValue('B19', 'Tỷ lệ chia sẻ doanh thu')
            ->getStyle('B19:E19')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B20:E20')
            ->setCellValue('B20', 'Tỷ lệ thất thoát')
            ->getStyle('B20:E20')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B21:E21')
            ->setCellValue('B21', '')
            ->getStyle('B21:E21')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B22:E22')
            ->setCellValue('B22', 'Chi phí mở mã (80,000 đ / mã)')
            ->getStyle('B22:E22')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B23:E23')
            ->setCellValue('B23', 'Chi phí duy trì mã (32,000 đ / mã)')
            ->getStyle('B23:E23')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B24:E24')
            ->setCellValue('B24', 'Phí hoàn trả cước khách hàng khiếu nại')
            ->getStyle('B24:E24')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B25:E25')
            ->setCellValue('B25', 'Phí khác (nếu có)')
            ->getStyle('B25:E25')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B26:E26')
            ->setCellValue('B26', 'Tổng phí')
            ->getStyle('B26:E26')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B27:E27')
            ->setCellValue('B27', 'Doanh thu vinplay')
            ->getStyle('B27:E27')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('F17', '= E16+H16+K16')
            ->getStyle('F17')->applyFromArray($BStyle)
            ->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('F18', '= ROUND(F17/1.1,0)')
            ->getStyle('F18')->applyFromArray($BStyle)
            ->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('F19', '=IF(F18<=800000000,0.88,0.9)')
            ->getStyle('F19')->applyFromArray($BStyle)
            ->getNumberFormat()->applyFromArray(
                array(
                    'code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE
                )
            );
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('F20', '0.03')
            ->getStyle('F20')->applyFromArray($BStyle)
            ->getNumberFormat()->applyFromArray(
                array(
                    'code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE
                )
            );
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('F21', '= IF(F20<=0.03,0.98,1-F20)')
            ->getStyle('F21')->applyFromArray($BStyle)
            ->getNumberFormat()->applyFromArray(
                array(
                    'code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE
                )
            );
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('F22', '0')
            ->setCellValue('F23', '0')
            ->setCellValue('F24', '0')
            ->setCellValue('F25', '0')
            ->setCellValue('F26', '=SUM(F22:F25)')
            ->setCellValue('F27', '=ROUND(F18*F19*F21,0) - F26')
            ->getStyle('F22:F27')->applyFromArray($BStyle)
            ->getNumberFormat()->setFormatCode('#,##0');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="doisoat9029.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');


        // var_dump($data);

    }

    function dongiaviettel($dongia)
    {
        $str = 0;
        if ($dongia == 100000) {
            $str = 60000;
        } else if ($dongia == 50000) {
            $str = 30000;
        } else if ($dongia == 30000) {
            $str = 18000;
        } else if ($dongia == 20000) {
            $str = 12000;
        } else if ($dongia == 15000) {
            $str = 9000;
        } else if ($dongia == 10000) {
            $str = 6000;
        } else if ($dongia == 5000) {
            $str = 3000;
        } else if ($dongia == 4000) {
            $str = 2400;
        } else if ($dongia == 3000) {
            $str = 1800;
        } else if ($dongia == 2000) {
            $str = 1200;
        } else if ($dongia == 1000) {
            $str = 600;
        }
        return $str;
    }

    function dongiavinamobi($dongia)
    {
        $str = 0;
        if ($dongia == 100000) {
            $str = 65000;
        } else if ($dongia == 50000) {
            $str = 32500;
        } else if ($dongia == 30000) {
            $str = 19500;
        } else if ($dongia == 20000) {
            $str = 13000;
        } else if ($dongia == 15000) {
            $str = 9750;
        } else if ($dongia == 10000) {
            $str = 6500;
        } else if ($dongia == 5000) {
            $str = 3250;
        } else if ($dongia == 4000) {
            $str = 2600;
        } else if ($dongia == 3000) {
            $str = 1950;
        } else if ($dongia == 2000) {
            $str = 1300;
        } else if ($dongia == 1000) {
            $str = 650;
        }

        return $str;
    }

    function reportbycard()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $start_time = null;
        $end_time = null;
        //  $error = "";

        if ($start_time === null) {
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $provider = "";
        $code = "";
        $amount = "";
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['provider'] = $provider;
        $this->data['code'] = $code;
        $this->data['amount'] = $amount;
        //$this->data['error'] = $error;
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $this->data['temp'] = 'admin/report/reportbycard';
        $this->load->view('admin/main', $this->data);
    }

    function exportbycard()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $start_time = null;
        $end_time = null;
        $provider = "";
        $amount = "";
        $code = "";
        $table = 0;
        $partner = "";
        $type = "";
        if ($this->input->post('ok')) {
            $this->data['error'] = "22222";
        }

        if ($this->input->post('toDate')) {
            $end_time = $this->input->post('toDate');
        }
        if ($this->input->post('fromDate')) {
            $start_time = $this->input->post('fromDate');
        }
        if ($this->input->post('select_provider')) {
            $provider = $this->input->post('select_provider');
        }
        if ($this->input->post('select_status')) {
            $code = $this->input->post('select_status');
        }
        if ($this->input->post('select_menhgia')) {
            $amount = $this->input->post('select_menhgia');
        }
        if ($this->input->post('select_table')) {
            $table = $this->input->post('select_table');
        }
        if ($this->input->post('select_partner')) {
            $partner = $this->input->post('select_partner');
        }
        if ($this->input->post('select_dichvu')) {
            $type = $this->input->post('select_dichvu');
        }
        if ($start_time === null) {
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->load->library('PHPExcel');
        $objPHPExcel = new PHPExcel();
        $BStyle = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        if ($table == 1) {
            $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=151&ts=' . urlencode($start_time) . '&te=' . urlencode($end_time) . '&pv=' . $provider . '&am=' . $amount . '&co=' . $code);
        } else if ($table == 2) {
            $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=152&ts=' . urlencode($start_time) . '&te=' . urlencode($end_time) . '&am=' . $amount . '&co=' . $code);
        } else if ($table == 3) {
            $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=153&ts=' . urlencode($start_time) . '&te=' . urlencode($end_time) . '&am=' . $amount . '&co=' . $code);
        } else if ($table == 4) {
            $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=158&ts=' . urlencode($start_time) . '&te=' . urlencode($end_time) . '&am=' . $amount . '&co=' . $code . '&pa=' . $partner . '&pv=' . $provider);
        } else if ($table == 5) {
            $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=159&ts=' . urlencode($start_time) . '&te=' . urlencode($end_time) . '&am=' . $amount . '&co=' . $code . '&pa=' . $partner . '&pv=' . $provider . '&type=' . $type);
        } else if ($table == 6) {
            $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=165&ts=' . urlencode($start_time) . '&te=' . urlencode($end_time) . '&pri=' . $amount);
        }

        // $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=151&ts=' . urlencode($start_time) . '&te=' . urlencode($end_time) . '&pv=' . $provider . '&am=' . $amount . '&co=' . $code);
        // var_dump($this->config->item('api_backend') . '?c=151&ts=' . urlencode($start_time) . '&te=' . urlencode($end_time).'&pv='.$provider.'&am='.$amount.'&co='.$code);die();
        $data = json_decode($datainfo)->transactions;

        if ($table == 1) {

            if ($data == "" || $data != null) {
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'STT')
                    ->setCellValue('B1', 'Mã giao dịch')
                    ->setCellValue('C1', 'Nickname')
                    ->setCellValue('D1', 'Thẻ')
                    ->setCellValue('E1', 'Nhà cung cấp')
                    ->setCellValue('F1', 'Serial')
                    ->setCellValue('G1', 'Mã thẻ')
                    ->setCellValue('H1', 'Mệnh giá')
                    ->setCellValue('I1', 'Mã lỗi dịch vụ')
                    ->setCellValue('J1', 'Mô tả')
                    ->setCellValue('K1', 'Mã lỗi win123club')
                    ->setCellValue('L1', 'Thời gian')
                    ->getStyle('A1:L1')->applyFromArray($BStyle);
                $i = 2;
                $j = 1;
                foreach ($data as $row) {

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A' . $i, $j)
                        ->getStyle('A' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('B' . $i, "'" . $row->referenceId)
                        ->getStyle('B' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('C' . $i, $row->nickName)
                        ->getStyle('C' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('D' . $i, $row->provider)
                        ->getStyle('D' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('E' . $i, $row->partner)
                        ->getStyle('E' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('F' . $i, "'" . $row->serial)
                        ->getStyle('F' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('G' . $i, "'" . $row->pin)
                        ->getStyle('G' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('H' . $i, $row->amount)
                        ->getStyle('H' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('I' . $i, $row->status)
                        ->getStyle('I' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('J' . $i, $row->message)
                        ->getStyle('J' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('K' . $i, $row->code)
                        ->getStyle('K' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('L' . $i, $row->timelog)
                        ->getStyle('L' . $i)->applyFromArray($BStyle);
                    $i++;
                    $j++;
                }

            } else {

                $this->session->set_flashdata('message', 1);
                redirect(admin_url('report/reportbycard'));


            }
        }
        if ($table == 2) {
            if ($data == "" || $data != null) {
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'STT')
                    ->setCellValue('B1', 'Nickname')
                    ->setCellValue('C1', 'Điện thoại')
                    ->setCellValue('D1', 'Nhà mạng')
                    ->setCellValue('E1', 'Tin nhắn gửi')
                    ->setCellValue('F1', 'Mệnh giá')
                    ->setCellValue('G1', 'Đầu số')
                    ->setCellValue('H1', 'Mã giao dịch')
                    ->setCellValue('I1', 'Mô tả')
                    ->setCellValue('J1', 'Win')
                    ->setCellValue('K1', 'Thời gian')
                    ->getStyle('A1:K1')->applyFromArray($BStyle);
                $i = 2;
                $j = 1;
                foreach ($data as $row) {

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A' . $i, $j)
                        ->getStyle('A' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('B' . $i, $row->nickname)
                        ->getStyle('B' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('C' . $i, $row->mobile)
                        ->getStyle('C' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('D' . $i, $row->provider)
                        ->getStyle('D' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('E' . $i, $row->moMessage)
                        ->getStyle('E' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('F' . $i, $row->amount)
                        ->getStyle('F' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('G' . $i, $row->shortCode)
                        ->getStyle('G' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('H' . $i, $row->requestId)
                        ->getStyle('H' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('I' . $i, $row->des)
                        ->getStyle('I' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('J' . $i, $row->money)
                        ->getStyle('J' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('K' . $i, $row->timeLog)
                        ->getStyle('K' . $i)->applyFromArray($BStyle);
                    $i++;
                    $j++;
                }


            } else {

                $this->session->set_flashdata('message', 1);
                redirect(admin_url('report/reportbycard'));

            }
        }
        if ($table == 3) {
            if ($data == "" || $data != null) {
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'STT')
                    ->setCellValue('B1', 'Nickname')
                    ->setCellValue('C1', 'Điện thoại')
                    ->setCellValue('D1', 'Nhà mạng')
                    ->setCellValue('E1', 'Tin nhắn gửi')
                    ->setCellValue('F1', 'Mệnh giá')
                    ->setCellValue('G1', 'Đầu số')
                    ->setCellValue('H1', 'Mã giao dịch')
                    ->setCellValue('I1', 'Mô tả')
                    ->setCellValue('J1', 'Win')
                    ->setCellValue('K1', 'Thời gian')
                    ->getStyle('A1:K1')->applyFromArray($BStyle);
                $i = 2;
                $j = 1;
                foreach ($data as $row) {

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A' . $i, $j)
                        ->getStyle('A' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('B' . $i, $row->nickname)
                        ->getStyle('B' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('C' . $i, $row->mobile)
                        ->getStyle('C' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('D' . $i, $row->provider)
                        ->getStyle('D' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('E' . $i, $row->moMessage)
                        ->getStyle('E' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('F' . $i, $row->amount)
                        ->getStyle('F' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('G' . $i, $row->shortCode)
                        ->getStyle('G' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('H' . $i, $row->requestId)
                        ->getStyle('H' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('I' . $i, $row->des)
                        ->getStyle('I' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('J' . $i, $row->money)
                        ->getStyle('J' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('K' . $i, $row->timeLog)
                        ->getStyle('K' . $i)->applyFromArray($BStyle);
                    $i++;
                    $j++;
                }


            } else {
                $this->session->set_flashdata('message', 1);
                redirect(admin_url('report/reportbycard'));

            }
        }

        if ($table == 4) {
            if ($data == "" || $data != null) {
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'STT')
                    ->setCellValue('B1', 'Mã giao dịch')
                    ->setCellValue('C1', 'Nickname')
                    ->setCellValue('D1', 'Thẻ')
                    ->setCellValue('E1', 'Nhà cung cấp')
                    ->setCellValue('F1', 'Mệnh giá')
                    ->setCellValue('G1', 'Số lượng')
                    ->setCellValue('H1', 'Thông tin thẻ nạp')
                    ->setCellValue('I1', 'Mã lỗi dịch vụ')
                    ->setCellValue('J1', 'Mô tả')
                    ->setCellValue('K1', 'Mã lỗi win123Club')
                    ->setCellValue('L1', 'Thời gian')
                    ->getStyle('A1:L1')->applyFromArray($BStyle);
                $i = 2;
                $j = 1;
                foreach ($data as $row) {

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A' . $i, $j)
                        ->getStyle('A' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('B' . $i, "'" . $row->referenceId)
                        ->getStyle('B' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('C' . $i, $row->nickName)
                        ->getStyle('C' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('D' . $i, $row->provider)
                        ->getStyle('D' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('E' . $i, $row->partner)
                        ->getStyle('E' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('F' . $i, $row->amount)
                        ->getStyle('F' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('G' . $i, $row->quantity)
                        ->getStyle('G' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('H' . $i, $row->softpin)
                        ->getStyle('H' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('I' . $i, $row->status)
                        ->getStyle('I' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('J' . $i, $row->message)
                        ->getStyle('J' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('K' . $i, $row->code)
                        ->getStyle('K' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('L' . $i, $row->timeLog)
                        ->getStyle('L' . $i)->applyFromArray($BStyle);
                    $i++;
                    $j++;
                }


            } else {
                $this->session->set_flashdata('message', 1);
                redirect(admin_url('report/reportbycard'));

            }

        }

        if ($table == 5) {
            if ($data == "" || $data != null) {
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'STT')
                    ->setCellValue('B1', 'Mã giao dịch')
                    ->setCellValue('C1', 'Nickname')
                    ->setCellValue('D1', 'Điện thoại')
                    ->setCellValue('E1', 'Nhà mạng')
                    ->setCellValue('F1', 'Nhà cung cấp')
                    ->setCellValue('G1', 'Thuê bao')
                    ->setCellValue('H1', 'Tiền')
                    ->setCellValue('I1', 'Mã lỗi dịch vụ')
                    ->setCellValue('J1', 'Mô tả')
                    ->setCellValue('K1', 'Mã lỗi win123club')
                    ->setCellValue('L1', 'Thời gian')
                    ->getStyle('A1:L1')->applyFromArray($BStyle);
                $i = 2;
                $j = 1;
                foreach ($data as $row) {

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A' . $i, $j)
                        ->getStyle('A' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('B' . $i, "'" . $row->referenceId)
                        ->getStyle('B' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('C' . $i, $row->nickName)
                        ->getStyle('C' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('D' . $i, "'" . $row->target)
                        ->getStyle('D' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('E' . $i, $row->provider)
                        ->getStyle('E' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('F' . $i, $row->partner)
                        ->getStyle('F' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('G' . $i, $row->type)
                        ->getStyle('G' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('H' . $i, $row->amount)
                        ->getStyle('H' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('I' . $i, $row->status)
                        ->getStyle('I' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('J' . $i, $row->message)
                        ->getStyle('J' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('K' . $i, $row->code)
                        ->getStyle('K' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('L' . $i, $row->timeLog)
                        ->getStyle('L' . $i)->applyFromArray($BStyle);
                    $i++;
                    $j++;
                }


            } else {
                $this->session->set_flashdata('message', 1);
                redirect(admin_url('report/reportbycard'));

            }

        }

        if ($table == 6) {
            if ($data == "" || $data != null) {
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'STT')
                    ->setCellValue('B1', 'orderCode')
                    ->setCellValue('C1', 'nickName')
                    ->setCellValue('D1', 'email')
                    ->setCellValue('E1', 'ip')
                    ->setCellValue('F1', 'totalAmount')
                    ->setCellValue('G1', 'bank')
                    ->setCellValue('H1', 'errorCodeSend')
                    ->setCellValue('I1', 'descVp')
                    ->setCellValue('J1', 'transTime')
                    ->setCellValue('K1', 'errorCodeReturn')
                    ->setCellValue('L1', 'descReturn')
                    ->setCellValue('M1', 'updateTime')
                    ->getStyle('A1:M1')->applyFromArray($BStyle);
                $i = 2;
                $j = 1;
                foreach ($data as $row) {

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A' . $i, $j)
                        ->getStyle('A' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('B' . $i, "'" . $row->orderCode)
                        ->getStyle('B' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('C' . $i, $row->nickName)
                        ->getStyle('C' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('D' . $i, "'" . $row->email)
                        ->getStyle('D' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('E' . $i, $row->ip)
                        ->getStyle('E' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('F' . $i, $row->totalAmount)
                        ->getStyle('F' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('G' . $i, $row->bank)
                        ->getStyle('G' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('H' . $i, $row->errorCodeSend)
                        ->getStyle('H' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('I' . $i, $row->descVp)
                        ->getStyle('I' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('J' . $i, $row->transTime)
                        ->getStyle('J' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('K' . $i, $row->errorCodeReturn)
                        ->getStyle('K' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('L' . $i, $row->descReturn)
                        ->getStyle('L' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('M' . $i, $row->updateTime)
                        ->getStyle('M' . $i)->applyFromArray($BStyle);
                    $i++;
                    $j++;
                }


            } else {
                $this->session->set_flashdata('message', 1);
                redirect(admin_url('report/reportbycard'));

            }

        }

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="thenap.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');

        // var_dump($datainfo);die();

    }

    function doisoat8x98()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $start_time = null;
        $end_time = null;


        if ($start_time === null) {
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;

        $this->data['temp'] = 'admin/report/doisoat8x98';
        $this->load->view('admin/main', $this->data);
    }

    function doisoat8x98ajax()
    {

        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=148&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate));
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }

    }

    function exportdoisoat8x98()

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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->load->library('PHPExcel');
        $objPHPExcel = new PHPExcel();
        $BStyle = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('C3:E3')
            ->setCellValue('C3', 'Viettel')
            ->mergeCells('F3:H3')
            ->setCellValue('F3', 'Mobifone')
            ->mergeCells('I3:K3')
            ->setCellValue('I3', 'Vinaphone')
            ->mergeCells('L3:N3')
            ->setCellValue('L3', 'Vietnam Mobile')
            ->mergeCells('O3:Q3')
            ->setCellValue('O3', 'Vietnam Mobile')
            ->getStyle('C3:Q3')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('C4', 'Đơn giá')
            ->setCellValue('D4', 'Số lượng')
            ->setCellValue('E4', 'Tổng tiền')
            ->setCellValue('F4', 'Đơn giá')
            ->setCellValue('G4', 'Số lượng')
            ->setCellValue('H4', 'Tổng tiền')
            ->setCellValue('I4', 'Đơn giá')
            ->setCellValue('J4', 'Số lượng')
            ->setCellValue('K4', 'Tổng tiền')
            ->setCellValue('L4', 'Đơn giá')
            ->setCellValue('M4', 'Số lượng')
            ->setCellValue('N4', 'Tổng tiền')
            ->setCellValue('O4', 'Đơn giá')
            ->setCellValue('P4', 'Số lượng')
            ->setCellValue('Q4', 'Tổng tiền')
            ->getStyle('C4:Q4')->applyFromArray($BStyle);
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=148&ts=' . urlencode($start_time) . '&te=' . urlencode($end_time));
        $data = json_decode($datainfo)->moneyReponse[1]->trans;
        $data1 = json_decode($datainfo)->moneyReponse[3]->trans;
        $data2 = json_decode($datainfo)->moneyReponse[2]->trans;
        $data3 = json_decode($datainfo)->moneyReponse[4]->trans;
        $data4 = json_decode($datainfo)->moneyReponse[5]->trans;
        $i = 5;
        $j = 5;
        $k = 5;
        $l = 5;
        $m = 5;

        for ($o = count($data) - 1; $o >= 0; $o--) {
            if ($data[$o]->faceValue <= 15000) {
                $objPHPExcel->setActiveSheetIndex()
                    ->setCellValue('B' . $i, $data[$o]->faceValue)
                    ->getStyle('B' . $i)->applyFromArray($BStyle)
                    ->getNumberFormat()->setFormatCode('#,##0');
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('C' . $i, $this->dongiaviettel8x98($data[$o]->faceValue))
                    ->getStyle('C' . $i)->applyFromArray($BStyle)
                    ->getNumberFormat()->setFormatCode('#,##0');
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('D' . $i, $data[$o]->quantity)
                    ->getStyle('D' . $i)->applyFromArray($BStyle)
                    ->getNumberFormat()->setFormatCode('#,##0');
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('E' . $i, '=C' . $i . '*D' . $i)
                    ->getStyle('E' . $i)->applyFromArray($BStyle)
                    ->getNumberFormat()->setFormatCode('#,##0');
                $i++;
            }
        }

        for ($p = count($data1) - 1; $p >= 0; $p--) {
            if ($data1[$p]->faceValue <= 15000) {
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('F' . $j, $this->dongiavinamobi8x98($data1[$p]->faceValue))
                    ->getStyle('F' . $j)->applyFromArray($BStyle)
                    ->getNumberFormat()->setFormatCode('#,##0');
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('G' . $j, $data1[$p]->quantity)
                    ->getStyle('G' . $j)->applyFromArray($BStyle)
                    ->getNumberFormat()->setFormatCode('#,##0');
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('H' . $j, '=F' . $j . '*G' . $j)
                    ->getStyle('H' . $j)->applyFromArray($BStyle)
                    ->getNumberFormat()->setFormatCode('#,##0');
                $j++;
            }

        }
        for ($q = count($data2) - 1; $q >= 0; $q--) {
            if ($data2[$q]->faceValue <= 15000) {
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('I' . $k, $this->dongiavinamobi8x98($data2[$q]->faceValue))
                    ->getStyle('I' . $k)->applyFromArray($BStyle)
                    ->getNumberFormat()->setFormatCode('#,##0');
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('J' . $k, $data2[$q]->quantity)
                    ->getStyle('J' . $k)->applyFromArray($BStyle)
                    ->getNumberFormat()->setFormatCode('#,##0');
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('K' . $k, '=I' . $k . '*J' . $k)
                    ->getStyle('K' . $k)->applyFromArray($BStyle)
                    ->getNumberFormat()->setFormatCode('#,##0');
                $k++;
            }

        }

        for ($r = count($data3) - 1; $r >= 0; $r--) {
            if ($data3[$r]->faceValue <= 15000) {
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('L' . $l, $this->dongiavietnam8x98($data3[$r]->faceValue))
                    ->getStyle('L' . $l)->applyFromArray($BStyle)
                    ->getNumberFormat()->setFormatCode('#,##0');
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('M' . $l, $data3[$r]->quantity)
                    ->getStyle('M' . $l)->applyFromArray($BStyle)
                    ->getNumberFormat()->setFormatCode('#,##0');
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('N' . $l, '=L' . $l . '*M' . $l)
                    ->getStyle('N' . $l)->applyFromArray($BStyle)
                    ->getNumberFormat()->setFormatCode('#,##0');
                $l++;
            }

        }
        for ($s = count($data4) - 1; $s >= 0; $s--) {
            if ($data4[$s]->faceValue <= 15000) {
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('O' . $m, $this->dongiavietnam8x98($data4[$s]->faceValue))
                    ->getStyle('O' . $m)->applyFromArray($BStyle)
                    ->getNumberFormat()->setFormatCode('#,##0');
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('P' . $m, $data4[$s]->quantity)
                    ->getStyle('P' . $m)->applyFromArray($BStyle)
                    ->getNumberFormat()->setFormatCode('#,##0');
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('Q' . $m, '=O' . $m . '*P' . $m)
                    ->getStyle('Q' . $m)->applyFromArray($BStyle)
                    ->getNumberFormat()->setFormatCode('#,##0');
                $m++;
            }

        }

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('E12', '=SUM(E5:E11)')
            ->getStyle('E12')
            ->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('H12', '=SUM(H5:H11)')
            ->getStyle('H12')
            ->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('K12', '=SUM(K5:K11)')
            ->getStyle('K12')
            ->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('N12', '=SUM(N5:N11)')
            ->getStyle('N12')
            ->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('Q12', '=SUM(Q5:Q11)')
            ->getStyle('Q12')
            ->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B17:E17')
            ->setCellValue('B17', 'Tổng doanh thu')
            ->getStyle('B17:E17')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B18:E18')
            ->setCellValue('B18', 'Tổng doanh thu không bao gồm VAT')
            ->getStyle('B18:E18')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B19:E19')
            ->setCellValue('B19', 'Tỷ lệ chia sẻ doanh thu')
            ->getStyle('B19:E19')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B20:E20')
            ->setCellValue('B20', 'Tỷ lệ thất thoát')
            ->getStyle('B20:E20')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B21:E21')
            ->setCellValue('B21', '')
            ->getStyle('B21:E21')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B22:E22')
            ->setCellValue('B22', 'Chi phí mở mã (80,000 đ / mã)')
            ->getStyle('B22:E22')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B23:E23')
            ->setCellValue('B23', 'Chi phí duy trì mã (32,000 đ / mã)')
            ->getStyle('B23:E23')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B24:E24')
            ->setCellValue('B24', 'Phí hoàn trả cước khách hàng khiếu nại')
            ->getStyle('B24:E24')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B25:E25')
            ->setCellValue('B25', 'Phí khác (nếu có)')
            ->getStyle('B25:E25')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B26:E26')
            ->setCellValue('B26', 'Tổng phí')
            ->getStyle('B26:E26')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B27:E27')
            ->setCellValue('B27', 'Doanh thu win123club')
            ->getStyle('B27:E27')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('F17', '= E12+H12+K12+N12+Q12')
            ->getStyle('F17')->applyFromArray($BStyle)
            ->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('F18', '= ROUND(F17/1.1,0)')
            ->getStyle('F18')->applyFromArray($BStyle)
            ->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('F19', '=IF(F18<=800000000,0.88,0.9)')
            ->getStyle('F19')->applyFromArray($BStyle)
            ->getNumberFormat()->applyFromArray(
                array(
                    'code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE
                )
            );
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('F20', '0.03')
            ->getStyle('F20')->applyFromArray($BStyle)
            ->getNumberFormat()->applyFromArray(
                array(
                    'code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE
                )
            );
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('F21', '= IF(F20<=0.03,0.98,1-F20)')
            ->getStyle('F21')->applyFromArray($BStyle)
            ->getNumberFormat()->applyFromArray(
                array(
                    'code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE
                )
            );
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('F22', '0')
            ->setCellValue('F23', '0')
            ->setCellValue('F24', '0')
            ->setCellValue('F25', '0')
            ->setCellValue('F26', '=SUM(F22:F25)')
            ->setCellValue('F27', '=ROUND(F18*F19*F21,0) - F26')
            ->getStyle('F22:F27')->applyFromArray($BStyle)
            ->getNumberFormat()->setFormatCode('#,##0');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="doisoat8x98.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');


        // var_dump($data);

    }

    function dongiaviettel8x98($dongia)
    {
        $str = 0;
        if ($dongia == 15000) {
            $str = 6750;
        } else if ($dongia == 10000) {
            $str = 4500;
        } else if ($dongia == 5000) {
            $str = 2250;
        } else if ($dongia == 4000) {
            $str = 1600;
        } else if ($dongia == 3000) {
            $str = 1200;
        } else if ($dongia == 2000) {
            $str = 800;
        } else if ($dongia == 1000) {
            $str = 260;
        }
        return $str;
    }

    function dongiavinamobi8x98($dongia)
    {
        $str = 0;
        if ($dongia == 15000) {
            $str = 6000;
        } else if ($dongia == 10000) {
            $str = 4000;
        } else if ($dongia == 5000) {
            $str = 2000;
        } else if ($dongia == 4000) {
            $str = 1600;
        } else if ($dongia == 3000) {
            $str = 1200;
        } else if ($dongia == 2000) {
            $str = 800;
        } else if ($dongia == 1000) {
            $str = 210;
        }

        return $str;
    }

    function dongiavietnam8x98($dongia)
    {
        $str = 0;
        if ($dongia == 15000) {
            $str = 8760;
        } else if ($dongia == 10000) {
            $str = 5760;
        } else if ($dongia == 5000) {
            $str = 2760;
        } else if ($dongia == 4000) {
            $str = 2160;
        } else if ($dongia == 3000) {
            $str = 1560;
        } else if ($dongia == 2000) {
            $str = 960;
        } else if ($dongia == 1000) {
            $str = 60;
        }

        return $str;
    }

    function doisoatvincard()
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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/doisoatvincard';
        $this->load->view('admin/main', $this->data);
    }

    function doisoatvincardajax()
    {

        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=150&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate));
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }

    }

    function rechargebymegacard()
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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/rechargebymegacard';
        $this->load->view('admin/main', $this->data);
    }


    function rechargebymegacardajax()
    {

        $nickname = urlencode($this->input->post("nickname"));
        $serial = urlencode($this->input->post("serial"));
        $mathe = urlencode($this->input->post("mathe"));
        $status = $this->input->post("status");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $pages = $this->input->post("pages");
        $tranid = urlencode($this->input->post("tranid"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=514&nn=' . $nickname . '&pv=&sr=' . $serial . '&pn=' . $mathe . '&co=' . $status . '&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate) . '&p=' . $pages . '&tid=' . $tranid);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }

    }

    function doisoatmegacard()
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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/doisoatmegacard';
        $this->load->view('admin/main', $this->data);
    }

    function doisoatmegacardajax()
    {
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=515&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate));
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }

    }

    function rechargefromvtc()
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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/rechargefromvtc';
        $this->load->view('admin/main', $this->data);

    }

    function rechargefromvtcajax()
    {

        $nickname = urlencode($this->input->post("nickname"));
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $pages = $this->input->post("pages");
        $tranid = urlencode($this->input->post("tranid"));
        $price = urlencode($this->input->post("price"));
        $status = urlencode($this->input->post("status"));
        $datainfo = $this->curl->simple_get($this->config->item('api_backend') . '?c=163&nn=' . $nickname . '&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate) . '&p=' . $pages . '&tid=' . $tranid . '&pri=' . $price . '&st=' . $status . $this->getAuthBackend());
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }

    }

    function doisoatfromvtc()
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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/doisoatfromvtc';
        $this->load->view('admin/main', $this->data);
    }

    function doisoatfromvtcajax()
    {

        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $datainfo = $this->curl->simple_get($this->config->item('api_backend') . '?c=164&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate) . $this->getAuthBackend());
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }

    }
	
	// NAP NGAN HANG COEPAY
	function rechargeajax()
    {
        $txtvinplay = urlencode($this->input->post("txtvinplay"));
        $nickname = urlencode($this->input->post("nickname"));
        $txtip = urlencode($this->input->post("txtip"));
        $bank = $this->input->post("bank");
        $status = $this->input->post("status");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $maxItem = $this->input->post("maxItem");
        $pages = $this->input->post("pages");
        $checkbank = $this->input->post("checkbank");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4055&nn=' . $nickname . '&tid=' . $txtvinplay . '&ip=' . $txtip . '&b=' . $bank . '&st=' . $status . '&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate) . '&tno=' . "" . '&p=' . $pages .  '&max_item=' . $maxItem .  '&checkbank=' . $checkbank);
        //echo($this->config->item('api_backend') . '?c=4055&nn=' . $nickname . '&tid=' . $txtvinplay . '&ip=' . $txtip . '&b=' . $bank . '&st=' . $status . '&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate) . '&tno=' . "" . '&p=' . $pages .  '&max_item=' . $maxItem .  '&checkbank=' . $checkbank);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }

    }
	
	function rechargebynapnganhang()
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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/rechargebynapnganhang';
        $this->load->view('admin/main', $this->data);
    }
	
	function updatedepositnganhangajax()
    {
        $transId = urlencode($this->input->post("transId"));
        $type = urlencode($this->input->post("type"));
        $tien = urlencode($this->input->post("money"));
        $user = $this->session->userdata['usernameadmin'];
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4059&transId=' . $transId . '&type=' . $type . '&tien=' . $tien . '&uad=' . $user);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }
	
	function rechargebynapcodepay()
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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/rechargebynapcodepay';
        $this->load->view('admin/main', $this->data);
    }

    function updatedepositcodepayajax()
    {
        $transId = urlencode($this->input->post("transId"));
        $type = urlencode($this->input->post("type"));
        $tien = urlencode($this->input->post("money"));
        $user = $this->session->userdata['usernameadmin'];
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4058&transId=' . $transId . '&type=' . $type . '&tien=' . $tien . '&uad=' . $user);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function managejackpot() {
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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/managejackpot';
        $this->load->view('admin/main', $this->data);
    }

    function managejackpotajax() {
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=11009');
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function updatefundajax()
    {
        $fundName = urlencode($this->input->post("fundName"));
        $amount = urlencode($this->input->post("amount"));
        $currentMoney = urlencode($this->input->post("currentMoney"));
        $updatedBy = urlencode($this->input->post("updatedBy"));
        $amount = urlencode($this->input->post("amount"));
        $type = urlencode($this->input->post("type"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=11010&fundName=' . $fundName . '&type=' . $type . '&amount=' . $amount . '&updatedBy='.$updatedBy. '&currentMoney='.$currentMoney);
        $data = json_decode($datainfo);
        if (isset($data)) {
            if($data->success) {
                echo "1";
            } else {
                echo "0";
            }
        } else {
            echo "Bạn không được hack";
        }
    }
    function historyfundajax()
    {
        $fundName = urlencode($this->input->post("fundName"));
        $fromDate = urlencode($this->input->post("fromDate"));
        $toDate = urlencode($this->input->post("toDate"));
        $type = urlencode($this->input->post("type"));
        $page = $this->input->post("page");
        $pageSize = $this->input->post("pageSize"); 
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=11025&fundName=' . $fundName . '&type=' . $type . '&pageIndex=' . $page . '&pageSize=' . $pageSize.'&startTime='.$fromDate.'&endTime='.$toDate);
        $data = json_decode($datainfo);
        if (isset($data)) {
            if($data->success) {
                echo json_encode($data);
            } else {
                echo "0";
            }
        } else {
            echo "Bạn không được hack";
        }
    }

    function manageProfit()
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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/manageProfit';
        $this->load->view('admin/main', $this->data);
    }
    function manageProfitAjax() {
        $toDate = $this->input->post("toDate") . " 23:59:59";
        $fromDate = $this->input->post("fromDate") . " 00:00:00";
        $ts = $this->input->post("ts") . " 00:00:00";
        $te = $this->input->post("te") . " 23:59:59";
        $dataChi = json_decode($this->get_data_curl($this->config->item('api_backend') . '?c=11031&pageSize=10&pageIndex=1&startTime=' . urlencode($fromDate) . '&endTime=' . urlencode($toDate)));
        $dataFund = json_decode($this->get_data_curl($this->config->item('api_backend') . '?c=11025&pageSize=100000&pageIndex=1&startTime=' . urlencode($fromDate) . '&endTime=' . urlencode($toDate)));
        $dataFee = json_decode($this->get_data_curl($this->config->item('api_backend') . '?c=11037&ts=' . urlencode($ts) . '&te=' . urlencode($te)));
        $dataFish = json_decode($this->get_data_curl($this->config->item('api_backend') . '?c=11038&timeStart=' . urlencode($fromDate) . '&timeEnd=' . urlencode($toDate)));
        $result = new stdClass();
        $result->chi = $dataChi -> totalExpense;
        $result->fund = $dataFund -> profit;
        $result->napFund = $dataFund -> totalDeposit;
        $result->rutFund = $dataFund -> totalWithdraw;
        $result->fee = 0;
        if(isset($dataFee -> totalFee)) {
            $result->fee = $dataFee -> totalFee;
        }
        $result->profitFish = 0;
        if(isset($dataFish -> totalProfit)) {
            $result->profitFish = $dataFish -> totalProfit;
        }
        if (isset($result)) {
            echo json_encode($result);
        } else {
            echo "Bạn không được hack";
        }
    }

    function detailChiPhi()
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
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/detailChiphi';
        $this->load->view('admin/main', $this->data);
    }
    function detailChiPhiAjax() {
        $expense = $this->input->post("expense");
        $toDate = $this->input->post("toDate"). " 23:59:59";
        $fromDate = $this->input->post("fromDate"). " 00:00:00";
        $type = $this->input->post("type");
        $page = $this->input->post("page");
        $pageSize = $this->input->post("pageSize");
        $datainfo = $this->file_get_contents($this->config->item('api_backend') . '?c=11031&pageIndex=' . $page . '&startTime=' . urlencode($fromDate) . '&endTime=' . urlencode($toDate) . '&pageSize=' . $pageSize . '&type=' . $type.'&expense='.$expense);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }
    function addChiPhi()
    {
       
        $this->data['temp'] = 'admin/report/addChiPhi';
        $this->load->view('admin/main', $this->data);
    }
    function addChiPhiAjax()
    {
        $expense = urlencode($this->input->post("expense"));
        $type = urlencode($this->input->post("type"));
        $amount = $this->input->post("amount");
        $datainfo = json_decode($this->get_data_curl($this->config->item('api_backend') . '?c=11030&amount=' . $amount . '&type=' . $type.'&expense='.$expense));
        if (isset($datainfo)) {
            if($datainfo->success) {
                echo "0";
            } else {
                echo $datainfo-> errorCode;
            }

        } else {
            echo "Bạn không được hack";
        }
    }
}
