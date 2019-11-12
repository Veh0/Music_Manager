<?php


namespace App\Entity\Media;


use App\Entity\Album\Album;
use App\Entity\Album\AlbumInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MediumRepository")
 */
class Medium implements MediumInterface
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $type;

    const CD = 1;

    const VINYLE = 2;

    const FILE = 4;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Album\Album", mappedBy="media")
     */
    protected $albums;

    public function __construct()
    {
        $this->albums = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Medium
     */
    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }


    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return Medium
     */
    public function setType(): self
    {
        switch ($this->getId())
        {
            case self::CD:
                $this->type = "CD";
                break;
            case self::VINYLE:
                $this->type = "Vinyle";
                break;
            case self::FILE:
                $this->type = "File";
                break;
            default:
                break;

        }
        return $this;
    }

    /**
     * @return Collection|Album[]
     */
    public function getAlbums(): Collection
    {
        return $this->albums;
    }

    public function addAlbum(Album $album): self
    {
        if (!$this->albums->contains($album)) {
            $this->albums[] = $album;
            $album->addMedium($this);
        }

        return $this;
    }

    public function removeAlbum(Album $album): self
    {
        if ($this->albums->contains($album)) {
            $this->albums->removeElement($album);
            $album->removeMedium($this);
        }

        return $this;
    }

}