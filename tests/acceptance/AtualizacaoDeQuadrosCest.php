<?php 

class AtualizacaoDeQuadrosCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function teste(AcceptanceTester $I)		
    {
		
		$I->amOnPage('hotsite/view/?url=teste');		
		$I->wait(20);
		$I->click('Logout');				
		$I->amOnPage('hotsite/view/?url=teste');         		
		$I->click('Login');		
	    $I->fillField('login', 'teste');	
	    $I->fillField('senha', 'teste');
		$I->click('Enviar Login');
		$I->amOnPage('hotsite/view/?url=teste');         			    
		$I->click('edit');
		$I->fillField('modal_titulo', 'Titulo  Alterado');
		$I->fillField('modal_html', '<h3> Teste alterado </h3>');        
		$I->click('Salvar');
		$I->amOnPage('hotsite/view/?url=teste');   
		$I->see('Titulo  Alterado');
		$I->see('Teste alterado');	 		 
				
    }
}
