<?php

namespace App\Exports;

use App\Models\Cotizacion;
use Illuminate\Contracts\View\View;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CotizacionesExport implements FromView, ShouldAutoSize
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
}
