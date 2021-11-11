<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*$resources = [
            ['id' => 1, 'name' => 'category'],
            ['id' => 2, 'name' => 'product'],
            ['id' => 4, 'name' => 'color']
        ];
        $request->session()->put('resources', $resources);*/
        //$request->session()->forget('resources');
        $resources = [];
        if($request->session()->exists('resources')) {
            $resources = $request->session()->get('resources');
        }
        $enterprise = 'Resources Ltd.';
        $data = [];
        $data['resources'] = $resources;
        $data['enterprise'] = $enterprise;
            if($request->session()->exists('message')) {
            $data['message'] = $request->session()->get('message');
            $type = 'success';
            if($request->session()->exists('type')) {
                $type = $request->session()->get('type');
            }
            $data['type'] = $type;
        }
        
        return view('resource.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $enterprise = 'Resources Ltd.';
        $data = [];
        $data['enterprise'] = $enterprise;
        return view('resource.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        //validación
        
        //Creamos el array donde vamos a almcenar todos los datos
        $resources = [];
        //Creamos una variable para obtener el array de resources
        //Lo primero que debemos hacer es comprobar que existe resources
        //Creamos una variable para almacenar el id que va a ir autoincrementando
        if($request->session()->exists('resources')) {
            $resources = $request->session()->get('resources');
            $array = end ($resources);
            $id = $array['id']+1;
            
        }else{
            $id = 1;
        }
        
        $name = $request->input('name');
        $precio = $request->input('precio');

        $resource = ['id' => $id, 'name' => $name, 'precio' => $precio];
        if(isset($resources[$id])) {
            return back()->withInput();
        } else {
            $resources[$id] = $resource;
        }
        $request->session()->put('resources', $resources);
        return redirect('resource')->with('message','Se ha insertado el elemento correctamente');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request ,$id){
        
        if($request->session()->exists('resources') && isset($request->session()->get('resources')[$id])) {
            $resource = $request->session()->get('resources')[$id];
            $data = [];
            $data['resource'] = $resource;
            $data['enterprise'] = 'Resources Ltd.';
            
            return view('resource.show', $data);    
            
        }
        
        return redirect('resource');
        
    }

   
    public function edit(Request $request, $id)
    {
        if($request->session()->exists('resources') && isset($request->session()->get('resources')[$id])) {
            $resource = $request->session()->get('resources')[$id];
            $data = [];
            $data['resource'] = $resource;
            $data['enterprise'] = 'Resources Ltd.';
            return view('resource.edit', $data);
            //return view('resource.edit', ['resource' => $resource]);
        } else {
            return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->session()->exists('resources')) {
            $resources = $request->session()->get('resources');
            if(isset($resources[$id])) {
                $resource = $resources[$id];
                $idInput = $request->input('id');
                $nameInput = $request->input('name');
                $precioInput = $request-> input('precio');
                $resource['id'] = $idInput;
                $resource['name'] = $nameInput;
                $resource['precio'] = $precioInput;
                if(isset($resources[$idInput]) && $id != $idInput) {
                    return back()->withInput();
                } 
                unset($resources[$id]);
                $resources[$idInput] = $resource;
                
                $request->session()->put('resources', $resources);
                return redirect('resource');
            }
        }
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $message = 'No se ha borrado el elemento correctamente';
        $type = 'danger';
        if($request->session()->exists('resources')) {
          $resources = $request->session()->get('resources');
          if(isset($resources[$id])) {
              unset($resources[$id]);
              $request->session()->put('resources', $resources);
              $message = 'Se ha borrado el elemeto';
              $type = 'success';
          }
        }
        $data = [];
        $data['message'] = $message;
        $data['type'] = $type;
        return redirect('resource')->with($data);
    }
    
    
    function flush(Request $request) {
        $request->session()->flush( );
        return redirect('resource')->with('message','Todos los elementos han sido borrados Correctamente');
    }
}
