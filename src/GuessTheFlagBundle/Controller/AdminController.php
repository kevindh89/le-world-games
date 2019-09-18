<?php

declare(strict_types=1);

namespace GuessTheFlagBundle\Controller;

use GuessTheFlagBundle\Entity\Flag;
use GuessTheFlagBundle\Form\ContinentType;
use GuessTheFlagBundle\Repository\FlagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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

        $form = $this->createFormBuilder($flag)
            ->add('country', TextType::class)
            ->add('image', TextType::class, ['image_property' => 'image'])
            ->add('continent', ContinentType::class)
            ->getForm();

        if ($request->isMethod('get')) {
            return $this->render('GuessTheFlagBundle:Admin:edit.html.twig', [
                'form' => $form->createView(),
            ]);
        }

        if ($form->handleRequest($request) && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirect($this->generateUrl('overview'));
        }

        return $this->render('GuessTheFlagBundle:Admin:edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
