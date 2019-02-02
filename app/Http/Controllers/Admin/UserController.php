<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UsersRepository;
use Alert;
use Crypt;
use App\Repositories\UserdetailRepository;

class UserController extends Controller
{
    private $repository;
    private $detailRepo;
    public function __construct(
        UsersRepository $repository,
        UserdetailRepository $detailRepo
    ) {
        $this->repository = $repository;
        $this->detailRepo = $detailRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $this->repository->get(null, $request->input('name'));
        $data = [
            'users' => $user,
        ];

        return view('admin.master.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.master.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->repository->store($request);

        Alert::success('Berhasil disimpan');
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->repository->find($id);
        $data = [
            'user' => $user
        ];

        return view('admin.master.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $this->repository->find($id);
        $this->repository->update($request, $user);

        Alert::success('Berhasil disimpan');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->repository->find(Crypt::decrypt($id));
        $this->repository->destroy($user);

        $detail = $this->detailRepo->findbyuser(Crypt::decrypt($id));
        $this->detailRepo->destroy($detail);

        return redirect()->route('users.index');
    }
}
