<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatestatusRequest;
use App\Http\Requests\UpdatestatusRequest;
use App\Repositories\statusRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class statusController extends AppBaseController
{
    /** @var  statusRepository */
    private $statusRepository;

    public function __construct(statusRepository $statusRepo)
    {
        $this->statusRepository = $statusRepo;
    }

    /**
     * Display a listing of the status.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->statusRepository->pushCriteria(new RequestCriteria($request));
        $statuses = $this->statusRepository->all();

        return view('statuses.index')
            ->with('statuses', $statuses);
    }

    /**
     * Show the form for creating a new status.
     *
     * @return Response
     */
    public function create()
    {
        return view('statuses.create');
    }

    /**
     * Store a newly created status in storage.
     *
     * @param CreatestatusRequest $request
     *
     * @return Response
     */
    public function store(CreatestatusRequest $request)
    {
        $input = $request->all();

        $status = $this->statusRepository->create($input);

        Flash::success('Status saved successfully.');

        return redirect(route('statuses.index'));
    }

    /**
     * Display the specified status.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $status = $this->statusRepository->findWithoutFail($id);

        if (empty($status)) {
            Flash::error('Status not found');

            return redirect(route('statuses.index'));
        }

        return view('statuses.show')->with('status', $status);
    }

    /**
     * Show the form for editing the specified status.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $status = $this->statusRepository->findWithoutFail($id);

        if (empty($status)) {
            Flash::error('Status not found');

            return redirect(route('statuses.index'));
        }

        return view('statuses.edit')->with('status', $status);
    }

    /**
     * Update the specified status in storage.
     *
     * @param  int              $id
     * @param UpdatestatusRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatestatusRequest $request)
    {
        $status = $this->statusRepository->findWithoutFail($id);

        if (empty($status)) {
            Flash::error('Status not found');

            return redirect(route('statuses.index'));
        }

        $status = $this->statusRepository->update($request->all(), $id);

        Flash::success('Status updated successfully.');

        return redirect(route('statuses.index'));
    }

    /**
     * Remove the specified status from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $status = $this->statusRepository->findWithoutFail($id);

        if (empty($status)) {
            Flash::error('Status not found');

            return redirect(route('statuses.index'));
        }

        $this->statusRepository->delete($id);

        Flash::success('Status deleted successfully.');

        return redirect(route('statuses.index'));
    }
}
