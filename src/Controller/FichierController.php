<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FichierController extends AbstractController {
    #[Route('/fichier/{correction}', name: 'app_fichier')]
    public function __invoke(Request $request, string $correction): Response {
        $file = $request->files->get('file');
        if (!$file)
            return new Response("Aucun fichier réceptionné lors de la requête.", 400);
        $fileContent = $file->getContent();

        switch ($correction) {
            case 'majuscule':
                $correctionContent = strtoupper($fileContent);
                break;
            case 'minuscule':
                $correctionContent = strtolower($fileContent);
                break;
            default:
                return new Response("Ce type de correction n'est pas reconnu.");
        }

        $response = new Response($correctionContent);
        $response->headers->set('Content-Type', 'text/plain');
        $response->headers->set('Content-Disposition', 'attachment;filename="correctedFile.txt');

        return $response;
    }
}
