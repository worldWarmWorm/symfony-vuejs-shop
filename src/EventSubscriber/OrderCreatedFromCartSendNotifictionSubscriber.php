<?php

namespace App\EventSubscriber;

use App\Event\OrderCreatedFromCartEvent;
use App\Utils\Mailer\Sender\OrderCreatedSender;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class OrderCreatedFromCartSendNotifictionSubscriber implements EventSubscriberInterface
{
  /**
   * @var OrderCreatedSender
   */
  private $orderCreatedSender;

  public function __construct(OrderCreatedSender $orderCreatedSender)
  {
    $this->orderCreatedSender = $orderCreatedSender;
  }

  public function onOrderCreatedFromCartEvent(OrderCreatedFromCartEvent $event)
  {
    $order = $event->getOrder();
    $this->orderCreatedSender->sendEmailToClient($order);
    $this->orderCreatedSender->sentEmailToManager($order);
  }

  public static function getSubscribedEvents(): array
  {
    return [
      OrderCreatedFromCartEvent::class => 'onOrderCreatedFromCartEvent',
    ];
  }
}
