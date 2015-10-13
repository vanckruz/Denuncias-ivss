
<!doctype html>
<html lang="ES">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximun-scale=1">
  <link rel="shortcut icon" href="../../../public_html/imagenes/favicon.ico" type="image/x-icon" />
  <link href="../../../../public_html/css/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="../../../public_html/css/styles2.css" rel="stylesheet" type="text/css">
  <link href="../../../public_html/css/formularios.css" rel="stylesheet"/>        
  <title>Sistema de Fiscalización</title>
</head>
<style>
    .popover{
        width: 400px;
    }

    .menu_inf_item:hover{
      background: #9ECC02;
      box-shadow: inset 0px 5px 20px #466101;
  }

  .content-menu{
    width:150px;
    position:absolute;
    top:84px;
    left:0;
}
.item-menu{
    width:150px;
    height:90px;
    background:#3B5998;
    border-top:1px dotted #f1f1f1;
    padding:5px;
}
.item-menu:hover{
    background: #9ECC02;
    box-shadow: inset 0px 5px 20px #466101;
    cursor:pointer;
}

.item-menu a:hover{
    cursor:pointer;
}

.item-menu p{
    font-size: 0.7em;
    margin-top: 5px;
    margin-bottom:5px;
}

.img_menu{
    width:40px;
    height:auto;
    margin:auto;
    margin-top:2px;
    opacity:0.7;
}

