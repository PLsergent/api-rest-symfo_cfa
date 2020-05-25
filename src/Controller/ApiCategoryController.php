<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ApiCategoryController extends AbstractController
{
    /**
     * @Route("/api/category", name="api_category", methods={"GET"})
     */
    public function index(CategoryRepository $categoryRepository, SerializerInterface $serializer) {
        $categories = $categoryRepository->findAll();
        $json = $serializer->serialize($categories, 'json', ['groups' => 'category:read']);
        $reponse = new Response($json, 200, [
            "Content-Type" => "application/json"
        ]);
        return $reponse;
    }

    /**
     * @Route("/api/category", name="api_category_create", methods={"POST"})
     */
    public function createCategory(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, ValidatorInterface $validator) {
        $jsonRequest = $request->getContent();
        try {
            $category = $serializer->deserialize($jsonRequest, Category::class, "json");
            $errors = $validator->validate($category);
            if (count($errors) > 0) {
                return $this->json([$errors, 400]);
            }

            $hasAccess = $this->isGranted('ROLE_ADMIN');

            if (!$hasAccess) {
                return $this->json([
                    'status' => 403
                    ]);
            }

            $em->persist($category);
            $em->flush();

            return $this->json($category, 201, [], ['groups' => 'category:read']);
        } catch (NotEncodableValueException $e) {
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400);

        }
    }
}
