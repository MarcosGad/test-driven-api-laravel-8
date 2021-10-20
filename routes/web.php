<?php

use Illuminate\Support\Facades\Route;
use Google\Client;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/drive', function () {
    $client = new Client();
    $client->setClientId('230444636034-mq1fjjhmb8c5j7c3vp7vrmtjoiag0n6d.apps.googleusercontent.com');
    $client->setClientSecret('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');
    $client->setRedirectUri('http://localhost:8000/google-drive/callback');
    $client->setScopes([
        'https://www.googleapis.com/auth/drive',
        'https://www.googleapis.com/auth/drive.file',
    ]);
    $url = $client->createAuthUrl();
    //return $url;
    return redirect($url);
});


Route::get('/google-drive/callback', function () {
    //return request('code');
    $client = new Client();
    $client->setClientId('230444636034-mq1fjjhmb8c5j7c3vp7vrmtjoiag0n6d.apps.googleusercontent.com');
    $client->setClientSecret('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');
    $client->setRedirectUri('http://localhost:8000/google-drive/callback');
    $code = '';
    $access_token = $client->fetchAccessTokenWithAuthCode($code);
    return $access_token;
});


Route::get('upload', function () {
    $client = new Client();
    $access_token = '';

    $client->setAccessToken($access_token);
    $service = new Google\Service\Drive($client);
    $file = new Google\Service\Drive\DriveFile();

    DEFINE("TESTFILE", 'testfile-small.txt');
    if (!file_exists(TESTFILE)) {
        $fh = fopen(TESTFILE, 'w');
        fseek($fh, 1024 * 1024);
        fwrite($fh, "!", 1);
        fclose($fh);
    }

    $file->setName("Hello World!");
    $service->files->create(
        $file,
        array(
            'data' => file_get_contents(TESTFILE),
            'mimeType' => 'application/octet-stream',
            'uploadType' => 'multipart'
        )
    );
});
