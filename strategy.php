<?php

declare(strict_types=1);

interface PaymentInterface
{
    public function pay(): void;
}

class Paypal implements PaymentInterface {
    public function pay(): void
    {
        print "Paid by Paypal";
    }
}

class Cash implements PaymentInterface {
    public function pay(): void
    {
        print "Paid by Cash";
    }
}

class Points implements PaymentInterface {
    public function pay(): void
    {
        print "Paid by Points";
    }
}


class PaymentStrategy implements PaymentInterface
{
    protected ?PaymentInterface $paymentService;
    public function pay(): void
    {
        $this->paymentService->pay();
    }

    public function setPayment(PaymentInterface $payment): void
    {
        $this->paymentService = $payment;
    }
}

$paymentService = new PaymentStrategy();
$paymentService->setPayment(new Paypal());
$paymentService->pay();
$paymentService->setPayment(new Points());
$paymentService->pay();