<? 

function send_confirmation_email($header, $Subject, $to, $toName, $template, $type, $footer, $CalFileAttachement=NULL,  $Vcalendar=NULL) 
{ 
    $mail = new PHPMailer();  // create a new object
    $mail->IsSMTP();                     
    $mail->SMTPAuth = TRUE;
    $mail->Port = 25;
    $mail->Host = '72.47.236.132';
    $mail->Username = 'testsol@tamaani.ca';
    $mail->Password = '123*mirak';    

    if(($CalFileAttachement!==NULL) and ($Vcalendar==NULL))
    {
        $mail->AddStringAttachment($CalFileAttachement, 'Invite.ics', "base64", "text/calendar");
    }
    else
    {
        $body ='
        <!DOCTYPE html>
        <html>
        <head>
        </head>
        <body style="background-color:#ccc; ">

        <table width="950" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF"  style="position:relative; font-family:Arial, 
        Helvetica, sans-serif; "  >
        <tr>
        <td bgcolor="#0A88C2" background="http://www.tamaani.ca/images/Email-Header.jpg" height="100" >

        <!--[if gte mso 9]>

        <v:image xmlns:v="urn:schemas-microsoft-com:vml" id="theImage" style="behavior: url(#default#VML); display:inline-block; 
        position:absolute; height:100px; width:950px;" src="http://www.tamaani.ca/images/Email-Header.jpg"/>

        <v:shape xmlns:v="urn:schemas-microsoft-com:vml" id="theText" style="behavior: url(#default#VML); display:inline-block; 
        position:absolute; height:100px; width:950px; ">

        <![endif]-->

        <p style="margin:60px 50px 10px 0px;  text-align:right;  font-size:22px; font-weight:bold ; font-family:Arial, 
        Helvetica, sans-serif; ">'.$type.'</p>

        <!--[if gte mso 9]>

        </v:shape>

        <![endif]-->

        </td>

        </tr>
        <tr>
        <td style="background-color:#FFF; color:#000  width:100%; padding:0px 50px 0px 0px; font-size:14px; ">
        <table width="850px" border="0" cellspacing="0" cellpadding="0">

        <tr>
        <td colspan="3" style="  color:#000; font-size:15px; padding:20px 0 10px 50px; font-family:Arial, Helvetica, sans-serif; font-size:14px; "> 
        '.$header.'
        </td>
        </tr>

        <tr>
        <td colspan="3" align="center" style="font-size:22px; font-weight:bold; padding:10px 0 10px 50px;   ">
        <img src="http://www.tamaani.ca/images/tamaani.jpg"  ></td>
        </tr>';

        $body .= $template.'

        </table>
        </td>
        </tr>
        </table></td>
        </tr>
        <tr>
        <td style=" color:#000; font-size:18px; padding:20px 0 10px 50px; font-family:Arial, Helvetica, sans-serif;"> '.$footer.'</td>
        </tr>
        <tr>
        <td style="background-color:#000000;  width:100%; padding:3px 0 3px 0px; font-family:Arial, Helvetica, sans-serif; ">&nbsp;</td>
        </tr>
        <tr>
        <td style="background-color:#138bc0;  width:100%; padding:3px 0 3px 0px; ">&nbsp;</td>
        </tr>
        </table>
        </body>
        </html>    ';
    }

    //$mail->From = 'vc@krg.ca';
    $mail->From = 'testsol@tamaani.ca';
    $mail->FromName = 'Tamaani VC';         
    $mail->Subject = $Subject;
    $mail->Body = $body;
    $mail->AltBody = $body;     



    $mail->AddAddress($to, $toName);
    //    $mail->AddAddress('fatiha@jkcommunications.com', $toName);
    //    $mail->AddBCC("fatiha@jkcommunications.com", "Webmaster");
	
	echo "about to send mail!";

    if(!$mail->Send())
    {
        echo "mail was not sent!";
		echo "<pre>" . print_r($mail->ErrorInfo, true) . "</pre>";

        return 'Mail error: ' . $mail->ErrorInfo; 
    } 
    else 
    {
		echo "mail was sent!";
		echo "<pre>" . print_r($mail->ErrorInfo, true) . "</pre>";		
		//echo "<pre>" . print_r($mail, true) . "</pre>";		

        return true;
    }

}


if(0)
{
    $headers = 'From: vc@krg.ca'; 
    mail('trazakaria@gmail.com', 'This email was sent using a scrip on Tamaani.ca', 'This is a test email message', 
        $headers, '-fit@jkcommunications.com'); 
}
else
{
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);

    include("../includes/phpdbclass/database.class.php");
    include("../includes/phpmailer/class.phpmailer.php");

    $header="test";
    $Subject="test subject";
    //$to="vc@krg.ca";
    $to="trazakaria@gmail.com";
    $toName="Tamaani Technical Team";
    $template="test template";
    $type="test type";
    $footer="test footer";

    send_confirmation_email($header, $Subject, $to, $toName, $template, $type, $footer);
}
