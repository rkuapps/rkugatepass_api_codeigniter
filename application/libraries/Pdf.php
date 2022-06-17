<?php defined('BASEPATH') or exit('No direct script access allowed');

require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;

class Pdf
{

        public function create($html, $filename)
        {

                $dompdf = new Dompdf();
                $options = $dompdf->getOptions();
                $options->setIsRemoteEnabled(true);
                $dompdf->setOptions($options);
                $dompdf->loadHtml($html);
                $dompdf->setPaper('A4', 'portrait');
                $dompdf->render();
                $dompdf->stream($filename);
                $output = $dompdf->output();
                file_put_contents('./uploads/' . $filename . '.pdf', $output);
        }
}
