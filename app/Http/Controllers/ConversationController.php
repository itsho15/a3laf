<?php

namespace App\Http\Controllers;

use App\DataTables\ConversationDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateConversationRequest;
use App\Http\Requests\UpdateConversationRequest;
use App\Repositories\ConversationRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ConversationController extends AppBaseController
{
    /** @var  ConversationRepository */
    private $conversationRepository;

    public function __construct(ConversationRepository $conversationRepo)
    {
        $this->conversationRepository = $conversationRepo;
    }

    /**
     * Display a listing of the Conversation.
     *
     * @param ConversationDataTable $conversationDataTable
     * @return Response
     */
    public function index(ConversationDataTable $conversationDataTable)
    {
        return $conversationDataTable->render('admin.conversations.index');
    }

    /**
     * Show the form for creating a new Conversation.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.conversations.create');
    }

    /**
     * Store a newly created Conversation in storage.
     *
     * @param CreateConversationRequest $request
     *
     * @return Response
     */
    public function store(CreateConversationRequest $request)
    {
        $input = $request->all();

        $conversation = $this->conversationRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/conversations.singular')]));

        return redirect(route('admin.conversations.index'));
    }

    /**
     * Display the specified Conversation.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $conversation = $this->conversationRepository->find($id);

        if (empty($conversation)) {
            Flash::error(__('models/conversations.singular').' '.__('messages.not_found'));

            return redirect(route('admin.conversations.index'));
        }

        return view('admin.conversations.show')->with('conversation', $conversation);
    }

    /**
     * Show the form for editing the specified Conversation.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $conversation = $this->conversationRepository->find($id);

        if (empty($conversation)) {
            Flash::error(__('messages.not_found', ['model' => __('models/conversations.singular')]));

            return redirect(route('admin.conversations.index'));
        }

        return view('admin.conversations.edit')->with('conversation', $conversation);
    }

    /**
     * Update the specified Conversation in storage.
     *
     * @param  int              $id
     * @param UpdateConversationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateConversationRequest $request)
    {
        $conversation = $this->conversationRepository->find($id);

        if (empty($conversation)) {
            Flash::error(__('messages.not_found', ['model' => __('models/conversations.singular')]));

            return redirect(route('admin.conversations.index'));
        }

        $conversation = $this->conversationRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/conversations.singular')]));

        return redirect(route('admin.conversations.index'));
    }

    /**
     * Remove the specified Conversation from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $conversation = $this->conversationRepository->find($id);

        if (empty($conversation)) {
            Flash::error(__('messages.not_found', ['model' => __('models/conversations.singular')]));

            return redirect(route('admin.conversations.index'));
        }

        $this->conversationRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/conversations.singular')]));

        return redirect(route('admin.conversations.index'));
    }
}
