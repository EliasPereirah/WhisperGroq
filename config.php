<?php
const PRODUCTION = false;
const GROQ_STT_ENDPOINT = 'https://api.groq.com/openai/v1/audio/transcriptions';
const GROQ_API_KEY = ''; // Groq API Key
const GROQ_STT_MODEL = 'whisper-large-v3'; // Modelo

if(!PRODUCTION) {
    ini_set('display_errors', 1);
}