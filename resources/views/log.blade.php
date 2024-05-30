@extends('students.layouts')

@section('content')
<x-app-layout>
    <x-slot name="header">
    
    <div class="d-flex justify-content-between ">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Lista de Logueos') }}
    </h2>
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
                    

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Fecha y hora</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Accion</th>
                                <th scope="col">IP</th>
                                <th scope="col">Navegador</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($logs as $log)
                            <tr>
                                <td>{{ $log->created_at }}</td>
                                <td>{{ $log->user }}</td>
                                <td>{{ $log->accion }}</td>
                                <td>{{ $log->ip }}</td>
                                <td>{{ $log->navegador }}</td>
                               
                                <td>
                                <form action="{{ route('logs.destroy', $log->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Quieres eliminar a este Logueo?');"><i class="bi bi-trash"></i> Eliminar Log</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <td colspan="6">
                                <span class="text-danger">
                                    <strong>¡No se encontró ningún Logueo!</strong>
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