<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Rekening;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\DB;

class MyTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax())
        {
            $query = Transaction::with(['user'])->where('users_id', Auth::user()->id);

            return DataTables::of($query)
                ->addcolumn('action', function($item){
                    return '

                    <a href="'. route('dashboard.transaction', $item->id) .'" class="bg-blue-500 text-white rounded-md px-2 py-1 m-2">
                            Bayar
                    </a>
                    
                    <a href="'. route('dashboard.my-transaction.show', $item->id) .'" class="bg-blue-500 text-white rounded-md px-2 py-1 m-2">
                            Show
                    </a>
                    ';
                })
                ->editColumn('total_price', function($item){
                    return number_format($item->total_price);
                })
                ->addIndexColumn()
                ->removeColumn('id')
                ->rawColumns(['action'])
                ->make();
        }

        return view('pages.dashboard.transaction.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Transaction $request)
    {
        //
    }

    public function transaction($id)
    {
        $rekening = Rekening::get();
        return view('pages.dashboard.transaction.create', compact('id', 'rekening'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $myTransaction)
    {
        if(request()->ajax())
        {
            $query = TransactionItem::with(['product'])->where('transactions_id', $myTransaction->id);

            return DataTables::of($query)
                ->editColumn('product.price', function($item){
                    return number_format($item->product->price);
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('pages.dashboard.transaction.show', [
            'transaction' => $myTransaction
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $imagee = $request->file('bukti_transaksi');
        $keterangan = $request->keterangan;
        if ($request->hasFile('bukti_transaksi')) {
            $destinationPath = 'storage/bukti'; // upload path
            $nama_image = date('YmdHis') . "." . $imagee->getClientOriginalExtension();
            $imagee->move($destinationPath, $nama_image);
            $update['bukti_transaksi'] = "$nama_image";
        }
        DB::table('transactions')->where('id', $request->id_trans)->update(['path' => $nama_image, 'keterangan' => $keterangan]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
