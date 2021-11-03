<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ApiPostController extends AbstractController
{
    /**
     * @Route("/api/post", name="api_post",methods="GET")
     */
    public function index(PostRepository $repo): Response
    {
        return $this->json($repo->findAll(),200,[],['groups' => 'post:read']);
	}
	/**
     * @Route("/api/post", name="api_post_add",methods="POST")
     */
    public function add(Request $request,SerializerInterface $serializer,EntityManagerInterface $em): Response
    {
    	$post = $serializer->deserialize($request->getContent(),Post::class,'json');
    	$post->setCreateAt(new \DateTime);
    	$em->persist($post);
    	$em->flush();
        return $this->json($post,201,[],['groups'	=> 'post:read']);
	}
}
