<?php


namespace App\Telegram\Event;


use BoShurik\TelegramBotBundle\Event\UpdateEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class UpdateSubscriber
 * @package App\Telegram\Event
 */
class UpdateSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [

        ];
    }
}