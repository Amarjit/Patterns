<?php

declare(strict_types=1);

interface PaymentStrategy
{
    public function pay(): void;
}

class Paypal implements PaymentStrategy {
    public function pay(): void
    {
        print "Paid by Paypal";
    }
}

class Cash implements PaymentStrategy {
    public function pay(): void
    {
        print "Paid by Cash";
    }
}

class Points implements PaymentStrategy {
    public function pay(): void
    {
        print "Paid by Points";
    }
}


class PaymentContext implements PaymentStrategy
{
    protected ?PaymentStrategy $paymentService = null;
    public function pay(): void
    {
        $this->paymentService->pay();
    }

    public function setPayment(PaymentStrategy $payment): void
    {
        $this->paymentService = $payment;
    }
}

$paymentService = new PaymentContext();
$paymentService->setPayment(new Paypal());
$paymentService->pay();
$paymentService->setPayment(new Points());
$paymentService->pay();