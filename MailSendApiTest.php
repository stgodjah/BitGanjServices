<?php

namespace BtcRelax;


class MailSendApiTest extends \PHPUnit_Framework_TestCase
{
    public  $vMailApi = null;

    public function testSendMail()
    {
       $vRes = $this->vMailApi->sendMail();
    }

    public function test__construct()
    {
        $this->vMailApi = new MailSendApi();
    }
}
