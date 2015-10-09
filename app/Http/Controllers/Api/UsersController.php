<?php

namespace ApiGfccm\Http\Controllers\Api;

use ApiGfccm\Http\Requests;
use Illuminate\Http\Request;
use ApiGfccm\Repositories\Interfaces\UserRepositoryInterface;
use ApiGfccm\Http\Responses\ItemResponse;
use ApiGfccm\Http\Responses\CollectionResponse;

class UsersController extends ApiController
{

    /**
     * @var UserRepositoryInterface
     */
    protected $user;

    /**
     * @param UserRepositoryInterface $user
     */
    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    /**
     * Get all Users
     *
     * @return CollectionResponse
     */

    public function index()
    {
        return $test = (new CollectionResponse($this->user->getAllUsers()))->asType('User');

        print_r($this->user->getAllUsers()->toArray());
    }

    /**
     * Get a Single User Information
     *
     * @param $id
     * @return ItemResponse
     */

    public function show($id)
    {
        return new ItemResponse($this->user->getById($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $input = array_filter($request->request->all());

        return (new ItemResponse($this->user->updateUser($id, $input)))->asType('User');
    }
}