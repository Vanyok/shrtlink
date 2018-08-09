<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 8/9/18
 * Time: 6:02 PM
 */

namespace AppBundle\Services;

use AppBundle\Entity\RequestInfo;
use AppBundle\Entity\ShortLink;
use DateTime;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class UrlService
{
    /**
     * @var EntityManager;
     */
    private $em;

    /**
     * UrlCoder constructor.
     * @param $entityManager
     */
    public function __construct($entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * generate and store short url to db
     *
     * @param Request $request
     * @return ShortLink|null
     */
    public function generateUrl($request)
    {
        $shortUrl = null;
        $origUrl = $request->get('link');
        $date = $request->get('exp_date');
        $date = isset($date) && !empty($date) ? DateTime::createFromFormat('Y-m-d', $date) : null;
        if (isset($origUrl) && $origUrl != '') {
            $shortUrl = new ShortLink();
            $shortUrl->setShortLink(base64_encode(time() % 10000));
            $shortUrl->setOrigLink($origUrl);
            $shortUrl->setExpirationDate($date);
            $this->em->persist($shortUrl);
            $this->em->flush();
        }
        return $shortUrl;
    }

    /**
     * @param  $slug
     * @return array|object[]
     */
    public function getRequestsForStatistic($slug)
    {
        $requests = $this->em->getRepository(RequestInfo::class)->findBy(['shortLink' => $slug]);
        return $requests;
    }

    /**
     *
     * @param ShortLink $slug
     * @return array|object[]
     */
    public function getLocationsForStatistic($slug)
    {
        $query = $this->em->createQuery(
            'SELECT count(r.id) as cnt ,  r.location 
    FROM AppBundle:RequestInfo r
    WHERE r.shortLink = :link
    GROUP BY r.location '
        )->setParameter('link', $slug);

        return $query->getResult();
    }

    /**
     * @param Request $request
     * @return ShortLink|null
     */
    public function getOriginalUrl($request)
    {
        $slug = $request->get('slug');
        $shortLink = $this->em->getRepository(ShortLink::class)->findOneBy(['shortLink' => $slug]);
        if (isset($shortLink)) {
            $info = new RequestInfo();
            $info->setShortLink($slug);
            $info->setRequestTime($request->server->get('REQUEST_TIME'));
            $info->setQueryString($request->server->get('QUERY_STRING'));
            $info->setHttpReferer($request->server->get('HTTP_REFERER'));
            $info->setHttpUserAgent($request->server->get('HTTP_USER_AGENT'));
            $info->setRemoteAddr($request->server->get('REMOTE_ADDR')); //ip
            $info->setRemoteHost($request->server->get('REMOTE_HOST'));
            $info->setLocation($this->getLocalityFromIP($request->server->get('REMOTE_ADDR')));
            $this->em->persist($info);
            $this->em->flush();
            return $shortLink;
        } else {
            return null;
        }

    }

    /**
     * @param Request $request
     * @return ShortLink|null
     */
    public function getShortUrl($request)
    {
        $slug = $request->get('slug');
        $url = $this->em->getRepository(ShortLink::class)->findOneBy(['shortLink' => $slug]);
        return $url;
    }


    private function getLocalityFromIP($ip)
    {
        //TODO: create functionality geodecode IP instead this mok-up;
        return "ua";
    }

}