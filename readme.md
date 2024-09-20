# Whisper
Whisper é um modelo de IA para transcrição de fala, capaz de transcrever audios para texto criado pela OpenAi e 
disponibilizado para o público totalmente open source.
# Groq.
Groq, Inc. é uma empresa americana que desenvolve chips de IA (LPUs - Language Processing Units) capaz de 
processamento/inferência em altíssima velocidade. LPUs da Groq são diferentes das GPUs Nvidia.
# Quanto custa
Tanto a transcrição de áudio com o modelo Whisper quanto outros modelos open source de IA como Llama, Gemma e outros 
possui camada grátis na Groq.
# Onde Pegar API Key?
Aqui: https://console.groq.com/keys
# Como transcrever áudio com Groq/Whisper?
Confira o exemplo de como isso pode ser feito com PHP utilizando o código desse repositório.
```php
<?php
require_once __DIR__."/config.php";
require_once __DIR__."/vendor/autoload.php";
$WhisperGroq = new \App\WhisperGroq();

$filePath = __DIR__."/audio.ogg";
$response = $WhisperGroq->transcription($filePath, 'pt','','verbose_json');
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
```

# Informações
**File Size:** O tamanho máximo do arquivo deve ser 25MB

**Chunks:** Se você tiver arquivo maiores será necessário quebrar em partes.

**Format:** São aceito arquivos nos formatos: mp3, mp4, mpeg, mpga, m4a, wav, e webm

**Tip:** Para reduzir o tamanho do arquivo você pode usar alguma ferramenta como FFmpeg, veja duas possibilidades nos exemplos abaixo:

```shell
ffmpeg -i audios/agi.mp4 -vn -map_metadata -1 -ac 1 -c:a libopus -b:a 12k -application voip audio.ogg
```

```shell
ffmpeg -i  agi.mp4  -ar 16000  -ac 1  -map 0:a: output.mp3
```


[Exemplo retirado daqui](https://community.openai.com/t/whisper-api-increase-file-limit-25-mb/566754#post_2)

[Exemplo Groq](https://console.groq.com/docs/speech-text#preprocessing-audio-files)

