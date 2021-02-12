<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    /**
     * @Route("/hello/controler", name="hello_controler")
     */
    public function index()
    {
        return $this->render('hello_controller/index.html.twig', [
            'controller_name' => 'HelloController',
        ]);
    }
    /**
     * @Route("/hello/{name}/{times}",requirements={"times"="\d+"}, defaults={"times": 3},name="app_hello_hellomanytimes")
     *
     */
    public function helloManyTimes($name, $times)
    {
        if ($times == 0 || $times > 10) {
            $times = 3;
        }
        return $this->render('hello/hellomanytimes.html.twig', array('name'=>$name,'times'=>$times));
    }
    /**
     * @Route("/hello/{name}")
     */
    public function hello($name)
    {
        return $this->render('hello/hello.html.twig', array('name' => $name));
    }
}
