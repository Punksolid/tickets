<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MapService
{

    final public const SERVICE_NAMES_IDS = [
        "1" => [
            'name' => 'Alumbrado Público',
            'subservices' => [
                ["id_tipo_servicio" => "4", "nombre_tipo_servicio" => "INSTALACIÓN DE ARBOTANTES"],
                ["id_tipo_servicio" => "1", "nombre_tipo_servicio" => "INSTALACIÓN DE LAMPARAS"],
                ["id_tipo_servicio" => "3", "nombre_tipo_servicio" => "MANTENIMIENTO DE ARBOTANTES"],
                ["id_tipo_servicio" => "2", "nombre_tipo_servicio" => "REPARACIÓN DE LAMPARAS"]
            ]
        ],
        "2" => [
            'name' => 'Aseo y Limpia',
            'subservices' => [
                ["id_tipo_servicio" => "9", "nombre_tipo_servicio" => "BARRIDO MECÁNICO"],
                ["id_tipo_servicio" => "6", "nombre_tipo_servicio" => "RECOLECCIÓN DE BASURA"],
                ["id_tipo_servicio" => "7", "nombre_tipo_servicio" => "RETIRO DE ANIMALES MUERTOS"]
            ],
        ],
        "3" => [
            'name' => 'Obras Publicas',
            'subservices' => [
                ["id_tipo_servicio" => "14", "nombre_tipo_servicio" => "* BACHES"],
                ["id_tipo_servicio" => "42", "nombre_tipo_servicio" => "* DESASOLVE Y REPARACIÓN DE ALCANTARILLAS PLUVIALES"],
                ["id_tipo_servicio" => "17", "nombre_tipo_servicio" => "* DESAZOLVE  Y LIMPIEZA DE ARROYOS"],
                ["id_tipo_servicio" => "29", "nombre_tipo_servicio" => "* DESAZOLVE DE LAGUNAS"],
                ["id_tipo_servicio" => "12", "nombre_tipo_servicio" => "* RASTREO DE CALLES"],
                ["id_tipo_servicio" => "13", "nombre_tipo_servicio" => "* RASTREO Y LIMPIEZA DE CAMINOS"],
                ["id_tipo_servicio" => "15", "nombre_tipo_servicio" => "* RASTREO, RELLENO Y NIVELACIÓN "],
                ["id_tipo_servicio" => "20", "nombre_tipo_servicio" => "* REPARACIÓN DE EMPEDRADO"],
                ["id_tipo_servicio" => "19", "nombre_tipo_servicio" => "* RETIRO DE MATERIAL EN V\u00cdA PUBLICA"],
                ["id_tipo_servicio" => "16", "nombre_tipo_servicio" => "* REVESTIMIENTO Y RASTREO DE CALLES Y CAMINOS DE SINDICATURA"],
                ["id_tipo_servicio" => "47", "nombre_tipo_servicio" => "BACHEO Y REENCARPETADO"],
                ["id_tipo_servicio" => "48", "nombre_tipo_servicio" => "DESASOLVE Y REPARACIÓN DE REJILLAS PLUVIALES"],
                ["id_tipo_servicio" => "49", "nombre_tipo_servicio" => "REPARACIÓN DE CALLES Y CAMINOS EMPEDRADOS"]
            ],
        ],
        "4" => [
            'name' => 'Fugas de Agua',
            'subservices' => [
                ["id_tipo_servicio" => "25", "nombre_tipo_servicio" => "DRENAJE"],
                ["id_tipo_servicio" => "21", "nombre_tipo_servicio" => "FUGAS DE AGUA"]]
        ],
        "6" => [
            'name' => 'Lotes Baldios',
            'subservices' => [
                ["id_tipo_servicio" => "31", "nombre_tipo_servicio" => "Verificacion de Casas Abandonadas"],
                ["id_tipo_servicio" => "30", "nombre_tipo_servicio" => "Verificacion de lotes", "plantilla" => ""]
            ]
        ],
        "7" => [
            'name' => 'Parques y Jardines',
            'subservices' => [
                ["id_tipo_servicio" => "33", "nombre_tipo_servicio" => "Despeje de Luminarias"],
                ["id_tipo_servicio" => "57", "nombre_tipo_servicio" => "FUGAS DE AGUA EN PARQUES Y CAMELLONES"],
                ["id_tipo_servicio" => "44", "nombre_tipo_servicio" => "Limpieza de Banquetas"],
                ["id_tipo_servicio" => "56", "nombre_tipo_servicio" => "LIMPIEZA DE CAMELLONES"],
                ["id_tipo_servicio" => "32", "nombre_tipo_servicio" => "Limpieza de Parques Y Áreas Verdes"],
                ["id_tipo_servicio" => "34", "nombre_tipo_servicio" => "Rehabilitación y Pintura de Juegos Infantiles"],
                ["id_tipo_servicio" => "58", "nombre_tipo_servicio" => "RETIRO DE ARBOLES CAIDOS"],
                ["id_tipo_servicio" => "43", "nombre_tipo_servicio" => "Retiro de Basura de Parques"]
            ]
        ],
        "8" => [
            'name' => 'Inspeccion y Vigilancia',
            'subservices' => [
                ["id_tipo_servicio" => "38", "nombre_tipo_servicio" => "Chequeo de Ganado Vago"],
                ["id_tipo_servicio" => "36", "nombre_tipo_servicio" => "Inconformidad de Vecinos"],
                ["id_tipo_servicio" => "35", "nombre_tipo_servicio" => "Supervision de Obras en Construccion"],
                ["id_tipo_servicio" => "37", "nombre_tipo_servicio" => "Supervision de Vendedores Ambulantes en Via Publica"]
            ]
        ],
        "9" => [
            'name' => 'Seguridad Publica',
            'subservices' => [
                ["id_tipo_servicio" => "39", "nombre_tipo_servicio" => "Inspeccion de Carros Abandonados"],
                ["id_tipo_servicio" => "41", "nombre_tipo_servicio" => "Inspeccion de Perros Bravos"],
                ["id_tipo_servicio" => "40", "nombre_tipo_servicio" => "Rondines policiacos"]
            ]
        ],
        "10" => [
            'name' => 'Denuncias Administrativas',
            'subservices' => [
                ["id_tipo_servicio" => "45", "nombre_tipo_servicio" => "Denuncia"]
            ]
        ],
        "12" => [
            'name' => 'Drenajes y Sistemas Pluviales',
            'subservices' => [
                ["id_tipo_servicio" => "52", "nombre_tipo_servicio" => "DESAZOLVE DE LAGUNAS"],
                ["id_tipo_servicio" => "55", "nombre_tipo_servicio" => "FUGAS DE AGUA DE DRENAJE PLUVIAL"],
                ["id_tipo_servicio" => "51", "nombre_tipo_servicio" => "LIMPIEZA DE ARROYOS"],
                ["id_tipo_servicio" => "59", "nombre_tipo_servicio" => "LIMPIEZA RE REJILLAS"],
                ["id_tipo_servicio" => "50", "nombre_tipo_servicio" => "RASTREO, RELLENO Y NIVELACIÓN"],
                ["id_tipo_servicio" => "53", "nombre_tipo_servicio" => "RETIRO DE MATERIAL EN LA VIA P\u00daBLICA"],
                ["id_tipo_servicio" => "54", "nombre_tipo_servicio" => "REVESTIMIENTO Y RASTREO DE CALLES Y CAMINOS EN SINDICATURAS"]
            ]
        ],

        "13" => [
            'name' => 'Dirección de Movilidad',
            'subservices' => [
                ["id_tipo_servicio" => "60","nombre_tipo_servicio" => "Instalación de Boyas en V\u00edas P\u00fablicas"],
                ["id_tipo_servicio" => "62","nombre_tipo_servicio" => "Instalación de Señalamientos Verticales en Vialidades"],
                ["id_tipo_servicio" => "61","nombre_tipo_servicio" => "Instalación de Vialetas en V\u00edas P\u00fablicas"],
                ["id_tipo_servicio" => "65","nombre_tipo_servicio" => "Pintado de Guarniciones de Vialidades y Parques P\u00fablicos"],
                ["id_tipo_servicio" => "64","nombre_tipo_servicio" => "Pintado de Pasos Peatonales"],
                ["id_tipo_servicio" => "63","nombre_tipo_servicio" => "Pintado de Señalamiento Horizontal en Vialidades"],
                ["id_tipo_servicio" => "66","nombre_tipo_servicio" => "Pintado y Señalamiento de Espacios para Discapacitados con Dictamen Previo del DIF Estatal"]]
        ]
    ];

    public function toId($service_name): int
    {
        foreach (self::SERVICE_NAMES_IDS as $key => $department) {
            if ($department['name'] == $service_name) {
                return $key;
            }
        }

        throw new \Exception('Service name not found');

    }

    public function getServiceIdBySubserviceId(int $subservice_id): string
    {
        foreach (self::SERVICE_NAMES_IDS as $key => $department) {
            foreach ($department['subservices'] as $subservice) {
                if ($subservice['id_tipo_servicio'] == $subservice_id) {
                    return $key;
                }
            }
        }

        throw new \Exception('Subservice id not found');
    }

    public function toName(int $service_id): string
    {
        return self::SERVICE_NAMES_IDS[$service_id]['name'];
    }

    public function getServicesOptions(int $department_id): array
    {
        return self::SERVICE_NAMES_IDS[$department_id]['subservices'];
    }

    public static function getServicesNames(): array
    {
        $services = [];
        foreach (self::SERVICE_NAMES_IDS as $key => $department) {
            $services[$key] = $department['name'];
        }
        return $services;
    }

    public static function getServiceTypesNames(): array
    {
        $services = [];
        foreach (self::SERVICE_NAMES_IDS as $key => $department) {
            foreach ($department['subservices'] as $subservice) {
                $services[$subservice['id_tipo_servicio']] = $subservice['nombre_tipo_servicio'];
            }
        }

        return $services;
    }
}
