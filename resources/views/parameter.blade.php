@extends('students.layouts')

@section('content')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Parametros') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                
                <div class="row justify-content-center mt-3">
                    <div class="col-md-8">

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

                        <div class="card">
                            <div class="card-header">
                                <div class="float-start">
                                    Actualizar parametros
                                </div>
                                <div class="float-end">
                                    <a href="{{ route('students.index') }}" class="btn btn-primary btn-sm">&larr; Atrás</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('parameters.update', $parameter->id) }}" method="post">
                                    @csrf
                                    @method("PUT")

                                    <div class="mb-3 row">
                                        <label for="numberClasses" class="col-md-4 col-form-label text-md-end text-start">numero de clases</label>
                                        <div class="col-md-6">
                                        <input type="number" class="form-control @error('numberClasses') is-invalid @enderror" id="numberClasses" name="numberClasses" value="{{$parameter->numberClasses}}">
                                            @if ($errors->has('numberClasses'))
                                                <span class="text-danger">{{ $errors->first('numberClasses') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="percentageRegular" class="col-md-4 col-form-label text-md-end text-start">porcentaje regular</label>
                                        <div class="col-md-6">
                                        <input type="text" class="form-control @error('percentageRegular') is-invalid @enderror" id="percentageRegular" name="percentageRegular" value="{{$parameter->percentageRegular}}">
                                            @if ($errors->has('percentageRegular'))
                                                <span class="text-danger">{{ $errors->first('percentageRegular') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="percentagePromotional" class="col-md-4 col-form-label text-md-end text-start">porcentaje Promocional</label>
                                        <div class="col-md-6">
                                        <input type="text" class="form-control @error('percentagePromotional') is-invalid @enderror" id="percentagePromotional" name="percentagePromotional" value="{{ $parameter->percentagePromotional }}">
                                            @if ($errors->has('percentagePromotional'))
                                                <span class="text-danger">{{ $errors->first('percentagePromotional') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update">
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>    
                </div>

</x-app-layout>
@endsection


































