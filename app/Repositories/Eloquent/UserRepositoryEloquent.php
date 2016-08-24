<?php namespace ApiGfccm\Repositories\Eloquent;

use ApiGfccm\Models\User;
use ApiGfccm\Repositories\Interfaces\AbstractApiInterface;
use ApiGfccm\Repositories\Interfaces\UserRepositoryInterface;

class UserRepositoryEloquent implements AbstractApiInterface, UserRepositoryInterface
{
    /**
     * @var User
     */
    protected $user;

    /**
     * UserRepositoryEloquent constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Returns all Users
     *
     * @return User|null
     */
    public function all()
    {
        return $this->user->with(['member', 'role'])->get();
    }

    /**
     * @param int $id
     * @return User|null
     */
    public function findById($id)
    {
        return $this->user->with(['member', 'role'])->where('id', $id)->first();
    }

    /**
     * @param string $userName
     * @return User|null
     */
    public function findByUsername($userName)
    {
        return $this->user->where('username', $userName)->first();
    }

    /**
     * @param array $payload
     * @return User
     */
    public function create($payload = [])
    {
        return $this->user->create($payload);
    }

    /**
     * @param int $id
     * @param array $payload
     * @return User|null
     */
    public function update($id, $payload = [])
    {
        $user = $this->user->find($id);

        if (!$user) {
            return null;
        }

        if (array_key_exists('member_id', $payload)) {
            return null;
        }

        $user->fill($payload)->save();

        return $user;
    }

}
