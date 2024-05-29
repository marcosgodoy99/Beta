@extends('students.layouts')

@section('content')
<x-app-layout>
    <x-slot name="header">
    
    <div class="d-flex justify-content-between ">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Buscar estudiantes') }}
    </h2>
    </div>
       
    
    </x-slot>
   
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                <div class="d-flex justify-content-center" >
                    <div>
                        <form action="{{ route('students.search') }}" method="post">
                            @csrf
                            <label for="dni">Buscar por DNI:</label>
                            <input style="border-radius: 10px;" type="number" id="dni" name="dni" maxlength="8" placeholder="Ingrese DNI del alumno">
                            <button type="submit" class="btn btn-success my-1">Buscar</button>
                        </form>
                    </div>
                </div>
                <br>
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
                                        <a href="{{ route('students.assist', $student->id) }}" class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i> Assistencia</a>
                                        <a href="{{ route('students.infoAssist', $student->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> info</a> 
                                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Editar</a>
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Quieres eliminar a este estudiante?');"><i class="bi bi-trash"></i> Eliminar</button>
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

                    
                    
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
@endsection
