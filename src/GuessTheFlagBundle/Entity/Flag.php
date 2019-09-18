<?php

declare(strict_types=1);

namespace GuessTheFlagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Flag.
 *
 * @ORM\Table(name="flag")
 * @ORM\Entity(repositoryClass="GuessTheFlagBundle\Repository\FlagRepository")
 */
class Flag
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="text")
     */
    private $image;

    /**
     * @ORM\Column(name="continent", type="string")
     */
    private $continent;

    public function getId(): int
    {
        return $this->id;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getContinent(): string
    {
        return $this->continent;
    }

    public function setContinent(string $continent): void
    {
        $this->continent = $continent;
    }
}
