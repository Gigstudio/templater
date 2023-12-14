<?php
use Templater\Controllers\Home;
use Templater\Controllers\Auth;
use Templater\Controllers\Workspace;
use Templater\Controllers\Edit;
use Templater\Controllers\Store;
use Templater\Controllers\Admin;
use Templater\Controllers\Service;

$get = [
    SITE_SHORT_NAME.'/construction' => [Home::class, 'construction'],
    SITE_SHORT_NAME                 => [Home::class, 'index'],
    SITE_SHORT_NAME.'/home'         => [Home::class, 'index'],
    SITE_SHORT_NAME.'/index'        => [Home::class, 'index'],
    SITE_SHORT_NAME.'/plans'        => [Home::class, 'plans'],
    SITE_SHORT_NAME.'/payments'     => [Home::class, 'payments'],
    SITE_SHORT_NAME.'/terms'        => [Home::class, 'terms'],
    SITE_SHORT_NAME.'/policy'       => [Home::class, 'policy'],
    SITE_SHORT_NAME.'/startuse'     => [Home::class, 'startuse'],
    SITE_SHORT_NAME.'/capabilities' => [Home::class, 'capabilities'],
    SITE_SHORT_NAME.'/templates'    => [Home::class, 'templates'],
    SITE_SHORT_NAME.'/lists'        => [Home::class, 'lists'],
    SITE_SHORT_NAME.'/about'        => [Home::class, 'about'],
    SITE_SHORT_NAME.'/cooperation'  => [Home::class, 'cooperation'],
    SITE_SHORT_NAME.'/bankdetails'  => [Home::class, 'bankdetails'],
    SITE_SHORT_NAME.'/feedback'     => [Home::class, 'feedback'],
    // SITE_SHORT_NAME.'/login'        => [Auth::class, 'login'],
];
$post = [
    SITE_SHORT_NAME.'/feedback'     => [Home::class, 'feedback'],
    // SITE_SHORT_NAME.'/login'        => [Auth::class, 'login'],
];
// $routes = [
//     ['get',	SITE_SHORT_NAME.'/', [Home::class, 'home']],
//     ['get',	SITE_SHORT_NAME.'/index', [Home::class, 'home']],
//     ['get',	SITE_SHORT_NAME.'/plans', [Home::class, 'plans']],
//     ['get',	SITE_SHORT_NAME.'/payments', [Home::class, 'payments']],
//     ['get',	SITE_SHORT_NAME.'/terms', [Home::class, 'terms']],
//     ['get',	SITE_SHORT_NAME.'/policy', [Home::class, 'policy']],
//     ['get',	SITE_SHORT_NAME.'/startuse', [Home::class, 'startuse']],
//     ['get',	SITE_SHORT_NAME.'/capabilities', [Home::class, 'capabilities']],
//     ['get',	SITE_SHORT_NAME.'/templates', [Home::class, 'templates']],
//     ['get',	SITE_SHORT_NAME.'/lists', [Home::class, 'lists']],
//     ['get',	SITE_SHORT_NAME.'/about', [Home::class, 'about']],
//     ['get',	SITE_SHORT_NAME.'/cooperation', [Home::class, 'cooperation']],
//     ['get',	SITE_SHORT_NAME.'/bankdetails', [Home::class, 'bankdetails']],
//     ['get',	SITE_SHORT_NAME.'/feedback', [Home::class, 'feedback']],
//     // ['get',	SITE_SHORT_NAME.'/login/{id}', [Auth::class, 'login']],
//     ['get',	SITE_SHORT_NAME.'/login', [Auth::class, 'login']],
//     ['post', SITE_SHORT_NAME.'/login', [Auth::class, 'login']]
// ];