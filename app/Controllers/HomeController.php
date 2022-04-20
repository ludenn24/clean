<?php

namespace App\Controllers;
use App\Models\Ollas;
use Slim\Views\Twig as View;

Class  HomeController extends Controller
{

    public function index($request, $response)
    {
        $conteo = Ollas::where('estado', 2)
            ->count();
        return $this->view->render($response, 'home.twig',[
            'contador' => $conteo,
        ]);
    }
    
     public function english($request, $response)
    {
        $conteo = Ollas::where('estado', 2)
            ->count();
        return $this->view->render($response, 'templates/english.twig',[
            'contador' => $conteo,
        ]);
    }

}
