<?php

namespace AppBundle\Controller;

use AppBundle\Services\UrlService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="shrtlnk_homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/statistic/{slug}", name="shrtlnk_statistic")
     */
    public function statisticAction(Request $request)
    {
        $service = new UrlService($this->getDoctrine()->getManager());
        $url = $service->getShortUrl($request);
        if (isset($url))
            return $this->render('default/statistic.html.twig', [
                'url' => $url,
                'requests' => $service->getRequestsForStatistic($url->getShortLink()),
                'locations' => $service->getLocationsForStatistic($url->getShortLink()),
            ]);
        else {
            return $this->redirectToRoute('shrtlnk_homepage', array(), 301);
        }

    }

    /**
     * @Route("/create", name="shrtlnk_create")
     */
    public function createLinkAction(Request $request)
    {

        $service = new UrlService($this->getDoctrine()->getManager());
        return new Response(json_encode($response = [
            'status' => 'ok',
            'html' => $this->renderView('default/result.html.twig', ['url' => $service->generateUrl($request)])
        ]));
    }

    /**
     * @Route("/{slug}", name="shrtlnk_redirect")
     */
    public function redirectAction(Request $request)
    {
        $service = new UrlService($this->getDoctrine()->getManager());
        $url = $service->getOriginalUrl($request);
        $now = time();
        if (isset($url) && $url->getExpirationDate()->getTimestamp() > $now)
            return $this->redirect($url->getOrigLink());
        else {
            return $this->redirectToRoute('shrtlnk_homepage', array(), 301);
        }
    }

}
