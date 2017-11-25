<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Utilisateur;

class DefaultController extends Controller
{
	private $em;

	public function __construct(){
		dump('toto');
		//$this->em = $this->getDoctrine()->getManager();
		$this->em = $GLOBALS['kernel']->getContainer()->get('doctrine')->getManager();	
		
	}
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
	$utilisateurs = $this->em->getRepository('AppBundle:Utilisateur')->findAll();
	dump($utilisateurs);
	$utilisateur = new Utilisateur();
	$utilisateur->setNom('Bouteille');
	$utilisateur->setPrenom('Alexandre');
	$utilisateur->setMail('a.bouteille@hotmail.fr');
	$utilisateur->setPassword('toto');
	$this->em->persist($utilisateur);
	$this->em->flush();
	$utilisateurs = $this->em->getRepository('AppBundle:Utilisateur')->findAll();
	dump($utilisateurs);

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }
}
