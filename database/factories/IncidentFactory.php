<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class IncidentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'folio' => rand(5000,10000000),
            'dependencia' => $this->faker->randomElement([
                'Alumbrado Público',
                'Aseo y Limpia',
                'Denuncias Administrativas',
                'Dirección de Movilidad',
                'Drenaje y Sistemas Pluviales',
                'Fugas de Agua',
                'Inspección y Vigilancia',
                'Lotes Baldios',
                'Obras Públicas',
                'Parques y Jardines',
                'Seguridad Pública'
            ]),
            'id_asignacion' => $this->faker->randomNumber(5), //number
            'reporte' => $this->faker->word,
            'ciudadano' => $this->faker->word,
            'domicilio' => $this->faker->address,
            'servicio' => $this->faker->word,
            'fecha' => $this->faker->dateTime,
            'usuario' => $this->faker->firstName(),
            'asignacion' => $this->faker->randomElement(['peticiones facebook']),
            'status' => $this->faker->randomElement(['Pendiente','Atendido']),
        ];
    }
}
