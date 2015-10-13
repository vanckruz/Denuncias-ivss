<!doctype>
<html lang="ES">
<head>
  <meta charset="UTF-8">
  <meta name=Generator content="Microsoft Word 12 (filtered)">
  <title>Ficha técnica de chequeo</title>
  <link href="../../../public_html/css/ficha.css" rel="stylesheet"/>
  <style>
    <!--
    /* Font Definitions */
    @font-face
    {font-family:Wingdings;
     panose-1:5 0 0 0 0 0 0 0 0 0;}
     @font-face
     {font-family:"Cambria Math";
     panose-1:2 4 5 3 5 4 6 3 2 4;}
     @font-face
     {font-family:"Arial Narrow";
     panose-1:2 11 6 6 2 2 2 3 2 4;}
     /* Style Definitions */
     p.MsoNormal, li.MsoNormal, div.MsoNormal
     {margin:0cm;
       margin-bottom:.0001pt;
       font-size:10.0pt;
       font-family:"Times New Roman","serif";
       text-align:left;
     }
     p.MsoHeader, li.MsoHeader, div.MsoHeader
     {margin:0cm;
       margin-bottom:.0001pt;
       font-size:12.0pt;
       font-family:"Times New Roman","serif";}
       p.MsoFooter, li.MsoFooter, div.MsoFooter
       {margin:0cm;
         margin-bottom:.0001pt;
         font-size:12.0pt;
         font-family:"Times New Roman","serif";}
         /* Page Definitions */
         @page WordSection1
         {
          size:612.0pt 792.0pt;
          /*margin:42.55pt 2.0cm 42.55pt 2.0cm;*/
          margin:5px auto;
        }
        div.WordSection1
        {
          page:WordSection1;
        }
        /* List Definitions */
        ol
        {margin-bottom:0cm;}
        ul
        {margin-bottom:0cm;}
        input
        {
         height:40px;
         width:100%;
         margin:0;
         overflow:hidden;
         padding:0;
         border:0;
       }
       .checkbox{
         height:30px;
         width::30px;
         background-color:rgba(0,0,255,1);
       }
     -->
   </style>


 </head>

 <body>
   <form method="post" action="controller_ficha.php" name="ficha_tecnica" id="ficha">
    <input type="hidden" form="ficha" name="id_ficha" value="<?=$numero?>"/>
    <input type="hidden" form="ficha" name="fecha_elaboracion" value="<?=date('d/m/Y')?>"/>
    <input type="hidden" form="ficha" name="id_empresa" value="<?=$id_emp?>"/>
    <input type="hidden" form="ficha" name="rif" value="<?=$rif_emp?>"/>
    <input type="hidden" form="ficha" name="nombre_empresa_seniat" value="<?=$nombre_seniat?>"/>
    <input type="hidden" form="ficha" name="nombre_representante" value="<?=$nombre_representante?>"/>
    <input type="hidden" form="ficha" name="direccion_ivss" value="<?=$direccion?>"/>
    <input type="hidden" form="ficha" name="oficina_registro" value="<?=$oficina?>"/>
    <input type="hidden" form="ficha" name="fecha_registro" value="<?=$fregistro_emp?>"/>
    <input type="hidden" form="ficha" name="numero" value="<?=$numero_documento?>"/>
    <input type="hidden" form="ficha" name="tomo" value="<?=$numero_tomo?>"/>
    <input type="hidden" form="ficha" name="folio" value="<?=$numero_folio?>"/>
    <input type="hidden" form="ficha" name="protocolo" value="<?=$numero_protocolo?>"/>
    <input type="hidden" form="ficha" name="fecha_actividad" value="<?=$factividad_emp?>"/>
    <input type="hidden" form="ficha" name="fecha_inscripcion" value="<?=$finscripcion_emp?>"/>
    <input type="hidden" form="ficha" name="registro_ivss" value=""/>
    <input type="hidden" form="ficha" name="registro_tiuna" value=""/>
    <input type="hidden" form="ficha" name="nivel_riesgo" value="<?=$riesgo?>"/>
    <input type="hidden" form="ficha" name="retencion" value="<?=$retencion?>"/>
    <input type="hidden" form="ficha" name="actividad_economica" value="<?=$actividad?>"/>
    <input type="hidden" form="ficha" name="afiliados" value=""/>
    <input type="hidden" form="ficha" name="difeferencia" value="" id="diferencia_valor" />
    <input type="hidden" form="ficha" name="id_funcionario" value="<?=$ced_fun?>"/>
    <input type="hidden" form="ficha" name="nombre_funcionario" value="<?=$funcionario?>"/>
    
    
  </form>
  <table id="contenedor">
    <tr>
      <td><img src="../../../public_html/imagenes/logoivss.png"/></td>
      <td>
        <span class="span">REPÚBLICA BOLIVARIANA DE VENEZUELA</span>
        <span class="span">MINISTERIO DEL PODER POPULAR PARA EL PROCESO SOCIAL DE TRABAJO</span>
        <span class="span">INSTITUTO VENEZOLANO DE LOS SEGUROS SOCIALES</span>             
      </td>
    </tr>
  </table>

  <div class=WordSection1>

    <table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 width=960
    style='width:960px;margin:5px auto;border-collapse:collapse;border:none'>
    <tr style='height:17.1pt'>
      <td width=455 colspan=30 rowspan=5 style='width:341.05pt;border:none;
      border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.1pt'>
      <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
        style='font-size:18.0pt;font-family:"Arial Narrow","sans-serif"'>FICHA
        TÉCNICA DE CHEQUEO</span></b></p>
      </td>
      <td width=216 colspan=26 style='width:162.2pt;border:solid windowtext 1.0pt;
      border-left:none;background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:17.1pt'>
      <p class=MsoNormal><b><span lang=ES style='font-size:10.0pt;font-family:"Arial Narrow","sans-serif"'>N°:<?=$numero?>
      </span></b></p>
    </td>
  </tr>
  <tr style='height:2.5pt'>
    <td width=216 colspan=26 style='width:162.2pt;border-top:none;border-left:
    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    padding:0cm 5.4pt 0cm 5.4pt;height:2.5pt'>
    <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
      style='font-size:3.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></b></p>
    </td>
  </tr>
  <tr style='height:7.1pt'>
    <td width=216 colspan=26 style='width:162.2pt;border-top:none;border-left:
    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:7.1pt'>
    <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
      style='font-size:11.0pt;font-family:"Arial Narrow","sans-serif";background:
      #D9D9D9'>FECHA DE ELABORACIÓN</span></b><b><span lang=ES style='font-size:
      7.0pt;font-family:"Arial Narrow","sans-serif"'></span></b></p>
    </td>
  </tr>
  <tr style='height:1.0pt'>
    <td width=60 colspan=9 style='width:45.0pt;border-top:none;border-left:none;
    border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    padding:0cm 5.4pt 0cm 5.4pt;height:1.0pt'>
    <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
      style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>DÍA</span></b></p>
    </td>
    <td width=72 colspan=9 style='width:54.0pt;border-top:none;border-left:none;
    border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    padding:0cm 5.4pt 0cm 5.4pt;height:1.0pt'>
    <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
      style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>MES</span></b></p>
    </td>
    <td width=84 colspan=8 style='width:63.2pt;border-top:none;border-left:none;
    border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    padding:0cm 5.4pt 0cm 5.4pt;height:1.0pt'>
    <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
      style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>AÑO</span></b></p>
    </td>
  </tr>
  <tr style='height:17.4pt'>
    <td width=60 colspan=9 style='width:45.0pt;border-top:none;border-left:none;
    border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    padding:0cm 5.4pt 0cm 5.4pt;height:17.4pt'><?=date('d')?>
    <p class=MsoNormal align=center style='text-align:center'><span lang=ES
      style='font-size:8.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></p>
    </td>
    <td width=72 colspan=9 style='width:54.0pt;border-top:none;border-left:none;
    border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    padding:0cm 5.4pt 0cm 5.4pt;height:17.4pt'><?=date('m')?>
    <p class=MsoNormal align=center style='text-align:center'><span lang=ES
      style='font-size:8.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></p>
    </td>
    <td width=84 colspan=8 style='width:63.2pt;border-top:none;border-left:none;
    border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    padding:0cm 5.4pt 0cm 5.4pt;height:17.4pt'><?=date('Y')?>
    <p class=MsoNormal align=center style='text-align:center'><span lang=ES
      style='font-size:8.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></p>
    </td>
  </tr>
  <tr>
    <td width=671 colspan=56 valign=top style='width:503.25pt;border:none;
    border-bottom:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
    <p class=MsoNormal style='text-align:justify'><b><span lang=ES
      style='font-size:3.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></b></p>
    </td>
  </tr>
  <tr style='height:17.0pt'>
    <td width=671 colspan=56 style='width:503.25pt;border:solid windowtext 1.0pt;
    border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:17.0pt'>
    <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
      style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>DATOS
      INFORMATIVOS DE LA EMPRESA PRIVADA U ORGANISMO PÚBLICO, ENTE O EMPRESA DEL
      ESTADO</span></b></p>
    </td>
  </tr>
  <tr style='height:8.5pt'>
    <td width=425 colspan=26 rowspan=2 valign=top style='width:318.7pt;
    border:solid windowtext 1.0pt;border-top:none;background:#D9D9D9;padding:
    0cm 5.4pt 0cm 5.4pt;height:8.5pt'>
    <p class=MsoNormal><b><span lang=ES style='font-size:10.0pt;font-family:"Arial Narrow","sans-serif";padding-bottom:50px;'>NOMBRE
      O RAZÓN SOCIAL:<br><br><span><?=$nombre_seniat?></span></span></b></p></td>
      <td width=246 colspan=30 valign=top style='width:184.55pt;border-top:none;
      border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
      padding:0cm 5.4pt 0cm 5.4pt;height:8.5pt'>
      <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
        style='font-size:11.0pt;font-family:"Arial Narrow","sans-serif"'>NÚMERO DE REGISTRO
        DE INFORMACIÓN FISCAL (RIF)</span></b></p>
      </td>
    </tr>
    <tr style='height:19.85pt'>
      <td width=25 colspan=2 style='width:18.4pt;border-top:none;border-left:none;
      border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
      background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:19.85pt'>
      <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
        style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'><?=$rif[0]?></span></b></p>
      </td>
      <td width=25 colspan=4 style='width:18.45pt;border-top:none;border-left:none;
      border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
      background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:19.85pt'>
      <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
        style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'><?=$rif[1]?></span></b></p>
      </td>
      <td width=25 colspan=5 style='width:18.45pt;border-top:none;border-left:none;
      border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
      background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:19.85pt'>
      <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
        style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'><?=$rif[2]?></span></b></p>
      </td>
      <td width=25 colspan=3 style='width:18.4pt;border-top:none;border-left:none;
      border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
      background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:19.85pt'>
      <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
        style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'><?=$rif[3]?></span></b></p>
      </td>
      <td width=25 colspan=3 style='width:18.45pt;border-top:none;border-left:none;
      border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
      background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:19.85pt'>
      <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
        style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'><?=$rif[4]?></span></b></p>
      </td>
      <td width=25 colspan=2 style='width:18.45pt;border-top:none;border-left:none;
      border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
      background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:19.85pt'>
      <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
        style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'><?=$rif[5]?></span></b></p>
      </td>
      <td width=25 colspan=5 style='width:18.4pt;border-top:none;border-left:none;
      border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
      background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:19.85pt'>
      <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
        style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'><?=$rif[6]?></span></b></p>
      </td>
      <td width=25 colspan=2 style='width:18.65pt;border-top:none;border-left:none;
      border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
      background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:19.85pt'>
      <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
        style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'><?=$rif[7]?></span></b></p>
      </td>
      <td width=25 colspan=3 style='width:18.45pt;border-top:none;border-left:none;
      border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
      background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:19.85pt'>
      <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
        style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'><?=$rif[8]?></span></b></p>
      </td>
      <td width=25 style='width:18.45pt;border-top:none;border-left:none;
      border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
      background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:19.85pt'>
      <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
        style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'><?=$rif[9]?></span></b></p>
      </td>
    </tr>
    <tr style='height:1.0cm'>
      <td width=425 colspan=56 valign=top style='width:318.7pt;border:solid windowtext 1.0pt;
      border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:1.0cm'>
      <p class=MsoNormal style='text-align:justify'><b><span lang=ES
        style='font-size:6.0pt;font-family:"Arial Narrow","sans-serif"'><input type="text" placeholder="NOMBRE O RAZÓN
        SOCIAL" form="ficha" required name="razon" maxlength="100" /></span></b></p>
      </td>
  <!--<td width=246 colspan=30 style='width:184.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:black;padding:0cm 5.4pt 0cm 5.4pt;height:1.0cm'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
  style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></b></p>
