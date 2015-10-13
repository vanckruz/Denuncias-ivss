<?php session_start(); ?>
<?php 
/*    <!--require('../../../resources/restrictedaccess.php');*/
    include("../../config/config.php");
    include("../../../resources/select/funciones.php");
    $direcciones = dameDirecciones();
    $codTelefono = dameCodigosTelefono();
?>
<!DOCTYPE html>
<html lang="ES">
<head>
    <meta charset="utf-8">
    <title>Fiscalizacion | Usuarios</title>
    <link rel="stylesheet" type="text/css" href="<?=$base_url;?>public_html/css/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=$base_url;?>public_html/css/visualizerut.css"/>
    <link href="../../../resources/jquery.confirm/jquery.confirm/jquery.confirm.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?=$base_url;?>public_html/vendor/DataTables/media/css/jquery.dataTables.css">
    <link rel="stylesheet" href="">
    

    <style>
        input,select,label{
          color:black !important;
      }

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

        background: #3B5998;
        padding: 11px;
        color: white;
        font-size: 23px;
        font-family: arial;
        margin-bottom: 20px;
    }
    
    .LabelForm { font-size: 89%;color: rgba(0, 0, 0, 0.7);}
    /*form hr{
        background-color: rgb(177, 177, 177);
        height: 1px;
        margin-top: 5px;
        float: left;
    }*/
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

#titulo, #saludo, #cerrar, #fecha
{
    color:white;
    font-size: 1.3em;
}
#titulo
{

    font-size:14px;
    vertical-align: middle;
    /*background-color:#022449;*/
    margin-left: -20px;
    padding:10px;
    border-radius:15px 0 15px 0;
    -moz-box-shadow: rgb(150,150,150) 5px 5px 20px;
    -webkit-box-shadow: rgb(150,150,150) 5px 5px 20px;
    box-shadow: rgba(0,0,0,0.8) 5px 10px 10px;
}
#saludo
{
    vertical-align: middle;
    padding-top: 10px; 
    float:left; 
}
#cerrar a
{
    padding-top: 10px;
    color: white !important;
    text-decoration: none;
}

#cerrar a:hover{
    color:darkblue !important;
    text-decoration:underline;
}
#fecha
{
    display: block;
    margin-top: 5px;
}

#consulta
{
    height:300px; 
    width:500px;
    margin:5px auto;
}

label{
    color: black;
    font-size: 0.8em;
}
h2{
    background:#3B5998;
    color:white;
    padding:7px;
    text-align: left;
    font-size: 1.2em;
}

h3{
    text-align: left;
    font-size: 0.9em;
    font-weight: bold;
    text-decoration: initial;
    margin-left: 14px;
}

.obligatorio{
    color:red;
}

select{
    width: 285px !important;
}
hr{
border-top: 1px solid #9A9A9A;
}
.error {
    color: red;
    font-size: 0.8em;
    font-weight: normal;
    /*padding: 0% 38% 0% 1%;*/
}
div label {
        font-size: 13px;
}
input{
    width: 239px !important;
}

 @media screen and (min-width:900px) and (max-width: 1100px) {
    .container{
        width: 880px !important;
    }
}
</style>
</head>
<body>
<div style="width:100%;background:#3B5998; margin: 0;padding:12px;">
    <div class="container">
        <div class="row">            

            <div class="col-xs-1">
                <img src="<?=$base_url;?>public_html/imagenes/logoivss_blanco.png" style="width:60px;"/>
            </div>

            <div class="col-xs-4">
                <span id="titulo">Sistema de Fiscalización</span>
            </div>

            <div class="col-xs-4">
                <span id="saludo">Bienvenido <?=$_SESSION['USUARIO']['nombre']." ".$_SESSION['USUARIO']['apellido'];?> <span class="glyphicon glyphicon-user"></span> </span>         
            </div>

            <div class="col-xs-3">
                <span id="cerrar"><a href="<?=$base_url;?>resources/logout.php" >Cerrar Sesión <span class="glyphicon glyphicon-log-out"></span></a></span>
                <span id="fecha"><?=Date("d-m-Y");?></span>
            </div>

        </div>  
    </div>
