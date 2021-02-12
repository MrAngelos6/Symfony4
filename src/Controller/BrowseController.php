<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Artist;
use App\Entity\Album;
use App\Entity\Track;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;


class BrowseController extends AbstractController
{
    /**
     * @Route("/artists",name="artists")
     */
    public function artists()
    {
        return $this->render('browse/artists.html.twig');
    }

    /**
     * @route("/artists/",name="artists")
     */
    public function listeArtists()
    {
        $artists = $this->getDoctrine()->getRepository(Artist::class)->findBy(array(), array("name" => "ASC"));
        if (!$artists) {
            throw $this->createNotFoundException('No Artists found');
        }
        return $this->render('browse/artists.html.twig', array('artists' => $artists));
    }

    /**
     * @route("albums/{artistID}",name="albums")
     * @param int $artistID
     * @return Response
     */

    public function albums(int $artistID)
    {
        $artist = $this->getDoctrine()->getRepository(Artist::class)->find($artistID);
        $albums = $this->getDoctrine()->getRepository(Album::class)->findBy(array('artist' => $artistID));

        if (!$artist) {
            throw $this->createNotFoundException("Error 404 - l'artiste n'existe pas");
        }

        return $this->render('browse/albums.html.twig', array('artist' => $artist, 'albums' => $albums));
    }

    /**
     * @route("/tracks/{id}",name="tracks")
     * @param Album $album
     * @Entity("album", expr="repository.findWithTracksAndSongs(id)")
     * @return Response
     */
    public function tracks(Album $album)
    {
//        $tracks = $this->getDoctrine()->getRepository(Track::class)->findBy(array('album' => $album), array("number" => "ASC"));
        if (!$album) {
            throw $this->createNotFoundException('No Album found');
        }
        return $this->render('browse/tracks.html.twig', array('album' => $album));
    }

}
