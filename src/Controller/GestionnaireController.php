<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Menu;
use App\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use App\Repository\MenuRepository;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class GestionnaireController extends AbstractController
{
    // ********** Gestion des Catégories **********

    #[Route('/dashboard/category', name: 'dashboard_category')]
    #[Route('/dashboard/category/{id}', name: 'category_edit')]
    public function catalogueCategories(Category $category = null,
                                        CategoryRepository $repoC,
                                        Request $request,
                                        EntityManagerInterface $manager
                                        ): Response
    {
        $this->security();
        $categories = $repoC->findAll();
        
        if(!$category){
            $category = new Category();
        }

        $form = $this->createFormBuilder($category)
                    ->add('libelle', TextType::class, [
                        'attr' => [
                            'placeholder' => 'Le nom de la categorie',
                            'class' => 'form-control'
                        ]
                    ])
                    ->add('description', TextareaType::class, [
                        'attr' => [
                            'placeholder' => 'La description de la categorie',
                            'class' => 'form-control'
                        ]
                    ])
                    ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($category);
            $manager->flush();
            return $this->redirectToRoute('dashboard_category');
        }

        return $this->render('gestionnaire/category.html.twig', [
            'categories' => $categories,
            'form' => $form->createView()
        ]);
    }

    #[Route('/dashboard/category/rm/{id}', name: 'category_remove')]
    public function removeCategory(Category $category,
                                    EntityManagerInterface $manager): Response
    {
        if($category){
            $manager->remove($category);
            $manager->flush();
            return $this->redirectToRoute('dashboard_category');
        }
        return $this->render('gestionnaire/category.html.twig');
    }

    // ********** Gestion des Menus **********

    #[Route('/dashboard/menu', name: 'dashboard_menu')]
    #[Route('/dashboard/menu/{id}', name: 'menu_edit')]
    public function catalogueMenus(Menu $menu = null,
                                   Request $request,
                                   MenuRepository $repo,
                                   ProduitRepository $repoP): Response
    {
        $this->security();

        $menus = $repo->findAll();
        $produits = $repoP->findAll();
        if(!$menu){
            $menu = new Menu;
        }

        $form = $this->createFormBuilder($menu)
                    ->add('libelle', TextType::class, [
                        'attr' => [
                            'placeholder' => 'Le nom du menu',
                            'class' => 'form-control'
                        ]
                    ])
                    ->add('image', FileType::class, [
                        'attr' => [
                            'placeholder' => 'L\'image du menu',
                            'class' => 'form-control'
                        ]
                    ])
                    ->add('description', TextareaType::class, [
                        'attr' => [
                            'placeholder' => 'La description du menu',
                            'class' => 'form-control'
                        ]
                    ])
                    ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($menu);
            $manager->flush();
            return $this->redirectToRoute('dashboard_menu');
        }

        return $this->render('gestionnaire/menu.html.twig', [
            'menus' => $menus,
            'produits' => $produits,
            'form' => $form->createView()
        ]);
    }

    // ********** Gestion des Produits **********

    #[Route('/dashboard/product', name: 'dashboard_product')]
    #[Route('/dashboard/product/{id}', name: 'product_edit')]
    public function catalogueProduits(Produit $produit = null,
                                      Request $request,
                                      ProduitRepository $repo,
                                      EntityManagerInterface $manager
                                      ): Response
    {
        $this->security();
        $produits = $repo->findAll();
        if(!$produit){
            $produit = new Produit;
        }
        
        $form = $this->createFormBuilder($produit)
                    ->add('libelle', TextType::class, [
                        'attr' => [
                            'placeholder' => 'Le nom du produit',
                            'class' => 'form-control'
                        ]
                    ])
                    ->add('prix', NumberType::class, [
                        'attr' => [
                            'placeholder' => 'Le prix du produit',
                            'class' => 'form-control'
                        ]
                    ])
                    ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $composants = explode(',', $request->get('composants'));
            $produit->setComposants($composants);
            $produit->setAddedAt(new \DateTimeImmutable());
            $manager->persist($produit);
            $manager->flush();
            return $this->redirectToRoute('dashboard_product');
        }
            
        return $this->render('gestionnaire/product.html.twig', [
            'produits' => $produits,
            'form' => $form->createView()
        ]);
    }

    // ********** Méthode de Sécurité **********

    private function security(){
        if($this->getUser()){
            if($this->getUser()->getRoles()[0] != 'ROLE_GESTIONNAIRE'){
                return $this->redirectToRoute('home');
            }
        } else {
            return $this->redirectToRoute('app_login');
        }
    }
}