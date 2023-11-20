<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Mailer\MailerInterface;

class MailController extends AbstractController
{
    #[Route('/mail', name: 'app_mail')]
    public function sendEmail(Request $request, MailerInterface $mailer): Response
    {
        // Crée le formulaire Symfony
        $form = $this->createFormBuilder()
            ->add('Email', TextType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('Sujet', TextType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('Contenu', TextareaType::class, [
                'label' => 'Corps du message',
                'attr' => ['rows' => 8], // Définissez le nombre de lignes pour le textarea
            ])
            ->add('Envoyer', SubmitType::class, [
                'label' => 'Envoyer',
                'attr' => ['class' => 'btn btn-primary'],
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Les données du formulaire sont disponibles dans $form->getData()
            $formData = $form->getData();

            $email = (new TemplatedEmail())
                ->from($formData['Email'])
                ->to('arthur.manceau1@outlook.fr')
                ->subject($formData['Sujet'])
                ->htmlTemplate('mail/template.html.twig')
                ->context([
                    'formData' => $formData,
                ]);

            $mailer->send($email);

            return $this->redirectToRoute('app_default');
        }

        return $this->render('mail/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
