<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Tim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class JadwalController extends Controller
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

        // $jadwal = Tim::with('pemain:id_tim,nama_pemain')->get();
        $jadwal = Jadwal::with(['tim_home:id,nama_tim', 'tim_away:id,nama_tim'])->get();
        return response()->json(
            [
                'success' => true,
                'messaage' => 'Data Jadwal Berhasil Ditampilkan',
                'data' => $jadwal
            ],
            200
        );
    }

    public function store(Request $request)
    {
        $validasiData = Validator::make($request->all(), [
            'tanggal_pertandingan' => 'required',
            'waktu_pertandingan' => 'required',
            'id_tim_home' => 'required',
            'id_tim_away' => 'required',
        ]);

        if ($validasiData->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Data Jadwal Gagal Ditambahkan',
                    'data' => $validasiData->errors()
                ],
                401
            );
        } else {
            $jadwal = Jadwal::create($request->all());
            if ($jadwal) {
                return response()->json(
                    [
                        'success' => true,
                        'message' => 'Data Jadwal Berhasil Ditambahkan',
                        'data' => $jadwal
                    ],
                    201
                );
            } else {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Data Jadwal Gagal Disimpan',
                    ],
                    401
                );
            }
        }
    }

    public function update(Request $request, $id)
    {
        $validasiData = Validator::make($request->all(), [
            'tanggal_pertandingan' => 'required',
            'waktu_pertandingan' => 'required',
            'id_tim_home' => 'required',
            'id_tim_away' => 'required',

        ]);

        if ($validasiData->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Data Jadwal Gagal Diubah',
                    'data' => $validasiData->errors()
                ],
                401
            );
        } else {
            $jadwal = Jadwal::whereId($id)->update([
                'tanggal_pertandingan' => $request->input('tanggal_pertandingan'),
                'waktu_pertandingan' => $request->input('waktu_pertandingan'),
                'id_tim_home' => $request->input('id_tim_home'),
                'id_tim_away' => $request->input('id_tim_away')

            ]);

            $jadwal = Jadwal::find($id);

            if ($jadwal) {
                return response()->json(
                    [
                        'success' => true,
                        'message' => 'Data Jadwal Berhasil Diubah',
                        'data' => $jadwal
                    ],
                    201
                );
            } else {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Data Jadwal Gagal Diubah',
                    ],
                    401
                );
            }
        }
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::whereId($id)->first();
        $jadwal->delete();

        $t = Jadwal::find($id);
        if ($jadwal) {
            return response()->json([
                'success' => true,
                'message' => 'Data Jadwal Berhasil Dihapus!',
                'data' => $t

            ], 200);
        }
    }
}
