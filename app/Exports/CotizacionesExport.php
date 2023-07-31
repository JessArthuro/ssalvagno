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
    protected $services;

    public function __construct($quote)
    {
        $this->quote = $quote;
        $this->services = $quote->servicios;
    }

    public function view(): View
    {
        return view('quotes.excel', [
            'quote' => $this->quote,
            'services' => $this->services
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
            // 'td.subtotal-cell' => [
            //     'alignment' => [
            //         'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
            //     ],
            // ],
        ];
    }
}
