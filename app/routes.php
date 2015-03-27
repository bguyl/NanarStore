<?php

use Symfony\Component\HttpFoundation\Request;


// Home page
$app->get('/', function () use ($app) {
    $articles = $app['dao.article']->findAll();
    $categories = $app['dao.category']->findAll();
    return $app['twig']->render('index.html.twig', array('articles' => $articles, 'categories' => $categories));

});	
	
// Detailed info about an article
$app->get('/article/{id}', function ($id) use ($app) {
    $article = $app['dao.article']->find($id);
    $categories = $app['dao.category']->findAll();
    $comments = $app['dao.comment']->findAllByArticle($id);
    return $app['twig']->render('article.html.twig', array(
        'article' => $article,
        'categories' => $categories,
        'comments' => $comments
    ));

});

// Login form
$app->get('/login', function(Request $request) use ($app) {
    $categories = $app['dao.category']->findAll();
    return $app['twig']->render('login.html.twig', array(
        'categories' => $categories,
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username')
    ));
})->bind('login');  // named route so that path('login') works in Twig templates
