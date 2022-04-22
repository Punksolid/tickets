<?php

namespace App\Services;

class NameServiceMapper
{
    public static function filter()
    {
        return [
            'Alumbrado Público' => [
                'Instalación de Arbotantes',
                'Instalación de Lamparas',
                'Mantenimiento de Arbotantes',
                'Reparación de Lamparas'
            ],
            'Aseo y Limpia' => [
                    "BARRIDO MECÁNICO",
                    "RECOLECCIÓN DE BASURA",
                    "RETIRO DE ANIMALES MUERTOS"
            ],
            'Denuncias Administrativas' => [
                    "Denuncia",
            ],
            'Dirección de Movilidad',
            'Drenaje y Sistemas Pluviales',
            'Fugas de Agua',
            'Inspección y Vigilancia',
            'Lotes Baldios',
            'Obras Públicas',
            'Parques y Jardines',
            'Seguridad Pública'
        ];
    }
}
