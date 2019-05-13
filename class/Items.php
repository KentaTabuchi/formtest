<?php
require_once (dirname(__FILE__)."\..\index.php");
class Items{
    public $name;
    public $phone;
    public $address;
    public $readdress;
    public $consultTitle;
    public $consultContents;

    public $errMessages;
    public $whereErr;
    /**
     * 投稿内容をコンストラクタでメンバ変数に移す
     */
    public function __construct(){
        
        $this->errMessages = new stdClass();
        
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
     */
    public function errCheck(){
        $this->whereErr = "";

        if(empty($this->name) || empty($this->phone) || empty($this->address) || empty($this->whichConsult)){
            $this->whereErr .= "未入力項目が残っています。</br>";
        }
        if(ctype_digit($this->phone) == false){
            $this->whereErr .= "電話番号に数字以外が入っています。</br>";
        }
        if($this->address != $this->readdress){
<<<<<<< HEAD
            $this->whereErr .= "確認したアドレスと一致していません。</br>";
=======
            $isValidated = false;
>>>>>>> c8774d251b2a50cff33e565584ab5e55040d24a7
        }
        if(preg_match('/..*@.*\..*/',$this->address) == false){
            $this->whereErr .= "メールアドレスが間違っています。</br>";
        }
   
    }
    /**
     * フォームの各項目の入力ミスに対するメッセージを　項目名->エラーメッセージ　の　辞書構造体に返す
     */
    public function createErrorMessages(){
        if (empty($this->name)) {
            $this->errMessages->nameEmptyErr = "※未入力";}
        else{
            $this->errMessages->nameEmptyErr = "";
        }
        if (empty($this->phone)) {
            $this->errMessages->phoneEmptyErr = "※未入力";
        }
        else{
            $this->errMessages->phoneEmptyErr = "";
        }
        if (!(ctype_digit($this->phone))){ 
            $this->errMessages->phoneNumericErr = "※ハイフン抜きで数字だけ入力てください。";
        }
        else{
            $this->errMessages->phoneNumericErr = "";
        }
        if (empty($this->address)) {
            $this->errMessages->addressEmptyErr = "※未入力";
        }
        else{
            $this->errMessages->addressEmptyErr = "";
        }
        if (preg_match('/..*@.*\..*/',$this->address) == false){
            $this->errMessages->mailPatternErr = "※メールの形式になっていません。";
        }
        else{
            $this->errMessages->mailPatternErr = "";
        }
        if (empty($this->consultTitle)) {
            $this->errMessages->isConsultEmptyErr = "※未入力";
        }
        else{
            $this->errMessages->isConsultEmptyErr = "";
        }
        
        if($this->address != $this->readdress) {
            $this->errMessages->notMatchErr = "※アドレスが一致しません";
        }
        else{
            $this->errMessages->notMatchErr = "";
        }
    

    }
    /**
     * 投稿内容を整形してメール本文を作成
     * @return 出来上がったメール本文
     */
    public function makeMailBody(){
        
        if($this->consultTitle == "1"){
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