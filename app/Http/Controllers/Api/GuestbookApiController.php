<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Guestbook;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GuestbookApiController extends Controller
{
    protected $hiddenFields = ['guest', 'user_id'];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $records = Guestbook::select('id', 'comment', 'created_at', 'user_id')->with('guest:id,name')->paginate(10);
        return $records->makeHidden($this->hiddenFields);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        $entry = new Guestbook();

        $entry->user_id = $request->user()->id;
        $entry->comment = $request->comment;
        $entry->save();

        return response([
            'success' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Guestbook $guestbook
     * @return Guestbook
     */
    public function show(Guestbook $guestbook)
    {
        $guestbook->setHidden($this->hiddenFields);
        return $guestbook;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Guestbook $guestbook
     * @return JsonResponse|Response
     * @throws AuthorizationException
     */
    public function update(Request $request, Guestbook $guestbook): JsonResponse|Response
    {
        if ($request->user()->id !== $guestbook->user_id
            && !$request->user()->isAdmin()) {
            throw new AuthorizationException;
        }

        $request->validate([
            'comment' => 'required|string',
        ]);

        $guestbook->comment = $request->comment;
        $guestbook->save();

        return response([
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Guestbook $guestbook
     * @return Response
     * @throws AuthorizationException
     */
    public function destroy(Guestbook $guestbook): Response
    {
        if (\Auth::user()->id !== $guestbook->user_id
            && !\Auth::user()?->user()->isAdmin()) {
            throw new AuthorizationException;
        }

        $guestbook->delete();

        return response([
            'success' => true
        ]);
    }
}
