<?php

namespace App\Http\Controllers;

use App\DataTables\FileDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateFileRequest;
use App\Http\Requests\UpdateFileRequest;
use App\Repositories\FileRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class FileController extends AppBaseController
{
    /** @var  FileRepository */
    private $fileRepository;

    public function __construct(FileRepository $fileRepo)
    {
        $this->fileRepository = $fileRepo;
    }

    /**
     * Display a listing of the File.
     *
     * @param FileDataTable $fileDataTable
     * @return Response
     */
    public function index(FileDataTable $fileDataTable)
    {
        return $fileDataTable->render('admin.files.index');
    }

    /**
     * Show the form for creating a new File.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.files.create');
    }

    /**
     * Store a newly created File in storage.
     *
     * @param CreateFileRequest $request
     *
     * @return Response
     */
    public function store(CreateFileRequest $request)
    {
        $input = $request->all();

        $file = $this->fileRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/files.singular')]));

        return redirect(route('admin.files.index'));
    }

    /**
     * Display the specified File.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $file = $this->fileRepository->find($id);

        if (empty($file)) {
            Flash::error(__('models/files.singular').' '.__('messages.not_found'));

            return redirect(route('admin.files.index'));
        }

        return view('admin.files.show')->with('file', $file);
    }

    /**
     * Show the form for editing the specified File.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $file = $this->fileRepository->find($id);

        if (empty($file)) {
            Flash::error(__('messages.not_found', ['model' => __('models/files.singular')]));

            return redirect(route('admin.files.index'));
        }

        return view('admin.files.edit')->with('file', $file);
    }

    /**
     * Update the specified File in storage.
     *
     * @param  int              $id
     * @param UpdateFileRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFileRequest $request)
    {
        $file = $this->fileRepository->find($id);

        if (empty($file)) {
            Flash::error(__('messages.not_found', ['model' => __('models/files.singular')]));

            return redirect(route('admin.files.index'));
        }

        $file = $this->fileRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/files.singular')]));

        return redirect(route('admin.files.index'));
    }

    /**
     * Remove the specified File from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $file = $this->fileRepository->find($id);

        if (empty($file)) {
            Flash::error(__('messages.not_found', ['model' => __('models/files.singular')]));

            return redirect(route('admin.files.index'));
        }

        $this->fileRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/files.singular')]));

        return redirect(route('admin.files.index'));
    }
}
