<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Assist;
use DB;
use Carbon\Carbon;
use Dompdf\Dompdf;
use App\Models\parameter;
use App\Models\Attendance;
use App\Http\Controllers\LogController;
use App\Models\log;
use App\Models\Rol;

class LogController extends Controller

{
    public function index()
    {   
        $user = auth()->user()->id;
        $admins = Rol::All();

        $logs = Log::all();
        foreach ($admins as $admin){
            if ($admin->users_id === $user){
                return view('Log', [
                    'logs' => $logs,
                ]);
            }
        }
        abort(403, 'Unauthorized action.');
    }

    public function destroy(Log $log) : RedirectResponse
    {
        $log->delete();
        return redirect()->route('log')
                ->withSuccess('Logueo eliminado con exito.');
    }
    
}
