<?php

// Set the time zone
date_default_timezone_set('PRC');

// Add your OpenAI API Key below 
$chat = new ChatGPT([
    'api_key' => 'API_GOES_HERE',	
]);

/*
The following long lines of comments are generated by GPT4
*/

// This line of code is used to close the output buffer. After closing, the output of the script will be sent to the browser immediately, instead of waiting for the buffer to fill up or for the script to finish executing.
ini_set('output_buffering', 'off');

// This line of code disables zlib compression. Normally, enabling zlib compression would reduce the amount of data sent to the browser, but for the server to send events, real-time is more important, so compression needs to be disabled.
ini_set('zlib.output_compression', false);

// This line of code uses a loop to empty all currently active output buffers. ob_end_flush() function flushes and closes the innermost output buffer, and the @ symbol is used to suppress any errors or warnings that may occur.
while (@ob_end_flush()) {}

// This line of code sets the Content-Type of the HTTP response to text/event-stream, which is the MIME type of the server sending event (SSE).
header('Content-Type: text/event-stream');

// This line of code sets the Cache-Control of the HTTP response to no-cache, telling the browser not to cache this response.
header('Cache-Control: no-cache');

// This line of code sets the Connection of the HTTP response to keep-alive, maintaining a long connection so that the server can continue to send events to the client.
header('Connection: keep-alive');

// This line of code sets the custom header X-Accel-Buffering for HTTP responses to no, which is used to disable buffering for certain proxies or web servers (such as Nginx).
// This helps ensure that server-sent events are not buffered during transmission.
header('X-Accel-Buffering: no');


// Introduce a sensitive word detection class, which is generated by GPT4
require './class/Class.DFA.php';

// Introduce a stream processing class that generates most of the code from GPT4
require './class/Class.StreamHandler.php';

// Introduce calls to the OpenAI interface class, which generates most of the code from GPT4
require './class/Class.ChatGPT.php';


echo 'data: '.json_encode(['time'=>date('Y-m-d H:i:s'), 'content'=>'']).PHP_EOL.PHP_EOL;
flush();

// Get the question from get
$question = urldecode($_GET['q'] ?? '');
if(empty($question)) {
    echo "event: close".PHP_EOL;
    echo "data: Connection closed".PHP_EOL.PHP_EOL;
    flush();
    exit();
}
$question = str_ireplace('{[$add$]}', '+', $question);

// Get the model from get
$model = ($_GET['model']);

// Add your OpenAI API Key below  
$chat = new ChatGPT([
    'api_key' => 'sk-proj-osWMron4D67PuU1PBtD4T3BlbkFJ4MtzxcfS2CzIcHGfBz5w',	
]);


/*-----------------
// If the following three lines are commented out, sensitive word detection will not be enabled
// Special attention, here purposely use garbled string file name is to prevent others from downloading sensitive word files, please deploy and change a different garbled file name yourself
$dfa = new DFA([
    'words_file' => './sensitive_words_sdfdsfvdfs5v56v5dfvdf.txt',
]);
$chat->set_dfa($dfa);
-------------------*/

// Start asking questions
$chat->qa([
	'system' => 'You are a bot that gives short notes on the topic entered.',
	'question' => $question,
	'model' => $model,
]);
