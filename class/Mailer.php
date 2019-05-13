<?php
    require_once (dirname(__FILE__)."\Items.php");

class Mailer{

    public $result1;
    public $result2;
    public $failed;

    /**
     * 管理者と投稿者の両方に投稿内容をメールする
     */
    public function sendMail(Items $items){
    if($errMessage = $items->errCheck() == ""){
        //$this->result1 = $this->sendMailTemplate("morita@xend.co.jp",$items->makeMailBody());//社長のアドレスのためテスト中はコメントアウトすること。
        $this->result2 = $this->sendMailTemplate($items->address,$items->makeMailBody());
    }
    else{
        $this->result1 = "";
        $this->result2 = "";
        $this->failed = $errMessage;
        }
    }

    private function sendMailTemplate($to,$message){
        mb_language("Japanese");
        mb_internal_encoding("UTF-8");

        $title = "投稿を受理いたしました。";

        if(mb_send_mail($to,$title,$message)){
            $result = $to . "へのメールを送信しました。";
        }
        else{
            $result = $to . "へのメール送信に失敗しました。";
        } 
        return $result;
    }
}
?>