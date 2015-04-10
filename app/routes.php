<?php

use Symfony\Component\HttpFoundation\Request;
use NanarStore\Domain\Comment;
use NanarStore\Domain\Article;
use NanarStore\Form\Type\CommentType;
use NanarStore\Form\Type\ArticleType;

// Home page
$app->get('/', function () use ($app) {
    $articles = $app['dao.article']->findAll();
    $categories = $app['dao.category']->findAll();
    return $app['twig']->render('index.html.twig', array('articles' => $articles, 'categories' => $categories));

});

// Article details with comments
$app->match('/article/{id}', function ($id, Request $request) use ($app) {
    $article = $app['dao.article']->find($id);
    $categories = $app['dao.category']->findAll();
    $user = $app['security']->getToken()->getUser();
    $commentFormView = null;
    if ($app['security']->isGranted('IS_AUTHENTICATED_FULLY')) {
        // A user is fully authenticated : he can add comments
        $comment = new Comment();
        $comment->setArticle($article);
        $comment->setAuthor($user);
        $commentForm = $app['form.factory']->create(new CommentType(), $comment);
        $commentForm->handleRequest($request);
        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $app['dao.comment']->save($comment);
            $app['session']->getFlashBag()->add('success', 'Your comment was succesfully added.');
        }
        $commentFormView = $commentForm->createView();
    }
    $comments = $app['dao.comment']->findAllByArticle($id);
    return $app['twig']->render('article.html.twig', array(
        'article' => $article,
        'categories' => $categories,
        'comments' => $comments,
        'commentForm' => $commentFormView));
});

// Login form
$app->get('/login', function(Request $request) use ($app) {
    $categories = $app['dao.category']->findAll();
    return $app['twig']->render('login.html.twig', array(
        'categories' => $categories,
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ));
})->bind('login');  // named route so that path('login') works in Twig templates


// Admin home page
$app->get('/admin', function() use ($app) {
    $categories = $app['dao.category']->findAll();
    $articles = $app['dao.article']->findAll();
    $comments = $app['dao.comment']->findAll();
    $users = $app['dao.user']->findAll();
    return $app['twig']->render('admin.html.twig', array(
        'categories' => $categories,
        'articles' => $articles,
        'comments' => $comments,
        'users' => $users));
});

// Add a new article
$app->match('/admin/article/add', function(Request $request) use ($app) {
    $categories = $app['dao.category']->findAll();
    $article = new Article();
    $articleForm = $app['form.factory']->create(new ArticleType(), $article);
    $articleForm->handleRequest($request);
    if ($articleForm->isSubmitted() && $articleForm->isValid()) {
        $app['dao.article']->save($article);
        $app['session']->getFlashBag()->add('success', 'The article was successfully created.');
    }
    return $app['twig']->render('article_form.html.twig', array(
        'categories' => $categories,
        'title' => 'New article',
        'articleForm' => $articleForm->createView()));
});

// Edit an existing article
$app->match('/admin/article/{id}/edit', function($id, Request $request) use ($app) {
    $categories = $app['dao.category']->findAll();
    $article = $app['dao.article']->find($id);
    $articleForm = $app['form.factory']->create(new ArticleType(), $article);
    $articleForm->handleRequest($request);
    if ($articleForm->isSubmitted() && $articleForm->isValid()) {
        $app['dao.article']->save($article);
        $app['session']->getFlashBag()->add('success', 'The article was succesfully updated.');
    }
    return $app['twig']->render('article_form.html.twig', array(
        'categories' => $categories,
        'title' => 'Edit article',
        'articleForm' => $articleForm->createView()));
});

// Remove an article
$app->get('/admin/article/{id}/delete', function($id, Request $request) use ($app) {
    // Delete all associated comments
    $app['dao.comment']->deleteAllByArticle($id);
    // Delete the article
    $app['dao.article']->delete($id);
    $app['session']->getFlashBag()->add('success', 'The article was succesfully removed.');
    return $app->redirect('/admin');
});


// Categore page
$app->get('/category/{name}', function($name, Request $request) use ($app) {
  $categories = $app['dao.category']->findAll();
  //Find articles by categories
  $articles = $app['dao.article']->findAllByCategory($name);
  return $app['twig']->render('article.html.twig', array(
      'articles' => $articles,
      'categories' => $categories));
});
