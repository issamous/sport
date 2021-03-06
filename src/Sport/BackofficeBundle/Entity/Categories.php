<?php

namespace Sport\BackofficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categories
 *
 * @ORM\Table(name="categories")
 * @ORM\Entity(repositoryClass="Sport\BackofficeBundle\Repository\CategoriesRepository")
 */
class Categories
{
    /**
     * @ORM\OneToOne(targetEntity="PhotoCategorie" ,  cascade={"persist" , "remove"} )
     */

    private $photo;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;


    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="parent", type="integer")
     */
    private $parent;

    /**
     * @var int
     *
     * @ORM\Column(name="list_order", type="integer")
     */
    private $listOrder;

    /**
     * @var int
     *
     * @ORM\Column(name="_published", type="integer")
     */
    private $published;

    /**
     * @var int
     *
     * @ORM\Column(name="_isdeleted", type="integer")
     */
    private $isdeleted;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Categories
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set parent
     *
     * @param integer $parent
     *
     * @return Categories
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return int
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set listOrder
     *
     * @param integer $listOrder
     *
     * @return Categories
     */
    public function setListOrder($listOrder)
    {
        $this->listOrder = $listOrder;

        return $this;
    }

    /**
     * Get listOrder
     *
     * @return int
     */
    public function getListOrder()
    {
        return $this->listOrder;
    }

    /**
     * Set published
     *
     * @param integer $published
     *
     * @return Categories
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return int
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set isdeleted
     *
     * @param integer $isdeleted
     *
     * @return Categories
     */
    public function setIsdeleted($isdeleted)
    {
        $this->isdeleted = $isdeleted;

        return $this;
    }

    /**
     * Get isdeleted
     *
     * @return int
     */
    public function getIsdeleted()
    {
        return $this->isdeleted;
    }




    /**
     * Set photo
     *
     * @param \Sport\BackofficeBundle\Entity\PhotoCategorie $photo
     *
     * @return Categories
     */
    public function setPhoto(\Sport\BackofficeBundle\Entity\PhotoCategorie $photo = null)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return \Sport\BackofficeBundle\Entity\PhotoCategorie
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Categories
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