</td>-->
</tr>
<tr style='height:8.5pt'>
  <td width=273 colspan=16 rowspan=2 valign=top style='width:204.85pt;
  border:solid windowtext 1.0pt;border-top:none;background:#D9D9D9;padding:
  0cm 5.4pt 0cm 5.4pt;height:8.5pt'>
  <p class=MsoNormal><b><span lang=ES style='font-size:10.0pt;font-family:"Arial Narrow","sans-serif"'>NOMBRE
    DEL EMPLEADOR O REPRESENTANTE LEGAL:</span><br><?=$nombre_representante?></b></p>
  </td>

  <td width=152 colspan=10 rowspan=2 valign=top style='width:113.85pt;
  border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;
  border-right:solid windowtext 1.0pt;background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;
  height:8.5pt'>
  <p class=MsoNormal><b><span lang=ES style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>CEDÚLA
    DE IDENTIDAD:<br/><span style='font-size:11.0pt; margin-left:45px;'><?=$cedula_representante?></span></span></b></p>
  </td>
  <td width=246 colspan=30 style='width:184.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:8.5pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:11.0pt;font-family:"Arial Narrow","sans-serif"'>NÚMERO
    PATRONAL</span></b></p>
  </td>
</tr>
<tr style='height:19.85pt'>
  <td width=27 colspan=3 style='width:20.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:19.85pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'><?=$np[0]?></span></b></p>
  </td>
  <td width=27 colspan=4 style='width:20.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:19.85pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'><?=$np[1]?></span></b></p>
  </td>
  <td width=27 colspan=5 style='width:20.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:19.85pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'><?=$np[2]?></span></b></p>
  </td>
  <td width=27 colspan=3 style='width:20.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:19.85pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'><?=$np[3]?></span></b></p>
  </td>
  <td width=27 colspan=3 style='width:20.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:19.85pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'><?=$np[4]?></span></b></p>
  </td>
  <td width=27 colspan=5 style='width:20.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:19.85pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'><?=$np[5]?></span></b></p>
  </td>
  <td width=27 colspan=2 style='width:20.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:19.85pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'><?=$np[6]?></span></b></p>
  </td>
  <td width=27 colspan=3 style='width:20.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:19.85pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'><?=$np[7]?></span></b></p>
  </td>
  <td width=27 colspan=2 style='width:20.55pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:19.85pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'><?=$np[8]?></span></b></p>
  </td>
