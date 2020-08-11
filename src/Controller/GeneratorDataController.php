<?php

namespace App\Controller;

use App\Entity\GeneratorData;
use App\Form\GeneratorDataType;
use App\Serializer\FormErrorSerializer;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\FileParam;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Serializer\Normalizer\FormErrorNormalizer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 *Api controller.
 * @Route("/api",name="api_")
 */
class GeneratorDataController extends AbstractFOSRestController
{
    /**
     * @Rest\Post("/generator/data", name="generator_data_create")
     * @Rest\View()
     * @param Request $request
     * @param FormErrorSerializer $errorSerializer
     * @return JsonResponse
     */
    public function postGeneratorData(Request $request, FormErrorSerializer $errorSerializer)
    {
        $data = json_decode($request->getContent(), true);
        $form = $this->createForm(GeneratorDataType::class, new GeneratorData());
        $form->submit($data);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();
            return new JsonResponse([
                'status' => 'created'
            ], JsonResponse::HTTP_OK
            );
        }
        return new JsonResponse([
            "response" => $errorSerializer->convertFormToArray($form
            )], JsonResponse::HTTP_BAD_REQUEST
        );
    }
}
