<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class DataController extends Controller
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

        // $data = Tim::with('pemain:id_tim,nama_pemain')->get();
        $data = Data::with(['jadwal','pencetak_gol_terbanyak'])->get();
        return response()->json(
            [
                'success' => true,
                'messaage' => 'Data Report Berhasil Ditampilkan',
                'data' => $data
            ],
            200
        );
    }

    public function store(Request $request)
    {
        $validasiData = Validator::make($request->all(), [
            'id_jadwal' => 'required',
            'id_info_tim' => 'required',
            'skor_akhir' => 'required',
            'status_akhir' => 'required',
            'total_win_home' => 'required',
            'total_win_away' => 'required'
        ]);

        if ($validasiData->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Data Report Gagal Ditambahkan',
                    'data' => $validasiData->errors()
                ],
                401
            );
        } else {
            $data = Data::create($request->all());
            if ($data) {
                return response()->json(
                    [
                        'success' => true,
                        'message' => 'Data Report Berhasil Ditambahkan',
                        'data' => $data
                    ],
                    201
                );
            } else {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Data Report Gagal Disimpan',
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
            'skor_akhir' => 'required',
            'status_akhir' => 'required',
            'total_win_home' => 'required',
            'total_win_away' => 'required'

        ]);

        if ($validasiData->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Data Report Gagal Diubah',
                    'data' => $validasiData->errors()
                ],
                401
            );
        } else {
            $data = Data::whereId($id)->update([
                'id_jadwal' => $request->input('id_jadwal'),
                'id_info_tim' => $request->input('id_info_tim'),
                'skor_akhir' => $request->input('skor_akhir'),
                'status_akhir' => $request->input('status_akhir'),
                'total_win_home' => $request->input('total_win_home'),
                'total_win_away' => $request->input('total_win_away'),

            ]);

            $data = Data::find($id);

            if ($data) {
                return response()->json(
                    [
                        'success' => true,
                        'message' => 'Data Report Berhasil Diubah',
                        'data' => $data
                    ],
                    201
                );
            } else {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Data Report Gagal Diubah',
                    ],
                    401
                );
            }
        }
    }

    public function destroy($id)
    {
        $data = Data::whereId($id)->first();
        $data->delete();

        $t = Data::find($id);
        if ($data) {
            return response()->json([
                'success' => true,
                'message' => 'Data Report Berhasil Dihapus!',
                'data' => $t

            ], 200);
        }
    }
}
