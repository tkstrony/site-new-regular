<?php namespace FlatFilesBooster;

class Logger {

    private $logDir;

    public function __construct($logDir = __DIR__.DIRECTORY_SEPARATOR.'site'.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'logs'.DIRECTORY_SEPARATOR) {
        if (!is_dir($logDir)) {
            mkdir($logDir, 0777, true);
        }
        $this->logDir = $logDir;
    }

    public function save($fileName, $entry, $jsonFormat = true) {
        $filePath = $this->logDir . $fileName . '.txt';

        // Jeśli zapisujemy w formacie JSON
        if ($jsonFormat && is_array($entry)) {
            $entry = json_encode($entry);
        }

        // Dodaj linię z wpisem do pliku
        $logEntry = date("Y-m-d H:i:s") . "\t" . $entry . PHP_EOL;
        file_put_contents($filePath, $logEntry, FILE_APPEND | LOCK_EX);
    }

    public function read($fileName) {
        $filePath = $this->logDir . $fileName . '.txt';
        if (file_exists($filePath)) {
            return file_get_contents($filePath);
        }
        return null;
    }

    public function delete($fileName) {
        $filePath = $this->logDir . $fileName . '.txt';
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    public function listLogs() {
        return glob($this->logDir . '*.txt');
    }
}

// usage
// $logger = new Logger();
// $logFileName = 'visitors-log-' . date('d-m-Y');

// // set JSON
// $visitorData = [
//     'IP'        => '127.0.0.1',
//     'Page'      => '/test-page',
//     'UserAgent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
//     'Timestamp' => date("d-m-Y H:i:s"),
//     'Country'   => 'Localhost'
// ];
// $logger->save($logFileName, $visitorData, true);

// // Read log
// echo $logger->read($logFileName);

// // Remove log
// $logger->delete($logFileName);

// // Show all logs
// print_r($logger->listLogs());
