<?php


namespace App\Service;

use App\DTO\TypeDTO;
use App\Entity\Type;

class TypeTransformer
{
    public function transform(TypeDTO $dto): Type
    {
        $entity = new Type();
        $entity->setName($dto->name);
        $entity->setDescription($dto->description);
        $entity->setCreatedAt($dto->createdAt);
        $entity->setUpdatedAt($dto->updatedAt);

        return $entity;
    }

    public function inverseTransform(Type $entity): TypeDTO
    {
        $dto = new TypeDTO();
        $dto->name = $entity->getName();
        $dto->description = $entity->getDescription();
        $dto->createdAt = $entity->getCreatedAt();
        $dto->updatedAt = $entity->getUpdatedAt();

        return $dto;
    }
}
