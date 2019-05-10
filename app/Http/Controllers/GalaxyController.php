<?php
namespace App\Http\Controllers;
use App\User;
use App\System;
use App\Planet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class GalaxyController extends Controller
{ 
    public function index()
    {
        $systems = System::all();
        return $systems;

    }


    public function create()
    {

        return view('/home');
    }
    public function store()
    {
        $system = new System();
        
        request()->validate([
            'name' => 'required',
            'XCoordinate' => 'required',
            'YCoordinate' => 'required',
        ]);
        $system->name = request('name');
        $system->XCoordinate = request('XCoordinate');
        $system->YCoordinate = request('YCoordinate');
        $system->save();

        return redirect('home');
    }
 
    public function edit($id)
    {
        $systems = System::findOrFail($id);
        return view('editObj', compact('systems'));
    }
    public function update($id)
    {
        $systems = System::find($id);
        $systems->name = request('name');
        $systems->save();
        return redirect('/home');
    }
    public function destroy($id)
    {
        System::find($id)->delete();
        return redirect('/home');
    }
}