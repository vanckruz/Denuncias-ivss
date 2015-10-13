 <?php

 class Visualizer
 {
 	private $dep; 
 	private $status;
 	private $sts_denuncia;
 	private $sts_queja;
 	
 	public function __construct($dep="", $sts="")
 	{
 		$this->dep=$dep;
 		$this->status =$sts;
 		$this->sts_denuncia = dameEstatusDenuncia();
 		//$this->sts_queja    = dameEstatusQueja();
 	}
 	
                /**
                 * showMensaje
                 *
                **/
                public function showMensaje($id_denuncia = "")
                {
					//MENSAJES RELACIONADOS CON DENUNCIAS
                	
                	if($this->dep=="DEN")
                	{
                		if($this->status=='EXIST')
                		{
                			include("denuncia_existe.php");
                		}
                		
                		elseif($this->status=='ERR')
                		{
                			require("denuncia_error.php");
                		}
                		elseif($this->status=='REG_OK')
                		{
                			require("denuncia_ok.php");
                			require("bottomView.tpl.php");
                		}
                		
                		elseif($this->status=='NRF')
                		{
                			require("denuncias_blank.php");
                		}
                		
                		elseif($this->status=='UPD_OK')
                		{
                			
                			require("denuncia_upd_ok.php");
                			require("bottomView.tpl.php");
                		}
                		
                		elseif($this->status=='DEL_OK')
                		{
                			require("denuncia_del_ok.php");
                		}
                	}
                	else if($this->dep=="CIU")
                	{
                		
                		if($this->status=="NRF")
                		{
                			require("../../mod_ciudadanos/Views/ciudadano_blank.php");
                		}
                	}
                	else if($this->dep=="QR")
                	{
                		
                		if($this->status=="UPD_OK")
                		{
                			require("queja_update_ok.php");
                		}
                		if($this->status=="REG_OK")
                		{
                			require("queja_ok.php");
                		}
                		if($this->status=="EXIST")
                		{
                			require("queja_existe.php");
                		}
                	}
                	require("bottomView.tpl.php");
                }
                
                public function mostrarDenuncia($den)
                {	
                	$sts = array('0'=>'Procedente', '1'=>'Improcedente', '2'=>'Cerrada');
                	$cedula = $den[0]->__GET('id_ciudadano');
                	$id_ciu = $cedula;
                	$rif = $den[0]->__GET('rif');
                	$persona = new FiscCiudadano();
                	$pd = new FiscCiudadanoDAO();
                	$empresa = new FiscEmpresa();
                	$modelo = new FiscEmpresaDAO();
				//$empresa = $modelo->queryByRif($rif);
                	$persona = $pd->getById($id_ciu);
                	$mot = dameMotivos();
				//$nac = $persona->__GET('nacionalidad');
                	$cedula = $persona->__GET('id_ciudadano');
                	$nombre = ucfirst($persona->__GET('nombres'));
                	$apellido = ucfirst($persona->__GET('apellidos'));
                	require('view_denuncia.php');
                	require("bottomView.tpl.php");
                }
                
                
                public function mostrarUpdateDen($den, $per)
                {
                	$sts = array('0'=>'Procedente', '1'=>'Improcedente', '2'=>'Cerrada');
                	$cedula = $per ->__get('id_ciudadano');
                	$nombre = $per ->__get('primer_nombre')." ".$per ->__get('segundo_nombre');
                	$apellido = $per ->__get('primer_apellido')." ".$per ->__get('segundo_apellido');
                	require("view_denuncia_actualizar.php");
                	require("bottomView.tpl.php");
                }
                
                public function showUpForm($denuncia, $persona, $empresa)
                {

                	//$sts = array('0'=>'Procedente', '1'=>'Improcedente', '2'=>"Cerrada");
                	$it = new ArrayIterator($persona);
                	$cedper = $persona->__GET('id_ciudadano');
                	$nomper = $persona->__GET('nombres');
                	$apeper = $persona->__GET('apellidos');
                	$telper = $persona->__GET('telefono_habitacion');
				//$dirper = $persona->__GET('direccionCiudadano');
				//$numpat = $empresa->__GET('numeroPatronal');
				//$rifemp = $empresa->__GET('rif');
				//$nomemp = $empresa->__GET('nombre');
				//$diremp = $empresa->__GET('direccion');
				//$telemp = $empresa->__GET('telefono');
                	$id_den      = $denuncia->__GET('id_denuncia');
                	$numden      = $id_den;
                	$fecden      = $denuncia->__GET('fecha_denuncia');
                	$motden      = $denuncia->__GET('motivo_denuncia');
                	$stsden      = $denuncia->__GET('estatus_denuncia');
                	$descripcion = $denuncia->__GET('descripcion');
                	
				//$nacionalidad = $denuncia->__GET('nacionalidad');
				//$cedula = $denuncia->__GET('cedula');
                	$fecha = $denuncia->__GET('fecha_denuncia');
                	$mot = dameMotivos();
				//$motden = $denuncia->__GET('motivo_denuncia')-1;
				//$motdendesc = $mot[$motden]['DESCRIPCION'];
                	$stsden = $denuncia->__GET('estatus_denuncia');
                	//$stsden = $sts[$stsden];
                	$stsden = $this->sts_denuncia[$stsden]['DESCRIPCION'];
				//require("bottomView.tpl.php");
                	require("view_denuncia_editar.php");
                	
                }

                public function showUpFormJuridico($denuncia)
                {
                	//$sts = array('0'=>'Procedente', '1'=>'Improcedente', '2'=>'Cerrada');
				/*
				$it = new ArrayIterator($persona);
                $cedper = $persona->__GET('id_ciudadano');
                $nomper = $persona->__get('primer_nombre')." ".$persona ->__get('segundo_nombre');
				$apeper = $persona->__get('primer_apellido')." ".$persona ->__get('segundo_apellido');
				$telper = $persona->__GET('telefono_hab');
				//$dirper = $persona->__GET('direccionCiudadano');
				//$numpat = $empresa->__GET('numeroPatronal');
				//$rifemp = $empresa->__GET('rif');
				//$nomemp = $empresa->__GET('nombre');
				//$diremp = $empresa->__GET('direccion');
				//$telemp = $empresa->__GET('telefono');
				*/

				$denunciad = new DenunciaJuridicaDAO();
				$motivos    = $denunciad->getMotivos($denuncia);
				$denuncia->__SET('motivo_denuncia',$motivos);

				$id_den      = $denuncia->__GET('id_denuncia');
				$numden      = $id_den;
				$fecden      = $denuncia->__GET('fecha_denuncia');				

				$motden      = $denuncia->__GET('motivo_denuncia');
				$stsden      = $denuncia->__GET('estatus_denuncia');
				$descripcion = $denuncia->__GET('descripcion_denuncia');
				//$nacionalidad = $denuncia->__GET('nacionalidad');
				//$cedula = $denuncia->__GET('cedula');
				$stsden = $denuncia->__GET('estatus_denuncia'); 
				//$stsden = $sts[$stsden];
				$stsden = $this->sts_denuncia[$stsden]['DESCRIPCION'];

				require("view_denuncia_editar_juridico.php");
				require("bottomView.tpl.php");
			}
			
			public function showDelDen($den,$per)
			{
				$sts = array('0'=>'Procedente', '1'=>'Improcedente', '2'=>'Cerrada');
				$cedula = $per ->__get('id_ciudadano');
				$nombre = $per ->__get('primer_nombre')." ".$per ->__get('segundo_nombre');
				$apellido = $per ->__get('primer_apellido')." ".$per ->__get('segundo_apellido');	
				require("view_denuncia_eliminar.php");	
				require("bottomView.tpl.php");
			}
			
			public function showDetails($persona, $empresa, $denuncia, &$apoderado)
			{
				$mot = dameMotivos();
				$estado = $empresa->__GET('estado');
				
				if($estado!=null)
				{
					$estado     = dameNombreEstado($estado);
					$municipio  = dameNombreMunicipio($empresa->__GET('municipio'));
					$parroquia  = dameNombreParroquia($empresa->__GET('parroquia'));
					$calle      = $empresa->__GET('calle');
					$edificio   = $empresa->__GET('edificio');
					$casa       = $empresa->__GET('casa');
					//.", ".$calle.", ".$edificio.", ".$casa
					$diremp     = "ESTADO ".$estado." , MUNICIPIO ".$municipio.", PARROQUIA ".$parroquia.", CALLE ".$calle.", EDIFICIO ".$edificio.", CASA ".$casa;

				}
				else
				{
					$diremp = trim($empresa->__GET('direccion_fisc_empresa'));
				}

				$ced_apo = $apoderado->__GET('id_apoderado');
				$nom_apo = $apoderado->__GET('nombres_apoderado');
				$ape_apo = $apoderado->__GET('apellidos_apoderado');
				$cedper = $persona->__GET('id_ciudadano');
				$nomper = $persona->__GET('nombres');
				$apeper = $persona->__GET('apellidos');
				$telper = $persona->__GET('telefono_habitacion');
				//$dirper = $persona->__GET('direccionCiudadano');
				$numpat = $empresa->__GET('id_fisc_empresa');
				$rifemp = $empresa->__GET('rif_fisc_empresa');
				$nomemp = $empresa->__GET('nombre_fisc_empresa');
				$telemp = $empresa->__GET('telefono_fisc_empresa');
				$id_den = $denuncia->__GET('id_denuncia');
				$numden = $id_den;
				$fecden = $denuncia->__GET('fecha_denuncia');
				//$motden = $denuncia->__GET('motivo_denuncia')-1;
				//$motden = $mot[$motden]['DESCRIPCION'];
				$stsden = $denuncia->__GET('estatus_denuncia');
				$estatus = $stsden;
				$stsdenuncia = $stsden;
				$stsden = $this->sts_denuncia[$stsden]['DESCRIPCION'];
				$desden = $denuncia->__GET('descripcion');
				$respon   = $denuncia->__GET('responsable');
				$resden = dameresponsable($respon)[0]['NOMBRE'];
				$creado = $denuncia->__GET('creadopor');

				$asignada = $denuncia->__GET('asignacion');
				$fecha_cierre = $denuncia->__GET('fecha_cierre');

				//  	 var_dump($stsdenuncia,$asignada,$id_den);
				//  	 exit();

				if($asignada==1)
				{


					$direcciones=dameDireccionesAsignacion($id_den);
					$asignadopor= $denuncia->__GET('asignadopor');
					//var_dump($direcciones); exit();
				}

				if ($stsdenuncia==2) 
				{

					$cerrada = 1;
					$fecha_cierre = $denuncia->__GET('fecha_cierre');
					$descripcion_estatus =$denuncia->__GET('descripcion_estatus');
					$cerrada = 1;
					$cerradopor = $denuncia->__GET('cerradopor');
					//var_dump($fecha_cierre,$cerrada);
				}


				require("view_denuncia_details.php");
				require("bottomView.tpl.php");

			}

			public function showDetailsJuridico($denuncia, $empresa, $representante)
			{
				$res = dameDirecciones(1);
				$denunciad = new DenunciaJuridicaDAO();
				$motivos    = $denunciad->getMotivos($denuncia);

                //datos del denunciado
                /* 
                $cedper = $denuncia->__GET('id_denunciado');
                $nomper = $denuncia->__GET('nombre_denunciado');
				$apeper = $denuncia->__GET('apellido_denunciado');
				//$telden = $denuncia->__GET('telefono_habitacion');
				//$dirper = $persona->__GET('direccionCiudadano');
				//datos del denunciado
				*/
				//datos de la empresa
				$numpat = $empresa->__GET('id_fisc_empresa');
				$rifemp = $empresa->__GET('rif_fisc_empresa');
				$nomemp = $empresa->__GET('nombre_fisc_empresa');
				$diremp = $empresa->__GET('direccion_fisc_empresa');
				$telemp = $empresa->__GET('telefono_fisc_empresa');
				$mailemp= $empresa->__GET('email_fisc_empresa');
				$refemp = $empresa->__GET('punto_ref_fisc_empresa');
				//datos de la empresa

				//datos de representante empresa
				$cedrep = $representante->__GET('clv_representante');
				$nomrep = $representante->__GET('str_nombres');
				$aperep = $representante->__GET('str_apellidos');
				$telrep = $representante->__GET('str_telefono1');
				$tel2rep= $representante->__GET('str_telefono2');
				$mailrep= $representante->__GET('str_email');
				//datos de representante empresa

				//datos de la denuncia
				$id_den = $denuncia->__GET('id_denuncia');
				$fecden = $denuncia->__GET('fecha_denuncia');
				$stsden = $denuncia->__GET('estatus_denuncia');
				$stsdenuncia = $stsden;
				$stsden = $this->sts_denuncia[$stsden]['DESCRIPCION'];
				$desden = $denuncia->__GET('descripcion_denuncia');
				$resp   = $denuncia->__GET('responsable_denuncia');

				$resden = dameresponsable($resp)[0]['NOMBRE'];
				$creado = $denuncia->__GET('creador');
				$asignada = $denuncia->__GET('asignada');

				$denuncia->__SET('motivo_denuncia',$motivos);

				//$fecha_cierre = $denuncia->__GET('fecha_cierre');
				//$cerrada = 1;

				if($asignada==1)
				{
					$direcciones=dameDireccionesAsignacionQueja($id_den);
					//var_dump($direcciones); exit();
					$asignadopor = $denuncia->__GET('asignadopor');
				}

				if ($stsdenuncia==2) 
				{
					$fecha_cierre_queja = $denuncia->__GET('fecha_cierre');
					$descripcion_estatus_queja =$denuncia->__GET('descripcion_estatus');

					$cerrada = 1;
					//var_dump($fecha_cierre_queja,$cerrada); exit();
					$cerradopor = $denuncia->__GET('cerradopor');
				}
				//datos de la denuncia

				require('view_denuncia_juridica_details.php');
				require('bottomView.tpl.php');
			}

			public function mostrarDenunciaJuridica($denuncia)
			{
				/*echo "<pre>";print_r($denuncia_natural);echo "</pre>";*/

				$stsden = array('0'=>'Procedente', '1'=>'Improcedente');
				require('view_denuncia_juridica.php');
			}
		}
		?>