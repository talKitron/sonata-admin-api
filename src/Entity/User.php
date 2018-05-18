<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Ramsey\Uuid\Uuid;
use Sonata\UserBundle\Entity\BaseUser;

/**
 * @ORM\AttributeOverrides({
 *      @ORM\AttributeOverride(name="username",
 *          column=@ORM\Column(type="string")
 *      ),
 *     @ORM\AttributeOverride(name="email",
 *          column=@ORM\Column(type="string")
 *      ),
 *     @ORM\AttributeOverride(name="enabled",
 *          column=@ORM\Column(type="boolean")
 *      ),
 * })
 *
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User extends BaseUser {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @JMS\Groups({"sonata_api_read"})
     */
    protected $username;

    /**
     * @JMS\Groups({"sonata_api_read"})
     */
    protected $email;

    /**
     * @JMS\Groups({"sonata_api_read"})
     */
    protected $enabled;

    public function prePersist(): void {
        parent::prePersist();

        if (empty($this->apiKey)) {
            $this->token = Uuid::uuid4();
        }
    }

    public function calculateAge(): ?int{
        $dob = $this->getDateOfBirth();
        if($dob){
            $diff = (new \DateTime())->diff(new \DateTime($dob));
            return $diff->y;
        }
        return null;
    }
}
