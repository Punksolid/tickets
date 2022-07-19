<?php

namespace Tests\Feature;

use App\Services\GetTotalPages;
use Goutte\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\DomCrawler\Crawler;
use Tests\TestCase;

class GetTotalPagesTest extends TestCase
{
    /**
     * TODO: Add mock
     * @return void
     */
    public function test_get_total_pages(): void
    {

        $total_pages_getter = $this->getMockBuilder(GetTotalPages::class);
        $crawler = new Crawler($this->mockPageWithList());
        $total_pages_getter_mock = $total_pages_getter
                                        ->onlyMethods(['makeRequest'])
                                        ->getMock();

        $total_pages_getter_mock->method('makeRequest')->willReturn($crawler);

        $this->assertEquals(3524, $total_pages_getter_mock->__invoke());
    }

    private function mockPageWithList(): string
    {
        return <<<HTML
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
        <title>Ventanilla Activa</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <!-- Le styles -->
        <base href="https://apps.culiacan.gob.mx/ciudadano/" target="_self" /> <!-- Url de aplicacion  -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-select.min.css">
        <style>
        .navbar-static-top {
        margin-bottom: 19px;
        }
        </style>
        <link href="css/jquery-ui.min.css" rel="stylesheet">
        <link href="css/app.css" rel="stylesheet">
        <link href="css/pnotify.custom.min.css" rel="stylesheet">
        <link href="css/print.css" media="print" rel="stylesheet">
        <link rel="stylesheet" href="css/navbar-h.css">
        <link rel="stylesheet" href="css/jquery.autocomplete.css">
        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="img/favicon.ico">
        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/jquery-ui.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/validator.min.js"></script>
        <script src="js/app.js"></script>
        <script src="js/pnotify.custom.min.js"></script>
        <script src="js/bootstrap-select.min.js"></script>
        <style type="text/css">
            ul.nav > li > a:hover, a.navbar-brand:hover{
                color: #4CAF50!important;
            }
            ul.nav > li.active > a:hover, a.navbar-brand:hover{
                color: #FFFFFF!important;
            }
        </style>
    </head>
    <body>
        <div class="navbar navbar-default navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <img src="https://apps.culiacan.gob.mx/ciudadano//img/ventanillaactiva.png" width="50" height="50" >
                    <a class="navbar-brand" style="float: right;" href="https://apps.culiacan.gob.mx/ciudadano/inicio">Ventanilla Activa</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">

                        <!--ATENCION CIUDADANA-->
                                                    <li><a href="atencion-ciudadana/reportar"><span class="glyphicon glyphicon-bullhorn"></span> Reportar</a></li>
                            <li id="menu-atn-list"><a href="atencion-ciudadana/listado"><span class="glyphicon glyphicon-list-alt"></span> Reportes</a></li>
                            <li><a href="atencion-ciudadana/pendientes"><span class="glyphicon glyphicon-bell"></span> Pendientes</a></li>
                            <li><a href="atencion-ciudadana/informes"><span class="glyphicon glyphicon-list"></span> Informes</a></li>

                        <!--DEPENDENCIA-->

                        <!--CIUDADANO-->

                        <!--CANAL ALTERNO-->

                        <!--ATENCIÓN EN LÍNEA-->

                        <!--PRESIDENCIA-->

                        <!--DENUNCIA-->

                        <!--APOYO-->

                    </ul>
                    <ul id="opciones-seguridad" class="nav navbar-nav navbar-right">
                                                <li><a>ATENCIÓN CIUDADANA - Eden Fernando Rivera</a></li>
                                                <li><a href="sesion/logout">
                          <span class="visible-sm"><span class="glyphicon glyphicon-off"></span></span>
                          <span class="hidden-sm"><span class="glyphicon glyphicon-off"></span> Cerrar sesión</span>
                        </a></li>
                    </ul>
                </div>
                <div class="cargando progress progress-striped text-center" id="cargando">
                    <div class="msg progress-bar progress-bar-warning progress-striped active"
                    role="progressbar" style="width: 100%">
                        <div class="bar" style="width: 100%;">Procesando</div>
                    </div>
                </div>
            </div>
        </div>

        <!--<div class="container-fluid">
            <ol class="breadcrumb">
                <li><a href="https://apps.culiacan.gob.mx/ciudadano/"><span class="glyphicon glyphicon-home"></span></a></li>
            </ol>
        </div>-->

        <div id="contenedor-principal" class="container-fluid" style="margin: 15px;">
            <span id="label-title" class="lead">Reportes / Asignaciones</span>
<hr id="hr-atencion">
<form id="form-listado-reportes" name="form-listado-reportes" action="#"  method="post" class="well form-horizontal" onsubmit="return(false)">
	<div class="row">

		<div class="col-sm-3">
			<div class="input-group">
				<input type="text" id="buscador" name="buscador" autofocus="autofocus" class="form-control" placeholder="ingrese texto a buscar..">
				<span class="input-group-btn">
					<button id="btn-buscar" class="btn btn-success" type="submit"><span class="glyphicon glyphicon-search"></span></button>
				</span>
			</div>
		</div>

		<div class="col-sm-3">
			<div class="input-group">
				<span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
				<input type="text" id="referencia" name="referencia" class="form-control" placeholder="buscar un dependencia...">
			</div>
			<input type="hidden" id="id_dependencia" name="id_dependencia" />
		</div>

		<!--<div class="col-sm-2">
			<div class="btn-group pull-right">
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					<span class="glyphicon glyphicon-filter"></span> Reportes <span class="caret"></span>
				</button>
				<ul class="dropdown-menu filtro-reportes" role="menu">
					<li><a href="#" data-estado="ACTIVO">Activos</a></li>
					<li><a href="#" data-estado="ASIGNADO">Asignados</a></li>
					<li><a href="#" data-estado="CANCELADO">Cancelados</a></li>
					<li class="divider"></li>
					<li class="active"><a href="#" data-estado="">Todos</a></li>
				</ul>
			</div>
			<input type="hidden" id="filtro-reportes-seleccionado" name="filtro-reportes-seleccionado" />
		</div>-->

		<div class="col-sm-2">
			<div class="btn-group">
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					<span class="glyphicon glyphicon-filter"></span> Filtros <span class="caret"></span>
				</button>
				<ul class="dropdown-menu filtro-asignaciones" role="menu">
					<li><a href="#" data-estado="PENDIENTE">Pendientes</a></li>
					<li><a href="#" data-estado="ATENDIDO">Atendidos</a></li>
					<!--<li><a href="#" data-estado="NOTIFICADO">Notificados / Rechazados</a></li>-->
					<li><a href="#" data-estado="CANCELADO">Cancelados</a></li>
					<li><a href="#" data-estado="FINALIZADO">Finalizados</a></li>
					<li class="divider"></li>
					<li class="active"><a href="#" data-estado="">Todos</a></li>
				</ul>
			</div>
			<input type="hidden" id="filtro-asignaciones-seleccionado" name="filtro-asignaciones-seleccionado" />
		</div>

		<div class="col-sm-2">
			<div class="input-group">
				<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
				<input type="text" id="fechas" name="fechas" class="form-control">
			</div>
			<input type="hidden" id="fecha_seleccionada" name="fecha_seleccionada" />
		</div>

	</div>
</form>

<div id="contenedor-listado-ac">
	<table id="tbl" class="table table-striped table-hover table-condensed table-nowrap">
	<thead>
		<tr>
			<th>FOLIO</th>
			<th>DEPENDENCIA</th>
			<th>ID ASIGNACIÓN</th>
			<th>ASIGNACIÓN</th>
			<th>REPORTE</th>
			<th>CIUDADANO</th>
			<th>DOMICILIO</th>
			<th>SERVICIO</th>
			<th>FECHA</th>
			<th>USUARIO</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
									<tr>
					<td>
						0000120510					</td>
					<td class="corta">
						Alumbrado Publico					</td>
					<td>
						71623					</td>
					<td>
						<small>se reportan 3 lamparas led apagadas y 6 lamparas con luz amarilla apagadas.</small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>ciudadana reporta 3 lamparas led apagadas ubicadas en calle alocacia esquina con encinos a espaldas de panteón 21 de marzo y 6 lamparas con luz amarilla apagadas en la misma ubicación en la col. los laureles pinos.</small>
											</td>
					<td>
											Vecinos al Lugar					</td>
					<td class="corta">
						<small><em>alocacia , LAURELES PINOS, CP  Culiacán Rosales, México</em></small>
					</td>
					<td>
						Alumbrado Público						<br>
						<small>REPARACIÓN DE LAMPARAS</small>
					</td>
					<td>
						<em><small>18-July-2022 14:31:21</small></em>
					</td>
					<td>
						Claudia Rodriguez						<small></small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="71623" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="120510" data-id-asignacion="71623" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/71623" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="120510" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="120510" data-id-asignacion="71623" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/ciudadano/consultar/120510" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
							<tr>
					<td>
						0000120509					</td>
					<td class="corta">
						Alumbrado Publico					</td>
					<td>
						71622					</td>
					<td>
						<small>se reporta 1 lampara led apagada.</small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>ciudadano reporta 1 lampara led apagada ubicada en calle del citavaro esquina con calle alcornote. en la col. urbivilla del cedro. (checar cableado).</small>
											</td>
					<td>
											Jonathan Burgos Rocha					</td>
					<td class="corta">
						<small><em>citavaro 5306, URBIVILLA DEL CEDRO, CP  Culiacán Rosales, México</em></small>
					</td>
					<td>
						Alumbrado Público						<br>
						<small>REPARACIÓN DE LAMPARAS</small>
					</td>
					<td>
						<em><small>18-July-2022 14:05:38</small></em>
					</td>
					<td>
						Claudia Rodriguez						<small></small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="71622" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="120509" data-id-asignacion="71622" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/71622" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="120509" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="120509" data-id-asignacion="71622" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/ciudadano/consultar/120509" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
							<tr>
					<td>
						0000120508					</td>
					<td class="corta">
						Inspeccion y Vigilancia					</td>
					<td>
						71621					</td>
					<td>
						<small>CIUDADANA REPORTA A VENDEDORES AMBULANTES QUIENES OBSTRUYEN EL PASO PEATONAL</small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>CIUDADANA REPORTA A VENDEDORES AMBULANTES QUIENES VENDEN TACOS, CEVICHURROS , SUSHI Y DEMAS,  OBSTRUYENDO EL LIBDRE PASO DE LAS BANQUETA, TANTO PEATONAL Y VEHICULAR Y PIDEN SE QUITEND E INMEDIATO YA QUE HYA MUCHOS ACCIDENTES EN EL MISMO LUGAR, CALLE BLVD. SAN ISIDRO Y EL BLVD. MAQUIO CLOUTHIER FRENTE AL OPTICA VISTA SUR, HAY UN VENDEDOR DE TACOS QUIEN TIENE SU CARRETA EN LA PURA CARRETERA Y OBSTRUYE EL PASO PEATONAL,  ES EL PRIMERO,  EN EL FRACC. SAN ISIDRO</small>
											</td>
					<td>
											CAROLINA ORTEGA ZEPEDA					</td>
					<td class="corta">
						<small><em>BLVD. SAN ISIDRO 4650, LOMA DE SAN ISIDRO, CP  Culiacán Rosales, México</em></small>
					</td>
					<td>
						Inspeccion y Vigilancia						<br>
						<small>Inconformidad de Vecinos</small>
					</td>
					<td>
						<em><small>18-July-2022 13:59:20</small></em>
					</td>
					<td>
						Herminia Gamez Valenzuela						<small></small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="71621" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="120508" data-id-asignacion="71621" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/71621" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="120508" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="120508" data-id-asignacion="71621" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/ciudadano/consultar/120508" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
							<tr>
					<td>
						0000120507					</td>
					<td class="corta">
						Alumbrado Publico					</td>
					<td>
						71620					</td>
					<td>
						<small>se reportan 5 lamparas dobles leds apagadas.</small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>ciudadano reporta 5 lamparas dobles leds, en camellón ubicadas en el blvd. ecuador entre carretera México 15 y calle Ebro. del fracc. Altamira (frente a plaza sendero).</small>
											</td>
					<td>
											gibran pastor castañeda castillo					</td>
					<td class="corta">
						<small><em>blvd. ecuador 112, GUADALUPE, CP  Culiacán Rosales, México</em></small>
					</td>
					<td>
						Alumbrado Público						<br>
						<small>REPARACIÓN DE LAMPARAS</small>
					</td>
					<td>
						<em><small>18-July-2022 13:55:25</small></em>
					</td>
					<td>
						Claudia Rodriguez						<small></small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="71620" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="120507" data-id-asignacion="71620" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/71620" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="120507" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="120507" data-id-asignacion="71620" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/ciudadano/consultar/120507" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
							<tr>
					<td>
						0000120506					</td>
					<td class="corta">
						Alumbrado Publico					</td>
					<td>
						71619					</td>
					<td>
						<small>se reportan 3 lamparas led fundidas.</small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>ciudadano reporta 3 lamparas led fundidas en calle rio quelite entre ave. domingo Rubí y Manuel Bonilla. en la col. Guadalupe.</small>
											</td>
					<td>
											gibran pastor castañeda castillo					</td>
					<td class="corta">
						<small><em>ave. domingo Rubí 112, GUADALUPE, CP  Culiacán Rosales, México</em></small>
					</td>
					<td>
						Alumbrado Público						<br>
						<small>REPARACIÓN DE LAMPARAS</small>
					</td>
					<td>
						<em><small>18-July-2022 13:47:30</small></em>
					</td>
					<td>
						Claudia Rodriguez						<small></small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="71619" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="120506" data-id-asignacion="71619" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/71619" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="120506" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="120506" data-id-asignacion="71619" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/ciudadano/consultar/120506" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
							<tr>
					<td>
						0000120505					</td>
					<td class="corta">
						Alumbrado Publico					</td>
					<td>
						71618					</td>
					<td>
						<small>CIUDADANA REPORTA UNA LAMPARA APAGADA LED</small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>CIUDADANA REPORTA UNA LAMPARA LED APAGADA , FUERON ARREGLARLA Y NO FUNCIONO EL JUEVES, POR EL CIRCUITO  EVA GABRIELA  # CL-36131,  EN LA PRIVADA ESTANCIA 8.</small>
											</td>
					<td>
											saida satarain ibarra					</td>
					<td class="corta">
						<small><em>CIRCUITO EVA GABRIELA 76, PRIVADA LA ESTANCIA 8, CP  Culiacán Rosales, México</em></small>
					</td>
					<td>
						Alumbrado Público						<br>
						<small>REPARACIÓN DE LAMPARAS</small>
					</td>
					<td>
						<em><small>18-July-2022 13:43:57</small></em>
					</td>
					<td>
						Herminia Gamez Valenzuela						<small></small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="71618" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="120505" data-id-asignacion="71618" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/71618" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="120505" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="120505" data-id-asignacion="71618" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/ciudadano/consultar/120505" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
							<tr>
					<td>
						0000120504					</td>
					<td class="corta">
						Alumbrado Publico					</td>
					<td>
						71617					</td>
					<td>
						<small>CIUDADANO REPORTA 8 LAMPARAS LED </small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>CIUDADANO REPORTA 8 LAMPARAS LED APAGADAS, 4 POR LA CALLE CRUZ MEDINA ENTRE MARTIN LUIS GUZMAN Y JOSE MARIA VELASCO, Y 4 MAS POR LA CALLE CRUZ MEDINA ENTRE LAS CALLES  ROSARIO CASTELLANOS Y JOSE VASCONCELOS, A UN COSTADO DE SORIANA BARRANCOS, FRACC. FINISTERRA</small>
											</td>
					<td>
											TRINIDAD HERNANDEZ					</td>
					<td class="corta">
						<small><em>MANANTIAL DE TEHUACAN 7735, VILLAS DEL MANANTIAL, CP  Culiacán Rosales, México</em></small>
					</td>
					<td>
						Alumbrado Público						<br>
						<small>REPARACIÓN DE LAMPARAS</small>
					</td>
					<td>
						<em><small>18-July-2022 13:37:01</small></em>
					</td>
					<td>
						Herminia Gamez Valenzuela						<small></small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="71617" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="120504" data-id-asignacion="71617" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/71617" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="120504" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="120504" data-id-asignacion="71617" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/ciudadano/consultar/120504" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
							<tr>
					<td>
						0000120503					</td>
					<td class="corta">
						Inspeccion y Vigilancia					</td>
					<td>
						71616					</td>
					<td>
						<small>se reporta construcción en proceso.</small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>se reporta construcción en proceso esta tomando toda la banqueta además de instalar 3 topes y piden se regule la situación en el #5211 int. c de la calle guamúchil esquina con bonsáis y calles magnolia y pino real. en la col. urvibilla del prado.</small>
											</td>
					<td>
											cristhian Alvarado					</td>
					<td class="corta">
						<small><em>guamúchil , URBIVILLA, CP  Culiacán Rosales, México</em></small>
					</td>
					<td>
						Inspeccion y Vigilancia						<br>
						<small>Supervision de Obras en Construccion</small>
					</td>
					<td>
						<em><small>18-July-2022 13:35:01</small></em>
					</td>
					<td>
						Claudia Rodriguez						<small></small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="71616" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="120503" data-id-asignacion="71616" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/71616" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="120503" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="120503" data-id-asignacion="71616" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/ciudadano/consultar/120503" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
							<tr>
					<td>
						0000120502					</td>
					<td class="corta">
						Alumbrado Publico					</td>
					<td>
						71615					</td>
					<td>
						<small>lamparas apagadas</small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>lámparas apagadas en calle Ciudades Hermanas casi esquina con Bravo, Col. Guadalupe</small>
											</td>
					<td>
											abdel isaac cazarez					</td>
					<td class="corta">
						<small><em>Ciudades Hermanas s/n, GUADALUPE, CP  Culiacán Rosales, México</em></small>
					</td>
					<td>
						Alumbrado Público						<br>
						<small>REPARACIÓN DE LAMPARAS</small>
					</td>
					<td>
						<em><small>18-July-2022 13:13:38</small></em>
					</td>
					<td>
						Lorena Macias Ramos						<small></small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="71615" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="120502" data-id-asignacion="71615" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/71615" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="120502" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="120502" data-id-asignacion="71615" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/ciudadano/consultar/120502" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
							<tr>
					<td>
						0000120501					</td>
					<td class="corta">
						Parques y Jardines del Ayuntamiento					</td>
					<td>
						71614					</td>
					<td>
						<small>ciudadana solicita el despeje de luminarias</small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>ciudadana solicita el despeje de luminarias ya que cubren la visibilidad de la misma, por las calle marte y nova, favor de traer escalera, ya qué se había reportado y vinieron y no hicieron nada, porque no traían escalera,  col. Rubén Jaramillo.</small>
											</td>
					<td>
											ANA BERTHA LIZARRAGA PADILLA					</td>
					<td class="corta">
						<small><em>marte 2199, AMPLIACIÓN RUBÉN JARAMILLO, CP  Culiacán Rosales, México</em></small>
					</td>
					<td>
						Parques y Jardines						<br>
						<small>Despeje de Luminarias</small>
					</td>
					<td>
						<em><small>18-July-2022 13:09:58</small></em>
					</td>
					<td>
						Herminia Gamez Valenzuela						<small></small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="71614" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="120501" data-id-asignacion="71614" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/71614" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="120501" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="120501" data-id-asignacion="71614" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/ciudadano/consultar/120501" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
							<tr>
					<td>
						0000120500					</td>
					<td class="corta">
						Alumbrado Publico					</td>
					<td>
						71613					</td>
					<td>
						<small>se reportan 2 lamparas led apagadas.</small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>ciudadana reporta 2 lamparas led apagadas ubicadas en calle manantial la Ciénega esquina Tenochtitlan. en fracc. san Luis</small>
											</td>
					<td>
											melisa plata					</td>
					<td class="corta">
						<small><em>manantial la Ciénega 7728, CAMPO BELLO, CP  Culiacán Rosales, México</em></small>
					</td>
					<td>
						Alumbrado Público						<br>
						<small>REPARACIÓN DE LAMPARAS</small>
					</td>
					<td>
						<em><small>18-July-2022 13:04:54</small></em>
					</td>
					<td>
						Claudia Rodriguez						<small></small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="71613" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="120500" data-id-asignacion="71613" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/71613" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="120500" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="120500" data-id-asignacion="71613" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/ciudadano/consultar/120500" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
							<tr>
					<td>
						0000120499					</td>
					<td class="corta">
						Alumbrado Publico					</td>
					<td>
						71612					</td>
					<td>
						<small>lampara apagada</small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>solicita se retire lámpara ( privada) y se entregue al dueño bajo su Carretera Sanalona 4076 entre calle de acceso al fraccionamiento camino real y ley pabellón, Fracc. Camino Real</small>
											</td>
					<td>
											alejandro miranda					</td>
					<td class="corta">
						<small><em>Carretera Sanalona 4076 4076, CAMINO REAL, CP  Culiacán Rosales, México</em></small>
					</td>
					<td>
						Alumbrado Público						<br>
						<small>REPARACIÓN DE LAMPARAS</small>
					</td>
					<td>
						<em><small>18-July-2022 12:59:12</small></em>
					</td>
					<td>
						Lorena Macias Ramos						<small></small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="71612" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="120499" data-id-asignacion="71612" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/71612" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="120499" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="120499" data-id-asignacion="71612" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/ciudadano/consultar/120499" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
							<tr>
					<td>
						0000120498					</td>
					<td class="corta">
						Alumbrado Publico					</td>
					<td>
						71611					</td>
					<td>
						<small>se reportan 2 lamparas leds apagadas.</small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>ciudadana reporta 2 lamparas led apagadas ubicadas en francisco Salazar Goicochea entre ave. Álvaro obregón y Ramón Díaz franco. en la col. arboledas.</small>
											</td>
					<td>
											blanca Estela salas Landeros					</td>
					<td class="corta">
						<small><em>francisco Salazar Goicochea 87, ARBOLEDAS, CP  Culiacán Rosales, México</em></small>
					</td>
					<td>
						Alumbrado Público						<br>
						<small>REPARACIÓN DE LAMPARAS</small>
					</td>
					<td>
						<em><small>18-July-2022 12:52:20</small></em>
					</td>
					<td>
						Claudia Rodriguez						<small></small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="71611" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="120498" data-id-asignacion="71611" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/71611" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="120498" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="120498" data-id-asignacion="71611" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/ciudadano/consultar/120498" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
							<tr>
					<td>
						0000120497					</td>
					<td class="corta">
						Alumbrado Publico					</td>
					<td>
						71610					</td>
					<td>
						<small>INSTALACIÓN DE POSTE COMPLETO</small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>solicita instalación de dos postes completos en calle Rodolfo Acedo casi esquina con calle sin nombre, Col. Fovissste Chapultepec. ( en años pasados si se contaba con esos dos postes pero se retiraron por encontrarse en mal estado) ( anexo imagen)</small>
											</td>
					<td>
											CAROLINA QUINTERO RUIZ					</td>
					<td class="corta">
						<small><em>Rodolfo Acedo s/n, FOVISSSTE CHAPULTEPEC, CP  Culiacán Rosales, México</em></small>
					</td>
					<td>
						Alumbrado Público						<br>
						<small>INSTALACIÓN DE ARBOTANTES</small>
					</td>
					<td>
						<em><small>18-July-2022 12:20:40</small></em>
					</td>
					<td>
						Lorena Macias Ramos						<small></small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="71610" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="120497" data-id-asignacion="71610" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/71610" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="120497" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="120497" data-id-asignacion="71610" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/ciudadano/consultar/120497" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
							<tr>
					<td>
						0000120496					</td>
					<td class="corta">
						Aseo, Limpia y Lotes Baldios					</td>
					<td>
						71609					</td>
					<td>
						<small>se solicita falta de recolección de basura.</small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>ciudadano reporta falta de recolección de basura con retraso de 1 semana tienen asignado recolectar lunes, miércoles y viernes ubicado en calle álamos entre lidia y Atenas en la col. urbivilla del roble.</small>
											</td>
					<td>
											Guadalupe robles					</td>
					<td class="corta">
						<small><em>álamos 4792, URBIVILLA DEL ROBLE, CP  Culiacán Rosales, México</em></small>
					</td>
					<td>
						Aseo y Limpia						<br>
						<small>RECOLECCIÓN DE BASURA</small>
					</td>
					<td>
						<em><small>18-July-2022 12:15:36</small></em>
					</td>
					<td>
						Claudia Rodriguez						<small></small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="71609" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="120496" data-id-asignacion="71609" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/71609" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="120496" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="120496" data-id-asignacion="71609" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/ciudadano/consultar/120496" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
							<tr>
					<td>
						0000120495					</td>
					<td class="corta">
						Alumbrado Publico					</td>
					<td>
						71608					</td>
					<td>
						<small>ciudadana reporta una lampara led apagada</small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>ciudadana reporta una lampara led apagada por la calle miguel hidalgo  num. de poste cl-32338, entre las calles priv. yuriria y laguna de Catemaco, col. miguel hidalgo</small>
											</td>
					<td>
											elisa zamora					</td>
					<td class="corta">
						<small><em>miguel hidalgo 1430, MIGUEL HIDALGO Y COSTILLA, CP  Culiacán Rosales, México</em></small>
					</td>
					<td>
						Alumbrado Público						<br>
						<small>REPARACIÓN DE LAMPARAS</small>
					</td>
					<td>
						<em><small>18-July-2022 12:02:53</small></em>
					</td>
					<td>
						Herminia Gamez Valenzuela						<small></small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="71608" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="120495" data-id-asignacion="71608" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/71608" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="120495" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="120495" data-id-asignacion="71608" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/ciudadano/consultar/120495" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
							<tr>
					<td>
						0000120494					</td>
					<td class="corta">
						Alumbrado Publico					</td>
					<td>
						71607					</td>
					<td>
						<small>se reportan 5 lamparas led apagadas.</small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>ciudadana reporta 5 lamparas led apagadas ubicadas en calle quinta entre segunda y cuarta y 4 lamparas en calle tercera y topa con calle quinta, en Infonavit ctm.</small>
											</td>
					<td>
											María del rosario Bojórquez					</td>
					<td class="corta">
						<small><em>quinta 1935, INFONAVIT CTM, CP  Culiacán Rosales, México</em></small>
					</td>
					<td>
						Alumbrado Público						<br>
						<small>REPARACIÓN DE LAMPARAS</small>
					</td>
					<td>
						<em><small>18-July-2022 12:01:44</small></em>
					</td>
					<td>
						Claudia Rodriguez						<small></small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="71607" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="120494" data-id-asignacion="71607" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/71607" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="120494" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="120494" data-id-asignacion="71607" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/ciudadano/consultar/120494" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
							<tr>
					<td>
						0000120493					</td>
					<td class="corta">
						Alumbrado Publico					</td>
					<td>
						71606					</td>
					<td>
						<small>lampara apagada</small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>una lampara apagada en calle Privada Plan de Tuxtepec entre Fray Bernando de Balbuena y Blvd. Agricultores, Col. Revolución</small>
											</td>
					<td>
											MARIA DEL CARMEN ARREDONDO QUIÑONEZ					</td>
					<td class="corta">
						<small><em>Privada Plan de Tuxtepec 3847, REVOLUCIÓN, CP  Culiacán Rosales, México</em></small>
					</td>
					<td>
						Alumbrado Público						<br>
						<small>REPARACIÓN DE LAMPARAS</small>
					</td>
					<td>
						<em><small>18-July-2022 12:01:23</small></em>
					</td>
					<td>
						Lorena Macias Ramos						<small></small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="71606" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="120493" data-id-asignacion="71606" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/71606" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="120493" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="120493" data-id-asignacion="71606" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/ciudadano/consultar/120493" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
							<tr>
					<td>
						0000120492					</td>
					<td class="corta">
						Alumbrado Publico					</td>
					<td>
						71605					</td>
					<td>
						<small>sector apagado</small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>calle apagada en  Rolando Arjona acceso por Blvd. Sánchez Alonso , Fracc. Parque Alameda</small>
											</td>
					<td>
											Lic. Alfredo Herrera Romero					</td>
					<td class="corta">
						<small><em>Rolando Arjona s/n, PARQUE ALAMEDA, CP  Culiacán Rosales, México</em></small>
					</td>
					<td>
						Alumbrado Público						<br>
						<small>REPARACIÓN DE LAMPARAS</small>
					</td>
					<td>
						<em><small>18-July-2022 11:52:03</small></em>
					</td>
					<td>
						Lorena Macias Ramos						<small>Alumbrado Publico</small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="71605" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="120492" data-id-asignacion="71605" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/71605" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="120492" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="120492" data-id-asignacion="71605" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/ciudadano/consultar/120492" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
							<tr>
					<td>
						0000120491					</td>
					<td class="corta">
						Alumbrado Publico					</td>
					<td>
						71603					</td>
					<td>
						<small>se reporta 1 lampara led apagada.</small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>ciudadano reporta 1 lampara led #11565, apagada ubicada en calle mina real del 14 esquina con miguel alemán en la col. 12 de diciembre.</small>
											</td>
					<td>
											Josué Martínez					</td>
					<td class="corta">
						<small><em>mina real del 14 1642, 12 DE DICIEMBRE, CP  Culiacán Rosales, México</em></small>
					</td>
					<td>
						Alumbrado Público						<br>
						<small>REPARACIÓN DE LAMPARAS</small>
					</td>
					<td>
						<em><small>18-July-2022 11:45:51</small></em>
					</td>
					<td>
						Claudia Rodriguez						<small></small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="71603" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="120491" data-id-asignacion="71603" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/71603" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="120491" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="120491" data-id-asignacion="71603" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/ciudadano/consultar/120491" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
						</tbody>
</table>

<div id="paginacion" class="pull-right"><ul class="pagination pagination-sm"><li class="active"><a>1</a></li><li><a class="btn-paginar"href="https://apps.culiacan.gob.mx/ciudadano/atencion-ciudadana/reportes/paginacion/20">2</a></li><li><a class="btn-paginar"href="https://apps.culiacan.gob.mx/ciudadano/atencion-ciudadana/reportes/paginacion/40">3</a></li><li><a class="btn-paginar"href="https://apps.culiacan.gob.mx/ciudadano/atencion-ciudadana/reportes/paginacion/20">&rsaquo;</a></li><li><a class="btn-paginar"href="https://apps.culiacan.gob.mx/ciudadano/atencion-ciudadana/reportes/paginacion/70460">&raquo;</a></li></ul></div>
<script type="text/javascript">
$(function() {
	$('.opcion').tooltip();
});
</script>
</div>

<div id="impresion"></div>

<div id="modal-cancelacion" class="modal fade">
	<div class="modal-dialog">
	    <div class="modal-content">
			<div class="modal-header lead">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<span id="titulo">Cancelación de la Asiganción</span>
			</div>
			<div class="modal-body">
		        <form id="form-cancelacion" name="form-cancelacion" action="#"  method="post">
		        	<input type="hidden" id="id-reporte-cancelar" name="id-reporte-cancelar" />
		        	<input type="hidden" id="id-asignacion-cancelar" name="id-asignacion-cancelar" />
		            <div class="form-group">
						<label class="control-label">Comentarios</label>
						<textarea id="comentario" name="comentario" rows="5" class="form-control"></textarea>
					</div>
		        </form>
		    </div>
		    <div class="modal-footer">
				<button id="btn-cancelar" name="btn-cancelar" class="btn btn-danger" type="submit" data-loading-text="Espere..">Enviar</button>
			</div>
		</div>
	</div>
</div>

<div id="modal-cambiar-prioridad" class="modal fade">
	<div class="modal-dialog">
	    <div class="modal-content">
			<div class="modal-header lead">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<span id="titulo">Cambiar Prioridad del Reporte</span>
			</div>
			<div class="modal-body">
		        <form id="form-cambiar-prioridad" name="form-cambiar-prioridad" action="#"  method="post">
		        	<input type="hidden" id="id-reporte-cambiar-prioridad" name="id-reporte-cambiar-prioridad" />
					<div class="row">
						<div class="col-sm-4">
							<div class="radio">
								<label>
									<input type="radio" name="prioridad" id="rd-normal" value="1" checked>
									<span class="label label-primary">
										<span class="glyphicon glyphicon-flag"></span>
										NORMAL
									</span>
								</label>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="radio">
								<label>
									<input type="radio" name="prioridad" id="rd-urgente" value="2">
									<span class="label label-danger">
										<span class="glyphicon glyphicon-fire"></span>
										URGENTE
									</span>
								</label>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="radio">
								<label>
									<input type="radio" name="prioridad" id="rd-especial" value="3">
									<span class="label label-warning">
										<span class="glyphicon glyphicon-star"></span>
										ESPECIAL
									</span>
								</label>
							</div>
						</div>
					</div>
		        </form>
		    </div>
		    <div class="modal-footer">
				<button id="btn-cambiar-prioridad" name="btn-cambiar-prioridad" class="btn btn-success" type="submit" data-loading-text="Espere..">Aceptar</button>
			</div>
		</div>
	</div>
</div>

<div id="modal-no-competencia" class="modal fade">
	<div class="modal-dialog">
	    <div class="modal-content">
			<div class="modal-header lead">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<span>Solicitud de No Competencia y/o Rechazamiento</span>
			</div>
			<div class="modal-body">
		        <form id="form-no-competencia" name="form-no-competencia" action="#"  method="post">
		        	<input type="hidden" id="id-notificacion" name="id-notificacion" />
		            <div class="form-group">
						<p id="justificante-notificacion"></p>
						<small><em><span id="fecha-notificacion" class="pull-right"></span></em></small>
					</div>
		        </form>
		    </div>
		    <div class="modal-footer">
		    	<button id="btn-aceptar-notificacion" name="btn-aceptar-notificacion" class="btn btn-success" type="button" data-loading-text="<span class='glyphicon glyphicon-ok-sign'></span> Aceptando.."><span class="glyphicon glyphicon-ok-sign"></span> Aceptar</button>
				<button id="btn-rechazar-notificacion" name="btn-rechazar-notificacion" class="btn btn-danger" type="button" data-loading-text="<span class='glyphicon glyphicon-remove-sign'></span> Rechazando.."><span class="glyphicon glyphicon-remove-sign"></span> Rechazar</button>
			</div>
		</div>
	</div>
</div>

<div id="modal-historial-comentarios" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header lead">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <span>Historial de Comentarios/Respuestas</span>
            </div>
            <div class="modal-body" style="margin-top: -22px;">
                <form id="form-historial-comentarios" name="form-historial-comentarios" action="#"  method="post">
                    <style>.globo-comentarios{ width: 70%; }</style>
                    <div id="contenedor-historial-comentarios"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal-ver-atencion" class="modal fade">
	<div class="modal-dialog">
	    <div class="modal-content">
			<div class="modal-header lead">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<span>Descripción de Atención</span>
			</div>
			<div class="modal-body" style="margin-top:-21px;">
		        <form id="form-ver-atencion" name="form-ver-atencion" action="#"  method="post">
		            <div class="form-group">
		            	<blockquote>
							<p id="descripcion-atencion"></p>
						</blockquote>
						<small><em>Fecha de atención <span id="fecha-atencion" class="pull-right"></span></em></small>
					</div>
		        </form>
		    </div>
		</div>
	</div>
</div>
<script src="js/jquery.autocomplete.js"></script>
<script type="text/javascript">
	$("#referencia").autocomplete("atencion-ciudadana/reportes/autocompletar_dependencias",
    { minChars:1,matchSubset:1,matchContains:1,cacheLength:10,onItemSelect:null,selectOnly:0,remoteDataType:"json",
       onItemSelect: function(item){
       	$("#id_dependencia").val(item.data);
       	if ( $('#id_dependencia').val() ) {
				$.post(app.url + 'atencion-ciudadana/reportes/paginacion', $('#form-listado-reportes').serialize(), function(data){
					$('#contenedor-listado-ac').html(data);
				});
			};
       }
     }
   	);
</script>
<script src="js/atencion-ciudadana/mod-listado.js"></script>
        </div>

        <div id="notificacion" class='notifications top-right'></div>

        <div id="confirmacion" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header lead">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>Confirmación
                    </div>
                    <div class="modal-body">
                        <p><i class="icon-warning-sign"></i> <span></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-sm btn-danger" data-loading-text="Espere..">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="confirmaciones" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header lead">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>Confirmación
                    </div>
                    <div class="modal-body">
                        <p><i class="icon-warning-sign"></i> <span></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-sm" data-loading-text="Espere..">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="modal-no-competencia" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header lead">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <span>Notificación de No Competencia y/o Rechazar</span>
            </div>
            <div class="modal-body">
                <form id="form-no-competencia" name="form-no-competencia" action="#"  method="post">
                    <input type="hidden" id="id-asignacion-notificar" name="id-asignacion-notificar" />
                    <div class="form-group">
                        <label class="control-label">Justificante</label>
                        <textarea id="justificante" name="justificante" rows="5" class="form-control"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btn-notificar" name="btn-cambiar-prioridad" class="btn btn-danger" type="submit" data-loading-text="Espere.."><span class="glyphicon glyphicon-share-alt"></span> Enviar</button>
            </div>
        </div>
    </div>
</div>

<div id="modal-historial-no-competencia" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header lead">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <span>Historial Generado de No Competencias</span>
            </div>
            <div class="modal-body" style="margin-top: -22px;">
                <form id="form-historial-no-competencia" name="form-historial-no-competencia" action="#"  method="post">
                    <table id="tbl-historial" class="table table-striped table-hover table-condensed table-nowrap" >
                        <thead>
                            <tr>
                                <th width="65%">JUSTIFICANTE</th>
                                <th width="15%">ESTADO</th>
                                <th width="20%"><span class="pull-right">ENVIADA</span></th>
                            </tr>
                        </thead>
                        <tbody id="renglones-historial">

                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal-comentario" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header lead">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <span>Comentario de Seguimiento</span>
            </div>
            <div class="modal-body">
                <form id="form-comentario" name="form-comentario" action="#"  method="post">
                    <input type="hidden" id="id-asignacion-comentario-seguimiento" name="id-asignacion-comentario-seguimiento" />
                    <div class="form-group">
                        <label class="control-label">Comentario</label>
                        <textarea id="comentario" name="comentario" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Adjunto</label>
                        <input type="file" id="adjunto" name="adjunto">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btn-enviar-comentario" class="btn btn-info" type="submit" data-loading-text="Espere.."><span class="glyphicon glyphicon-comment"></span> Enviar</button>
            </div>
        </div>
    </div>
</div>

<div id="modal-historial-comentarios" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header lead">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <span>Historial de Comentarios/Respuestas</span>
            </div>
            <div class="modal-body" style="margin-top: -22px;">
                <form id="form-historial-comentarios" name="form-historial-comentarios" action="#"  method="post">
                    <style>.globo-comentarios{ width: 70%; }</style>
                    <div id="contenedor-historial-comentarios"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal-atendido" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header lead">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <span>Atención de Reporte</span>
            </div>
            <div class="modal-body">
                <form id="form-atendido" name="form-atendido" action="#"  method="post">
                    <input type="hidden" id="id-asignacion-atender" name="id-asignacion-atender" />
                    <div class="form-group">
                        <label class="control-label">Comentario Final</label>
                        <textarea id="comentario_atencion" name="comentario_atencion" rows="5" class="form-control"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btn-atender" name="btn-cambiar-prioridad" class="btn btn-success" type="submit" data-loading-text="Espere.."><span class="glyphicon glyphicon-thumbs-up"></span> Atender</button>
            </div>
        </div>
    </div>
</div>

<script src="js/dependencia/modales.js"></script>

    </body>
</html>
HTML;

    }
}
