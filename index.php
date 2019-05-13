<?php
    require_once (dirname(__FILE__)."\class\Items.php");
    require_once (dirname(__FILE__)."\class\Mailer.php");
    
    $items = new Items();
    $mailer = new Mailer();
    $items->createErrorMessages();

    if($items->consultTitle==1) {
        $leftCheck = 'checked';}
    else {
        $leftCheck = '';
    }
    if($items->consultTitle==2) {
        $rightCheck = 'checked';
    }
    else {
        $rightCheck = '';
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