</tr>
<tr style='height:1.0cm'>
  <td width=273 colspan=16 valign=top style='width:204.85pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:1.0cm'>
  <p class=MsoNormal><b><span lang=ES style='font-size:7.0pt;font-family:"Arial Narrow","sans-serif"'><input type="text" placeholder="NOMBRE DEL EMPLEADOR O REPRESENTANTE LEGAL" form="ficha" name="representante" required maxlength="100" /></span></b></p>
</td>
<td width=152 colspan=40 valign=top style='width:113.85pt;border-top:none;
border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
padding:0cm 5.4pt 0cm 5.4pt;height:1.0cm'>
<p class=MsoNormal><b><span lang=ES style='font-size:6.0pt;font-family:"Arial Narrow","sans-serif"'><input type="text" placeholder="CÉDULA DE IDENTIDAD" form="ficha" name="cedula" required maxlength="11" //></span></b></p>
</td>
  <!--<td width=246 colspan=30 style='width:184.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:black;padding:0cm 5.4pt 0cm 5.4pt;height:1.0cm'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
  style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></b></p>
</td>-->
</tr>
<tr style='height:8.5pt'>
  <td width=495 colspan=35 style='width:371.45pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:8.5pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:11.0pt;font-family:"Arial Narrow","sans-serif"'>INFORMACIÓN
    DEL REGISTRO MERCANTIL</span></b></p>
  </td>
  <td width=176 colspan=21 style='width:131.8pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:8.5pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:11.0pt;font-family:"Arial Narrow","sans-serif"'>FECHA DE
    INICIO DE ACTIVIDADES</span></b></p>
  </td>
