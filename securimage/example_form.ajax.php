<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
session_start(); // this MUST be called prior to any output including whitespaces and line breaks!

$GLOBALS['ct_recipient']   = 'YOU@EXAMPLE.COM'; // Change to your email address!
$GLOBALS['ct_msg_subject'] = 'Securimage Test Contact Form';

$GLOBALS['DEBUG_MODE'] = 1;
// CHANGE TO 0 TO TURN OFF DEBUG MODE
// IN DEBUG MODE, ONLY THE CAPTCHA CODE IS VALIDATED, AND NO EMAIL IS SENT


// Process the form, if it was submitted
process_si_contact_form();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Securimage Example Form</title>
    <style type="text/css">
    <!--
        #success_message { border: 1px solid #000; width: 550px; text-align: left; padding: 10px 7px; background: #33ff33; color: #000; font-weight; bold; font-size: 1.2em; border-radius: 4px; -moz-border-radius: 4px; -webkit-border-radius: 4px; }
        fieldset { width: 90%; }
        legend { font-size: 24px; }
        .note { font-size: 18px; }
    -->
    </style>
  
    <script src="https://ajax.googleapis.com/ajax/libs/prototype/1.7.0.0/prototype.js"></script>
  
    <script type="text/javascript">
        function reloadCaptcha()
        {
            document.getElementById('siimage').src = './securimage_show.php?sid=' + Math.random();
        }
        
        function processForm()
        {
            new Ajax.Request('<?php echo $_SERVER['PHP_SELF'] ?>', {
                method: 'post',
                parameters: $('contact_form').serialize(),
                onSuccess: function(transport) {
                    try {
                        var r = transport.responseText.evalJSON();

                        if (r.error == 0) {
                            $('success_message').show();
                            $('contact_form').reset();
                            reloadCaptcha();
                            setTimeout("$('success_message').hide()", 30000);
                        } else {
                            alert("There was an error with your submission.\n\n" + r.message);
                        }
                    } catch(ex) {
                        alert("There was an error parsing the json");
                    }
                },
                onFailure: function(err) {
                    alert("Ajax request failed");
                }
            });

            return false;
        }
    </script>
</head>
<body>

<fieldset>
<legend>Example Form</legend>

<p class="note">
  This is an example PHP form that processes user information, checks for errors, and validates the captcha code.<br />
  This example form also demonstrates how to submit a form to itself to display error messages.
</p>

<div id="success_message" style="display: none">Your message has been sent!<br />We will contact you as soon as possible.</div>

<form method="post" action="" id="contact_form" onsubmit="return processForm()">
  <input type="hidden" name="do" value="contact" />

  <p>
    <strong>Name*:</strong><br />
    <input type="text" name="ct_name" size="35" value="" />
  </p>

  <p>
    <strong>Email*:</strong><br />
    <input type="text" name="ct_email" size="35" value="" />
  </p>

  <p>
    <strong>URL:</strong><br />
    <input type="text" name="ct_URL" size="35" value="" />
  </p>

  <p>
    <strong>Message*:</strong><br />
    <textarea name="ct_message" style="width: 450px; height: 200px"></textarea>
  </p>

  <p>
    <img id="siimage" style="border: 1px solid #000; margin-right: 15px" src="./securimage_show.php?sid=<?php echo md5(uniqid()) ?>" alt="CAPTCHA Image" align="left">
    <object type="application/x-shockwave-flash" data="./securimage_play.swf?audio_file=./securimage_play.php&amp;bgColor1=#fff&amp;bgColor2=#fff&amp;iconColor=#777&amp;borderWidth=1&amp;borderColor=#000" height="32" width="32">
    <param name="movie" value="./securimage_play.swf?audio_file=./securimage_play.php&amp;bgColor1=#fff&amp;bgColor2=#fff&amp;iconColor=#777&amp;borderWidth=1&amp;borderColor=#000">
    </object>
    &nbsp;
    <a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="reloadCaptcha(); this.blur(); return false"><img src="./images/refresh.png" alt="Reload Image" onclick="this.blur()" align="bottom" border="0"></a><br />
    <strong>Enter Code*:</strong><br />
    <input type="text" name="ct_captcha" size="12" maxlength="8" />
  </p>

  <p>
    <br />
    <input type="submit" value="Submit Message">
  </p>

