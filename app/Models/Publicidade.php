<?php

namespace App\Models;

use Dompdf\Dompdf;
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
            padding: 5px;
        }
        table{
            width:100%;
        }
        td {
            width: 30px;
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
            $html .= '<td>R$ ' . number_format($pub->valor, 2, ',','.') . '</td>';
            $html .= '</tr>';
        }

        //Valor total final da planilha

        $html .= '<tr>';
        $html .= '<td colspan="5"><b>Total</b></td>';
        foreach ($soma as $som) {
            $html .= '<td>R$ ' . number_format($som->valor, 2, ',','.') . '</td>';
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
}
