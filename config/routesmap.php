<?php
$get = [
    '/'             => [Home::class, 'home'],
    '/plans'        => [Home::class, 'plans'],
    '/payments'     => [Home::class, 'payments'],
    '/terms'        => [Home::class, 'terms'],
    '/policy'       => [Home::class, 'policy'],
    '/startuse'     => [Home::class, 'startuse'],
    '/capabilities' => [Home::class, 'capabilities'],
    '/templates'    => [Home::class, 'templates'],
    '/lists'        => [Home::class, 'lists'],
    '/about'        => [Home::class, 'about'],
    '/cooperation'  => [Home::class, 'cooperation'],
    '/bankdetails'  => [Home::class, 'bankdetails'],
    '/feedback'     => [Home::class, 'feedback'],
    '/login'        => [Auth::class, 'login'],
];
$post = [
    '/feedback'     => [Home::class, 'feedback'],
    '/login'        => [Auth::class, 'login'],
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