</div>
<div class="principal" style="color:black !important; background:white !important;">    
    <h3 style="background:#3B5998;color:white;margin-top:0px;padding:16px;">Resultado de la búsqueda</h3><br>
    <h4>Datos del Usuario</h4>
    <form name='UsersRegistrados' id='UsersRegistrados' action='#' method='post' style="background-color:white !important;">
        <input type="hidden" name="id" value="" id="id" />
        <input type="hidden" name="option" value="" id="option" />
        <!--/******************************************************************************************************/-->    
        <div style="margin-left:25px;margin-right:25px;">
            <table class='table table-bordered table-hover' id="tabla_consulta">
              <thead>
               <tr>
                 <th class="text-center" style="background:#3B5998;color:white !important;">Cédula</th>
                 <th class="text-center" style="background:#3B5998;color:white !important;">Nombres</th>
                 <th class="text-center" style="background:#3B5998;color:white !important;">Apellidos</th>
                 <th class="text-center" style="background:#3B5998;color:white !important;">Email</th>
                 <th class="text-center" style="background:#3B5998;color:white !important;"><span>Editar</span></th>
                 <th class="text-center" style="background:#3B5998;color:white !important;"><span>Eliminar</span></th>
             </tr>
         </thead>
         <tbody>
             <tr>
              <td class="text-center"><?=$usuario->__GET('id_user')?></td>
              <td class="text-center"><?=$usuario->__GET('nombre')?></td>
              <td class="text-center"><?=$usuario->__GET('apellido')?></td>
              <td class="text-center"><?=$usuario->__GET('correo')?></td>
              <td style="text-align:center;"><button type="button" id="<?=$usuario->__GET('id_user')?>" value="edituser" class='edit_user btn_opcion btn btn-primary' data-nacionalidad = "<?=$usuario->__GET('nacionalidad');?>"data-id = "<?=$usuario->__GET('id_user')?>"data-name = "<?=$usuario->__GET('nombre')?>"data-apellido = "<?=$usuario->__GET('apellido')?>"data-email = "<?=$usuario->__GET('correo')?>"data-pass = "<?=$usuario->__GET('password')?>"data-departamento = "<?=$usuario->__GET('departamento')?>"data-perfil = "<?=$usuario->__GET('user_type')?>"data-region = "<?=$usuario->__GET('region')?>"data-estado = "<?=$usuario->__GET('estado')?>"data-oficina = "<?=$usuario->__GET('oficina')?>"data-direcciongeneral = "<?=$usuario->__GET('direccion_general')?>"data-direccionlinea = "<?=$usuario->__GET('direccion_linea')?>"data-user = "<?=$usuario->__GET('usuario')?>"data-codigousuario = "<?=$usuario->__GET('codigo_usuario')?>"data-telefonohabitacion = "<?=$usuario->__GET('telefono_habitacion')?>"data-telefonomovil = "<?=$usuario->__GET('telefono_movil')?>" title="Editar"/><span class="glyphicon glyphicon-pencil"></span></button></td>
              <td style="text-align:center;"><button type="button" id="<?=$usuario->__GET('id_user')?>" value="eliminar" class='eliminar_user btn_opcion btn btn-danger' title="Eliminar"><span class="glyphicon glyphicon-remove"></span></button></td>
          </tr>
      </tbody>
  </table>
</form>   
</div>


