<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Pago;

class PagoConfirmadoNotification extends Notification
{
    use Queueable;

    protected $pago;

    public function __construct(Pago $pago)
    {
        $this->pago = $pago;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $msj = ($notifiable->id === $this->pago->user_id) 
            ? 'Has realizado un pago con éxito.' 
            : 'Has recibido un nuevo pago de renta.';

        return (new MailMessage)
            ->subject('Confirmación de Pago - HomeHive')
            ->view('emails.pago', [ // El nuevo nombre que pusimos
                'user' => $notifiable,
                'pago' => $this->pago,
                'mensaje_personalizado' => $msj,
            ]);
    }
}