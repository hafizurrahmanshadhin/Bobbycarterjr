<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    {{ $text }}



    <script>
        // Function to speak text with a selected voice
        function speakText(text) {
            var utterance = new SpeechSynthesisUtterance(text);

            // List available voices
            var voices = window.speechSynthesis.getVoices();

            // Select a voice (you can specify based on name or index)
            utterance.voice = voices.find(voice => voice.name === "Google US English"); // Change to desired voice name

            // Optional: Adjust rate and pitch
            utterance.rate = 1; // Normal speed
            utterance.pitch = 5; // Normal pitch

            window.speechSynthesis.speak(utterance);
        }

        // Call the function with your text
        var text = "{{ $text }}";
        speakText(text);
    </script>
</body>

</html>
