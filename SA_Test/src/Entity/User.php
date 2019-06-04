<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 *     fields={"username"},
 *     message="This username is already in use"
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8", minMessage="Your password must at least contain 8 characters")
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password", message="Your confirm password is different of your password")
     */
    private $confirm_password;


    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Bug", mappedBy="contributors")
     */
    private $buglist;



    public function __construct()
    {
        $this->buglist = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getConfirmPassword()
    {
        return $this->confirm_password;
    }

    public function setConfirmPassword($confirm_password): void
    {
        $this->confirm_password = $confirm_password;
    }

    /**
     * @return Collection|Bug[]
     */
    public function getBuglist(): Collection
    {
        return $this->buglist;
    }

    public function addBuglist(Bug $buglist): self
    {
        if (!$this->buglist->contains($buglist)) {
            $this->buglist[] = $buglist;
            $buglist->addContributor($this);
        }

        return $this;
    }

    public function removeBuglist(Bug $buglist): self
    {
        if ($this->buglist->contains($buglist)) {
            $this->buglist->removeElement($buglist);
            $buglist->removeContributor($this);
        }

        return $this;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }

}
