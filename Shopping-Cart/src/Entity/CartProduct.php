<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CartProductRepository")
 */
class CartProduct
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
    * @ORM\Column(type="integer")
    */
    private $quantity;


    /**
     * @ORM\ManyToOne(targetEntity="Cart", inversedBy="cart_product")
     * @ORM\JoinColumn(name="cart_id", referencedColumnName="id")
     */
    private $cart;

    /**
    * @ORM\ManyToOne(targetEntity="Product", inversedBy="product_cart")
    * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
    */
    private $product;

    


    // public function getProducts()
    // {
    //     //return $this->cart_product->getProducts();
    // }

     public function getId()
     {
        return $this->id;
     }
     public function setProduct(Product $product)
     {
        $this->product = $product;
     }

     public function getProduct()
     {
        return $this->product;
     }

     public function setCart(Cart $cart)
     {
        $this->cart = $cart;
     }

     public function getCart()
     {
        return $this->cart;
     }

     public function setQuantity($quantity)
     {
        $this->quantity = $quantity;
     }

     public function getQuantity()
     {
        return $this->quantity;
     }
}