</tr>
<tr style='height:11.35pt'>
  <td width=141 colspan=5 style='width:106.1pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:11.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>OFICINA DE
    REGISTRO</span></b></p>
  </td>
  <td width=94 colspan=7 style='width:70.85pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>FECHA</span></b></p>
  </td>
  <td width=57 colspan=6 style='width:42.55pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>NÚMERO</span></b></p>
  </td>
  <td width=57 colspan=4 style='width:42.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>TOMO</span></b></p>
  </td>
  <td width=76 colspan=4 style='width:2.0cm;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>FOLIO</span></b></p>
  </td>
  <td width=70 colspan=9 style='width:52.75pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>PROTOCOLO</span></b></p>
  </td>
  <td width=48 colspan=7 style='width:36.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.35pt'>
  <p class=MsoNormal><b><span lang=ES style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>FECHA:</span></b></p>
</td>
<td width=42 colspan=5 valign=top style='width:31.8pt;border-top:none;
border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:11.35pt'>
<p class=MsoNormal style='text-align:justify'><b><span lang=ES
  style='font-size:11.0pt;font-family:"Arial Narrow","sans-serif"'><?=$factividad[0].$factividad[1]?></span></b></p>
</td>
<td width=42 colspan=6 valign=top style='width:31.8pt;border-top:none;
border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:11.35pt'>
<p class=MsoNormal style='text-align:justify'><b><span lang=ES
  style='font-size:11.0pt;font-family:"Arial Narrow","sans-serif"'><?=$factividad[3].$factividad[4]?></span></b></p>
</td>
<td width=43 colspan=3 valign=top style='width:32.05pt;border-top:none;
border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:11.35pt'>
<p class=MsoNormal style='text-align:justify'><b><span lang=ES
  style='font-size:11.0pt;font-family:"Arial Narrow","sans-serif"'><?=$factividad[6].$factividad[7]?></span></b></p>
</td>
</tr>
<tr style='height:8.5pt'>
  <td width=141 colspan=5 rowspan=2 valign=top style='width:106.1pt;border:
  solid windowtext 1.0pt;border-top:none;background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;
  height:8.5pt'>
  <p class=MsoNormal style='text-align:justify'><b><span lang=ES
    style='font-size:11.0pt;font-family:"Arial Narrow","sans-serif"'><?=$oficina?></span></b></p>
  </td>
  <td width=28 colspan=2 rowspan=2 valign=top style='width:21.25pt;border-top:
  none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:8.5pt'>
  <p class=MsoNormal style='text-align:center; vertical-align: middle'><b><span lang=ES
    style='font-size:11.0pt;font-family:"Arial Narrow","sans-serif"'><?=$fregistro[0].$fregistro[1]?></span></b></p>
  </td>
  <td width=28 colspan=3 rowspan=2 valign=top style='width:21.25pt;border-top:
  none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:8.5pt'>
  <p class=MsoNormal style='text-align:center; vertical-align: middle'><b><span lang=ES
    style='font-size:11.0pt;font-family:"Arial Narrow","sans-serif"'><?=$fregistro[3].$fregistro[4]?></span></b></p>
  </td>
  <td width=38 colspan=2 rowspan=2 valign=top style='width:1.0cm;border-top:
  none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:8.5pt'>
  <p class=MsoNormal style='text-align:center; vertical-align: middle'><b><span lang=ES
    style='font-size:11.0pt;font-family:"Arial Narrow","sans-serif"'><?=$fregistro[6].$fregistro[7]?></span></b></p>
  </td>
  <td width=57 colspan=6 rowspan=2 valign=top style='width:42.55pt;border-top:
  none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:8.5pt'>
  <p class=MsoNormal style='text-align:center; vertical-align: middle'><b><span lang=ES
    style='font-size:11.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span><?=$numero_documento?></b></p>
  </td>
  <td width=57 colspan=4 rowspan=2 valign=top style='width:42.5pt;border-top:
  none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:8.5pt'>
  <p class=MsoNormal style='text-align:center; vertical-align: middle'><b><span lang=ES
    style='font-size:11.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span><?=$numero_tomo?></b></p>
  </td>
  <td width=76 colspan=4 rowspan=2 valign=top style='width:2.0cm;border-top:
  none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:8.5pt'>
  <p class=MsoNormal style='text-align:center; vertical-align: middle'><b><span lang=ES
    style='font-size:11.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span><?=$numero_folio?></b></p>
  </td>
  <td width=70 colspan=9 rowspan=2 valign=top style='width:52.75pt;border-top:
  none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:8.5pt'>
  <p class=MsoNormal style='text-align:center; vertical-align: middle'><b><span lang=ES
    style='font-size:11.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span><?=$numero_protocolo?></b></p>
  </td>
  <td width=176 colspan=21 style='width:131.8pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:8.5pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:11.0pt;font-family:"Arial Narrow","sans-serif"'>FECHA DE
    INSCRIPCIÓN IVSS</span></b></p>
  </td>
