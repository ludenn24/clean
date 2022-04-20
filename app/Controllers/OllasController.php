<?php

namespace App\Controllers;

use App\Helper\JsonRequest;
use App\Helper\JsonRenderer;

use App\Models\Ollas;use App\Models\OllasSimple;
use App\Controllers\Controller;
use Illuminate\Database\Capsule\Manager as DB;
use Respect\Validation\Validator as v;



Class OllasController extends Controller
{

    //VARIANTE DE ALERTAS
    function show($type,$string)
    {
        $div='';
        if($type==1){
            $div='<div class="alert alert-danger" role="alert">
                  <a href="#" class="alert-link">'.$string.'</a>
                </div>';
        }
        if($type==2){
            $div='<div id="login-status" class="warn-notice">
            <div class="content-wrapper">
                <div id="login-detail">
                    <div id="login-status-icon-container"><i class="fa fa-exclamation-triangle"></i></div>
                    <div id="login-status-message">'.$string.'</div>
                </div>
            </div>
        </div>';
        }

        if($type==3){
            $div='<div id="login-status" class="info-notice">
            <div class="content-wrapper">
                <div id="login-detail">
                    <div id="login-status-icon-container"><span class="login-status-icon"></span></div>
                    <div id="login-status-message">'.$string.'</div>
                </div>
            </div>
        </div>';
        }

        if($type==4){
            $div='<div class="alert alert-success"><i class="fa fa-check"></i> '.$string.'</div>';
        }
        return $div;
    }


    public function getViewOlla($request, $response)
    {
        return $this->view->render($response, 'templates/ollas.twig');
    }
    
    public function getViewOllasCasas($request, $response)
    {
        return $this->view->render($response, 'templates/ollascasas.twig');
    }
    
    public function getViewRegistro($request, $response)
    {
        return $this->view->render($response, 'templates/registro.twig');
    }		 public function getViewRegistroSimple($request, $response)    {        return $this->view->render($response, 'templates/registro-simple.twig');    }

    public function getListOllas($request, $response, $args)
    {
        $distrito = $request->getParam('distrito');
        try {
            $data = Ollas::select('tb_ollas_excel.*', 'tb_distritos.distrito')
           ->join('tb_distritos', 'tb_ollas_excel.distrito', '=', 'tb_distritos.idDist')
            ->where(function ($q) use($distrito) {
                 if ($distrito) {
                     $q->where('tb_ollas_excel.distrito', 'like', $distrito);
                 }
             })
           ->where('tb_ollas_excel.estado','=',2)
            ->get();
            return $this->response->withJson($data, 200);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 500);
        }

    }
    
    public function getListOllasCasas($request, $response, $args)
    {
        try {
            $data = Ollas::select('tb_ollas_excel.*', 'tb_distritos.distrito')
           ->join('tb_distritos', 'tb_ollas_excel.distrito', '=', 'tb_distritos.idDist')
           ->where('tb_ollas_excel.estado','=',2)
            ->orWhere('tb_ollas_excel.estado','=',5)
            ->get();
            return $this->response->withJson($data, 200);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 500);
        }

    }

    public function getOllas()
    {
        return Ollas::select('tb_ollas_excel.*', 'tb_distritos.distrito')
       ->join('tb_distritos', 'tb_ollas_excel.distrito', '=', 'tb_distritos.idDist')
       ->where('tb_ollas_excel.estado','=',1)->get();
    }

    public function getOlla($request, $response, $args)
    {
        try {
            $id = $request->getParam('codigo');
            $data = Ollas::where('id','=',$id)->get();
            return $this->response->withJson($data, 200);

        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 200);
        }

    }
    
   
    public function Listar($request, $response, $args) {
        try {
            $data = Ollas::select('tb_ollas_excel.*',
                                'tb_distritos.distrito as nomdis')
                                ->join('tb_distritos', 'tb_ollas_excel.distrito', '=', 'tb_distritos.idDist')
                                ->where('tb_ollas_excel.estado', '!=', 4)
                                ->where('tb_ollas_excel.estado', '!=', 5)
                                ->orderBy('tb_ollas_excel.id', 'DESC')
                                ->get();
            $arreglo["data"] = $data;
            return $this->response->withJson($arreglo);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 500);
        }
    }

     
    public function ListaDistrital($request, $response, $args) {
        $ses_codigo = isset($_SESSION['distrito']) ? $_SESSION['distrito'] : '';
        try {
            $data = Ollas::select('tb_ollas_excel.*','tb_distritos.distrito as nomdis')
                                ->join('tb_distritos', 'tb_ollas_excel.distrito', '=', 'tb_distritos.idDist')
                                ->where('tb_ollas_excel.distrito', '=', $ses_codigo)
                                ->where('tb_ollas_excel.estado', '!=', 4)
                                ->where('tb_ollas_excel.estado', '!=', 5)
                                ->orderBy('tb_ollas_excel.id', 'DESC')
                                ->get();
            $arreglo["data"] = $data;
            return $this->response->withJson($arreglo);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 500);
        }
    }
	public function ListaSimple($request, $response, $args) {                try {            $data = OllasSimple::select('tb_ollas_simple.*','tb_distritos.distrito as nomdis')                                ->join('tb_distritos', 'tb_ollas_simple.distrito', '=', 'tb_distritos.idDist')                                ->orderBy('tb_ollas_simple.codigo', 'DESC')                                ->get();            $arreglo["data"] = $data;            return $this->response->withJson($arreglo);        } catch (ErrorException $e) {            $data = "Hubo un error al listar los datos.";            return $this->response->withJson($data, 500);        }    }

    public function Actualizar($request, $response, $args)
    {
        $codigo=$request->getParam('id');

            Ollas::where('id', '=', $codigo)->update([
            'distrito'=> $request->getParam('distrito'),
            'zona'=> $request->getParam('zona'),
            'aahh'=> $request->getParam('aahh'),
            'ubicacion'=> $request->getParam('ubicacion'),
            'nombre_olla'=> $request->getParam('nombre_olla'),
            'padrones'=> $request->getParam('padrones'),
            'comedorpopular'=> $request->getParam('comedorpopular'),
            'comite'=> '---',
            'nombre_contacto'=> $request->getParam('nombre_contacto'),
            'cargo_contacto'=> $request->getParam('cargo_contacto'),
            'celular_contacto'=> $request->getParam('celular_contacto'),
            'nombre_contacto_secundario'=> $request->getParam('nombre_contacto_secundario'),
            'cargo_contacto_secundario'=> '---',
            'celular_contacto_secundario'=> $request->getParam('celular_contacto_secundario'),
                'fecha_creacion'=> $request->getParam('fecha_creacion'),
            'agua'=> $request->getParam('agua'),
            'luz'=> $request->getParam('luz'),
            'presencia_muni'=> $request->getParam('presencia_muni'),
            'tipo_espacio'=> $request->getParam('tipo_espacio'),
            'estado_espacio'=> $request->getParam('estado_espacio'),
            'combustible'=> $request->getParam('combustible'),
            'techo'=> $request->getParam('techo'),
            'lavado'=> $request->getParam('lavado'),
            'higiene'=> $request->getParam('higiene'),
            'instrumentos'=> $request->getParam('instrumentos'),
            'insumos'=> $request->getParam('insumos'),
            'org_ayuda'=> $request->getParam('org_ayuda'),
            'dias_atencion'=> $request->getParam('dias_atencion'),
            'comidas_dia'=> $request->getParam('comidas_dia'),
            'raciones'=> $request->getParam('raciones'),
            'precio_racion'=> $request->getParam('precio_racion'),
            'raciones_pagadas'=> $request->getParam('raciones_pagadas'),
            'zonas_beneficiadas'=> $request->getParam('zonas_beneficiadas'),
            'familias_beneficiadas'=> $request->getParam('familias_beneficiadas'),
            'ninos_beneficiadas'=> $request->getParam('ninos_beneficiadas'),
            'adultos_beneficiadas'=> $request->getParam('adultos_beneficiadas'),
            'disca_beneficiadas'=> $request->getParam('disca_beneficiadas'),
            'emba_beneficiadas'=> $request->getParam('emba_beneficiadas'),
            'enfercro_beneficiadas'=> $request->getParam('enfercro_beneficiadas'),
            'observaciones'=> $request->getParam('observaciones'),
            'total_beneficiadas'=> $request->getParam('total_beneficiadas'),
             'extranjera'=> $request->getParam('extranjera'),
            'huerto'=> $request->getParam('huerto'),
            'espacio_huerto'=> $request->getParam('espacio_huerto'),
            'liderazgo'=> $request->getParam('liderazgo'),
            'inocuidad'=> $request->getParam('inocuidad'),
            'protocolos'=> $request->getParam('protocolos'),
            'otro_cap'=> $request->getParam('otro_cap'),
            'latitud'=> $request->getParam('latitud_editar'),
            'longitud'=> $request->getParam('longitud_editar'),
            'estado'=> $request->getParam('estado'),
            ]);
            $mensaje = $codigo.'?'.$this->show('4', 'Olla actualizada correctamente.');
            echo json_encode($mensaje);


    }

    public function Registrar($request, $response, $args)
    {

        $carpeta = "uploads/";
        $nombre = basename($_FILES["file"]["name"]);
        $fecha_actual = date('Y-m-d-H-i-s');
        $src = $carpeta .  $fecha_actual. '_' . $nombre;
        $tipo = basename($_FILES["file"]["type"]);
        $size = basename($_FILES["file"]["size"]);
        $moveee = $_FILES["file"]["tmp_name"];

        if ($tipo != 'png' and
            $tipo != 'jpg' and
            $tipo != 'jpeg' and
            $tipo != 'pdf') {

            $mensaje['response'] = 'error';
            $mensaje['message'] = $this->show('1','Solo se permiten archivos JPG, JPEG o PNG.');

        } elseif ($size >= 262144000) {

            $mensaje['response'] = 'error';
            $mensaje['message'] = $this->show('1','Solo se permiten subir imágenes de menos de 25 Megabytes.');

        } elseif (move_uploaded_file($moveee, $src)) {


        Ollas::create([

            'distrito'=> $request->getParam('distrito'),
            'zona'=> $request->getParam('zona'),
            'aahh'=> $request->getParam('aahh'),
            'ubicacion'=> $request->getParam('ubicacion'),
            'nombre_olla'=> $request->getParam('nombre_olla'),
            'padrones'=> $request->getParam('padrones'),
            'comedorpopular'=> $request->getParam('comedorpopular'),
            'comite'=> '---',
            'nombre_contacto'=> $request->getParam('nombre_contacto'),
            'cargo_contacto'=> $request->getParam('cargo_contacto'),
            'celular_contacto'=> $request->getParam('celular_contacto'),
            'nombre_contacto_secundario'=> $request->getParam('nombre_contacto_secundario'),
            'cargo_contacto_secundario'=> '---',
            'celular_contacto_secundario'=> $request->getParam('celular_contacto_secundario'),
                'fecha_creacion'=> $request->getParam('fecha_creacion'),
            'agua'=> $request->getParam('agua'),
            'luz'=> $request->getParam('luz'),
            'presencia_muni'=> $request->getParam('presencia_muni'),
            'tipo_espacio'=> $request->getParam('tipo_espacio'),
            'estado_espacio'=> $request->getParam('estado_espacio'),
            'combustible'=> $request->getParam('combustible'),
            'techo'=> $request->getParam('techo'),
            'lavado'=> $request->getParam('lavado'),
            'higiene'=> $request->getParam('higiene'),
            'instrumentos'=> $request->getParam('instrumentos'),
            'insumos'=> $request->getParam('insumos'),
            'org_ayuda'=> $request->getParam('org_ayuda'),
            'dias_atencion'=> $request->getParam('dias_atencion'),
            'comidas_dia'=> $request->getParam('comidas_dia'),
            'raciones'=> $request->getParam('raciones'),
            'precio_racion'=> $request->getParam('precio_racion'),
            'raciones_pagadas'=> $request->getParam('raciones_pagadas'),
            'zonas_beneficiadas'=> $request->getParam('zonas_beneficiadas'),
            'familias_beneficiadas'=> $request->getParam('familias_beneficiadas'),
            'ninos_beneficiadas'=> $request->getParam('ninos_beneficiadas'),
            'adultos_beneficiadas'=> $request->getParam('adultos_beneficiadas'),
            'disca_beneficiadas'=> $request->getParam('disca_beneficiadas'),
            'emba_beneficiadas'=> $request->getParam('emba_beneficiadas'),
            'enfercro_beneficiadas'=> $request->getParam('enfercro_beneficiadas'),
            'observaciones'=> $request->getParam('observaciones'),
            'total_beneficiadas'=> $request->getParam('total_beneficiadas'),
             'extranjera'=> $request->getParam('extranjera'),
                'migrante_atencion'=> $request->getParam('migrante_atencion'),
            'huerto'=> $request->getParam('huerto'),
            'espacio_huerto'=> $request->getParam('espacio_huerto'),
            'liderazgo'=> $request->getParam('liderazgo'),
            'inocuidad'=> $request->getParam('inocuidad'),
            'protocolos'=> $request->getParam('protocolos'),
            'otro_cap'=> $request->getParam('otro_cap'),
            'foto'=> $src,
            'latitud'=> $request->getParam('latitud'),
            'longitud'=> $request->getParam('longitud'),
        ]);

            $mensaje['response'] = 'success';
            $mensaje['message'] = $this->show('4', 'Olla común registrada correctamente');

        }

        echo json_encode($mensaje);
    }
    public function RegistrarSimple($request, $response, $args)    {          try {               OllasSimple::create([                    'distrito'=> $request->getParam('distrito'),                    'nombre_olla'=> $request->getParam('nombre_olla'),                    'nombre_contacto'=> $request->getParam('nombre_contacto'),                    'celular_contacto'=> $request->getParam('celular_contacto'),                    'raciones'=> $request->getParam('raciones'),                ]);            $mensaje['response'] = 'success';            $mensaje['message'] = $this->show('4', 'Olla común registrada correctamente');            echo json_encode($mensaje);        } catch (ErrorException $e) {            $mensaje['response'] = "error";            $mensaje['message'] = $this->show('4', 'Ocurrió un error, inténtelo nuevamente');            echo json_encode($mensaje);        }    }

}
