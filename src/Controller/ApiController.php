<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Blog;
use App\Repository\BlogRepository;

/**
 * @Route("/api")
 */
class ApiController extends AbstractController
{
    /**
     * @Route("/blogs", methods={"get"})
     */
    public function list(Request $request, BlogRepository $blogRepository)
    {
        $param = $request->query->all();

        $result = $blogRepository->list($param);
        // var_dump($result);die();

        return $this->render('api/blog.html.twig', [
            'number' => 1,
            'author' => $param['author'] ?? '',
            'summary' => $param['summary'] ?? '',
            'result' => $result,
        ]);
    }

    /**
     * @Route("/blogs", methods={"post"})
     */
    public function create(Request $request, BlogRepository $blogRepository)
    {
        $param = @json_decode($request->getContent(), true);

        if (empty($param))
            return new Response('Fail: Empty param.');

        $blogRepository->add($param);

        return new Response('Success');
    }

    /**
     * @Route("/blogs", methods={"put"})
     */
    public function update(Request $request, BlogRepository $blogRepository)
    {
        try {
            $param = @json_decode($request->getContent(), true);

            if (empty($param) || empty($param['id']))
                return new Response('Fail: Empty param.');

            $blogRepository->update($param);

            return new Response('Success');
        } catch (\Exception $e) {
            return new Response('Fail: ' . $e->getMessage());
        }
    }

    /**
     * @Route("/blogs", methods={"delete"})
     */
    public function remove(Request $request, BlogRepository $blogRepository)
    {
        try {
            $id = $request->get('id', 0);

            if (empty($id))
                return new Response('Fail: Empty param.');

            $blogRepository->remove($id);

            return new Response('Success');
        } catch (\Exception $e) {
            return new Response('Fail: ' . $e->getMessage());
        }
    }
}