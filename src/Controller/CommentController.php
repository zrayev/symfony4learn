<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class CommentController extends AbstractController
{
    public function new(Request $request)
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form
            ->add('save', SubmitType::class, ['label' => 'Save', 'attr' => ['class' => 'btn btn-default pull-right']]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
//            $comment = $form->getData();

            return $this->redirectToRoute('create_comment');
        }

        return $this->render('comment/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
