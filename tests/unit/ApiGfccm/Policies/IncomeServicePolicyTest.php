<?php

use ApiGfccm\Models\Member;
use ApiGfccm\Models\Role;
use ApiGfccm\Models\User;
use ApiGfccm\Models\UserRole;
use ApiGfccm\Policies\IncomeServicePolicy;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

class IncomeServicePolicyTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions, MockeryPHPUnitIntegration;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
    }

    /**
     * @test
     */
    public function it_returns_false_on_put_post_delete_when_user_is_not_authorized()
    {
        $member = factory(Member::class)->create();
        $user = factory(User::class)->create(['member_id' => $member->id]);
        $role = factory(Role::class)->create(['id' => 5]);
        $userRole = factory(UserRole::class)->create(['user_id' => $user->id, 'role_id' => $role->id]);

        $policy = new IncomeServicePolicy($userRole);

        $result = $policy->putPostDelete($user);

        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function it_returns_true_on_put_post_delete_when_user_is_authorized()
    {
        $member = factory(Member::class)->create();
        $user = factory(User::class)->create(['member_id' => $member->id]);
        $role = factory(Role::class)->create(['id' => 3]);
        $userRole = factory(UserRole::class)->create(['user_id' => $user->id, 'role_id' => $role->id]);

        $policy = new IncomeServicePolicy($userRole);

        $result = $policy->putPostDelete($user);

        $this->assertTrue($result);
    }
}