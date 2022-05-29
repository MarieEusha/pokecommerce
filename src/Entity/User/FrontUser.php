<?php

namespace App\Entity\User;

use App\Repository\FrontUserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FrontUserRepository::class)]
class FrontUser extends BaseUser
{

}
