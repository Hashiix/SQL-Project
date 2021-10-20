<?php

namespace App\Entity;

use App\Repository\SessionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SessionsRepository::class)
 */
class Sessions
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Movies::class, inversedBy="sessions")
     */
    private $movie;

    /**
     * @ORM\ManyToOne(targetEntity=Slots::class, inversedBy="sessions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $slot;

    /**
     * @ORM\ManyToOne(targetEntity=Days::class, inversedBy="sessions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $day;

    /**
     * @ORM\Column(type="integer")
     */
    private $seatsleft;

    /**
     * @ORM\OneToMany(targetEntity=Tickets::class, mappedBy="session")
     */
    private $tickets;

    public function __construct()
    {
        $this->movie = new ArrayCollection();
        $this->tickets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|movies[]
     */
    public function getMovie(): Collection
    {
        return $this->movie;
    }

    public function addMovie(movies $movie): self
    {
        if (!$this->movie->contains($movie)) {
            $this->movie[] = $movie;
        }

        return $this;
    }

    public function removeMovie(movies $movie): self
    {
        $this->movie->removeElement($movie);

        return $this;
    }

    public function getSlot(): ?slots
    {
        return $this->slot;
    }

    public function setSlot(?slots $slot): self
    {
        $this->slot = $slot;

        return $this;
    }

    public function getDay(): ?days
    {
        return $this->day;
    }

    public function setDay(?days $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getSeatsleft(): ?int
    {
        return $this->seatsleft;
    }

    public function setSeatsleft(int $seatsleft): self
    {
        $this->seatsleft = $seatsleft;

        return $this;
    }

    /**
     * @return Collection|Tickets[]
     */
    public function getTickets(): Collection
    {
        return $this->tickets;
    }

    public function addTicket(Tickets $ticket): self
    {
        if (!$this->tickets->contains($ticket)) {
            $this->tickets[] = $ticket;
            $ticket->setSession($this);
        }

        return $this;
    }

    public function removeTicket(Tickets $ticket): self
    {
        if ($this->tickets->removeElement($ticket)) {
            // set the owning side to null (unless already changed)
            if ($ticket->getSession() === $this) {
                $ticket->setSession(null);
            }
        }

        return $this;
    }
}
