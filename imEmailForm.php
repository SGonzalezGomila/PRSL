<?php
if(substr(basename($_SERVER['PHP_SELF']), 0, 11) == "imEmailForm") {
	include './x5engine.php';
	$form = new ImForm();
	$form->setField('Nombre', $_POST['imObjectForm_1_1'], '', false);
	$form->setField('teléfono', $_POST['imObjectForm_1_2'], '', false);
	$form->setField('dirección', $_POST['imObjectForm_1_3'], '', false);
	$form->setField('Email', $_POST['imObjectForm_1_4'], '', false);
	$form->setField('consulta', $_POST['imObjectForm_1_5'], '', false);

	if(@$_POST['action'] != 'check_answer') {
		if(!isset($_POST['imJsCheck']) || $_POST['imJsCheck'] != 'jsactive' || (isset($_POST['imSpProt']) && $_POST['imSpProt'] != ""))
			die(imPrintJsError());
		$form->mailToOwner('info@prsl.com.ar', 'info@prsl.com.ar', 'Consulta desde la página', '', false);
		$form->mailToCustomer('info@prsl.com.ar', $_POST['imObjectForm_1_4'], '', '', false);
		@header('Location: ../index.html');
		exit();
	} else {
		echo $form->checkAnswer(@$_POST['id'], @$_POST['answer']) ? 1 : 0;
	}
}
