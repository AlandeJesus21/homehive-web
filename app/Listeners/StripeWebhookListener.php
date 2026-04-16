<?php

namespace App\Listeners;

use Laravel\Cashier\Events\WebhookReceived;
use App\Models\Pago;
use App\Notifications\PagoConfirmadoNotification; // Importar

class StripeWebhookListener
{
    public function handle(WebhookReceived $event)
    {
        $payload = $event->payload;

        if ($payload['type'] === 'checkout.session.completed') {
            $session = $payload['data']['object'];
            $pagoId = $session['metadata']['pago_id'] ?? null;

            if ($pagoId) {
                // Cargamos la relación inquilino para poder notificarlo
                $pago = Pago::with('inquilino')->find($pagoId);
                
                if ($pago && $pago->status !== 'pagado') {
                    $pago->update([
                        'status' => 'pagado',
                        'stripe_id' => $session['id'],
                    ]);

                    // 1. Notificar al Inquilino
                    if ($pago->inquilino) {
                        $pago->inquilino->notify(new PagoConfirmadoNotification($pago));
                    }

                    // 2. Notificar al Arrendador (Propietario)
                    if ($pago->arrendador) {
                        $pago->arrendador->notify(new PagoConfirmadoNotification($pago));
                    }
                }
            }
        }
    }
}