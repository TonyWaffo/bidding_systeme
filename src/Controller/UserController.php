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

class UserController extends AbstractController{
    /**
     * @Route("/createuser", name="create_user")
     */
    public function addUser(ManagerRegistry $doctrine){
        $entityManager=$doctrine->getManager();
        $user=new User();
        $x = rand() * 2147483647;
        $user->setEmail('tony'.$x.'@gmail.com');
        $user->setPassword('hdjdhd_jd;');
        $user->setFirstName('Frederic');
        $user->setLastName('Tamo');
        $user->setAddress('Rue de la joie');
        $user->setZipCode('BP 8554 ');
        $user->setCountry('Cameroun');
        $user->setTown('Douala');
        // $date=new DateTime('2000-01-01');
        $date=DateTime::createFromFormat('d/m/Y',"12/08/1991");
        $user->setBirthday($date);
        $user->setPhone('658741258');
        $user->setOccupation('chomeur');
        $user->setGender('male');
        $user->setStatus('Divorcé');
        $entityManager->persist($user);
        $entityManager->flush();


        return $this->render('create.html.twig',['test'=>$user]);
    }
}
?>