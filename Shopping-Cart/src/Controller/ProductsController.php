<?php
// src/Controller/ProductController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Product;


class ProductsController extends Controller
{
    /**
     * @Route ("/products")
     */
     public function index(): Response
     {
        //  $em = $this->getDoctrine()->getManager();
        //  $product = new Product();
        //  $product->setName("testName");
        //  $product->setDesc("testDesc");
        //  $product->setQuantity(3);
        //  $product->setPrice(1250.5);

        //  $em->persist($product);
        //  $em->flush();
        //  $products = array(
        //      ['id' => 1,
        //       'name' => 'car',
        //       'desc' => 'a blue car.', 
        //       'quantity' => 10, 
        //       'price' => 1000],
        //      ['id' => 2,
        //       'name' => 'motocycle',
        //       'desc' => 'a red motocycle.',
        //       'quantity' => 5, 
        //       'price' => 800],
        //      ['id' => 3,
        //       'name' => 'plane',
        //       'desc' => 'a green plane.',
        //       'quantity' => 2,
        //       'price' => 1500]
        //  );

         $repository = $this->getDoctrine()
         ->getRepository("App\Entity\Product");
        
         
         
         $products = $repository->findAll();


         $data = array(
            'products' => $products
         );
         return $this->render('/products.html.twig', array(
            'data' => $data
         ));
     }

     /**
      * @Route ("/products/add")
      */
      public function addProducts()
      {

        // $product = new Product();

        // $form = $this->createForm(ProductType::class, $product);

        // $form->handleRequest($request);
        // if ($form->isSubmitted() && $form->isValid()) {

        // }
        return new Response("TODO");
      }


}