<?php

return [
    'GET' => [
        '/' => ['controller' => 'MahasiswaController', 'action' => 'index'],

        '/mahasiswa'            => ['controller' => 'MahasiswaController', 'action' => 'index'],
        '/mahasiswa/create'     => ['controller' => 'MahasiswaController', 'action' => 'create'],
        '/mahasiswa/{id}/edit'  => ['controller' => 'MahasiswaController', 'action' => 'edit'],

        '/prodi'            => ['controller' => 'ProdiController', 'action' => 'index'],
        '/prodi/create'     => ['controller' => 'ProdiController', 'action' => 'create'],
        '/prodi/{id}/edit'  => ['controller' => 'ProdiController', 'action' => 'edit'],

        '/matakuliah'            => ['controller' => 'MatakuliahController', 'action' => 'index'],
        '/matakuliah/create'     => ['controller' => 'MatakuliahController', 'action' => 'create'],
        '/matakuliah/{id}/edit'  => ['controller' => 'MatakuliahController', 'action' => 'edit'],
    ],
    'POST' => [
        '/mahasiswa/store'        => ['controller' => 'MahasiswaController', 'action' => 'store'],
        '/mahasiswa/{id}/update'  => ['controller' => 'MahasiswaController', 'action' => 'update'],
        '/mahasiswa/{id}/delete'  => ['controller' => 'MahasiswaController', 'action' => 'destroy'],

        '/prodi/store'        => ['controller' => 'ProdiController', 'action' => 'store'],
        '/prodi/{id}/update'  => ['controller' => 'ProdiController', 'action' => 'update'],
        '/prodi/{id}/delete'  => ['controller' => 'ProdiController', 'action' => 'destroy'],

        '/matakuliah/store'        => ['controller' => 'MatakuliahController', 'action' => 'store'],
        '/matakuliah/{id}/update'  => ['controller' => 'MatakuliahController', 'action' => 'update'],
        '/matakuliah/{id}/delete'  => ['controller' => 'MatakuliahController', 'action' => 'destroy'],
    ],
];