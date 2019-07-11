<?php
require 'EasyPayApi.php';
if (isset($_GET["user"]) && isset($_GET["pass"])) {
    $vUser = $_GET["user"];
    $vPass = $_GET["pass"];
        try {
            $vApi = new \BtcRelax\EasyPayApi($vUser,$vPass);
            if (isset($_GET["proxy"])) {
                $vProxy = $_GET["proxy"];
                $vApi->setProxyUrl($vProxy);
            }
            $vGetSessionRes = $vApi->getSession();
            echo \sprintf("Result create session:%s\n<br>", $vGetSessionRes);
            if ($vGetSessionRes) {
                echo \sprintf("Generated app id:%s\n<br>", $vApi->getCurrentAppId() );
                $vGetTokenResult = $vApi->getToken();
                echo \sprintf("Result GetTokenResult:%s\n<br>", $vGetTokenResult);
                if ($vGetTokenResult) {
                    $vNewName = substr(str_shuffle(md5(time())), 0, 5);
                    $vNewWalletInstrumentId = $vApi->addWallet($vNewName);
                    echo \sprintf("Try to create new wallet name:%s\n<br> Got result:%s\n<br>", $vNewName , $vNewWalletInstrumentId );        
                    echo ("Rendering wallets:");
                    echo $vApi->renderGetWallets();
                    $vNewWallet = $vApi->getWalletByInstrumentId($vNewWalletInstrumentId);
                    $vNewWalletNumber = $vNewWallet['number'];
                    echo (\sprintf("Getting wallet number: %s\n<br>", $vNewWalletNumber));
                    $vDeleteResult = $vApi->deleteWalletByNumber($vNewWalletNumber);
                    echo (\sprintf("Delete wallet by number:%s, result: %s\n<br>",$vNewWalletNumber, $vDeleteResult));
                }
            }
        } catch (Exception $exc) {
            echo \sprintf("Error creating EasyPay api:%s", $exc->getMessage()); 
        }
} else { ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>JS Issue Tracker</title>
    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  </head>
  <body onload="fetchParams()">
    <div class="container">
            <form id="paramsInputForm">
                <div class="form-group">
                <label for="paramsUser">Login</label>
                <input type="text" class="form-control" id="paramsUser" placeholder="Username for login" name="user">
                </div>
                <div class="form-group">
                <label for="paramsPass">Password</label>
                <input type="text" class="form-control" id="paramsPass" placeholder="Password for login" name="pass">
                </div>
                <div class="form-group">
                <label for="paramsProxy">Proxy</label>
                <input type="text" class="form-control" id="paramsProxy" placeholder="Proxy for get token" name="proxy">
                </div>
               <input type="hidden" name="start_debug" value="1">
               <input type="hidden" name="debug_host" value="localhost">
               <input type="hidden" name="debug_port" value="10137">
              <button type="submit" class="btn btn-primary" >Add</button>
            </form>    
        <div id="paramsList"></div>
   </div>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://chancejs.com/chance.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
  </body>
</html>  
<?php } ?>
        