<?php

namespace App\Http\Controllers;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PdfController extends Controller
{

    public function Reporuser(Request $request)
    {

        $query = User::query();

        if ($request->role) {
            $query->where('role', $request->role);
        }

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [
                $request->start_date,
                $request->end_date
            ]);
        }

        $users = $query->get();

        $pdf = Pdf::loadView('admin.reporte.reporteuser', compact('users'));

        return $pdf->stream('reporte.pdf');
    }

}