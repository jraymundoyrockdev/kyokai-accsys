<?php namespace ApiGfccm\Repositories\Interfaces;

interface IncomeServiceRepositoryInterface
{
    /**
     * Returns all Income Services
     *
     * @return mixed
     */
    public function all();

    /**
     * Returns an Income Services
     *
     * @param int $id
     * @return mixed
     */
    public function show($id);

    /**
     * Create|Update Income Service
     *
     * @param array $payload
     * @param int|null $id
     * @return mixed
     */
    public function save($payload, $id = null);

    /**
     * Create a bulk of Structural Fund
     *
     * @param array $payload
     * @return mixed
     */
    public function createFundStructure(array $payload);

    /**
     * Create a bulk of Structural Fund
     *
     * @param array $payload
     * @return mixed
     */
    public function createFundItemStructure(array $payload);

    /**
     * Create a bulk of Denomination Structural Fund
     *
     * @param array $payload
     * @return mixed
     */
    public function createDenominationStructure(array $payload);

    /**
     * Updates funds amount
     *
     * @param int $id
     * @param array $payload
     * @param string $method
     * @return mixed
     */
    public function updateFunds($id, $payload, $method);
}