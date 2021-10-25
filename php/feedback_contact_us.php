<?php
// Change these two variables to meet your needs.

$myemail = 'info@shansons.com.pk';
$subject = 'Feedback / Enquiry Form';

$op = $_POST[op];

if($op == 'contact')
{
    $name = stripslashes($_POST[name]);
    $email = stripslashes($_POST[email]);
	$phone = stripslashes($_POST[phone]);
    $text = stripslashes($_POST[text]);
    $referer = $_POST[referer];
          
    if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$",$email)) 
    { 
        $status = "We're sorry, but you've write an Incorrect Email Address.<br><br>";
    }
    if(!$name)
    {
        $status .= "Please write your Name.<br><br>";
    }
	if(!$phone)
    {
        $status .= "Please write your Phone / Cell Number.<br><br>";
    }
    if(!$text)
    {
        $status .= "Please write a Message / Enquiry.<br>";
    }
	
    if(!$status)
    {
        $header = "From: $email\r\nReply-To: $email\r\n";

        $message = "
            Name: $name
			Email Address: $email
			Phone / Cell Number: $phone
                                              
            $text
        ";

        if(mail($myemail, $subject, $message, $header))
        {
            $status = "Thanks you for your Feedback / Enquiry. We will contact you soon.<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
        }
        else
        {
            $status = "There was a problem sending your Feadback / Enquiry, please try again later.<br><br>";
        }

    }
    else
    {
        $status .= "<br>Please press <u>back</u> on your browser to Resubmit Feedback / Enquiry Form.<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    }
}    

// Now check the referer page and ensure it's a proper URL

$referer = $_SERVER[HTTP_REFERER];

if(!preg_match('#^http\\:\\/\\/[a-z0-9\-]+\.([a-z0-9\-]+\.)?[a-z]+#i', $referer))
{
    unset($referer);
}

?>

<?php print $status; ?>

<form method="post" action="<?php print $_SELF; ?>">
<input type="hidden" name="op" value="contact">
<input type="hidden" name="referer" value="<?php print $referer; ?>">

<p style="font-family: Arial,Helvetica,Geneva,Sans-serif; font-size: 9pt; color: rgb(51,51,51); font-weight: bold; text-align: left;">
&nbsp;Name<br><input name="name" size="37" value=""><br><br>
&nbsp;E-mail Address<br><input name="email" size="37" value=""><br><br>
&nbsp;Phone / Cell Number<br><input name="phone" size="37" value=""><br><br>
&nbsp;Message<br><textarea name="text" cols="29" rows="14"></textarea><br><br>
<input type="submit" value="Send message">
</p>

