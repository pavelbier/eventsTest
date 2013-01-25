<?php

namespace TestApp;
use Nette;
use Kdyby;

class MessageFormLogListener extends Nette\Object implements Kdyby\Events\Subscriber
{
    public function getSubscribedEvents()
    {
        return array('MessageForm::onSuccess');
    }
    public function onSuccess(Nette\Application\UI\Form $form)
    {
        Nette\Diagnostics\Debugger::log($form->values->message);
    }
}