.AlertBoxCargando{
    border-radius:0px;
}  

    input, textarea, select{ 
        padding: 9px;
        height: 30px;
        border: solid 1px #E5E5E5; 
        outline: 0; 
        font: normal 13px/100% Verdana, Tahoma, sans-serif; 
        width: 200px; 
        background: #FFFFFF url('bg_form.png') left top repeat-x; 
        background: -webkit-gradient(linear, left top, left 25, from(#FFFFFF), color-stop(4%, #EEEEEE), to(#FFFFFF)); 
        background: -moz-linear-gradient(top, #FFFFFF, #EEEEEE 1px, #FFFFFF 25px); 
        box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px; 
        -moz-box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px; 
        -webkit-box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px; 
    } 
    select,input{
        padding: 0% 3%;
        border: solid 1px rgba(219, 219, 219, 0.99);
        margin: 7px;
        /*width: 100% !important;*/
    }
    option{
        background:white;
    }

    .inputleft{
        /*width: 100% !important;*/
        width: 300px !important;
    }

    .inputright{
        /*width: 80% !important;*/
        width: 300px !important;
    }
    
    textarea { 
        width: 400px; 
        max-width: 400px; 
        height: 150px; 
        line-height: 150%; 
    } 
    
    input:hover, textarea:hover, select:hover,
    input:focus, textarea:focus, select:focus
    { 
        border-color: #C9C9C9; 
        -webkit-box-shadow: rgba(76, 133, 255, 0.73) 0px 0px 8px; 
    }
    form {
        background: #f1f1f1;
        margin-bottom: 7%;
        height: auto;
    }

    form  h1{

        background: #234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0%;
        padding: 11px;
        color: white;
        font-size: 23px;
        font-family: arial;
        margin-bottom: 20px;
    }
    
    .LabelForm { font-size: 89%;color: rgba(0, 0, 0, 0.7);}
    form hr{
        background-color: rgb(177, 177, 177);
        height: 1px;
        margin-top: 5px;
        float: left;
    }
    form button{
        height: 30px;
    } 
    form .separador label{

        font-family: Arial;
        font-size: 103%;
        border: solid 3px rgb(95, 148, 195);
        margin: 0% 80% 0% 0%;
        padding: 0.5% 1.0% 0.5% 1%;
        border-radius: 30px;
        background-color: #E7E5E5;

    }

    form .separador hr{

        margin-top: -2.3%;
        margin-bottom: 10px;
        width: 77%;
        margin-left: 19%;
        height: 0.14em;
        background: #538ec2;
        background: -moz-linear-gradient(left, #538ec2 0%, #f1f1f1 100%, #f1f1f1 100%, #f1f1f1 100%);
        background: -webkit-gradient(linear, left top, right top, color-stop(0%,#538ec2), color-stop(100%,#f1f1f1), color-stop(100%,#f1f1f1), color-stop(100%,#f1f1f1));
        background: -webkit-linear-gradient(left, #538ec2 0%,#f1f1f1 100%,#f1f1f1 100%,#f1f1f1 100%);
        background: -o-linear-gradient(left, #538ec2 0%,#f1f1f1 100%,#f1f1f1 100%,#f1f1f1 100%);
        background: -ms-linear-gradient(left, #538ec2 0%,#f1f1f1 100%,#f1f1f1 100%,#f1f1f1 100%);
        background: linear-gradient(to right, #538ec2 0%,#f1f1f1 100%,#f1f1f1 100%,#f1f1f1 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#538ec2', endColorstr='#f1f1f1',GradientType=1 );
    }

    .submit input { 
        width: auto; 
        padding: 9px 15px; 
        background: #617798; 
        border: 0; 
        font-size: 14px; 
        color: #FFFFFF; 
        -moz-border-radius: 5px; 
        -webkit-border-radius: 5px; 
    }
    td {
        text-align: right;
    }
    .loginbox{
        background:#3B5998;
        height: 59%;
        width: 39%;
        margin: 7% 0% 0% 32%;
        box-shadow: 8px 8px 7px 2px #ccc;
        border-radius: 11% 4%;
        padding: 16px;
    }
    .loginbackground{
    /*position: absolute;
    width: 101%;
    height: 500px;
    background: rgba(0,0,0,0.5);
    margin-top: 0;
    z-index: 2;
    margin-left: -1%;*/
}


.login-message{
    font-family: arial;
    font-size: 20px;
    color: white;
    padding: 13% 0% 1% 0%;
}

.volverBotones{
    position: relative;
    z-index: 2;
}

.Alert{

    position: absolute;
    width: 99.1%;
    height: 88.1%;
    margin-top: -5.8%;
    z-index: 2;
}

.AlertBox{
  background: white;
  height: 26%;
  width: 45%;
  margin: 16% 0% 14% 27%;
  box-shadow: 2px 3px 7px 2px #ccc;
  border-radius: 20px;
}

.AlertBoxCargando{
    background: #3B5998;
    border-radius:0px;
    box-shadow: 3px 3px 1px 7px #f1f1f1;
    height: 70%;
    width: 60%;
    position: absolute;
    bottom:380px;
    left:200px;
}
.titulo{
    background:#3B5998;
    padding:25px;
    color: white;
    font-size:1.3em;
    text-align:center;
}
.AlertMensaje{

    font-family: arial;
    font-size: 20px;
    color: black;
    padding: 13% 0% 1% 0%;
}

.DivImagen{
    margin-top: -44%;
    opacity: 1;
    position: relative;
}
.obligatorio{
    color:red;
    /*margin-right: 0.4%;*/
    width: 100px;
    margin-left: -1px;
}
.error {
  color: red;
  font-size: 79%;
  padding: 0% 2% 0% 1%;
}


</style>
<!-- ##################################### PANEL LATERAL #########################################-->
<body style="background:linear-gradient(to right, #AFA19E, #E7E7FF, #E7E7E7, #8E8E8E) no-repeat scroll 0% 0% #8E8E8E;height:auto;">
   
<!-- ##################################### PANEL LATERAL #########################################-->
    <div style="width:100%;background:#3B5998; margin: 0;padding:12px;">
        <div class="container">
            <div class="row">            
                
                <div class="col-xs-1">
                    <img src="../../../public_html/imagenes/logoivss_blanco.png" style="width:60px;"/>
                </div>

                <div class="col-xs-4">
                    <span id="titulo">SISTEMA DE FISCALIZACIÓN DEL IVSS</span>
                </div>
                
                <div class="col-xs-4">
                    <span id="saludo">Bienvenido ITALO ANTONIO LAPREA QUINTERO <span class="glyphicon glyphicon-user"></span> </span>         
                </div>
                
                <div class="col-xs-3">
                    <span id="cerrar"><a href="../../resources/logout.php">Cerrar Sesión <span class="glyphicon glyphicon-log-out"></span></a></span>
                    <span id="fecha">22-08-2015</span>
                </div>

            </div>  
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12" id="contenidos" style="min-height:600px;">
		<!--*************************************************** CONTENIDO ***************************************************-->
             <form name="FormularioRegistroUsuario" id="FormularioRegistroUsuario" action="#" method="post" style="margin-bottom:60px !important;">
        <input type="hidden" name="option" value="registro">    
        <h1>Editar Usuario</h1>
        <div class="Alert" id="MensajeAlerta" style="display:none;">
            <div class="AlertBox">
                <div class="AlertMensaje">
                    <span id="TextoAlerta"></span>
                </div>          
                <button id="ButtonAlert" name="ButtonAlert" type="button" style="width: 157px;   margin-top: 18px; "  class="btn btn-warning">
                    <span class=""></span>Aceptar
                </button>     
            </div>
        </div>
        <!--  ////////////////////////////////////PANTALLA DE DATOS DEL USUARIO/////////////////////////////////////////////  -->
        <center>
            <table>
                <tr>
                    <th colspan="4" style="padding: 0% 0% 2% 0%;">
                        <div class="separador">
                            <label style="color:black; margin-top: 1%;" class="LabelForm">Datos Personales</label>
                            <hr>
                        </div>
                    </th>
                </tr>      
                <tr>
                    <td>
                        <label class="LabelForm">Nombre</label>
                        <input type="text" id="NombreUser" name="NombreUser" class="inputleft" readonly="">
                    </td>
                    <td>
                        <label class="LabelForm">Apellido</label>
                        <input id="ApellidoUser" name="ApellidoUser" type="text" class="inputright" readonly="">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="LabelForm">Cédula</label>
                        <input id="Cedula" name="Cedula" type="text" class="inputleft" readonly="">
                    </td>
                    <td>
                        <span class="obligatorio">*</span>
                        <label id="EmailLabel" class="LabelForm">Correo Electrónico</label>
                        <input id="Email" name="Email" type="text" class="inputright" maxlength="100" pattern="^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,3})$" title="ingrese un email válido">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="LabelForm">Teléfono de Habitación</label>
                        <input id="Telf_Habitacion" name="Telf_Habitacion" type="text" class="inputleft" onkeypress="return justNumbers(event);" maxlength="11">
                    </td>
                    <td>
                        <label style="margin-left: 8%;" class="LabelForm">Teléfono Móvil</label>
                        <input id="Telef_Movil" name="Telef_Movil" type="text" class="inputright" onkeypress="return justNumbers(event);" maxlength="11">
                    </td>
                </tr>
                <tr>
                    <th colspan="4" style="padding: 0% 0% 2% 0%;">
                        <div class="separador">                    
                            <label style="color:black; margin-top: 1%;" class="LabelForm">Datos de Usuario</label>
                            <hr>
                        </div>
                    </th>
                </tr>
                <tr>
                    <td>
                        <span class="obligatorio">*</span>
                        <label id="UsuarioLabel" class="LabelForm">Usuario</label>
                        <input name="UserName" id="UserName" type="text" class="inputleft" maxlength="100">
                    </td>
                    <td>
                        <span class="obligatorio" style="width: 100px;margin-left: -1px;">*</span>
                        <label id="CodUserLabel" class="LabelForm">Código del Usuario</label>
                        <input name="CodUser" id="CodUser" type="text" class="inputright" maxlength="100">
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="obligatorio">*</span>
                        <label id="PasswordLabel" class="LabelForm">Contraseña</label>
                        <input name="password" id="password" type="password" class="inputleft" maxlength="100">
                    </td>
                    <td>
                        <span class="obligatorio">*</span>
                        <label id="PerfilLabel" class="LabelForm">Perfil</label>
                        <select id="perfil" name="perfil" class="inputright">
                            <option value="" selected="selected" name="opcdef" >Seleccione</option>
                            <option value="1">Administrador</option>
                            <option value="2">Analista</option>
                            <option value="3">Responsable</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><span class="obligatorio">*</span><label id="RegionLabel" class="LabelForm">Región</label>
                        <select id="regionselect" name="regionselect" class="inputleft"> 
                            <option value="">Seleccione</option>
                            <option value="CEN">Central</option>
                            <option value="OCC">Occidental</option>
                            <option value="OR">Oriental</option>
                        </select>
                    </td>
                    <td><span class="obligatorio">*</span><label id="EstadoLabel" class="LabelForm">Estado</label>                
                        <select id="estadoselect" name="estadoselect" class="inputright"> 
                            <option value="">Seleccione</option>
                        <!--<?
                        //foreach ($estados as $estado) {
                            //echo  "<option value=".$estado['INICIAL_NUMERO_EMPRESA'].">".$estado['NOMBRE_ESTADO']."</option>";
                          //  }
                        ?>-->
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="obligatorio">*</span>
                    <label style="margin-left: -1%;" id="OfiAdminLabel" class="LabelForm">Oficina Administrativa</label>
                    <select id="oficinaselect" name="oficinaselect" class="inputleft">
                        <option value="">Seleccione</option>
                    </select>
                </td>
                <td>
                    <span class="obligatorio">*</span>
                    <label id="DirGenLabel" class="LabelForm">Dirección General</label>
                    <select id="direcciongeneralselect" name="direcciongeneralselect" class="inputright">
                        <option value="">Seleccione</option>
                        <?
                        foreach ($direcciones as $direcciongeneral) {
                            echo  "<option value=".$direcciongeneral['ID_DIRECCION'].">".$direcciongeneral['NOMBRE']."</option>";
                        }
                        ?>
                    </select>
                </td>                
            </tr>
            <tr>
                <td>
                    <span class="obligatorio">*</span>
                    <label id="DirecLineaLabel" class="LabelForm">Dirección de Línea</label>
                    <select id="direccionlineaselect" name="direccionlineaselect" class="inputleft">
                        <option value="">Seleccione</option>
                        <option value="1">Dirección de Apoyo Técnico Administrativo</option>
                        <option value="2">Direcciones de Fiscalización Región Oriente</option>
                        <option value="3">Direcciones de Fiscalización Región Occidente</option>
                    </select>
                </td>
                <td>
                    <span class="obligatorio">*</span>
                    <label id="DivisionLabel" class="LabelForm">División</label>                
                    <select id="divisionselect" name="divisionselect" class="inputright">
                        <option value="">Seleccione</option>
                        <option value="1">División de Atención al Denunciante</option>
                        <option value="2">División de Conformación y Sustanciación de Expedientes Administrativos</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: center;">
                    <button style="  margin-bottom: 10px;" id="btn-volver" type="submit"  class="btn btn-default btn-volver">
                        <span class="glyphicon glyphicon-user"></span> Aceptar
                    </button>                                 
                </td>
            </tr>
        </table>
        <!--  ////////////////////////////////////PANTALLA DE DATOS DEL USUARIO/////////////////////////////////////////////  -->    
    </form>



        <!--*************************************************** CONTENIDO ***************************************************-->
            </div>
        </div>
    </div>
    <!--**********************************************************************************************FOOTER*********************************-->
    <div style="width:100%;background:#3B5998; margin: 0; position: fixed;bottom: 0;left:0;">
        <div class="container">  
            <div class="row">
                <div class="col-xs-12" style="padding:12px;">
                    <p style="text-align:center;margin-top:7px;font-size:0.7em;color:white;">
                        LA SEGURIDAD SOCIAL ES TU DERECHO<br>
                        INSTITUTO VENEZOLANO DE LOS SEGUROS SOCIALES (IVSS) 2015<br>
                        DESARROLLADO POR LA DIRECCIÓN GENERAL DE INFORMÁTICA                
                    </p>
                    <div style="position:absolute;top:2px;right:25px;width:210px;border-left:1px solid white;"  id="volverButton">
                        <div style="width:100px;float:left;">
                            <a  id="volver_act" data-link="http://desarrollofiscalizacion.ivss.int/App/mod_users/users.php" data-content="" rel="popover" data-placement="left" data-original-title="Volver" data-trigger="hover">
                                <div style="cursor:pointer;padding:3px;" class="menu_inf_item" id="volver_act">
                                    <img src="../../../public_html/imagenes/iconos/volver.png" style="width:30px;">
                                    <p style="font-size:0.7em;color:white;margin-top:10px;">Volver</p>
                                </div> 
                            </a>
                        </div>

                        <div style="width:100px;float:left;">
                            <a onClick="location='http://desarrollofiscalizacion.ivss.int/'" id="menu_principal" data-content="" rel="popover" data-placement="left" data-original-title="Ir al menu principal" data-trigger="hover">
                                <div style="cursor:pointer;padding:3px;" class="menu_inf_item" >
                                    <img src="../../../public_html/imagenes/iconos/home.png" style="width:30px;">
                                    <p style="font-size:0.7em;color:white;margin-top:10px;">Menu home</p>
                                </div>    
                            </a>
                        </div>
                    </div><!--Navegación inferior-->
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../../../public_html/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="../../../public_html/js/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="../../../public_html/js/mostrarContenido.js"></script>
    <script type="text/javascript" src="../../../public_html/js/valida_login.js"></script>
    <script type="text/javascript" src="../../../public_html/vendor/jQueryValidation/dist/jquery.validate.js"></script>
    <script>
    $("#volverButton").on("click",function(){
        window.location.href = "http://desarrollofiscalizacion.ivss.int/App/mod_users/users.php";
    });
    
    </script>
</body>
</html>