<?php /* ?>
<input type='button' class='boton' value='Volver' onClick='regresar();' style="float:right;padding:3px;color:white !important;font-weight:bold;margin-right:10px;   margin-top: 0%;">
<?php */ ?>
<!-- ################################################ MODAL DE EDITAR ################################################-->
<div id="ModalBoxEdit" style="display:none;width:100%;height:100%;position:absolute;top:0px;left:0;z-index:50;overflow-y:scroll; background:rgba(0,0,0,0.5)">
    <form name="FormularioEdicion" id="FormularioEdicion" action="Controller.User.php" method="POST" style="margin-top: -20px!important;">
        <h1>Editar Usuario</h1>
        <div id="TablaFormulario" style="width:960px !important;margin:auto;padding:25px;overflow:hidden;background:#FFFFFF;box-shadow:10px 10px 21px #000;margin-bottom: 86px;">
            <h2>Datos Personales</h2>
            <input type="hidden" id="idUser" name="idUser" form="ModalForm">
            <div class="row">
                <div class="col-xs-1 form-group" style="margin: 0px 0px 0px 40px;">
                    <label style="margin-left: 10px;">Nombre</label>
                    <input type="text" class="form-control" id="NombreUser" name="NombreUser" value="" readonly="" form="ModalForm">
                </div>
                <div class="col-xs-1 form-group" style="margin: 0px 0px 0px 205px;">
                    <label style="margin-left: 10px;">Apellido</label>
                    <input type="text" class="form-control" id="ApellidoUser" name="ApellidoUser" value="" readonly="" form="ModalForm">
                </div>
                 <div class="col-xs-1 form-group" style="margin: 0px 0px 0px 205px;">
                    <label style="margin-left: 10px;">Cédula</label>
                    <input type="text" class="form-control" id="Cedula" name="Cedula" value="" readonly="" form="ModalForm">
                </div>
            </div>
            <div class="row">
                 <div class="col-xs-2 form-group" style="margin: 0px 0px 0px 40px;">
                    <label class="labelformulario" style="margin-left: -8px;;">Correo Electrónico</label>
                <input type="text" class="form-control" id="Email" name="Email" placeholder="Ej: alguien@alguien.com" form="ModalForm" maxlength="250" oncopy="return false;" onpaste="return false;" oncut="return false;">
                </div>
                <div class="col-xs-2 form-group input-group">
                    <label class="labelformulario" style="margin: 0px 0px 0px -234px;">Teléfono de Habitación</label>
                    <select name="TelefHabitacionSelect" id="TelefHabitacionSelect" class="form-control" form="ModalForm" style="width: 123px !important;height: 30px !important;margin: 30px 0px 0px 148px;border-radius: 5px 0px 0px 5px;">
                            <option value="">Seleccione</option>
                            <? 
                            foreach ($codTelefono as $TelefonoCodigo) {
                               echo "<option value=".$TelefonoCodigo['CODIGO_AREA'].">".$TelefonoCodigo['CODIGO_AREA']."</option>";
                           }
                           ?>
                       </select>
                    <input type="text" class="form-control" id="Telf_Habitacion" name="Telf_Habitacion"  form="ModalForm" placeholder="Ej: 5555555" maxlength="7" oncopy="return false;" onpaste="return false;" oncut="return false;" style="width: 117px !important;margin: -30px 0px 0px 270px;">
                </div>
                <div class="col-xs-2 form-group input-group">
                    <label class="labelformulario" style="float: left;margin: -70px 0px 0px 632px;">Teléfono Movil</label>
                     <select name="TelefMovilSelect" id="TelefMovilSelect" class="form-control"  form="ModalForm" style="width: 123px !important;height: 30px !important;margin: -45px 0px 0px 628px; border-radius: 5px 0px 0px 5px;">
                            <option value="">Seleccione</option>
                            <option value="0414">0414</option>
                            <option value="0424">0424</option>
                            <option value="0416">0416</option>
                            <option value="0416">0426</option>
                            <option value="0412">0412</option>
                    </select>
                    <input type="text" class="form-control" id="Telef_Movil" name="Telef_Movil" form="ModalForm" placeholder="Ej: 5555555" form="ModalForm"  maxlength="7" oncopy="return false;" onpaste="return false;" oncut="return false;" style="width: 118px !important;margin: -45px 0px 0px 750px;">  
                </div>
            </div>
            <h2>Datos de Usuario</h2>
            <div class="row">
                <div class="col-xs-4 form-group ">
                    <label style="margin: 0px 124px 0px 0px;"><span class="obligatorio">*</span> Usuario</label>
                    <input type="text" class="form-control" id="UserName" name="UserName" placeholder="Ej: alguien@alguien.com" form="ModalForm" maxlength="100" oncopy="return false;" onpaste="return false;" oncut="return false;" style="margin: 6px 0px 0px 46px;">
                    <p id="errorCorreoUsuarioExiste" class="error" style="display:none;">Correo ingresado ya existe</p>
                </div>
                  <div class="col-xs-4 form-group">
                     <label style="margin: 0px 203px 5px 0px;"><span class="obligatorio">*</span> Perfil</label>
                    <select id="perfil" name="perfil" class="form-control" form="ModalForm" style="margin: 0px 0px 0px 16px;width:240px!important;height: 30px !important;padding-top: 5px;">
                        <option value="" selected>Seleccione</option>
                        <option value="1">Administrador</option>
                        <option value="2">Analista</option>
                    </select>
                </div>
                <div class="col-xs-4 form-group">
                    <label style="margin: 0px 0px 7px -248px;"><span class="obligatorio">*</span> Region</label>
                    <select id="regionselect" name="regionselect" class="form-control" form="ModalForm" style="margin: -3px 0px 0px -12px;width: 242px !important;height: 30px !important;padding-top: 5px;"> 
                        <option value="">Seleccione</option>
                        <option value="CEN">Central</option>
                        <option value="OCC">Occidental</option>
                        <option value="OR">Oriental</option>
                    </select>
                </div>
            </div>
            <div class="row">                
                 <div class="col-xs-2 form-group">
                    <label style="margin: 0px 0px 7px 20px;"><span class="obligatorio">*</span> Estado</label>
                    <select id="estadoselect" name="estadoselect" class="form-control" form="ModalForm" style="margin: -1px 0px -3px 45px;padding-top: 5px;width: 240px!important;height: 30px !important;"> 
                        <option value="">Seleccione</option>
                    </select>
                </div>
                <div class="col-xs-4 form-gruop">
                    <label style="margin: 0px -219px 0px 1px;"><span class="obligatorio">*</span> Oficina Administrativa</label>
                    <select id="oficinaselect" name="oficinaselect" class="form-control" form="ModalForm" style="margin: 6px 0px 0px 171px;width: 245px !important;height: 30px !important;padding-top: 5px;">
                            <option value="">Seleccione</option>
                    </select>
                </div>
                 <div class="col-xs-4 form-group">
                <label style="margin: 0px -124px 0px 0px;"><span class="obligatorio">*</span> Dirección General</label>
                <select id="direcciongeneralselect" name="direcciongeneralselect" class="form-control" form="ModalForm" style="    margin: 6px 0px 0px 144px;width: 245px !important;height: 30px !important;padding-top: 5px;">
                        <option value="">Seleccione</option>
                        <?
                        foreach ($direcciones as $direcciongeneral) {
                            echo  "<option value=".$direcciongeneral['ID_DIRECCION'].">".$direcciongeneral['NOMBRE']."</option>";
                        }
                        ?>
                    </select>
            </div>               
            </div>
            <div class="row">
             <div class="col-xs-4 form-gruop">
                    <label style="margin: 0px 64px 0px 0px;"><span class="obligatorio">*</span> Dirección de Línea</label>
                    <select id="direccionlineaselect" name="direccionlineaselect" class="form-control" form="ModalForm" style="margin: 6px 0px 0px 43px;width: 245px !important;height: 30px !important;padding-top: 5px;">
                        <option value="">Seleccione</option>
                        <option value="1">Dirección de Apoyo Técnico Administrativo</option>
                        <option value="2">Direcciones de Fiscalización Región Oriente</option>
                        <option value="3">Direcciones de Fiscalización Región Occidente</option>
                    </select>
                </div>                
                <div class="col-xs-4 form-group">
                <label style="margin: 0px 180px 0px 0px;"><span class="obligatorio">*</span> División</label>
                <select id="divisionselect" name="divisionselect" class="form-control" form="ModalForm" style="padding-top: 5px;width: 245px !important;height: 30px;margin: 6px 0px 0px 15px;">
                    <option value="">Seleccione</option>
                    <option value="1">División de Atención al Denunciante</option>
                    <option value="2">División de Conformación y Sustanciación de Expedientes Administrativos</option>|
                </select>
                </div> 
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-2 col-xs-offset-4 form-group">                   
                    <button id="AceptarUpdate" type="button"  class="btn btn-primary">
                        <span class="glyphicon"></span> Aceptar
                    </button>
                </div>
                <div class="col-xs-2 form-group">
                     <button id="CancelUpdate"  type="button"  class="btn btn-danger">
                        <span class="glyphicon"></span> Regresar
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- ################################################ MODAL DE EDITAR ################################################-->
<!-- ############################################### MODAL DE ELIMINAR ###############################################-->
<div id="ModalBox" style="display:none;width:100%;height:100%;position:fixed;top:0px;left:0px;z-index:50;overflow:hidden; background-color: rgba(0, 0, 0, 0.498039)">
  <div style="">    
  </div>  
  <div style="width: 26%;margin: 16% 0% 0% 37%;height: 182px;overflow:hidden;padding:12px;background:#f1f1f1;">
    <form action="Controller.Users.php" method="post" id="ModalForm">
      <p style="text-align:center;margin-bottom:12px;font-size:1.1em;font-weight:bold;" id="PreguntaModal"></p>
      <input name="option" id="opt" type="hidden">
      <input name="id" id="id_opt" type="hidden">
      <input name="email" id="email_opt" type="hidden">
      <div>
        <button class="btn btn-primary" id="confirm_form" style="margin-top: 12%;"><span id="spanbutton" class="glyphicon"></span id="spantext"> Aceptar</button>
        <button class="btn btn-danger" id="cancel_form" style="margin-top: 12%;"><span class="glyphicon"></span> Cancelar</button>
    </div>
