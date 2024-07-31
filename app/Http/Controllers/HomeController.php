<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Alumni;
use App\Models\Carousel;
use App\Models\Dashboard;
use App\Models\Sorotan;
use App\Models\Talenta;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // $ongoings = Ongoing::all();
        // $upcomings = Upcoming::all();
        // $moments = Moment::all();
        // $contacts = Contact::first();

        $agendas = Agenda::all();
        $talentas = Talenta::all();
        $sorotans = Sorotan::all();
        $alumnis = Alumni::all();
        $dashboards = Dashboard::all();
        $carousels = Carousel::all();

        return view('user.landingpage', compact(
            'agendas',
            'talentas',
            'sorotans',
            'alumnis',
            'dashboards',
            'carousels',
        ));
    }
}
