<?php 
namespace App\Controller;
use DateTime;
use App\Entity\User;
use App\Entity\Room;
use App\Entity\Member;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MemberController extends AbstractController{

     /**
     * @Route("/newmember", name="add_member")
     */
    public function newMember(ManagerRegistry $doctrine){
        $member= new Member();
        $room=$doctrine->getRepository(Room::class)->findOneBy(['id'=>'4']);//cherche la chambre avec un certain id
        $entityManager=$doctrine->getManager();
        $member->setName('navarel');
        $member->setEmail('navoussipo@gmail.com');
        $member->addRoom($room);//créé le membre qui appartiendra à la chambre trouvée plus haut
        $entityManager->persist($member);
        $entityManager->flush();

        return $this->render('create.html.twig',['test'=>$member]);
    }
    
}
?>