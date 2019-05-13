<?php
    require_once (dirname(__FILE__)."\class\Items.php");
    require_once (dirname(__FILE__)."\class\Mailer.php");
    
    $items = new Items();
<<<<<<< HEAD
    $mailer = new Mailer();
    $items->createErrorMessages();

    if($items->consultTitle==1) {
        $leftCheck = 'checked';}
    else {
        $leftCheck = '';
=======

    $name = $items->name;
    $phone = $items->phone;
    $address = $items->address;
    $readdress = $items->readdress;
    $consultTitle = $items->consultTitle;
    $consultContents = $items->consultContents;

    if (empty($name)) {
        $nameEmptyErr = "※未入力";}
    else{
        $nameEmptyErr = "";
    }
    if (empty($phone)) $phoneEmptyErr = "※未入力";
    if (ctype_digit($phone) == false) $phoneNumericErr = "※ハイフン抜きで数字だけ入力てください。"; 
    if (empty($address)) $addressEmptyErr = "※未入力";
    if(preg_match('/..*@.*\..*/',$address) == false) $mailPatternErr = "※メールの形式になっていません。";
    if (empty($consultTitle)) $isConsultEmptyErr = "※未入力";

    if($items->address != $items->consultContents) {
        $notMatchErr = "※アドレスが一致しません";
    }else{
        $notMatchErr = "";
    }

    if($items->consultTitle==1) $leftCheck = 'checked';
        else $leftCheck = '';
    if($items->consultTitle==2) $rightCheck = 'checked';
        else $rightCheck = '';
    
    function sendMail($to,$message){
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
        
>>>>>>> c8774d251b2a50cff33e565584ab5e55040d24a7
    }
    if($items->consultTitle==2) {
        $rightCheck = 'checked';
    }
<<<<<<< HEAD
    else {
        $rightCheck = '';
=======
    else{
        $result1 = "";
        $result2 = "";
        $failed = "ご入力内容に不備があります。";
>>>>>>> c8774d251b2a50cff33e565584ab5e55040d24a7
    }

    $mailer->sendMail($items);

echo <<<_END
<html>
<head>
    <meta charset = "utf8">
    <title>応募フォームテスト</title>
</head>
<body>

    <form method = "post" action = "index.php">

        お名前 （必須）{$items->errMessages->nameEmptyErr}<br>
        <input type = "text" name = "name" value = "{$items->name}" size = "40"/><br>

        お電話番号 (必須){$items->errMessages->phoneEmptyErr}{$items->errMessages->phoneNumericErr}<br>
        <input type = "text" name = "phone" value = "{$items->phone}" size = "40"/><br>
        メールアドレス (必須){$items->errMessages->addressEmptyErr}{$items->errMessages->mailPatternErr}<br>
        <input type = "text" name = "address" value = "{$items->address}" size = "40"/><br>
        確認のためもう一度ご入力ください。{$items->errMessages->notMatchErr}<br>
        <input type = "text" name = "readdress" value = "{$items->readdress}" size = "40"/><br>
        ご相談項目 (必須) {$items->errMessages->isConsultEmptyErr}<br>
        <input type = "radio" name = "consultTitle" value = "1" $leftCheck />無料のご相談
        <input type = "radio" name = "consultTitle" value = "2" $rightCheck />その他のご質問 <br>
        ご相談内容 <br>
        <textarea name = "consultContents" cols = "40" rows = "5" wrap = "off">{$items->consultContents}</textarea><br>
        <input type = "button" onclick = "submit();" value = "この内容で送信"/>
        <br/>
    </form>
    {$mailer->result1}<br>
    {$mailer->result2}<br>
    {$items->whereErr}

</body>
</html>
_END
?>

