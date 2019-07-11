<?php
    require('../BtcRelax/core.inc');
    $core = \BtcRelax\Core::getIstance(false);
    $vReq = $core->getRequest(false);
    if (array_key_exists('userid', $vReq)) {
       $vCustomerId = $vReq['userid'];
       $vUser = \BtcRelax\AM::userById($vCustomerId);
       $vAM = \BtcRelax\Core::createAM();
       $vIdent = $vUser->getIdentifiers()[0];
       $vAM->SignIn($vIdent);
       //$core->run();
} else { ?>
    <form name="Login As form" action="login_as.php">
        <input type="text" name="userid" value="" />
        <input type="submit" value="Login as" />
    </form>

<?php } ?>
