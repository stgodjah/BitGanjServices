<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>MailSend Api test</title>
</head>
<body>
<?php
require 'MailSendApi.php';
$vApi = new \BtcRelax\MailSendApi();
echo $vApi->sendMail();
?>
</body>
</html>
