<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Models\TransactionItem;

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
    public function create(Transaction $transaction)
    {
        //
    }

    public function transaction(Transaction $transaction)
    {
        return view('pages.dashboard.transaction.create', compact('transaction'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Transaction $request, Transaction $myTransaction)
    {
        $query = Transaction::with(['user'])->where('users_id', Auth::user()->id);

        $files = $request->file('files');

        if($request->hasFile('files'))
        {
            foreach ($files as $file) {
                $path = $file->store('public/transfer');

                TransactionItem::create([
                    'products_id' => $myTransaction->id,
                    'url' => $path
                ]);
            }
        }

        return redirect()->route('dashboard.product.gallery.index', $myTransaction->id);
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
    public function update(Request $request, $id)
    {
        //
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
