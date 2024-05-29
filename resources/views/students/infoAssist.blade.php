@extends('students.layouts')

@section('content')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Asistencias del alumno') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="row justify-content-center mt-3">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <div class="float-start">
                                        Información del estudiante
                                    </div>
                                    <div class="float-end">
                                        <a href="{{ route('students.index') }}" class="btn btn-primary btn-sm">&larr; Atrás</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                
                                <table class="table">
    <tr>
        <td class="col-md-6">
            <div class="row">
                <label for="dni" class="col-md-4 col-form-label text-md-end text-start"><strong>DNI:</strong></label>
                <div class="col-md-8" style="line-height: 35px;">
                    <p>{{ $student['dni'] }}</p>
                </div>
            </div>
        </td>

        <td class="col-md-6">
            <div class="row">
                <label for="lastname" class="col-md-4 col-form-label text-md-end text-start"><strong>Condicion:</strong></label>
                <div class="col-md-8" style="line-height: 35px;">
                    <p>{{ $condition }}</p>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td class="col-md-6">
            <div class="row">
                <label for="lastname" class="col-md-4 col-form-label text-md-end text-start"><strong>Apellido:</strong></label>
                <div class="col-md-8" style="line-height: 35px;">
                    <p>{{ $student['lastname'] }}</p>
                </div>
            </div>
        </td>
        <td class="col-md-6">
            <div class="row">
                <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Nombre:</strong></label>
                <div class="col-md-8" style="line-height: 35px;">
                    <p>{{ $student['name'] }}</p>
                </div>
            </div>
        </td>
    </tr>
</table>
                                    <div class="row">
                                        <label for="created_at" class="col-md-4 col-form-label text-md-end text-start"><strong>fecha de asistencia:</strong></label>
                                        <div class="col-md-6" style="line-height: 35px;">
                                            @foreach($assists as $assist)
                                            <div>
                                                {{$assist}}
                                            </div>
                                            @endforeach    
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endsection