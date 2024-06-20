<?php

namespace App;

use CURLFile;

/**
 * Speech to Texto usando Whisper via Groq API
 * Arquivo enviado deve ter no máximo 25 MB
 **/
class WhisperGroq
{

    /**
     * Transcreve um arquivo (mp3, mp4, mpeg, mpga, m4a, wav, e webm) para texto
     * @param string $filePath Caminho para o arquivo a ser transcrito
     * @param string $language (opcional) Especifica o idioma para transcrição (ISO 639-1) (ex: "en" para English, pt para Portuguese).
     * @param string $prompt (opcional) Forneça contexto para palavras desconhecidas
     * @param string $responseFormat (opcional) Formato da resposta (json (default), verbose_json (para obter timestamps), text (texto puro))
     * @return string|false Retorna resposta em JSON ou false em caso de erro
     **/
    public function transcription(string $filePath, string $language = '', string $prompt = '', string $responseFormat = ''): string|false
    {
        if (!is_file($filePath)) {
            return '';
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, GROQ_STT_ENDPOINT);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: bearer ' . GROQ_API_KEY
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        $postFields = [
            'file' => new CURLFile($filePath),
            'model' => GROQ_STT_MODEL
        ];
        if ($prompt) {
            $postFields['prompt'] = $prompt;
        }
        if ($language) {
            $postFields['language'] = $language;
        }
        if ($responseFormat) {
            $responseFormat = strtolower($responseFormat);
            $postFields['response_format'] = $responseFormat;
        }
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

}