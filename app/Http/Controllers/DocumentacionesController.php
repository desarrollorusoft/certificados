<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DocumentacionesRequest;
use App\Repositories\Documentaciones\DocumentacionesRepository;
use App\Documentaciones;

class DocumentacionesController extends Controller
{

    Protected $documentaciones;

    public function __construct(DocumentacionesRepository $documentacionesRepository)
    {
      $this->documentaciones = $documentacionesRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  $this->documentaciones->getAll();
    }

    public function callView()
    {
        $user = auth()->user()->name;
        $header_titulo = "Documentaciones";
        $header_descripcion ="Alta | Baja | Modificación";      
        return view('abm.documentaciones',compact('user','header_titulo','header_descripcion'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentacionesRequest $request)
    {
        
        return $this->documentaciones->store($request);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
