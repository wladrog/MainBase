<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HolidayController extends Controller
{
    public function index()
    {
        // Konsumpcja API – pobranie świąt zewnętrznych
        $response = Http::get('https://date.nager.at/api/v3/PublicHolidays/2025/PL');

        if ($response->successful()) {
            $holidays = $response->json();
        } else {
            $holidays = []; // Awaryjnie – pusta tablica
        }

        return view('holidays', ['holidays' => $holidays]);
    }
}

