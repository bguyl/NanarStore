<?php

use Symfony\Component\HttpFoundation\Request;
use NanarStore\Domain\Comment;
use NanarStore\Domain\Article;
use NanarStore\Domain\User;
use NanarStore\Form\Type\CommentType;
use NanarStore\Form\Type\ArticleType;
use NanarStore\Form\Type\UserType;

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

// Edit an existing comment
$app->match('/admin/comment/{id}/edit', function($id, Request $request) use ($app) {
	$categories = $app['dao.category']->findAll();
    $comment = $app['dao.comment']->find($id);
    $commentForm = $app['form.factory']->create(new CommentType(), $comment);
    $commentForm->handleRequest($request);
    if ($commentForm->isSubmitted() && $commentForm->isValid()) {
        $app['dao.comment']->save($comment);
        $app['session']->getFlashBag()->add('success', 'The comment was succesfully updated.');
    }
    return $app['twig']->render('comment_form.html.twig', array(
        'categories' => $categories,
		'title' => 'Edit comment',
        'commentForm' => $commentForm->createView()));
});

// Remove a comment
$app->get('/admin/comment/{id}/delete', function($id, Request $request) use ($app) {
    $app['dao.comment']->delete($id);
    $app['session']->getFlashBag()->add('success', 'The comment was succesfully removed.');
    return $app->redirect('/admin');
});


// Add a user
$app->match('/admin/user/add', function(Request $request) use ($app) {
	$categories = $app['dao.category']->findAll();
    $user = new User();
    $userForm = $app['form.factory']->create(new UserType(), $user);
    $userForm->handleRequest($request);
    if ($userForm->isSubmitted() && $userForm->isValid()) {
        // generate a random salt value
        $salt = substr(md5(time()), 0, 23);
        $user->setSalt($salt);
        $plainPassword = $user->getPassword();
        // find the default encoder
        $encoder = $app['security.encoder.digest'];
        // compute the encoded password
        $password = $encoder->encodePassword($plainPassword, $user->getSalt());
        $user->setPassword($password);
        $app['dao.user']->save($user);
        $app['session']->getFlashBag()->add('success', 'The user was successfully created.');
    }
    return $app['twig']->render('user_form.html.twig', array(
		'categories' => $categories,
        'title' => 'New user',
        'userForm' => $userForm->createView()));
});

// Edit an existing user
$app->match('/admin/user/{id}/edit', function($id, Request $request) use ($app) {
	$categories = $app['dao.category']->findAll();
    $user = $app['dao.user']->find($id);
    $userForm = $app['form.factory']->create(new UserType(), $user);
    $userForm->handleRequest($request);
    if ($userForm->isSubmitted() && $userForm->isValid()) {
        $plainPassword = $user->getPassword();
        // find the encoder for the user
        $encoder = $app['security.encoder_factory']->getEncoder($user);
        // compute the encoded password
        $password = $encoder->encodePassword($plainPassword, $user->getSalt());
        $user->setPassword($password);
        $app['dao.user']->save($user);
        $app['session']->getFlashBag()->add('success', 'The user was succesfully updated.');
    }
    return $app['twig']->render('user_form.html.twig', array(
		'categories' => $categories,
        'title' => 'Edit user',
        'userForm' => $userForm->createView()));
});

// Remove a user
$app->get('/admin/user/{id}/delete', function($id, Request $request) use ($app) {
    // Delete all associated comments
    $app['dao.comment']->deleteAllByUser($id);
    // Delete the user
    $app['dao.user']->delete($id);
    $app['session']->getFlashBag()->add('success', 'The user was succesfully removed.');
    return $app->redirect('/admin');
});

// Category page
$app->get('/category/{name}', function($name, Request $request) use ($app) {
  $categories = $app['dao.category']->findAll();
  //Find articles by categories
  $articles = $app['dao.article']->findByCategory($name);
  return $app['twig']->render('category.html.twig', array(
      'name' => $name,
      'articles' => $articles,
      'categories' => $categories));
})
->bind('category');

// Basket page
$app->get('/basket', function(Request $request) use ($app) {
  $categories = $app['dao.category']->findAll();
  //Get the current user
  $user = $app['security']->getToken()->getUser();
  //Find the order
  $val1 = $user.getId();
  $order = $app['dao.order']->find($val1, 1);
  return $app['twig']->render('basket.html.twig', array(
      'order' => $order,
      'categories' => $categories));
});
