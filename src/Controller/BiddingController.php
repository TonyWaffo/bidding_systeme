<?php 
namespace App\Controller;
use DateTime;
use App\Entity\User;
use App\Entity\Room;
use App\Entity\Member;
use App\Entity\Image;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BiddingController extends AbstractController{

    /**
     * @Route("/showrooms/{id}", name="show_rooms")
     */
    public function showMyRooms(User $user){
        /*var_dump($user); // affiche le contenu d'une variable
        exit();*/
        $rooms = $user->getRooms();
        return $this->render('user_rooms.html.twig', ['rooms' => $rooms, 'user' => $user]);
    }

    /**
     * @Route("/showroom/{id}", name="show_room")
     */
    public function showMyRoom(Room $room){
        $members= $room->getMembers()->getValues();// prend les valeurs de la collection pour afficher sous forme de tableau
        $images= $room->getImages()->getValues();
        /*foreach ($entities as $key => $entity) {
            $images[$key] = base64_encode(stream_get_contents($entity->getBlobFile()));
        }*/
        //var_dump(  $images ); // affiche le contenu d'une variable
        //exit();
        return $this->render('user_room.html.twig', ['room' => $room, 'members' => $members, 'images' => $images ]);
    }

     
    /**
     * @Route("/createroom", name="create_room")
     */
    public function createRoom(ManagerRegistry $doctrine){
        $entityManager=$doctrine->getManager();
        $room=new Room();
        $room->setArticle('sandal adidas');
        $room->setPrix('51000');
        $room->setDescription('Seconde main');
        $room->setTimer('11');
        $room->setCounter('2');
        $user=$doctrine->getRepository(User::class)->findOneBy(['email'=>'doric@gmail.com']);// cherche un email spécifique
        $room->setUser($user);//créé la chambre qui sera administrée par l'utilisateur trouvé plus haut
        //$room->addImage();Comment inserer les photos

        $entityManager->persist($room);
        $entityManager->flush();


        return $this->render('create.html.twig',['test'=>$room]);
    }
}
?>