<?php
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

$app->get('/', 'HomeController:index')->setName('home');
$app->post('/registrar', 'EntradaController:Registrar');
$app->group('', function () {
    $this->get('/admin/auth', 'AdminController:getSignIn')->setName('admin.signin');
    $this->post('/admin/auth', 'AdminController:postSignIn');
})->add(new GuestMiddleware($container));
$app->group('/admin', function () {
    $this->get('/listamenu', 'MenuCategoriaController:getMenuCategory');
    $this->get('/dash', 'AdminController:getViewDash')->setName('admin.dash');
    $this->get('/listaitem', 'MenuItemController:getMenuItem');
    $this->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');
    $this->get('/reportes', 'AdminController:getEntradaReportes')->setName('admin.reportes');
    $this->get('/materiales', 'AdminController:getEntradaDatos')->setName('admin.datos');
    $this->get('/entrada/editar', 'EntradaController:getEntrada');
    $this->get('/entrada/listar', 'EntradaController:Listar');
    $this->post('/entrada/registrar', 'EntradaController:Registrar');
})->add(new AuthMiddleware($container));