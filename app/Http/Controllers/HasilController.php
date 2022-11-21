<?php

namespace App\Http\Controllers;

use App\Models\Hasil;
use App\Models\Jadwal;
use App\Models\Tim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class HasilController extends Controller
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

        // $hasil = Tim::with('pemain:id_tim,nama_pemain')->get();
        $hasil = Hasil::with(['jadwal','pencetak_gol:id,nama_pemain,nomor_punggung'])->get();
        return response()->json(
            [
                'success' => true,
                'messaage' => 'Data Hasil Pertandingan Berhasil Ditampilkan',
                'data' => $hasil
            ],
            200
        );
    }

    public function store(Request $request)
    {
        $validasiData = Validator::make($request->all(), [
            'id_jadwal' => 'required',
            'id_info_tim' => 'required',
            'total_skor' => 'required',
            'waktu_gol' => 'required',
        ]);

        if ($validasiData->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Data Hasil Gagal Ditambahkan',
                    'data' => $validasiData->errors()
                ],
                401
            );
        } else {
            $hasil = Hasil::create($request->all());
            if ($hasil) {
                return response()->json(
                    [
                        'success' => true,
                        'message' => 'Data Hasil Berhasil Ditambahkan',
                        'data' => $hasil
                    ],
                    201
                );
            } else {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Data Hasil Gagal Disimpan',
                    ],
                    401
                );
            }
        }
    }

    public function update(Request $request, $id)
    {
        $validasiData = Validator::make($request->all(), [
            'id_jadwal' => 'required',
            'id_info_tim' => 'required',
            'total_skor' => 'required',
            'waktu_gol' => 'required',

        ]);

        if ($validasiData->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Data Hasil Gagal Diubah',
                    'data' => $validasiData->errors()
                ],
                401
            );
        } else {
            $hasil = Hasil::whereId($id)->update([
                'id_jadwal' => $request->input('id_jadwal'),
                'id_info_tim' => $request->input('id_info_tim'),
                'total_skor' => $request->input('total_skor'),
                'waktu_gol' => $request->input('waktu_gol'),

            ]);

            $hasil = Hasil::find($id);

            if ($hasil) {
                return response()->json(
                    [
                        'success' => true,
                        'message' => 'Data Hasil Berhasil Diubah',
                        'data' => $hasil
                    ],
                    201
                );
            } else {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Data Hasil Gagal Diubah',
                    ],
                    401
                );
            }
        }
    }

    public function destroy($id)
    {
        $hasil = Hasil::whereId($id)->first();
        $hasil->delete();

        $t = Hasil::find($id);
        if ($hasil) {
            return response()->json([
                'success' => true,
                'message' => 'Data Hasil Berhasil Dihapus!',
                'data' => $t

            ], 200);
        }
    }
}
