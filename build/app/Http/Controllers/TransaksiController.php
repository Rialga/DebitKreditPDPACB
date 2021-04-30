<?php

namespace App\Http\Controllers;

use App\Saldo;
use Illuminate\Http\Request;
use App\Transaksi;


class TransaksiController extends Controller
{
    public function index(){

        $data =Transaksi::latest()->get();
        $saldo =Saldo::all();


        return view('transaksi')->with(['data'=>$data, 'saldo'=>$saldo]);

    }

    public function add(){
        $data = Saldo::all();

        return view('addForm')->with(['data'=>$data]);
    }

    public function create(Request $request){



        $nasabah = Saldo::where('id', $request->idSaldo)->first();
        $transaksi = new Transaksi();


        $idSaldo = $request->idSaldo;
        $nominal = $request->nominal;
        $jenis = $request->jenis;


        if($request->jenis == 2){
            if($request->nominal > $nasabah->saldo){
                return redirect()->back();
            }
            else{

                $saldoUpdate = $nasabah->saldo - $request->nominal;
                return $this->transaksi($idSaldo , $nominal, $jenis, $saldoUpdate);
            }
        }
        else{

            $saldoUpdate = $nasabah->saldo + $request->nominal;
            return $this->transaksi($idSaldo , $nominal, $jenis, $saldoUpdate);

        }



    }

    public function transaksi($idSaldo , $nominal, $jenis, $saldoUpdate){
        $nasabah = Saldo::where('id', $idSaldo)->first();
        $transaksi = new Transaksi();
        $transaksi->id_saldo = $idSaldo;
        $transaksi->nominal = $nominal;
        $transaksi->jenis = $jenis;
        $transaksi->save();

        $nasabah->saldo = $saldoUpdate;
        $nasabah->update();

        return redirect('transaksi/');
    }

    public function update(Request $request){

        $idTransaksi = $request->id;
        $transaksi = Transaksi::where('id', $idTransaksi)->first();



        $idSaldoNew = $request->idSaldo;
        $nominalNew = $request->nominal;
        $jenisNew = $request->jenis;

        $idSaldoOld = $transaksi->id_saldo;
        $nominalOld = $transaksi->nominal;
        $jenisOld = $transaksi->jenis;


        $nasabah = Saldo::where('id',$idSaldoOld)->first();
        $nasabahBaru = Saldo::where('id',$idSaldoNew)->first();


        // Debet
        if($jenisNew == 1){
            // Id sama
            if($idSaldoOld == $idSaldoNew){

                // Sama Debit
                if($jenisNew == $jenisOld){
                    $saldoAwal = $nasabah->saldo - $nominalOld;

                    if($saldoAwal < 0){
                        return redirect()->back();
                    }
                }
                //Kredit
                else{
                    $saldoAwal = $nasabah->saldo + $nominalOld;
                }

                $saldoNew = $saldoAwal + $nominalNew;
            }
            else{

                // sama debit
                if($jenisNew == $jenisOld){
                    $nasabah->saldo = $nasabah->saldo - $nominalOld;

                    if($nasabah->saldo - $nominalOld < 0){
                        return redirect()->back();
                    }
                }
                //kredit
                else{
                    $nasabah->saldo = $nasabah->saldo + $nominalOld;
                }

                $nasabah->update();

                $saldoNew = $nasabahBaru->saldo + $nominalNew;
            }
        }
        // Kredet
        else{

            if($idSaldoOld == $idSaldoNew){

                // sama kredet
                if($jenisNew == $jenisOld){
                    $saldoAwal = $nasabah->saldo + $nominalOld;
                }
                // debet
                else{
                    $saldoAwal = $nasabah->saldo - $nominalOld;
                }

                $saldoNew = $saldoAwal - $nominalNew;

                if($saldoAwal < 0 || $saldoNew < 0){
                    return redirect()->back();
                }
            }
            else{
                // sama kredet
                if($jenisNew == $jenisOld){
                    $nasabah->saldo = $nasabah->saldo + $nominalOld;
                }

                // debet
                else{
                    $nasabah->saldo = $nasabah->saldo - $nominalOld;
                }

                $saldoNew = $nasabahBaru->saldo - $nominalNew;


                if($nasabah->saldo - $nominalOld < 0 || $saldoNew < 0){
                    return redirect()->back();
                }
                $nasabah->update();

            }
        }

        return $this->editTransaksi($idSaldoNew , $nominalNew, $jenisNew, $saldoNew, $idTransaksi);



    }

    public function editTransaksi ($idSaldoNew , $nominalNew, $jenisNew, $saldoNew, $idTransaksi){


        $nasabah = Saldo::where('id',$idSaldoNew)->first();
        $nasabah->saldo = $saldoNew;
        $nasabah->update();

        $transaksi = Transaksi::where('id', $idTransaksi)->first();
        $transaksi->id_saldo = $idSaldoNew;
        $transaksi->nominal = $nominalNew;
        $transaksi->jenis = $jenisNew;
        $transaksi->update();

        return redirect('transaksi/');
    }

    public function edit($id){
        $data = Transaksi::where('id', $id)->first();
        $datasaldo = Saldo::all();
        return view('editform')->with(['data'=>$data, 'dataSaldo'=>$datasaldo]);

    }

    public function delete($id){
        $transaksi = Transaksi::where('id', $id)->first();
        $saldo = Saldo::where('id' , $transaksi->id_saldo)->first();
        $transaksi->jenis == 1 ? $saldo->saldo = $saldo->saldo - $transaksi->nominal : $saldo->saldo = $saldo->saldo + $transaksi->nominal;
        $saldo->update();
        $transaksi->delete();

        return redirect('transaksi/');

    }
}