</tr>
<tr style='height:11.35pt'>
  <td width=48 colspan=7 style='width:36.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.35pt'>
  <p class=MsoNormal><b><span lang=ES style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>FECHA:</span></b></p>
</td>
<td width=42 colspan=5 valign=top style='width:31.8pt;border-top:none;
border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
padding:0cm 5.4pt 0cm 5.4pt;height:11.35pt'>
<p class=MsoNormal style='text-align:justify'><b><span lang=ES
  style='font-size:11.0pt;font-family:"Arial Narrow","sans-serif"'><?=$finscripcion[0].$finscripcion[1]?></span></b></p>
</td>
<td width=42 colspan=6 valign=top style='width:31.8pt;border-top:none;
border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
padding:0cm 5.4pt 0cm 5.4pt;height:11.35pt'>
<p class=MsoNormal style='text-align:justify'><b><span lang=ES
  style='font-size:11.0pt;font-family:"Arial Narrow","sans-serif"'><?=$finscripcion[3].$finscripcion[4]?></span></b></p>
</td>
<td width=43 colspan=3 valign=top style='width:32.05pt;border-top:none;
border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
padding:0cm 5.4pt 0cm 5.4pt;height:11.35pt'>
<p class=MsoNormal style='text-align:justify'><b><span lang=ES
  style='font-size:11.0pt;font-family:"Arial Narrow","sans-serif"'><?=$finscripcion[6].$finscripcion[7]?></span></b></p>
</td>
</tr>
<tr style='height:1.0cm'>
  <td width=671 colspan=56 valign=top style='width:503.25pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:1.0cm'>
  <p class=MsoNormal><b><span lang=ES style='font-size:7.0pt;font-family:"Arial Narrow","sans-serif"'><input type="text" placeholder="DENOMINACIÓN COMERCIAL:" form="ficha" required name="denominacion" maxlength="200" /></span></b></p>
</td>
</tr>
<tr style='height:1.0cm'>
  <td width=671 colspan=56 valign=top style='width:503.25pt;border:solid windowtext 1.0pt;
  border-top:none;background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:1.0cm'>
  <p class=MsoNormal style='text-align:justify'><b><span lang=ES
    style='font-size:10.0pt;font-family:"Arial Narrow","sans-serif"'>DIRECCIÓN DE
    LA RAZÓN SOCIAL:</span><br><?=$direccion?></b></p>
  </td>
</tr>
<tr style='height:1.0cm'>
  <td width=671 colspan=56 valign=top style='width:503.25pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:1.0cm'>
  <p class=MsoNormal style='text-align:justify'><b><span lang=ES
    style='font-size:7.0pt;font-family:"Arial Narrow","sans-serif"'><input type="text" placeholder="DIRECCIÓN DE
    LA RAZÓN SOCIAL:" form="ficha" required name="direccion_fiscalizacion" maxlength="100" /></span></b></p>
  </td>
</tr>
<tr style='height:16.95pt'>
  <td width=178 colspan=8 style='width:133.65pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:16.95pt'>
  <p class=MsoNormal style='text-align:justify'><b><span lang=ES
    style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>EXISTENCIA DE
    SUCURSALES O AGENCIA:</span></b></p>
  </td>
  <td width=31 colspan=3 style='width:23.1pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:16.95pt'>
  <p class=MsoNormal style='text-align:justify'><b><span lang=ES
    style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>SI:</span></b></p>
  </td>
  <td width=31 colspan=2 style='width:23.1pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:16.95pt'>
  <p class=MsoNormal style='text-align:justify'><b><span lang=ES
    style='font-size:7.0pt;font-family:"Arial Narrow","sans-serif"'><input type="radio" form="ficha" class="checkbox" name="sucursales"/></span></b></p>
  </td>
  <td width=31 colspan=2 style='width:23.1pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:16.95pt'>
  <p class=MsoNormal style='text-align:justify'><b><span lang=ES
    style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>NO:</span></b></p>
  </td>
  <td width=31 colspan=4 style='width:23.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:16.95pt'>
  <p class=MsoNormal style='text-align:justify'><b><span lang=ES
    style='font-size:7.0pt;font-family:"Arial Narrow","sans-serif"'><input type="radio" name="sucursales" form="ficha" class="checkbox"/></span></b></p>
  </td>
  <td width=57 colspan=4 style='width:42.55pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:16.95pt'>
  <p class=MsoNormal style='text-align:justify'><b><span lang=ES
    style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>CUANTAS:</span></b></p>
  </td>
  <td width=38 style='width:1.0cm;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:16.95pt'>
  <p class=MsoNormal style='text-align:justify'><b><span lang=ES
    style='font-size:7.0pt;font-family:"Arial Narrow","sans-serif"'><input type="text" form="ficha" name="numero_sucursales" maxlength="10" /></span></b></p>
  </td>
  <td width=275 colspan=32 style='width:206.25pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:16.95pt'>
  <p class=MsoNormal style='text-align:justify'><b><span lang=ES
    style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'><input type="text" placeholder="UBICACIÓN:" form="ficha" required name="ubicacion_sucursales" maxlength="100" /></span></b></p>
  </td>
</tr>
<tr style='height:22.7pt'>
  <td width=671 colspan=56 valign=top style='width:503.25pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:22.7pt'>
  <p class=MsoNormal style='text-align:justify'><b><span lang=ES
    style='font-size:7.0pt;font-family:"Arial Narrow","sans-serif"'><input type="text" form="ficha" required name="ubicacion_sucursales2" maxlength="2000" /></span></b></p>
  </td>
