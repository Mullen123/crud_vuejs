<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //registos totales
       // $tasks = Task::get();
      //  return $tasks;



        //paginacion en forma descendente y que solo me muestre 4
        $tasks = Task::orderBy('id','Desc')->paginate(10);

        return[
            //controlas la paginacion
            'pagination'=>[

                'total' => $tasks->total(),
                'current_page' => $tasks->currentPage(),
                'per_page' => $tasks->perPage(),
                'last_page' => $tasks->lastPage(),
                'from' => $tasks->firstItem(),
                'to' => $tasks->lastPage(),
            
            ],
            //controla los registros que se ven en pantalla
            'tasks' => $tasks



        ];

    

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[

            'keep' =>'required'
        ]);

        //entras al modelo y metodo create
        Task::create($request->all());
        return;
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
             
             $this->validate($request,[

            'keep' =>'required'
        ]);

             //si pasaentonces actualiza

             Task::find($id)->update($request->all());

             return;

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tasks = Task::findOrFail($id);
        $tasks->delete();
    }
}
