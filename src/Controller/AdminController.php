<?php

namespace App\Controller;

use App\Entity\Action;
use App\Entity\Contract;
use App\Entity\Coworker;
use App\Entity\Guarantee;
use App\Entity\Manager;
use App\Entity\Siege;
use App\Entity\Sinister;
use App\Form\AdminProfileType;
use App\Form\CreateContractType;
use App\Form\CreateGuaranteeType;
use App\Form\CreateSinisterType;
use App\Form\ManagerProfileType;
use App\Form\SiegeProfileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function index()
    {
        return $this->render('admin/index.html.twig');
    }

    public function createUser(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // On Regenere l'entity avec le bon role pour le discriminant
            switch ($role = $form->get('roles')->getData()) {
                case 'ROLE_SIEGE':
                    $user = new Siege();
                    break;
                case 'ROLE_MANAGER':
                    $user = new Manager();
                    break;
                case 'ROLE_COWORKER':
                    $user = new Coworker();
                    break;
            }
            $user->setRoles([$role]);

            $username = $form->get('username')->getData();
            $user->setUsername($username);

            // 3) Encode the password (you could also do this via Doctrine listener)
            $plainPassword = $form->get('password')->getData();
            $encoded = $encoder->encodePassword($user, $plainPassword);
            $user->setPassword($encoded);

            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('admin_index');
        }
        return $this->render('admin/create_user.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function listUsers()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('admin/list_users.html.twig', array(
            'users' => $users,
        ));
    }

    public function deleteUser($id)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);

        if($user->getUsername() != $this->getUser()->getUsername())
        {
            $this->em->remove($user);
            $this->em->flush();
        }
        else
        {
            $this->addFlash(
                'notice',
                "Can't delete yourself!"
            );
        }
        return $this->redirectToRoute('admin_list_users');
    }

    public function editUser(Request $request, $id)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);

        // Creation du formulaire correspondant au role de l'user
        if (in_array('ROLE_ADMIN', $user->getRoles())) {
            $form = $this->createForm(UserType::class, $user);
        } else if (in_array('ROLE_SIEGE', $user->getRoles())) {
            $form = $this->createForm(SiegeProfileType::class, $user);
        } else if (in_array('ROLE_MANAGER', $user->getRoles())) {
            $form = $this->createForm(ManagerProfileType::class, $user);
        } else if (in_array('ROLE_COWORKER', $user->getRoles())) {
            $form = $this->createForm(SiegeProfileType::class, $user);
        }

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }

        return $this->render('admin/edit_user.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function editSelfProfile(Request $request)
    {
        $user = $this->getUser();
        $form = $this->createForm(AdminProfileType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($user);
            $this->em->flush();
        }

        return $this->render('admin/edit_self_profile.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function createContract(Request $request)
    {
        $contract = new Contract();
        $form = $this->createForm(CreateContractType::class, $contract);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contract);
            $entityManager->flush();

            return $this->redirectToRoute('admin_index');
        }

        return $this->render('admin/contracts/create-contract.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function listContract()
    {
        $contracts = $this->getDoctrine()->getRepository(Contract::class)->findAll();

        return $this->render('admin/contracts/list-contract.html.twig', array(
            'contracts' => $contracts,
        ));
    }

    public function createGuarantee(Request $request)
    {
        $guarantee = new Guarantee();
        $form = $this->createForm(CreateGuaranteeType::class, $guarantee);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($guarantee);
            $entityManager->flush();

            return $this->redirectToRoute('admin_index');
        }

        return $this->render('admin/guarantees/create-guarantee.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function listGuarantee()
    {
        $guarantees = $this->getDoctrine()->getRepository(Guarantee::class)->findAll();

        return $this->render('admin/guarantees/list-guarantee.html.twig', array(
            'guarantees' => $guarantees,
        ));
    }

    public function createSinister(Request $request)
    {
        $sinister = new Sinister();
        $form = $this->createForm(CreateSinisterType::class, $sinister);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sinister);
            $entityManager->flush();

            return $this->redirectToRoute('admin_index');
        }

        return $this->render('admin/sinisters/create-sinister.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function listSinister()
    {
        $sinisters = $this->getDoctrine()->getRepository(Sinister::class)->findAll();



        return $this->render('admin/sinisters/list-sinister.html.twig', array(
            'sinisters' => $sinisters,
        ));
    }

    public function createAction(Request $request)
    {
        $action = new Action();
        $form = $this->createForm(CreateSinisterType::class, $action);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($action);
            $entityManager->flush();

            return $this->redirectToRoute('admin_index');
        }

        return $this->render('admin/actions/create-action.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function listAction()
    {
        $actions = $this->getDoctrine()->getRepository(Action::class)->findAll();

        return $this->render('admin/actions/list-action.html.twig', array(
            'actions' => $actions,
        ));
    }

}