<?php

require_once "crud/crud_article.php";
require_once "crud/crud_command.php";
require_once "crud/crud_user.php";

require_once '../vendor/autoload.php';

class PDF extends \TCPDF {
    function Header() {
        $this->SetFont('helvetica', 'B', 16);
        $this->Cell(0, 10, 'Facture', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage(), 0, 0, 'C');
    }
}

function generatePDF(int $id_command) {
    $order = getOrderById($id_command);
    createPDF($order);
}

function createPDF($command) {
    $pdf = new PDF();
    $pdf->SetCreator('Y-Commerce');
    $pdf->SetAuthor('Y-Commerce System');
    $pdf->SetTitle('Facture');
    
    $pdf->AddPage();
    $pdf->SetFont('helvetica', '', 12);

    $facture_id = $command["id"];
    $user = getUserById($command['user_id']);
    $client = $user["username"];
    $email = $user["mail"];
    $livraison = $command["adress"];
    $date = $command["transaction_date"];
    $detailsId = json_decode($command['article_list']);
    $articlesDetails = [];

    foreach ($detailsId as $id) {
        $articlesDetails[] = getOrderDetailsById($id);
    }

    $pdf->Cell(0, 10, "Facture ID: $facture_id", 0, 1);
    $pdf->Cell(0, 10, "Client: $client", 0, 1);
    $pdf->Cell(0, 10, "Email: $email", 0, 1);
    $pdf->Cell(0, 10, "Adresse de livraison: $livraison", 0, 1);
    $pdf->Cell(0, 10, "Date: $date", 0, 1);
    $pdf->Ln(10);

    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(80, 10, "Article", 1);
    $pdf->Cell(30, 10, "Quantite", 1);
    $pdf->Cell(30, 10, "Prix", 1);
    $pdf->Cell(30, 10, "Total", 1);
    $pdf->Ln();

    $pdf->SetFont('helvetica', '', 12);
    $total = 0;

    foreach ($articlesDetails as $articleDet) {
        $article = getArticleById($articleDet['article_id']);

        $nom = $article["slug"];
        $quantite = $articleDet["quantity"];
        $prix = $article["price"];
        $total_article = $quantite * $prix;
        $total += $total_article;

        $pdf->Cell(80, 10, $nom, 1);
        $pdf->Cell(30, 10, $quantite, 1);
        $pdf->Cell(30, 10, number_format($prix, 2) . " Euros", 1);
        $pdf->Cell(30, 10, number_format($total_article, 2) . " Euros", 1);
        $pdf->Ln();
    }

    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(140, 10, "Total", 1);
    $pdf->Cell(30, 10, number_format($total, 2) . " Euros", 1);
    $pdf->Ln(10);

    $pdf->Output('D', "facture_$facture_id.pdf");
    exit;
}

generatePDF(11);

?>