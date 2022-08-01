<?php

namespace Tests\Feature\Jobs;

use App\Jobs\FetchAndScrapMulta;
use App\Models\Multa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Mockery\Mock;
use Symfony\Component\DomCrawler\Crawler;
use Tests\TestCase;

class FetchAndScrapMultaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fetch_and_strap_multa(): void
    {
        $this->withoutExceptionHandling();
        $expected = [
            'folio' => 'J100000',
            'placa' => 'VJE5251',
            'importe' => '435.00',
            'redondeo' => '0.00',
        ];

        /** @var FetchAndScrapMulta | Mock $fetch_and_scrap_multa_job */
        $fetch_and_scrap_multa_job = $this->partialMock(FetchAndScrapMulta::class);
        $fetch_and_scrap_multa_job->shouldReceive('request')->andReturn( new Crawler($this->multaHtmlResponse()));

        $fetch_and_scrap_multa_job->handle();

        $multa = Multa::where('folio', 'J100000')->first();
        $actual = $multa->toArray();

        $this->assertEquals($expected['folio'], $actual['folio']);
        $this->assertEquals($expected['placa'], $actual['placa']);
        $this->assertEquals($expected['importe'], $actual['importe']);
        $this->assertEquals($expected['redondeo'], $actual['redondeo']);
        $this->assertEquals(1, count($actual['conceptos']));
        $this->assertNotNull($actual['full_html']);
    }

    private function multaHtmlResponse()
    {
        return <<<HTML
			<div class="datos-boleta" style="overflow: hidden">
				<div class="contribuyente">
					<div class="predio-title">
						<h4>Multas de tránsito</h4>
					</div>
					<dl>
						<dt>Folio</dt>
						<dd>J100000</dd>
						<dt>Placa</dt>
						<dd>VJE5251</dd>
						<dt>Importe</dt>
						<dd class="label label-success" style="font-size: 14px">$ 435.00</dd>
						<dt>Redondeo</dt>
						<dd>0.00</dd>
					</dl>
				</div>
			</div>

			<div class="descripcion-multa">
				<h3 class="lead" style="margin-top: 30px">Resumen de la multa</h3>
								<table class="table">
					<thead>
						<tr>
							<th>Concepto</th>
							<th>Descripción</th>
							<th>Importe</th>
						</tr>
					</thead>
					<tbody>

						<div class="detalle-boleta">
															<tr>
									<td>52</td>
									<td>ESTACIONARSE EN LUGARES NO PERMITIDOS HABIENDO SE¤ALES VISIBLES (L 156, R 138)</td>
									<td>435.00</td>
																	</tr>
													</div>
					</tbody>
					<tfoot>
						<tr>
							<th colspan="2">Total</th>
							<th>435.00</th>
						</tr>
					</tfoot>
				</table>
			</div>


<div class="buttons">
	<a href="mipago_bancomer" type="button" class="btn-action">Pagar con Tarjeta</a>
</div>

HTML;

    }

}
