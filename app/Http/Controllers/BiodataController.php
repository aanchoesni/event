<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserdetailRepository;
use App\Models\Userdetail;
use Alert;
use Validator;
use Auth;
use App\Repositories\TypeRepository;
use App\Repositories\UnitRepository;

class BiodataController extends Controller
{
    public function __construct(
        UserdetailRepository $detailRepository,
        TypeRepository $typeRepository,
        UnitRepository $unitRepository
        ) {
        $this->detailRepository = $detailRepository;
        $this->typeRepository = $typeRepository;
        $this->unitRepository = $unitRepository;
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');

        $checkbiodata = Userdetail::where('noidentitas', $request->input('noidentitas'))->first();

        if ($checkbiodata) {
            Alert::warning('Data sudah ada');
            return redirect()->route('home');
        }

        $this->detailRepository->store($request);

        return redirect()->route('home');
    }

    public function show()
    {
        $biodata = $this->detailRepository->show(Auth::user()->id);
        $type = $this->typeRepository->getSelect();
        $unit = $this->unitRepository->getSelect();

        $data = [
            'biodata' => $biodata,
            'type' => $type,
            'unit' => $unit,
        ];

        return view('showbiodata', $data);
    }

    public function update(Request $request)
    {
        $data = $this->detailRepository->update($request, Auth::user()->role);

        return redirect()->route('home');
    }
}
