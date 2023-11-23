<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class CertificadoOrigen extends Mailable
{
    use Queueable, SerializesModels;
    public $path_save;
    public $numero_certificado;

    public function __construct($path_save, $numero_certificado)
    {
        $this->path_save = $path_save;
        $this->numero_certificado = $numero_certificado;
    }

    public function build()
    {
        $pdfContent = Storage::get($this->path_save);

        return $this->view('mina.empresa.viaje.mailCertificadoOrigen', ['numero_certificado' => $this->numero_certificado])
        ->attachData($pdfContent, "certificado_origen_$this->numero_certificado.pdf", [
            'mime' => 'application/pdf'
        ]);
    }
}