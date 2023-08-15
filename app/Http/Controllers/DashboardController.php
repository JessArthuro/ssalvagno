<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $currentDate = Carbon::now()->locale('es_ES');
        $weekday = ucfirst($currentDate->isoFormat('dddd'));
        $day = $currentDate->format('d');
        $month = mb_convert_case($currentDate->isoFormat('MMMM'), MB_CASE_TITLE, 'UTF-8');
        $formattedDate = "{$weekday}, {$day} de {$month}";

        $welcomeMessage = $this->welcomeMessage();
        return view('dashboard', compact('formattedDate', 'welcomeMessage'));
    }

    public function welcomeMessage()
    {
        $currentHour = Carbon::now()->hour;

        if ($currentHour >= 6 && $currentHour < 12) {
            $message = 'Buenos días';
        } elseif ($currentHour >= 12 && $currentHour < 19) {
            $message = 'Buenos tardes';
        } else {
            $message = 'Buenos noches';
        }

        return $message;
    }
}
