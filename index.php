<?php
require_once __DIR__."/config.php";
require_once __DIR__."/vendor/autoload.php";
$WhisperGroq = new \App\WhisperGroq();

$filePath = __DIR__."/audio.ogg";
$language = ''; // opcional, mas desejável se você sabe o idioma do vídeo
$response_format = 'verbose_json'; // json | verbose_json | text
$prompt = ''; // Mais informações em: https://platform.openai.com/docs/guides/speech-to-text/prompting
$response = $WhisperGroq->transcription($filePath, $language,$prompt, $response_format);
$response = json_decode($response);
$text = $response->text ?? '';
$segments = $response->segments ?? [];
if($text){
    echo "<b>Transcrição</b>:<br> $text";
    echo "<hr> <b>Segments</b><br><pre>";
    print_r($segments);
    echo "</pre>";
}else{
    echo "<b>Erro</b>:<br>";
    print_r($response);
}
