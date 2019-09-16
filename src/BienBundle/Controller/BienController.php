<?php

namespace BienBundle\Controller;

use BienBundle\Entity\adresse;
use BienBundle\Entity\agence;
use BienBundle\Entity\agent;
use BienBundle\Entity\bien;
use BienBundle\Entity\commentaire;
use BienBundle\Entity\couleur;
use BienBundle\Entity\detailsBien;
use BienBundle\Entity\typeBien;
use BienBundle\Entity\User;
use BienBundle\Entity\zoneGeo;
use BienBundle\Form\adresseType;
use BienBundle\Form\agenceType;
use BienBundle\Form\agentType;
use BienBundle\Form\bienSearchType;
use BienBundle\Form\bienType;
use BienBundle\Form\commentaireType;
use BienBundle\Form\couleurType;
use BienBundle\Form\detailsBienType;
use BienBundle\Form\typeBienType;
use BienBundle\Form\UserType;
use BienBundle\Form\zoneGeoType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class BienController extends Controller
{


    /**
     * @Route ("/", name="accueil")
     */
    public function accueilAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $biens = $em->getRepository('BienBundle:bien')->getBienWithType6E();
        $typeBiens = $em->getRepository('BienBundle:typeBien')->findAll();
        $agents = $em->getRepository('BienBundle:agent')->findAll();
        $agences = $em->getRepository('BienBundle:agence')->findAll();
        $nbBienVendre = $em->getRepository('BienBundle:bien')->getNbBienVendre();
        $nbBienLouer = $em->getRepository('BienBundle:bien')->getNbBienLouer();
        $couleur = $em->getRepository('BienBundle:couleur')->find(1);
        $monPrixMin = $em->getRepository('BienBundle:bien')->getPrixMin();
        $monPrixMax = $em->getRepository('BienBundle:bien')->getPrixMax();
        $agencePrincipale = $em->getRepository('BienBundle:agence')->getAgencePrincipale();

        $form = $this->createForm(bienSearchType::class);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $data = array('typeBien' => $form['typeBien']->getData(),
                'typeVenteBien' => $form['typeVenteBien']->getData(),
                'zoneGeo' => $form['zoneGeo']->getData(),
                'surfaceBienMax' => $form['surfaceBienMax']->getData(),
                'prixMax' => $form['prixMax']->getData(),
                'nbPiece' => $form['nbPiece']->getData(),
                'nbChambre' => $form['nbChambre']->getData(),
                'nbSalleDeBain' => $form['nbSalleDeBain']->getData(),
            );
            $bienSearch = $em->getRepository('BienBundle:bien')->findAnnonceByParameters($data);
            $bienSearch2 = $this->get('knp_paginator')->paginate(
                $bienSearch,
                $request->query->get('page', 1), 6);
            return $this->render('BienBundle:Main:bien-view-list.html.twig',
                array('biens' => $bienSearch2,
                    'couleur' => $couleur,
                    'form' => $form->createView(),
                    'monPrixMin' => $monPrixMin,
                    'monPrixMax' => $monPrixMax,
                    'bienSearch' => $bienSearch,
                    'bienRecent' => $biens
                ));
        }
        return $this->render('@Bien/Main/accueil.html.twig',
            array('biens' => $biens,
                'types' => $typeBiens,
                'agents' => $agents,
                'nbTypes' => count($typeBiens),
                'nbAgents' => count($agents),
                'nbAgences' => count($agences),
                'nbBienVendre' => count($nbBienVendre),
                'nbBienLouer' => count($nbBienLouer),
                'couleur' => $couleur,
                'form' => $form->createView(),
                'monPrixMax' => $monPrixMax,
                'monPrixMin' => $monPrixMin,
                'agencePrincipale' => $agencePrincipale,
            ));
    }

    ///     AGENT       ///

    /**
     * @Route ("/agent/view/grid", name="agent-view-grid")
     */
    public function agentViewAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $couleur = $em->getRepository('BienBundle:couleur')->find(1);
        $listeAgents = $em->getRepository('BienBundle:agent')->findAll();

        $agents = $this->get('knp_paginator')->paginate(
            $listeAgents,
            $request->query->get('page', 1), 8);
        return $this->render('BienBundle:Main:agent-view-grid.html.twig', array(
            'agents' => $agents, 'couleur' => $couleur));
    }

    /**
     * @Route ("/agent/view/list", name="agent-view-list")
     */
    public function agentViewListAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $couleur = $em->getRepository('BienBundle:couleur')->find(1);
        $listeAgents = $em->getRepository('BienBundle:agent')->findAll();

        $agents = $this->get('knp_paginator')->paginate(
            $listeAgents,
            $request->query->get('page', 1), 5);
        return $this->render('BienBundle:Main:agent-view-list.html.twig', array(
            'agents' => $agents, 'couleur' => $couleur));
    }

    /**
     * @Route ("/agent/fiche/{id}", name="agent-fiche")
     */
    public function agentFicheAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $couleur = $em->getRepository('BienBundle:couleur')->find(1);
        $monAgent = $em->getRepository('BienBundle:agent')->find($id);

        return $this->render("BienBundle:Main:agent-fiche.html.twig",
            array('agent' => $monAgent, 'couleur' => $couleur));
    }

    ///         AGENCE          ///

    /**
     * @Route ("/agence/view/list", name="agence-view-list")
     */
    public function agenceViewListAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $couleur = $em->getRepository('BienBundle:couleur')->find(1);
        $listeAgences = $em->getRepository('BienBundle:agence')->findAll();

        $agences = $this->get('knp_paginator')->paginate(
            $listeAgences,
            $request->query->get('page', 1), 5);
        return $this->render('BienBundle:Main:agence-view-list.html.twig', array(
            'agences' => $agences, 'couleur' => $couleur));
    }

    /**
     * @Route ("/agence/view/grid", name="agence-view-grid")
     */
    public function agenceViewGridAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $couleur = $em->getRepository('BienBundle:couleur')->find(1);
        $listeAgences = $em->getRepository('BienBundle:agence')->findAll();

        $agences = $this->get('knp_paginator')->paginate(
            $listeAgences,
            $request->query->get('page', 1), 8);
        return $this->render('BienBundle:Main:agence-view-grid.html.twig', array(
            'agences' => $agences, 'couleur' => $couleur));
    }

    /**
     * @Route ("/agence/fiche/{id}", name="agence-fiche")
     */
    public function agenceFicheAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $couleur = $em->getRepository('BienBundle:couleur')->find(1);
        $monAgence = $em->getRepository('BienBundle:agence')->find($id);

        return $this->render("BienBundle:Main:agence-fiche.html.twig",
            array('agence' => $monAgence, 'couleur' => $couleur));
    }

    /**
     * @Route ("/agence_principale/fiche", name="agence-principale")
     */
    public function agencePrincipaleFicheAction()
    {
        $em = $this->getDoctrine()->getManager();
        $couleur = $em->getRepository('BienBundle:couleur')->find(1);
        $agenceP = $em->getRepository('BienBundle:agence')->getAgencePrincipale();

        return $this->render('BienBundle:Main:agence-fiche.html.twig',
            array('agence' => $agenceP, 'couleur' => $couleur));
    }

    ///     BIEN        ///

    /**
     * @Route ("/depot-annonce", name="depot-annonce")
     */
    public function depotAnnonceAction(Request $request)
    {
        $couleur = $this->getDoctrine()
            ->getManager()
            ->getRepository('BienBundle:couleur')
            ->findAll();

        $bien = new bien();
        $bien->setDateDepotBien(new \DateTime());
        $bien->setStatutBien('Actif');

        $form = $this->createForm(bienType::class, $bien);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bien);
            $em->flush();
            return $this->redirect("/agence/web/app_dev.php/");
        }
        return $this->render('@Bien/Main/depotAnnonce.html.twig',
            array('form' => $form->createView(), 'couleurs' => $couleur
            ));
    }

    /**
     * @Route ("/bien/fiche/{id}", name="bien-fiche")
     */
    public function bienFicheAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $couleur = $em->getRepository('BienBundle:couleur')->find(1);
        $monPrixMin = $em->getRepository('BienBundle:bien')->getPrixMin();
        $monPrixMax = $em->getRepository('BienBundle:bien')->getPrixMax();
        $bienRecent = $em->getRepository('BienBundle:bien')->getBienWithType6E();
        $bienCom = $em->getRepository('BienBundle:bien')->getBienWithComValider($id);
        $bien = $em->getRepository('BienBundle:bien')->find($id);
        $options = $em->getRepository('BienBundle:detailsBien')->getOptionInBien($id);

        //  FORMULAIRE POUR UN COMMENTAIRE
        $commentaire = new commentaire();
        $formCom = $this->createForm(commentaireType::class, $commentaire);
        if ($request->isMethod('POST') && $formCom->handleRequest($request)->isValid()) {
            if ($this->getUser() != null) {
                if ($this->getUser()->getUsername() == null) {
                    $user = $this->getUser()->getEmail();
                } else {
                    $user = $this->getUser()->getUsername();
                }
                $commentaire->setAuteurCom($user);
                $commentaire->setDateCom(new \DateTime());
                $commentaire->setPublierCom('Non');
                $commentaire->setBien($bien);

                $em->persist($commentaire);
                $em->flush();
                $this->addFlash('postCommentaire', 'Votre commentaire est en cours de traitement');
                return $this->redirect("/agence/web/app_dev.php/bien/fiche/".$id);
            } else {
                $this->addFlash('commentaire', 'Vous devez vous connecter pour laisser un commentaire');
                return $this->redirect("/agence/web/app_dev.php/login");
            }
        }

        //  FORMULAIRE POUR UNE RECHERCHE D'UN BIEN
        $form = $this->createForm(bienSearchType::class);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $data = array('typeBien' => $form['typeBien']->getData(),
                'typeVenteBien' => $form['typeVenteBien']->getData(),
                'zoneGeo' => $form['zoneGeo']->getData(),
                'surfaceBienMax' => $form['surfaceBienMax']->getData(),
                'prixMax' => $form['prixMax']->getData(),
                'nbPiece' => $form['nbPiece']->getData(),
                'nbChambre' => $form['nbChambre']->getData(),
                'nbSalleDeBain' => $form['nbSalleDeBain']->getData(),
            );
            $bienSearch = $em->getRepository('BienBundle:bien')->findAnnonceByParameters($data);

            $bienSearch2 = $this->get('knp_paginator')->paginate(
                $bienSearch,
                $request->query->get('page', 1), 6);
            return $this->render('BienBundle:Main:bien-view-list.html.twig',
                array('biens' => $bienSearch2,
                    'couleur' => $couleur,
                    'form' => $form->createView(),
                    'monPrixMin' => $monPrixMin,
                    'monPrixMax' => $monPrixMax,
                    'bienSearch' => $bienSearch,
                    'bienRecent' => $bienRecent
                ));
        }

        // FORMULAIRE DE CONTACT
        $formContact = $this->createForm('BienBundle\Form\contactType', null, array(
            'method' => 'POST'
        ));
        if ($request->isMethod('POST')) {
            $formContact->handleRequest($request);
            if ($formContact->isValid()) {
                if ($this->sendEmail($formContact->getData())) {
                    return $this->redirect("/agence/web/app_dev.php/bien/fiche/" . $id);
                } else {
                    var_dump('Erreur');
                }
            }
        }

        return $this->render("BienBundle:Main:bien-fiche.html.twig",
            array('bien' => $bien,
                'options' => $options,
                'nbOptions' => count($options),
                'couleur' => $couleur,
                'formCom' => $formCom->createView(),
                'form' => $form->createView(),
                'formContact' => $formContact->createView(),
                'bienCom' => $bienCom,
                'monPrixMin' => $monPrixMin,
                'monPrixMax' => $monPrixMax,
                'bienRecent' => $bienRecent,
            ));
    }

    /**
     * @Route ("/bien/view/list", name="bien-view-list")
     */
    public function bienListAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $couleur = $em->getRepository('BienBundle:couleur')->find(1);
        $bienRecent = $em->getRepository('BienBundle:bien')->getBienWithType6E();
        $monPrixMin = $em->getRepository('BienBundle:bien')->getPrixMin();
        $monPrixMax = $em->getRepository('BienBundle:bien')->getPrixMax();
        $listeBiens = $em->getRepository('BienBundle:bien')->getBienActif();
        $biens = $this->get('knp_paginator')->paginate(
            $listeBiens,
            $request->query->get('page', 1), 6);

        $form = $this->createForm(bienSearchType::class);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $data = array('typeBien' => $form['typeBien']->getData(),
                'typeVenteBien' => $form['typeVenteBien']->getData(),
                'zoneGeo' => $form['zoneGeo']->getData(),
                'surfaceBienMax' => $form['surfaceBienMax']->getData(),
                'prixMax' => $form['prixMax']->getData(),
                'nbPiece' => $form['nbPiece']->getData(),
                'nbChambre' => $form['nbChambre']->getData(),
                'nbSalleDeBain' => $form['nbSalleDeBain']->getData(),
            );
            $bienSearch = $em->getRepository('BienBundle:bien')->findAnnonceByParameters($data);

            $bienSearch2 = $this->get('knp_paginator')->paginate(
                $bienSearch,
                $request->query->get('page', 1), 6);
            return $this->render('BienBundle:Main:bien-view-list.html.twig',
                array('biens' => $bienSearch2,
                    'couleur' => $couleur,
                    'form' => $form->createView(),
                    'monPrixMin' => $monPrixMin,
                    'monPrixMax' => $monPrixMax,
                    'listeBiens' => $listeBiens,
                    'bienSearch' => $bienSearch,
                    'bienRecent' => $bienRecent
                ));
        }
        return $this->render('BienBundle:Main:bien-view-list.html.twig',
            array('form' => $form->createView(),
                'listeBiens' => $listeBiens,
                'couleur' => $couleur,
                'biens' => $biens,
                'monPrixMin' => $monPrixMin,
                'monPrixMax' => $monPrixMax,
                'bienSearch' => $listeBiens,
                'bienRecent' => $bienRecent
            ));
    }

    /**
     * @Route ("/bien/view/grid", name="bien-view-grid")
     */
    public function bienGridAction(Request $request)
    {

        $session = $request->getSession();

        $em = $this->getDoctrine()->getManager();
        $bienRecent = $em->getRepository('BienBundle:bien')->getBienWithType6E();
        $couleur = $em->getRepository('BienBundle:couleur')->find(1);
        $monPrixMin = $em->getRepository('BienBundle:bien')->getPrixMin();
        $monPrixMax = $em->getRepository('BienBundle:bien')->getPrixMax();
        $listeBiens = $em->getRepository('BienBundle:bien')->getBienActif();
        $biens = $this->get('knp_paginator')->paginate(
            $listeBiens,
            $request->query->get('page', 1), 6);

        $form = $this->createForm(bienSearchType::class);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $data = array('typeBien' => $form['typeBien']->getData(),
                'typeVenteBien' => $form['typeVenteBien']->getData(),
                'zoneGeo' => $form['zoneGeo']->getData(),
                'surfaceBienMax' => $form['surfaceBienMax']->getData(),
                'prixMax' => $form['prixMax']->getData(),
                'nbPiece' => $form['nbPiece']->getData(),
                'nbChambre' => $form['nbChambre']->getData(),
                'nbSalleDeBain' => $form['nbSalleDeBain']->getData(),
            );
            $bienSearch = $em->getRepository('BienBundle:bien')->findAnnonceByParameters($data);
            $bienSearch2 = $this->get('knp_paginator')->paginate(
                $bienSearch,
                $request->query->get('page', 1), 6);
            return $this->render('BienBundle:Main:bien-view-grid.html.twig',
                array('biens' => $bienSearch2,
                    'couleur' => $couleur,
                    'form' => $form->createView(),
                    'monPrixMin' => $monPrixMin,
                    'monPrixMax' => $monPrixMax,
                    'listeBiens' => $listeBiens,
                    'bienSearch' => $bienSearch,
                    'bienRecent' => $bienRecent
                ));
        } elseif ($session->get('data') != null) {
            $bienSearch = $this->getDoctrine()
                ->getManager()
                ->getRepository('BienBundle:bien')
                ->findAnnonceByParameters($session->get('data'));

            $bienSearch2 = $this->get('knp_paginator')->paginate(
                $bienSearch,
                $request->query->get('page', 1), 6);
            $session->remove('data');
            return $this->render('BienBundle:Main:bien-view-grid.html.twig',
                array('biens' => $bienSearch2,
                    'couleur' => $couleur,
                    'form' => $form->createView(),
                    'monPrixMin' => $monPrixMin,
                    'monPrixMax' => $monPrixMax,
                    'listeBiens' => $listeBiens,
                    'bienSearch' => $bienSearch,
                    'bienRecent' => $bienRecent
                ));
        }
        return $this->render('BienBundle:Main:bien-view-grid.html.twig',
            array('form' => $form->createView(),
                'listeBiens' => $listeBiens,
                'couleur' => $couleur,
                'biens' => $biens,
                'monPrixMin' => $monPrixMin,
                'monPrixMax' => $monPrixMax,
                'bienSearch' => $listeBiens,
                'bienRecent' => $bienRecent,
            ));
    }

    /**
     * @Route ("/bien/view/grid/type/{id}", name="bien-view-grid-type")
     */
    public function bienGridTypeAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $bienRecent = $em->getRepository('BienBundle:bien')->getBienWithType6E();
        $couleur = $em->getRepository('BienBundle:couleur')->find(1);
        $mesBiens = $em->getRepository('BienBundle:bien')->getBienWithTypeBien($id);
        $monPrixMin = $em->getRepository('BienBundle:bien')->getPrixMin();
        $monPrixMax = $em->getRepository('BienBundle:bien')->getPrixMax();

        $biens = $this->get('knp_paginator')->paginate(
            $mesBiens,
            $request->query->get('page', 1), 6);

        $form = $this->createForm(bienSearchType::class);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $data = array('typeBien' => $form['typeBien']->getData(),
                'typeVenteBien' => $form['typeVenteBien']->getData(),
                'zoneGeo' => $form['zoneGeo']->getData(),
                'surfaceBienMax' => $form['surfaceBienMax']->getData(),
                'prixMax' => $form['prixMax']->getData(),
                'nbPiece' => $form['nbPiece']->getData(),
                'nbChambre' => $form['nbChambre']->getData(),
                'nbSalleDeBain' => $form['nbSalleDeBain']->getData(),
            );
            $session = $request->getSession();
            $session->set('data', $data);
            return $this->redirectToRoute('bien-view-grid');
        }
        return $this->render('BienBundle:Main:bien-view-grid.html.twig',
            array('couleur' => $couleur,
                'listeBiens' => $mesBiens,
                'biens' => $biens,
                'form' => $form->createView(),
                'monPrixMin' => $monPrixMin,
                'monPrixMax' => $monPrixMax,
                'bienSearch' => $mesBiens,
                'bienRecent' => $bienRecent,
            ));
    }

    /**
     * @Route ("/bien/view/grid/typeVente/{id}", name="bien-view-grid-typeVente")
     */
    public function bienGridTypeVenteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $couleur = $em->getRepository('BienBundle:couleur')->find(1);
        $bienRecent = $em->getRepository('BienBundle:bien')->getBienWithType6E();
        $mesBiens = $em->getRepository('BienBundle:bien')->getBienWithTypeVenteBien($id);
        $monPrixMin = $em->getRepository('BienBundle:bien')->getPrixMin();
        $monPrixMax = $em->getRepository('BienBundle:bien')->getPrixMax();

        $biens = $this->get('knp_paginator')->paginate(
            $mesBiens,
            $request->query->get('page', 1), 6);

        $form = $this->createForm(bienSearchType::class);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $data = array('typeBien' => $form['typeBien']->getData(),
                'typeVenteBien' => $form['typeVenteBien']->getData(),
                'zoneGeo' => $form['zoneGeo']->getData(),
                'surfaceBienMax' => $form['surfaceBienMax']->getData(),
                'prixMax' => $form['prixMax']->getData(),
                'nbPiece' => $form['nbPiece']->getData(),
                'nbChambre' => $form['nbChambre']->getData(),
                'nbSalleDeBain' => $form['nbSalleDeBain']->getData(),
            );
            $session = $request->getSession();
            $session->set('data', $data);
            return $this->redirectToRoute('bien-view-grid');
        }
        return $this->render('BienBundle:Main:bien-view-grid.html.twig',
            array('couleur' => $couleur,
                'listeBiens' => $mesBiens,
                'biens' => $biens,
                'form' => $form->createView(),
                'monPrixMin' => $monPrixMin,
                'monPrixMax' => $monPrixMax,
                'bienSearch' => $mesBiens,
                'bienRecent' => $bienRecent
            ));
    }


    ///     FORMULAIRE DE CONTACT      ///

    /**
     * @Route ("/contact", name="contact")
     */
    public function contactAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $couleur = $em->getRepository('BienBundle:couleur')->find(1);
        $listAgences = $em->getRepository('BienBundle:agence')->getAgenceWithAdresse2();

        $form = $this->createForm('BienBundle\Form\contactType', null, array(
            'method' => 'POST'
        ));
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                if ($this->sendEmail($form->getData())) {
                    $this->addFlash('message', 'Votre message a bien été envoyé');
                    return $this->redirect('/agence/web/app_dev.php/contact');
                } else {
                    var_dump('Erreur');
                }
            }
        }
        return $this->render('BienBundle:Main:contact.html.twig', array(
            'form' => $form->createView(),
            'agences' => $listAgences,
            'nbAgences' => count($listAgences),
            'couleur' => $couleur
        ));
    }

    /**
     * Fonction pour l'envoie d'un mail
     */
    private function sendEmail($data)
    {
        $myappContactMail = $this->getParameter('mailer_user');
        $myappContactPassword = $this->getParameter('mailer_password');

        // In this case we'll use the ZOHO mail services.
        // If your service is another, then read the following article to know which smpt code to use and which port
        // http://ourcodeworld.com/articles/read/14/swiftmailer-send-mails-from-php-easily-and-effortlessly
        $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
            ->setUsername($myappContactMail)
            ->setPassword($myappContactPassword);

        $mailer = \Swift_Mailer::newInstance($transport);

        $message = \Swift_Message::newInstance("The Nest Contact - " . $data["sujet"])
            ->setFrom(array($myappContactMail => $data["nom"]))
            ->setTo(array(
                $myappContactMail => $myappContactMail
            ))
//          ->setBody("E-mail : ". $data["email"].'<br>'.$data["message"]);
            ->setBody('')
            ->addPart('<b>Nom : </b> ' . $data["nom"] . '<br><br>' .
                '<b>Adresse mail : </b> ' . $data["email"] . '<br><br>' .
                '<b>Message : </b> <br> ' . $data["message"], 'text/html');

        return $mailer->send($message);
    }

