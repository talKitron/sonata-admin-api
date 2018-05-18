<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sonata\UserBundle\Entity\BaseGroup;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\AttributeOverrides({
 *      @ORM\AttributeOverride(name="name",
 *          column=@ORM\Column(type="string")
 *      )
 * })
 *
 * @ORM\Entity
 * @ORM\Table(name="groups")
 */
class Group extends BaseGroup {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Groups({"sonata_api_read", "sonata_api_write"})
     */
    protected $id;

    /**
     * @JMS\Groups({"sonata_api_read"})
     */
    protected $name;

    /**
     * @ORM\ManyToMany(targetEntity="User", inversedBy="users")
     * @ORM\JoinTable(name="fos_user_user_group",
     *  joinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")},
     *  inverseJoinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")}
     * )
     * @JMS\Groups({"sonata_api_read"})
     */
    protected $users;

    /**
     * @return ArrayCollection
     */
    public function getUsers() {
        return $this->users;
    }
}
