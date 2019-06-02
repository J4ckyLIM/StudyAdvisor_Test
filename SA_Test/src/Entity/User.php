<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
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
     */
    private $password;

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

}
