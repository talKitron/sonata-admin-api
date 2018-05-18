<?php

namespace Tests\App\Entity;

use App\Entity\Group;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase{

    public function testIsInitializable(){
        $user = new User();
        $this->assertInstanceOf(User::class, $user);
    }

    public function testIsSettingDefaults(){
        $user = new User();
        $this->assertSame('u', $user->getGender());
    }

    public function testIsAddingGroupToCollection(){
        $user = new User();
        $group = new Group('Test group');
        $user->addGroup($group);
        $this->assertSame(1, $user->getGroups()->count());
    }

    public function testIsRemovingGroupToCollection(){
        $user = new User();
        $group = new Group('Test group');
        $user->addGroup($group);
        $this->assertSame(1, $user->getGroups()->count());
    }

    public function testIsCalculatingAge(){
        $user = new User();
        $this->assertSame(null, $user->calculateAge());
        $user->setDateOfBirth('1991-01-01');
        $this->assertTrue($user->calculateAge() > 0);
    }
}