<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProviderController extends AbstractController
{
    /**
     * @Route("/provider", name="app_provider")
     */
    public function index(): Response
    {
        return $this->render('provider/index.html.twig', [
            'controller_name' => 'ProviderController',
            //...
        ]);
    }

    /**
     * @author demateu
     * 
     * @Route("/proveedores/crear", name="crear.proveedor")
     * 
     * Muestra el formulario para crear un nuevo proveedor
     */
    public function create()
    {
        return $this->render('provider/create.html.twig');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*
    public function store(Request $request)
    {
        //
    }
    */

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cupon  $cupon
     * @return \Illuminate\Http\Response
     */
    public function show($proveedor)
    {
        return $this->render('provider/show.html.twig', [
            'proveedor' => $proveedor,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cupon  $cupon
     * @return \Illuminate\Http\Response
     */
    /*
    public function edit($proveedor)
    {
        //
    }
    */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cupon  $cupon
     * @return \Illuminate\Http\Response
     */
    /*
    public function update(Request $request, $proveedor)
    {
        //
    }
    */

    /**
     * @author demateu
     * Elimina el proveedor que se indica
     * 
     * @Route("/proveedores/eliminar/{id}", name="eliminar.proveedor", methods={"DELETE"})
     */
    public function destroy($id)
    {
        return $this->render('provider/index.html.twig', [

        ]);
    }



}
