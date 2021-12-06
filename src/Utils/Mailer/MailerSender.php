<?php

namespace App\Utils\Mailer;

use App\Utils\Mailer\DTO\MailerOptions;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;

class MailerSender
{
  /**
   * @var MailerInterface
   */
  private $mailer;

  /**
   * @var LoggerInterface
   */
  private $logger;

  public function __construct(MailerInterface $mailer, LoggerInterface $logger)
  {
    $this->mailer = $mailer;
    $this->logger = $logger;
  }

  /**
   * @param MailerOptions $mailerOptions
   * @return object|TemplatedEmail
   */
  public function sendTemplateEmail(MailerOptions $mailerOptions)
  {
    $email = (new TemplatedEmail())
      ->to($mailerOptions->getRecipient())
      ->subject($mailerOptions->getSubject())
      ->htmlTemplate($mailerOptions->getHtmlTemplate())
      ->context($mailerOptions->getContext());

    if ($mailerOptions->getCc()) {
      $email->cc($mailerOptions->getCc());
    }

    try {
      $this->mailer->send($email);
    } catch (TransportExceptionInterface $ex) {
      $this->logger->critical($mailerOptions->getSubject(), [
        'errorText' => $ex->getTraceAsString()
      ]);

      $systemMailerOptions = new MailerOptions();
      $systemMailerOptions->setText($ex->getTraceAsString());

      $this->sendSystemEmail($systemMailerOptions);
    }

    return $email;
  }

  /**
   * @param MailerOptions $mailerOptions
   * @return void
   */
  private function sendSystemEmail(MailerOptions $mailerOptions): void
  {
    $mailerOptions->setSubject('[Exception] An error occurred while sending the letter');
    $mailerOptions->setRecipient('admin@ranked-choice.com');

    $email = (new TemplatedEmail())
      ->to($mailerOptions->getRecipient())
      ->subject($mailerOptions->getSubject())
      ->text($mailerOptions->getText());

    try {
      $this->mailer->send($email);
    } catch (TransportExceptionInterface $ex) {
      $this->logger->critical($mailerOptions->getSubject(), [
        'errorText' => $ex->getTraceAsString()
      ]);
    }
  }
}