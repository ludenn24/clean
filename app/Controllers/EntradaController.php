<?php

namespace App\Controllers;

use App\Models\Entrada;
use App\Controllers\Controller;
use Psr\Http\Message\ServerRequestInterface as Request;
use Respect\Validation\Validator as v;
use Illuminate\Database\Capsule\Manager as DB;

Class EntradaController extends Controller {

    public function Registrar($request, $response, $args) {
        try {
        Entrada::create([
            'nombre' => $request->getParam('first_name'),
            'apellidos' => $request->getParam('last_name'),
            'telefono' => $request->getParam('contact_no'),
            'correo' => $request->getParam('email'),
            'servicio' => $request->getParam('service'),
            'estado' => 1,
        ]);
        $mensaje['response'] = 'success';
        } catch (ErrorException $e) {
        $mensaje['response'] = 'error';
        }
        echo json_encode($mensaje);
    }

    public function Listar($request, $response, $args) {
        try {
            $categoria = $request->getParam('categoria');
            $data = Entrada::where('categoria', '=', $categoria)
                    ->where('estado', '!=', 3)
                    ->orderBy('created_at', 'DESC')->get();
            $arreglo["data"] = $data;
            return $this->response->withJson($arreglo);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 500);
        }
    }

}
