<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 8/9/18
 * Time: 7:09 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="request_info")
 */
class RequestInfo
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=64, nullable=TRUE )
     *
     */
    protected $requestTime;

    /**
     * @ORM\Column(type="string", length=64, nullable=TRUE )
     */
    protected $shortLink;

    /**
     * @ORM\Column(type="string", length=64, nullable=TRUE )
     */
    protected $queryString;

    /**
     * @ORM\Column(type="string", length=64, nullable=TRUE )
     */
    protected $httpReferer;

    /**
     * @ORM\Column(type="string", length=256, nullable=TRUE )
     */
    protected $httpUserAgent;

    /**
     * @ORM\Column(type="string", length=64, nullable=TRUE )
     */
    protected $remoteAddr;

    /**
     * @ORM\Column(type="string", length=64, nullable=TRUE )
     */
    protected $remoteHost;

    /**
     * @ORM\Column(type="string", length=24, nullable=TRUE )
     */
    protected $location;


    /**
     * used for statistic
     * @var int
     */
    public $cnt;


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
     * @return int
     */
    public function getCnt()
    {
        return $this->cnt;
    }

    /**
     * @param int $cnt
     */
    public function setCnt($cnt)
    {
        $this->cnt = $cnt;
    }

    /**
     * @return mixed
     */
    public function getRequestTime()
    {
        return $this->requestTime;
    }

    /**
     * @param mixed $requestTime
     */
    public function setRequestTime($requestTime)
    {
        $this->requestTime = $requestTime;
    }

    /**
     * @return mixed
     */
    public function getQueryString()
    {
        return $this->queryString;
    }

    /**
     * @param mixed $queryString
     */
    public function setQueryString($queryString)
    {
        $this->queryString = $queryString;
    }

    /**
     * @return mixed
     */
    public function getHttpReferer()
    {
        return $this->httpReferer;
    }

    /**
     * @param mixed $httpReferer
     */
    public function setHttpReferer($httpReferer)
    {
        $this->httpReferer = $httpReferer;
    }

    /**
     * @return mixed
     */
    public function getHttpUserAgent()
    {
        return $this->httpUserAgent;
    }

    /**
     * @param mixed $httpUserAgent
     */
    public function setHttpUserAgent($httpUserAgent)
    {
        $this->httpUserAgent = $httpUserAgent;
    }

    /**
     * @return mixed
     */
    public function getRemoteAddr()
    {
        return $this->remoteAddr;
    }

    /**
     * @param mixed $remoteAddr
     */
    public function setRemoteAddr($remoteAddr)
    {
        $this->remoteAddr = $remoteAddr;
    }

    /**
     * @return mixed
     */
    public function getRemoteHost()
    {
        return $this->remoteHost;
    }

    /**
     * @param mixed $remoteHost
     */
    public function setRemoteHost($remoteHost)
    {
        $this->remoteHost = $remoteHost;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }


}