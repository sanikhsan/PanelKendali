<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = Supplier::query();

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <a class="inline-block border border-gray-700 bg-gray-700 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-gray-800 focus:outline-none focus:shadow-outline" 
                            href="' . route('dashboard.supplier.edit', $item->id) . '">
                            Edit
                        </a>
                        <form class="inline-block" action="' . route('dashboard.supplier.destroy', $item->id) . '" method="POST">
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

        return view('pages.dashboard.supplier.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_supplier' => 'required',
            'keterangan' => 'required',
        ]);

        Supplier::create($request->all());
        return redirect()->route('dashboard.supplier.index')
                         ->with('success','Rekening Berhasil ditambahkan.');
    }

    public function create()
    {
        return view('pages.dashboard.supplier.create');
    }

    public function edit(Supplier $supplier)
    {
        return view('pages.dashboard.supplier.edit',[
            'item' => $supplier
        ]);

        return view('pages.dashboard.rekening.edit');
    }

    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'nama_supplier' => 'required',
            'keterangan' => 'required',
        ]);

        $supplier->update($request->all());

        return redirect()->route('dashboard.supplier.index')
                         ->with('success','Supplier Berhasil diperbaharui.');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('dashboard.supplier.index');
    }
}
