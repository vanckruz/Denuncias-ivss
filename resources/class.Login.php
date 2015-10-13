<?php
session_start();
require_once 'classUsuarioDAO.php';
require_once 'classUsuario.php';
class Login
{
    private $modelo;
    private $usuario;
    private $ldap_info;
    private $metodo_encriptacion='sha1';

    public function __construct()
    {

        $this->modelo = new UsuarioDAO();

    }

    public function login_users($nick, $password)
    {
        if (empty($nick)){return false;}
        if (empty ($password)){return false;}
        

        $this->usuario = $this->modelo->obtenerUsuario($nick);
            /*
            //Verificar si el usuario está logueado
            $session_id = $this->usuario->GET('session_id');
            if($session_id != "" && $session_id!= session_id())
                {
                    session_destroy();
                    return false;
                }
            */
            //si existe el usuario
                if(Count($this->usuario) == 1)  
                { 
                    if($this->usuario->__GET('int_borrado')==1){return false;}
                    $pass;
                    switch ($this->metodo_encriptacion)
                    {
                        case 'sha1'|'SHA1':
                        $pass=sha1($password);
                        break;
                        case 'md5'|'MD5':
                        $pass=md5($password);
                        break;
                        case 'texto'|'TEXTO':
                        $pass=$password;
                        break;
                        default:
                        trigger_error('El valor de la propiedad metodo_encriptacion no es válido. Utiliza MD5 o SHA1 o TEXTO',E_USER_ERROR);
                    }
                    if($this->usuario->__GET('password')==$pass)
                    {
                   // @session_start();
				    //almacenamos en memoria los datos del usuario
                        $_SESSION['USUARIO']=array(
                            'user'=>$this->usuario->__GET('correo'), 
                            'nombre'=>$this->usuario->__GET('nombre'), 
                            'apellido'=>$this->usuario->__GET('apellido'),
                            'cedula'=>$this->usuario->__GET('id_user'),
                            'utype'=>$this->usuario->__GET('user_type'),
                            'departamento'=>$this->usuario->__GET('departamento'),
                            'codigo_usuario'=>$this->usuario->__GET('codigo_usuario'),
                            'estado'=>$this->usuario->__GET('estado'),
                            'tiempo'=>date("H:i:s"));
                        return true; //usuario y contraseña validadas

                   /*
                   echo $this->usuario->__GET('password')."<br>";
                   echo $this->usuario->__GET('primer_nombre')."<br>";
                   echo $this->usuario->__GET('segundo_nombre')."<br>";
                   echo $this->usuario->__GET('primer_apellido')."<br>";
                   echo $this->usuario->__GET('segundo_apellido')."<br>";
                    */
               }
           }	 
           else 
           {

                //@session_start();
                //unset($_SESSION['USUARIO']); //destruimos la session activa al fallar el login por si existia
                return false; //no coincide la contraseña
            }		 			
        }

        public static function estoy_logeado(){

        if (!isset($_SESSION['USUARIO'])) return false; //no existe la variable $_SESSION['USUARIO']. No logeado.
        if (!is_array($_SESSION['USUARIO'])) return false; //la variable no es un array $_SESSION['USUARIO']. No logeado.
        if (empty($_SESSION['USUARIO']['user'])) return false; //no tiene almacenado el usuario en $_SESSION['USUARIO']. No logeado.

        //cumple las condiciones anteriores, entonces es un usuario validado
        return true;

    }

    /**
     * Vacia la sesion con los datos del usuario validado
     */
    public function logout(){
        unset($_SESSION['USUARIO']); //eliminamos la variable con los datos de usuario;
        session_write_close(); //nos asegurmos que se guarda y cierra la sesion
        /*
        $this->usuario->__SET('session_id',"");
        $this->usuario->__SET('id_user',$_SESSION['USUARIO']['cedula']);
        
        if($this->modelo->update_session($this->usuario))
            {return true;}
        else{return false;}
        */
        return true;
    }
}
?>