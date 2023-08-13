<?php

namespace App\Exports;

use App\Models\Cotizacion;
use Illuminate\Contracts\View\View;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CotizacionesExport implements FromView, ShouldAutoSize, WithStyles
{
    protected $quote;

    public function __construct($quote)
    {
        $this->quote = $quote;
    }

    public function view(): View
    {
        $this->quote->load('servicios.huespedes');

        // Agrupar huespedes por nombre y sumarizar desayunos, comidas y cenas
        $groupedHuespedes = [];

        foreach ($this->quote->servicios as $servicio) {
            foreach ($servicio->huespedes as $huesped) {
                $nombreHuesped = $huesped->nombre_h;

                if(!isset($groupedHuespedes[$nombreHuesped])){
                    $groupedHuespedes[$nombreHuesped] = [
                        'desayunos' => 0,
                        'comidas' => 0,
                        'cenas' => 0,
                    ];
                }

                $groupedHuespedes[$nombreHuesped]['desayunos'] += $huesped->desayunos;
                $groupedHuespedes[$nombreHuesped]['comidas'] += $huesped->comidas;
                $groupedHuespedes[$nombreHuesped]['cenas'] += $huesped->cenas;
                $groupedHuespedes[$nombreHuesped]['embarcacion'] = $huesped->embarcacion->nombre;
            }
        }

        return view('quotes.excel', [
            'quote' => $this->quote,
            'groupedHuespedes' => $groupedHuespedes,
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            'B2' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
                'font' => [
                    'size' => 18,
                ],
            ],
            '4' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => [
                        'rgb' => '002060',
                    ],
                ],
                'font' => [
                    'color' => [
                        'rgb' => 'FFFFFF',
                    ],
                ],
            ],
        ];
    }
}
