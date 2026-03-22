<?php

class User extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('useragent_model');
        $this->load->model('logadmin_model');
        $this->load->model('sourcegiftcode_model');

    }

    function index()
    {
        $this->data['temp'] = 'admin/user/index';
        $this->load->view('admin/main', $this->data);
    }

    function congtrutien()
    {

        $this->data['temp'] = 'admin/user/congtrutien';
        $this->load->view('admin/main', $this->data);
    }

    function congtienajax()
    {
        $admin_login = $this->session->userdata('user_id_login');
        $admin_info = $this->admin_model->get_info($admin_login);
        $otpselectcong = $this->input->post("otpselectcong");
        $tienchuyen = $this->input->post("tienchuyen");
        $money_type = $this->input->post("money_type");
        $reasonchuyen = $this->input->post("reasonchuyen");
        $maotpcong = $this->input->post("maotpcong");
        $nickname = $this->input->post("nickname");
        $action = $this->input->post("actionname");
        $datainfo = $this->file_get_contents($this->config->item('api_backend') . '?c=100&nn=' . $nickname . '&mn=' . $tienchuyen . '&mt=' . $money_type . '&rs=' . urlencode($reasonchuyen) . '&otp=' . $maotpcong . '&type=' . $otpselectcong . '&ac=' . $action . '&nns=null');

        $data = json_decode($datainfo);
        if (isset($data->success)) {
            if ($data->success == true) {
                if ($data->errorCode == 0) {
                    echo json_encode("1");
                    // leon
                    // if ($action == "Admin")
                    //     $this->logadmin_model->create($this->logadmingiftcode(12, $nickname, $admin_info->UserName, "", $tienchuyen, $money_type));
                    // elseif ($action == "EventVP") {
                    //     $this->logadmin_model->create($this->logadmingiftcode(19, $nickname, $admin_info->UserName, "", $tienchuyen, $money_type));
                    // }
                }
            } else {
                if ($data->errorCode == 1001) {
                    echo json_encode("2");
                } elseif ($data->errorCode == 1002) {
                    echo json_encode("3");
                } elseif ($data->errorCode == 1008) {
                    echo json_encode("4");
                } elseif ($data->errorCode == 1021) {
                    echo json_encode("5");
                } elseif ($data->errorCode == 2001) {
                    echo json_encode("6");
                }
            }
        } else {
            echo "Bạn không được hack";
        }
    }

    function trutienajax()
    {
        $admin_login = $this->session->userdata('user_id_login');
        $admin_info = $this->admin_model->get_info($admin_login);
        $otpselecttru = $this->input->post("otpselecttru");
        $tienchuyen = $this->input->post("tienchuyen");
        $money_type = $this->input->post("money_type");
        $reasonchuyen = $this->input->post("reasonchuyen");
        $maotptru = $this->input->post("maotptru");
        $nickname = $this->input->post("nickname");
        $action = $this->input->post("actionname");
        $datainfo = $this->file_get_contents($this->config->item('api_backend') . '?c=100&nn=' . $nickname . '&mn=' . $tienchuyen . '&mt=' . $money_type . '&rs=' . urlencode($reasonchuyen) . '&otp=' . $maotptru . '&type=' . $otpselecttru . '&ac=' . $action . '&nns=' . $admin_info->FullName);
        $data = json_decode($datainfo);
        if (isset($data->success)) {
            if ($data->success == true) {
                if ($data->errorCode == 0) {
                    echo json_encode("1");
                    // if ($action == "Admin")
                    //     $this->logadmin_model->create($this->logadmingiftcode(12, $nickname, $admin_info->UserName, "", $tienchuyen, $money_type));
                    // elseif ($action == "EventVP") {
                    //     $this->logadmin_model->create($this->logadmingiftcode(19, $nickname, $admin_info->UserName, "", $tienchuyen, $money_type));
                    // }
                }
            } else {
                if ($data->errorCode == 1001) {
                    echo json_encode("2");
                } elseif ($data->errorCode == 1002) {
                    echo json_encode("3");
                } elseif ($data->errorCode == 1008) {
                    echo json_encode("4");
                } elseif ($data->errorCode == 1021) {
                    echo json_encode("5");
                } elseif ($data->errorCode == 2001) {
                    echo json_encode("6");
                }
            }
        } else {
            echo "Bạn không được hack";
        }
    }

    function nohu()
    {
        $this->data['temp'] = 'admin/user/nohu';
        $this->load->view('admin/main', $this->data);
    }


    function getnicknameajax()
    {
        $nickname = urlencode($this->input->post("nickname"));
        $datainfo = $this->file_get_contents($this->config->item('api_backend') . '?c=716&nn=' . $nickname);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    /*
     * Ham chinh sua thong tin quan tri vien
     */


    function logout()
    {
        if ($this->session->userdata('user_id_login')) {
            $this->session->unset_userdata('user_id_login');
        }
        redirect(base_url('login'));
    }

    function resetpw()
    {
        $this->data['temp'] = 'admin/user/resetpw';
        $this->load->view('admin/main', $this->data);
    }


    function resetpwajax()
    {
        $admin_login = $this->session->userdata('user_id_login');
        $admin_info = $this->admin_model->get_info($admin_login);
        $nickname = urlencode($this->input->post("nickname"));
        $password = urlencode($this->input->post("password"));
        $type = $this->input->post("type");
        $otp = urlencode($this->input->post("otp"));
//        $datainfo = file_get_contents($this->config->item('api_backend') . '?c=14&nn=' . $nickname . '&pass=' . $password . '&otp=' . $otp . '&type=' . $type . '&ad=' . $admin_info->FullName);
        $datainfo = file_get_contents($this->config->item('api_backend') . '?c=14&nn=' . $nickname . '&pass=' . $password . '&otp=' . $otp);
        if (isset($datainfo)) {
//            if ($datainfo == 0) {
//                $data = array(
//                    'account_name' => $nickname,
//                    'username' => $admin_info->UserName,
//                    'action' => "Reset password"
//                );
//                $this->logadmin_model->create($data);
//            }
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }
    function resetpwCap2ajax() {
        $nickname = urlencode($this->input->post("nickname"));
        $code = urlencode($this->input->post("code"));
        $datainfo = file_get_contents($this->config->item('api_backend') . '?c=4020&nickname=' . $nickname . '&code=' . $code);
        if (isset($datainfo)) {

            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function updatevpevent()
    {
        $this->data['temp'] = 'admin/user/updatevpevent';
        $this->load->view('admin/main', $this->data);
    }

    function updatevpajax()
    {
        $admin_login = $this->session->userdata('user_id_login');
        $admin_info = $this->admin_model->get_info($admin_login);
        $nickname = urlencode($this->input->post("nickname"));
        $type = $this->input->post("type");
        $value = urlencode($this->input->post("value"));
        $otp = urlencode($this->input->post("otp"));
        $typeotp = $this->input->post("typeotp");
        $datainfo = $this->file_get_contents($this->config->item('api_url') . '?c=726&nn=' . $nickname . '&tu=' . $type . '&va=' . $value . '&otp=' . $otp . '&type=' . $typeotp . '&ad=' . $admin_info->FullName);
        if (isset($datainfo)) {
            $datainfo = intval($datainfo);
            if ($datainfo == 0) {
                if ($type == 0) {
                    $data = array(
                        'account_name' => $nickname,
                        'username' => $admin_info->UserName,
                        'action' => "Trừ vippoint event",
                        'money' => -$value
                    );
                } else {
                    $data = array(
                        'account_name' => $nickname,
                        'username' => $admin_info->UserName,
                        'action' => "Cộng vippoint event",
                        'money' => $value
                    );
                }

                $this->logadmin_model->create($data);
            }
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function refundbonus()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $start_time = null;
        if ($start_time === null) {
            $start_time = date('Y-m-d');
        }
        $this->data['start_time'] = $start_time;
        $this->data['temp'] = 'admin/agent/index';
        $this->load->view('admin/main', $this->data);
    }

    function refundajax()
    {
        $admin_login = $this->session->userdata('user_id_login');
        $admin_info = $this->admin_model->get_info($admin_login);
        $otp = urlencode($this->input->post("otp"));
        $type = $this->input->post("type");
        $te = $this->input->post("te");
        $datainfo = $this->file_get_contents($this->config->item('api_url') . '?c=711&otp=' . $otp . '&type=' . $type . '&te=' . $te . '&ad=' . $admin_info->FullName);
        if (isset($datainfo)) {
            if ($datainfo == 0) {
                $data = array(
                    'username' => $admin_info->UserName,
                    'action' => "Hoàn trả phí đại lý"
                );
                $this->logadmin_model->create($data);
            }
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function bonusajax()
    {
        $admin_login = $this->session->userdata('user_id_login');
        $admin_info = $this->admin_model->get_info($admin_login);
        $otp = urlencode($this->input->post("otp"));
        $type = $this->input->post("type");
        $datainfo = $this->file_get_contents($this->config->item('api_url') . '?c=724&otp=' . $otp . '&type=' . $type . '&ad=' . $admin_info->FullName);
        if (isset($datainfo)) {
            if ($datainfo == 0) {
                $data = array(
                    'username' => $admin_info->UserName,
                    'action' => "Trả thưởng top doanh số đại lý"
                );
                $this->logadmin_model->create($data);
            }
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function reportgc()
    {
        $datainfo = json_decode($this->file_get_contents($this->config->item('api_url') . '?c=10'));
        $this->data['listvin'] = $datainfo->giftcode_vin;
        $this->data['listxu'] = $datainfo->giftcode_xu;
        $source = $this->sourcegiftcode_model->get_source_gift_code_marketing_view();
        $this->data['source'] = $source;
        $sourcevh = $this->sourcegiftcode_model->get_source_gift_code_vanhanh_view();
        $this->data['sourcevh'] = $sourcevh;
        $list = $this->useragent_model->get_admin_gift_code();
        $this->data['list'] = $list;
        $this->data['temp'] = 'admin/user/reportgc';
        $this->load->view('admin/main', $this->data);
    }

    function reportgcajax()
    {
        $roomvin = $this->input->post("roomvin");
        $roomxu = $this->input->post("roomxu");
        $nguonxuat = $this->input->post("nguonxuat");
        $fromDate = urlencode($this->input->post("fromDate"));
        $toDate = urlencode($this->input->post("toDate"));
        $money = $this->input->post("money");
        $filterdate = $this->input->post("filterdate");
        if ($money == 1) {
            $datainfo = $this->get_data_curl($this->config->item('api_url') . '?c=304&gp=' . $roomvin . '&ts=' . $fromDate . '&te=' . $toDate . '&mt=' . $money . '&gs=' . $nguonxuat . '&type=&tt=' . $filterdate . '&bl=');

        } elseif ($money == 0) {
            $datainfo = $this->get_data_curl($this->config->item('api_url') . '?c=304&gp=' . $roomxu . '&ts=' . $fromDate . '&te=' . $toDate . '&mt=' . $money . '&gs=' . $nguonxuat . '&type=&tt=' . $filterdate . '&bl=');
        }
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function reportgcmktajax()
    {
        $roomvin = $this->input->post("roomvin");
        $roomxu = $this->input->post("roomxu");
        $nguonxuat = $this->input->post("nguonxuat");
        $fromDate = urlencode($this->input->post("fromDate"));
        $toDate = urlencode($this->input->post("toDate"));
        $money = $this->input->post("money");
        $filterdate = $this->input->post("filterdate");
        if ($money == 1) {
            $datainfo = $this->get_data_curl($this->config->item('api_url') . '?c=304&gp=' . $roomvin . '&ts=' . $fromDate . '&te=' . $toDate . '&mt=' . $money . '&gs=' . $nguonxuat . '&type=2&tt=' . $filterdate . '&bl=');
        } elseif ($money == 0) {
            $datainfo = $this->get_data_curl($this->config->item('api_url') . '?c=304&gp=' . $roomxu . '&ts=' . $fromDate . '&te=' . $toDate . '&mt=' . $money . '&gs=' . $nguonxuat . '&type=2&tt=' . $filterdate . '&bl=');
        }
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function reportgcvhajax()
    {
        $roomvin = $this->input->post("roomvin");
        $roomxu = $this->input->post("roomxu");
        $nguonxuat = $this->input->post("nguonxuat");
        $fromDate = urlencode($this->input->post("fromDate"));
        $toDate = urlencode($this->input->post("toDate"));
        $money = $this->input->post("money");
        $filterdate = $this->input->post("filterdate");
        if ($money == 1) {
            $datainfo = $this->get_data_curl($this->config->item('api_url') . '?c=304&gp=' . $roomvin . '&ts=' . $fromDate . '&te=' . $toDate . '&mt=' . $money . '&gs=' . $nguonxuat . '&type=3&tt=' . $filterdate . '&bl=');
        } elseif ($money == 0) {
            $datainfo = $this->get_data_curl($this->config->item('api_url') . '?c=304&gp=' . $roomxu . '&ts=' . $fromDate . '&te=' . $toDate . '&mt=' . $money . '&gs=' . $nguonxuat . '&type=3&tt=' . $filterdate . '&bl=');
        }
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function reportgcdlajax()
    {
        $roomvin = $this->input->post("roomvin");
        $roomxu = $this->input->post("roomxu");
        $nguonxuat = $this->input->post("nguonxuat");
        $fromDate = urlencode($this->input->post("fromDate"));
        $toDate = urlencode($this->input->post("toDate"));
        $money = $this->input->post("money");
        $filterdate = $this->input->post("filterdate");
        if ($money == 1) {
            $datainfo = $this->get_data_curl($this->config->item('api_url') . '?c=304&gp=' . $roomvin . '&ts=' . $fromDate . '&te=' . $toDate . '&mt=' . $money . '&gs=' . $nguonxuat . '&type=1&tt=' . $filterdate . '&bl=');
        } elseif ($money == 0) {
            $datainfo = $this->get_data_curl($this->config->item('api_url') . '?c=304&gp=' . $roomxu . '&ts=' . $fromDate . '&te=' . $toDate . '&mt=' . $money . '&gs=' . $nguonxuat . '&type=1&tt=' . $filterdate . '&bl=');
        }
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function delgiftcode()
    {
        $datainfo = json_decode($this->file_get_contents($this->config->item('api_url') . '?c=10'));
        $this->data['listvin'] = $datainfo->giftcode_vin;
        $source = $this->sourcegiftcode_model->get_source_gift_code_marketing_view();
        $this->data['source'] = $source;
        $sourcevh = $this->sourcegiftcode_model->get_source_gift_code_vanhanh_view();
        $this->data['sourcevh'] = $sourcevh;
        $this->data['temp'] = 'admin/user/delgiftcode';
        $this->load->view('admin/main', $this->data);
    }

    function delgiftcodeajax()
    {
        $admin_login = $this->session->userdata('user_id_login');
        $admin_info = $this->admin_model->get_info($admin_login);
        $fromdate = urlencode($this->input->post("fromdate"));
        $todate = urlencode($this->input->post("todate"));
        $source = urlencode($this->input->post("nguonxuat"));
        $price = urlencode($this->input->post("roomvin"));

        $datainfo = $this->get_data_curl($this->config->item('api_url') . '?c=604&gp=' . $price . '&ts=' . $fromdate . '&te=' . $todate . '&gs=' . $source);
        $data = json_decode($datainfo);
        $num = $data->transactions->countGiftCode;
        if (isset($datainfo)) {
            if ($num > 0) {
                if ($source == "" && $price == "") {
                    $action = "Thu hồi giftcode được tạo từ ngày " . $this->input->post("fromdate") . " đến ngày " . $this->input->post("todate") . " số lượng: " . $num;
                } else if ($source == "" && $price != "") {
                    $action = "Thu hồi giftcode được tạo từ ngày " . $this->input->post("fromdate") . " đến ngày " . $this->input->post("todate") . " số lượng: " . $num . " mệnh giá " . $price . " K Vin";
                } else if ($source != "" && $price == "") {
                    $action = "Thu hồi giftcode được tạo từ ngày " . $this->input->post("fromdate") . " đến ngày " . $this->input->post("todate") . " số lượng: " . $num . " mã " . $source;
                } else if ($source != "" && $price != "") {
                    $action = "Thu hồi giftcode được tạo từ ngày " . $this->input->post("fromdate") . " đến ngày " . $this->input->post("todate") . " số lượng: " . $num . " mệnh giá " . $price . " K Vin , mã " . $source;
                }
                $data = array(
                    'username' => $admin_info->UserName,
                    'account_name' => $admin_info->FullName,
                    'action' => $action
                );
                $this->logadmin_model->create($data);
            }
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function congtientaixiu()
    {
        $this->data['error'] = "";
        if ($this->input->post("ok")) {
            if (file_exists('public/admin/uploads/congtientaixiu.csv')) {
                unlink('public/admin/uploads/congtientaixiu.csv');
                $this->data['error'] = "Bạn xóa file cũ thành công";
            } else {
                $temp = explode(".", $_FILES["filexls"]["name"]);
                $extension = end($temp);
                if ($extension == "csv") {
                    $config = array("");
                    $config['upload_path'] = './public/admin/uploads';
                    $config['allowed_types'] = '*';
                    $config['max_size'] = 1024 * 8;
                    //  $config['overwrite'] = TRUE;
                    $config['file_name'] = 'congtientaixiu';
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('filexls')) {
                        $error = array('error' => $this->upload->display_errors());
                        $this->data['error'] = "Bạn chưa chọn file hoặc không được phân quyền";

                    } else {
                        $this->data['error'] = "";
                        $data = array('upload_data' => $this->upload->data());

                        $this->data['error'] = "Upload file thành công";
                    }
                } else {
                    $this->data['error'] = "Bạn chưa chọn file hoặc không chọn đúng file csv";
                }
            }

        }
        if (file_exists(FCPATH . "public/admin/uploads/congtientaixiu.csv") != false) {
            $this->load->library('csvreader');
            $result = $this->csvreader->parse_file(public_url('admin/uploads/congtientaixiu.csv'));
            $data = array();
            foreach ($result as $row) {
                if (isset($row["Nickname"]) && isset($row["Money"])) {
                    array_push($data, array(trim($row["Nickname"]) => intval($row["Money"])));
                }
            }
            $this->data['listnn'] = json_encode($data);

        } else {
            $this->data['listnn'] = "";
        }
        $this->data['temp'] = 'admin/user/congtientaixiu';
        $this->load->view('admin/main', $this->data);
    }

    function congtientaixiuajax()
    {
        $admin_login = $this->session->userdata('user_id_login');
        $admin_info = $this->admin_model->get_info($admin_login);
        $nickname = $this->input->post("nickname");
        $lydo = urlencode($this->input->post("lydo"));
        $money = urlencode($this->input->post("money"));
        $otp = urlencode($this->input->post("otp"));
        $typeotp = $this->input->post("typeotp");
        $action = $this->input->post("action");
//        $server_output = $this->file_get_contents($this->config->item('api_url')."?c=17&data=".$nickname."&mt=".$money."&rs=".$lydo."&otp=".$otp."&type=".$typeotp);
//        var_dump($server_output);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->config->item('api_url'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "c=17&data=" . $nickname . "&mt=" . $money . "&rs=" . $lydo . "&otp=" . $otp . "&type=" . $typeotp . "&ac=" . $action . "&ad=" . $admin_info->FullName . $this->getAuthBackend());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3600);

        $server_output = curl_exec($ch);

        $data = json_decode($server_output);

        if (isset($server_output)) {

            if ($data->errorCode == 0) {
                if ($action == "Admin") {
                    $this->logadmin_model->create($this->logadmingiftcode(20, $nickname, $admin_info->UserName, "", 0, $money));
                } elseif ($action == "EventVP") {
                    $this->logadmin_model->create($this->logadmingiftcode(19, $nickname, $admin_info->UserName, "", 0, $money));
                }
                if (file_exists('public/admin/uploads/congtientaixiu.csv')) {
                    unlink('public/admin/uploads/congtientaixiu.csv');
                }
            }
            echo $server_output;
        } else {
            echo "Bạn không được hack";
        }
        curl_close($ch);

    }

    function delsecuser()
    {
        $this->data['temp'] = 'admin/user/delsecuser';
        $this->load->view('admin/main', $this->data);
    }

    function update2fa()
    {
        $this->data['temp'] = 'admin/user/update2fa';
        $this->load->view('admin/main', $this->data);
    }

    function getqrajax()
    {
        $username = $this->session->userdata("usernameadmin");

        $datainfo = $this->get_data_curl($this->config->item('api_url') . '?c=2000&un=' . urlencode($username));
        //echo "get qrajax";
        //print_r($datainfo);
        $data = json_decode($datainfo);
        echo $datainfo;

    }

    function updateotpajax()
    {
        $username = $this->session->userdata("usernameadmin");
        $sec = $this->input->post('sec');
        $otp = $this->input->post('otp');
        $act = $this->input->post('act');
        $datainfo = $this->get_data_curl($this->config->item('api_url') . '?c=2000&un=' . urlencode($username) . '&secret=' . $sec . '&otp=' . $otp . '&act=' . $act);
        $data = json_decode($datainfo);
        if (!isset($data)) {
            return;

        }
        if ($act == "rm" && isset($data->errorCode) && $data->errorCode == 0) {
            $this->session->set_userdata('isAppSecure', 0);
        } elseif ($act != "rm" && $data->errorCode == 0) {
            $this->session->set_userdata('isAppSecure', 1);
        }
        echo $datainfo;
    }

    function huybaomat()
    {
        $nickname = $this->input->post('nickname');
        $ac = $this->input->post('ac');
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c='.$ac .'&nickname=' . $nickname);
        
        if (isset($datainfo)) {
            echo 0;
        } else {
            echo "Bạn không được hack";
        }
    }

    function listSecTele()
    {
        $this->data['temp'] = 'admin/user/listSecTele';
        $this->load->view('admin/main', $this->data);
    }
    function listSecAjax() {
        $nn = $this->input->post("nickname");
        $p = $this->input->post("page");
        $ps = $this->input->post("pageSize");
        $phone = $this->input->post("phone");
        $c = $this->input->post("c");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c='.$c .'&nickname=' . urlencode($nn).'&pageIndex=' . $p . '&pageSize=' . $ps . '&phone=' . $phone);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function congtruslot()
    {
        $this->data['temp'] = 'admin/user/congtruslot';
        $this->load->view('admin/main', $this->data);
    }

    function congtruslotajax()
    {
        $admin_login = $this->session->userdata('user_id_login');
        $admin_info = $this->admin_model->get_info($admin_login);
        $nickname = $this->input->post('nickname');
        $number = $this->input->post('number');
        $type = $this->input->post('type');
        $otp = $this->input->post('otp');
        $slot = $this->input->post('slot');
        $datainfo = $this->file_get_contents($this->config->item('api_url') . '?c=30&nn=' . urlencode($nickname) . '&otp=' . $otp . '&type=' . $type . '&va=' . $number . '&gn=' . $slot . '&ad=' . $admin_info->FullName);
        $data = json_decode($datainfo);
        if (isset($datainfo)) {
            if ($data->errorCode == 0) {
                if ($number > 0) {
                    $data = array(
                        'action' => "Cộng " . $number . "  lượt quay slot " . $slot,
                        'account_name' => $nickname,
                        'username' => $admin_info->UserName
                    );

                } else {
                    $data = array(
                        'action' => "Trừ " . (-$number) . "  lượt quay slot " . $slot,
                        'account_name' => $nickname,
                        'username' => $admin_info->UserName
                    );
                }
                $this->logadmin_model->create($data);
            }
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function congtrutienbot()
    {
        $this->data['temp'] = 'admin/user/congtrutienbot';
        $this->load->view('admin/main', $this->data);
    }


    function congtrutienbotajax()
    {
        $admin_login = $this->session->userdata('user_id_login');
        $admin_info = $this->admin_model->get_info($admin_login);
        $tienchuyen = $this->input->post("tienchuyen");
        $otp = $this->input->post("otp");
        $nickname = $this->input->post("nickname");
        $type = $this->input->post("typeotp");
        $datainfo = $this->file_get_contents($this->config->item('api_backend') . '?c=1994&nn=' . $nickname . '&mn=' . $tienchuyen . '&otp=' . $otp . '&type=' . $type . '&ad=' . $admin_info->FullName);
        $data = json_decode($datainfo);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Giao dịch không hợp lệ";
        }
    }


    //=============================BAU cUA========================================
    function quanlybaucua()
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
        $this->data['temp'] = 'admin/user/quanlybaucuato';
        $this->load->view('admin/main', $this->data);
    }
    //=============================xocdia========================================
    function quanlyxocdia()
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
        $this->data['temp'] = 'admin/user/quanlyxocdia';
        $this->load->view('admin/main', $this->data);
    }

    //=============================xocdia========================================
    function quanlyxocdiakubet()
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
        $this->data['temp'] = 'admin/user/quanlyxocdiakubet';
        $this->load->view('admin/main', $this->data);
    }

    //=============================becangxocdia==================================


    function beCauxocdiaAjax()
    {
        $status = ($this->input->post("status"));
        $dice1 = ($this->input->post("dice1"));
        $dice2 = ($this->input->post("dice2"));
        $dice3 = ($this->input->post("dice3"));
        $dice4 = ($this->input->post("dice4"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4014&st=' . $status . '&dc1=' . $dice1 . '&dc2=' . $dice2 . '&dc3=' . $dice3. '&dc4=' . $dice4);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
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
        $status = ($this->input->post("status"));
        $dice1 = ($this->input->post("dice1"));
        $dice2 = ($this->input->post("dice2"));
        $dice3 = ($this->input->post("dice3"));

        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=3705&st=' . $status . '&dc1=' . $dice1 . '&dc2=' . $dice2 . '&dc3=' . $dice3);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    // =-====================================TX================================

    /**
     * tuongvx
     * Thêm code bẻ càng tài xỉu
     */
    function becangtaixiu()
    {
        $this->data['temp'] = 'admin/user/becangtaixiu';
        $this->load->view('admin/main', $this->data);
    }

    function becangtaixiukubet()
    {
        $this->data['temp'] = 'admin/user/becangtaixiukubet';
        $this->load->view('admin/main', $this->data);
    }

    function becangtaixiumd5()
    {
        $this->data['temp'] = 'admin/user/becangtaixiumd5';
        $this->load->view('admin/main', $this->data);
    }

    function becongthe()
    {
        $this->data['temp'] = 'admin/user/becongthe';
        $this->load->view('admin/main', $this->data);
    }

    function setcongtheajax()
    {
        $congnap = urlencode($this->input->post("congnap"));
        $type = urlencode($this->input->post("type"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4071&congnap=' . $congnap.'&type='.$type);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    /**
     * thuc hien call api be cang tai xiu
     */
    function becangtaixiuajax()
    {
        $acbe = $this->input->post("acbe");
        $nohu = $this->input->post("nohu");
        $datainfo = file_get_contents($this->config->item('api_backend') . '?c=6666&action=' . $acbe . '&nohu=' . $nohu);
        echo $datainfo;
    }

    function becangtaixiukubetajax()
    {
        $acbe = $this->input->post("acbe");
        $nohu = $this->input->post("nohu");
        $datainfo = file_get_contents($this->config->item('api_backend') . '?c=6666&action=' . $acbe . '&nohu=' . $nohu);
        echo $datainfo;
    }

    /**
     * thuc hien call api be cang tai xiu MD5
     */
    function becangtaixiumd5ajax()
    {
        $acbe = $this->input->post("acbe");
        $nohu = $this->input->post("nohu");
        $datainfo = file_get_contents($this->config->item('api_backend') . '?c=556666&action=' . $acbe . '&nohu=' . $nohu);
        echo $datainfo;
    }
    function updateHuTaiXiu()
    {
        $minHu = $this->input->post("minHu");
        $maxHu = $this->input->post("maxHu");
        $hu = $this->input->post("hu");
        $datainfo = file_get_contents($this->config->item('api_backend') . '?c=6670&huMin=' . $minHu . '&huMax=' . $maxHu.'&hu='.$hu);
        echo $datainfo;
    }

    function updateHuXocDia()
    {
        $minHu = $this->input->post("minHu");
        $maxHu = $this->input->post("maxHu");
        $hu = $this->input->post("hu");
        $datainfo = file_get_contents($this->config->item('api_backend') . '?c=6671&huMin=' . $minHu . '&huMax=' . $maxHu.'&hu='.$hu);
        echo $datainfo;
    }

    function getResultXocDia()
    {
        $datainfo = file_get_contents($this->config->item('api_backend') . '?c=6672');
        echo $datainfo;
    }
    /**
     * thuc hien call api be cang tai xiu
     */
    function updateSetBot()
    {
        $moneyMin = $this->input->post("moneyMin");
        $moneyMax = $this->input->post("moneyMax");
        $numberUserTaiMax = $this->input->post("numberUserTaiMax");
        $numberUserXiuMax = $this->input->post("numberUserXiuMax");
        $datainfo = file_get_contents($this->config->item('api_backend') . '?c=70&moneyMin=' . $moneyMin . '&moneyMax=' . $moneyMax . '&numberUserTaiMax=' . $numberUserTaiMax . '&numberUserXiuMax=' . $numberUserXiuMax);
        echo $datainfo;
    }

    function updateSetBotKuabet()
    {
        $moneyMin = $this->input->post("moneyMin");
        $moneyMax = $this->input->post("moneyMax");
        $numberUserTaiMax = $this->input->post("numberUserTaiMax");
        $numberUserXiuMax = $this->input->post("numberUserXiuMax");
        $numberUserChanMax = $this->input->post("numberUserChanMax");
        $numberUserLeMax = $this->input->post("numberUserLeMax");
        $datainfo = file_get_contents($this->config->item('api_backend') . '?c=5670&moneyMin=' . $moneyMin . '&moneyMax=' . $moneyMax . '&numberUserTaiMax=' . $numberUserTaiMax . '&numberUserXiuMax=' . $numberUserXiuMax . '&numberUserChanMax=' . $numberUserChanMax . '&numberUserLeMax=' . $numberUserLeMax);
        echo $datainfo;
    }

    /**
     * thuc hien call api be cang tai xiu
     */
    function chatAjax()
    {
        $nickName = $this->input->post("nickname");
        $content = $this->input->post("content");
        $datainfo = file_get_contents($this->config->item('api_backend') . '?c=6669&nickname=' . $nickName . '&content=' . urlencode($content));
        echo $datainfo;
    }

    /**
     * set bot fake tai xiu
     */
    function setBotFakeAjax()
    {
        $numberBotTaiFake = $this->input->post("numberBotTaiFake");
        $numberBotXiuFake = $this->input->post("numberBotXiuFake");
        $datainfo = file_get_contents($this->config->item('api_backend') . '?c=4036&numberBotTaiFake=' . $numberBotTaiFake . '&numberBotXiuFake=' . $numberBotXiuFake);
        echo $datainfo;
    }

    /**
     * set bot fake tai xiu MD5
     */
    function setBotFakeMD5Ajax()
    {
        $numberBotTaiFake = $this->input->post("numberBotTaiFake");
        $numberBotXiuFake = $this->input->post("numberBotXiuFake");
        $datainfo = file_get_contents($this->config->item('api_backend') . '?c=554036&numberBotTaiFake=' . $numberBotTaiFake . '&numberBotXiuFake=' . $numberBotXiuFake);
        echo $datainfo;
    }
    /**
     * thuc hien call api set bot tai xiu MD5
     */
    function updateSetBotMD5()
    {
        $moneyMin = $this->input->post("moneyMin");
        $moneyMax = $this->input->post("moneyMax");
        $numberUserTaiMax = $this->input->post("numberUserTaiMax");
        $numberUserXiuMax = $this->input->post("numberUserXiuMax");
        $datainfo = file_get_contents($this->config->item('api_backend') . '?c=5570&moneyMin=' . $moneyMin . '&moneyMax=' . $moneyMax . '&numberUserTaiMax=' . $numberUserTaiMax . '&numberUserXiuMax=' . $numberUserXiuMax);
        echo $datainfo;
    }

    /**
     * thuc hien call api be cang tai xiu MD5
     */
    function chatMD5Ajax()
    {
        $nickName = $this->input->post("nickname");
        $content = $this->input->post("content");
        $datainfo = file_get_contents($this->config->item('api_backend') . '?c=556669&nickname=' . $nickName . '&content=' . urlencode($content));
        echo $datainfo;
    }

    /**
     * thuc hien call api thong tin bot be cang tai xiu MD5
     */
    function getInforSetBotMD5()
    {
        $datainfo = file_get_contents($this->config->item('api_backend') . '?c=556699');
        $data = json_decode($datainfo);
        echo $datainfo;
    }
    /**
     * thuc hien call api be cang tai xiu
     */
    function chatAjaxList()
    {
        $content = $this->input->post("content");
        $datainfo = file_get_contents($this->config->item('api_backend') . '?c=6696&content=' . urlencode($content));
        echo $datainfo;
    }


    function getInforSetBot()
    {
        $datainfo = file_get_contents($this->config->item('api_backend') . '?c=6699');
        $data = json_decode($datainfo);
        echo $datainfo;
    }

    function getInforSetBotKuabet()
    {
        $datainfo = file_get_contents($this->config->item('api_backend') . '?c=566699');
        $data = json_decode($datainfo);
        echo $datainfo;
    }

    /**
     * thuc hien call api be cang tai xiu
     */
    function getResultBecangTaixiu()
    {
        $datainfo = file_get_contents($this->config->item('api_backend') . '?c=6667');
        echo $datainfo;
    }

    /**
     * thuc hien call api be cang tai xiu MD5
     */
    function getResultBecangTaixiuMD5()
    {
        $datainfo = file_get_contents($this->config->item('api_backend') . '?c=556667');
        echo $datainfo;
    }
  
    /**
     * thuc hien call api be cang tai xiu MD5
     */
    function getNumberUserPlayTaixiuMD5Ajax()
    {
        $datainfo = file_get_contents($this->config->item('api_backend') . '?c=556668');
        $data = json_decode($datainfo);
        echo $datainfo;
    }

    /**
     * thuc hien call api lay danh sach bot chat tai xiu md5
     */
    function getListBotChatTaixiuMD5Ajax()
    {
        $datainfo = file_get_contents($this->config->item('api_backend') . '?c=556669');
        $data = json_decode($datainfo);
        echo $datainfo;
    }

    /**
     * thuc hien call api be cang tai xiu
     */
    function getNumberUserPlayTaixiuAjax()
    {
        $datainfo = file_get_contents($this->config->item('api_backend') . '?c=6668');
        $data = json_decode($datainfo);
        echo $datainfo;
    }

    /**
     * thuc hien call api laay danh sach bot chat
     */
    function getListBotChatTaixiuAjax()
    {
        $datainfo = file_get_contents($this->config->item('api_backend') . '?c=69');
        $data = json_decode($datainfo);
        echo $datainfo;
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

        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4005&Id=' . $id . '&session=' . $session . '&doiA=' . $doiA . '&doiB=' . $doiB . '&banThangDoiA=' . $banThangDoiA . '&banThangDoiB=' . $banThangDoiB . '&thoiGianDa=' . $thoiGianDa . '&tiLeDoiAChapCaTran=' . $tiLeDoiAChapCaTran . '&tiLeDoiBChapCaTran=' . $tiLeDoiBChapCaTran . '&tileDoiAChapTaiXiu=' . $tileDoiAChapTaiXiu . '&tileDoiBChapTaiXiu=' . $tileDoiBChapTaiXiu . '&tileDoiAChapHiep1=' . $tileDoiAChapHiep1 . '&tileDoiBChapHiep1=' . $tileDoiBChapHiep1 . '&tileDoiAChapHiep2=' . $tileDoiAChapHiep2 . '&tileDoiBChapHiep2=' . $tileDoiBChapHiep2 . '&tileAnDoiACaTran=' . $tileAnDoiACaTran . '&tileAnDoiBCaTran=' . $tileAnDoiBCaTran . '&tileAnDoiATaiXiu=' . $tileAnDoiATaiXiu . '&tileAnDoiBTaiXiu=' . $tileAnDoiBTaiXiu . '&tileAnDoiAHiep1=' . $tileAnDoiAHiep1 . '&tileAnDoiBHiep1=' . $tileAnDoiBHiep1 . '&tileAnDoiAHiep2=' . $tileAnDoiAHiep2 . '&tileAnDoiBHiep2=' . $tileAnDoiBHiep2 . '&status=0&url=none');
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function dongcuockeoajax()
    {

        $id = urlencode($this->input->post("Id"));
        $status = urlencode($this->input->post("status"));

        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4007&Id=' . $id . '&status=' . $status);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function xoacuockeoajax()
    {
        $id = urlencode($this->input->post("Id"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4009&Id=' . $id);
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

        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4003&session=' . $session . '&doiA=' . $doiA . '&doiB=' . $doiB . '&banThangDoiA=' . $banThangDoiA . '&banThangDoiB=' . $banThangDoiB . '&thoiGianDa=' . $thoiGianDa . '&tiLeDoiAChapCaTran=' . $tiLeDoiAChapCaTran . '&tiLeDoiBChapCaTran=' . $tiLeDoiBChapCaTran . '&tileDoiAChapTaiXiu=' . $tileDoiAChapTaiXiu . '&tileDoiBChapTaiXiu=' . $tileDoiBChapTaiXiu . '&tileDoiAChapHiep1=' . $tileDoiAChapHiep1 . '&tileDoiBChapHiep1=' . $tileDoiBChapHiep1 . '&tileDoiAChapHiep2=' . $tileDoiAChapHiep2 . '&tileDoiBChapHiep2=' . $tileDoiBChapHiep2 . '&tileAnDoiACaTran=' . $tileAnDoiACaTran . '&tileAnDoiBCaTran=' . $tileAnDoiBCaTran . '&tileAnDoiATaiXiu=' . $tileAnDoiATaiXiu . '&tileAnDoiBTaiXiu=' . $tileAnDoiBTaiXiu . '&tileAnDoiAHiep1=' . $tileAnDoiAHiep1 . '&tileAnDoiBHiep1=' . $tileAnDoiBHiep1 . '&tileAnDoiAHiep2=' . $tileAnDoiAHiep2 . '&tileAnDoiBHiep2=' . $tileAnDoiBHiep2 . '&status=0&url=none');
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }


    function listkeobongdaajax()
    {

        $session = urlencode($this->input->post("session"));
        $frdate = urlencode($this->input->post("frD"));
        $todate = urlencode($this->input->post("todate"));
        $page = urlencode($this->input->post("page"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4008&session=' . $session . '&start=' . $frdate . '&end=' . $todate . '&p=' . $page);
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
            $start_time = date('Y-m-d 00:00:00');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 00:00:00', strtotime('+2 days'));
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
            $start_time = date('Y-m-d 00:00:00');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 00:00:00', strtotime('+2 days'));
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

    function trathuongbongdaajax()
    {
        $session = urlencode($this->input->post("session"));
        $id = urlencode($this->input->post("id"));
        $idTran = urlencode($this->input->post("idTran"));
        $moenyWin = urlencode($this->input->post("moenyWin"));
        $nickname = urlencode($this->input->post("nickname"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4006&session=' . $session . '&id=' . $id . '&idTran=' . $idTran . '&moenyWin=' . $moenyWin . '&nickname=' . $nickname);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }
  // ===================================Lô ĐỀ ===================================================
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
        $this->data['temp'] = 'admin/user/addketqualode';
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
        $this->data['temp'] = 'admin/user/tinhtoantrathuong';
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

    // =================================== ĐUA TỐP TX ===================================================
    function  duatoptaixiu()
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
            $start_time = date('Y-m-d 00:00:00');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;

        $start_time2 = null;
        $end_time2 = null;
        if ($this->input->post('fromDate2')) {
            $start_time2 = $this->input->post('fromDate2');
        }

        if ($this->input->post('toDate2')) {
            $end_time2 = $this->input->post('toDate2');
        }

        if ($start_time2 === null) {
            $start_time2 = date('Y-m-01 00:00:00');
        }
        if ($end_time2 === null) {
            $end_time2 = date('Y-m-d 23:59:59');
        }
        $this->data['start_time2'] = $start_time2;
        $this->data['end_time2'] = $end_time2;


        $this->data['temp'] = 'admin/user/duatoptaixiu';
        $this->load->view('admin/main', $this->data);
    }

    function  getlistvinhdanhAjax()
    {
        $start_time = urlencode($this->input->post("fromDate"));
        $time_end = urlencode($this->input->post("toDate"));
        $limitNumber = urlencode($this->input->post("limitNumber"));
        $datainfo = $this->get_data_curl($this->config->item('api_url') . '?c=4008&beginTime=' . $start_time . '&endTime=' . $time_end . '&limitNumber=' . $limitNumber);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function  trathuongduatopAjax()
    {
        $nickname = urlencode($this->input->post("nickname"));
        $bonus = urlencode($this->input->post("bonus"));
        $datainfo = $this->get_data_curl($this->config->item('api_url') . '?c=4009&nn=' . $nickname . '&bonus=' . $bonus);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }

    }

    function botdaily()
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

        $this->data['temp'] = 'admin/user/botdaily';
        $this->load->view('admin/main', $this->data);
    }

    function listbotdailyajax()
    {
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4016');
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function addbotdailyajax()
    {
        $nickName = urlencode($this->input->post("nickName"));
        $id = urlencode($this->input->post("idTele"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4017&nn=' . $nickName . '&id=' . $id);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function removebotdailyajax()
    {
        $nickName = urlencode($this->input->post("nickName"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4018&nn=' . $nickName);
        if ($datainfo) {
            echo $datainfo;
        } else {
            echo "1001";
        }
    }


    function thongketaiyou88()
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
            $start_time = date('Y-m-d H:i:s', strtotime('-1 days'));
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;

        $this->data['temp'] = 'admin/user/thongketaiyou88';
        $this->load->view('admin/main', $this->data);
    }

    function listDoimainajax()
    {
        $start_time = urlencode($this->input->post("fromDate"));
        $time_end = urlencode($this->input->post("toDate"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4019&ts=' . $start_time . '&te=' . $time_end);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function listAccountActivePhone()
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
            $start_time = date('Y-m-d H:i:s', strtotime('-1 days'));
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;

        $this->data['temp'] = 'admin/user/listaccountactivephone';
        $this->load->view('admin/main', $this->data);
    }

    function listAccountActivePhoneAjax()
    {
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4022');
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }
	
	function listAccountActivePhoneByTimeAjax()
    {
		$start_time = urlencode($this->input->post("fromDate"));
        $time_end = urlencode($this->input->post("toDate"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4032&startDate=' . $start_time . '&endDate=' . $time_end);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }
	
	function findAccountActivePhoneAjax()
    {
        $timkiem = urlencode($this->input->post("timkiem"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4031&timkiem=' . $timkiem);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function DeleteAccountActivePhoneAjax()
    {
        $nickname = urlencode($this->input->post("nickname"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4023&nickname=' . $nickname);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function ActivePhoneAccountAjax()
    {
        $nickname = urlencode($this->input->post("nickname"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4037&nickname=' . $nickname);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }
	
	function listAccountSunwin()
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
            $start_time = date('Y-m-d H:i:s', strtotime('-1 days'));
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;

        $this->data['temp'] = 'admin/user/listaccountsunwin';
        $this->load->view('admin/main', $this->data);
    }

    function listAccountSunWinByTimeAjax()
    {
		$page = urlencode($this->input->post("page"));
        $maxitem = urlencode($this->input->post("maxitem"));
		$timestart = urlencode($this->input->post("timestart"));
		$timeend = urlencode($this->input->post("timeend"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4040&page=' . $page . '&maxitem=' . $maxitem. '&timestart=' . $timestart. '&timeend=' . $timeend);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }
	
	function DeleteAccountSunwinAjax()
    {
        $username = urlencode($this->input->post("username"));
		$timelog = urlencode($this->input->post("timelog"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4041&username=' . $username . '&timelog=' . $timelog);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function listaccountplayslot()
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
            $start_time = date('Y-m-d H:i:s', strtotime('-1 days'));
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;

        $this->data['temp'] = 'admin/user/listaccountplayslot';
        $this->load->view('admin/main', $this->data);
    }


    function listcodetanthu()
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
            $start_time = date('Y-m-d H:i:s', strtotime('-1 days'));
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;

        $this->data['temp'] = 'admin/user/listcodetanthu';
        $this->load->view('admin/main', $this->data);
    }

    function listCodeTanThuAjax()
    {
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4029');
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function addCodeTanThuAjax()
    {
        $code = urlencode($this->input->post("code"));
        $money = urlencode($this->input->post("money"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4025&code=' . $code . '&money=' . $money);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function searchCodeTanThuAjax()
    {
        $code = urlencode($this->input->post("code"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4028&code=' . $code);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function deleteCodeTanThuAjax()
    {
        $code = urlencode($this->input->post("code"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4026&code=' . $code);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function updateCodeTanThuAjax()
    {
        $code = urlencode($this->input->post("code"));
        $stop = urlencode($this->input->post("stop"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4027&code=' . $code . '&stop=' . $stop);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }
	
	function listAccountVerificalBank()
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
            $start_time = date('Y-m-d H:i:s', strtotime('-1 days'));
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;

        $this->data['temp'] = 'admin/user/listaccountverificalbank';
        $this->load->view('admin/main', $this->data);
    }

    function updateBankInfo()
    {
    
        $this->data['temp'] = 'admin/user/updatebankinfo';
        $this->load->view('admin/main', $this->data);
    }

    function findBankByNicknameAjax()
    {
        $nickname = urlencode($this->input->post("nickname"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=11015&nickName=' . $nickname);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }
    function updateMomoInfo()
    {
    
        $this->data['temp'] = 'admin/user/updatemomoinfo';
        $this->load->view('admin/main', $this->data);
    }

    function findMomoByNicknameAjax()
    {
        $nickname = urlencode($this->input->post("nickname"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=11045&nickName=' . $nickname);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }
    function updateMomoInfoAjax()
    {
        $nickname = urlencode($this->input->post("nickname"));
        $phoneName = urlencode($this->input->post("phoneName"));
        $phoneNumber = urlencode($this->input->post("phoneNumber"));
        $id = urlencode($this->input->post("id"));
        
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=11046&nickName=' . $nickname.'&phoneName='.$phoneName.'&phoneNumber='.$phoneNumber.'&id='.$id);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }
    function findAccountVerificalBankAjax()
    {
        $nickname = urlencode($this->input->post("nickname"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4056&nickname=' . $nickname);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }
    
    function updateBankInfoAjax()
    {
        $nickname = urlencode($this->input->post("nickname"));
        $bankName = urlencode($this->input->post("bankName"));
        $accountName = urlencode($this->input->post("accountName"));
        $id = urlencode($this->input->post("id"));
        $bankAccount = urlencode($this->input->post("bankAccount"));
        
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=11044&nickName=' . $nickname.'&bankName='.$bankName.'&accountName='.$accountName.'&id='.$id.'&bankAccount='.$bankAccount);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }
    function DeleteAccountVerificalBankAjax()
    {
        $nickname = urlencode($this->input->post("nickname"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4057&nickname=' . $nickname);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }


    function seogame()
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
            $start_time = date('Y-m-d H:i:s', strtotime('-1 days'));
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s', strtotime('1 days'));
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;

        $this->data['temp'] = 'admin/user/seogame';
        $this->load->view('admin/main', $this->data);
    }

    // DANH SÁCH TÀI KHOẢN Nhatvip

    function listAccountNhatvip()
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
            $start_time = date('Y-m-d H:i:s', strtotime('-1 days'));
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;

        $this->data['temp'] = 'admin/user/listaccountnhatvip';
        $this->load->view('admin/main', $this->data);
    }

    function listAccountNhatvipByTimeAjax()
    {
        $page = urlencode($this->input->post("page"));
        $maxitem = urlencode($this->input->post("maxitem"));
        $timestart = urlencode($this->input->post("timestart"));
        $timeend = urlencode($this->input->post("timeend"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4060&page=' . $page . '&maxitem=' . $maxitem . '&timestart=' . $timestart . '&timeend=' . $timeend);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function DeleteAccountNhatvipAjax()
    {
        $username = urlencode($this->input->post("username"));
        $timelog = urlencode($this->input->post("timelog"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4061&username=' . $username . '&timelog=' . $timelog);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    // DANH SÁCH TÀI KHOẢN V8CLUB

    function listAccountV8club()
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
            $start_time = date('Y-m-d H:i:s', strtotime('-1 days'));
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;

        $this->data['temp'] = 'admin/user/listaccountv8club';
        $this->load->view('admin/main', $this->data);
    }

    function listAccountV8clubByTimeAjax()
    {
        $page = urlencode($this->input->post("page"));
        $maxitem = urlencode($this->input->post("maxitem"));
        $timestart = urlencode($this->input->post("timestart"));
        $timeend = urlencode($this->input->post("timeend"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4064&page=' . $page . '&maxitem=' . $maxitem . '&timestart=' . $timestart . '&timeend=' . $timeend);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function DeleteAccountV8clubAjax()
    {
        $username = urlencode($this->input->post("username"));
        $timelog = urlencode($this->input->post("timelog"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4065&username=' . $username . '&timelog=' . $timelog);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }


    function xoataikhoan()
    {
        $this->data['temp'] = 'admin/user/xoataikhoan';
        $this->load->view('admin/main', $this->data);
    }

    function xoataikhoanajax()
    {
        $username = urlencode($this->input->post("username"));
        $nickname = urlencode($this->input->post("nickname"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=4067&username=' . $username . '&nickname=' . $nickname);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }
}
