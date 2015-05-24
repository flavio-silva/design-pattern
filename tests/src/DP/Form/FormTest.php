<?php

namespace DP\Form;

use DP\Validator\Validator;
use DP\Request\Request;
use DP\Form\Input;
use DP\Form\Select;
use DP\Validator\InArray;
use DP\Validator\StringLength;
use DP\Validator\Currency;

class FormTest extends \PHPUnit_Framework_TestCase
{
    private $form;
    private $data;
    private $categorias;
     
    public function setUp()
    {   
        #Configuração das variáveis super globais
        $_SERVER['REQUEST_METHOD'] = 'POST';        
        $_POST = [
            'nome' => 'Notebook',
            'valor' => '2000',
            'descricao' => 'Dell Inspiron',
            'categoria' => '2'
        ];
        
        $request = new Request();
        $post = $request->getPost();
        $this->data = $post->getData();
        $this->form = new Form(new Validator($request), 'form-test');
        
        $this->categorias = [
            1 => 'Eletrodoméstico',
            2 => 'Eletrônico',
            3 => 'Cama, Mesa e Banho',
            4 => 'Brinquedos',
        ];
    }
    
    public function testVerificaAFuncionalidadeDePopularDados()
    {               
        $nome = new Input('nome');
        $nome->setAttribute('type', 'text');

        $valor = new Input('valor');
        $valor->setAttribute('type', 'text');

        $descricao = new Input('descricao');
        $descricao->setAttribute('type', 'text');

        $categoria = new Select('categoria');
        
        $this->form->createField($nome)
            ->createField($valor)
            ->createField($descricao)
            ->createField($categoria->setValueOptions($this->categorias))
        ;
        
        $this->form->populate($this->data);
        
        $this->assertEquals('Notebook', $this->form->getField('nome')->getAttribute('value'));
        $this->assertEquals('2000', $this->form->getField('valor')->getAttribute('value'));
        $this->assertEquals('Dell Inspiron', $this->form->getField('descricao')->getAttribute('value'));
        $this->assertEquals('2', $this->form->getField('categoria')->getSelected());
    }
    
    public function testVerificaAFuncionalidadeDeValidacaoDeDados()
    {
        $nome = new Input('nome');
        $nome->setAttribute('type', 'text');

        $valor = new Input('valor');
        $valor->setAttribute('type', 'text');

        $descricao = new Input('descricao');
        $descricao->setAttribute('type', 'text');

        $categoria = new Select('categoria');
        
        $this->form->createField($nome)
            ->createField($valor)
            ->createField($descricao)
            ->createField($categoria->setValueOptions($this->categorias))
        ;
        
        $inArray = new InArray();
        $inArray->setData(array_keys($this->categorias))
            ->setName('categoria')
        ;

        $stringLength = new StringLength(200);
        $stringLength->setName('descricao');
        
        $currency = new Currency();
        $currency->setName('valor');

        $this->form->getValidator()
                ->add($currency)
                ->add($inArray)
                ->add($stringLength)
        ;
        
        $this->form->populate($this->data);
        $this->assertTrue($this->form->isValid());
        
        $data = $this->data;
        $data['valor'] = 'text';
        $this->form->populate($data);
        $this->assertFalse($this->form->isValid());
      
        $data = $this->data;
        $data['descricao'] = 'O vídeo fornece uma maneira poderosa de ajudá-lo a provar seu argumento.'
        . 'Ao clicar em Vídeo Online, você pode colar o código de inserção do vídeo que deseja adicionar.'
        . 'Você também pode digitar uma palavra-chave para pesquisar online o vídeo mais adequado ao seu documento.'
        ;
        
        $this->form->populate($data);        
        $this->assertFalse($this->form->isValid());
        
        $data = $this->data;
        $data['categoria'] = 5;
        
        $this->form->populate($data);
        $this->assertFalse($this->form->isValid());
    }
    
    public function getForm()
    {
        $validator = $this->getMockBuilder('\DP\Validator\Validator')
                        ->disableOriginalConstructor()
                        ->getMock();
        
        $validator->expects($this->any())
                ->method('isValid')
                ->willReturn(true);
        
        
        return new \DP\Form\Form($validator, 'form');
    }
    
    public function testVerificaSeOTipoDaClasseEstaCorreto()
    {        
        $form = $this->getForm();
        $this->assertInstanceOf('\DP\Form\RenderTagsInterface', $form);
        $this->assertInstanceOf('\DP\Form\AbstractForm', $form);
    }
    
    public function testVerificaSeOMetodoOpenTagRetornaUmaTagValida()
    {
        $form = $this->getForm();        
        $this->assertRegExp('/^<form.*?>$/', $form->openTag());
    }
    
    public function testVerificaSeOMetodoCloseTagRetornaUmaTagValid()
    {
        $form = $this->getForm();        
        $this->assertEquals('</form>', $form->closeTag());
    }
    
    public function testVerificaSeOMetodoIsValidFunciona()
    {
        $form = $this->getForm();
        $this->assertTrue($form->isValid());
    }
    
    public function testVerificaSeOMetodoGetValidatorFunciona()
    {
        $form = $this->getForm();
        $this->assertInstanceOf('\DP\Validator\Validator',$form->getValidator());
    }
}
