<?php

namespace App\Controller;

use App\Entity\Siege;
use App\Form\SiegeProfileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class SiegeController extends Controller
{
    public function index()
    {
        return $this->render('siege/index.html.twig');
    }

    public function editSelfProfile(Request $request)
    {
        $user = $this->getUser();
        $form = $this->createForm(SiegeProfileType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }

        return $this->render('siege/edit_self_profile.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function managerList()
    {
        $id = $this->getUser()->getId();

        $managerArray = $this->getDoctrine()->getRepository(Siege::class)->findAttachedManagers($id);

        return $this->render('siege/manager_list.html.twig',array(
            'managers' => $managerArray,
        ));
    }

}