<?php

namespace App\Http\Controllers;

use App\Models\Parameter;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreParameterRequest;
use App\Http\Requests\UpdateParameterRequest;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\MessageBag;

class ParameterController extends Controller
{
    
    public function create() : View
    {
         $id = 1;
         $parameter = Parameter::find($id);

         if ($parameter == null) {
             $parameter = Parameter::create([
                 'id' => $id,
             ]);
         }
 
         // Devuelve la vista con el parámetro
         return view('parameter', [
             'parameter' => $parameter
         ]);
    }

    /**
     * Store a newly created resource in storage.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateParameterRequest $request, Parameter $parameter) : RedirectResponse
    {
        $numberClassesMax = 300;
        $regularMax = 100;
        $promotionalMax = 100;
    
        $numberClasses = $request->input('numberClasses');
        $regular = $request->input('percentageRegular');
        $promotional = $request->input('percentagePromotional');
    
        if ($numberClasses <= $numberClassesMax && $regular <= $regularMax && $promotional <= $promotionalMax) {
            // Actualiza los parámetros
            $parameter->update($request->all());
            return redirect()->back()->withSuccess('Parameters are updated successfully.');
        }
    
        // Si alguna de las condiciones no se cumple, genera un mensaje de error apropiado
        $errors = new MessageBag(['error' => '']);
        if ($numberClasses > $numberClassesMax) {
            $errors->add('error', 'Error with number of classes.');
        }
        if ($regular > $regularMax) {
            $errors->add('error', 'Error with regular percentage.');
        }
        if ($promotional > $promotionalMax) {
            $errors->add('error', 'Error with promotional percentage.');
        }
    
        return redirect()->back()->withErrors($errors);
    }
}
   