</form> 
</div>
</div>
</div>
</body>
<div style="width:100%;background:#3B5998; margin: 0; position: fixed;bottom: 0;left:0;">
        <div class="container">  
            <div class="row">
                <div class="col-xs-12" style="padding:12px;">
                    <p style="text-align:center;margin-top:7px;font-size:0.7em;color:white;">
                        LA SEGURIDAD SOCIAL ES TU DERECHO<br>
                        INSTITUTO VENEZOLANO DE LOS SEGUROS SOCIALES (IVSS) 2015<br>
                        DESARROLLADO POR LA DIRECCIÓN GENERAL DE INFORMÁTICA                
                    </p>
                    <div style="position:absolute;top:2px;right:25px;width:210px;border-left:1px solid white;">
                        <div style="width:100px;float:left;">
                            <a id="volver_act" onclick="javascript:window.history.back();" data-content="" rel="popover" data-placement="left" data-original-title="Volver" data-trigger="hover">
                                <div style="cursor:pointer;padding:3px;" class="menu_inf_item" id="volver_act">
                                    <img src="<?=$base_url;?>public_html/imagenes/iconos/volver.png" style="width:30px;">
                                    <p style="font-size:0.7em;color:white;margin-top:10px;">Volver</p>
                                </div> 
                            </a>
                        </div>

                        <div style="width:100px;float:left;">
                            <a onclick="location='<?=$base_url;?>'" id="menu_principal" data-content="" rel="popover" data-placement="left" data-original-title="Ir al menu principal" data-trigger="hover">
                                <div style="cursor:pointer;padding:3px;" class="menu_inf_item">
                                    <img src="<?=$base_url;?>public_html/imagenes/iconos/home.png" style="width:30px;">
                                    <p style="font-size:0.7em;color:white;margin-top:10px;">Menu home</p>
                                </div>    
                            </a>
                        </div>
                    </div><!--Navegación inferior-->
                </div>
            </div>
        </div>
    </div>