//////////////////////////////////////////////////////////////////////////////////////////////////:

    ///   ACCUEIL   ADMIN   ///

    /**
     * @Route ("/admin/accueil", name="admin-accueil")
     */
    public function adminAction()
    {
        $em = $this->getDoctrine()->getManager();
        $agences = $em->getRepository('BienBundle:agence')->findAll();
        $agents = $em->getRepository('BienBundle:agent')->findAll();
        $users = $em->getRepository('BienBundle:User')->findAll();
        $zones = $em->getRepository('BienBundle:zoneGeo')->findAll();
        $types = $em->getRepository('BienBundle:typeBien')->findAll();
        $options = $em->getRepository('BienBundle:detailsBien')->findAll();
        $biens = $em->getRepository('BienBundle:bien')->findAll();
        $biensV = $em->getRepository('BienBundle:bien')->getNbBienVendre();
        $biensL = $em->getRepository('BienBundle:bien')->getNbBienLouer();
        $commentaires = $em->getRepository('BienBundle:commentaire')->findAll();
        $commentairesAValider = $em->getRepository('BienBundle:commentaire')->getCommentaireNonPublier();

        return $this->render("BienBundle:Admin:admin-accueil.html.twig",
            array('nbAgences' => count($agences),
                'nbAgents' => count($agents),
                'nbUsers' => count($users),
                'nbZones' => count($zones),
                'nbTypes' => count($types),
                'nbOptions' => count($options),
                'nbBiens' => count($biens),
                'nbBiensV' => count($biensV),
                'nbBiensL' => count($biensL),
                'nbCom' => count($commentaires),
                'nbComAV' => count($commentairesAValider),
            ));
    }


    ///   AGENCE   ///

    /**
     * @Route ("/admin/agence/fiche/{id}", name="admin-agence-fiche")
     */
    public function adminAgenceFicheAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $monAgence = $em->getRepository('BienBundle:agence')->find($id);
        $mesAgents = $em->getRepository('BienBundle:agent')->getAgentInAgence($id);
        $mesBiens = $em->getRepository('BienBundle:bien')->getBienInAgence($id);

        return $this->render("BienBundle:Admin:agence-fiche.html.twig",
            array('agence' => $monAgence, 'agents' => $mesAgents, 'biens' => $mesBiens));
    }

    /**
     * @Route ("/admin/agence/delete/{id}", name="admin-agence-delete")
     */
    public function adminAgenceDeleteAction($id)
    {
        $agence = $this->getDoctrine()
            ->getManager()
            ->getRepository('BienBundle:agence')
            ->find($id);

        $em = $this->getDoctrine()->getManager();
        unlink('uploads/agences/' . $agence->getPhotoAgence());
        $em->remove($agence);
        $em->flush();
        $this->addFlash('suppression', 'Suppression réussie');
        return $this->redirectToRoute('admin-agence-view');
    }

    /**
     * @Route ("/admin/agence/edit/{id}", name="admin-agence-edit")
     */
    public function adminAgenceEditAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $monAgence = $em->getRepository('BienBundle:agence')->find($id);
        $image = $monAgence->getPhotoAgence();
        $form = $this->createForm(agenceType::class, $monAgence);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $agencePrincipale = $em->getRepository('BienBundle:agence')->getAgencePrincipale();

            //si aucune photo
            if ($monAgence->getPhotoAgence() == null) {
                //statut oui et qu'il y a déjà une agence P
                if ($monAgence->getAgencePrincipale() == 'oui' && $agencePrincipale != null) {
                    //modif statut de l'agence P
                    $agencePrincipale->setAgencePrincipale('non');
                    $em->persist($agencePrincipale);
                    $monAgence->setPhotoAgence($image);

                    //google map
                    $address1 = $monAgence->getAdresse()->getNomVille();
                    $address2 = str_replace(' ', '+', $address1);
                    $address2 = $address2 . '+Réunion';
                    $monAdresse = urlencode($address2);
//                    $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$monAdresse.'&sensor=false');
                    $geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $monAdresse . '&key=AIzaSyB0N5pbJN10Y1oYFRd0MJ_v2g8W2QT74JE');
                    $output = json_decode($geocode);
                    $lat = $output->results[0]->geometry->location->lat;
                    $long = $output->results[0]->geometry->location->lng;
                    $monAgence->getAdresse()->setLat($lat);
                    $monAgence->getAdresse()->setLng($long);

                    $em->flush();
                    $this->addFlash('modif', 'Modification effectuée');
                    return $this->redirectToRoute('admin-agence-view');
                } //statut oui mais pas d'agence P
                else {
                    //google map
                    $address1 = $monAgence->getAdresse()->getNomVille();
                    $address2 = str_replace(' ', '+', $address1);
                    $address2 = $address2 . '+Réunion';
                    $monAdresse = urlencode($address2);
//                    $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$monAdresse.'&sensor=false');
                    $geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $monAdresse . '&key=AIzaSyB0N5pbJN10Y1oYFRd0MJ_v2g8W2QT74JE');
                    $output = json_decode($geocode);
                    $lat = $output->results[0]->geometry->location->lat;
                    $long = $output->results[0]->geometry->location->lng;
                    $monAgence->getAdresse()->setLat($lat);
                    $monAgence->getAdresse()->setLng($long);

                    $monAgence->setPhotoAgence($image);
                    $em->flush();
                    $this->addFlash('modif', 'Modification effectuée');
                    return $this->redirectToRoute('admin-agence-view');
                }

            } //nouvelle photo
            else {
                //statut oui et qu'il y a déjà une agence P
                if ($monAgence->getAgencePrincipale() == 'oui' && $agencePrincipale != null) {
                    $agencePrincipale->setAgencePrincipale('non');
                    $em->persist($agencePrincipale);

                    // image
                    unlink('uploads/agences/' . $image);
                    $file = $monAgence->getPhotoAgence();
                    $type = $file->guessExtension();
                    $filename = $this->generateUniqueFileName() . '.' . $file->guessExtension();
                    $file->move($this->getParameter('photos_directory3'), $filename);
                    $monAgence->setPhotoAgence($filename);
                    //compression image.jpeg
                    if ($type == 'jpeg') {
                        $img = imagecreatefromjpeg('uploads/agences/' . $filename);
                        imagejpeg($img, 'uploads/agences/' . $filename, 75);
                    }
                    //enregistrement
                    $em->persist($agencePrincipale);

                    //google map
                    $address1 = $monAgence->getAdresse()->getNomVille();
                    $address2 = str_replace(' ', '+', $address1);
                    $address2 = $address2 . '+Réunion';
                    $monAdresse = urlencode($address2);
//                    $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$monAdresse.'&sensor=false');
                    $geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $monAdresse . '&key=AIzaSyB0N5pbJN10Y1oYFRd0MJ_v2g8W2QT74JE');
                    $output = json_decode($geocode);
                    $lat = $output->results[0]->geometry->location->lat;
                    $long = $output->results[0]->geometry->location->lng;
                    $monAgence->getAdresse()->setLat($lat);
                    $monAgence->getAdresse()->setLng($long);

                    $em->flush();
                    $this->addFlash('modif', 'Modification effectuée');
                    return $this->redirectToRoute('admin-agence-view');
                } //statut oui mais pas d'agence P
                else {
                    // image
                    unlink('uploads/agences/' . $image);
                    $file = $monAgence->getPhotoAgence();
                    $type = $file->guessExtension();
                    $filename = $this->generateUniqueFileName() . '.' . $file->guessExtension();
                    $file->move($this->getParameter('photos_directory3'), $filename);
                    $monAgence->setPhotoAgence($filename);
                    //compression image.jpeg
                    if ($type == 'jpeg') {
                        $img = imagecreatefromjpeg('uploads/agences/' . $filename);
                        imagejpeg($img, 'uploads/agences/' . $filename, 75);
                    }
                    //enregistrement

                    //google map
                    $address1 = $monAgence->getAdresse()->getNomVille();
                    $address2 = str_replace(' ', '+', $address1);
                    $address2 = $address2 . '+Réunion';
                    $monAdresse = urlencode($address2);
//                    $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$monAdresse.'&sensor=false');
                    $geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $monAdresse . '&key=AIzaSyB0N5pbJN10Y1oYFRd0MJ_v2g8W2QT74JE');
                    $output = json_decode($geocode);
                    $lat = $output->results[0]->geometry->location->lat;
                    $long = $output->results[0]->geometry->location->lng;
                    $monAgence->getAdresse()->setLat($lat);
                    $monAgence->getAdresse()->setLng($long);
                    $em->flush();
                    $this->addFlash('modif', 'Modification effectuée');
                    return $this->redirectToRoute('admin-agence-view');
                }
            }
        }
        return $this->render("BienBundle:Admin:agence-edit.html.twig",
            array('agence' => $monAgence,
                'form' => $form->createView())
        );
    }

    /**
     * @Route ("/admin/agence/membre/{id}", name="admin-agence-membre")
     */
    public function adminAgenceMembreAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $monAgence = $em->getRepository('BienBundle:agence')->find($id);
        $mesAgents = $em->getRepository('BienBundle:agent')->getAgentInAgence($id);

        /// DEB FORM
        $form = $this->createFormBuilder($monAgence)
            ->add('agents', EntityType::class,
                array('label' => 'Les agents : ',
                    'class' => 'BienBundle\Entity\agent',
                    'choice_label' => 'nomAgent',
                    'expanded' => true,
                    'multiple' => true
                ))
            ->add('Valider', SubmitType::class, array('attr' => array('class' => 'btn btn-primary btn-block')))
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $monAgence = $form->getData();
            $em->persist($monAgence);
            $em->flush();
            $this->addFlash('modif', 'Modification réussie');
            return $this->redirect('/agence/web/app_dev.php/admin/agence/membre/' . $id);
        }
        ///   FIN  FORM
        return $this->render("BienBundle:Admin:agence-membre.html.twig",
            array('agence' => $monAgence,
                'agents' => $mesAgents,
                'form' => $form->createView()
            ));
    }

    /**
     * @Route ("/admin/agence/new", name="admin-agence-new")
     */
    public function adminAgenceNewAction(Request $request)
    {
        $agence = new agence();
        $form = $this->createForm(agenceType::class, $agence);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            //google map
            $address1 = $agence->getAdresse()->getNomVille();
            $address2 = str_replace(' ', '+', $address1);
            $address2 = $address2 . '+Réunion';
            $monAdresse = urlencode($address2);
//            $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$monAdresse.'&sensor=false');
            $geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $monAdresse . '&key=AIzaSyB0N5pbJN10Y1oYFRd0MJ_v2g8W2QT74JE');
            $output = json_decode($geocode);
            $lat = $output->results[0]->geometry->location->lat;
            $long = $output->results[0]->geometry->location->lng;
            $agence->getAdresse()->setLat($lat);
            $agence->getAdresse()->setLng($long);

            // image
            $file = $agence->getPhotoAgence();
            $type = $file->guessExtension();
            $filename = $this->generateUniqueFileName() . '.' . $file->guessExtension();
            $file->move($this->getParameter('photos_directory3'), $filename);
            $agence->setPhotoAgence($filename);
            if ($type == 'jpeg') {
                $img = imagecreatefromjpeg('uploads/agences/' . $filename);
                imagejpeg($img, 'uploads/agences/' . $filename, 75);
            }
            $agencePrincipale = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('BienBundle:agence')
                ->getAgencePrincipale();
            if ($agencePrincipale != null && $agence->getAgencePrincipale() == 'oui') {
                $agencePrincipale->setAgencePrincipale('non');
                $em = $this->getDoctrine()->getManager();
                $em->persist($agencePrincipale);
                $em->persist($agence);
                $em->flush();
            } else {
                $em = $this->getDoctrine()->getManager();
                $em->persist($agence);
                $em->flush();
            }
            $this->addFlash('ajout', 'Ajout réussi');
            return $this->redirect("/agence/web/app_dev.php/admin/agence/view");
        }
        return $this->render("BienBundle:Admin:agence-new.html.twig",
            array('form' => $form->createView(),
            ));
    }

    /**
     * @Route ("/admin/agence/view", name="admin-agence-view")
     */
    public function adminAgenceViewAction()
    {
        $listAgences = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BienBundle:agence')
            ->getAgenceWithAdresse();

        return $this->render("BienBundle:Admin:agence-view.html.twig",
            array('listAgences' => $listAgences));
    }


    ///   AGENT   ///

    /**
     * @Route ("/admin/agent/fiche/{id}", name="admin-agent-fiche")
     */
    public function adminAgentFicheAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $monAgent = $em->getRepository('BienBundle:agent')->find($id);
        $mesAgences = $em->getRepository('BienBundle:agence')->getAgentInAgence($id);
        $mesBiens = $em->getRepository('BienBundle:bien')->getBienInAgent($id);

        return $this->render("BienBundle:Admin:agent-fiche.html.twig",
            array('agent' => $monAgent, 'agences' => $mesAgences, 'biens' => $mesBiens));
    }

    /**
     * @Route ("/admin/agent/delete/{id}", name="admin-agent-delete")
     */
    public function adminAgentDeleteAction($id)
    {
        $agent = $this->getDoctrine()
            ->getManager()
            ->getRepository('BienBundle:agent')
            ->find($id);

        $em = $this->getDoctrine()->getManager();
        unlink('uploads/agents/' . $agent->getPhotoAgent());
        $em->remove($agent);
        $em->flush();
        $this->addFlash('suppression', 'Suppression réussie');

        return $this->redirectToRoute('admin-agent-view');
    }

    /**
     * @Route ("/admin/agent/edit/{id}", name="admin-agent-edit")
     */
    public function adminAgentEditAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $monAgent = $em->getRepository('BienBundle:agent')->find($id);
        //récupération de l'image avant validation de la modif
        $image = $monAgent->getPhotoAgent();
        $form = $this->createForm(agentType::class, $monAgent);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            //si nouvelle photo
            if ($monAgent->getPhotoAgent() != null) {
                unlink('uploads/agents/' . $image);
                $file = $monAgent->getPhotoAgent();
                $type = $file->guessExtension();
                $filename = $this->generateUniqueFileName() . '.' . $file->guessExtension();
                $file->move($this->getParameter('photos_directory'), $filename);
                $monAgent->setPhotoAgent($filename);
                //si .jpeg alors compression
                if ($type == 'jpeg') {
                    $img = imagecreatefromjpeg('uploads/agents/' . $filename);
                    imagejpeg($img, 'uploads/agents/' . $filename, 75);
                }
                $em->flush();
                $this->addFlash('modif', 'Modification effectuée');
                return $this->redirectToRoute('admin-agent-view');
            } else {
                $monAgent->setPhotoAgent($image);
                $em->flush();
                $this->addFlash('modif', 'Modification effectuée');
                return $this->redirectToRoute('admin-agent-view');
            }
        }
        return $this->render("BienBundle:Admin:agent-edit.html.twig",
            array('agent' => $monAgent,
                'form' => $form->createView())
        );
    }

    /**
     * @Route ("/admin/agent/new", name="admin-agent-new")
     */
    public function adminAgentNewAction(Request $request)
    {
        $agent = new agent();
        $form = $this->createForm(agentType::class, $agent);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $file = $agent->getPhotoAgent();
            $type = $file->guessExtension();
            $filename = $this->generateUniqueFileName() . '.' . $file->guessExtension();
            $file->move($this->getParameter('photos_directory'), $filename);
            $agent->setPhotoAgent($filename);
            if ($type == 'jpeg') {
                $img = imagecreatefromjpeg('uploads/agents/' . $filename);
                imagejpeg($img, 'uploads/agents/' . $filename, 75);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($agent);
            $em->flush();
            $this->addFlash('ajout', 'Ajout réussi');
            return $this->redirect("/agence/web/app_dev.php/admin/agent/view");
        }
        return $this->render("BienBundle:Admin:agent-new.html.twig",
            array('form' => $form->createView(),
            ));
    }

    /**
     * @Route ("/admin/agent/view", name="admin-agent-view")
     */
    public function adminAgentViewAction()
    {
        $agents = $this->getDoctrine()
            ->getManager()
            ->getRepository('BienBundle:agent')
            ->findAll();
        return $this->render("BienBundle:Admin:agent-view.html.twig",
            array('agents' => $agents));
    }


    ///     BIEN        ///

    /**
     * @Route ("/admin/bien/fiche/{id}", name="admin-bien-fiche")
     */
    public function adminBienFicheAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $monBien = $em->getRepository('BienBundle:bien')->find($id);
        $mesAgent = $em->getRepository('BienBundle:agent')->getAgentInBien($id);
        $monProprio = $em->getRepository('BienBundle:proprietaire')->getProprioInBien($id);
        $mesAgences = $em->getRepository('BienBundle:agence')->getAgenceWithBien($id);
        $options = $em->getRepository('BienBundle:detailsBien')->getOptionInBien($id);

        return $this->render("BienBundle:Admin:bien-fiche.html.twig",
            array('bien' => $monBien,
                'proprio' => $monProprio,
                'agents' => $mesAgent,
                'agences' => $mesAgences,
                'options' => $options));
    }

    /**
     * @Route ("/admin/bien/view", name="admin-bien-view")
     */
    public function adminBienViewAction()
    {
        $biens = $this->getDoctrine()
            ->getManager()
            ->getRepository('BienBundle:bien')
            ->findAll();

        return $this->render("BienBundle:Admin:bien-view.html.twig",
            array('biens' => $biens));
    }

    /**
     * @Route ("/admin/bien/new", name="admin-bien-new")
     */
    public function adminBienNewAction(Request $request)
    {
        $bien = new bien();
        $bien->setDateDepotBien(new \DateTime());
        $bien->setStatutBien('Actif');

        $form = $this->createForm(bienType::class, $bien);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $file = $bien->getPhotoBien();
            $type = $file->guessExtension();
            $filename = $this->generateUniqueFileName() . '.' . $file->guessExtension();
            $file->move($this->getParameter('photos_directory2'), $filename);
            $bien->setPhotoBien($filename);

            if ($type == 'jpeg') {
                $img = imagecreatefromjpeg('uploads/biens/' . $filename);
                imagejpeg($img, 'uploads/biens/' . $filename, 75);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($bien);
            $em->flush();
            $this->addFlash('ajout', 'Ajout réussi');
            return $this->redirect("/agence/web/app_dev.php/admin/bien/view");
        }
        return $this->render('@Bien/Admin/bien-new.html.twig',
            array('form' => $form->createView(), ''
            ));
    }

    /**
     * @Route ("/admin/bien/delete/{id}", name="admin-bien-delete")
     */
    public function adminBienDeleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $bien = $this->getDoctrine()
            ->getManager()
            ->getRepository('BienBundle:bien')
            ->find($id);

        unlink('uploads/biens/' . $bien->getPhotoBien());
        $em->remove($bien);
        $em->flush();
        $this->addFlash('suppression', 'Suppression réussie');
        return $this->redirectToRoute('admin-bien-view');
    }

    /**
     * @Route ("/admin/bien/edit/{id}", name="admin-bien-edit")
     */
    public function adminBienEditAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $monBien = $em->getRepository('BienBundle:Bien')->find($id);
        $image = $monBien->getPhotoBien();
        $form = $this->createForm(bienType::class, $monBien);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            if ($monBien->getPhotoBien() != null) {
                unlink('uploads/biens/' . $image);
                $file = $monBien->getPhotoBien();
                $type = $file->guessExtension();
                $filename = $this->generateUniqueFileName() . '.' . $file->guessExtension();
                $file->move($this->getParameter('photos_directory2'), $filename);
                $monBien->setPhotoBien($filename);
                if ($type == 'jpeg') {
                    $img = imagecreatefromjpeg('uploads/biens/' . $filename);
                    imagejpeg($img, 'uploads/biens/' . $filename, 70);
                }
                $em->flush();
                $this->addFlash('modif', 'Modification réussie');
                return $this->redirectToRoute('admin-bien-view');
            } else {
                $monBien->setPhotoBien($image);
                $em->flush();
                $this->addFlash('modif', 'Modification réussie');
                return $this->redirectToRoute('admin-bien-view');
            }
        }
        return $this->render("BienBundle:Admin:bien-edit.html.twig",
            array('bien' => $monBien,
                'form' => $form->createView())
        );
    }

    /**
     * @Route ("/admin/bien/responsable/agence/{id}", name="admin-bien-responsable-agence")
     */
    public function adminBienResponsableAgenceAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $monBien = $em->getRepository('BienBundle:bien')->find($id);
        $mesAgences = $em->getRepository('BienBundle:agence')->getAgenceWithBien($id);

        /// DEB FORM
        $form = $this->createFormBuilder($monBien)
            ->add('agences', EntityType::class,
                array('label' => 'Les agences responsables: ',
                    'class' => 'BienBundle\Entity\agence',
                    'choice_label' => 'nomAgence',
                    'expanded' => true,
                    'multiple' => true
                ))
            ->add('Valider', SubmitType::class, array('attr' => array('class' => 'btn btn-primary btn-block')))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $monBien = $form->getData();
            $em->persist($monBien);
            $em->flush();
            $this->addFlash('modif', 'Modification réussie');

            return $this->redirect('/agence/web/app_dev.php/admin/bien/responsable/agence/' . $id);
        }
        ///   FIN  FORM
        return $this->render("BienBundle:Admin:bien-responsable-agence.html.twig",
            array('bien' => $monBien,
                'agences' => $mesAgences,
                'form' => $form->createView()
            ));
    }

    /**
     * @Route ("/admin/bien/responsable/agent/{id}", name="admin-bien-responsable-agent")
     */
    public function adminBienResponsableAgentAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $monBien = $em->getRepository('BienBundle:bien')->find($id);
        $mesAgents = $em->getRepository('BienBundle:agent')->getAgentInBien($id);

        /// DEB FORM
        $form = $this->createFormBuilder($monBien)
            ->add('agents', EntityType::class,
                array('label' => ' ',
                    'class' => 'BienBundle\Entity\agent',
                    'choice_label' => 'nomAgent',
                    'expanded' => true,
                    'multiple' => true
                ))
            ->add('Valider', SubmitType::class, array('attr' => array('class' => 'btn btn-primary btn-block')))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $monBien = $form->getData();
            $em->persist($monBien);
            $em->flush();
            $this->addFlash('modif', 'Modification réussie');

            return $this->redirect('/agence/web/app_dev.php/admin/bien/responsable/agent/' . $id);
        }
        ///   FIN  FORM
        return $this->render("BienBundle:Admin:bien-responsable-agent.html.twig",
            array('bien' => $monBien,
                'agents' => $mesAgents,
                'form' => $form->createView()
            ));
    }


    ///         COMMENTAIRES            ///

    /**
     * @Route ("/admin/com-a-valider/view", name="admin-com-a-valider-view")
     */
    public function adminComAValiderViewAction()
    {
        $mesCommentaires = $this->getDoctrine()
            ->getManager()
            ->getRepository('BienBundle:commentaire')
            ->getCommentaireNonPublier();

        return $this->render("BienBundle:Admin:com-a-valider-view.html.twig",
            array('mesCommentaires' => $mesCommentaires));
    }

    /**
     * @Route ("/admin/com-a-valider/delete/{id}", name="admin-com-a-valider-delete")
     */
    public function adminComAValiderDeleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $commentaire = $em->getRepository('BienBundle:commentaire')->find($id);
        $em->remove($commentaire);
        $em->flush();
        $this->addFlash('suppression', 'Le commentaire à été supprimer');

        return $this->redirectToRoute('admin-com-a-valider-view');
    }

    /**
     * @Route ("/admin/com-a-valider/valider/{id}", name="admin-com-a-valider")
     */
    public function adminComAValiderValiderAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $commentaire = $em->getRepository('BienBundle:commentaire')->find($id);
        $commentaire->setPublierCom('Oui');
        $em->flush();
        $this->addFlash('modif', 'Le commentaire à été publié');
        return $this->redirectToRoute('admin-com-a-valider-view');
    }

    /**
     * @Route("/admin/com-a-valider/fiche/{id}", name="admin-com-a-valider-fiche")
     */
    public function adminComAValiderFicheAction($id)
    {
        $commentaire = $this->getDoctrine()
            ->getManager()
            ->getRepository('BienBundle:commentaire')
            ->find($id);
        return $this->render("BienBundle:Admin:com-a-valider-fiche.html.twig",
            array('commentaire' => $commentaire));
    }

    /**
     * @Route ("/admin/com-valider/view", name="admin-com-valider-view")
     */
    public function adminComValiderAction()
    {
        $mesCommentaires = $this->getDoctrine()
            ->getManager()
            ->getRepository('BienBundle:commentaire')
            ->getCommentairePublier();

        return $this->render("BienBundle:Admin:com-valider-view.html.twig",
            array('mesCommentaires' => $mesCommentaires));
    }

    /**
     * @Route ("/admin/com-valider/delete/{id}", name="admin-com-valider-delete")
     */
    public function adminComValiderDeleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $commentaire =$em->getRepository('BienBundle:commentaire')->find($id);
        $em->remove($commentaire);
        $em->flush();
        $this->addFlash('suppression', 'Le commentaire à été supprimer');

        return $this->redirectToRoute('admin-com-valider-view');
    }

    /**
     * @Route("/admin/com-valider/fiche/{id}", name="admin-com-valider-fiche")
     */
    public function adminComValiderFicheAction($id)
    {
        $commentaire = $this->getDoctrine()
            ->getManager()
            ->getRepository('BienBundle:commentaire')
            ->find($id);
        return $this->render("BienBundle:Admin:com-valider-fiche.html.twig",
            array('commentaire' => $commentaire));
    }


    ///   TYPE   BIEN   ///

    /**
     * @Route ("/admin/type-bien/delete/{id}", name="admin-type-bien-delete")
     */
    public function adminTypeBienDeleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $typeBien = $em->getRepository('BienBundle:typeBien')->find($id);
        $em->remove($typeBien);
        $em->flush();
        $this->addFlash('suppression', 'Suppression réussie');

        return $this->redirectToRoute('admin-type-bien-view');
    }

    /**
     * @Route ("/admin/type-bien/edit/{id}", name="admin-type-bien-edit")
     */
    public function adminTypeBienEditAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $monTypeBien = $em->getRepository('BienBundle:typeBien')->find($id);

        $form = $this->createForm(typeBienType::class, $monTypeBien);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->flush();
            $this->addFlash('modif', 'Modification réussie');
            return $this->redirectToRoute('admin-type-bien-view');
        }
        return $this->render("BienBundle:Admin:typeBien-edit.html.twig",
            array('type' => $monTypeBien,
                'form' => $form->createView())
        );
    }

    /**
     * @Route ("/admin/type-bien/new", name="admin-type-bien-new")
     */
    public function adminTypeBienNewAction(Request $request)
    {
        $typeBien = new typeBien();
        $form = $this->createForm(typeBienType::class, $typeBien);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typeBien);
            $em->flush();
            $this->addFlash('ajout', 'Ajout réussi');
            return $this->redirectToRoute('admin-type-bien-view');
        }
        return $this->render("BienBundle:Admin:typeBien-new.html.twig",
            array('form' => $form->createView(),
            ));
    }

    /**
     * @Route ("/admin/type-bien/view", name="admin-type-bien-view")
     */
    public function adminTypeBienViewAction()
    {
        $typeBien = $this->getDoctrine()
            ->getManager()
            ->getRepository('BienBundle:typeBien')
            ->findAll();

        return $this->render("BienBundle:Admin:typeBien-view.html.twig",
            array('types' => $typeBien));
    }


    ///   DETAILS   BIEN  OU   OPTION   BIEN ///

    /**
     * @Route ("/admin/details-bien/delete/{id}", name="admin-details-bien-delete")
     */
    public function adminDetailsBienDeleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $detailsBien =$em->getRepository('BienBundle:detailsBien')->find($id);
        $em->remove($detailsBien);
        $em->flush();
        $this->addFlash('suppression', 'Suppression réussie');

        return $this->redirectToRoute('admin-details-bien-view');
    }

    /**
     * @Route ("/admin/details-bien/edit/{id}", name="admin-details-bien-edit")
     */
    public function adminDetailsBienEditAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $monDetailsBien = $em->getRepository('BienBundle:detailsBien')->find($id);
        $form = $this->createForm(detailsBienType::class, $monDetailsBien);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->flush();
            $this->addFlash('modif', 'Modification réussie');
            return $this->redirectToRoute('admin-details-bien-view');
        }
        return $this->render("BienBundle:Admin:details-edit.html.twig",
            array('details' => $monDetailsBien,
                'form' => $form->createView())
        );
    }

    /**
     * @Route ("/admin/details-bien/new", name="admin-details-bien-new")
     */
    public function adminDetailsBienNewAction(Request $request)
    {
        $detailsBien = new detailsBien();
        $form = $this->createForm(detailsBienType::class, $detailsBien);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($detailsBien);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', 'Task saved');
            $this->addFlash('ajout', 'Ajout réussi');

            return $this->redirectToRoute('admin-details-bien-view');
        }
        return $this->render("BienBundle:Admin:details-new.html.twig",
            array('form' => $form->createView(),
            ));
    }

    /**
     * @Route ("/admin/details-bien/view", name="admin-details-bien-view")
     */
    public function adminDetailsBienViewAction()
    {
        $detailsBien = $this->getDoctrine()
            ->getManager()
            ->getRepository('BienBundle:detailsBien')
            ->findAll();

        return $this->render("BienBundle:Admin:details-view.html.twig",
            array('details' => $detailsBien));
    }


    ///   ZONE GEO   ///

    /**
     * @Route ("/admin/zone-geo/delete/{id}", name="admin-zone-geo-delete")
     */
    public function adminZoneGeoDeleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $zoneGeo = $em->getRepository('BienBundle\Entity\zoneGeo')->find($id);
        $em->remove($zoneGeo);
        $em->flush();
        $this->addFlash('suppression', 'Suppression réussie');
        return $this->redirectToRoute('admin-zone-geo-view');
    }

    /**
     * @Route ("/admin/zone-geo/edit/{id}", name="admin-zone-geo-edit")
     */
    public function adminZoneGeoEditAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $maZoneGeo = $em->getRepository('BienBundle:zoneGeo')->find($id);
        $form = $this->createForm(zoneGeoType::class, $maZoneGeo);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->flush();
            $this->addFlash('modif', 'Modification réussie');
            return $this->redirectToRoute('admin-zone-geo-view');
        }
        return $this->render("BienBundle:Admin:zoneGeo-edit.html.twig",
            array('zoneGeo' => $maZoneGeo,
                'form' => $form->createView())
        );
    }

    /**
     * @Route ("/admin/zone-geo/new", name="admin-zone-geo-new")
     */
    public function adminZoneGeoNewAction(Request $request)
    {
        $zoneGeo = new zoneGeo();
        $form = $this->createForm(zoneGeoType::class, $zoneGeo);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($zoneGeo);
            $em->flush();
            $this->addFlash('ajout', 'Ajout réussi');
            return $this->redirectToRoute('admin-zone-geo-view');
        }
        return $this->render("BienBundle:Admin:zoneGeo-new.html.twig",
            array('form' => $form->createView(),
            ));
    }

    /**
     * @Route ("/admin/zone-geo/view", name="admin-zone-geo-view")
     */
    public function adminZoneGeoViewAction()
    {
        $zoneGeo = $this->getDoctrine()
            ->getManager()
            ->getRepository('BienBundle:zoneGeo')
            ->findAll();
        return $this->render("BienBundle:Admin:zoneGeo-view.html.twig",
            array('zoneGeo' => $zoneGeo));
    }


    ///   UTILISATEUR   ///

    /**
     * @Route ("/admin/utilisateur/fiche/{id}", name="admin-utilisateur-fiche")
     */
    public function adminUtilisateurFicheAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $monUtilisateur = $em->getRepository('BienBundle:User')->find($id);

