<?php

namespace App\Controller;

use Twig\Environment;
use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PagesController extends AbstractController
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, MailerInterface $mailer, EntityManagerInterface $entityManager): Response
    {
        $message = new Contact();

        $form = $this->createForm(ContactType::class, $message);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($message);
            $entityManager->flush();

            $transport = Transport::fromDsn('smtp://siteweb@guardianfrance.fr:DL3FH4M8p6u4W@smtp.ionos.fr:587?auth_mode=login');

            $mailer = new Mailer($transport);

            $emailData = [
                'lastname' => $message->getLastName(),
                'name' => $message->getName(),
                'email' => $message->getEmail(),
                'phone' => $message->getPhone(),
                
            ];

            $email = (new TemplatedEmail())
                ->from('siteweb@guardianfrance.fr')
                ->to('dorianclerbout@gmail.com') 
                ->subject('Demande de contact depuis le site AFMS')
                ->htmlTemplate('email/contact.html.twig')
                ->context(['emailData' => $emailData]);

            $htmlContent = $this->twig->render('email/contact.html.twig', ['emailData' => $emailData]);
            $email->html($htmlContent);

            $mailer->send($email);

            $this->addFlash('success', ' Guardian France vous répondra dans les meilleurs délais.');

            return $this->redirectToRoute('app_contact');
        } else {
            $this->addFlash('error', 'Une erreur s\'est produite lors de l\'envoi du message.');
        }

        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'form' => $form->createView()
        ]);
    }

    #[Route('/about', name: 'app_about')]
    public function about(): Response
    {
        return $this->render('about/index.html.twig', [
            'controller_name' => 'PagesController',
        ]);
    }

    #[Route('/financement', name: 'app_finance')]
    public function financement(): Response
    {
        return $this->render('finance/index.html.twig', [
            'controller_name' => 'PagesController',
        ]);
    }

    #[Route('/actualités', name: 'app_blog')]
    public function blog(): Response
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'PagesController',
        ]);
    }
}
