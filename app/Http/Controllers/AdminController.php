<?php 

namespace App\Http\Controllers;

use App\Models\Barrio;
use App\Models\Propiedad;
use App\Models\Review;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Process;

class AdminController extends Controller {

    public function index() {
        
        $totalUsers = User::count();
        $totalPropiedades = Propiedad::count();
        $totalReviews = Review::count();

        return view('admin.index', compact('totalUsers', 'totalPropiedades', 'totalReviews'));
    }
    
    public function usersview() {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function propiedadesview() {
        $barrio = Barrio::all();
        $propiedades = Propiedad::all();
        return view('admin.propiedades.index', compact('propiedades', 'barrio'));
    }

    public function reviewsview() {
        $reviews = Review::with('usuario', 'propiedad')->get();
        return view('admin.reviews.index', compact('reviews'));
    }

    public function reviewsearch() {
        $query = Review::query();

        if (request('start_date')) {
            $query->whereDate('created_at', '>=', request('start_date'));
        }

        if (request('end_date')) {
            $query->whereDate('created_at', '<=', request('end_date'));
        }

        $reviews = $query->get();

        return view('admin.reviews.index', compact('admin.reviews.index', 'reviews'));
    }

    public function propiedadessearch() {
        $query = Propiedad::query();

        if (request('start_date')) {
            $query->whereDate('created_at', '>=', request('start_date'));
        }

        if (request('end_date')) {
            $query->whereDate('created_at', '<=', request('end_date'));
        }

        if (request('tipo')) {
            $query->where('tipo', request('tipo'));
        }

        $propiedades = $query->get();

        return view('admin.propiedades.index', compact('propiedades'));
    }

    public function userssearch() {
        $query = User::query();

        if (request('start_date')) {
            $query->whereDate('created_at', '>=', request('start_date'));
        }

        if (request('end_date')) {
            $query->whereDate('created_at', '<=', request('end_date'));
        }

        if (request('role')) {
            $query->where('role', request('role'));
        }

        $users = $query->get();

        return view('admin.users.index', compact('users'));
    }

    public function backupDatabase()
    {
        $dbConfig = Config::get('database.connections.mysql');
        $filename = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
        $path = storage_path("app/{$filename}");
        
        $authFile = storage_path("app/db_auth.cnf");
        $authContent = "[client]\nuser=\"{$dbConfig['username']}\"\npassword=\"{$dbConfig['password']}\"\nhost=\"{$dbConfig['host']}\"";
        file_put_contents($authFile, $authContent);

        try {
            set_time_limit(300);

            $isWindows = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
            $extraParams = $isWindows ? '--column-statistics=0 ' : '';

            $command = sprintf(
                'mysqldump --defaults-extra-file="%s" %s--set-gtid-purged=OFF --single-transaction %s > "%s" 2>&1',
                $authFile,
                $extraParams,
                $dbConfig['database'],
                $path
            );

            system($command);

            if (file_exists($authFile)) unlink($authFile);

            if (file_exists($path) && filesize($path) > 0) {
                
                // 1. Limpiar cualquier residuo de salida
                if (ob_get_level()) ob_end_clean();

                // 2. Respuesta tipo Stream (La más compatible con Ubuntu/Nginx)
                return response()->streamDownload(function () use ($path) {
                    echo file_get_contents($path);
                    unlink($path); // Borramos después de enviar el contenido
                }, $filename, [
                    'Content-Type' => 'application/sql',
                    'Content-Disposition' => 'attachment; filename="'.$filename.'"'
                ]);
            }

            return back()->with('error', 'No se pudo generar el backup.');

        } catch (\Exception $e) {
            if (file_exists($authFile)) unlink($authFile);
            return back()->with('error', 'Excepción: ' . $e->getMessage());
        }
    }
    
}


?>