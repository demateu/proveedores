<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\KernelInterface;

class CacheController extends AbstractController
{
    
    /**
     * @Route("/clear-cache", name="clear_cache")
     */
    public function clearCache(KernelInterface $kernel): Response
    {
        $projectDir = $kernel->getProjectDir();

        // Limpiar caché de Symfony (cache:clear)
        $output = [];
        $exitCode = null;
        exec("php {$projectDir}/bin/console cache:clear --no-warmup", $output, $exitCode);

        // Otros comandos para limpiar la configuración, rutas y optimizar
        exec("php {$projectDir}/bin/console cache:clear --env=prod");
        exec("php {$projectDir}/bin/console config:clear");
        exec("php {$projectDir}/bin/console route:clear");
        exec("php {$projectDir}/bin/console cache:warmup --env=prod");

        // Mensaje de confirmación
        $message = "Caché borrada, Configuración limpia!!";

        // Mostrar resultados o redirigir a una página
        return new Response(implode("<br>", $output) . "<br>" . $message);
    }
}
