<?php

declare(strict_types=1);

interface NotificationInterface
{
    public function send(string $message);
}

class EmailNotification implements NotificationInterface
{
    public function send(string $message): string
    {
        return "email: {$message}";
    }
}

class SMSNotification implements NotificationInterface
{
    public function send(string $message): string
    {
        return "sms: {$message}";
    }
}

class PushNotification implements NotificationInterface
{
    public function send(string $message): string
    {
        return "push: {$message}";
    }
}

class MessageFactory
{
    public static function create(string $type): NotificationInterface
    {
        return match ($type) {
            'email' => new EmailNotification(),
            'sms' => new SMSNotification(),
            'push' => new PushNotification(),
        };
    }
}

MessageFactory::create('email')->send('Hello, World!');
MessageFactory::create('sms')->send('Hello, World!');
MessageFactory::create('push')->send('Hello, World!');