<?php

declare(strict_types=1);

namespace GuessTheFlagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Flag.
 *
 * @ORM\Table(name="flag")
 * @ORM\Entity(repositoryClass="GuessTheFlagBundle\Repository\FlagRepository")
 */
class Flag
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="country", type="string", length=255)
     */
    private $country;

    /**
     * @ORM\Column(name="image", type="text")
     */
    private $image;

    /**
     * @ORM\Column(name="continent", type="string")
     */
    private $continent;

    /**
     * @ORM\Column(name="colors", type="json_array")
     */
    private $colors;

    /**
     * @Assert\IsFalse(groups={"non-eu"})
     * @ORM\Column(name="is_eu", type="boolean")
     */
    private $isEu;

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

    public function getisEu(): bool
    {
        return $this->isEu;
    }

    public function setIsEu(bool $isEu): void
    {
        $this->isEu = $isEu;
    }

    public function getColors(): ?array
    {
        return $this->colors;
    }

    public function setColors(array $colors): void
    {
        $this->colors = $colors;
    }
}
