<?php

namespace App\Entity;

use App\Repository\MoviesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MoviesRepository::class)
 */
class Movies
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $attach;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $releasedate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $length;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=Rooms::class, inversedBy="movies")
     */
    private $room;

    /**
     * @ORM\ManyToMany(targetEntity=Sessions::class, mappedBy="movie")
     */
    private $sessions;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $lastdate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $firstday;

    public function __construct()
    {
        $this->sessions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAttach(): ?string
    {
        return $this->attach;
    }

    public function setAttach(?string $attach): self
    {
        $this->attach = $attach;

        return $this;
    }

    public function getReleasedate(): ?\DateTimeInterface
    {
        return $this->releasedate;
    }

    public function setReleasedate(?\DateTimeInterface $releasedate): self
    {
        $this->releasedate = $releasedate;

        return $this;
    }

    public function getLength(): ?string
    {
        return $this->length;
    }

    public function setLength(?string $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getRoom(): ?rooms
    {
        return $this->room;
    }

    public function setRoom(?rooms $room): self
    {
        $this->room = $room;

        return $this;
    }

    /**
     * @return Collection|Sessions[]
     */
    public function getSessions(): Collection
    {
        return $this->sessions;
    }

    public function addSession(Sessions $session): self
    {
        if (!$this->sessions->contains($session)) {
            $this->sessions[] = $session;
            $session->addMovie($this);
        }

        return $this;
    }

    public function removeSession(Sessions $session): self
    {
        if ($this->sessions->removeElement($session)) {
            $session->removeMovie($this);
        }

        return $this;
    }

    public function getLastdate(): ?\DateTimeInterface
    {
        return $this->lastdate;
    }

    public function setLastdate(?\DateTimeInterface $lastdate): self
    {
        $this->lastdate = $lastdate;

        return $this;
    }

    public function getFirstday(): ?\DateTimeInterface
    {
        return $this->firstday;
    }

    public function setFirstday(?\DateTimeInterface $firstday): self
    {
        $this->firstday = $firstday;

        return $this;
    }
}
