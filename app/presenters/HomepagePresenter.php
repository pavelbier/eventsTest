<?php

/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{

	/**
	 * @var Kdyby\Events\EventManager $eventManager
	 */
	protected $eventManager;
	/**
	 * @var TestApp\messagetFormProcess $messageFormProcess
	 */
	protected $messageFormProcess;

	public function __construct(Kdyby\Events\EventManager $eventManager,TestApp\IMessageFormProcess $messageFormProcess)
	{
		$this->eventManager = $eventManager;
		$this->messageFormProcess = $messageFormProcess;
	}

	public function createComponentMessageForm()
	{
		$form = new Nette\Application\UI\Form;
		$form->addText('message','Message:',30,255)->setRequired('Message required!');
		$form->addSubmit('ok');
		$this->messageFormProcess->onSuccess = $this->eventManager->createEvent('MessageForm::onSuccess');
		$form->onSuccess[] = callback($this,'messageFormSuccessed');
		return $form;
	}

	public function messageFormSuccessed(Nette\Application\UI\Form $form)
	{
		$this->messageFormProcess->process($form);
		$this->flashMessage('Message "'.$form->values->message.'" accepted');
		$this->redirect('this');
	}

}
