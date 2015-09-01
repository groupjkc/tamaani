<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Contact Information</title>
</head>

<body>
<?
$email = 'stamand.nadine@gmail.com, cnakoolak@krg.ca';
$subject = $_POST['purpose'];
$visitor_email = $_POST ['email'];
$message =  $_POST['name'] . " <a href=\"mailto:${_POST['email']}\">" . $_POST['email'] . "</a><br />" . $_POST['address'] . "<br />" . $_POST['text'];
$mailHeader = "From:$visitor_email\nReply-to:$visitor_email\n";

	$is_send = mail($email, $subject, $message, $mailHeader);
	if($is_send) echo "Mail sent.";
	else echo "Mail can not be sent";

?>
<ul>
	<li>Name: <? echo $_POST['name'];?></li>
	<li>Address: <? echo $_POST['address'];?></li>
	<li>Purpose: <? echo $_POST['purpose'];?></li>
	<li>Message: <? echo $_POST['text'];?></li>
	<li>E-Mail: <? echo "<a href=\"mailto:${_POST['email']}\">" . $_POST['email'] . "</a>";?></li>
</ul>
</body>
</html>
