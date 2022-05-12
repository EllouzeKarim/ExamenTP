<?php

namespace App\Controller;

use App\Entity\PFE;
use App\Form\PFEType;
use App\Repository\EntrepriseRepository;
use App\Repository\PFERepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('pfe')]
class PFEController extends AbstractController
{

    private $manager;
    public function __construct(private PFERepository $repository, private ManagerRegistry $doctrine,private EntrepriseRepository $repository1)
    {
        $this->manager = $doctrine->getManager();


    }

    #[Route('/add/{id?0}', name: 'app_pfe')]
    public function index(Request $request,PFE $pfe=null): Response
    {
        if(!$pfe)
        $pfe = new PFE();
        $form=$this->createForm(PFEType::class,$pfe);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $this->manager->persist($pfe);
            $this->manager->flush();
            $this->addFlash('success','Votre PFE a été ajouté ');
            return $this->render('/pfe/details.html.twig',['pfe'=>$pfe]);
        }

        return $this->render('/pfe/index.html.twig',[
            'form' => $form->createView(),
        ]);


    }
    #[Route('/total', name: 'app_pfe_total')]
    public function vuetotal(Request $request,): Response
    {
       // $entreprises = $this->repository1->findAll();
       // $repository=$doctrine->getRepository(PFE::class);
        $entreprises=$this->repository->findByEntreprise();
        return $this->render('/pfe/entreprises.html.twig',['entreprises'=>$entreprises]);


    }

}


