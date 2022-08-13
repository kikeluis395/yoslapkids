<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tbl_cancion;
use PhpOffice\PhpPresentation\PhpPresentation;
use PhpOffice\PhpPresentation\IOFactory;
use PhpOffice\PhpPresentation\Slide\Background\Color;
use PhpOffice\PhpPresentation\Style\Alignment;
use PhpOffice\PhpPresentation\Style\Color as StyleColor;
use Illuminate\Http\Request;
use PhpOffice\PhpPresentation\DocumentLayout;

class ExportarCancionesController extends Controller
{
    public function index()
    {
        $canciones = Tbl_cancion::all();
        return view('admin/exportarCanciones', compact('canciones'));
    }

    public function getSongs() {
        $canciones = Tbl_cancion::all();
        foreach ($canciones as $cancion) {
            $cancion->tipo_js = $cancion->tipo->tipo_cancion_nombre;
            $cancion->numero_estrofas = count($cancion->estrofas);
        }
        echo json_encode($canciones);
    }

    public function download(Request $request)
    {
        $objPHPPowerPoint = new PhpPresentation();
        $objPHPPowerPoint->getLayout()->setDocumentLayout(DocumentLayout::LAYOUT_SCREEN_16X10);
        // Create a shape (text)
        $array_canciones = $request->array_songs;
        $array_canciones = json_decode($array_canciones);


        $canciones = [];
        foreach ($array_canciones as $id_cancion) {
            $canciones[] = Tbl_cancion::find($id_cancion);
        }
        // $canciones = Tbl_cancion::whereIn('id_cancion', $array_canciones)->get();

        foreach ($canciones as $key => $cancion) {
            $currentSlide = $objPHPPowerPoint->createSlide();
            $oBkgColor = new Color();
            $oBkgColor->setColor(new StyleColor('FFe7e0c6'));
            $currentSlide->setBackground($oBkgColor);
            $shape = $currentSlide->createRichTextShape()
                ->setHeight(650)
                ->setWidth(900)
                ->setOffsetX(50)
                ->setOffsetY(100);
            $shape->getActiveParagraph()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $textRun = $shape->createTextRun($cancion->cancion_titulo);
            $textRun->getFont()->setBold(true)
                ->setSize(60);
            foreach ($cancion->estrofas as $estrofa) {
                // Create slide
                $currentSlide = $objPHPPowerPoint->createSlide();
                $oBkgColor = new Color();
                $oBkgColor->setColor(new StyleColor('FFe7e0c6'));
                $currentSlide->setBackground($oBkgColor);
                $shape = $currentSlide->createRichTextShape()
                    ->setHeight(650)
                    ->setWidth(900)
                    ->setOffsetX(20)
                    ->setOffsetY(20);
                $shape->getActiveParagraph()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $textRun = $shape->createTextRun($estrofa->estrofa_contenido);
                $textRun->getFont()->setBold(true)
                    ->setSize(55);
            }
        }

        $oWriterPPTX = IOFactory::createWriter($objPHPPowerPoint, 'PowerPoint2007');

        header('Content-Type: application/vnd.ms-powerpoint');
        header('Content-Disposition: attachment;filename="' . 'canciones' . date('Y-m-d H:i:s') . '.pptx"');
        header('Cache-Control: max-age=0');

        $oWriterPPTX->save("php://output");
        // $oWriterODP = IOFactory::createWriter($objPHPPowerPoint, 'ODPresentation');
        // $oWriterODP->save(__DIR__ . "/sample.odp");
    }
}
