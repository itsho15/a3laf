<?php

namespace App\Http\Controllers;

use App\DataTables\BankDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateBankRequest;
use App\Http\Requests\UpdateBankRequest;
use App\Repositories\BankRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class BankController extends AppBaseController
{
    /** @var  BankRepository */
    private $bankRepository;

    public function __construct(BankRepository $bankRepo)
    {
        $this->bankRepository = $bankRepo;
    }

    /**
     * Display a listing of the Bank.
     *
     * @param BankDataTable $bankDataTable
     * @return Response
     */
    public function index(BankDataTable $bankDataTable)
    {
        return $bankDataTable->render('admin.banks.index');
    }

    /**
     * Show the form for creating a new Bank.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.banks.create');
    }

    /**
     * Store a newly created Bank in storage.
     *
     * @param CreateBankRequest $request
     *
     * @return Response
     */
    public function store(CreateBankRequest $request)
    {
        $input = $request->all();

        $bank = $this->bankRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/banks.singular')]));

        return redirect(route('admin.banks.index'));
    }

    /**
     * Display the specified Bank.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $bank = $this->bankRepository->find($id);

        if (empty($bank)) {
            Flash::error(__('models/banks.singular').' '.__('messages.not_found'));

            return redirect(route('admin.banks.index'));
        }

        return view('admin.banks.show')->with('bank', $bank);
    }

    /**
     * Show the form for editing the specified Bank.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $bank = $this->bankRepository->find($id);

        if (empty($bank)) {
            Flash::error(__('messages.not_found', ['model' => __('models/banks.singular')]));

            return redirect(route('admin.banks.index'));
        }

        return view('admin.banks.edit')->with('bank', $bank);
    }

    /**
     * Update the specified Bank in storage.
     *
     * @param  int              $id
     * @param UpdateBankRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBankRequest $request)
    {
        $bank = $this->bankRepository->find($id);

        if (empty($bank)) {
            Flash::error(__('messages.not_found', ['model' => __('models/banks.singular')]));

            return redirect(route('admin.banks.index'));
        }

        $bank = $this->bankRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/banks.singular')]));

        return redirect(route('admin.banks.index'));
    }

    /**
     * Remove the specified Bank from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $bank = $this->bankRepository->find($id);

        if (empty($bank)) {
            Flash::error(__('messages.not_found', ['model' => __('models/banks.singular')]));

            return redirect(route('admin.banks.index'));
        }

        $this->bankRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/banks.singular')]));

        return redirect(route('admin.banks.index'));
    }
}
