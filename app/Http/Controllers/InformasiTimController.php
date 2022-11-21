<?php

namespace App\Http\Controllers;

use App\Models\InformasiTim;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class InformasiTimController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {

        $pemain = InformasiTim::all();
        return response()->json(
            [
                'success' => true,
                'messaage' => 'Data Pemain Berhasil Ditampilkan',
                'data' => $pemain
            ],
            200
        );
    }

    
    public function store(Request $request)
    {
        $validasiData = Validator::make($request->all(), [
            'id_tim' => 'required',
            'nama_pemain' => 'required',
            'tinggi_badan' => 'required',
            'berat_badan' => 'required',
            'posisi_pemain' => 'required',
            'nomor_punggung' => 'required|unique:info_tim',
        ]);

        if ($validasiData->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Data Pemain Gagal Ditambahkan',
                    'data' => $validasiData->errors()
                ],
                401
            );
        } else {
            $pemain = InformasiTim::create($request->all());
            if ($pemain) {
                return response()->json(
                    [
                        'success' => true,
                        'message' => 'Data Pemain Berhasil Ditambahkan',
                        'data' => $pemain
                    ],
                    201
                );
            } else {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Data Pemain Gagal Disimpan',
                    ],
                    401
                );
            }
        }
    }

    public function update(Request $request, $id)
    {
        $validasiData = Validator::make($request->all(), [
            'id_tim' => 'required',
            'nama_pemain' => 'required',
            'tinggi_badan' => 'required',
            'berat_badan' => 'required',
            'posisi_pemain' => 'required',
            'nomor_punggung' => 'required|unique:info_tim',

        ]);

        if ($validasiData->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Data Pemain Gagal Diubah',
                    'data' => $validasiData->errors()
                ],
                401
            );
        } else {
            $pemain = InformasiTim::whereId($id)->update([
                'id_tim' => $request->input('id_tim'),
                'nama_pemain' => $request->input('nama_pemain'),
                'tinggi_badan' => $request->input('tinggi_badan'),
                'berat_badan' => $request->input('berat_badan'),
                'posisi_pemain' => $request->input('posisi_pemain'),
                'nomor_punggung' => $request->input('nomor_punggung')

            ]);

            $pemain = InformasiTim::find($id);

            if ($pemain) {
                return response()->json(
                    [
                        'success' => true,
                        'message' => 'Data Pemain Berhasil Diubah',
                        'data' => $pemain
                    ],
                    201
                );
            } else {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Data Pemain Gagal Diubah',
                    ],
                    401
                );
            }
        }
    }

    public function destroy($id)
    {
        $pemain = InformasiTim::whereId($id)->first();
        $pemain->delete();

        $t = InformasiTim::find($id);
        if ($pemain) {
            return response()->json([
                'success' => true,
                'message' => 'Data Pemain Berhasil Dihapus!',
                'data' => $t

            ], 200);
        }
    }
}