<!-- ############################################### MODAL DE ELIMINAR ###############################################-->
<!--/******************************************************************************************************/-->   
<script type="text/jscript" src="<?=$base_url;?>public_html/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="<?=$base_url;?>public_html/js/enviar.js"></script>
<script type="text/javascript" src="<?=$base_url;?>resources/jquery.confirm/jquery.confirm/jquery.confirm.js"></script>
<script type="text/javascript" src="<?=$base_url;?>resources/jquery.confirm/js/script.js"></script>
<script type="text/javascript" src="<?=$base_url;?>public_html/vendor/jQueryValidation/dist/jquery.validate.js"></script>
<script type="text/javascript" src="<?=$base_url;?>public_html/vendor/DataTables/media/js/jquery.dataTables.js"></script>
<script type='text/javascript'>
    $(document).on("ready",function(){
      window.Edit_or_Delete = "0";
  });

    function regresar(){
      var pagina = 'http://desarrollofiscalizacion.ivss.int/App/mod_denuncias/denuncias.php';
      location.href=pagina
  }
  $(document).ready(function($) {
    //$("#tabla_consulta").dataTable(); Aqui no se usa el datatable es de uno viejo !
});


$(".edit_user").on("click",function(){
    $("#opt").val('buscarUser');
    $("#id_opt").val(this.id);
    $("#email_opt").val($(this).attr("data-email"));
    $("#PreguntaModal").text("¿Desea editar este usuario?")
    $("#ModalBox").fadeIn();
 });

  $(".eliminar_user").on("click",function(){
      $("#opt").val('eliminar');
      $("#id_opt").val(this.id);      
 
      $("#PreguntaModal").text("¿Desea eliminar este usuario del sistema?")
      $("#ModalBox").fadeIn();
  })

  $("#cancel_form").on("click",function(e){
      e.preventDefault();
      $("#ModalBox").fadeOut();
  })

  $("#confirm_form").on("click",function(e){
    var Ofiid = "";
    var Estid = "";
    if ($("#opt").val() == 'buscarUser'){
        e.preventDefault();
        $.ajax({
            dataType: "json",
            type:"post",
            data:{"option": $("#opt").val(),'id':$("#id_opt").val(),'email':$("#email_opt").val()},
            url:"Controller.Users.php",
            beforeSend:function(){

            },
            success:function(resp){
                var primera_letra_estado = ""
                primera_letra_estado = resp.ESTADO.split("");
                //console.log(resp)
                $("#idUser").val( $("#id_opt").val());
                $("#NombreUser").val(resp.NOMBRE);
                $("#ApellidoUser").val(resp.APELLIDO);
                $("#Cedula").val(resp.ID_USER);
                $("#Email").val(resp.CORREO);
                //Telefono de habitacion//
                if (resp.TELEFONO_HABITACION !== null){
                    var TelefHabitacion = resp.TELEFONO_HABITACION.split("");
                    var ExtensionHabitacion = TelefHabitacion[0]+TelefHabitacion[1]+TelefHabitacion[2]+TelefHabitacion[3];
                    $("#TelefHabitacionSelect").val(ExtensionHabitacion);
                    $("#Telf_Habitacion").val(TelefHabitacion[4]+TelefHabitacion[5]+TelefHabitacion[6]+TelefHabitacion[7]+TelefHabitacion[8]+TelefHabitacion[9]+TelefHabitacion[10]);
                }

                if (resp.TELEFONO_MOVIL !== null){
                    var TelefMovil = resp.TELEFONO_MOVIL.split("");
                    var ExtensionMovil = TelefMovil[0]+TelefMovil[1]+TelefMovil[2]+TelefMovil[3];
                    $("#TelefMovilSelect").val(ExtensionMovil);
                    $("#Telef_Movil").val(TelefMovil[4]+TelefMovil[5]+TelefMovil[6]+TelefMovil[7]+TelefMovil[8]+TelefMovil[9]+TelefMovil[10]);
                }
                //Telefono de movil//
                //.0
                $("#UserName").val(resp.USUARIO);
                $("#CodUser").val(resp.CODIGO_USUARIO);
                $("#perfil").val(resp.USER_TYPE);
                $("#regionselect").val(resp.REGION);
                $("#direcciongeneralselect").val(resp.DIRECCION_GENERAL);
                $("#direccionlineaselect").val(resp.DIRECCION_LINEA);
                $("#divisionselect").val(resp.DEPARTAMENTO);
                /*---------------------   CAMBIAMOS EL COMO DE ESTADO --------------------------------*/
                $.ajax({
                    dataType: "json",
                    data: {region:resp.REGION},
                    url:   '../../../resources/select/buscar.php',
                    type:  'post',
                    beforeSend: function(){

                    },
                    success: function(resp){
                        //lo que se si el destino devuelve algo
                        $("#estadoselect").html(resp.html);
                        //console.log(resp.html);                         
                    },
                    async:false
                }).done(function(){
                    primera_letra_estado = resp.ESTADO.split("");
                    $("#estadoselect").val(resp.ESTADO);
                });
                /*---------------------   CAMBIAMOS EL COMO DE LA OFICINA --------------------------------*/
                $.ajax({
                    dataType: "json",
                    data: {"primera_letra": primera_letra_estado[0]},
                    url:   '../../../resources/select/buscar.php',
                    type:  'post',
                    beforeSend: function(){
                    //Lo que se hace antes de enviar el formulario
                    },
                    success: function(respuesta){
                    //lo que se si el destino devuelve algo
                        $("#oficinaselect").html(respuesta.html);
                    },
                    error:  function(xhr,err){ 
                    //alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
                    }
                }).done(function(){
                    $("#oficinaselect").val(resp.OFICINA)
                });
                /*---------------------   CAMBIAMOS EL COMO DE ESTADO --------------------------------*/
            }
        }).done(function(){
            $("#ModalBox").fadeOut();
            $("#ModalBoxEdit").fadeIn();
            //$("#oficinaselect").val(Ofiid);
        });
    } else {
        $("#ModalForm").validate({
                rules:{
                    UserName:{
                        required:  true,
                        minlength: 5
                    },
                    CodUser:{
                        required:  true,
                        minlength: 5
                    },
                    password:{
                        required:  true,
                        minlength: 6
                    },
                    Email:{
                        required:  true,
                        email :    true
                    },
                    perfil:{
                        required:        true,
                        valueNotEquals: ""
                    },
                    regionselect:{
                        required:        true,
                        valueNotEquals: ""                    
                    },
                    estadoselect:{
                        required:        true,
                        valueNotEquals: ""
                    },
                    oficinaselect:{
                        required:        true,
                        valueNotEquals: ""
                    },
                    direcciongeneralselect:{
                        required:        true,
                        valueNotEquals: ""
                    },
                    direccionlineaselect:{
                        required:        true,
                        valueNotEquals: ""
                    },
                    divisionselect:{
                        required:        true,
                        valueNotEquals: ""
                    }
                },
                messages:{
                    UserName:{
                        required:   "Este campo es requerido",
                        minlength:  "El nombre de usuario debe ser mayor de 5 caracteres"
                    },
                    CodUser:{
                        required:    "Este campo es requerido",
                        minlength:   "El nombre de usuario debe ser mayor de 5 caracteres"
                    },
                    password:{
                        required:  "Este campo es requerido",
                        minlength: "La contraseña debe ser mayor de 6 caracteres"
                    },
                    Email:{
                        required: "Este campo es requerido",
                        email :   "Ingrese un correo con el formato correcto correo@correo.com"
                    },
                    perfil:{
                        required:  "Este campo es requerido"
                    },
                    regionselect:{
                        required:  "Este campo es requerido"
                    },
                    estadoselect:{
                        required:  "Este campo es requerido"
                    },
                    oficinaselect:{
                        required:  "Este campo es requerido"
                    },
                    direcciongeneralselect:{
                        required:  "Este campo es requerido"
                    },
                    direccionlineaselect:{
                        required:  "Este campo es requerido"
                    },
                    divisionselect:{
                        required:  "Este campo es requerido"
                    }
                },
                submitHandler: function(form,event) {
                    var EstadoSelectoption = $("#estadoselect option:selected").data("estado");
                    $("#estadoselect option").val(EstadoSelectoption);
                    console.log(EstadoSelectoption);
                    event.preventDefault();
                    form.submit();
                }
            });
        /*------------------CAMBIAMOS EL VAL DEL SELECT DE ESTADO POR EL DATA-ESTADO -------*/
     
        //console.log($("#estadoselect option").val());
        /*------------------CAMBIAMOS EL VAL DEL SELECT DE ESTADO POR EL DATA-ESTADO -------*/
        /*alert("aqui");*/
        //document.getElementById('FormularioEdicion').submit();
    }
  });

  $("#CancelUpdate").on("click",function(e){
    e.preventDefault;
    $("#ModalBoxEdit").fadeOut();
  })
  $("#AceptarUpdate").on("click",function(e){
    e.preventDefault;
    $("#opt").val('editar');
    $("#id_opt").val(this.id);
    $("#PreguntaModal").text("¿Desea editar este usuario?")
    /*$("#spanbutton").removeClass('glyphicon-trash');
    $("#confirm_form").removeClass('btn-danger');
    $("#spanbutton").addClass("glyphicon-pencil");
    $("#confirm_form").addClass('btn-primary');*/
    $("#ModalBox").fadeIn();
  })

