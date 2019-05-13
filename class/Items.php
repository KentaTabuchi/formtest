<?php
require_once (dirname(__FILE__)."\..\index.php");
class Items{
    public $name;
    public $phone;
    public $address;
    public $readdress;
    public $consultTitle;
    public $consultContents;

    /**
     * 投稿内容をコンストラクタでメンバ変数に移す
     */
    public function __construct(){
        if(isset($_POST['name'])){
            $this->name =$_POST['name'];
        }else{
            $this->name = "";
        }
        if(isset($_POST['phone'])){
            $this->phone =$_POST['phone'];
        }else{
            $this->phone = "";
        }
        if(isset($_POST['address'])){
            $this->address =$_POST['address'];
        }else{
            $this->address = "";
        }
        if(isset($_POST['readdress'])){
            $this->readdress =$_POST['readdress'];
        }else{
            $this->readdress = "";
        }
        if(isset($_POST['consultTitle'])){
            $this->consultTitle =$_POST['consultTitle'];
        }else{
            $this->consultTitle = "";
        }
            
        if(isset($_POST['consultContents'])){
            $this->consultContents =$_POST['consultContents'];
        }else{
            $this->consultContents = "";
        }    
    }
    /**
     * 送信前に入力ミスのチェックを行う
     * @return 問題なければ true 漏れがあれば false を返す
     */
    public function errCheck(){
        $isValidated = true;

        if(empty($this->name) || empty($this->phone) || empty($this->address) || empty($this->whichConsult)){
            $isValidated = false;
        }
        if(ctype_digit($this->phone) == false){
            $isValidated = false;
        }
        if($this->address != $this->readdress){
            $isValidated = false;
        }
        if(preg_match('/..*@.*\..*/',$this->address) == false){
            $isValidated = false;
        }
        
        return $isValidated;
    }
    /**
     * 投稿内容を整形してメール本文を作成
     * @return 出来上がったメール本文
     */
    public function makeMailBody(){
        
        if($this->whichConsult == "1"){
            $this->consultItem = "無料のご相談";
        }
        else{
            $this->consultItem ="その他のご質問";
        }
        
        $mailBody = "
---------------------------------------------------------------
【お名前】 {$this->name}
【お電話番号】 {$this->phone}
【メールアドレス】 {$this->address}
【ご相談項目】 {$this->consultItem}
【ご相談内容】
{$this->consultContents}
---------------------------------------------------------------
        ";
        return $mailBody;
    }
}

?>