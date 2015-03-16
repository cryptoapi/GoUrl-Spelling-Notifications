<?php 
/**
 * GoUrl Spelling Notifications, 2015 year
 *
 * @link https://gourl.io/php-spelling-notifications.html
 * @version 1.0
 * @license GPLv2
 */


// Place your emails in two variables below
// --------------------------

$from_email 	= ''; 				// place your email; field From:
$to_email 		= ''; 				// place your email; field To:
$send_button 	= 'Send to Author';	// you can change 'send' button text; 'Send', 'Send to Webmaster', etc





// DO NOT EDIT BELOW THIS LINE
// -----------------------------
if(isset($_POST['submit']) && $_POST['submit'])
{
	$title 	 = 'Spelling Error on '.$_SERVER["SERVER_NAME"]. ', '.date("F j, Y, g:i a");
	$url 	 = htmlspecialchars(substr(trim($_POST['url']), 0, 2000));
	$spl 	 = substr(trim(stripslashes($_POST['spl'])), 0, 2000);
	$comment = htmlspecialchars(substr(trim(stripslashes($_POST['comment'])), 0, 20000));
	$agent	 = htmlspecialchars(trim($_SERVER['HTTP_USER_AGENT']));
	if (!$from_email) $from_email = 'server@'.$_SERVER["SERVER_NAME"];
	if (!$to_email)   $to_email = 'webmaster@'.$_SERVER["SERVER_NAME"];
	
					   
	$txt = '<html>
			<head>
			<title>Spelling or grammar error</title>
			</head>
			<body style="font-size: 14px; margin: 5px; color: #333333; line-height: 25px; font-family: Verdana, Arial, Helvetica">
			'.date("F j, Y, g:i a").'<br><br>
			<strong>Webpage:</strong> &#160;<a style="color:#007cb9" href='.$url.'>'.$url.'</a>
			<br><br><br>
			<strong>Error:</strong><br>---------<br>'.str_replace("<strong>", "<strong style='color:red'>", $spl).'
			<br><br><br>
			<strong>Comments:</strong><br>---------<br>'.$comment.'
			<br><br><br><br>
			<strong>IP:</strong> <a style="color:#007cb9" href="http://myip.ms/'.$_SERVER['REMOTE_ADDR'].'">'.$_SERVER['REMOTE_ADDR'].'</a>
			<br>                               
			<strong>Agent:</strong> '.$_SERVER['HTTP_USER_AGENT'].'
			</body>
			</html>
			';


	$from = "From: =?utf-8?B?". base64_encode($_SERVER["SERVER_NAME"]). "?= < $from_email >\n";
	$from .= "X-Sender: < $from_email >\n";
	$from .= "Content-Type: text/html; charset=utf-8\n";
		   
	$result = mail($to_email, $title, $txt, $from);
	
}

?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Send email notification to webmaster</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css" rel="stylesheet">
	<script> var p=top;function loaddata(){null!=p&&(document.forms.splwin.url.value=p.splloc);null!=p&&(document.forms.splwin.spl.value=p.spl);if("undefined"==typeof p.spl || "undefined"==typeof p.splloc) {document.getElementById("submit").disabled = true;document.getElementById("cancel").disabled = true;}}function hide(){var a=p.document.getElementById("splwin");a.parentNode.removeChild(a)};window.onkeydown=function(event){if(event.keyCode===27){hide()}};</script>
	<style>#m strong{color:red}.container{margin-top:20px}</style>
	</head>
	<body onload=loaddata()>
		<div class="container">
			<p><b>Spelling or Grammar Error</b></p>
			<div class="pull-right" style="margin:-44px -10px 0 0;"><a href="javascript:void(0)" onclick="hide()" title="Close Window" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-remove"></span></a></div>
		
			<?php if(isset($_POST['submit']) && $_POST['submit']) : ?>
		
				<br><br><br>
			
				<?php if($result) : ?>
					<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok"></span>
						&#160;Thank you! Your message has been successfully sent, we highly appreciate your support !
					</div>
				<?php else : ?>
					<br>
					<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-remove-sign"></span>
						&#160;Error! Message not sent, Please try again !
					</div>
				<?php endif; ?>
					
				<br><br><div style="text-align:center; margin-left:-20px"><a target="_blank" href="https://gourl.io/php-spelling-notifications.html"><img alt='GoUrl Spelling Notifications' title='GoUrl Spelling Notifications' src='gourlspelling2.png'></a><a href="https://gourl.io/php-spelling-notifications.html" target="_blank" title="">GoUrl Spelling Notifications &#187;</a></div>
				<br><br><br><div style="text-align:center"><input class="btn btn-danger btn-sm" onclick="hide()" type="button" value="Close Window" id="cancel" name="cancel"></div>

			<?php else : ?>
	
				<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" name="splwin">
					<div id="m" class="alert alert-warning" style="margin-bottom:7px;"><script>document.write(p.spl);</script></div>
					<input class="form-control" type="hidden" id="spl" name="spl">
					<label style="font-weight:lighter;">Webpage:</label>
					<input class="form-control input-sm" id="url" type="text" name="url" size="35" readonly="readonly">
					<label style="font-weight:lighter;margin-top:8px;">Describe the error and offer a solution:</label>
					<textarea class="form-control" style="margin-bottom:11px;" id="comment" rows="4" name="comment" required="required" autofocus="autofocus"></textarea>
					<input class="btn btn-success btn-sm" type="submit" value="<?php echo htmlentities($send_button); ?>" id='submit' name="submit"> &#160;
					<input class="btn btn-danger btn-sm" onclick="hide()" type="button" value="Cancel" id="cancel" name="cancel">
					<div style="position:absolute;right:30px;bottom:5px;width:60px"><a target="_blank" href="https://gourl.io/php-spelling-notifications.html"><img alt='GoUrl Spelling Notifications' title='GoUrl Spelling Notifications' src='gourlspelling2.png'></a></div>
				</form>                
	
			<?php endif; ?>
		</div>
	</body>
</html>