//        $em = $this->getDoctrine()->getManager();
//        $mesAgences = $em->getRepository('BienBundle:agence')->getAgentInAgence($id);

        return $this->render("BienBundle:Admin:agent-fiche.html.twig",
            array('utilisateur' => $monUtilisateur));
    }

    /**
     * @Route ("/admin/utilisateur/delete/{id}", name="admin-utilisateur-delete")
     */
    public function adminUtilisateurDeleteAction($id)
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('BienBundle:User');
        $utilisateur = $repository->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($utilisateur);
        $em->flush();

        return $this->redirectToRoute('admin-utilisateur-view');
    }

    /**
     * @Route ("/admin/utilisateur/edit/{id}", name="admin-utilisateur-edit")
     */
    public function adminUtilisateurEditAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $monUtilisateur = $em->getRepository('BienBundle:User')->find($id);

        $form = $this->createForm(UserType::class, $monUtilisateur);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->flush();
            return $this->redirectToRoute('admin-utilisateur-view');

        }
        return $this->render("BienBundle:Admin:utilisateur-edit.html.twig",
            array('utilisateur' => $monUtilisateur,
                'form' => $form->createView())
        );
    }

    /**
     * @Route ("/admin/utilisateur/new", name="admin-utilisateur-new")
     */
    public function adminUtilisateurNewAction(Request $request)
    {
        $utilisateur = new User();

        $form = $this->createForm(UserType::class, $utilisateur);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($utilisateur);
            $em->flush();

            //$this->addFlash('ajout','Ajout réussi');

            return $this->redirect("/agence/web/app_dev.php/admin/utilisateur/view");
        }
        return $this->render("BienBundle:Admin:utilisateur-new.html.twig",
            array('form' => $form->createView(),
            ));
    }

    /**
     * @Route ("/admin/utilisateur/view", name="admin-utilisateur-view")
     */
    public function adminUtilisateurViewAction()
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('BienBundle:User');

        $utilisateurs = $repository->findAll();

        return $this->render("BienBundle:Admin:utilisateur-view.html.twig",
            array('utilisateurs' => $utilisateurs));
    }


    ///         PERSONNALISER LE SITE            ///

    /**
     * @Route ("/admin/personnaliser/couleur/view", name="admin-perso-couleur")
     */
    public function adminPersonnaliserCouleurAction(Request $request)
    {

        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('BienBundle:couleur');
        $ancienneCouleur = $repository->find(1);

        $couleur = new couleur();
        $couleur->setId(1);
        $form = $this->createForm(couleurType::class, $ancienneCouleur);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $nom = $ancienneCouleur->getNomCouleur();
            $em->remove($ancienneCouleur);
            $em->flush();
            $couleur->setNomCouleur($nom);
            $em->persist($couleur);
            $em->flush();
            $this->addFlash('modif', 'Modification réussie');
            return $this->redirectToRoute('admin-perso-couleur');
        }
        return $this->render("BienBundle:Admin:perso-couleur-view.html.twig",
            array('couleur' => $couleur,
                'form' => $form->createView())
        );

    }


    ///   ADRESSE   ///

    /**
     * @Route ("/admin/adresse/delete/{id}", name="admin-adresse-delete")
     */
    public function adminAdresseDeleteAction($id)
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('BienBundle:adresse');
        $adresse = $repository->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($adresse);
        $em->flush();

        return $this->redirectToRoute('admin-adresse-view');
    }

    /**
     * @Route ("/admin/adresse/edit/{id}", name="admin-adresse-edit")
     */
    public function adminAdresseEditAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $monAdresse = $em->getRepository('BienBundle:adresse')->find($id);

        $form = $this->createForm(adresseType::class, $monAdresse);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->flush();
            return $this->redirectToRoute('admin-adresse-view');

        }
        return $this->render("BienBundle:Admin:adresse-edit.html.twig",
            array('adresse' => $monAdresse,
                'form' => $form->createView())
        );
    }

    /**
     * @Route ("/admin/adresse/new", name="admin-adresse-new")
     */
    public function adminAdresseNewAction(Request $request)
    {
        $adresse = new adresse();

        $form = $this->createForm(adresseType::class, $adresse);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($adresse);
            $em->flush();

            return $this->redirect("/agence/web/app_dev.php/admin/adresse/view");

        }
        return $this->render("BienBundle:Admin:adresse-new.html.twig",
            array('form' => $form->createView(),
            ));
    }

    /**
     * @Route ("/admin/adresse/view", name="admin-adresse-view")
     */
    public function adminAdresseViewAction()
    {
        $adresses = $this->getDoctrine()
            ->getManager()
            ->getRepository('BienBundle:adresse')
            ->getAdresseWithZoneGeo();

        return $this->render("BienBundle:Admin:adresse-view.html.twig",
            array('adresses' => $adresses));
    }

    //fonction pour donner un nom aléatoire a une image
    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }
}