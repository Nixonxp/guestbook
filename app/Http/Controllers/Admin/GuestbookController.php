<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuestbookCreateRequest;
use App\Http\Requests\GuestbookUpdateRequest;
use App\Models\Guestbook;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use InvalidArgumentException;
use Throwable;

class GuestbookController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Guestbook::class, 'guestbook');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $records = Guestbook::select('*')->with('guest')->paginate(10);

        return view('auth.guestbook.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $users = User::select('id', 'name', 'email')->get();
        return view('auth.guestbook.form', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param GuestbookCreateRequest $request
     * @return RedirectResponse
     */
    public function store(GuestbookCreateRequest $request)
    {
        try {
            $record = new Guestbook;
            $data = $request->safe()->all();
            $result = $record
                ->create($data);

            if ($result) {
                return redirect()
                    ->route('guestbook.index', $record->id)
                    ->with(['success' => __('main.save_success')]);
            }
        } catch (InvalidArgumentException $e) {
            $errormsg = $e->getMessage();
        } catch (Throwable) {
            $errormsg = __('main.save_error');
        }

        return back()
            ->with(['warning' => $errormsg])
            ->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return View
     */
    public function show(Guestbook $guestbook): View
    {
        return view('auth.guestbook.show', compact('guestbook'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Guestbook $guestbook
     * @return View
     */
    public function edit(Guestbook $guestbook): View
    {
        $users = User::select('id', 'name', 'email')->get();
        return view('auth.guestbook.form', compact('guestbook', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param GuestbookUpdateRequest $request
     * @param Guestbook $guestbook
     * @return RedirectResponse
     */
    public function update(GuestbookUpdateRequest $request, Guestbook $guestbook)
    {
        try {
            $data = $request->safe()->all();
            $result = $guestbook
                ->update($data);

            if ($result) {
                return redirect()
                    ->route('guestbook.edit', $guestbook->id)
                    ->with(['success' => __('main.save_success')]);
            }
        } catch (InvalidArgumentException $e) {
            $errormsg = $e->getMessage();
        } catch (Throwable) {
            $errormsg = __('main.save_error');
        }

        return back()
            ->with(['warning' => $errormsg])
            ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Guestbook $guestbook
     * @return RedirectResponse
     */
    public function destroy(Guestbook $guestbook): RedirectResponse
    {
        $guestbook->delete();
        session()->flash('success', __('main.delete_success'));
        return redirect(route('guestbook.index'));
    }
}
