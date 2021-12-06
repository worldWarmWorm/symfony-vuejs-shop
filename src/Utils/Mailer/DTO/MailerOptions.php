<?php

namespace App\Utils\Mailer\DTO;

class MailerOptions {
  /**
   * @var string
   */
  private $recipient;

  /**
   * @var string|null
   */
  private $cc;

  /**
   * @var string
   */
  private $subject;

  /**
   * @var string
   */
  private $htmlTemplate;

  /**
   * @var array
   */
  private $context;

  /**
   * @var string
   */
  private $text;

  /**
   * @return string
   */
  public function getRecipient(): string
  {
    return $this->recipient;
  }

  /**
   * @param string $recipient
   * @return MailerOptions
   */
  public function setRecipient(string $recipient): self
  {
    $this->recipient = $recipient;
    return $this;
  }

  /**
   * @return string
   */
  public function getCc(): ?string
  {
    return $this->cc;
  }

  /**
   * @param string $cc
   * @return MailerOptions
   */
  public function setCc(string $cc): self
  {
    $this->cc = $cc;
    return $this;
  }

  /**
   * @return string
   */
  public function getSubject(): string
  {
    return $this->subject;
  }

  /**
   * @param string $subject
   * @return MailerOptions
   */
  public function setSubject(string $subject): self
  {
    $this->subject = $subject;
    return $this;
  }

  /**
   * @return string
   */
  public function getHtmlTemplate(): string
  {
    return $this->htmlTemplate;
  }

  /**
   * @param string $htmlTemplate
   * @return MailerOptions
   */
  public function setHtmlTemplate(string $htmlTemplate): self
  {
    $this->htmlTemplate = $htmlTemplate;
    return $this;
  }

  /**
   * @return array
   */
  public function getContext(): array
  {
    return $this->context;
  }

  /**
   * @param array $context
   * @return MailerOptions
   */
  public function setContext(array $context): self
  {
    $this->context = $context;
    return $this;
  }

  /**
   * @return string
   */
  public function getText(): string
  {
    return $this->text;
  }

  /**
   * @param string $text
   * @return MailerOptions
   */
  public function setText(string $text): self
  {
    $this->text = $text;
    return $this;
  }
}