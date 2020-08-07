<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePageAPIRequest;
use App\Http\Requests\API\UpdatePageAPIRequest;
use App\Models\Page;
use App\Repositories\PageRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PageController
 * @package App\Http\Controllers\API
 */

class PageAPIController extends AppBaseController
{
    /** @var  PageRepository */
    private $pageRepository;

    public function __construct(PageRepository $pageRepo)
    {
        $this->pageRepository = $pageRepo;
    }

    /**
     * Display a listing of the Page.
     * GET|HEAD /pages
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $pages = $this->pageRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            $pages->toArray(),
            __('messages.retrieved', ['model' => __('models/pages.plural')])
        );
    }

    /**
     * Store a newly created Page in storage.
     * POST /pages
     *
     * @param CreatePageAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePageAPIRequest $request)
    {
        $input = $request->all();

        $page = $this->pageRepository->create($input);

        return $this->sendResponse(
            $page->toArray(),
            __('messages.saved', ['model' => __('models/pages.singular')])
        );
    }

    /**
     * Display the specified Page.
     * GET|HEAD /pages/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Page $page */
        $page = $this->pageRepository->find($id);

        if (empty($page)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/pages.singular')])
            );
        }

        return $this->sendResponse(
            $page->toArray(),
            __('messages.retrieved', ['model' => __('models/pages.singular')])
        );
    }

    /**
     * Update the specified Page in storage.
     * PUT/PATCH /pages/{id}
     *
     * @param int $id
     * @param UpdatePageAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePageAPIRequest $request)
    {
        $input = $request->all();

        /** @var Page $page */
        $page = $this->pageRepository->find($id);

        if (empty($page)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/pages.singular')])
            );
        }

        $page = $this->pageRepository->update($input, $id);

        return $this->sendResponse(
            $page->toArray(),
            __('messages.updated', ['model' => __('models/pages.singular')])
        );
    }

    /**
     * Remove the specified Page from storage.
     * DELETE /pages/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Page $page */
        $page = $this->pageRepository->find($id);

        if (empty($page)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/pages.singular')])
            );
        }

        $page->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/pages.singular')])
        );
    }
}
