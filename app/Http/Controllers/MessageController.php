<?php

namespace App\Http\Controllers;

use App\DataTables\MessageDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Repositories\MessageRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class MessageController extends AppBaseController
{
    /** @var  MessageRepository */
    private $messageRepository;

    public function __construct(MessageRepository $messageRepo)
    {
        $this->messageRepository = $messageRepo;
    }

    /**
     * Display a listing of the Message.
     *
     * @param MessageDataTable $messageDataTable
     * @return Response
     */
    public function index(MessageDataTable $messageDataTable)
    {
        return $messageDataTable->render('admin.messages.index');
    }

    /**
     * Show the form for creating a new Message.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.messages.create');
    }

    /**
     * Store a newly created Message in storage.
     *
     * @param CreateMessageRequest $request
     *
     * @return Response
     */
    public function store(CreateMessageRequest $request)
    {
        $input = $request->all();

        $message = $this->messageRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/messages.singular')]));

        return redirect(route('admin.messages.index'));
    }

    /**
     * Display the specified Message.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $message = $this->messageRepository->find($id);

        if (empty($message)) {
            Flash::error(__('models/messages.singular').' '.__('messages.not_found'));

            return redirect(route('admin.messages.index'));
        }

        return view('admin.messages.show')->with('message', $message);
    }

    /**
     * Show the form for editing the specified Message.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $message = $this->messageRepository->find($id);

        if (empty($message)) {
            Flash::error(__('messages.not_found', ['model' => __('models/messages.singular')]));

            return redirect(route('admin.messages.index'));
        }

        return view('admin.messages.edit')->with('message', $message);
    }

    /**
     * Update the specified Message in storage.
     *
     * @param  int              $id
     * @param UpdateMessageRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMessageRequest $request)
    {
        $message = $this->messageRepository->find($id);

        if (empty($message)) {
            Flash::error(__('messages.not_found', ['model' => __('models/messages.singular')]));

            return redirect(route('admin.messages.index'));
        }

        $message = $this->messageRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/messages.singular')]));

        return redirect(route('admin.messages.index'));
    }

    /**
     * Remove the specified Message from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $message = $this->messageRepository->find($id);

        if (empty($message)) {
            Flash::error(__('messages.not_found', ['model' => __('models/messages.singular')]));

            return redirect(route('admin.messages.index'));
        }

        $this->messageRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/messages.singular')]));

        return redirect(route('admin.messages.index'));
    }
}
