<?php

class Logger{
    // declare log file and file pointer as private properties
    private $log_file = "mylog.txt";
    private $fp;
    // set log file (path and name)
    public function __construct($mensagem=null) {
        if(!is_null($mensagem)){
            $this->escrever($mensagem,true);
            }
    }

    // write message to the log file
    public function escrever($mensagem,$fechar=false) {
        try {
            // if file pointer doesn't exist, then open log file
            if (!is_resource($this->fp)) {
                $this->lopen();
            }
            // define script name
            $script_name = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
            // define current time and suppress E_WARNING if using the system TZ settings
            // (don't forget to set the INI setting date.timezone)
            $time = @date('[d/M/Y:H:i:s]');
            // write current time, script name and message to the log file
            fwrite($this->fp, "$time ($script_name) $mensagem" . PHP_EOL);
            if($fechar) {
                $this->fechar();
            }
            
            
            
        } catch (Exception $ex) {
            
        }
    }
    // close log file (it's always a good idea to close a file when you're done with it)
    public function fechar() {
        fclose($this->fp);
    }
    // open log file (private method)
    private function lopen() {
        // in case of Windows set default log file
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $log_file_default = 'c:/php/logfile.txt';
        }
        // set default log file for Linux and other systems
        else {
            $log_file_default = '/tmp/logfile.txt';
        }
        // define log file from lfile method or use previously set default
        $lfile = $this->log_file ? $this->log_file : $log_file_default;
        // open log file for writing only and place file pointer at the end of the file
        // (if the file does not exist, try to create it)
        $this->fp = fopen($lfile, 'a') or exit("Can't open $lfile!");
    }
}