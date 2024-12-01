<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

class OsamaController extends Controller {

    public function myTemporaryFunction() {

        echo "Executing myTemporaryFunction\n";

        $reflection = new \ReflectionMethod($this, __FUNCTION__);
        $filePath = $reflection->getFileName();
        $functionName = $reflection->getName();

        $this->callScript($filePath, $functionName);
    }

    private function callScript($filePath, $functionName) {

        $scriptPath = base_path('bash.sh');

        $filePath = escapeshellarg($filePath);
        $functionName = escapeshellarg($functionName);

        $command = "bash $scriptPath $filePath $functionName";

        $output = shell_exec($command);

        echo $output;
    }

}
