<?php

namespace App\Http\Controllers;

use App\DataTables\FollowerDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateFollowerRequest;
use App\Http\Requests\UpdateFollowerRequest;
use App\Repositories\FollowerRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class FollowerController extends AppBaseController
{
    /** @var  FollowerRepository */
    private $followerRepository;

    public function __construct(FollowerRepository $followerRepo)
    {
        $this->followerRepository = $followerRepo;
    }

    /**
     * Display a listing of the Follower.
     *
     * @param FollowerDataTable $followerDataTable
     * @return Response
     */
    public function index(FollowerDataTable $followerDataTable)
    {
        return $followerDataTable->render('admin.followers.index');
    }

    /**
     * Show the form for creating a new Follower.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.followers.create');
    }

    /**
     * Store a newly created Follower in storage.
     *
     * @param CreateFollowerRequest $request
     *
     * @return Response
     */
    public function store(CreateFollowerRequest $request)
    {
        $input = $request->all();

        $follower = $this->followerRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/followers.singular')]));

        return redirect(route('admin.followers.index'));
    }

    /**
     * Display the specified Follower.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $follower = $this->followerRepository->find($id);

        if (empty($follower)) {
            Flash::error(__('models/followers.singular').' '.__('messages.not_found'));

            return redirect(route('admin.followers.index'));
        }

        return view('admin.followers.show')->with('follower', $follower);
    }

    /**
     * Show the form for editing the specified Follower.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $follower = $this->followerRepository->find($id);

        if (empty($follower)) {
            Flash::error(__('messages.not_found', ['model' => __('models/followers.singular')]));

            return redirect(route('admin.followers.index'));
        }

        return view('admin.followers.edit')->with('follower', $follower);
    }

    /**
     * Update the specified Follower in storage.
     *
     * @param  int              $id
     * @param UpdateFollowerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFollowerRequest $request)
    {
        $follower = $this->followerRepository->find($id);

        if (empty($follower)) {
            Flash::error(__('messages.not_found', ['model' => __('models/followers.singular')]));

            return redirect(route('admin.followers.index'));
        }

        $follower = $this->followerRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/followers.singular')]));

        return redirect(route('admin.followers.index'));
    }

    /**
     * Remove the specified Follower from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $follower = $this->followerRepository->find($id);

        if (empty($follower)) {
            Flash::error(__('messages.not_found', ['model' => __('models/followers.singular')]));

            return redirect(route('admin.followers.index'));
        }

        $this->followerRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/followers.singular')]));

        return redirect(route('admin.followers.index'));
    }
}
