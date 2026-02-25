<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\FinalForm;

class FinalFormPdfMail extends Mailable
{
    use Queueable, SerializesModels;

    public $finalForm;

    public function __construct(FinalForm $finalForm)
    {
        $this->finalForm = $finalForm;
    }

    public function build()
    {
        $application = FinalForm::where('id', $this->finalForm->id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $user = auth()->user();

        // Generate PDF
        $pdf = Pdf::loadView('user.finalDocument.preview', compact('application', 'user'))
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'dpi' => 96,
                'defaultFont' => 'sans-serif',
            ]);

        // Generate filename
        $filename = 'CLC_Form_' . $application->registration_no . '_' . date('Y-m-d') . '.pdf';

        return $this->subject('🎉 Your Christ Land City Registration Form')
            ->from('no-reply@christlandcity.com', 'Christ Land City')
            ->cc('support@christlandcity.com')
            ->markdown('emails.final_form_pdf')
            ->attachData($pdf->output(), $filename, [
                'mime' => 'application/pdf',
            ]);
    }
}
