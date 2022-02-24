<?php 
namespace App\Controller;
use DateTime;
use App\Entity\User;
use App\Entity\Room;
use App\Entity\Member;
use App\Entity\Image;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ImageController extends AbstractController{
     /**
     * @Route("/newimage/{id}", name="add_image")
     */
    public function addImage( Room $room, ManagerRegistry $doctrine){
        $image= new Image();
        $entityManager=$doctrine->getManager();
        $image->setName('Liberty art');
        $time= new Datetime();//temps actuel
        $time->format("d-m-y H-i-s");// format du temps
        //fixer le time zone
        $image->setCreationDate($time);
        $image->setLastUpdateDate($time);
        $file=file_get_contents("C:/wamp64(1)/www/bidding_room/public/image/flag.jpg");// transforme le contenu d'une image en chaine de caractères
        $image->setBlobFile($file);
        $image->addRoom($room);//créé le membre qui appartiendra à la chambre trouvée plus haut
        $entityManager->persist($image);
        $entityManager->flush();

        return $this->render('create.html.twig',['test'=>$image]);
    }
    
}
?>