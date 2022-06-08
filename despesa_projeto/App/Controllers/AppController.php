<?php

namespace App\Controllers;


use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action {


	public function timeline() {

		session_start();


		if($_SESSION['id'] != '' && $_SESSION['nome'] != '') {

			//RECUPERAÇÃO DAS DESPESAS 
			$despesa = Container::getModel('Despesa');
			$despesa->__set('id_usuario', $_SESSION['id']);
			$despesas = $despesa->getAll();

			
			//echo '<pre>'; 
			//print_r($despesas);
			//echo '</pre>';

			$this->view->despesa = $despesas;
			$this->render('timeline');
		} else {
			header('Location: /?login=erro');
		}

		
	}

	public function despesa(){

		session_start();


		if($_SESSION['id'] != '' && $_SESSION['nome'] != '') {
			
			$teste = Container::getModel('Despesa');

			$teste->__set('despesa', $_POST['despesa']);
			$teste->__set('valor', $_POST['valor']);
			$teste->__set('id_usuario', $_SESSION['id']);
			$teste->salvar();
			header('Location: /timeline');

	}else{
			header('Location: /?login=erro');
		}

	}


	
}

?>