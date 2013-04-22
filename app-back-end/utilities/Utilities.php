<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Utilities
 *
 * @author Jerson
 */
class Utilities {
    
    public static function sendEmail($to, $subject, $content, $from, $Bcc){	
        $contentHTML = "<!DOCTYPE HTML>
                	<head>
			<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
			<title>Mi Oficina .Co</title>
			</head>
			<body>". $content ."</body>
			</html>";
		
	if( mail($to, $subject, $contentHTML, "From:".$from."\r\nContent-type: text/html"."\r\nBcc:".$Bcc."\r\n") ){
            return true;
        }else{
            return false;
	}
    }
    
    
}

?>
