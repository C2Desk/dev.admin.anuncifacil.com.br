<?php

namespace App\Models;

use Dompdf\Dompdf;
use Dompdf\Options;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Publicidade extends Model
{

    use HasFactory;
    protected $table = 'publicidade';

    //Select de publicidade

    public function getPublicidade()
    {
        $pub = DB::table('publicidade')->select('*')->orderBy('id', 'DESC')->paginate(10);
        return $pub;
    }

    //Insert de publicidade

    public function savePub($texto, $tipo, $titulo, $email, $telefone, $link, $foto1, $venc, $status, $valor)
    {
        date_default_timezone_set('America/Sao_Paulo');
        try {
            $sql = "INSERT INTO anuncifacil.publicidade (tipo,data,visitas,destaque,palavra_chave,texto,historico,promocao,titulo, email, hora, telefone, link, foto, vencimento, status, valor) values
            ('" . $tipo . "','" . date("Y-m-d") . "', 0, ' on ', 'Tenis', '" . $texto . "', 'historico', 'on', '" . $titulo . "', '" . $email . "', '" . date("H:i:s") . "', '" . $telefone . "', '" . $link . "', '" . $foto1 . "', '" . $venc . "', '" . $status . "', '" . $valor . "')";

            DB::insert($sql);

            return true;
        } catch (\Throwable $th) {
            throw new Exception("Erro ao inserir os dados do post no banco de dados" . $th);
        }
    }

    //Resgatar informação para a tela de edit

    public function edit($id)
    {
        $publicidade = DB::table('publicidade')->select('*')->where('id', $id)->paginate(10);
        return $publicidade;
    }

    //Update de publicidade

    public function updatePub($id, $tipo, $titulo, $email, $telefone, $link, $foto1, $venc, $status, $valor)
    {

        date_default_timezone_set('America/Sao_Paulo');
        try {
            $sql = "UPDATE anuncifacil.publicidade SET data = '" . date("Y-m-d") . "', visitas = 0, destaque =  'on', palavra_chave = 'Tenis',email = '" . $email . "',  hora = '" . date("H:i:s") . "' , telefone = '" . $telefone . "',titulo = '" . $titulo . "', link = '" . $link . "',foto= '" . $foto1 . "',vencimento = '" . $venc . "',status = '" . $status . "', valor = '" . $valor . "' WHERE id = $id;";

            DB::update($sql);

            return true;
        } catch (\Throwable $th) {
            throw new Exception("Erro ao inserir os dados do post no banco de dados" . $th);
        }
    }


    //Delete da publicidade

    public function destroyPost($id)
    {
        try {
            $sql = "DELETE FROM anuncifacil.publicidade WHERE id = $id";
            DB::delete($sql);
            return true;
        } catch (\Throwable $th) {
            throw new Exception("Erro ao inserir os dados do post no banco de dados" . $th);
        }
    }



    //Extrair a publicidade em formato de pdf

    public function exportPdf()
    {
        //  require_once (asset('assets/vendor/dompdf/autoload.inc.php'));

        require_once 'dompdf/autoload.inc.php';

        $dompdf = new Dompdf();

        // Definimos o nome do arquivo que será exportado
        $arquivo = 'AnunciFacil.pdf';

        // Criamos uma tabela HTML com o formato da planilha
        $html = '<!DOCTYPE html>
        <html lang="pt-br">
            <head>
                <meta charset="utf-8">
                <title>Contato</title>
            <head>
            <body>';

        //Header data
        // $html .= '<h5 style="display:flex; text-align:center;">' . date('d/m/Y H:i') . ' - Anuncifacil</h5>';
        $html .= '<h5 style="display:flex; text-align:center;">' . date('d/m/Y') . ' - Anuncifacil</h5>';

        //Style do PDF
        $html .= '<style>
        *{
            font:400 13px "Calibri","Arial";
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
            table {
                border-spacing: 10px;
            }
          }
          th, td {
            padding: 1px;
        }
        table{
            width:100%;
        }
        td {
            width: 25px;
            font-size:14px;
        }
        thead tr        {
            height:60px;
            background:#042a4a;
            font-size:16px;
            color:white;
          }

        </style>';

        //Header da planilha
        $html .= '<table>
        <thead">
          <tr>
            <th style="width:10px;">Nº</th>
            <th>Venc.</th>
            <th>Cad.</th>
            <th>Título</th>
            <th>Categoria</th>
            <th>Valor</th>

          </tr>
        <thead>
        <tbody>';

        //Selecionar todos os itens da tabela
        $public = DB::select('SELECT * FROM anuncifacil.publicidade where status = "on"');
        //Soma o total para o valor
        $soma = DB::select('SELECT sum(valor) as valor FROM anuncifacil.publicidade');

        foreach ($public as $pub) {
            $html .= '<tr style="height:60px;">';
            $html .= '<td>' . $pub->id . '</td>';
            $html .= '<td>' . $pub->vencimento . '</td>';
            $html .= '<td>' . $pub->data . '</td>';
            $html .= '<td>' . $pub->titulo . '</td>';;
            $html .= '<td>' . $pub->tipo . '</td>';
            $html .= '<td>R$ ' . number_format($pub->valor, 2, ',', '.') . '</td>';
            $html .= '</tr>';
        }

        //Valor total final da planilha

        $html .= '<tr>';
        $html .= '<td colspan="5"><b>Total</b></td>';
        foreach ($soma as $som) {
            $html .= '<td>R$ ' . number_format($som->valor, 2, ',', '.') . '</td>';
        }
        $html .= '</tr>';


        //$customPaper = array(0,0,1100,841.89);
        //$dompdf->set_paper($customPaper);
        $dompdf->loadHtml($html);
        $dompdf->render();

        $dompdf->stream($arquivo, array("Attachment" => true));
        // Configurações header para forçar o download
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: application/x-msexcel");
        header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
        header("Content-Description: PHP Generated Data");

        // Envia o conteúdo do arquivo
        echo $html;
        exit;
    }













    public function recibo($id)
    {
        //  require_once (asset('assets/vendor/dompdf/autoload.inc.php'));

        require_once 'dompdf/autoload.inc.php';



        $options = new Options();
        $options->set('isRemoteEnabled',true);
        $dompdf = new Dompdf( $options );

        // Definimos o nome do arquivo que será exportado
        $arquivo = 'recibo.pdf';

        // Criamos uma tabela HTML com o formato da planilha
        $html = '<!DOCTYPE html>
        <html lang="pt-br">
            <head>
                <meta charset="utf-8">
                <title>Contato</title>
            <head>
            <body>';


        //Style do PDF
        $html .= '<style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;

        }

        #receipt {
            border: 2px solid #000;
            padding: 20px;
            max-width: 1000px;
            margin: 0 auto;
        }

        #receipt-header {
            text-align: center;
            margin-bottom: 20px;
        }

        #receipt-header h1 {
            margin: 0;
        }

        #receipt-info {
            margin-bottom: 20px;
        }

        #receipt-items {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        #receipt-items th,
        #receipt-items td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        #receipt-total {
            text-align: right;
        }
        #receipt-ass{
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
        }

        </style>';

        //Header da planilha


        //Selecionar todos os itens da tabela
        $public = DB::select("SELECT * FROM anuncifacil.publicidade where id = $id");
        //Soma o total para o valor

        function obterMesEmPortugues($mes)
        {
            $meses = array(
                1 => 'JANEIRO',
                2 => 'FEVEREIRO',
                3 => 'MARÇO',
                4 => 'ABRIL',
                5 => 'MAIO',
                6 => 'JUNHO',
                7 => 'JULHO',
                8 => 'AGOSTO',
                9 => 'SETEMBRO',
                10 => 'OUTUBRO',
                11 => 'NOVEMBRO',
                12 => 'DEZEMBRO'
            );

            return $meses[$mes];
        }


        $mesPorExtenso = obterMesEmPortugues(date('n'));
        $image = 'https://fashionelite.com/wp-content/uploads/2016/09/1331144712_IMG_paris1.jpg';
        foreach ($public as $pub) {

            $html .= '<div id="receipt">
        <div id="receipt-header">
        <div id="receipt-header">
        <h1>Recibo</h1>
    </div>
    </table>
        </div>
        <div id="receipt-info">
        <p><strong>Recebi(emos) de: </strong>' . $pub->titulo . '</p>
            <p><strong>A importância de:</strong> R$ ' . number_format($pub->valor, 2, ',', '.') . '</p>

            <p><strong>SITE/' . $mesPorExtenso . '-PRESTAÇÃO DE SERVIÇOS</strong></p>

            <p><strong>Para maior clareze, firmo o presente CORNELIO PROCOPIO, <u>' . date('d') . '</u> de <u>     '  . $mesPorExtenso . '     </u> de <u>    ' . date('Y') . '    </u></p>
        </div>

        <table style="width: 100%;">
    <tr>
        <td style="width: 50%;">
            <p><strong>REGINALDO DONIZETE TINTI</strong></p>
            <p>Fone: (43) 99982-2633</p>
        </td>
        <td style="text-align: right;">
            <p><strong>___________________</strong></p>
            <p style="margin-left: 10px;">Assinatura</p>
        </td>
    </tr>
</table>


    </div>';
        }





        //Valor total final da planilha



        //$customPaper = array(0,0,1100,841.89);
        //$dompdf->set_paper($customPaper);

        $dompdf->loadHtml($html);

        $dompdf->render();

        $dompdf->stream($arquivo, array("Attachment" => true));


        // Configurações header para forçar o download
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");

        header("Content-type: application/x-msexcel");
        header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
        header("Content-Description: PHP Generated Data");

        // Envia o conteúdo do arquivo
        echo $html;

        exit;
    }


    public function recibos()
    {
        //  require_once (asset('assets/vendor/dompdf/autoload.inc.php'));

        require_once 'dompdf/autoload.inc.php';



        $options = new Options();
        $options->set('isRemoteEnabled',true);
        $dompdf = new Dompdf( $options );

        // Definimos o nome do arquivo que será exportado
        $arquivo = 'recibo.pdf';

        // Criamos uma tabela HTML com o formato da planilha
        $html = '<!DOCTYPE html>
        <html lang="pt-br">
            <head>
                <meta charset="utf-8">
                <title>Contato</title>
            <head>
            <body>';


        //Style do PDF
        $html .= '<style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;

        }

        #receipt {
            border: 2px solid #000;
            padding: 15px;
            max-width: 1000px;
            margin: 0 auto;
            height:auto;
            font-size: 10px;
        }

        #receipt-header {
            text-align: center;

        }

        #receipt-header h1 {
            margin: 0;
        }

        #receipt-info {
            margin-bottom: 20px;
        }

        #receipt-items {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        #receipt-items th,
        #receipt-items td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        #receipt-total {
            text-align: right;
        }
        #receipt-ass{
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
        }

        </style>';

        //Header da planilha

        function obterMesEmPortuguess($mes)
        {
            $meses = array(
                1 => 'JANEIRO',
                2 => 'FEVEREIRO',
                3 => 'MARÇO',
                4 => 'ABRIL',
                5 => 'MAIO',
                6 => 'JUNHO',
                7 => 'JULHO',
                8 => 'AGOSTO',
                9 => 'SETEMBRO',
                10 => 'OUTUBRO',
                11 => 'NOVEMBRO',
                12 => 'DEZEMBRO'
            );

            return $meses[$mes];
        }
        //Selecionar todos os itens da tabela
        $public = DB::select('SELECT * FROM anuncifacil.publicidade where status = "on"');
        //Soma o total para o valor

        $mesPorExtenso = obterMesEmPortuguess(date('n'));



        $recibosPorFolha = 0;
        foreach ($public as $pub) {

            $html .= '<div id="receipt">
        <div id="receipt-header">
        <div id="receipt-header">
        <h1>Recibo</h1>
    </div>
    </table>
        </div>
        <div id="receipt-info">
        <p><strong>Recebi(emos) de: </strong>' . $pub->titulo . '</p>
            <p><strong>A importância de:</strong> R$ ' . number_format($pub->valor, 2, ',', '.') . '</p>

            <p><strong>SITE/' . $mesPorExtenso . '-PRESTAÇÃO DE SERVIÇOS</strong></p>

            <p><strong>Para maior clareze, firmo o presente CORNELIO PROCOPIO, <u>' . date('d') . '</u> de <u>     '  . $mesPorExtenso . '     </u> de <u>    ' . date('Y') . '    </u></p>
        </div>

        <table style="width: 100%;">
    <tr>
        <td style="width: 50%;">
            <p><strong>REGINALDO DONIZETE TINTI</strong></p>
            <p>Fone: (43) 99982-2633</p>
        </td>
        <td style="text-align: right;">
            <p><strong>___________________</strong></p>
            <p style="margin-left: 10px;">Assinatura</p>
        </td>
    </tr>
</table>


    </div>';

    $recibosPorFolha++;
    if ($recibosPorFolha === 4) {
        $html .= '<div style="page-break-after: always;"></div>';
        // Reinicia a contagem para o próximo grupo de três recibos
        $recibosPorFolha = 0;
    }

        }





        //Valor total final da planilha



        //$customPaper = array(0,0,1100,841.89);
        //$dompdf->set_paper($customPaper);

        $dompdf->loadHtml($html);

        $dompdf->render();

        $dompdf->stream($arquivo, array("Attachment" => true));


        // Configurações header para forçar o download
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");

        header("Content-type: application/x-msexcel");
        header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
        header("Content-Description: PHP Generated Data");

        // Envia o conteúdo do arquivo
        echo $html;

        exit;
    }
}
