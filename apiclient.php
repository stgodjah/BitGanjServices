<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>API Client</title>
        <script type="text/javascript" src="../js/jquery-1.11.3.min.js" ></script>	
        <link rel="icon" type="image/png" href="../img/BitGanj.png" />
    </head>
    <body>        
        <?php
        include '../BtcRelax/core.inc';
        $core = new BtcRelax\Core();
        $core->init(false);
        $vReq  = $core->getRequest();
        $apiObj = \BtcRelax\Core::createApiClient();
        $resultHtml = "<input type=\"submit\" name=\"setTelegramId\" value=\"Set telegram id\" />";
        if (array_key_exists('setTelegramId', $vReq) && $core->getRequestMethod() === 'POST' )
        {
           
           $nonce = $vReq['inNonce'];
           $telegramId = $vReq['inTelegramId'];
           if (!empty($nonce) && !empty($telegramId))
           {
              $resultHtml = 'Ok';
              if ($apiObj->SetTelegramToNonce($nonce, $telegramId) === false)
              {
                  $resultHtml = $apiObj->get_last_error();
              }
           }
           
        }
        ?>            
        <form action="#" method="POST" enctype="multipart/form-data">
                <table border="1">
                    <thead>
                        <tr>
                            <th>Test method: SetTelegramToNonce </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Nonce:<input type="text" name="inNonce" value="" /></td>
                        </tr>
                        <tr>
                            <td>TelegramId:<input type="text" name="inTelegramId" value="" /></td>
                        </tr>
                        <tr>
                            <td><?php echo $resultHtml; ?></td>
                        </tr>
                    </tbody>
                </table>
            </form>      
    </body>
</html>
