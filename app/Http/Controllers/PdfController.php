<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Info; // เปลี่ยนเป็นชื่อโมเดลของคุณ
use PhpOffice\PhpWord\IOFactory;
use Dompdf\Dompdf;
use Dompdf\Options;

class PdfController extends Controller
{
    public function generatePdf($id)
    {
        // ดึงข้อมูลจากฐานข้อมูลตาม ID
        $info = Info::findOrFail($id);

        // เตรียมข้อมูลสำหรับการกรอกลงในเอกสาร Word
        $data = [
            'methode_name' => $info->methode_name,
            'reason_description' => $info->reason_description,
            'office_name' => $info->office_name,
            'attachdorder' => $info->attachdorder,
            'devilvery_time' => $info->devilvery_time,
            // เพิ่มข้อมูลที่ต้องการกรอกลงในเอกสาร Word ตามต้องการ
        ];

        // เส้นทางของไฟล์ Word Template
        $templatePath = storage_path('app/public/pcm.docx');
        $filledDocumentPath = $this->fillWordTemplate($templatePath, $data);

        // แปลงไฟล์ Word เป็น PDF
        $pdfPath = $this->convertWordToPdf($filledDocumentPath);

        // ส่ง PDF เป็นการตอบกลับ (download) ให้ผู้ใช้
        return response()->download($pdfPath);
    }

    private function fillWordTemplate($templatePath, $data)
    {
        // โหลดไฟล์ Word Template
        $phpWord = IOFactory::load($templatePath);
        $section = $phpWord->getSection(0);

        // กรอกข้อมูลลงใน template
        foreach ($data as $placeholder => $value) {
            $section->replaceText('${' . $placeholder . '}', $value);
        }

        // บันทึกเอกสารที่กรอกข้อมูลแล้ว
        $outputPath = storage_path('app/public/filled-pcm.docx');
        $writer = IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save($outputPath);

        return $outputPath;
    }

    private function convertWordToPdf($wordPath)
    {
        // โหลดไฟล์ Word
        $phpWord = IOFactory::load($wordPath);
        $tempHtmlPath = storage_path('app/public/temp-document.html');

        // แปลง Word เป็น HTML
        $htmlWriter = IOFactory::createWriter($phpWord, 'HTML');
        $htmlWriter->save($tempHtmlPath);

        // แปลง HTML เป็น PDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml(file_get_contents($tempHtmlPath));
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // บันทึก PDF
        $pdfPath = storage_path('app/public/filled-pcm.pdf');
        file_put_contents($pdfPath, $dompdf->output());

        // ลบไฟล์ HTML ชั่วคราว
        unlink($tempHtmlPath);

        return $pdfPath;
    }
}
