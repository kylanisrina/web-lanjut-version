<?php

namespace App\Http\Controllers;
use App\Models\Kelas;
use App\Models\UserModel;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public $userModel;
    public $kelasModel;


    public function __construct(){
        $this->userModel = new UserModel();
        $this->kelasModel = new Kelas();
    }

    public function index(){
        $data = [
            'title' => 'List User',
            'users' => $this->userModel->getUser(),
        ];

        return view('list_user', $data);
    }

    public function create(){
        $kelasModel = new Kelas();

        // Mengambil data kelas menggunakan method getKelas
        $kelas = $kelasModel->getKelas();

        $data = [
            'title' => 'Create User',
            'kelas' => $kelas,
        ];

        return view('create_user', $data);
    }

        public function store(Request $request)
        {
        // Validasi input
        $request->validate([
            'nama' => 'required',
            'npm' => 'required',
            'kelas_id' => 'required',
            'foto' =>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi foto
        ],
        [
            'nama.required' => 'Nama perlu diisi.',
            'npm.required' => 'NPM perlu diisi.',
            'kelas_id.required' => 'Kelas perlu dipilih.',
        ]);

        // Proses upload foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $filename, 'public'); // Menyimpan file ke storage

            // Simpan data user ke database
            $this->userModel->create([
                'nama' => $request->input('nama'),
                'npm' => $request->input('npm'),
                'kelas_id' => $request->input('kelas_id'),
                'foto' => $filePath, // Menyimpan nama file ke database
            ]);
        }

        return redirect()->to('/user/list');
    }


    public function show($id) {
        $user = $this->userModel->getUser($id);

        $data = [
            'title' => 'Profile',
            'user' => $user,
        ];
        return view('profile', $data);
    }
}
