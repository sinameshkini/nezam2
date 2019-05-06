

<?php
require_once ("include.php");
// require_once ("lib/nusoap.php");
    extract($_POST);
    if($_POST['act'] == 'maketoken'){
       
        $id =  $_POST['id'];
        $result = $conn->query("SELECT cost FROM course WHERE id=$id;");
        $row = $result->fetch_assoc();
        $client = new SoapClient('https://ikc.shaparak.ir/XToken/Tokens.xml', array('soap_version'   => SOAP_1_1));
        $params['amount'] = $row['cost'];
        $params['merchantId'] = "A1FF";
        $params['invoiceNo'] = invoice();
        $params['paymentId'] = paymenId();
        $params['revertURL'] = "http://tc.gu.ac.ir/nezam2/callback.php";
        $result = $client->__soapCall("MakeToken", array($params));
        echo $result;
    }
    // if($_POST['act'] == 'verifytoken'){
    //         $client = new SoapClient('https://ikc.shaparak.ir/XVerify/Verify.xml', array('soap_version'   => SOAP_1_1));
    //         $params['token'] =  $_POST["token"]; // please replace currentToken
    //         $params['merchantId'] = "A1FF";
    //         $params['referenceNumber'] = $_POST['referenceId'];
    //         $params['sha1Key'] = '22338240992352910814917221751200141041845518824222260';
    //         $result = $client->__soapCall("KicccPaymentsVerification", array($params));
    // }

    function paymenId(){
        $payid = date('hmsYd');
        return $payid;
    }
    function invoice(){
        $inid = date('Ydhms');
        return $inid;
    }

?>