$("#regionselect").on("change",function(){
    ComboEstado($("#regionselect").val());
})

$("#estadoselect").on("change",function(){
    ComboOficina($("#estadoselect").val());
})

  function ComboEstado(REGIONID){
    $.ajax({
        dataType: "json",
        data: {"region":REGIONID},
        url:   '../../../resources/select/buscar.php',
        type:  'post',
        beforeSend: function(){

        },
        success: function(resp){
            $("#estadoselect").html(resp.html);
        },
        async:false
    });    
}

    function ComboOficina(ESTADOID){
        $.ajax({
            dataType: "json",
            data: {"primera_letra": ESTADOID},
            url:   '../../../resources/select/buscar.php',
            type:  'post',
            beforeSend: function(){
                //Lo que se hace antes de enviar el formulario
            },
            success: function(respuesta){
                //lo que se si el destino devuelve algo
                $("#oficinaselect").html(respuesta.html);
            },
            error:  function(xhr,err){ 
                //alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
            }
        });
    }
function justNumbers(e){
    var keynum = window.event ? window.event.keyCode : e.which;
        //if (keynum == 13)
             //$("#ButtonLogin").click;
             if ((keynum == 8) || (keynum == 46))
                return true;         
            return /\d/.test(String.fromCharCode(keynum));        
        }
</script>

</html>

