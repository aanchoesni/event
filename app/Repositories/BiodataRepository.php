<?php

namespace App\Repositories;

use GuzzleHttp\Client as GuzzleHttpClient;

class BiodataRepository
{
    public function biodata($auth)
    {
        if ($auth[0]->jenis == 'P') {
            return $this->isdm($auth);
        }

        if ($auth[0]->jenis == 'M') {
            return $this->siakadu($auth);
        }
    }

    public function isdm($auth)
    {
        $client = new GuzzleHttpClient();
        $apiRequest = $client->request('GET', 'https://i-sdm.unesa.ac.id/biodataumum/' . $auth[0]->userid);
        $isdm = json_decode($apiRequest->getBody()->getContents());

        $data['email'] = $auth[0]->email;
        $data['name'] = $isdm[0]->nama;
        $data['noid'] = $isdm[0]->nip;
        if ($isdm[0]->isdosen == 0) {
            $data['role'] = 'tendik';
        } else {
            $data['role'] = 'dosen';
        }
        $data['fakultas'] = $isdm[0]->namahomebase;
        $data['prodi'] = $isdm[0]->namasatker;
        $data['login_type'] = 'sso';

        return $data;
    }

    public function siakadu($auth)
    {
        $userid = $auth[0]->userid;
        $url = "https://siakadu.unesa.ac.id/api/apiunggun";
        $data = array('username' => $userid, 'kondisi' => "cekhakakses");
        $x = kirim_data($url, 'post', $data);
        $user = unserialize($x['isi']);

        $data['email'] = $auth[0]->email;
        $data['name'] = $user['data_mahasiswa']['nm_pd'];
        $data['noid'] = $user['username'];
        $data['role'] = 'mahasiswa';
        $data['fakultas'] = $user['nama_fakultas'];
        $data['prodi'] = $user['nama_prodi'];
        $data['login_type'] = 'sso';

        return $data;
    }
}
