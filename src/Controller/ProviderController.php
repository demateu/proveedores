<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Csrf\CsrfToken;



//Modelos
use App\Entity\Provider;

class ProviderController extends AbstractController
{

    /**
     * @author demateu
     * 
     * @Route("/proveedores", name="proveedor.index")
     * 
     * Lista todos los proveedores paginados
     */
    public function index(EntityManagerInterface $entityManager, PaginatorInterface $paginator, Request $request): Response
    {
        // Obtener todos los proveedores
        /*
        $proveedores = $this->getDoctrine()->getRepository(Provider::class)->findAll();
        return $this->render('provider/index.html.twig', [
            'proveedores' => $proveedores,
        ]);
        */

        $queryBuilder = $entityManager->getRepository(Provider::class)->createQueryBuilder('p');

        // Ordenar por fecha de actualizacion y despues de creación
        $queryBuilder->orderBy('p.updated_at', 'DESC'); // Ordena por updatedAt (modificado más recientemente)
        $queryBuilder->addOrderBy('p.created_at', 'DESC'); // Luego ordena por createdAt (creado más recientemente)

        // Pagina los resultados de la consulta
        $pagination = $paginator->paginate(
            $queryBuilder, 
            $request->query->getInt('page', 1), // página actual
            10 // resultados por página
        );

        return $this->render('provider/index.html.twig', [
            'proveedores' => $pagination,
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
     * @author demateu
     * Guardar los datos en la BBDD
     * 
     * @Route("/proveedor/store", name="proveedor.store", methods={"POST"})
     */
    public function store(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Obtener el tipo de proveedor desde los datos del formulario o cualquier otra fuente
        $tipo = $request->request->get('tipo_proveedor');

        // Crear una nueva instancia de la entidad Provider
        $proveedor = new Provider();

        // Obtener los datos del formulario
        $proveedor->setNombre($request->request->get('nombre'));
        $proveedor->setEmail($request->request->get('email'));
        $proveedor->setTelefono($request->request->get('telefono'));
        $proveedor->setTipo($tipo);
        $proveedor->setEstado($request->request->get('status') ? true : false);

        // Persistir y guardar los datos en la base de datos
        $entityManager->persist($proveedor);
        $entityManager->flush();

        // Redirigir y devolver una respuesta
        $this->addFlash('success', '¡Proveedor '.$proveedor->getId().' creado exitosamente!');
        return $this->redirectToRoute('proveedor.index');
    }


    /**
     * @author demateu
     * Muestra el proveedor seleccionado
     *
     * @param int $id El ID del proveedor
     * @Route("/proveedores/{id}", name="proveedor.show", methods={"GET"})
     */
    public function show($id)
    {
        $proveedor = $this->getDoctrine()->getRepository(Provider::class)->find($id);

        // Verificar si el proveedor existe
        if (!$proveedor) {
            throw $this->createNotFoundException('El proveedor no existe.');
        }

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
     * @author demateu
     * Actualiza los datos de el proveedor seleccionado
     * 
     * @Route("/proveedor/{id}/actualizar", name="proveedor.update", methods={"POST"})
     */
    public function update(Request $request, EntityManagerInterface $entityManager, $id): Response
    {
        // Obtener el proveedor por su ID
        $proveedor = $entityManager->getRepository(Provider::class)->find($id);

        if (!$proveedor) {
            throw $this->createNotFoundException(
                'No se encontró el proveedor con el ID ' . $id
            );
        }

        // Obtener los datos del formulario y actualizarlos
        $proveedor->setNombre($request->request->get('nombre'));
        $proveedor->setEmail($request->request->get('email'));
        $proveedor->setTelefono($request->request->get('telefono'));
        $proveedor->setTipo($request->request->get('tipo_proveedor'));
        $proveedor->setEstado($request->request->get('status') ? true : false);

        // Guardar los cambios en la base de datos
        $entityManager->flush();

        // Redirigir y devolver una respuesta -> QUE MUESTRE LOS MENSAJES EN ALERT EN LA BASE TWIG...
        $this->addFlash('success', '¡Proveedor '.$proveedor->getId().' modificado exitosamente!');
        return $this->redirectToRoute('proveedor.index');
    }


    /**
     * @author demateu
     * Elimina el proveedor que se indica
     * 
     * @Route("/proveedores/{id}/eliminar", name="proveedor.destroy", methods={"DELETE"})
     */
    public function destroy(Request $request, EntityManagerInterface $entityManager, CsrfTokenManagerInterface $csrfTokenManager, Provider $proveedor): Response
    {
        // Verificar si el token CSRF es válido
        $token = $request->request->get('_token');
        if (!$csrfTokenManager->isTokenValid(new CsrfToken('eliminar' . $proveedor->getId(), $token))) {
            throw new \Exception('Token CSRF inválido.');
        }

        // Eliminar el proveedor
        $entityManager->remove($proveedor);
        $entityManager->flush();

        // Redirigir a la página de listado de proveedores u otra página
        $this->addFlash('success', 'Esperemos que no haya sido un error porqué acabas de eliminar el proveedor.');
        return $this->redirectToRoute('proveedor.index');
    }



}
