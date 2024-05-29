@extends('students.layouts')

@section('content')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agregar un nuevo estudiante') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="card">
                        <div class="card-header">
                            <div class="float-end">
                                <a href="{{ route('students.index') }}" class="btn btn-primary btn-sm">&larr; Atrás</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('students.store') }}" method="post">
                                @csrf

                                <div class="mb-3 row">
                                    <label for="dni" class="col-md-4 col-form-label text-md-end text-start">DNI</label>
                                    <div class="col-md-6">
                                    <input type="number" class="form-control @error('dni') is-invalid @enderror" id="dni" name="dni" value="{{ old('dni') }}">
                                        @if ($errors->has('dni'))
                                            <span class="text-danger">{{ $errors->first('dni') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="name" class="col-md-4 col-form-label text-md-end text-start">Nombre</label>
                                    <div class="col-md-6">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="lastname" class="col-md-4 col-form-label text-md-end text-start">Apellido</label>
                                    <div class="col-md-6">
                                    <input type="text" class="form-control @error('lastname') is-invalid @enderror" id="lastname" name="lastname" value="{{ old('lastname') }}">
                                        @if ($errors->has('lastname'))
                                            <span class="text-danger">{{ $errors->first('lastname') }}</span>
                                        @endif
                                    </div>
                                </div>


                                <div class="mb-3 row">
                                    <label for="group" class="col-md-4 col-form-label text-md-end text-start">Grupo</label>
                                    <div class="col-md-6">
                                    <input type="text" step="0.01" class="form-control @error('group') is-invalid @enderror" id="group" name="group" value="{{ old('group') }}">
                                        @if ($errors->has('group'))
                                            <span class="text-danger">{{ $errors->first('group') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="curso" class="col-md-4 col-form-label text-md-end text-start">curso</label>
                                    <div class="col-md-6">
                                    <input type="text" step="0.01" class="form-control @error('birthdate') is-invalid @enderror" id="curso" name="curso" value="{{ old('curso') }}">
                                        @if ($errors->has('curso'))
                                            <span class="text-danger">{{ $errors->first('curso') }}</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="mb-3 row">
                                    <label for="birthdate" class="col-md-4 col-form-label text-md-end text-start">Birthdate</label>
                                    <div class="col-md-6">
                                    <input type="date" step="0.01" class="form-control @error('birthdate') is-invalid @enderror" id="birthdate" name="birthdate" value="{{ old('birthdate') }}">
                                        @if ($errors->has('birthdate'))
                                            <span class="text-danger">{{ $errors->first('birthdate') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Agregar estudiante">
                                </div>
                                
                            </form>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endsection