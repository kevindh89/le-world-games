<?php

declare(strict_types=1);

namespace GuessTheFlagBundle\Controller;

use GuessTheFlagBundle\Entity\Flag;
use GuessTheFlagBundle\Form\FlagType;
use GuessTheFlagBundle\Repository\FlagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin", name="admin_")
 */
class AdminController extends Controller
{
    private $flagRepository;

    public function __construct(FlagRepository $flagRepository)
    {
        $this->flagRepository = $flagRepository;
    }

    /**
     * @Route("/overview", name="overview")
     */
    public function overviewAction()
    {
        $flags = $this->flagRepository->findAll();

        return $this->render('GuessTheFlagBundle:Admin:overview.html.twig', [
            'flags' => $flags,
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function editAction(string $id, Request $request)
    {
        /** @var Flag $flag */
        $flag = $this->flagRepository->find($id);

        $form = $this->createForm(FlagType::class, $flag);

        if ($request->isMethod('get')) {
            return $this->render('GuessTheFlagBundle:Admin:edit.html.twig', [
                'form' => $form->createView(),
            ]);
        }

        if ($form->handleRequest($request) && $form->isValid()) {
            /** @var UploadedFile $photo */
            $photo = $form['photoFile']->getData();

            if ($photo) {
                $filename = mt_rand(1, 999999).'-'.uniqid().'.'.$photo->guessExtension();
                $photo->move($this->getParameter('photo_directory'), $filename);
                $flag->setPhoto($filename);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirect($this->generateUrl('admin_overview'));
        }

        return $this->render('GuessTheFlagBundle:Admin:edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
