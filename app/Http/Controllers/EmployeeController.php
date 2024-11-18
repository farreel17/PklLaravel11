<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EmployeeController extends Controller
{
    public function index(Request $request){
        

        if($request->has('search')){
            $data = Employee::where('nama','LIKE','%'.$request->search.'%',)->paginate(5);
            session::put('halaman_url', request()->fullUrl());
        }else{
            $data = Employee::paginate(5);
            session::put('halaman_url', request()->fullUrl());
        }

        
        return view ('data', compact('data'));
    }

    public function tambahpegawai(){
        return view('tambahdata');
    }

    public function insertdata(Request $request){
        //dd($request->all());
//         $validated = $request->validate([
//             'nama' => 'required|min:7|max:25',
//             'notelepon' => 'required|min:11|max:12',
//         ]);

        $data = Employee::create($request->all());
        if($request->hasfile('foto')){
            $request->file('foto')->move('fotopegawai/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('pegawai')->with('success','Data Berhasil Ditambahkan!!');
    }

    //tambah data & hapus data
    public function tambahdata($id){

        $data = Employee::find($id);
        //dd($data);

        return view('tampildata', compact('data'));
    }
// Edit Data
    public function updatedata(Request $request, $id){
        $data = Employee::find($id);
        $data->update($request->all());
        if(session('halaman_url')){
            return redirect(session('halaman_url'))->with('success','Data Berhasil Di Update!!');
        }
        
        return redirect()->route('pegawai')->with('success','Data Berhasil Di Update!!');
    }
// Delete Data
    public function delete($id){
        $data = Employee::find($id);
        $data->delete();
        return redirect()->route('pegawai')->with('success','Data Berhasil Di Hapus!!');
    }



    public function page(){
        return view('adminpage');
    }


    public function viewpegawai(Request $request){
        

        if($request->has('search')){
            $data = Employee::where('nama','LIKE','%'.$request->search.'%',)->paginate(5);
            session::put('halaman_url', request()->fullUrl());
        }else{
            $data = Employee::paginate(5);
            session::put('halaman_url', request()->fullUrl());
        }

        
        return view ('viewpegawai', compact('data'));
    }




    // public function viewpegawai(){
    //     $data = Employee::paginate(10);
    //     return view('viewpegawai', compact('data'));
    // }
}
