<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFileAPIRequest;
use App\Http\Requests\API\UpdateFileAPIRequest;
use App\Models\File;
use App\Repositories\FileRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class FileController
 * @package App\Http\Controllers\API
 */

class FileAPIController extends AppBaseController
{
    /** @var  FileRepository */
    private $fileRepository;

    public function __construct(FileRepository $fileRepo)
    {
        $this->fileRepository = $fileRepo;
    }

    /**
     * Display a listing of the File.
     * GET|HEAD /files
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $files = $this->fileRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            $files->toArray(),
            __('messages.retrieved', ['model' => __('models/files.plural')])
        );
    }

    /**
     * Store a newly created File in storage.
     * POST /files
     *
     * @param CreateFileAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateFileAPIRequest $request)
    {
        $input = $request->all();

        $file = $this->fileRepository->create($input);

        return $this->sendResponse(
            $file->toArray(),
            __('messages.saved', ['model' => __('models/files.singular')])
        );
    }

    /**
     * Display the specified File.
     * GET|HEAD /files/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var File $file */
        $file = $this->fileRepository->find($id);

        if (empty($file)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/files.singular')])
            );
        }

        return $this->sendResponse(
            $file->toArray(),
            __('messages.retrieved', ['model' => __('models/files.singular')])
        );
    }

    /**
     * Update the specified File in storage.
     * PUT/PATCH /files/{id}
     *
     * @param int $id
     * @param UpdateFileAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFileAPIRequest $request)
    {
        $input = $request->all();

        /** @var File $file */
        $file = $this->fileRepository->find($id);

        if (empty($file)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/files.singular')])
            );
        }

        $file = $this->fileRepository->update($input, $id);

        return $this->sendResponse(
            $file->toArray(),
            __('messages.updated', ['model' => __('models/files.singular')])
        );
    }

    /**
     * Remove the specified File from storage.
     * DELETE /files/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var File $file */
        $file = $this->fileRepository->find($id);

        if (empty($file)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/files.singular')])
            );
        }

        $file->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/files.singular')])
        );
    }
}
