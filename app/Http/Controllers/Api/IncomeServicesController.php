<?php namespace ApiGfccm\Http\Controllers\Api;

use ApiGfccm\Commands\CreateIncomeServiceCommand;
use ApiGfccm\Http\Controllers\Controller;
use ApiGfccm\Http\Requests;
use ApiGfccm\Http\Requests\IncomeServiceRequest;
use ApiGfccm\Http\Responses\CollectionResponse;
use ApiGfccm\Http\Responses\ItemResponse;
use ApiGfccm\Repositories\Interfaces\IncomeServiceMemberFundRepositoryInterface;
use ApiGfccm\Repositories\Interfaces\IncomeServiceRepositoryInterface;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;


class IncomeServicesController extends Controller
{
    /**
     * @var IncomeServiceRepositoryInterface
     */
    protected $incomeService;

    /**
     * @var IncomeServiceMemberFundRepositoryInterface
     */
    protected $memberFund;

    /**
     * @param IncomeServiceRepositoryInterface $incomeService
     * @param IncomeServiceMemberFundRepositoryInterface $memberFund
     */
    public function __construct(
        IncomeServiceRepositoryInterface $incomeService,
        IncomeServiceMemberFundRepositoryInterface $memberFund)
    {
        $this->incomeService = $incomeService;
        $this->memberFund = $memberFund;
    }

    /**
     * Display a listing Income Services
     *
     * @return CollectionResponse
     */
    public function index()
    {
        return (new CollectionResponse($this->incomeService->all()))->asType('IncomeService');
    }

    /**
     * Display a certain Income Service
     *
     * @param int $id
     * @return ItemResponse
     */
    public function show($id)
    {
        $incomeService = $this->incomeService->show($id);

        if (empty($incomeService)) {
            return response('Unauthorized.', 401);
        }

        return (new ItemResponse($incomeService))->asType('IncomeService');
    }

    /**
     * Create new Income Service
     *
     * @param IncomeServiceRequest $request
     * @param Guard $guard
     * @return ItemResponse
     */
    public function store(IncomeServiceRequest $request, Guard $guard)
    {
        return (new ItemResponse($this->dispatch(
            new CreateIncomeServiceCommand(
                $request->get('service_id'),
                $request->get('service_date'),
                $guard->user()->id,
                3,
                'status')
        )));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}