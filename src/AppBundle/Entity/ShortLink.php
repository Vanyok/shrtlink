<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 8/9/18
 * Time: 5:47 PM
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="short_link")
 */
class ShortLink
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=512)
     */
    protected $origLink;

    /**
     * @ORM\Column(type="string", length=64)
     */
    protected $shortLink;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $expirationDate;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getOrigLink()
    {
        return $this->origLink;
    }

    /**
     * @param mixed $origlink
     */
    public function setOrigLink($origLink)
    {
        $this->origLink = $origLink;
    }

    /**
     * @return mixed
     */
    public function getShortLink()
    {
        return $this->shortLink;
    }

    /**
     * @param mixed $shortLink
     */
    public function setShortLink($shortLink)
    {
        $this->shortLink = $shortLink;
    }

    /**
     * @return mixed
     */
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }

    /**
     * @param mixed $expirationDate
     */
    public function setExpirationDate($expirationDate)
    {
        $this->expirationDate = $expirationDate;
    }


}