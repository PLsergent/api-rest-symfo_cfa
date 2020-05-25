<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ApiProductController extends AbstractController
{
    /**
     * @Route("/api/category", name="api_product", methods={"GET"})
     */
    public function index(ProductRepository $productRepository, SerializerInterface $serializer) {
        $products = $productRepository->findAll();
        $json = $serializer->
        serialize($products, 'json', ['groups' => 'product:read']);
        $reponse = new Response($json, 200, [
            "Content-Type" => "application/json"
        ]);
        return $reponse;
    }

    /**
     * @Route("/api/category", name="api_category_create", methods={"POST"})
     */
    public function createCateory(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, ValidatorInterface $validator) {
        $jsonRequest = $request->getContent();
        try {
            $product = $serializer->deserialize($jsonRequest, Product::class, "json");
            $errors = $validator->validate($product);
            if (count($errors) > 0) {
                return $this->json([$errors, 400]);
            }

            $hasAccess = $this->isGranted('ROLE_ADMIN');

            if (!$hasAccess) {
                return $this->json([
                    'status' => 403
                    ]);
            }

            $em->persist($product);
            $em->flush();

            return $this->json($product, 201, [], ['groups' => 'product:read']);
        } catch (NotEncodableValueException $e) {
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400);

        }
    }
}
