<?php

namespace App\Entity;

use App\Repository\TestEntityRepository;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Index;
use Jsor\Doctrine\PostGIS\Types\PostGISType;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[Entity(repositoryClass: TestEntityRepository::class)]
#[Index(fields: ['geometry'], flags: ['spatial'])]
class TestEntity
{
    #[Id]
    #[Column(type: UuidType::NAME)]
    private Uuid $id;
    #[Column(type: PostGISType::GEOMETRY, nullable: true)]
    private ?string $geometry = null;

    public function __construct()
    {
        $this->id = Uuid::v7();
    }

    /**
     * @return Uuid
     */
    public function getId(): Uuid
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getGeometry(): ?string
    {
        return $this->geometry;
    }

    /**
     * @param string|null $geometry
     */
    public function setGeometry(?string $geometry): void
    {
        $this->geometry = $geometry;
    }
}
