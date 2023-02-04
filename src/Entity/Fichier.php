<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use App\Controller\FichierController;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[ApiResource(
    operations: [
        new Post(
            controller: FichierController::class,
            deserialize: false
        )
    ]
)]
class Fichier {
    #[ApiProperty(identifier: true)]
    private ?int $id = null;

    private UploadedFile $uploadedFile;

    public function getId(): ?int {
        return $this->id;
    }

    public function getUploadedFile() {
        return $this->uploadedFile;
    }

    public function setUploadedFile(UploadedFile $uploadedFile): self {
        $this->uploadedFile = $uploadedFile;

        return $this;
    }
}
