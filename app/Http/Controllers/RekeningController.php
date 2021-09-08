<?php

namespace App\Http\Controllers;

use App\Models\Rekening;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RekeningController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = Rekening::query();

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <a class="inline-block border border-gray-700 bg-gray-700 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-gray-800 focus:outline-none focus:shadow-outline" 
                            href="' . route('dashboard.rekening.edit', $item->id) . '">
                            Edit
                        </a>
                        <form class="inline-block" action="' . route('dashboard.rekening.destroy', $item->id) . '" method="POST">
                        <button class="border border-red-500 bg-red-500 text-white rounded-md px-2 py-1 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                            Hapus
                        </button>
                            ' . method_field('delete') . csrf_field() . '
                        </form>';
                })
                ->addIndexColumn()
                ->removeColumn('id')
                ->rawColumns(['action'])
                ->make();
        }

        return view('pages.dashboard.rekening.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_bank' => 'required',
            'atas_nama' => 'required',
            'nomor_rekening' => 'required',
        ]);

        Rekening::create($request->all());
        return redirect()->route('dashboard.rekening.index')
                         ->with('success','Rekening Berhasil ditambahkan.');
    }

    public function create()
    {
        return view('pages.dashboard.rekening.create');
    }

    public function edit(Rekening $rekening)
    {
        return view('pages.dashboard.rekening.edit',[
            'item' => $rekening
        ]);

        return view('pages.dashboard.rekening.edit');
    }

    public function update(Request $request, Rekening $rekening)
    {
        $request->validate([
            'nama_bank' => 'required',
            'atas_nama' => 'required',
            'nomor_rekening' => 'required',
        ]);

        $rekening->update($request->all());

        return redirect()->route('dashboard.rekening.index')
                         ->with('success','Rekening Berhasil diperbaharui.');
    }

    public function destroy(Rekening $rekening)
    {
        $rekening->delete();

        return redirect()->route('dashboard.rekening.index');
    }
}
