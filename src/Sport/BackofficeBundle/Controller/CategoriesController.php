<?php

namespace Sport\BackofficeBundle\Controller;

use Sport\BackofficeBundle\Entity\Categories;
use Sport\BackofficeBundle\Entity\PhotoCategorie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class CategoriesController extends Controller
{
    public function indexAction()
    {
        return $this->render('SportBackofficeBundle:Default:index.html.twig');
    }

    public function listeAction()
    {
         return $this->render('SportBackofficeBundle:categories:liste.html.twig');
    }

    public function ajoutAction()
    {
         return $this->render('SportBackofficeBundle:categories:ajout.html.twig');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function AddCategorisAction(Request $request)
    {

        if($request->getMethod() == "POST") {

            $reponseUrl = array();

            $data  =  json_decode($request->request->get("data"));
            $nom   =  $data->nom ;
            $descp =  $data->description ;



            $em = $this->getDoctrine()->getEntityManager();

                       $repon = $em->getRepository("SportBackofficeBundle:Categories")->findOneBy(array("nom"=>$nom));


                        if(!$repon){

                            $Categories = new Categories();
                            $Categories->setNom($nom);
                            $Categories->setDescription($descp );
                            $Categories->setParent(0);
                            $Categories->setIsdeleted(0);
                            $Categories->setListOrder(0);
                            $Categories->setPublished(0);

                            $uploadedPhoto = $request->files->get("photo");

                            if($uploadedPhoto instanceof UploadedFile){

                                    $mimetype = $uploadedPhoto->getMimeType();
                                    $extension = substr($mimetype, strpos($mimetype,"/")+1 , strlen($mimetype));

                                    if($extension == "jpeg" || $extension == "jpg" || $extension == "png" ){

                                        $photo = new PhotoCategorie();
                                        $namePhoto = "categorie-" . time(). "." . $extension;
                                        $photo->setFile($uploadedPhoto);
                                        $photo->upload($namePhoto);

                                        $photo->setAlt($nom);
                                        $photo->setUrl($namePhoto);




                                    }else{

                                        $photo = new PhotoCategorie();
                                        $photo->setAlt($nom)->setUrl("uploads/categories/avatarCategorie.png");
                                    }

                            }else{

                                $photo = new PhotoCategorie();
                                $photo->setAlt($nom)->setUrl("uploads/categories/avatarCategorie.png");

                            }

                            $Categories->setPhoto($photo);
                            $em->persist($Categories);
                            $em->persist($photo);

                            $em->flush();

                            $reponseUrl["success"] = 1 ;
                            $reponseUrl["message"] = "Categorie Enregester avec succes" ;

                      }else{

                            $reponseUrl["success"] = 0 ;
                            $reponseUrl["message"] = "Categorie existe avec ce Nom" ;

                        }
        }

        return new JsonResponse($reponseUrl);
    }

    public function getCategoriesListAction (Request $request)
    {

          //  if($request->isMethod() == "POST"){


        $data = json_decode($request->getContent(),true) ;

                 $textSearch =  $data["txt"] ;

                 $em = $this->getDoctrine()->getEntityManager() ;
                 $gd = $em->createQueryBuilder();

                 $query =  $gd->select("c")->from("SportBackofficeBundle:Categories", "c");

                 if(strlen($textSearch) > 3  ) {

                     $query->where("c.nom like :nomsearch ");
                 }

                $query->orderBy("c.id","DESC") ;

                if(strlen($textSearch) > 3  ) {

                    $query->setParameter("nomsearch","%".$textSearch."%") ;
                 }

                $resultListCat  =  $query->getQuery()->getResult();

                $baseImage = $request->getScheme()."://".$request->getHttpHost().$request->getBasePath() ."/uploads/categories/" ;

                $reponseUrl = array();

                foreach($resultListCat as $iteam ){

                    $reponseUrl[] = array(
                       "id"=>$iteam->getId(),
                       "description"=>$iteam->getDescription(),
                       "nom"=>$iteam->getNom(),
                        "img"=>$baseImage. $iteam->getPhoto()->getUrl(),
                        "alt"=>$iteam->getPhoto()->getAlt()
                    ) ;

                }


           // }

        return new JsonResponse($reponseUrl);
    }

    public function suppimerCategoriesAction($id){

     $em = $this->getDoctrine()->getEntityManager();

     $categorie = $em->getRepository("SportBackofficeBundle:Categories")->findOneBy(array("id"=>$id));

        if ($categorie ) {

            $em->remove($categorie);
            $em->flush();

            die("Supprimé avec succes");
        }

        die("n'existe pas");

    }

    public function UpdateCategoriesAction(Request $request) {



        if($request->getMethod() == "POST") {

            $reponseUrl = array();

            $data = json_decode($request->request->get("data"));

           // var_dump( $data );

            /*$id = $data->id ;
            $nom = $data->nom;
            $descp = $data->desc;*/

            $id = $data->{"id"};
            $nom = $data->{"nom"};
            $descp = $data->{"desc"};


            $em = $this->getDoctrine()->getEntityManager();
            $Categories = $em->getRepository("SportBackofficeBundle:Categories")->findOneBy(array("id"=>$id));



            if ($Categories) {


                $Categories->setNom($nom);
                $Categories->setDescription($descp);
                $Categories->setParent(0);
                $Categories->setIsdeleted(0);
                $Categories->setListOrder(0);
                $Categories->setPublished(0);


                $uploadedPhoto = $request->files->get("photo");

                if($uploadedPhoto instanceof UploadedFile){

                    $mimetype = $uploadedPhoto->getMimeType();
                    $extension = substr($mimetype, strpos($mimetype,"/")+1 , strlen($mimetype));

                    if($extension == "jpeg" || $extension == "jpg" || $extension == "png" ){

                        $photo = new PhotoCategorie();
                        $namePhoto = "categorie-" . time(). "." . $extension;
                        $photo->setFile($uploadedPhoto);
                        $photo->upload($namePhoto);

                        $photo->setAlt($nom);
                        $photo->setUrl($namePhoto);



                        $em->persist($photo);
                        $em->flush();
                        $Categories->setPhoto($photo);


                    }

                }


                $em->persist($Categories);
                $em->flush();

                $reponseUrl["success"] = 1 ;
                $reponseUrl["message"] = "Categorie Modifer avec succes" ;

            }else{

                $reponseUrl["success"] = 0 ;
                $reponseUrl["message"] = "Categorie n'existe pas" ;

            }

            return new JsonResponse($reponseUrl);
        }


    }

}
