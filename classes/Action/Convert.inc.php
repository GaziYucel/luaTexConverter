<?php
/**
 * @file plugins/generic/latexConverter/classes/Action/Convert.inc.php
 *
 * Copyright (c) 2023+ TIB Hannover
 * Copyright (c) 2023+ Gazi Yucel
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class Convert
 * @ingroup plugins_generic_latexconverter
 *
 * @brief Action Convert for the Handler
 */

namespace TIBHannover\LatexConverter\Action;

use JSONMessage;
use NotificationManager;
use TIBHannover\LatexConverter\Models\Cleanup;

class Convert
{
    /**
     * @var object LatexConverterPlugin
     */
    protected object $plugin;

    function __construct($plugin, $request, $params)
    {
        $this->plugin = $plugin;
    }

    /**
     * Main entry point
     * @return JSONMessage
     */
    public function execute(): JSONMessage
    {
        return $this->convert();
    }

    /**
     * Converts LaTex file to pdf
     * @return JSONMessage
     */
    private function convert(): JSONMessage
    {
        if (!file_exists($this->workingDirAbsolutePath .'/'.$this->pdfFile)) {
            $this->plugin->logError(file_get_contents($this->workingDirAbsolutePath . '/' . $this->logFile)) ;
        }
        return new JSONMessage(true, ['submissionId' => '51']);
    }
    
    function __destruct()
    {
        if (file_exists($this->workingDirAbsolutePath)) {
            $cleanup = new Cleanup();
            $cleanup->removeDirectoryAndContentsRecursively($this->workingDirAbsolutePath);
        }
    }
}
