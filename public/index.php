<?php

set_include_path(get_include_path() . PATH_SEPARATOR . '../src/');

spl_autoload_register();

$form = new DP\Form\Form('contato');
$form->setAttribute('method', 'post');
$form->setAttribute('action', '/contato/index');

$inputText = new DP\Form\Input('nome');
$inputText->setAttribute('type', 'text')
            ->setAttribute('required', 'required');            

$inputSubmit = new DP\Form\Input('enviar');
$inputSubmit->setAttribute('type', 'submit')                
                ->setAttribute('value', 'Enviar');

$textArea = new DP\Form\TextArea('descricao');

$textArea->setAttribute('rows', '4')
            ->setAttribute('cols', '50');

$select = new \DP\Form\Select('cidade');
$select->setOptions(array('Sao Paulo', 'Rio de Janeiro', 'Manaus', 'Belo Horizonte'));

$form->addElement($inputText);
$form->addElement($inputSubmit);
$form->addElement($textArea);
$form->addElement($select);

echo 'Formulario de Exemplo<br/>';
echo $form->openTag();
echo 'Nome: ',$form->render('nome');

echo '<br />';
echo 'Cidade: ', $form->render('cidade');
echo '<br />';
echo 'Descricao: ', $form->render('descricao');

echo $form->closeTag();

