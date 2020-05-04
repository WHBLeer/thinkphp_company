<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
// 应用公共文件
use phpmailer\phpmailer;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use think\Db;

if (!function_exists('send_email')) {
    /**
     * 公共发送邮件函数
     * @Author   wanghongbin
     * @Email    wanghongbin@ngoos.org
     * @DateTime 2018-07-17
     * @param    [type]                $subject [邮件主题]
     * @param    [type]                $content [邮件内容]
     * @param    [type]                $toname  [接收者]
     * @param    [type]                $toemail [接收者邮箱]
     * @return   [type]                         [description]
     */
    function send_email($subject,$content, $toname, $toemail){
        $mail_conf = db('conf')->where('sort=3')->select();
        $mail = new PHPMailer(true);
        $mail->isSMTP();                        // 使用SMTP服务
        $mail->CharSet      = "utf8";           // 编码格式为utf8，不设置编码的话，中文会出现乱码
        $mail->Host         = $mail_conf['smtphost'];// 发送方的SMTP服务器地址
        $mail->SMTPAuth     = true;             // 是否使用身份验证
        $mail->Username     = $mail_conf['smtpname'];// 发送方的163邮箱用户名
        $mail->Password     = $mail_conf['smtppwd'];//客户端授权密码
        $mail->SMTPSecure   = "ssl";            // 使用ssl协议方式
        $mail->Port         = $mail_conf['smtpport'];              // 163邮箱的ssl协议方式端口号是465/994
        $mail->setFrom($mail_conf['smtpname'],$mail_conf['mailname']);// 设置发件人信息
        $mail->addAddress($toemail,$toname);    // 设置收件人信息
        $mail->addReplyTo($mail_conf['smtpname'],$mail_conf['mailname']);// 设置回复人信息
        // $mail->addCC("xxx@163.com");         // 设置邮件抄送人
        // $mail->addBCC("xxx@163.com");            // 设置秘密抄送人
        // $mail->addAttachment("bug0.jpg");        // 添加附件
        $mail->Subject      = $subject;         // 邮件标题
        $mail->IsHTML(true);
        $mail->Body         = $content;         // 邮件正文
        //$mail->AltBody = "纯文本";               // 这个是设置纯文本方式显示的正文内容
        if(!$mail->send()){// 发送邮件
            // echo "错误: ".$mail->ErrorInfo;// 输出错误信息
            return $mail->ErrorInfo;
        }else{
            return 1;
        }
    }
}

if (!function_exists('send_test_email')) {
    /**
     * 公共发送邮件函数
     * @Author   wanghongbin
     * @Email    wanghongbin@ngoos.org
     * @DateTime 2018-07-17
     * @param    [type]                $subject [邮件主题]
     * @param    [type]                $toemail [接收者邮箱]
     * @return   [type]                         [description]
     */
    function send_test_email($conf){
        $mail = new PHPMailer(true);
        $mail->isSMTP();                        // 使用SMTP服务
        $mail->CharSet      = "utf8";           // 编码格式为utf8，不设置编码的话，中文会出现乱码
        $mail->Host         = $conf['smtphost'];// 发送方的SMTP服务器地址
        $mail->SMTPAuth     = true;             // 是否使用身份验证
        $mail->Username     = $conf['smtpname'];// 发送方的163邮箱用户名
        $mail->Password     = $conf['smtppwd'];//客户端授权密码
        $mail->SMTPSecure   = "ssl";            // 使用ssl协议方式
        $mail->Port         = $conf['smtpport'];              // 163邮箱的ssl协议方式端口号是465/994
        $mail->setFrom($conf['smtpname'],$conf['mailname']);// 设置发件人信息
        $mail->addAddress($conf['testmail'],'测试邮件接收者');    // 设置收件人信息
        $mail->addReplyTo($conf['smtpname'],$conf['mailname']);// 设置回复人信息
        $mail->Subject      = '测试邮件，勿回复';         // 邮件标题
        $mail->IsHTML(true);
        $mail->Body         = '<html><body><h2>当您看到这封邮件时，就证明您的邮件配置可用！</h2></br><h5>'.date('Y-m-d H:i:s').'</h5></body></html>';         // 邮件正文
        if(!$mail->send()){// 发送邮件
            return $mail->ErrorInfo;
        }else{
            return 1;
        }
    }
}

if (!function_exists('send_notify')) {
    /**
     * 发送消息给用户
     * @Author   wanghongbin
     * @Email    wanghongbin@ngoos.org
     * @DateTime 2018-09-06
     * @param    string                $type    [消息类型]
     * @param    string                $content [消息内容]
     * @param    string                $uids    [用户id，可以是数组，也可以是逗号隔开的字符串]
     * @return   [type]                         [description]
     */
    function send_notify($type = '', $content = '', $uids = '') {
        $uids = is_array($uids) ? $uids : explode(',', $uids);
        $list = [];
        foreach ($uids as $uid) {
            $list[] = [
                'uid_receive' => $uid,
                'uid_send'    => UID,
                'type'        => $type,
                'content'     => $content,
            ];
        }

        $MessageModel = model('user/message');
        return false !== $MessageModel->saveAll($list);
    }
}

