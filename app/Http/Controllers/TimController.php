<?php

namespace App\Http\Controllers;

use App\Models\Tim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class TimController extends Controller
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
        $tim = Tim::with('pemain')->get();
        return response()->json(
            [
                'success' => true,
                'messaage' => 'Data Tim Berhasil Ditampilkan',
                'data' => $tim
            ],
            200
        );
    }

    public function store(Request $request)
    {
        $validasiData = Validator::make($request->all(), [
            'nama_tim' => 'required',
            'logo_tim' => 'required',
            'tahun_berdiri' => 'required',
            'alamat_markas' => 'required',
            'kota_markas' => 'required',
        ]);

        if ($validasiData->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Data Tim Gagal Ditambahkan',
                    'data' => $validasiData->errors()
                ],
                401
            );
        } else {
            $tim = Tim::create($request->all());
            if ($tim) {
                return response()->json(
                    [
                        'success' => true,
                        'message' => 'Data Tim Berhasil Ditambahkan',
                        'data' => $tim
                    ],
                    201
                );
            } else {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Data Tim Gagal Disimpan',
                    ],
                    401
                );
            }
        }
    }

    public function update(Request $request, $id)
    {
        $validasiData = Validator::make($request->all(), [
            'nama_tim' => 'required',
            'logo_tim' => 'required',
            'tahun_berdiri' => 'required',
            'alamat_markas' => 'required',
            'kota_markas' => 'required',

        ]);

        if ($validasiData->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Data Tim Gagal Diubah',
                    'data' => $validasiData->errors()
                ],
                401
            );
        } else {
            $tim = Tim::whereId($id)->update([
                'nama_tim' => $request->input('nama_tim'),
                'logo_tim' => $request->input('logo_tim'),
                'tahun_berdiri' => $request->input('tahun_berdiri'),
                'alamat_markas' => $request->input('alamat_markas'),
                'kota_markas' => $request->input('kota_markas'),

            ]);

            $tim = Tim::find($id);

            if ($tim) {
                return response()->json(
                    [
                        'success' => true,
                        'message' => 'Data Tim Berhasil Diubah',
                        'data' => $tim
                    ],
                    201
                );
            } else {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Data Tim Gagal Diubah',
                    ],
                    401
                );
            }
        }
    }

    public function destroy($id)
    {
        $tim = Tim::whereId($id)->first();
        $tim->delete();

        $t = Tim::find($id);
        if ($tim) {
            return response()->json([
                'success' => true,
                'message' => 'Data Tim Berhasil Dihapus!',
                'data' => $t

            ], 200);
        }
    }


}
