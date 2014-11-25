<?php

namespace WSF\SocialBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use WSF\SocialBundle\Entity\Post;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
{
    /**
     * @Route("/post")
     * @Template()
     */

    public function postAction(Request $request)
    {
        // crée une tâche et lui donne quelques données par défaut pour cet exemple
        $post = new Post();
        $post->setPost('Write a new post');

        $form = $this->createFormBuilder($post)
            ->add('post', 'text')
            ->add('save', 'submit')
            ->getForm();

        $form->handleRequest($request);

	    if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

	        return $this->redirect('/');

	    }

        return array('form' => $form->createView());
    }
}
