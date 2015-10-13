<?php

	/**********************************************************************************************
	Funcion: Consultar_Datos
	Parametros Recibidos:
		Recibe una lista variable de parametros los cuales son:
		numero de parametros a consultar, nombre de la tabla, parametro 1,...parametro n,identificador de conexion
	Objetivo: Realizar un SELECT de la tabla especificada
	**********************************************************************************************/
	/*public function consulta($consulta,$link)
	{				
		$resultado= mysqli_query($link,$consulta);	
	}
	public function extraer_registro ()
	{
		if ($fila = mysqli_fetch_array($resultado,MYSQL_ASSOC))
			return $fila;
		else {
				return false;
			 }
	}	 	
*/
	/**********************************************************************************************
	Funcion: Insertar_Datos
	Parametros Recibidos:
		Recibe una lista variable de parametros los cuales son:
		numero de parametros a insertar, nombre de la tabla, parametro 1,...parametro n, valor 1,...,valor n,identificador de conexion
	Objetivo: Realizar un INSERT en la tabla especificada
	**********************************************************************************************/
	function Insertar_Datos()
	{
		$numargs=func_num_args();
		$arg_list=func_get_args();
		$numval=$arg_list[0];
		$cadconsul="INSERT INTO `$arg_list[1]` ";
		for($i=2;$i<=$numval+1;$i++)
		{
			if($i==2)
				$cadconsul.="( ";
			if($i<$numval+1)
				$cadconsul.="`$arg_list[$i]` , ";
			else
				$cadconsul.="`$arg_list[$i]` ) VALUES ";
		}
		for(;$i<$numargs-1;$i++)
		{
			if($i==$numval+2)
				$cadconsul.="( ";
			if($i<$numargs-2)
			{
				if(!empty($arg_list[$i]))
					$cadconsul.="'$arg_list[$i]', ";
				else
					$cadconsul.=" NULL, ";
			}
			else
			{
				if(!empty($arg_list[$i]))
					$cadconsul.="'$arg_list[$i]');";
				else
					$cadconsul.="NULL);";
			}
		}
		if(mysqli_query($arg_list[$numargs-1],$cadconsul))
			return true;
		else
			return false;
	}

	/**********************************************************************************************
	Funcion: Existe
	Parametros Recibidos:
		Recibe una lista de variables las cuales son: numero de campos, nombre de la tabla, campo 1, id 1, campo 2, id 2, campo n, id n, bd
	Objetivo: Devolver true si existe un registro en la tabla que coinsida con los campos he id's dados
	**********************************************************************************************/
	function Existe()
	{
		$numargs=func_num_args();
		$arg_list=func_get_args();
		$num_campos=$arg_list[0];
		$cadconsul="SELECT * FROM `$arg_list[1]` WHERE ";
		for($i=2;$i<=$num_campos+2;$i++)
		{
			$cadconsul.="`$arg_list[$i]`=";
			$i++;
			$cadconsul.="'$arg_list[$i]' AND ";
		}
		$cadconsul[strlen($cadconsul)-1]=" ";
		$cadconsul[strlen($cadconsul)-2]=" ";
		$cadconsul[strlen($cadconsul)-3]=" ";
		$cadconsul[strlen($cadconsul)-4]=" ";
		$cadconsul=trim($cadconsul);
		$cadconsul.=";";
		$consul=mysqli_query($arg_list[$numargs-1],$cadconsul);
		if($consul)
		{
			$num=mysqli_num_rows($consul);
			if(!empty($num))
				return true;
			unset($num);
			mysqli_free_result($consul);
		}
		return false;
	}

	/**********************************************************************************************
	Funcion: Actualizar_Datos
	Parametros Recibidos:
		Recibe una lista variable de parametros los cuales son:
		numero de campos claves, numero de parametros posible de actualizarse, nombre de la tabla, nombre del campo clave 1, valor del campo clave 1,..., nombre campo clave n, valor del campos clave n, nombre del campo 1,valor anterior del campo 1, valor nuevo del campo 1,...,nombre del campo n,valor anterior del campo n, valor nuevo del campo n, identificador de conexion
	Objetivo: Realizar un UPDATE en la tabla especificada. Retorna 0: si no existen cambio en las variables. Retorna 1: si se realizo el update exitoso. Retorna 2: si ocurrio un error en el update
	**********************************************************************************************/
	function Actualizar_Datos()
	{
		$numargs=func_num_args();
		$arg_list=func_get_args();
		$numvalclaves=$arg_list[0];
		$numval=$arg_list[1];
		$cambio=false;
		for($i=1,$j=3+($numvalclaves*2);$i<=$numval;$i++,$j+=3)
		{
			if(strcmp($arg_list[$j+1],$arg_list[$j+2]))
			{
				$cambio=true;
				break;
			}
		}
		if($cambio)//existen actualizaciones
		{
			$cadaux="UPDATE `$arg_list[2]` SET";
			for($i=1,$j=3+($numvalclaves*2);$i<=$numval;$i++,$j+=3)
			{
				if(strcmp($arg_list[$j+1],$arg_list[$j+2]))
				{
					$jx=$j+2;
					if(!empty($arg_list[$jx]))
						$cadaux.=" `$arg_list[$j]`='$arg_list[$jx]',";
					else
						$cadaux.=" `$arg_list[$j]`=NULL,";
					unset($jx);
				}
			}
			$cadaux[strlen($cadaux)-1]=" ";
			$cadaux.="WHERE ";
			for($i=1,$j=3;$i<=$numvalclaves;$i++,$j+=2)
			{
				$jx=$j+1;
				$cadaux.="`$arg_list[$j]`='$arg_list[$jx]' AND ";
				unset($jx);
			}
			$cadaux[strlen($cadaux)-1]=" ";
			$cadaux[strlen($cadaux)-2]=" ";
			$cadaux[strlen($cadaux)-3]=" ";
			$cadaux[strlen($cadaux)-4]=" ";
			$cadaux=trim($cadaux);
			$cadaux.=";";
			if(mysqli_query($arg_list[$numargs-1],$cadaux))
				return 1;
			else
				return 2;
		}
		return 0;
	}

	/**********************************************************************************************
	Funcion: Eliminar_Datos
	Parametros Recibidos:
		Recibe una lista variable de parametros los cuales son:
		numero de campos claves, nombre de la tabla, nombre del campo clave 1, valor del campo clave 1,...,nombre del campo clave n, valor del campo clave n, identificador de conexion
	Objetivo: Realizar un DELETE en la tabla especificada. Retorna true si tuvo exito y false si no
	**********************************************************************************************/
	function Eliminar_Datos()
	{
		$numargs=func_num_args();
		$arg_list=func_get_args();
		$numvalclaves=$arg_list[0];
		$cadaux="DELETE FROM `$arg_list[1]` WHERE ";
		for($i=1,$j=2;$i<=$numvalclaves;$i++,$j+=2)
		{
			$jx=$j+1;
			$cadaux.="`$arg_list[$j]`='$arg_list[$jx]' AND ";
			unset($jx);
		}
		$cadaux[strlen($cadaux)-1]=" ";
		$cadaux[strlen($cadaux)-2]=" ";
		$cadaux[strlen($cadaux)-3]=" ";
		$cadaux[strlen($cadaux)-4]=" ";
		$cadaux=trim($cadaux);
		$cadaux.=";";
		if(mysql_query($cadaux,$arg_list[$numargs-1]))
		{
			mysql_query("OPTIMIZE TABLE `$arg_list[1]`;",$arg_list[$numargs-1]);
			return true;
		}
		return false;
	}

	/***********************************************************************************************
	Funcion: Comprobar_Puntos
	Parametro recibido: string $cadena: recibido por copia
	Objetivo: comprueba que no haya dos puntos seguidos
	Retorna: true o false, si se cumple el objetivo
	***********************************************************************************************/
	function Comprobar_Puntos($cadena)
	{
  		$seguir = true;
   		// Se obtiene la posición del primer punto
   		$posicion = strpos($cadena, '.');
   		// Se comprueba que exista
   		while (($posicion) && ($seguir))
      	{
      		// Se comprueba que el anterior y el siguiente no son . o @
      		if (($cadena[$posicion - 1] != '.') &&
          		($cadena[$posicion + 1] != '.') &&
          		($cadena[$posicion - 1] != '@') &&
          		($cadena[$posicion + 1] != '@'))
          	// Se obtiene la subcadena a partir del punto
         		 $cadena = substr($cadena, $posicion + 1);
      		else
          		$seguir = false;
      		// Se vuelve a obtener la posición del primer punto
     		 $posicion = strpos($cadena, '.');
      	}
   		return $seguir;
   	}
	
	/***********************************************************************************************
	Funcion: Validar_Correo
	Parametro recibido: string $cadena: recibido por copia
	Objetivo: Validar Correo Electronico
	Retorna: true o false, si se cumple el objetivo
	***********************************************************************************************/
	function Validar_Correo($cadena)
	{
   		// Primero se comprueba que sólo aparezca una arroba
   		// y que al menos exista un punto decimal. Para lo que
   		// se calcula la frecuencia de los caracteres
		$cadena=strtr($cadena,'_','a');
   		$caracteres = count_chars($cadena);
   		if (($caracteres[ord('@')] == 1) && ($caracteres[ord('.')]>0))
      	{
      		// Se comprueba que sólo existan caracteres alfabéticos
      		$caracteres = count_chars($cadena, 3);
      		$i = 0;
      		$seguir = true;
      		while (($i < strlen($cadena)) && $seguir)
         		{
         			$posicion = ord($cadena[$i]);
         			if ($posicion < ord('0'))
            		{
            		// El código del carácter no es numérico
            			if ($posicion != ord('.'))  // y no es el punto
                		$seguir = false;
            	}
         		elseif (($posicion > ord('9')) && ($posicion < ord('@')))
            		$seguir = false;  // Entre números y letras mayúsculas
         		elseif (($posicion > ord('Z')) && ($posicion < ord('a')))
            		$seguir = false;  // Entre mayúsculas y minúsculas
         		elseif ($posicion > ord('z'))
            		$seguir = false;  // mayor que letras minúsculas
         		$i++;
		}
		if ($seguir) // Si de momento es correcto
		{
			// comprobar que detrás de @ hay caracteres
			//  y al menos un punto
			$posicion1 = strpos($cadena, '@');
      		$posicion2 = strrpos($cadena, '.');
         		$seguir = (($posicion1 + 1 <= $posicion2) &&
          	          ($posicion2 < (strlen($cadena) - 1)) &&
           	         ($posicion1 <> 0));
         		if ($seguir)
          		$seguir = Comprobar_Puntos($cadena);
		}
			return $seguir;
     	}
		else
		{
			// No tiene una arroba, ni un punto.
      		return  false;
		}
	}
?>