if (!function_exists('excel_export')) {
    /**
     * excel表格导出
     * @param string $fileName 文件名称
     * @param array $headArr 表头名称
     * @param array $data 要导出的数据
     * @author static7  
     */
    function excel_export($fileName = '', $headArr = [], $datas = []) {
        foreach($datas as $item) $data[] = array_values($item);
        $dataArr[] = $headArr;
        $count = count($headArr);  //计算表头数量
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties();
        $sheet = $spreadsheet->getActiveSheet();
        $fileName .= "_" . date("Ymd", \think\Request::instance()->time()) . ".xlsx";
        /*--------------开始从数据库提取信息插入Excel表中------------------*/
        for ($a=0; $a < count($data); $a++) { 
            $dataArr[] = $data[$a];
        }
        for ($i=0; $i < count($dataArr[0]); $i++) { 
            for ($j=0; $j < count($dataArr); $j++) { 
                // $coord = Coordinate::stringFromColumnIndex($i) . ($j + 1);
                $coord = Coordinate::stringFromColumnIndex($i+1) . ($j+1);
                if (is_numeric($dataArr[$j][$i])) {
                    if ($dataArr[$j][$i]==0) {
                        $value = '否';
                    }else if ($dataArr[$j][$i]==1) {
                        $value = '是';
                    }else{
                        $value = ' '.$dataArr[$j][$i];
                    }
                }else{
                    $value = $dataArr[$j][$i];
                }
                
                $sheet->setCellValue($coord,$value);
            }
        }

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $fileName);
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        //删除清空：
        $spreadsheet->disconnectWorksheets();
        unset($spreadsheet);
        exit;
    }
}

if (!function_exists('trimall')) {
    /**
     * 删除所有的空格
     * @Author   wanghongbin
     * @Email    wanghongbin@ngoos.org
     * @DateTime 2018-07-19
     * @param    [type]                $str [description]
     * @return   [type]                     [description]
     */
    function trimall($str)
    {
        $oldchar=array(" ","　","\t","\n","\r");
        $newchar=array("","","","","");
        return str_replace($oldchar,$newchar,$str);
    }
}

if (!function_exists('re_substr')) {
    /**
     * 字符串截取，支持中文和其他编码
     * @param string  $str 需要转换的字符串
     * @param integer $start 开始位置
     * @param string  $length 截取长度
     * @param boolean $suffix 截断显示字符
     * @param string  $charset 编码格式
     * @return string
     */
    function re_substr($str, $start = 0, $length, $suffix = true, $charset = "utf-8") {
        $slice = mb_substr($str, $start, $length, $charset);
        $omit = mb_strlen($str) >= $length ? '...' : '';
        return $suffix ? $slice.$omit : $slice;
    }
}

if (!function_exists('word_time')) {
    /**
     * 把日期或者时间戳转为距离现在的时间
     * @param $time
     * @return bool|string
     */
    function word_time($time) {
        // 如果是日期格式的时间;则先转为时间戳
        if (!is_integer($time)) {
            $time = strtotime($time);
        }
        $int = time() - $time;
        if ($int <= 2){
            $str = sprintf('刚刚', $int);
        }elseif ($int < 60){
            $str = sprintf('%d秒前', $int);
        }elseif ($int < 3600){
            $str = sprintf('%d分钟前', floor($int / 60));
        }elseif ($int < 86400){
            $str = sprintf('%d小时前', floor($int / 3600));
        }elseif ($int < 1728000){
            $str = sprintf('%d天前', floor($int / 86400));
        }else{
            $str = date('Y-m-d H:i:s', $time);
        }
        return $str;
    }
}

if (!function_exists('delete_dir_file')) {
    /**
     * 循环删除目录和文件
     * @param string $dir_name
     * @return bool
     */
    function delete_dir_file($dir_name) {
        $result = false;
        if(is_dir($dir_name)){
            if ($handle = opendir($dir_name)) {
                while (false !== ($item = readdir($handle))) {
                    if ($item != '.' && $item != '..') {
                        if (is_dir($dir_name . DS . $item)) {
                            delete_dir_file($dir_name . DS . $item);
                        } else {
                            unlink($dir_name . DS . $item);
                        }
                    }
                }
                closedir($handle);
                if (rmdir($dir_name)) {
                    $result = true;
                }
            }
        }
     
        return $result;
    }
}

if (!function_exists('get_complete_url')) {
    /**
     * 完整URL链接
     * @Author   wanghongbin
     * @Email    wanghongbin@ngoos.org
     * @DateTime 2018-07-20
     * @param    string                $url [description]
     * @return   [type]                     [description]
     */
    function get_complete_url($url='')
    {
        if(preg_match("/^(http:\/\/|https:\/\/).*$/",$url)){
            return $url;
        }else{
            if (httpcode('https://'.$url)==200) {
                return 'https://'.$url;
            }
            return 'http://'.$url;
        }
    }
}

if (!function_exists('httpcode')) {
    /**
     * 判断链接是否可用
     * @Author   wanghongbin
     * @Email    wanghongbin@ngoos.org
     * @DateTime 2018-07-20
     * @param    [type]                $url [description]
     * @return   [type]                     [description]
     */
    function httpcode($url=''){
        $ch = curl_init();
        $timeout = 3;
        curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_exec($ch);
        $httpcode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $httpcode;
    }
}