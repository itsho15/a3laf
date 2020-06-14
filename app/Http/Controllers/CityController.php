<?php

namespace App\Http\Controllers;

use App\DataTables\CityDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Repositories\CityRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class CityController extends AppBaseController
{
    /** @var  CityRepository */
    private $cityRepository;

    public function __construct(CityRepository $cityRepo)
    {
        $this->cityRepository = $cityRepo;
    }

    /**
     * Display a listing of the City.
     *
     * @param CityDataTable $cityDataTable
     * @return Response
     */
    public function index(CityDataTable $cityDataTable)
    {
        return $cityDataTable->render('admin.cities.index');
    }

    /**
     * Show the form for creating a new City.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.cities.create');
    }

    /**
     * Store a newly created City in storage.
     *
     * @param CreateCityRequest $request
     *
     * @return Response
     */
    public function store(CreateCityRequest $request)
    {
        $input = $request->all();

        $city = $this->cityRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/cities.singular')]));

        return redirect(route('admin.cities.index'));
    }

    /**
     * Display the specified City.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $city = $this->cityRepository->find($id);

        if (empty($city)) {
            Flash::error(__('models/cities.singular').' '.__('messages.not_found'));

            return redirect(route('admin.cities.index'));
        }

        return view('admin.cities.show')->with('city', $city);
    }

    /**
     * Show the form for editing the specified City.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $city = $this->cityRepository->find($id);

        if (empty($city)) {
            Flash::error(__('messages.not_found', ['model' => __('models/cities.singular')]));

            return redirect(route('admin.cities.index'));
        }

        return view('admin.cities.edit')->with('city', $city);
    }

    /**
     * Update the specified City in storage.
     *
     * @param  int              $id
     * @param UpdateCityRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCityRequest $request)
    {
        $city = $this->cityRepository->find($id);

        if (empty($city)) {
            Flash::error(__('messages.not_found', ['model' => __('models/cities.singular')]));

            return redirect(route('admin.cities.index'));
        }

        $city = $this->cityRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/cities.singular')]));

        return redirect(route('admin.cities.index'));
    }

    /**
     * Remove the specified City from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $city = $this->cityRepository->find($id);

        if (empty($city)) {
            Flash::error(__('messages.not_found', ['model' => __('models/cities.singular')]));

            return redirect(route('admin.cities.index'));
        }

        $this->cityRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/cities.singular')]));

        return redirect(route('admin.cities.index'));
    }
}
