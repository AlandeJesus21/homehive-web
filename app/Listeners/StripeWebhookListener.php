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
                $pago = Pago::with(['inquilino', 'arrendador'])->find($pagoId);
                
                if ($pago && $pago->status !== 'pagado') {
                    // AQUÍ HACEMOS EL AJUSTE DE FECHAS
                    $pago->update([
                        'status' => 'pagado',
                        'stripe_id' => $session['id'],
                        'fecha_inicio' => now(),           // La renta inicia en este momento
                        'fecha_fin' => now()->addMonth(),  // Vence exactamente en un mes
                    ]);

                    // Notificaciones
                    if ($pago->inquilino) {
                        $pago->inquilino->notify(new PagoConfirmadoNotification($pago));
                    }

                    if ($pago->arrendador) {
                        $pago->arrendador->notify(new PagoConfirmadoNotification($pago));
                    }
                }
            }
        }
    }
}