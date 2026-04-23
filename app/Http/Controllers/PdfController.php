<?php

namespace App\Http\Controllers;

use App\Models\Barrio;
use App\Models\Propiedad;
use App\Models\User;
use App\Models\Review;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PdfController extends Controller
{

    public function ReporUser(Request $request)
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

    public function ReporProp(Request $request)
    {
        $query = Propiedad::query();
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [
                $request->start_date,
                $request->end_date
            ]);
        }

        if($request->tipo) {
            $query->where('tipo', $request->tipo);
        }

        $propiedades = $query->get();
        $barrio = Barrio::all();

        $pdf = Pdf::loadView('admin.reporte.reporte', compact('propiedades', 'barrio'));

        return $pdf->stream('reporte.pdf');
    }


    public function reporteReviews(Request $request){
        $query = Review::query();
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [
                $request->start_date,
                $request->end_date
            ]);
        }

        if ($request->rating) {
            $query->where('reating', $request->rating);
        }

        $review = $query->with('usuario', 'propiedad')->get();
        

        $pdf = Pdf::loadView('admin.reporte.reportereviews', compact('review'));

        return $pdf->stream('Reportereview.pdf');

    }

}