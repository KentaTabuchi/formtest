<?php
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $readdress = $_POST['readdress'];
    $isConsult = $_POST['isConsult'];
    $consultContents = $_POST['consultContents'];

    if (empty($name)) $nameEmptyErr = "※未入力";
    if (empty($phone)) $phoneEmptyErr = "※未入力";
    if (ctype_digit($phone) == false) $phoneNumericErr = "※ハイフン抜きで数字だけ入力てください。"; 
    if (empty($address)) $addressEmptyErr = "※未入力";
    if(preg_match('/..*@.*\..*/',$address) == false) $mailPatternErr = "※メールの形式になっていません。";
    if (empty($isConsult)) $isConsultEmptyErr = "※未入力";

    if($_POST['address'] != $_POST['readdress']) $notMatchErr = "※アドレスが一致しません";

    if($_POST['isConsult']==1) $leftCheck = 'checked';
        else $leftCheck = '';
    if($_POST['isConsult']==2) $rightCheck = 'checked';
        else $rightCheck = '';
    
    function errCheck($name,$phone,$address,$readdress,$isConsult){
        $validated = true;

        if(empty($name) || empty($phone) || empty($address) || empty($isConsult)){
            $validated = false;
        }
        if(ctype_digit($phone) == false){
            $validated = false;
        }
        if($address != $readdress){
            $validated = false;
        }
        if(preg_match('/..*@.*\..*/',$address) == false){
            $validated = false;
        }
        
        return $validated;
    }
    function makeMailBody($name,$phone,$address,$isConsult,$consultContents){
        
        if($isConsult == "1"){
            $consultItem = "無料のご相談";
        }
        else{
            $consultItem ="その他のご質問";
        }
        
        $mailBody = "
---------------------------------------------------------------
【お名前】 $name
【お電話番号】 $phone
【メールアドレス】 $address
【ご相談項目】 $consultItem
【ご相談内容】
$consultContents
---------------------------------------------------------------
        ";
        return $mailBody;
    }
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
        
    }

    if(errCheck($name,$phone,$address,$readdress,$isConsult)){
        $result1 = sendMail("morita@xend.co.jp",$message,$isConsult);//社長のアドレスのためテスト中はコメントアウトすること。
        $result2 = sendMail($address,makeMailBody($name,$phone,$address,$isConsult,$consultContents));
    }
    else{
        $failed = "ご入力内容に不備があります。";
    }


echo <<<_END
<html>
<head>
    <meta charset = "utf8">
    <title>応募フォームテスト</title>
</head>
<body>

    <form method = "post" action = "index.php">

        お名前 （必須）{$nameEmptyErr}<br>
        <input type = "text" name = "name" value = "{$name}" size = "40"/><br>

        お電話番号 (必須){$phoneEmptyErr}{$phoneNumericErr}<br>
        <input type = "text" name = "phone" value = "{$phone}" size = "40"/><br>
        メールアドレス (必須){$addressEmptyErr}{$mailPatternErr}<br>
        <input type = "text" name = "address" value = "{$address}" size = "40"/><br>
        確認のためもう一度ご入力ください。{$notMatchErr}<br>
        <input type = "text" name = "readdress" value = "{$readdress}" size = "40"/><br>
        ご相談項目 (必須) {$isConsultEmptyErr}<br>
        <input type = "radio" name = "isConsult" value = "1" $leftCheck />無料のご相談
        <input type = "radio" name = "isConsult" value = "2" $rightCheck />その他のご質問 <br>
        ご相談内容 <br>
        <textarea name = "consultContents" cols = "40" rows = "5" wrap = "off">{$consultContents}</textarea><br>
        <input type = "button" onclick = "submit();" value = "この内容で送信"/>
        <br/>
    </form>
    {$result1}<br>
    {$result2}<br>
    {$failed}

</body>
</html>
_END
?>

