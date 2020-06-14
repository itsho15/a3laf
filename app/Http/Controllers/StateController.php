<?php

namespace App\Http\Controllers;

use App\DataTables\StateDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateStateRequest;
use App\Http\Requests\UpdateStateRequest;
use App\Repositories\StateRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class StateController extends AppBaseController
{
    /** @var  StateRepository */
    private $stateRepository;

    public function __construct(StateRepository $stateRepo)
    {
        $this->stateRepository = $stateRepo;
    }

    /**
     * Display a listing of the State.
     *
     * @param StateDataTable $stateDataTable
     * @return Response
     */
    public function index(StateDataTable $stateDataTable)
    {
        return $stateDataTable->render('admin.states.index');
    }

    /**
     * Show the form for creating a new State.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.states.create');
    }

    /**
     * Store a newly created State in storage.
     *
     * @param CreateStateRequest $request
     *
     * @return Response
     */
    public function store(CreateStateRequest $request)
    {
        $input = $request->all();

        $state = $this->stateRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/states.singular')]));

        return redirect(route('admin.states.index'));
    }

    /**
     * Display the specified State.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $state = $this->stateRepository->find($id);

        if (empty($state)) {
            Flash::error(__('models/states.singular').' '.__('messages.not_found'));

            return redirect(route('admin.states.index'));
        }

        return view('admin.states.show')->with('state', $state);
    }

    /**
     * Show the form for editing the specified State.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $state = $this->stateRepository->find($id);

        if (empty($state)) {
            Flash::error(__('messages.not_found', ['model' => __('models/states.singular')]));

            return redirect(route('admin.states.index'));
        }

        return view('admin.states.edit')->with('state', $state);
    }

    /**
     * Update the specified State in storage.
     *
     * @param  int              $id
     * @param UpdateStateRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStateRequest $request)
    {
        $state = $this->stateRepository->find($id);

        if (empty($state)) {
            Flash::error(__('messages.not_found', ['model' => __('models/states.singular')]));

            return redirect(route('admin.states.index'));
        }

        $state = $this->stateRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/states.singular')]));

        return redirect(route('admin.states.index'));
    }

    /**
     * Remove the specified State from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $state = $this->stateRepository->find($id);

        if (empty($state)) {
            Flash::error(__('messages.not_found', ['model' => __('models/states.singular')]));

            return redirect(route('admin.states.index'));
        }

        $this->stateRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/states.singular')]));

        return redirect(route('admin.states.index'));
    }
}
