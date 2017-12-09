<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CartRepository")
 */
class Cart
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CartProduct", mappedBy="cart")
     */
    private $cart_product;


    public function getId()
    {
        return $this->id;
    }

    public function getCart_products()
    {
        return $this->cart_product;
    }

    public function __construct() {
        $this->cart_product = new ArrayCollection();
    }
}
