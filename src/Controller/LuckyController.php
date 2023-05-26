<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/lucky")
 */
class LuckyController extends AbstractController
{
    /**
     * @Route("/number")
     */
    public function number()
    {
        $number = rand(0, 100);

        // return new Response(
        //     '<html><body>Lucky number: '.$number.'</body></html>'
        // );

        return $this->render('lucky/number.html.twig', [
            'number' => $number,
        ]);
    }

    /**
     * @Route("/api/posts/{id}", methods={"GET","HEAD"})
     */
    public function show(int $id): Response
    {
        // ... return a JSON response with the post
        return new Response(
            '<html><body>Lucky number: 1</body></html>'
        );
    }

    /**
     * @Route("/api/posts/{id}", methods={"PUT"})
     */
    public function edit(int $id): Response
    {
        // ... edit a post
        return new Response(
            '<html><body>Lucky number: 2</body></html>'
        );
    }
}