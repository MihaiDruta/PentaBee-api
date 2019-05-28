<?php


namespace App\Service;

use App\DTO\TechnologyDTO;
use App\Entity\Technology;

class TechnologyTransformer
{
    public function transform(TechnologyDTO $dto): Technology
    {
        $entity = new Technology();
        $entity->setName($dto->name);
        $entity->setDescription($dto->description);
        $entity->setCreatedAt($dto->createdAt);
        $entity->setUpdatedAt($dto->updatedAt);

        return $entity;
    }

    public function inverseTransform(Technology $entity): TechnologyDTO
    {
        $dto = new TechnologyDTO();
        $dto->name = $entity->getName();
        $dto->description = $entity->getDescription();
        $dto->createdAt = $entity->getCreatedAt();
        $dto->updatedAt = $entity->getUpdatedAt();

        return $dto;
    }

}