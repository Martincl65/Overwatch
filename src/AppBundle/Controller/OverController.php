<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OverController extends Controller
{

    public function indexAction($name)
    {
        /*test*/
        $curl = curl_init("http://ow-api.herokuapp.com/profile/pc/eu/".$name);
        curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, true );
        curl_setopt ( $curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC );
        curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, false );
        $json = curl_exec ( $curl );
        $obj = json_decode ( $json, true );
        curl_close ( $curl );

        $curl = curl_init("https://owapi.net/api/v3/u/".$name."/blob");
        curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, true );
        curl_setopt ( $curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC );
        curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt($curl,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        $json = curl_exec ( $curl );
        $stats = json_decode ( $json, true );
        curl_close ( $curl );

        return $this->render('AppBundle:default:index.html.twig', array('api' => $obj, 'stats' => $stats));
    }
}
