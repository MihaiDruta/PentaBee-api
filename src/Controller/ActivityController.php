<?php

namespace App\Controller;

use App\Entity\Activity;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Activity controller.
 * @Route("/api", name="api_")
 */
class ActivityController extends AbstractController
{
    /**
     * Lists all Activities.
     * @Rest\Get("/activities")
     *
     * @param SerializerInterface $serializer
     * @return Response
     */
    public function getActivitiesList(SerializerInterface $serializer): Response
    {
        $activities = $this->getDoctrine()->getRepository(Activity::class)->findAll();

        /** @var SerializationContext $context */
        $context = SerializationContext::create()->setGroups(array('ActivityList'));

        $json = $serializer->serialize(
            $activities,
            'json',
            $context
        );

        return new JsonResponse($json, 200, [], true);
    }

    /**
     * Lists all Activities.
     * @Rest\Get("/activities/{id}")
     *
     * @param SerializerInterface $serializer
     * @return Response
     */
    public function getActivityDetails(SerializerInterface $serializer, $id): Response
    {
        $activity = $this->getDoctrine()->getRepository(Activity::class)->find($id);

        /** @var SerializationContext $context */
        $context = SerializationContext::create()->setGroups(array('ActivityDetails'));

        $json = $serializer->serialize(
            $activity,
            'json',
            $context
        );

        return new JsonResponse($json, 200, [], true);
    }
}
