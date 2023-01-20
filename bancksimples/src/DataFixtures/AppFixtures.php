<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\TipoConta;
use App\Entity\Gerente;
use App\Entity\Agencia;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $hasher
    ){}

    public function load(ObjectManager $manager): void
    {
        $user1 = new User(); 
        $user1->setEmail('admin@gmail.com');
        $user1->setRoles(['ROLE_ADMIN']);
        $user1->setPassword(
            $this->hasher->hashPassword($user1, '123456')
        );
        $user1->setStatus(true);
        $user1->setNome('Ricardo Dev');
        $user1->setDataCriacao(new \DateTime());
        $manager->persist($user1);

        $user2 = new User(); 
        $user2->setEmail('gerente-renan@gmail.com');
        $user2->setRoles(['ROLE_GERENTE']);
        $user2->setPassword(
            $this->hasher->hashPassword($user2, '123456')
        );
        $user2->setStatus(true);
        $user2->setNome('Renan Dev');
        $user2->setDataCriacao(new \DateTime());
        $manager->persist($user2);

        $user3 = new User(); 
        $user3->setEmail('cliente@gmail.com');
        $user3->setRoles(['ROLE_CLIENTE']);
        $user3->setPassword(
            $this->hasher->hashPassword($user2, '123456')
        );
        $user3->setStatus(true);
        $user3->setNome('Ayla Dev');
        $user3->setDataCriacao(new \DateTime());
        $manager->persist($user3);

        $user4 = new User(); 
        $user4->setEmail('gerente-roberto@gmail.com');
        $user4->setRoles(['ROLE_GERENTE']);
        $user4->setPassword(
            $this->hasher->hashPassword($user2, '123456')
        );
        $user4->setStatus(true);
        $user4->setNome('Roberto Dev');
        $user4->setDataCriacao(new \DateTime());
        $manager->persist($user4);

        $user5 = new User(); 
        $user5->setEmail('gerente-severino@gmail.com');
        $user5->setRoles(['ROLE_GERENTE']);
        $user5->setPassword(
            $this->hasher->hashPassword($user2, '123456')
        );
        $user5->setStatus(true);
        $user5->setNome('Severino Dev');
        $user5->setDataCriacao(new \DateTime());
        $manager->persist($user5);

        $tipoConta1 = new TipoConta();
        $tipoConta1->setTipo('CC');
        $manager->persist($tipoConta1);

        $tipoConta2 = new TipoConta();
        $tipoConta2->setTipo('CP');
        $manager->persist($tipoConta2);

        $gerente1 = new Gerente();
        $gerente1->setNome($user2->getNome());
        $gerente1->setUser($user2);
        $manager->persist($gerente1);

        $gerente2 = new Gerente();
        $gerente2->setNome($user4->getNome());
        $gerente2->setUser($user4);
        $manager->persist($gerente1);

        $gerente3 = new Gerente();
        $gerente3->setNome($user5->getNome());
        $gerente3->setUser($user5);
        $manager->persist($gerente3);

        $agencia1 = new Agencia();
        $agencia1->setGerente($gerente1);
        $agencia1->setNumeroAgencia('001');
        $agencia1->setCidade('São Paulo');
        $agencia1->setEndereco('Rua Principal');
        $agencia1->setCep('58333-000');
        $agencia1->setBairro('Centro');
        $agencia1->setNumeroEndereco('222');
        $agencia1->setEstado('SP');
        $agencia1->setDataCriacao(new \DateTime());
        $manager->persist($agencia1);

        $agencia2 = new Agencia();
        $agencia2->setGerente($gerente2);
        $agencia2->setNumeroAgencia('002');
        $agencia2->setCidade('Mamanguape');
        $agencia2->setEndereco('Rua Imperador Dom Pedro Primeiro');
        $agencia2->setCep('58111-333');
        $agencia2->setBairro('Centro');
        $agencia2->setNumeroEndereco('11');
        $agencia2->setEstado('pb');
        $agencia2->setDataCriacao(new \DateTime());
        $manager->persist($agencia2);

        $agencia3 = new Agencia();
        $agencia3->setGerente($gerente3);
        $agencia3->setNumeroAgencia('003');
        $agencia3->setCidade('Rio de Janeiro');
        $agencia3->setEndereco('Rua Dev');
        $agencia3->setCep('58444-999');
        $agencia3->setBairro('Centro');
        $agencia3->setNumeroEndereco('88');
        $agencia3->setEstado('Rj');
        $agencia3->setDataCriacao(new \DateTime());
        $manager->persist($agencia3);

        $gerente1->setAgencia($agencia1);
        $manager->persist($gerente1);
        
        $gerente2->setAgencia($agencia2);
        $manager->persist($gerente2);
        
        $gerente3->setAgencia($agencia3);
        $manager->persist($gerente3);

        

        $manager->flush();
    }
}
