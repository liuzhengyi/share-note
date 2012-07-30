<?php
$email=get_argp("email");
$user_vericode=get_argp("veriCode");
if(strtolower($_SESSION['verifyCode'])!=strtolower($user_vericode)){
}
UNSET($_SESSION['verifyCod']);

$dbo = new dbex($dbServs);
$sql="SELECT user_id,user_name FROM user_basic WHERE user_email='$email'";
$user_row=$dbo->getRow($sql);

if($user_row == 1) {
							
	$user_id = $user_row['user_id'];
	$user_name = $user_row['user_name'];
} else {
	echo '<p><font color="red" size="+1">The submitted email addreass does not match those on file!</font></p>';
	$user_id = 0 ; 
}
if($user_id) {
	// Create a new random password
	$p = substr(md5(uniqid(rand(),1)), 3, 10);

	$sql="update `user_basic` set `forget_pass`=sha1('$p') where `user_id` = '$user_id'";
	if($dbo->exeUpdate($sql)) {
		$body = "Your password to log in '$siteDomain' has been temporarily changed to '$p'. Please log in using this password and your username.";
		mail($email, 'Your temporary password', $body, 'From: admin@sitename.com');
		echo "<h3>Your password has been changed. You will receive the new temporary password at the email address with which you entered.</h3>";
		action_return(0,"发送成功！",-1);
	} else {
		action_return(0,"发送失败！",'-1');
	}
}

?>
