<?php

namespace App\Repositories;

use GuzzleHttp\Client as GuzzleHttpClient;

class AuthRepository
{
    public function sso($request, $email, $session_id)
    {
        // Get Token
        try {
            $clientauthscsso = new GuzzleHttpClient();
            $apiRequestauthscsso = $clientauthscsso->request('GET', 'https://sso.unesa.ac.id/check-secret-token/'.$session_id);
            $cektoken = json_decode($apiRequestauthscsso->getBody()->getContents());
        } catch (\Exception $apiRequestauthscsso) {
            // dd('Gagal Masuk Tahap 1');
            $error = 'Token Tidak Ditemukan';
            return $error;
        }

        // Check Validation Token
        try {
            $clientauthtknsso = new GuzzleHttpClient();
            $apiRequestauthtknsso = $clientauthtknsso->request('GET', 'https://sso.unesa.ac.id/check-token/'.$cektoken);
            $checkakses = json_decode($apiRequestauthtknsso->getBody()->getContents());
        } catch (\Exception $apiRequestauthtknsso) {
            // dd('Gagal Masuk Tahap 2');
            $error = 'Token Tidak Valid';
            return $error;
        }

        // Get Account
        try {
            $clientbiodata = new GuzzleHttpClient();
            $apiRequestbiodata = $clientbiodata->request('GET', 'https://sso.unesa.ac.id/userid/'.$checkakses->email);
            $aksessso = json_decode($apiRequestbiodata->getBody()->getContents());
        } catch (\Exception $apiRequestbiodata) {
            $gagal_login = "Data Tidak Ditemukan";
            return $error;
        }

        $success = $aksessso;

        return $success;
    }

    public function getAccount($nim)
    {
        $url = "https://siakadu.unesa.ac.id/api/apiunggun";
        $data = array('username'=>$nim, 'kondisi'=>"cekhakakses");
        $x= kirim_data($url, 'post', $data);
        $user = unserialize($x['isi']);

        return $user;
    }
}
