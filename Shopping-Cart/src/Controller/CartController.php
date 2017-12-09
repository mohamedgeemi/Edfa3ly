<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\{Cart, Product, CartProduct};


class CartController extends Controller
{
    private static $cart;

    private function generateCart()
    {
        if (! CartController::$cart)
        {
            $em = $this->getDoctrine()->getManager();
            $repo = $this->getDoctrine()->getRepository(Cart::class);

            CartController::$cart = $repo->find(1);
            if (!CartController::$cart)
            {
                CartController::$cart = new Cart();
                $em->persist(CartController::$cart);
                $em->flush();
            }
        }
    }
    /**
     * @Route("/cart", name="cart")
     */
    public function index()
    {
        // One Cart only
        $this->generateCart();

        $repository = $this->getDoctrine()
        ->getRepository("App\Entity\Cart");
       
        $cart = $repository->find(CartController::$cart->getId());

        $items = $cart->getCart_products();


        $data = array(
           'items' => $items
        );
        return $this->render('/cart.html.twig', array(
           'data' => $data
        ));
    }

    /**
     * @Route("/cart/add/{product_id}/{quantity}")
     * @Entity("product", expr="repository.find(product_id)")
     */
    public function addProduct(Product $product, $quantity)
    {
        // One Cart only
        $this->generateCart();

        //return new Response($product->getName());
        $repository = $this->getDoctrine()
        ->getRepository("App\Entity\CartProduct");

        $cart_product = $repository->findOneBy([
            'product' => $product,
            'cart' => CartController::$cart,
        ]);

        if (!$cart_product){
            $cart_product = new CartProduct();
            
            $cart_product->setQuantity($quantity);
            $cart_product->setProduct($product);
            $cart_product->setCart(CartController::$cart);
        }
        else{
            $cart_product->setQuantity($cart_product->getQuantity() + $quantity);
        }
        
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($cart_product);
        $em->flush();

        return new Response();
    }

    /**
     * @Route("/cart/update/{cart_product_id}/{quantity}")
     * @Entity("cart_product", expr="repository.find(cart_product_id)")
     */
    public function updateCart(CartProduct $cart_product, $quantity)
    {
        $em = $this->getDoctrine()->getManager();

        if ($quantity == 0)
        {
            $em->remove($cart_product);
        }
        else
        {
            $cart_product->setQuantity($quantity);
            $em->persist($cart_product);
        }

        $em->flush();

        return new Response();
    }
    
    /**
     * @Route("/cart/empty/")
     */
    public function emptyCart()
    {
        // One Cart only
        $this->generateCart();
        
        $repository = $this->getDoctrine()
        ->getRepository("App\Entity\CartProduct");

        $cart_products = $repository->findBy(
            ['cart' => CartController::$cart]
        );

        $em = $this->getDoctrine()->getManager();

        foreach ($cart_products as $cart_product)
        {
            $em->remove($cart_product);
        }

        $em->flush();
        
        return new Response();
    }
}
