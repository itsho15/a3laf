<?php

namespace App\Http\Controllers;

use App\DataTables\CommentDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Repositories\CommentRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class CommentController extends AppBaseController
{
    /** @var  CommentRepository */
    private $commentRepository;

    public function __construct(CommentRepository $commentRepo)
    {
        $this->commentRepository = $commentRepo;
    }

    /**
     * Display a listing of the Comment.
     *
     * @param CommentDataTable $commentDataTable
     * @return Response
     */
    public function index(CommentDataTable $commentDataTable)
    {
        return $commentDataTable->render('admin.comments.index');
    }

    /**
     * Show the form for creating a new Comment.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.comments.create');
    }

    /**
     * Store a newly created Comment in storage.
     *
     * @param CreateCommentRequest $request
     *
     * @return Response
     */
    public function store(CreateCommentRequest $request)
    {
        $input = $request->all();

        $comment = $this->commentRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/comments.singular')]));

        return redirect(route('admin.comments.index'));
    }

    /**
     * Display the specified Comment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $comment = $this->commentRepository->find($id);

        if (empty($comment)) {
            Flash::error(__('models/comments.singular').' '.__('messages.not_found'));

            return redirect(route('admin.comments.index'));
        }

        return view('admin.comments.show')->with('comment', $comment);
    }

    /**
     * Show the form for editing the specified Comment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $comment = $this->commentRepository->find($id);

        if (empty($comment)) {
            Flash::error(__('messages.not_found', ['model' => __('models/comments.singular')]));

            return redirect(route('admin.comments.index'));
        }

        return view('admin.comments.edit')->with('comment', $comment);
    }

    /**
     * Update the specified Comment in storage.
     *
     * @param  int              $id
     * @param UpdateCommentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCommentRequest $request)
    {
        $comment = $this->commentRepository->find($id);

        if (empty($comment)) {
            Flash::error(__('messages.not_found', ['model' => __('models/comments.singular')]));

            return redirect(route('admin.comments.index'));
        }

        $comment = $this->commentRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/comments.singular')]));

        return redirect(route('admin.comments.index'));
    }

    /**
     * Remove the specified Comment from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $comment = $this->commentRepository->find($id);

        if (empty($comment)) {
            Flash::error(__('messages.not_found', ['model' => __('models/comments.singular')]));

            return redirect(route('admin.comments.index'));
        }

        $this->commentRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/comments.singular')]));

        return redirect(route('admin.comments.index'));
    }
}
