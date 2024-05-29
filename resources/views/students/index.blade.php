@extends('students.layouts')

@section('content')
<x-app-layout>
    <x-slot name="header">
    
    <div class="d-flex justify-content-between ">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Lista de estudiantes') }}
    </h2>
        <div class="d-flex justify-content-center" >
            <div>
                <a href="{{ route('students.generatePDF', $students) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Generar PDF</a>
            </div>
        </div>
    </div>
       
    
    </x-slot>
   
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            {{ $message }}
                        </div>
                    @endif
                    
                    @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif

                    @php
                        $birthdays = json_decode($birthdays);
                    @endphp
                    
                    @if ($birthdays <> null)
                    <div class="alert alert-success" role="alert">
                        hoy es el cumpleaños de:
                        @foreach ($birthdays as $birthday)    
                            {{ $birthday }} 
                        @endforeach
                    </div>
                    @endif
                    
                    <form action="">
                    <a href="{{ route('students.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Agregar un nuevo estudiante</a>
                    <select style="border 5px"  name="idCategoria" required>
                            <option value="1">Curso 1</option>
                            <option value="2">Curso 2</option>
                            <option value="3">Curso 3</option>
                        </select>
                    </form>

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Apellido</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">DNI</th>
                                <th scope="col">Grupo</th>
                                <th scope="col">Curso</th>
                                <th scope="col">Fecha de nacimiento</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($students as $student)
                            <tr>
                                <td>{{ $student->lastname }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->dni }}</td>
                                <td>{{ $student->group }}</td>
                                <td>{{ $student->curso }}</td>
                                <td>{{ $student->birthdate }}</td>
                                <td>
                                    <form action="{{ route('students.destroy', $student->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')

                                        <a href="{{ route('students.assist', $student->id) }}" class="btn btn-success btn-sm">Asistencia</a>
                                        <a href="{{ route('students.infoAssist', $student->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> info</a>   
                                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Editar</a> 
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Quieres eliminar a este estudiante?');"><i class="bi bi-trash"></i> Eliminar Alumno</button>

                                        @if(app('App\Http\Controllers\StudentController')->icon($student->id) === 'true')
                                            <i class="bi bi-check"></i>
                                        @endif 
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <td colspan="6">
                                <span class="text-danger">
                                    <strong>¡No se encontró ningún estudiante!</strong>
                                </span>
                            </td>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $students->links() }}
                    
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
@endsection