</form>
</fieldset>

</body>
</html>

<?php

// The form processor PHP code
function process_si_contact_form()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$_POST['do'] == 'contact') {
        // if the form has been submitted
      
        foreach($_POST as $key => $value) {
            if (!is_array($key)) {
                // sanitize the input data
                if ($key != 'ct_message') $value = strip_tags($value);
                $_POST[$key] = htmlspecialchars(stripslashes(trim($value)));
            }
        }

        $name    = @$_POST['ct_name'];    // name from the form
        $email   = @$_POST['ct_email'];   // email from the form
        $URL     = @$_POST['ct_URL'];     // url from the form
        $message = @$_POST['ct_message']; // the message from the form
        $captcha = @$_POST['ct_captcha']; // the user's entry for the captcha code
        $name    = substr($name, 0, 64);  // limit name to 64 characters

        $errors = array();  // initialize empty error array

        if (isset($GLOBALS['DEBUG_MODE']) && $GLOBALS['DEBUG_MODE'] == false) {
            // only check for errors if the form is not in debug mode
      
            if (strlen($name) < 3) {
                // name too short, add error
                $errors['name_error'] = 'Your name is required';
            }

            if (strlen($email) == 0) {
                // no email address given
                $errors['email_error'] = 'Email address is required';
            } else if ( !preg_match('/^(?:[\w\d]+\.?)+@(?:(?:[\w\d]\-?)+\.)+\w{2,4}$/i', $email)) {
                // invalid email format
                $errors['email_error'] = 'Email address entered is invalid';
            }

            if (strlen($message) < 20) {
                // message length too short
                $errors['message_error'] = 'Please enter a message';
            }
        }

        // Only try to validate the captcha if the form has no errors
        // This is especially important for ajax calls
        if (sizeof($errors) == 0) {
            require_once dirname(__FILE__) . '/securimage.php';
            $securimage = new Securimage();
      
            if ($securimage->check($captcha) == false) {
                $errors['captcha_error'] = 'Incorrect security code entered';
            }
        }

        if (sizeof($errors) == 0) {
            // no errors, send the form
            $time       = date('r');
            $message = "A message was submitted from the contact form.  The following information was provided.<br /><br />"
                     . "Name: $name<br />"
                     . "Email: $email<br />"
                     . "URL: $URL<br />"
                     . "Message:<br />"
                     . "<pre>$message</pre>"
                     . "<br /><br />IP Address: {$_SERVER['REMOTE_ADDR']}<br />"
                     . "Time: $time<br />"
                     . "Browser: {$_SERVER['HTTP_USER_AGENT']}<br />";

            if (isset($GLOBALS['DEBUG_MODE']) && $GLOBALS['DEBUG_MODE'] == false) {
                // send the message with mail()
                mail($GLOBALS['ct_recipient'], $GLOBALS['ct_msg_subject'], $message, "From: {$GLOBALS['ct_recipient']}\r\nReply-To: {$email}\r\nContent-type: text/html; charset=ISO-8859-1\r\nMIME-Version: 1.0");
            }
            
            $return = array('error' => 0, 'message' => 'OK');
            die(json_encode($return));
        } else {
            $errmsg = '';
            foreach($errors as $key => $error) {
                // set up error messages to display with each field
                $errmsg .= " - {$error}\n";
            }

            $return = array('error' => 1, 'message' => $errmsg);
            die(json_encode($return));
        }
    } // POST
} // function process_si_contact_form()
