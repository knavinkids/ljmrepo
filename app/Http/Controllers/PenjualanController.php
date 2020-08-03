<?php

namespace App\Http\Controllers;
use DB;
use App\Penjualan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
	public function index()
	{
		$data=Penjualan::where('idpegawai', '373')->orderBy('tanggal', 'desc')->paginate(10);
		return view('penjualan.index',compact('data'));
	}
	public function fetch_data(Request $request){
		if($request->ajax()){
			$sort_by = $request->get('sortby');
			$sort_type = $request->get('sorttype');
			$query = $request->get('query');
			$query = str_replace("","%",$query);
			$perpage = $request->get('perpage');

			$data = Penjualan::where('idpegawai', '373');
			$data = $data->Where('customer', 'like', '%'.$query.'%')->orWhere('nobukti','like', '%'.$query.'%')
				->orderBy($sort_by, $sort_type)
				->paginate($perpage);

			return view('penjualan.data', compact('data'))->render();
		}

	}
	
	function create()
	{
		//
	}

	public function store(Request $request)
	{
		//
	}
	public function show(Penjualan $penjualan)
	{
		//
	}

	public function edit(Penjualan $penjualan)
	{
		//
	}

	public function update(Request $request, Penjualan $penjualan)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Penjualan  $penjualan
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Penjualan $penjualan)
	{
		//
	}
}
