<?php
require_once __DIR__ . '/../vendor/autoload.php';

$di = new Aura\Di\Container(new Aura\Di\Factory());
$di->set('helper-list', function () use($di) {
    return new DP\Helper\HtmlListHelper();
});

$di->set('db', new \PDO("sqlite:" . __DIR__ . "/../dp"));

$categorias = $di->set('categorias', function () use ($di) {
   $db = $di->get('db'); 
   $stmt = $db->query("select * from categoria");
   return $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    
});

$di->set('request', new DP\Request\Request());
$di->set('validator', new DP\Validator\Validator($di->get('request')));

$inArray = new DP\Validator\InArray();
$inArray->setData(array_keys($di->get('categorias')))
        ->setName('categoria');

$stringLength = new DP\Validator\StringLength(200);
$stringLength->setName('descricao');
$currency = new \DP\Validator\Currency();
$currency->setName('valor');

$validator = $di->get('validator');
$validator->add($inArray)
        ->add($stringLength)
        ->add($currency);
$di->set('contato-validator', $validator);

$di->set('form', new \DP\Form\Form($di->get('contato-validator'),'contato'));

/** @var $form \DP\Form\Form */
$form = $di->get('form');
$form->setAttribute('method', 'post');

$nome = new \DP\Form\Input('nome');
$nome->setAttribute('type', 'text');

$valor = new \DP\Form\Input('valor');
$valor->setAttribute('type', 'text');

$descricao = new \DP\Form\Input('descricao');
$descricao->setAttribute('type', 'text');

$categoria = new \DP\Form\Select('categoria');
$categoria->setValueOptions($di->get('categorias'));

$enviar = new \DP\Form\Input('enviar');
$enviar->setAttribute('type', 'submit')
    ->setAttribute('value', 'Cadastrar')
    ->setAttribute('class', 'btn-info');

$fieldset = new \DP\Form\FieldSet('contato');
$fieldset->createField($nome)
        ->createField($valor)
        ->createField($descricao)
        ->createField($categoria)
        ->createField($enviar);

$form->createField($fieldset);

/** @var $request \DP\Request\Request*/
$request = $di->get('request');

$messages = ['success' => 'The data has been submitted successfully'];
$helper = $di->get('helper-list');

if($request->isPost()) {
    $post = $request->getPost();
    $form->populate($post->getData());
    
    if(!$form->isValid()) {
        $messages = $form->getValidator()->getMessages();
    }    
}

if($request->isGet()) {
    $get = $request->getGet();
}

require_once __DIR__ . '/../src/layout/header.phtml';
require_once __DIR__ . '/../src/view/contato.phtml';
require_once __DIR__ . '/../src/layout/footer.phtml';