<?php

namespace App\Entity;


class Language
{
    private ?string $unsubscribe = null;
    private ?string $subscribe = null;
    private ?string $unsubscribeSuccess = null;
    private ?string $unsubscribeError = null;
    private ?string $subscribeError = null;
    private ?string $hello = null;
    private ?string $anyQuestionsContactMe = null;
    private ?string $haveAQuestion = null;
    private ?string $ConfirmationOfRecusal = null;
    private ?string $willAnswerYou = null;
    private ?string $thankSubscribe = null;
    private ?string $thankMessage = null;
    private ?string $message = null;
    private ?string $website = null;
    private ?string $errorHelp = null;

    public function getUnsubscribe(): ?string
    {
        return $this->unsubscribe;
    }

    public function setUnsubscribe(string $unsubscribe): self
    {
        $this->unsubscribe = $unsubscribe;

        return $this;
    }

	/**
	 * @return 
	 */
	public function getSubscribe(): ?string {
		return $this->subscribe;
	}
	
	/**
	 * @param  $subscribe 
	 * @return self
	 */
	public function setSubscribe(?string $subscribe): self {
		$this->subscribe = $subscribe;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getUnsubscribeSuccess(): ?string {
		return $this->unsubscribeSuccess;
	}
	
	/**
	 * @param  $unsubscribeSuccess 
	 * @return self
	 */
	public function setUnsubscribeSuccess(?string $unsubscribeSuccess): self {
		$this->unsubscribeSuccess = $unsubscribeSuccess;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getHello(): ?string {
		return $this->hello;
	}
	
	/**
	 * @param  $hello 
	 * @return self
	 */
	public function setHello(?string $hello): self {
		$this->hello = $hello;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getAnyQuestionsContactMe(): ?string {
		return $this->anyQuestionsContactMe;
	}
	
	/**
	 * @param  $anyQuestionsContactMe 
	 * @return self
	 */
	public function setAnyQuestionsContactMe(?string $anyQuestionsContactMe): self {
		$this->anyQuestionsContactMe = $anyQuestionsContactMe;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getHaveAQuestion(): ?string {
		return $this->haveAQuestion;
	}
	
	/**
	 * @param  $haveAQuestion 
	 * @return self
	 */
	public function setHaveAQuestion(?string $haveAQuestion): self {
		$this->haveAQuestion = $haveAQuestion;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getConfirmationOfRecusal(): ?string {
		return $this->ConfirmationOfRecusal;
	}
	
	/**
	 * @param  $ConfirmationOfRecusal 
	 * @return self
	 */
	public function setConfirmationOfRecusal(?string $ConfirmationOfRecusal): self {
		$this->ConfirmationOfRecusal = $ConfirmationOfRecusal;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getWillAnswerYou(): ?string {
		return $this->willAnswerYou;
	}
	
	/**
	 * @param  $willAnswerYou 
	 * @return self
	 */
	public function setWillAnswerYou(?string $willAnswerYou): self {
		$this->willAnswerYou = $willAnswerYou;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getThankSubscribe(): ?string {
		return $this->thankSubscribe;
	}
	
	/**
	 * @param  $thankSubscribe 
	 * @return self
	 */
	public function setThankSubscribe(?string $thankSubscribe): self {
		$this->thankSubscribe = $thankSubscribe;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getThankMessage(): ?string {
		return $this->thankMessage;
	}
	
	/**
	 * @param  $thankMessage 
	 * @return self
	 */
	public function setThankMessage(?string $thankMessage): self {
		$this->thankMessage = $thankMessage;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getMessage(): ?string {
		return $this->message;
	}
	
	/**
	 * @param  $message 
	 * @return self
	 */
	public function setMessage(?string $message): self {
		$this->message = $message;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getWebsite(): ?string {
		return $this->website;
	}
	
	/**
	 * @param  $website 
	 * @return self
	 */
	public function setWebsite(?string $website): self {
		$this->website = $website;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getUnsubscribeError(): ?string {
		return $this->unsubscribeError;
	}
	
	/**
	 * @param  $unsubscribeError 
	 * @return self
	 */
	public function setUnsubscribeError(?string $unsubscribeError): self {
		$this->unsubscribeError = $unsubscribeError;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getErrorHelp(): ?string {
		return $this->errorHelp;
	}
	
	/**
	 * @param  $errorHelp 
	 * @return self
	 */
	public function setErrorHelp(?string $errorHelp): self {
		$this->errorHelp = $errorHelp;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getSubscribeError(): ?string {
		return $this->subscribeError;
	}
	
	/**
	 * @param  $subscribeError 
	 * @return self
	 */
	public function setSubscribeError(?string $subscribeError): self {
		$this->subscribeError = $subscribeError;
		return $this;
	}
}
