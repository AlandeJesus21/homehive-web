<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pago;

class ActualizarPagosVencidos extends Command
{
    protected $signature = 'pagos:verificar-vencimiento';
    protected $description = 'Vuelve a poner en pendiente los pagos cuya fecha_fin ya pasó';

    public function handle()
    {
        $vencieronHoy = Pago::where('status', 'pagado')
                            ->where('fecha_fin', '<', now())
                            ->update(['status' => 'pendiente']);

        $limiteGracia = now()->subDays(3);
        
        $pagosParaEliminar = Pago::where('status', 'pendiente')
                                ->where('fecha_fin', '<', $limiteGracia)
                                ->get();

        foreach ($pagosParaEliminar as $pago) {
            \App\Models\Solicitud::where('propiedad_id', $pago->propiedad_id)
                                ->where('user_id', $pago->user_id)
                                ->delete();

            $pago->delete();
        }

        $this->info("Proceso completado: Se actualizaron {$vencieronHoy} pagos y se eliminaron " . $pagosParaEliminar->count() . " registros fuera de gracia.");
    }
}