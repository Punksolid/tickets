<?php

namespace Tests\Feature;

use App\Jobs\FetchIncidentsJob;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\DomCrawler\Crawler;
use Tests\TestCase;

class WebScrapperTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_all_fields()
    {
        // Create a new crawler instance with the value of mockResponse method
        $crawler = new Crawler($this->mockResponse());
        // Partial mock FetchIncidentsJob class
        /** @var FetchIncidentsJob $fetch_incidents */
        $fetch_incidents = $this->partialMock(FetchIncidentsJob::class);
        $fetch_incidents->shouldReceive('request')->andReturn($crawler);


        $result = $fetch_incidents->requestAndScrap();
        $this->assertEquals([
            "folio" => "117257",
            "dependencia" => "Obras Publicas",
            "id_asignacion" => "68632",
            "prioridad" => "NORMAL",
            "reporte" => "ciudadana solicita con carácter de urgente la reparación de alcantarilla muy hundida, ubicado en blvd. niños héroes entre casi esq. con pres Valsequillo, en la col. las quintas.",
            "ciudadano" => "alma karina calderon angulo",
            "domicilio" => "blvd. niños héroes 2584, LOS ÁNGELES, CP 80014 Culiacán Rosales, México",
            "servicio" => "Obras Publicas BACHEO Y REENCARPETADO",
            "fecha" => "11-April-2022 13:15:43",
            "usuario" => "Bertha Alicia Aispuro Osuna",
            "asignacion" => "se solicita con carácter de urgente la reparación de alcantarilla hundida",
            "status" => "PENDIENTE",
        ], $result[0]);

    }

    public function mockResponse()
    {
        return <<<HTML
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
						11725					</td>
					<td class="corta">
						Obras Publicas					</td>
					<td>
						68632					</td>
					<td>
						<small>se solicita con carácter de urgente la reparación de alcantarilla hundida</small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>ciudadana solicita con carácter de urgente la reparación de alcantarilla muy hundida, ubicado en blvd. niños héroes entre casi esq. con pres Valsequillo, en la col. las quintas.</small>
											</td>
					<td>
											alma karina calderon angulo					</td>
					<td class="corta">
						<small><em>blvd. niños héroes 2584, LOS ÁNGELES, CP 80014 Culiacán Rosales, México</em></small>
					</td>
					<td>
						Obras Publicas						<br>
						<small>BACHEO Y REENCARPETADO</small>
					</td>
					<td>
						<em><small>11-April-2022 13:15:43</small></em>
					</td>
					<td>
						Bertha Alicia Aispuro Osuna						<small></small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="68632" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="117257" data-id-asignacion="68632" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/68632" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="117257" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="117257" data-id-asignacion="68632" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/070/consultar/117257" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
							<tr>
					<td>
						11725					</td>
					<td class="corta">
						Parques y Jardines del Ayuntamiento					</td>
					<td>
						68631					</td>
					<td>
						<small>se solicita el despeje de luminarias.</small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>ciudadana solicita el despeje de luminarias, ubicadas en calle rio Piaxtla pte. esq. con Manuel Bonilla</small>
											</td>
					<td>
											sofia teresa morales valera					</td>
					<td class="corta">
						<small><em>rio piaxtla 295, GUADALUPE, CP 80220 Culiacán Rosales, México</em></small>
					</td>
					<td>
						Parques y Jardines						<br>
						<small>Despeje de Luminarias</small>
					</td>
					<td>
						<em><small>11-April-2022 12:37:55</small></em>
					</td>
					<td>
						Bertha Alicia Aispuro Osuna						<small></small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="68631" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="117256" data-id-asignacion="68631" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/68631" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="117256" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="117256" data-id-asignacion="68631" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/070/consultar/117256" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
							<tr>
					<td>
						11725					</td>
					<td class="corta">
						Alumbrado Publico					</td>
					<td>
						68630					</td>
					<td>
						<small>se reporta una lampara leds apagada</small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>ciudadana reporta una lampara leds apagada, ubicada en calle rio Piaxtla Pte. casi esq. con Manuel Bonilla.</small>
											</td>
					<td>
											sofia teresa morales valera					</td>
					<td class="corta">
						<small><em>rio piaxtla 295, GUADALUPE, CP 8220 Culiacán Rosales, México</em></small>
					</td>
					<td>
						Alumbrado Público						<br>
						<small>REPARACIÓN DE LAMPARAS</small>
					</td>
					<td>
						<em><small>11-April-2022 12:32:44</small></em>
					</td>
					<td>
						Bertha Alicia Aispuro Osuna						<small></small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="68630" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="117254" data-id-asignacion="68630" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/68630" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="117254" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="117254" data-id-asignacion="68630" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/070/consultar/117254" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
							<tr>
					<td>
						11725					</td>
					<td class="corta">
						Alumbrado Publico					</td>
					<td>
						68629					</td>
					<td>
						<small>se reporta una lampara leds apagada</small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>ciudadano reporta una lampara leds apagada CL-05919, ubicada en calle edo. de puebla entre blvd. sinaloa y av. el dorado.</small>
											</td>
					<td>
											edgardo quijada franco					</td>
					<td class="corta">
						<small><em>edo. de puebla 1456, LAS QUINTAS, CP 80060 Culiacán Rosales, México</em></small>
					</td>
					<td>
						Alumbrado Público						<br>
						<small>REPARACIÓN DE LAMPARAS</small>
					</td>
					<td>
						<em><small>11-April-2022 12:28:53</small></em>
					</td>
					<td>
						Bertha Alicia Aispuro Osuna						<small></small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="68629" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="117253" data-id-asignacion="68629" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/68629" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="117253" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="117253" data-id-asignacion="68629" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/070/consultar/117253" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
							<tr>
					<td>
						11725					</td>
					<td class="corta">
						Inspeccion y Vigilancia					</td>
					<td>
						68628					</td>
					<td>
						<small>se reporta a persona que realiza trabajos de carpintería</small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>se reporta a persona que realiza trabajos de carpintería, produciendo ruidos muy fuertes todo el día esto de lunes a domingo, ocasionando molestia e inconformidad en vecinos ya que también utiliza solvente de fuerte aromas y por ser dañinos para la salud, ubicado en el no.950 de la calle rio Ometepec esq. con bahía de agiabampo</small>
											</td>
					<td>
											vecinos al lugar					</td>
					<td class="corta">
						<small><em>rio ometepec , NUEVO CULIACÁN, CP  Culiacán Rosales, México</em></small>
					</td>
					<td>
						Inspeccion y Vigilancia						<br>
						<small>Inconformidad de Vecinos</small>
					</td>
					<td>
						<em><small>11-April-2022 12:05:00</small></em>
					</td>
					<td>
						Bertha Alicia Aispuro Osuna						<small></small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="68628" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="117251" data-id-asignacion="68628" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/68628" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="117251" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="117251" data-id-asignacion="68628" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/070/consultar/117251" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
							<tr>
					<td>
						11725					</td>
					<td class="corta">
						Alumbrado Publico					</td>
					<td>
						68643					</td>
					<td>
						<small>lampara apagada</small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>ciudadana solicita se le instale iluminación a la techumbre en la colonia Antorchista, por calle Acolhuacán, a lado de costa del sol</small>
											</td>
					<td>
											Lidia acosta					</td>
					<td class="corta">
						<small><em>Acolhuacan a lado de costa de sol sn, EL RANCHITO, CP 0000 Culiacán Rosales, México</em></small>
					</td>
					<td>
						Alumbrado Público						<br>
						<small>INSTALACIÓN DE LAMPARAS</small>
					</td>
					<td>
						<em><small>11-April-2022 11:41:06</small></em>
					</td>
					<td>
						Karla Yuridia Corrales Solis						<small>Alumbrado Publico</small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="68643" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="117250" data-id-asignacion="68643" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/68643" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="117250" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="117250" data-id-asignacion="68643" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/070/consultar/117250" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
							<tr>
					<td>
						11724					</td>
					<td class="corta">
						Alumbrado Publico					</td>
					<td>
						68627					</td>
					<td>
						<small>se reporta una lampara leds apagada</small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>ciudadana reporta una lampara leds apagada, ubicada en andador arboledas entre av. landas y andador Amapá del norte</small>
											</td>
					<td>
											miriam chavira lizarraga					</td>
					<td class="corta">
						<small><em>andador arboledas 2550-A, FRACCIONAMIENTO VALLE DE AMAPA, CP 80194 Culiacán Rosales, México</em></small>
					</td>
					<td>
						Alumbrado Público						<br>
						<small>REPARACIÓN DE LAMPARAS</small>
					</td>
					<td>
						<em><small>11-April-2022 11:30:46</small></em>
					</td>
					<td>
						Bertha Alicia Aispuro Osuna						<small></small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="68627" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="117249" data-id-asignacion="68627" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/68627" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="117249" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="117249" data-id-asignacion="68627" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/070/consultar/117249" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
							<tr>
					<td>
						11724					</td>
					<td class="corta">
						Dirección de Movilidad					</td>
					<td>
						68626					</td>
					<td>
						<small>se reporta a el Sr. Samuel y la Sra. Laura</small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>se reporta al Sr. Samuel y Sra. Laura que tiene abarrote en la pura esq. y levantaron tope el cual obstruye y desvía cause de arroyo, ocasionando ya serios daños a pavimento, molestia e inconformidad en vecinos y automovilistas, ubicado en calle guamúchil esq. con priv. granito, nota se hace mención de folio no.116817 de fecha 24/03/22</small>
											</td>
					<td>
											vecinos al lugar					</td>
					<td class="corta">
						<small><em>guamúchil , JARDINES DEL PEDREGAL, CP 80025 Culiacán Rosales, México</em></small>
					</td>
					<td>
						Dirección de Movilidad						<br>
						<small>Instalación de Boyas en Vías Públicas</small>
					</td>
					<td>
						<em><small>11-April-2022 11:25:26</small></em>
					</td>
					<td>
						Bertha Alicia Aispuro Osuna						<small></small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="68626" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="117248" data-id-asignacion="68626" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/68626" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="117248" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="117248" data-id-asignacion="68626" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/070/consultar/117248" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
							<tr>
					<td>
						11724					</td>
					<td class="corta">
						Alumbrado Publico					</td>
					<td>
						68656					</td>
					<td>
						<small>lampara apagada</small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>Lampara que NO ENCIENDE. Exactamente en el semaforo que esta en el cruce de la calle aztlan y del blvd benjamin Hill. Frente a la bodega aurrera</small>
											</td>
					<td>
											Joaquin Farias					</td>
					<td class="corta">
						<small><em>Aztlán 3802 3802, INDUSTRIAL EL PALMITO, CP 80180 Culiacán Rosales, México</em></small>
					</td>
					<td>
						Alumbrado Público						<br>
						<small>REPARACIÓN DE LAMPARAS</small>
					</td>
					<td>
						<em><small>11-April-2022 11:23:49</small></em>
					</td>
					<td>
						Joaquin Farias						<small></small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="68656" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="117247" data-id-asignacion="68656" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/68656" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="117247" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="117247" data-id-asignacion="68656" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/070/consultar/117247" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
							<tr>
					<td>
						11724					</td>
					<td class="corta">
						Alumbrado Publico					</td>
					<td>
						68625					</td>
					<td>
						<small>se reportan dos lamparas leds apagadas</small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>ciudadana reporta dos lamparas leds apagadas, ubicadas en calle jade entre las calles salvador Alvarado y blvd. obrero mundial, en la col. villa del pedregal</small>
											</td>
					<td>
											martha uriarte chavez					</td>
					<td class="corta">
						<small><em>jade 1800, 10 DE ABRIL, CP 80029 Culiacán Rosales, México</em></small>
					</td>
					<td>
						Alumbrado Público						<br>
						<small>REPARACIÓN DE LAMPARAS</small>
					</td>
					<td>
						<em><small>11-April-2022 11:08:22</small></em>
					</td>
					<td>
						Bertha Alicia Aispuro Osuna						<small></small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="68625" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="117246" data-id-asignacion="68625" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/68625" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="117246" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="117246" data-id-asignacion="68625" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/070/consultar/117246" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
							<tr>
					<td>
						11724					</td>
					<td class="corta">
						Inspeccion y Vigilancia					</td>
					<td>
						68624					</td>
					<td>
						<small>se reporta a persona con yonke</small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>se reporta a persona con yonke, obstruyendo el paso peatona y parte del vehicular con unidades en total estado de chatarra, ocasionando molestia e inconformidad en traseuntes y vecinos por constante peligro y por ser motivo de acumulamiento de basura y plaga de animales, ubicado en calle urales norte esq. con av. urales.</small>
											</td>
					<td>
											vecinos al lugar					</td>
					<td class="corta">
						<small><em>urales norte , VILLA BONITA, CP 80199 Culiacán Rosales, México</em></small>
					</td>
					<td>
						Inspeccion y Vigilancia						<br>
						<small>Inconformidad de Vecinos</small>
					</td>
					<td>
						<em><small>11-April-2022 10:47:37</small></em>
					</td>
					<td>
						Bertha Alicia Aispuro Osuna						<small></small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="68624" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="117245" data-id-asignacion="68624" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/68624" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="117245" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="117245" data-id-asignacion="68624" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/070/consultar/117245" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
							<tr>
					<td>
						11724					</td>
					<td class="corta">
						Dirección de Sistemas de Drenajes Pluviales					</td>
					<td>
						68623					</td>
					<td>
						<small>se solicita la limpieza y desazolve de canal pluvial</small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>ciudadana solicita la limpieza y desazolve de canal pluvial, ubicado en calle dr. mora y blvd. el dorado (a espaldas de banamex). Nota: este canal divide las quintas de la campiña</small>
											</td>
					<td>
											norma Inzunza					</td>
					<td class="corta">
						<small><em>dr. mora 1339, LAS QUINTAS, CP 80060 Culiacán Rosales, México</em></small>
					</td>
					<td>
						Drenajes y Sistemas Pluviales						<br>
						<small>LIMPIEZA DE ARROYOS</small>
					</td>
					<td>
						<em><small>11-April-2022 10:23:35</small></em>
					</td>
					<td>
						Bertha Alicia Aispuro Osuna						<small></small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="68623" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="117244" data-id-asignacion="68623" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/68623" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="117244" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="117244" data-id-asignacion="68623" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/070/consultar/117244" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
							<tr>
					<td>
						11724					</td>
					<td class="corta">
						Alumbrado Publico					</td>
					<td>
						68622					</td>
					<td>
						<small>se reportan dos lamparas leds apagadas</small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>ciudadana reporta tres lamparas leds apagadas, ubicadas en calle justicia frene al no.2809 entre av. revolución y arroyo</small>
											</td>
					<td>
											alejandra alvarez					</td>
					<td class="corta">
						<small><em>justicia 2809, EMILIANO ZAPATA, CP 80260 Culiacán Rosales, México</em></small>
					</td>
					<td>
						Alumbrado Público						<br>
						<small>REPARACIÓN DE LAMPARAS</small>
					</td>
					<td>
						<em><small>11-April-2022 09:42:05</small></em>
					</td>
					<td>
						Bertha Alicia Aispuro Osuna						<small></small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="68622" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="117243" data-id-asignacion="68622" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/68622" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="117243" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="117243" data-id-asignacion="68622" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/070/consultar/117243" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
							<tr>
					<td>
						11724					</td>
					<td class="corta">
						Inspeccion y Vigilancia					</td>
					<td>
						68621					</td>
					<td>
						<small>se reporta a persona con cría de gallinas y gallos</small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>se reporta a persona con criadero de gallinas y gallos, ocasionando malos olores, mucha mosca, plaga de animales (rata, coruco y cucaracha), ubicado en el no.827 de calle platón entre blvd. las americas y shiller.</small>
											</td>
					<td>
											vecinos al lugar					</td>
					<td class="corta">
						<small><em>platón , VILLA UNIVERSIDAD, CP 80011 Culiacán Rosales, México</em></small>
					</td>
					<td>
						Inspeccion y Vigilancia						<br>
						<small>Inconformidad de Vecinos</small>
					</td>
					<td>
						<em><small>11-April-2022 09:37:38</small></em>
					</td>
					<td>
						Bertha Alicia Aispuro Osuna						<small></small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="68621" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="117242" data-id-asignacion="68621" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/68621" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="117242" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="117242" data-id-asignacion="68621" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/070/consultar/117242" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
							<tr>
					<td>
						11724					</td>
					<td class="corta">
						Inspeccion y Vigilancia					</td>
					<td>
						68620					</td>
					<td>
						<small>se reporta la demolición de construcción </small>
						<br>
															<span class="label label-danger">CANCELADO</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>se reporta la demolición de construcción afectando a vecinos, ubicado en calle gea entre las calles Zeus y Aquiles.</small>
											</td>
					<td>
											vecinos al lugar					</td>
					<td class="corta">
						<small><em>gea , CANACO, CP 80059 Culiacán Rosales, México</em></small>
					</td>
					<td>
						Inspeccion y Vigilancia						<br>
						<small>Supervision de Obras en Construccion</small>
					</td>
					<td>
						<em><small>11-April-2022 09:21:12</small></em>
					</td>
					<td>
						Bertha Alicia Aispuro Osuna						<small></small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="68620" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->


						<!---->

						<a data-id-reporte="117241" data-id-asignacion="68620" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/070/consultar/117241" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
							<tr>
					<td>
						11724					</td>
					<td class="corta">
						Aseo, Limpia y Lotes Baldios					</td>
					<td>
						68619					</td>
					<td>
						<small>se reporta lote baldío</small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>se reporta lote baldío con demasiada maleza, basura y plaga de animales, ubicado en calle san Víctor esq. con topando con blvd. del lago.</small>
											</td>
					<td>
											anonimo					</td>
					<td class="corta">
						<small><em>san victor , LOS ÁNGELES, CP 80014 Culiacán Rosales, México</em></small>
					</td>
					<td>
						Lotes Baldios						<br>
						<small>Verificacion de lotes</small>
					</td>
					<td>
						<em><small>11-April-2022 09:05:21</small></em>
					</td>
					<td>
						Bertha Alicia Aispuro Osuna						<small></small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="68619" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="117240" data-id-asignacion="68619" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/68619" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="117240" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="117240" data-id-asignacion="68619" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/070/consultar/117240" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
							<tr>
					<td>
						11723					</td>
					<td class="corta">
						Parques y Jardines del Ayuntamiento					</td>
					<td>
						68618					</td>
					<td>
						<small>se solicita la limpieza general y desmonte de camellón</small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>ciudadana solicita la limpieza general y desmonte de camellón, ubicado en blvd. san Nicolás entre san Víctor y san Aaron</small>
											</td>
					<td>
											dulce cristal ramos Aguirre					</td>
					<td class="corta">
						<small><em>blvd. san nicolas 2742, LOS ÁNGELES, CP 80014 Culiacán Rosales, México</em></small>
					</td>
					<td>
						Parques y Jardines						<br>
						<small>LIMPIEZA DE CAMELLONES</small>
					</td>
					<td>
						<em><small>11-April-2022 09:02:27</small></em>
					</td>
					<td>
						Bertha Alicia Aispuro Osuna						<small></small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="68618" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="117239" data-id-asignacion="68618" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/68618" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="117239" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="117239" data-id-asignacion="68618" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/070/consultar/117239" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
							<tr>
					<td>
						11723					</td>
					<td class="corta">
						Alumbrado Publico					</td>
					<td>
						68617					</td>
					<td>
						<small>se solicita la instalación de arbotante y lampara completa</small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>ciudadana solicita la instalación de arbotante y lampara completa, ubicado en calle san Víctor esq. con san Nicolás</small>
											</td>
					<td>
											dulce cristal ramos Aguirre					</td>
					<td class="corta">
						<small><em>san victor 2742, LOS ÁNGELES, CP 80014 Culiacán Rosales, México</em></small>
					</td>
					<td>
						Alumbrado Público						<br>
						<small>INSTALACIÓN DE ARBOTANTES</small>
					</td>
					<td>
						<em><small>11-April-2022 08:55:22</small></em>
					</td>
					<td>
						Bertha Alicia Aispuro Osuna						<small></small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="68617" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="117238" data-id-asignacion="68617" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/68617" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="117238" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="117238" data-id-asignacion="68617" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/070/consultar/117238" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
							<tr>
					<td>
						11723					</td>
					<td class="corta">
						Alumbrado Publico					</td>
					<td>
						68642					</td>
					<td>
						<small>lampara apagada</small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>En el parque ubicado en circuito los jacintos la pastilla que enciende las luminarias falla mucho y al parecer tiene corto y muy frecuentemente no prenden auge cambiar esa pastilla y revisar el poste tiene corto</small>
											</td>
					<td>
											Zaida Lorena Franco Trujillo					</td>
					<td class="corta">
						<small><em>Circuito los jacintos 1810, COLINAS DEL BOSQUE, CP 80197 Culiacán Rosales, México</em></small>
					</td>
					<td>
						Alumbrado Público						<br>
						<small>REPARACIÓN DE LAMPARAS</small>
					</td>
					<td>
						<em><small>09-April-2022 09:56:00</small></em>
					</td>
					<td>
						Zaida Lorena Franco Trujillo						<small></small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="68642" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="117237" data-id-asignacion="68642" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/68642" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="117237" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="117237" data-id-asignacion="68642" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/070/consultar/117237" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
							<tr>
					<td>
						11723					</td>
					<td class="corta">
						Alumbrado Publico					</td>
					<td>
						68641					</td>
					<td>
						<small>lampara apagada</small>
						<br>
															<span class="label label-info">PENDIENTE</span>
														</td>
					<td class="corta">
															<span class="label label-primary"><span class="glyphicon glyphicon-flag"></span> NORMAL</span>
															<br>
						<small>Vecino tiene estacionado frente a mi casa un automovil en calidad de chatarra. Ademas de contaminar el aspecto visual, ocupa un espacio, tira aceite y se acumula basura que no podemos limpiar. Es la segunda ocasion que realizo este reporte y persiste esta situacion.</small>
											</td>
					<td>
											Carlos Hernández					</td>
					<td class="corta">
						<small><em>Villa Navarra 2861, VILLAS DEL RÍO, CP 80050 Culiacán Rosales, México</em></small>
					</td>
					<td>
						Inspeccion y Vigilancia						<br>
						<small>Inconformidad de Vecinos</small>
					</td>
					<td>
						<em><small>09-April-2022 09:30:08</small></em>
					</td>
					<td>
						Carlos Hernández						<small></small>
					</td>
					<td colspan="2">
						<!--<a data-id-asignacion="68641" class="btn-historial-comentarios btn btn-xs btn-default pull-right opcion" title="Historial de Comentarios"><span class="glyphicon glyphicon-comment"></span></a>
						<span class="pull-right">&nbsp;</span>-->

															<a data-id-reporte="117235" data-id-asignacion="68641" class="btn-cancelar-reporte btn btn-xs btn-danger pull-right opcion" title="Cancelar Asignación"><span class="glyphicon glyphicon-remove"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a href="atencion-ciudadana/reportes/edicion/68641" class="btn btn-xs btn-info pull-right opcion" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
									<a data-id-reporte="117235" data-prioridad-actual="NORMAL" class="btn-c-p btn btn-xs btn-success pull-right opcion" title="Cambiar Prioridad"><span class="glyphicon glyphicon-sort"></span></a>
									<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

						<!---->

						<a data-id-reporte="117235" data-id-asignacion="68641" class="btn-impresion btn btn-xs btn-primary pull-right opcion" title="Imprimir"><span class="glyphicon glyphicon-print"></span></a>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
						<a href="https://apps.culiacan.gob.mx/070/consultar/117235" class="btn-ver-detalle btn btn-xs btn-default pull-right opcion" target="_blank" title="Ver Reporte"><span class="glyphicon glyphicon-zoom-in"></span></a>
					</td>
				</tr>
						</tbody>
</table>

<div id="paginacion" class="pull-right"><ul class="pagination pagination-sm"><li><a class="btn-paginar"href="https://apps.culiacan.gob.mx/070/atencion-ciudadana/reportes/paginacion/">&lsaquo;</a></li><li><a class="btn-paginar"href="https://apps.culiacan.gob.mx/070/atencion-ciudadana/reportes/paginacion/">1</a></li><li class="active"><a>2</a></li><li><a class="btn-paginar"href="https://apps.culiacan.gob.mx/070/atencion-ciudadana/reportes/paginacion/40">3</a></li><li><a class="btn-paginar"href="https://apps.culiacan.gob.mx/070/atencion-ciudadana/reportes/paginacion/60">4</a></li><li><a class="btn-paginar"href="https://apps.culiacan.gob.mx/070/atencion-ciudadana/reportes/paginacion/40">&rsaquo;</a></li><li><a class="btn-paginar"href="https://apps.culiacan.gob.mx/070/atencion-ciudadana/reportes/paginacion/67840">&raquo;</a></li></ul></div>
<script type="text/javascript">
$(function() {
	$('.opcion').tooltip();
});
</script>
HTML;

    }

}
