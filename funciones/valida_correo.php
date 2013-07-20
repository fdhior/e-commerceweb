<?php

function comprobar_email($email){ 
	$mail_correcto = 0; 
	//compruebo unas cosas primeras 
	if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@")){ 
		if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) { 
		//miro si tiene caracter . 
			if (substr_count($email,".")>= 1){ 
				//obtengo la terminacion del dominio 
				$term_dom = substr(strrchr ($email, '.'),1); 
				//compruebo que la terminación del dominio sea correcta 
				if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){ 
					//compruebo que lo de antes del dominio sea correcto 
					$antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1); 
					$caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1); 
					if ($caracter_ult != "@" && $caracter_ult != "."){ 
						$mail_correcto = 1; 
					} 
				} 
			} 
		} 
	} 

	if ($mail_correcto == "1") {
		return 1; 
	} else { 
		return 0; 
	}
		
} 

function check_email_address($email) 
{
	// Primero, checamos que solo haya un símbolo @, y que los largos sean correctos
  if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) 
	{
		// correo inválido por número incorrecto de caracteres en una parte, o número incorrecto de símbolos @
    return false;
  }
  // se divide en partes para hacerlo más sencillo
  $email_array = explode("@", $email);
  $local_array = explode(".", $email_array[0]);
  for ($i = 0; $i < sizeof($local_array); $i++) 
	{
    if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) 
		{
      return false;
    }
  } 
  // se revisa si el dominio es una IP. Si no, debe ser un nombre de dominio válido
	if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) 
	{ 
     $domain_array = explode(".", $email_array[1]);
     if (sizeof($domain_array) < 2) 
		 {
        return false; // No son suficientes partes o secciones para se un dominio
     }
     for ($i = 0; $i < sizeof($domain_array); $i++) 
		 {
        if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) 
				{
           return false;
        }
     }
  }
  return true;
}


?>