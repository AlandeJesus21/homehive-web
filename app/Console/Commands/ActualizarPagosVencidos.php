<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pago;

class ActualizarPagosVencidos extends Command
{
    // Este es el nombre con el que podrías llamarlo manualmente
    protected $signature = 'pagos:verificar-vencimiento';
    protected $description = 'Vuelve a poner en pendiente los pagos cuya fecha_fin ya pasó';

    public function handle()
    {
        $pagosActualizados = Pago::where('status', 'pagado')
            ->where('fecha_fin', '<', now())
            ->update(['status' => 'pendiente']);

        if ($pagosActualizados > 0) {
            $this->info("Se actualizaron {$pagosActualizados} pagos vencidos.");
        } else {
            $this->info("No hay pagos vencidos por actualizar.");
        }
    }
}