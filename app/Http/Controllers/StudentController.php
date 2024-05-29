<?php

namespace App\Http\Controllers;


use App\Models\Student;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Assist;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Dompdf\Dompdf;
use App\Models\parameter;
use App\Models\Attendance;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $students = Student::orderBy('lastname', 'asc')->paginate(8);
        $birthdays = $this->birthday();
        $birthdays = json_encode($birthdays);

        return view('students.index', [
            'students' => $students,
            'birthdays' => $birthdays,
        ]);
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request) : RedirectResponse
    {
        Student::create($request->all());
        return redirect()->route('students.index')
                ->withSuccess('New Student is added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student) : View
    {
        
        return view('students.show', [
            'student' => $student
        ]);
    }

    public function infoAssist(Student $student) : view
    {
         $created_at = [];
         $i = 0;
         $assists = Assist::where('student_id', $student->id)->get();
         foreach ($assists as $assist) {
            $created_at[$i] = $assist->created_at->format('d-m-y H:i');
            $i++;
        }
        $condition = $this->condition($created_at);
         return view('students.infoAssist',[
            'student' => $student,
            'assists' => $created_at,
            'condition' => $condition
         ]);   



    }
  
    public function edit(Student $student) : View
    {
        return view('students.edit', [
            'student' => $student
        ]);
    }

    
    public function assist(Student $student)
    {
        $assists = Assist::where('student_id', $student->id)->get();
        $hoy = Carbon::now()->format('d-m-y');

        foreach ($assists as $assist) {
            $created_at = $assist->created_at->format('d-m-y');
            if ($hoy == $created_at) {
                $errors = ('Ya has registrado la asistencia para hoy.');
                return redirect()->back()->withErrors($errors);
            }
        }

        // Si no se encontró asistencia para hoy, registrarla
        $assist = new Assist();
        $assist->student()->associate($student); 
        $assist->save();
        return redirect()->route('students.index')->withSuccess('Asistencia del estudiante registrada con éxito.')
         ->withSuccess('student assistance successfully added');
    }

    public function deleteAssist(Student $student)
    {


    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student) : RedirectResponse
    {
        $student->update($request->all());
        return redirect()->back()
                ->withSuccess('Student is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student) : RedirectResponse
    {
        $student->delete();
        return redirect()->route('students.index')
                ->withSuccess('Student is deleted successfully.');
    }

    public function searchStudent(Request $request) : view
    {
        $dni = $request->input('dni');
        $students = DB::table('students')
            ->where('dni', 'LIKE', $dni)
            ->get();

        return view('search', [
            'students' => $students
        ]);   
    }  

    public function birthday()
    {
        
        $students = DB::table('students')->get();
        $birthdays = [];
        $aux =0;
        $Y ='';
        foreach ($students as $student){
            if (Carbon::parse($student->birthdate)->isBirthday()){
                $birthdays[$aux] = ($Y.$student->name.' '.$student->lastname);
                $aux = + 1; 
                $Y = ' Y ';
            };
        }
         return $birthdays; 
    }    

    public function generatePDF()
    {
        $students = Student::all();
        $html = '<h1>Información de los estudiantes</h1>'; 
        foreach ($students as $student) 
        { 
            $html .= '<p>Nombre: ' . $student->name .'</p>';
            $html .= '<p>Apellido: ' . $student->lastname .'</p>';
            $html .= '<p>DNI: ' . $student->dni .'</p>';
            $html .= '<p>Curso: ' . $student->curso .'</p>';
            $html .= '<p>Grupo: ' . $student->group .'</p>';
            $html .= '<p>Fecha de nacimiento: ' . $student->birthdate .'</p>'; 
            $html .= '<hr>';
        }

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->render();
        return $dompdf->stream("info_estudiantes.pdf"); 
    }

    public function icon($id)
    {  
        $assists = Assist::where('student_id', $id)->get();
        $hoy = Carbon::now()->format('d-m-y');
        foreach ($assists as $assist) {
            $created_at = $assist->created_at->format('d-m-y');
            if ($hoy == $created_at) {
                return 'true';
            }
        }
      return 'false';  
    }

    public function condition($date)
    {
        $parameters = Parameter::all();
        $parameter = $parameters->first();
        $numberClasses = $parameter->numberClasses;
        $regular = $parameter->percentageRegular;
        $promotional = $parameter->percentagePromotional;
        $count = count($date);
        $percentage = ($count / $numberClasses) * 100;
        $percentage = round($percentage);
            
        if ($percentage >= $regular && $percentage < $promotional)
        {
            return 'REGULAR';
        }
        if ($percentage >= $promotional)
        {
            return 'PROMOCION';
        }
        return 'LIBRE';
    }
    
}