</tr>
<tr style='height:22.7pt'>
  <td width=279 colspan=17 valign=top style='width:208.95pt;border:solid windowtext 1.0pt;
  border-top:none;background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:22.7pt'>
  <p class=MsoNormal><b><span lang=ES style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>E-MAIL:</span><br><?=$email?></b></p>
</td>
<td width=155 colspan=10 valign=top style='width:116.55pt;border-top:none;
border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:22.7pt'>
<p class=MsoNormal><b><span lang=ES style='font-size:11.0pt;font-family:"Arial Narrow","sans-serif"'>TELÉFONO:</span><br><?=$telefono?></b></p>
</td>
<td width=237 colspan=29 rowspan=2 valign=top style='width:177.75pt;
border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;
border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.7pt'>
<p class=MsoNormal><b><span lang=ES style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'><input type="text" placeholder="PERSONA CONTACTO:" form="ficha" name="contacto" required maxlength="100" /></span></b></p>
</td>
</tr>
<tr style='height:22.7pt'>
  <td width=279 colspan=17 valign=top style='width:208.95pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:22.7pt'>
  <p class=MsoNormal><b><span lang=ES style='font-size:7.0pt;font-family:"Arial Narrow","sans-serif"'><input type="text" placeholder="E-MAIL:" form="ficha" name="email" required maxlength="100" /></span></b></p>
</td>
<td width=155 colspan=10 valign=top style='width:116.55pt;border-top:none;
border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
padding:0cm 5.4pt 0cm 5.4pt;height:22.7pt'>
<p class=MsoNormal><b><span lang=ES style='font-size:7.0pt;font-family:"Arial Narrow","sans-serif"'><input type="text" placeholder="TELÉFONO:" form="ficha" name="telefono"required maxlength="12" /></span></b></p>
</td>
</tr>
<tr style='height:17.0pt'>
  <td width=671 colspan=56 style='width:503.25pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:17.0pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:11.0pt;font-family:"Arial Narrow","sans-serif"'>CONDICIONES
    ACTUALES DE LA NÓMINA DE TRABAJADORES (EMPRESA Vs. IVSS)</span></b></p>
  </td>
</tr>
<tr style='height:9.2pt'>
  <td width=118 colspan=4 style='width:88.25pt;border:solid windowtext 1.0pt;
  border-top:none;background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:9.2pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>REGISTRO</span></b></p>
  </td>
  <td width=136 colspan=10 rowspan=2 style='width:101.8pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:9.2pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>RIESGO</span></b></p>
  </td>
  <td width=156 colspan=11 rowspan=2 style='width:117.15pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:9.2pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>ACTIVIDAD
    ECONÓMICA</span></b></p>
  </td>
  <td width=87 colspan=11 rowspan=2 style='width:65.0pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:9.2pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>TRABAJADORES ACTIVOS</span></b></p>
  </td>
  <td width=87 colspan=10 rowspan=2 style='width:65.05pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:9.2pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>TRABAJADORES AFILIADOS
    IVSS</span></b></p>
  </td>
  <td width=88 colspan=10 rowspan=2 style='width:66.0pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:9.2pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>DIFERENCIA</span></b></p>
  </td>
</tr>
<tr style='height:14.15pt'>
  <td width=59 colspan=2 style='width:44.05pt;border:solid windowtext 1.0pt;
  border-top:none;background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:14.15pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>IVSS</span></b></p>
  </td>
  <td width=59 colspan=2 style='width:44.2pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:14.15pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>TIUNA</span></b></p>
  </td>
</tr>
<tr style='height:14.15pt'>
  <td width=29 style='width:22.0pt;border:solid windowtext 1.0pt;border-top:
  none;padding:0cm 5.4pt 0cm 5.4pt;height:14.15pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>SI</span></b></p>
  </td>
  <td width=29 style='width:22.05pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:14.15pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>NO</span></b></p>
  </td>
  <td width=29 style='width:22.1pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:14.15pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>SI</span></b></p>
  </td>
  <td width=29 style='width:22.1pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:14.15pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>NO</span></b></p>
  </td>
  <td width=61 colspan=5 style='width:45.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:14.15pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>NIVEL</span></b></p>
  </td>
  <td width=75 colspan=5 style='width:56.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:14.15pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>% RETENCIÓN</span></b></p>
  </td>
  <td width=156 colspan=11 rowspan=2 valign=top style='width:117.15pt;
  border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;
  border-right:solid windowtext 1.0pt;background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;
  height:14.15pt;vertical-align: middle;'>
  <p class=MsoNormal style='text-align:justify'><b><span lang=ES
    style='font-size:10.0pt;font-family:"Arial Narrow","sans-serif"'><?=$actividad?></span></b></p>
  </td>
  <td width=87 colspan=11 rowspan=2 valign=top style='width:65.0pt;border-top:
  none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:14.15pt'>
  <p class=MsoNormal style='text-align:justify'><b><span lang=ES
    style='font-size:7.0pt;font-family:"Arial Narrow","sans-serif"'><input type="text" form="ficha" required placeholder="activos" name="activos" id="activos" maxlength="10" /></span></b></p>
  </td>
  <td width=87 colspan=10 rowspan=2 valign=top style='width:65.05pt;border-top:
  none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:14.15pt'>
  <p class=MsoNormal style='text-align:center; vertical-align: middle'><b><span lang=ES
    style='font-size:11.0pt;font-family:"Arial Narrow","sans-serif"' id="registrados"><?=$empleados?></span></b></p>
  </td>
  <td width=88 colspan=10 rowspan=2 valign=top style='width:66.0pt;border-top:
  none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:14.15pt; text-align: center; vertical-align: middle;'>
  <p class=MsoNormal style='text-align:justify'><b><span lang=ES
    style='font-size:11.0pt;font-family:"Arial Narrow","sans-serif";margin: auto;' id="diferencia"></span></b></p>
  </td>
