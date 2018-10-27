<?php

namespace App\Controller;

use App\Entity\Guarantee;
use App\Entity\Participant;
use App\Form\CreateParticipantType;
use App\Form\ManagerProfileType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class ManagerController extends Controller
{
    public function index()
    {
        return $this->render('manager/index.html.twig');
    }

    public function editSelfProfile(Request $request)
    {
        $user = $this->getUser();
        $form = $this->createForm(ManagerProfileType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
            }

        return $this->render('manager/edit_self_profile.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function createParticipant(Request $request)
    {
        $participant = new Participant();
        $form = $this->createForm(CreateParticipantType::class, $participant);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $participant->setManager($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($participant);
            $entityManager->flush();

            return $this->redirectToRoute('manager_index');
        }

        return $this->render('manager/participants/create-participant.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function listParticipant()
    {
        $participants = $this->getDoctrine()->getRepository(Participant::class)->findAll();
        $guarantees = $this->getDoctrine()->getRepository(Guarantee::class)->findAll();

        return $this->render('manager/participants/list-participant.html.twig', array(
            'participants' => $participants,
            'guarantees' => $guarantees,
        ));
    }

    public function linkParticipantWithGuarantee($participant)
    {
        dump($participant);
//        dump($guarantee);

        return $this->redirectToRoute('manager_list_participant');
    }
}