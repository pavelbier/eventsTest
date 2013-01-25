<?php

namespace TestApp;
use Nette;

class MessageFormProcess extends Nette\Object implements IMessageFormProcess
{
    public $onSuccess = array();

    public function process(Nette\Application\UI\Form $form)
    {
        $this->onSuccess($form);
    }
}