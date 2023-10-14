<?
  class Logger {

    private $fileStream;

    function __construct() {
      require_once 'C:\ospanel\domains\laba11.com\config.php';

      $this->fileStream = fopen($LOGGER_OUTPUT_FILENAME, 'a');
    }

    function __destruct() {
      fclose($this->fileStream);
    }
    public function info($text) {
      fwrite($this->fileStream, $this->constructText('INFO', $text));
    }

    private function constructText($type, $text) {
      $date = new DateTime();
      $dateString = $date->format('Y-m-d H:i:s');

      return '[' . $dateString . ']' . ' | ' . $type . ' | ' . $text . "\n";
    }
  }
?>