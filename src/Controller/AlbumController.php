<?php

namespace App\Controller;

use App\Form\AlbumType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Album;

class AlbumController extends AbstractController
{
    /**
     * @Route("/album", name="album")
     */
    public function index()
    {
        return $this->render('Album/index.html.twig', [
            'controller_name' => 'AlbumController',
        ]);
    }

    /**
     * @Route("/album/edit/{id}", name="edit", requirements={"id"="\d+"})
     * @param Album $album
     * @return Response
     */
    public function edit(Album $album)
    {
        $form = $this->createForm(AlbumType::class, $album);

        return $this->render('Album/edit.html.twig', ['formulaire' => $form->createView()]);
    }

    /**
     * @Route("/album/delete/{id}", name="delete", requirements={"id"="\d+"})
     * @param Album $album
     * @return Response
     */
    public function delete(Album $album)
    {
        return $this->render('Album/delete.html.twig');
    }

    /**
     * @Route("/new", name="new")
     */
    public function new()
    {
        return $this->render('Album/new.html.twig');
    }
}
