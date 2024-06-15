<?php

namespace App\Entity;

use App\Repository\ProviderRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Enum\ProviderType;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=ProviderRepository::class)
 * @ORM\HasLifecycleCallbacks
 */
class Provider
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Email
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank
     */
    private $telefono;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank
     * @Assert\Callback({"App\Entity\Provider", "validateTipo"})
     */
    private $tipo; //de hotel, pista o complemento.

    /**
     * @ORM\Column(type="boolean")
     * @Assert\NotNull
     */
    private $estado; //activos o no

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="create")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="update")
     */
    private $updated_at;

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue(): void
    {
        $this->created_at = new \DateTime();
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue(): void
    {
        $this->updated_at = new \DateTime();
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public static function validateTipo($tipo, ExecutionContextInterface $context, $payload)
    {
        if (!ProviderType::isValidType($tipo)) {
            $context->buildViolation('Tipo inválido.')
                ->atPath('tipo')
                ->addViolation();
        }
    }


    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        if (!ProviderType::isValidType($tipo)) {
            throw new \InvalidArgumentException('Tipo inválido.');
        }
        $this->tipo = $tipo;

        return $this;
    }

    public function getEstado(): ?bool
    {
        return $this->estado;
    }

    public function setEstado(bool $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function __toString()
    {
        return $this->nombre; // o cualquier otra propiedad que tenga sentido
    }


}
