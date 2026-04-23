<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Solicitud;

class SolicitudNotification extends Notification
{
    use Queueable;

    protected $solicitud;
    protected $tipo;

    public function __construct(Solicitud $solicitud, $tipo)
    {
        $this->solicitud = $solicitud;
        $this->tipo = $tipo;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        // Definir títulos y mensajes según el tipo
        $config = [
            'nueva' => [
                'sujeto' => 'Nueva Solicitud Recibida - HomeHive',
                'titulo' => '¡Tienes una nueva solicitud!',
                'cuerpo' => "Has recibido una nueva propuesta para tu propiedad: <strong>{$this->solicitud->propiedad}</strong>.",
                'boton'  => 'Ver Solicitudes'
            ],
            'aceptada' => [
                'sujeto' => 'Solicitud Aceptada - HomeHive',
                'titulo' => '¡Tu solicitud fue aprobada!',
                'cuerpo' => "Buenas noticias, tu solicitud para <strong>{$this->solicitud->propiedad}</strong> ha sido aceptada.",
                'boton'  => 'Ver Detalles'
            ],
            'rechazada' => [
                'sujeto' => 'Actualización de Solicitud - HomeHive',
                'titulo' => 'Solicitud Rechazada',
                'cuerpo' => "Tu solicitud para <strong>{$this->solicitud->propiedad}</strong> no fue aceptada en esta ocasión.",
                'boton'  => 'Ir a mis solicitudes'
            ],
        ];

        $actual = $config[$this->tipo];

        return (new MailMessage)
            ->subject($actual['sujeto'])
            ->view('emails.solicitud', [
                'user' => $notifiable,
                'solicitud' => $this->solicitud,
                'titulo' => $actual['titulo'],
                'cuerpo' => $actual['cuerpo'],
                'boton_texto' => $actual['boton']
            ]);
    }
}