</tr>
<tr style='height:16.1pt'>
  <td width=29 style='width:22.0pt;border:solid windowtext 1.0pt;border-top:
  none;background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:16.1pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:7.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></b></p>
  </td>
  <td width=29 style='width:22.05pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:16.1pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:7.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></b></p>
  </td>
  <td width=29 style='width:22.1pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;background:#D9D9D9;
  padding:0cm 5.4pt 0cm 5.4pt;height:16.1pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:7.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></b></p>
  </td>
  <td width=29 style='width:22.1pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;background:#D9D9D9;
  padding:0cm 5.4pt 0cm 5.4pt;height:16.1pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:7.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></b></p>
  </td>
  <td width=61 colspan=5 style='width:45.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:16.1pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:11.0pt;font-family:"Arial Narrow","sans-serif"'><?=$riesgo?></span></b></p>
  </td>
  <td width=75 colspan=5 style='width:56.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:#D9D9D9;padding:0cm 5.4pt 0cm 5.4pt;height:16.1pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:11.0pt;font-family:"Arial Narrow","sans-serif"'><?=$retencion?></span></b></p>
  </td>
</tr>
<tr style='height:14.15pt'>
  <td width=161 colspan=6 style='width:120.55pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:14.15pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
    style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>FORMA 14-02</span></b></p>
    <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
      style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>(NO
      PROCESADOS)</span></b></p>
    </td>
    <td width=162 colspan=15 style='width:121.5pt;border-top:none;border-left:
    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    padding:0cm 5.4pt 0cm 5.4pt;height:14.15pt'>
    <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
      style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>FORMA 14-03</span></b></p>
      <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
        style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>(NO
        PROCESADOS)</span></b></p>
      </td>
      <td width=162 colspan=13 style='width:121.5pt;border-top:none;border-left:
      none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
      padding:0cm 5.4pt 0cm 5.4pt;height:14.15pt'>
      <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
        style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>CAMBIO DE
        SALARIO</span></b></p>
        <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
          style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>(NO
          PROCESADOS)</span></b></p>
        </td>
        <td width=186 colspan=22 style='width:139.7pt;border-top:none;border-left:
        none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        padding:0cm 5.4pt 0cm 5.4pt;height:14.15pt'>
        <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
          style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>MOROSIDAD
          SEGÚN</span></b></p>
          <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
            style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>ESTADO DE
            CUENTA</span></b></p>
          </td>
        </tr>
        <tr style='height:14.15pt'>
          <td width=161 colspan=6 style='width:120.55pt;border:solid windowtext 1.0pt;
          border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:14.15pt'>
          <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
            style='font-size:7.0pt;font-family:"Arial Narrow","sans-serif"'><input type="text" form="ficha" name="forma1402" placeholder="14-02" required /></span></b></p>
          </td>
          <td width=162 colspan=15 style='width:121.5pt;border-top:none;border-left:
          none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
          padding:0cm 5.4pt 0cm 5.4pt;height:14.15pt'>
          <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
            style='font-size:7.0pt;font-family:"Arial Narrow","sans-serif"'><input type="text" form="ficha" name="forma1403" placeholder="14-03"required /></span></b></p>
          </td>
          <td width=162 colspan=13 style='width:121.5pt;border-top:none;border-left:
          none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
          padding:0cm 5.4pt 0cm 5.4pt;height:14.15pt'>
          <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
            style='font-size:7.0pt;font-family:"Arial Narrow","sans-serif"'><input type="text" form="ficha" name="cambio_salario" placeholder="cambio de salario" required /></span></b></p>
          </td>
          <td width=186 colspan=22 style='width:139.7pt;border-top:none;border-left:
          none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
          padding:0cm 5.4pt 0cm 5.4pt;height:14.15pt'>
          <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
            style='font-size:7.0pt;font-family:"Arial Narrow","sans-serif"'><input type="text" form="ficha" name="morosidad" placeholder="morosidad"required /></span></b></p>
          </td>
        </tr>
        <tr style='height:17.0pt'>
          <td width=671 colspan=56 style='width:503.25pt;border:solid windowtext 1.0pt;
          border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:17.0pt'>
          <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
            style='font-size:11.0pt;font-family:"Arial Narrow","sans-serif"'>OBSERVACIONES
            Y/O COMENTARIOS</span></b></p>
          </td>
        </tr>
        <tr style='height:45.35pt'>
          <td width=671 colspan=56 valign=top style='width:503.25pt;border:solid windowtext 1.0pt;
          border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:45.35pt'>
          <p class=MsoNormal style='text-align:justify'><b><span lang=ES
            style='font-size:7.0pt;font-family:"Arial Narrow","sans-serif"'><input type="text" form="ficha" name="observaciones" required maxlength="2000" /></span></b></p>
          </td>
        </tr>
        <tr style='height:17.0pt'>
          <td width=671 colspan=56 style='width:503.25pt;border:solid windowtext 1.0pt;
          border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:17.0pt'>
          <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
            style='font-size:11.0pt;font-family:"Arial Narrow","sans-serif"'>DATOS DEL SERVIDOR
            PÚBLICO ACTUANTE</span></b></p>
          </td>
        </tr>
        <tr style='height:12.0pt'>
          <td width=315 colspan=20 style='width:235.95pt;border:solid windowtext 1.0pt;
          border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:12.0pt'>
          <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
            style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>NOMBRES Y
            APELLIDOS:</span></b></p>
          </td>
          <td width=145 colspan=11 style='width:108.85pt;border-top:none;border-left:
          none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
          padding:0cm 5.4pt 0cm 5.4pt;height:12.0pt'>
          <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
            style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>CÉDULA DE
            IDENTIDAD NÚMERO:</span></b></p>
          </td>
          <td width=211 colspan=25 rowspan=2 valign=top style='width:158.45pt;
          border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;
          border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:12.0pt'>
          <p class=MsoNormal><b><span lang=ES style='font-size:9.0pt;font-family:"Arial Narrow","sans-serif"'>FIRMA:</span></b></p>
        </td>
      </tr>
      <tr style='height:42.5pt'>
        <td width=315 colspan=20 valign=top style='width:235.95pt;border:solid windowtext 1.0pt;
        border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:42.5pt'>
        <p class=MsoNormal style='text-align:justify'><b><span lang=ES
          style='font-size:10.0pt;font-family:"Arial Narrow","sans-serif"'><input type="text" value="<?=$funcionario?>" style="font-size:1.3em; text-align:center;" readonly="readonly"></span></b></p>
        </td>
        <td width=145 colspan=11 valign=top style='width:108.85pt;border-top:none;
        border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        padding:0cm 5.4pt 0cm 5.4pt;height:42.5pt'>
        <p class=MsoNormal style='text-align:justify'><b><span lang=ES
          style='font-size:7.0pt;font-family:"Arial Narrow","sans-serif"'><input type="text" value="<?=$ced_fun?>" style="font-size:1.8em; text-align:center;" readonly="readonly"></span></b></p>
        </td>
      </tr>
      <!--seccion comentada hasta el final del tr -->
      <tr height=0>
        <td width=29 style='border:none'></td>
        <td width=29 style='border:none'></td>
        <td width=29 style='border:none'></td>
        <td width=29 style='border:none'></td>
        <td width=24 style='border:none'></td>
        <td width=19 style='border:none'></td>
        <td width=9 style='border:none'></td>
        <td width=8 style='border:none'></td>
        <td width=1 style='border:none'></td>
        <td width=19 style='border:none'></td>
        <td width=11 style='border:none'></td>
        <td width=27 style='border:none'></td>
        <td width=4 style='border:none'></td>
        <td width=14 style='border:none'></td>
        <td width=17 style='border:none'></td>
        <td width=3 style='border:none'></td>
        <td width=5 style='border:none'></td>
        <td width=14 style='border:none'></td>
        <td width=9 style='border:none'></td>
        <td width=13 style='border:none'></td>
        <td width=8 style='border:none'></td>
        <td width=27 style='border:none'></td>
        <td width=9 style='border:none'></td>
        <td width=38 style='border:none'></td>
        <td width=14 style='border:none'></td>
        <td width=15 style='border:none'></td>
        <td width=9 style='border:none'></td>
        <td width=15 style='border:none'></td>
        <td width=3 style='border:none'></td>
        <td width=2 style='border:none'></td>
        <td width=5 style='border:none'></td>
        <td width=14 style='border:none'></td>
        <td width=6 style='border:none'></td>
        <td width=5 style='border:none'></td>
        <td width=11 style='border:none'></td>
        <td width=1 style='border:none'></td>
        <td width=2 style='border:none'></td>
        <td width=8 style='border:none'></td>
        <td width=8 style='border:none'></td>
        <td width=8 style='border:none'></td>
        <td width=11 style='border:none'></td>
        <td width=9 style='border:none'></td>
        <td width=4 style='border:none'></td>
        <td width=14 style='border:none'></td>
        <td width=11 style='border:none'></td>
        <td width=11 style='border:none'></td>
        <td width=3 style='border:none'></td>
        <td width=1 style='border:none'></td>
        <td width=2 style='border:none'></td>
        <td width=8 style='border:none'></td>
        <td width=19 style='border:none'></td>
        <td width=6 style='border:none'></td>
        <td width=6 style='border:none'></td>
        <td width=15 style='border:none'></td>
        <td width=3 style='border:none'></td>
        <td width=25 style='border:none'></td>
      </tr>
    </table>

    <p class=MsoNormal style='text-align:justify;line-height:150%'><span lang=ES
      style='line-height:150%;font-family:"Arial","sans-serif"'>&nbsp;</span></p>
    </div>
    <div>
      <input type="submit" value="SIGUIENTE" style=" padding:5px; background-color:rgba(0,0,51,1); text-align:center; width:100px; color:rgba(255,255,255,1); margin:5px auto; margin-top:0px" form="ficha"/>
      <input type="button" value="CANCELAR" style=" padding:5px; background-color:rgba(0,0,51,1); text-align:center; width:100px; color:rgba(255,255,255,1); margin:5px auto; margin-top:0px" onClick="regresar();"/>
    </div>
    <script type="text/javascript" src="../../../public_html/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $("#activos").on("blur",function(){

          $activos     = $("#activos").val();
          if($activos =="")
          {
            $("#diferencia").text("");
          }
          else
          {
            $registrados = $("#registrados").text();
            $diferencia  = $activos - $registrados;
            $("#diferencia").text($diferencia);
            $("#diferencia_valor").val($diferencia);
          }




        });
      });
    </script>
  </body>

  </html>
