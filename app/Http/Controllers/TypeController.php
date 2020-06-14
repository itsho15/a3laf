<?php

namespace App\Http\Controllers;

use App\DataTables\TypeDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Repositories\TypeRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class TypeController extends AppBaseController
{
    /** @var  TypeRepository */
    private $typeRepository;

    public function __construct(TypeRepository $typeRepo)
    {
        $this->typeRepository = $typeRepo;
    }

    /**
     * Display a listing of the Type.
     *
     * @param TypeDataTable $typeDataTable
     * @return Response
     */
    public function index(TypeDataTable $typeDataTable)
    {
        return $typeDataTable->render('admin.types.index');
    }

    /**
     * Show the form for creating a new Type.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created Type in storage.
     *
     * @param CreateTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateTypeRequest $request)
    {
        $input = $request->all();

        $type = $this->typeRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/types.singular')]));

        return redirect(route('admin.types.index'));
    }

    /**
     * Display the specified Type.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $type = $this->typeRepository->find($id);

        if (empty($type)) {
            Flash::error(__('models/types.singular').' '.__('messages.not_found'));

            return redirect(route('admin.types.index'));
        }

        return view('admin.types.show')->with('type', $type);
    }

    /**
     * Show the form for editing the specified Type.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $type = $this->typeRepository->find($id);

        if (empty($type)) {
            Flash::error(__('messages.not_found', ['model' => __('models/types.singular')]));

            return redirect(route('admin.types.index'));
        }

        return view('admin.types.edit')->with('type', $type);
    }

    /**
     * Update the specified Type in storage.
     *
     * @param  int              $id
     * @param UpdateTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTypeRequest $request)
    {
        $type = $this->typeRepository->find($id);

        if (empty($type)) {
            Flash::error(__('messages.not_found', ['model' => __('models/types.singular')]));

            return redirect(route('admin.types.index'));
        }

        $type = $this->typeRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/types.singular')]));

        return redirect(route('admin.types.index'));
    }

    /**
     * Remove the specified Type from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $type = $this->typeRepository->find($id);

        if (empty($type)) {
            Flash::error(__('messages.not_found', ['model' => __('models/types.singular')]));

            return redirect(route('admin.types.index'));
        }

        $this->typeRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/types.singular')]));

        return redirect(route('admin.types.index'));
    }
}
