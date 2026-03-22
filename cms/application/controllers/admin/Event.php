<?php

Class Event extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('eventminigame_model');
        $this->load->model('admin_model');
        $this->load->model('usergame_model');
        $this->load->model('logadmin_model');
    }
    function index(){
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
        $this->data['temp'] = 'admin/event/index';
        $this->load->view('admin/main', $this->data);
    }
    function add() {
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
            $start_time = date('Y-m-d 00:00:00');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/event/add';
        $this->load->view('admin/main', $this->data);
    }
    function createEventAjax() {
        $eventName = urlencode($this->input->post("eventName"));
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $rate = $this->input->post("rate");
        $datainfo = $this->file_get_contents($this->config->item('api_backend') . '?c=11047&eventName=' . $eventName . '&timeStart=' . urlencode($fromDate) . '&timeEnd=' . urlencode($toDate) . '&rate=' . $rate );
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }
    function listAllEventAjax() {
        $eventName = urlencode($this->input->post("eventName"));
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $rate = $this->input->post("rate");
        $status = $this->input->post("status");
        $type = $this->input->post("type");
        $url = $this->input->post("url");
        $action = $this->input->post("action");
        $datainfo = $this->file_get_contents($this->config->item('api_backend') . '?c=11048&eventName=' . $eventName . '&timeStart=' . urlencode($fromDate) . '&timeEnd=' . urlencode($toDate) 
        . '&rate=' . $rate . '&staus=' . $status . '&type=' . $type . '&url=' . $url . '&action=' . $action);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }

    }
    function updateEventAjax() {
        $eventName = urlencode($this->input->post("eventName"));
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $rate = $this->input->post("rate");
        $status = $this->input->post("status");
        $type = urlencode($this->input->post("type"));
        $url = urlencode($this->input->post("url"));
        $action = urlencode($this->input->post("action"));
        $id = $this->input->post("id");
        $datainfo = $this->file_get_contents($this->config->item('api_backend') . '?c=11049&eventName=' . $eventName . '&timeStart=' . urlencode($fromDate) 
        . '&timeEnd=' . urlencode($toDate) . '&rate=' . $rate . '&id=' . $id . '&status=' . $status . '&type=' . $type . '&url=' . $url . '&action=' . $action );
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }

    }
    function addrotate()
    {
        if ($this->input->post()) {
            $name = $this->input->post('name');
            $info = $this->eventminigame_model->get_info_rotate($name);
            $this->data['info'] = $info;

        }
        $this->data['temp'] = 'admin/event/addrotate';
        $this->load->view('admin/main', $this->data);
    }
    function insertrotate(){

        $info = $this->usergame_model->get_info_nickname($this->input->post('nickname'));
        if ($info != false) {
            foreach($info as $row){
                $data = array(
                    'user_id' => $row->id,
                    'nick_name' => $row->nick_name,
                    'rotate_free' => $this->input->post('numadd')
                );
                $this->eventminigame_model->create($data);
            }
            echo json_encode( "Bạn thêm số vòng quay thành công" );
        }else{

            echo json_encode( "Nick name không tồn tại!" );
        }
    }
    function updaterotate(){
        $name = $this->input->post('nickname');
        $info = $this->eventminigame_model->get_info_rotate($name);
        $this->data['info'] = $info;
        if ($info != false) {
            foreach($info as $row){
                $data = array(
                    'rotate_free' => $row->rotate_free +  $this->input->post('numupdate')
                );
                $this->eventminigame_model->update($this->input->post('nickname'),$data);
            }
            echo json_encode( "Bạn thêm số vòng quay thành công" );
        }else{

            echo json_encode( "Nick name không tồn tại!" );
        }

    }
    function vippoint(){
        $this->data['temp'] = 'admin/event/vippoint';
        $this->load->view('admin/main', $this->data);
    }
    function uservippoint(){
        $this->data['temp'] = 'admin/event/uservippoint';
        $this->load->view('admin/main', $this->data);
    }
    function vippointajax(){
        $nickname = urlencode($this->input->post("nickname"));
        $value = $this->input->post("value");
        $type = $this->input->post("type");
        $pages = $this->input->post("pages");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $account = $this->input->post("account");
        $datainfo = $this->file_get_contents($this->config->item('api_backend').'?c=130&nn='.$nickname.'&va='.$value.'&type='.$type.'&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate).'&bt='.$account.'&p='.$pages);
        if(isset($datainfo)) {
            echo $datainfo;
        }else{
            echo "Bạn không được hack";
        }

    }

    function uservippointajax(){
        $nickname = urlencode($this->input->post("nickname"));
        $sort = $this->input->post("sort");
        $field = $this->input->post("field");
        $pages = $this->input->post("pages");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $account = $this->input->post("account");
        $datainfo = $this->file_get_contents($this->config->item('api_backend').'?c=131&nn='.$nickname.'&srt='.$sort.'&fd='.$field.'&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate).'&bt='.$account.'&p='.$pages);
        if(isset($datainfo)) {
            echo $datainfo;

        }else{
            echo "Bạn không được hack";
        }

    }
    function addbotcaothap(){
        $this->data['temp'] = 'admin/event/addbotcaothap';
        $this->load->view('admin/main', $this->data);
    }

    function addbotcaothapajax(){
        $nickname = urlencode($this->input->post("nickname"));
        $room = $this->input->post("room");
        $prize = urlencode($this->input->post("prize"));
        $labai = $this->input->post("labai");
        $datainfo = $this->file_get_contents($this->config->item('api_backend').'?c=1995&nn='.$nickname.'&cr='.$labai.'&bv='.$room.'&pz='.$prize);

        if(isset($datainfo)) {
            echo $datainfo;

        }else{
            echo "Bạn không được hack";
        }

    }

    function getnicknameajax(){
        $nickname = urlencode($this->input->post("nickname"));
        $datainfo = $this->file_get_contents($this->config->item('api_backend') . '?c=716&nn=' . $nickname);
        if(isset($datainfo)) {
            echo $datainfo;
        }else{
            echo "Bạn không được hack";
        }
    }

    function listbossxocdia(){

        $this->data['temp'] = 'admin/event/listbossxocdia';
        $this->load->view('admin/main', $this->data);
    }
    function listbossxocdiaajax(){
        $nickname = urlencode($this->input->post("nickname"));
        $money = urlencode($this->input->post("money"));
        $room = urlencode($this->input->post("room"));
        $status = urlencode($this->input->post("status"));
        if($room == "" && $money != ""){
           $room = -1;
        }elseif($room != "" && $money == ""){
            $money = -1;
        }elseif($room == "" && $money == ""){
            $room = -1;
            $money = -1;

        }
        $datainfo = $this->file_get_contents($this->config->item('api_backend') . '?c=21&nn='.$nickname.'&r='.$room.'&st='.$status.'&mn='.$money);
        if(isset($datainfo)) {
            echo $datainfo;
        }else{
            echo "Bạn không được hack";
        }
    }

    function listbonusnhiemvu(){

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
            $start_time = date('Y-m-d 00:00:00');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/event/listbonusnhiemvu';
        $this->load->view('admin/main', $this->data);
    }
    function listbonusnhiemvuajax(){
        $nickname = urlencode($this->input->post("nickname"));
        $money = urlencode($this->input->post("money"));
        $gamename = urlencode($this->input->post("gamename"));
        $toDate = urlencode($this->input->post("toDate"));
        $fromDate = urlencode($this->input->post("fromDate"));
        $pages = $this->input->post("pages");
        $datainfo = $this->file_get_contents($this->config->item('api_backend') . '?c=160&nn='.$nickname.'&gn='.$gamename.'&mt='.$money.'&mn='.$money.'&ts='.$toDate.'&te='.$fromDate.'&p='.$pages);
        if(isset($datainfo)) {
            echo $datainfo;
        }else{
            echo "Bạn không được hack";
        }
    }
}
