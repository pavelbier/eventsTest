<?php
namespace TestApp;
use Nette;

interface IMessageFormProcess {
	public function process(Nette\Application\UI\Form $form);	
};
