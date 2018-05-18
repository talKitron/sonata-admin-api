<?php

namespace Tests\App\Entity;


use App\Entity\Group;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class GroupTest extends TestCase {
    public function testIsConstructingWithPassedArguments(){
        $groupName = 'Test Group';
        $group = new Group($groupName);
        $this->assertSame($groupName, $group->getName());
    }

    public function testIsAddingRole(){
        $group = new Group('Test Group');
        $group->addRole('ROLE_USER');
        $this->assertSame(1, count($group->getRoles()));
    }

    public function testIsRemovingUserFromCollection(){
        $group = new Group('Test group');
        $role1 = 'ROLE_USER';
        $role2 = 'ROLE_ADMIN';
        $group->addRole($role1);
        $group->addRole($role2);
        $this->assertSame(2, count($group->getRoles()));
        $group->removeRole($role1);
        $this->assertSame(1, count($group->getRoles()));
    }
}