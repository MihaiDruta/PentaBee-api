<?php

namespace App\Service;

use App\DTO\ActivityDTO;
use App\Entity\Activity;
use App\Entity\Technology;
use App\Entity\Type;
use App\Entity\User;
use App\Repository\TechnologyRepository;
use App\Repository\TypeRepository;
use App\Repository\UserRepository;
use Exception;

class ActivityTransformer
{

    /**
     * @var UserRepository
     */
    private $userRepo;
    /**
     * @var TechnologyRepository
     */
    private $techRepo;
    /**
     * @var TypeRepository
     */
    private $typeRepo;

    public function __construct(
        UserRepository $userRepo,
        TechnologyRepository $techRepo,
        TypeRepository $typeRepo
    ) {
        $this->userRepo = $userRepo;
        $this->techRepo = $techRepo;
        $this->typeRepo = $typeRepo;
    }

    public function checkTechnologyIntegrity(Technology $technology): bool
    {
        if ($technology === null) {
            throw new Exception('Technology type Object cannot be null.');
        }
        return true;
    }

    public function checkTypeIntegrity(Type $type): bool
    {
        if ($type === null) {
            throw new Exception('ActivityType type Object cannot be null.');
        }
        return true;
    }

    public function transform(
        ActivityDTO $dto
    ): Activity {

        $entity = new Activity();
        $entity->setName($dto->name);
        $entity->setDescription($dto->description);
        $entity->setApplicationDeadline($dto->applicationDeadline);
        $entity->setFinalDeadline($dto->finalDeadline);
        $entity->setCreatedAt($dto->createdAt);
        $entity->setUpdatedAt($dto->updatedAt);
        $entity->setStatus($dto->status);

        /** @var User $tempUser */
        $tempUser = $this->userRepo->find($dto->owner);
        $entity->setOwner($tempUser);

        /** @var Technology $tech */
        foreach ($dto->technologies as $tech) {
            $techID = $tech->getId();
            $techToAdd = $this->techRepo->find($techID);
            try {
                $this->checkTechnologyIntegrity($techToAdd);
            } catch (Exception $exception) {
                echo 'Message: ' . $exception->getMessage();
            }
            $entity->addTechnology($techToAdd);
        }

        /** @var Type $type */
        foreach ($dto->types as $type) {
            $typeID = $type->getId();
            $typeToAdd = $this->typeRepo->find($typeID);
            try {
                $this->checkTypeIntegrity($typeToAdd);
            } catch (Exception $exception) {
                echo 'Message: ' . $exception->getMessage();
            }
            $entity->addType($typeToAdd);
        }
        return $entity;
    }
}
